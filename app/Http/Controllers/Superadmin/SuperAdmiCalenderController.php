<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\GoogleService;
use App\Jobs\UpdateAllExistAppoinment;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Client_info;
use App\Models\Employee;
use App\Models\holiday_setup;
use App\Models\setting_name_location;
use App\Models\point_of_service;
use App\Models\setting_cpt_code;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SuperAdmiCalenderController extends Controller
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

    public function calender(Request $request)
    {
        $all_patients = Client::select('id', 'admin_id', 'client_full_name')->where('admin_id', $this->admin_id)->get();
        $all_provider = Employee::select('id', 'admin_id', 'full_name')->where('admin_id', $this->admin_id)->get();
        $poin_service = point_of_service::where('admin_id', $this->admin_id)->get();
        return view('superadmin.calender.calenderView', compact('all_patients', 'all_provider', 'poin_service'));
    }

    public function calender_submit(Request $request)
    {
        $select_date = $request->select_date;

        $f_date = substr($select_date, 0, 10);
        $l_date = substr($select_date, 13, 24);

        $f_n_date = Carbon::parse($f_date)->format('Y-m-d');
        $l_n_date = Carbon::parse($l_date)->format('Y-m-d');


        $appointments = appoinment::whereBetween('schedule_date', [$f_n_date, $l_n_date])
            ->with('provider')
            ->get();


        return view('superadmin.calender.calenderView', compact('appointments'));
    }


    public function calender_get_data(Request $request)
    {


        $get_start = $request->start;
        $get_end = $request->end;

        $mil = $get_start;
        $seconds = ceil($mil / 1000);

        $mil2 = $get_end;
        $seconds2 = ceil($mil2 / 1000);

        $data1 = date('Y-m-d', $seconds);
        $data2 = date('Y-m-d', $seconds2);

        $events = Appoinment::where('admin_id', $this->admin_id)
            ->where('schedule_date', '>=', $data1)
            ->where('schedule_date', '<=', $data2)
            ->get();

        //        $events = $eventQuery->get();
        $data = [];
        foreach ($events as $event) {


            //$client = Client::where('id',$event->client_id)->first();
            $pro_data = Employee::select('last_name', 'first_name', 'back_color', 'text_color')->where('id', $event->provider_id)->first();
            $client = Client::where('admin_id', $this->admin_id)->where('id', $event->client_id)->first();

            if ($client) {
                if ($pro_data) {
                    $pro_name = substr($pro_data->last_name, 0, 2) . ' ' . substr($pro_data->first_name, 0, 2) . ' : ';
                } else {
                    $pro_name = '';
                }
                $client_name = $pro_name . substr($client->client_last_name, 0, 2) . ' ' . substr($client->client_first_name, 0, 2);
            } else {
                if ($pro_data) {
                    $pro_name = substr($pro_data->last_name, 0, 2) . ' ' . substr($pro_data->first_name, 0, 2) . ' : ';
                } else {
                    $pro_name = '';
                }
                $client_name = $pro_name;
            }


            //            $event['start_time'] = date('g:iA', strtotime($event['from_time']));
            $event['start_time'] = date('g:iA', strtotime($event['start_time']));
            $event['end_time'] = date('g:iA', strtotime($event['to_time']));
            $event['title'] = $client_name;
            if ($event->location == '02' || $event->location == '10') {
                $event['icon'] = 'camera';
            } else {
                $event['icon'] = "none";
            }

            if ($pro_data) {
                if ($pro_data->back_color != null) {
                    $event['textColor'] = "#000";
                    $event['backgroundColor'] = $pro_data->back_color;
                    $event['display'] = "block";
                } else {
                    $event['textColor'] = "#000000";
                    $event['backgroundColor'] = "#E0EBF5";
                    $event['display'] = "block";
                }
            } else {
                $event['textColor'] = "#000000";
                $event['backgroundColor'] = "#E0EBF5";
                $event['display'] = "block";
                $event['date'] = $event;
            }


            if (!(int)$event['is_all_day']) {
                $event['allDay'] = false;
                $event['start'] = Carbon::createFromTimestamp(strtotime($event['from_time']))->toIso8601String();
                $event['end'] = Carbon::createFromTimestamp(strtotime($event['to_time']))->toIso8601String();
            } else {
                $event['allDay'] = true;
                $event['start'] = $event['from_time'] . "T" . "12:00:00";
                $event['end'] = $event['to_time'] . "T" . "23:59:00";

            }
            if (isset($event['from_time']) && !empty($event['to_time'])) {
                $event['cstm_deadline'] = $_date = date('Y-m-d', strtotime($event['to_time']));
            }


            $event['eventid'] = $event['id'];
            array_push($data, $event);
        }


        return response()->json($data);
    }


    public function calender_get_data_filter(Request $request)
    {

        $get_start = $request->start;
        $get_end = $request->end;

        $mil = $get_start;
        $seconds = ceil($mil / 1000);

        $mil2 = $get_end;
        $seconds2 = ceil($mil2 / 1000);

        $data1 = date('Y-m-d', $seconds);
        $data2 = date('Y-m-d', $seconds2);


        $client = $request->calender_filter_client;
        $employee = $request->calender_filter_employee;
        $location = $request->calender_filter_location;

        $date_range = $request->calender_filter_reportrange;
        $reportrange_one1 = Carbon::parse(substr($request->calender_filter_reportrange, 0, 10))->format('Y-m-d');
        $reportrange_one2 = Carbon::parse(substr($request->calender_filter_reportrange, 13, 24))->format('Y-m-d');


        $status = $request->calender_filter_status;
        $admin_id = $this->admin_id;

        $events = Appoinment::where('admin_id', $this->admin_id)
            ->where(function ($query) use ($client, $employee, $location, $status, $reportrange_one1, $reportrange_one2, $data1, $data2) {
                if (isset($client)) {
                    $query->whereIn('client_id', $client);
                }
                if (isset($location) && $location != null || $location != '') {
                    $query->where('location', $location);
                }

                if (isset($status) && $status != null || $status != "") {
                    $query->where('status', $status);
                }

                if (isset($employee) && $employee != null || $employee != '') {
                    $query->whereIn('provider_id', $employee);
                }

                if (isset($reportrange_one1) && !empty($reportrange_one2)) {
                    $query->where('schedule_date', '>=', $reportrange_one1);
                    $query->where('schedule_date', '<=', $reportrange_one2);
                }

                //      $query->where('schedule_date', '>=', $data1);
                //      $query->where('schedule_date', '<=', $data2);

            })->get();

        $data = [];
        foreach ($events as $event) {
            //            $client = Client::where('id',$event->client_id)->first();
            $pro_data = Employee::select('last_name', 'first_name', 'back_color', 'text_color')->where('id', $event->provider_id)->first();
            $client = Client::where('admin_id', $this->admin_id)->where('id', $event->client_id)->first();

            if ($client) {
                if ($pro_data) {
                    $pro_name = substr($pro_data->last_name, 0, 2) . ' ' . substr($pro_data->first_name, 0, 2) . ' : ';
                } else {
                    $pro_name = '';
                }
                $client_name = $pro_name . substr(0, 2) . ' ' . substr($client->client_first_name, 0, 2);
            } else {
                if ($pro_data) {
                    $pro_name = substr($pro_data->last_name, 0, 2) . ' ' . substr($pro_data->first_name, 0, 2) . ' : ';
                } else {
                    $pro_name = '';
                }
                $client_name = $pro_name;
            }
            $pro_data = Employee::select('back_color', 'text_color')->where('id', $event->provider_id)->first();

            $event['start_time'] = date('g:iA', strtotime($event['start_time']));
            $event['end_time'] = date('g:iA', strtotime($event['end_time']));
            $event['title'] = $client_name;
            if ($event->location == '02' || $event->location == '10') {
                $event['icon'] = 'camera';
            } else {
                $event['icon'] = "none";
            }

            if ($pro_data) {
                if ($pro_data->back_color != null) {
                    $event['textColor'] = "#000000";
                    $event['backgroundColor'] = $pro_data->back_color;
                    $event['display'] = "block";
                } else {
                    $event['textColor'] = "#000000";
                    $event['backgroundColor'] = "#FFFFFF";
                    $event['display'] = "block";
                }
            } else {
                $event['textColor'] = "#000000";
                $event['backgroundColor'] = "#FFFFFF";
                $event['display'] = "block";
            }

            if (!(int)$event['is_all_day']) {
                $event['allDay'] = false;
                $event['start'] = Carbon::createFromTimestamp(strtotime($event['from_time']))->toIso8601String();
                $event['end'] = Carbon::createFromTimestamp(strtotime($event['to_time']))->toIso8601String();
            } else {
                $event['allDay'] = true;
                $event['start'] = $event['from_time'] . "T" . "12:00:00";
                $event['end'] = $event['to_time'] . "T" . "23:59:00";
            }
            if (isset($event['from_time']) && !empty($event['to_time'])) {
                $event['cstm_deadline'] = $_date = date('Y-m-d', strtotime($event['to_time']));
            }

            if ($event->location == '02' || $event->location == '10') {
                $event['icon'] = 'camera';
            }

            $event['eventid'] = $event['id'];
            array_push($data, $event);
        }


        return response()->json($data);
    }


    public function calender_session_create_new(Request $request)
    {
        $scdule_time_start = Carbon::parse($request->cal_create_form_date);


        $scdule_form_time_start = Carbon::parse($request->cal_create_from_time)->format('H:i:s');
        $scdule_to_time_end = Carbon::parse($request->cal_create_to_time)->format('H:i:s');


        $scdedule_date = Carbon::parse($scdule_time_start)->format('Y-m-d');

        $form_time_convert = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($scdule_form_time_start)->format('Y-m-d H:i:s'));
        $to_time_covert = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($scdule_to_time_end)->format('Y-m-d H:i:s'));

        $diff_form_to = $form_time_convert->diffInMinutes($to_time_covert);


        $ses_form_time = new \DateTime($scdule_time_start->format('Y-m-d') . ' ' . $form_time_convert->format('H:i:s'));
        $ses_to_time = Carbon::parse($ses_form_time)->addMinutes($diff_form_to);

        $scdule_time_end = Carbon::parse($request->cal_create_form_date)->addMinutes($diff_form_to);


        $auth_n = Client_authorization::where('id', $request->cal_create_auth)->first();
        $ac_n = Client_authorization_activity::where('id', $request->cal_create_act)->first();
        $pro_n = Employee::where('id', $request->cal_create_pro)->first();
        if ($ac_n) {
            $cpt_name = setting_cpt_code::where('cpt_id', $ac_n->cpt_code)
                ->where('admin_id', $this->admin_id)
                ->first();

            if ($cpt_name) {
                $cpt_id = $cpt_name->cpt_code;
            } else {
                $cpt_id = null;
            }

        } else {
            $cpt_id = null;
        }


        $f_date = $scdedule_date;
        $onset_dt = Carbon::parse($ac_n->onset_date)->format('Y-m-d');
        $end_dt = Carbon::parse($ac_n->end_date)->format('Y-m-d');


        $client = Client::where('id', $request->cal_create_client)->first();


        if ($client) {
            $client_info = Client_info::where('client_id', $client->id)->first();
        }


        if ($auth_n->client_id != $client->id && $ac_n->client_id != $client->id) {
            return back()->with('alert', 'Authorization and Activity is not belongs to Patient');
            exit();
        }


        $time_array = [];


        $final_sum_hours = ($diff_form_to / 60);

        if ($final_sum_hours <= 0 || $final_sum_hours > $ac_n->hours_max_is_one) {
            // return back()->with('alert', 'You have exceded the approved authorized hours');
            return "errorauthhour";
            exit();
        }

        if ($onset_dt != null && $scdedule_date < $onset_dt) {
            // return back()->with('alert', 'You are scheduling the session prior to the auth date');
            return 'error1';
        } elseif ($end_dt != null && $scdedule_date > $end_dt) {
            // return back()->with('alert', 'You are scheduling the session prior to the auth date');
            return "error2";
        } else {

            $sc_date = Carbon::parse($scdule_time_end)->format('Y-m-d');
            $check_holiday = holiday_setup::where('admin_id', $this->admin_id)->where('holiday_date', $sc_date)->first();

            if ($check_holiday) {
                return back()->with('alert', 'You have selected schedule holiday');
                exit();
            }

            $appoinemt_update = new Appoinment();
            $appoinemt_update->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
            $appoinemt_update->billable = 1;
            $appoinemt_update->client_id = $request->cal_create_client;
            $appoinemt_update->authorization_id = $request->cal_create_auth;
            $appoinemt_update->authorization_activity_id = $request->cal_create_act;
            $appoinemt_update->payor_id = $auth_n->payor_id;
            $appoinemt_update->provider_id = $request->cal_create_pro;
            $appoinemt_update->location = $request->cal_create_location;
            $appoinemt_update->time_duration = $diff_form_to;
            $appoinemt_update->from_time = $ses_form_time;
            $appoinemt_update->activity_type = $ac_n->activity_one;
            $appoinemt_update->to_time = $ses_to_time;
            $appoinemt_update->cpt_code = $cpt_id;
            $appoinemt_update->schedule_date = $scdedule_date;
            $appoinemt_update->status = $request->cal_create_status;
            $appoinemt_update->week_day_name = "";
            $appoinemt_update->degree_level = $ac_n->activity_two;
            $appoinemt_update->gender = $client->client_gender;
            $appoinemt_update->zone = $client->zone;
            $appoinemt_update->m1 = $ac_n->m1;
            $appoinemt_update->m2 = $ac_n->m2;
            $appoinemt_update->m3 = $ac_n->m3;
            $appoinemt_update->m4 = $ac_n->m4;
            if ($client_info) {
                $appoinemt_update->lagunage = $client_info->preferred_language;
            }
            if ($auth_n->is_placeholder == 1) {
                $appoinemt_update->is_show = 1;
            } else {
                $appoinemt_update->is_show = 0;
            }
            $appoinemt_update->is_locked = 0;
            $appoinemt_update->is_mark_gen = 0;
            $appoinemt_update->save();


            return response()->json('appoinemtcreatedcal', 200);


        }
    }


    public function calender_get_data_update(Request $request)
    {


        $scdule_time_start = Carbon::parse($request->callender_from_date);


        $scdule_form_time_start = Carbon::parse($request->callender_form_time)->format('H:i:s');
        $scdule_to_time_end = Carbon::parse($request->callender_to_time)->format('H:i:s');


        $scdedule_date = Carbon::parse($scdule_time_start)->format('Y-m-d');

        $form_time_convert = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($scdule_form_time_start)->format('Y-m-d H:i:s'));
        $to_time_covert = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($scdule_to_time_end)->format('Y-m-d H:i:s'));

        $diff_form_to = $form_time_convert->diffInMinutes($to_time_covert);


        $ses_form_time = new \DateTime($scdule_time_start->format('Y-m-d') . ' ' . $form_time_convert->format('H:i:s'));
        $ses_to_time = Carbon::parse($ses_form_time)->addMinutes($diff_form_to);

        $scdule_time_end = Carbon::parse($request->callender_from_time)->addMinutes($diff_form_to);


        $auth_n = Client_authorization::where('id', $request->callender_authorization_id)->first();
        $ac_n = Client_authorization_activity::where('id', $request->callender_activity_id)->first();
        $pro_n = Employee::where('id', $request->callender_provider_id)->first();
        if ($ac_n) {
            $cpt_name = setting_cpt_code::where('cpt_id', $ac_n->cpt_code)
                ->where('admin_id', $this->admin_id)
                ->first();

            if ($cpt_name) {
                $cpt_id = $cpt_name->cpt_code;
            } else {
                $cpt_id = null;
            }

        } else {
            $cpt_id = null;
        }


        $f_date = Carbon::parse($request->callender_from_time)->format('Y-m-d');
        if($ac_n){
            $onset_dt = Carbon::parse($ac_n->onset_date)->format('Y-m-d');
            $end_dt = Carbon::parse($ac_n->end_date)->format('Y-m-d');
        }
        else{
            $onset_dt=null;
            $end_dt=null;
        }


        $client = Client::where('id', $request->callender_client_id)->first();

        if ($client) {
            $client_info = Client_info::where('client_id', $client->id)->first();
        }


        if($auth_n){
            if ($auth_n->client_id != $client->id && $ac_n->client_id != $client->id) {
                return back()->with('alert', 'Authorization and Activity is not belongs to Patient');
                exit();
            }
        }


        $time_array = [];


        $final_sum_hours = ($diff_form_to / 60);

        if($ac_n){
            if ($final_sum_hours <= 0 || $final_sum_hours > $ac_n->hours_max_is_one) {
                // return back()->with('alert', 'You have exceded the approved authorized hours');
                return "errorauthhour";
                exit();
            }
        }

        if ($onset_dt != null && $scdedule_date < $onset_dt) {
            // return back()->with('alert', 'You are scheduling the session prior to the auth date');
            return 'error1';
        } elseif ($end_dt != null && $scdedule_date > $end_dt) {
            // return back()->with('alert', 'You are scheduling the session prior to the auth date');
            return "error2";
        } else {

            $sc_date = Carbon::parse($scdule_time_end)->format('Y-m-d');
            $check_holiday = holiday_setup::where('admin_id', $this->admin_id)->where('holiday_date', $sc_date)->first();

            if ($check_holiday) {
                return back()->with('alert', 'You have selected schedule holiday');
                exit();
            }

            $appoinemt_update = Appoinment::where('id', $request->callender_edit_single)->first();
            if($appoinemt_update->billable==1){                
        //            $appoinemt_update->billable = isset($request->callender_billable) == 1 ? 1 : 2;
                $appoinemt_update->client_id = $request->callender_client_id;
                $appoinemt_update->authorization_id = $request->callender_authorization_id;
                $appoinemt_update->authorization_activity_id = $request->callender_activity_id;
                $appoinemt_update->payor_id = $auth_n->payor_id;
                $appoinemt_update->provider_id = $request->callender_provider_id;
                $appoinemt_update->location = $request->callender_location;
                $appoinemt_update->time_duration = $diff_form_to;
                $appoinemt_update->from_time = $ses_form_time;
                $appoinemt_update->activity_type = $ac_n->activity_one;
                $appoinemt_update->m1 = $ac_n->m1;
                $appoinemt_update->m2 = $ac_n->m2;
                $appoinemt_update->m3 = $ac_n->m3;
                $appoinemt_update->m4 = $ac_n->m4;
                $appoinemt_update->degree_level = $ac_n->activity_two;
                $appoinemt_update->to_time = $ses_to_time;
                $appoinemt_update->cpt_code = $cpt_id;
                $appoinemt_update->schedule_date = $scdedule_date;
                $appoinemt_update->status = $request->callender_status;
                $appoinemt_update->notes = $request->callender_notes;
                $appoinemt_update->week_day_name = "";
                $appoinemt_update->gender = $client->client_gender;
                $appoinemt_update->zone = $client->zone;
                if ($client_info) {
                $appoinemt_update->lagunage = $client_info->preferred_language;
                }
                if ($auth_n->is_placeholder == 1) {
                    $appoinemt_update->is_show = 1;
                } else {
                    $appoinemt_update->is_show = 0;
                }
                $appoinemt_update->save();
            }
            else{
                $appoinemt_update->client_id = $request->callender_client_id;
                $appoinemt_update->authorization_id = $request->callender_authorization_id;
                $appoinemt_update->authorization_activity_id = $request->callender_activity_id;
                $appoinemt_update->provider_id = $request->callender_provider_id;
                $appoinemt_update->location = $request->callender_location;
                $appoinemt_update->time_duration = $diff_form_to;
                $appoinemt_update->from_time = $ses_form_time;
                $appoinemt_update->to_time = $ses_to_time;
                $appoinemt_update->schedule_date = $scdedule_date;
                $appoinemt_update->status = $request->callender_status;
                $appoinemt_update->week_day_name = "";
                $appoinemt_update->save();
            }

            // $this->creatGoogleEvent($appoinemt_update,'update');

            return redirect()->back()->with('success', 'Appointment Successfully Updated');


        }


        // $appoienment = Appoinment::where('id', $request->id)->first();
        // $appoienment->from_time = Carbon::parse($request->from_time);
        // $appoienment->to_time = Carbon::parse(strtotime($request->from_time))->addMinutes($appoienment->time_duration);
        // $appoienment->save();
        // return response()->json($appoienment);
    }


    public function calender_get_data_drop_single(Request $request)
    {


        $sc_date = Carbon::parse($request->from_time)->format('Y-m-d');
        $check_holiday = holiday_setup::where('admin_id', $this->admin_id)->where('holiday_date', $sc_date)->first();

        if ($check_holiday) {
            return response()->json('holiday_sepup', 200);
            exit();
        }



        $app = Appoinment::where('id', $request->id)->first();
        $ffrom_date=$sc_date->format('m/d/Y');
        $from_time=Carbon::createFromFormat('m/d/Y H:i:s',$ffrom_date.' '.Carbon::parse($app->from_time)->format('H:i:s'));
        $to_time=Carbon::createFromFormat('m/d/Y H:i:s',$ffrom_date.' '.Carbon::parse($app->to_time)->format('H:i:s'));
        $app->schedule_date = $sc_date->format('Y-m-d');
        $app->from_time = $from_time;
        $app->to_time = $to_time;
        $app->save();

        return response()->json($app);
    }


    public function calender_get_data_single(Request $request)
    {
        $appoienment = Appoinment::where('id', $request->id)->first();
        if($appoienment->billable==1){
            $client = Client::where('id', $appoienment->client_id)->first();
            $email=$client->email;
            $name=$client->client_full_name;
        }
        else{
            $email="";
            $name="";
        }

        $payroll_check=\App\Models\timesheet::select('id')->where('admin_id',$this->admin_id)->where('appointment_id',$appoienment->id)->where('submitted',1)->where('status','completed')->first();
        if($payroll_check){
            $pay_check=1;
        }
        else{
            $pay_check=2;
        }
        return response()->json([
            "data" => $appoienment,
            "pay_check" => $pay_check,
            "email" => $email,
            "name" => $name,
            "billable"=>$appoienment->billable,
        ], 200);
    }


    public function calender_get_data_sunc()
    {

        $timezone = setting_name_location::where('admin_id', $this->admin_id)->first();

        if (!$timezone || $timezone->timezone == null) {
            return back()->with('alert', "Please set timezone in settings first!");
        } else {
            $g_service = new GoogleService(Auth::user(), "admin");
            $g_service->redirectc($g_service->authUrl());
        }
    }


    public function calender_get_redirect()
    {
        $timezone = setting_name_location::where('admin_id', $this->admin_id)->first();

        $timezone = $timezone->timezone;

        $g_service = new GoogleService(Auth::user(), "admin");
        $g_service->google_callback();

        $app_apps = Appoinment::select('id', 'admin_id', 'g_event_id', 'client_id', 'provider_id', 'from_time', 'to_time', 'status')
            ->where('admin_id', $this->admin_id)
            ->where('status', 'Rendered')
            ->where(function ($query) {
                $query->where('g_event_id', null)
                    ->orWhere('g_event_id', "");
            })
            ->get();

        foreach ($app_apps as $new_apponinemt) {
            UpdateAllExistAppoinment::dispatch($new_apponinemt, $timezone, "admin");
        }

        return redirect(route('superadmin.calender.view'));
    }


    public function getGoogleCalendarEvents($user, $eventId = false)
    {
        $g_service = new GoogleService(Auth::user(), "admin");
        $is_google_token_expired = $g_service->is_google_token_expired();
        if ($is_google_token_expired) {
            return false;
        }
        $client = $g_service->google_client();
        $service = new \Google_Service_Calendar($client);
        $optParams = array(
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            //            'timeMin' => date('c'),
        );
        if (!$eventId) {
            return $service->events->listEvents("primary", $optParams);
        }
        try {
            $gevent = $service->events->get($this->googleCalendarId(), $eventId);
            if ($gevent->getStatus() == "cancelled") {
                return false;
            }
            return $gevent;
        } catch (\Exception $exception) {
            if ($exception->getCode() == 404) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function googleCalendarId()
    {
        return "primary";
    }


    public function calender_get_all_client(Request $request)
    {

        $app_client = Appoinment::distinct()->select('client_id')->where('admin_id', $this->admin_id)->get();
        $array = [];
        foreach ($app_client as $client) {
            array_push($array, $client->client_id);
        }

        $clients = Client::select('id', 'admin_id', 'client_full_name')->where('admin_id', $this->admin_id)->whereIn('id', $array)->get();
        return response()->json($clients, 200);
    }


    public function calender_get_all_employee(Request $request)
    {
        $app_client = Appoinment::select('admin_id', 'provider_id')->where('admin_id', $this->admin_id)->get();

        $array = [];
        foreach ($app_client as $client) {
            array_push($array, $client->provider_id);
        }
        $clients = Employee::select('id', 'admin_id', 'full_name')->where('admin_id', $this->admin_id)->whereIn('id', $array)->get();

        return response()->json($clients, 200);
    }
}
