<?php

namespace App\Http\Controllers\Userweb;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\Project;
use App\Models\SubMembership;
use App\Models\Template;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Storage;
use DB;

class TemsController extends Controller
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
    function templates()
    {


        $templates = Template::get();

        return view('userweb.templates', compact('templates'));
    }


    

    function all_folderss()
    {
        $user = User::select('id')->where('user_id',auth()->user()->id)->get();
        $id[]= auth()->user()->id;
        foreach($user as $usr){
            $id[] = $usr->id;
        }
        $folders = Folder::whereIn('user_id', $id)->get();
        return view('userweb.allfolder', compact('folders'));
   }


    function save_project(Request $request)
    {

        $get_user_details = User::where('id', auth()->user()->id)->first();
        $get_user_plan_details = SubMembership::with('mem')->where('id', $get_user_details->plan_id)->first();
        $project = Project::where('user_id', auth()->user()->id)->get();
        if ($get_user_plan_details->mem->project_limit != 0) {
            if (count($project) >= $get_user_plan_details->mem->project_limit) {
                return View::make("userweb.forms.limitreached")
                    ->with("html", $get_user_plan_details)
                    ->render();
            }
        }
        $project_text = $request->template;

        $tem_id = $request->tem_id;

        $newproject = new Project();
        $newproject->project_id = $request->project_id;
        $newproject->project_text = $project_text;
        $newproject->user_id = auth()->user()->id;
        $newproject->template = $tem_id;
        $newproject->created_at = now();
        $newproject->save();

        if ($newproject) {
            return View::make("userweb.forms.saved")
                ->with("html", $newproject)
                ->render();
        } else {
            return redirect()->back()->withErrors('Something Went Wrong Try Again Later');
        }

    }

    function update_project(Request $request)
    {

        $project_text = $request->template;
        $id = $request->proj_id;
        $tem_id = $request->tem_id;

        $newproject = Project::FindorFail($id);
        $newproject->project_text = $project_text;
        $newproject->updated_at = now();
        $newproject->save();

        if ($newproject) {
            return View::make("userweb.forms.updated")
                ->with("html", $newproject)
                ->render();
        } else {
            return redirect()->back()->withErrors('Something Went Wrong Try Again Later');
        }

    }


    function create_folder(Request $request)
    {

        $get_user_details = User::where('id', auth()->user()->id)->first();
        $get_user_plan_details = SubMembership::with('mem')->where('id', $get_user_details->plan_id)->first();
        $project = Folder::where('user_id', auth()->user()->id)->get();
        if ($get_user_plan_details->mem->folder_limit != 0) {
            if (count($project) >= $get_user_plan_details->mem->folder_limit) {
                return redirect()->back()->withErrors('Folder Limit Reached');
            }
        }

        $name = $request->name;


        $newproject = new Folder();
        $newproject->name = $name;
        $newproject->user_id = auth()->user()->id;
        $newproject->created_at = now();
        $newproject->save();

        if ($newproject) {
            return redirect()->back()->withSuccess('Folder Created');
        } else {
            return redirect()->back()->withErrors('Something Went Wrong Try Again Later');
        }

    }


    function move_project_to_folder(Request $request)
    {
        if (count($request->projects) == 0) {
            return redirect()->back()->withErrors('Select any Project(s)');
        }

        foreach ($request->projects as $pr) {
            $project = Project::FindOrFail($pr);
            $project->folder = $request->folders;
            $project->updated_at = now();
            $project->save();
        }

        if ($project) {
            return redirect()->back()->withSuccess('Moved To Folder Successfully');
        } else {
            return redirect()->back()->withErrors('Something Went Wrong Try Again Later');
        }

    }


    function folder_projects(Request $request)
    {
        $id = $request->folder_id;
        $templates = Project::where('folder', $id)->get();
        if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 

        return view('userweb.folderprojects', compact('templates','url_aws'));
    }


    function ai_section(Request $request, $slug)
    {
        $checkinput=auth()->user()->input_lang;
        $get_details = Template::with('template_fields')->where('slug', $slug)->first();

        if($slug=="ai_images"){
          return view('userweb.forms.aiimages', compact('slug'));
        }
		
		if($slug=="image_editor"){
          return view('userweb.forms.image_editor', compact('slug'));
        }
        return view('userweb.forms.show', compact('get_details', 'slug'));
    }


    function mycontent(Request $request)
    {
        $id = $request->folder_id;
        $templates = Project::where('folder', $id)->get();
         if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 


        return view('userweb.mycontent', compact('templates','url_aws'));
    }

    function myusage(Request $request)
    {
        $id = $request->folder_id;
        $templates = Project::where('folder', $id)->get();

        return view('userweb.usage', compact('templates'));
    }

    function billing(Request $request)
    {
        $id = $request->folder_id;
        $templates = Project::where('folder', $id)->get();

        return view('userweb.billing', compact('templates'));
    }


    function alltools(Request $request)
    {
        $id = $request->folder_id;
        $templates = Project::where('folder', $id)->get();

        return view('userweb.alltools', compact('templates'));
    }

    function all_toolss()
    {

        $folders = Folder::where('user_id', auth()->user()->id)->get();
        return view('userweb.alltools', compact('folders'));
    }

    function article_generator()
    {

        $folders = Folder::where('user_id', auth()->user()->id)->get();
        return view('userweb.article', compact('folders'));
    }

}
