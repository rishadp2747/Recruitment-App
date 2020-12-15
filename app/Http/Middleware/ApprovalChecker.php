<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class ApprovalChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $approval_s = $user->approved;
        if($approval_s==0){
            return redirect('/dashboard/approvalpending');
        }
        elseif($approval_s==2){
            return redirect('/dashboard/rejected');
        }
        else{
          return $next($request);
        }
    }
}
