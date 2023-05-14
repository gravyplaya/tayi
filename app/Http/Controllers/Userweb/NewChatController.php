<?php
namespace App\Http\Controllers\Userweb;
use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Setting;
use App\Models\Chat;
use App\Models\Framework;
use App\Models\User;
use App\Models\ChatQuestion;
use Auth;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use View;
use Carbon\carbon;
use Session;

class NewChatController extends Controller
{


   public function all_experts(Request $request)
    { 
        $f_id= $request->framework_id;
        $framework_details=Framework::with('chat_questions')->get();
        return view('userweb.all_experts',compact('framework_details'));

    }



    public function open_framework_chat(Request $request)
    { 

        $slug = trim(preg_replace('/[^A-Za-z0-9]/', '-', $request->chat_name));
        $chat_session=$slug."-".auth()->user()->id;
        $check_chat=Chat::where('chat_id',$chat_session)->first();
        if($check_chat){
        $chats=Chat::where('chat_id',$chat_session)->get();
        $chat_answer=ChatAnswer::where('chat_session',$chat_session)->where('answer',NULL)->first();

        $chat=new Chat();
        $chat->chat_name=$request->chat_name;
        $chat->chat_id=$slug."-".auth()->user()->id;
        $chat->role='assistant';
        $chat->first_msg=1;
        $chat->framework_id=$f_id;
        $chat->user_id=auth()->user()->id;
        $chat->lang=$request->lang;
        $chat->message=$chat_answer->question;;
        $chat->save();

        }else{
        $f_id= $request->framework_id;
        $getQuestions=ChatQuestion::where('framework_id',$f_id)->get();
        if(count($getQuestions)>0){
            foreach($getQuestions as $getques){
                $new=new ChatAnswer();
                $new->chat_session=$chat_session;
                $new->question_id=$getques->id;
                $new->question=$getques->question;
                if($getques->options != NULL){
                $new->options=$getques->options;
                 }
                $new->created_at=now();
                $new->updated_at=now();
                $new->save();
            }
        }


        $chat_answer=ChatAnswer::where('chat_session',$chat_session)->where('answer',NULL)->first();
        if($chat_answer){
        $chat=new Chat();
        $chat->chat_name=$request->chat_name;
        $chat->chat_id=$slug."-".auth()->user()->id;
        $chat->role='assistant';
        $chat->first_msg=1;
        $chat->framework_id=$f_id;
        $chat->user_id=auth()->user()->id;
        $chat->lang=$request->lang;
        $chat->message=$chat_answer->question;;
        $chat->save();

        $chat_id=$chat->chat_id;
        Session::put('chat_session', $chat_id);
        Session::save();
         }


        $framework_details=Framework::with('chat_questions')->where('id',$f_id)->first();
        $getdata=json_decode($request->getanswers);
        $framework=Framework::where('id',$f_id)->first();
        $questions=ChatQuestion::where('framework_id',$f_id)->get();
        $system_message=$framework->system_message;
        foreach($questions as $ques){
             $name=$ques->name;
             $remove="#".$name."#";
             $system_message=str_replace($remove,$getdata->$name,$system_message);
         }

        $replychat= new Chat();
		$replychat->chat_name=$framework_details->name;
		$replychat->chat_description=$framework_details->description;
        $replychat->user_id=$request->user()->id;
        $replychat->message=$system_message;
        $replychat->role='system';
        $replychat->chat_id=$request->chat_session;
		$replychat->framework_id= $f_id;
        $replychat->created_at=now();
        $replychat->created_at=now();
        $replychat->save();
			
        $chats=[];
        }


        return response()->json(['chats'=>$chats]);
    }
	
	
	
	public function allchats(Request $request){
		 
		 $chats=Chat::where('user_id', $request->user()->id)
			 ->where('chat_id',$request->chat_session)
			 ->where('role','system')
			 ->get();
		
		  return response()->json(['chats'=>$chats]);
	}

    public function chat_completions(Request $request)
    {

        
        $chat=Chat::where('user_id', $request->user()->id)->where('chat_id',$request->chat_session)->where('first_msg',1)->first();
        $openai = Setting::where('name', 'open_ai')->first()->value;
        $open_ai_key = $openai;
        $prompt=$request->prompt;
        $checkuser = User::Where('id', $request->user()->id)->first();


        $system_message=Chat::where('user_id', $request->user()->id)->where('chat_id',$request->chat_session)->where('role','system')->first();
        if(!$system_message){
            $system_message="You Are a Helpful Assistant";
        }else{
            $system_message=$system_message->message;
        }


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"model\": \"gpt-3.5-turbo\",\n  \"max_tokens\": 2000,\n  \"messages\": [{\"role\": \"system\", \"content\": \".$system_message.\"},{\"role\": \"user\", \"content\": \".$prompt.\"}]\n}");
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
    
        $chat= new Chat();
        $chat->user_id=$request->user()->id;
        $chat->message=$prompt;
        $chat->role='user';
        $chat->chat_id=$request->chat_session;
        $chat->created_at=now();
        $chat->created_at=now();
        $chat->save();
        $prompt_tokens=0;
        $completion_tokens=0;
        $reached=$checkuser->token_reached;
		$chat_tokens=$checkuser->chat_tokens;
        foreach($com->choices as $comm){
        $check=str_replace("\n\n",'<br>',$comm->message->content);
        $check1=str_replace("\n",'<br>',$check);
        $replychat= new Chat();
        $replychat->user_id=$request->user()->id;
        $replychat->message=$comm->message->content;
        $replychat->role='assistant';
        $replychat->chat_id=$request->chat_session;
        $replychat->created_at=now();
        $replychat->created_at=now();
        $replychat->save();
        
         $reached = $checkuser->token_reached + $com->usage->total_tokens;
	     $chat_tokens = $checkuser->chat_tokens + $com->usage->total_tokens;
         $prompt_tokens=$com->usage->prompt_tokens;
         $completion_tokens=$com->usage->completion_tokens;
        }
        $user = User::FindorFail($request->user()->id);
        $user->token_reached = $reached;
		$user->chat_tokens =  $chat_tokens;
        $user->save();
        $com=Chat::where('chat_id',$request->chat_session)->get();

         return response()->json(['chats'=>$com]);
       
    }


    public function audio_to_text(Request $request)
    {
        $openai = Setting::where('name', 'open_ai')->first()->value;
        $open_ai_key = $openai;
        $files=$request->file;
        dd($files);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/audio/transcriptions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $post = array(
            'file' => $files,
            'model' => 'whisper-1'
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $headers = array();
        $headers[] = 'Authorization: Bearer '.$open_ai_key;
        $headers[] = 'Content-Type: multipart/form-data';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $text=json_decode($result);
        return response()->json(['audio_text'=>$text]);
    }


   

    public function chat_to_favourite(Request $request,$status,$slug)
    {
        $chat=Chat::where('user_id', $request->user()->id)->where('chat_id',$slug)->where('first_msg',1)->Update(['fav'=>$status]);
         $chat_id="";
        return view('userweb.chat_new', compact('chat_id'));
    }
	
	
	 public function delete_chat(Request $request)
    {
		 $chat_session=$request->chat_session;
        $chat=Chat::where('user_id', $request->user()->id)->where('chat_id',$chat_session)->delete();
        return redirect()->back()->withSuccess("chat deleted successfully");
    }

}
