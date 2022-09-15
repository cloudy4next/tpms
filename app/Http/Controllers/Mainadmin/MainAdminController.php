<?php

namespace App\Http\Controllers\Mainadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainAdminController extends Controller
{
    public function index()
    {
        return view('mainadmin.index');
    }
}
