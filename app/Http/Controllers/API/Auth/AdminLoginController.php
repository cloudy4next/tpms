<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function admin_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Please Enter Your Email Address',
            'password.required' => 'Please Enter Your Password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ]);
        } else {
            $credentials = request(['email', 'password']);
            if (Auth::guard('admin')->attempt($credentials)) {
                $login_user = Auth::guard('admin')->user();
                $user = Admin::where('id', $login_user->id)->first();
                $success['token'] = $user->createToken('tpmssrtadmin')->accessToken;
                $user_info = Admin::select('id', 'name', 'email')->where('id', $user->id)->first();
                return response()->json([
                    'status' => 'success',
                    'account_type' => 'admin',
                    'message' => 'admin successfully logged in',
                    'access_token' => 'Bearer' . ' ' . $success['token'],
                    'token_type' => 'Bearer',
                    'user' => $user_info
                ]);
            } else {
                return response()->json([
                    'status' => 'unauthorised',
                    'message' => 'This credentials do not match our records',
                ]);
                exit();
            }
        }


    }
}
