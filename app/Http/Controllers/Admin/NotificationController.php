<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\User_Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use DB;

class NotificationController extends Controller
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
    public function index(){
        return view('admin.notification.list');
    }

    public function notification_list(){
        $notification = Notification::get();
        return DataTables::of($notification)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '';
           $btn.='<div class="dropdown">
           <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
           <ul class="dropdown-menu">
               </li>
               <li><a class="dropdown-item" title="Edit" href="'.route('admin.notification_edit',$row->id).'">Edit</a>
               </li>
               <li><a class="dropdown-item" title="Delete" href="'.route('admin.notification_delete',$row->id).'">Delete</a>
               </li>
           </ul>
       </div>';
            return $btn;
        })
        
        ->rawColumns(['action'])
        ->make(true);

    }

    public function create(Request $request){
        $request->validate([
            'title' => ['required',],
            'user_type' => ['required'],
        ]);
        $image = $request->file('noti_image');
        if ($image != NULL) {
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '-' . Str::uuid() . '.' . $extension;
            $path = Storage::disk('public')->putFileAs("noti_image", $image, $filename);
        }
        if($request->user_type == 0){
            $color ="red";
        }else{
            $color = "skyblue";
        }
       $notification = Notification::create([
        'noti_type'        =>  $request->noti_type ,
        'title'            =>  $request->title ,
        'discrtiption'     =>  $request->discrtiption ,
        'user_type'        =>  $request->user_type,
        'icon'             =>  $path,
        'color'             =>  $color,

       ]);
       if($request->user_type == 0){

        $users = User::where('plan_id',5)->get();
       }else{
        $planid =["1","2","3","4"];
        $users = User::whereIn('plan_id',$planid)->get();
       }
       foreach($users as $user){
        $id = $user->id;
        User_Notification::create([
            'user_id'=>$id,
            'noti_id'=> $notification->id,
            'status'=>0,
        ]);
       }
      
        if($notification){
            return redirect()->back()->with('success', __('Create Notification successfully!'));
            }else{
            return redirect()->back()->withErrors('Something Went wrong!');
            }
    }
    public function edit($id){
        $noti = Notification::where('id',$id)->first();
        return view('admin.notification.edit',compact('noti'));
    }
    public function update(Request $request,$id){
        $noti = Notification::where('id',$id)->first();
        $image = $request->file('noti_image');
        if ($image ==!null) {
            if (Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '-' . Str::uuid() . '.' . $extension;
                $path = Storage::disk('public')->putFileAs("noti_image", $image, $filename);
            }
        }else{
            $path = $noti->icon;
        }
        if($request->noti_type == 0){
            $color = "red";
        }else{
            $color = "skyblue";
        }
        $update = Notification::where('id',$id)->update([
            'noti_type'        =>  $request->noti_type ,
            'color'        =>  $color ,
            'title'            =>  $request->title ,
            'discrtiption'     =>  $request->discrtiption ,
            'user_type'        =>  $request->user_type,
            'noti_url'        =>  $request->noti_url,
            'icon'             =>  $path,
        ]);
        if($update){
            return redirect()->route('admin.notification')->with('success', __('Notification Updated successfully!'));
            }else{
            return redirect()->back()->withErrors('Something Went wrong!');
            }
    }
    public function delete($id){
        $delete =  Notification::find($id)->delete();
        if($delete){
            return redirect()->route('admin.notification')->withErrors('Notification Deleted successfully!');
        }else{
            return redirect()->back()->withErrors('Something Went wrong!');
        }
    }

    public function email(){
        return view('admin.notification.email');
    }
    public function send_mail(Request $request){
       
        if($request->user_type == 0){
            $users = User::where('plan_id',5)->get();
        }else{
            $p_id = ["1","2","3","4"];
            $users = User::whereIn('plan_id',$p_id)->get();
        }
        foreach($users as $user){
            $mail=  Mail::send('admin.notification.mail_template', ['request' => $request], function($message) use($request,$user){
                $message->to($user->email);
                $message->subject($request->subject);
            });
        }

        if($mail){
            return redirect()->back()->with('success', __('Mail Send successfully!'));
            }else{
            return redirect()->back()->withErrors('Something Went wrong!');
            }
    }
    
    public function readnotification($id){
       User_Notification::where('user_id',auth()->user()->id)->where('noti_id',$id)->update(['status' => "1"]);
       return redirect()->back();
    }
}


