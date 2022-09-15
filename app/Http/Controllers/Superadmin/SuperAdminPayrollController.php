<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Appoinment;
use App\Models\Employee;
use App\Models\Employee_payroll;
use App\Models\pay_period;
use App\Models\timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class SuperAdminPayrollController extends Controller
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


    public function payroll()
    {
        return view('superadmin.payroll.processPayroll');
    }


    public function payroll_pay_time_get(Request $request)
    {
        //        $pay_period = pay_period::select('id', 'show_start_date', 'show_end_date')->where('admin_id', $this->admin_id)->get();
        $pay_period = pay_period::select('id', 'start_date', 'end_date')->where('admin_id', $this->admin_id)->get();


        return response()->json($pay_period, 200);
    }


    public function payroll_get_payor_by_payid(Request $request)
    {
        $pay_data = pay_period::select('id', 'admin_id', 'start_date', 'end_date')
            ->where('id', $request->pay_id)
            ->where('admin_id', $this->admin_id)
            ->first();


        $appoinments = Appoinment::distinct()->select('admin_id', 'provider_id', 'schedule_date')
            ->where('admin_id', $this->admin_id)
            ->whereBetween('schedule_date', [$pay_data->start_date, $pay_data->end_date])
            ->get();

        $array = [];
        foreach ($appoinments as $app) {
            array_push($array, $app->provider_id);
        }

        $provider = Employee::select('id', 'full_name')->where('admin_id', $this->admin_id)->whereIn('id', $array)->orderBy('full_name','asc')->get();

        return response()->json($provider, 200);

    }


    public function payroll_process_get_data(Request $request)
    {

        $pay_data = pay_period::select('id', 'start_date', 'end_date')->where('id', $request->pay_id)->first();

        $pov_id = $request->prov_id;

        $admin_id = $this->admin_id;
        $query = "SELECT timesheets.*, employees.full_name FROM timesheets LEFT JOIN employees ON timesheets.provider_id=employees.id WHERE timesheets.admin_id=$admin_id AND timesheets.is_del = 1 AND timesheets.submitted = 1 AND timesheets.status <> 'Completed' AND timesheets.status <> 'Acceptance Approved' ";
        $pov_id = implode("','", $pov_id);
        $query .= "AND timesheets.provider_id IN('" . $pov_id . "') ";
        if (isset($pay_data)) {
            $query .= "AND timesheets.schedule_date >= '$pay_data->start_date' ";
            $query .= "AND timesheets.schedule_date <= '$pay_data->end_date' ";
        }


        $query .= "ORDER BY employees.full_name ASC, ";
        $query .= "timesheets.schedule_date ASC; ";
        $query_exe = DB::select($query);

        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.payroll.include.payrollProcessTable', compact('query_exe'))->render(),
        ]);


    }


    public function payroll_process_update(Request $request)
    {
        $data = $request->all();

        for ($i = 0; $i < count($data['ids']); $i++) {
            $update_process = timesheet::select('id', 'acceped_hours', 'acceped_mileage')
                ->where('id', $data['ids'][$i])
                ->first();
            $update_process->acceped_hours = isset($data['hours'][$i]) ? $data['hours'][$i] : $update_process->acceped_hours;
            $update_process->acceped_mileage = isset($data['mileages'][$i]) ? $data['mileages'][$i] : $update_process->acceped_mileage;
            if($request->status!='updating'){
                $update_process->status=$request->status;
            }
            $update_process->save();
        }

        return response()->json('done', 200);
    }


    public function submit_payroll()
    {
        return view('superadmin.payroll.submitPayroll');
    }


    public function submit_payroll_get(Request $request)
    {
        $pay_data = pay_period::select('id', 'start_date', 'end_date')->where('id', $request->pay_id)->first();
        $admin_id = $this->admin_id;
        $query = "SELECT timesheets.*, employees.full_name FROM timesheets LEFT JOIN employees ON timesheets.provider_id=employees.id WHERE timesheets.admin_id=$admin_id AND timesheets.is_del = 1 AND timesheets.submitted = 1 AND timesheets.status = 'Acceptance Approved' ";
        if (isset($pay_data)) {
            $query .= "AND timesheets.schedule_date >= '$pay_data->start_date' ";
            $query .= "AND timesheets.schedule_date <= '$pay_data->end_date' ";
        }
        $query .= "ORDER BY employees.full_name ASC, ";
        $query .= "timesheets.schedule_date ASC; ";
        $query_exe = DB::select($query);

        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.payroll.include.payrollSubmitTable', compact('query_exe'))->render(),
        ]);
    }

    public function submit_payroll_update(Request $request){
        $data = $request->all();

        for ($i = 0; $i < count($data['ids']); $i++) {
            $update_process = timesheet::select('id', 'status')
                ->where('id', $data['ids'][$i])
                ->first();
            $update_process->status=$request->status;
            $update_process->save();
        }

        return response()->json('done', 200);

    }

    public function completed_payroll()
    {
        return view('superadmin.payroll.processedLastPayroll');
    }

    public function completed_payroll_pay_time_get(Request $request)
    {
//        $pay_period = pay_period::select('id', 'show_start_date', 'show_end_date')->where('admin_id', $this->admin_id)->get();
        $pay_period = pay_period::select('id', 'start_date', 'end_date')->where('admin_id', $this->admin_id)->get();


        return response()->json($pay_period, 200);
    }


    public function completed_payroll_get_payor_by_payid(Request $request)
    {
        $pay_data = pay_period::select('id', 'admin_id', 'start_date', 'end_date')
            ->where('id', $request->pay_id)
            ->where('admin_id', $this->admin_id)
            ->first();


        $appoinments = Appoinment::distinct()->select('admin_id', 'provider_id', 'schedule_date')
            ->where('admin_id', $this->admin_id)
            ->whereBetween('schedule_date', [$pay_data->start_date, $pay_data->end_date])
            ->get();

        $array = [];
        foreach ($appoinments as $app) {
            array_push($array, $app->provider_id);
        }

        $provider = Employee::select('id', 'full_name')->where('admin_id', $this->admin_id)->whereIn('id', $array)->orderBy('full_name','asc')->get();

        return response()->json($provider, 200);

    }

    public function completed_payroll_update_status(Request $request){
        $ids=$request->ids;
        $status=$request->status;
        $timesheet=timesheet::whereIn('id',$ids)->get();
        foreach($timesheet as $ts){
            $ts->status=$status;
            $ts->save();
        }

        return response()->json('done', 200);
    }

    public function completed_payroll_get(Request $request)
    {
        $pay_data = pay_period::select('id', 'start_date', 'end_date')->where('id', $request->pay_id)->first();
        $admin_id = $this->admin_id;
        $pov_id=$request->prov_id;
        $query = "SELECT timesheets.*, employees.full_name FROM timesheets LEFT JOIN employees ON timesheets.provider_id=employees.id WHERE timesheets.admin_id=$admin_id AND timesheets.is_del = 1 AND timesheets.submitted = 1 AND timesheets.status = 'Completed' ";
        if (isset($pay_data)) {
            $query .= "AND timesheets.schedule_date >= '$pay_data->start_date' ";
            $query .= "AND timesheets.schedule_date <= '$pay_data->end_date' ";
        }
        $pov_id = implode("','", $pov_id);
        $query .= "AND timesheets.provider_id IN('" . $pov_id . "') ";
        $query .= "ORDER BY employees.full_name ASC, ";
        $query .= "timesheets.schedule_date ASC; ";
        $query_exe = DB::select($query);

        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.payroll.include.payrollCompletedTable', compact('query_exe'))->render(),
        ]);
    }

    public function payroll_timesheet()
    {
        return view('superadmin.payroll.payrollTimesheet');
    }


    public function payroll_timesheet_appoinment(Request $request)
    {

        $pay_data = pay_period::select('id', 'start_date', 'end_date')->where('id', $request->pay_id)->first();

        $pov_id = $request->staff_provider;
        $status= $request->status;


        $app_data = DB::table('appoinments')->select('admin_id', 'id', 'schedule_date', 'client_id', 'authorization_activity_id', 'week_day_name', 'from_time', 'to_time','provider_id')
            ->where('admin_id', $this->admin_id)
            ->whereIn('provider_id', $pov_id)
            ->where('schedule_date', '>=', $pay_data->start_date)
            ->where('schedule_date', '<=', $pay_data->end_date)
            ->where('status','Rendered')
            ->get();

        foreach ($app_data as $app) {
            $check_exists = timesheet::where('appointment_id', $app->id)->first();

            $check_prov = Employee_payroll::select('id', 'employee_id', 'milage_rate', 'service_id')->where('employee_id', $app->provider_id)->first();

            if (!$check_exists) {

                $d = new \DateTime($app->schedule_date);
                $week=$d->format('l');

                //                $time_one = Carbon::parse($app->from_time)->format('g:i a');
                $timeIn_one = Carbon::parse($app->from_time)->format('g');
                $timeIn_two = Carbon::parse($app->from_time)->format('i');
                $timeIn_three = Carbon::parse($app->from_time)->format('a');


                // $time_two = Carbon::parse($app->to_time)->format('g:i a');
                $timeout_one = Carbon::parse($app->to_time)->format('g');
                $timeout_two = Carbon::parse($app->to_time)->format('i');
                $timeout_three = Carbon::parse($app->to_time)->format('a');


                $new_timesheet = new timesheet();
                $new_timesheet->admin_id = $this->admin_id;
                $new_timesheet->provider_id = $app->provider_id;
                $new_timesheet->appointment_id = $app->id;
                $new_timesheet->schedule_date = $app->schedule_date;

                $new_timesheet->timein_full = $app->from_time;
                $new_timesheet->timein_one = $timeIn_one;
                $new_timesheet->timein_two = $timeIn_two;
                $new_timesheet->timein_three = $timeIn_three;

                $new_timesheet->timeout_full = $app->to_time;
                $new_timesheet->timeout_one = $timeout_one;
                $new_timesheet->timeout_two = $timeout_two;
                $new_timesheet->timeout_three = $timeout_three;

                $new_timesheet->client_id = $app->client_id;
                $new_timesheet->activity_id = $app->authorization_activity_id;
                $new_timesheet->status = "Ready to Submit";
                $new_timesheet->week_day = $week;
                $new_timesheet->is_del = 1;
                $new_timesheet->submitted = 2;
                if ($check_prov) {
                    $new_timesheet->miles = $check_prov->milage_rate;
                } else {
                    $new_timesheet->miles = 0;
                }

                $new_timesheet->save();
            }
        }


        $admin_id = $this->admin_id;
        $query = "SELECT timesheets.*, employees.full_name FROM timesheets LEFT JOIN employees ON timesheets.provider_id=employees.id WHERE timesheets.admin_id=$admin_id AND timesheets.is_del = 1 AND timesheets.status <> 'Completed' ";
        $pov_id = implode("','", $pov_id);
        $query .= "AND timesheets.provider_id IN('" . $pov_id . "') ";
        if (isset($pay_data)) {
            $query .= "AND timesheets.schedule_date >= '$pay_data->start_date' ";
            $query .= "AND timesheets.schedule_date <= '$pay_data->end_date' ";
        }

        if($status!=0){
            $query .= "AND timesheets.submitted = '$status' ";
        }

        $query .= "ORDER BY employees.full_name ASC, ";
        $query .= "timesheets.schedule_date ASC; ";
        $query_exe = DB::select($query);


        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.payroll.include.payrollTimesheetTable', compact('query_exe'))->render(),
        ]);

    }


    public function payroll_timesheet_save(Request $request)
    {
        $all_ids = $request->ids;
        $pay_data = pay_period::select('id', 'time_sheet_date')->where('id', $request->pay_id)->first();
        $current_date=Carbon::now();
        $data = $request->all();

        for ($i = 0; $i < count($data['ids']); $i++) {
            $sheet = timesheet::where('id', $data['ids'][$i])->first();
            if($pay_data->time_sheet_date<$current_date){
                return "expired";
            }
            $sheet->timein_one = isset($data['timein_one'][$i]) ? $data['timein_one'][$i] : null;
            $sheet->timein_two = isset($data['timein_two'][$i]) ? $data['timein_two'][$i] : null;
            $sheet->timein_three = isset($data['timein_three'][$i]) ? $data['timein_three'][$i] : null;
            $sheet->timeout_one = isset($data['timeout_one'][$i]) ? $data['timeout_one'][$i] : null;
            $sheet->timeout_two = isset($data['timeout_two'][$i]) ? $data['timeout_two'][$i] : null;
            $sheet->timeout_three = isset($data['timeout_three'][$i]) ? $data['timeout_three'][$i] : null;
            $sheet->miles = isset($data['miles'][$i]) ? $data['miles'][$i] : null;
            $sheet->save();
        }

        return response()->json('done', 200);
    }


    public function payroll_timesheet_single(Request $request)
    {
        $delete_sheet = timesheet::whereIn('id', $request->d_id)->get();
        foreach($delete_sheet as $ub_sheet){
            $ub_sheet->is_del=2;
            $ub_sheet->save();
        }
        return response()->json('done', 200);
    }


    public function payroll_timesheet_bydayname(Request $request)
    {
        $day_name = $request->dayname;
        $pay_data = pay_period::select('id', 'start_date', 'end_date')->where('id', $request->payroll_time)->first();

        $pov_id = $request->staff_provider;
        $status=$request->status;


        $admin_id = $this->admin_id;
        $query = "SELECT timesheets.*, employees.full_name FROM timesheets LEFT JOIN employees ON timesheets.provider_id=employees.id WHERE timesheets.admin_id=$admin_id AND timesheets.is_del = 1 AND timesheets.status <> 'Completed' ";
        $pov_id = implode("','", $pov_id);
        $query .= "AND timesheets.provider_id IN('" . $pov_id . "') ";
        if (isset($pay_data)) {
            $query .= "AND timesheets.schedule_date >= '$pay_data->start_date' ";
            $query .= "AND timesheets.schedule_date <= '$pay_data->end_date' ";
        }
        if($status!=0){
            $query .= "AND timesheets.submitted = '$status' ";
        }
        $query .= "AND week_day='$day_name' ";
        $query .= "ORDER BY employees.full_name ASC, ";
        $query .= "timesheets.schedule_date ASC; ";
        $query_exe = DB::select($query);

        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.payroll.include.payrollTimesheetTable', compact('query_exe'))->render(),
        ]);

    }


    public function payroll_timesheet_unbillable(Request $request)
    {

        $admin_id = $this->admin_id;
        $query = "SELECT * FROM timesheets WHERE admin_id=$admin_id AND provider_id AND is_del = 2 ";
        $query .= "ORDER BY schedule_date ASC; ";
        $query_exe = DB::select($query);
        return view('superadmin.settingOtherSetup.unbillableTimesheet', compact('query_exe'));

    }


    public function revert_timesheet(Request $request)
    {

        $datas = timesheet::whereIn('id', $request->records)->get();
        foreach ($datas as $data) {
            $ud = timesheet::where('id', $data->id)->first();
            $ud->is_del = 1;
            $ud->save();
        }
        return "success";
    }

    public function submit_timesheet(Request $request){
        $datas = timesheet::select('id','submitted')->whereIn('id', $request->ids)->get();
        foreach($datas as $data){
            $data->submitted=1;
            $data->save();
        }
        return "success";
    }


    public function payroll_revert(Request $request){
        $datas = timesheet::select('id','submitted')->whereIn('id', $request->d_id)->get();
        foreach($datas as $data){
            $data->submitted=2;
            $data->save();
        }
        return "success";

    }


    public function get_all_payor(Request $request){

        $appoinments = Appoinment::distinct()->select('admin_id', 'provider_id')
            ->where('admin_id', $this->admin_id)
            ->get();

        $array = [];
        foreach ($appoinments as $app) {
            array_push($array, $app->provider_id);
        }

        $provider = Employee::select('id', 'full_name')->where('admin_id', $this->admin_id)->whereIn('id', $array)->orderBy('full_name','asc')->get();

        return response()->json($provider, 200);
    }


    public function fetch_signature_upload_data(Request $request){
        $provider_id=$request->provider_id;



        $range=$request->date_range;
        $range_from = Carbon::parse(substr($range, 0, 10))->format('Y-m-d');
        $range_to = Carbon::parse(substr($range, 13, 23))->format('Y-m-d');


        $sig_avail=\App\Models\Appoinment_signature::select('session_id')->where('admin_id',$this->admin_id)->whereIn('provider_id',$provider_id)->where('admin_id','!=',null)->where(function($q){
                $q->where('user_type',1)->orWhere('user_type',2);
            })->get();
        $s_arr=[];
        $my_arr=[];
        foreach($sig_avail as $s_a){
            array_push($s_arr,$s_a->session_id);
        }

        $s_arr= array_count_values($s_arr);
        foreach($s_arr as $x=>$val){
            if($val>=2){
                array_push($my_arr,$s_arr[$x]);
            }
        }



        $my_arr = implode("','", $my_arr);

        $provider_id = implode("','", $provider_id);
        $admin_id = $this->admin_id;

        $query = "SELECT a.schedule_date, a.id, a.client_id, a.provider_id, a.billable, a.from_time, a.to_time, a.status, a.authorization_activity_id, a.time_duration, e.full_name FROM appoinments as a JOIN employees as e ON a.provider_id=e.id WHERE a.admin_id=$admin_id ";
        $query .= "AND a.id NOT IN('" . $my_arr . "') ";
        $query .= "AND a.provider_id IN('" . $provider_id . "') ";
        $query .= "AND a.schedule_date >= '$range_from' ";
        $query .= "AND a.schedule_date <= '$range_to' ";
        $query .= "AND a.status = 'Rendered' ";
        $query .= "ORDER BY e.full_name ASC, ";
        $query .= "a.schedule_date ASC; ";


        $query_exe = DB::select($query);

        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.home.include.signatureNotUploadTable', compact('query_exe'))->render(),
        ]);


    }

}
