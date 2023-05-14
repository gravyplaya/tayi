<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Carbon\carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
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

        $category = Category::get();

        if($this->storage_space != "same_server"){
           $url_aws =  rtrim(Storage::disk($this->storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 
        return view('admin.category.list', compact('category','url_aws'));
    }

    public function add(Request $request)
    {

        $category = Category::get();


        return view('admin.category.add', compact('category'));
    }

    function store(Request $request)
    {

        $slug = trim(preg_replace('/[^A-Za-z0-9]/', '-', $request->name));

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->icon = Helpers::upload('category/', 'png', $request->file('image'));
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();

        return redirect()->route('admin.category.list')->withSuccess('Category Added Successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    function update(Request $request, $id)
    {

        $slug = trim(preg_replace('/[^A-Za-z0-9]/', '-', $request->name));

        $category = Category::findOrFail($id);
        $old_image = $category->icon;
        $category->name = $request->name;
        $category->slug = $slug;
        if ($request->image != NULL) {
            $category->icon = Helpers::update('category/', $request->file('image'), 'png', $request->file('image'));
        }
        $category->updated_at = Carbon::now();
        $category->save();


        return redirect()->route('admin.category.list')->withSuccess('Category Updated Successfully');
    }


    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.list')->withSuccess('Category Deleted Successfully');
    }

    public function premium(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->premium = $request->status;
        $category->save();

        return redirect()->route('admin.category.list')->withSuccess('Category premium status updated Successfully');
    }

     public function highlighted(Request $request, $id)
    {
        $counthighlight=Category::where('highlighted',1)->count();
        if($counthighlight >= 4){
          return redirect()->route('admin.category.list')->withErrors('you can add only 4 categorys/tools to highlighted tools');
        }else{
        $category = Category::findOrFail($id);
        $category->highlighted = $request->status;
        $category->save();
        }
        return redirect()->route('admin.category.list')->withSuccess('Category highlighted status updated Successfully');
    }

     public function popular(Request $request, $id)
    {

        $countpopular=Category::where('popular',1)->count();
        if($countpopular >= 8){
          return redirect()->route('admin.category.list')->withErrors('you can add only 8 categorys/tools to popular tools');
        }else{
        $category = Category::findOrFail($id);
        $category->popular = $request->status;
        $category->save();
        }

        return redirect()->route('admin.category.list')->withSuccess('Category popular status updated Successfully');
    }

}
