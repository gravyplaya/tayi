<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\SubMembership;
use App\Models\User;
use Auth;
use Carbon\carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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

    public function list(Request $request)
    {

        $user = User::get();

         if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 
        return view('admin.user.list', compact('user','url_aws'));
    }

    public function add(Request $request)
    {

        $user = User::get();


        return view('admin.user.add', compact('user'));
    }

    function store(Request $request)
    {

        $category = new User();
        $category->name = $request->name;
        $category->email = $request->email;
		$category->email_verified_at = Carbon::now();
        $category->password = $request->password;
        $category->image = Helpers::upload('user/', 'png', $request->file('image'));
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();
		
		
		 $me = SubMembership::with('mem')->where("id", 5)->first();


                $total_price = 0;
                $plan_tokens = $me->mem->tokens;


                $user = User::where('id', $category->id)->first();
                $updateUser = User::findOrFail($category->id);
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


        return redirect()->route('admin.user.list')->withSuccess('User Added Successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    function update(Request $request, $id)
    {

        $category = User::findOrFail($id);
        $old_image = $category->image;
        $category->name = $request->name;
        $category->email = $request->email;
		
        $category->image = Helpers::update('user/', $old_image, 'png', $request->file('image'));
        if ($request->password != NULL) {
            $category->password = $request->password;
        }
        $category->updated_at = Carbon::now();
        $category->save();


        return redirect()->route('admin.user.list')->withSuccess('User Updated Successfully');
    }


    public function delete($id)
    {
        $category = User::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.user.list')->withSuccess('User Deleted Successfully');
    }

    public function docs(Request $request)
    {
        if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 
        $user = Project::with('user', 'related_folder')->orderBy('id', 'desc')->paginate(15);
        return view('admin.user.docs', compact('user','url_aws'));
    }


    public function history(Request $request)
    {
        if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 
        $user = History::with('user')->orderBy('id', 'desc')->paginate(15);
        return view('admin.user.history', compact('user','url_aws'));
    }

    public function transaction(Request $request)
    {
        $user = Transaction::with('user', 'sub_membershipp')->orderBy('id', 'desc')->paginate(15);
        return view('admin.user.transaction', compact('user'));
    }


}
