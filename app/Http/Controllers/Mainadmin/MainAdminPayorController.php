<?php

namespace App\Http\Controllers\Mainadmin;

use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\Payor_facility_details;
use Illuminate\Http\Request;

class MainAdminPayorController extends Controller
{
    public function manage_payor()
    {
        return view('mainadmin.payor.managePayor');
    }


    public function manage_payor_save(Request $request)
    {
        $new_payor_fac = new Payor_facility_details();
        $new_payor_fac->name = $request->name;
        $new_payor_fac->address = $request->address;
        $new_payor_fac->city = $request->city;
        $new_payor_fac->state = $request->state;
        $new_payor_fac->zip = $request->zip;
        $new_payor_fac->payor_id = $request->payor_id;
        $new_payor_fac->save();

        $new_all_payor = new All_payor();
        $new_all_payor->facility_payor_id = $new_payor_fac->id;
        $new_all_payor->payor_name = $new_payor_fac->name;
        $new_all_payor->save();

        return back()->with('success', 'Payor Successully Created');

    }
}
