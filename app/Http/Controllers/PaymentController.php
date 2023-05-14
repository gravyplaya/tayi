<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\SubMembership;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Stripe;

class PaymentController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function makePayment(Request $request)
    {


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
                        'name' => $request->plan_type . " membership",
                        'images' => null,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/') . "/payment_successfull?mem_id=" . $request->mem_id,
            'cancel_url' => url('/') . "/payment_failed?mem_id=" . $request->mem_id,
        ]);


        // Store a piece of data in the session...
        session(['amount' => $request->amount]);

        session(['transaction_id' => $checkout_session->payment_intent]);


        header('Location: ' . $checkout_session->url);
        exit;


    }





    

    public function success(Request $request)
    {

        $me = SubMembership::with('mem')->where("id", $request->mem_id)->first();
        $check = Transaction::where('transaction_id', session('transaction_id'))->first();
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
        $updateUser->plan_id = $request->mem_id;
        $updateUser->projects_limit = 0;
        $updateUser->tokens = $user->tokens + $plan_tokens;
        $updateUser->save();


        $payment = new Transaction();
        $payment->amount = session('amount');
        $payment->mem_id = $request->mem_id;
        $payment->user_id = auth()->user()->id;
        $payment->date_of_transaction = date('Y-m-d');
        $payment->status = "success";
        $payment->medium = "stripe";
        $payment->transaction_id = session('transaction_id');
        $payment->created_at = now();
        $payment->save();

        return view('userweb.payment_success', compact('me'));
    }

    public function failed(Request $request)
    {
        $me = SubMembership::with('mem')->where("id", $request->mem_id)->first();
        $payment = new Transaction();
        $payment->amount = session('amount');
        $payment->mem_id = $request->mem_id;
        $payment->user_id = auth()->user()->id;
        $payment->date_of_transaction = date('Y-m-d');
        $payment->status = "failed";
        $payment->medium = "stripe";
        $payment->transaction_id = session('transaction_id');
        $payment->created_at = now();
        $payment->save();
        return view('userweb.payment_failed', compact('me'));
    }


}
