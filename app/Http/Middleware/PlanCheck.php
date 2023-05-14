<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PlanCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    { 
        $checkuser=\App\Models\User::where('id',auth()->user()->id)->first();
        if($checkuser->user_id != NULL){
        $mainuser=\App\Models\User::where('id',$checkuser->user_id)->first();
          if($mainuser->plan_id == 5)
            
                return redirect()->route('user_plan_expired');
            
        }

        return $next($request);
    }
}
