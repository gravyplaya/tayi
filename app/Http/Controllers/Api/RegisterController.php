<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\SubMembership;
use Validator;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = $input['password'];
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $user->sendEmailVerificationNotification();
         $me = SubMembership::with('mem')->where("id", 5)->first();
         $newUser=$user;

        $total_price = 0;
        $plan_tokens = $me->mem->tokens;
        $user = User::where('id', $newUser->id)->first();
        $updateUser = User::findOrFail($newUser->id);
        $updateUser->tokens = $user->tokens + $plan_tokens;
        if ($user->plan_end != NULL) {
            $date = date('Y-m-d', strtotime('+' . $me->days . ' days', strtotime($user->plan_end)));
            $updateUser->plan_end = $date;
        } else {
            $date = date('Y-m-d', strtotime('+' . $me->days . ' days'));
            $updateUser->plan_start = date('Y-m-d');
            $updateUser->plan_end = $date;

        }
        $updateUser->folders_limit = $me->mem->folder_limit;
        $updateUser->plan_id = 5;
        $updateUser->projects_limit = $me->mem->project_limit;
        $updateUser->tokens = $plan_tokens;
        $updateUser->save();
   
        return $this->sendResponse($success, 'You will receive a verification email on '.$input['email'].' please verify your email for using further.');
    }


    

    public function login(Request $request)
    { 
        
        $checkuser=User::where('email',$request->email)->where('email_verified_at','!=', NULL)->first();
        if($checkuser){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['name'] =  $user->name;
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Credentials not matching with our records.']);
        } 
        }else{
            
           return $this->sendError('Unauthorised.', ['error'=>'Email not verified Yet']);
      }
    }
}