<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:client', ['except' => ['logout']]);
    }


    public function showLoginform()
    {
        return view('auth.login');
    }


    //this is login function for admin which is given email and password to get data form database
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:8'
        ]);
        if (Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('provider.dashboard'));
        }

        return redirect()->back();

    }


    //this funsion for admin logout which i customized to cpy form loginController
    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect(route('user.login'));
    }
}
