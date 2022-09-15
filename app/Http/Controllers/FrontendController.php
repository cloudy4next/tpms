<?php

namespace App\Http\Controllers;

use App\Mail\AfterResetPassword;
use App\Mail\ResetPasswordMail;
use App\Models\Admin;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class FrontendController extends Controller
{
    public function create_admin()
    {
        $admin = new Admin();
        $admin->name = "Admin";
        $admin->email = "admin@admin.com";
        $admin->password = Hash::make('12345678');
        $admin->save();
        return 'Admin created';
    }


    public function forgot_password()
    {
        return view('auth.forgotPassword');
    }

    public function forgot_password_email_submit(Request $request)
    {

        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];
        $result = "Unknown";
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        $ip_data = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

        if ($ip_data && $ip_data->geoplugin_countryName != null) {
            $result = array('ip' => $ip,
                'continentCode' => $ip_data->geoplugin_continentCode,
                'countryCode' => $ip_data->geoplugin_countryCode,
                'countryName' => $ip_data->geoplugin_countryName,
            );
        }

        $user = Admin::where('email', $request->email)->first();
        $provider = Employee::where('office_email', $request->email)->first();
        if ($user) {
            $code = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
            $user->ver_code = $code;
            $user->ver_code_url = Str::random(5) . uniqid() . rand(0, 9) . rand(0, 9) . rand(0, 9) . Str::random(5);
            $user->save();
            $to = $user->email;
            $msg = [
                'name' => $user->name,
                'code' => $code,
                'is_admin' => 1,
                'date' => Carbon::now()->format('m-d-Y'),
                'country_name' => $result != "Unknown" ? $result['countryName'] : "Unknown",
                'state' => $result != "Unknown" ? $result['countryCode'] : "Unknown",
                'ip' => $result != "Unknown" ? $result['ip'] : "Unknown"
            ];
            Mail::to($to)->send(new ResetPasswordMail($msg));


            return redirect(route('user.forgot.password.enter.code'));
        } elseif ($provider) {
            $code = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
            $provider->ver_code = $code;
            $provider->ver_code_url = Str::random(5) . uniqid() . rand(0, 9) . rand(0, 9) . rand(0, 9) . Str::random(5);
            $provider->save();
            $to = $provider->office_email;
            $msg = [
                'name' => $provider->full_name,
                'code' => $code,
                'is_admin' => 2,
                'date' => Carbon::now()->format('m-d-Y'),
                'country_name' => $result != "Unknown" ? $result['countryName'] : "Unknown",
                'state' => $result != "Unknown" ? $result['countryCode'] : "Unknown",
                'ip' => $result != "Unknown" ? $result['ip'] : "Unknown"
            ];
            Mail::to($to)->send(new ResetPasswordMail($msg));


            return redirect(route('user.forgot.password.enter.code'));
        } else {
            return back()->with('error_alert', 'Invalid ID');
        }
    }


    public function forgot_password_enter_code()
    {
        return view('auth.forgotPasswordCodeCheck');
    }

    public function forgot_password_code_submit(Request $request)
    {
        $user = Admin::where('ver_code', $request->code)->first();
        $provider = Employee::where('ver_code', $request->code)->first();
        if ($user) {
            $user->ver_code = null;
            $user->save();

            return redirect(route('user.forgot.password.change.password', $user->ver_code_url));
        } elseif ($provider) {
            $provider->ver_code = null;
            $provider->save();
            return redirect(route('user.forgot.password.change.password', $provider->ver_code_url));
        } else {
            return back()->with('error_alert', 'Invalid Verification Code');
        }
    }

    public function forgot_password_change_password($url)
    {
        $id = $url;
        return view('auth.forgotPasswordChangePassword', compact('id'));
    }


    public function forgot_password_change_password_submit(Request $request)
    {
        $this->validate($request, [
            'new_password' => 'required|min:8',
            'confirm_assword' => 'required|min:8',
        ], [
            'new_password.required' => 'Please enter new password',
            'confirm_assword.required' => 'Please enter confirm password',
        ]);


        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];
        $result = "Unknown";
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        $ip_data = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

        if ($ip_data && $ip_data->geoplugin_countryName != null) {
            $result = array('ip' => $ip,
                'continentCode' => $ip_data->geoplugin_continentCode,
                'countryCode' => $ip_data->geoplugin_countryCode,
                'countryName' => $ip_data->geoplugin_countryName,
            );
        }


        $user = Admin::where('ver_code_url', $request->id)->first();
        $provider = Employee::where('ver_code_url', $request->id)->first();
        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->ver_code_url = null;
            $user->save();


            $to = $user->email;
            $msg = [
                'name' => $user->name,
                'is_admin' => 1,
                'date' => Carbon::now()->format('m-d-Y'),
                'country_name' => $result != "Unknown" ? $result['countryName'] : "Unknown",
                'state' => $result != "Unknown" ? $result['countryCode'] : "Unknown",
                'ip' => $result != "Unknown" ? $result['ip'] : "Unknown"
            ];
            Mail::to($to)->send(new AfterResetPassword($msg));

            return redirect(route('user.login'))->with('change_pass_success', 'Password Successfully Changed');
        } elseif ($provider) {
            $provider->password = Hash::make($request->new_password);
            $provider->ver_code_url = null;
            $provider->save();


            $to = $provider->office_email;
            $msg = [
                'name' => $provider->full_name,
                'is_admin' => 2,
                'date' => Carbon::now()->format('m-d-Y'),
                'country_name' => $result != "Unknown" ? $result['countryName'] : "Unknown",
                'state' => $result != "Unknown" ? $result['countryCode'] : "Unknown",
                'ip' => $result != "Unknown" ? $result['ip'] : "Unknown"
            ];
            Mail::to($to)->send(new AfterResetPassword($msg));


            return redirect(route('user.login'))->with('change_pass_success', 'Password Successfully Changed');
        } else {
            return redirect(route('user.login'))->with('change_pass_success', 'Password Successfully Changed');
        }
    }


    public function demo_route()
    {
        $to = "srt7142@gmail.com";
        $msg = [
            'name' => "ami",
            'code' => "12345678"
        ];
        Mail::to($to)->send(new ResetPasswordMail($msg));
    }


    public function send_sms()
    {

        $recipients = '+1909​406​9004';
        $message = "This is XXX reminding you of an appointment on 03-17-2022 @ 9:00 am to 9:30 am. Please keep in mind, as per our cancellation policy, any appointment cancelled with less than 24 hours notice will incur a cancellation fee. We look forward to seeing you. DO NOT REPLY. Please call the office with any schedule changes";
        
        $account_sid = "AC0a9a543cdadda6821ae5158e310fb234";
        $auth_token = "2d6853e0f6c256eade0f479b216722e2";
        $twilio_number = "(888)380-0789";
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $recipients,
            ['from' => $twilio_number, 'body' => $message]
        );

        return 'done';
    }


    public function send_voice_mail()
    {
        $sid = "AC0a9a543cdadda6821ae5158e310fb234";
        $token = "2d6853e0f6c256eade0f479b216722e2";
        $twilio = new Client($sid, $token);
        $twilio_number = "(888)380-0789";
//        $twilio_number = "+18883800789";

        $peter_number = "+19094069004";
        $my_number = "+8801723516545";

        $call = $twilio->calls
            ->create("+19094069004", // to
                $twilio_number, // from
                ["url" => "http://demo.twilio.com/docs/voice.xml"]
            );


        return 'done';


    }


    public function privacy_policy()
    {
        return view('frontend.privacyPolicy');
    }


}
