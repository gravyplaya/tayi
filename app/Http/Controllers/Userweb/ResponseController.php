<?php

namespace App\Http\Controllers\Userweb;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Project;
use App\Models\Setting;
use App\Models\SubMembership;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Orhanerday\OpenAi\OpenAi;
use Str;
use View;

class ResponseController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    function response(Request $request)
    {
        
        $mem_id = auth()->user()->plan_id;
        $planend = strtotime(auth()->user()->plan_end);
        $today = strtotime(date('Y-m-d'));
        $submem = SubMembership::with('mem')->where('id', $mem_id)->first();
        $checkuser = User::Where('id', auth()->user()->id)->first();
        $open_ai_model=Setting::where('name','open_ai_model')->first()->value;
        if($checkuser->plan_id != 5){
        if ($planend < $today) {

            $checkuser=User::Where('id', auth()->user()->id)->update(['plan_id' => 5,'plan_start'=>NULL, 'plan_end'=>NULL]);
        }
       }
       $checkuser = User::Where('id', auth()->user()->id)->first();
        $rem_tokens = $checkuser->tokens - $checkuser->token_reached;
        $words_limit = $request->words_limit ?? $rem_tokens;
        if ($rem_tokens < $words_limit) {
            return View::make("userweb.forms.alert")
                ->with("html", $rem_tokens)
                ->render();
        }


        $openai = Setting::where('name', 'open_ai')->first()->value;
        $open_ai_key = $openai;
        $open_ai = new OpenAi($open_ai_key);
        $model = $submem->mem ? $submem->mem->model : "text-davinci-003";
        $id = $request->ex_id ?? 1;
        $lang = $request->lang ?? auth()->user()->output_lang;
        $tone = $request->tone ?? "friendly";
        $variants = $request->variants ? (int)$request->variants : 1;

        $template=Template::with('template_fields')->where('id',$id)->first();
        $i=1;
        $prompt=$template->prompt;
        foreach($template['template_fields'] as $fields){
            $field="#field-".$i."#";
            $fieldname="field-".$i;
            $prompt=str_replace($field," ".$request->$fieldname." ",$prompt);
            $i++;
        }
     
        $prefix=str_replace("\n\n",',',$prompt);
        $prefix=str_replace("\n",',',$prefix);
        $prefix=str_replace("\r\r",'',$prefix);
        $prefix=str_replace("\r",'',$prefix);

        $flags = $open_ai->moderation([
             'input' => $prompt
         ]);
    
        $flag=json_decode($flags);
       
        if($flag->results[0]->flagged==true){
            return View::make("userweb.forms.flagged")
            ->with("html", $flag)
            ->render();
        }
      
        $words_limit = $request->words_limit ?? $rem_tokens;
        $max_token = $words_limit <= 2000 ? (int)$words_limit : 2000;
        $prompt_tokens=0;
        $completion_tokens=0;
        $reached=$checkuser->token_reached;
        $template=Template::where('id',$id)->first();
		$system_message=$template->system_message;
        if($open_ai_model == "chatGPT"){
       $toneprefix=$prefix ." output Language: ".$lang;
        ////chatgpt code///
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"model\": \"gpt-3.5-turbo\",\n  \"max_tokens\": ".(int)$max_token.",\n  \"n\": ".(int)$variants.",\n  \"temperature\":0.8,\n  \"messages\": [{\"role\": \"system\", \"content\": \".$system_message.\"},{\"role\": \"user\", \"content\": \".$toneprefix.\"}]\n}");
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$open_ai_key;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $com = json_decode($result);
   
        foreach($com->choices as $comm){
      
        $checke1=str_replace("\n\n",'<br>',$comm->message->content);
         $p_name[] = $checke1;
         $prod_name = implode('<br><br><hr>', $p_name);
         $reached = $checkuser->token_reached + $com->usage->total_tokens;
         $prompt_tokens=$com->usage->prompt_tokens;
         $completion_tokens=$com->usage->completion_tokens;
        }
        
        }else{
       $toneprefix=$prefix ." output Language: " . $lang;
        ///davinci
        $complete = $open_ai->completion([
            'model' => $model,
            'prompt' => $toneprefix,
            'temperature' => 0.8,
            'max_tokens' => (int)$max_token,
            'n' => (int)$variants, 
            'frequency_penalty' => 0.0,
            'presence_penalty' => 0.0,
            'top_p' => 1.0,
        ]);

        $com = json_decode($complete);
          foreach ($com->choices as $chs) {
            $checke = str_replace("\n\n", '<br>', $chs->text);
            $checke1 = str_replace("\n", '<br>', $checke);
            $p_name[] = $checke1;
            $prod_name = implode('<br><br><hr>', $p_name);
            $prompt_tokens=$com->usage->prompt_tokens;
            $completion_tokens=$com->usage->completion_tokens;
            $reached = $checkuser->token_reached + $com->usage->total_tokens;

         }

        }
        
    
        $insert = new History();
        $insert->prompt = $prefix;
        $insert->results = $prod_name;
        $insert->model = $model;
        $insert->prompt_tokens = $prompt_tokens;
        $insert->response_tokens = $completion_tokens;
        $insert->token_used = $reached;
		$insert->tools=$id;
        $insert->user_id = auth()->user()->id;
        $insert->created_at = now();
        $insert->save();

        $user = User::FindorFail(auth()->user()->id);
        $user->token_reached = $reached;
        $user->save();
		
        $com->history_id=$insert->id;

        return View::make("userweb.forms.result")
            ->with("html", $com)
            ->render();


    }


    function templatesa()
    {
        $templateas = Template::get();

        return view('userweb.templates', compact('templateas'));
    }


    function edit(Request $request)
    {
        $checkinput=auth()->user()->input_lang;
        $project = $request->project;

        $getproject = Project::where('id', $project)->first();


        $get_details = Template::where('id', $getproject->template)->first();
        $slug = $get_details->slug;
        $title2 = "";
        $subheadings = "";
        $placeholder2 = "";
        $variant = 0;
        $lang = 0;
        $placeholder3 = "";
        $title3 = "";
        $numberss = "";
        $column = "";
        $lang_text = "";
        $resolution_title = "";
        $resol = 0;
        if ($get_details->id == 1) {
            $title = "Question In ".$checkinput;
            $placeholder = "e.g. who is the prime minister of india?";
            $variant = 1;
        } elseif ($get_details->id == 2) {
            $title = "Enter wrong sentence in ".$checkinput;
            $placeholder = "e.g. what are you did?";

        } elseif ($get_details->id == 3) {
            $title = "whole summary";
            $placeholder = "e.g. a paragraph.";

        } elseif ($get_details->id == 4) {

            $title = "Type In ".$checkinput;
            $placeholder = "e.g. hello what's up?.";
            $lang = 1;
            $lang_text = "Translate Into";
        } elseif ($get_details->id == 5) {
            $title = "classification texts ";
            $placeholder = "e.g. apple \n cake \n motorola";
        } elseif ($get_details->id == 6) {
            $title = "Enter Movie Name";
            $placeholder = "e.g. Ghost Rider";
        } elseif ($get_details->id == 7) {
            $title = "Tweets";
            $placeholder = "e.g. tweet1 \n tweet2 \n tweet3";
        } elseif ($get_details->id == 9) {
            $title = "Enter Text (from which you want to extract keywords)";
            $placeholder = "e.g. lorem ipsum";
        } elseif ($get_details->id == 10) {
            $title = "Question in ".$checkinput;
            $placeholder = "e.g. What is tesla?";
            $variant = 1;

        } elseif ($get_details->id == 11) {
            $title = "Write Product Description in".$checkinput;
            $placeholder = "e.g. an AI app";
            $title2 = "Platform(Google,FB)";
            $placeholder2 = "e.g. Google";
            $title3 = "Target(parents,companies)";
            $placeholder3 = "e.g. parents";
            $variant = 1;
        } elseif ($get_details->id == 12) {
            $title = "write subject(on which you want to create spreadsheet) in ".$checkinput;
            $column = "Enter Column Numbers";
            $placeholder = "e.g. recent movies with its release dates, cast, box office collection";
        } elseif ($get_details->id == 15) {
            $title = "write subject(on which you want to create short horror story) in ".$checkinput;
            $placeholder = "e.g. a nightmare";
            $variant = 1;
        } elseif ($get_details->id == 16) {
            $title = "write text(which you want to convert to third person) in ".$checkinput;
            $placeholder = "e.g. I am not interested";
            $variant = 1;
        } elseif ($get_details->id == 17) {
            $title = "write notes in ".$checkinput;
            $placeholder = "e.g. 1-Tom: Profits up 50%\n
Jane: New servers are online\n
Kjel: Need more time to fix software\n
Jane: Happy to help\n
Parkman: Beta testing almost done";

        } elseif ($get_details->id == 18) {
            $title = "Intructions for recipe in ".$checkinput;
            $title2 = "Ingredients for recipe in ".$checkinput;
            $placeholder = "e.g. I want spicy";
            $placeholder2 = "e.g. peas\n potato\n curd";
            $variant = 1;
        } elseif ($get_details->id == 19) {
            $title = "Insert Essay Subject ".$checkinput;
            $placeholder = "e.g. India";
            $variant = 1;
        } elseif ($get_details->id == 20) {
            $title = "Write Notes(for gererating review(s)) in ".$checkinput;
            $placeholder = "e.g. Name: The Blue Wharf\n
        Lobster great, noisy, service polite, prices good.";
            $variant = 1;
        } elseif ($get_details->id == 21) {
            $title = "Write Subject(for gererating review(s)) in ".$checkinput;
            $placeholder = "e.g. What are 5 key points I should know when studying Ancient Rome?";
            $variant = 1;
        } elseif ($get_details->id == 22) {
            $title = "Job Designation ".$checkinput;
            $numberss = "Enter Questions limit";
            $placeholder = "sales executive";
            $variant = 1;
        } elseif ($get_details->id == 23) {
            $title = "Write Blog Subject in ".$checkinput;
            $placeholder = "e.g. OpenAI";
            $variant = 1;
        } elseif ($get_details->id == 24) {
            $title = "Write Notes about your product in ".$checkinput;
            $placeholder = "e.g. A home milkshake maker.";
            $title2 = "seed words";
            $placeholder2 = "e.g. fit, app, flow";
            $variant = 1;
        } elseif ($get_details->id == 25) {
            $title = "article title in ".$checkinput;
            $title2 = "focus keywords(separated by comma) in ".$checkinput;
            $subheadings = "Subheadings(separated by comma) in ".$checkinput;
            $placeholder = "e.g. openAI";
            $placeholder2 = "e.g. future, world";
            $placeholder3 = "e.g. bad effect, good effect";
            $variant = 1;
        } elseif ($get_details->id == 26) {
            $title = "Write Subject(on which you want to create social post) in ".$checkinput;
            $placeholder = "e.g. OpenAI";
            $variant = 1;
        } elseif ($get_details->id == 27) {
            $title = "write title (which you want to change in image) in ".$checkinput;
            $placeholder = "e.g. horse eating icecream";
            $resolution_title = "Select Image Resolution";
            $resol = 1;
            $variant = 1;
        } else {
            $title = "Write Title (On which Yo want to write post) in ".$checkinput;
            $placeholder = "e.g. AI";
            $title2 = "Platform(Google,FB,linkedin etc)";
            $placeholder2 = "e.g. Google";
            $title3 = "Target(parents,companies)";
            $placeholder3 = "e.g. parents";
            $variant = 1;
        }


        return view('userweb.forms.edit', compact('getproject', 'project', 'get_details', 'slug', 'title', 'placeholder', 'title2', 'placeholder2', 'lang', 'variant', 'numberss', 'lang_text', 'column', 'title3', 'placeholder3', 'resol', 'resolution_title', 'subheadings'));
    }


    function save_image(Request $request)
    {

        $project_text = $request->template;

        $tem_id = $request->tem_id;

        $newproject = new Project();
        $newproject->project_id = $request->name;
        $newproject->image = $request->name;
        $newproject->project_text = $request->title;
        $newproject->resolution = $request->resolution;
        $newproject->user_id = auth()->user()->id;
        $newproject->template = 27;
        $newproject->created_at = now();
        $newproject->save();

        if ($newproject) {
            return redirect()->back()->withSuccess('Something Went Wrong Try Again Later');
        } else {
            return redirect()->back()->withErrors('Something Went Wrong Try Again Later');
        }

    }
	
	function like(Request $request)
    {
        $id=$request->id;
		
		if($request->jid){
			$j=$request->jid;
		}else{
			$j=0;
		}
		$getdata=History::where('id', $id)->first();
		if($getdata->like_dislike != 1){
			$getdata=History::where('id', $id)->update(['like_dislike'=>1]);
		}
         $historydata=History::where('id', $id)->first();
		$historydata->j_id=$j;
         return View::make("userweb.forms.like")
            ->with("html", $historydata)
            ->render();
    }
	
	function dislike(Request $request)
    {
        $id=$request->id;
        if($request->jid){
			$j=$request->jid;
		}else{
			$j=0;
		}
		$getdata=History::where('id', $id)->first();
		if($getdata->like_dislike != 2){
			$getdata=History::where('id', $id)->update(['like_dislike'=>2]);
		}
         $historydata=History::where('id', $id)->first();
		 $historydata->j_id=$j;
         return View::make("userweb.forms.like")
            ->with("html", $historydata)
            ->render();
    }
	
	function articlelike(Request $request)
    {
        $id=$request->id;
		
		if($request->jid){
			$j=$request->jid;
		}else{
			$j=0;
		}
		$getdata=History::where('id', $id)->first();
		if($getdata->like_dislike != 1){
			$getdata=History::where('id', $id)->update(['like_dislike'=>1]);
		}
         $historydata=History::where('id', $id)->first();
		$historydata->j_id=$j;
         return View::make("userweb.forms.articlelike")
            ->with("html", $historydata)
            ->render();
    }
	
	function articledislike(Request $request)
    {
        $id=$request->id;
        if($request->jid){
			$j=$request->jid;
		}else{
			$j=0;
		}
		$getdata=History::where('id', $id)->first();
		if($getdata->like_dislike != 2){
			$getdata=History::where('id', $id)->update(['like_dislike'=>2]);
		}
         $historydata=History::where('id', $id)->first();
		 $historydata->j_id=$j;
         return View::make("userweb.forms.articlelike")
            ->with("html", $historydata)
            ->render();
    }


}
