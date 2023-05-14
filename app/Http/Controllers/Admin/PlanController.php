<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Auth;
use Carbon\carbon;
use DB;
use Illuminate\Http\Request;

class PlanController extends Controller
{


    public function list(Request $request)
    {

        $plan = Plan::get();


        return view('admin.plan.list', compact('plan'));
    }

    public function add(Request $request)
    {

        $plan = Plan::get();


        return view('admin.plan.add', compact('plan'));
    }

    function store(Request $request)
    {


        $category = new Plan();
        $category->tokens = $request->tokens;
        $category->price = $request->price;
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();

        return redirect()->route('admin.plan.list')->withSuccess('Plan Added Successfully');
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('admin.plan.edit', compact('plan'));
    }

    function update(Request $request, $id)
    {

        $category = Plan::findOrFail($id);
        $category->tokens = $request->tokens;
        $category->price = $request->price;
        $category->updated_at = Carbon::now();
        $category->save();


        return redirect()->route('admin.plan.list')->withSuccess('Plan Updated Successfully');
    }


    public function delete($id)
    {
        $category = Plan::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.plan.list')->withSuccess('Plan Deleted Successfully');
    }

}
