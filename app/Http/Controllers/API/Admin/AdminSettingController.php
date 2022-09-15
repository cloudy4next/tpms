<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\point_of_service;
use App\Models\setting_name_location;
use App\Models\setting_name_location_box_two;
use App\Models\setting_working_hour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSettingController extends Controller
{
    public function ac_get_setting_name_location()
    {
        $name_location_data = setting_name_location::where('admin_id', Auth::user()->id)->first();
        $name_location_box_data = setting_name_location_box_two::where('admin_id', Auth::user()->id)->get();
        $wornking_hour_check = setting_working_hour::where('admin_id', Auth::user()->id)->first();
        $point_of_ser = point_of_service::where('admin_id', Auth::user()->id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'admin setting name location get',
            'box_no_33' => $name_location_data,
            'box_no_32' => $name_location_box_data,
            'working_hours' => $wornking_hour_check,
            'pos' => $point_of_ser,
        ]);
    }


    public function ac_update_setting_name_location(Request $request)
    {
        $update_name_location = setting_name_location::where('admin_id', Auth::user()->id)->first();

        $update_name_location->facility_name = $request->facility_name;
        $update_name_location->address = $request->address;
        $update_name_location->address_two = $request->address_two;
        $update_name_location->city = $request->city;
        $update_name_location->state = $request->state;
        $update_name_location->zip = $request->zip;
        $update_name_location->phone_one = $request->phone_one;
        $update_name_location->short_code = $request->short_code;
        $update_name_location->email = $request->email;
        $update_name_location->ein = $request->ein;
        $update_name_location->npi = $request->npi;
        $update_name_location->taxonomy = $request->taxonomy;
        $update_name_location->contact_person = $request->contact_person;
        $update_name_location->service_area_miles = $request->service_area_miles;
        $update_name_location->default_pos = $request->default_pos;
        $update_name_location->ftp_username = $request->ftp_username;
        $update_name_location->ftp_password = $request->ftp_password;
        $update_name_location->is_combo = $request->is_combo;
        $update_name_location->email_reminder = $request->email_reminder;
        $update_name_location->timezone = $request->default_tz;
        $update_name_location->save();

        $wornking_hour = setting_working_hour::where('admin_id', Auth::user()->id)->first();

        $wornking_hour->mon_start_time = Carbon::parse($request->mon_start);
        $wornking_hour->mon_end_time = Carbon::parse($request->mon_end);
        $wornking_hour->tus_start = Carbon::parse($request->tues_start);
        $wornking_hour->tus_end = Carbon::parse($request->tues_end);
        $wornking_hour->wed_start = Carbon::parse($request->wed_start);
        $wornking_hour->wed_end = Carbon::parse($request->wed_end);
        $wornking_hour->thur_start = Carbon::parse($request->thur_start);
        $wornking_hour->thur_end = Carbon::parse($request->thur_end);
        $wornking_hour->fri_start = Carbon::parse($request->fri_start);
        $wornking_hour->fri_end = Carbon::parse($request->fri_end);
        $wornking_hour->sat_start = Carbon::parse($request->sat_start);
        $wornking_hour->sat_end = Carbon::parse($request->sat_end);
        $wornking_hour->sun_start = Carbon::parse($request->sun_start);
        $wornking_hour->sun_end = Carbon::parse($request->sun_end);
        $wornking_hour->save();

        return response()->json([
            'status' => 'success',
            'message' => 'admin setting name location updated',
        ]);

    }

}
