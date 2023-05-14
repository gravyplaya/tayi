<?php

namespace App\Http\Controllers\Userweb;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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

    function edit_profile(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();
        if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 

        return view('userweb.edit_profile', compact('user','url_aws'));
    }

    function update_profile(Request $request)
    {

        $password = $request->password;
	
        $id = auth()->user()->id;
        $name = $request->name;
        $image = $request->image;

        $newproject = User::FindorFail($id);
        $newproject->name = $name;
        if ($password != NULL) {
            $newproject->password = Hash::make($password);
        }
        if ($image != NULL) {
            $newproject->image = Helpers::upload('user/', 'png', $request->file('image'));
        }
        $newproject->updated_at = now();
        $newproject->save();

        if ($newproject) {
            return redirect()->back()->withSuccess('User data Updated');
        } else {
            return redirect()->back()->withErrors('Something Went Wrong Try Again Later');
        }

    }

    public function user_transaction(Request $request)
    {
        $user = Transaction::with('user', 'sub_membershipp')->orderBy('id', 'desc')->where('user_id', auth()->user()->id)->paginate(15);
        return view('userweb.user_transaction', compact('user'));
    }

    public function user_history(Request $request)
    {
        $user = History::with('user')->orderBy('id', 'desc')->where('user_id', auth()->user()->id)->paginate(15);
        return view('userweb.user_history', compact('user'));
    }


}
