<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Appoinment;
use App\Models\Appoinment_signature;
use App\Models\Appoinment_note;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\deposit;
use App\Models\Employee;
use App\Models\Employee_credential;
use App\Models\manage_claim;
use App\Models\manage_claim_transaction;
use App\Models\patient_statement;
use App\Models\ledger_list;
use App\Models\deposit_apply;
use App\Models\Processing_claim;
use App\Models\report_notification;
use App\Models\Employee_leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class SuperAdminDashboardController extends Controller
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


    public function barchart1()
    {
        $combo = \App\Models\setting_name_location::where('admin_id', $this->admin_id)->first();
        if ($combo->is_combo == 1) {
            return $this->treatment_analysis_with_combo();
        } else {
            return $this->treatment_analysis_without_combo();
        }
    }


    public function treatment_analysis_with_combo()
    {
        $month_array = array();
        $sum_array = array();
        $c_y = Carbon::now()->format('Y');
        $c_m = Carbon::now()->format('m');
        $to_date = Carbon::parse($c_y . '-' . $c_m . '-01')->format('Y-m-d');
        $from_date = Carbon::parse($to_date)->subMonth(2)->format('Y-m-d');
        $to_date = Carbon::parse($to_date)->addMonth(1)->format('Y-m-d');
        $to_date = Carbon::parse($to_date)->subDays(1)->format('Y-m-d');

        Carbon::useMonthsOverflow(false);
        $month_array[] = Carbon::now()->subMonth(2)->format('F');
        $month_array[] = Carbon::now()->subMonth(1)->format('F');
        $month_array[] = Carbon::now()->format('F');
        Carbon::resetMonthsOverflow();

        $admin_id = $this->admin_id;

        $cpt_array = [];

        $query = "SELECT cpt_code,SUM(time_duration) as cpt_total FROM appoinments WHERE (schedule_date between '$from_date' and '$to_date') AND admin_id='$admin_id' AND (cpt_code IS NOT NULL) GROUP by cpt_code ORDER by cpt_total DESC LIMIT 5";


        $cpts = DB::select(DB::raw($query));

        // $cpts=Appoinment::select('cpt_code')->distinct()->where('admin_id',$this->admin_id)->get();
        $i = 0;
        foreach ($cpts as $cpt) {

            $cpt_array[] = $cpt->cpt_code;
            Carbon::useMonthsOverflow(false);
            $month = Carbon::now()->subMonth(2)->format('m');
            $year = Carbon::now()->subMonth(2)->format('Y');
            Carbon::resetMonthsOverflow();

            $sum_array[$i][] = (Appoinment::where('admin_id', $admin_id)->where('cpt_code', $cpt->cpt_code)->where('status', 'Rendered')->whereMonth('schedule_date', '=', $month)->whereYear('schedule_date', '=', $year)->sum('time_duration')) / 60;

            Carbon::useMonthsOverflow(false);
            $month = Carbon::now()->subMonth(1)->format('m');
            $year = Carbon::now()->subMonth(1)->format('Y');
            Carbon::resetMonthsOverflow();

            $sum_array[$i][] = (Appoinment::where('admin_id', $admin_id)->where('cpt_code', $cpt->cpt_code)->where('status', 'Rendered')->whereMonth('schedule_date', '=', $month)->whereYear('schedule_date', '=', $year)->sum('time_duration')) / 60;

            $month = Carbon::now()->format('m');
            $year = Carbon::now()->format('Y');

            $sum_array[$i][] = (Appoinment::where('admin_id', $admin_id)->where('cpt_code', $cpt->cpt_code)->where('status', 'Rendered')->whereMonth('schedule_date', '=', $month)->whereYear('schedule_date', '=', $year)->sum('time_duration')) / 60;

            $i++;
        }

        return json_encode(array(
            "labels" => $month_array,
            "sum" => $sum_array,
            "label" => $cpt_array
        ));
    }


    private function treatment_analysis_without_combo()
    {
        $month_array = array();
        $sum_array = array();
        $c_y = Carbon::now()->format('Y');
        $c_m = Carbon::now()->format('m');
        $to_date = Carbon::parse($c_y . '-' . $c_m . '-01')->format('Y-m-d');
        $from_date = Carbon::parse($to_date)->subMonth(2)->format('Y-m-d');
        $to_date = Carbon::parse($to_date)->addMonth(1)->format('Y-m-d');
        $to_date = Carbon::parse($to_date)->subDays(1)->format('Y-m-d');

        Carbon::useMonthsOverflow(false);
        $month_array[] = Carbon::now()->subMonth(2)->format('F');
        $month_array[] = Carbon::now()->subMonth(1)->format('F');
        $month_array[] = Carbon::now()->format('F');
        Carbon::resetMonthsOverflow();

        $admin_id = $this->admin_id;

        $cpt_array = [];

        // $query = "SELECT cpt_code,SUM(time_duration) as cpt_total FROM appoinments WHERE (schedule_date between '$from_date' and '$to_date') AND admin_id='$admin_id' AND (cpt_code IS NOT NULL) GROUP by cpt_code ORDER by cpt_total DESC LIMIT 5";

        $query = "SELECT manage_claim_transactions.cpt as cpt_code,SUM(appoinments.time_duration) as cpt_total FROM manage_claim_transactions JOIN appoinments WHERE manage_claim_transactions.appointment_id = appoinments.id AND (manage_claim_transactions.schedule_date between '$from_date' and '$to_date') AND manage_claim_transactions.admin_id='$admin_id' AND (manage_claim_transactions.cpt IS NOT NULL) GROUP by manage_claim_transactions.cpt ORDER by cpt_total DESC LIMIT 5";


        $cpts = DB::select(DB::raw($query));

        // $cpts=Appoinment::select('cpt_code')->distinct()->where('admin_id',$this->admin_id)->get();
        $i = 0;
        foreach ($cpts as $cpt) {

            $cpt_array[] = $cpt->cpt_code;
            $cc = $cpt->cpt_code;
            Carbon::useMonthsOverflow(false);
            $month = Carbon::now()->subMonth(2)->format('m');
            $year = Carbon::now()->subMonth(2)->format('Y');
            Carbon::resetMonthsOverflow();

            $query = "SELECT m.cpt as cpt, SUM(a.time_duration) as cpt_total FROM manage_claim_transactions as m JOIN appoinments as a WHERE m.appointment_id = a.id AND MONTH(m.schedule_date) = '$month' AND YEAR(m.schedule_date) = '$year' AND m.admin_id='$admin_id' AND m.cpt = '$cc' GROUP by m.cpt ORDER by cpt_total DESC";
            $total_m = DB::select(DB::raw($query));
            if (count($total_m) > 0) {
                $tt = 0;
                foreach ($total_m as $ttime) {
                    $tt += $ttime->cpt_total;
                }
                $sum_array[$i][] = number_format($tt / 60, 2, '.', '');
            } else {
                $sum_array[$i][] = 0.00;
            }

            // $sum_array[$i][] = number_format((manage_claim_transaction::where('admin_id', $admin_id)->where('cpt_code', $cpt->cpt_code)->whereMonth('schedule_date', '=', $month)->whereYear('schedule_date', '=', $year)->sum('time_duration')) / 60,2,'.','');
            Carbon::useMonthsOverflow(false);
            $month = Carbon::now()->subMonth(1)->format('m');
            $year = Carbon::now()->subMonth(1)->format('Y');
            Carbon::resetMonthsOverflow();

            $query = "SELECT m.cpt as cpt, SUM(a.time_duration) as cpt_total FROM manage_claim_transactions as m JOIN appoinments as a WHERE m.appointment_id = a.id AND MONTH(m.schedule_date) = '$month' AND YEAR(m.schedule_date) = '$year' AND m.admin_id='$admin_id' AND m.cpt = '$cc' GROUP by m.cpt ORDER by cpt_total DESC";
            $total_m = DB::select(DB::raw($query));
            if (count($total_m) > 0) {
                $tt = 0;
                foreach ($total_m as $ttime) {
                    $tt += $ttime->cpt_total;
                }
                $sum_array[$i][] = number_format($tt / 60, 2, '.', '');
            } else {
                $sum_array[$i][] = 0.00;
            }

            $month = Carbon::now()->format('m');
            $year = Carbon::now()->format('Y');

            $query = "SELECT m.cpt as cpt, SUM(a.time_duration) as cpt_total FROM manage_claim_transactions as m JOIN appoinments as a WHERE m.appointment_id = a.id AND MONTH(m.schedule_date) = '$month' AND YEAR(m.schedule_date) = '$year' AND m.admin_id='$admin_id' AND m.cpt = '$cc' GROUP by m.cpt ORDER by cpt_total DESC";
            $total_m = DB::select(DB::raw($query));
            if (count($total_m) > 0) {
                $tt = 0;
                foreach ($total_m as $ttime) {
                    $tt += $ttime->cpt_total;
                }
                $sum_array[$i][] = number_format($tt / 60, 2, '.', '');
            } else {
                $sum_array[$i][] = 0.00;
            }

            $i++;
        }

        return json_encode(array(
            "labels" => $month_array,
            "sum" => $sum_array,
            "label" => $cpt_array
        ));
    }

    public function barchart2()
    {
        $month_array = array();
        $total_billed = array();
        $total_paid = array();

        for ($i = 0; $i < 7; $i++) {
            Carbon::useMonthsOverflow(false);
            if ($i == 6) {
                $month_array[] = Carbon::now()->format('F');
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->format('Y');
            } else {
                $m = 6 - $i;
                $month_array[] = Carbon::now()->subMonth($m)->format('F');
                $month = Carbon::now()->subMonth($m)->format('m');
                $year = Carbon::now()->subMonth($m)->format('Y');
            }
            Carbon::resetMonthsOverflow();

            $lines = ledger_list::where('admin_id', $this->admin_id)
                ->whereMonth('schedule_date', '=', $month)
                ->whereYear('schedule_date', '=', $year)->get();

            $t_am = 0;
            $t_paid = 0;

            foreach ($lines as $line) {

                $total_am = 0;
                $total_pay = 0;
                $deposit_aplly_1 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                    ->where('appointment_id', $line->appointment_id)
                    ->where('dos', $line->schedule_date)
                    ->where('admin_id', $line->admin_id)
                    ->first();

                $billed_am = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                    ->where('appointment_id', $line->appointment_id)
                    ->where('dos', $line->schedule_date)
                    ->where('admin_id', $line->admin_id)
                    ->sum('billed_am');

                $deposit_aplly_pay = deposit_apply::select('appointment_id', 'dos', 'admin_id')
                    ->where('appointment_id', $line->appointment_id)
                    ->where('dos', $line->schedule_date)
                    ->where('admin_id', $line->admin_id)
                    ->sum('payment');

                if ($deposit_aplly_1) {
                    $total_am += $billed_am;
                    $total_pay += $deposit_aplly_pay;
                } else {
                    $total_am += $line->billed_am;
                    $total_pay += 0.00;
                }

                $t_am += $total_am;
                $t_paid += $total_pay;
            }

            $total_billed[] = number_format($t_am, 2, '.', '');
            $total_paid[] = number_format($t_paid, 2, '.', '');
        }

        return json_encode(array(
            "labels" => $month_array,
            "sum" => array($total_billed, $total_paid)
        ));
    }

    public function linechart()
    {
        $month_array = array();
        $sum_array = array();


        for ($i = 0; $i < 7; $i++) {
            Carbon::useMonthsOverflow(false);
            if ($i == 6) {
                $month_array[] = Carbon::now()->format('F');
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->format('Y');
            } else {
                $m = 6 - $i;
                $month_array[] = Carbon::now()->subMonth($m)->format('F');
                $month = Carbon::now()->subMonth($m)->format('m');
                $year = Carbon::now()->subMonth($m)->format('Y');
            }
            Carbon::resetMonthsOverflow();

            $sum_array[] = number_format(ledger_list::where('admin_id', $this->admin_id)->whereMonth('schedule_date', '=', $month)->whereYear('schedule_date', '=', $year)->sum('billed_am'), 2, '.', '');
        }

        return json_encode(array(
            "labels" => $month_array,
            "sum" => $sum_array
        ));
    }

    public function auth_to_expire()
    {
        return view('superadmin.home.authToExpire');
    }


    public function auth_to_expire_get(Request $request)
    {

        $interval = $request->inter;
        if ($interval == 30) {
            $next_date = Carbon::now()->addDays(30)->format('Y-m-d');
        } else if ($interval == 60) {
            $next_date = Carbon::now()->addDays(60)->format('Y-m-d');
        } else if ($interval == 90) {
            $next_date = Carbon::now()->addDays(90)->format('Y-m-d');
        } else if ($interval == 120) {
            $next_date = Carbon::now()->addDays(120)->format('Y-m-d');
        }

        $now_date = Carbon::now()->format('Y-m-d');
        $client_auths = Client_authorization::select('id', 'client_id', 'payor_id', 'end_date', 'authorization_number', 'supervisor_id')
            ->where('admin_id', $this->admin_id)
            ->where('end_date', '<=', $next_date)
            ->where('end_date', '>=', $now_date)
            ->where('is_valid', 1)
            ->get();

        return response()->json([
            'notices' => $client_auths,
            'view' => View::make('superadmin.home.include.authToExpireTable', compact('client_auths'))->render(),
        ]);
    }

    public function non_payor_tag()
    {
        $client_auths = Client_authorization::select('client_id', 'payor_id','supervisor_id')->where('admin_id', $this->admin_id)->where('payor_id', 12)->get();
        return view('superadmin.home.nonPayorTag', compact('client_auths'));
    }

    public function without_plan_care()
    {
        $client_auths = Client_authorization::select('client_id')->where('admin_id', $this->admin_id)->get();
        $array = [];
        foreach ($client_auths as $clau_id) {
            array_push($array, $clau_id->client_id);
        }

        $clients = Client::whereNotIn('id', $array)->where('admin_id', $this->admin_id)->get();

        return view('superadmin.home.withoutPlanCare', compact('clients'));
    }

    public function todays_copay()
    {

        $client_auths = Client_authorization::select('client_id', 'copay','supervisor_id')->where('admin_id', $this->admin_id)
            ->where('copay', '!=', null)
            ->get();

        $array = [];
        foreach ($client_auths as $cl_au) {
            array_push($array, $cl_au->client_id);
        }

        $apps = Appoinment::select('client_id', 'authorization_id', 'schedule_date', 'provider_id')
            ->whereIn('client_id', $array)
            ->where('admin_id', $this->admin_id)
            ->where('schedule_date', Carbon::now()->format('Y-m-d'))
            ->get();

        return view('superadmin.home.todaysCopay', compact('apps'));
    }


    public function session_not_bulled()
    {

        $count_manage_claims = Processing_claim::select('admin_id', 'appointment_id')
            ->where('admin_id', $this->admin_id)
            ->where('is_mark_gen', 0)
            ->where('status', '!=', 'Unbillable Activity')
            ->get();

        $array = [];
        foreach ($count_manage_claims as $clam) {
            array_push($array, $clam->appointment_id);
        }

        $count_app = Appoinment::select('id', 'admin_id', 'client_id', 'payor_id', 'authorization_activity_id', 'schedule_date', 'status', 'is_mark_gen')
            ->whereIn('id', $array)
            ->where('admin_id', $this->admin_id)
            ->orderBy('schedule_date', 'asc')
            ->get();

        return view('superadmin.home.sessionNotBulled', compact('count_app'));
    }


    public function last_weeks_deposit()
    {
        $now = Carbon::now()->format('Y-m-d');
        $last_week = Carbon::now()->subDays(7)->format('Y-m-d');

        $deposits = deposit::where('admin_id', $this->admin_id)
            ->where('deposit_date', '>=', $last_week)
            ->where('deposit_date', '<=', $now)
            ->get();

        return view('superadmin.home.lastFiveDeposit', compact('deposits'));
    }


    public function last_five_statement()
    {



        $now = Carbon::now()->format('Y-m-d');
        $last_month = Carbon::now()->subDays(30)->format('Y-m-d');

        $statement = patient_statement::distinct()->select('client_id', 'admin_id', 'created_at')->where('admin_id', $this->admin_id)
            ->where('service_date', '>=', $last_month)
            ->where('service_date', '<=', $now)
            ->orderBy('client_id', 'desc')
            ->get();

        return view('superadmin.home.lastFiveStatement', compact('statement'));
    }

    public function last_month_bulled_data()
    {
        return view('superadmin.home.lastMonthBulledDates');
    }


    public function last_month_bulled_data_get(Request $request)
    {
        $last_month = Carbon::now()->subMonth()->month;

        $last_month_claim = manage_claim::distinct()->select('batch_id')
            ->where('admin_id', $this->admin_id)
            ->whereMonth('created_at', $last_month)
            ->get();

        return response()->json([
            'notices' => $last_month_claim,
            'view' => View::make('superadmin.home.include.lastMonthBulledTable', compact('last_month_claim'))->render(),
        ]);
    }


    public function last_month_bulled_data_filter(Request $request)
    {
        $type = $request->filtertype;
        if ($type == 1) {
            $spec_date = Carbon::parse($request->single_data)->format('Y-m-d');
            $last_month_claim = manage_claim::distinct()->select('batch_id')
                ->where('admin_id', $this->admin_id)
                ->whereDate('created_at', '=', $spec_date)
                ->get();

            return response()->json([
                'notices' => $last_month_claim,
                'view' => View::make('superadmin.home.include.lastMonthBulledTable', compact('last_month_claim'))->render(),
            ]);
        } elseif ($type == 2) {
            $dat_range_one = Carbon::parse(substr($request->reportrange, 0, 10))->format('Y-m-d');
            $dat_range_two = Carbon::parse(substr($request->reportrange, 13, 24))->format('Y-m-d');

            $last_month_claim = manage_claim::distinct()->select('batch_id')
                ->where('admin_id', $this->admin_id)
                ->whereDate('created_at', '>=', $dat_range_one)
                ->whereDate('created_at', '<=', $dat_range_two)
                ->get();

            return response()->json([
                'notices' => $last_month_claim,
                'view' => View::make('superadmin.home.include.lastMonthBulledTable', compact('last_month_claim'))->render(),
            ]);
        } else {
            return 'not found';
        }
    }


    public function last_month_bulled_data_details(Request $request)
    {
        $last_month_claim_details = manage_claim_transaction::where('admin_id', $this->admin_id)
            ->where('batch_id', $request->batch_id)
            ->where('admin_id', $this->admin_id)
            ->get();

        return response()->json([
            'notices' => $last_month_claim_details,
            'view' => View::make('superadmin.home.include.lastMonthBulledDetailsTable', compact('last_month_claim_details'))->render(),
        ]);
    }


    public function last_month_bulled_data_export(Request $request)
    {
        $filter_type = $request->filter_type;
        $select_date = $request->select_date;
        $date_rang_one = Carbon::parse(substr($request->date_range, 0, 10))->format('Y-m-d');
        $date_rang_two = Carbon::parse(substr($request->date_range, 13, 24))->format('Y-m-d');

        $file_name = "Last Month Billed Date-" . $this->admin_id . rand(000000, 999999);
        if ($filter_type == 0) {
            return back()->with('alert', 'Please Select Date Type');
        }
        $new_report_noti = new report_notification();
        $new_report_noti->admin_id = $this->admin_id;
        $new_report_noti->user_id = Auth::user()->id;
        $new_report_noti->name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $new_report_noti->file_name = "Last Month Billed Date-" . $this->admin_id . rand(000000, 999999);
        $new_report_noti->report_name = "Last Month Billed Date";
        $new_report_noti->report_type = 21;
        if ($filter_type == 1) {
            $new_report_noti->form_date = Carbon::parse($select_date)->format('Y-m-d');
        } else {
            $new_report_noti->form_date = Carbon::parse($date_rang_one)->format('Y-m-d');
            $new_report_noti->to_date = Carbon::parse($date_rang_two)->format('Y-m-d');
        }

        $new_report_noti->status = 'Pending';
        $new_report_noti->filter_type = $filter_type;
        $new_report_noti->type = 1;
        $new_report_noti->save();
        return back()->with('success', 'Last Month Billed Successfully Exported');
    }


    public function scheduled_not_rendered()
    {
        $not_rendered = Appoinment::where('admin_id', $this->admin_id)
            ->where('status', 'Scheduled')
            ->orderBy('schedule_date', 'desc')
            ->get();

        return view('superadmin.home.scheduledNotRendered', compact('not_rendered'));
    }

    public function scheduled_not_attended_last_week()
    {
        $now = Carbon::now()->format('Y-m-d');
        $lastsev_day = Carbon::now()->subDays(7)->format('Y-m-d');

        $not_attended_last_week = Appoinment::where('admin_id', $this->admin_id)
            ->where(function ($q) {
                $q->where('status', 'Cancelled by Client')
                    ->orWhere('status', 'Cancelled by Provider')
                    ->orWhere('status', 'CC more than 24 hrs')
                    ->orWhere('status', 'CC less than 24 hrs')
                    ->orWhere('status', 'No Show');
            })
            ->where('schedule_date', '>=', $lastsev_day)
            ->where('schedule_date', '<=', $now)
            ->get();

        return view('superadmin.home.scheduledNotAttendedWeek', compact('not_attended_last_week'));
    }

    public function session_note_missing()
    {
        $notes = \App\Models\Session_notes_avail::select('id', 'admin_id', 'session_id')->where('admin_id', $this->admin_id)->get();
        $array = [];
        foreach ($notes as $note) {
            array_push($array, $note->session_id);
        }

        $apps = Appoinment::where('admin_id', $this->admin_id);

        if (count($array) > 0) {
            $apps = $apps->whereNotIn('id', $array);
        }

        $apps = $apps->get();

        return view('superadmin.home.sessionNoteMissing', compact('apps'));
    }


    public function cancelled_session()
    {

        $v1 = "Cancelled by Client";
        $v2 = "CC more than 24 hrs";
        $v3 = "CC less than 24 hrs";
        $v4 = "Cancelled by Provider";

        $apps = Appoinment::where('admin_id', $this->admin_id)
            ->where(function ($query) use ($v1, $v2, $v3, $v4) {
                $query->where('status', '=', $v1);
                $query->orWhere('status', '=', $v2);
                $query->orWhere('status', '=', $v3);
                $query->orWhere('status', '=', $v4);
            });
        if ($this->admin_id == 33) {
            $apps = $apps->where('schedule_date', '>=', '2022-08-01');
        }

        $apps = $apps->get();

        return view('superadmin.home.cancelledSession', compact('apps'));
    }


    public function auth_place_holder()
    {
        $client_auth = Client_authorization::where('is_placeholder', 1)->where('admin_id', $this->admin_id)->get();
        return view('superadmin.home.authPlaceHolder', compact('client_auth'));
    }


    public function vacation_pending()
    {

        $vacations = Employee_leave::where('admin_id', $this->admin_id)->get();
        return view('superadmin.home.vacationPenidng', compact('vacations'));
    }


    public function missing_credentials()
    {

        $get_empo = Employee::select('id', 'admin_id')->where('admin_id', $this->admin_id)->get();
        $array_no_con = [];
        foreach ($get_empo as $gemn) {
            $check_cren = Employee_credential::where('employee_id', $gemn->id)->count();
            if ($check_cren <= 0) {
                array_push($array_no_con, $gemn->id);
            }
        }


        $employee = Employee::whereIn('id', $array_no_con)->get();

        return view('superadmin.home.missingCredentials', compact('employee'));
    }


    public function credentials_expire()
    {

        $get_empo = Employee::select('id', 'admin_id')->where('admin_id', $this->admin_id)->get();

        $array = [];
        foreach ($get_empo as $gem) {
            array_push($array, $gem->id);
        }
        $cot_now_dt = Carbon::now()->format('Y-m-d');
        $employee = Employee_credential::whereIn('employee_id', $array)
            ->where('credential_date_expired', '<', $cot_now_dt)
            ->get();


        return view('superadmin.home.credentialsExpire', compact('employee'));
    }

    public function credentialsExpireGet(Request $request)
    {

        $interval = $request->inter;
        if ($interval == 30) {
            $old_date = Carbon::now()->subDays(30)->format('Y-m-d');
        } else if ($interval == 60) {
            $old_date = Carbon::now()->subDays(60)->format('Y-m-d');
        } else if ($interval == 90) {
            $old_date = Carbon::now()->subDays(90)->format('Y-m-d');
        }

        $now_date = Carbon::now()->format('Y-m-d');


        $get_empo = Employee::select('id', 'admin_id')->where('admin_id', $this->admin_id)->get();

        $array = [];
        foreach ($get_empo as $gem) {
            array_push($array, $gem->id);
        }

        $employee = Employee_credential::whereIn('employee_id', $array)
            ->where('credential_date_expired', '>=', $old_date)
            ->where('credential_date_expired', '<=', $now_date)
            ->get();

        return response()->json([
            'notices' => $employee,
            'view' => View::make('superadmin.home.include.credentialsExpireTable', compact('employee'))->render(),
        ]);
    }



    public function sinature_not_upload()
    {
        return view('superadmin.home.signatureNotUpload');
    }


    public function pending_secondary()
    {
        return view('superadmin.home.pendingSecondary');
    }

    public function prov_missing_sign_sess()
    {
        $sign = Appoinment_signature::where('admin_id', $this->admin_id)->where('signature', '!=', null)->get();
        $arr = [];

        if (count($sign) > 0) {
            foreach ($sign as $sig) {
                array_push($arr, $sig->session_id);
            }
        }


        $apps = Appoinment::whereNotIn('id', $arr)->where('admin_id', $this->admin_id)
            ->where('billable', '=', '1')->orderBy('provider_id', 'desc')
            ->orderBy('schedule_date', 'desc')
            ->get();

        return view('superadmin.home.providerMissSignSess', compact('apps'));
    }

    public function schedule_billable()
    {
        return view('superadmin.home.scheduleBillable');
    }


    public function payment_deposit()
    {
        return view('superadmin.home.paymentDeposit');
    }
}
