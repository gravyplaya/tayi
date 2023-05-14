<?php
   
namespace App\Http\Controllers;
   
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\SubMembership;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use DB;
use Carbon\carbon;
use Str;

   
class LinkedinSocialiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
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
     
            $user = Socialite::driver('linkedin')->user();
      
            $finduser = User::where('email', $user->email)->first();
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
            if($finduser){
                $finduser1 = User::where('email', $user->email)->where('linkedin_id',$user->id)->first();
				if(!$finduser1){
                $newUser = User::where('email', $user->email)->update(['linkedin_id'=>$user->id]);
				}
                Auth::login($finduser);
     
                return redirect()->intended('/panel');
      
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => Carbon::now(),
                    'linkedin_id'=> $user->id,
                    'signup_via'=> 'linkedin',
                    'password' => "12345678",
					'image'=>$name
                ]);
     
                Auth::login($newUser);
                $me = SubMembership::with('mem')->where("id", 5)->first();


                $total_price = 0;
                $plan_tokens = $me->mem->tokens;
                $user = User::where('id', $newUser->id)->first();
                $updateUser = User::findOrFail($newUser->id);
                $updateUser->tokens = $user->tokens + $plan_tokens;
                $updateUser->folders_limit = $me->mem->folder_limit;
                $updateUser->speech_minutes=$user->speech_minutes+$me->mem->speech_minutes;
                $updateUser->plan_id = 5;
                $updateUser->team_member_limit = $me->mem->team_limit;
                $updateUser->projects_limit = $me->mem->project_limit;
                $updateUser->tokens = $plan_tokens;
                $updateUser->save();

                return redirect()->intended('/panel');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}