<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Mail\ClientAccessEmail;
use App\Mail\MeetMail;

// use App\Mail\sessionLinkInvitation;
use App\Models\custom_form;
use App\Models\All_employee_type;
use App\Models\All_payor;
use App\Models\All_payor_detail;
use App\Models\all_service_rule;
use App\Models\all_sub_activity;
use App\Models\All_treatment;
use App\Models\Appoinment;
use App\Models\Batching_claim;
use App\Models\bussiness_document;
use App\Models\Client;
use App\Models\Client_activity;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Client_info;
use App\Models\Employee;
use App\Models\Employee_type_assign;
use App\Models\general_setting;
use App\Models\holiday_setup;
use App\Models\meet_link;
use App\Models\note_form;
use App\Models\pay_period;
use App\Models\payor_details_tx_type;
use App\Models\Payor_facility;
use App\Models\Payor_facility_details;
use App\Models\point_of_service;
use App\Models\Processing_claim;
use App\Models\Rendering_provider;
use App\Models\service_rule;
use App\Models\setting_cpt_code;
use App\Models\setting_name_location;
use App\Models\setting_name_location_box_two;
use App\Models\setting_service;
use App\Models\setting_working_hour;
use App\Models\SuperAdmin;
use App\Models\template_library;
use App\Models\Treatment_facility;
use App\Models\vendor_number;
use App\Models\zone_setup;
use App\Models\cpt_code_exclusion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;
use Twilio\TwiML\Voice\Pay;

