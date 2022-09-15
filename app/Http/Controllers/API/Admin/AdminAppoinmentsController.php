<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appoinment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminAppoinmentsController extends Controller
{
    public function get_appoinments(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'provider_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ], [
            'client_id.required' => 'Please Enter Client ID',
            'provider_id.required' => 'Please Enter Provider ID',
            'from_date.required' => 'Please Enter From Date',
            'to_date.required' => 'Please Enter To Date',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ]);
        } else {
            $client = $request->client_id;
            $provider = $request->provider_id;
            $form_date = Carbon::parse($request->from_date)->format('Y-m-d');
            $to_date = Carbon::parse($request->to_date)->format('Y-m-d');

            $appoinments = Appoinment::select('id', 'billable', 'client_id', 'authorization_id', 'authorization_activity_id', 'payor_id', 'provider_id', 'time_duration', 'from_time', 'to_time', 'cpt_code', 'schedule_date', 'status', 'created_at', 'updated_at')
                ->where('admin_id', Auth::user()->id)
                ->where('client_id', $client)
                ->where('provider_id', $provider)
                ->where('schedule_date', '>=', $form_date)
                ->where('schedule_date', '<=', $to_date)
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'get appoinments',
                'appoinments' => $appoinments
            ]);

        }


    }


    public function update_appoinments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'appoinment_id' => 'required',
            'provider_id' => 'required',
            'from_time' => 'required',
            'to_time' => 'required',
        ], [
            'appoinment_id.required' => 'Please Enter appoinment ID',
            'provider_id.required' => 'Please Enter Provider ID',
            'from_time.required' => 'Please Enter From Time',
            'to_time.required' => 'Please Enter To Time',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ]);
        } else {
            $update_appoinment = Appoinment::where('id', $request->appoinment_id)->where('admin_id', Auth::user()->id)->first();
            if ($update_appoinment) {

                $scdule_time_start = Carbon::parse($update_appoinment->schedule_date)->format('m/d/Y');
                $scdule_form_time_start = Carbon::parse($request->from_time)->format('H:i:s');
                $scdule_to_time_end = Carbon::parse($request->to_time)->format('H:i:s');


                $ft_check = Carbon::createFromFormat('m/d/Y H:i:s', $scdule_time_start . ' ' . Carbon::parse($scdule_form_time_start)->format('H:i:s'));
                $tt_check = Carbon::createFromFormat('m/d/Y H:i:s', $scdule_time_start . ' ' . Carbon::parse($scdule_to_time_end)->format('H:i:s'));

                $diff_time = $ft_check->diffInHours($tt_check);


                if ($diff_time > 8) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Session is more then 8 hours',
                    ]);
                    exit();
                }


                if ($ft_check > $tt_check) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Time in "To Time" is past than "From Time"',
                    ]);
                    exit();
                }


                $form_time_convert = Carbon::createFromFormat('H:i:s', Carbon::parse($scdule_form_time_start)->format('H:i:s'));


                $to_time_covert = Carbon::createFromFormat('H:i:s', Carbon::parse($scdule_to_time_end)->format('H:i:s'));


                $diff_form_to = $form_time_convert->diffInMinutes($to_time_covert);

                $start = new \DateTime($scdule_time_start);
                $time_stamp = strtotime($start->format('Y-m-d\TH:i:s.z\Z'));
                $date_time_data2 = Carbon::parse($time_stamp);
                $ses_form_time = new \DateTime($date_time_data2->format('Y-m-d') . ' ' . $form_time_convert->format('H:i:s'));
                $ses_to_time = Carbon::parse($ses_form_time)->addMinutes($diff_form_to);


                $update_appoinment->provider_id = $request->provider_id;
                $update_appoinment->from_time = $ses_form_time;
                $update_appoinment->to_time = $ses_to_time;
                $update_appoinment->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'appoinment successfully updated',
                ]);

            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'appoinment not found',
                ]);
            }
        }


    }

}
