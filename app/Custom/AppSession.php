<?php

namespace App\Custom;


use App\Models\Appoinment;
use App\Models\Recurring_session;
use App\Models\holiday_setup;
use App\Models\Client;
use App\Models\Client_activity;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Client_info;
use App\Models\Employee;
use App\Models\setting_cpt_code;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AppSession
{

    protected $admin_id;

    public function __construct($admin_id)
    {
        $this->admin_id = $admin_id;
    }

    public function create_new_session($request)
    {

        $data_checked_day = $request->day_name;
        $from_time = Carbon::createFromFormat('m/d/Y H:i:s', $request->from_time . ' ' . Carbon::parse($request->form_time_session)->format('H:i:s'));
        $to_time = Carbon::createFromFormat('m/d/Y H:i:s', $request->from_time . ' ' . Carbon::parse($request->to_time_session)->format('H:i:s'));
        $minutes = $from_time->diffInMinutes($to_time);

        $from_date = Carbon::parse($request->from_time);
        $to_date = Carbon::parse($request->end_date);

        if ($request->billable == 1) {

            // Log::info('Session is billable');
            $client = Client::select('id', 'is_active_client', 'client_first_name', 'client_middle', 'client_last_name', 'client_gender', 'zone')->where('id', $request->client_id)->where('admin_id', $this->admin_id)->first();
            $client_info = Client_info::select('client_id', 'preferred_language')->where('client_id', $client->id)->where('admin_id', $this->admin_id)->first();
            $auth_n = client_authorization::select('client_id', 'onset_date', 'end_date', 'payor_id', 'is_placeholder')->where('id', $request->authorization_id)->where('admin_id', $this->admin_id)->first();
            $ac_n = client_authorization_activity::where('id', $request->activity_id)->where('admin_id', $this->admin_id)->first();
            $pro_id = $request->provider_id;
            $pro_n = Employee::select('id', 'first_name', 'middle_name', 'last_name')->where('id', $request->provider_id)->where('admin_id', $this->admin_id)->first();
            $cpt_name = setting_cpt_code::select('cpt_id', 'cpt_code')->where('cpt_id', $ac_n->cpt_code)->where('admin_id', $this->admin_id)->first();

            // Log::info('Client Name is :'.$client->client_first_name);

            // Log::info('Validation is done');

            //Creating Session

            if ($request->chkrecurrence == 1) {

                //Validation
                $valid = $this->validate_session([
                    "rec" => $request->chkrecurrence,
                    "billable" => $request->billable,
                    "auth_n" => $auth_n,
                    "ac_n" => $ac_n,
                    "minutes" => $minutes,
                    "from_date" => $from_date,
                    "to_date" => $to_date,
                    "from_time" => $from_time,
                    "to_time" => $to_time,
                    "days" => $data_checked_day,
                    "client" => $client,
                    "rec_check" => 1,   //Recurrance is there
                ], $request);

                if ($valid != "success") {
                    return $valid;
                }

                //Recurring Session add
                // Log::info('Recurrance is there');
                $rec_id = $this->create_recurring_session([
                    "from_date" => $from_date,
                    "hours_from" => $from_time,
                    "hours_to" => $to_time,
                    "client_id" => $client->id,
                    "client_name" => $client->client_first_name . ' ' . $client->client_middle . ' ' . $client->client_last_name,
                    "provider_id" => $pro_id,
                    "provider_name" => $pro_n->first_name . ' ' . $pro_n->middle_name . ' ' . $pro_n->last_name,
                    "activity_name" => $ac_n->activity_name,
                ], $request);

                if ($request->daily == 1) {
                    // Log::info("Ruccerance is daily");
                    while ($from_date <= $to_date) {

                        // Log::info("Date is :".$from_date->format('Y-m-d'));
                        //Validating if current session date is not holiday
                        $holi_check = holiday_setup::select('id')->where('admin_id', $this->admin_id)->where('holiday_date', $from_date)->first();
                        if ($holi_check) {
                            $from_date->addDays(1);
                            continue;
                        }

                        //Updating recurring session end date due to holiday
                        $rec_up = recurring_session::select('id', 'schedule_date_end')->where('admin_id', $this->admin_id)->where('id', $rec_id)->first();
                        $rec_up->schedule_date_end = $from_date->format('Y-m-d');
                        $rec_up->save();

                        // Log::info("Created Recurring Session date is updated.");

                        $day_name = $from_date->format('l');
                        $ffrom_date = $from_date->format('m/d/Y');
                        $from_time = Carbon::createFromFormat('m/d/Y H:i:s', $ffrom_date . ' ' . Carbon::parse($request->form_time_session)->format('H:i:s'));
                        $to_time = Carbon::createFromFormat('m/d/Y H:i:s', $ffrom_date . ' ' . Carbon::parse($request->to_time_session)->format('H:i:s'));
                        $this->create_session([
                            "rec_id" => $rec_id,
                            "auth_n" => $auth_n,
                            "ac_n" => $ac_n,
                            "minutes" => $minutes,
                            "from_time" => $from_time,
                            "to_time" => $to_time,
                            "cpt_name" => $cpt_name,
                            "sch_date" => $from_date,
                            "client" => $client,
                            "client_info" => $client_info ? $client_info : 0,
                        ], $request);

                        // Log::info('Session is created.');

                        $from_date->addDays(1);
                    }
                } elseif ($request->daily == 2) {

                    while ($from_date <= $to_date) {

                        //Validating if current session date is not holiday
                        $holi_check = holiday_setup::select('id')->where('admin_id', $this->admin_id)->where('holiday_date', $from_date)->first();
                        if ($holi_check) {
                            $from_date->addDays(1);
                            continue;
                        }

                        //Updating recurring session end date due to holiday
                        $rec_up = recurring_session::select('id', 'schedule_date_end')->where('id', $rec_id)->where('admin_id', $this->admin_id)->first();
                        $rec_up->schedule_date_end = $from_date->format('Y-m-d');
                        $rec_up->save();


                        $day_name = $from_date->format('l');
                        if (in_array($day_name, $data_checked_day)) {

                            $ffrom_date = $from_date->format('m/d/Y');
                            $from_time = Carbon::createFromFormat('m/d/Y H:i:s', $ffrom_date . ' ' . Carbon::parse($request->form_time_session)->format('H:i:s'));
                            $to_time = Carbon::createFromFormat('m/d/Y H:i:s', $ffrom_date . ' ' . Carbon::parse($request->to_time_session)->format('H:i:s'));

                            $this->create_session([
                                "rec_id" => $rec_id,
                                "auth_n" => $auth_n,
                                "ac_n" => $ac_n,
                                "minutes" => $minutes,
                                "from_time" => $from_time,
                                "to_time" => $to_time,
                                "cpt_name" => $cpt_name,
                                "sch_date" => $from_date,
                                "client" => $client,
                                "client_info" => $client_info ? $client_info : 0,
                            ], $request);
                        }
                        $from_date->addDays(1);
                    }
                }
            } else {

                //Validation
                $valid = $this->validate_session([
                    "rec" => $request->chkrecurrence,
                    "billable" => $request->billable,
                    "auth_n" => $auth_n,
                    "ac_n" => $ac_n,
                    "minutes" => $minutes,
                    "from_time" => $from_time,
                    "to_time" => $to_time,
                    "from_date" => $from_date,
                    "to_date" => $to_date,
                    "days" => $data_checked_day,
                    "client" => $client,
                    "rec_check" => 2 //Recurrance is not there
                ], $request);

                if ($valid != "success") {
                    return $valid;
                }

                $this->create_session([
                    "rec_id" => null,
                    "auth_n" => $auth_n,
                    "ac_n" => $ac_n,
                    "minutes" => $minutes,
                    "from_time" => $from_time,
                    "to_time" => $to_time,
                    "cpt_name" => $cpt_name,
                    "sch_date" => $from_date,
                    "client" => $client,
                    "client_info" => $client_info ? $client_info : 0,
                ], $request);
            }
        } else {

            //Validation

            $valid = $this->validate_session([
                "rec" => $request->chkrecurrence,
                "billable" => $request->billable,
                "minutes" => $minutes,
                "from_date" => $from_date,
                "from_time" => $from_time,
                "to_time" => $to_time
            ], $request);

            if ($valid != "success") {
                return $valid;
            }


            $pros = $request->provider_mul_id;

            foreach ($pros as $pro) {

                $pro_n = Employee::select('id', 'first_name', 'middle_name', 'last_name')->where('id', $pro)->where('admin_id', $this->admin_id)->first();

                //Creating Session
                if ($request->chkrecurrence == 1) {

                    //Creating Recurring Session
                    $rec_id = $this->create_recurring_session([
                        "from_date" => $from_date,
                        "hours_from" => $from_time,
                        "hours_to" => $to_time,
                        "provider_id" => $pro,
                        "provider_name" => $pro_n->first_name . ' ' . $pro_n->middle_name . ' ' . $pro_n->last_name,
                    ], $request);

                    if ($request->daily == 1) {
                        while ($from_date <= $to_date) {

                            //Validating if current session date is not holiday
                            $holi_check = holiday_setup::select('id')->where('admin_id', $this->admin_id)->where('holiday_date', $from_date)->first();
                            if ($holi_check) {
                                $from_date->addDays(1);
                                continue;
                            }

                            //Updating recurring session end date due to holiday
                            $rec_up = recurring_session::select('id', 'schedule_date_end')->where('id', $rec_id)->where('admin_id', $this->admin_id)->first();
                            $rec_up->schedule_date_end = $from_date->format('Y-m-d');
                            $rec_up->save();

                            $day_name = $from_date->format('l');
                            $ffrom_date = $from_date->format('m/d/Y');
                            $from_time = Carbon::createFromFormat('m/d/Y H:i:s', $ffrom_date . ' ' . Carbon::parse($request->form_time_session)->format('H:i:s'));
                            $to_time = Carbon::createFromFormat('m/d/Y H:i:s', $ffrom_date . ' ' . Carbon::parse($request->to_time_session)->format('H:i:s'));
                            $this->create_session([
                                "rec_id" => $rec_id,
                                "minutes" => $minutes,
                                "from_time" => $from_time,
                                "to_time" => $to_time,
                                "sch_date" => $from_date,
                                "provider_id" => $pro
                            ], $request);
                            $from_date->addDays(1);
                        }
                    } elseif ($request->daily == 2) {

                        while ($from_date <= $to_date) {

                            //Validating if current session date is not holiday
                            $holi_check = holiday_setup::select('id')->where('admin_id', $this->admin_id)->where('holiday_date', $from_date)->first();
                            if ($holi_check) {
                                $from_date->addDays(1);
                                continue;
                            }

                            //Updating recurring session end date due to holiday
                            $rec_up = recurring_session::select('id', 'schedule_date_end')->where('id', $rec_id)->where('admin_id', $this->admin_id)->first();
                            $rec_up->schedule_date_end = $from_date->format('Y-m-d');
                            $rec_up->save();


                            $day_name = $from_date->format('l');
                            if (in_array($day_name, $data_checked_day)) {
                                $ffrom_date = $from_date->format('m/d/Y');
                                $from_time = Carbon::createFromFormat('m/d/Y H:i:s', $ffrom_date . ' ' . Carbon::parse($request->form_time_session)->format('H:i:s'));
                                $to_time = Carbon::createFromFormat('m/d/Y H:i:s', $ffrom_date . ' ' . Carbon::parse($request->to_time_session)->format('H:i:s'));
                                $this->create_session([
                                    "rec_id" => $rec_id,
                                    "minutes" => $minutes,
                                    "from_time" => $from_time,
                                    "to_time" => $to_time,
                                    "sch_date" => $from_date,
                                    "provider_id" => $pro
                                ], $request);
                            }
                            $from_date->addDays(1);
                        }
                    }
                } else {
                    $this->create_session([
                        "rec_id" => null,
                        "minutes" => $minutes,
                        "from_time" => $from_time,
                        "to_time" => $to_time,
                        "sch_date" => $from_date,
                        "provider_id" => $pro
                    ], $request);
                }
            }
        }

        return 'appoinemtcreated';
    }

    public function validate_session($data, $request)
    {

        $billable = $data["billable"];
        $from_date = Carbon::parse($data["from_date"]->format('Y-m-d'));
        $from_time = $data["from_time"];
        $to_time = $data["to_time"];
        $minutes = $data["minutes"];
        $rec = $data["rec"];

        $t_hrs = ($minutes / 60);
        $holi_check = holiday_setup::select('id')->where('admin_id', $this->admin_id)->where('holiday_date', $from_date)->first();


        if ($t_hrs > 8) {
            return 'morethan8';
        } else if ($rec != 1 && $holi_check) {
            return 'holiday';
        } else if ($from_time > $to_time) {
            return "timeCheck";
        }


        if ($data["billable"] == 1) {

            $to_date = $data["to_date"];
            $days = $data["days"];
            $rec_check = $data["rec_check"];
            $auth_n = $data["auth_n"];
            $ac_n = $data["ac_n"];
            $client = $data["client"];

            $auth_s_date = Carbon::parse($auth_n->onset_date)->format('Y-m-d');
            $auth_end_date = Carbon::parse($auth_n->end_date)->format('Y-m-d');


            if ($from_date < $auth_s_date) {
                return 'authstart';
            } else if ($from_date > $auth_end_date) {
                return "authend";
            } else if ($rec == 1 && $to_date < $auth_s_date) {
                return "recauthstart";
            } else if ($rec == 1 && $to_date > $auth_end_date) {
                return "recauthend";
            } else if ($client->is_active_client != 1) {
                return 'inactiveclient';
            } else if ($auth_n->client_id != $client->id && $ac_n->client_id != $client->id) {
                return 'clientauth';
            }

            $t_minutes = 0;

            if ($rec_check == 1) {
                if ($request->daily == 1) {
                    while ($from_date <= $to_date) {
                        $day_name = $from_date->format('l');
                        $t_minutes += $minutes;
                        $from_date->addDays(1);
                    }
                } elseif ($request->daily == 2) {

                    while ($from_date <= $to_date) {
                        $day_name = $from_date->format('l');
                        if (in_array($day_name, $days)) {
                            $t_minutes += $minutes;
                        }
                        $from_date->addDays(1);
                    }
                }

                $t_hrs = ($t_minutes / 60);
                $valid = $this->auth_hours_validation($t_hrs, $ac_n, $from_date);
            } else if ($rec_check == 2) {
                $valid = $this->auth_hours_validation($t_hrs, $ac_n, $from_date);
            } else {
                return "success";
            }

            if ($valid["error"] == "errorauthhour") {
                return $valid["error"] . $valid["des"];
            } else if ($valid["error"] == "authempty") {
                return "authempty";
            } else {
                return "success";
            }
        } else {
            return "success";
        }
    }

    public function create_recurring_session($data, $req)
    {


        $rec_s = new Recurring_session();
        $rec_s->admin_id = $this->admin_id;
        $rec_s->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
        $rec_s->schedule_date_start = $data["from_date"]->format("Y-m-d");
        $rec_s->schedule_date_end = Carbon::parse($req->from_time);
        $rec_s->horus_form = $data["hours_from"];
        $rec_s->horus_to = $data["hours_to"];
        $rec_s->provider_id = $data["provider_id"];
        $rec_s->provider_name = $data["provider_name"];

        if ($req->billable == 1) {
            $rec_s->session_name = $data["client_name"];
            $rec_s->client_id = $data["client_id"];
            $rec_s->client_name = $data["client_name"];
            $rec_s->activity_name = $data["activity_name"];
        } else {
            if ($req->activity_id == 1) {
                $rec_s->activity_name = 'Regular Time';
            } else if ($req->activity_id == 2) {
                $rec_s->activity_name = 'Training &amp; Admin';
            } else if ($req->activity_id == 3) {
                $rec_s->activity_name = 'Fill-In';
            } else if ($req->activity_id == 4) {
                $rec_s->activity_name = 'Other';
            } else if ($req->activity_id == 5) {
                $rec_s->activity_name = 'Public Holiday';
            } else if ($req->activity_id == 6) {
                $rec_s->activity_name = 'Paid Time Off';
            } else if ($req->activity_id == 7) {
                $rec_s->activity_name = 'Unpaid';
            }
        }

        $rec_s->location = $req->location;
        $rec_s->status = $req->status;
        $rec_s->save();

        return $rec_s->id;
    }

    public function create_session($data, $request)
    {

        $app = new Appoinment();
        $app->admin_id = $this->admin_id;
        $app->billable = $request->billable;
        $app->client_id = $request->client_id;
        $app->authorization_id = $request->authorization_id;
        $app->authorization_activity_id = $request->activity_id;
        $app->location = $request->location;
        $app->status = $request->status;
        $app->is_locked = 0;
        $app->is_mark_gen = 0;

        $app->recurring_id = $data["rec_id"];
        $app->time_duration = $data["minutes"];
        $app->from_time = $data["from_time"];
        $app->to_time = $data["to_time"];
        $app->schedule_date = $data["sch_date"];
        $app->week_day_name = Carbon::parse($request->from_time)->format('l');

        if ($request->billable == 1) {
            $auth_n = $data["auth_n"];
            $ac_n = $data["ac_n"];
            $cpt_name = $data["cpt_name"];
            $client = $data["client"];
            $client_info = $data["client_info"];

            $app->provider_id = $request->provider_id;

            $app->payor_id = $auth_n->payor_id;
            if ($auth_n->is_placeholder == 1) {
                $app->is_show = 1;
            } else {
                $app->is_show = 0;
            }

            $app->activity_type = $ac_n->activity_one;
            $app->degree_level = $ac_n->activity_two;
            $app->m1 = $ac_n->m1;
            $app->m2 = $ac_n->m2;
            $app->m3 = $ac_n->m3;
            $app->m4 = $ac_n->m4;

            $app->cpt_code = $cpt_name->cpt_code;
            $app->gender = $client->client_gender;
            $app->zone = $client->zone;

            if (!is_int($client_info)) {
                $app->lagunage = $client_info->preferred_language;
            }
        } else {
            $app->payor_id = 0;
            $app->provider_id = $data["provider_id"];
            $app->activity_type = 0;
            $app->cpt_code = 0;
            $app->is_show = 0;
        }

        $app->save();
    }

    public function auth_hours_validation($hours, $act, $date)
    {

        $date = Carbon::parse($date)->format('Y-m-d');
        $auth_empty = true;
        $act1_empty = false;
        $act2_empty = false;
        $act3_empty = false;

        if (!(empty($act->hours_max_one) || empty($act->hours_max_per_one) || empty($act->hours_max_is_one))) {
            $auth_empty = false;
            $act1_empty = true;
        }

        if (!(empty($act->hours_max_two) || empty($act->hours_max_per_two) || empty($act->hours_max_is_two))) {
            $auth_empty = false;
            $act2_empty = true;
        }

        if (!(empty($act->hours_max_three) || empty($act->hours_max_per_three) || empty($act->hours_max_is_three))) {
            $auth_empty = false;
            $act3_empty = true;
        }


        if ($auth_empty) {
            return array(
                "error"=>"noerror",
                "des"=>''
            );
        }

        $total_hrs = 0;
        if ($act1_empty) {
            $error = '';
            if ($act->hours_max_per_one == "Day") {

                $today = Carbon::parse($date)->format('Y-m-d');
                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('schedule_date', $today)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else if ($act->hours_max_per_one == "Week") {

                $week_date = Carbon::parse($date)->subDays(6)->format('Y-m-d');
                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('schedule_date', '>=', $week_date)->where('schedule_date', '<=', $date)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else if ($act->hours_max_per_one == "Month") {

                $month_date = Carbon::parse($date)->format('Y-m');
                $month_date = $month_date . '-01';
                $month_date = Carbon::parse($month_date)->format('Y-m-d');

                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('schedule_date', '>=', $month_date)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else if ($act->hours_max_per_one == "Total Auth") {
                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else {
                $total_hrs = 0;
            }

            if ($act->hours_max_one == 1) {
                if ($total_hrs > $act->hours_max_is_one) {
                    return array(
                        "error" => "errorauthhour",
                        "des" => $act->hours_max_per_one
                    );
                }
            } else if ($act->hours_max_one == 3) {
                if ($act->billed_type == 'Per Unit') {
                    $all_time = 0;

                    if ($act->billed_time == "15 min") {
                        $all_time = ($act->hours_max_is_one * 15) / 60;
                    } else if ($act->billed_time == "30 min") {
                        $all_time = ($act->hours_max_is_one * 30) / 60;
                    } else if ($act->billed_time == "45 min") {
                        $all_time = ($act->hours_max_is_one * 45) / 60;
                    } else if ($act->billed_time == "1 hour") {
                        $all_time = ($act->hours_max_is_one * 60) / 60;
                    } else if ($act->billed_time == "2 hour") {
                        $all_time = ($act->hours_max_is_one * 120) / 60;
                    } else if ($act->billed_time == "1 min") {
                        $all_time = ($act->hours_max_is_one * 1) / 60;
                    }

                    if ($all_time != 0) {
                        if ($total_hrs > $all_time) {
                            return array(
                                "error" => "errorauthhour",
                                "des" => $act->hours_max_per_one
                            );
                        }
                    }
                }
            }
        }


        if ($act2_empty) {
            if ($act->hours_max_per_two == "Day") {
                $today = Carbon::parse($date)->format('Y-m-d');
                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('schedule_date', $today)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else if ($act->hours_max_per_two == "Week") {
                $week_date = Carbon::parse($date)->subDays(6)->format('Y-m-d');
                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('schedule_date', '>=', $week_date)->where('schedule_date', '<=', $date)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else if ($act->hours_max_per_two == "Month") {
                $month_date = Carbon::parse($date)->format('Y-m');
                $month_date = $month_date . '-01';
                $month_date = Carbon::parse($month_date)->format('Y-m-d');

                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('schedule_date', '>=', $month_date)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else if ($act->hours_max_per_two == "Total Auth") {
                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else {
                $total_hrs = 0;
            }

            if ($act->hours_max_two == 1) {
                if ($total_hrs > $act->hours_max_is_two) {
                    return array(
                        "error" => "errorauthhour",
                        "des" => $act->hours_max_per_two
                    );
                }
            } else if ($act->hours_max_two == 3) {
                if ($act->billed_type == 'Per Unit') {
                    $all_time = 0;
                    if ($act->billed_time == "15 min") {
                        $all_time = ($act->hours_max_is_two * 15) / 60;
                    } else if ($act->billed_time == "30 min") {
                        $all_time = ($act->hours_max_is_two * 30) / 60;
                    } else if ($act->billed_time == "45 min") {
                        $all_time = ($act->hours_max_is_two * 45) / 60;
                    } else if ($act->billed_time == "1 hour") {
                        $all_time = ($act->hours_max_is_two * 60) / 60;
                    } else if ($act->billed_time == "2 hour") {
                        $all_time = ($act->hours_max_is_two * 120) / 60;
                    } else if ($act->billed_time == "1 min") {
                        $all_time = ($act->hours_max_is_two * 1) / 60;
                    }

                    if ($all_time != 0) {
                        if ($total_hrs > $all_time) {
                            return array(
                                "error" => "errorauthhour",
                                "des" => $act->hours_max_per_two
                            );
                        }
                    }
                }
            }
        }


        if ($act3_empty) {
            if ($act->hours_max_per_three == "Day") {
                $today = Carbon::parse($date)->format('Y-m-d');
                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('schedule_date', $today)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else if ($act->hours_max_per_three == "Week") {
                $week_date = Carbon::parse($date)->subDays(6)->format('Y-m-d');
                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('schedule_date', '>=', $week_date)->where('schedule_date', '<=', $date)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else if ($act->hours_max_per_three == "Month") {
                $month_date = Carbon::parse($date)->format('Y-m');
                $month_date = $month_date . '-01';
                $month_date = Carbon::parse($month_date)->format('Y-m-d');
                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('schedule_date', '>=', $month_date)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else if ($act->hours_max_per_three == "Total Auth") {
                $app_hrs = Appoinment::where('authorization_activity_id', $act->id)->where('admin_id', $this->admin_id)->where('status','Rendered')->sum('time_duration');
                $app_hrs = $app_hrs / 60;
                $total_hrs = $app_hrs + $hours;
            } else {
                $total_hrs = 0;
            }

            if ($act->hours_max_three == 1) {
                if ($total_hrs > $act->hours_max_is_three) {
                    return array(
                        "error" => "errorauthhour",
                        "des" => $act->hours_max_per_three
                    );
                }
            } else if ($act->hours_max_three == 3) {
                if ($act->billed_type == 'Per Unit') {
                    $all_time = 0;
                    if ($act->billed_time == "15 min") {
                        $all_time = ($act->hours_max_is_three * 15) / 60;
                    } else if ($act->billed_time == "30 min") {
                        $all_time = ($act->hours_max_is_three * 30) / 60;
                    } else if ($act->billed_time == "45 min") {
                        $all_time = ($act->hours_max_is_three * 45) / 60;
                    } else if ($act->billed_time == "1 hour") {
                        $all_time = ($act->hours_max_is_three * 60) / 60;
                    } else if ($act->billed_time == "2 hour") {
                        $all_time = ($act->hours_max_is_three * 120) / 60;
                    } else if ($act->billed_time == "1 min") {
                        $all_time = ($act->hours_max_is_three * 1) / 60;
                    }

                    if ($all_time != 0) {
                        if ($total_hrs > $all_time) {
                            return array(
                                "error" => "errorauthhour",
                                "des" => $act->hours_max_per_three
                            );
                        }
                    }
                }
            }
            
        }

        return array(
            "error" => "noerror",
            "des" => ""
        );
    }

    public function update_session($request)
    {

        $id = $request->app_id;
        $provider_id = $request->provider_id;
        $from_time = Carbon::createFromFormat('m/d/Y H:i:s', $request->from_time . ' ' . Carbon::parse($request->form_time_session)->format('H:i:s'));
        $to_time = Carbon::createFromFormat('m/d/Y H:i:s', $request->from_time . ' ' . Carbon::parse($request->to_time_session)->format('H:i:s'));
        $minutes = $from_time->diffInMinutes($to_time);

        $from_date = Carbon::parse($request->from_time);
        $to_date = Carbon::parse($request->end_date);

        if ($request->billable == 1) {

            $client = Client::select('id','is_active_client','client_first_name','client_middle','client_last_name','client_gender','zone')->where('id', $request->client_id)->where('admin_id',$this->admin_id)->first();
            $client_info = Client_info::select('client_id','preferred_language')->where('client_id', $client->id)->where('admin_id',$this->admin_id)->first();
            $auth_n = client_authorization::select('client_id','onset_date','end_date','payor_id','is_placeholder')->where('id', $request->authorization_id)->where('admin_id',$this->admin_id)->first();
            $ac_n = client_authorization_activity::where('id', $request->activity_id)->where('admin_id',$this->admin_id)->first();
            // Log::info($ac_n);
            $pro_id = $request->provider_id;
            $pro_n = Employee::select('id', 'first_name', 'middle_name', 'last_name')->where('id', $request->provider_id)->where('admin_id', $this->admin_id)->first();

            $cpt_name = setting_cpt_code::select('cpt_id', 'cpt_code')->where('cpt_id', $ac_n->cpt_code)->where('admin_id', $this->admin_id)->first();
            // Log::info($cpt_name);

            $valid = $this->validate_session([
                "billable" => $request->billable,
                "auth_n" => $auth_n,
                "ac_n" => $ac_n,
                "minutes" => $minutes,
                "from_date" => $from_date,
                "to_date" => $to_date,
                "from_time" => $from_time,
                "to_time" => $to_time,
                "client" => $client,
                "rec_check" => 2,
                "rec" => 0,
                "days" => 0,
            ], $request);

            if ($valid != "success") {
                return $valid;
            }

            $this->edit_session([
                "id" => $id,
                "auth_n" => $auth_n,
                "ac_n" => $ac_n,
                "minutes" => $minutes,
                "from_time" => $from_time,
                "to_time" => $to_time,
                "sch_date" => $from_date,
                "cpt_name" => $cpt_name,
                "client" => $client,
                "client_info" => $client_info ? $client_info : 0,
            ], $request);
        } else {
            $valid = $this->validate_session([
                "rec" => 0,
                "billable" => $request->billable,
                "minutes" => $minutes,
                "from_date" => $from_date,
                "from_time" => $from_time,
                "to_time" => $to_time
            ], $request);

            if ($valid != "success") {
                return $valid;
            }

            $this->edit_session([
                "id" => $id,
                "minutes" => $minutes,
                "from_time" => $from_time,
                "to_time" => $to_time,
                "sch_date" => $from_date,
                "provider_id" => $provider_id,
            ], $request);
        }

        return "sessionUpdated";
    }


    public function edit_session($data, $request)
    {
        $app = Appoinment::where('id', $data["id"])->where('admin_id', $this->admin_id)->first();
        $app->admin_id = $this->admin_id;
        $app->client_id = $request->client_id;
        $app->authorization_id = $request->authorization_id;
        $app->authorization_activity_id = $request->activity_id;
        $app->location = $request->location;
        $app->status = $request->status;

        $app->time_duration = $data["minutes"];
        $app->from_time = $data["from_time"];
        $app->to_time = $data["to_time"];
        $app->schedule_date = $data["sch_date"];
        $app->week_day_name = Carbon::parse($request->from_time)->format('l');

        if ($request->billable == 1) {
            $auth_n = $data["auth_n"];
            $ac_n = $data["ac_n"];
            $cpt_name = $data["cpt_name"];
            $client = $data["client"];
            $client_info = $data["client_info"];

            $app->provider_id = $request->provider_id;

            $app->payor_id = $auth_n->payor_id;
            if ($auth_n->is_placeholder == 1) {
                $app->is_show = 1;
            } else {
                $app->is_show = 0;
            }

            $app->activity_type = $ac_n->activity_one;
            $app->degree_level = $ac_n->activity_two;
            $app->m1 = $ac_n->m1;
            $app->m2 = $ac_n->m2;
            $app->m3 = $ac_n->m3;
            $app->m4 = $ac_n->m4;

            $app->cpt_code = $cpt_name->cpt_code;
            $app->gender = $client->client_gender;
            $app->zone = $client->zone;

            if (!is_int($client_info)) {
                $app->lagunage = $client_info->preferred_language;
            }
        } else {
            $app->payor_id = 0;
            $app->provider_id = $data["provider_id"];
            $app->activity_type = 0;
            $app->cpt_code = 0;
            $app->is_show = 0;
        }

        $app->save();
    }
}
