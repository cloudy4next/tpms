<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Mail\MeetMail;
use App\Models\Appoinment;
use App\Models\Appoinment_signature;
use App\Models\Client;
use App\Models\Client_activity;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Employee;
use App\Models\meet_link;
use App\Models\setting_name_location;
use App\Models\general_setting;
use App\Models\note_form;
use App\Models\usf_one_form;
use App\Models\dsptn_two_form;
use App\Models\btsmf_three_form;
use App\Models\btusf_four_form;
use App\Models\msn_five_form;
use App\Models\tcsn_fix_form;
use App\Models\ct_seven_form;
use App\Models\ct_seven2_form;
use App\Models\tp_eight_form;
use App\Models\pc_nine_form;
use App\Models\pc_nine2_form;
use App\Models\ot_ten_form;
use App\Models\cn_eleven_form;
use App\Models\pt_twelve_form;
use App\Models\sn_thirteen_form;
use App\Models\register_fourteen_form;
use App\Models\register2_fifteen_form;
use App\Models\sp_sixteen_form;
use App\Models\sp_sixteen2_form;
use App\Models\sp_sixteen3_form;
use App\Models\cp_seventeen_form;
use App\Models\cp_eighteen_form;
use App\Models\cp_ninteen_form;
use App\Models\gs_twenty_form;
use App\Models\gs_twentyone_form;
use App\Models\gs_twentytwo_form;
use App\Models\gs_twentythree_form;
use App\Models\bio_twentyfour_form;
use App\Models\bio_twentyfour2_form;
use App\Models\bio_twentyfour3_form;
use App\Models\bio_twentyfour4_form;
use App\Models\bio_twentyfour5_form;
use App\Models\bio_twentyfour6_form;
use App\Models\birp_twentyfive_form;
use App\Models\birp_twentyfive2_form;
use App\Models\dis_twentysix_form;
use App\Models\lpro_twentyseven_form;
use App\Models\ls_twentyeight_form;
use App\Models\dia_twentynine_form;
use App\Models\ds_thirty1_form;
use App\Models\ds_thirty2_form;
use App\Models\ds_thirty3_form;
use App\Models\ds_thirty4_form;
use App\Models\ds_thirty5_form;
use App\Models\ds_thirty6_form;
use App\Models\ds_thirty7_form;
use App\Models\ds_thirty8_form;
use App\Models\ds_thirty9_form;
use App\Models\ds_thirty10_form;
use App\Models\ds_thirty11_form;
use App\Models\ds_thirty12_form;
use App\Models\custom_form;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProviderSessionController extends Controller
{
    protected $admin_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->admin_id = Auth::user()->admin_id;
            return $next($request);
        });
    }

    public function get_all_provider(Request $request)
    {
        $app = Appoinment::distinct()->select('provider_id')->get();

        $array = [];
        foreach ($app as $apppn) {
            array_push($array, $apppn->provider_id);
        }

        $providers = Employee::select('id', 'full_name')->whereIn('id', $array)->get();
        return response()->json($providers, 200);
    }

    public function get_all_clients(Request $request)
    {
        $app = Appoinment::distinct()->select('client_id', 'provider_id')->where('provider_id', Auth::user()->id)->get();

        $array = [];
        foreach ($app as $apppn) {
            array_push($array, $apppn->client_id);
        }

        $clients = Client::select('id', 'client_full_name')->whereIn('id', $array)->get();
        return response()->json($clients, 200);
    }


    public function get_all_sessions(Request $request)
    {
        $ses_proiders = $request->ses_proiders;
        $ses_client = $request->ses_client;
        $search_by = $request->search_by;
        $billable = $request->app_type_check;

        $today_date = Carbon::now()->format('Y-m-d');

        $query = "SELECT * FROM appoinments WHERE client_id IS NOT NULL ";

        if (empty($ses_proiders) && empty($ses_client)) {
            if ($billable == 1) {
                return 'nne';
            }
        }

        if (isset($ses_proiders)) {
            $query .= "AND provider_id=$ses_proiders  ";
        }
        if (isset($ses_client)) {
            $client_filter = implode("','", $request->ses_client);
            //            $query .= "AND client_id=$ses_client ";
            $query .= "AND client_id IN('" . $client_filter . "') ";
        }

        if ($search_by == 1) {
            $query .= "AND schedule_date = '$today_date' ";
        }


        if ($search_by == 2) {
            $tomorrow_date = Carbon::now()->addDay(1)->format('Y-m-d');
            $query .= "AND schedule_date = '$tomorrow_date' ";
        }

        if ($search_by == 3) {
            $yesterday_date = Carbon::now()->subDay(1)->format('Y-m-d');
            $query .= "AND schedule_date = '$yesterday_date' ";
        }

        if ($search_by == 4) {
            $next_seven_days = Carbon::now()->addDays(7)->format('Y-m-d');
            $query .= "AND schedule_date > '$today_date' ";
            $query .= "AND schedule_date <= '$next_seven_days' ";
        }

        if ($search_by == 5) {

            $reportrange_one1 = Carbon::parse(substr($request->date_ranger, 0, 10))->format('Y-m-d');
            $reportrange_one2 = Carbon::parse(substr($request->date_ranger, 13, 24))->format('Y-m-d');
            $query .= "AND schedule_date >= '$reportrange_one1' ";
            $query .= "AND schedule_date <= '$reportrange_one2' ";
        }


        if ($search_by == 6) {

            //            $query .= "AND client_id='$ses_client' ";

            if (isset($request->date_ranger)) {
                $reportrange_one1 = Carbon::parse(substr($request->date_ranger, 0, 10))->format('Y-m-d');
                $reportrange_one2 = Carbon::parse(substr($request->date_ranger, 13, 24))->format('Y-m-d');
                $query .= "AND schedule_date >= '$reportrange_one1' ";
                $query .= "AND schedule_date <= '$reportrange_one2' ";
            }
        }

        if ($search_by == 7) {
            $last_fiften_days = Carbon::now()->subDays(15)->format('Y-m-d');
            $query .= "AND schedule_date < '$today_date' ";
            $query .= "AND schedule_date >= '$last_fiften_days' ";
        }

        if ($search_by == 8) {
            $next_fiften_days = Carbon::now()->addDays(15)->format('Y-m-d');
            $query .= "AND schedule_date > '$today_date' ";
            $query .= "AND schedule_date <= '$next_fiften_days' ";
        }

        if ($search_by == 9) {
            $last_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
            $query .= "AND schedule_date < '$today_date' ";
            $query .= "AND schedule_date >= '$last_30_days' ";
        }

        if ($search_by == 10) {
            $next_30_days = Carbon::now()->addDays(30)->format('Y-m-d');
            $query .= "AND schedule_date > '$today_date' ";
            $query .= "AND schedule_date <= '$next_30_days' ";
        }

        if ($billable == 1) {
            $query .= "AND billable = 1 ";
        } else if ($billable == 2) {
            $query .= "AND billable = 2 ";
        }


        $query .= "ORDER BY schedule_date DESC";
        $appoientment = DB::select($query);


        $sessions = $this->arrayPaginator($appoientment, $request);
        return response()->json([
            'notices' => $sessions,
            'view' => View::make('provider.include.manage_session_table', compact('sessions', 'billable'))->render(),
            'pagination' => (string)$sessions->links()
        ]);
    }


    public function get_all_sessions_get(Request $request)
    {
        $ses_proiders = $request->ses_proiders;
        $ses_client = $request->ses_client;
        $search_by = $request->search_by;
        $billable = $request->app_type_check;

        $today_date = Carbon::now()->format('Y-m-d');

        $query = "SELECT * FROM appoinments WHERE client_id IS NOT NULL ";

        if (empty($ses_proiders) && empty($ses_client)) {
            if ($billable == 1) {
                return 'nne';
            }
        }

        if (isset($ses_proiders)) {
            $query .= "AND provider_id=$ses_proiders  ";
        }
        if (isset($ses_client) && $ses_client != 0) {
            $client_filter = implode("','", $request->ses_client);
            //            $query .= "AND client_id=$ses_client ";
            $query .= "AND client_id IN('" . $client_filter . "') ";
        }

        if ($search_by == 1) {
            $query .= "AND schedule_date = '$today_date' ";
        }


        if ($search_by == 2) {
            $tomorrow_date = Carbon::now()->addDay(1)->format('Y-m-d');
            $query .= "AND schedule_date = '$tomorrow_date' ";
        }

        if ($search_by == 3) {
            $yesterday_date = Carbon::now()->subDay(1)->format('Y-m-d');
            $query .= "AND schedule_date = '$yesterday_date' ";
        }

        if ($search_by == 4) {
            $next_seven_days = Carbon::now()->addDays(7)->format('Y-m-d');
            $query .= "AND schedule_date > '$today_date' ";
            $query .= "AND schedule_date <= '$next_seven_days' ";
        }

        if ($search_by == 5) {

            $reportrange_one1 = Carbon::parse(substr($request->date_ranger, 0, 10))->format('Y-m-d');
            $reportrange_one2 = Carbon::parse(substr($request->date_ranger, 13, 24))->format('Y-m-d');
            $query .= "AND schedule_date >= '$reportrange_one1' ";
            $query .= "AND schedule_date <= '$reportrange_one2' ";
        }

        if ($search_by == 6) {

            //            $query .= "AND client_id='$ses_client' ";

            if (isset($request->date_ranger)) {
                $reportrange_one1 = Carbon::parse(substr($request->date_ranger, 0, 10))->format('Y-m-d');
                $reportrange_one2 = Carbon::parse(substr($request->date_ranger, 13, 24))->format('Y-m-d');
                $query .= "AND schedule_date >= '$reportrange_one1' ";
                $query .= "AND schedule_date <= '$reportrange_one2' ";
            }
        }

        if ($search_by == 7) {
            $last_fiften_days = Carbon::now()->subDays(15)->format('Y-m-d');
            $query .= "AND schedule_date < '$today_date' ";
            $query .= "AND schedule_date >= '$last_fiften_days' ";
        }

        if ($search_by == 8) {
            $next_fiften_days = Carbon::now()->addDays(15)->format('Y-m-d');
            $query .= "AND schedule_date > '$today_date' ";
            $query .= "AND schedule_date <= '$next_fiften_days' ";
        }

        if ($search_by == 9) {
            $last_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
            $query .= "AND schedule_date < '$today_date' ";
            $query .= "AND schedule_date >= '$last_30_days' ";
        }

        if ($search_by == 10) {
            $next_30_days = Carbon::now()->addDays(30)->format('Y-m-d');
            $query .= "AND schedule_date > '$today_date' ";
            $query .= "AND schedule_date <= '$next_30_days' ";
        }


        if ($billable == 1) {
            $query .= "AND billable = 1 ";
        } else if ($billable == 2) {
            $query .= "AND billable = 2 ";
        }


        $query .= "ORDER BY schedule_date DESC";
        $appoientment = DB::select($query);

        $sessions = $this->arrayPaginator($appoientment, $request);
        return response()->json([
            'notices' => $sessions,
            'view' => View::make('provider.include.manage_session_table', compact('sessions', 'billable'))->render(),
        ]);
    }


    public function appoinment_delete(Request $request)
    {
        $update_app = Appoinment::whereIn('id', $request->check_array)->get();
        foreach ($update_app as $up) {
            if ($up->is_locked == 0) {
                $up->delete();
            }
        }
        return 'done';
    }


    public function monthly_utilization(Request $request)
    {
        $design_filter = implode("','", $request->check_array);
        $query = "SELECT DISTINCT id,authorization_activity_id FROM appoinments WHERE id IN('" . $design_filter . "')";
        $query .= "ORDER BY schedule_date DESC";

        $appoientment = DB::select($query);


        return response()->json([
            'notices' => $appoientment,
            'view' => View::make('provider.include.montly_utilization_table', compact('appoientment'))->render(),
        ]);
    }


    public function activity_update(Request $request)
    {
        $auth = Client_authorization::where('id', $request->authrization_id)->where('admin_id', Auth::user()->admin_id)->first();


        $check_numeric = is_numeric($request->rate);
        if (!$check_numeric) {
            return back()->with('alert', 'Please Add Rate Value as Number or With decimal');
        } else {
            $update_activity = Client_authorization_activity::where('id', $request->edit_activity_id)->where('admin_id', Auth::user()->admin_id)->first();

            $update_activity->activity_name = $request->activity_one . ' ' . $request->activity_two;
            $update_activity->activity_one = $request->activity_one;
            $update_activity->activity_two = $request->activity_two;
            $update_activity->cpt_code = $request->cpt_code;
            $update_activity->onset_date = $auth->onset_date;
            $update_activity->end_date = $auth->end_date;
            $update_activity->m1 = $request->m1;
            $update_activity->m2 = $request->m2;
            $update_activity->m3 = $request->m3;
            $update_activity->m4 = $request->m4;
            $update_activity->auth_activity = $request->auth_activity;
            $update_activity->billed_type = $request->billed_type;
            $update_activity->billed_time = $request->billed_time;
            $update_activity->rate = number_format($request->rate, 2);
            $update_activity->hours_max_one = isset($request->hours_max_one) ? $request->hours_max_one : $update_activity->hours_max_one;
            $update_activity->hours_max_per_one = isset($request->hours_max_per_one) ? $request->hours_max_per_one : $update_activity->hours_max_per_one;
            $update_activity->hours_max_is_one = isset($request->hours_max_is_one) ? $request->hours_max_is_one : $update_activity->hours_max_is_one;
            $update_activity->hours_max_two = $request->hours_max_two;
            $update_activity->hours_max_per_two = $request->hours_max_per_two;
            $update_activity->hours_max_is_two = $request->hours_max_is_two;
            $update_activity->hours_max_three = $request->hours_max_three;
            $update_activity->hours_max_per_three = $request->hours_max_per_three;
            $update_activity->hours_max_is_three = $request->hours_max_is_three;
            $update_activity->notes = $request->notes;
            $update_activity->save();

            Client_activity::create([
                'admin_id' => Auth::user()->admin_id,
                'client_id' => $auth->client_id,
                'title' => "Authorization Activity Created",
                'message' => $update_activity->activity_name . " Authorization Activity Updated ",
                'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
            ]);


            return back()->with('success', 'Activity Updated Successfully');
        }
    }


    public function activity_delete($id)
    {
        $del_activity = client_authorization_activity::where('id', $id)->where('admin_id', Auth::user()->id)->first();
        Client_activity::create([
            'admin_id' => Auth::user()->admin_id,
            'client_id' => $del_activity->client_id,
            'title' => "Authorization Activity Deleted",
            'message' => $del_activity->activity_name . " Authorization Activity Deleted ",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);
        $del_activity->delete();

        return back()->with('success', 'Activity Deleted Successfully');
    }


    public function open_attach_file(Request $request)
    {
        $dis = $request->data_checkbox_appoinment;
        $app = Appoinment::whereIn('id', $dis)->first();
        $client_auth = Client_authorization::where('id', $app->authorization_id)->first();
        return asset($client_auth->upload_authorization);
    }


    public function update_rendered(Request $request)
    {
        $apps = Appoinment::whereIn('id', $request->check_array)->update(['status' => 'Rendered']);
        return 'done';
    }


    public function session_update(Request $request)
    {
        $app = Appoinment::where('id', $request->edit_sess_id)->first();
        $app->status = $request->appooinment_craete_status_name;
        $app->save();
        return 'done';
    }


    public function session_app_get_details(Request $request)
    {
        if ($request->billable == 1) {
            $app = Appoinment::where('id', $request->app_id)->first();
            $client = Client::where('id', $app->client_id)->first();
            $client_auth = Client_authorization::where('id', $app->authorization_id)->first();
            $client_act = Client_authorization_activity::where('id', $app->authorization_activity_id)->first();
            $provider = Employee::where('id', $app->provider_id)->first();
            return response()->json([
                'app' => $app,
                'client' => $client,
                'auth' => $client_auth,
                'act' => $client_act,
                'prov' => $provider,
            ]);
        } else {
            $app = Appoinment::where('id', $request->app_id)->first();
            $provider = Employee::where('id', $app->provider_id)->first();
            return response()->json([
                'app' => $app,
                'prov' => $provider,
            ]);
        }
    }


    public function session_id_data_get(Request $request)
    {
        $session = Appoinment::where('id', $request->ses_id)->first();
        return response()->json($session, 200);
    }

    public function session_sinature_save(Request $request)
    {

        $image = $request->sing_draw_txt;
        $sing_seccid = $request->sessionid;

        $session = Appoinment_signature::where('session_id', $sing_seccid)->where('user_type', 1)->first();

        if ($session) {
            if ($request->sing_draw_txt != $session->signature) {
                $name = time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw_txt, 0, strpos($request->sing_draw_txt, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw_txt)->save($imgUrl2);
                $session->signature = $path3;
            }


            if ($request->hasFile('sing_file')) {
                $image = $request->file('sing_file');
                $name = uniqid() . time() . $image->getClientOriginalName();
                $directory = 'assets/dashboard/singnature/';
                $image->move($directory, $name);
                $imgUrl3 = $directory . $name;
                $session->signature = $imgUrl3;
            }
            $session->sign_time = Carbon::now('EST');
            $session->save();


            return 'done';
        } else {

            $new_singature = new Appoinment_signature();
            $new_singature->session_id = $sing_seccid;
            $new_singature->admin_id = Auth::user()->admin_id;
            $new_singature->provider_id = Auth::user()->id;
            $new_singature->client_id = $request->sess_client_id;
            $new_singature->user_type = 1;
            $new_singature->sign_time = Carbon::now('EST');

            if ($request->sing_draw_txt && $request->sing_draw_txt != null) {

                $name = time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw_txt, 0, strpos($request->sing_draw_txt, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw_txt)->save($imgUrl2);
                $new_singature->signature = $path3;
            }


            if ($request->hasFile('sing_file')) {
                $image = $request->file('sing_file');
                $name = uniqid() . time() . $image->getClientOriginalName();
                $directory = 'assets/dashboard/singnature/';
                $image->move($directory, $name);
                $imgUrl3 = $directory . $name;
                $new_singature->signature = $imgUrl3;
            }


            $new_singature->save();

            return 'done';
        }
    }


    public function session_sinature_save_provider(Request $request)
    {
        $image = $request->sing_draw_txt_provider;
        $sing_seccid = $request->sessionid_provider;

        $session = Appoinment_signature::where('session_id', $sing_seccid)->where('user_type', 2)->first();

        if ($session) {
            if ($request->sing_draw_txt_provider != $session->signature) {
                $name = time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw_txt_provider, 0, strpos($request->sing_draw_txt_provider, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw_txt_provider)->save($imgUrl2);
                $session->signature = $path3;
                $session->sign_time_pro = Carbon::now('EST');
            }


            if ($request->hasFile('sing_file2')) {
                $image = $request->file('sing_file2');
                $name = uniqid() . time() . $image->getClientOriginalName();
                $directory = 'assets/dashboard/singnature/';
                $image->move($directory, $name);
                $imgUrl3 = $directory . $name;
                $session->signature = $imgUrl3;
                $session->sign_time_pro = Carbon::now('EST');
            }

            $session->save();


            return 'done';
        } else {

            $new_singature = new Appoinment_signature();
            $new_singature->session_id = $sing_seccid;
            $new_singature->admin_id = Auth::user()->admin;
            $new_singature->provider_id = Auth::user()->id;
            $new_singature->client_id = $request->sess_client_id_provider;
            $new_singature->user_type = 2;
            $new_singature->sign_time_pro = Carbon::now('EST');

            if ($request->sing_draw_txt_provider && $request->sing_draw_txt_provider != null) {

                $name = time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw_txt_provider, 0, strpos($request->sing_draw_txt_provider, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw_txt_provider)->save($imgUrl2);
                $new_singature->signature = $path3;
            }


            if ($request->hasFile('sing_file2')) {
                $image = $request->file('sing_file2');
                $name = uniqid() . time() . $image->getClientOriginalName();
                $directory = 'assets/dashboard/singnature/';
                $image->move($directory, $name);
                $imgUrl3 = $directory . $name;
                $new_singature->signature = $imgUrl3;
            }


            $new_singature->save();

            return 'done';
        }
    }

    public function forms_builders_save_data(Request $request)
    {

        $filled_form = $request->filled_form;
        $id = $request->form_id;
        $session_id = $request->session_id;
        // $data=note_form::where('id',$id)->first();

        $data = custom_form::where('form_id', $id)->where('admin_id', $this->admin_id)
            ->where('session_id', $session_id)->first();
        if (!$data) {
            $data = new custom_form();
        }

        if ($request->hasFile('updload_sign')) {
            $image = $request->file('updload_sign');
            $imageName = $this->admin_id . time() . uniqid() . '.' . "png";
            $directory = 'assets/dashboard/singnature/';
            $imgUrl1 = $directory . $imageName;
            Image::make($image)->save($imgUrl1);
            $data->signature = $imgUrl1;
        } else {
            if ($request->sing_draw && $request->sing_draw != null) {
                $name = $this->admin_id . time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw, 0, strpos($request->sing_draw, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw)->save($imgUrl2);
                $data->signature = $path3;
            }
        }

        if ($request->hasFile('updload_sign2')) {
            $image = $request->file('updload_sign2');
            $imageName = $this->admin_id . time() . uniqid() . '.' . "png";
            $directory = 'assets/dashboard/singnature/';
            $imgUrl1 = $directory . $imageName;
            Image::make($image)->save($imgUrl1);
            $data->signature2 = $imgUrl1;
        } else {
            if ($request->sing_draw2 && $request->sing_draw2 != null) {
                $name = $this->admin_id . time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw2, 0, strpos($request->sing_draw2, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw2)->save($imgUrl2);
                $data->signature2 = $path3;
            }
        }

        $data->admin_id = $this->admin_id;
        $data->session_id = $session_id;
        $data->form_id = $id;
        $data->filled_form = $filled_form;
        $data->save();
        $this->form_avail_save($request->session_id, $request->form_id);

        $res = array(

            "sign1" => $data->signature,
            "sign2" => $data->signature2
        );

        return json_encode($res);
    }

    public function forms_builders_view($id)
    {
        $forms = note_form::where('id', $id)->first();
        $data = $forms->html_data;
        $sign1 = $forms->signature;
        $sign2 = $forms->signature2;
        return view('provider.formbuilder.formBuilderView', compact('data', 'sign1', 'sign2'));
    }


    public function session_get_template_name(Request $request)
    {
        $notes_forms = note_form::where('admin_id', $this->admin_id)->get();
        return response()->json($notes_forms, 200);
    }

    public function session_created_template_name(Request $request)
    {
        $form_one = usf_one_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_two = dsptn_two_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_three = btsmf_three_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_four = btusf_four_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_five = msn_five_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_six = tcsn_fix_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_7 = ct_seven_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_eight = tp_eight_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_9 = pc_nine_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_10 = ot_ten_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_eleven = cn_eleven_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_12 = pt_twelve_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_13 = sn_thirteen_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_14 = register_fourteen_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_15 = register2_fifteen_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_16 = sp_sixteen_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_17 = cp_seventeen_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_18 = cp_eighteen_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_19 = cp_ninteen_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_20 = gs_twenty_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_21 = gs_twentyone_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_22 = gs_twentytwo_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_23 = gs_twentythree_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_24 = bio_twentyfour_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_25 = birp_twentyfive_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_26 = dis_twentysix_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_27 = lpro_twentyseven_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_28 = ls_twentyeight_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_29 = dia_twentynine_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_30 = ds_thirty1_form::where('sessionid', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_60 = \App\Models\saa_sixty_form::where('session_id', $request->ses_id)->where('admin_id', $this->admin_id)->first();
        $form_61 = \App\Models\sn_sixtyone_form::where('session_id', $request->ses_id)->where('admin_id', $this->admin_id)->first();

        $customs = custom_form::where('session_id', $request->ses_id)->where('admin_id', $this->admin_id)->where('filled_form', '!=', null)->get();

        if (count($customs) > 0) {
            foreach ($customs as $custom) {
                $name = note_form::where('id', $custom->form_id)->first();
                $cus_arr[] = array(
                    "id" => $custom->id,
                    "name" => $name->template_name,
                );
            }
        } else {
            $cus_arr = array();
        }


        $arr = array(
            'form_one' => $form_one,
            'form_two' => $form_two,
            'form_three' => $form_three,
            'form_four' => $form_four,
            'form_five' => $form_five,
            'form_six' => $form_six,
            'form_7' => $form_7,
            'form_eight' => $form_eight,
            'form_9' => $form_9,
            'form_10' => $form_10,
            'form_eleven' => $form_eleven,
            'form_12' => $form_12,
            'form_13' => $form_13,
            'form_14' => $form_14,
            'form_15' => $form_15,
            'form_16' => $form_16,
            'form_17' => $form_17,
            'form_18' => $form_18,
            'form_19' => $form_19,
            'form_20' => $form_20,
            'form_21' => $form_21,
            'form_22' => $form_22,
            'form_23' => $form_23,
            'form_24' => $form_24,
            'form_25' => $form_25,
            'form_26' => $form_26,
            'form_27' => $form_27,
            'form_28' => $form_28,
            'form_29' => $form_29,
            'form_30' => $form_30,
            'form_60' => $form_60,
            'form_61' => $form_61,
            'custom' => $cus_arr,
        );


        return response()->json($arr, 200);
    }


    public function session_note_open(Request $request)
    {
        $notes = note_form::where('admin_id', $this->admin_id)->where('id', $request->note_id)->first();

        if ($notes) {
            $name_location = setting_name_location::where('admin_id', $this->admin_id)->first();
            $logo = general_setting::where('admin_id', $this->admin_id)->first();
            if (!$logo) {
                return back()->with('alert', 'Please update logo.');
            }
            if ($notes->template_id == 1) {
                $session_id = $request->from_session_id;
                return view('provider.template.uniqueSuperVisionForm', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 2) {
                $session_id = $request->from_session_id;
                return view('provider.template.directServiceParentTrainingForm', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 3) {
                $session_id = $request->from_session_id;
                return view('provider.template.bcbaTraineeSupervisionMonthlyForm', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 4) {
                $session_id = $request->from_session_id;
                return view('provider.template.bcbaTraineeUniqueSupervisionForm', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 5) {
                $session_id = $request->from_session_id;
                return view('provider.template.monthlySuperVisionForm', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 6) {
                $session_id = $request->from_session_id;
                return view('provider.template.therapistSessionForm', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 7) {
                $session_id = $request->from_session_id;
                return view('provider.template.clinicalTreatmentForm', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 8) {
                $session_id = $request->from_session_id;
                return view('provider.template.treatmentPlan', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 9) {
                $session_id = $request->from_session_id;
                return view('provider.template.privateClientForm', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 10) {
                $session_id = $request->from_session_id;
                return view('provider.template.outpatientTreatmentForm', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 11) {
                $session_id = $request->from_session_id;
                return view('provider.template.catalystNote', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 12) {
                $session_id = $request->from_session_id;
                return view('provider.template.parentTraining', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 13) {
                $session_id = $request->from_session_id;
                return view('provider.template.sessionNotes', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 14) {
                $session_id = $request->from_session_id;
                return view('provider.template.supervisionRegistered1', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 15) {
                $session_id = $request->from_session_id;
                return view('provider.template.supervisionRegistered2', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 16) {
                $session_id = $request->from_session_id;
                return view('provider.template.servicePlan', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 17) {
                $session_id = $request->from_session_id;
                return view('provider.template.cpClinical', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 18) {
                $session_id = $request->from_session_id;
                return view('provider.template.cpNotes', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 19) {
                $session_id = $request->from_session_id;
                return view('provider.template.cpSoap', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 20) {
                $session_id = $request->from_session_id;
                return view('provider.template.gsAssessment', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 21) {
                $session_id = $request->from_session_id;
                return view('provider.template.gsParentTraining', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 22) {
                $session_id = $request->from_session_id;
                return view('provider.template.gsSupervision', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 23) {
                $session_id = $request->from_session_id;
                return view('provider.template.gsTreatment', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 24) {
                $session_id = $request->from_session_id;
                return view('provider.template.biopsychosocial', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 25) {
                $session_id = $request->from_session_id;
                return view('provider.template.birpProgress', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 26) {
                $session_id = $request->from_session_id;
                return view('provider.template.dischargeSummary', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 27) {
                $session_id = $request->from_session_id;
                return view('provider.template.languageProgress', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 28) {
                $session_id = $request->from_session_id;
                return view('provider.template.languageSession', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 29) {
                $session_id = $request->from_session_id;
                return view('provider.template.diagnosisSummary', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 30) {
                $session_id = $request->from_session_id;
                return view('provider.template.dataSheet', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 31) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhBehaviorAssessment', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 32) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhBehaviorProgress', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 33) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhServiceVerification', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 34) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhCFARS', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 35) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhDischargeSummary', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 36) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhMedFlowsheet', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 37) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhNoShow', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 38) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhPCP', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 39) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhLocusWorksheet', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 40) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhReleaseInfo', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 41) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhBiopsychosocial', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 42) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhConsentTreat', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 43) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhFARS', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 44) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhMasterTreatment', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 45) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhMedConsent', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 46) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhMedManagement', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 47) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhProgressNote', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 48) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhPsychiatricEvaluation', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 49) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhPsychiatricABA', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 50) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhRiskAssessment', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 51) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhLocusScore', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 52) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhTreatmentPlan', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 53) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhSafetyPlanning', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 54) {
                $session_id = $request->from_session_id;
                return view('provider.template.cbhMentalHealth', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 60) {
                $session_id = $request->from_session_id;
                return view('provider.template.supervisionAndAssessment', compact('session_id', 'name_location', 'logo'));
            } elseif ($notes->template_id == 61) {
                $session_id = $request->from_session_id;
                return view('provider.template.sessionNotesTwo', compact('session_id', 'name_location', 'logo'));
            } else {
                if ($notes->html_data == null) {
                    return back()->with('alert', 'Template Not Found');
                } else {
                    $data = $notes->html_data;
                    $form_id = $notes->id;
                    $title = $notes->template_name;

                    $session_id = $request->from_session_id;
                    $sign1 = null;
                    $sign2 = null;
                    $check = "new";
                    return view('provider.formbuilder.formBuilderView', compact('data', 'session_id', 'form_id', 'title', 'logo', 'name_location', 'sign1', 'sign2', 'check'));
                }
            }
        } else {
            return back()->with('alert', 'Template Not Found');
        }
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

    public function session_created_template_open(Request $request)
    {
        $name_location = setting_name_location::where('admin_id', $this->admin_id)->first();
        $logo = general_setting::where('admin_id', $this->admin_id)->first();

        if (!$logo) {
            return back()->with('alert', 'Please update logo.');
        }
        if ($request->created_note_id == 1) {
            $session_id = $request->created_from_session_id;
            $form_one = usf_one_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.uniqueSuperVisionForm', compact('session_id', 'form_one', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 2) {
            $session_id = $request->created_from_session_id;
            $form_two = dsptn_two_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.directServiceParentTrainingForm', compact('session_id', 'form_two', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 3) {
            $session_id = $request->created_from_session_id;
            $form_three = btsmf_three_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.bcbaTraineeSupervisionMonthlyForm', compact('session_id', 'form_three', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 4) {
            $session_id = $request->created_from_session_id;
            $form_four = btusf_four_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.bcbaTraineeUniqueSupervisionForm', compact('session_id', 'form_four', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 5) {
            $session_id = $request->created_from_session_id;
            $form_five = msn_five_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.monthlySuperVisionForm', compact('session_id', 'form_five', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 6) {
            $session_id = $request->created_from_session_id;
            $form_six = tcsn_fix_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.therapistSessionForm', compact('session_id', 'form_six', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 7) {
            $data = ct_seven_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data2 = ct_seven2_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $session_id = $request->created_from_session_id;
            return view('provider.createdTemplate.clinicalTreatmentForm', compact('session_id', 'data', 'data2', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 8) {
            $session_id = $request->created_from_session_id;
            $form_eight = tp_eight_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.treatmentPlan', compact('session_id', 'form_eight', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 9) {
            $data = pc_nine_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data2 = pc_nine2_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $session_id = $request->created_from_session_id;
            return view('provider.createdTemplate.privateClientForm', compact('session_id', 'name_location', 'logo', 'data', 'data2'));
        } elseif ($request->created_note_id == 10) {
            $session_id = $request->created_from_session_id;
            $data = ot_ten_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.outpatientTreatmentForm', compact('session_id', 'name_location', 'logo', 'data'));
        } elseif ($request->created_note_id == 11) {
            $session_id = $request->created_from_session_id;
            $form_eleven = cn_eleven_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.catalystNote', compact('session_id', 'form_eleven', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 12) {
            $session_id = $request->created_from_session_id;
            $data = pt_twelve_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.parentTraining', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 13) {
            $session_id = $request->created_from_session_id;
            $data = sn_thirteen_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.sessionNotes', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 14) {
            $session_id = $request->created_from_session_id;
            $data = register_fourteen_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.supervisionRegistered1', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 15) {
            $session_id = $request->created_from_session_id;
            $data = register2_fifteen_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.supervisionRegistered2', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 16) {
            $session_id = $request->created_from_session_id;
            $data = sp_sixteen_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data2 = sp_sixteen2_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data3 = sp_sixteen3_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.servicePlan', compact('session_id', 'data', 'data2', 'data3', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 17) {
            $session_id = $request->created_from_session_id;
            $data = cp_seventeen_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.cpClinical', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 18) {
            $session_id = $request->created_from_session_id;
            $data = cp_eighteen_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.cpNotes', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 19) {
            $session_id = $request->created_from_session_id;
            $data = cp_ninteen_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.cpSoap', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 20) {
            $session_id = $request->created_from_session_id;
            $data = gs_twenty_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.gsAssessment', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 21) {
            $session_id = $request->created_from_session_id;
            $data = gs_twentyone_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.gsParentTraining', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 22) {
            $session_id = $request->created_from_session_id;
            $data = gs_twentytwo_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.gsSupervision', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 23) {
            $session_id = $request->created_from_session_id;
            $data = gs_twentythree_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.gsTreatment', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 24) {
            $session_id = $request->created_from_session_id;
            $data = bio_twentyfour_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data2 = bio_twentyfour2_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data3 = bio_twentyfour3_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data4 = bio_twentyfour4_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data5 = bio_twentyfour5_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data6 = bio_twentyfour6_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.biopsychosocial', compact('session_id', 'data', 'data2', 'data3', 'data4', 'data5', 'data6', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 25) {
            $session_id = $request->created_from_session_id;
            $data = birp_twentyfive_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data2 = birp_twentyfive2_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.birpProgress', compact('session_id', 'data', 'data2', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 26) {
            $session_id = $request->created_from_session_id;
            $data = dis_twentysix_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.dischargeSummary', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 27) {
            $session_id = $request->created_from_session_id;
            $data = lpro_twentyseven_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.languageProgress', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 28) {
            $session_id = $request->created_from_session_id;
            $data = ls_twentyeight_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.languageSession', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 29) {
            $session_id = $request->created_from_session_id;
            $data = dia_twentynine_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.diagnosisSummary', compact('session_id', 'data', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 30) {
            $session_id = $request->created_from_session_id;
            $data = ds_thirty1_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data2 = ds_thirty2_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data3 = ds_thirty3_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data4 = ds_thirty4_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data5 = ds_thirty5_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data6 = ds_thirty6_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data7 = ds_thirty7_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data8 = ds_thirty8_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data9 = ds_thirty9_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data10 = ds_thirty10_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data11 = ds_thirty11_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $data12 = ds_thirty12_form::where('sessionid', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            return view('provider.createdTemplate.dataSheet', compact('session_id', 'data', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7', 'data8', 'data9', 'data10', 'data11', 'data12', 'name_location', 'logo'));
        } elseif ($request->created_note_id == 60) {
            $session_id = $request->created_from_session_id;
            $data = \App\Models\saa_sixty_form::where('session_id', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $obj = $data->data_obj;
            return view('provider.createdTemplate.supervisionAndAssessment', compact('session_id', 'data', 'name_location', 'logo', 'obj'));
        } elseif ($request->created_note_id == 61) {
            $session_id = $request->created_from_session_id;
            $data = \App\Models\sn_sixtyone_form::where('session_id', $request->created_from_session_id)->where('admin_id', $this->admin_id)->first();
            $obj = $data->data_obj;
            return view('provider.createdTemplate.sessionNotesTwo', compact('session_id', 'data', 'name_location', 'logo', 'obj'));
        } else {

            if (strpos($request->created_note_id, '-') == false) {
                return back()->with('alert', 'Template Not Found');
            } else {
                $id = explode("-", $request->created_note_id);
                $id = $id[1];
                $main = custom_form::where('id', $id)->first();
                $form_id = $main->form_id;
                $data = $main->filled_form;
                $session_id = $main->session_id;
                $sign1 = $main->signature;
                $sign2 = $main->signature2;

                $notes = note_form::where('id', $main->form_id)->first();
                $title = $notes->template_name;
                $check = "created";
                return view('provider.formbuilder.formBuilderView', compact('data', 'session_id', 'form_id', 'title', 'logo', 'name_location', 'sign1', 'sign2', 'check'));
            }
        }
    }

    private function form_avail_save($session_id, $form_id)
    {
        $check = \App\Models\Session_notes_avail::where('admin_id', Auth::user()->admin_id)->where('session_id', $session_id)->where('form_id', $form_id)->first();
        if (!$check) {
            $save = new \App\Models\Session_notes_avail();
            $save->admin_id = Auth::user()->admin_id;
            $save->session_id = $session_id;
            $save->added = 1;
            $save->form_id = $form_id;
            $save->save();
        }
    }

    private function session_signatures($data, $request, $session_id)
    {

        $pro_sig = Appoinment_signature::select('session_id', 'signature', 'user_type')->where('session_id', $session_id)->where('user_type', 2)->where('admin_id', Auth::user()->admin_id)->first();
        if ($pro_sig) {
            $data->signature = $pro_sig->signature;
        } else {
            $data->signature = "from_session";
        }

        $care_sig = Appoinment_signature::select('session_id', 'signature', 'user_type')->where('session_id', $request->sessionid)->where('user_type', 1)->where('admin_id', Auth::user()->admin_id)->first();

        if ($care_sig) {
            $data->updload_sign = $care_sig->signature;
        } else {
            $data->updload_sign = "from_session";
        }

        return $data;
    }


    public function usp_form_one_submit(Request $request)
    {
        $check_exists = usf_one_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $usp_form_one = usf_one_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $usp_form_one = new usf_one_form();
        }


        if ($request->hasFile('updload_sign')) {
            $image = $request->file('updload_sign');
            $imageName = $this->admin_id . time() . uniqid() . '.' . "png";
            $directory = 'assets/dashboard/singnature/';
            $imgUrl1 = $directory . $imageName;
            Image::make($image)->save($imgUrl1);
            $usp_form_one->signature = $imgUrl1;
        } else {
            if ($request->sing_draw && $request->sing_draw != null) {
                $name = $this->admin_id . time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw, 0, strpos($request->sing_draw, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw)->save($imgUrl2);
                $usp_form_one->signature = $path3;
            }
        }

        if ($request->hasFile('updload_sign2')) {
            $image = $request->file('updload_sign2');
            $imageName = $this->admin_id . time() . uniqid() . '.' . "png";
            $directory = 'assets/dashboard/singnature/';
            $imgUrl1 = $directory . $imageName;
            Image::make($image)->save($imgUrl1);
            $usp_form_one->updload_sign = $imgUrl1;
        } else {
            if ($request->sing_draw2 && $request->sing_draw2 != null) {
                $name = $this->admin_id . time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw2, 0, strpos($request->sing_draw2, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw2)->save($imgUrl2);
                $usp_form_one->updload_sign = $path3;
            }
        }


        $usp_form_one->admin_id = $this->admin_id;
        $usp_form_one->sessionid = $request->sessionid;
        $usp_form_one->tr_name = $request->tr_name;
        $usp_form_one->starttm = Carbon::parse($request->starttm);
        $usp_form_one->stdate = $request->stdate;
        $usp_form_one->supervisor = $request->supervisor;
        $usp_form_one->endtime = Carbon::parse($request->endtime);
        $usp_form_one->exptyp = $request->exptyp;
        $usp_form_one->stgname = $request->stgname;
        $usp_form_one->actcat = $request->actcat;
        $usp_form_one->actnote = $request->actnote;
        $usp_form_one->tlhrs = Carbon::parse($request->tlhrs);
        $usp_form_one->tlcon = $request->tlcon;
        $usp_form_one->individual = $request->individual;
        $usp_form_one->group2 = $request->group2;
        $usp_form_one->traineewithclnt = $request->traineewithclnt;
        $usp_form_one->formate = $request->formate;
        $usp_form_one->experience2 = $request->experience2;
        $usp_form_one->supervisiontype = $request->supervisiontype;
        $usp_form_one->actcat2 = $request->actcat2;
        $usp_form_one->bsttask = $request->bsttask;
        $usp_form_one->sumsup = $request->sumsup;
        $usp_form_one->supfeed = $request->supfeed;
        $usp_form_one->actitem = $request->actitem;
        $usp_form_one->bcbaid = $request->bcbaid;
        $usp_form_one->signdate = $request->signdate;
        $usp_form_one->bacbid2 = $request->bacbid2;
        $usp_form_one->signdate2 = $request->signdate2;
        $usp_form_one->save();


        $this->form_avail_save($request->sessionid, 1);

        return 'done';
    }


    public function usp_form_one_by_ajax(Request $request)
    {
        $usp_form_one = usf_one_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        return response()->json($usp_form_one, 200);
    }


    public function sdptn_form_two_submit(Request $request)
    {
        $data = dsptn_two_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if (!$data) {
            $data = new dsptn_two_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);

        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->childname = $request->childname;
        $data->attendens = $request->attendens;
        $data->starttime = Carbon::parse($request->starttime);
        $data->endtime = Carbon::parse($request->endtime);
        $data->stdate = $request->stdate;
        $data->goals1 = $request->goals1;
        $data->goals2 = $request->goals2;
        $data->goals3 = $request->goals3;
        $data->goals4 = $request->goals4;
        $data->goals5 = $request->goals5;
        $data->goals6 = $request->goals6;
        $data->act = $request->act;
        $data->needs = $request->needs;
        $data->save();

        $this->form_avail_save($request->sessionid, 2);
        return 'done';
    }


    public function sdptn_form_two_by_ajax(Request $request)
    {
        $new_sdptn_form = dsptn_two_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        return response()->json($new_sdptn_form, 200);
    }


    public function btsmf_form_three_submit(Request $request)
    {
        $data = btsmf_three_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();

        if (!$data) {
            $data = new btsmf_three_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);

        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->stdate = $request->stdate;
        $data->sttime = $request->sttime;
        $data->trainee = $request->trainee;
        $data->restricthours = $request->restricthours;
        $data->setting = $request->setting;
        $data->numclient = $request->numclient;
        $data->cpurchaging = $request->cpurchaging;
        $data->unrestricthours = $request->unrestricthours;
        $data->supervisingbcba = $request->supervisingbcba;
        $data->bcba = $request->bcba;
        $data->nohouri = $request->nohouri;
        $data->nohs = $request->nohs;
        $data->top_feed = $request->top_feed;
        $data->tlic = $request->tlic;
        $data->bacbidsing = $request->bacbidsing;
        $data->bacbid = $request->bacbid;
        $data->bacbiddate = $request->bacbiddate;
        $data->bacbidsing2 = $request->bacbidsing2;
        $data->bacbid2 = $request->bacbid2;
        $data->bacbiddate2 = $request->bacbiddate2;
        $data->save();
        $this->form_avail_save($request->sessionid, 3);
        return 'done';
    }


    public function btusf_form_four_submit(Request $request)
    {
        $data = btusf_four_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if (!$data) {
            $data = new btusf_four_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->stdate = $request->stdate;
        $data->sttime = $request->sttime;
        $data->trainee = $request->trainee;
        $data->restricthours = $request->restricthours;
        $data->setting = $request->setting;
        $data->numclient = $request->numclient;
        $data->cpurchaging = $request->cpurchaging;
        $data->unrestricthours = $request->unrestricthours;
        $data->supervisingbcba = $request->supervisingbcba;
        $data->bcba = $request->bcba;
        $data->seslength = $request->seslength;
        $data->nohs = $request->nohs;
        $data->suptypes1 = $request->suptypes1;
        $data->suptypes2 = $request->suptypes2;
        $data->suptypes3 = $request->suptypes3;
        $data->arotime = $request->arotime;
        $data->coworkers = $request->coworkers;
        $data->selfimprovement = $request->selfimprovement;
        $data->appropriately = $request->appropriately;
        $data->seeks = $request->seeks;
        $data->submission = $request->submission;
        $data->communicates = $request->communicates;
        $data->sensitivity = $request->sensitivity;
        $data->behanalytic = $request->behanalytic;
        $data->feeds = $request->feeds;
        $data->tlic = $request->tlic;
        $data->bacbsign = $request->bacbsign;
        $data->bacb = $request->bacb;
        $data->bacbdate = $request->bacbdate;
        $data->bacbsign2 = $request->bacbsign2;
        $data->bacb2 = $request->bacb2;
        $data->bacbdate2 = $request->bacbdate2;
        $data->save();

        $this->form_avail_save($request->sessionid, 4);
        return 'done';
    }


    public function msn_form_five_submit(Request $request)
    {
        $data = msn_five_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if (!$data) {
            $data = new msn_five_form();
        }
        $data = $this->session_signatures($data, $request, $request->sessionid);

        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->clname = $request->clname;
        $data->stdate = $request->stdate;
        $data->sttime = Carbon::parse($request->sttime);
        $data->rbts = $request->rbts;
        $data->format1 = $request->format1;
        $data->format2 = $request->format2;
        $data->format3 = $request->format3;
        $data->format4 = $request->format4;
        $data->activities1 = $request->activities1;
        $data->activities2 = $request->activities2;
        $data->activities3 = $request->activities3;
        $data->activities4 = $request->activities4;
        $data->goals = $request->goals;
        $data->responsetreat1 = $request->responsetreat1;
        $data->responsetreat2 = $request->responsetreat2;
        $data->responsetreat3 = $request->responsetreat3;
        $data->responsetreat4 = $request->responsetreat4;
        $data->feed = $request->feed;
        $data->pcondis = $request->pcondis;
        $data->rbt = $request->rbt;
        $data->rbt_exp = $request->rbt_exp;
        $data->supervisorsign = $request->supervisorsign;
        $data->supervisorname = $request->supervisorname;
        $data->signdate = $request->signdate;
        $data->save();
        $this->form_avail_save($request->sessionid, 5);
        return 'done';
    }


    public function tcsn_form_six_submit(Request $request)
    {
        $data = tcsn_fix_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if (!$data) {
            $data = new tcsn_fix_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);

        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->clname = $request->clname;
        $data->stdate = $request->stdate;
        $data->sttime = Carbon::parse($request->sttime);
        $data->endtime = Carbon::parse($request->endtime);
        $data->setting1 = $request->setting1;
        $data->setting2 = $request->setting2;
        $data->setting3 = $request->setting3;
        $data->pepresent1 = $request->pepresent1;
        $data->pepresent2 = $request->pepresent2;
        $data->pepresent3 = $request->pepresent3;
        $data->pepresent4 = $request->pepresent4;
        $data->pepresent5 = $request->pepresent5;
        $data->pepresent6 = $request->pepresent6;
        $data->pepresentiotr = $request->pepresentiotr;
        $data->dangerousbehave1 = $request->dangerousbehave1;
        $data->dangerousbehave2 = $request->dangerousbehave2;
        $data->dangerousbehave3 = $request->dangerousbehave3;
        $data->dangerousbehave4 = $request->dangerousbehave4;
        $data->dangerousbehave5 = $request->dangerousbehave5;
        $data->dangerousbehave6 = $request->dangerousbehave6;
        $data->dangerousbehave7 = $request->dangerousbehave7;
        $data->dangerousbehaveotr = $request->dangerousbehaveotr;
        $data->chabehaviors = $request->chabehaviors;
        $data->dtt = $request->dtt;
        $data->net = $request->net;
        $data->mt = $request->mt;
        $data->ta = $request->ta;
        $data->bip = $request->bip;
        $data->shaping = $request->shaping;
        $data->bst = $request->bst;
        $data->iuotrcheck = $request->iuotrcheck;
        $data->iuotrchecktxt = $request->iuotrchecktxt;
        $data->prarcom = $request->prarcom;
        $data->proarpair = $request->proarpair;
        $data->proarscoial = $request->proarscoial;
        $data->proarsc = $request->proarsc;
        $data->proarpsk = $request->proarpsk;
        $data->proarflu = $request->proarflu;
        $data->proartnc = $request->proartnc;
        $data->proarsmr = $request->proarsmr;
        $data->proarotr = $request->proarotr;
        $data->proarotrtxt = $request->proarotrtxt;
        $data->ensession1 = $request->ensession1;
        $data->ensession2 = $request->ensession2;
        $data->ensession3 = $request->ensession3;
        $data->ensession4 = $request->ensession4;
        $data->ensession5 = $request->ensession5;
        $data->motivating = $request->motivating;
        $data->well = $request->well;
        $data->struggle = $request->struggle;
        $data->help = $request->help;
        $data->supsession1 = $request->supsession1;
        $data->supsession2 = $request->supsession2;
        $data->supsession3 = $request->supsession3;
        $data->supsession4 = $request->supsession4;
        $data->thcomts = $request->thcomts;
        $data->thersign1 = $request->thersign1;
        $data->priame1 = $request->priame1;
        $data->thersigndate1 = $request->thersigndate1;
        $data->pcqrbt = $request->pcqrbt;
        $data->pcqrbtexp = $request->pcqrbtexp;
        $data->thersign2 = $request->pcqrbtexp;
        $data->prname2 = $request->prname2;
        $data->thersigndate2 = $request->thersigndate2;
        $data->save();

        $this->form_avail_save($request->sessionid, 6);
        return "done";
    }

    public function form_7_submit(Request $request)
    {
        $data = ct_seven_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if (!$data) {
            $data = new ct_seven_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->clname = $request->clname;
        $data->date = $request->date;
        $data->stime = $request->stime;
        $data->etime = $request->etime;
        $data->setting = $request->setting;
        $data->community = $request->community;
        $data->clinic = $request->clinic;
        $data->school = $request->school;
        $data->langimp = $request->langimp;
        $data->explang = $request->explang;
        $data->ssdef = $request->ssdef;
        $data->repbeh = $request->repbeh;
        $data->resint = $request->resint;
        $data->hyper = $request->hyper;
        $data->insist = $request->insist;
        $data->harmself = $request->harmself;
        $data->report = $request->report;
        $data->brc = $request->brc;
        $data->mag = $request->mag;
        $data->bmg = $request->bmg;
        $data->mac = $request->mac;
        $data->mpg = $request->mpg;
        $data->mrs = $request->mrs;
        $data->mmg = $request->mmg;
        $data->mtt = $request->mtt;
        $data->ptr = $request->ptr;
        $data->asskill = $request->asskill;
        $data->intobs = $request->intobs;
        $data->othdes = $request->othdes;
        $data->othdesexp = $request->othdesexp;
        $data->lcomm = $request->lcomm;
        $data->ttp = $request->ttp;
        $data->socskill = $request->socskill;
        $data->playskill = $request->playskill;
        $data->adapskill = $request->adapskill;
        $data->selfman = $request->selfman;
        $data->motoskill = $request->motoskill;
        $data->tarsafe = $request->tarsafe;
        $data->disrupt = $request->disrupt;
        $data->taroth = $request->taroth;
        $data->tarothdes = $request->tarothdes;
        $data->dtt = $request->dtt;
        $data->net = $request->net;
        $data->net = $request->net;
        $data->vb = $request->vb;
        $data->shaping = $request->shaping;
        $data->chaining = $request->chaining;
        $data->bst = $request->bst;
        $data->incteach = $request->incteach;
        $data->propmt = $request->propmt;

        $data->save();

        $data = ct_seven2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if (!$data) {
            $data = new ct_seven2_form();
        }

        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->antec = $request->antec;
        $data->pnrein = $request->pnrein;
        $data->tokenecon = $request->tokenecon;
        $data->diffrein = $request->diffrein;
        $data->nonharm = $request->nonharm;
        $data->tuother = $request->tuother;
        $data->tuotherdes = $request->tuotherdes;
        $data->absbeh = $request->absbeh;
        $data->decbeh = $request->decbeh;
        $data->mastar = $request->mastar;
        $data->masgoal = $request->masgoal;
        $data->maingoal = $request->maingoal;
        $data->rapidgoal = $request->rapidgoal;
        $data->steadygoal = $request->steadygoal;
        $data->incbeh = $request->incbeh;
        $data->behplan = $request->behplan;
        $data->lackmot = $request->lackmot;
        $data->regresskill = $request->regresskill;
        $data->tpdetail = $request->tpdetail;
        $data->newbeh = $request->newbeh;
        $data->ptdiss = $request->ptdiss;
        $data->followup = $request->followup;
        $data->inperson = $request->inperson;
        $data->remote = $request->remote;
        $data->group = $request->group;
        $data->obsnote = $request->obsnote;
        $data->datreview = $request->datreview;
        $data->observation = $request->observation;
        $data->protdemon = $request->protdemon;
        $data->teammeeting = $request->teammeeting;
        $data->datother = $request->datother;
        $data->datotherexp = $request->datotherexp;
        $data->posfeed = $request->posfeed;
        $data->teach = $request->teach;
        $data->moddel = $request->moddel;
        $data->coach = $request->coach;
        $data->review = $request->review;
        $data->ioa = $request->ioa;
        $data->dttsheet = $request->dttsheet;
        $data->goal1 = $request->goal1;
        $data->goal2 = $request->goal2;
        $data->goal3 = $request->goal3;
        $data->parsign = $request->parsign;
        $data->parprint = $request->parprint;
        $data->pardate = $request->pardate;
        $data->pmsign = $request->pmsign;
        $data->pmprint = $request->pmprint;
        $data->pmdate = $request->pmdate;
        $data->save();
        $this->form_avail_save($request->sessionid, 7);
        return 'done';
    }


    public function tp_form_eight_submit(Request $request)
    {
        $check_exists = tp_eight_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $tp_form_eight = tp_eight_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $tp_form_eight = new tp_eight_form();
        }

        $tp_form_eight = $this->session_signatures($tp_form_eight, $request, $request->sessionid);




        $tp_form_eight->admin_id = $this->admin_id;
        $tp_form_eight->sessionid = $request->sessionid;
        $tp_form_eight->clname = $request->clname;
        $tp_form_eight->stdate = $request->stdate;
        $tp_form_eight->init = $request->init;
        $tp_form_eight->ongoing = $request->ongoing;
        $tp_form_eight->gl1 = $request->gl1;
        $tp_form_eight->gl1opendt = $request->gl1opendt;
        $tp_form_eight->gl1trdat = $request->gl1trdat;
        $tp_form_eight->gl1obj = $request->gl1obj;
        $tp_form_eight->gl1inter = $request->gl1inter;
        $tp_form_eight->gl2 = $request->gl2;
        $tp_form_eight->gl2opdt = $request->gl2opdt;
        $tp_form_eight->gl2trdt = $request->gl2trdt;
        $tp_form_eight->gl2obj = $request->gl2obj;
        $tp_form_eight->gl2inter = $request->gl2inter;
        $tp_form_eight->gl3 = $request->gl3;
        $tp_form_eight->gl3opdt = $request->gl3opdt;
        $tp_form_eight->gl3trdt = $request->gl3trdt;
        $tp_form_eight->gl3obj = $request->gl3obj;
        $tp_form_eight->gl3inter = $request->gl3inter;
        $tp_form_eight->gl4 = $request->gl4;
        $tp_form_eight->gl4opdt = $request->gl4opdt;
        $tp_form_eight->gl4trdt = $request->gl4trdt;
        $tp_form_eight->gl4obj = $request->gl4obj;
        $tp_form_eight->gl4inter = $request->gl4inter;
        $tp_form_eight->save();

        $this->form_avail_save($request->sessionid, 8);
        return 'done';
    }

    public function form_9_submit(Request $request)
    {
        $check_exists = pc_nine_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $btsmf_form = pc_nine_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $btsmf_form = new pc_nine_form();
        }


        $btsmf_form->admin_id = $this->admin_id;
        $btsmf_form->sessionid = $request->sessionid;
        $btsmf_form->clname = $request->clname;
        $btsmf_form->dob = $request->dob;
        $btsmf_form->doa = $request->doa;
        $btsmf_form->poa = $request->poa;
        $btsmf_form->address = $request->address;
        $btsmf_form->phone = $request->phone;
        $btsmf_form->insid = $request->insid;
        $btsmf_form->school = $request->school;
        $btsmf_form->grade = $request->grade;
        $btsmf_form->intersum = $request->intersum;
        $btsmf_form->psyserv = $request->psyserv;
        $btsmf_form->prepsy = $request->prepsy;
        $btsmf_form->prename = $request->prename;
        $btsmf_form->psymed = $request->psymed;
        $btsmf_form->preslist = $request->preslist;
        $btsmf_form->presby = $request->presby;
        // $btsmf_form->antidepress = $request->antidepress;
        // $btsmf_form->antilist = $request->antilist;
        // $btsmf_form->antiby = $request->antiby;
        $btsmf_form->priphy = $request->priphy;
        $btsmf_form->priphone = $request->priphone;
        $btsmf_form->mtomed = $request->mtomed;
        $btsmf_form->mtolist = $request->mtolist;
        $btsmf_form->lastphy = $request->lastphy;
        $btsmf_form->hconc = $request->hconc;
        $btsmf_form->currmed = $request->currmed;
        $btsmf_form->sleephab = $request->sleephab;
        $btsmf_form->sleepcheck = $request->sleepcheck;
        $btsmf_form->wexc = $request->wexc;
        $btsmf_form->exclong = $request->exclong;
        $btsmf_form->ehabit = $request->ehabit;
        $btsmf_form->ehabitcheck = $request->ehabitcheck;
        $btsmf_form->wchange = $request->wchange;
        $btsmf_form->usealc = $request->usealc;
        $btsmf_form->drinkp = $request->drinkp;
        $btsmf_form->recdrug = $request->recdrug;
        $btsmf_form->cigar = $request->cigar;
        $btsmf_form->suith = $request->suith;
        $btsmf_form->suipast = $request->suipast;
        $btsmf_form->romrel = $request->romrel;
        $btsmf_form->rellong = $request->rellong;
        $btsmf_form->relrate = $request->relrate;
        $btsmf_form->lastchange = $request->lastchange;
        $btsmf_form->depress = $request->depress;
        $btsmf_form->mood = $request->mood;
        $btsmf_form->rapids = $request->rapids;
        $btsmf_form->extanx = $request->extanx;
        $btsmf_form->panatt = $request->panatt;
        $btsmf_form->phob = $request->phob;
        $btsmf_form->sleepdis = $request->sleepdis;
        $btsmf_form->hallu = $request->hallu;
        $btsmf_form->unlosstime = $request->unlosstime;
        $btsmf_form->unexmemory = $request->unexmemory;
        $btsmf_form->alabuse = $request->alabuse;
        $btsmf_form->freqcomp = $request->freqcomp;
        $btsmf_form->eatdiss = $request->eatdiss;
        $btsmf_form->bodyimg = $request->bodyimg;

        $btsmf_form->save();

        $check_exists2 = pc_nine2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists2) {
            $btsmf_form2 = pc_nine2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $btsmf_form2 = new pc_nine2_form();
        }

        $btsmf_form2 = $this->session_signatures($btsmf_form2, $request, $request->sessionid);




        $btsmf_form2->admin_id = $this->admin_id;
        $btsmf_form2->sessionid = $request->sessionid;
        $btsmf_form2->repth = $request->repth;
        $btsmf_form2->repbeh = $request->repbeh;
        $btsmf_form2->homith = $request->homith;
        $btsmf_form2->suiattm = $request->suiattm;
        $btsmf_form2->suiwhen = $request->suiwhen;
        $btsmf_form2->curremp = $request->curremp;
        $btsmf_form2->emppos = $request->emppos;
        $btsmf_form2->emphappy = $request->emphappy;
        $btsmf_form2->workstress = $request->workstress;
        $btsmf_form2->religious = $request->religious;
        $btsmf_form2->faith = $request->faith;
        $btsmf_form2->spiritual = $request->spiritual;
        $btsmf_form2->difficulty = $request->difficulty;
        $btsmf_form2->depr = $request->depr;
        $btsmf_form2->depexp = $request->depexp;
        $btsmf_form2->bipdis = $request->bipdis;
        $btsmf_form2->bipdisexp = $request->bipdisexp;
        $btsmf_form2->anxdis = $request->anxdis;
        $btsmf_form2->anxdisexp = $request->anxdisexp;
        $btsmf_form2->panicatt = $request->panicatt;
        $btsmf_form2->panicattexp = $request->panicattexp;
        $btsmf_form2->sch = $request->sch;
        $btsmf_form2->schexp = $request->schexp;
        $btsmf_form2->abuse = $request->abuse;
        $btsmf_form2->abusexp = $request->abusexp;
        $btsmf_form2->eatdis = $request->eatdis;
        $btsmf_form2->eatdisexp = $request->eatdisexp;
        $btsmf_form2->leardis = $request->leardis;
        $btsmf_form2->leardisexp = $request->leardisexp;
        $btsmf_form2->trauma = $request->trauma;
        $btsmf_form2->traumaexp = $request->traumaexp;
        $btsmf_form2->suiatt = $request->suiatt;
        $btsmf_form2->suiattexp = $request->suiattexp;
        $btsmf_form2->chrill = $request->chrill;
        $btsmf_form2->chrillexp = $request->chrillexp;
        $btsmf_form2->strength = $request->strength;
        $btsmf_form2->aboutyou = $request->aboutyou;
        $btsmf_form2->copstra = $request->copstra;
        $btsmf_form2->goalthe = $request->goalthe;
        $btsmf_form2->diagassess = $request->diagassess;
        $btsmf_form2->nurse = $request->nurse;
        $btsmf_form2->psytest = $request->psytest;
        $btsmf_form2->psytreat = $request->psytreat;
        $btsmf_form2->medadmin = $request->medadmin;
        $btsmf_form2->commsupport = $request->commsupport;
        $btsmf_form2->indout = $request->indout;
        $btsmf_form2->outser = $request->outser;
        $btsmf_form2->groupout = $request->groupout;
        $btsmf_form2->intenfam = $request->intenfam;
        $btsmf_form2->stab = $request->stab;
        $btsmf_form2->struct = $request->struct;
        $btsmf_form2->psyassess = $request->psyassess;
        $btsmf_form2->behass = $request->behass;
        $btsmf_form2->otherr = $request->otherr;
        $btsmf_form2->otherr2 = $request->otherr2;

        $btsmf_form2->save();
        $this->form_avail_save($request->sessionid, 9);
        return 'done';
    }

    public function form_10_submit(Request $request)
    {
        $check_exists = ot_ten_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ot_ten_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ot_ten_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);





        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->riskharm = $request->riskharm;
        $data->funcstatus = $request->funcstatus;
        $data->funcstatus = $request->funcstatus;
        $data->comorbid = $request->comorbid;
        $data->envstress = $request->envstress;
        $data->suppenv = $request->suppenv;
        $data->rescurr = $request->rescurr;
        $data->acceng = $request->acceng;
        $data->transp = $request->transp;
        $data->present = $request->present;
        $data->currtreat = $request->currtreat;
        $data->detail30 = $request->detail30;
        $data->currmed = $request->currmed;
        $data->treat = $request->treat;
        $data->save();

        $this->form_avail_save($request->sessionid, 10);
        return 'done';
    }

    public function cn_form_eleven_submit(Request $request)
    {

        $check_exists = cn_eleven_form::where('admin_id', $this->admin_id)->where('sessionid', $request->sessionid)->first();
        if ($check_exists) {
            $form_eleven = cn_eleven_form::where('admin_id', $this->admin_id)->where('sessionid', $request->sessionid)->first();
        } else {
            $form_eleven = new cn_eleven_form();
        }

        $form_eleven = $this->session_signatures($form_eleven, $request, $request->sessionid);



        $form_eleven->admin_id = $this->admin_id;
        $form_eleven->sessionid = $request->sessionid;
        $form_eleven->clname = $request->clname;
        $form_eleven->stdate = $request->stdate;
        $form_eleven->terp = $request->terp;
        $form_eleven->sttitme = Carbon::parse($request->sttitme);
        $form_eleven->endtime = Carbon::parse($request->endtime);
        $form_eleven->notes = $request->notes;
        $form_eleven->location = $request->location;
        $form_eleven->lodate = $request->lodate;
        $form_eleven->losttime = Carbon::parse($request->losttime);
        $form_eleven->loendtime = Carbon::parse($request->loendtime);
        $form_eleven->los = $request->los;
        $form_eleven->spyn = $request->spyn;
        $form_eleven->cpins = $request->cpins;
        $form_eleven->suds = $request->suds;
        $form_eleven->twods = $request->twods;
        $form_eleven->wnmbwo = $request->wnmbwo;
        $form_eleven->iopdb = $request->iopdb;
        $form_eleven->note2 = $request->note2;
        $form_eleven->ladd = $request->ladd;
        $form_eleven->save();

        $this->form_avail_save($request->sessionid, 11);
        return "done";
    }

    public function form_12_submit(Request $request)
    {
        $check_exists = pt_twelve_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $btsmf_form = pt_twelve_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $btsmf_form = new pt_twelve_form();
        }

        $btsmf_form = $this->session_signatures($btsmf_form, $request, $request->sessionid);


        $btsmf_form->admin_id = $this->admin_id;
        $btsmf_form->sessionid = $request->sessionid;
        $btsmf_form->clname = $request->clname;
        $btsmf_form->dob = $request->dob;
        $btsmf_form->age = $request->age;
        $btsmf_form->diag = $request->diag;
        $btsmf_form->insured = $request->insured;
        $btsmf_form->p_name = $request->p_name;
        $btsmf_form->cred = $request->cred;
        $btsmf_form->caregiver = $request->caregiver;
        $btsmf_form->clname2 = $request->clname2;
        $btsmf_form->bcbarad = $request->bcbarad;
        $btsmf_form->otherexp = $request->otherexp;
        $btsmf_form->sd = $request->sd;
        $btsmf_form->sst = Carbon::parse($request->sst);
        $btsmf_form->set = Carbon::parse($request->set);
        $btsmf_form->in_person = $request->in_person;
        $btsmf_form->remote = $request->remote;
        $btsmf_form->pto = $request->pto;
        $btsmf_form->fd = $request->fd;
        $btsmf_form->pfn = $request->pfn;
        $btsmf_form->pcred = $request->pcred;

        $btsmf_form->save();
        $this->form_avail_save($request->sessionid, 12);
        return 'done';
    }

    public function form_13_submit(Request $request)
    {
        $check_exists = sn_thirteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $btsmf_form = sn_thirteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $btsmf_form = new sn_thirteen_form();
        }
        $btsmf_form = $this->session_signatures($btsmf_form, $request, $request->sessionid);

        $btsmf_form->admin_id = $this->admin_id;
        $btsmf_form->sessionid = $request->sessionid;
        $btsmf_form->clname = $request->clname;
        $btsmf_form->sd = $request->sd;
        $btsmf_form->stime = Carbon::parse($request->stime);
        $btsmf_form->etime = Carbon::parse($request->etime);
        $btsmf_form->units = $request->units;
        $btsmf_form->sl = $request->sl;
        $btsmf_form->pxcode = $request->pxcode;
        $btsmf_form->scd = $request->scd;
        $btsmf_form->on = $request->on;
        $btsmf_form->pname = $request->pname;
        $btsmf_form->pcr = $request->pcr;
        $btsmf_form->pnpi = $request->pnpi;
        $btsmf_form->skill = $request->skill;
        $btsmf_form->social = $request->social;
        $btsmf_form->role = $request->role;
        $btsmf_form->prem = $request->prem;
        $btsmf_form->stimu = $request->stimu;
        $btsmf_form->modeling = $request->modeling;
        $btsmf_form->shaping = $request->shaping;
        $btsmf_form->contract = $request->contract;
        $btsmf_form->timer = $request->timer;
        $btsmf_form->tboard = $request->tboard;
        $btsmf_form->selfm = $request->selfm;
        $btsmf_form->dtt = $request->dtt;
        $btsmf_form->antm = $request->antm;
        $btsmf_form->selfmn = $request->selfmn;
        $btsmf_form->diffrein = $request->diffrein;
        $btsmf_form->fct = $request->fct;
        $btsmf_form->vaid = $request->vaid;
        $btsmf_form->errorlearn = $request->errorlearn;
        $btsmf_form->net = $request->net;
        $btsmf_form->chaining = $request->chaining;
        $btsmf_form->others = $request->others;
        $btsmf_form->other2 = $request->other2;
        $btsmf_form->stype = $request->stype;
        $btsmf_form->sessionnotes = $request->sessionnotes;
        $btsmf_form->ssummary = $request->ssummary;
        $btsmf_form->provider_name = $request->provider_name;
        $btsmf_form->pcredent = $request->pcredent;

        $btsmf_form->save();
        $this->form_avail_save($request->sessionid, 13);
        return 'done';
    }

    public function form_14_submit(Request $request)
    {
        $check_exists = register_fourteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $btsmf_form = register_fourteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $btsmf_form = new register_fourteen_form();
        }

        $btsmf_form = $this->session_signatures($btsmf_form, $request, $request->sessionid);



        $btsmf_form->admin_id = $this->admin_id;
        $btsmf_form->sessionid = $request->sessionid;
        $btsmf_form->clname = $request->clname;
        $btsmf_form->dob = $request->dob;
        $btsmf_form->age = $request->age;
        $btsmf_form->diagnosis = $request->diagnosis;
        $btsmf_form->supname = $request->supname;
        $btsmf_form->regtech = $request->regtech;
        $btsmf_form->sd = $request->sd;
        $btsmf_form->sst = Carbon::parse($request->sst);
        $btsmf_form->set = Carbon::parse($request->set);
        $btsmf_form->ptperson = $request->ptperson;
        $btsmf_form->ptremote = $request->ptremote;
        $btsmf_form->supoverview = $request->supoverview;
        $btsmf_form->supfeed = $request->supfeed;
        $btsmf_form->pfn = $request->pfn;
        $btsmf_form->pcred = $request->pcred;

        $btsmf_form->save();
        $this->form_avail_save($request->sessionid, 14);
        return 'done';
    }

    public function form_15_submit(Request $request)
    {
        $check_exists = register2_fifteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $btsmf_form = register2_fifteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $btsmf_form = new register2_fifteen_form();
        }

        $btsmf_form = $this->session_signatures($btsmf_form, $request, $request->sessionid);





        $btsmf_form->admin_id = $this->admin_id;
        $btsmf_form->sessionid = $request->sessionid;
        $btsmf_form->clname = $request->clname;
        $btsmf_form->dob = $request->dob;
        $btsmf_form->age = $request->age;
        $btsmf_form->cldiag = $request->cldiag;
        $btsmf_form->insured = $request->insured;
        $btsmf_form->supname = $request->supname;
        $btsmf_form->regtech = $request->regtech;
        $btsmf_form->sd = $request->sd;
        $btsmf_form->sst = Carbon::parse($request->sst);
        $btsmf_form->set = Carbon::parse($request->set);
        $btsmf_form->supprovide = $request->supprovide;
        $btsmf_form->a_1 = $request->a_1;
        $btsmf_form->a_2 = $request->a_2;
        $btsmf_form->a_3 = $request->a_3;
        $btsmf_form->a_4 = $request->a_4;
        $btsmf_form->a_5 = $request->a_5;
        $btsmf_form->a_6 = $request->a_6;
        $btsmf_form->b_1 = $request->b_1;
        $btsmf_form->b_2 = $request->b_2;
        $btsmf_form->b_3 = $request->b_3;
        $btsmf_form->c_1 = $request->c_1;
        $btsmf_form->c_2 = $request->c_2;
        $btsmf_form->c_3 = $request->c_3;
        $btsmf_form->c_4 = $request->c_4;
        $btsmf_form->c_5 = $request->c_5;
        $btsmf_form->c_6 = $request->c_6;
        $btsmf_form->c_7 = $request->c_7;
        $btsmf_form->c_8 = $request->c_8;
        $btsmf_form->c_9 = $request->c_9;
        $btsmf_form->c_10 = $request->c_10;
        $btsmf_form->c_11 = $request->c_11;
        $btsmf_form->c_12 = $request->c_12;
        $btsmf_form->d_1 = $request->d_1;
        $btsmf_form->d_2 = $request->d_2;
        $btsmf_form->d_3 = $request->d_3;
        $btsmf_form->d_4 = $request->d_4;
        $btsmf_form->d_5 = $request->d_5;
        $btsmf_form->d_6 = $request->d_6;
        $btsmf_form->e_1 = $request->e_1;
        $btsmf_form->e_2 = $request->e_2;
        $btsmf_form->e_3 = $request->e_3;
        $btsmf_form->e_4 = $request->e_4;
        $btsmf_form->e_5 = $request->e_5;
        $btsmf_form->f_1 = $request->f_1;
        $btsmf_form->f_2 = $request->f_2;
        $btsmf_form->f_3 = $request->f_3;
        $btsmf_form->f_4 = $request->f_4;
        $btsmf_form->f_5 = $request->f_5;
        $btsmf_form->supfeed = $request->supfeed;
        $btsmf_form->supoverview = $request->supoverview;

        $btsmf_form->save();
        $this->form_avail_save($request->sessionid, 15);
        return 'done';
    }

    public function form_16_submit(Request $request)
    {
        $check_exists = sp_sixteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $btsmf_form = sp_sixteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $btsmf_form = new sp_sixteen_form();
        }

        $btsmf_form->admin_id = $this->admin_id;
        $btsmf_form->sessionid = $request->sessionid;
        $btsmf_form->rec_name = $request->rec_name;
        $btsmf_form->ide = $request->ide;
        $btsmf_form->age = $request->age;
        $btsmf_form->dob = $request->dob;
        $btsmf_form->gname = $request->gname;
        $btsmf_form->gcontact = $request->gcontact;
        $btsmf_form->address = $request->address;
        $btsmf_form->comdate = $request->comdate;
        $btsmf_form->auth = $request->auth;
        $btsmf_form->authname = $request->authname;
        $btsmf_form->bacbcer = $request->bacbcer;
        $btsmf_form->npi = $request->npi;
        $btsmf_form->recdia = $request->recdia;
        $btsmf_form->refer = $request->refer;
        $btsmf_form->phyname = $request->phyname;
        $btsmf_form->phynpi = $request->phynpi;
        $btsmf_form->phycontact = $request->phycontact;
        $btsmf_form->intset = $request->intset;
        $btsmf_form->radio1 = $request->radio1;
        $btsmf_form->bginfo = $request->bginfo;
        $btsmf_form->mdissue = $request->mdissue;
        $btsmf_form->resref = $request->resref;
        $btsmf_form->date1 = $request->date1;
        $btsmf_form->ant1 = $request->ant1;
        $btsmf_form->beh1 = $request->beh1;
        $btsmf_form->con1 = $request->con1;
        $btsmf_form->date2 = $request->date2;
        $btsmf_form->ant2 = $request->ant2;
        $btsmf_form->beh2 = $request->beh2;
        $btsmf_form->con2 = $request->con2;
        $btsmf_form->date3 = $request->date3;
        $btsmf_form->ant3 = $request->ant3;
        $btsmf_form->beh3 = $request->beh3;
        $btsmf_form->con3 = $request->con3;
        $btsmf_form->save();


        $check_exists2 = sp_sixteen2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists2) {
            $btsmf_form2 = sp_sixteen2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $btsmf_form2 = new sp_sixteen2_form();
        }

        $btsmf_form2->admin_id = $this->admin_id;
        $btsmf_form2->sessionid = $request->sessionid;
        $btsmf_form2->medn1 = $request->medn1;
        $btsmf_form2->dos1 = $request->dos1;
        $btsmf_form2->pur1 = $request->pur1;
        $btsmf_form2->side1 = $request->side1;
        $btsmf_form2->medn2 = $request->medn2;
        $btsmf_form2->dos2 = $request->dos2;
        $btsmf_form2->pur2 = $request->pur2;
        $btsmf_form2->side2 = $request->side2;
        $btsmf_form2->medn3 = $request->medn3;
        $btsmf_form2->dos3 = $request->dos3;
        $btsmf_form2->pur3 = $request->pur3;
        $btsmf_form2->side3 = $request->side3;
        $btsmf_form2->beh = $request->beh;
        $btsmf_form2->func = $request->func;
        $btsmf_form2->bline = $request->bline;
        $btsmf_form2->inten = $request->inten;
        $btsmf_form2->datam = $request->datam;
        $btsmf_form2->patid = $request->patid;
        $btsmf_form2->blang = $request->blang;
        $btsmf_form2->goal1 = $request->goal1;
        $btsmf_form2->goal2 = $request->goal2;
        $btsmf_form2->goal3 = $request->goal3;
        $btsmf_form2->gtrain = $request->gtrain;
        $btsmf_form2->tgbgoal = $request->tgbgoal;
        $btsmf_form2->contextant = $request->contextant;
        $btsmf_form2->behv = $request->behv;
        $btsmf_form2->funccon = $request->funccon;
        $btsmf_form2->consq = $request->consq;
        $btsmf_form2->preventst = $request->preventst;
        $btsmf_form2->repskills = $request->repskills;
        $btsmf_form2->managest = $request->managest;
        $btsmf_form2->ltstat = $request->ltstat;
        $btsmf_form2->ltobj = $request->ltobj;
        $btsmf_form2->interobj = $request->interobj;
        $btsmf_form2->tarbeh = $request->tarbeh;
        $btsmf_form2->stobj = $request->stobj;
        $btsmf_form2->mes = $request->mes;
        $btsmf_form2->sttatus = $request->sttatus;
        $btsmf_form2->baselevel = $request->baselevel;
        $btsmf_form2->clevel = $request->clevel;
        $btsmf_form2->mcriteria = $request->mcriteria;
        $btsmf_form2->act = $request->act;
        $btsmf_form2->drink = $request->drink;
        $btsmf_form2->games = $request->games;
        $btsmf_form2->social = $request->social;
        $btsmf_form2->risk = $request->risk;
        $btsmf_form2->notes = $request->notes;
        $btsmf_form2->benefit = $request->benefit;
        $btsmf_form2->nott = $request->nott;
        $btsmf_form2->genez = $request->genez;
        $btsmf_form2->maint = $request->maint;
        $btsmf_form2->actstep1 = $request->actstep1;
        $btsmf_form2->crit1 = $request->crit1;
        $btsmf_form2->tframe1 = $request->tframe1;
        $btsmf_form2->srba1 = $request->srba1;
        $btsmf_form2->srbas1 = $request->srbas1;
        $btsmf_form2->nlct1 = $request->nlct1;
        $btsmf_form2->desc1 = $request->desc1;
        $btsmf_form2->actstep2 = $request->actstep2;
        $btsmf_form2->crit2 = $request->crit2;
        $btsmf_form2->tframe2 = $request->tframe2;
        $btsmf_form2->srba2 = $request->srba2;
        $btsmf_form2->srbas2 = $request->srbas2;
        $btsmf_form2->nlct2 = $request->nlct2;
        $btsmf_form2->desc2 = $request->desc2;

        $btsmf_form2->save();


        $check_exists3 = sp_sixteen3_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists3) {
            $btsmf_form3 = sp_sixteen3_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $btsmf_form3 = new sp_sixteen3_form();
        }

        $btsmf_form3 = $this->session_signatures($btsmf_form3, $request, $request->sessionid);




        $btsmf_form3->admin_id = $this->admin_id;
        $btsmf_form3->sessionid = $request->sessionid;
        $btsmf_form3->actstep3 = $request->actstep3;
        $btsmf_form3->crit3 = $request->crit3;
        $btsmf_form3->tframe3 = $request->tframe3;
        $btsmf_form3->srba3 = $request->srba3;
        $btsmf_form3->srbas3 = $request->srbas3;
        $btsmf_form3->nlct3 = $request->nlct3;
        $btsmf_form3->desc3 = $request->desc3;
        $btsmf_form3->actstep4 = $request->actstep4;
        $btsmf_form3->crit4 = $request->crit4;
        $btsmf_form3->tframe4 = $request->tframe4;
        $btsmf_form3->srba4 = $request->srba4;
        $btsmf_form3->srbas4 = $request->srbas4;
        $btsmf_form3->nlct4 = $request->nlct4;
        $btsmf_form3->desc4 = $request->desc4;
        $btsmf_form3->emgprot = $request->emgprot;
        $btsmf_form3->compr = $request->compr;
        $btsmf_form3->psydrug = $request->psydrug;
        $btsmf_form3->pcp = $request->pcp;
        $btsmf_form3->decline = $request->decline;
        $btsmf_form3->bh = $request->bh;
        $btsmf_form3->bhtype = $request->bhtype;
        $btsmf_form3->leadh = $request->leadh;
        $btsmf_form3->rbth = $request->rbth;
        $btsmf_form3->trh = $request->trh;
        $btsmf_form3->bcbam = $request->bcbam;
        $btsmf_form3->bcbatu = $request->bcbatu;
        $btsmf_form3->bcbawe = $request->bcbawe;
        $btsmf_form3->bcbath = $request->bcbath;
        $btsmf_form3->bcbafri = $request->bcbafri;
        $btsmf_form3->rbtm = $request->rbtm;
        $btsmf_form3->rbttu = $request->rbttu;
        $btsmf_form3->rbtwe = $request->rbtwe;
        $btsmf_form3->rbtth = $request->rbtth;
        $btsmf_form3->rbtfri = $request->rbtfri;
        $btsmf_form3->bacbname = $request->bacbname;
        $btsmf_form3->bacbcer = $request->bacbcer;


        $btsmf_form3->save();
        $this->form_avail_save($request->sessionid, 16);
        return 'done';
    }


    public function form_17_submit(Request $request)
    {
        $check_exists = cp_seventeen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = cp_seventeen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new cp_seventeen_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);



        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->currstatus = $request->currstatus;
        $data->goaltarget = $request->goaltarget;
        $data->goaladdress = $request->goaladdress;
        $data->techattempt = $request->techattempt;
        $data->restreat = $request->restreat;
        $data->progressdata = $request->progressdata;
        $data->lengthsup = $request->lengthsup;
        $data->rendbehtech = $request->rendbehtech;
        $data->superprovide = $request->superprovide;
        $data->feedbackcrit = $request->feedbackcrit;
        $data->client = $request->client;
        $data->therapist = $request->therapist;
        $data->render_prov = $request->render_prov;

        $data->save();
        $this->form_avail_save($request->sessionid, 17);
        return 'done';
    }

    public function form_18_submit(Request $request)
    {
        $check_exists = cp_eighteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = cp_eighteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new cp_eighteen_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);



        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->clinicstatus = $request->clinicstatus;
        $data->whopresent = $request->whopresent;
        $data->behatarget = $request->behatarget;
        $data->techused = $request->techused;
        $data->programwork = $request->programwork;
        $data->reinforce = $request->reinforce;
        $data->clientprogress = $request->clientprogress;
        $data->plannext = $request->plannext;

        $data->save();
        $this->form_avail_save($request->sessionid, 18);
        return 'done';
    }

    public function form_19_submit(Request $request)
    {
        $check_exists = cp_ninteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = cp_ninteen_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new cp_ninteen_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);




        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->subjective = $request->subjective;
        $data->objective = $request->objective;
        $data->assessment = $request->assessment;
        $data->plan = $request->plan;
        $data->client = $request->client;
        $data->therapist = $request->therapist;
        $data->render_prov = $request->render_prov;

        $data->save();
        $this->form_avail_save($request->sessionid, 19);
        return 'done';
    }

    public function form_20_submit(Request $request)
    {
        $check_exists = gs_twenty_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = gs_twenty_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new gs_twenty_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->task = $request->task;
        $data->assesstool = $request->assesstool;
        $data->destask = $request->destask;
        $data->client = $request->client;
        $data->therapist = $request->therapist;
        $data->render_prov = $request->render_prov;
        $data->save();
        $this->form_avail_save($request->sessionid, 20);
        return 'done';
    }

    public function form_21_submit(Request $request)
    {
        $check_exists = gs_twentyone_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = gs_twentyone_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new gs_twentyone_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);



        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->parti = $request->parti;
        $data->recm = $request->recm;
        $data->goaladdress = $request->goaladdress;
        $data->intervent = $request->intervent;
        $data->feedback = $request->feedback;

        $data->client = $request->client;
        $data->therapist = $request->therapist;
        $data->render_prov = $request->render_prov;
        $data->save();
        $this->form_avail_save($request->sessionid, 21);
        return 'done';
    }

    public function form_22_submit(Request $request)
    {
        $check_exists = gs_twentytwo_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = gs_twentytwo_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new gs_twentytwo_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);

        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->defict = $request->defict;
        $data->pbo = $request->pbo;
        $data->iu = $request->iu;
        $data->pn = $request->pn;
        $data->fpt = $request->fpt;
        $data->client = $request->client;
        $data->therapist = $request->therapist;
        $data->render_prov = $request->render_prov;
        $data->save();

        $this->form_avail_save($request->sessionid, 22);
        return 'done';
    }

    public function form_23_submit(Request $request)
    {
        $check_exists = gs_twentythree_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = gs_twentythree_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new gs_twentythree_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->task = $request->task;
        $data->taskdes = $request->taskdes;
        $data->client = $request->client;
        $data->therapist = $request->therapist;
        $data->render_prov = $request->render_prov;
        $data->save();
        $this->form_avail_save($request->sessionid, 23);
        return 'done';
    }

    public function form_24_submit(Request $request)
    {

        $check_exists = bio_twentyfour_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = bio_twentyfour_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new bio_twentyfour_form();
        }


        $data = $this->session_signatures($data, $request, $request->sessionid);

        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->presentprob = $request->presentprob;
        $data->history = $request->history;
        $data->riskharm = $request->riskharm;
        $data->trauma = $request->trauma;
        $data->comorbid = $request->comorbid;
        $data->environ = $request->environ;
        $data->defictsupport = $request->defictsupport;
        $data->transportation = $request->transportation;
        $data->clientrequest = $request->clientrequest;
        $data->prenatal = $request->prenatal;
        $data->health = $request->health;
        $data->devmile = $request->devmile;
        $data->specialserv = $request->specialserv;
        $data->otherlife = $request->otherlife;
        $data->attending = $request->attending;
        $data->grade = $request->grade;
        $data->expell = $request->expell;
        $data->absences = $request->absences;
        $data->retained = $request->retained;
        $data->classes = $request->classes;
        $data->pastpsy = $request->pastpsy;
        $data->physical = $request->physical;
        $data->substance = $request->substance;
        $data->present = $request->present;
        $data->outcome = $request->outcome;
        $data->pastsupport = $request->pastsupport;
        $data->otherprovider = $request->otherprovider;
        $data->lhistinfo = $request->lhistinfo;
        $data->lhistwel = $request->lhistwel;
        $data->lhistrestrain = $request->lhistrestrain;
        $data->lhistformal = $request->lhistformal;
        $data->lhistconserv = $request->lhistconserv;
        $data->lhistnone = $request->lhistnone;
        $data->lhistparole = $request->lhistparole;
        $data->lhistdui = $request->lhistdui;
        $data->probationoff = $request->probationoff;
        $data->ssubstance = $request->ssubstance;
        $data->caffeine = $request->caffeine;
        $data->prescr = $request->prescr;
        $data->halluc = $request->halluc;
        $data->save();

        $check_exists = bio_twentyfour2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = bio_twentyfour2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new bio_twentyfour2_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->sdativ = $request->sdativ;
        $data->barbit = $request->barbit;
        $data->methad = $request->methad;
        $data->subother = $request->subother;
        $data->tobacco = $request->tobacco;
        $data->alcohol = $request->alcohol;
        $data->mariju = $request->mariju;
        $data->tranqu = $request->tranqu;
        $data->metham = $request->metham;
        $data->overcount = $request->overcount;
        $data->inhalant = $request->inhalant;
        $data->stimul = $request->stimul;
        $data->cocain = $request->cocain;
        $data->withdrawal = $request->withdrawal;
        $data->askandrecord = $request->askandrecord;
        $data->sobriety = $request->sobriety;
        $data->whensobriety = $request->whensobriety;
        $data->unremark = $request->unremark;
        $data->unkempt = $request->unkempt;
        $data->atypical = $request->atypical;
        $data->person = $request->person;
        $data->place = $request->place;
        $data->oridate = $request->oridate;
        $data->situation = $request->situation;
        $data->insightpoor = $request->insightpoor;
        $data->insightaverage = $request->insightaverage;
        $data->insightgood = $request->insightgood;
        $data->judgpoor = $request->judgpoor;
        $data->judgaver = $request->judgaver;
        $data->judggood = $request->judggood;
        $data->judgecomment = $request->judgecomment;
        $data->motorun = $request->motorun;
        $data->motorrest = $request->motorrest;
        $data->motorwith = $request->motorwith;
        $data->motorslurr = $request->motorslurr;
        $data->limit = $request->limit;
        $data->sleeppat = $request->sleeppat;
        $data->appetite = $request->appetite;
        $data->acomment = $request->acomment;
        $data->affun = $request->affun;
        $data->save();

        $check_exists = bio_twentyfour3_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = bio_twentyfour3_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new bio_twentyfour3_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->affcrit = $request->affcrit;
        $data->affflat = $request->affflat;
        $data->affangr = $request->affangr;
        $data->affeuph = $request->affeuph;
        $data->affsilly = $request->affsilly;
        $data->affirri = $request->affirri;
        $data->affdepr = $request->affdepr;
        $data->affhope = $request->affhope;
        $data->depnone = $request->depnone;
        $data->dephypo = $request->dephypo;
        $data->depfati = $request->depfati;
        $data->depfee = $request->depfee;
        $data->depguilt = $request->depguilt;
        $data->dephelpless = $request->dephelpless;
        $data->depirrit = $request->depirrit;
        $data->deppoor = $request->deppoor;
        $data->depsadn = $request->depsadn;
        $data->depsexual = $request->depsexual;
        $data->deploss = $request->deploss;
        $data->depwithdraw = $request->depwithdraw;
        $data->depself = $request->depself;
        $data->depinter = $request->depinter;
        $data->depcry = $request->depcry;
        $data->deprcomm = $request->deprcomm;
        $data->thinun = $request->thinun;
        $data->thindiss = $request->thindiss;
        $data->thindel = $request->thindel;
        $data->thinhyp = $request->thinhyp;
        $data->thindis = $request->thindis;
        $data->thinsus = $request->thinsus;
        $data->thinobs = $request->thinobs;
        $data->thinfli = $request->thinfli;
        $data->thinconf = $request->thinconf;
        $data->thingrand = $request->thingrand;
        $data->thinkcomm = $request->thinkcomm;
        $data->attun = $request->attun;
        $data->attego = $request->attego;
        $data->attsar = $request->attsar;
        $data->attres = $request->attres;
        $data->attcont = $request->attcont;

        $data->save();

        $check_exists = bio_twentyfour4_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = bio_twentyfour4_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new bio_twentyfour4_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->atthost = $request->atthost;
        $data->attneg = $request->attneg;
        $data->attpass = $request->attpass;
        $data->attaggr = $request->attaggr;
        $data->attsedu = $request->attsedu;
        $data->attitudecomm = $request->attitudecomm;
        $data->medhistory = $request->medhistory;
        $data->medcond = $request->medcond;
        $data->contactinfo = $request->contactinfo;
        $data->lastdate = $request->lastdate;
        $data->immunizations = $request->immunizations;
        $data->height = $request->height;
        $data->weight = $request->weight;
        $data->satisfied = $request->satisfied;
        $data->diagnosed = $request->diagnosed;
        $data->referral = $request->referral;
        $data->med = $request->med;
        $data->dosage = $request->dosage;
        $data->effect = $request->effect;
        $data->compli = $request->compli;
        $data->prescrr = $request->prescrr;
        $data->medname = $request->medname;
        $data->dosefreq = $request->dosefreq;
        $data->effective = $request->effective;
        $data->compl = $request->compl;
        $data->presby = $request->presby;
        $data->med3 = $request->med3;
        $data->freq3 = $request->freq3;
        $data->effect3 = $request->effect3;
        $data->compl3 = $request->compl3;
        $data->pres3 = $request->pres3;
        $data->med4 = $request->med4;
        $data->freq4 = $request->freq4;
        $data->effect4 = $request->effect4;
        $data->compl4 = $request->compl4;
        $data->pres4 = $request->pres4;
        $data->med5 = $request->med5;
        $data->freq5 = $request->freq5;
        $data->effect5 = $request->effect5;
        $data->compl5 = $request->compl5;

        $data->save();

        $check_exists = bio_twentyfour5_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = bio_twentyfour5_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new bio_twentyfour5_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->pres5 = $request->pres5;
        $data->dailyliving = $request->dailyliving;
        $data->alltask = $request->alltask;
        $data->technology = $request->technology;
        $data->assisrequire = $request->assisrequire;
        $data->relationana = $request->relationana;
        $data->anxtxt = $request->anxtxt;
        $data->anxtime = $request->anxtime;
        $data->pantxt = $request->pantxt;
        $data->pantime = $request->pantime;
        $data->photxt = $request->photxt;
        $data->photime = $request->photime;
        $data->obesstxt = $request->obesstxt;
        $data->obesstime = $request->obesstime;
        $data->somatxt = $request->somatxt;
        $data->somatime = $request->somatime;
        $data->deprtxt = $request->deprtxt;
        $data->deprtime = $request->deprtime;
        $data->impatxt = $request->impatxt;
        $data->impatime = $request->impatime;
        $data->poortxt = $request->poortxt;
        $data->poortime = $request->poortime;
        $data->inttxt = $request->inttxt;
        $data->inttime = $request->inttime;
        $data->dystxt = $request->dystxt;
        $data->dystime = $request->dystime;
        $data->weighttxt = $request->weighttxt;
        $data->weighttime = $request->weighttime;
        $data->bizarrtxt = $request->bizarrtxt;
        $data->bizarrtime = $request->bizarrtime;
        $data->bbtxt = $request->bbtxt;
        $data->bbtime = $request->bbtime;
        $data->pitxt = $request->pitxt;
        $data->pitime = $request->pitime;
        $data->pjtxt = $request->pjtxt;
        $data->pjtime = $request->pjtime;
        $data->pistxt = $request->pistxt;
        $data->pistime = $request->pistime;
        $data->cptxt = $request->cptxt;
        $data->cptime = $request->cptime;
        $data->sptxt = $request->sptxt;

        $data->save();


        $check_exists = bio_twentyfour6_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = bio_twentyfour6_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new bio_twentyfour6_form();
        }
        $data = $this->session_signatures($data, $request, $request->sessionid);





        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->sptime = $request->sptime;
        $data->fptxt = $request->fptxt;
        $data->fptime = $request->fptime;
        $data->indetxt = $request->indetxt;
        $data->indetime = $request->indetime;
        $data->othr = $request->othr;
        $data->othtxt = $request->othtxt;
        $data->othtime = $request->othtime;
        $data->idensymp = $request->idensymp;
        $data->summarycons = $request->summarycons;
        $data->cghfuture = $request->cghfuture;
        $data->likeyour = $request->likeyour;
        $data->likeimprove = $request->likeimprove;
        $data->proudlife = $request->proudlife;
        $data->expectpart = $request->expectpart;
        $data->strength = $request->strength;
        $data->needs = $request->needs;
        $data->abilities = $request->abilities;
        $data->prefer = $request->prefer;
        $data->problemlist = $request->problemlist;
        $data->diagrational = $request->diagrational;
        $data->intersumm = $request->intersumm;
        $data->rscomm = $request->rscomm;
        $data->rsmed = $request->rsmed;
        $data->rsind = $request->rsind;
        $data->rsfam = $request->rsfam;
        $data->rstesting = $request->rstesting;
        $data->rscare = $request->rscare;
        $data->rsbtl = $request->rsbtl;
        $data->rscoll = $request->rscoll;
        $data->rsreha = $request->rsreha;
        $data->rsasoc = $request->rsasoc;
        $data->rsltt = $request->rsltt;
        $data->rsgrou = $request->rsgrou;
        $data->rsother = $request->rsother;
        $data->referrall = $request->referrall;
        $data->whichhospital = $request->whichhospital;
        $data->dsmv = $request->dsmv;
        $data->rectreat = $request->rectreat;
        $data->projectdate = $request->projectdate;
        $data->clarea = $request->clarea;
        $data->dischplan = $request->dischplan;

        $data->save();
        $this->form_avail_save($request->sessionid, 24);
        return 'done';
    }


    public function form_25_submit(Request $request)
    {

        $check_exists = birp_twentyfive_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = birp_twentyfive_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new birp_twentyfive_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);

        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->consumer = $request->consumer;
        $data->pother = $request->pother;
        $data->pparent = $request->pparent;
        $data->parent = $request->parent;
        $data->pgaurdian = $request->pgaurdian;
        $data->affect = $request->affect;
        $data->proselect = $request->proselect;
        $data->newselect = $request->newselect;
        $data->contacttype = $request->contacttype;
        $data->stressor = $request->stressor;
        $data->stressexp = $request->stressexp;
        $data->stresscomm = $request->stresscomm;
        $data->imi = $request->imi;
        $data->goalselect = $request->goalselect;
        $data->objselect = $request->objselect;
        $data->intselect = $request->intselect;
        $data->nonbill = $request->nonbill;
        $data->enc1 = $request->enc1;
        $data->formul1 = $request->formul1;
        $data->ass1 = $request->ass1;
        $data->reminded1 = $request->reminded1;
        $data->urged1 = $request->urged1;
        $data->refer1 = $request->refer1;
        $data->engage1 = $request->engage1;
        $data->confirm1 = $request->confirm1;
        $data->resp1 = $request->resp1;
        $data->direct1 = $request->direct1;
        $data->arr1 = $request->arr1;
        $data->assur1 = $request->assur1;
        $data->resch1 = $request->resch1;

        $data->save();


        $check_exists = birp_twentyfive2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = birp_twentyfive2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new birp_twentyfive2_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);



        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->enc2 = $request->enc2;
        $data->fomul2 = $request->fomul2;
        $data->ass2 = $request->ass2;
        $data->reminded2 = $request->reminded2;
        $data->urged2 = $request->urged2;
        $data->refer2 = $request->refer2;
        $data->engage2 = $request->engage2;
        $data->confirm2 = $request->confirm2;
        $data->resp2 = $request->resp2;
        $data->direct2 = $request->direct2;
        $data->arr2 = $request->arr2;
        $data->assur2 = $request->assur2;
        $data->resch2 = $request->resch2;
        $data->enc3 = $request->enc3;
        $data->ass3 = $request->ass3;
        $data->reminded3 = $request->reminded3;
        $data->urged3 = $request->urged3;
        $data->refer3 = $request->refer3;
        $data->engage3 = $request->engage3;
        $data->formul3 = $request->formul3;
        $data->confirm3 = $request->confirm3;
        $data->resp3 = $request->resp3;
        $data->direct3 = $request->direct3;
        $data->arr3 = $request->arr3;
        $data->assur3 = $request->assur3;
        $data->resch3 = $request->resch3;
        $data->enc4 = $request->enc4;
        $data->formul4 = $request->formul4;
        $data->ass4 = $request->ass4;
        $data->reminded4 = $request->reminded4;
        $data->urged4 = $request->urged4;
        $data->refer4 = $request->refer4;
        $data->engage4 = $request->engage4;
        $data->confirm4 = $request->confirm4;
        $data->resp4 = $request->resp4;
        $data->direct4 = $request->direct4;
        $data->arr4 = $request->arr4;
        $data->assu4 = $request->assu4;
        $data->resch4 = $request->resch4;
        $data->strength = $request->strength;
        $data->transitional = $request->transitional;
        $data->additional = $request->additional;
        $data->statusselect = $request->statusselect;
        $data->nextapp = $request->nextapp;

        $data->save();
        $this->form_avail_save($request->sessionid, 25);
        return 'done';
    }

    public function form_26_submit(Request $request)
    {


        $check_exists = dis_twentysix_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = dis_twentysix_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new dis_twentysix_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);



        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->sdate = $request->sdate;
        $data->disdate = $request->disdate;
        $data->livsit = $request->livsit;
        $data->strength = $request->strength;
        $data->needs = $request->needs;
        $data->abilities = $request->abilities;
        $data->pref = $request->pref;
        $data->incare = $request->incare;
        $data->sigfind = $request->sigfind;
        $data->summgoal = $request->summgoal;
        $data->summnot = $request->summnot;
        $data->currss = $request->currss;
        $data->overrec = $request->overrec;
        $data->outsideorg = $request->outsideorg;
        $data->planser = $request->planser;
        $data->medneed = $request->medneed;
        $data->discont = $request->discont;
        $data->summdis = $request->summdis;

        $data->save();
        $this->form_avail_save($request->sessionid, 26);
        return 'done';
    }

    public function form_27_submit(Request $request)
    {


        $check_exists = lpro_twentyseven_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = lpro_twentyseven_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new lpro_twentyseven_form();
        }


        if ($request->hasFile('updload_sign')) {
            $image = $request->file('updload_sign');
            $imageName = $this->admin_id . time() . uniqid() . '.' . "png";
            $directory = 'assets/dashboard/singnature/';
            $imgUrl1 = $directory . $imageName;
            Image::make($image)->save($imgUrl1);
            $data->signature = $imgUrl1;
        } else {
            if ($request->sing_draw && $request->sing_draw != null) {
                $name = $this->admin_id . time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw, 0, strpos($request->sing_draw, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw)->save($imgUrl2);
                $data->signature = $path3;
            }
        }

        if ($request->hasFile('updload_sign2')) {
            $image = $request->file('updload_sign2');
            $imageName = $this->admin_id . time() . uniqid() . '.' . "png";
            $directory = 'assets/dashboard/singnature/';
            $imgUrl1 = $directory . $imageName;
            Image::make($image)->save($imgUrl1);
            $data->updload_sign = $imgUrl1;
        } else {
            if ($request->sing_draw2 && $request->sing_draw2 != null) {
                $name = $this->admin_id . time() . uniqid() . '.' . explode('/', explode(':', substr($request->sing_draw2, 0, strpos($request->sing_draw2, ';')))[1])[1];
                $directory = 'assets/dashboard/singnature/';
                $imgUrl2 = $directory . $name;
                $path3 = 'assets/dashboard/singnature/' . $name;
                Image::make($request->sing_draw2)->save($imgUrl2);
                $data->updload_sign = $path3;
            }
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->clname = $request->clname;
        $data->dob = $request->dob;
        $data->address = $request->address;
        $data->sdate = $request->sdate;
        $data->cpt = $request->cpt;
        $data->ca = $request->ca;
        $data->icd = $request->icd;
        $data->backinfo = $request->backinfo;
        $data->ltgoal = $request->ltgoal;
        $data->stgoal = $request->stgoal;
        $data->intstra = $request->intstra;
        $data->resth = $request->resth;
        $data->testsem = $request->testsem;
        $data->recom = $request->recom;
        $data->mednec = $request->mednec;
        $data->recomm = $request->recomm;
        $data->ltgoal2 = $request->ltgoal2;
        $data->stgoal2 = $request->stgoal2;
        $data->save();
        $this->form_avail_save($request->sessionid, 27);
        return 'done';
    }

    public function form_28_submit(Request $request)
    {


        $check_exists = ls_twentyeight_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ls_twentyeight_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ls_twentyeight_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);



        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->clname = $request->clname;
        $data->dob = $request->dob;
        $data->icd = $request->icd;
        $data->dos1 = $request->dos1;
        $data->cpt1 = $request->cpt1;
        $data->stg1 = $request->stg1;
        $data->apc1 = $request->apc1;
        $data->dos2 = $request->dos2;
        $data->cpt2 = $request->cpt2;
        $data->stg2 = $request->stg2;
        $data->apc2 = $request->apc2;
        $data->name1 = $request->name1;
        $data->name2 = $request->name2;
        $data->save();
        $this->form_avail_save($request->sessionid, 28);
        return 'done';
    }

    public function form_29_submit(Request $request)
    {

        $check_exists = dia_twentynine_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = dia_twentynine_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new dia_twentynine_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->clname = $request->clname;
        $data->dob = $request->dob;
        $data->date = $request->date;
        $data->icd = $request->icd;
        $data->reason = $request->reason;
        $data->testadmin = $request->testadmin;
        $data->scores = $request->scores;
        $data->implication = $request->implication;
        $data->recom = $request->recom;
        $data->name1 = $request->name1;
        $data->name2 = $request->name2;
        $data->save();
        $this->form_avail_save($request->sessionid, 29);
        return 'done';
    }


    public function form_30_submit(Request $request)
    {

        $check_exists = ds_thirty1_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty1_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty1_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);

        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->clname = $request->clname;
        $data->stname = $request->stname;
        $data->sdate = $request->sdate;
        $data->sttime = $request->sttime;
        $data->etime = $request->etime;
        $data->select1 = $request->select1;
        $data->select2 = $request->select2;
        $data->hour1 = $request->hour1;
        $data->hr1_1 = $request->hr1_1;
        $data->hr2_1 = $request->hr2_1;
        $data->hr3_1 = $request->hr3_1;
        $data->total_1 = $request->total_1;
        $data->hour2 = $request->hour2;
        $data->hr1_2 = $request->hr1_2;
        $data->hr2_2 = $request->hr2_2;
        $data->hr3_2 = $request->hr3_2;
        $data->total_2 = $request->total_2;
        $data->hour3 = $request->hour3;
        $data->hr1_3 = $request->hr1_3;
        $data->hr2_3 = $request->hr2_3;
        $data->hr3_3 = $request->hr3_3;
        $data->total_3 = $request->total_3;
        $data->pro1 = $request->pro1;
        $data->tar1 = $request->tar1;
        $data->b1_1 = $request->b1_1;
        $data->b1_2 = $request->b1_2;
        $data->b1_3 = $request->b1_3;
        $data->b1_4 = $request->b1_4;
        $data->b1_5 = $request->b1_5;
        $data->b1_6 = $request->b1_6;
        $data->b1_7 = $request->b1_7;
        $data->b1_8 = $request->b1_8;
        $data->b1_9 = $request->b1_9;
        $data->b1_10 = $request->b1_10;
        $data->b1_11 = $request->b1_11;
        $data->b1_12 = $request->b1_12;
        $data->b1_13 = $request->b1_13;
        $data->b1_14 = $request->b1_14;
        $data->b1_15 = $request->b1_15;
        $data->b1_t = $request->b1_t;
        $data->b1_ot = $request->b1_ot;
        $data->b1_s = $request->b1_s;

        $data->save();


        $check_exists = ds_thirty2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty2_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty2_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->pro2 = $request->pro2;
        $data->tar2 = $request->tar2;
        $data->b2_1 = $request->b2_1;
        $data->b2_2 = $request->b2_2;
        $data->b2_3 = $request->b2_3;
        $data->b2_4 = $request->b2_4;
        $data->b2_5 = $request->b2_5;
        $data->b2_6 = $request->b2_6;
        $data->b2_7 = $request->b2_7;
        $data->b2_8 = $request->b2_8;
        $data->b2_9 = $request->b2_9;
        $data->b2_10 = $request->b2_10;
        $data->b2_11 = $request->b2_11;
        $data->b2_12 = $request->b2_12;
        $data->b2_13 = $request->b2_13;
        $data->b2_14 = $request->b2_14;
        $data->b2_15 = $request->b2_15;
        $data->b2_t = $request->b2_t;
        $data->b2_ot = $request->b2_ot;
        $data->b2_s = $request->b2_s;
        $data->pro3 = $request->pro3;
        $data->tar3 = $request->tar3;
        $data->b3_1 = $request->b3_1;
        $data->b3_2 = $request->b3_2;
        $data->b3_3 = $request->b3_3;
        $data->b3_4 = $request->b3_4;
        $data->b3_5 = $request->b3_5;
        $data->b3_6 = $request->b3_6;
        $data->b3_7 = $request->b3_7;
        $data->b3_8 = $request->b3_8;
        $data->b3_9 = $request->b3_9;
        $data->b3_10 = $request->b3_10;
        $data->b3_11 = $request->b3_11;
        $data->b3_12 = $request->b3_12;
        $data->b3_13 = $request->b3_13;
        $data->b3_14 = $request->b3_14;
        $data->b3_15 = $request->b3_15;
        $data->b3_t = $request->b3_t;
        $data->b3_ot = $request->b3_ot;
        $data->b3_s = $request->b3_s;
        $data->save();

        $check_exists = ds_thirty3_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty3_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty3_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->pro4 = $request->pro4;
        $data->tar4 = $request->tar4;
        $data->b4_1 = $request->b4_1;
        $data->b4_2 = $request->b4_2;
        $data->b4_3 = $request->b4_3;
        $data->b4_4 = $request->b4_4;
        $data->b4_5 = $request->b4_5;
        $data->b4_6 = $request->b4_6;
        $data->b4_7 = $request->b4_7;
        $data->b4_8 = $request->b4_8;
        $data->b4_9 = $request->b4_9;
        $data->b4_10 = $request->b4_10;
        $data->b4_11 = $request->b4_11;
        $data->b4_12 = $request->b4_12;
        $data->b4_13 = $request->b4_13;
        $data->b4_14 = $request->b4_14;
        $data->b4_15 = $request->b4_15;
        $data->b4_t = $request->b4_t;
        $data->b4_ot = $request->b4_ot;
        $data->b4_s = $request->b4_s;
        $data->pro5 = $request->pro5;
        $data->tar5 = $request->tar5;
        $data->b5_1 = $request->b5_1;
        $data->b5_2 = $request->b5_2;
        $data->b5_3 = $request->b5_3;
        $data->b5_4 = $request->b5_4;
        $data->b5_5 = $request->b5_5;
        $data->b5_6 = $request->b5_6;
        $data->b5_7 = $request->b5_7;
        $data->b5_8 = $request->b5_8;
        $data->b5_9 = $request->b5_9;
        $data->b5_10 = $request->b5_10;
        $data->b5_11 = $request->b5_11;
        $data->b5_12 = $request->b5_12;
        $data->b5_13 = $request->b5_13;
        $data->b5_14 = $request->b5_14;
        $data->b5_15 = $request->b5_15;
        $data->b5_t = $request->b5_t;
        $data->b5_ot = $request->b5_ot;
        $data->b5_s = $request->b5_s;

        $data->save();

        $check_exists = ds_thirty4_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty4_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty4_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->pro6 = $request->pro6;
        $data->tar6 = $request->tar6;
        $data->b6_1 = $request->b6_1;
        $data->b6_2 = $request->b6_2;
        $data->b6_3 = $request->b6_3;
        $data->b6_4 = $request->b6_4;
        $data->b6_5 = $request->b6_5;
        $data->b6_6 = $request->b6_6;
        $data->b6_7 = $request->b6_7;
        $data->b6_8 = $request->b6_8;
        $data->b6_9 = $request->b6_9;
        $data->b6_10 = $request->b6_10;
        $data->b6_11 = $request->b6_11;
        $data->b6_12 = $request->b6_12;
        $data->b6_13 = $request->b6_13;
        $data->b6_14 = $request->b6_14;
        $data->b6_15 = $request->b6_15;
        $data->b6_t = $request->b6_t;
        $data->b6_ot = $request->b6_ot;
        $data->b6_s = $request->b6_s;
        $data->pro7 = $request->pro7;
        $data->tar7 = $request->tar7;
        $data->b7_1 = $request->b7_1;
        $data->b7_2 = $request->b7_2;
        $data->b7_3 = $request->b7_3;
        $data->b7_4 = $request->b7_4;
        $data->b7_5 = $request->b7_5;
        $data->b7_6 = $request->b7_6;
        $data->b7_7 = $request->b7_7;
        $data->b7_8 = $request->b7_8;
        $data->b7_9 = $request->b7_9;
        $data->b7_10 = $request->b7_10;
        $data->b7_11 = $request->b7_11;
        $data->b7_12 = $request->b7_12;
        $data->b7_13 = $request->b7_13;
        $data->b7_14 = $request->b7_14;
        $data->b7_15 = $request->b7_15;
        $data->b7_t = $request->b7_t;
        $data->b7_ot = $request->b7_ot;
        $data->b7_s = $request->b7_s;

        $data->save();

        $check_exists = ds_thirty5_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty5_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty5_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->pro8 = $request->pro8;
        $data->tar8 = $request->tar8;
        $data->b8_1 = $request->b8_1;
        $data->b8_2 = $request->b8_2;
        $data->b8_3 = $request->b8_3;
        $data->b8_4 = $request->b8_4;
        $data->b8_5 = $request->b8_5;
        $data->b8_6 = $request->b8_6;
        $data->b8_7 = $request->b8_7;
        $data->b8_8 = $request->b8_8;
        $data->b8_9 = $request->b8_9;
        $data->b8_10 = $request->b8_10;
        $data->b8_11 = $request->b8_11;
        $data->b8_12 = $request->b8_12;
        $data->b8_13 = $request->b8_13;
        $data->b8_14 = $request->b8_14;
        $data->b8_15 = $request->b8_15;
        $data->b8_t = $request->b8_t;
        $data->b8_ot = $request->b8_ot;
        $data->b8_s = $request->b8_s;
        $data->pro9 = $request->pro9;
        $data->tar9 = $request->tar9;
        $data->b9_1 = $request->b9_1;
        $data->b9_2 = $request->b9_2;
        $data->b9_3 = $request->b9_3;
        $data->b9_4 = $request->b9_4;
        $data->b9_5 = $request->b9_5;
        $data->b9_6 = $request->b9_6;
        $data->b9_7 = $request->b9_7;
        $data->b9_8 = $request->b9_8;
        $data->b9_9 = $request->b9_9;
        $data->b9_10 = $request->b9_10;
        $data->b9_11 = $request->b9_11;
        $data->b9_12 = $request->b9_12;
        $data->b9_13 = $request->b9_13;
        $data->b9_14 = $request->b9_14;
        $data->b9_15 = $request->b9_15;
        $data->b9_t = $request->b9_t;
        $data->b9_ot = $request->b9_ot;
        $data->b9_s = $request->b9_s;

        $data->save();

        $check_exists = ds_thirty6_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty6_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty6_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->session_note = $request->session_note;
        $data->pro10 = $request->pro10;
        $data->tar10 = $request->tar10;
        $data->b10_1 = $request->b10_1;
        $data->b10_2 = $request->b10_2;
        $data->b10_3 = $request->b10_3;
        $data->b10_4 = $request->b10_4;
        $data->b10_5 = $request->b10_5;
        $data->b10_6 = $request->b10_6;
        $data->b10_7 = $request->b10_7;
        $data->b10_8 = $request->b10_8;
        $data->b10_9 = $request->b10_9;
        $data->b10_10 = $request->b10_10;
        $data->b10_11 = $request->b10_11;
        $data->b10_12 = $request->b10_12;
        $data->b10_13 = $request->b10_13;
        $data->b10_14 = $request->b10_14;
        $data->b10_15 = $request->b10_15;
        $data->b10_t = $request->b10_t;
        $data->b10_ot = $request->b10_ot;
        $data->b10_s = $request->b10_s;
        $data->pro11 = $request->pro11;
        $data->tar11 = $request->tar11;
        $data->b11_1 = $request->b11_1;
        $data->b11_2 = $request->b11_2;
        $data->b11_3 = $request->b11_3;
        $data->b11_4 = $request->b11_4;
        $data->b11_5 = $request->b11_5;
        $data->b11_6 = $request->b11_6;
        $data->b11_7 = $request->b11_7;
        $data->b11_8 = $request->b11_8;
        $data->b11_9 = $request->b11_9;
        $data->b11_10 = $request->b11_10;
        $data->b11_11 = $request->b11_11;
        $data->b11_12 = $request->b11_12;
        $data->b11_13 = $request->b11_13;
        $data->b11_14 = $request->b11_14;
        $data->b11_15 = $request->b11_15;
        $data->b11_t = $request->b11_t;
        $data->b11_ot = $request->b11_ot;
        $data->b11_s = $request->b11_s;

        $data->save();

        $check_exists = ds_thirty7_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty7_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty7_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->pro12 = $request->pro12;
        $data->tar12 = $request->tar12;
        $data->b12_1 = $request->b12_1;
        $data->b12_2 = $request->b12_2;
        $data->b12_3 = $request->b12_3;
        $data->b12_4 = $request->b12_4;
        $data->b12_5 = $request->b12_5;
        $data->b12_6 = $request->b12_6;
        $data->b12_7 = $request->b12_7;
        $data->b12_8 = $request->b12_8;
        $data->b12_9 = $request->b12_9;
        $data->b12_10 = $request->b12_10;
        $data->b12_11 = $request->b12_11;
        $data->b12_12 = $request->b12_12;
        $data->b12_13 = $request->b12_13;
        $data->b12_14 = $request->b12_14;
        $data->b12_15 = $request->b12_15;
        $data->b12_t = $request->b12_t;
        $data->b12_ot = $request->b12_ot;
        $data->b12_s = $request->b12_s;
        $data->pro13 = $request->pro13;
        $data->tar13 = $request->tar13;
        $data->b13_1 = $request->b13_1;
        $data->b13_2 = $request->b13_2;
        $data->b13_3 = $request->b13_3;
        $data->b13_4 = $request->b13_4;
        $data->b13_5 = $request->b13_5;
        $data->b13_6 = $request->b13_6;
        $data->b13_7 = $request->b13_7;
        $data->b13_8 = $request->b13_8;
        $data->b13_9 = $request->b13_9;
        $data->b13_10 = $request->b13_10;
        $data->b13_11 = $request->b13_11;
        $data->b13_12 = $request->b13_12;
        $data->b13_13 = $request->b13_13;
        $data->b13_14 = $request->b13_14;
        $data->b13_15 = $request->b13_15;
        $data->b13_t = $request->b13_t;
        $data->b13_ot = $request->b13_ot;
        $data->b13_s = $request->b13_s;

        $data->save();

        $check_exists = ds_thirty8_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty8_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty8_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->pro14 = $request->pro14;
        $data->tar14 = $request->tar14;
        $data->b14_1 = $request->b14_1;
        $data->b14_2 = $request->b14_2;
        $data->b14_3 = $request->b14_3;
        $data->b14_4 = $request->b14_4;
        $data->b14_5 = $request->b14_5;
        $data->b14_6 = $request->b14_6;
        $data->b14_7 = $request->b14_7;
        $data->b14_8 = $request->b14_8;
        $data->b14_9 = $request->b14_9;
        $data->b14_10 = $request->b14_10;
        $data->b14_11 = $request->b14_11;
        $data->b14_12 = $request->b14_12;
        $data->b14_13 = $request->b14_13;
        $data->b14_14 = $request->b14_14;
        $data->b14_15 = $request->b14_15;
        $data->b14_t = $request->b14_t;
        $data->b14_ot = $request->b14_ot;
        $data->b14_s = $request->b14_s;
        $data->pro15 = $request->pro15;
        $data->tar15 = $request->tar15;
        $data->b15_1 = $request->b15_1;
        $data->b15_2 = $request->b15_2;
        $data->b15_3 = $request->b15_3;
        $data->b15_4 = $request->b15_4;
        $data->b15_5 = $request->b15_5;
        $data->b15_6 = $request->b15_6;
        $data->b15_7 = $request->b15_7;
        $data->b15_8 = $request->b15_8;
        $data->b15_9 = $request->b15_9;
        $data->b15_10 = $request->b15_10;
        $data->b15_11 = $request->b15_11;
        $data->b15_12 = $request->b15_12;
        $data->b15_13 = $request->b15_13;
        $data->b15_14 = $request->b15_14;
        $data->b15_15 = $request->b15_15;
        $data->b15_t = $request->b15_t;
        $data->b15_ot = $request->b15_ot;
        $data->b15_s = $request->b15_s;

        $data->save();

        $check_exists = ds_thirty9_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty9_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty9_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->pro16 = $request->pro16;
        $data->tar16 = $request->tar16;
        $data->b16_1 = $request->b16_1;
        $data->b16_2 = $request->b16_2;
        $data->b16_3 = $request->b16_3;
        $data->b16_4 = $request->b16_4;
        $data->b16_5 = $request->b16_5;
        $data->b16_6 = $request->b16_6;
        $data->b16_7 = $request->b16_7;
        $data->b16_8 = $request->b16_8;
        $data->b16_9 = $request->b16_9;
        $data->b16_10 = $request->b16_10;
        $data->b16_11 = $request->b16_11;
        $data->b16_12 = $request->b16_12;
        $data->b16_13 = $request->b16_13;
        $data->b16_14 = $request->b16_14;
        $data->b16_15 = $request->b16_15;
        $data->b16_t = $request->b16_t;
        $data->b16_ot = $request->b16_ot;
        $data->b16_s = $request->b16_s;
        $data->pro17 = $request->pro17;
        $data->tar17 = $request->tar17;
        $data->b17_1 = $request->b17_1;
        $data->b17_2 = $request->b17_2;
        $data->b17_3 = $request->b17_3;
        $data->b17_4 = $request->b17_4;
        $data->b17_5 = $request->b17_5;
        $data->b17_6 = $request->b17_6;
        $data->b17_7 = $request->b17_7;
        $data->b17_8 = $request->b17_8;
        $data->b17_9 = $request->b17_9;
        $data->b17_10 = $request->b17_10;
        $data->b17_11 = $request->b17_11;
        $data->b17_12 = $request->b17_12;
        $data->b17_13 = $request->b17_13;
        $data->b17_14 = $request->b17_14;
        $data->b17_15 = $request->b17_15;
        $data->b17_t = $request->b17_t;
        $data->b17_ot = $request->b17_ot;
        $data->b17_s = $request->b17_s;

        $data->save();

        $check_exists = ds_thirty10_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty10_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty10_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->pro18 = $request->pro18;
        $data->tar18 = $request->tar18;
        $data->b18_1 = $request->b18_1;
        $data->b18_2 = $request->b18_2;
        $data->b18_3 = $request->b18_3;
        $data->b18_4 = $request->b18_4;
        $data->b18_5 = $request->b18_5;
        $data->b18_6 = $request->b18_6;
        $data->b18_7 = $request->b18_7;
        $data->b18_8 = $request->b18_8;
        $data->b18_9 = $request->b18_9;
        $data->b18_10 = $request->b18_10;
        $data->b18_11 = $request->b18_11;
        $data->b18_12 = $request->b18_12;
        $data->b18_13 = $request->b18_13;
        $data->b18_14 = $request->b18_14;
        $data->b18_15 = $request->b18_15;
        $data->b18_t = $request->b18_t;
        $data->b18_ot = $request->b18_ot;
        $data->b18_s = $request->b18_s;
        $data->task1 = $request->task1;
        $data->task2 = $request->task2;
        $data->task3 = $request->task3;
        $data->task1_1 = $request->task1_1;
        $data->task1_2 = $request->task1_2;
        $data->task1_3 = $request->task1_3;
        $data->task1_4 = $request->task1_4;
        $data->task1_5 = $request->task1_5;
        $data->task1_6 = $request->task1_6;
        $data->task1_7 = $request->task1_7;
        $data->task1_8 = $request->task1_8;
        $data->task1_9 = $request->task1_9;
        $data->task1_10 = $request->task1_10;
        $data->v1_1 = $request->v1_1;
        $data->v1_2 = $request->v1_2;
        $data->v1_3 = $request->v1_3;
        $data->v1_4 = $request->v1_4;
        $data->v1_5 = $request->v1_5;
        $data->v1_6 = $request->v1_6;
        $data->v1_7 = $request->v1_7;
        $data->v1_8 = $request->v1_8;
        $data->v1_9 = $request->v1_9;
        $data->v1_10 = $request->v1_10;

        $data->save();

        $check_exists = ds_thirty11_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty11_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty11_form();
        }


        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->task2_1 = $request->task2_1;
        $data->task2_2 = $request->task2_2;
        $data->task2_3 = $request->task2_3;
        $data->task2_4 = $request->task2_4;
        $data->task2_5 = $request->task2_5;
        $data->task2_6 = $request->task2_6;
        $data->task2_7 = $request->task2_7;
        $data->task2_8 = $request->task2_8;
        $data->task2_9 = $request->task2_9;
        $data->task2_10 = $request->task2_10;
        $data->v2_1 = $request->v2_1;
        $data->v2_2 = $request->v2_2;
        $data->v2_3 = $request->v2_3;
        $data->v2_4 = $request->v2_4;
        $data->v2_5 = $request->v2_5;
        $data->v2_6 = $request->v2_6;
        $data->v2_7 = $request->v2_7;
        $data->v2_8 = $request->v2_8;
        $data->v2_9 = $request->v2_9;
        $data->v2_10 = $request->v2_10;
        $data->task3_1 = $request->task3_1;
        $data->task3_2 = $request->task3_2;
        $data->task3_3 = $request->task3_3;
        $data->task3_4 = $request->task3_4;
        $data->task3_5 = $request->task3_5;
        $data->task3_6 = $request->task3_6;
        $data->task3_7 = $request->task3_7;
        $data->task3_8 = $request->task3_8;
        $data->task3_9 = $request->task3_9;
        $data->task3_10 = $request->task3_10;
        $data->v3_1 = $request->v3_1;
        $data->v3_2 = $request->v3_2;
        $data->v3_3 = $request->v3_3;
        $data->v3_4 = $request->v3_4;
        $data->v3_5 = $request->v3_5;
        $data->v3_6 = $request->v3_6;
        $data->v3_7 = $request->v3_7;
        $data->v3_8 = $request->v3_8;
        $data->v3_9 = $request->v3_9;
        $data->v3_10 = $request->v3_10;

        $data->save();


        $check_exists = ds_thirty12_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = ds_thirty12_form::where('sessionid', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        } else {
            $data = new ds_thirty12_form();
        }

        $data = $this->session_signatures($data, $request, $request->sessionid);



        $data->admin_id = $this->admin_id;
        $data->sessionid = $request->sessionid;
        $data->task1_t = $request->task1_t;
        $data->task2_t = $request->task2_t;
        $data->task3_t = $request->task3_t;
        $data->ant1 = $request->ant1;
        $data->beh1 = $request->beh1;
        $data->con1 = $request->con1;
        $data->fun1 = $request->fun1;
        $data->fre1 = $request->fre1;
        $data->ant2 = $request->ant2;
        $data->beh2 = $request->beh2;
        $data->con2 = $request->con2;
        $data->fun2 = $request->fun2;
        $data->fre2 = $request->fre2;
        $data->ant3 = $request->ant3;
        $data->beh3 = $request->beh3;
        $data->con3 = $request->con3;
        $data->fun3 = $request->fun3;
        $data->fre3 = $request->fre3;
        $data->save();
        $this->form_avail_save($request->sessionid, 30);
        return 'done';
    }

    public function form_60_submit(Request $request)
    {

        $check_exists = \App\Models\saa_sixty_form::where('session_id', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = $check_exists;
        } else {
            $data = new \App\Models\saa_sixty_form();
        }

        $data->admin_id = $this->admin_id;
        $data->session_id = $request->sessionid;
        $data->data_obj = $request->data_obj;

        $data = $this->session_signatures($data, $request, $request->sessionid);



        $data->save();

        $this->form_avail_save($request->sessionid, 60);
        return 'done';
    }

    public function form_61_submit(Request $request)
    {

        $check_exists = \App\Models\sn_sixtyone_form::where('session_id', $request->sessionid)->where('admin_id', $this->admin_id)->first();
        if ($check_exists) {
            $data = $check_exists;
        } else {
            $data = new \App\Models\sn_sixtyone_form();
        }

        $data->admin_id = $this->admin_id;
        $data->session_id = $request->sessionid;
        $data->data_obj = $request->data_obj;

        $data = $this->session_signatures($data, $request, $request->sessionid);


        $this->form_avail_save($request->sessionid, 61);
        $data->save();

        return 'done';
    }

    public function meet_session_create(Request $request)
    {
        $url = Str::random(20) . rand(0000, 8888) . Auth::user()->id . time() . uniqid();
        $new_meet = new meet_link();
        $new_meet->admin_id = Auth::user()->admin_id;
        $new_meet->session_id = $request->ses_id;
        $new_meet->room_name = Auth::user()->full_name . "'s Room";
        $new_meet->meet_full_url = "https://meet.therapypms.com/?room=" . $url;
        $new_meet->meet_url = $url;
        $new_meet->is_end = 0;
        $new_meet->video_url = null;
        $new_meet->save();

        $ses = Appoinment::select('id', 'client_id')->where('id', $request->ses_id)->first();
        $client = Client::select('id', 'email')->where('id', $ses->client_id)->first();
        $fac = setting_name_location::select('id', 'admin_id', 'facility_name')->where('admin_id', Auth::user()->admin_id)->first();


        $to = $client->email;

        $msg = [
            'name' => $client->client_full_name,
            'facility' => $fac->facility_name,
            'url' => $new_meet->meet_full_url
        ];
        Mail::to($to)->send(new MeetMail($msg));


        return response()->json([
            'status' => 'success',
            'url' => "https://meet.therapypms.com/?room=" . $new_meet->meet_url
        ], 200);
    }
}