class SuperAdminSettingController extends Controller
{
    protected $admin_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->is_up_admin == 1) {
                $this->admin_id = Auth::user()->id;
            } else {
                $this->admin_id = Auth::user()->up_admin_id;
            }
            return $next($request);
        });
    }

    private function form_avail_save($session_id,$form_id){
        $check = \App\Models\Session_notes_avail::where('admin_id',$this->admin_id)->where('session_id',$session_id)->where('form_id',$form_id)->first();
        if(!$check){
            $save = new \App\Models\Session_notes_avail();
            $save->admin_id = $this->admin_id;
            $save->session_id = $session_id;
            $save->added = 1;
            $save->form_id = $form_id;
            $save->save();
        }
    }

    public function name_location()
    {
        $name_location_data = setting_name_location::where('admin_id', $this->admin_id)->first();
        $point_of_ser = point_of_service::where('admin_id', $this->admin_id)->get();


        if ($name_location_data) {
            $name_location = $name_location_data;
        } else {

            $name_location = new setting_name_location();
            $name_location->admin_id = $this->admin_id;
            $name_location->facility_name = "";
            $name_location->save();
        }

        $name_location_box_data = setting_name_location_box_two::where('admin_id', $this->admin_id)->where('admin_create', 1)->first();
        $name_location_box_data_new = setting_name_location_box_two::where('admin_id', $this->admin_id)->where('admin_create', 0)->get();

        if ($name_location_box_data) {
            $name_location_box_two = $name_location_box_data;
        } else {

            $name_location_box_two = new setting_name_location_box_two();
            $name_location_box_two->admin_id = $this->admin_id;
            $name_location_box_two->facility_name_two = null;
            $name_location_box_two->admin_create = 1;
            $name_location_box_two->save();
        }

        $wornking_hour_check = setting_working_hour::where('admin_id', $this->admin_id)->first();
        if ($wornking_hour_check) {
            $wornking_hour = setting_working_hour::where('admin_id', $this->admin_id)->first();
        } else {
            $wornking_hour = new setting_working_hour();
            $wornking_hour->admin_id = $this->admin_id;
            $wornking_hour->save();
        }


        return view('superadmin.settingFacilitySetup.nameLocation', compact('name_location', 'name_location_box_two', 'name_location_box_data_new', 'wornking_hour', 'point_of_ser'));
    }

    public function name_location_save(Request $request)
    {
        $update_name_location = setting_name_location::where('admin_id', $this->admin_id)->first();

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

        $wornking_hour = setting_working_hour::where('admin_id', $this->admin_id)->first();

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


        Client_activity::create([
            'admin_id' => $this->admin_id,
            'title' => "Setting Facility Setup Updated",
            'message' => " Setting Facility Setup Updated",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);


        return back()->with('success', 'Box No 33 updated');
    }


    public function name_location_box_32_save(Request $request)
    {
        $update_name_location_box_two = setting_name_location_box_two::where('admin_id', $this->admin_id)->where('id', $request->box_32_id)->first();

        $update_name_location_box_two->zone_name = $request->zone_name;
        $update_name_location_box_two->facility_name_two = $request->facility_name_two;
        $update_name_location_box_two->address = $request->address;
        $update_name_location_box_two->city = $request->city;
        $update_name_location_box_two->state = $request->state;
        $update_name_location_box_two->zip = $request->zip;
        $update_name_location_box_two->phone_one = $request->phone_one;
        $update_name_location_box_two->npi = $request->npi;
        $update_name_location_box_two->save();


        $data = $request->all();
        if (isset($data['new_zone_name'])) {
            for ($i = 0; $i < count($data['new_zone_name']); $i++) {
                setting_name_location_box_two::updateOrCreate(['id' => $data['edit_box_id'][$i]], [
                    'admin_id' => $this->admin_id,
                    'zone_name' => isset($data['new_zone_name'][$i]) ? $data['new_zone_name'][$i] : null,
                    'facility_name_two' => isset($data['new_facility_name_two'][$i]) ? $data['new_facility_name_two'][$i] : null,
                    'address' => isset($data['new_address'][$i]) ? $data['new_address'][$i] : null,
                    'city' => isset($data['new_city'][$i]) ? $data['new_city'][$i] : null,
                    'state' => isset($data['new_state'][$i]) ? $data['new_state'][$i] : null,
                    'zip' => isset($data['new_zip'][$i]) ? $data['new_zip'][$i] : null,
                    'phone_one' => isset($data['new_phone_one'][$i]) ? $data['new_phone_one'][$i] : null,
                    'npi' => isset($data['new_npi'][$i]) ? $data['new_npi'][$i] : null,
                    'admin_create' => 0,
                ]);
            }
        }


        return back()->with('success', 'Box No 32 updated');
    }


    public function get_working_hours(Request $request)
    {
        $wornking_hour_check = setting_working_hour::where('admin_id', $this->admin_id)->first();

        if ($wornking_hour_check) {
            $wornking_hour = setting_working_hour::where('admin_id', $this->admin_id)->first();
        } else {
            $wornking_hour = new setting_working_hour();
            $wornking_hour->admin_id = $this->admin_id;
            $wornking_hour->save();
        }


        return response()->json($wornking_hour, 200);

    }


    public function name_location_box_32_exsist_remove(Request $request)
    {
        $client = Client::where('admin_id', $this->admin_id)->where('zone', $request->de_id)->first();

        if ($client) {
            return response()->json('existsbox', 200);
            exit();
        } else {
            $del_32 = setting_name_location_box_two::where('admin_id', $this->admin_id)->where('id', $request->de_id)->first();

            if ($del_32) {
                $del_32->delete();
                return response()->json('done', 200);
            } else {
                return response()->json('error', 200);
                exit();
            }
        }
    }


    public function add_payor()
    {

        //        $facility_payor_details = Payor_facility_details::all();
        //        foreach ($facility_payor_details as $fpdes){
        //            All_payor::create([
        //               'facility_payor_id' =>$fpdes->id,
        //               'payor_name' =>$fpdes->name,
        //            ]);
        //        }
        //
        //        return 'done';


        return view('superadmin.settingFacilitySetup.addPayor');
    }


    public function all_payor_show(Request $request)
    {
        $array = [];
        $payor_fac = Payor_facility::select('admin_id', 'payor_id')->where('admin_id', $this->admin_id)->get();


        foreach ($payor_fac as $p_fac) {
            array_push($array, $p_fac->payor_id);
        }


        $show_all_payor = All_payor::whereNotIn('id', $array)->orderBy('payor_name','asc')->get();
        return response()->json($show_all_payor, 200);
    }


    public function all_payor_faclility_show(Request $request)
    {
        $payor_fac = Payor_facility::select('id', 'payor_id', 'payor_name')->where('admin_id', $this->admin_id)->orderBy('payor_name','asc')->get();

        return response()->json($payor_fac, 200);
    }


    public function add_payor_facility(Request $request)
    {
        $all_p = $request->alp;

        $get_payors = All_payor::whereIn('id', $all_p)->get();

        foreach ($get_payors as $apayor) {
            $sing_payor = All_payor::where('id', $apayor->id)->first();

            $fac_payor_detais = Payor_facility_details::where('id', $apayor->facility_payor_id)->first();

            $new_payor_fac = new Payor_facility();
            $new_payor_fac->admin_id = $this->admin_id;
            $new_payor_fac->payor_id = $sing_payor->id;
            $new_payor_fac->facility_payor_id = $sing_payor->facility_payor_id;
            $new_payor_fac->payor_name = $sing_payor->payor_name;
            $new_payor_fac->address = $fac_payor_detais->address;
            $new_payor_fac->city = $fac_payor_detais->city;
            $new_payor_fac->state = $fac_payor_detais->state;
            $new_payor_fac->zip = $fac_payor_detais->zip;
            $new_payor_fac->contact_one = $fac_payor_detais->contact_one;
            $new_payor_fac->contact_two = $fac_payor_detais->contact_two;
            $new_payor_fac->phone_one = $fac_payor_detais->phone_one;
            $new_payor_fac->phone_two = $fac_payor_detais->phone_two;
            $new_payor_fac->fpayor_id = $fac_payor_detais->payor_id;
            $new_payor_fac->is_regional_center = $fac_payor_detais->is_regional_center;
            $new_payor_fac->regional_center_name = $fac_payor_detais->regional_center_name;
            $new_payor_fac->billing_aber = $fac_payor_detais->billing_aber;
            $new_payor_fac->ele_payor_id = $fac_payor_detais->ele_payor_id;
            $new_payor_fac->create_by = $fac_payor_detais->create_by;
            $new_payor_fac->plain_medicare = $fac_payor_detais->plain_medicare;
            $new_payor_fac->plan_medicalid = $fac_payor_detais->plan_medicalid;
            $new_payor_fac->plan_campus = $fac_payor_detais->plan_campus;
            $new_payor_fac->plan_champva = $fac_payor_detais->plan_champva;
            $new_payor_fac->plan_group_health = $fac_payor_detais->plan_group_health;
            $new_payor_fac->plan_feca = $fac_payor_detais->plan_feca;
            $new_payor_fac->plan_others = $fac_payor_detais->plan_others;
            $new_payor_fac->claim_filing_indicator = $fac_payor_detais->claim_filing_indicator;
            $new_payor_fac->save();


            $new_payor_details = new All_payor_detail();
            $new_payor_details->admin_id = $this->admin_id;
            $new_payor_details->payor_id = $sing_payor->id;
            $new_payor_details->facility_payor_id = $sing_payor->facility_payor_id;
            $new_payor_details->payor_name = $sing_payor->payor_name;
            $new_payor_details->co_pay = $sing_payor->co_pay;
            $new_payor_details->day_club = $sing_payor->day_club;
            $new_payor_details->is_electronic = $sing_payor->is_electronic;
            $new_payor_details->cms_1500_31 = $sing_payor->cms_1500_31;
            $new_payor_details->cms_1500_32a = $sing_payor->cms_1500_32a;
            $new_payor_details->cms_1500_32b = $sing_payor->cms_1500_32b;
            $new_payor_details->cms_1500_33a = $sing_payor->cms_1500_33a;
            $new_payor_details->cms_1500_33b = $sing_payor->cms_1500_33b;
            $new_payor_details->is_active = $sing_payor->is_active;
            $new_payor_details->npi = $sing_payor->npi;
            $new_payor_details->tax_id = $sing_payor->tax_id;
            $new_payor_details->ssn = $sing_payor->ssn;
            $new_payor_details->box_17 = $sing_payor->box_17;
//            $new_payor_details->cms1500_32address = $sing_payor->cms1500_32address;
//            $new_payor_details->cms150033_address = $sing_payor->cms150033_address;
            $new_payor_details->day_pay_cpt = $sing_payor->day_pay_cpt;
            $new_payor_details->save();


//            Payor_facility::create([
//                'admin_id' => Auth::user()->is_up_admin == 1 ? $this->admin_id : Auth::user()->up_admin_id,
//                'payor_id' => $sing_payor->id,
//                'facility_payor_id' => $apayor->facility_payor_id,
//                'payor_name' => $apayor->payor_name,
//                'address' => $fac_payor_detais->address,
//                'city' => $fac_payor_detais->city,
//                'state' => $fac_payor_detais->state,
//                'zip' => $fac_payor_detais->zip,
//                'contact_one' => $fac_payor_detais->contact_one,
//                'contact_two' => $fac_payor_detais->contact_two,
//                'phone_one' => $fac_payor_detais->phone_one,
//                'fpayor_id' => $fac_payor_detais->payor_id,
//                'is_regional_center' => $fac_payor_detais->is_regional_center,
//                'regional_center_name' => $fac_payor_detais->regional_center_name,
//                'billing_aber' => $fac_payor_detais->billing_aber,
//                'ele_payor_id' => $fac_payor_detais->ele_payor_id,
//                'create_by' => $fac_payor_detais->create_by,
//                'plain_medicare' => $fac_payor_detais->plain_medicare,
//                'plan_medicalid' => $fac_payor_detais->plan_medicalid,
//                'plan_campus' => $fac_payor_detais->plan_campus,
//                'plan_champva' => $fac_payor_detais->plan_champva,
//                'plan_group_health' => $fac_payor_detais->plan_group_health,
//                'plan_feca' => $fac_payor_detais->plan_feca,
//                'plan_others' => $fac_payor_detais->plan_others,
//                'claim_filing_indicator' => $fac_payor_detais->claim_filing_indicator,
//            ]);
        }

        return 'done';
    }


    public function remove_payor_facility(Request $request)
    {
        $all_p = $request->alp;

        foreach ($all_p as $p) {


            $sing_p = Payor_facility::select('id', 'payor_id')->where('id', $p)->where('admin_id', $this->admin_id)->first();
            $get_app_count = Appoinment::where('payor_id', $sing_p->payor_id)->where('admin_id', $this->admin_id)->count();

//            if (Auth::user()->is_up_admin == 1) {
//                $remove_trx_payor = payor_details_tx_type::where('admin_id', $this->admin_id)
//                    ->where('payor_id', $sing_p->payor_id)->delete();
//            } else {
//                $remove_trx_payor = payor_details_tx_type::where('admin_id', $this->admin_id)
//                    ->where('payor_id', $sing_p->payor_id)->delete();
//            }


            if ($get_app_count <= 0) {
                $payor_fac_details = All_payor_detail::where('payor_id', $sing_p->payor_id)->where('admin_id', $this->admin_id)->first();

                if ($payor_fac_details) {
                    $payor_fac_details->delete();
                }
                $sing_p->delete();
            }
        }
    }

    public function all_payor_get_details(Request $request)
    {
        $get_f_id = $request->all_payor_id;
        $f_id = $get_f_id[0];

        $all_ayor = All_payor::where('id', $f_id)->first();

        if ($all_ayor) {
            $payor_fac = Payor_facility_details::where('id', $all_ayor->facility_payor_id)->first();
            if ($payor_fac) {
                return response()->json($payor_fac, 200);
            } else {
                return response()->json('payor fac not fount');
            }
        } else {
            return response()->json('all payor not found');
        }
    }


    public function payor_facility_get_details(Request $request)
    {
        $get_f_id = $request->all_payor;
        $f_id = $get_f_id[0];

        $get_facility_data = Payor_facility_details::where('id', $f_id)->first();

        if ($get_facility_data) {
            return response($get_facility_data, 200);
        } else {
            return 'all payor selected';
        }
    }


    public function payor_selected_facility_get_details(Request $request)
    {
        $get_f_id = $request->f_id;
        $f_id = $get_f_id[0];

        $get_facility_data = Payor_facility::where('id', $f_id)->where('admin_id', $this->admin_id)->first();

        if ($get_facility_data) {
            return $get_facility_data;
        } else {
            return 'all payor selected';
        }
    }


    public function payor_facility_details_update(Request $request)
    {
        $update_payor_details = Payor_facility::where('id', $request->f_edit_id)->first();
        $update_payor_details->payor_name = $request->name;
        $update_payor_details->address = $request->address;
        $update_payor_details->city = $request->city;
        $update_payor_details->state = $request->state;
        $update_payor_details->zip = $request->zip;
        $update_payor_details->contact_one = $request->contact_one;
        $update_payor_details->contact_two = $request->contact_two;
        $update_payor_details->phone_one = $request->phone_one;
        $update_payor_details->phone_two = $request->phone_two;
        $update_payor_details->fpayor_id = $request->payor_id;
        $update_payor_details->billing_aber = $request->billing_aber;
        $update_payor_details->is_regional_center = $request->is_regional_center;
        $update_payor_details->ele_payor_id = $request->ele_payor_id;
        $update_payor_details->save();


        $update_all_payor_fac = All_payor_detail::where('admin_id', $this->admin_id)
            ->where('payor_id', $update_payor_details->payor_id)
            ->where('facility_payor_id', $update_payor_details->facility_payor_id)
            ->first();

        if ($update_all_payor_fac) {
            $update_all_payor_fac->payor_name = $update_payor_details->payor_name;
            $update_all_payor_fac->save();
        }


        return back()->with('success', 'Payor Details Successfully Updated');
    }


    public function payor_setup()
    {
        $all_payor_fac = All_payor_detail::where('admin_id', $this->admin_id)->paginate(10);
        $all_payor_fac_count = All_payor_detail::where('admin_id', $this->admin_id)->count();
        return view('superadmin.settingFacilitySetup.payorSetup', compact('all_payor_fac'));
    }

    public function payor_setup_detaisl_get(Request $request)
    {
        $payor_details = All_payor_detail::where('id', $request->edi_id)->where('admin_id', $this->admin_id)->first();

        $treatment_fac = Treatment_facility::where('admin_id', $this->admin_id)->get();

        foreach ($treatment_fac as $tre_fac) {
            $check_tx = payor_details_tx_type::where('admin_id', $this->admin_id)
                ->where('payor_id', $payor_details->payor_id)
                ->where('treatment_id', $tre_fac->treatment_id)
                ->first();

            if (!$check_tx) {
                $new_data = new payor_details_tx_type();
                $new_data->admin_id = $this->admin_id;
                $new_data->payor_id = $payor_details->payor_id;
                $new_data->treatment_id = $tre_fac->treatment_id;
                $new_data->treatment_name = $tre_fac->treatment_name;
                $new_data->box_24j = "";
                $new_data->id_qualifire = "";
                $new_data->save();
            }
        }

        $get_all_tx_types = payor_details_tx_type::where('admin_id', $this->admin_id)
            ->where('payor_id', $payor_details->payor_id)
            ->orderBy('treatment_name','asc')
            ->get();

        return response()->json([
            'payor_details' => $payor_details,
            'tx_types' => $get_all_tx_types,
        ], 200);
    }


    public function payor_setup_detaisl_update(Request $request)
    {

        $payor = All_payor_detail::where('id', $request->payor_up_id)->where('admin_id', $this->admin_id)->first();

        if ($payor) {
            $payor->co_pay = $request->copay_number;
            $payor->day_club = $request->day_cub;
            $payor->is_electronic = $request->is_elec;
            $payor->cms_1500_31 = $request->cms1500_31;
            $payor->cms_1500_32a = $request->cms1500_32a;
            $payor->cms_1500_32b = $request->cms1500_32b;
            $payor->cms_1500_33a = $request->cms1500_33a;
            $payor->cms_1500_33b = $request->cms1500_33b;
            $payor->is_active = $request->is_active;
            $payor->npi = $request->npi;
            $payor->tax_id = $request->tax_id;
            $payor->ssn = $request->ssn;
            $payor->box_17 = $request->box_17;
            $payor->day_pay_cpt = $request->day_pay_cpt;
            // $payor->cms150032_address = $request->cms150032_address;
            // $payor->cms150033_address = $request->cms150033_address;
            $payor->cms1500_32address = $request->cms1500_32address;
            $payor->cms1500_32city = $request->cms1500_32city;
            $payor->cms1500_32state = $request->cms1500_32state;
            $payor->cms1500_32zip = $request->cms1500_32zip;

            $payor->cms1500_33address = $request->cms1500_33address;
            $payor->cms1500_33city = $request->cms1500_33city;
            $payor->cms1500_33state = $request->cms1500_33state;
            $payor->cms1500_33zip = $request->cms1500_33zip;
            $payor->save();
        }

        $data = $request->all();
        if (isset($data['edit_details_id'])) {
            for ($i = 0; $i < count($request->edit_details_id); $i++) {
                $update_data = payor_details_tx_type::where('id', $data['edit_details_id'][$i])->first();
                if ($update_data) {
                    $update_data->payor_id = $payor->payor_id;
                    $update_data->box_24j = isset($data['box_24j'][$i]) ? $data['box_24j'][$i] : '';
                    $update_data->id_qualifire = isset($data['id_qualifire'][$i]) ? $data['id_qualifire'][$i] : '';
                    $update_data->save();
                }
            }
        }


    }


    public function payor_setup_update_table(Request $request)
    {
        $data = $request->all();
//        return $data;
        if (isset($data)) {
            for ($i = 0; $i < count($data['edit_id']); $i++) {
                $payor_details = All_payor_detail::where('id', $data['edit_id'][$i])
                    ->where('admin_id', $this->admin_id)
                    ->first();

                if ($payor_details) {
                    $payor_details->is_electronic = isset($data['is_electonic_data'][$i]) ? $data['is_electonic_data'][$i] : '';
                    $payor_details->cms_1500_31 = isset($data['cms_1500_31'][$i]) ? $data['cms_1500_31'][$i] : '';
                    $payor_details->cms_1500_32a = isset($data['cms_1500_32a'][$i]) ? $data['cms_1500_32a'][$i] : '';
                    $payor_details->cms_1500_32b = isset($data['cms_1500_32b'][$i]) ? $data['cms_1500_32b'][$i] : '';
                    $payor_details->cms_1500_33a = isset($data['cms_1500_33a'][$i]) ? $data['cms_1500_33a'][$i] : '';
                    $payor_details->cms_1500_33b = isset($data['cms_1500_33b'][$i]) ? $data['cms_1500_33b'][$i] : '';
                    $payor_details->is_active = isset($data['is_active_data'][$i]) ? $data['is_active_data'][$i] : 0;
                    $payor_details->save();
                }

            }
        }
    }


    public function payor_treatment()
    {
        $all_treatments = All_treatment::orderBy('treatment_name','asc')->get();
        $facility_treatments = Treatment_facility::orderBy('treatment_name','asc')->get();
        return view('superadmin.settingFacilitySetup.addTreatment', compact('all_treatments', 'facility_treatments'));
    }


    public function payor_treatment_facility(Request $request)
    {
        $all_p = $request->alp;
        foreach ($all_p as $p) {
            $trement = All_treatment::where('id', $p)->first();
            Treatment_facility::create([
                'admin_id' => $this->admin_id,
                'treatment_id' => $p,
                'treatment_name' => $trement->treatment_name,
            ]);
        }

        return 'done';
    }


    public function payor_treatment_get(Request $request)
    {
        $array = [];
        $assign_tre = Treatment_facility::where('admin_id', $this->admin_id)->get();
        foreach ($assign_tre as $astre) {
            array_push($array, $astre->treatment_id);
        }
        $all_treatments = All_treatment::whereNotIn('id', $array)->orderBy('treatment_name','asc')->get();
        return response()->json($all_treatments, 200);
    }

    public function assign_treatment_get()
    {
        $all_treatments = Treatment_facility::where('admin_id', $this->admin_id)->orderBy('treatment_name','asc')->get();

        return response()->json($all_treatments, 200);
    }

    public function assign_treatment_remove(Request $request)
    {
        $all_p = $request->assign_treatment;
        foreach ($all_p as $p) {
            $tretment = Treatment_facility::where('admin_id', $this->admin_id)->where('id', $p)->first();
            $auch = Client_authorization::where('admin_id', $this->admin_id)->where('treatment_type', $tretment->treatment_name)->count();
            $remove_pyr_tx_details = payor_details_tx_type::where('admin_id', $this->admin_id)
                ->where('treatment_id', $tretment->treatment_id)->delete();

            if ($auch <= 0) {
                $tretment->delete();
            }
        }

        return 'done';
    }


    public function add_employee()
    {
        //        $array = ['Infant Toddler Developmental Specialist','Mental Health Service Provider','Music Therapist','Occupation Therapist','Occupation Therapist assistant','Physical Therapist',
        //            'Physical Therapist Assistant','Professional','Speech Therapist','Speech Therapist Assistant','Teacher'];
        //
        //        for ($i=0;$i<count($array);$i++){
        //            $new_type = new All_employee_type();
        //            $new_type->type_name = $array[$i];
        //            $new_type->save();
        //        }

        return view('superadmin.settingFacilitySetup.addEmployee');
    }


    public function employee_get_all(Request $request)
    {

        $array = [];
        $assign_types = Employee_type_assign::where('admin_id', $this->admin_id)->get();

        foreach ($assign_types as $type) {
            array_push($array, $type->type_id);
        }

        $all_employee_type = All_employee_type::whereNotIn('id', $array)->get();
        return response()->json($all_employee_type, 200);
    }

    public function employee_get_assign_all(Request $request)
    {
        $assign_tem_type = Employee_type_assign::where('admin_id', $this->admin_id)->get();
        return response()->json($assign_tem_type, 200);
    }


    public function employee_save_type(Request $request)
    {
        $types = $request->types;

        foreach ($types as $typ) {
            $type_name = All_employee_type::where('id', $typ)->first();
            Employee_type_assign::create([
                'admin_id' => $this->admin_id,
                'type_id' => $type_name->id,
                'type_name' => $type_name->type_name,
            ]);
        }

        return 'done';
    }


    public function employee_remove_type(Request $request)
    {
        $assign_type = $request->assign_type;

        foreach ($assign_type as $typ) {
            $del_assign_type = Employee_type_assign::where('admin_id', $this->admin_id)->where('id', $typ)->first();
            if ($del_assign_type) {
                $sing_em = Employee::select('id', 'admin_id', 'title')
                    ->where('admin_id', $this->admin_id)
                    ->where('title', $del_assign_type->id)
                    ->count();

                if ($sing_em <= 0) {
                    $del_assign_type->delete();
                }
            }
        }
    }


    public function rendering_provider()
    {
        $ren_providers = Rendering_provider::where('admin_id', $this->admin_id)->orderBy('id', 'desc')->paginate(10);
        return view('superadmin.settingOtherSetup.renderingProvider', compact('ren_providers'));
    }

    public function rendering_provider_save(Request $request)
    {
        $new_provider = new Rendering_provider();
        $new_provider->admin_id = $this->admin_id;
        $new_provider->provider_name = $request->provider_name;
        $new_provider->provider_last_name = $request->provider_last_name;
        $new_provider->npi = $request->npi;
        $new_provider->upin = $request->upin;
        $new_provider->save();
        return back()->with('success', 'Referring Provider Successfully Created');
    }

    public function rendering_provider_update(Request $request)
    {
        $update_provider = Rendering_provider::where('id', $request->edit_ref_provider)->first();
        $update_provider->provider_name = $request->provider_name;
        $update_provider->provider_last_name = $request->provider_last_name;
        $update_provider->npi = $request->npi;
        $update_provider->upin = $request->upin;
        $update_provider->save();
        return back()->with('success', 'Referring Provider Successfully Updated');
    }

    public function rendering_provider_delete($id)
    {
        $delete_provider = Rendering_provider::where('id', $id)->first();
        $delete_provider->delete();
        return back()->with('success', 'Referring Provider Successfully Deleted');
    }


    public function pos()
    {
        $pos_data = point_of_service::where('admin_id', $this->admin_id)->orderBy('id', 'desc')->paginate(10);
        return view('superadmin.settingOtherSetup.pos', compact('pos_data'));
    }

    public function pos_save(Request $request)
    {
        $new_pos = new point_of_service();
        $new_pos->admin_id = $this->admin_id;
        $new_pos->pos_name = $request->pos_name;
        $new_pos->pos_code = $request->pos_code;
        $new_pos->save();
        return back()->with('success', 'POS Successfully Created');
    }


    public function pos_update(Request $request)
    {
        $update_pos = point_of_service::where('id', $request->edit_pos)->first();
        $update_pos->pos_name = $request->pos_name;
        $update_pos->pos_code = $request->pos_code;
        $update_pos->save();
        return back()->with('success', 'POS Successfully Updated');
    }


    public function pos_delete($id)
    {
        $delete_pos = point_of_service::where('id', $id)->first();
        $check_app = Appoinment::where('location', $delete_pos->pos_code)->where('admin_id', $this->admin_id)->first();
        if ($check_app) {
            return back()->with('alert', 'POS already used in session');
            exit();
        }

        $delete_pos->delete();
        return back()->with('success', 'POS Successfully Deleted');

    }


    public function services()
    {
        $set_services = setting_service::where('admin_id', $this->admin_id)->orderBy('id', 'desc')->paginate(10);
        $facility_treatment = Treatment_facility::where('admin_id', $this->admin_id)->orderBy('treatment_name','asc')->get();
        return view('superadmin.settingFacilitySetup.services', compact('set_services', 'facility_treatment'));
    }

    public function services_save(Request $request)
    {
        $count_service = setting_service::where('admin_id', $this->admin_id)
            ->where('facility_treatment_id', $request->facility_treatment_id)
            ->where('description', $request->description)
            ->count();

        if ($count_service > 1) {
            return back()->with('alert', 'Setting Services Already Exists');
            exit();
        }


        $new_setting_service = new setting_service();
        $new_setting_service->admin_id = $this->admin_id;
        $new_setting_service->facility_treatment_id = $request->facility_treatment_id;
        $new_setting_service->service = $request->service;
        $new_setting_service->description = $request->description;
        $new_setting_service->duration = $request->duration;
        $new_setting_service->mileage = $request->mileage;
        $new_setting_service->type = $request->type;
        $new_setting_service->save();

        return back()->with('success', 'Setting Services Successfully Created');
    }


    public function services_update(Request $request)
    {
        $setting_sevice_update = setting_service::where('id', $request->service_edit)->first();


        $check_exists_act = Client_authorization_activity::where('activity_one', $setting_sevice_update->description)
            ->where('admin_id', $this->admin_id)
            ->get();

        if (count($check_exists_act) > 0) {
            foreach ($check_exists_act as $sing_act) {
                $update_act = Client_authorization_activity::where('id', $sing_act->id)->first();
                $update_act->activity_one = $request->description;
                $update_act->save();
            }
        }


        $setting_sevice_update->facility_treatment_id = $request->facility_treatment_id_edit;
        $setting_sevice_update->description = $request->description;
        $setting_sevice_update->duration = $request->duration;
        $setting_sevice_update->mileage = $request->mileage;
        $setting_sevice_update->type = $request->type;
        $setting_sevice_update->save();
        return back()->with('success', 'Setting Services Successfully Updated');
    }


    public function services_delete($id)
    {
        $service = setting_service::where('id', $id)->first();
        if ($service) {

            $check_auth = Client_authorization_activity::where('activity_one', $service->description)->where('admin_id', $this->admin_id)->count();

            if ($check_auth > 0) {
                return back()->with('alert', 'Service Have Active Authorization');
                exit();
            } else {
                $service->delete();
                return back()->with('success', 'Service Deleted Successfully');
            }
        } else {
            return back()->with('alert', 'Something Went Wrong');
        }
    }


    public function cpt_code()
    {
        $all_cpt_codes = setting_cpt_code::where('admin_id', $this->admin_id)->paginate(15);
        $facility_treatment = Treatment_facility::where('admin_id', $this->admin_id)->get();
        $name_location = setting_name_location::where('admin_id', $this->admin_id)->first();
        return view('superadmin.settingOtherSetup.cptCode', compact('all_cpt_codes', 'facility_treatment', 'name_location'));
    }

    public function cpt_code_save(Request $request)
    {
        $name_location = setting_name_location::where('admin_id', $this->admin_id)->first();
        if ($name_location->is_combo != 1) {
            $check_exist_cpt = setting_cpt_code::where('admin_id', $this->admin_id)
                ->where('cpt_code', $request->cpt_code)
                ->first();
        } else {
            $ck_all_codes = $request->cpt_code;
            $ck_array_imp_cpt = implode(", ", $ck_all_codes);
            $check_exist_cpt = setting_cpt_code::where('admin_id', $this->admin_id)
                ->where('cpt_code', $ck_array_imp_cpt)
                ->first();
        }


        if ($check_exist_cpt) {
            return back()->with('alert', 'Cpt Code Already Exists');
        } else {
            $check_cpt_id = setting_cpt_code::where('admin_id', $this->admin_id)
                ->orderBy('id', 'desc')
                ->first();

            if ($check_cpt_id) {
                $cpt_id = $check_cpt_id->cpt_id + 1;
            } else {
                $cpt_id = 1;
            }

            $new_cpt = new setting_cpt_code();
            $new_cpt->admin_id = $this->admin_id;
            $new_cpt->cpt_id = $cpt_id;
            $new_cpt->facility_treatment_id = $request->facility_treatment_id;
            if ($name_location->is_combo != 1) {
                $new_cpt->cpt_code = $request->cpt_code;
            } else {
                $all_codes = $request->cpt_code;
                $array_imp_cpt = implode(", ", $all_codes);
                $new_cpt->cpt_code = $array_imp_cpt;
            }

            $new_cpt->save();
            return back()->with('success', 'Cpt Code Created Successfully');
        }
    }


    public function cpt_code_update(Request $request)
    {
        $name_location = setting_name_location::where('admin_id', $this->admin_id)->first();
        if ($name_location->is_combo != 1) {
            $count_cpt = setting_cpt_code::where('admin_id', $this->admin_id)
                ->where('facility_treatment_id', $request->edit_facility_treatment_id)
                ->where('cpt_code', $request->edit_cpt_code)
                ->count();

            if ($count_cpt > 1) {
                return back()->with('alert', 'Cpt Already Exists');
                exit();
            }


        } else {
            $ck_all_codes = $request->edit_cpt_code;
            $ck_array_imp_cpt = implode(", ", $ck_all_codes);
            $count_cpt = setting_cpt_code::where('admin_id', $this->admin_id)
                ->where('facility_treatment_id', $request->edit_facility_treatment_id)
                ->where('cpt_code', $ck_array_imp_cpt)
                ->count();

            if ($count_cpt > 1) {
                return back()->with('alert', 'Cpt Already Exists');
                exit();
            }


        }

        $update_cpt_code = setting_cpt_code::where('id', $request->cpt_code_edit)->first();
        $update_cpt_code->facility_treatment_id = $request->edit_facility_treatment_id;
        if ($name_location->is_combo != 1) {
            $update_cpt_code->cpt_code = $request->edit_cpt_code;
        } else {
            $ck_all_codes = $request->edit_cpt_code;
            $ck_array_imp_cpt = implode(", ", $ck_all_codes);
            $update_cpt_code->cpt_code = $ck_array_imp_cpt;
        }

        $update_cpt_code->save();
        return back()->with('success', 'Cpt Code Updated Successfully');


    }

    public function cpt_code_delete($id)
    {
        $delete_cpt_code = setting_cpt_code::where('id', $id)
            ->where('admin_id', $this->admin_id)
            ->first();

        if ($delete_cpt_code) {

            $check_client_act = Client_authorization_activity::where('cpt_code', $delete_cpt_code->cpt_id)
                ->where('admin_id', $this->admin_id)
                ->first();

            if ($check_client_act) {
                return back()->with('alert', 'Cpt Code Already Use In Patient Activity');
            } else {
                $delete_cpt_code->delete();
                return back()->with('success', 'Cpt Code Deleted Successfully');
            }
        } else {
            return back()->with('alert', 'Cpt Code Not Found');
        }
    }


    public function cpt_code_exclusion()
    {
        return view('superadmin.settingOtherSetup.cptCodeExclusion');
    }

    public function fetch_all_cpt(Request $request)
    {
        $list = [];
        $excluded = cpt_code_exclusion::select('cpt_code_id', 'cpt_code')->where('admin_id', $this->admin_id)->get();
        foreach ($excluded as $ex) {
            array_push($list, $ex->cpt_code_id);
        }

        $included = setting_cpt_code::select('id', 'cpt_code')->where('admin_id', $this->admin_id)->whereNotIn('id', $list)->get();
        return response()->json([
            "included" => $included,
            "excluded" => $excluded
        ]);
    }


    public function include_cpt(Request $request)
    {
        $cpt = $request->exclude_cpt;
        cpt_code_exclusion::whereIn('cpt_code_id', $cpt)->delete();
    }

    public function exclude_cpt(Request $request)
    {
        $cpt = $request->all_cpt;
        foreach ($cpt as $cp) {
            $code = setting_cpt_code::where('id', $cp)->first();
            $data = new cpt_code_exclusion;
            $data->admin_id = $this->admin_id;
            $data->cpt_code_id = $cp;
            $data->cpt_code = $code->cpt_code;
            $data->save();
        }
    }

    public function vendor_number()
    {
        $service = setting_service::where('admin_id', $this->admin_id)->get();
        $tx_types = Treatment_facility::where('admin_id', $this->admin_id)->get();
        $get_all_pay = Payor_facility::where('admin_id', $this->admin_id)->get();


        return view('superadmin.settingOtherSetup.vendorNumber', compact('service', 'tx_types', 'get_all_pay'));
    }

    public function vendor_number_get_region_center(Request $request)
    {
        $payor_fac = Payor_facility_details::where('is_regional_center', 1)->get();

        $array_data = [];
        foreach ($payor_fac as $payorfc) {
            $pay_fac = Payor_facility::where('payor_id', $payorfc->id)->first();
            array_push($array_data, $pay_fac->payor_id);
        }

        $get_all_pay = Payor_facility::whereIn('payor_id', $array_data)->where('admin_id', $this->admin_id)->get();

        return response()->json($get_all_pay, 200);
    }

    public function vendor_number_get_tx(Request $request)
    {
        $tx_fac = Treatment_facility::where('admin_id', $this->admin_id)->get();
        return response()->json($tx_fac, 200);
    }


    public function vendor_number_save(Request $request)
    {
        $new_vendor = new vendor_number();
        $new_vendor->admin_id = $this->admin_id;
        $new_vendor->service_id = $request->service_id;
        $new_vendor->treatment_id = $request->treatment_id;
        $new_vendor->regional_center_id = $request->regional_center_id;
        $new_vendor->vendor_no = $request->vendor_no;
        $new_vendor->service_code = $request->service_code;
        $new_vendor->save();
        return back()->with('success', 'Vendor Number Successfully Created');
    }

    public function vendor_number_update(Request $request)
    {
        $up_vendor = vendor_number::where('id', $request->edit_vendor)->first();
        $up_vendor->service_id = $request->service_id;
        $up_vendor->treatment_id = $request->treatment_id;
        $up_vendor->regional_center_id = $request->regional_center_id;
        $up_vendor->vendor_no = $request->vendor_no;
        $up_vendor->service_code = $request->service_code;
        $up_vendor->save();
        return back()->with('success', 'Vendor Number Successfully Updated');
    }

    public function vendor_number_delete($id)
    {
        $vendor_number_delete = vendor_number::where('id', $id)->first();
        if ($vendor_number_delete) {
            $vendor_number_delete->delete();
            return back()->with('success', 'Vendor Number Successfully Deleted');
        } else {
            return back()->with('success', 'Vendor Number Not Found');
        }
    }


    public function vendor_number_filter(Request $request)
    {
        $tx_id = $request->tx_id;
        $region_id = $request->region_id;

        $admin_id = $this->admin_id;
        $query = "SELECT * FROM vendor_numbers WHERE admin_id=$admin_id ";

        if (isset($tx_id)) {
            $query .= "AND treatment_id =$tx_id ";
        }

        if (isset($region_id)) {
            $query .= "AND regional_center_id =$region_id ";
        }

        $query .= "ORDER BY id DESC ";
        $query_exe = DB::select($query);

        $vendors = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $vendors,
            'view' => View::make('superadmin.settingOtherSetup.include.vendorNumberTable', compact('vendors'))->render(),
        ]);
    }


    public function vendor_number_filter_get(Request $request)
    {
        $tx_id = $request->tx_id;
        $region_id = $request->region_id;

        $admin_id = $this->admin_id;

        $query = "SELECT * FROM vendor_numbers WHERE admin_id=$admin_id ";

        if (isset($tx_id)) {
            $query .= "AND treatment_id =$tx_id ";
        }

        if (isset($region_id)) {
            $query .= "AND regional_center_id =$region_id ";
        }

        $query .= "ORDER BY id DESC ";
        $query_exe = DB::select($query);

        $vendors = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $vendors,
            'view' => View::make('superadmin.settingOtherSetup.include.vendorNumberTable', compact('vendors'))->render(),
        ]);
    }


    public function logo()
    {
        $check_logo = general_setting::where('admin_id', $this->admin_id)->first();
        if ($check_logo) {
            $logo = $check_logo;
        } else {
            $new_logo = new general_setting();
            $new_logo->admin_id = $this->admin_id;
            $new_logo->save();

            $logo = $new_logo;
        }
        return view('superadmin.settingFacilitySetup.logo', compact('logo'));
    }

    public function logo_update(Request $request)
    {
        $logo_update = general_setting::where('admin_id', $this->admin_id)->first();

        if ($logo_update) {
            if ($request->hasFile('logo')) {
                @unlink($logo_update->logo);
                $image = $request->file('logo');
                $imageName = time() . uniqid() . '.' . "png";
                $directory = 'assets/dashboard/images/logo/';
                $imgUrl = $directory . $imageName;
                Image::make($image)->save($imgUrl);
                $logo_update->logo = $imgUrl;
            }
            $logo_update->admin_id = $this->admin_id;
            $logo_update->save();
        } else {
            $new_logo = new general_setting();
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $imageName = time() . uniqid() . '.' . "png";
                $directory = 'assets/dashboard/images/logo/';
                $imgUrl = $directory . $imageName;
                Image::make($image)->save($imgUrl);
                $new_logo->logo = $imgUrl;
            }
            $new_logo->admin_id = $this->admin_id;
            $new_logo->save();
        }


        return back()->with('success', "Logo Successfully Updated");
    }


    public function unbillable_activity()
    {
        $unbillable_acts = Processing_claim::where('status', 'Unbillable Activity')
            ->where('admin_id', $this->admin_id)
            ->paginate(10);
        return view('superadmin.settingFacilitySetup.unbillableActivity', compact('unbillable_acts'));
    }


    public function unbillable_activity_get(Request $request)
    {
        $admin_id = $this->admin_id;
        $query = "SELECT * FROM processing_claims WHERE admin_id=$admin_id  AND status ='Unbillable Activity' ";
        $query .= "ORDER BY schedule_date ASC; ";
        $unbillable_acts = DB::select($query);

        return response()->json([
            'notices' => $unbillable_acts,
            'view' => View::make('superadmin.settingFacilitySetup.include.unbillabletable', compact('unbillable_acts'))->render(),
        ]);

    }


    public function unbillable_activity_update(Request $request)
    {
        $ids = $request->claim_id;
        $all_claims = Processing_claim::whereIn('id', $ids)->get();
        if (count($all_claims)) {
            foreach ($all_claims as $clm) {
                $claim = Processing_claim::where('id', $clm->id)->where('admin_id', $this->admin_id)->first();
                if ($claim) {
                    $claim->is_mark_gen = 0;
                    $claim->status = 'Ready To Bill';
                    $claim->save();
                }

                $app_data = Appoinment::where('id', $clm->appointment_id)->where('admin_id', $this->admin_id)->first();
                if ($app_data) {
                    $app_data->is_locked = 0;
                    $app_data->save();
                }

                $batching_claim = Batching_claim::where('appointment_id', $claim->appointment_id)->where('admin_id', $this->admin_id)->first();
                if ($batching_claim) {
                    $batching_claim->status = "Ready To Bill";
                    $batching_claim->is_mark_gen = 0;
                    $batching_claim->save();
                }

            }

            return 'done';
        } else {
            return 'cliam not found';
        }


    }


    public function zone_setup()
    {
        $all_zone = zone_setup::orderBy('id', 'desc')->paginate(10);
        $all_zone_get = zone_setup::all();
        $all_provider = Employee::all();
        return view('superadmin.settingFacilitySetup.zoneSetup', compact('all_zone', 'all_zone_get', 'all_provider'));
    }

    public function zone_setup_save(Request $request)
    {
        $new_zone = new zone_setup();
        $new_zone->zone_id = rand(000, 999);
        $new_zone->name = $request->name;
        $new_zone->description = $request->description;
        $new_zone->save();

        return back()->with('success', "Zone Successfully Created");
    }


    public function zone_setup_delete($id)
    {
        $zone_delete = zone_setup::where('id', $id)->first();
        $zone_delete->delete();
        return back()->with('success', "Zone Successfully Deleted");
    }

    public function holiday_setup()
    {
        $holiday_setups = holiday_setup::where('admin_id', $this->admin_id)->orderBy('holiday_date','ASC')->paginate(15);
        $jan1 = holiday_setup::where('holiday_name', 'jan1')->where('admin_id', $this->admin_id)->first();
        $jan17 = holiday_setup::where('holiday_name', 'jan17')->where('admin_id', $this->admin_id)->first();
        $feb21 = holiday_setup::where('holiday_name', 'feb21')->where('admin_id', $this->admin_id)->first();
        $may30 = holiday_setup::where('holiday_name', 'may30')->where('admin_id', $this->admin_id)->first();
        $jun20 = holiday_setup::where('holiday_name', 'jun20')->where('admin_id', $this->admin_id)->first();
        $july4 = holiday_setup::where('holiday_name', 'july4')->where('admin_id', $this->admin_id)->first();
        $sep5 =  holiday_setup::where('holiday_name', 'sep5')->where('admin_id', $this->admin_id)->first();
        $oct10 = holiday_setup::where('holiday_name', 'oct10')->where('admin_id', $this->admin_id)->first();
        $nov11 = holiday_setup::where('holiday_name', 'nov11')->where('admin_id', $this->admin_id)->first();
        $nov24 = holiday_setup::where('holiday_name', 'nov24')->where('admin_id', $this->admin_id)->first();
        $dec25 = holiday_setup::where('holiday_name', 'dec25')->where('admin_id', $this->admin_id)->first();

        return view('superadmin.settingOtherSetup.holidaySetup', compact('holiday_setups', 'jan1', 'jan17', 'feb21', 'may30', 'jun20', 'july4', 'sep5', 'oct10', 'nov11', 'nov24', 'dec25'));
    }

    public function holiday_setup_save(Request $request)
    {
        $h_date = Carbon::parse($request->holiday_date)->format('Y-m-d');
        $check_date = holiday_setup::where('holiday_date', $h_date)->where('admin_id', $this->admin_id)->first();
        if ($check_date) {
            return back()->with('alert', 'Holiday date already exists');
            exit();
        }
        $new_holiday = new holiday_setup();
        $new_holiday->admin_id = $this->admin_id;
        $new_holiday->holiday_date = $h_date;
        $new_holiday->description = $request->description;
        $new_holiday->save();
        return back()->with('success', 'Holiday Setup Created Successfully');
    }

    public function holiday_setup_delete($id)
    {
        $delete_holiday_setup = holiday_setup::where('id', $id)
            ->where('admin_id', $this->admin_id)
            ->first();
        $delete_holiday_setup->delete();
        return back()->with('success', 'Holiday Setup Deleted Successfully');
    }


    public function federal_holiday_save(Request $request)
    {
        if (isset($request->jan_1)) {
            $date = Carbon::now()->format('Y') . '-01-01';
            $check_jan1 = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();

            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date)->format('Y-m-d');
                $new_holiday->description = "New Year's Day (January 1)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'jan1';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-01-01';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }

        if (isset($request->jan_17)) {
            $date_jan17 = Carbon::now()->format('Y') . '-01-17';
            $check_jan1 = holiday_setup::where('holiday_date', $date_jan17)->where('admin_id',$this->admin_id)->first();
            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date_jan17)->format('Y-m-d');
                $new_holiday->description = "Martin Luther King Jr. Day (January 17)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'jan17';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-01-17';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }

        if (isset($request->feb_21)) {
            $date_jan17 = Carbon::now()->format('Y') . '-02-21';
            $check_jan1 = holiday_setup::where('holiday_date', $date_jan17)->where('admin_id',$this->admin_id)->first();
            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date_jan17)->format('Y-m-d');
                $new_holiday->description = "George Washington's Birthday (February 21)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'feb21';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-02-21';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }

        if (isset($request->may_30)) {
            $date_jan17 = Carbon::now()->format('Y') . '-05-30';
            $check_jan1 = holiday_setup::where('holiday_date', $date_jan17)->where('admin_id',$this->admin_id)->first();
            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date_jan17)->format('Y-m-d');
                $new_holiday->description = "Memorial Day (May 30)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'may30';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-05-30';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }



        if (isset($request->jun_20)) {
            $date_jan17 = Carbon::now()->format('Y') . '-06-20';
            $check_jan1 = holiday_setup::where('holiday_date', $date_jan17)->where('admin_id',$this->admin_id)->first();
            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date_jan17)->format('Y-m-d');
                $new_holiday->description = "Juneteenth (June 20)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'jun20';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-06-20';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }

        if (isset($request->july_4)) {
            $date_jan17 = Carbon::now()->format('Y') . '-07-04';
            $check_jan1 = holiday_setup::where('holiday_date', $date_jan17)->where('admin_id',$this->admin_id)->first();
            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date_jan17)->format('Y-m-d');
                $new_holiday->description = "Independence Day (July 4)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'july4';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-07-04';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }
        

        if (isset($request->sep_5)) {
            $date_jan17 = Carbon::now()->format('Y') . '-09-05';
            $check_jan1 = holiday_setup::where('holiday_date', $date_jan17)->where('admin_id',$this->admin_id)->first();
            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date_jan17)->format('Y-m-d');
                $new_holiday->description = "Labor Day (September 5)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'sep5';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-09-05';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }

        if (isset($request->oct_10)) {
            $date_jan17 = Carbon::now()->format('Y') . '-10-10';
            $check_jan1 = holiday_setup::where('holiday_date', $date_jan17)->where('admin_id',$this->admin_id)->first();
            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date_jan17)->where('admin_id',$this->admin_id)->format('Y-m-d');
                $new_holiday->description = "Columbus Day (October 10)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'oct10';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-10-10';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }

        if (isset($request->nov_11)) {
            $date_jan17 = Carbon::now()->format('Y') . '-11-11';
            $check_jan1 = holiday_setup::where('holiday_date', $date_jan17)->where('admin_id',$this->admin_id)->first();
            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date_jan17)->format('Y-m-d');
                $new_holiday->description = "Veterans Day (November 11)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'nov11';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-11-11';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }

        if (isset($request->nov_24)) {
            $date_jan17 = Carbon::now()->format('Y') . '-11-24';
            $check_jan1 = holiday_setup::where('holiday_date', $date_jan17)->where('admin_id',$this->admin_id)->first();
            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date_jan17)->format('Y-m-d');
                $new_holiday->description = "Thanksgiving (November 24)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'nov24';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-11-24';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }

        if (isset($request->dec_25)) {
            $date_jan17 = Carbon::now()->format('Y') . '-12-25';
            $check_jan1 = holiday_setup::where('holiday_date', $date_jan17)->where('admin_id',$this->admin_id)->first();
            if (!$check_jan1) {
                $new_holiday = new holiday_setup();
                $new_holiday->admin_id = $this->admin_id;
                $new_holiday->holiday_date = Carbon::parse($date_jan17)->format('Y-m-d');
                $new_holiday->description = "Christmas Day (December 25)";
                $new_holiday->is_fed = 1;
                $new_holiday->holiday_name = 'dec25';
                $new_holiday->save();
            }
        }
        else {
            $date = Carbon::now()->format('Y') . '-12-25';
            $holi = holiday_setup::where('holiday_date', $date)->where('admin_id',$this->admin_id)->first();
            if($holi){
                $holi->delete();
            }
        }

        return back()->with('success', 'Holiday Created Successfully');

    }


    public function pay_period()
    {
        return view('superadmin.settingOtherSetup.payPeriod');
    }

    public function pay_period_fetch(Request $request){
        $admin_id=$this->admin_id;
        
        $query = "SELECT * FROM pay_periods WHERE admin_id=$admin_id";
        $query_exe = DB::select($query);
        
        $statements = $this->arrayPaginatorPeriod($query_exe, $request);
        return response()->json([
            'notices' => $statements,
            'status' => 'success',
            'view' => View::make('superadmin.settingOtherSetup.include.payPeriodTable', compact('statements'))->render(),
            'pagination' => (string)$statements->links()
        ]);
    }

    public function pay_period_fetch_filter(Request $request){
        $admin_id=$this->admin_id;
        
        $query = "SELECT * FROM pay_periods WHERE admin_id=$admin_id";
        $query_exe = DB::select($query);
        
        $statements = $this->arrayPaginatorPeriod($query_exe, $request);
        return response()->json([
            'notices' => $statements,
            'status' => 'success',
            'view' => View::make('superadmin.settingOtherSetup.include.payPeriodTable', compact('statements'))->render(),
            'pagination' => (string)$statements->links()
        ]);
    }

    public function arrayPaginatorPeriod($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 15;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }

    public function pay_period_save(Request $request)
    {



        if ($request->period_length == 1) {
            $start_date = Carbon::parse($request->year . '-01-01')->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            $start = new \DateTime($start_date);
            $end = new \DateTime($end_date);


            while ($start <= $end) {
                $time_stamp = strtotime($start->format('Y-m-d\TH:i:s.z\Z'));

                $date_time_data = date('Y-m-d', $time_stamp);

                $week = date('l', $time_stamp);


                // if ($week == $request->check_date) {
                //     $c_d=Carbon::createFromFormat('Y-m-d',$date_time_data)->addWeeks(1)->format('Y-m-d');
                //     $check_date_day = $c_d;
                // } else {
                //     $check_date_day = null;
                // }

                $last_end_date = Carbon::parse($date_time_data)->addDays(6)->format('Y-m-d');


                if ($end_date <= $date_time_data) {
                    return back()->with('success', 'Pay Period Successfully Created');
                    exit();
                }

                if ($last_end_date <= $end_date) {

                    if ($week == $request->week_day_name) {
                        $check_date=$this->check_date(Carbon::parse($last_end_date)->format('Y-m-d'),$request->check_date);
                        $s_date=Carbon::parse($date_time_data)->addDays(1)->format('Y-m-d');
                        $new_pay_period = new pay_period();
                        $new_pay_period->admin_id = $this->admin_id;
                        $new_pay_period->period_length = $request->period_length;
                        $new_pay_period->year = $request->year;
                        $new_pay_period->start_date = $s_date;
                        $new_pay_period->end_date = $last_end_date;
                        $new_pay_period->show_start_date = date('m/d/Y', $time_stamp);
                        $new_pay_period->show_end_date = Carbon::parse($date_time_data)->addDays(6)->format('m/d/Y');
                        $new_pay_period->check_date = $check_date;
                        $new_pay_period->time_sheet = $request->time_sheet;
                        if ($request->time_sheet >= 1) {
                            $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->addDays($request->time_sheet)->format('Y-m-d');
                        } else {
                            $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->format('Y-m-d');
                        }
                        $new_pay_period->week_day_name = $week;
                        $new_pay_period->save();


                        $start->modify('+1 day');
                    } else {
                        $start->modify('+1 day');
                    }


                } else {
                    $start->modify('+1 day');
                }
            }

            return back()->with('success', 'Pay Period Successfully Created');

        } elseif ($request->period_length == 2) {
            $start_date = Carbon::parse($request->year . '-01-01')->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            $start = new \DateTime($start_date);
            $end = new \DateTime($end_date);
            while ($start <= $end) {
                $time_stamp = strtotime($start->format('Y-m-d\TH:i:s.z\Z'));

                $day = date("d", $time_stamp);

                $week = date('l', $time_stamp);

                $date_time_data = date('Y-m-d', $time_stamp);
                $last_end_date = Carbon::parse($date_time_data)->addDays(14)->format('Y-m-d');


                // if ($week == $request->check_date) {
                //     $check_date_day = $date_time_data;
                // } else {
                //     $check_date_day = null;
                // }

                if ($end_date <= $date_time_data) {
                    return back()->with('success', 'Pay Period Successfully Created');
                    exit();
                }



                if ($day == 01) {
                    $s_date=$this->first_date($date_time_data,$request->week_day_name);
                    $check_date=$this->check_date(Carbon::parse($last_end_date)->format('Y-m-d'),$request->check_date);
                    $new_pay_period = new pay_period();
                    $new_pay_period->admin_id = $this->admin_id;
                    $new_pay_period->period_length = $request->period_length;
                    $new_pay_period->year = $request->year;
                    $new_pay_period->start_date = $s_date;
                    $new_pay_period->end_date = $last_end_date;
                    $new_pay_period->show_start_date = date('m/d/Y', $time_stamp);
                    $new_pay_period->show_end_date = Carbon::parse($date_time_data)->addDays(14)->format('m/d/Y');
                    $new_pay_period->check_date = $check_date;
                    $new_pay_period->time_sheet = $request->time_sheet;
                    if ($request->time_sheet >= 1) {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->addDays($request->time_sheet)->format('Y-m-d');
                    } else {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->format('Y-m-d');
                    }
                    $new_pay_period->week_day_name = $request->week_day_name;
                    $new_pay_period->save();

                    $start->modify('+14 day');
                } elseif ($day == 15) {

                    $date_time_data_1 = date('Y-m-d', $time_stamp);

                    $last_date_mon1 = new \DateTime($date_time_data_1);
                    $last_date_mon1->modify('last day of this month');
                    $last_date_mon2 = $last_date_mon1->format('Y-m-d');

                    $check_last_day_exists = pay_period::where('start_date', $date_time_data_1)
                        ->where('end_date', $last_date_mon2)
                        ->where('admin_id', $this->admin_id)->first();
                    $check_date=$this->check_date(Carbon::parse($last_date_mon2)->format('Y-m-d'),$request->check_date);

                    $s_date=$this->first_date($date_time_data_1,$request->week_day_name);


                    $new_pay_period = new pay_period();
                    $new_pay_period->admin_id = $this->admin_id;
                    $new_pay_period->period_length = $request->period_length;
                    $new_pay_period->year = $request->year;
                    $new_pay_period->start_date = $s_date;
                    $new_pay_period->end_date = $last_date_mon2;
                    $new_pay_period->show_start_date = date('m/d/Y', $time_stamp);
                    $new_pay_period->show_end_date = Carbon::parse($last_date_mon2)->format('m/d/Y');
                    $new_pay_period->check_date = $check_date;
                    $new_pay_period->time_sheet = $request->time_sheet;
                    if ($request->time_sheet >= 1) {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_date_mon2)->addDays($request->time_sheet)->format('Y-m-d');
                    } else {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_date_mon2)->format('Y-m-d');
                    }
                    $new_pay_period->week_day_name = $request->week_day_name;
                    $new_pay_period->save();


                    $start->modify('+1 day');
                } else {
                    $start->modify('+1 day');
                }
            }
            return back()->with('success', 'Pay Period Successfully Created');

        } elseif ($request->period_length == 3) {
            $start_date = Carbon::parse($request->year . '-01-01')->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            $start = new \DateTime($start_date);
            $end = new \DateTime($end_date);
            while ($start <= $end) {
                $time_stamp = strtotime($start->format('Y-m-d\TH:i:s.z\Z'));

                $date_time_data_3 = date('Y-m-d', $time_stamp);
                $week = date('l', $time_stamp);

                // if ($week == $request->check_date) {
                //     $check_date_day = $date_time_data_3;
                // } else {
                //     $check_date_day = null;
                // }

                if ($end_date <= $date_time_data_3) {
                    return back()->with('success', 'Pay Period Successfully Created');
                    exit();
                }
                $first_date = new \DateTime($date_time_data_3);
                $first_date->modify('first day of this month');
                $first_date_get = $first_date->format('Y-m-d');

                $last_date = new \DateTime($date_time_data_3);
                $last_date->modify('last day of this month');
                $last_date_get = $last_date->format('Y-m-d');

                $check_last_day_exists = pay_period::where('start_date', $first_date_get)
                    ->where('end_date', $last_date_get)
                    ->where('admin_id', $this->admin_id)->first();
                $check_date=$this->check_date(Carbon::parse($last_date_get)->format('Y-m-d'),$request->check_date);
                $s_date=$this->first_date($first_date_get,$request->week_day_name);

                $new_pay_period = new pay_period();
                $new_pay_period->admin_id = $this->admin_id;
                $new_pay_period->period_length = $request->period_length;
                $new_pay_period->year = $request->year;
                $new_pay_period->start_date = $s_date;
                $new_pay_period->end_date = $last_date_get;
                $new_pay_period->show_start_date = Carbon::parse($first_date_get)->format('m/d/Y');
                $new_pay_period->show_end_date = Carbon::parse($last_date_get)->format('m/d/Y');
                $new_pay_period->check_date = $check_date;
                $new_pay_period->time_sheet = $request->time_sheet;
                if ($request->time_sheet >= 1) {
                    $new_pay_period->time_sheet_date = Carbon::parse($last_date_get)->addDays($request->time_sheet)->format('Y-m-d');
                } else {
                    $new_pay_period->time_sheet_date = Carbon::parse($last_date_get)->format('Y-m-d');
                }
                $new_pay_period->week_day_name = $request->week_day_name;
                $new_pay_period->save();

                $start->modify('+1 month');
            }
            return back()->with('success', 'Pay Period Successfully Created');

        }
        elseif ($request->period_length == 4) {
            $start_date = Carbon::parse($request->year . '-01-01')->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            $start = new \DateTime($start_date);
            $end = new \DateTime($end_date);


            while ($start <= $end) {
                $time_stamp = strtotime($start->format('Y-m-d\TH:i:s.z\Z'));

                $date_time_data = date('Y-m-d', $time_stamp);

                $week = date('l', $time_stamp);

                if ($week == $request->week_day_name) {


                    $last_end_date = Carbon::parse($date_time_data)->addDays(14)->format('Y-m-d');
                    $last_end_date_new = Carbon::parse($date_time_data)->addDays(15)->format('Y-m-d');
                    $start_new = new \DateTime($last_end_date_new);
                    $time_stamp_new = strtotime($start_new->format('Y-m-d\TH:i:s.z\Z'));
                    $week_new = date('l', $time_stamp_new);


                    // if ($week == $request->check_date) {
                    //     $c_d=Carbon::createFromFormat('Y-m-d',$date_time_data)->addWeeks(2)->format('Y-m-d');
                    //     $check_date_day = $c_d;
                    // } else {
                    //     $check_date_day = null;
                    // }


                    if ($end_date <= $date_time_data) {
                        return back()->with('success', 'Pay Period Successfully Created');
                        exit();
                    }

                    if ($last_end_date <= $end_date) {
                        if ($week == $request->week_day_name) {

                            $check_date=$this->check_date(Carbon::parse($last_end_date)->subDay(1)->format('Y-m-d'),$request->check_date);

                            $new_pay_period = new pay_period();
                            $new_pay_period->admin_id = $this->admin_id;
                            $new_pay_period->period_length = $request->period_length;
                            $new_pay_period->year = $request->year;
                            $new_pay_period->start_date = $date_time_data;
                            $new_pay_period->end_date = Carbon::parse($last_end_date)->subDay(1)->format('Y-m-d');
                            $new_pay_period->show_start_date = date('m/d/Y', $time_stamp);
                            $new_pay_period->show_end_date = Carbon::parse($date_time_data)->addDays(6)->format('m/d/Y');
                            $new_pay_period->check_date = $check_date;
                            $new_pay_period->time_sheet = $request->time_sheet;
                            if ($request->time_sheet >= 1) {
                                $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->addDays($request->time_sheet - 1)->format('Y-m-d');
                            } else {
                                $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->subDay(1)->format('Y-m-d');
                            }
                            $new_pay_period->week_day_name = $week;
                            $new_pay_period->save();

                            $start->modify('+14 day');
                        } elseif ($week_new == $request->week_day_name) {
                            $check_date=$this->check_date(Carbon::parse($last_end_date)->subDay(1)->format('Y-m-d'),$request->check_date);

                            $new_pay_period = new pay_period();
                            $new_pay_period->admin_id = $this->admin_id;
                            $new_pay_period->period_length = $request->period_length;
                            $new_pay_period->year = $request->year;
                            $new_pay_period->start_date = $date_time_data;
                            $new_pay_period->end_date = Carbon::parse($last_end_date)->subDay(1)->format('Y-m-d');
                            $new_pay_period->show_start_date = date('m/d/Y', $time_stamp);
                            $new_pay_period->show_end_date = Carbon::parse($date_time_data)->addDays(6)->format('m/d/Y');
                            $new_pay_period->check_date = $check_date;
                            $new_pay_period->time_sheet = $request->time_sheet;
                            if ($request->time_sheet >= 1) {
                                $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->addDays($request->time_sheet - 1)->format('Y-m-d');
                            } else {
                                $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->subDay(1)->format('Y-m-d');
                            }
                            $new_pay_period->week_day_name = $request->week_day_name;
                            $new_pay_period->save();

                            $start->modify('+14 day');
                        } else {
                            $start->modify('+14 day');
                        }


                    } else {
                        $start->modify('+14 day');
                    }
                } else {
                    $start->modify('+1 day');
                }
            }

            return back()->with('success', 'Pay Period Successfully Created');
        }
        elseif ($request->period_length == 5) {
            $start_date = Carbon::parse($request->year . '-01-01')->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            $start = new \DateTime($start_date);
            $end = new \DateTime($end_date);

            while ($start <= $end) {
                $time_stamp = strtotime($start->format('Y-m-d\TH:i:s.z\Z'));

                $day = date("d", $time_stamp);

                $date_time_data = date('Y-m-d', $time_stamp);
                $last_end_date = Carbon::parse($date_time_data)->addDays(14)->format('Y-m-d');

                if ($end_date <= $date_time_data) {
                    return back()->with('success', 'Pay Period Successfully Created');
                    exit();
                }


                if ($day == 05) {
                    $check_date=$this->check_date(Carbon::parse($last_end_date)->format('Y-m-d'),$request->check_date);

                    $s_date=$this->first_date($date_time_data,$request->week_day_name);

                    $new_pay_period = new pay_period();
                    $new_pay_period->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
                    $new_pay_period->period_length = $request->period_length;
                    $new_pay_period->year = $request->year;
                    $new_pay_period->start_date = $s_date;
                    $new_pay_period->end_date = $last_end_date;
                    $new_pay_period->show_start_date = date('m/d/Y', $time_stamp);
                    $new_pay_period->show_end_date = Carbon::parse($date_time_data)->addDays(14)->format('Y-m-d');
                    $new_pay_period->check_date = $check_date;
                    $new_pay_period->time_sheet = $request->time_sheet;
                    if ($request->time_sheet > 1) {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->addDays($request->time_sheet)->format('Y-m-d');
                    } else {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->format('Y-m-d');
                    }
                    $new_pay_period->week_day_name = $request->week_day_name;
                    $new_pay_period->save();
                    $start->modify('+14 day');
                } elseif ($day == 20) {

                    $date_time_data_1 = date('Y-m-d', $time_stamp);

                    $last_date_mon1 = new \DateTime($date_time_data_1);
                    $last_date_mon1->modify('last day of this month');
                    $last_date_mon2 = $last_date_mon1->format('Y-m-d');

                    $check_date=$this->check_date(Carbon::parse($last_date_mon2)->format('Y-m-d'),$request->check_date);

                    $s_date=$this->first_date($date_time_data,$request->week_day_name);


                    $new_pay_period = new pay_period();
                    $new_pay_period->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
                    $new_pay_period->period_length = $request->period_length;
                    $new_pay_period->year = $request->year;
                    $new_pay_period->start_date = $s_date;
                    $new_pay_period->end_date = $last_date_mon2;
                    $new_pay_period->show_start_date = date('m/d/Y', $time_stamp);
                    $new_pay_period->show_end_date = Carbon::parse($last_date_mon2)->format('m/d/Y');
                    $new_pay_period->check_date = $check_date;
                    $new_pay_period->time_sheet = $request->time_sheet;
                    if ($request->time_sheet > 1) {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_date_mon2)->addDays($request->time_sheet)->format('Y-m-d');
                    } else {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_date_mon2)->format('Y-m-d');
                    }
                    $new_pay_period->week_day_name = $request->week_day_name;
                    $new_pay_period->save();
                    $start->modify('+1 day');
                } else {
                    $start->modify('+1 day');
                }
            }

            return back()->with('success', 'Pay Period Successfully Created');
        }
        elseif ($request->period_length == 6) {
            $start_date = Carbon::parse($request->year . '-01-01')->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            $start = new \DateTime($start_date);
            $end = new \DateTime($end_date);

            while ($start <= $end) {
                $time_stamp = strtotime($start->format('Y-m-d\TH:i:s.z\Z'));

                $day = date("d", $time_stamp);

                $date_time_data = date('Y-m-d', $time_stamp);
                $last_end_date = Carbon::parse($date_time_data)->addDays(14)->format('Y-m-d');

                if ($end_date <= $date_time_data) {
                    return back()->with('success', 'Pay Period Successfully Created');
                    exit();
                }


                if ($day == 15) {

                    $check_date=$this->check_date(Carbon::parse($last_end_date)->format('Y-m-d'),$request->check_date);

                    $s_date=$this->first_date($date_time_data,$request->week_day_name);
                    $new_pay_period = new pay_period();
                    $new_pay_period->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
                    $new_pay_period->period_length = $request->period_length;
                    $new_pay_period->year = $request->year;
                    $new_pay_period->start_date = $s_date;
                    $new_pay_period->end_date = $last_end_date;
                    $new_pay_period->show_start_date = date('m/d/Y', $time_stamp);
                    $new_pay_period->show_end_date = Carbon::parse($date_time_data)->addDays(14)->format('Y-m-d');
                    $new_pay_period->check_date = $check_date;
                    $new_pay_period->time_sheet = $request->time_sheet;
                    if ($request->time_sheet > 1) {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->addDays($request->time_sheet)->format('Y-m-d');
                    } else {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_end_date)->format('Y-m-d');
                    }
                    $new_pay_period->week_day_name = $request->week_day_name;
                    $new_pay_period->save();
                    $start->modify('+15 day');
                } elseif ($day == 30) {

                    $date_time_data_1 = date('Y-m-d', $time_stamp);

                    $last_date_mon1 = new \DateTime($date_time_data_1);
                    $last_date_mon1->modify('last day of this month');
                    $last_date_mon2 = $last_date_mon1->format('Y-m-d');

                    $check_date=$this->check_date(Carbon::parse($last_date_mon2)->format('Y-m-d'),$request->check_date);

                    $s_date=$this->first_date($date_time_data,$request->week_day_name);

                    $new_pay_period = new pay_period();
                    $new_pay_period->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
                    $new_pay_period->period_length = $request->period_length;
                    $new_pay_period->year = $request->year;
                    $new_pay_period->start_date = $s_date;
                    $new_pay_period->end_date = $last_date_mon2;
                    $new_pay_period->show_start_date = date('m/d/Y', $time_stamp);
                    $new_pay_period->show_end_date = Carbon::parse($last_date_mon2)->format('m/d/Y');
                    $new_pay_period->check_date = $check_date;
                    $new_pay_period->time_sheet = $request->time_sheet;
                    if ($request->time_sheet > 1) {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_date_mon2)->addDays($request->time_sheet)->format('Y-m-d');
                    } else {
                        $new_pay_period->time_sheet_date = Carbon::parse($last_date_mon2)->format('Y-m-d');
                    }
                    $new_pay_period->week_day_name = $request->week_day_name;
                    $new_pay_period->save();
                    $start->modify('+1 day');
                } else {
                    $start->modify('+1 day');
                }
            }

            return back()->with('success', 'Pay Period Successfully Created');
        }
    }

    public function check_date($last_date,$check_day){
        $start = new \DateTime($last_date);
        $start->modify('+1 day');
        $end = new \DateTime(Carbon::parse($last_date)->addDays(8)->format('Y-m-d'));
        $result='';
        while($start<=$end){
            $time_stamp = strtotime($start->format('Y-m-d\TH:i:s.z\Z'));
            $week = date('l', $time_stamp);
            if($week==$check_day){
                $result=date('Y-m-d',$time_stamp);
                break;
            }

            $start->modify('+1 day');
        }

        return $result;

    }

    public function first_date($start_date,$week_day){
        $start = new \DateTime($start_date);
        $end = new \DateTime(Carbon::parse($start_date)->addDays(7)->format('Y-m-d'));
        $result='';
        while($start<=$end){
            $time_stamp = strtotime($start->format('Y-m-d\TH:i:s.z\Z'));
            $week = date('l', $time_stamp);
            if($week==$week_day){
                $result=date('Y-m-d',$time_stamp);
                break;
            }

            $start->modify('+1 day');
        }

        return $result;
    }

    public function pay_period_update(Request $request)
    {
        $ts_date = Carbon::parse($request->end_date)->addDays($request->time_sheet)->format('Y-m-d');
        $update_pay_period = pay_period::where('id', $request->period_edit)->first();
        $update_pay_period->start_date = $request->start_date;
        $update_pay_period->end_date = $request->end_date;
        $update_pay_period->check_date = $request->check_date;
        $update_pay_period->time_sheet = $request->time_sheet;
        $update_pay_period->time_sheet_date = $ts_date;
        $update_pay_period->save();
        return back()->with('success', 'Pay Period Successfully Updated');
    }

    public function pay_period_delete($id)
    {
        $delete_pay_period = pay_period::where('id', $id)->first();

        $delete_pay_period->delete();
        return back()->with('success', 'Pay Period Successfully Deleted');
    }

    public function pay_period_delete_bulk(Request $request)
    {

        $arr = explode(',', $request->ids);
        $delete_pay_period = pay_period::whereIn('id', $arr)->delete();
        return back()->with('success', 'Pay Periods Successfully Deleted');
    }


    public function sub_activity_setup()
    {
        $all_service = setting_service::where('admin_id', $this->admin_id)->get();
        $admin_all_sub_acts = all_sub_activity::where('admin_id', $this->admin_id)->paginate(10);
        $facility_treatment = Treatment_facility::where('admin_id', $this->admin_id)->get();
        return view('superadmin.settingOtherSetup.subActivitySetup', compact('admin_all_sub_acts', 'facility_treatment', 'all_service'));
    }


    public function sub_activity_treatment_billable_type(Request $request)
    {
        $sub_act_bill_type = setting_service::distinct()->select('type')->where('facility_treatment_id', $request->tret_id)->orderBy('description','asc')->get();
        return response()->json($sub_act_bill_type, 200);
    }

    public function sub_activity_treatment_service_get(Request $request)
    {
        $all_service_get = setting_service::where('facility_treatment_id', $request->tret_id)->where('type', $request->bill_id)->orderBy('description','asc')->get();
        return response()->json($all_service_get, 200);
    }


    public function sub_activity_setup_save(Request $request)
    {

        $check = all_sub_activity::where('service_id',$request->service_id)->where('facility_treatment_id',$request->treatment_type)->where('admin_id',$this->admin_id)->where('sub_activity',$request->new_desc)->first();
        if(!$check){
            $new_sub_act = new all_sub_activity();
            $new_sub_act->admin_id = $this->admin_id;
            $new_sub_act->is_billable = $request->is_billbale;
            $new_sub_act->facility_treatment_id = $request->treatment_type;
            $new_sub_act->service_id = $request->service_id;
            $new_sub_act->sub_activity = $request->sub_activity;
            $new_sub_act->is_active = 1;
            $new_sub_act->sub_activity = $request->new_desc;
            $new_sub_act->save();
            return "done";
        }
        else{
            return "already";
        }
    }

    public function sub_activity_get_data(Request $request)
    {
        $tret_id = $request->tret_id;
        $bill_type = $request->bill_type;
        $ser_id = $request->ser_id;


        $admin_id = $this->admin_id;
        $sub_admins = SuperAdmin::assign_admins(Auth::user()->id);

        $query = "SELECT * FROM all_sub_activities WHERE admin_id IS NOT NULL ";
        $query .= "AND admin_id=$admin_id ";

        $query .= "AND facility_treatment_id=$tret_id ";
        $query .= "AND service_id=$ser_id ";

        $query .= "ORDER BY id DESC; ";
        $query_exe = DB::select($query);


        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.settingOtherSetup.include.subActivitytable', compact('query_exe'))->render(),
        ]);
    }


    public function sub_activity_single(Request $request)
    {
        $admin_single_sub_act = all_sub_activity::where('admin_id', $this->admin_id)->where('id', $request->id)->first();

        return response()->json($admin_single_sub_act, 200);
    }

    public function sub_activity_single_update(Request $request)
    {
        $single_act_update = all_sub_activity::where('id', $request->edi_id)->where('admin_id', $this->admin_id)->first();

        if ($single_act_update) {
            $single_act_update->sub_activity = $request->desc;
            $single_act_update->is_active = $request->is_active;
            $single_act_update->hide_client_calender = $request->hide_cal;
            $single_act_update->save();
            return response()->json($single_act_update, 200);
        }
    }


    public function sub_activity_single_delete(Request $request)
    {
        $single_act_delete = all_sub_activity::where('id', $request->id)->where('admin_id', $this->admin_id)->first();
        if ($single_act_delete) {
            $check = \App\Models\Client_authorization_activity::select('id','admin_id','activity_two')->where('activity_two',$single_act_delete->sub_activity)->where('admin_id',$this->admin_id)->first();
            if($check){
                return "already";
            }
            else{
                $single_act_delete->delete();
            }
            return "done";
        } else {
            return "error";
        }
    }

    public function sub_activity_change_status(Request $request){
        $id = $request->id;
        $status = $request->status;
        $data = all_sub_activity::where('id', $id)->where('admin_id', $this->admin_id)->first();
        $data->is_active = $status;
        $data->save();

        echo "done";
    }

    public function adp_code()
    {
        return view('superadmin.settingOtherSetup.adpCode');
    }

    public function session_rule()
    {
        $check_rules = service_rule::select('admin_id')->where('admin_id', $this->admin_id)->count();

        if ($check_rules <= 0) {
            $all_rules = all_service_rule::all();
            foreach ($all_rules as $rules) {
                $new_rules = new service_rule();
                $new_rules->admin_id = $this->admin_id;
                $new_rules->rule_id = $rules->id;
                $new_rules->rule_name = $rules->rule_name;
                $new_rules->rule_description = $rules->rule_description;
                $new_rules->is_active = 0;
                $new_rules->prevent_session = 0;
                $new_rules->save();
            }
        }

        $get_rules = service_rule::where('admin_id', $this->admin_id)->get();

        return view('superadmin.settingOtherSetup.sessionRule', compact('get_rules'));
    }


    public function session_rule_update(Request $request)
    {
        $data = $request->all();


        if (isset($data['ids'])) {
            for ($i = 0; $i < count($data['ids']); $i++) {
                $update_servie_act = service_rule::select('id', 'is_active', 'prevent_session')->where('id', $data['ids'][$i])
                    ->where('admin_id', $this->admin_id)
                    ->first();
                $update_servie_act->is_active = isset($data['actives'][$i]) ? $data['actives'][$i] : 0;
                $update_servie_act->prevent_session = isset($data['prevents'][$i]) ? $data['prevents'][$i] : 0;
                $update_servie_act->save();
            }
        }


        //        return back()->with('success', 'Service Rules Updated Successfully');
        return response()->json('done', 200);
    }

    public function employee_setup()
    {
        return view('superadmin.settingOtherSetup.employeeSetup');
    }


    public function hr_note_type()
    {
        return view('superadmin.settingOtherSetup.hrNoteType');
    }

    public function employee_position()
    {
        return view('superadmin.settingOtherSetup.employeePosition');
    }

    public function game_goal()
    {
        return view('superadmin.settingOtherSetup.gameGoal');
    }


    public function game_goal_copay()
    {
        return view('superadmin.settingOtherSetup.gameGoalCopay');
    }


    public function user_setup()
    {
        return view('superadmin.settingOtherSetup.userSetup');
    }


    public function user_setup_get_user(Request $request)
    {
        $user_type = $request->user_type;
        $user_name = $request->user_name;
        $user_email = $request->user_email;


        $admin_id = $this->admin_id;

        if ($user_type == 1) {
            $query = "SELECT * FROM clients WHERE admin_id=$admin_id ";

            if (isset($user_name)) {
                $query .= "AND email LIKE '%$user_email%' ";
            }

            if (isset($user_name)) {
                $query .= "AND client_full_name LIKE '%$user_name%' ";
            }

            $query_exe = DB::select($query);
            $users = $this->arrayPaginator($query_exe, $request);


            return response()->json([
                'notices' => $users,
                'view' => View::make('superadmin.settingOtherSetup.include.userSetupTable', compact('users'))->render(),
                'pagination' => (string)$users->links()
            ]);
        } elseif ($user_type == 2) {
            $query = "SELECT * FROM employees WHERE admin_id=$admin_id ";

            if (isset($user_name)) {
                $query .= "AND office_email LIKE '%$user_email%' ";
            }

            if (isset($user_name)) {
                $query .= "AND full_name LIKE '%$user_name%' ";
            }
            $query_exe = DB::select($query);
            $users = $this->arrayPaginator($query_exe, $request);
            return response()->json([
                'notices' => $users,
                'view' => View::make('superadmin.settingOtherSetup.include.userSetupStaffTable', compact('users'))->render(),
                'pagination' => (string)$users->links()
            ]);
        }

    }


    public function user_setup_get_user_ge(Request $request)
    {
        $user_type = $request->user_type;
        $user_name = $request->user_name;
        $user_email = $request->user_email;


        $admin_id = $this->admin_id;

        if ($user_type == 1) {
            $query = "SELECT * FROM clients WHERE admin_id=$admin_id ";

            if (isset($user_name)) {
                $query .= "AND email LIKE '%$user_email%' ";
            }

            if (isset($user_name)) {
                $query .= "AND client_full_name LIKE '%$user_name%' ";
            }
            $query_exe = DB::select($query);
            $users = $this->arrayPaginator($query_exe, $request);
            return response()->json([
                'notices' => $users,
                'view' => View::make('superadmin.settingOtherSetup.include.userSetupTable', compact('users'))->render(),
                'pagination' => (string)$users->links()
            ]);
        } elseif ($user_type == 2) {
            $query = "SELECT * FROM employees WHERE admin_id=$admin_id ";

            if (isset($user_name)) {
                $query .= "AND office_email LIKE '%$user_email%' ";
            }

            if (isset($user_name)) {
                $query .= "AND full_name LIKE '%$user_name%' ";
            }
            $query_exe = DB::select($query);
            $users = $this->arrayPaginator($query_exe, $request);
            return response()->json([
                'notices' => $users,
                'view' => View::make('superadmin.settingOtherSetup.include.userSetupStaffTable', compact('users'))->render(),
                'pagination' => (string)$users->links()
            ]);
        }
    }


    public function documents()
    {
        return view('superadmin.settingDocuemts.documents');
    }

    public function notes_forms()
    {

        $notes_forms = note_form::where('admin_id', $this->admin_id)->get();

        return view('superadmin.settingDocuemts.notesFroms', compact('notes_forms'));
    }


    public function notes_forms_save(Request $request)
    {
        $new_note_form = new note_form();
        $new_note_form->admin_id = $this->admin_id;
        $new_note_form->template_name = $request->template_name;
        $new_note_form->template_type = $request->template_type;
        $new_note_form->display_name = $request->display_name;
        $new_note_form->question_type = $request->question_type;
        $new_note_form->question = $request->question;
        $new_note_form->answer = $request->answer;
        $new_note_form->answer_type = $request->answer_type;
        $new_note_form->save();

        return back()->with('success', 'Note Form Created Successfully');
    }


    public function template_library()
    {
        $template_library = template_library::all();

//        $libs = template_library::where('template_slug', null)->get();
//        foreach ($libs as $lib) {
//            $sing_lib = template_library::where('id', $lib->id)->first();
//            $sing_lib->template_slug = Str::slug($lib->template_name, '-');
//            $sing_lib->save();
//        }

        return view('superadmin.settingDocuemts.templateLibrary', compact('template_library'));
    }


    public function template_library_form(Request $request)
    {

        $id = $request->id;
        if ($id == 1) {
            return view('superadmin.settingDocuemts.template.uniqueSuperVisionForm');
        } elseif ($id == 2) {
            return view('superadmin.settingDocuemts.template.directServiceParentTrainingForm');
        } elseif ($id == 3) {
            return view('superadmin.settingDocuemts.template.bcbaTraineeSupervisionMonthlyForm');
        } elseif ($id == 4) {
            return view('superadmin.settingDocuemts.template.bcbaTraineeUniqueSupervisionForm');
        } elseif ($id == 5) {
            return view('superadmin.settingDocuemts.template.monthlySuperVisionForm');
        } elseif ($id == 6) {
            return view('superadmin.settingDocuemts.template.therapistSessionForm');
        } elseif ($id == 7) {
            return view('superadmin.settingDocuemts.template.clinicalTreatmentForm');
        } elseif ($id == 8) {
            return view('superadmin.settingDocuemts.template.treatmentPlan');
        } elseif ($id == 9) {
            return view('superadmin.settingDocuemts.template.privateClientForm');
        } elseif ($id == 10) {
            return view('superadmin.settingDocuemts.template.outpatientTreatmentForm');
        } elseif ($id == 11) {
            return view('superadmin.settingDocuemts.template.catalystNote');
        } elseif ($id == 12) {
            return view('superadmin.settingDocuemts.template.parentTraining');
        } elseif ($id == 13) {
            return view('superadmin.settingDocuemts.template.sessionNotes');
        } elseif ($id == 14) {
            return view('superadmin.settingDocuemts.template.supervisionRegistered1');
        } elseif ($id == 15) {
            return view('superadmin.settingDocuemts.template.supervisionRegistered2');
        } elseif ($id == 16) {
            return view('superadmin.settingDocuemts.template.servicePlan');
        } elseif ($id == 17) {
            return view('superadmin.settingDocuemts.template.cpClinical');
        } elseif ($id == 18) {
            return view('superadmin.settingDocuemts.template.cpNotes');
        } elseif ($id == 19) {
            return view('superadmin.settingDocuemts.template.cpSoap');
        } elseif ($id == 20) {
            return view('superadmin.settingDocuemts.template.gsAssessment');
        } elseif ($id == 21) {
            return view('superadmin.settingDocuemts.template.gsParentTraining');
        } elseif ($id == 22) {
            return view('superadmin.settingDocuemts.template.gsSupervision');
        } elseif ($id == 23) {
            return view('superadmin.settingDocuemts.template.gsTreatment');
        } elseif ($id == 24) {
            return view('superadmin.settingDocuemts.template.biopsychosocial');
        } elseif ($id == 25) {
            return view('superadmin.settingDocuemts.template.birpProgress');
        } elseif ($id == 26) {
            return view('superadmin.settingDocuemts.template.dischargeSummary');
        } elseif ($id == 27) {
            return view('superadmin.settingDocuemts.template.languageProgress');
        } elseif ($id == 28) {
            return view('superadmin.settingDocuemts.template.languageSession');
        } elseif ($id == 29) {
            return view('superadmin.settingDocuemts.template.diagnosisSummary');
        } elseif ($id == 30) {
            return view('superadmin.settingDocuemts.template.dataSheet');
        } elseif ($id == 31) {
            return view('superadmin.settingDocuemts.template.cbhBehaviorAssessment');
        } elseif ($id == 32) {
            return view('superadmin.settingDocuemts.template.cbhBehaviorProgress');
        } elseif ($id == 33) {
            return view('superadmin.settingDocuemts.template.cbhServiceVerification');
        } elseif ($id == 34) {
            return view('superadmin.settingDocuemts.template.cbhCFARS');
        } elseif ($id == 35) {
            return view('superadmin.settingDocuemts.template.cbhDischargeSummary');
        } elseif ($id == 36) {
            return view('superadmin.settingDocuemts.template.cbhMedFlowsheet');
        } elseif ($id == 37) {
            return view('superadmin.settingDocuemts.template.cbhNoShow');
        } elseif ($id == 38) {
            return view('superadmin.settingDocuemts.template.cbhPCP');
        } elseif ($id == 39) {
            return view('superadmin.settingDocuemts.template.cbhLocusWorksheet');
        } elseif ($id == 40) {
            return view('superadmin.settingDocuemts.template.cbhReleaseInfo');
        } elseif ($id == 41) {
            return view('superadmin.settingDocuemts.template.cbhBiopsychosocial');
        } elseif ($id == 42) {
            return view('superadmin.settingDocuemts.template.cbhConsentTreat');
        } elseif ($id == 43) {
            return view('superadmin.settingDocuemts.template.cbhFARS');
        } elseif ($id == 44) {
            return view('superadmin.settingDocuemts.template.cbhMasterTreatment');
        } elseif ($id == 45) {
            return view('superadmin.settingDocuemts.template.cbhMedConsent');
        } elseif ($id == 46) {
            return view('superadmin.settingDocuemts.template.cbhMedManagement');
        } elseif ($id == 47) {
            return view('superadmin.settingDocuemts.template.cbhProgressNote');
        } elseif ($id == 48) {
            return view('superadmin.settingDocuemts.template.cbhPsychiatricEvaluation');
        } elseif ($id == 49) {
            return view('superadmin.settingDocuemts.template.cbhPsychiatricABA');
        } elseif ($id == 50) {
            return view('superadmin.settingDocuemts.template.cbhRiskAssessment');
        } elseif ($id == 51) {
            return view('superadmin.settingDocuemts.template.cbhLocusScore');
        } elseif ($id == 52) {
            return view('superadmin.settingDocuemts.template.cbhTreatmentPlan');
        } elseif ($id == 53) {
            return view('superadmin.settingDocuemts.template.cbhSafetyPlanning');
        } elseif ($id == 54) {
            return view('superadmin.settingDocuemts.template.cbhMentalHealth');
        } elseif ($id == 60) {
            return view('superadmin.settingDocuemts.template.supervisionAndAssessment');
        } elseif ($id == 61) {
            return view('superadmin.settingDocuemts.template.sessionNotesTwo');
        } else {
            return back()->with('alert', 'Template Not Found');
        }
    }


    public function template_library_apply($id)
    {
        $check_note_form = note_form::where('admin_id', $this->admin_id)->where('template_id', $id)->first();

        if ($check_note_form) {
            return back()->with('alert', 'Template Library Already Applied');
        } else {

            $template = template_library::where('id', $id)->first();

            if ($template) {
                $new_note_form = new note_form();
                $new_note_form->admin_id = $this->admin_id;
                $new_note_form->template_id = $template->id;
                $new_note_form->template_name = $template->template_name;
                $new_note_form->template_slug = $template->template_slug;
                $new_note_form->save();
                return back()->with('success', 'Template Library Successfully Applied');
            } else {
                return back()->with('alert', 'Template Library Not Found');
            }


        }
    }


    public function forms_builders()
    {
        $forms = note_form::where('admin_id', $this->admin_id)->where('html_data', '!=', null)->get();
        return view('superadmin.settingDocuemts.formBuilder', compact('forms'));
    }

    public function forms_builders_create()
    {
        return view('superadmin.settingDocuemts.formBuilderCreate');
    }

    public function forms_builders_template_edit($id)
    {

        $forms = note_form::where('id', $id)->first();
        $data = $forms->html_data;
        $title = $forms->template_name;
        $type = $forms->template_type;
        return view('superadmin.settingDocuemts.formBuilderEdit', compact('data', 'id', 'title', 'type'));
    }

    public function forms_builders_template_duplicate($id)
    {

        $forms = note_form::where('id', $id)->first();
        $data = $forms->html_data;
        $type = $forms->template_type;
        return view('superadmin.settingDocuemts.formBuilderDuplicate', compact('data', 'id', 'type'));
    }

    public function forms_builders_template_delete($id)
    {

        $forms = note_form::where('id', $id)->delete();
        return back()->with('success', 'Form template deleted successfully!');
    }

    public function forms_builders_save(Request $request)
    {
        $data = $request->formHtml;

        $check = note_form::where('template_name', $request->form_title)->get();

        if (count($check) > 0) {
            return 'title';
        } else {
            $new_tem = new note_form();
            $new_tem->admin_id = $this->admin_id;
            $new_tem->template_name = $request->form_title;
            $new_tem->template_type = $request->form_type;
            $new_tem->html_data = $data;
            $new_tem->save();
            return 'success';
        }

    }

    public function forms_builders_edit_save(Request $request)
    {
        $data = $request->formHtml;
        $id = $request->id;

        $check = note_form::where('template_name', $request->form_title)->where('id', '!=', $id)->get();

        if (count($check) > 0) {
            return 'title';
        } else {
            $new_tem = note_form::where('id', $id)->first();
            $new_tem->admin_id = $this->admin_id;
            $new_tem->template_name = $request->form_title;
            $new_tem->template_type = $request->form_type;
            $new_tem->html_data = $data;
            $new_tem->save();
            return 'success';
        }

    }

    public function forms_builders_duplicate_save(Request $request)
    {
        $data = $request->formHtml;
        $id = $request->id;

        $check = note_form::where('template_name', $request->form_title)->get();

        if (count($check) > 0) {
            return 'title';
        } else {
            $new_tem = new note_form();
            $new_tem->admin_id = $this->admin_id;
            $new_tem->template_name = $request->form_title;
            $new_tem->template_type = $request->form_type;
            $new_tem->html_data = $data;
            $new_tem->save();
            return 'success';
        }

    }


    public function forms_builders_save_data(Request $request)
    {

        $filled_form = $request->filled_form;
        $id = $request->form_id;
        $session_id = $request->session_id;
        // $data=note_form::where('id',$id)->first();

        $data = custom_form::where('form_id', $id)->where('admin_id', $this->admin_id)
            ->where('session_id', $session_id)->first();
        if (!$data) {
            $data = new custom_form();
        }

        if ($request->hasFile('updload_sign')) {
            $image = $request->file('updload_sign');
            $imageName = $this->admin_id . time() . uniqid() . '.' . "png";
            $directory = 'assets/dashboard/singnature/';
            $imgUrl1 = $directory . $imageName;
            Image::make($image)->save($imgUrl1);
            $data->signature = $imgUrl1;
        } else {
            if ($request->sing_draw && $request->sing_draw != null) {
                $name = $this->admin_id . time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw, 0, strpos($request->sing_draw, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw)->save($imgUrl2);
                $data->signature = $path3;
            }
        }

        if ($request->hasFile('updload_sign2')) {
            $image = $request->file('updload_sign2');
            $imageName = $this->admin_id . time() . uniqid() . '.' . "png";
            $directory = 'assets/dashboard/singnature/';
            $imgUrl1 = $directory . $imageName;
            Image::make($image)->save($imgUrl1);
            $data->signature2 = $imgUrl1;
        } else {
            if ($request->sing_draw2 && $request->sing_draw2 != null) {
                $name = $this->admin_id . time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw2, 0, strpos($request->sing_draw2, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw2)->save($imgUrl2);
                $data->signature2 = $path3;
            }
        }

        $data->admin_id = $this->admin_id;
        $data->session_id = $session_id;
        $data->form_id = $id;
        $data->filled_form = $filled_form;
        $data->save();

        $this->form_avail_save($request->session_id,$request->form_id);

        $res = array(

            "sign1" => $data->signature,
            "sign2" => $data->signature2
        );

        return json_encode($res);
    }


    public function forms_builders_template_view($id)
    {
        $forms = note_form::where('id', $id)->first();
        $data = $forms->html_data;
        $title = $forms->template_name;
        return view('superadmin.settingDocuemts.formBuilderTemplateView', compact('data', 'title'));
    }

    public function forms_builders_view($id)
    {
        $forms = note_form::where('id', $id)->first();
        $data = $forms->html_data;
        $sign1 = $forms->signature;
        $sign2 = $forms->signature2;
        return view('superadmin.settingDocuemts.formBuilderView', compact('data', 'sign1', 'sign2'));
    }


    public function bussiness_documents()
    {
        $bus_doc = bussiness_document::where('admin_id', $this->admin_id)->paginate(10);
        return view('superadmin.settingDocuemts.bussinessDocuments', compact('bus_doc'));
    }

    public function bussiness_documents_save(Request $request)
    {
        $new_bus_doc = new bussiness_document();

        if ($request->hasFile('file_name')) {
            $image = $request->file('file_name');
            $name = $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/documents/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $new_bus_doc->file_name = $imageUrl;
        }


        $new_bus_doc->admin_id = $this->admin_id;
        $new_bus_doc->description = $request->description;
        $new_bus_doc->uploadedon = Carbon::now()->format('Y-m-d');
        $new_bus_doc->upload_by = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $new_bus_doc->save();
        return back()->with('success', 'Business Document Successfully Created');
    }


    public function bussiness_documents_update(Request $request)
    {
        $new_bus_doc = bussiness_document::where('id', $request->edit_bus_doc)->first();

        if ($request->hasFile('file_name')) {
            $image = $request->file('file_name');
            $name = $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/documents/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $new_bus_doc->file_name = $imageUrl;
        }

        $new_bus_doc->description = $request->description;
        $new_bus_doc->upload_by = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $new_bus_doc->save();
        return back()->with('success', 'Business Document Successfully Updated');
    }


    public function bussiness_documents_delete($id)
    {
        $doc_delete = bussiness_document::where('id', $id)->first();
        if ($doc_delete) {
            $doc_delete->delete();
            return back()->with('success', 'Business Document Successfully Deleted');
        } else {
            return back()->with('alert', 'Business Document Not Found');
        }
    }

    public function subscription_information()
    {
        return view('superadmin.settingAccounts.subscriptionInformation');
    }

    public function subscription_information_billing()
    {
        return view('superadmin.settingAccounts.subscriptionInformationBilling');
    }


    public function notification()
    {
        return view('superadmin.settingAccounts.notification');
    }

    public function demo_data()
    {
        return view('superadmin.settingAccounts.demoData');
    }


    public function data_export()
    {
        return view('superadmin.settingAccounts.dataExport');
    }


    public function meet_list()
    {
        $meets = meet_link::where('admin_id', $this->admin_id)->paginate(10);
        return view('superadmin.settingAccounts.meetList', compact('meets'));
    }

    public function meet_create(Request $request)
    {
        $url = Str::random(20) . rand(0000, 8888) . $this->admin_id . time() . uniqid();
        $new_meet = new meet_link();
        $new_meet->admin_id = $this->admin_id;
        $new_meet->meet_full_url = "https://meet.therapypms.com/" . $url;
        $new_meet->meet_url = $url;
        $new_meet->is_end = 0;
        $new_meet->video_url = null;
        $new_meet->save();

        return back()->with(['success', 'Meet link created successfully', 'rows' => $new_meet]);

    }


    public function meet_session_start(Request $request)
    {
        $url = Str::random(20) . rand(0000, 8888) . $this->admin_id . time() . uniqid();
        $new_meet = new meet_link();
        $new_meet->admin_id = $this->admin_id;
        $new_meet->session_id = $request->ses_id;
        $new_meet->room_name = Auth::user()->name . "'s Room";
        $new_meet->meet_full_url = "https://meet.therapypms.com/?room=" . $url;
        $new_meet->meet_url = $url;
        $new_meet->is_end = 0;
        $new_meet->video_url = null;
        $new_meet->save();


        $ses = Appoinment::select('id', 'client_id')->where('id', $request->ses_id)->first();
        $client = Client::select('id', 'email')->where('id', $ses->client_id)->first();
        $fac = setting_name_location::select('id', 'admin_id', 'facility_name')->where('admin_id', $this->admin_id)->first();
        $to = $client->email;

        $msg = [
            'name' => $client->client_full_name,
            'facility' => $fac->facility_name,
            'url' => $new_meet->meet_full_url
        ];

        Mail::to($to)->send(new MeetMail($msg));

        return response()->json([
            'status' => 'success',
            'url' => "https://meet.therapypms.com/?room=" . $new_meet->meet_url
        ], 200);
    }

    // public function meet_session_link_mail(Request $request){
    //     $url=$request->url;
    //     $client_email=$request->client_email;
    //     Mail::to($client_email)->send(new sessionLinkInvitation($url));
    //     return "success";
    // }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


    // ------------------- all extra upload -------------------------------
    public function import_all_payor(Request $request)
    {


        $image = $request->file('csv_file');
        $name = $image->getClientOriginalName();
        $uploadPath = 'assets/dashboard/csvfiles/';
        $image->move($uploadPath, $name);
        $imageUrl = $uploadPath . $name;

        if ($request->hasFile('csv_file')) {
            $file_name = public_path($imageUrl);
            $users = (new FastExcel)->import($file_name, function ($line) {
                return Payor_facility_details::create([
                    'name' => $line['name'],
                    'ele_payor_id' => $line['ele_payor_id'],
                    'address' => $line['address'],
                    'city' => $line['city'],
                    'state' => $line['state'],
                    'zip' => $line['zip'],
                    'phone_one' => $line['phone_one'],
                    'phone_two' => $line['phone_two'],
                    'create_by' => Auth::user()->name,
                    'plain_medicare' => $line['plain_medicare'],
                    'plan_medicalid' => $line['plan_medicalid'],
                    'plan_campus' => $line['plan_campus'],
                    'plan_champva' => $line['plan_champva'],
                    'plan_group_health' => $line['plan_group_health'],
                    'plan_feca' => $line['plan_feca'],
                    'plan_others' => $line['plan_others'],
                ]);
            });
        }
    }


    public function save_forms(Request $request)
    {
        $forms = $request->forms;
        $type = $request->type;
        $check = 'done';

        foreach ($forms as $id) {
            $check_note_form = note_form::where('admin_id', $this->admin_id)->where('template_id', $id)->first();
            if ($check_note_form) {
                $check = "some_applied";
            } else {

                $template = template_library::where('id', $id)->first();

                if ($template) {
                    $new_note_form = new note_form();
                    $new_note_form->admin_id = $this->admin_id;
                    $new_note_form->template_id = $template->id;
                    $new_note_form->template_name = $template->template_name;
                    $new_note_form->template_slug = $template->template_slug;
                    $new_note_form->template_type = $template->template_type;
                    $new_note_form->save();
                } else {
                    $check = "some_not_found";
                }
            }
        }

        return $check;
    }

    public function available_forms(Request $request)
    {

        $libs = template_library::get();
        foreach ($libs as $lib) {
            $id = $lib->id;
            $type = $lib->template_type;
            $notes = note_form::where('template_id', $id)->get();
            foreach ($notes as $note) {
                $note->template_type = $type;
                $note->save();
            }
        }

        $type = $request->type;
        $all_forms = note_form::select('template_id')->where('template_type', $type)->where('template_id','!=',null)->where('admin_id', $this->admin_id)->get();

        $id_arr = array();
        foreach ($all_forms as $form_id) {
            $id_arr[] = $form_id->template_id;
        }

        $available = template_library::where('template_type', $type)->whereNotIn('id', $id_arr)->get();
        return response()->json($available);

    }

    public function assigned_forms(Request $request)
    {
        $type = $request->type;
        $all_forms = note_form::where('admin_id', $this->admin_id)->where('template_type', $type)->get();
        return response()->json($all_forms);
    }

    public function remove_forms(Request $request)
    {
        $forms = $request->forms;

        foreach ($forms as $id) {
            $check_note_form = note_form::where('admin_id', $this->admin_id)->where('template_id', $id)->first();
            $check_note_form->delete();
        }

        echo "done";
    }
}
