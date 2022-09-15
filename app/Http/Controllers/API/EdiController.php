<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EdiController extends Controller
{
    public function send_edi_data(Request $request)
    {

        return 'done';
        //        $to = "srt7142@gmail.com";
//
//        $msg = [
//            'name' => "ami",
//            'code'=>"12345678"
//        ];
//        Mail::to($to)->send(new ResetPasswordMail($msg));
    }
}
