<?php

namespace App\Http\Controllers\Userweb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;

class LanguageController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    function set_language(Request $request)
    {
        $get = DB::table('users')->where('id', auth()->user()->id)->update(['input_lang' => $request->input_lang, 'output_lang' => $request->output_lang]);

        return redirect()->back()->withSuccess("Languages has been set up successfully.");
    }


}
