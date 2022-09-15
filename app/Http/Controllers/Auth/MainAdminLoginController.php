<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainAdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:superadmin',['except'=>['main_admin_logout']]);
    }

    public function main_admin_logout()
    {
        Auth::guard('superadmin')->logout();
        return redirect(route('user.login'));
    }
}
