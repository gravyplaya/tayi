<?php

namespace App\Http\Controllers\Userweb;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Project;
use App\Models\Setting;
use App\Models\SubMembership;
use App\Models\Template;
use App\Models\User;
use App\CentralLogics\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Orhanerday\OpenAi\OpenAi;
use DB;
use Str;
use View;

class ResultController extends Controller
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

    function index(Request $request)
    {
        $storage =  DB::table('image_spaces')
                    ->first();

        if($storage->aws == 1){
            $storage_space = "s3.aws";
        }
        else if($storage->wasabi == 1){
            $storage_space = "s3.wasabi";
        }else{
            $storage_space ="same_server";
        }
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

       if($request->variants != NULL){
        $varientt=$request->variants;
       }else{
        $varientt=1;
       }
       $words_per_image=Setting::where('name','words_per_image')->first()->value;
       
        $rem_tokens = $checkuser->tokens - $checkuser->token_reached;
        $words_limit = $words_per_image*$varientt;
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
        
        $max_results = $variants;
        $imageName=Str::random(10) . '.png';
        $title = $request->title ?? "horses in space";
        $resolution = $request->resolution ?? "256x256";
		$width="256";
		$height="256";
		if($resolution == "256x256"){
			$width="256";
			$height="256";
		}
		if($resolution == "512x512"){
			$width="512";
			$height="512";
		}
		if($resolution == "1024x1024"){
			$width="1024";
			$height="1024";
		}
			  
		
		    $flags = $open_ai->moderation([
				 'input' => $title
			 ]);
    
			$flag=json_decode($flags);

			if($flag->results[0]->flagged==true){
				return View::make("userweb.forms.flagged")
				->with("html", $flag)
				->render();
			}
		
		
		$deepai=Setting::where('name','deep_ai')->first()->value;
		$image_model = Setting::where('name', 'image_model')->first()->value;
		 $dir = "images/";
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
		if($image_model=="dall"){
            $complete = $open_ai->image([
                'prompt' => $title,
                'size' => $resolution,
                'n' => $max_results,
                "response_format" => "url",
            ]);
			
			

            $response = json_decode($complete, true);
           
           
            if (isset($response['data'])) {
                if (count($response['data']) > 1) {
                    foreach ($response['data'] as $key => $value) {
                        $url = $value['url'];

                        $name = Str::random(10) . '.png';

                        $image = file_get_contents($url);
                         if($storage_space != "same_server"){
                      
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
                        $content->image = $name;
						$content->tools = 1000;
                        $content->save();
						
                        $per_image = $words_per_image;
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
					$content->tools = 1000;
                    $content->resolution = $resolution;
                    $content->image = $name;
                    $content->save();

                    $per_image = $words_per_image;
                    $reached = $checkuser->token_reached + $per_image;
                    $user = User::FindorFail(auth()->user()->id);
                    $user->token_reached = $reached;
                    $user->save();

                    $response['name'][] = $name;
					$response['history_id'][] = $content->id;

                }
                $response['title'] = $title;
                $response['resolution'] = $resolution;
               
                return View::make("userweb.forms.imgresult")
                    ->with("html", $response)
                    ->render();

            } else {
                $response = "No Image found";
                return View::make("userweb.forms.noimgresult")
                    ->with("html", $response)
                    ->render();
            }
			
		 }else{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://api.deepai.org/api/stable-diffusion');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, ['text' => $title, 'grid_size'=> "1",'width'=>$width, 'height'=>$height]);
			$headers = array();
			$headers[] = 'Api-Key: '.$deepai;
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);
           $response = json_decode($result, true);
		
			//single image//
			$url = $response['output_url'];
            $name = Str::random(10) . '.png';
            $imageName=Str::random(10) . '.png';
            $image = file_get_contents($url);
            if($storage_space != "same_server"){
                      
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
                        $content->image = $name;
			            $content->tools = 1000;
                        $content->save();
			
                        $per_image = $words_per_image;
                        $reached = $checkuser->token_reached + $per_image;
                        $user = User::FindorFail(auth()->user()->id);
                        $user->token_reached = $reached;
                        $user->save();
                        $response['name'][] = $name;
						$response['title'] = $title;
						$response['resolution'] = $resolution;
						$response['url']=$url;
			            $response['history_id'] = $content->id;
			     
				
   
                return View::make("userweb.forms.diffresult")
                    ->with("value", $response)
                    ->render();
		}
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
		
		$checkinput=auth()->user()->input_lang;
        $get_details = Template::with('template_fields')->where('slug', $slug)->first();

        if($slug=="ai_images"){
          return view('userweb.forms.aiimages', compact('slug'));
        }
		
		if($slug=="image_editor"){
          return view('userweb.forms.image_editor', compact('slug'));
        }


        return view('userweb.forms.edit', compact('get_details', 'slug','getproject'));
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
	
	
	
	function get_edited_image(Request $request){

   
       $varientt=1;
       $checkuser = User::Where('id', auth()->user()->id)->first();
       $words_per_image=Setting::where('name','words_per_image')->first()->value;
       
        $rem_tokens = $checkuser->tokens - $checkuser->token_reached;
        $words_limit = $words_per_image*$varientt;
        if ($rem_tokens < $words_limit) {
            return View::make("userweb.forms.alert")
                ->with("html", $rem_tokens)
                ->render();
        }


        $storage =  DB::table('image_spaces')
                    ->first();

        if($storage->aws == 1){
            $storage_space = "s3.aws";
        }
        else if($storage->wasabi == 1){
            $storage_space = "s3.wasabi";
        }else{
            $storage_space ="same_server";
        }
        $deepai=Setting::where('name','deep_ai')->first()->value;
		$image_model = Setting::where('name', 'image_model')->first()->value;
        $validator= $request->validate([
           'image' => 'required|max:25000',
        ]);
       
        $image= $request->image;
         $dir = "images/";
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
         if ($image != null) {

            $ext = $image->getClientOriginalExtension();
            $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "." . $ext;
            if($this->storage_space != "same_server"){
                $category_image_name = $imageName;
                $category_image =$image;

                $filePath = "images/".$category_image_name;
                $path=Storage::disk($this->storage_space)->put($filePath, file_get_contents($request->file('image')));
                $url_aws =  rtrim(\Storage::disk($this->storage_space)->url('/'));
                $dir=$url_aws.'images/'.$category_image_name;
    
            }else{
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->putFileAs($dir ,$audio_file, $imageName);
		    $dir = url('/storage/app/public/images/').'/'.$imageName; 
           		
				
             }
           }else{
            return redirect()->back()->withErrors('Upload an image first');
           }
 
        $cFile = curl_file_create($dir);
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://api.deepai.org/api/image-editor');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$post = array(
			'image' => $cFile,
			'text' => $request->title
		);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		$headers = array();
		$headers[] = 'Api-Key:'.$deepai;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		$checkuser=User::where('id',auth()->user()->id)->first();
		 $words_per_image = Setting::where('name', 'words_per_image')->first()->value;
		$response = json_decode($result, true);
        $re = json_decode($result);
		$dir = "images/";
		if(property_exists($re, 'output_url')){
		$title=$request->title;
		$resolution="256x256";
	
            	//single image//
			$url = $response['output_url'];
            $name = Str::random(10) . '.png';
            $image = file_get_contents($url);
            if($storage_space != "same_server"){
                      
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
		             	$content->tools = 1000;
                        $content->resolution = $resolution;
                        $content->image = $name;
                        $content->save();
			
                        $per_image = $words_per_image;
                        $reached = $checkuser->token_reached + $per_image;
                        $user = User::FindorFail(auth()->user()->id);
                        $user->token_reached = $reached;
                        $user->save();
                        $response['name'][] = $name;
						$response['title'] = $title;
						$response['resolution'] = $resolution;
						$response['url']=$url;
			
			     
				
   
                return View::make("userweb.forms.diffresult")
                    ->with("value", $response)
                    ->render();
			     
				
   
		}else{
			$response="Something went wrong Please try again after sometime!";
			return View::make("userweb.forms.server_issue")
                    ->with("html", $response)
                    ->render();
		}

    }


}
