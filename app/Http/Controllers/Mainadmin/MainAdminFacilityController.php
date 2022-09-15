<?php

namespace App\Http\Controllers\Mainadmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\admin_assign;
use App\Models\all_sub_activity;
use App\Models\Compnay;
use App\Models\service_rule;
use App\Models\setting_name_location;
use App\Models\setting_name_location_box_two;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainAdminFacilityController extends Controller
{
    public function compnay_facility()
    {
        $all_facility = setting_name_location::orderBy('id', 'desc')->paginate(10);
        $all_facility_names = setting_name_location::orderBy('id', 'desc')->get();
        $all_admins = Admin::select('id', 'first_name', 'last_name')->get();
        return view('mainadmin.CompnayFacility.compnayFacilityList', compact('all_facility', 'all_admins', 'all_facility_names'));
    }

    public function compnay_details_save(Request $request)
    {
        $new_compnay = new Compnay();
        $new_compnay->is_active = $request->com_is_active;
        $new_compnay->company_name = $request->com_name;
        $new_compnay->company_address = $request->com_address;
        $new_compnay->company_city = $request->com_city;
        $new_compnay->company_state = $request->com_state;
        $new_compnay->company_zip = $request->com_zip;
        $new_compnay->company_phone = $request->com_phone;
        $new_compnay->company_email = $request->com_email;
        $new_compnay->company_website = $request->com_website;
        $new_compnay->save();
        return response()->json($new_compnay, 200);


    }


    public function compnay_details_update(Request $request)
    {
        $new_compnay = Compnay::where('id', $request->edit_id)->first();
        if ($new_compnay) {
            $new_compnay->is_active = $request->com_is_active;
            $new_compnay->company_name = $request->com_name;
            $new_compnay->company_address = $request->com_address;
            $new_compnay->company_city = $request->com_city;
            $new_compnay->company_state = $request->com_state;
            $new_compnay->company_zip = $request->com_zip;
            $new_compnay->company_phone = $request->com_phone;
            $new_compnay->company_email = $request->com_email;
            $new_compnay->company_website = $request->com_website;
            $new_compnay->save();
            return response()->json($new_compnay, 200);
        }
    }


    public function compnay_get_all(Request $request)
    {
        $all_com = Compnay::orderBy('company_name', 'asc')->get();
        return response()->json($all_com, 200);
    }


    public function compnay_details_get(Request $request)
    {
        $single_compnay = Compnay::where('id', $request->com_id)->first();
        return response()->json($single_compnay, 200);
    }


    public function facility_save(Request $request)
    {

        $new_admin = new Admin();
//        $new_admin->name = "admin";
        $new_admin->company_id = $request->compnay_id;
        $new_admin->name = $request->first_name . ' ' . $request->last_name;
        $new_admin->first_name = $request->first_name;
        $new_admin->last_name = $request->last_name;
        $new_admin->email = $request->email;
        $new_admin->dob = $request->dob;
        $new_admin->gender = $request->gender;
        $new_admin->phone = $request->phone;
        $new_admin->fax = $request->fax;
        $new_admin->password = Hash::make($request->password);
        $new_admin->is_up_admin = 1;
        $new_admin->up_admin_id = 0;
        $new_admin->save();

//        $data = ['(BCBA)', 'BCaBA (HN Mod)', 'BA/RBT (HM Mod)', 'BCBA (No Mod)', '(BA)', '(BA/BCaBA)'];
//
//        for ($i = 0; $i < count($data); $i++) {
//            all_sub_activity::create([
//                'admin_id' => $new_admin->id,
//                'sub_activity' => $data[$i],
//            ]);
//        }


        $new_facility = new setting_name_location();
        $new_facility->company_id = $request->compnay_id;
        $new_facility->admin_id = $new_admin->id;
        $new_facility->facility_name = $request->facility_name;
        $new_facility->ein = $request->ein;
        $new_facility->email = $request->email;
        $new_facility->service_area_miles = $request->service_area_miles;
        $new_facility->default_pos = $request->default_pos;
        $new_facility->npi = $request->npi;
        $new_facility->state = $request->state;
        $new_facility->taxonomy = $request->taxonomy_code;
//        $new_facility->message = $request->message;
        $new_facility->save();

        $new_facility_two = new setting_name_location_box_two();
        $new_facility_two->admin_id = $new_admin->id;
        $new_facility_two->zone_name = 'Main Zone';
        $new_facility_two->facility_name_two = $request->facility_name;
        $new_facility_two->admin_create = 1;
        $new_facility_two->save();


        return back()->with('success', 'Facility And Admin Account Has been Created');


    }


    public function get_admin_by_facility(Request $request)
    {
        $setting_locations = setting_name_location::where('facility_name', $request->sadminfac)->get();

        $array = [];
        foreach ($setting_locations as $loc) {
            array_push($array, $loc->admin_id);
        }

        $admins = Admin::whereIn('id', $array)->where('is_up_admin', 1)->get();

        return response()->json($admins, 200);
    }


    public function create_sub_admin(Request $request)
    {

        if (strlen($request->sub_password) < 8) {
            return back()->with('alert', 'Password must be at least 8 characters');
            exit();
        }


        $up_admin = Admin::where('id', $request->up_admin_id)->first();

        if ($up_admin) {
            $new_admin = new Admin();
            $new_admin->name = $request->sub_first_name . ' ' . $request->sub_last_name;
            $new_admin->first_name = $request->sub_first_name;
            $new_admin->last_name = $request->sub_last_name;
            $new_admin->email = $request->sub_email;
            $new_admin->password = Hash::make($request->sub_password);
            $new_admin->is_up_admin = 2;
            $new_admin->up_admin_id = $up_admin->id;
            $new_admin->company_id = isset($up_admin->company_id) ? $up_admin->company_id : 0;
            $new_admin->save();


            $assign_admin = new admin_assign();
            $assign_admin->admin_id = $up_admin->id;
            $assign_admin->sub_admin_id = $new_admin->id;
            $assign_admin->save();

            return back()->with('success', 'Sub-Admin Successfully Created');
        } else {
            return back()->with('alert', 'Admin Not Found');
        }

    }


}
