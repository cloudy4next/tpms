<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Cache;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {
            $expiresAt = now()->addSeconds(20);
            if(isset(Auth::user()->client_first_name)){
                $mail = Auth::user()->login_email;
            }
            else if(isset(Auth::user()->employee_type)){
                $mail = Auth::user()->login_email;
            }else{
                $mail = Auth::user()->email;
            }

            Cache::put('online-' . Auth::user()->id . '-' . $mail, true, $expiresAt);

            /*User::where('id', Auth::user()->id)->update(['last_seen' => now()]);*/
        }

        return $next($request);
    }
}
