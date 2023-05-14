<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Auth;
use Carbon\carbon;
use DB;
use Illuminate\Http\Request;

class AdminLanguageController extends Controller
{


    public function list(Request $request)
    {

        $lang = Language::get();


        return view('admin.language.list', compact('lang'));
    }

    public function add(Request $request)
    {

        $lang = Language::get();


        return view('admin.language.add', compact('lang'));
    }

    function store(Request $request)
    {


        $category = new Language();
        $category->name = $request->name;
        $category->flag = $request->flag;
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();

        return redirect()->route('admin.language.list')->withSuccess('Language Added Successfully');
    }

    public function edit($id)
    {
        $lang = Language::findOrFail($id);
        return view('admin.language.edit', compact('lang'));
    }

    function update(Request $request, $id)
    {


        $category = Language::findOrFail($id);
        $category->name = $request->name;
        $category->flag = $request->flag;
        $category->updated_at = Carbon::now();
        $category->save();


        return redirect()->route('admin.language.list')->withSuccess('Language Updated Successfully');
    }


    public function delete($id)
    {
        $category = Language::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.language.list')->withSuccess('Language Deleted Successfully');
    }

}
