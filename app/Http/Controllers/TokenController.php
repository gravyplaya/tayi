<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\SubMembership;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\Request;
use Session;
use Stripe;

class TokenController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function makePayment(Request $request)
    {
       
        $plan_id = $request->plan_id;
        $getplan_det=Plan::where('id',$plan_id)->first();
        $stripe = \App\Models\PaymentGateway::where('id', 2)->first();

        Stripe\Stripe::setApiKey($stripe->secret);
         
        $stripe = array(
            "secret_key" => $stripe->secret,
            "publishable_key" => $stripe->api_key
        );


        $currency = Setting::where('name', 'currency_name')->first();
        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $currency->value,
                    'unit_amount' => $request->amount * 100,
                    'product_data' => [
                        'name' => $getplan_det->tokens . " Words Top-up",
                        'images' => null,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/') . "/token_payment_successfull?mem_id=" . $request->plan_id,
            'cancel_url' => url('/') . "/token_payment_failed?mem_id=" . $request->plan_id,
        ]);


        // Store a piece of data in the session...
        session(['amount' => $request->amount]);

        session(['transaction_id' => $checkout_session->payment_intent]);


        header('Location: ' . $checkout_session->url);
        exit;


    }





    

    public function token_payment_successfull(Request $request)
    {

        $user_id = auth()->user()->id;
        $plan_id = $request->mem_id;
        $amount = $request->amount;

        $getplan_det=Plan::where('id',$plan_id)->first();
        $tokens = $getplan_det->tokens;
        $transaction_id = session('transaction_id');
        $me=$getplan_det;
        $check = Transaction::where('transaction_id', $transaction_id)->first();
        if ($check) {
            return view('userweb.token_success', compact('me'));
        }

        $check = Transaction::where('transaction_id', $transaction_id)->first();
        if ($check) {
            return view('userweb.token_success', compact('me'));
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
        $payment->medium = "stripe";
        $payment->type = "token_top_up";
        $payment->transaction_id = $transaction_id;
        $payment->created_at = now();
        $payment->save();

        return view('userweb.token_success', compact('me'));
    }

    public function token_payment_failed(Request $request)
    {
        $plan_id = $request->mem_id;
         $getplan_det=Plan::where('id',$plan_id)->first();
         $me=$getplan_det;
        $tokens = $getplan_det->tokens;
        $payment = new Transaction();
        $payment->amount = $getplan_det->price;
        $payment->mem_id = $request->mem_id;
        $payment->user_id = auth()->user()->id;
        $payment->date_of_transaction = date('Y-m-d');
        $payment->status = "failed";
        $payment->medium = "stripe";
        $payment->type = "token_top_up";
        $payment->transaction_id = session('transaction_id');
        $payment->created_at = now();
        $payment->save();
        return view('userweb.token_failed', compact('me'));
    }


}
