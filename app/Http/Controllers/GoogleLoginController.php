<?php

namespace App\Http\Controllers;

use App\Models\SubMembership;
use App\Models\User;
use Carbon\carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use DB;
use Str;

class GoogleLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function callback()
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

             $user = Socialite::driver('google')->user();
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

           
  

            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {
                 $finduser1 = User::where('email', $user->email)->where('google_id',$user->id)->first();
				if(!$finduser1){
                $newUser = User::where('email', $user->email)->update(['google_id'=>$user->id]);
				}
                Auth::login($finduser);
                return redirect()->intended('/panel');

            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => Carbon::now(),
                    'signup_via' => 'google',
                    'google_id' => $user->id,
                    'password' => '12345678',
                    'image' => $name
                ]);

                Auth::login($newUser);

                $me = SubMembership::with('mem')->where("id", 5)->first();
                

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

        } catch (Exception $e) {
           return redirect()->back()->withErrors('Something wents wrong.');
        }
    }
}
