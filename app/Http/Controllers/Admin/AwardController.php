<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\CentralLogics\Helpers;
use App\Models\Award;
use App\Models\UserAward;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use DB;

class AwardController extends Controller
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
	
	
 public function index(Request $request){
     if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 
    return view('admin.award.list',compact('url_aws'));
 }
 public function awardlist(){
    $award = Award::get();
    return DataTables::of($award)
    ->addIndexColumn()       
    ->addColumn('action', function ($row) {
        $btn = '';
       $btn.='<div class="dropdown">
       <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
       <ul class="dropdown-menu">               
           </li>
           <li><a class="dropdown-item" href="'.route('admin.award.edit',$row->id).'">Edit</a>
           </li>
           <li><a class="dropdown-item" href="'.route('admin.award.delete',$row->id).'">Delete</a>
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
        'name' => ['required',],
        'icon' => ['required',],
        'tokens' => ['required'],
    ]);
    $image = $request->file('icon'); 

   $award= Award::Create([
    'name' =>       $request->name,
    'icon' =>       Helpers::upload('awards/', 'png', $request->file('icon')),
    'tokens' =>     $request->tokens,
    ]);
    if($award){
        return redirect()->back()->with('success',__('lang.awardcreate'));
    }else{
        return redirect()->back()->with('error',__('lang.somethingwrong'));
    }
 }
 public function edit($id){
    $award = Award::where('id',$id)->first();
    
    return view('admin.award.edit',compact('award'));
 }
 public function update(Request $request,$id){
    
    $award = Award::where('id',$id)->first();
    $request->validate([
        'name' => ['required',],
        'icon' => ['required',],
        'tokens' => ['required'],
    ]);
    $image = $request->file('icon');
//    dd($image);
    if ($image != Null) {
        
        if (Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
        if ($image->isValid()) {
          
            $path =Helpers::upload('awards/', 'png', $request->file('icon'));
        }
    }else{            
        $path = $award->icon;
    }
   $update=$award->Update([
    'name' =>       $request->name,
    'icon' =>       $path,
    'tokens' =>     $request->tokens,
    ]);
    if($update){
        return redirect()->route('admin.award')->with('success',__('lang.awardupdate'));
    }else{
        return redirect()->back()->with('error',__('lang.somethingwrong'));
    }
 }
 public function delete($id){
    $delete = Award::find($id)->delete();
    if($delete){
        return redirect()->back()->with('success',__('lang.awarddelete'));
    }else{
        return redirect()->back()->with('error',__('lang.somethingwrong'));
    }
 }
 public function useraward(Request $request){

    $useraward = UserAward::create([

        'user_id'  => $request->user_id,
        'award_id'  => $request->award_id
    ]);
    if($useraward){
        return redirect()->back();
    }else{
        return redirect()->back();
    }
 }

}
