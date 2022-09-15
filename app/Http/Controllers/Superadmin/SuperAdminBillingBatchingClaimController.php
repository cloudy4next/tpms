<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\All_payor_detail;
use App\Models\Appoinment;
use App\Models\Batching_claim;
use App\Models\Client;
use App\Models\Client_authorization_activity;
use App\Models\Employee;
use App\Models\manage_claim;
use App\Models\manage_claim_transaction;
use App\Models\Processing_claim;
use App\Models\setting_name_location;
use App\Models\report_notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Rap2hpoutre\FastExcel\FastExcel;


class SuperAdminBillingBatchingClaimController extends Controller
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

    public function batching_claim()
    {
        $name_location = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        return view('superadmin.batchingclaim.batchingClaim', compact('name_location'));
    }

    public function batching_claim_edi_count(Request $request)
    {
        $data_count = Batching_claim::where('has_manage_claim', 0)->count();
        return $data_count;
    }


    public function batching_claim_get_client(Request $request)
    {

        $app = Processing_claim::distinct()->select('client_id', 'admin_id')->where('status', "Ready To Bill")
            ->where('admin_id', $this->admin_id);

        if(isset($request->filter)){
            if($request->filter == 1){
                $client1=$request->client1;
                if(!($client1 == null || $client1 == '')){
                    $app= $app->whereIn('client_id',$client1);
                }
            }
            else if($request->filter == 2){
                $payor1= $request->payor1;
                if(!($payor1 == null || $payor1 == '')){
                    $app = $app->whereIn('payor_id', $payor1);
                }
            }
            else if($request->filter == 3){
                $providerj = $request->providerj;
                if(!($providerj == null || $providerj == '')){
                    $app = $app->whereIn('cms_24j',$providerj);
                }
            }
        }

        $app = $app->get();

        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->client_id);
        }
        $clients = Client::whereIn('id', $array)->where('admin_id', $this->admin_id)->orderBy('client_first_name', 'asc')->get();

        return $clients;
        exit;
    }

    public function batching_claim_get_payor(Request $request)
    {

        $app = Processing_claim::distinct()->select('payor_id', 'admin_id')->where('status', "Ready To Bill")
            ->where('admin_id', $this->admin_id);

        if(isset($request->filter)){
            if($request->filter == 1){
                $client1=$request->client1;
                if(!($client1 == null || $client1 == '')){
                    $app= $app->whereIn('client_id',$client1);
                }
            }
            else if($request->filter == 2){
                $payor1= $request->payor1;
                if(!($payor1 == null || $payor1 == '')){
                    $app = $app->whereIn('payor_id', $payor1);
                }
            }
            else if($request->filter == 3){
                $providerj = $request->providerj;
                if(!($providerj == null || $providerj == '')){
                    $app = $app->whereIn('cms_24j',$providerj);
                }
            }
        }

        $app = $app->get();



        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->payor_id);
        }


        $clients = All_payor_detail::select('id', 'admin_id', 'payor_id', 'payor_name')->whereIn('payor_id', $array)
            ->where('admin_id', $this->admin_id)
            ->orderBy('payor_name', 'asc')->get();
        $name_location = setting_name_location::select('id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        return response()->json([
            'payor' => $clients,
            'name_location' => $name_location,
        ], 200);


        exit;
    }


    public function batching_claim_get_providerj(Request $request)
    {
        $app = Processing_claim::distinct()->select('cms_24j', 'admin_id','status','client_id','payor_id')->where('status', "Ready To Bill")
            ->where('admin_id', $this->admin_id);

        
        if(isset($request->filter)){
            if($request->filter == 1){
                $client1=$request->client1;
                if(!($client1 == null || $client1 == '')){
                    $app= $app->whereIn('client_id',$client1);
                }
            }
            else if($request->filter == 2){
                $payor1= $request->payor1;
                if(!($payor1 == null || $payor1 == '')){
                    $app = $app->whereIn('payor_id', $payor1);
                }
            }
            else if($request->filter == 3){
                $providerj = $request->providerj;
                if(!($providerj == null || $providerj == '')){
                    $app = $app->whereIn('cms_24j',$providerj);
                }
            }
        }

        $app = $app->get();

        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->cms_24j);
        }

        $provider = Employee::select('id', 'full_name')->whereIn('id', $array)->orderBy('full_name','asc')->get();
        return response()->json($provider, 200);
        exit();


    }


    public function batching_claim_get_claim(Request $request)
    {
        $filter_one = $request->filter_one;
        $client1 = $request->client1;
        $payor1 = $request->payor1;
        $providerj = $request->providerj;

        $filter_two = $request->filter_two;
        $client2 = $request->client2;
        $payor2 = $request->payor2;
        $providerj2 = $request->providerj2;

        $date_range_to = Carbon::parse($request->date_range_to)->format('Y-m-d');
        $name_location = setting_name_location::select('id', 'is_combo')->where('admin_id', $this->admin_id)->first();

        $get_process_claim = Processing_claim::where('admin_id', $this->admin_id)
                ->where('is_mark_gen', 0)
                ->where('status', "Ready To Bill")
                ->where('schedule_date', '<=', $date_range_to);

        if($filter_one == 0){
            if($filter_two == 1){
                if(!($client2 == null || $client2 == '')){
                    $get_process_claim = $get_process_claim->whereIn('client_id', $client2);
                }
            }
            else if($filter_two == 2){
                if(!($payor2 == null || $payor2 == '')){
                    $get_process_claim = $get_process_claim->whereIn('payor_id', $payor2);
                }
            }
            else if($filter_two == 3){
                if(!($providerj2 == null || $providerj2 == '')){
                    $get_process_claim=$get_process_claim->whereIn('cms_24j', $providerj2);
                }
            }
        }
        else if ($filter_one == 1) {
            $get_process_claim = $get_process_claim->whereIn('client_id', $client1);
            if($filter_two == 2){
                if(!($payor2 == null || $payor2 == '')){
                    $get_process_claim = $get_process_claim->whereIn('payor_id', $payor2);
                }
            }
            else if($filter_two == 3){
                if(!($providerj2 == null || $providerj2 == '')){
                    $get_process_claim=$get_process_claim->whereIn('cms_24j', $providerj2);
                }
            }
        } elseif ($filter_one == 2) {
            $get_process_claim = $get_process_claim->whereIn('payor_id', $payor1);
            if($filter_two == 1){
                if(!($client2 == null || $client2 == '')){
                    $get_process_claim = $get_process_claim->whereIn('client_id', $client2);
                }
            }
            else if($filter_two == 3){
                if(!($providerj2 == null || $providerj2 == '')){
                    $get_process_claim=$get_process_claim->whereIn('cms_24j', $providerj2);
                }
            }
        } elseif ($filter_one == 3) {

            $get_process_claim=$get_process_claim->whereIn('cms_24j', $providerj);

            if($filter_two == 2){
                if(!($payor2 == null || $payor2 == '')){
                    $get_process_claim = $get_process_claim->whereIn('payor_id', $payor2);
                }
            }
            else if($filter_two == 1){
                if(!($client2 == null || $client2 == '')){
                    $get_process_claim=$get_process_claim->whereIn('client_id', $client2);
                }
            }

        }

        $get_process_claim=$get_process_claim->orderBy('client_id', 'asc')->get();
        $process_ids = [];

        foreach($get_process_claim as $get_pro){
            array_push($process_ids,$get_pro->id);
        }

        if ($name_location->is_combo == 1) {
            $bact_claim = $this->batch_with_combo($get_process_claim, $date_range_to);
        } else {
            $bact_claim = $this->batch_without_combo($get_process_claim, $date_range_to);
        }

        if ($bact_claim["status"] == 'done') {

            $batch_ids=$bact_claim["batch_ids"];
            $app_ids=$bact_claim["app_ids"];
            $admin_id = $this->admin_id;
            $ids = implode("','", $batch_ids);
            $query = "SELECT * FROM batching_claims WHERE status='Ready To Bill' AND is_mark_gen=0 AND admin_id=$admin_id ";
            $query .= "AND id IN('" . $ids . "') ";
            

            /*if ($filter_one == 1) {
                $query .= "AND client_id =$client1 ";
                if($filter_two == 2){
                    if ($name_location->is_combo == 1) {
                        if($payor2!=null){
                        }
                    } else {
                        if($payor2!=0){
                            $query .= "AND payor_id = $payor2 ";
                        }
                    }
                }
                else if($filter_two == 3){
                    if($providerj2!=0){
                        $query .= "AND cms_24j = $providerj2 ";
                    }

                }

            } else if($filter_one == 2){
                if ($name_location->is_combo == 1) {
                    $payor_filter = implode("','", $payor1);
                    $query .= "AND payor_id IN('" . $payor_filter . "') ";
                } else {
                    $query .= "AND payor_id = $payor1 ";
                }

                if($filter_two == 1){
                    $query .= "AND client_id =$client2 ";
                }
                else if($filter_two == 3){
                    if($providerj2!=0){
                        $query .= "AND cms_24j = $providerj2 ";
                    }
                }

            } else if($filter_one == 3){
                $query .= "AND cms_24j = $providerj ";
                if($filter_two == 1){
                    $query .= "AND client_id =$client2 ";
                }
                else if($filter_two == 2){
                    if ($name_location->is_combo == 1) {
                        if($payor2!=null){
                            $payor_filter = implode("','", $payor2);
                            $query .= "AND payor_id IN('" . $payor_filter . "') ";
                        }
                    } else {
                        if($payor2!=0){
                            $query .= "AND payor_id = $payor2 ";
                        }
                    }
                }
            }*/

            $query .= "AND schedule_date <= '$date_range_to' ";
            $query .= "ORDER BY schedule_date ASC ";

            $query_exe = DB::select($query);


            $sessions = $this->arrayPaginator($query_exe, $request);
            return response()->json([
                'notices' => $sessions,
                'process_ids' =>$process_ids,
                'batch_ids' => $batch_ids,
                'app_ids' => $app_ids,
                'view' => View::make('superadmin.batchingclaim.include.batching_claim_table', compact('sessions'))->render(),
                'pagination' => (string)$sessions->links(),
            ]);
        }

    }


    private function batch_with_combo($claims, $date_range_to)
    {
        $batch_ids=[];
        $app_ids=[];
        foreach ($claims as $get_claim) {
            $check_exist_claim = Batching_claim::where('appointment_id', $get_claim->appointment_id)
                ->where('admin_id', $this->admin_id)
                ->where('processing_claim_id', $get_claim->id)
                ->first();

            if (!$check_exist_claim) {
                $act = Client_authorization_activity::where('id', $get_claim->activity_id)->where('admin_id',$this->admin_id)->first();

                $billed_amount = number_format((double)$get_claim->units * (double)$act->rate, 2,'.','');
                

                $new_bat_claim = new Batching_claim();
                $new_bat_claim->admin_id = $this->admin_id;
                $new_bat_claim->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_bat_claim->processing_claim_id = $get_claim->id;
                $new_bat_claim->appointment_id = $get_claim->appointment_id;
                $new_bat_claim->client_id = $get_claim->client_id;
                $new_bat_claim->provider_id = $get_claim->provider_id;
                $new_bat_claim->authorization_id = $get_claim->authorization_id;
                $new_bat_claim->activity_id = $get_claim->activity_id;
                $new_bat_claim->payor_id = $get_claim->payor_id;
                $new_bat_claim->activity_type = $get_claim->activity_type;
                $new_bat_claim->schedule_date = $get_claim->schedule_date;
                $new_bat_claim->from_time = $get_claim->from_time;
                $new_bat_claim->to_time = $get_claim->to_time;
                $new_bat_claim->cpt = $get_claim->cpt;
                $new_bat_claim->m1 = $get_claim->m1;
                $new_bat_claim->m2 = $get_claim->m2;
                $new_bat_claim->m3 = $get_claim->m3;
                $new_bat_claim->m4 = $get_claim->m4;
                $new_bat_claim->pos = $get_claim->pos;
                $new_bat_claim->units = $get_claim->units;
                $new_bat_claim->rate = number_format((double)$get_claim->rate,2,'.','');
                $new_bat_claim->cms_24j = $get_claim->cms_24j;
                $new_bat_claim->id_qualifier = $get_claim->id_qualifier;
                $new_bat_claim->status = $get_claim->status;
                $new_bat_claim->degree_level = $get_claim->degree_level;
                $new_bat_claim->zone = $get_claim->zone;
                $new_bat_claim->location = $get_claim->location;
                $new_bat_claim->units_value_calc = $get_claim->units_value_calc;
                $new_bat_claim->billed_am = $billed_amount;
                $new_bat_claim->is_mark_gen = 0;
                $new_bat_claim->has_manage_claim = 0;
                $new_bat_claim->has_legder = 0;
                $new_bat_claim->save();

                array_push($batch_ids,$new_bat_claim->id);
                array_push($app_ids,$get_claim->appointment_id);

                
            } else {

                $exist_claim = Batching_claim::where('appointment_id', $get_claim->appointment_id)
                    ->where('admin_id', $this->admin_id)
                    ->where('processing_claim_id', $get_claim->id)
                    ->first();
                    
                $billed_amount = number_format((double)$get_claim->units * (double)$get_claim->rate, 2,'.','');
                $exist_claim->appointment_id = $get_claim->appointment_id;
                $exist_claim->client_id = $get_claim->client_id;
                $exist_claim->provider_id = $get_claim->provider_id;
                $exist_claim->authorization_id = $get_claim->authorization_id;
                $exist_claim->activity_id = $get_claim->activity_id;
                $exist_claim->payor_id = $get_claim->payor_id;
                $exist_claim->activity_type = $get_claim->activity_type;
                $exist_claim->schedule_date = $get_claim->schedule_date;
                $exist_claim->from_time = $get_claim->from_time;
                $exist_claim->to_time = $get_claim->to_time;
                $exist_claim->cpt = $get_claim->cpt;
                $exist_claim->m1 = $get_claim->m1;
                $exist_claim->m2 = $get_claim->m2;
                $exist_claim->m3 = $get_claim->m3;
                $exist_claim->m4 = $get_claim->m4;
                $exist_claim->pos = $get_claim->pos;
                $exist_claim->units = $get_claim->units;
                $exist_claim->rate = number_format((double)$get_claim->rate,2,'.','');
                $exist_claim->cms_24j = $get_claim->cms_24j;
                $exist_claim->id_qualifier = $get_claim->id_qualifier;
                $exist_claim->status = $get_claim->status;
                $exist_claim->degree_level = $get_claim->degree_level;
                $exist_claim->zone = $get_claim->zone;
                $exist_claim->location = $get_claim->location;
                $exist_claim->units_value_calc = $get_claim->units_value_calc;
                $exist_claim->billed_am = $billed_amount;
                $exist_claim->save();
                array_push($batch_ids,$exist_claim->id);
                array_push($app_ids,$get_claim->appointment_id);
            }
        }

        return array(
            "status" =>"done",
            "batch_ids" =>$batch_ids,
            "app_ids" =>$app_ids,
        );
    }


    private function batch_without_combo($claims, $date_range_to)
    {
        $batch_ids=[];
        $app_ids=[];
        foreach ($claims as $get_claim) {
            $check_exist_claim = Batching_claim::where('appointment_id', $get_claim->appointment_id)
                ->where('admin_id', $this->admin_id)
                ->where('processing_claim_id', $get_claim->id)
                ->first();


            if (!$check_exist_claim) {
                $billed_amount = number_format((float)$get_claim->units, 2) * number_format((float)$get_claim->rate, 2);

                $new_bat_claim = new Batching_claim();
                $new_bat_claim->admin_id = $this->admin_id;
                $new_bat_claim->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_bat_claim->processing_claim_id = $get_claim->id;
                $new_bat_claim->appointment_id = $get_claim->appointment_id;
                $new_bat_claim->client_id = $get_claim->client_id;
                $new_bat_claim->provider_id = $get_claim->provider_id;
                $new_bat_claim->authorization_id = $get_claim->authorization_id;
                $new_bat_claim->activity_id = $get_claim->activity_id;
                $new_bat_claim->payor_id = $get_claim->payor_id;
                $new_bat_claim->activity_type = $get_claim->activity_type;
                $new_bat_claim->schedule_date = $get_claim->schedule_date;
                $new_bat_claim->from_time = $get_claim->from_time;
                $new_bat_claim->to_time = $get_claim->to_time;
                $new_bat_claim->cpt = $get_claim->cpt;
                $new_bat_claim->m1 = $get_claim->m1;
                $new_bat_claim->m2 = $get_claim->m2;
                $new_bat_claim->m3 = $get_claim->m3;
                $new_bat_claim->m4 = $get_claim->m4;
                $new_bat_claim->pos = $get_claim->pos;
                $new_bat_claim->units = $get_claim->units;
                $new_bat_claim->rate = number_format((double)$get_claim->rate,2,'.','');
                $new_bat_claim->cms_24j = $get_claim->cms_24j;
                $new_bat_claim->id_qualifier = $get_claim->id_qualifier;
                $new_bat_claim->status = $get_claim->status;
                $new_bat_claim->degree_level = $get_claim->degree_level;
                $new_bat_claim->zone = $get_claim->zone;
                $new_bat_claim->location = $get_claim->location;
                $new_bat_claim->units_value_calc = $get_claim->units_value_calc;
                $new_bat_claim->billed_am = $billed_amount;
                $new_bat_claim->is_mark_gen = 0;
                $new_bat_claim->has_manage_claim = 0;
                $new_bat_claim->has_legder = 0;
                $new_bat_claim->save();
                array_push($batch_ids,$new_bat_claim->id);
                array_push($app_ids,$get_claim->appointment_id);
            } else {

                $exist_claim = Batching_claim::where('appointment_id', $get_claim->appointment_id)
                    ->where('admin_id', $this->admin_id)
                    ->where('processing_claim_id', $get_claim->id)
                    ->first();

                $billed_amount = number_format((float)$get_claim->units, 2) * number_format((float)$get_claim->rate, 2);

                $exist_claim->appointment_id = $get_claim->appointment_id;
                $exist_claim->client_id = $get_claim->client_id;
                $exist_claim->provider_id = $get_claim->provider_id;
                $exist_claim->authorization_id = $get_claim->authorization_id;
                $exist_claim->activity_id = $get_claim->activity_id;
                $exist_claim->payor_id = $get_claim->payor_id;
                $exist_claim->activity_type = $get_claim->activity_type;
                $exist_claim->schedule_date = $get_claim->schedule_date;
                $exist_claim->from_time = $get_claim->from_time;
                $exist_claim->to_time = $get_claim->to_time;
                $exist_claim->cpt = $get_claim->cpt;
                $exist_claim->m1 = $get_claim->m1;
                $exist_claim->m2 = $get_claim->m2;
                $exist_claim->m3 = $get_claim->m3;
                $exist_claim->m4 = $get_claim->m4;
                $exist_claim->pos = $get_claim->pos;
                $exist_claim->units = $get_claim->units;
                $exist_claim->rate = number_format((double)$get_claim->rate,2,'.','');
                $exist_claim->cms_24j = $get_claim->cms_24j;
                $exist_claim->id_qualifier = $get_claim->id_qualifier;
                $exist_claim->status = $get_claim->status;
                $exist_claim->degree_level = $get_claim->degree_level;
                $exist_claim->zone = $get_claim->zone;
                $exist_claim->location = $get_claim->location;
                $exist_claim->units_value_calc = $get_claim->units_value_calc;
                $exist_claim->billed_am = $billed_amount;
                $exist_claim->save();
                array_push($batch_ids,$exist_claim->id);
                array_push($app_ids,$get_claim->appointment_id);
            }
        }

        return array(
            "status" =>"done",
            "batch_ids" =>$batch_ids,
            "app_ids" =>$app_ids,
        );
    }


    public function batching_claim_make_process(Request $request)
    {

        $process_ids = $request->process_ids;
        $batch_ids=$request->batch_ids;
        $app_ids = $request->app_ids;

        $admin_id = $this->admin_id;

        $process_ids = implode("','", $process_ids);
        $batch_ids = implode("','", $batch_ids);
        $app_ids = implode("','", $app_ids);

        $query = "UPDATE processing_claims SET is_mark_gen=1 WHERE status = 'Ready To Bill' AND admin_id=$admin_id AND id IN('" . $process_ids . "') ";
        DB::update(DB::raw($query));

        $query = "UPDATE batching_claims SET is_mark_gen=1 WHERE status = 'Ready To Bill' AND admin_id=$admin_id AND id IN('" . $batch_ids . "') ";
        DB::update(DB::raw($query));
        
        $query = "UPDATE appoinments SET is_mark_gen=1 WHERE admin_id=$admin_id AND id IN('" . $app_ids . "') ";
        DB::update(DB::raw($query));

        return response()->json('process_batch');
    }

    public function batching_report(Request $req)
    {
        $arr = $req->data;
        $extra = json_encode($arr);
        $report_type = 101;

        $new_noti = new report_notification();
        $new_noti->admin_id = $this->admin_id;
        $new_noti->name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $new_noti->notification_date = Carbon::now();
        $new_noti->file_name = 'Private_Claims-' . Auth::user()->id . time();
        $new_noti->report_type = $report_type;
        $new_noti->report_name = "report";
        $new_noti->date_type = null;
        $new_noti->form_date = null;
        $new_noti->to_date = null;
        $new_noti->s_date = null;
        $new_noti->extra = $extra;
        $new_noti->status = "Pending";
        $new_noti->type = 1;
        $new_noti->save();

        return "success";
    }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 60;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }
}
