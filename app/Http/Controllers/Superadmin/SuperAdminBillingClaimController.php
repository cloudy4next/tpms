<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\setting_name_location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminBillingClaimController extends Controller
{
    protected $admin_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->is_up_admin == 1) {
                $this->admin_id = Auth::user()->id;
            } else {
                $this->admin_id = Auth::user()->up_admin_id;
            }
            return $next($request);
        });
    }

    public function billing_claim_management()
    {
        $name_loca = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        return view('superadmin.claimManagement.ClaimList', compact('name_loca'));
    }
}
