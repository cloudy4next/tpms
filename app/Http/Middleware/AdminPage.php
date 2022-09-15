<?php

namespace App\Http\Middleware;

use App\Models\admin_page_access;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminPage
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $page_id = '')
    {
        if (Auth::check()) {

            $array = ['Dashboard', 'Appointment', 'Patient(S)', 'Staffs', 'Billing', 'Payments', 'Payroll', 'Report', 'Settings'];
            $dashboard = admin_page_access::where('admin_id', Auth::user()->id)->where('page_id', $page_id)->first();
            if ($dashboard) {
                return $next($request);
            } else {

                if($page_id==1){
                    $dashboard2=admin_page_access::where('admin_id',Auth::user()->id)->where('page_id',10)->first();
                    if($dashboard2){
                        return redirect()->route('superadmin.dashboard2');
                    }
                    else{
                        abort('404');
                    }
                }
                else if($page_id==10){
                    $dashboard3=admin_page_access::where('admin_id',Auth::user()->id)->where('page_id',1)->first();
                    if($dashboard3){
                        return redirect()->route('superadmin.dashboard');
                    }
                    else{
                        abort('404');
                    }
                }
                else{
                    abort('404');
                }
            }
        }
//        return $next($request);
    }
}
