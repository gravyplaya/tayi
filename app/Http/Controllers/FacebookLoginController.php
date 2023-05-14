<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SubMembership;
use App\Models\User;
use Carbon\carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;
use Validator;
use Socialite;
use Exception;
use Str;

class FacebookLoginController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
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
        try {
           
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('email', $user->email)->first();
            $dir = 'user/';
			 $url = $user->avatar;
             $name = Str::random(10) . '.png';
             $image = file_get_contents($url);
             $imageName=$name;

			 if($storage_space != "same_server"){   
				 $filePath = $dir.$name;

				 $path=Storage::disk($storage_space)->put($filePath, $image);
			 }else{
				 if (!Storage::disk('public')->exists($dir)) {
					 Storage::disk('public')->makeDirectory($dir);
				 }
				 Storage::disk('public')->put($dir . $imageName, $image);
			 }
            if($isUser){
				$finduser1 = User::where('email', $user->email)->where('fb_id',$user->id)->first();
				if(!$finduser1){
                $newUser = User::where('email', $user->email)->update(['fb_id'=>$user->id]);
				}
                Auth::login($isUser);
               return redirect()->intended('/panel');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => Carbon::now(),
                    'signup_via' => 'facebook',
                    'fb_id' => $user->id,
                    'password' =>"12345678",
					'image'=>$name
                ]);
    
                Auth::login($createUser);
                $me = SubMembership::with('mem')->where("id", 5)->first();

                 $newUser=$createUser;
                $total_price = 0;
                $plan_tokens = $me->mem->tokens;
                $user = User::where('id', $newUser->id)->first();
                $updateUser = User::findOrFail($newUser->id);
                $updateUser->tokens = $user->tokens + $plan_tokens;
                $updateUser->speech_minutes=$user->speech_minutes+$me->mem->speech_minutes;
                $updateUser->folders_limit = $me->mem->folder_limit;
                $updateUser->plan_id = 5;
                $updateUser->team_member_limit = $me->mem->team_limit;
                $updateUser->projects_limit = $me->mem->project_limit;
                $updateUser->tokens = $plan_tokens;
                $updateUser->save();

                return redirect()->intended('/panel');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}