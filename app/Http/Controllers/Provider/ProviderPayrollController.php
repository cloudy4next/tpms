<?php

namespace App\Http\Controllers\Provider;

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

class ProviderPayrollController extends Controller
{
    public function payroll_timesheet()
    {
        return view('provider.payroll.timesheet');
    }

    public function payroll_pay_time_get(Request $request)
    {
        $pay_period = pay_period::select('id', 'start_date', 'end_date')->where('admin_id', Auth::user()->admin_id)->get();
        return response()->json($pay_period, 200);
    }


    public function payroll_get_payor_by_payid(Request $request)
    {
        $pay_data = pay_period::select('id', 'start_date', 'end_date')->where('id', $request->pay_id)->first();

        $appoinments = Appoinment::distinct()->select('provider_id', 'schedule_date')
            ->where('admin_id', Auth::user()->admin_id)
            ->where('provider_id', Auth::user()->id)
            ->whereBetween('schedule_date', [$pay_data->start_date, $pay_data->end_date])
            ->get();

        $array = [];
        foreach ($appoinments as $app) {
            array_push($array, $app->provider_id);
        }

        $provider = Employee::select('id', 'full_name')->where('admin_id', Auth::user()->admin_id)->whereIn('id', $array)->get();


        return response()->json($provider, 200);
    }


    public function payroll_timesheet_appoinment(Request $request)
    {
        $pay_data = pay_period::select('id', 'start_date', 'end_date')->where('id', $request->pay_id)->first();

        $pov_id = [];
        array_push($pov_id,Auth::user()->id);
        $admin_id = Auth::user()->admin_id;
        $status=$request->status;


        $app_data = DB::table('appoinments')->select('admin_id', 'id', 'schedule_date', 'client_id', 'authorization_activity_id', 'week_day_name', 'from_time', 'to_time','provider_id')
            ->where('admin_id', Auth::user()->admin_id)
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
                $new_timesheet->admin_id = $admin_id;
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
            'view' => View::make('provider.payroll.include.payrollTimesheetTable', compact('query_exe'))->render(),
        ]);
    }


    public function payroll_timesheet_save(Request $request)
    {
        $pay_data = pay_period::select('id', 'time_sheet_date')->where('id', $request->pay_id)->first();
        $current_date=Carbon::now();
        $all_ids = $request->ids;
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


    public function payroll_timesheet_single_delete(Request $request)
    {
        $delete_sheet = timesheet::where('id', $request->d_id)->first();
        if ($delete_sheet) {
            $delete_sheet->delete();
        }
        return response()->json('done', 200);
    }


    public function payroll_timesheet_bydayname(Request $request)
    {


        $day_name = $request->dayname;
        $pay_data = pay_period::select('id', 'start_date', 'end_date')->where('id', $request->payroll_time)->first();
        $status=$request->status;
        $pov_id = [];
        array_push($pov_id,Auth::user()->id);

        $admin_id = Auth::user()->admin_id;
        $query = "SELECT timesheets.*, employees.full_name FROM timesheets LEFT JOIN employees ON timesheets.provider_id=employees.id WHERE timesheets.admin_id=$admin_id AND timesheets.is_del = 1 AND timesheets.status <> 'Completed' ";
        $pov_id = implode("','", $pov_id);
        $query .= "AND timesheets.provider_id IN('" . $pov_id . "') ";
        if (isset($pay_data)) {
            $query .= "AND timesheets.schedule_date >= '$pay_data->start_date' ";
            $query .= "AND timesheets.schedule_date <= '$pay_data->end_date' ";
        }
        $query .= "AND week_day='$day_name' ";
        if($status!=0){
            $query .= "AND timesheets.submitted = '$status' ";
        }
        $query .= "ORDER BY employees.full_name ASC, ";
        $query .= "timesheets.schedule_date ASC; ";
        $query_exe = DB::select($query);

        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('provider.payroll.include.payrollTimesheetTable', compact('query_exe'))->render(),
        ]);
    }


    public function submit_timesheet(Request $request){
        $datas = timesheet::select('id','submitted')->whereIn('id', $request->ids)->get();
        foreach($datas as $data){
            $data->submitted=1;
            $data->save();
        }
        return "success";
    }


}
