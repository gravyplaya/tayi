<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\History;
use Auth;
use Carbon\carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MostController extends Controller
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
   

     public function popular(Request $request)
    {

		 if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 
        $populartools=History::with('templates')->select('tools', DB::raw('count(*) as total'))->groupBy('tools')->orderBy('total','desc')->get();
		 
		 return view('admin.reports.mostused', compact('populartools','url_aws'));
        
    }
	
	
	public function liked_disliked_report(Request $request)
    {

	    if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 
        $history=History::with('user','templates')->where('like_dislike','!=',0)->paginate(10);
		 
		 return view('admin.reports.likedislike', compact('history','url_aws'));
        
    }

}
