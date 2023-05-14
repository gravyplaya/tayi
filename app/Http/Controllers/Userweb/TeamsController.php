<?php

namespace App\Http\Controllers\Userweb;

use App\Http\Controllers\Controller;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class TeamsController extends Controller
{
    function index(Request $request)
    {
        
        $teams = User::where('user_id',Auth::user()->id)->get();        
        $tokens = Auth::user()->tokens;
        if($tokens){
            $maxtoken = $tokens - Auth::user()->token_reached;
        }else{
            $maxtoken = 0;
        }    
       return view('userweb.teams.list',compact('maxtoken','teams'));
    }

    public function teamlist(){
        $teams = User::where('user_id',Auth::user()->id)->get();      
        return DataTables::of($teams)
        ->addIndexColumn()       
        ->addColumn('action', function ($row) {
            $btn = '';
            // $btn .= '<a  data-placement="top" title="Edit" href="' . route('team.edit', $row->id) . '" data-id="' . $row->id . '" class="form_status btn btn-success btn-sm btn-active">Edit</a>&nbsp;&nbsp;';
           $btn.='<div class="dropdown">
           <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
           <ul class="dropdown-menu">               
               </li>
               <li><a class="dropdown-item" href="'.route('team.edit',$row->id).'">Edit</a>
               </li>
               <li><a class="dropdown-item" href="'.route('team.delete',$row->id).'">Delete</a>
               </li>
               
           </ul>
       </div>';
            return $btn;
        })
        
        ->rawColumns(['action'])
        ->make(true);

    }

    function create_team(Request $request)
    {     
        $request->validate([           
            'name' => ['required',],
            'email' => ['required','unique:users'],
            'tokens' => ['required'],
        ]);
        $user=User::where('id',auth()->user()->id)->first();
       $countteam_member=User::where('user_id',Auth::user()->id)->count();

       if($user->team_member_limit >  $countteam_member){
        $token_reached = Auth::user()->token_reached + $request->tokens;
            User::where('id',Auth::user()->id)->update(['token_reached' => $token_reached]);    
        $data = User::create([
            'name' =>$request->name,
            'tokens' =>$request->tokens,
            'email' =>$request->email,           
            'password' =>$request->password,           
            'user_id' =>Auth::user()->id,           
            'plan_id' =>Auth::user()->plan_id,           
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
    function edit(Request $request)
    { 
        $tokens = Auth::user()->tokens;
        if($tokens){
            $maxtoken = $tokens - Auth::user()->token_reached;
        }else{
            $maxtoken = 0;
        }   
        $id = $request->id;
        $teams = User::where('id',$id)->first();      
       return view('userweb.teams.edit',compact('teams','maxtoken'));
      
    }
    function update(Request $request)
    {        
        $teams = User::find($request->id);
        $token= $request->tokens - $teams->tokens;
        $updatetoken = Auth::user()->token_reached + $token;
            User::where('id',Auth::user()->id)->update(['token_reached' => $updatetoken]);
        $teams->update([
            'name' =>$request->name,
            'tokens' =>$request->tokens,
            'email' =>$request->email, 
            'user_id' =>Auth::user()->id,
        ]);
        if($teams){            
        return redirect()->route('team')->with('success', __('Team Updated successfully!'));
        }else{            
        return redirect()->back()->with('error', __('Something Went wrong!'));
        }
    }

    function delete($id){
        $delete = User::where('id',$id)->delete();
        if($delete){            
            return redirect()->route('team')->with('success', __('Team Deleted successfully!'));
            }else{            
            return redirect()->back()->with('error', __('Something Went wrong!'));
            }
    } 

}
