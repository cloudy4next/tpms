<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\GoogleService;
use App\Jobs\UpdateAllExistAppoinment;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\client_color;
use App\Models\Client_info;
use App\Models\Employee;
use App\Models\setting_cpt_code;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderCalenderController extends Controller
{
    public function calender()
    {
        $provider = Employee::where('id', Auth::user()->id)->first();
        return view('provider.calender.calenderView', compact('provider'));
    }

    public function calender_get_all_cleint(Request $request)
    {
        $appoinemnts = Appoinment::select('client_id', 'provider_id')->where('provider_id', Auth::user()->id)->get();

        $array = [];
        foreach ($appoinemnts as $app) {
            array_push($array, $app->client_id);
        }

        $clients = Client::select('id', 'client_full_name')->whereIn('id', $array)->get();
        return response()->json($clients, 200); 
    }


    public function get_calender_data(Request $request)
    {

        $get_start = $request->start;
        $get_end = $request->end;

        $mil = $get_start;
        $seconds = ceil($mil / 1000);

        $mil2 = $get_end;
        $seconds2 = ceil($mil2 / 1000);

        $data1 = date('Y-m-d', $seconds);
        $data2 = date('Y-m-d', $seconds2);

        $events = Appoinment::where('provider_id', Auth::user()->id)
            ->where('schedule_date', '>=', $data1)
            ->where('schedule_date', '<=', $data2)
            ->get();


        //        $events = $eventQuery->get();
        $data = [];
        foreach ($events as $event) {


            //            $client = Client::where('id',$event->client_id)->first();
            $client = Client::where('id', $event->client_id)->first();

            if ($client) {
                $client_name = Auth::user()->last_name . ' ' . Auth::user()->first_name[0] . ' : ' . substr($client->client_last_name, 0, 2) . ' ' . substr($client->client_first_name, 0, 2);
                $client_color = client_color::where('provider_id', Auth::user()->id)->where('client_id', $client->id)->first();
            } else {
                $client_name = Auth::user()->last_name . ' ' . Auth::user()->first_name[0];
                $client_color = client_color::where('provider_id', Auth::user()->id)->where('client_id', 0)->first();
            }


            $event['start_time'] = date('g:iA', strtotime($event['start_time']));
            $event['end_time'] = date('g:iA', strtotime($event['end_time']));
            $event['title'] = $client_name;

            if($event->location=='02' || $event->location=='10'){
                $event['icon']='camera';
            }
            else{
                $event['icon']="none";
            }


            if ($client_color) {
                if ($client_color->back_color != null) {
                    $event['textColor'] = "#212529";
                    $event['backgroundColor'] = $client_color->back_color;
                    $event['display'] = "block";
                } else {
                    $event['textColor'] = "#212529";
                    $event['eventBackgroundColor'] = "#E0EBF5";
                    $event['display'] = "block";
                }
            } else {
                $event['textColor'] = "#212529";
                $event['eventBackgroundColor'] = "#E0EBF5";
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


            $event['eventid'] = $event['id'];
            array_push($data, $event);
        }
        return response()->json($data);
    }


    public function get_calender_data_filter(Request $request)
    {
        $client = $request->calender_filter_client;
        $location = $request->calender_filter_location;

        $date_range = $request->calender_filter_reportrange;
        $reportrange_one1 = Carbon::parse(substr($request->calender_filter_reportrange, 0, 10))->format('Y-m-d');
        $reportrange_one2 = Carbon::parse(substr($request->calender_filter_reportrange, 13, 24))->format('Y-m-d');


        $get_start = $request->start;
        $get_end = $request->end;

        $mil = $get_start;
        $seconds = ceil($mil / 1000);

        $mil2 = $get_end;
        $seconds2 = ceil($mil2 / 1000);


        $status = $request->calender_filter_status;

        // $events = Appoinment::where('provider_id', Auth::user()->id)
        //     ->where(function ($query) use ($client, $employee, $location, $status, $reportrange_one1, $reportrange_one2) {
        //         $query->where('client_id', '=', $client);
        //         $query->orWhere('location', '=', $location);
        //         $query->orWhere('status', '=', $status);
        //         $query->orWhereBetween('schedule_date', [$reportrange_one1, $reportrange_one2]);
        //     })->get();


        $data1 = date('Y-m-d', $seconds);
        $data2 = date('Y-m-d', $seconds2);

        $events = Appoinment::where('provider_id', Auth::user()->id)
            ->where(function ($query) use ($client, $location, $status, $reportrange_one1, $reportrange_one2, $data1, $data2) {
                if (isset($client)) {
                    $query->whereIn('client_id', $client);
                }

                

                if (isset($location) && $location != null || $location != '') {
                    $query->where('location', '=', $location);
                }

                if (isset($status) && $status != null || $status != "") {
                    $query->where('status', '=', $status);
                }

                if (isset($date_range) && !empty($date_range)) {
                    $query->whereBetween('schedule_date', [$reportrange_one1, $reportrange_one2]);
                }

                $query->where('schedule_date', '>=', $data1);
                $query->where('schedule_date', '<=', $data2);

            })->get();


        $data = [];
        foreach ($events as $event) {
            //            $client = Client::where('id',$event->client_id)->first();
            $client = Client::where('id', $event->client_id)->first();

            if ($client) {
                $client_name = Auth::user()->last_name . ' ' . Auth::user()->first_name[0] . ' : ' . substr($client->client_last_name, 0, 2) . ' ' . substr($client->client_first_name, 0, 2);
            } else {
                $client_name = Auth::user()->last_name . ' ' . Auth::user()->first_name[0];
            }
            $client_color = client_color::where('provider_id', Auth::user()->id)->where('client_id', $client->id)->first();

            $event['start_time'] = date('g:iA', strtotime($event['start_time']));
            $event['end_time'] = date('g:iA', strtotime($event['end_time']));
            $event['title'] = $client_name;

            if($event->location=='02' || $event->location=='10'){
                $event['icon']='camera';
            }
            else{
                $event['icon']="none";
            }

            if ($client_color) {
                if ($client_color->back_color != null) {
                    $event['textColor'] = "#212529";
                    $event['backgroundColor'] = $client_color->back_color;
                    $event['display'] = "block";
                } else {
                    $event['textColor'] = "#212529";
                    $event['backgroundColor'] = "#E0EBF5";
                    $event['display'] = "block";
                }
            } else {
                $event['color'] = "#212529";
                $event['eventBackgroundColor'] = "#E0EBF5";
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


    public function single_calender_data(Request $request)
    {
        $app = Appoinment::where('id', $request->id)->first();
        if($app->billable==1){
            $client = Client::where('id', $app->client_id)->first();
            $email=$client->email;
            $name=$client->client_full_name;
        }
        else{
            $email="";
            $name="";
        }

        $payroll_check=\App\Models\timesheet::select('id')->where('admin_id',Auth::user()->admin_id)->where('appointment_id',$app->id)->where('submitted',1)->where('status','completed')->first();
        if($payroll_check){
            $pay_check=1;
        }
        else{
            $pay_check=2;
        }

        return response()->json([
            "data"=>$app,
            "email"=>$email,
            "pay_check" => $pay_check,
            "name"=>$name,
        ], 200);
    }

    public function appoinment_client_get(Request $request)
    {
        $client = Client::where('id', $request->client_id)->first();
        return response()->json($client, 200);
    }

    public function appoinment_client_auth_get(Request $request)
    {
        $client_auth = Client_authorization::where('client_id', $request->client_id)->get();
        return response()->json($client_auth, 200);
    }

    public function appoinment_client_auth_act_get(Request $request)
    {
        $auth_act = Client_authorization_activity::where('authorization_id', $request->auth_id)->get();
        return response()->json($auth_act, 200);
    }

    public function appoinment_get_all_provider(Request $request)
    {
        $employee = Employee::all();
        return response()->json($employee, 200);
    }


    public function appoinment_data_update(Request $request)
    {
        $appoienment = Appoinment::where('id', $request->id)->first();
        $appoienment->from_time = Carbon::parse($request->from_time);
        $appoienment->to_time = Carbon::parse(strtotime($request->from_time))->addMinutes($appoienment->time_duration);
        $appoienment->save();
        return response()->json($appoienment);
    }


    public function appoinment_update_single(Request $request)
    {
        $appoinemt_update = Appoinment::where('id', $request->callender_edit_single)->first();
        $appoinemt_update->status = $request->callender_status;
        $appoinemt_update->save();
        return redirect()->back()->with('success', 'Appointment Successfully Updated');
    }

    public function calender_get_data_sunc()
    {


        $timezone = Employee::select('timezone')->where('id', Auth::user()->id)->first();
        if(!$timezone || $timezone->timezone==null){
            return back()->with('alert',"Please set timezone in settings first!");
        }
        else{
            $g_service = new GoogleService(Auth::user(),"provider");
            $g_service->redirectc($g_service->authUrl());
        }
    }


    public function calender_get_redirect()
    {
        $timezone = Employee::select('timezone')->where('id', Auth::user()->id)->first();

        $timezone=$timezone->timezone;

        $g_service = new GoogleService(Auth::user(),"provider");
        $g_service->google_callback();

        $app_apps = Appoinment::select('id', 'admin_id', 'g_event_id', 'client_id', 'provider_id', 'from_time', 'to_time', 'status')
            ->where('provider_id', Auth::user()->id)
            ->where('status','Rendered')
            ->where(function($query){
                $query->where('pg_event_id',null)
                ->orWhere('pg_event_id',"");
            })
            ->get();

        foreach ($app_apps as $new_apponinemt) {
            UpdateAllExistAppoinment::dispatch($new_apponinemt,$timezone,"provider");
        }

        return redirect(route('provider.calender'));
    }


    public function getGoogleCalendarEvents($user, $eventId = false)
    {
        $g_service = new GoogleService(Auth::user(),"provider");
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
}
