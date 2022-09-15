<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminAccountActivityController extends Controller
{
    protected $admin_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->is_up_admin==1){
                $this->admin_id=Auth::user()->id;
            }
            else{
                $this->admin_id=Auth::user()->up_admin_id;
            }
            return $next($request);
        });
    }
    
    public function account_activity()
    {
        return view('superadmin.accountActivity.accountActivityList');
    }
}
