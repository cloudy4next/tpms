<?php

namespace App\Http\Controllers\Superadmin;

use App\GoogleService;
use App\Http\Controllers\Controller;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Employee;
use App\Models\note_form;
use App\Models\Recurring_session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class SuperAdminManageSessionController extends Controller
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


    public function manage_session()
    {
        return view('superadmin.appoinment.manageSession');
    }


    public function appoinement_update_status(Request $request)
    {
        if ($request->chnage_status == 'Bulk Delete') {
            $update_app = Appoinment::whereIn('id', $request->check_array)->where('admin_id', $this->admin_id)->get();

            $g_service = new GoogleService(Auth::user(), "admin");
            foreach ($update_app as $up) {
                if ($up->is_locked != 1) {
                    $is_google_token_expired = $g_service->is_google_token_expired();
                    if ($is_google_token_expired) {
                    } else {
                        if ($up->g_event_id != null || $up->g_event_id != '') {

                            $client = $g_service->google_client();
                            $service = new \Google_Service_Calendar($client);
                            $service->events->delete('primary', $up->g_event_id);

                            $up->g_event_id = null;
                            $up->save();
                        }
                    }
                    $up->delete();
                }
            }
            return 'done';
        } else {
            $update_app = Appoinment::whereIn('id', $request->check_array)->where('admin_id', $this->admin_id)->update(['status' => $request->chnage_status]);
            return "done";
        }
    }


    public function appoinement_get_date(Request $request)
    {
        $reportrange = $request->ses_reportrange;
        $reportrange_form = Carbon::parse(substr($reportrange, 0, 10))->format('Y-m-d');
        $reportrange_to = Carbon::parse(substr($reportrange, 13, 23))->format('Y-m-d');

        $start_date = Carbon::parse($reportrange_form)->format('m');
        $today = Carbon::parse($reportrange_to)->format('m');
        $check_month = $today - $start_date;
        if ($check_month > 5) {
            return 'date_max_error';
            exit();
        }


        $admin_id = $this->admin_id;

        $query = "SELECT id,admin_id,is_locked,billable,client_id,authorization_activity_id,provider_id,location,schedule_date,from_time,to_time,time_duration,status,authorization_id
            FROM appoinments WHERE admin_id=$admin_id ";

        if (isset($request->ses_client_id)) {
            $client_filter = implode("','", $request->ses_client_id);
            $query .= "AND client_id IN('" . $client_filter . "') ";
        }


        if (isset($request->ses_emaployee_id)) {
            $provider_filter = implode("','", $request->ses_emaployee_id);
            $query .= "AND provider_id IN('" . $provider_filter . "') ";
        }

        if (isset($request->ses_app_type)) {
            $query .= "AND billable = '$request->ses_app_type'  ";
        }


        if (isset($request->ses_status)) {
            $query .= "AND status = '$request->ses_status'  ";
        }

        if (isset($reportrange)) {
            $query .= "AND schedule_date >= '$reportrange_form' ";
            $query .= "AND schedule_date <= '$reportrange_to'  ";
        }


        $query .= "ORDER BY schedule_date DESC";


        $appoientment = DB::select($query);

        $sessions = $this->arrayPaginator($appoientment, $request);
        return response()->json([
            'notices' => $sessions,
            'view' => View::make('superadmin.appoinment.include.manage_settion_table', compact('sessions'))->render(),
            'pagination' => (string)$sessions->links(),
            'count_ses' => count($appoientment),
        ]);
    }


    public function appoinement_get_date_get(Request $request)
    {
        $reportrange = $request->ses_reportrange;
        $reportrange_form = Carbon::parse(substr($reportrange, 0, 10))->format('Y-m-d');
        $reportrange_to = Carbon::parse(substr($reportrange, 13, 23))->format('Y-m-d');

        $start_date = Carbon::parse($reportrange_form)->format('m');
        $today = Carbon::parse($reportrange_to)->format('m');
        $check_month = $today - $start_date;
        if ($check_month > 5) {
            return 'date_max_error';
            exit();
        }


        $admin_id = $this->admin_id;

        $query = "SELECT id,admin_id,billable,is_locked,client_id,authorization_activity_id,provider_id,location,schedule_date,from_time,to_time,time_duration,status,authorization_id
            FROM appoinments WHERE admin_id=$admin_id ";

        if (isset($request->ses_client_id)) {
            $client_filter = implode("','", $request->ses_client_id);
            $query .= "AND client_id IN('" . $client_filter . "') ";
        }


        if (isset($request->ses_emaployee_id)) {
            $provider_filter = implode("','", $request->ses_emaployee_id);
            $query .= "AND provider_id IN('" . $provider_filter . "') ";
        }

        if (isset($request->ses_app_type)) {
            $query .= "AND billable = '$request->ses_app_type'  ";
        }


        if (isset($request->ses_status)) {
            $query .= "AND status = '$request->ses_status'  ";
        }

        if (isset($reportrange)) {
            $query .= "AND schedule_date >= '$reportrange_form' ";
            $query .= "AND schedule_date <= '$reportrange_to'  ";
        }


        $query .= "ORDER BY schedule_date DESC";


        $appoientment = DB::select($query);
        //        $sessions = DB::select($query);

        $sessions = $this->arrayPaginator($appoientment, $request);
        return response()->json([
            'notices' => $sessions,
            'view' => View::make('superadmin.appoinment.include.manage_settion_table', compact('sessions'))->render(),
            'pagination' => (string)$sessions->links(),
            'count_ses' => count($appoientment),
        ]);
    }


    public function appoinement_get_date_nonbil(Request $request)
    {


        $admin_id = $this->admin_id;
        $query = "SELECT id,recurring_id,billable,client_id,authorization_activity_id,provider_id,billable,gender,location,status,lagunage,zone,week_day_name,schedule_date,is_locked,time_duration,from_time,to_time,authorization_id,notes
            FROM appoinments WHERE admin_id=$admin_id ";

        if (isset($request->ses_app_type)) {
            $query .= "AND billable = '$request->ses_app_type'  ";
        }

        if (isset($request->ses_emaployee_id)) {
            $provider_filter = implode("','", $request->ses_emaployee_id);
            $query .= "AND provider_id IN('" . $provider_filter . "') ";
        }


        $query .= "ORDER BY schedule_date DESC";

        $sessions = DB::select($query);

        return response()->json([
            'notices' => $sessions,
            'view' => View::make('superadmin.appoinment.include.manage_settion_table', compact('sessions'))->render(),
        ]);
    }


    public function appoinement_get_date_nonbil_get(Request $request)
    {
        $admin_id = $this->admin_id;
        $query = "SELECT id,recurring_id,billable,client_id,authorization_activity_id,provider_id,billable,gender,location,status,lagunage,zone,week_day_name,schedule_date,is_locked,time_duration,from_time,to_time,authorization_id,notes
            FROM appoinments WHERE admin_id=$admin_id ";

        if (isset($request->ses_app_type)) {
            $query .= "AND billable = '$request->ses_app_type'  ";
        }

        if (isset($request->ses_emaployee_id)) {
            $provider_filter = implode("','", $request->ses_emaployee_id);
            $query .= "AND provider_id IN('" . $provider_filter . "') ";
        }


        $query .= "ORDER BY schedule_date DESC";
        $sessions = DB::select($query);

        return response()->json([
            'notices' => $sessions,
            'view' => View::make('superadmin.appoinment.include.manage_settion_table', compact('sessions'))->render(),
        ]);
    }


    public function session_client_get_all(Request $request)
    {
        $client = Client::select('id', 'client_full_name')
            ->where('admin_id', $this->admin_id)
            ->where('is_active_client', 1)
            ->orderBy('client_full_name', 'asc')
            ->get();

        return response()->json($client, 200);
    }


    public function session_client_authorization_get(Request $request)
    {
        $client_auth = Client_authorization::select('id', 'admin_id', 'client_id', 'authorization_name')->whereIn('client_id', $request->client_id)->where('admin_id', $this->admin_id)->orderBy('authorization_name', 'asc')->get();

        return response()->json($client_auth, 200);
    }


    public function recurring_session()
    {
        $recurring_sessions = recurring_session::where('admin_id', $this->admin_id)->orderBy('id', 'desc')->paginate(10);
        return view('superadmin.appoinment.recurringSession', compact('recurring_sessions'));
    }


    public function recurring_session_get_ptpro(Request $request)
    {
        $sort_by = $request->sort_by;

        if ($sort_by == 2) {
            $apps = Client::select('id', 'admin_id', 'client_full_name')->where('admin_id', $this->admin_id)->orderBy('client_full_name', 'asc')->get();
            return response()->json($apps, 200);
        } elseif ($sort_by == 3) {
            $employee = Employee::select('id', 'admin_id', 'full_name')->where('admin_id', $this->admin_id)->orderBy('full_name', 'asc')->get();
            return response()->json($employee, 200);
        } else {
        }
    }


    public function recurring_session_get(Request $request)
    {
        $sort_by = $request->sort_by;
        $all_patient = $request->all_patient;
        $all_provider = $request->all_provider;


        $admin_id = $this->admin_id;

        $sql = "SELECT * FROM recurring_sessions WHERE admin_id=$admin_id ";

        if ($sort_by == 2 && isset($all_patient)) {
            if ($all_patient != null || $all_patient != '') {
                $client_filter = implode("','", $request->all_patient);
                $sql .= "AND client_id IN('" . $client_filter . "') ";
                //                $sql .= "AND client_name='$all_patient' ";
            }
        }

        if ($sort_by == 3 && isset($all_provider)) {
            if ($all_provider != null || $all_provider != '') {
                $provider_filter = implode("','", $request->all_provider);
                $sql .= "AND provider_id IN('" . $provider_filter . "') ";
                //                $sql .= "AND provider_name='$all_provider' ";
            }
        }

        $sql .= "ORDER BY id DESC";


        $recurring_sessions = DB::select($sql);


        //        $recurring_sessions = $this->arrayPaginatorRec($query_exe, $request);
        return response()->json([
            'notices' => $recurring_sessions,
            'view' => View::make('superadmin.appoinment.include.recurringTbl', compact('recurring_sessions'))->render(),
            //            'pagination' => (string)$recurring_sessions->links()
        ]);
    }


    public function recurring_session_get_next(Request $request)
    {
        $sort_by = $request->sort_by;
        $all_patient = $request->all_patient;
        $all_provider = $request->all_provider;


        $admin_id = $this->admin_id;

        $sql = "SELECT * FROM recurring_sessions WHERE admin_id=$admin_id ";

        if ($sort_by == 2 && isset($all_patient)) {
            if ($all_patient != null || $all_patient != '') {
                $sql .= "AND client_name = '$all_patient' ";
            }
        }

        if ($sort_by == 3 && isset($all_provider)) {
            if ($all_provider != null || $all_provider != '') {
                $sql .= "AND provider_name LIKE '%$all_provider%' ";
            }
        }

        $sql .= "ORDER BY id DESC";


        $query_exe = DB::select($sql);

        $recurring_sessions = $this->arrayPaginatorRec($query_exe, $request);
        return response()->json([
            'notices' => $recurring_sessions,
            'view' => View::make('superadmin.appoinment.include.recurringTbl', compact('recurring_sessions'))->render(),
            'pagination' => (string)$recurring_sessions->links()
        ]);
    }


    public function recurring_session_edit($id)
    {
        $edit_rec = recurring_session::where('id', $id)->first();

        $session_data = appoinment::distinct()->select(
            'recurring_id',
            'client_id',
            'authorization_id',
            'authorization_activity_id',
            'provider_id',
            'location',
            'time_duration',
            'from_time',
            'to_time',
            'status',
            'notes',
            'created_at'
        )->where('recurring_id', $id)->first();

        if (!$session_data) {
            return back()->with('alert', 'Sessions for this recurring pattern has been deleted.');
        }


        $clients = DB::table('clients')->get();
        $authorization = DB::table('client_authorizations')->where('client_id', $session_data->client_id)->get();
        $activity = DB::table('client_authorization_activities')->where('authorization_id', $session_data->authorization_id)->get();
        $provider = DB::table('employees')->get();
        $sessions_not_sheduled = DB::table('appoinments')->where('recurring_id', '=', $id)->where('is_locked', '!=', '1')->get();
        $sessions_sheduled = DB::table('appoinments')->where('recurring_id', '=', $id)->where('is_locked', '=', '1')->get();

        return view('superadmin.appoinment.recurringSessionEdit', compact('sessions_not_sheduled', 'sessions_sheduled', 'session_data', 'clients', 'authorization', 'activity', 'provider'));
    }


    public function recurring_session_update(Request $request)
    {
        $session_ids_request = $request->check_array;

        $form_time = Carbon::parse($request->from_time);
        $to_time = Carbon::parse($request->to_time);
        $form_time_convert = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($form_time)->format('Y-m-d H:i:s'));
        $to_time_covert = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($to_time)->format('Y-m-d H:i:s'));


        $diff_form_to = $form_time_convert->diffInMinutes($to_time_covert);

        $t_hrs = ($diff_form_to / 60);

        if ($t_hrs > 8) {
            return redirect()->back()->with('alert', 'Session Can not be more than 8 hour! ');
        }
        $client_id = recurring_session::where('id', $request->rec_id)->first();
        $auth_n = client_authorization::select('client_id', 'onset_date', 'end_date', 'payor_id', 'is_placeholder')->where('id', $request->authorization_id)->where('admin_id', $this->admin_id)->first();


        $ac_n = client_authorization_activity::where('id', $request->activity_id)->first();
        $pro_n = Employee::where('id', $request->provider_id)->first();

        $auth_s_date = Carbon::parse($auth_n->onset_date)->format('Y-m-d');
        $auth_end_date = Carbon::parse($auth_n->end_date)->format('Y-m-d');


        if ($client_id->schedule_date_start < $auth_s_date) {

            return redirect()->back()->with('alert', 'You are scheduling the session prior to the auth start date');
        } else if ($client_id->schedule_date_start > $auth_end_date) {

            return redirect()->back()->with('alert', 'You are scheduling the session after to the auth end date');
        }

        $update_rec = recurring_session::where('id', $request->rec_id)->first();

        $update_rec->activity_name = $ac_n->activity_name;
        $update_rec->provider_name = $pro_n->first_name . ' ' . $pro_n->middle_name . ' ' . ' ' . $pro_n->last_name;
        $update_rec->location = $request->location;
        $update_rec->horus_form = $form_time;
        $update_rec->horus_to = $to_time;
        $update_rec->status = $request->status;
        $update_rec->save();

        $sessions = appoinment::where('recurring_id', $request->rec_id)
            ->where('is_locked', '=', '0')
            ->whereIn('id', $session_ids_request)
            ->get();

        foreach ($sessions as $session) {
            $update_settion = appoinment::where('id', $session->id)->first();
            $update_settion->authorization_id = $request->authorization_id;
            $update_settion->authorization_activity_id = $request->activity_id;
            $update_settion->provider_id = $request->provider_id;
            $update_settion->location = $request->location;
            $update_settion->time_duration = $diff_form_to;
            $update_settion->from_time = $form_time;
            $update_settion->to_time = $to_time;
            $update_settion->status = $request->status;
            $update_settion->notes = $request->notes;
            $update_settion->save();
        }

        //return back()->with('success','Session Successfully Updated');
        // return redirect(route('superadmin.recurring.session'))->with('success', 'Session Successfully Updated');
        return "success";
    }


    public function arrayPaginatorRec($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true),
            count($array),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }

    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 20;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true),
            count($array),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }
}
