<?php

namespace App\Http\Controllers\Userweb;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Setting;
use App\Models\SubMembership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Orhanerday\OpenAi\OpenAi;
use Str;
use View;
use DB;

class ArticleController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
        $storage =  DB::table('image_spaces')
                    ->first();

        if($storage->aws == 1){
            $this->storage_space = "s3.aws";
        }
        else if($storage->wasabi == 1){
            $this->storage_space = "s3.wasabi";
        }else{
            $this->storage_space ="same_server";
        }

    }
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    function generated_article(Request $request)
    {
        $storage =  DB::table('image_spaces')
                    ->first();
         $imageName = Str::random(10) . '.png';
        if($storage->aws == 1){
            $storage_space = "s3.aws";
        }
        else if($storage->wasabi == 1){
            $storage_space = "s3.wasabi";
        }else{
            $storage_space ="same_server";
        }
        $mem_id = auth()->user()->plan_id;
        $submem = SubMembership::with('mem')->where('id', $mem_id)->first();
        $words_per_image = Setting::where('name', 'words_per_image')->first()->value;
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
        if($request->images != NULL){
        $varientt=$request->images;
       }else{
        $varientt=1;
       }
      $words_per_image=Setting::where('name','words_per_image')->first()->value;;
       
        $rem_tokens = $checkuser->tokens - $checkuser->token_reached;
        $words_limit = $words_per_image*$varientt + (int)$request->words_limit; 
        if ($rem_tokens < $words_limit) {
            return View::make("userweb.forms.alert")
                ->with("html", $rem_tokens)
                ->render();
        }


        $openai = Setting::where('name', 'open_ai')->first()->value;

        $open_ai_key = $openai;
        $open_ai = new OpenAi($open_ai_key);
        $model = $submem->mem ? $submem->mem->model : "text-davinci-003";
        $lang = $request->lang ?? auth()->user()->output_lang;
        $tone = $request->tone ?? "friendly";
        $variants = $request->variants ? (int)$request->variants : 1;
//generate images//
        $max_results = $request->images ?? 0;
        $title = $request->title ?? "25 best places to visit in india in 2023";
        $resolution = "256x256";
        $keywords = $request->keywords;
        $flags = $open_ai->moderation([
                 'input' => $title
             ]);
    
            $flag=json_decode($flags);

            if($flag->results[0]->flagged==true){
                return View::make("userweb.forms.flagged")
                ->with("html", $flag)
                ->render();
            }
        if ($max_results > 0) {

          
            $complete = $open_ai->image([
                'prompt' => $keywords,
                'size' => $resolution,
                'n' => (int)$max_results,
                "response_format" => "url",
            ]);

            $response = json_decode($complete, true);
            
            $dir = "images";
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            if (isset($response['data'])) {
                if (count($response['data']) > 1) {
                    foreach ($response['data'] as $key => $value) {
                         $url = $value['url'];
                       
                        $name = Str::random(10) . '.png';

                        $image = file_get_contents($url);
                      if($storage_space != "same_server"){
                        $dir = "images/";
                      $filePath = $dir.$name;
                
                       $path=Storage::disk($storage_space)->put($filePath, $image);
                    }else{
                       if (!Storage::disk('public')->exists($dir)) {
                          Storage::disk('public')->makeDirectory($dir);
                       }
                       Storage::disk('public')->put($dir . $imageName, $image);
                    }

                        $content = new History();
                        $content->user_id = auth()->user()->id;
                        $content->prompt = $title;
                        $content->resolution = $resolution;
                        $content->tools = 1000;
                        $content->image = $name;
                        $content->save();
                        $per_image = Setting::where('name', 'words_per_image')->first()->value;
                        $reached = $checkuser->token_reached + $per_image;
                        $user = User::FindorFail(auth()->user()->id);
                        $user->token_reached = $reached;
                        $user->save();


                        $response['name'][] = $name;
                        $response['history_id'][] = $content->id;

                    }
                } else {
                    $url = $response['data'][0]['url'];
                      $name = Str::random(10) . '.png';
                      $image = file_get_contents($url);
                      if($storage_space != "same_server"){
                      $dir = "images/";
                      $filePath = $dir.$name;
                
                       $path=Storage::disk($storage_space)->put($filePath, $image);
                    }else{
                       if (!Storage::disk('public')->exists($dir)) {
                          Storage::disk('public')->makeDirectory($dir);
                       }
                       Storage::disk('public')->put($dir . $imageName, $image);
                    }

                    $content = new History();
                    $content->user_id = auth()->user()->id;
                    $content->prompt = $title;
                    $content->resolution = $resolution;
                    $content->tools = 1000;
                    $content->image = $name;
                    $content->save();

                    $per_image = Setting::where('name', 'words_per_image')->first()->value;
                    $reached = $checkuser->token_reached + $per_image;
                    $user = User::FindorFail(auth()->user()->id);
                    $user->token_reached = $reached;
                    $user->save();

                    $response['name'][] = $name;
                    $response['history_id'][] = $content->id;

                }
                $response['title'] = $title;
                $response['resolution'] = $resolution;
                $response['image'] = 1;


            } else {
                $response['name'][] = "no image";
                $response['title'] = $title;
                $response['image'] = 0;
                $response['resolution'] = "";

            }
        }
//generate images//

        $tokens = $request->words_limit;

        $max_token = $tokens ?? $rem_tokens;
        $subheadings = $request->addmore;
        $sub = implode(',', $subheadings);

        $keywords = $request->keywords;
        if ($max_token > 1200) {
            $max_token = 1200;
        }
        
        $toneprefix="Write an article on " . $title . " with keywords " . $keywords . " with subheadings " . $sub . " in " . $tokens . " words input Language: " . auth()->user()->input_lang . " output Language: " . $lang;
        ////chatgpt code///

        
        $system_message="You are a helpful assistant";
        if($open_ai_model == "chatGPT"){
  
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

        $response['article'] = $com;


        $insert = new History();
        $insert->prompt = $title;
        $insert->results = $prod_name;
        $insert->model = $model;
        $insert->token_used = $reached;
        $insert->prompt_tokens = $prompt_tokens;
        $insert->tools = 1001;
        $insert->response_tokens = $completion_tokens;
        $insert->user_id = auth()->user()->id;
        $insert->created_at = now();
        $insert->save();


        $user = User::FindorFail(auth()->user()->id);
        $user->token_reached = $reached;
        $user->save();

        $response['template_id'] = 1001;
        $response['article_history_id']=$insert->id;
        return View::make("userweb.article_details")
            ->with("html", $response)
            ->render();


    }


}
