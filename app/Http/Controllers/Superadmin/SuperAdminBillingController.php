<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\all_sub_activity;
use App\Models\Appoinment;
use App\Models\Batching_claim;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Employee;
use App\Models\Employee_department;
use App\Models\Payor_facility;
use App\Models\Processing_claim;
use App\Models\rate_list;
use App\Models\setting_cpt_code;
use App\Models\setting_name_location;
use App\Models\setting_service;
use App\Models\Treatment_facility;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class SuperAdminBillingController extends Controller
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

    public function billing()
    {

        //        $clients = Client::all();
        //
        //        foreach ($clients as $client){
        //            $client = Client::where('id',$client->id)->first();
        //            $client->client_full_name = $client->client_first_name.' '.$client->client_middle.' '.$client->client_last_name;
        //            $client->save();
        //        }
        $count_pending_for_aproval = Processing_claim::where('status', 'Pending for Approval')->where('admin_id', $this->admin_id)->count();
        $name_loca = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        return view('superadmin.billing.billing', compact('count_pending_for_aproval', 'name_loca'));
    }


    public function billing_get_recod_by_date(Request $request)
    {
        $data = Carbon::parse($request->to_date)->format('Y-m-d');
        $get_app_save = Appoinment::where('admin_id', $this->admin_id)
            ->where('schedule_date', '<=', $data)
            ->where('billable', 1)
            ->where('is_locked', 0)
            ->where('is_show', 0)
            ->where('status', 'Rendered')
            ->get();

        $name_location = setting_name_location::where('admin_id', $this->admin_id)->first();

        if ($name_location->is_combo == 1) {
            $proc_claim = $this->combo_code_process_claim($get_app_save);
        } else {
            $proc_claim = $this->without_combo_code_process_claim($get_app_save);
        }


        if ($proc_claim == 'claim_processed') {
            $get_all_cliam = Processing_claim::distinct()->select('admin_id', 'payor_id')
                ->where('schedule_date', '<=', $data)
                ->where('admin_id', $this->admin_id)
                ->get();
            $array = [];

            foreach ($get_all_cliam as $ap) {
                array_push($array, $ap->payor_id);
            }

            $payors = Payor_facility::select('id', 'payor_id', 'payor_name')
                ->whereIn('payor_id', $array)->where('admin_id', $this->admin_id)
                ->orderBy('payor_name','Asc')
                ->get();

            return response()->json([
                'payors' => $payors,
                'name_loca' => $name_location->is_combo,
            ]);
            exit();
        } else {
            $get_all_cliam = Processing_claim::distinct()->select('admin_id', 'payor_id')
                ->where('schedule_date', '<=', $data)
                ->where('admin_id', $this->admin_id)
                ->get();

            $array = [];

            foreach ($get_all_cliam as $ap) {
                array_push($array, $ap->payor_id);
            }


            $payors = Payor_facility::select('id', 'payor_id', 'payor_name')->whereIn('payor_id', $array)->where('admin_id', $this->admin_id)->orderBy('payor_name','Asc')->get();
            return response()->json([
                'payors' => $payors,
                'name_loca' => $name_location->is_combo,
            ]);
            exit();
        }
    }


    private function combo_code_process_claim($claims)
    {
        foreach ($claims as $sing_app) {

            $sing_app_data = Appoinment::where('id', $sing_app->id)->first();

            $exp_ctps = explode(",", $sing_app->cpt_code);
            foreach ($exp_ctps as $cpt => $vaue) {


                $check_exist = Processing_claim::where('appointment_id', $sing_app_data->id)
                    ->where('admin_id', $this->admin_id)
                    ->where('cpt', $vaue)
                    ->first();
                
                $act = Client_authorization_activity::where('id', $sing_app_data->authorization_activity_id)
                    ->where('admin_id', $this->admin_id)
                    ->first();
                $auth = Client_authorization::where('id', $sing_app_data->authorization_id)
                    ->where('admin_id', $this->admin_id)
                    ->first();

                if (!$check_exist) {

                    if ($auth && $auth->is_placeholder != 1) {


                        $new_claim = new processing_claim();
                        if ($act->billed_type == "15 mins") {

                            $time = $sing_app->time_duration / 15;
                            $new_claim->units_value_calc = (double)$time;
                        } elseif ($act->billed_type == "Hour") {
                            $time = $sing_app->time_duration / 60;
                            $new_claim->units_value_calc = (double)$time;
                        } elseif ($act->billed_type == "Per Unit") {


                            if ($act->billed_time == "15 min") {
                                $time = $sing_app->time_duration / 15;
                                $new_claim->units_value_calc = (double)$time;
                            } elseif ($act->billed_time == "30 min") {

                                $time = $sing_app->time_duration / 30;
                                $new_claim->units_value_calc = (double)$time;
                            } elseif ($act->billed_time == "45 min") {

                                $time = $sing_app->time_duration / 45;
                                $new_claim->units_value_calc = (double)$time;
                            } elseif ($act->billed_time == "1 hour") {

                                $time = $sing_app->time_duration / 60;
                                $new_claim->units_value_calc = (double)$time;
                            }
                        } elseif ($act->billed_type == "Per Session") {
                            $new_claim->units_value_calc = (double)1.00;
                        } else {
                            $new_claim->units_value_calc = (double)0.00;
                        }


                        $new_claim->admin_id = $this->admin_id;
                        $new_claim->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                        $new_claim->appointment_id = $sing_app->id;
                        $new_claim->client_id = $sing_app->client_id;
                        $new_claim->provider_id = $sing_app->provider_id;
                        $new_claim->authorization_id = $sing_app->authorization_id;
                        $new_claim->activity_id = $sing_app->authorization_activity_id;
                        $new_claim->payor_id = isset($auth) ? $auth->payor_id : null;
                        $new_claim->activity_type = $act->activity_one;
                        $new_claim->schedule_date = $sing_app->schedule_date;
                        $new_claim->from_time = $sing_app->from_time;
                        $new_claim->to_time = $sing_app->to_time;
                        $new_claim->time_duration = $sing_app->time_duration;
                        $new_claim->cpt = $vaue;
                        $new_claim->m1 = $act->m1;
                        $new_claim->m2 = $act->m2;
                        $new_claim->m3 = $act->m3;
                        $new_claim->m4 = $act->m4;
                        $new_claim->units = (double)$new_claim->units_value_calc;
                        $new_claim->rate = number_format((double)$act->rate,2,'.','');
                        $new_claim->cms_24j = $auth->supervisor_id;
                        $new_claim->status = 'Ready To Bill';
                        $new_claim->degree_level = $sing_app->degree_level;
                        $new_claim->zone = $sing_app->zone;
                        $new_claim->location = $sing_app->location;
                        $new_claim->is_mark_gen = 0;
                        $new_claim->save();

                        $app_data = Appoinment::where('id', $sing_app->id)->first();
                        $app_data->is_locked = 1;
                        $app_data->save();

                    } else {
                        $app_data = Appoinment::where('id', $sing_app->id)->first();
                        $app_data->is_locked = 0;
                        $app_data->is_mark_gen = 0;
                        $app_data->save();
                    }
                } else {
                    $check_batch_claim = Batching_claim::where('admin_id', $this->admin_id)
                        ->where('appointment_id', $check_exist->appointment_id)
                        ->where('processing_claim_id', $check_exist->id)
                        ->where('is_mark_gen', 1)
                        ->first();


                    if ($auth && $auth->is_placeholder == 1) {
                        if (!$check_batch_claim) {
                            $app_data = Appoinment::where('id', $sing_app->id)->first();
                            $app_data->is_locked = 1;
                            $app_data->is_mark_gen = 0;
                            $app_data->save();

                            $check_exist->is_mark_gen = 0;
                            $check_exist->save();
                        }
                    }

                }


            }

        }
        return 'claim_processed';


    }


    private function without_combo_code_process_claim($claims)
    {
        foreach ($claims as $sing_app) {
            $check_exist = Processing_claim::where('appointment_id', $sing_app->id)
                ->where('admin_id', $this->admin_id)
                ->first();

            $act = Client_authorization_activity::where('id', $sing_app->authorization_activity_id)
                ->where('admin_id', $this->admin_id)
                ->first();
            $auth = Client_authorization::where('id', $sing_app->authorization_id)
                ->where('admin_id', $this->admin_id)
                ->first();

            $cpt_name = setting_cpt_code::where('cpt_id', $act->cpt_code)
                ->where('admin_id', $this->admin_id)
                ->first();


            if (!$check_exist) {

                if ($auth && $auth->is_placeholder != 1) {
                    $new_claim = new processing_claim();
                    if ($act->billed_type == "15 mins") {

                        $time = $sing_app->time_duration / 15;
                        $new_claim->units_value_calc = (double)$time;
                    } elseif ($act->billed_type == "Hour") {
                        $time = $sing_app->time_duration / 60;
                        $new_claim->units_value_calc = (double)$time;
                    } elseif ($act->billed_type == "Per Unit") {
                        if ($act->billed_time == "15 min") {
                            $time = $sing_app->time_duration / 15;
                            $new_claim->units_value_calc = (double)$time;
                        } elseif ($act->billed_time == "30 min") {

                            $time = $sing_app->time_duration / 30;
                            $new_claim->units_value_calc = (double)$time;
                        } elseif ($act->billed_time == "45 min") {

                            $time = $sing_app->time_duration / 45;
                            $new_claim->units_value_calc = (double)$time;
                        } elseif ($act->billed_time == "1 hour") {

                            $time = $sing_app->time_duration / 60;
                            $new_claim->units_value_calc = (double)$time;
                        }
                    } elseif ($act->billed_type == "Per Session") {
                        $new_claim->units_value_calc = 1.00;
                    } else {
                        $new_claim->units_value_calc = 0.00;
                    }


                    $new_claim->admin_id = $this->admin_id;
                    $new_claim->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                    $new_claim->appointment_id = $sing_app->id;
                    $new_claim->client_id = $sing_app->client_id;
                    $new_claim->provider_id = $sing_app->provider_id;
                    $new_claim->authorization_id = $sing_app->authorization_id;
                    $new_claim->activity_id = $sing_app->authorization_activity_id;
                    $new_claim->payor_id = isset($auth) ? $auth->payor_id : null;
                    $new_claim->activity_type = $act->activity_one;
                    $new_claim->schedule_date = $sing_app->schedule_date;
                    $new_claim->from_time = $sing_app->from_time;
                    $new_claim->to_time = $sing_app->to_time;
                    $new_claim->time_duration = $sing_app->time_duration;
                    $new_claim->cpt = isset($cpt_name) ? $cpt_name->cpt_code : null;
                    $new_claim->m1 = $act->m1;
                    $new_claim->m2 = $act->m2;
                    $new_claim->m3 = $act->m3;
                    $new_claim->m4 = $act->m4;
                    $new_claim->units = (double)$new_claim->units_value_calc;
                    $new_claim->rate = number_format((double)$act->rate,2,'.','');
                    $new_claim->cms_24j = $auth->supervisor_id;
                    $new_claim->status = 'Ready To Bill';
                    $new_claim->degree_level = $sing_app->degree_level;
                    $new_claim->zone = $sing_app->zone;
                    $new_claim->location = $sing_app->location;
                    $new_claim->is_mark_gen = 0;
                    $new_claim->save();


                    $app_data = Appoinment::where('id', $sing_app->id)->first();
                    $app_data->is_locked = 1;
                    $app_data->save();
                } else {

                    $app_data = Appoinment::where('id', $sing_app->id)->first();
                    $app_data->is_locked = 0;
                    $app_data->is_mark_gen = 0;
                    $app_data->save();
                }
            } else {
                $check_batch_claim = Batching_claim::where('admin_id', $this->admin_id)
                    ->where('appointment_id', $check_exist->appointment_id)
                    ->where('processing_claim_id', $check_exist->id)
                    ->where('is_mark_gen', 1)
                    ->first();


                if ($auth && $auth->is_placeholder == 1) {
                    if (!$check_batch_claim) {
                        $app_data = Appoinment::where('id', $sing_app->id)->first();
                        $app_data->is_locked = 1;
                        $app_data->is_mark_gen = 0;
                        $app_data->save();

                        $check_exist->is_mark_gen = 0;
                        $check_exist->save();
                    }
                }


            }
        }

        return 'claim_processed';

    }


    public function billing_update_data_all(Request $request)
    {
        $date = Carbon::parse($request->to_date)->format('Y-m-d');
        $appoinments = Appoinment::select('id', 'admin_id', 'is_mark_gen', 'billable', 'client_id', 'provider_id', 'authorization_id', 'authorization_activity_id', 'payor_id',
            'schedule_date', 'from_time', 'to_time', 'status', 'time_duration', 'degree_level', 'zone', 'location')
            ->where('admin_id', $this->admin_id)
            ->where('schedule_date', '<=', $date)
            ->where('billable', 1)
            ->where('is_mark_gen', 0)
            ->where('payor_id', $request->pay_id)
            ->where('status', 'Rendered')
            ->get();

        foreach ($appoinments as $app) {

            $act = Client_authorization_activity::select('id', 'admin_id', 'billed_type', 'billed_time', 'cpt_code', 'activity_one', 'm1', 'm2', 'm3', 'm4', 'rate')->where('id', $app->authorization_activity_id)
                ->where('admin_id', $this->admin_id)
                ->first();
            $auth = Client_authorization::select('id', 'admin_id', 'payor_id', 'supervisor_id')->where('id', $app->authorization_id)
                ->where('admin_id', $this->admin_id)
                ->first();

            $cpt_name = setting_cpt_code::where('cpt_id', $act->cpt_code)
                ->where('admin_id', $this->admin_id)
                ->first();

            $new_claim = Processing_claim::where('appointment_id', $app->id)->first();


            if ($new_claim) {


                if ($act->billed_type == "15 mins") {

                    $time = $app->time_duration / 15;
                    $new_claim->units_value_calc = $time;
                } elseif ($act->billed_type == "Hour") {
                    $time = $app->time_duration / 60;
                    $new_claim->units_value_calc = number_format($time, 2);
                } elseif ($act->billed_type == "Per Unit") {


                    if ($act->billed_time == "15 min") {
                        $time = $app->time_duration / 15;
                        $new_claim->units_value_calc = number_format($time, 2);
                    } elseif ($act->billed_time == "30 min") {

                        $time = $app->time_duration / 30;
                        $new_claim->units_value_calc = number_format($time, 2);
                    } elseif ($act->billed_time == "45 min") {

                        $time = $app->time_duration / 45;
                        $new_claim->units_value_calc = number_format($time, 2);
                    } elseif ($act->billed_time == "1 hour") {

                        $time = $app->time_duration / 60;
                        $new_claim->units_value_calc = number_format($time, 2);
                    }
                } elseif ($act->billed_type == "Per Session") {
                    $new_claim->units_value_calc = 1.00;
                } else {
                    $new_claim->units_value_calc = 0.00;
                }

                $new_claim->appointment_id = $app->id;
                $new_claim->client_id = $app->client_id;
                $new_claim->provider_id = $app->provider_id;
                $new_claim->authorization_id = $app->authorization_id;
                $new_claim->activity_id = $app->authorization_activity_id;
                $new_claim->payor_id = $auth->payor_id;
                $new_claim->activity_type = $act->activity_one;
                $new_claim->schedule_date = $app->schedule_date;
                $new_claim->from_time = $app->from_time;
                $new_claim->to_time = $app->to_time;
                $new_claim->time_duration = $app->time_duration;
                $new_claim->cpt = isset($cpt_name) ? $cpt_name->cpt_code : null;
                $new_claim->m1 = $act->m1;
                $new_claim->m2 = $act->m2;
                $new_claim->m3 = $act->m3;
                $new_claim->m4 = $act->m4;
                $new_claim->units = $new_claim->units_value_calc;
                $new_claim->rate = number_format((double)$act->rate, 2,'.','');
                $new_claim->cms_24j = $auth->supervisor_id;
                $new_claim->degree_level = $app->degree_level;
                $new_claim->zone = $app->zone;
                $new_claim->location = $app->location;
                $new_claim->save();

            }
        }


    }


    public function billing_get_clients(Request $request)
    {
        //        $app = appoinment::distinct()->select('client_id')->where('schedule_date','<=',$request->to_date)
        //            ->where('payor_id',$request->payor_id)
        //            ->get();
        $data = Carbon::parse($request->to_date)->format('Y-m-d');
        $name_location = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();

        if ($name_location->is_combo == 1) {
            $app = Processing_claim::distinct()->select('admin_id', 'client_id')->where('schedule_date', '<=', $data)
                ->whereIn('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        } else {
            $app = Processing_claim::distinct()->select('admin_id', 'client_id')->where('schedule_date', '<=', $data)
                ->where('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        }


        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->client_id);
        }

        $clients = Client::whereIn('id', $array)->where('admin_id', $this->admin_id)->orderBy('client_full_name', 'asc')->get();

        return $clients;


        exit;
    }


    public function billing_get_treating_therapist(Request $request)
    {
        //        $app = appoinment::distinct()->select('provider_id')->where('schedule_date','<=',$request->to_date)
        //            ->where('payor_id',$request->payor_id)
        //            ->get();
        $data = Carbon::parse($request->to_date)->format('Y-m-d');
        $name_location = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        if ($name_location->is_combo == 1) {
            $app = Processing_claim::distinct()->select('admin_id', 'provider_id')->where('schedule_date', '<=', $data)
                ->whereIn('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        } else {
            $app = Processing_claim::distinct()->select('admin_id', 'provider_id')->where('schedule_date', '<=', $data)
                ->where('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        }


        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->provider_id);
        }

        $employee = Employee::whereIn('id', $array)->where('admin_id', $this->admin_id)->orderBy('full_name', 'asc')->get();

        return $employee;
    }


    public function billing_get_csm_therapist(Request $request)
    {
        $employee_sup = Employee_department::where('is_supervisor', 1)->where('admin_id', $this->admin_id)->get();


        $array = [];

        foreach ($employee_sup as $ap) {
            array_push($array, $ap->id);
        }
        $employee = Employee::whereIn('id', $array)->where('admin_id', $this->admin_id)->orderBy('full_name', 'asc')->get();


        return $employee;
    }


    public function billing_get_activity_type(Request $request)
    {
        //        $app = appoinment::distinct()->select('authorization_activity_id')->where('schedule_date','<=',$request->to_date)
        //            ->where('payor_id',$request->payor_id)
        //            ->get();

        $data = Carbon::parse($request->to_date)->format('Y-m-d');
        $name_location = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        if ($name_location->is_combo == 1) {
            $app = Processing_claim::distinct()->select('activity_id')->where('schedule_date', '<=', $data)
                ->whereIn('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        } else {
            $app = Processing_claim::distinct()->select('activity_id')->where('schedule_date', '<=', $data)
                ->where('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        }


        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->activity_id);
        }

        $client_activity = Client_authorization_activity::whereIn('id', $array)->where('admin_id', $this->admin_id)->orderBy('activity_one','asc')->get();
        return $client_activity;
    }


    public function billing_get_degree_level(Request $request)
    {

        $data = Carbon::parse($request->to_date)->format('Y-m-d');
        $name_location = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        if ($name_location->is_combo == 1) {
            $app = Processing_claim::distinct()->select('activity_id')->where('schedule_date', '<=', $data)
                ->whereIn('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        } else {
            $app = Processing_claim::distinct()->select('activity_id')->where('schedule_date', '<=', $data)
                ->where('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        }


        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->activity_id);
        }

        $client_activity = Client_authorization_activity::whereIn('id', $array)->where('admin_id', $this->admin_id)->orderBy('activity_one','asc')->get();

        return $client_activity;
    }


    public function billing_get_zone(Request $request)
    {
        //        $app = appoinment::distinct()->select('client_id')->where('schedule_date','<=',$request->to_date)
        //            ->where('payor_id',$request->payor_id)
        //            ->get();

        $data = Carbon::parse($request->to_date)->format('Y-m-d');
        $name_location = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        if ($name_location->is_combo == 1) {
            $app = Processing_claim::distinct()->select('client_id')->where('schedule_date', '<=', $data)
                ->whereIn('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        } else {
            $app = Processing_claim::distinct()->select('client_id')->where('schedule_date', '<=', $data)
                ->where('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        }


        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->client_id);
        }

        $client = Client::distinct()->select('zone')->whereIn('id', $array)->where('admin_id', $this->admin_id)->orderBy('zone','asc')->get();

        return $client;
    }


    public function billing_get_cpt_code(Request $request)
    {
        //        $app = appoinment::distinct()->select('authorization_activity_id')->where('schedule_date','<=',$request->to_date)
        //            ->where('payor_id',$request->payor_id)
        //            ->get();
        $data = Carbon::parse($request->to_date)->format('Y-m-d');
        $name_location = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        if ($name_location->is_combo == 1) {
            $app = Processing_claim::distinct()->select('cpt')->where('schedule_date', '<=', $data)
                ->whereIn('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        } else {
            $app = Processing_claim::distinct()->select('cpt')->where('schedule_date', '<=', $data)
                ->where('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        }


        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->cpt);
        }

        $cpt = setting_service::whereIn('service', $array)->where('admin_id', $this->admin_id)->get();

        return $cpt;
    }


    public function billing_get_modifire(Request $request)
    {
        //        $app = appoinment::distinct()->select('authorization_activity_id')->where('schedule_date','<=',$request->to_date)
        //            ->where('payor_id',$request->payor_id)
        //            ->get();
        $data = Carbon::parse($request->to_date)->format('Y-m-d');
        $name_location = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        if ($name_location->is_combo == 1) {
            $app = Processing_claim::distinct()->select('activity_id')->where('schedule_date', '<=', $data)
                ->whereIn('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        } else {
            $app = Processing_claim::distinct()->select('activity_id')->where('schedule_date', '<=', $data)
                ->where('payor_id', $request->payor_id)
                ->where('admin_id', $this->admin_id)
                ->get();
        }


        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->activity_id);
        }

        $auth_activity = Client_authorization_activity::distinct()->select('m1', 'm2', 'm3', 'm4')
            ->whereIn('id', $array)
            ->where('admin_id', $this->admin_id)
            ->get();

        $array2 = [];

        foreach ($auth_activity as $ap2) {
            array_push($array2, $ap2->m1);
            array_push($array2, $ap2->m2);
            array_push($array2, $ap2->m3);
            array_push($array2, $ap2->m4);
        }

        return $array2;
    }


    public function billing_record_get_cms_provider(Request $request)
    {
        $employee_sup = Employee_department::where('is_supervisor', 1)->where('admin_id', $this->admin_id)->get();

        $array = [];

        foreach ($employee_sup as $ap) {
            array_push($array, $ap->employee_id);
        }
        $employee = Employee::whereIn('id', $array)->where('admin_id', $this->admin_id)->orderBy('first_name', 'asc')->get();
        return $employee;
    }


    public function billing_record_get(Request $request)
    {

        $to_date = $request->to_date;
        $to_date_get = Carbon::parse($to_date)->format('Y-m-d');
        $payor_id = $request->payor_id;
        $client1 = $request->client1;
        $treating_therapist = $request->treating_therapist;
        $cms_therapist = $request->cms_therapist;
        $activitytype = $request->activitytype;
        $ready_to_bill_status = $request->ready_to_bill_status;

        $reportrange = $request->reportrange;
        $reportrange_one1 = substr($request->reportrange, 0, 10);
        $reportrange_one2 = substr($request->reportrange, 13, 24);

        $degree_level = $request->degree_level;
        $zone = $request->zone;
        $cptcode = $request->cptcode;
        $modifire = $request->modifire;
        $pos = $request->pos;
        $zero_units = $request->zero_units;

        $client2 = $request->client2;
        $treating_therapist1 = $request->treating_therapist1;
        $cms_therapist1 = $request->cms_therapist1;
        $activitytype1 = $request->activitytype1;
        $ready_to_bill_status1 = $request->ready_to_bill_status1;

        $reportrange1 = $request->reportrange1;
        $reportrange_two1 = substr($request->reportrange1, 0, 10);
        $reportrange_two2 = substr($request->reportrange1, 13, 24);

        $degree_level1 = $request->degree_level1;
        $zone1 = $request->zone1;
        $cptcode1 = $request->cptcode1;
        $modifire1 = $request->modifire1;
        $pos1 = $request->pos1;
        $zero_units_one = $request->zero_units_one;
        $name_location = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        $admin_id = $this->admin_id;


//        $query = "SELECT * FROM processing_claims WHERE admin_id=$admin_id AND payor_id = $payor_id AND is_mark_gen=0  AND status !='Unbillable Activity' ";

        if ($name_location->is_combo == 1) {
            $payor_filter = implode("','", $payor_id);
            $query = "SELECT * FROM processing_claims WHERE admin_id=$admin_id AND payor_id IN('" . $payor_filter . "') AND is_mark_gen=0  AND status !='Unbillable Activity' ";
        } else {
            $query = "SELECT * FROM processing_claims WHERE admin_id=$admin_id AND payor_id = $payor_id AND is_mark_gen=0  AND status !='Unbillable Activity' ";
        }


        if (
            empty($client1) && empty($treating_therapist) && empty($cms_therapist) && empty($activitytype) && empty($ready_to_bill_status) && empty($reportrange) && empty($degree_level) && empty($zone) && empty($cptcode) && empty($modifire) &&
            empty($pos) && empty($zero_units) && empty($client2) && empty($treating_therapist1) && empty($cms_therapist1) && empty($ready_to_bill_status1) && empty($reportrange1) && empty($activitytype1) && empty($degree_level1) && empty($zone1) && empty($cptcode1) &&
            empty($modifire1) && empty($pos1) && empty($zero_units_one)
        ) {
            return 'not seleted';
        }

        if (isset($to_date)) {
            $query .= "AND schedule_date <= '$to_date_get' ";
        }

        if (isset($client1)) {
            $query .= "AND client_id =$client1 ";
        }

        if (isset($treating_therapist)) {
            $query .= "AND provider_id =$treating_therapist ";
        }

        if (isset($cms_therapist)) {
            $query .= "AND provider_id =$cms_therapist ";
        }

        if ($activitytype) {
            $query .= "AND activity_id =$activitytype ";
        }

        if ($ready_to_bill_status) {
            $query .= "AND status ='$ready_to_bill_status' ";
        }

        if (isset($reportrange)) {
            $query .= "AND schedule_date >= '$reportrange_one1' ";
            $query .= "AND schedule_date <= '$reportrange_one2' ";
        }


        if ($degree_level) {
            $query .= "AND degree_level ='$degree_level' ";
        }

        if ($zone) {
            $query .= "AND zone ='$zone' ";
        }

        if ($cptcode) {
            $query .= "AND cpt ='$cptcode' ";
        }

        if ($modifire) {
            $query .= "AND m1 ='$modifire' ";
            $query .= "OR m2 ='$modifire' ";
            $query .= "OR m3 ='$modifire' ";
            $query .= "OR m4 ='$modifire' ";
        }

        if ($pos) {
            $query .= "AND location ='$pos' ";
        }


        if ($zero_units) {
            $query .= "AND units=0.00 ";
            $query .= "OR units=0 ";
        }


        if ($client2) {
            $query .= "AND client_id =$client2 ";
        }

        if ($treating_therapist1) {
            $query .= "AND provider_id =$treating_therapist1 ";
        }

        if ($cms_therapist1) {
            $query .= "AND provider_id =$cms_therapist1 ";
        }

        if ($ready_to_bill_status1) {
            $query .= "AND status ='$ready_to_bill_status1' ";
        }


        if (isset($reportrange1)) {
            $query .= "AND schedule_date >= '$reportrange_two1' ";
            $query .= "AND schedule_date <= '$reportrange_two2' ";
        }

        if ($activitytype1) {
            $query .= "AND activity_id =$activitytype1 ";
        }

        if ($degree_level1) {
            $query .= "AND degree_level ='$degree_level1' ";
        }

        if ($zone1) {
            $query .= "AND zone ='$zone1' ";
        }

        if ($cptcode1) {
            $query .= "AND cpt_code ='$cptcode1' ";
        }

        if ($modifire1) {
            $query .= "AND m1 ='$modifire1' ";
            $query .= "OR m2 ='$modifire1' ";
            $query .= "OR m3 ='$modifire1' ";
            $query .= "OR m4 ='$modifire1' ";
        }


        if ($pos1) {
            $query .= "AND location ='$pos1' ";
        }


        if ($zero_units_one) {
            $query .= "AND units=0.00 ";
            $query .= "OR units=0 ";
        }

        $query .= "ORDER BY schedule_date ASC ";
        $query_exe = DB::select($query);

        $bill_data = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $bill_data,
            'view' => View::make('superadmin.billing.include.billing_table', compact('bill_data'))->render(),
            'pagination' => (string)$bill_data->links(),
        ]);
    }


    public function billing_record_get_next(Request $request)
    {
        $to_date = $request->to_date;
        $to_date_get = Carbon::parse($to_date)->format('Y-m-d');
        $payor_id = $request->payor_id;
        $client1 = $request->client1;
        $treating_therapist = $request->treating_therapist;
        $cms_therapist = $request->cms_therapist;
        $activitytype = $request->activitytype;
        $ready_to_bill_status = $request->ready_to_bill_status;

        $reportrange = $request->reportrange;
        $reportrange_one1 = substr($request->reportrange, 0, 10);
        $reportrange_one2 = substr($request->reportrange, 13, 24);

        $degree_level = $request->degree_level;
        $zone = $request->zone;
        $cptcode = $request->cptcode;
        $modifire = $request->modifire;
        $pos = $request->pos;
        $zero_units = $request->zero_units;

        $client2 = $request->client2;
        $treating_therapist1 = $request->treating_therapist1;
        $cms_therapist1 = $request->cms_therapist1;
        $activitytype1 = $request->activitytype1;
        $ready_to_bill_status1 = $request->ready_to_bill_status1;

        $reportrange1 = $request->reportrange1;
        $reportrange_two1 = substr($request->reportrange1, 0, 10);
        $reportrange_two2 = substr($request->reportrange1, 13, 24);

        $degree_level1 = $request->degree_level1;
        $zone1 = $request->zone1;
        $cptcode1 = $request->cptcode1;
        $modifire1 = $request->modifire1;
        $pos1 = $request->pos1;
        $zero_units_one = $request->zero_units_one;
        $name_location = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        $admin_id = $this->admin_id;


//        $query = "SELECT * FROM processing_claims WHERE admin_id=$admin_id AND payor_id = $payor_id AND is_mark_gen=0  AND status !='Unbillable Activity' ";

        if ($name_location->is_combo == 1) {
            $payor_filter = implode("','", $payor_id);
            $query = "SELECT * FROM processing_claims WHERE admin_id=$admin_id AND payor_id IN('" . $payor_filter . "') AND is_mark_gen=0  AND status !='Unbillable Activity' ";
        } else {
            $query = "SELECT * FROM processing_claims WHERE admin_id=$admin_id AND payor_id = $payor_id AND is_mark_gen=0  AND status !='Unbillable Activity' ";
        }


        if (
            empty($client1) && empty($treating_therapist) && empty($cms_therapist) && empty($activitytype) && empty($ready_to_bill_status) && empty($reportrange) && empty($degree_level) && empty($zone) && empty($cptcode) && empty($modifire) &&
            empty($pos) && empty($zero_units) && empty($client2) && empty($treating_therapist1) && empty($cms_therapist1) && empty($ready_to_bill_status1) && empty($reportrange1) && empty($activitytype1) && empty($degree_level1) && empty($zone1) && empty($cptcode1) &&
            empty($modifire1) && empty($pos1) && empty($zero_units_one)
        ) {
            return 'not seleted';
        }

        if (isset($to_date)) {
            $query .= "AND schedule_date <= '$to_date_get' ";
        }

        if (isset($client1)) {
            $query .= "AND client_id =$client1 ";
        }

        if (isset($treating_therapist)) {
            $query .= "AND provider_id =$treating_therapist ";
        }

        if (isset($cms_therapist)) {
            $query .= "AND provider_id =$cms_therapist ";
        }

        if ($activitytype) {
            $query .= "AND activity_id =$activitytype ";
        }

        if ($ready_to_bill_status) {
            $query .= "AND status ='$ready_to_bill_status' ";
        }

        if (isset($reportrange)) {
            $query .= "AND schedule_date >= '$reportrange_one1' ";
            $query .= "AND schedule_date <= '$reportrange_one2' ";
        }


        if ($degree_level) {
            $query .= "AND degree_level ='$degree_level' ";
        }

        if ($zone) {
            $query .= "AND zone ='$zone' ";
        }

        if ($cptcode) {
            $query .= "AND cpt ='$cptcode' ";
        }

        if ($modifire) {
            $query .= "AND m1 ='$modifire' ";
            $query .= "OR m2 ='$modifire' ";
            $query .= "OR m3 ='$modifire' ";
            $query .= "OR m4 ='$modifire' ";
        }

        if ($pos) {
            $query .= "AND location ='$pos' ";
        }


        if ($zero_units) {
            $query .= "AND units=0.00 ";
            $query .= "OR units=0 ";
        }


        if ($client2) {
            $query .= "AND client_id =$client2 ";
        }

        if ($treating_therapist1) {
            $query .= "AND provider_id =$treating_therapist1 ";
        }

        if ($cms_therapist1) {
            $query .= "AND provider_id =$cms_therapist1 ";
        }

        if ($ready_to_bill_status1) {
            $query .= "AND status ='$ready_to_bill_status1' ";
        }


        if (isset($reportrange1)) {
            $query .= "AND schedule_date >= '$reportrange_two1' ";
            $query .= "AND schedule_date <= '$reportrange_two2' ";
        }

        if ($activitytype1) {
            $query .= "AND activity_id =$activitytype1 ";
        }

        if ($degree_level1) {
            $query .= "AND degree_level ='$degree_level1' ";
        }

        if ($zone1) {
            $query .= "AND zone ='$zone1' ";
        }

        if ($cptcode1) {
            $query .= "AND cpt_code ='$cptcode1' ";
        }

        if ($modifire1) {
            $query .= "AND m1 ='$modifire1' ";
            $query .= "OR m2 ='$modifire1' ";
            $query .= "OR m3 ='$modifire1' ";
            $query .= "OR m4 ='$modifire1' ";
        }


        if ($pos1) {
            $query .= "AND location ='$pos1' ";
        }


        if ($zero_units_one) {
            $query .= "AND units=0.00 ";
            $query .= "OR units=0 ";
        }

        $query .= "ORDER BY schedule_date ASC ";
        $query_exe = DB::select($query);

        $bill_data = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $bill_data,
            'view' => View::make('superadmin.billing.include.billing_table', compact('bill_data'))->render(),
            'pagination' => (string)$bill_data->links(),
        ]);
    }


    public function billing_record_update(Request $request)
    {
        $gen = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();

        if ($request->action == 1) {
            $ids = $request->id;
//            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(['status' => 'Ready to Bill']);
            $claims = Processing_claim::whereIn('id', $ids)
                ->where('admin_id', $this->admin_id)
                ->get();
            $count_data = Processing_claim::where('status', 'Pending for Approval')->where('admin_id', $this->admin_id)->count();

            foreach ($claims as $clm) {
                $claim = Processing_claim::where('id', $clm->id)->where('admin_id', $this->admin_id)->first();

                $claim->status = "Ready to Bill";
                $claim->save();

                $batching_claim = Batching_claim::where('appointment_id', $claim->appointment_id)->first();
                if ($batching_claim) {
                    $batching_claim->status = "Ready to Bill";
                    $batching_claim->save();
                }
            }


            return $count_data;
        } elseif ($request->action == 2) {
            $ids = $request->id;
//            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(['status' => 'Pending for Approval']);
            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->get();
            $count_data = Processing_claim::where('status', 'Pending for Approval')->where('admin_id', $this->admin_id)->count();

            foreach ($claims as $clams) {
                $claim = Processing_claim::where('id', $clams->id)
                    ->where('admin_id', $this->admin_id)
                    ->first();
                $claim->status = "Pending for Approval";
                $claim->save();

                if ($gen->is_combo == 1) {
                    $batching_claim = Batching_claim::where('appointment_id', $claim->appointment_id)
                        ->where('processing_claim_id', $claim->id)
                        ->update(['status' => 'Pending for Approval']);

//                    if ($batching_claim) {
//                        $batching_claim->status = "Pending for Approval";
//                        $batching_claim->save();
//                    }
                } else {
                    $batching_claim = Batching_claim::where('appointment_id', $claim->appointment_id)->first();
                    if ($batching_claim) {
                        $batching_claim->status = "Pending for Approval";
                        $batching_claim->save();
                    }
                }

            }


            return $count_data;
        } elseif ($request->action == 3) {
            $ids = $request->id;
            //            $claims = Processing_claim::whereIn('id',$ids)->delete();

            $all_claims = Processing_claim::whereIn('id', $ids)->get();
            $combo_code = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();

            foreach ($all_claims as $clm) {

                if ($combo_code->is_combo == 1) {
                    $claim = Processing_claim::where('id', $clm->id)->where('admin_id', $this->admin_id)->first();

                    $batching_claim = Batching_claim::where('appointment_id', $claim->appointment_id)
                        ->where('processing_claim_id', $claim->id)
                        ->where('admin_id', $this->admin_id)
                        ->delete();


                    $claim->delete();

                    $count_com_pro = Processing_claim::where('appointment_id', $clm->appointment_id)->count();

                    if ($count_com_pro <= 0) {
                        $app_data = Appoinment::where('id', $clm->appointment_id)
                            ->where('admin_id', $this->admin_id)
                            ->first();
                        $app_data->is_locked = 0;
                        $app_data->save();
                    }
                } else {
                    $claim = Processing_claim::where('id', $clm->id)->where('admin_id', $this->admin_id)->first();

                    $app_data = Appoinment::where('id', $clm->appointment_id)->where('admin_id', $this->admin_id)->first();
                    $app_data->is_locked = 0;
                    $app_data->save();

                    $batching_claim = Batching_claim::where('appointment_id', $claim->appointment_id)->first();
                    if ($batching_claim) {
                        $batching_claim->delete();
                    }


                    $claim->delete();
                }


            }

            return 'done';
        } elseif ($request->action == 4) {
            $ids = $request->id;
//            if (Auth::user()->is_up_admin == 1) {
//                $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(['status' => 'Unbillable Activity']);
//            } else {
//                $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', Auth::user()->up_admin_id)->update(['status' => 'Unbillable Activity']);
//            }

            $all_claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->get();

            foreach ($all_claims as $claims) {
                $proc_claims = Processing_claim::where('id', $claims->id)->first();
                $proc_claims->status = "Unbillable Activity";
                $proc_claims->save();

                $batching_claim = Batching_claim::where('appointment_id', $claims->appointment_id)->first();
                if ($batching_claim) {
                    $batching_claim->status = "Unbillable Activity";
                    $batching_claim->save();
                }

            }


            return $claims;
        } elseif ($request->action == 5) {
            $ids = $request->id;
            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(['cms_24j' => $request->cms_provider_id]);
            $provider_name = Employee::where('id', $request->cms_provider_id)->first();
            return $provider_name;
        } elseif ($request->action == 6) {
            $ids = $request->id;
            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(['id_qualifier' => $request->id_qualifiers_val]);
            return $request->id_qualifiers_val;
        } elseif ($request->action == 7) {
            $ids = $request->id;
            $mo_one_val = $request->mo_one_val;
            $mo_one_two = $request->mo_two_val;
            $mo_one_three = $request->mo_three_val;
            $mo_one_four = $request->mo_four_val;
            if (!empty($mo_one_val)) {
                $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(
                    ['m1' => $mo_one_val]
                );
            }

            if (!empty($mo_one_two)) {
                $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(
                    ['m2' => $mo_one_two]
                );
            }

            if (!empty($mo_one_three)) {
                $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(
                    ['m3' => $mo_one_three]
                );
            }

            if (!empty($mo_one_four)) {
                $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(
                    ['m4' => $mo_one_four]
                );
            }
        } elseif ($request->action == 8) {
            $ids = $request->id;
            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->get();
            foreach ($claims as $claim) {
                $clm = Processing_claim::where('id', $claim->id)->where('admin_id', $this->admin_id)->first();
                $clm->units = round(floatval($clm->units));
                $clm->save();
            }
            return $claims;
        } elseif ($request->action == 9) {
            $ids = $request->id;
            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(['rate' => $request->rate_val]);
            return $claims;
        } elseif ($request->action == 10) {
            $ids = $request->id;
            $rate_array = [];
            foreach ($ids as $id) {
                $sing_claim = Processing_claim::select('id', 'admin_id', 'authorization_id', 'activity_id', 'rate', 'cpt')->where('id', $id)->first();
                if ($sing_claim) {
                    $auth = Client_authorization::select('id', 'admin_id', 'treatment_type', 'treatment_type_id')
                        ->where('admin_id', $this->admin_id)
                        ->where('id', $sing_claim->authorization_id)
                        ->first();
                    $act = Client_authorization_activity::select('id', 'admin_id', 'activity_one', 'activity_two', 'cpt_code')
                        ->where('admin_id', $this->admin_id)
                        ->where('id', $sing_claim->activity_id)
                        ->first();
                    $tret = Treatment_facility::where('treatment_name', $auth->treatment_type)->where('admin_id', $this->admin_id)->first();
                    $service = setting_service::where('admin_id', $this->admin_id)
                        ->where('facility_treatment_id', $tret->id)
                        ->where('description', $act->activity_one)
                        ->first();
                    $sub_type = all_sub_activity::where('admin_id', $this->admin_id)
                        ->where('facility_treatment_id', $tret->id)
                        ->where('service_id', $service->id)
                        ->where('sub_activity', $act->activity_two)
                        ->first();
                    $cpt = setting_cpt_code::where('facility_treatment_id', $tret->id)->where('cpt_id', $act->cpt_code)->first();


                    $check_rate_list = rate_list::select('id', 'admin_id', 'treatment_type', 'activity_type', 'sub_activity', 'cpt_code', 'billed_rate')
                        ->where('admin_id', $this->admin_id)
                        ->where('treatment_type', $tret->id) //16
                        ->where('activity_type', $service->id) // 23
                        ->where('sub_activity', $sub_type->id) // 21
                        ->where('cpt_code', $cpt->id) // 5
                        ->first();

                    if ($check_rate_list) {
                        $sing_claim->rate = $check_rate_list->billed_rate;
                        $sing_claim->save();
                    }

                    array_push($rate_array, $check_rate_list);
                }
            }


            return response()->json($rate_array, 200);


        } elseif ($request->action == 11) {
            $ids = $request->id;
            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->get();

            foreach ($claims as $clm) {
                $clm_data = Processing_claim::where('id', $clm->id)->where('admin_id', $this->admin_id)->first();

                if ($request->cpt_val != "" || $request->cpt_val != null) {
                    $clm_data->cpt = $request->cpt_val;
                }
                if ($request->unit_val != "" || $request->unit_val != null) {
                    $clm_data->units = $request->unit_val;
                }
                $clm_data->save();
            }
            return $claims;
        } elseif ($request->action == 12) {
            $ids = $request->id;
            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->get();
            foreach ($claims as $clm) {
                $clm_data = Processing_claim::where('id', $clm->id)->where('admin_id', $this->admin_id)->first();
                $clm_data->cms_24j = $clm->provider_id;
                $clm_data->save();
            }
            return $claims;
        } elseif ($request->action == 14) {
            $ids = $request->id;
            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->update(['location' => $request->pos_val]);
            return $claims;
        } else if ($request->action == 15) {
            $ids = $request->id;
            $claims = Processing_claim::whereIn('id', $ids)->where('admin_id', $this->admin_id)->get();
            foreach ($claims as $up_m) {
                $clm_data = Processing_claim::select('id', 'admin_id', 'm1', 'm2', 'm3', 'm4')->where('id', $up_m->id)->where('admin_id', $this->admin_id)->first();

                if ($clm_data->m1 == null || $clm_data->m1 == "") {
                    if ($clm_data->m1 == null || $clm_data->m1 == "") {
                        $clm_data->m1 = $request->tele_mod_value;
                    }
                } elseif ($clm_data->m1 != null || $clm_data->m1 != "") {

                    if ($clm_data->m2 == null || $clm_data->m2 == "") {
                        $clm_data->m2 = $request->tele_mod_value;
                    } elseif ($clm_data->m2 != null || $clm_data->m2 != "") {

                        if ($clm_data->m3 == null || $clm_data->m3 == "") {
                            $clm_data->m3 = $request->tele_mod_value;
                        } elseif ($clm_data->m3 != null || $clm_data->m3 != "") {
                            if ($clm_data->m4 == null || $clm_data->m4 == "") {
                                $clm_data->m4 = $request->tele_mod_value;
                            }
                        } else {
                        }
                    }
                } elseif ($clm_data->m2 != null || $clm_data->m2 != "") {

                    if ($clm_data->m3 == null || $clm_data->m3 == "") {
                        $clm_data->m3 = $request->tele_mod_value;
                    }
                } elseif ($clm_data->m3 != null || $clm_data->m3 != "") {

                    if ($clm_data->m4 == null || $clm_data->m4 == "") {
                        $clm_data->m4 = $request->tele_mod_value;
                    }
                }
                $clm_data->save();
            }
        } else {
            $ids = $request->id;
            $data = $request->all();

            for ($i = 0; $i < count($data['id']); $i++) {
                $claim = Processing_claim::where('id', $data['id'][$i])->where('admin_id', $this->admin_id)->first();
                $claim->cpt = isset($data['cpt'][$i]) ? $data['cpt'][$i] : null;
                $claim->m1 = isset($data['m1_name'][$i]) ? $data['m1_name'][$i] : null;
                $claim->m2 = isset($data['m2_name'][$i]) ? $data['m2_name'][$i] : null;
                $claim->m3 = isset($data['m3_name'][$i]) ? $data['m3_name'][$i] : null;
                $claim->m4 = isset($data['m4_name'][$i]) ? $data['m4_name'][$i] : null;
                $claim->location = isset($data['location'][$i]) ? $data['location'][$i] : null;
                $claim->units = isset($data['unit_name'][$i]) ? $data['unit_name'][$i] : null;
                $claim->rate = isset($data['rates_name'][$i]) ? $data['rates_name'][$i] : null;
                $claim->id_qualifier = isset($data['qualifier_id'][$i]) ? $data['qualifier_id'][$i] : null;
                $claim->save();
            }
        }
    }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 50;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


    public function billing_claim_management()
    {
        return view('superadmin.billing.billingClaimManagement');
    }


    public function billing_claim_management_view()
    {
        return view('superadmin.billing.billingClaimManagementView');
    }


    public function billing_claim_management_history()
    {
        return view('superadmin.billing.billingClaimManagementHistory');
    }
}
