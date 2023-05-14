<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\TemplateField;
use App\Models\ChatQuestion;
use Auth;
use Carbon\carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{

    public function __construct()
    {
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
       if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 
        $template = Template::get();


        return view('admin.template.list', compact('template','url_aws'));
    }

    public function add(Request $request)
    {

        $template = Template::get();


        return view('admin.template.add', compact('template'));
    }

    function store(Request $request)
    {

        $slug = trim(preg_replace('/[^A-Za-z0-9]/', '-', $request->name));
       $check_slug=Template::where('slug',$slug)->get();
       if(count($check_slug)>0){
          return redirect()->withErrors('Template Already Added');
       }
        $category = new Template();
        $category->name = $request->name;
        $category->category_id = $request->category;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->icon = Helpers::upload('icon/', 'png', $request->file('image'));
        $category->prompt = $request->prompt;
        $category->tone = $request->tone;
        $category->variant = $request->variant;
		$category->system_message = $request->system_message;
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();


        $moreFields=$request->moreFields;
        $i=1;
        foreach($moreFields as $moreFiel){
            if($moreFiel['title'] != NULL && $moreFiel['description'] != NULL && $moreFiel['type'] != NULL){
            $name="field-".$i;
            $addfield=new TemplateField();
            $addfield->field_name=$moreFiel['title'];
            $addfield->template_id=$category->id;
            $addfield->field_type=$moreFiel['type'];
            $addfield->name=$name;
            $addfield->description=$moreFiel['description'];
            $addfield->created_at=now();
            $addfield->updated_at=now();
            $addfield->save();
            $i++;
           }
        }


      

        return redirect()->route('admin.template.list')->withSuccess('Template Added Successfully');
    }

    public function edit($id)
    {
        $template = Template::with('template_fields')->findOrFail($id);
        return view('admin.template.edit', compact('template'));
    }

    function update(Request $request, $id)
    {

        $slug = trim(preg_replace('/[^A-Za-z0-9]/', '-', $request->name));
        $check_slug=Template::where('slug',$slug)->where('id','!=',$id)->get();
       if(count($check_slug)>0){
          return redirect()->withErrors('Template Already Added');
       }

        $category = Template::findOrFail($id);
        $old_image = $category->icon;
        $category->name = $request->name;
        $category->category_id = $request->category;
        $category->slug = $slug;
	    $category->prompt = $request->prompt;
        $category->tone = $request->tone;
		$category->system_message = $request->system_message;
        $category->variant = $request->variant;
        $category->description = $request->description;

        if ($request->image != NULL) {
            $category->icon = Helpers::update('icon/', $request->file('image'), 'png', $request->file('image'));
        }
         if ($request->chat_image != NULL) {
            $category->chat_icon = Helpers::update('chat_icon/', $request->file('chat_image'), 'png', $request->file('chat_image'));
        }
        $category->updated_at = Carbon::now();
        $category->save();
            
        $check=TemplateField::where('template_id',$id)->delete();
        $moreFields=$request->moreFields;
        $i=1;
        foreach($moreFields as $moreFiel){
            if($moreFiel['title'] != NULL && $moreFiel['description'] != NULL && $moreFiel['type'] != NULL){
            $name="field-".$i;
            $addfield=new TemplateField();
            $addfield->field_name=$moreFiel['title'];
            $addfield->template_id=$category->id;
            $addfield->field_type=$moreFiel['type'];
            $addfield->name=$name;
            $addfield->description=$moreFiel['description'];
            $addfield->created_at=now();
            $addfield->updated_at=now();
            $addfield->save();

            $i++;
           }
        }

        return redirect()->route('admin.template.list')->withSuccess('Template Updated Successfully');
    }


    public function delete($id)
    {
        $category = Template::findOrFail($id);
        $category->delete();
        
        $chat_questions=TemplateField::where('template_id',$id)->delete();
        return redirect()->route('admin.template.list')->withSuccess('Template Deleted Successfully');
    }

    public function premium(Request $request, $id)
    {
        $category = Template::findOrFail($id);
        $category->premium = $request->status;
        $category->save();

        return redirect()->route('admin.template.list')->withSuccess('Template premium status updated Successfully');
    }

     public function highlighted(Request $request, $id)
    {
        $counthighlight=Template::where('highlighted',1)->count();
        if($counthighlight >= 4 && $request->status==1){
          return redirect()->route('admin.template.list')->withErrors('you can add only 4 templates/tools to highlighted tools');
        }else{
        $category = Template::findOrFail($id);
        $category->highlighted = $request->status;
        $category->save();
        }
        return redirect()->route('admin.template.list')->withSuccess('Template highlighted status updated Successfully');
    }

     public function popular(Request $request, $id)
    {

        $countpopular=Template::where('popular',1)->count();
        if($countpopular >= 8  && $request->status==1){
          return redirect()->route('admin.template.list')->withErrors('you can add only 8 templates/tools to popular tools');
        }else{
        $category = Template::findOrFail($id);
        $category->popular = $request->status;
        $category->save();
        }

        return redirect()->route('admin.template.list')->withSuccess('Template popular status updated Successfully');
    }

}
