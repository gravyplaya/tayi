<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use App\Models\Setting;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

   public function __construct(){
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


    public function index(Request $request)
    {
        if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 

        return view('admin.settings.index',compact('url_aws'));
    }

    public function update(Request $request)
    {
        if($request->gpt=="on"){
            $gpt="chatGPT";

        }else{
            $gpt="davinci";
        }
        
		if($request->image_model=="on"){
            $image_model="dall";

        }else{
            $image_model="diffusion";
        }
		
		DB::table('settings')->updateOrInsert(['name' => 'image_model'], [
            'value' => $image_model
        ]);
        DB::table('settings')->updateOrInsert(['name' => 'open_ai_model'], [
            'value' => $gpt
        ]);

        if($gpt == "chatGPT"){
           DB::table('memberships')->update(['model'=>"gpt-3.5-turbo"]);
        }else{
            DB::table('memberships')->where('model',"gpt-3.5-turbo")->update(['model'=>"text-davinci-003"]);
        }

        DB::table('settings')->updateOrInsert(['name' => 'app_name'], [
            'value' => $request['app_name']
        ]);

        DB::table('settings')->updateOrInsert(['name' => 'currency_name'], [
            'value' => $request['currency_name']
        ]);

        DB::table('settings')->updateOrInsert(['name' => 'currency_symbol'], [
            'value' => $request['currency_symbol']
        ]);

        DB::table('settings')->updateOrInsert(['name' => 'words_per_image'], [
            'value' => $request['words_per_image']
        ]);

        $curr_logo = Setting::where(['name' => 'logo'])->first();
        if ($request->has('logo')) {
            $image_name = Helpers::update('admin/', $curr_logo->value, 'png', $request->file('logo'));
        } else {
            $image_name = $curr_logo['value'];
        }

        DB::table('settings')->updateOrInsert(['name' => 'logo'], [
            'value' => $image_name
        ]);

        $fav_icon = Setting::where(['name' => 'favicon'])->first();
        if ($request->has('favicon')) {
            $image_name = Helpers::update('admin/', $fav_icon->value, 'png', $request->file('favicon'));
        } else {
            $image_name = $fav_icon['value'];
        }

        DB::table('settings')->updateOrInsert(['name' => 'favicon'], [
            'value' => $image_name
        ]);


        DB::table('settings')->updateOrInsert(['name' => 'open_ai'], [
            'value' => $request['open_ai']
        ]);
		
		
		 DB::table('settings')->updateOrInsert(['name' => 'deep_ai'], [
            'value' => $request['deep_ai']
        ]);

        DB::table('settings')->updateOrInsert(['name' => 'footer_text1'], [
            'value' => $request['footer_text1']
        ]);

         DB::table('settings')->updateOrInsert(['name' => 'footer_text2'], [
            'value' => $request['footer_text2']
        ]);


        $footer_logo = Setting::where(['name' => 'footer_logo'])->first();
        if ($footer_logo) {
            $image_name = Helpers::update('admin/', $footer_logo->value, 'png', $request->file('footer_logo'));
        } else {
            $image_name = $footer_logo['value'];
        }

        DB::table('settings')->updateOrInsert(['name' => 'footer_logo'], [
            'value' => $image_name
        ]); 

         DB::table('settings')->updateOrInsert(['name' => 'facebook'], [
            'value' => $request['facebook']
        ]);

          DB::table('settings')->updateOrInsert(['name' => 'twitter'], [
            'value' => $request['twitter']
        ]);

        DB::table('settings')->updateOrInsert(['name' => 'google'], [
            'value' => $request['google']
        ]);
       
         DB::table('settings')->updateOrInsert(['name' => 'btncolor'], [
            'value' => $request['btncolor']
        ]);

       $status = $request->imagespace_status;
 
        if($status=="wasabi"){
            $wasabi = 1;
            $aws = 0;
            $ss = 0;
        }elseif($status=="aws"){
            $wasabi = 0;
            $aws = 1;
            $ss = 0;
        }else{
            $wasabi = 0;
            $aws = 0;
            $ss = 1; 
        }
        
        
        $check = DB::table('image_spaces')
               ->first();
       
    
      if($check){
        

        $update = DB::table('image_spaces')
                ->update(['wasabi'=> $wasabi, 'aws'=>$aws, 'same_server'=>$ss]);
    
      }
      else{
          $update = DB::table('image_space')
                ->insert(['wasabi'=> $wasabi, 'aws'=>$aws, 'same_server'=>$ss]);
      }


        return redirect()->back()->withSuccess("Settings Updated Successfully");
    }


    public function payment_index(Request $request)
    {
        return view('admin.settings.payment_gateway');
    }

    public function payment_update(Request $request)
    {
        $razorpay = PaymentGateway::findOrfail(1);
        $razorpay->secret = $request->razorpay_secret;
        $razorpay->api_key = $request->razorpay_api_key;
        $razorpay->active = $request->razorpay_status;
        $razorpay->save();


        $stripe = PaymentGateway::findOrfail(2);
        $stripe->secret = $request->stripe_secret;
        $stripe->api_key = $request->stripe_api_key;
        $stripe->active = $request->stripe_status;
        $stripe->save();

        return redirect()->back()->withSuccess("Payment Gateway Settings Updated Successfully");
    }



   
}
