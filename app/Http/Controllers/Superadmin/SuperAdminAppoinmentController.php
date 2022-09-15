<?php

namespace App\Http\Controllers\Superadmin;

use App\GoogleService;
use App\Http\Controllers\Controller;
use App\Jobs\UpdateAllExistAppoinment;
use App\Models\Appoinment;
use App\Models\Appoinment_note;
use App\Models\Client;
use App\Models\Client_activity;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Client_info;
use App\Models\Employee;
use App\Models\holiday_setup;
use App\Models\Recurring_session;
use App\Models\setting_cpt_code;
use App\Models\setting_service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use function Livewire\str;

use App\Custom\AppSession;

class SuperAdminAppoinmentController extends Controller
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


    public function get_all_client(Request $request)
    {
        $clients = Client::select('id', 'admin_id', 'client_full_name', 'is_active_client')
            ->where('admin_id', $this->admin_id)
            ->where('is_active_client', 1)
            ->orderby('client_first_name', 'asc')->get();

        $response = array();
        foreach ($clients as $client) {
            $response[] = array(
                "id" => $client->id,
                "text" => $client->client_full_name
            );
        }

        return $response;
    }


    public function get_all_employee(Request $request)
    {

        $employes = Employee::select('id', 'admin_id', 'full_name')->where('admin_id', $this->admin_id)
            ->where('is_active', 1)
            ->orderby('first_name', 'asc')
            ->get();
        return response()->json($employes);
    }


    public function get_single_client(Request $request)
    {
        $client = Client::where('admin_id', $this->admin_id)->where('id', $request->client_id)->first();
        if ($client) {
            return response()->json([
                "id" => $client->id,
                "name" => $client->client_full_name
            ], 200);
        } else {
            return response()->json('', 200);
        }
    }


    public function get_authorization_by_client(Request $request)
    {
        $client_id = $request->client_id;

        $employees = Client_authorization::select('id', 'admin_id', 'client_id', 'is_primary', 'is_valid', 'description', 'onset_date', 'end_date', 'authorization_number')->where('admin_id', $this->admin_id)
            ->where('client_id', $client_id)
            ->where('is_primary', 1)
            ->where('is_valid', 1)
            ->orderBy('authorization_name', 'asc')
            ->get();

        $response = array();
        foreach ($employees as $employee) {
            $response[] = array(
                "id" => $employee->id,
                "text" => $employee->description . '(' . Carbon::parse($employee->onset_date)->format('m.d.Y') . ' to ' . Carbon::parse($employee->end_date)->format('m.d.Y') . ')' . ' | ' . $employee->authorization_number
            );
        }

        return $response;
    }

    public function get_authorization_activity_by_auth_id(Request $request)
    {

        $auth_id = $request->auth_id;

        $employees = Client_authorization_activity::select('id', 'admin_id', 'activity_name', 'authorization_id')
            ->where('admin_id', $this->admin_id)
            ->where('authorization_id', $auth_id)
            ->orderby('activity_name', 'asc')
            ->get();


        $response = array();
        foreach ($employees as $employee) {
            $response[] = array(
                "id" => $employee->id,
                "text" => $employee->activity_name
            );
        }

        return $response;
    }


    public function get_authorization_activity_all(Request $request)
    {
        $employees = client_authorization_activity::where('admin_id', $this->admin_id)->orderby('activity_name', 'asc')->get();
        $response = array();
        foreach ($employees as $employee) {
            $response[] = array(
                "id" => $employee->id,
                "text" => $employee->activity_name
            );
        }

        echo json_encode($response);
    }


    public function get_all_provider(Request $request)
    {
        $employees = Employee::where('admin_id', $this->admin_id)
            ->where('is_active', 1)
            ->orderby('first_name', 'asc')
            ->get();
        $response = array();
        foreach ($employees as $employee) {
            $response[] = array(
                "id" => $employee->id,
                "text" => $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name
            );
        }

        return $response;
    }

    public function appoinement_save(Request $request){
        $app= new AppSession($this->admin_id);
        $check = $app->create_new_session($request);

        if($check == 'appoinemtcreated'){
            Client_activity::create([
                'admin_id' => $this->admin_id,
                'client_id' => $request->client_id,
                'title' => "Session Created",
                'message' => " Session Created ",
                'act_date' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
        return $check;
    }

    public function appoinement_update_get_details(Request $request)
    {
        $up_id = Appoinment::where('id', $request->id)->first();

        $client = Client::select('id', 'email', 'client_full_name')->where('id', $up_id->client_id)->first();

        if ($client) {
            $email = $client->email;
            $name = $client->client_full_name;
        } else {
            $email = 0;
            $name = '';
        }

        $form_time = Carbon::parse($up_id->from_time)->format('Y-m-d\TH:i');
        
        return response()->json([
            'status' => 'success',
            'app_data' => $up_id,
            'email' => $email,
            'name' => $name,
            'from_time' => $form_time,
        ]);
    }


    public function appoinement_update(Request $request)
    {
        $app= new AppSession($this->admin_id);
        $check = $app->update_session($request);
        return $check;
    }


    public function creatGoogleEvent($event, $evn_is_update)
    {
        $g_service = new GoogleService(Auth::user());
        $is_google_token_expired = $g_service->is_google_token_expired();
        if (!$is_google_token_expired) {
            try {
                $client = $g_service->google_client();
                $service = new \Google_Service_Calendar($client);
                $google_data = $this->set_data_according_google_calendar($event);
                $googleEvent = new \Google_Service_Calendar_Event($google_data);
                if ($evn_is_update == 'create') {
                    $ev_id = $service->events->insert($this->googleCalendarId(), $googleEvent);
                    $app_update = Appoinment::select('id', 'g_event_id')->where('id', $event->id)->first();

                    if ($app_update) {
                        $app_update->g_event_id = $ev_id->id;
                        $app_update->save();
                    }

                } else {
                    $ev_id = $service->events->update($this->googleCalendarId(), $event->g_event_id, $googleEvent);
                }

                return true;
            } catch (Exception $ex) {
                return false;
            }
        }
    }


    public function googleCalendarId()
    {
        return "primary";
    }


    public function set_data_according_google_calendar($event)
    {
        $client = Client::where('id', $event->client_id)->first();
        $name = Auth::user()->name . ' : ' . $client->client_full_name;

        $google_data = array();
        if (isset($event->client_id)) {
            $google_data['summary'] = $name;
        }
        if (isset($event->from_time)) {
            if (!$event->is_all_day) {
                $start = Carbon::createFromTimestamp(strtotime($event->from_time))->toIso8601String();
            } else {
                $start = $event->from_time;
            }
            $google_data['start'] = array(
                'dateTime' => $start
            );
        }
        if (isset($event->to_time)) {
            if (!$event->is_all_day) {
                $end = Carbon::createFromTimestamp(strtotime($event->to_time))->toIso8601String();
            } else {
                $end = $event->to_time;
            }
            $google_data['end'] = array(
                'dateTime' => $end
            );
        }
        if (isset($event->description)) {
            $google_data['description'] = $event->description;
        }
        if (isset($event->public)) {
            $google_data['visibility'] = "public";
        } else {
            $google_data['visibility'] = "private";
        }
        return $google_data;
    }


    public function update_google_callender($event)
    {
        $client = Client::where('id', $event->client_id)->first();
        $name = Auth::user()->name . ' : ' . $client->client_full_name;

        $google_data = array();
        if (isset($event->client_id)) {
            $google_data['summary'] = $name;
        }
        if (isset($event->from_time)) {
            if (!$event->is_all_day) {
                $start = Carbon::createFromTimestamp(strtotime($event->from_time))->toIso8601String();
            } else {
                $start = $event->from_time;
            }
            $google_data['start'] = array(
                'dateTime' => $start
            );
        }
        if (isset($event->to_time)) {
            if (!$event->is_all_day) {
                $end = Carbon::createFromTimestamp(strtotime($event->to_time))->toIso8601String();
            } else {
                $end = $event->to_time;
            }
            $google_data['end'] = array(
                'dateTime' => $end
            );
        }
        if (isset($event->description)) {
            $google_data['description'] = $event->description;
        }
        if (isset($event->public)) {
            $google_data['visibility'] = "public";
        } else {
            $google_data['visibility'] = "private";
        }
        return $google_data;
    }


    public function google_callender_single_session_delete($id)
    {
        $event = Appoinment::find($id);
        $is_google_token_expired = $this->google_service->is_google_token_expired();
        if ($is_google_token_expired) {
            $event->delete();
            return true;
        } else {
            if ($event->g_event_id != null || $event->g_event_id != '') {
                $g_service = new GoogleService(Auth::user());
                $client = $g_service->google_client();
                $service = new \Google_Service_Calendar($client);
                $service->events->delete($this->googleCalendarId(), $event->event_id);
            }
            $event->delete();
        }
    }


    public function appoinement_update_status(Request $request)
    {
        
        $ap_ids = $request->check_array;
        $update_status = appoinment::whereIn('id', $ap_ids)->update(['status' => $request->status_name]);
        return 'done';
    }


}
