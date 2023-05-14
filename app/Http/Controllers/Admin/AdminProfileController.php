<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Auth;
use Hash;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
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

    function edit_profile(Request $request)
    {
        $id = auth('admin')->user()->id;
        $user = Admin::where('id', $id)->first();

        if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 

        return view('admin.edit_profile', compact('user','url_aws'));
    }

    function update_profile(Request $request)
    {
       
        $password = $request->password;
        $id = auth('admin')->user()->id;
        $name = $request->name;
        $email = $request->email;
        $image = $request->image;
        
        $newproject = Admin::FindorFail($id);
        $newproject->name = $name;
        $newproject->email = $email;
        if ($password != NULL) {
            $newproject->password = Hash::make($password);
        }
        if ($image != NULL) {
            $newproject->image = Helpers::upload('user/', 'png', $request->file('image'));
        }
        $newproject->updated_at = now();
        $newproject->save();

        if ($newproject) {
            return redirect()->back()->withSuccess('Admin Profile Updated');
        } else {
            return redirect()->back()->withErrors('Something Went Wrong Try Again Later');
        }

    }


}
