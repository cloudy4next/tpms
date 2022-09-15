<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\Batching_claim;
use App\Models\Client;
use App\Models\deposit_apply;
use App\Models\deposit_apply_transaction;
use App\Models\ledger_list;
use App\Models\ledger_note;
use App\Models\manage_claim_transaction;
use App\Models\Payor_facility;
use App\Models\Processing_claim;
use App\Models\setting_cpt_code;
use App\Models\setting_name_location;
use App\Models\setting_service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class SuperAdminBillingLegderController extends Controller
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


    public function billing_ledger_create(Request $request)
    {


        $batch_ids=$request->batch_ids;

        $get_bacted_claim = Batching_claim::where('admin_id', $this->admin_id)
            ->whereIn('id',$batch_ids)
            ->where('has_legder', 0)
            ->where('status', 'Ready To Bill')
            ->get();



        foreach ($get_bacted_claim as $cat_claim) {

            $check_exists = ledger_list::where('batching_id', $cat_claim->id)->where('appointment_id', $cat_claim->appointment_id)->first();
            if (!$check_exists) {
                $new_ledger = new ledger_list();
                $new_ledger->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
                $new_ledger->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_ledger->batching_id = $cat_claim->id;
                $new_ledger->processing_claim_id = $cat_claim->processing_claim_id;
                $new_ledger->appointment_id = $cat_claim->appointment_id;
                $new_ledger->client_id = $cat_claim->client_id;
                $new_ledger->provider_id = $cat_claim->provider_id;
                $new_ledger->authorization_id = $cat_claim->authorization_id;
                $new_ledger->activity_id = $cat_claim->activity_id;
                $new_ledger->payor_id = $cat_claim->payor_id;
                $new_ledger->activity_type = $cat_claim->activity_type;
                $new_ledger->schedule_date = $cat_claim->schedule_date;
                $new_ledger->cpt = $cat_claim->cpt;
                $new_ledger->m1 = $cat_claim->m1;
                $new_ledger->m2 = $cat_claim->m2;
                $new_ledger->m3 = $cat_claim->m3;
                $new_ledger->m4 = $cat_claim->m4;
                $new_ledger->pos = $cat_claim->pos;
                $new_ledger->units = $cat_claim->units;
                $new_ledger->rate = $cat_claim->rate;
                $new_ledger->cms_24j = $cat_claim->cms_24j;
                $new_ledger->id_qualifier = $cat_claim->id_qualifier;
                $new_ledger->status = $cat_claim->status;
                $new_ledger->degree_level = $cat_claim->degree_level;
                $new_ledger->zone = $cat_claim->zone;
                $new_ledger->location = $cat_claim->location;
                $new_ledger->units_value_calc = $cat_claim->units_value_calc;
                $new_ledger->billed_am = $cat_claim->billed_am;
                $new_ledger->billed_date = $cat_claim->billed_date;
                $new_ledger->is_mark_gen = $cat_claim->is_mark_gen;
                $new_ledger->has_manage_claim = $cat_claim->has_manage_claim;
                $new_ledger->save();

                $sing_batch = Batching_claim::where('id', $cat_claim->id)->first();
                $sing_batch->has_legder = 1;
                $sing_batch->save();
            }
        }


        return response()->json('ledger_create');


    }


    public function billing_ledger()
    {
        return view('superadmin.ledger.ledger');
    }

    public function billing_ledger_get_all_client(Request $request)
    {

        $client_ids = [];
        $batch_claim = ledger_list::distinct()->select('client_id')
            ->where('admin_id', $this->admin_id)
            ->get();
        foreach ($batch_claim as $clm) {
            array_push($client_ids, $clm->client_id);
        }
        $cliens = Client::whereIn('id', $client_ids)
            ->where('admin_id', $this->admin_id)
            ->orderBy('client_full_name', 'asc')
            ->get();
        return $cliens;

    }


    public function billing_ledger_get_all_payor(Request $request)
    {
        $all_payor = Payor_facility::where('admin_id', $this->admin_id)->orderBy('payor_name','asc')->get();
        return response()->json($all_payor, 200);
    }


    public function billing_ledger_get_all_cptcode(Request $request)
    {
        $cpt_codes = setting_cpt_code::where('admin_id', $this->admin_id)->get();
        return response()->json($cpt_codes, 200);
    }


    public function billing_ledger_get_data(Request $request)
    {
        $sort_by = $request->sort_by;
        $claim_no = $request->claim_no;
        $client_id = $request->client_id;
        $payor_id = $request->payor_id;
        $cpt = $request->cpt;
        $fil_cat_name = $request->fil_cat_name;

        $reportrange = $request->reportrange;
        $reportrange1 = Carbon::parse(substr($request->reportrange, 0, 10))->format('Y-m-d');
        $reportrange2 = Carbon::parse(substr($request->reportrange, 12, 22))->format('Y-m-d');


        $from_date = Carbon::parse($reportrange1)->format('Y-m-d');
        $to_date = Carbon::parse($reportrange2)->format('Y-m-d');
        $admin_id = $this->admin_id;


        $claim_array = [];

        if ($sort_by == 1) {
            $manage_claim = manage_claim_transaction::select('admin_id', 'claim_id', 'baching_id')->where('claim_id', $claim_no)
                ->where('admin_id', $this->admin_id)->get();
            foreach ($manage_claim as $mng_clm) {
                array_push($claim_array, $mng_clm->baching_id);
            }
        }


        $query = "SELECT * FROM ledger_lists WHERE admin_id=$admin_id ";

        if (empty($client_id) && empty($payor_id) && empty($reportrange)) {


        }

        if (isset($claim_no) && $sort_by == 1) {
            $claim_filter = implode("','", $claim_array);
            $query .= "AND batching_id IN('" . $claim_filter . "') ";
        }


        if (isset($client_id) && $sort_by == 2) {
            $client_id = implode("','", $client_id);
            $query .= "AND client_id IN('" . $client_id . "') ";
        }

        if (isset($cpt) && $sort_by == 2) {
            $query .= "AND cpt ='$cpt' ";
        }

        if (isset($fil_cat_name) && $sort_by == 2) {
            $query .= "AND category_name ='$fil_cat_name' ";
        }

        if (isset($reportrange) && $sort_by == 2) {
            $query .= "AND schedule_date >= '$from_date' ";
            $query .= "AND schedule_date <= '$to_date' ";

        }

        $query .= "ORDER BY schedule_date ASC";
        
        $leg_dat = DB::select($query);
        $legder_data = $this->arrayPaginator($leg_dat, $request);

        // if ($sort_by == 1) {
        //     $ledger_list_data = ledger_list::distinct()->select('batching_id', 'client_id', 'appointment_id', 'schedule_date')->whereIn('batching_id', $claim_array)->get();
        // } else {
        //     $ledger_list_data = ledger_list::distinct()->select('batching_id', 'client_id', 'appointment_id', 'schedule_date')->where('client_id', $client_id)->get();
        // }


        // $bill_am = 0;
        // $pay_am = 0;
        // $adj_am = 0;
        // $sum = 0;
        // foreach ($ledger_list_data as $leddata) {

        //     $check_dep_am = deposit_apply::distinct()->select('admin_id', 'appointment_id', 'dos')
        //         ->where('appointment_id', $leddata->appointment_id)
        //         ->where('dos', $leddata->schedule_date)
        //         ->where('admin_id', $this->admin_id)
        //         ->sum('billed_am');
        //     $check_dep_pay = deposit_apply_transaction::distinct()->select('admin_id', 'appointment_id', 'dos')
        //         ->where('appointment_id', $leddata->appointment_id)
        //         ->where('dos', $leddata->schedule_date)
        //         ->where('admin_id', $this->admin_id)
        //         ->sum('payment');

        //     $check_dep_adj = deposit_apply_transaction::distinct()->select('admin_id', 'appointment_id', 'dos')
        //         ->where('appointment_id', $leddata->appointment_id)
        //         ->where('dos', $leddata->schedule_date)
        //         ->where('admin_id', $this->admin_id)
        //         ->sum('adjustment');

        //     $bill_am += $check_dep_am;
        //     $pay_am += $check_dep_pay;
        //     $adj_am += $check_dep_adj;
        // }


        // $sub_total_1 = $pay_am + $adj_am;
        // $sum = $bill_am - $sub_total_1;


        return response()->json([
            'notices' => $legder_data,
            'view' => View::make('superadmin.ledger.include.ledger_table', compact('legder_data'))->render(),
            'pagination' => (string)$legder_data->links(),
            // 'billed_am' => $bill_am,
            // 'payment' => $pay_am,
            // 'adj' => $adj_am,
            // 'bal' => $sum,
            // 'is_view' => 1,
        ]);
    }


    public function client_ledger_get(Request $request)
    {


        $client_id = $request->client_id;
        $cpt = $request->cpt;
        $fil_cat_name = $request->fil_cat_name;

        $reportrange = $request->reportrange;
        $reportrange1 = Carbon::parse(substr($request->reportrange, 0, 10))->format('Y-m-d');
        $reportrange2 = Carbon::parse(substr($request->reportrange, 12, 22))->format('Y-m-d');


        $from_date = Carbon::parse($reportrange1)->format('Y-m-d');
        $to_date = Carbon::parse($reportrange2)->format('Y-m-d');
        $admin_id = $this->admin_id;


        $claim_array = [];
        $query = "SELECT * FROM ledger_lists WHERE admin_id=$admin_id ";


        if (empty($client_id) && empty($payor_id) && empty($reportrange)) {


        }


        if (isset($client_id)) {
            $query .= "AND client_id =$client_id ";

        }

        if (isset($cpt)) {
            $query .= "AND cpt ='$cpt' ";
        }

        if (isset($fil_cat_name)) {
            $query .= "AND category_name ='$fil_cat_name' ";
        }

        if (isset($reportrange)) {
            $query .= "AND schedule_date >= '$from_date' ";
            $query .= "AND schedule_date <= '$to_date' ";

        }

        $query .= "ORDER BY schedule_date ASC";
        $query_exe = DB::select($query);

        $legder_data = $this->arrayPaginatorClientLed($query_exe, $request);
        $ledger_list_data = ledger_list::distinct()->select('batching_id', 'client_id', 'appointment_id', 'schedule_date')
            ->where('client_id', $client_id)
            ->get();


        $bill_am = 0;
        $pay_am = 0;
        $adj_am = 0;
       // $sum = 0;
        foreach ($ledger_list_data as $leddata) {
            $check_dep_am = deposit_apply::distinct()->select('admin_id', 'appointment_id', 'dos')
                ->where('appointment_id', $leddata->appointment_id)
                ->where('dos', $leddata->schedule_date)
                ->where('admin_id', $this->admin_id)
                ->sum('billed_am');

            $check_dep_pay = deposit_apply_transaction::distinct()->select('admin_id', 'appointment_id', 'dos')
                ->where('appointment_id', $leddata->appointment_id)
                ->where('dos', $leddata->schedule_date)
                ->where('admin_id', $this->admin_id)
                ->sum('payment');

            $check_dep_adj = deposit_apply_transaction::distinct()->select('admin_id', 'appointment_id', 'dos')
                ->where('appointment_id', $leddata->appointment_id)
                ->where('dos', $leddata->schedule_date)
                ->where('admin_id', $this->admin_id)
                ->sum('adjustment');

            $bill_am += $check_dep_am;
            $pay_am += $check_dep_pay;
            $adj_am += $check_dep_adj;

        }


        $sub_total_1 = $pay_am + $adj_am;
        $sum = $bill_am - $sub_total_1;


        return response()->json([
            'notices' => $legder_data,
            'view' => View::make('superadmin.client.include.clientLedgerTbl', compact('legder_data'))->render(),
            'pagination' => (string)$legder_data->links(),
            'billed_am' => $bill_am,
            'payment' => $pay_am,
            'adj' => $adj_am,
            'bal' => $sum,
            'is_view' => 1,
        ]);
    }


    public function client_ledger_get_next(Request $request)
    {
        $client_id = $request->client_id;
        $cpt = $request->cpt;
        $fil_cat_name = $request->fil_cat_name;

        $reportrange = $request->reportrange;
        $reportrange1 = Carbon::parse(substr($request->reportrange, 0, 10))->format('Y-m-d');
        $reportrange2 = Carbon::parse(substr($request->reportrange, 12, 22))->format('Y-m-d');


        $from_date = Carbon::parse($reportrange1)->format('Y-m-d');
        $to_date = Carbon::parse($reportrange2)->format('Y-m-d');
        $admin_id = $this->admin_id;


        $claim_array = [];


        $query = "SELECT * FROM ledger_lists WHERE admin_id=$admin_id ";

        if (empty($client_id) && empty($payor_id) && empty($reportrange)) {


        }


        if (isset($client_id)) {
            $query .= "AND client_id =$client_id ";

        }

        if (isset($cpt)) {
            $query .= "AND cpt ='$cpt' ";
        }

        if (isset($fil_cat_name)) {
            $query .= "AND category_name ='$fil_cat_name' ";
        }

        if (isset($reportrange)) {
            $query .= "AND schedule_date >= '$from_date' ";
            $query .= "AND schedule_date <= '$to_date' ";

        }

        $query .= "ORDER BY schedule_date ASC";
        $query_exe = DB::select($query);

        $legder_data = $this->arrayPaginatorClientLed($query_exe, $request);
        $ledger_list_data = ledger_list::distinct()->select('batching_id', 'client_id', 'appointment_id', 'schedule_date')
            ->where('client_id', $client_id)
            ->get();


        $bill_am = 0;
        $pay_am = 0;
        $adj_am = 0;
        //        $sum = 0;
        foreach ($ledger_list_data as $leddata) {

            $check_dep_am = deposit_apply::distinct()->select('admin_id', 'appointment_id', 'dos')
                ->where('appointment_id', $leddata->appointment_id)
                ->where('dos', $leddata->schedule_date)
                ->where('admin_id', $this->admin_id)
                ->sum('billed_am');

            $check_dep_pay = deposit_apply_transaction::distinct()->select('admin_id', 'appointment_id', 'dos')
                ->where('appointment_id', $leddata->appointment_id)
                ->where('dos', $leddata->schedule_date)
                ->where('admin_id', $this->admin_id)
                ->sum('payment');

            $check_dep_adj = deposit_apply_transaction::distinct()->select('admin_id', 'appointment_id', 'dos')
                ->where('appointment_id', $leddata->appointment_id)
                ->where('dos', $leddata->schedule_date)
                ->where('admin_id', $this->admin_id)
                ->sum('adjustment');

            $bill_am += $check_dep_am;
            $pay_am += $check_dep_pay;
            $adj_am += $check_dep_adj;

        }


        $sub_total_1 = $pay_am + $adj_am;
        $sum = $bill_am - $sub_total_1;


        return response()->json([
            'notices' => $legder_data,
            'view' => View::make('superadmin.client.include.clientLedgerTbl', compact('legder_data'))->render(),
            'pagination' => (string)$legder_data->links(),
            'billed_am' => $bill_am,
            'payment' => $pay_am,
            'adj' => $adj_am,
            'bal' => $sum,
            'is_view' => 1,
        ]);
    }


    public function arrayPaginatorClientLed($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 20;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


    public function billing_ledger_sum_total(Request $request)
    {
        $client_id = $request->client_id;
        $payor_id = $request->payor_id;
        $cpt = $request->cpt;
        $fil_cat_name = $request->fil_cat_name;

        $reportrange = $request->reportrange;
        $reportrange1 = Carbon::parse(substr($request->reportrange, 0, 10))->format('Y-m-d');
        $reportrange2 = Carbon::parse(substr($request->reportrange, 12, 22))->format('Y-m-d');


        $from_date = Carbon::parse($reportrange1)->format('Y-m-d');
        $to_date = Carbon::parse($reportrange2)->format('Y-m-d');
        $admin_id = $this->admin_id;


        $ledger_sum_billedam = deposit_apply::select('client_id', 'amount')->where(function ($query) use ($client_id) {
            $query->where('client_id', $client_id);
        })->sum('amount');

        $ledger_sum_payment = deposit_apply_transaction::select('client_id', 'payment')->where(function ($query) use ($client_id) {
            $query->where('client_id', $client_id);
        })->sum('payment');

        $ledger_sum_adj = deposit_apply_transaction::select('client_id', 'adjustment')->where(function ($query) use ($client_id) {
            $query->where('client_id', $client_id);
        })->sum('adjustment');


        $sub_total = ($ledger_sum_payment + $ledger_sum_adj);
        $total = $ledger_sum_billedam - $sub_total;
        $ledger_list_data = ledger_list::select('admin_id', 'client_id', 'batching_id')
            ->where('client_id', $client_id)
            ->where('admin_id', $this->admin_id)
            ->get();

        $sum = 0;
        foreach ($ledger_list_data as $leddata) {
            $check_dep_app = deposit_apply::select('batching_claim_id', 'balance', 'client_id')
                ->where('batching_claim_id', $leddata->batching_id)
                ->where('client_id', $client_id)
                ->first();


            if ($check_dep_app) {
                $check_dep_trac = deposit_apply_transaction::select('deposit_apply_id', 'balance', 'client_id')
                    ->where('deposit_apply_id', $check_dep_app->id)
                    ->where('client_id', $client_id)
                    ->where('admin_id', $this->admin_id)
                    ->first();
                if ($check_dep_trac) {
                    if ($check_dep_trac->balance != null || $check_dep_trac->balance != "") {
                        $sum += $check_dep_trac->balance;
                    } else {
                        $sum += $check_dep_app->balance;
                    }
                } else {
                    $sum += 0;
                }

            }

        }


        return response()->json([
            'billed_am' => $ledger_sum_billedam,
            'payment' => $ledger_sum_payment,
            'adj' => $ledger_sum_adj,
            'bal' => $total,
        ]);


    }


    public function billing_ledger_transaction_get(Request $request)
    {
        $ids = $request->ids;
        $admin_id = $this->admin_id;
        $query = "SELECT * FROM deposit_apply_transactions WHERE admin_id=$admin_id ";

        if (empty($ids)) {
            return 'none';
        }

        if (isset($ids)) {
            $surface_filter = implode("','", $ids);
            $query .= "AND batching_claim_id IN('" . $surface_filter . "')  ";
            $deposits_apllys_trans = DB::select($query);
        }


            //        $deposits_apllys_trans = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $deposits_apllys_trans,
            'view' => View::make('superadmin.ledger.include.ledger_include_transaction', compact('deposits_apllys_trans'))->render(),
            //            'pagination' => (string)$deposits_apllys_trans->links()
        ]);

    }


    public function client_ledger_transaction_get(Request $request)
    {
        $ids = $request->ids;
        $admin_id = $this->admin_id;
        $query = "SELECT * FROM deposit_apply_transactions WHERE admin_id=$admin_id ";

        if (empty($ids)) {
            return 'none';
        }

        if (isset($ids)) {
            $surface_filter = implode("','", $ids);
            $query .= "AND batching_claim_id IN('" . $surface_filter . "')  ";
            $deposits_apllys_trans = DB::select($query);
        }


        //        $deposits_apllys_trans = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $deposits_apllys_trans,
            'view' => View::make('superadmin.client.include.ledger_include_transaction', compact('deposits_apllys_trans'))->render(),
        //            'pagination' => (string)$deposits_apllys_trans->links()
        ]);
    }


    public function billing_ledger_note_save(Request $request)
    {
        $dep = ledger_list::where('id', $request->ledger_id)->where('admin_id', $this->admin_id)->first();

        if ($dep) {
            $new_note = new ledger_note();
            $new_note->admin_id = $this->admin_id;
            $new_note->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
            $new_note->ledger_id = $request->ledger_id;
            $new_note->client_id = $dep->client_id;
            $new_note->payor_id = $dep->payor_id;
            $new_note->cpt_code = $dep->cpt;
            $new_note->category_name = $request->category_name;
            $new_note->followup_date = Carbon::parse($request->followup_date)->format('Y-m-d');
            $new_note->worked_date = $request->worked_date;
            $new_note->notes = $request->notes;
            $new_note->save();

            $dep->category_name = $request->category_name;
            $dep->followup_date = Carbon::parse($request->followup_date)->format('Y-m-d');
            $dep->worked_date = Carbon::now()->format('Y-m-d');
            $dep->save();
            return response()->json('note_successfully_added', 200);  
        } else {
            return response()->json('ledger_not_found', 200);
        }


    }


    public function billing_ledger_multi_note_save(Request $request)
    {

        $ids = $request->ids;


        for ($i = 0; $i < count($ids); $i++) {

            $dep = ledger_list::where('id', $ids[$i])->where('admin_id', $this->admin_id)->first();

            if ($dep) {
                $new_note = new ledger_note();
                $new_note->admin_id = $this->admin_id;
                $new_note->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_note->ledger_id = $dep->id;
                $new_note->client_id = $dep->client_id;
                $new_note->payor_id = $dep->payor_id;
                $new_note->cpt_code = $dep->cpt;
                $new_note->category_name = $request->category_name;
                $new_note->followup_date = Carbon::parse($request->followup_date)->format('Y-m-d');
                $new_note->worked_date = $request->worked_date;
                $new_note->notes = $request->notes;
                $new_note->save();


                $dep->category_name = $request->category_name;
                $dep->followup_date = Carbon::parse($request->followup_date)->format('Y-m-d');
                $dep->worked_date = Carbon::now()->format('Y-m-d');
                $dep->save();

            }


        }
        return 'done';

    }


    public function billing_ledger_bucket_multi_note_save(Request $request)
    {
        $ids = $request->ids;


        for ($i = 0; $i < count($ids); $i++) {

            $dep = ledger_list::where('id', $ids[$i])->where('admin_id', $this->admin_id)->first();

            if ($dep) {
                $new_note = new ledger_note();
                $new_note->admin_id = $this->admin_id;
                $new_note->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_note->ledger_id = $dep->id;
                $new_note->client_id = $dep->client_id;
                $new_note->payor_id = $dep->payor_id;
                $new_note->cpt_code = $dep->cpt;
                $new_note->category_name = $request->category_name;
                $new_note->followup_date = Carbon::parse($request->followup_date)->format('Y-m-d');
                $new_note->worked_date = Carbon::now()->format('Y-m-d');
                $new_note->notes = $request->notes;
                $new_note->save();


                $dep->category_name = $request->category_name;
                $dep->followup_date = Carbon::parse($request->followup_date)->format('Y-m-d');
                $dep->worked_date = Carbon::now()->format('Y-m-d');
                $dep->save();

            }


        }
        return 'done';
    }


    public function billing_ledger_ar_followup_bucket($type)
    {
        return view('superadmin.ledger.ledgerArFollowBucket', compact('type'));
    }


    public function billing_ledger_ar_followup_bucket_filter_client(Request $request)
    {

        $today = '';
        $old_date = '';
        $today = Carbon::now()->format('Y-m-d');
        if ($request->check_date == 2) {
            $old_date = Carbon::now()->subDays(7)->format('Y-m-d');
        }
        else if ($request->check_date == 3) {
            $old_date = Carbon::now()->subDays(15)->format('Y-m-d');
        }
        else if ($request->check_date == 4) {
            $old_date = Carbon::now()->subDays(30)->format('Y-m-d');
        }



        if($request->check_date == 1){
            $client = ledger_note::distinct()->select('admin_id', 'client_id')->where('admin_id', $this->admin_id)
                ->where('followup_date', $old_date)
                ->with('client')
                ->get();
        }
        else{
            $client = ledger_note::distinct()->select('admin_id', 'client_id')->where('admin_id', $this->admin_id)
                ->where('followup_date', '<=', $today)
                ->where('followup_date', '>=', $old_date)
                ->with('client')
                ->get();
        }


        return $client;
    }


    public function billing_ledger_ar_followup_bucket_filter_payor(Request $request)
    {
        $today = '';
        $old_date = '';
        $today = Carbon::now()->format('Y-m-d');
        if ($request->check_date == 2) {
            $old_date = Carbon::now()->subDays(7)->format('Y-m-d');
        }
        else if ($request->check_date == 3) {
            $old_date = Carbon::now()->subDays(15)->format('Y-m-d');
        }
        else if ($request->check_date == 4) {
            $old_date = Carbon::now()->subDays(30)->format('Y-m-d');
        }



        if($request->check_date == 1){
            $payor = ledger_note::distinct()->select('admin_id', 'payor_id')->where('admin_id', $this->admin_id)
                ->where('followup_date', $old_date)
                ->with('payor')
                ->get();
        }
        else{
            $payor = ledger_note::distinct()->select('admin_id', 'payor_id')->where('admin_id', $this->admin_id)
                ->where('followup_date', '<=', $today)
                ->where('followup_date', '>=', $old_date)
                ->with('payor')
                ->get();
        }


        return $payor;
    }


    public function billing_ledger_ar_followup_bucket_filter_cpt(Request $request)
    {
        $today = '';
        $old_date = '';
        $today = Carbon::now()->format('Y-m-d');
        if ($request->check_date == 2) {
            $old_date = Carbon::now()->subDays(7)->format('Y-m-d');
        }
        else if ($request->check_date == 3) {
            $old_date = Carbon::now()->subDays(15)->format('Y-m-d');
        }
        else if ($request->check_date == 4) {
            $old_date = Carbon::now()->subDays(30)->format('Y-m-d');
        }

        if($request->check_date == 1){
            $cpt = ledger_note::distinct()->select('admin_id', 'cpt_code')->where('admin_id', $this->admin_id)
                ->where('followup_date', $old_date)
                ->get();
        }
        else{
            $cpt = ledger_note::distinct()->select('admin_id', 'cpt_code')->where('admin_id', $this->admin_id)
                ->where('followup_date', '<=', $today)
                ->where('followup_date', '>=', $old_date)
                ->with('cpt')
                ->get();
        }

        return $cpt;
    }


    public function billing_ledger_ar_followup_bucket_filter(Request $request)
    {
        // dd($request->all());
        $select_date = $request->select_date;

        $data_range = $request->data_range;
        $reportrange_two1 = Carbon::parse(substr($request->data_range, 0, 10))->format('Y-m-d');
        $reportrange_two2 = Carbon::parse(substr($request->data_range, 13, 24))->format('Y-m-d');


        $client_id = $request->client_id;
        $payor_id = $request->payor_id;
        $ctp_code = $request->ctp_code;
        $ser_cat_name = $request->ser_cat_name;

        $array = [];
        $all_notes = ledger_note::distinct()->select('ledger_id')->where('admin_id', $this->admin_id)->get();
        $client_array = [];
        

        foreach ($all_notes as $note) {
            array_push($array, $note->ledger_id);
        }

        $admin_id = $this->admin_id;

        $query = "SELECT * FROM ledger_lists WHERE admin_id=$admin_id ";

        $size_filter = implode("','", $array);
        $query .= "AND id IN('" . $size_filter . "') ";

        $today = Carbon::now()->format('Y-m-d');
        $last_7days = Carbon::now()->subDays(7)->format('Y-m-d');
        $last_15days = Carbon::now()->subDays(15)->format('Y-m-d');
        $last_30days = Carbon::now()->subDays(30)->format('Y-m-d');


        if (isset($select_date)) {
            if ($select_date == 1) {
                $query .= "AND followup_date='$today' ";
            } elseif ($select_date == 2) {
                $query .= "AND followup_date >= '$last_7days' ";
                $query .= "AND followup_date <= '$today' ";
            } elseif ($select_date == 3) {
                $query .= "AND followup_date >= '$last_15days' ";
                $query .= "AND followup_date <= '$today' ";
            } elseif ($select_date == 4) {
                $query .= "AND followup_date >= '$last_30days' ";
                $query .= "AND followup_date <= '$today' ";
            }
        }


        if (!empty($client_id)) {
            if(is_array($client_id))
            {
                $client_id = implode("','", $client_id);
                $query .= "AND client_id IN('" . $client_id . "') ";
            }
            else{
                $query .= "AND client_id = '$client_id' ";

            }

        }

        if (!empty($payor_id)) {
            if(is_array($payor_id))
            {
                $payor_id = implode("','", $payor_id);
                $query .= "AND payor_id IN('" . $payor_id . "') ";
            }
            else{
                $query .= "AND payor_id = '$payor_id' ";

            }


        }
        
        if (!empty($ctp_code)) {
            if(is_array($ctp_code))
            {
                $ctp_code = implode("','", $ctp_code);
                $query .= "AND cpt IN('" . $ctp_code . "') ";
            }
            else{
                $query .= "AND cpt = '$ctp_code' ";

            }

        }
        if (isset($ser_cat_name)) {
            $query .= "AND category_name ='$ser_cat_name' ";
        }

        if (isset($data_range)) {
            $query .= "AND followup_date >= '$reportrange_two1' ";
            $query .= "AND followup_date <= '$reportrange_two2' ";
        }


        $query_exe = DB::select($query);

        $query_exe = $this->arrayPaginator($query_exe,$request);
        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.ledger.include.arbucket_table', compact('query_exe'))->render(),
            'pagination' => (string)$query_exe->links(),
        ]);

    }


    public function billing_ledger_ar_followup_bucket_comment_get(Request $request)
    {
        $led_id = $request->l_id;

        $comments = DB::table('ledger_notes')
            ->where('admin_id', $this->admin_id)
            ->where('ledger_id', $led_id)
            ->get();

        return response()->json($comments, 200);
    }


    public function billing_ledger_ar_followup_bucket_filter_types($type)
    {
        $type_id = $type;
        return view('superadmin.ledger.ledgerArFollowBucketTypes', compact('type_id'));
    }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 30;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


}
