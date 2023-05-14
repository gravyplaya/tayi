<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\SubMembership;
use Auth;
use Carbon\carbon;
use DB;
use Illuminate\Http\Request;

class MembershipController extends Controller
{


    public function list(Request $request)
    {

        $user = Membership::get();


        return view('admin.membership.list', compact('user'));
    }


    public function edit($id)
    {
        $user = Membership::findOrFail($id);
        return view('admin.membership.edit', compact('user'));
    }

    function update(Request $request, $id)
    {

        $category = Membership::findOrFail($id);
        $category->name = $request->name;
        $category->tokens = $request->tokens;
        if ($request->mrp != NULL) {
        }
        if ($request->price != NULL) {
            $category->price = $request->price;
        }
        $category->model = $request->model_sel;
        $category->speech_minutes = $request->speech_minutes;
        $category->folder_limit = $request->folder_limit;
        $category->project_limit = $request->project_limit;
        $category->team_limit = $request->team_limit??0;
        $category->article = $request->article;
        $category->image = $request->image;
        $category->updated_at = Carbon::now();
        $category->save();


        return redirect()->route('admin.membership.list')->withSuccess('User Updated Successfully');
    }


    public function sublist(Request $request, $id)
    {

        $membership = SubMembership::with('mem')->where('mem_id', $id)->get();


        return view('admin.membership.sub_membership.list', compact('membership'));
    }


    public function subedit($id)
    {
        $membership = SubMembership::findOrFail($id);
        return view('admin.membership.sub_membership.edit', compact('membership', 'id'));
    }


    function subupdate(Request $request, $id)
    {

        if ($request->discount == NULL) {
            $discount = 0;
        } else {
            $discount = $request->discount;
        }


        $membership = SubMembership::with('mem')->where('id', $id)->first();
        $category = SubMembership::findOrFail($id);
        $category->type = $request->name;
        $category->discount = $discount;
        if ($membership->mem_id == 1) {
            $category->days = $request->validity;
        } else {
            $category->months = $request->validity;
        }

        $category->updated_at = Carbon::now();
        $category->save();


        return redirect()->route('admin.membership.details.list', $membership->mem_id)->withSuccess('User Updated Successfully');
    }


}
