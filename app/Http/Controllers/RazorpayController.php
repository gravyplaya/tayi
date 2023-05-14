<?php

namespace App\Http\Controllers;

use App\Models\SubMembership;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\Request;
use Redirect;
use Response;

class RazorpayController extends Controller
{


    public function razorPaySuccess(Request $request)
    {

        $user_id = $request->user_id;
        $plan_id = $request->plan_id;
        $amount = $request->amount;
        $tokens = $request->tokens;
        $transaction_id = $request->payment_id;

        $me = SubMembership::with('mem')->where("id", $plan_id)->first();
        $check = Transaction::where('transaction_id', $transaction_id)->first();
        if ($check) {
            return view('userweb.payment_success', compact('me'));
        }

        $check = Transaction::where('transaction_id', $transaction_id)->first();
        if ($check) {
            return view('userweb.payment_success', compact('me'));
        }

        $total_price = $me->mem->price * $me->months;
        $discount = ($total_price * $me->discount) / 100;
        $finalamount = $total_price - $discount;
        $monthly = $finalamount / $me->months;
        $plan_tokens = $me->mem->tokens * $me->months;
        $speech_minutes=$me->mem->speech_minutes * $me->months;
        $user = User::where('id', auth()->user()->id)->first();
        $updateUser = User::findOrFail(auth()->user()->id);
        $updateUser->tokens = $user->tokens + $plan_tokens;
        if ($user->plan_end != NULL) {
            $date = date('Y-m-d', strtotime('+' . $me->months . ' month', strtotime($user->plan_end)));
            $updateUser->plan_end = $date;
        } else {
            $date = date('Y-m-d', strtotime('+' . $me->months . ' month'));
            $updateUser->plan_start = date('Y-m-d');
            $updateUser->plan_end = $date;

        }
        $updateUser->speech_minutes =$user->speech_minutes + $speech_minutes;
        $updateUser->folders_limit = 0;
        $updateUser->projects_limit = 0;
        $updateUser->plan_id = $plan_id;
        $updateUser->tokens = $user->tokens + $plan_tokens;
        $updateUser->save();


        $payment = new Transaction();
        $payment->amount = $amount;
        $payment->user_id = auth()->user()->id;
        $payment->mem_id = $plan_id;
        $payment->date_of_transaction = date('Y-m-d');
        $payment->status = "success";
        $payment->medium = "razorpay";
        $payment->transaction_id = $transaction_id;
        $payment->created_at = now();
        $payment->save();

        return view('userweb.payment_success', compact('me'));
    }

    public function success()
    {

        return view('payment_success');
    }

    public function failed()
    {
        return view('payment_failed');
    }





    public function razorPaySuccessTokens(Request $request)
    {

        $user_id = auth()->user()->id;
        $plan_id = $request->plan_id;
        $amount = $request->amount;
        $getplan_det=Plan::where('id',$plan_id)->first();
        $tokens = $getplan_det->tokens;
        $transaction_id = $request->payment_id;
        $me=$getplan_det;
        $check = Transaction::where('transaction_id', $transaction_id)->first();
        if ($check) {
            return view('userweb.payment_success', compact('me'));
        }

        $check = Transaction::where('transaction_id', $transaction_id)->first();
        if ($check) {
            return view('userweb.payment_success', compact('me'));
        }

        
        $user = User::where('id', auth()->user()->id)->first();
        $updateUser = User::findOrFail(auth()->user()->id);
        $updateUser->tokens = $user->tokens + $tokens;
        $updateUser->save();


        $payment = new Transaction();
        $payment->amount = $amount;
        $payment->user_id = auth()->user()->id;
        $payment->mem_id = $plan_id;
        $payment->date_of_transaction = date('Y-m-d');
        $payment->status = "success";
        $payment->medium = "razorpay";
        $payment->type = "token_top_up";
        $payment->transaction_id = $transaction_id;
        $payment->created_at = now();
        $payment->save();

        return view('userweb.token_success', compact('me'));
    }




}
