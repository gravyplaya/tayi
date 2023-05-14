<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class UserTeamsController extends Controller
{    
    function index($id)
    {
        $user = User::where('id',$id)->first();
        $tokens = $user->tokens;
        if($tokens){
            $maxtoken = $tokens - $user->token_reached;
        }else{
            $maxtoken = 0;
        }    
        
       
       return view('admin.user_teams.list',compact('id','maxtoken'));
    }

    public function teamlist($id){
        $teams = User::where('user_id',$id)->get();
        return DataTables::of($teams)
        ->addIndexColumn()       
        ->addColumn('action', function ($row) {
            $btn = '';
            // $btn .= '<a  data-placement="top" title="Edit" href="' . route('team.edit', $row->id) . '" data-id="' . $row->id . '" class="form_status btn btn-success btn-sm btn-active">Edit</a>&nbsp;&nbsp;';
           $btn.='<div class="dropdown">
           <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
           <ul class="dropdown-menu">               
               </li>
               <li><a class="dropdown-item" href="'.route('admin.user_team_edit',$row->id).'">Edit</a>
               </li>
               <li><a class="dropdown-item" href="'.route('admin.user_team_delete',$row->id).'">Delete</a>
               </li>
               
           </ul>
       </div>';
            return $btn;
        })
        
        ->rawColumns(['action'])
        ->make(true);

    }

    function create(Request $request,$id)
    {     
        $request->validate([           
            'name' => ['required',],
            'email' => ['required','unique:users'],
            'tokens' => ['required'],
        ]);
        $user = User::where('id',$id)->first();
       $countteam_member=User::where('user_id',$user->id)->count();

       if($user->team_member_limit >  $countteam_member){
        $token_reached = $user->token_reached + $request->tokens;
            User::where('id',$id)->update(['token_reached' => $token_reached]);    
        $data = User::create([
            'name' =>$request->name,
            'tokens' =>$request->tokens,
            'email' =>$request->email,           
            'password' =>$request->password,           
            'user_id' =>$id,
            'plan_id' =>$user->plan_id,
        ]);

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $data->id,
            'token' => $token
        ]);
        Mail::send('userweb.email.emailVerificationEmail', ['token' => $token,'request' => $request], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
        }else{
          return redirect()->back()->withErrors('Team Member Limit Reached!');
       }
        return redirect()->back()->with('success', __('Team registered successfully!'));
    }
    function edit(Request $request,$id)
    { 
        $teams = User::where('id',$id)->first();
        $user = User::where('id',$teams->user_id)->first();
        $tokens = $user->tokens;
        if($tokens){
            $maxtoken = $tokens - $user->token_reached;
        }else{
            $maxtoken = 0;
        }        
       return view('admin.user_teams.edit',compact('teams','maxtoken'));
      
    }
    function update(Request $request,$id)
    {        
        $teams = User::find($id);
        $user = User::where('id',$teams->user_id)->first();
        $token= $request->maxtoken + $request->oldtoken;
        $updatetoken =  $token - $request->tokens;
        User::where('id',$id)->update(['token_reached' => $updatetoken]); 
        $teams->update([
            'name' =>$request->name,
            'tokens' =>$request->tokens,
            'email' =>$request->email, 
            'user_id' =>$user->id,
        ]);
        if($teams){            
        return redirect()->route('team')->with('success', __('Team Updated successfully!'));
        }else{            
        return redirect()->back()->with('error', __('Something Went wrong!'));
        }
    }

    function delete($id){
        $delete = User::find($id)->delete();
        if($delete){            
            return redirect()->route('team')->with('success', __('Team Deleted successfully!'));
            }else{            
            return redirect()->back()->with('error', __('Something Went wrong!'));
            }
    } 
}
