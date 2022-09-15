<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\Batching_claim;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\deposit;
use App\Models\deposit_apply;
use App\Models\deposit_apply_transaction;
use App\Models\general_setting;
use App\Models\manage_claim_transaction;
use App\Models\Payor_facility;
use App\Models\setting_name_location;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Codedge\Fpdf\Fpdf\Fpdf;


class MYPDF extends FPDF
{

    function Header()
    {

        if (Auth::user()->is_up_admin == 1) {
            $setting_name = setting_name_location::where('admin_id', Auth::user()->id)->first();
            $logo = general_setting::where('admin_id', Auth::user()->id)->first();
        } else {
            $setting_name = setting_name_location::where('admin_id', Auth::user()->up_admin_id)->first();
            $logo = general_setting::where('admin_id', Auth::user()->up_admin_id)->first();
        }

        if (!$logo) {
            return back()->with('alert', 'Please Upload Logo');
            exit();
        }

        $logo_image = $logo->logo;


        if (!$setting_name) {
            return back()->with('alert', 'Please Update Box 32');
            exit();
        }

        $today_date = Carbon::now()->format('m/d/Y');
        $this->SetAutoPageBreak(false);
        $this->SetFont('helvetica', '', 10);
        $this->Image($logo_image, 15, 10, 20, 20);
        $this->SetXY(38, 10);
        $w = 4;
        $this->SetFont('','B',12);
        $this->SetTextColor(0, 32, 96);
        $this->Cell(120, $w, $setting_name->facility_name, 0, 1);
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->SetX(38);
        $this->Cell(120, $w, $setting_name->address . ', ' . $setting_name->city, 0, 1);
        $this->SetX(38);
        $this->Cell(120, $w, $setting_name->state . ', ' . $setting_name->zip, 0, 1);
        $this->SetX(38);
        $this->Cell(120, $w, 'Phone: ' . $setting_name->phone_one, 0, 1);
        $this->SetX(38);
        $this->Cell(120, $w, 'Fax: (818) 578-5007', 0, 1);
        $this->SetX(38);
        $this->Cell(120, $w, 'Email: ' . $setting_name->email, 0, 1);

        $this->SetXY(110, 18);

        $this->SetFont('', 'B', 12);
        $this->SetX(110);
        $this->SetFillColor(0, 32, 96);
        $this->SetTextColor(0, 32, 96);
        $this->Cell(125, $w, 'Receipt', 0, 1, 'C');
        $this->SetFont('', '', 10);
        $this->SetX(110);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(125, $w + 2, $today_date, 0, 1, 'C');
        $this->SetY(40);
        $this->SetDrawColor(0, 32, 96);
        $this->SetLineWidth(0.7);
        $this->Line(10, 5, 10, 35);
        $this->Line(10, 35, 200, 35);
    }
}


