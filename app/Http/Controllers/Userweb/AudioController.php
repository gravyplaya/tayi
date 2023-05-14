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
use DB;
use Str;
use View;
use wapmorgan\Mp3Info\Mp3Info;

class AudioController extends Controller
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

   

 function audio()
    {
        $templateas = Template::get();

        return view('userweb.audio.index', compact('templateas'));
    }


    function audio_to_text(Request $request){

        $remaining_minutes=auth()->user()->speech_minutes - auth()->user()->minutes_reached;
        $seconds=$remaining_minutes * 60;
        $validator= $request->validate([
           'audio_file' => 'required|max:25000',
        ]);
        $audio = new Mp3Info($request->audio_file, true);
        $minutes=ceil($audio->duration / 60);

         if((int)$remaining_minutes< (int)$minutes){
          $validator=[];
         $validator['remaining_minutes']=$remaining_minutes;
         $validator['audio_duration']=$minutes;
        return View::make("userweb.forms.failed_stt")
            ->with("html", $validator)
            ->render();

         }
        $audio_file= $request->audio_file;

        $openai = Setting::where('name', 'open_ai')->first()->value;
        $open_ai_key = $openai;
        $open_ai = new OpenAi($open_ai_key);
        $dir="audio/";
         if ($audio_file != null) {

            $ext = $audio_file->getClientOriginalExtension();
            $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "." . $ext;
            if($this->storage_space != "same_server"){
                $category_image_name = $imageName;
                $category_image =$audio_file;

                $filePath = "audio/".$category_image_name;
                $path=Storage::disk($this->storage_space)->put($filePath, file_get_contents($request->file('audio_file')));
                $url_aws =  rtrim(\Storage::disk($this->storage_space)->url('/'));
                $dir=$url_aws.'audio/'.$category_image_name;
    
            }else{
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->putFileAs($dir ,$audio_file, $imageName);
		    $dir = url('/storage/app/public/audio/').'/'.$imageName; 
           		
				
             }
           }else{
            return redirect()->back()->withErrors('Upload a file first');
           }
 
        $cFile = curl_file_create($dir);

        $result = $open_ai->transcribe([
            "model" => "whisper-1",
            "file" => $cFile,
            "language"=>$request->language
        ]);
        
        $res=json_decode($result);
		
        if(property_exists($res, 'text')){
            $user=User::findOrFail(auth()->user()->id);
            $user->minutes_reached=$user->minutes_reached+$minutes;
            $user->save();
        }

        return View::make("userweb.forms.audio_text")
            ->with("html", $res)
            ->render();

    }



    function audio_translate(Request $request){

        $remaining_minutes=auth()->user()->speech_minutes - auth()->user()->minutes_reached;
        $seconds=$remaining_minutes * 60;
        $validator= $request->validate([
           'audio_file' => 'required|max:25000',
        ]);
        $audio = new Mp3Info($request->audio_file, true);
        $minutes=ceil($audio->duration / 60);

         if((int)$remaining_minutes< (int)$minutes){
          $validator=[];
         $validator['remaining_minutes']=$remaining_minutes;
         $validator['audio_duration']=$minutes;
        return View::make("userweb.forms.failed_stt")
            ->with("html", $validator)
            ->render();

         }
        $audio_file= $request->audio_file;
        
        $openai = Setting::where('name', 'open_ai')->first()->value;
        $open_ai_key = $openai;
        $open_ai = new OpenAi($open_ai_key);
        $dir="audio/";
         if ($audio_file != null) {

            $ext = $audio_file->getClientOriginalExtension();
            $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "." . $ext;
            if($this->storage_space != "same_server"){
                $category_image_name = $imageName;
                $category_image =$audio_file;
                $filePath = "audio/".$category_image_name;
                $path=Storage::disk($this->storage_space)->put($filePath, fopen($category_image, 'r+'), 'public');
                $url_aws =  rtrim(\Storage::disk($this->storage_space)->url('/'));
                $dir=$url_aws.'audio/'.$category_image_name;
       
                
            }else
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->putFileAs($dir ,$audio_file, $imageName);
			  $dir = url('/storage/app/public/audio/').'/'.$imageName; 
           }else{
            return redirect()->back()->withErrors('Upload a file first');
           }
 
       
        $cFile = curl_file_create($dir);

        $result = $open_ai->translate([
            "model" => "whisper-1",
            "file" => $cFile
        ]);
        
        $res=json_decode($result);
        if(property_exists($res, 'text')){
            $user=User::findOrFail(auth()->user()->id);
            $user->minutes_reached=$user->minutes_reached+$minutes;
            $user->save();
        }

        return View::make("userweb.forms.audio_translate")
            ->with("html", $res)
            ->render();

    }


}
