<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['superadmin_logout']]);
    }

    public function user_login()
    {
        return view('auth.login');
    }

    public function custom_login_submit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect(route('superadmin.dashboard'));
        } else if (Auth::guard('superadmin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect(route('mainadmin.dashboard'));
        } else if (Auth::guard('provider')->attempt(['login_email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect(route('provider.dashboard'));
        } else if (Auth::guard('client')->attempt(['login_email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect(route('client.dashboard'));
        } else {
            return back()->with('login_error', 'Invalid Credentials');
        }

    }

    public function superadmin_logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('user.login'));
    }


}
