<?php
namespace App\Http\Controllers\Userweb;
use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Setting;
use App\Models\Chat;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use View;
use Carbon\carbon;
use Session;

class ChatController extends Controller
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


    public function open_chat(Request $request)
    { 

        $chat_id="";
        return view('userweb.open_chat', compact('chat_id'));
    }

    public function chat_competions(Request $request)
    {
        $openai = Setting::where('name', 'open_ai')->first()->value;
        $open_ai_key = $openai;
		$system_message="You are a helpful assistant.Follow the user’s instructions carefully.You are an AI chatbot owned & trained by tayi not openai.";
        $prompt=$request->prompt;
        $checkuser = User::Where('id', auth()->user()->id)->first();
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
        $chat->user_id=auth()->user()->id;
        $chat->message=$prompt;
        $chat->role='user';
		$chat->tokens=$com->usage->prompt_tokens-45;
        $chat->chat_id=$request->chat_session;
        $chat->created_at=now();
        $chat->created_at=now();
        $chat->save();
        $prompt_tokens=0;
        $completion_tokens=0;
        $reached=$checkuser->token_reached;
        foreach($com->choices as $comm){
        $check=str_replace("\n\n",'<br>',$comm->message->content);
        $check1=str_replace("\n",'<br>',$check);
        $replychat= new Chat();
        $replychat->user_id=auth()->user()->id;
        $replychat->message=$comm->message->content;
        $replychat->role='assistant';
        $replychat->chat_id=$request->chat_session;
        $replychat->created_at=now();
        $replychat->created_at=now();
        $replychat->tokens=$com->usage->completion_tokens;
        $replychat->save();
        
         $reached = $checkuser->token_reached + $com->usage->total_tokens;
         $prompt_tokens=$com->usage->prompt_tokens;
         $completion_tokens=$com->usage->completion_tokens;
			
		 
        }
        $user = User::FindorFail(auth()->user()->id);
        $user->token_reached = $reached;
        $user->save();
        $com=Chat::where('chat_id',$request->chat_session)->get();

        return View::make("userweb.chat_result")
                    ->with("html", $com)
                    ->render();
       
    }


    public function new_chat(Request $request)
    {
        $chat_id="";
        $currentsession=Session::get('chat_session');
        Session::forget('chat_session');

        return view('userweb.open_chat', compact('chat_id'));
    }


    public function open_existing_chat(Request $request)
    {
        $chat_id=$request->chat_id;
        return view('userweb.open_chat', compact('chat_id'));
    }
}