class SuperAdminBillingDepositController extends Controller
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

    public function billing_deposit()
    {
        $payor = Payor_facility::where('admin_id', $this->admin_id)->get();

        return view('superadmin.deposit.deposit', compact('payor'));
    }

    public function billing_deposit_add()
    {
        $all_payor = Payor_facility::where('admin_id', $this->admin_id)->get();
        $all_client = Client::where('admin_id', $this->admin_id)->get();

        return view('superadmin.deposit.depositAdd', compact('all_payor', 'all_client'));
    }


    public function billing_deposit_add_save(Request $request)
    {

        $check = deposit::select('id')->where('admin_id',$this->admin_id)->where('instrument',$request->instrument)->first();
        if($check){
            return back()->with('alert','Check already exists.');
        }

        $new_dep = new deposit();

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/deposit/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;
            $new_dep->file = $imageUrl;
        }


        $new_dep->admin_id = $this->admin_id;
        $new_dep->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
        $new_dep->payor_type = $request->payor_type;
        $new_dep->payor_id = $request->payor_id;
        $new_dep->client_id = $request->client_id;
        $new_dep->deposit_date = Carbon::parse($request->deposit_date)->format('Y-m-d');
        $new_dep->payment_method = $request->payment_method;
        $new_dep->instrument = $request->instrument;
        $new_dep->instrument_date = Carbon::parse($request->instrument_date)->format('Y-m-d');
        $new_dep->amount = (double)$request->amount;
        $new_dep->unapplied_amount = (double)$request->unapplied_amount;
        $new_dep->notes = $request->notes;
        $new_dep->save();


        return redirect(route('superadmin.billing.deposit'))->with('success', 'Deposit Successfully Created');

    }


    public function billing_deposit_edit($id)
    {
        $all_payor = Payor_facility::where('admin_id', $this->admin_id)->get();
        $all_client = Client::where('admin_id', $this->admin_id)->get();
        $dep = deposit::where('id', $id)->where('admin_id', $this->admin_id)->first();

        return view('superadmin.deposit.depositEdit', compact('all_payor', 'all_client', 'dep'));
    }


    public function billing_deposit_update(Request $request)
    {
        $update_deposit = deposit::where('id', $request->deposit_edit_id)
            ->where('admin_id', $this->admin_id)
            ->first();

        if ($request->hasFile('file')) {
            @unlink($update_deposit->file);
            $image = $request->file('file');
            $name = $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/deposit/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;
            $update_deposit->file = $imageUrl;
        }


        $update_deposit->payor_type = $request->payor_type;
        $update_deposit->payor_id = $request->payor_id;
        $update_deposit->client_id = $request->client_id;
        $update_deposit->deposit_date = Carbon::parse($request->deposit_date)->format('Y-m-d');
        $update_deposit->payment_method = $request->payment_method;
        $update_deposit->instrument = $request->instrument;
        $update_deposit->instrument_date = Carbon::parse($request->instrument_date)->format('Y-m-d');
        $update_deposit->amount = number_format((double)str_replace(',','',(string)$request->amount),2,'.','');
        $update_deposit->unapplied_amount = number_format((double)str_replace(',','',(string)$request->unapplied_amount),2,'.','');
        $update_deposit->notes = $request->notes;
        $update_deposit->save();

        return redirect(route('superadmin.billing.deposit'))->with('success', 'Deposit Successfully Updated');

    }


    public function billing_deposit_delete($id)
    {

        $delete_dep = deposit::where('id', $id)
            ->where('admin_id', $this->admin_id)
            ->first();

        $check_exists = deposit_apply::where('deopsit_id', $id)
            ->where('admin_id', $this->admin_id)
            ->where('status_apply', 1)
            ->count();

        if ($check_exists > 0) {
            return back()->with('alert', 'Selected deposits have active payments');
        } else {

            $depe_data = deposit_apply::where('deopsit_id', $id)
                ->where('admin_id', $this->admin_id)
                ->delete();
            $delete_dep->delete();
            return back()->with('success', 'Deposit Successfully Deleted');
        }
    }


    public function billing_data_get_payee_type(Request $request)
    {
        $type = $request->payee_id;

        if ($type == 1) {
            $client = Client::select('id', 'admin_id', 'client_full_name')->where('admin_id', $this->admin_id)->orderBy('client_full_name','asc')->get();
            return response()->json($client, 200);
        } else {
            $all_payor = Payor_facility::where('admin_id', $this->admin_id)->orderBy('payor_name','asc')->get();
            return response()->json($all_payor, 200);
        }

    }


    public function billing_data_get(Request $request)
    {
        $dep_dare_range = $request->dep_dare_range;
        $dep_dare_range1 = Carbon::parse(substr($request->dep_dare_range, 0, 10))->format('Y-m-d');
        $dep_dare_range2 = Carbon::parse(substr($request->dep_dare_range, 13, 23))->format('Y-m-d');

        $check_date_rage = $request->check_date_rage;
        $check_date_rage1 = Carbon::parse(substr($request->check_date_rage, 0, 10))->format('Y-m-d');
        $check_date_rage2 = Carbon::parse(substr($request->check_date_rage, 13, 23))->format('Y-m-d');

        $payor_name = $request->payor_name;
        $check_no = $request->check_no;
        $payee_type = $request->payee_type;
        $alloc = $request->alloc;

        $admin_id = $this->admin_id;

        $query = "SELECT * FROM deposits WHERE admin_id=$admin_id ";

       // if (empty($dep_dare_range) && empty($check_date_rage) && empty($payor_name) && empty($check_no)) {
       //     $query .= "ORDER BY id ASC";
       //     $query_exe = DB::select($query);
       // }


        if (isset($payee_type) && $payee_type == 1) {
            $query .= "AND payor_type = 1 ";
            $query .= "AND client_id = $payor_name ";
        }

        if (isset($payee_type) && $payee_type == 2) {
            $query .= "AND payor_type = 2 ";
            $query .= "AND payor_id = $payor_name ";
        }


        if (isset($check_no)) {
            $query .= "AND instrument LIKE '%$check_no%' ";
        }

        if (isset($dep_dare_range)) {
            $query .= "AND deposit_date >= '$dep_dare_range1' ";
            $query .= "AND deposit_date <= '$dep_dare_range2' ";
        }

        if (isset($check_date_rage)) {
            $query .= "AND instrument_date >= '$check_date_rage1' ";
            $query .= "AND instrument_date <= '$check_date_rage2' ";
        }

        if($request->default == 'default')
        {
            $query .= "AND MONTH(instrument_date) = MONTH(now()) AND YEAR(instrument_date) = YEAR(CURRENT_DATE())";
        }

        $query .= "ORDER BY id DESC";
        $deposits = DB::select($query);


       // $deposits = $this->arrayPaginator($query_exe, $request);

        return response()->json([
            'notices' => $deposits,
            'view' => View::make('superadmin.deposit.include.include_table', compact('deposits'))->render(),
            'data_type' => 1
        ]);
    }


    public function billing_data_get_two(Request $request)
    {
        $dep_dare_range = $request->dep_dare_range;
        $dep_dare_range1 = Carbon::parse(substr($request->dep_dare_range, 0, 10))->format('Y-m-d');
        $dep_dare_range2 = Carbon::parse(substr($request->dep_dare_range, 13, 23))->format('Y-m-d');

        $check_date_rage = $request->check_date_rage;
        $check_date_rage1 = Carbon::parse(substr($request->check_date_rage, 0, 10))->format('Y-m-d');
        $check_date_rage2 = Carbon::parse(substr($request->check_date_rage, 13, 23))->format('Y-m-d');

        $payor_name = $request->payor_name;
        $check_no = $request->check_no;
        $payee_type = $request->payee_type;

        $admin_id = $this->admin_id;

        $query = "SELECT * FROM deposits WHERE admin_id=$admin_id ";

        if (empty($dep_dare_range) && empty($check_date_rage) && empty($payor_name) && empty($check_no)) {
            $query .= "ORDER BY id ASC ";
            $query_exe = DB::select($query);
        }

        if (isset($payee_type) && $payee_type == 1) {
            $query .= "AND client_id = $payor_name ";
        }

        if (isset($payee_type) && $payee_type == 2) {
            $query .= "AND payor_id = $payor_name ";
        }

        if (isset($check_no)) {
            $query .= "AND instrument LIKE '%$check_no%' ";
        }

        if (isset($dep_dare_range)) {
            $query .= "AND deposit_date >= '$dep_dare_range1' ";
            $query .= "AND deposit_date <= '$dep_dare_range2' ";
        }
        if (isset($dep_dare_range)) {
            $query .= "AND instrument_date >= '$check_date_rage1' ";
            $query .= "AND instrument_date <= '$check_date_rage2' ";
        }


        $query_exe = DB::select($query);

        $deposits = $this->arrayPaginator($query_exe, $request);

        return response()->json([
            'notices' => $deposits,
            'view' => View::make('superadmin.deposit.include.include_table', compact('deposits'))->render(),
            'pagination' => (string)$deposits->links(),
            'data_type' => 1
        ]);
    }


    public function billing_data_search(Request $request)
    {
        $dep_dare_range = $request->dep_dare_range;
        $dep_dare_range1 = Carbon::parse(substr($request->dep_dare_range, 0, 10))->format('Y-m-d');
        $dep_dare_range2 = Carbon::parse(substr($request->dep_dare_range, 13, 23))->format('Y-m-d');

        $check_date_rage = $request->check_date_rage;
        $check_date_rage1 = Carbon::parse(substr($request->check_date_rage, 0, 10))->format('Y-m-d');
        $check_date_rage2 = Carbon::parse(substr($request->check_date_rage, 13, 23))->format('Y-m-d');

        $payor_name = $request->payor_name;
        $check_no = $request->check_no;

        $admin_id = $this->admin_id;
        $query = "SELECT * FROM deposits WHERE admin_id=$admin_id ";


        if (empty($dep_dare_range) && empty($check_date_rage) && empty($payor_name) && empty($check_no)) {
            return 'none';
        }

        if (isset($payor_name)) {
            $query .= "AND payor_id = $payor_name ";
        }

        if (isset($check_no)) {
            $query .= "AND instrument LIKE '%$check_no%' ";
        }

        if (isset($dep_dare_range)) {
            $query .= "AND deposit_date >= '$dep_dare_range1' ";
            $query .= "AND deposit_date <= '$dep_dare_range2' ";
        }
        if (isset($dep_dare_range)) {
            $query .= "AND instrument_date >= '$check_date_rage1' ";
            $query .= "AND instrument_date <= '$check_date_rage2' ";
        }


        $query .= "ORDER BY deposit_date ASC";
        $query_exe = DB::select($query);

        $deposits = $this->arrayPaginator($query_exe, $request);

        return response()->json([
            'notices' => $deposits,
            'view' => View::make('superadmin.deposit.include.include_table', compact('deposits'))->render(),
            'pagination' => (string)$deposits->links()
        ]);


    }


    public function billing_deposit_apply($id)
    {
        $deposit = deposit::where('id', $id)
            ->where('admin_id', $this->admin_id)
            ->first();

        $dep_apply_id = $id;

        return view('superadmin.deposit.depositApply', compact('deposit', 'dep_apply_id'));
    }


    public function billing_deposit_apply_show_adj_pay_total(Request $request)
    {

        $deposit = deposit_apply::where('deopsit_id', $request->dep_id_show)
            ->where('client_id', $request->client_id)
            ->where('admin_id', $this->admin_id)
            ->sum('payment');
        $deposit2 = deposit_apply::where('deopsit_id', $request->dep_id_show)
            ->where('client_id', $request->client_id)
            ->where('admin_id', $this->admin_id)
            ->sum('adjustment');
        $pay = $deposit;
        $adj = $deposit2;

        return response()->json([
            'payment' => $pay,
            'adjustment' => $adj,
        ]);

    }


    public function billing_deposit_apply_get_data(Request $request)
    {
        $postby = $request->post_by_deposit;
        $claim_number = $request->claim_number;
        $client = $request->client_id;
        $date_range = $request->date_range;
        $deopsit_id = $request->deopsit_id;

        $date_one = Carbon::parse(substr($date_range, 0, 10))->format('Y-m-d');
        $date_two = Carbon::parse(substr($date_range, 13, 23))->format('Y-m-d');
        $include_closed = $request->include_closed;


        //get deposit id
        $exists_distinct = deposit_apply::distinct()->select('deopsit_id')
            ->where('admin_id', $this->admin_id)
            ->where('client_id', $client)
            ->where('deopsit_id', '!=', $deopsit_id)
            ->orderBy('deopsit_id', 'desc')
            ->first();

        //get all batch data
        $claim_array = [];
        if ($postby == 1) {

            // $manage_claim = manage_claim_transaction::select('admin_id', 'claim_id', 'baching_id')->where('claim_id', $claim_number)
            //     ->where('admin_id', $this->admin_id)
            //     ->get();

            // foreach ($manage_claim as $mng_clm) {
            //     array_push($claim_array, $mng_clm->baching_id);
            // }


            // $baching_claims = Batching_claim::whereIn('id', $claim_array)   
            //     ->where('is_mark_gen', 1)
            //     ->where('admin_id', $this->admin_id)
            //     ->get();


            $manage_claim = manage_claim_transaction::select('id','admin_id', 'claim_id', 'baching_id','client_id','appointment_id')->where('claim_id', $claim_number)
                ->where('admin_id', $this->admin_id)
                ->get();
            // Log::info('Claim number is: '.$claim_number);
            // Log::info($manage_claim);

            foreach ($manage_claim as $mng_clm) {

                $b_claim = Batching_claim::select('id','admin_id','client_id','appointment_id','cpt')->where('admin_id',$this->admin_id)->where('client_id',$mng_clm->client_id)->where('appointment_id',$mng_clm->appointment_id)->get();
                foreach($b_claim as $b_c){
                    array_push($claim_array, $b_c->id);
                }
            }

            // Log::info($claim_array);

            $baching_claims = Batching_claim::whereIn('id', $claim_array)   
                ->where('is_mark_gen', 1)
                ->where('admin_id', $this->admin_id)
                ->get();
            // Log::info($baching_claims);

        } else {
            $baching_claims = Batching_claim::where('client_id', $client)
                ->where('is_mark_gen', 1)
                ->where('admin_id', $this->admin_id)
                ->whereBetween('schedule_date', [$date_one, $date_two])
                ->get();
            // Log::info($baching_claims);
        }


        //update deposit apply screeen
        foreach ($baching_claims as $batc_claim) {


            $exists_dep_apply = deposit_apply::where('batching_claim_id', $batc_claim->id)
                ->where('deopsit_id', $deopsit_id)
                ->where('admin_id', $this->admin_id)
                ->first();

            $check_has_sec = Client_authorization::select('id', 'client_id', 'is_primary')
                ->where('client_id', $batc_claim->client_id)
                ->where('is_primary', 2)
                ->where('admin_id', $this->admin_id)
                ->first();

            $amount = $batc_claim->units * $batc_claim->rate;
            if (!$exists_dep_apply) {


                $activity = Client_authorization_activity::where('id', $batc_claim->activity_id)
                    ->where('admin_id', $this->admin_id)
                    ->first();

                $new_dep_apply = new deposit_apply();
                $new_dep_apply->admin_id = $this->admin_id;
                $new_dep_apply->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_dep_apply->deopsit_id = $deopsit_id;
                $new_dep_apply->batching_claim_id = $batc_claim->id;
                $new_dep_apply->appointment_id = $batc_claim->appointment_id;
                $new_dep_apply->client_id = $batc_claim->client_id;

                $new_dep_apply->provider_id = $batc_claim->provider_id;

                $new_dep_apply->authorization_id = $batc_claim->authorization_id;
                $new_dep_apply->activity_id = $batc_claim->activity_id;
                $new_dep_apply->payor_id = $batc_claim->payor_id;
                $new_dep_apply->dos = $batc_claim->schedule_date;
                $new_dep_apply->units = $batc_claim->units;
                $new_dep_apply->cpt = $batc_claim->cpt;
                $new_dep_apply->m1 = $batc_claim->m1;
                $new_dep_apply->m2 = $batc_claim->m2;
                $new_dep_apply->m3 = $batc_claim->m3;
                $new_dep_apply->m4 = $batc_claim->m4;
                $new_dep_apply->m5 = null;
                $new_dep_apply->amount = $batc_claim->billed_am;
                $new_dep_apply->payment = null;
                $new_dep_apply->adjustment = null;
                $new_dep_apply->balance = $batc_claim->billed_am;
                $new_dep_apply->reason = "Contractual Adj";
                $new_dep_apply->status = "Open";
                $new_dep_apply->see_payor = $batc_claim->units_value_calc;
                $new_dep_apply->provider_24j = $batc_claim->cms_24j;
                $new_dep_apply->billed_am = $batc_claim->billed_am;

                $new_dep_apply->id_qualifier = $batc_claim->id_qualifier;
                $new_dep_apply->degree_level = $batc_claim->degree_level;
                $new_dep_apply->zone = $batc_claim->zone;
                $new_dep_apply->location = $batc_claim->location;
                $new_dep_apply->units_value_calc = $batc_claim->units_value_calc;

                if ($check_has_sec) {
                    $new_dep_apply->has_seceondary = $check_has_sec->id;
                } else {
                    $new_dep_apply->has_seceondary = 0;
                }
                $new_dep_apply->has_claim_id = 0;
                $new_dep_apply->save();


                $check_exists_dep_apply = deposit_apply::where('batching_claim_id', $batc_claim->id)
                    ->where('deopsit_id', $deopsit_id)
                    ->where('admin_id', $this->admin_id)
                    ->first();


                if ($exists_distinct && $check_exists_dep_apply) {

                    $data = deposit_apply::where('deopsit_id', $exists_distinct->deopsit_id)
                        ->where('batching_claim_id', $batc_claim->id)
                        ->where('admin_id', $this->admin_id)
                        ->first();

                    $update_dep_apply = deposit_apply::where('id', $check_exists_dep_apply->id)->first();
                    if ($data && $update_dep_apply) {
                        $update_dep_apply->admin_id = $this->admin_id;
                        $update_dep_apply->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                        $update_dep_apply->deopsit_id = $deopsit_id;
                        $update_dep_apply->batching_claim_id = $data->batching_claim_id;
                        $update_dep_apply->appointment_id = $data->appointment_id;
                        $update_dep_apply->client_id = $data->client_id;

                        $update_dep_apply->provider_id = $data->provider_id;

                        $update_dep_apply->authorization_id = $data->authorization_id;
                        $update_dep_apply->activity_id = $data->activity_id;
                        $update_dep_apply->payor_id = $data->payor_id;
                        $update_dep_apply->dos = $data->dos;
                        $update_dep_apply->units = $batc_claim->units;
                        $update_dep_apply->cpt = $data->cpt;
                        $update_dep_apply->m1 = $data->m1;
                        $update_dep_apply->m2 = $data->m2;
                        $update_dep_apply->m3 = $data->m3;
                        $update_dep_apply->m4 = $data->m4;
                        $update_dep_apply->m5 = null;
                        $update_dep_apply->amount = $batc_claim->billed_am;
                        $update_dep_apply->payment = null;
                        $update_dep_apply->adjustment = null;
                        if ($update_dep_apply->balance == 0.00 || $update_dep_apply->balance == null || $update_dep_apply->balance == '') {
                            $update_dep_apply->balance = $batc_claim->billed_am;
                        } else {
                            $update_dep_apply->balance = $data->balance;
                        }

                        $update_dep_apply->reason = $data->reason;
                       // $update_dep_apply->status = 'Open';
                        $update_dep_apply->status = $data->status;
                        $update_dep_apply->see_payor = $data->see_payor;
                        $update_dep_apply->provider_24j = $data->provider_24j;
                        $update_dep_apply->billed_am = $data->billed_am;

                        $update_dep_apply->id_qualifier = $data->id_qualifier;
                        $update_dep_apply->degree_level = $data->degree_level;
                        $update_dep_apply->zone = $data->zone;
                        $update_dep_apply->location = $data->location;
                        $update_dep_apply->units_value_calc = $data->units_value_calc;

                        $update_dep_apply->has_seceondary = $data->has_seceondary;
                        $update_dep_apply->has_claim_id = $data->has_claim_id;
                        $update_dep_apply->save();
                    }

                }
            } else {
                if ($check_has_sec) {
                    $exists_dep_apply->has_seceondary = $check_has_sec->id;
                } else {
                    $exists_dep_apply->has_seceondary = 0;
                }

                if ($exists_dep_apply->status_apply != 1) {
                    if ($exists_dep_apply->balance == 0.00 || $exists_dep_apply->balance == null || $exists_dep_apply->balance == '') {
                        $exists_dep_apply->balance = $batc_claim->billed_am;
                    } else if ($exists_dep_apply->payment == null && $exists_dep_apply->adjustment == null) {
                        $exists_dep_apply->balance = $batc_claim->billed_am;
                       // $exists_dep_apply->balance = $exists_dep_apply->balance;
                    }
                }
                $exists_dep_apply->amount = $batc_claim->billed_am;
                $exists_dep_apply->units = $batc_claim->units;

                $exists_dep_apply->save();

            }

        }

        $admin_id = $this->admin_id;


        if (isset($include_closed) && $include_closed == 1) {
            $query = "SELECT * FROM deposit_applies where deopsit_id =$deopsit_id AND admin_id=$admin_id ";

        } else {
            $query = "SELECT * FROM deposit_applies where deopsit_id =$deopsit_id AND status!='Closed' AND admin_id=$admin_id ";

        }

        if (empty($client_id) && empty($date_one) && empty($date_two)) {
            $query_exe = DB::select($query);
        }

        if (isset($postby) && $postby == 1) {
            $claim_filter = implode("','", $claim_array);
            $query .= "AND batching_claim_id IN('" . $claim_filter . "') ";
        }

        if ($postby == 2 && isset($client)) {
            $query .= "AND client_id = $client ";

        }


        if ($postby == 2 && isset($date_one) && isset($date_two)) {
            $query .= "AND dos >= '$date_one' ";
            $query .= "AND dos <= '$date_two'  ";
        }


        $query .= "ORDER BY dos DESC";
        $deposits_apllys = DB::select($query);

        $deposits_apllys = $this->arrayPaginator2($deposits_apllys, $request);

        return response()->json([
            'notices' => $deposits_apllys,
            'pagination' => (string)$deposits_apllys->links(),
            'view' => View::make('superadmin.deposit.include.apply_include_table', compact('deposits_apllys'))->render(),
        ]);


    }

    public function billing_deposit_apply_get_save(Request $request)
    {
        $ids = $request->ids;
        $data = $request->all();


        for ($i = 0; $i < count($data['ids']); $i++) {


            $apply_claim = deposit_apply::where('id', $request['ids'][$i])
                ->where('admin_id', $this->admin_id)
                ->first();

            $am = isset($request['Updated_balance'][$i]) ? isset($request['Updated_balance'][$i]) : 0;
            $pa = isset($request['payment'][$i]) ? isset($request['payment'][$i]) : 0;
            $adj = isset($request['adjuestment'][$i]) ? isset($request['adjuestment'][$i]) : 0;


            $apply_claim->payment = ($apply_claim->payment + isset($request['payment'][$i]) ? $request['payment'][$i] : 0.00);
            $apply_claim->adjustment = ($apply_claim->adjustment + isset($request['adjuestment'][$i]) ? $request['adjuestment'][$i] : 0.00);
            $apply_claim->balance = isset($request['Updated_balance'][$i]) ? $request['Updated_balance'][$i] : 0.00;
            $apply_claim->reason = isset($request['resaon_data'][$i]) ? $request['resaon_data'][$i] : null;
            $apply_claim->status = isset($request['status'][$i]) ? $request['status'][$i] : null;
            $apply_claim->status_apply = 1;
            $apply_claim->sec_submited = isset($request['status'][$i]) && $request['status'][$i] == 'Secondary Responsibility' ? 1 : 0;
            $apply_claim->save();


            $dep = deposit::where('id', $apply_claim->deopsit_id)->first();

            if ($dep->payor_type == 1) {
                $client_name = Client::where('id', $dep->client_id)->first();
                $who_paid = $client_name->client_full_name;
            } else {
                $payor_name = All_payor::where('id', $dep->payor_id)->first();
                if ($payor_name) {
                    $who_paid = $payor_name->payor_name;
                } else {
                    $who_paid = '';
                }

            }

            if ($dep->status_apply != 1) {
                $new_dep_transaction = new deposit_apply_transaction();
                $new_dep_transaction->admin_id = $this->admin_id;
                $new_dep_transaction->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_dep_transaction->deposit_apply_id = $apply_claim->id;
                $new_dep_transaction->batching_claim_id = $apply_claim->batching_claim_id;
                $new_dep_transaction->appointment_id = $apply_claim->appointment_id;
                $new_dep_transaction->client_id = $apply_claim->client_id;
                $new_dep_transaction->authorization_id = $apply_claim->authorization_id;
                $new_dep_transaction->activity_id = $apply_claim->activity_id;
                $new_dep_transaction->payor_id = $apply_claim->payor_id;
                $new_dep_transaction->dos = $apply_claim->dos;
                $new_dep_transaction->units = $apply_claim->units;
                $new_dep_transaction->cpt = $apply_claim->cpt;
                $new_dep_transaction->instrument = $dep->instrument;
                $new_dep_transaction->code = $apply_claim->cpt;
                $new_dep_transaction->m1 = $apply_claim->m1;
                $new_dep_transaction->m5 = $apply_claim->m5;
                $new_dep_transaction->amount = $apply_claim->amount;
                $new_dep_transaction->payment = $apply_claim->payment;
                $new_dep_transaction->adjustment = $apply_claim->adjustment;
                $new_dep_transaction->balance = $apply_claim->balance;
                $new_dep_transaction->reason = $apply_claim->reason;
                $new_dep_transaction->status = $apply_claim->status;
                $new_dep_transaction->m2 = $apply_claim->m2;
                $new_dep_transaction->m3 = $apply_claim->m3;
                $new_dep_transaction->m4 = $apply_claim->m4;
                $new_dep_transaction->who_paid = $who_paid;
                $new_dep_transaction->instrument_no = $dep->instrument;
                $new_dep_transaction->has_seceondary = $apply_claim->has_seceondary;
                $new_dep_transaction->save();
            }

        }


    }


    public function billing_deposit_apply_transaction_get(Request $request)
    {
        $ids = $request->trs_ids;
        $dep_client_id = $request->dep_client_id;
        $include_closed = $request->include_closed;
        $dep_apply_id = $request->dep_apply_id;

        $dates = [];

        $appys = deposit_apply::distinct()->select('dos', 'id')
            ->whereIn('id', $ids)
            ->where('admin_id', $this->admin_id)
            ->get();

        foreach ($appys as $ap) {
            array_push($dates, $ap->id);
        }

        $admin_id = $this->admin_id;
        $query = "SELECT * FROM deposit_apply_transactions WHERE admin_id=$admin_id ";


        if (isset($dep_client_id)) {
            $query .= "AND client_id=$dep_client_id ";
        }

        if (isset($dates)) {
            $surface_filter = implode("','", $dates);
            $query .= "AND deposit_apply_id IN('" . $surface_filter . "')  ";

        }

        $query .= "ORDER BY dos ASC";
        $deposits_apllys_trans = DB::select($query);

        return response()->json([
            'notices' => $deposits_apllys_trans,
            'view' => View::make('superadmin.deposit.include.apply_include_transaction', compact('deposits_apllys_trans'))->render(),
        ]);

    }


    public function billing_deposit_apply_show_all_client(Request $request)
    {
        $clients = Client::where('admin_id', $this->admin_id)->orderBy('client_full_name','asc')->get();
        return $clients;
    }


    public function billing_deposit_apply_show_payor_client(Request $request)
    {
        $cl_id = [];

        $batc_clm = deposit_apply::distinct()->select('client_id')
            ->where('deopsit_id', $request->deopsit_id)
            ->where('admin_id', $this->admin_id)
            ->get();
        foreach ($batc_clm as $bclm) {
            array_push($cl_id, $bclm->client_id);
        }

        $all_claint = Client::whereIn('id', $cl_id)
            ->where('admin_id', $this->admin_id)
            ->orderBy('client_full_name','asc')
            ->get();

        return $all_claint;


    }


    public function billing_data_revert(Request $request)
    {
        $d_ids = $request->d_id;

        $deposit_applyies = deposit_apply::whereIn('id', $d_ids)
            ->where('admin_id', $this->admin_id)
            ->get();
        foreach ($deposit_applyies as $depapply) {

            $bact_claim = Batching_claim::where('id', $depapply->batching_claim_id)
                ->where('admin_id', $this->admin_id)
                ->first();
            $dep_ap = deposit_apply::where('id', $depapply->id)
                ->where('admin_id', $this->admin_id)
                ->first();

            $dep_data = deposit::where('id', $depapply->deopsit_id)
                ->where('admin_id', $this->admin_id)
                ->first();

            if ($bact_claim) {
                $activity = Client_authorization_activity::where('id', $bact_claim->activity_id)
                    ->where('admin_id', $this->admin_id)
                    ->first();

                if ($activity) {
                    $amount = $bact_claim->units_value_calc * $activity->rate;
                } else {
                    $amount = $bact_claim->units_value_calc * 0;
                }

                $dep_ap->batching_claim_id = $bact_claim->id;
                $dep_ap->client_id = $bact_claim->client_id;
                $dep_ap->activity_id = $bact_claim->activity_id;
                $dep_ap->payor_id = $bact_claim->payor_id;
                $dep_ap->dos = $bact_claim->schedule_date;
                $dep_ap->units = $bact_claim->units_value_calc;
                $dep_ap->cpt = $bact_claim->cpt;
                $dep_ap->m1 = $bact_claim->m1;
                $dep_ap->m2 = $bact_claim->m2;
                $dep_ap->m3 = $bact_claim->m3;
                $dep_ap->m4 = $bact_claim->m4;
                $dep_ap->m5 = null;
                $dep_ap->amount = $amount;
                $dep_ap->payment = null;
                $dep_ap->adjustment = null;
                $dep_ap->balance = $amount;
                $dep_ap->reason = "Contractual Adj";
                $dep_ap->status = "Open";
                $dep_ap->see_payor = $bact_claim->units_value_calc;
                $dep_ap->provider_24j = $bact_claim->cms_24j;
                $dep_ap->status_apply = null;
                $dep_ap->save();


                $deposit_applyies_tran = deposit_apply_transaction::where('admin_id', $this->admin_id)->where('deposit_apply_id', $dep_ap->id)->first();

                if ($deposit_applyies_tran) {
                    $deposit_applyies_tran->delete();
                }
            }
        }


    }


    public function billing_deposit_details(Request $request)
    {
        $dep_id = $request->dep_id;
        $admin_id = $this->admin_id;
        $deposits_details = deposit_apply::where('admin_id', $this->admin_id)->whereIn('deopsit_id', $dep_id)->where('status_apply', 1)->get();

        return response()->json([
            'notices' => $deposits_details,
            'view' => View::make('superadmin.deposit.include.deposit_details_table', compact('deposits_details'))->render(),
        ]);

    }


    public function billing_deposit_view_details($id)
    {
        $all_payor = All_payor::orderBy('payor_name','asc')->get();
        $all_client = Client::where('admin_id', $this->admin_id)->orderBy('client_full_name','asc')->get();
        $dep = deposit::where('id', $id)->where('admin_id', $this->admin_id)->first();
        return view('superadmin.deposit.depositViewDeails', compact('all_payor', 'all_client', 'dep'));
    }


    public function billing_deposit_view_details_arledger(Request $request)
    {
        $admin_id = $this->admin_id;
        $dep_id = $request->dep_id;


        $array = [];
        $dep_app = deposit_apply::select('id', 'admin_id')->where('admin_id', $this->admin_id)->where('deopsit_id', $dep_id)->get();

        foreach ($dep_app as $dep_d) {
            array_push($array, $dep_d->id);
        }


        $query = "SELECT * FROM deposit_apply_transactions WHERE admin_id=$admin_id ";

        $size_filter = implode("','", $array);
        $query .= "AND deposit_apply_id IN('" . $size_filter . "')";

        $query .= "ORDER BY dos ASC";
        $deposits = DB::select($query);

        return response()->json([
            'notices' => $deposits,
            'view' => View::make('superadmin.deposit.include.deposit_trasaction_arledger', compact('deposits'))->render(),
        ]);

    }


    public function billing_deposit_receipt($id)
    {

        $pdf = new MYPDF();
        $pdf->AddPage();
        $pdf->SetFont('', '', 8);
        $pdf->SetDrawColor(0, 32, 96);

//Height of row
        $w = 7;


//Calling table heading
        $pdf->SetFillColor(0, 32, 96);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(20, $w, 'Payment Date', 1, 0, 'C', true);
        $pdf->Cell(48, $w, 'Patient Name', 1, 0, 'L', true);
        $pdf->Cell(100, $w, 'Description', 1, 0, 'L', true);
        $pdf->Cell(22, $w, 'Amount Paid', 1, 1, 'C', true);


        $array = [];
        $dep_apply = deposit_apply::select('id', 'admin_id', 'deopsit_id')
            ->where('admin_id', $this->admin_id)
            ->where('deopsit_id', $id)
            ->get();
        foreach ($dep_apply as $deap) {
            array_push($array, $deap->id);
        }

        $dep_apply_trans = deposit_apply_transaction::whereIn('deposit_apply_id', $array)->where('admin_id', $this->admin_id)->get();
        $depo_data = deposit::where('id', $id)->first();

        $payment_dat = Carbon::parse($depo_data->deposit_date)->format('m/d/Y');
        $payor_name = All_payor::select('id', 'payor_name')->where('id', $depo_data->payor_id)->first();


        $total_sum = deposit_apply_transaction::whereIn('deposit_apply_id', $array)->sum('payment');
        $uncam = $depo_data->amount - $total_sum;

        for ($i = 0; $i < count($dep_apply_trans); $i++) {
            $act_name = Client_authorization_activity::select('id', 'activity_name')->where('id', $dep_apply_trans[$i]['activity_id'])->first();
            $cl = Client::select('client_full_name')->where('id',$dep_apply_trans[$i]['client_id'])->first();
            if($cl){
                $cl_name=$cl->client_full_name;
            }
            else{
                $cl_name = '';
            }
            $y = $pdf->GetY();
            $y = floor($y);
            $y = $y + $w;

            //Checking for page break and applying table header on every page.
            if ($y >= 290) {
                $pdf->AddPage('P');
                $pdf->SetFillColor(0, 32, 96);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->Cell(20, $w, 'Payment Date', 1, 0, 'C', true);
                $pdf->Cell(48, $w, 'Patient Name', 1, 0, 'L', true);
                $pdf->Cell(100, $w, 'Description', 1, 0, 'L', true);
                $pdf->Cell(22, $w, 'Amount Paid', 1, 1, 'C', true);
            }
            //Main data row
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(20, $w, $payment_dat, 1, 0, 'L');
            $pdf->Cell(48, $w, $cl_name, 1, 0, 'L');
            $pdf->Cell(100, $w, isset($act_name) ? $act_name->activity_name : '', 1, 0, 'L');
            $pdf->Cell(22, $w, '$' . $dep_apply_trans[$i]['payment'], 1, 1, 'R');
        }

        $pdf->SetFillColor(0, 32, 96);
        $pdf->SetFont('', 'B', 9);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(110, 7, 'Total', 1, 0, '', 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(58, 7, 'Credit Balance : ' . '$' . number_format($uncam, 2), 1, 0, 'R', 1);
        $pdf->Cell(22, 7, '$' . number_format($total_sum, 2), 1, 0, 'R', 1);


        $pdf->Output();


    }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }

    public function arrayPaginator2($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 20;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


}
