<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\client_color;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientCallenderController extends Controller
{
    public function my_callender()
    {
        $provider = Employee::where('admin_id', Auth::user()->admin_id)->get();
        return view('client.callender.myCallender', compact('provider'));
    }

    public function my_callender_get_data(Request $request)
    {
        $get_start = $request->start;
        $get_end = $request->end;

        $mil = $get_start;
        $seconds = ceil($mil / 1000);

        $mil2 = $get_end;
        $seconds2 = ceil($mil2 / 1000);

        $data1 = date('Y-m-d', $seconds);
        $data2 = date('Y-m-d', $seconds2);

        $events = Appoinment::where('client_id', Auth::user()->id)
            ->where('schedule_date', '>=', $data1)
            ->where('schedule_date', '<=', $data2)
            ->get();


        //        $events = $eventQuery->get();
        $data = [];
        foreach ($events as $event) {


            //            $client = Client::where('id',$event->client_id)->first();
            $client = Client::where('id', $event->client_id)->first();
            $provider = Employee::where('id', $event->provider_id)->first();

            if ($provider) {
                $client_name = $provider->last_name . ' ' . $provider->first_name[0] . ' : ' . substr(Auth::user()->client_last_name, 0, 2) . ' ' . substr(Auth::user()->client_first_name, 0, 2);
                $client_color = client_color::where('provider_id', Auth::user()->id)->where('client_id', $client->id)->first();
            } else {
                $client_name = Auth::user()->client_last_name . ' ' . Auth::user()->client_first_name[0];
                $client_color = client_color::where('provider_id', $provider->id)->where('client_id', Auth::user()->id)->first();
            }


            $event['start_time'] = date('g:iA', strtotime($event['start_time']));
            $event['end_time'] = date('g:iA', strtotime($event['end_time']));
            $event['title'] = $client_name;


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


    public function my_callender_get_data_filter(Request $request)
    {

    }


    public function my_callender_session_drop(Request $request)
    {
        $appoienment = Appoinment::where('id', $request->id)->first();
        $appoienment->from_time = Carbon::parse($request->from_time);
        $appoienment->to_time = Carbon::parse(strtotime($request->from_time))->addMinutes($appoienment->time_duration);
        $appoienment->save();
        return response()->json($appoienment);
    }

    public function my_callender_get_single_data(Request $request)
    {
        $app = Appoinment::where('id', $request->id)->first();
        return response()->json($app, 200);
    }


    public function my_callender_get_client(Request $request)
    {
        $client = Client::where('id', $request->client_id)->first();
        return response()->json($client, 200);
    }

    public function my_callender_get_auth(Request $request)
    {
        $client_auth = Client_authorization::where('client_id', $request->client_id)->get();
        return response()->json($client_auth, 200);
    }

    public function my_callender_get_auth_act(Request $request)
    {
        $auth_act = Client_authorization_activity::where('authorization_id', $request->auth_id)->get();
        return response()->json($auth_act, 200);
    }

    public function my_callender_get_all_provider(Request $request)
    {
        $employee = Employee::where('admin_id', Auth::user()->admin_id)->get();
        return response()->json($employee, 200);
    }

    public function my_callender_appoinment_single_update(Request $request)
    {
        $appoinemt_update = Appoinment::where('id', $request->callender_edit_single)->first();
        $appoinemt_update->status = $request->callender_status;
        $appoinemt_update->save();
        return redirect()->back()->with('success', 'Appointment Successfully Updated');
    }


}
