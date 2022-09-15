<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\Client;
use App\Models\Client_authorization_activity;
use App\Models\deposit;
use App\Models\deposit_apply;
use App\Models\deposit_apply_transaction;
use App\Models\general_setting;
use App\Models\invoice_number;
use App\Models\patient_statement;
use App\Models\Payor_facility;
use App\Models\setting_name_location;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatementMail;
use Illuminate\Support\Str;
use PDF;

class SuperAdminBillingStatementController extends Controller
{

    protected $admin_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->is_up_admin==1){
                $this->admin_id=Auth::user()->id;
            }
            else{
                $this->admin_id=Auth::user()->up_admin_id;
            }
            return $next($request);
        });
    }


    public function billing_statement()
    {
        // $array = [];
        // $c_dis = deposit_apply::distinct()->select('client_id')->where('admin_id', $this->admin_id)->get();
        // foreach ($c_dis as $cid) {
        //     array_push($array, $cid->client_id);
        // }

        // $dep_appyois = Client::whereIn('id', $array)->where('admin_id', $this->admin_id)->paginate(10);
        $clients = Client::where('admin_id', $this->admin_id)->orderBy('client_full_name','asc')->get();
        $payors = Payor_facility::where('admin_id', $this->admin_id)->orderBy('payor_name','asc')->get();
        return view('superadmin.statement.statement', compact('clients', 'payors'));
    }


    public function billing_statement_get_data_all(Request $request)
    {

        $admin_id = $this->admin_id;
        $query = "SELECT distinct client_id FROM patient_statements WHERE admin_id=$admin_id ";
        $query_exe = DB::select($query);

        $statements = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $statements,
            'view' => View::make('superadmin.statement.include.statementTable', compact('statements'))->render(),
            'pagination' => (string)$statements->links()
        ]);
    }


    public function billing_statement_get_data_all_filter(Request $request)
    {

        $admin_id = $this->admin_id;
        $query = "SELECT distinct client_id FROM patient_statements WHERE admin_id=$admin_id ";
        $query_exe = DB::select($query);

        $statements = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $statements,
            'view' => View::make('superadmin.statement.include.statementTable', compact('statements'))->render(),
            'pagination' => (string)$statements->links()
        ]);
    }


    public function billing_statement_get_data(Request $request)
    {
        $type = $request->check;
        $client_arr=$request->client_arr;
        $payor_arr=$request->payor_arr;
        $date=$request->date;
        $from_date = Carbon::parse(substr($date, 0, 10))->format('Y-m-d');
        $to_date = Carbon::parse(substr($date, 13, 23))->format('Y-m-d');

        $data = deposit_apply_transaction::where('admin_id', $this->admin_id);
        if($type==2){
            $data=$data->whereIn('client_id',$client_arr);
        }
        if($type==3){
            $data=$data->whereIn('payor_id',$payor_arr);
        }
        $data=$data->where('dos','>=',$from_date)->where('dos','<=',$to_date);
        $data=$data->where(function($query){
            $query->where('status', 'PR CoIns')->orWhere('status', 'PR Copay')->orWhere('status', 'PR Ded');
        })->get();


        $dep_app_ids=array();

        foreach ($data as $dep_data) {
            
            $check=deposit_apply_transaction::where('appointment_id',$dep_data->appointment_id)->where('admin_id',$this->admin_id)->orderBy('id','desc')->first();
            if($check->status=="PR CoIns" || $check->status=="PR Copay" || $check->status=="PR Ded"){
                array_push($dep_app_ids,$dep_data->id);
                $check_exists = patient_statement::select('id','deposit_apply_id', 'client_id')
                ->where('deposit_apply_id', $dep_data->id)
                ->where('client_id', $dep_data->client_id)
                ->where('admin_id', $this->admin_id)
                ->first();

                if (!$check_exists) {
                    $new_statement = new patient_statement();
                    $new_statement->admin_id = $this->admin_id;
                    $new_statement->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                    $new_statement->dep_id = $dep_data->deposit_apply_id;
                    $new_statement->deposit_apply_id = $dep_data->id;
                    $new_statement->client_id = $dep_data->client_id;
                    $new_statement->service_date = $dep_data->dos;
                    $new_statement->activity_id = $dep_data->activity_id;
                    $new_statement->co_pay = $dep_data->status == "PR Copay" ? $dep_data->balance : 0.00;
                    $new_statement->coins = $dep_data->status == "PR CoIns" ? $dep_data->balance : 0.00;
                    $new_statement->ded = $dep_data->status == "PR Ded" ? $dep_data->balance : 0.00;
                    $new_statement->status = $dep_data->status;
                    $new_statement->is_paid = 0;
                    $new_statement->save();
                }
                else{
                    $update_statement = patient_statement::where('id',$check_exists->id)->first();
                    $update_statement->admin_id = $this->admin_id;
                    $update_statement->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                    $update_statement->dep_id = $dep_data->deposit_apply_id;
                    $update_statement->deposit_apply_id = $dep_data->id;
                    $update_statement->client_id = $dep_data->client_id;
                    $update_statement->service_date = $dep_data->dos;
                    $update_statement->activity_id = $dep_data->activity_id;
                    $update_statement->co_pay = $dep_data->status == "PR Copay" ? $dep_data->balance : 0.00;
                    $update_statement->coins = $dep_data->status == "PR CoIns" ? $dep_data->balance : 0.00;
                    $update_statement->ded = $dep_data->status == "PR Ded" ? $dep_data->balance : 0.00;
                    $update_statement->status = $dep_data->status;
                    $update_statement->is_paid = 0;
                    $update_statement->save();
                }
            }



        }

        $admin_id=$this->admin_id;
        
        $query = "SELECT distinct patient_statements.client_id, clients.client_full_name FROM patient_statements JOIN clients ON patient_statements.client_id = clients.id WHERE patient_statements.admin_id=$admin_id ";
        
        if(count($dep_app_ids)>0){
            $dep_app_idds = implode("','", $dep_app_ids);
            $query .= "AND patient_statements.deposit_apply_id IN('" . $dep_app_idds . "') ";
        }

        if($type == 2){
            if(count($client_arr)>0){
                $clients = implode("','", $client_arr);
                $query .= "AND patient_statements.client_id IN('" . $clients . "') ";
            }
        }

        $query.="ORDER BY clients.client_full_name ASC";

        $query_exe = DB::select($query);
        // $statements = $this->arrayPaginator($query_exe, $request);
        $statements = $query_exe;
        return response()->json([
            'notices' => $statements,
            'view' => View::make('superadmin.statement.include.statementTable', compact('statements','dep_app_ids','from_date','to_date','client_arr','payor_arr'))->render(),
        ]);

    }


    public function billing_statement_get_data_filter(Request $request)
    {
        
        $type = $request->check;
        $client_arr=$request->client_arr;
        $payor_arr=$request->payor_arr;
        $date=$request->date;
        $from_date = Carbon::parse(substr($date, 0, 10))->format('Y-m-d');
        $to_date = Carbon::parse(substr($date, 13, 23))->format('Y-m-d');

        $data = deposit_apply_transaction::where('admin_id', $this->admin_id);
        if($type==2){
            if(sizeof($client_arr)>0){
                $data=$data->whereIn('client_id',$client_arr);
            }
        }
        if($type==3){
            if(sizeof($payor_arr)>0){
                $data=$data->whereIn('payor_id',$payor_arr);
            }
        }
        $data=$data->where('dos','>=',$from_date)->where('dos','<=',$to_date);
        $data=$data->where(function($query){
            $query->where('status', 'PR CoIns')->orWhere('status', 'PR Copay')->orWhere('status', 'PR Ded');
        })->get();


        $dep_app_ids=[];

        foreach ($data as $dep_data) {
            
            $check=deposit_apply_transaction::where('appointment_id',$dep_data->appointment_id)->where('admin_id',$this->admin_id)->orderBy('id','desc')->first();
            if($check->status=="PR CoIns" || $check->status=="PR Copay" || $check->status=="PR Ded"){
                array_push($dep_app_ids,$dep_data->id);
                $check_exists = patient_statement::select('id','deposit_apply_id', 'client_id')
                ->where('deposit_apply_id', $dep_data->id)
                ->where('client_id', $dep_data->client_id)
                ->where('admin_id', $this->admin_id)
                ->first();

                if (!$check_exists) {
                    $new_statement = new patient_statement();
                    $new_statement->admin_id = $this->admin_id;
                    $new_statement->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                    $new_statement->dep_id = $dep_data->deposit_apply_id;
                    $new_statement->deposit_apply_id = $dep_data->id;
                    $new_statement->client_id = $dep_data->client_id;
                    $new_statement->service_date = $dep_data->dos;
                    $new_statement->activity_id = $dep_data->activity_id;
                    $new_statement->co_pay = $dep_data->status == "PR Copay" ? $dep_data->balance : 0.00;
                    $new_statement->coins = $dep_data->status == "PR CoIns" ? $dep_data->balance : 0.00;
                    $new_statement->ded = $dep_data->status == "PR Ded" ? $dep_data->balance : 0.00;
                    $new_statement->status = $dep_data->status;
                    $new_statement->is_paid = 0;
                    $new_statement->save();
                }
                else{
                    $update_statement = patient_statement::where('id',$check_exists->id)->first();
                    $update_statement->admin_id = $this->admin_id;
                    $update_statement->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                    $update_statement->dep_id = $dep_data->deposit_apply_id;
                    $update_statement->deposit_apply_id = $dep_data->id;
                    $update_statement->client_id = $dep_data->client_id;
                    $update_statement->service_date = $dep_data->dos;
                    $update_statement->activity_id = $dep_data->activity_id;
                    $update_statement->co_pay = $dep_data->status == "PR Copay" ? $dep_data->balance : 0.00;
                    $update_statement->coins = $dep_data->status == "PR CoIns" ? $dep_data->balance : 0.00;
                    $update_statement->ded = $dep_data->status == "PR Ded" ? $dep_data->balance : 0.00;
                    $update_statement->status = $dep_data->status;
                    $update_statement->is_paid = 0;
                    $update_statement->save();
                }
            }



        }


        // $query_exe=patient_statement::select('client_id')->distinct()->where('admin_id',$this->admin_id)->whereIn('deposit_apply_id',$dep_app_ids)->get();
        $admin_id=$this->admin_id;
        
        $query = "SELECT distinct client_id FROM patient_statements WHERE admin_id=$admin_id ";
        
        if(sizeof($dep_app_ids)>0){
            $dep_app_idds = implode("','", $dep_app_ids);
            $query .= "AND deposit_apply_id IN('" . $dep_app_idds . "') ";
        }

        $query_exe = DB::select($query);
        $statements = $query_exe;
        return response()->json([
            'notices' => $statements,
            'view' => View::make('superadmin.statement.include.statementTable', compact('statements','dep_app_ids','from_date','to_date','client_arr','payor_arr'))->render(),
            'pagination' => (string)$statements->links()
        ]);
    }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 15;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


    public function billing_statement_view()
    {
        return view('superadmin.statement.statementView');
    }


    public function billing_statement_view_pdf(Request $request)
    {
        $client_ids = json_decode($request->client_ids,true);
        $client_rec=json_decode($request->client_rec,true);

        if ($client_ids == null) {
            return back()->with('alert', 'Client Not Selected');
        }

        $logo = general_setting::where('admin_id', $this->admin_id)->first();
        if (!$logo) {
            return back()->with('alert', 'Please Upload Logo');
            exit();
        }

        if (empty($logo->logo) && !file_exists($logo->logo)) {
            return back()->with('alert', 'Please Upload Logo');
            exit();
        }


        $logo_image = $logo->logo;

        $exists_inv = invoice_number::orderBy('id', 'desc')->first();
        if ($exists_inv) {

            $exists_inv->inv_number = $exists_inv->inv_number + 1;
            $exists_inv->save();
            $invoice_num = $exists_inv->inv_number;
        } else {
            $new_inv = new invoice_number();
            $new_inv->inv_number = "0001";
            $new_inv->save();
            $invoice_num = $new_inv->inv_number;
        }


        $client_dis = deposit_apply::distinct()->select('client_id')->whereIn('client_id', $client_ids)->get();

        $data = [
            "client_rec" => $client_rec,
            "logo_image" => $logo_image,
            "invoice_num" => $invoice_num,
            "client_dis" => $client_dis
        ];

        $pdf = $this->print_invoice_pdf($data,2);
        $pdf->Output();
    }



    public function billing_statement_save_pdf(Request $request){
        $client_ids = $request->client_ids;
        $client_rec = $request->client_rec;

        if ($client_ids == null) {
            return [
                "status" => "client_error"
            ];
        }

        $logo = general_setting::where('admin_id', $this->admin_id)->first();
        if (!$logo) {
            return [
                "status" => "logo_error"
            ];
        }

        if (empty($logo->logo) && !file_exists($logo->logo)) {
            return [
                "status" => "logo_error"
            ];
        }


        $logo_image = $logo->logo;

        $exists_inv = invoice_number::orderBy('id', 'desc')->first();
        if ($exists_inv) {
            $exists_inv->inv_number = $exists_inv->inv_number + 1;
            $exists_inv->save();
            $invoice_num = $exists_inv->inv_number;
        } else {
            $new_inv = new invoice_number();
            $new_inv->inv_number = "0001";
            $new_inv->save();
            $invoice_num = $new_inv->inv_number;
        }


        $client_dis = deposit_apply::distinct()->select('client_id')->whereIn('client_id', $client_ids)->get();

        $data = [
            "client_rec" => $client_rec,
            "logo_image" => $logo_image,
            "invoice_num" => $invoice_num,
            "client_dis" => $client_dis
        ];

        $pdf = $this->print_invoice_pdf($data,2);
        $client_name = Client::select('id','admin_id','client_first_name')->where('id',$client_ids[0])->where('admin_id',$this->admin_id)->first();
        $file_name = 'PatientStatement_'.time().'.pdf';
        if($client_name){
            $file_name = $client_name->client_first_name.'_'.time().'.pdf';
        }

        $path = public_path('statements/').$file_name;

        $pdf->Output($path,'F');


        return [
            "status" => "success",
            "file_name" => $file_name,
        ];
    }


    private function print_invoice_pdf($data,$no_cc){

        $client_rec = $data["client_rec"];
        $logo_image = $data["logo_image"];
        $invoice_num = $data["invoice_num"];
        $client_dis = $data["client_dis"];

        $pdf = new Fpdf();
        foreach ($client_dis as $client_data) {
            $key="client".$client_data->client_id;
            $dep_apply_check_value=$client_rec[$key];
            $client = Client::select('id', 'client_full_name', 'client_street', 'client_city', 'client_state', 'client_zip')->where('id', $client_data->client_id)->first();
            $v1 = "PR CoIns";
            $v2 = "PR Copay";
            $v3 = "PR Ded";
            $transactions = deposit_apply::select('activity_id', 'dos', 'status', 'balance')->where('client_id', $client_data->client_id)->where(function ($query) use ($v1, $v2, $v3) {
                $query->where('status', '=', $v1);
                $query->orWhere('status', '=', $v2);
                $query->orWhere('status', '=', $v3);
            })->get();


            $date1 = deposit_apply::select('dos')->where('client_id', $client_data->client_id)->where(function ($query) use ($v1, $v2, $v3) {
                $query->where('status', '=', $v1);
                $query->orWhere('status', '=', $v2);
                $query->orWhere('status', '=', $v3);
            })->orderBy('id', 'asc')->first();

            $date2 = deposit_apply::select('dos')->where('client_id', $client_data->client_id)->where(function ($query) use ($v1, $v2, $v3) {
                $query->where('status', '=', $v1);
                $query->orWhere('status', '=', $v2);
                $query->orWhere('status', '=', $v3);
            })->orderBy('id', 'desc')->first();


            if ($dep_apply_check_value == null) {
                $coypay_sum = deposit_apply::select('balance')->where('client_id', $client_data->client_id)->where('status', "PR Copay")->sum('balance');
                $pr_cpon_sum = deposit_apply::select('balance')->where('client_id', $client_data->client_id)->where('status', "PR CoIns")->sum('balance');
                $pr_ded_sum = deposit_apply::select('balance')->where('client_id', $client_data->client_id)->where('status', "PR Ded")->sum('balance');
                $total = ($coypay_sum + $pr_cpon_sum + $pr_ded_sum);
            } else {
                $coypay_sum = deposit_apply::select('balance')->whereIn('id', $dep_apply_check_value)->where('client_id', $client_data->client_id)->where('status', "PR Copay")->sum('balance');
                $pr_cpon_sum = deposit_apply::select('balance')->whereIn('id', $dep_apply_check_value)->where('client_id', $client_data->client_id)->where('status', "PR CoIns")->sum('balance');
                $pr_ded_sum = deposit_apply::select('balance')->whereIn('id', $dep_apply_check_value)->where('client_id', $client_data->client_id)->where('status', "PR Ded")->sum('balance');
                $total = ($coypay_sum + $pr_cpon_sum + $pr_ded_sum);
            }

            $seeting = setting_name_location::where('admin_id',$this->admin_id)->first();

            $last_client_deposit = deposit::select('deposit_date', 'amount')->where('client_id', $client_data->client_id)->orderBy('id', 'desc')->first();

            $pdf->AliasNbPages();

            $pdf->AddPage('P', 'Letter');
            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Image($logo_image, 146, 15, 60, 20);

            $pdf->SetY(15);
            if ($seeting) {
                $pdf->Cell(0, 5, $seeting->facility_name, 0, 1);
            } else {
                $pdf->Cell(0, 5, '', 0, 1);
            }
            if ($seeting) {
                $pdf->Cell(0, 5, $seeting->address, 0, 1);
            } else {
                $pdf->Cell(0, 5, '', 0, 1);
            }
            if ($seeting) {
                $pdf->Cell(0, 5, $seeting->city . ' ' . $seeting->state . ' ' . $seeting->zip, 0, 1);
            } else {
                $pdf->Cell(0, 5, '', 0, 1);
            }
            if ($seeting) {
                $pdf->Cell(0, 5, 'Phone: ' . $seeting->phone_one, 0, 1);
            } else {
                $pdf->Cell(0, 5, 'Phone: ', 0, 1);
            }


            $pdf->SetFillColor(8, 151, 175);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetXY(130, 50);
            $pdf->Cell(77, 8, 'Invoice#' . $invoice_num, 1, 1, 'L', true);

            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(120, 5, 'Bill To', 0, 0);
            $pdf->Cell(50, 5, 'Invoice Date', 1, 0);
            $pdf->Cell(27, 5, Carbon::now()->format('m/d/Y'), 1, 1);
            $pdf->Cell(120, 5, $client->client_full_name, 0, 0);
            $pdf->Cell(50, 5, 'Due Date', 1, 0);
            $pdf->Cell(27, 5, Carbon::now()->addDays(15)->format('m/d/Y'), 1, 1);
            $pdf->MultiCell(120, 5, $client->client_street . ' ' . $client->client_city . ' ' . $client->client_state . ' ' . $client->client_zip, 0, 1);
            $pdf->SetXY(130, 68);
            $pdf->Cell(50, 5, 'Last Paid Date', 1, 0);
            if ($last_client_deposit) {
                $pdf->Cell(27, 5, Carbon::parse($last_client_deposit->deposit_date)->format('m/d/Y'), 1, 1);
            } else {
                $pdf->Cell(27, 5, '', 1, 1);
            }

            $pdf->SetXY(130, 73);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(50, 5, 'Last Payment', 1, 0, 'L', true);
            if ($last_client_deposit) {
                $pdf->Cell(27, 5, '$' . $last_client_deposit->amount, 1, 1, 'L', true);
            } else {
                $pdf->Cell(27, 5, '$0.00', 1, 1, 'L', true);
            }

            $pdf->SetTextColor(255, 255, 255);


            $pdf->SetY(85);
            $pdf->Cell(30, 10, 'SERVICE DATE', 1, 0, 'C', true);
            $pdf->Cell(90, 10, 'DESCRIPTION', 1, 0, 'C', true);
            $pdf->Cell(77, 5, 'BALANCE', 1, 0, 'C', true);
            $pdf->SetXY(130, 90);
            $pdf->Cell(25, 5, 'COPAY', 1, 0, 'C', true);
            $pdf->Cell(25, 5, 'COINS', 1, 0, 'C', true);
            $pdf->Cell(27, 5, 'DEDUCTIBLE', 1, 1, 'C', true);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetTextColor(0, 0, 0);


            if ($dep_apply_check_value == null) {
                //without depo check id
                for ($i = 0; $i < count($transactions); $i++) {
                    $client_auth_act = Client_authorization_activity::select('activity_name')->where('id', $transactions[$i]['activity_id'])->first();
                    $pdf->Cell(30, 5, Carbon::parse($transactions[$i]['dos'])->format('m/d/Y'), 1, 0, 'C');
                    if ($client_auth_act) {
                        $pdf->Cell(90, 5, $client_auth_act->activity_name, 1, 0, 'C');
                    } else {
                        $pdf->Cell(90, 5, '', 1, 0, 'C');
                    }

                    if ($transactions[$i]['status'] == 'PR Copay') {
                        $pdf->Cell(25, 5, number_format($transactions[$i]['balance'], 2), 1, 0, 'C');
                    } else {
                        $pdf->Cell(25, 5, '0.00', 1, 0, 'C');
                    }

                    if ($transactions[$i]['status'] == 'PR CoIns') {
                        $pdf->Cell(25, 5, number_format($transactions[$i]['balance'], 2), 1, 0, 'C');
                    } else {
                        $pdf->Cell(25, 5, '0.00', 1, 0, 'C');
                    }


                    if ($transactions[$i]['status'] == 'PR Ded') {
                        $pdf->Cell(27, 5, number_format($transactions[$i]['balance'], 2), 1, 1, 'C');
                    } else {
                        $pdf->Cell(27, 5, '0.00', 1, 1, 'C');
                    }

                    if ($i == 30) {
                        $pdf->AddPage('P', 'Letter');
                        $pdf->SetTextColor(255, 255, 255);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(30, 10, 'SERVICE DATE', 1, 0, 'C', true);
                        $pdf->Cell(90, 10, 'DESCRIPTION', 1, 0, 'C', true);
                        $pdf->Cell(77, 5, 'BALANCE', 1, 0, 'C', true);
                        $y = $pdf->GetY();
                        $pdf->SetXY(130, $y + 5);
                        $pdf->Cell(25, 5, 'COPAY', 1, 0, 'C', true);
                        $pdf->Cell(25, 5, 'COINS', 1, 0, 'C', true);
                        $pdf->Cell(27, 5, 'DEDUCTIBLE', 1, 1, 'C', true);
                        $pdf->SetTextColor(0, 0, 0);
                        $pdf->SetFont('Arial', '', 10);
                    }
                }
            } else {
                //whit depo apply checked
                $depo_applys_transactions = deposit_apply::whereIn('id', $dep_apply_check_value)->get();
                for ($i = 0; $i < count($depo_applys_transactions); $i++) {
                    $client_auth_act = Client_authorization_activity::where('id', $depo_applys_transactions[$i]['activity_id'])->first();
                    $pdf->Cell(30, 5, Carbon::parse($depo_applys_transactions[$i]['dos'])->format('m/d/Y'), 1, 0, 'C');
                    if ($client_auth_act) {
                        $pdf->Cell(90, 5, $client_auth_act->activity_name, 1, 0, 'C');
                    } else {
                        $pdf->Cell(90, 5, '', 1, 0, 'C');
                    }

                    if ($depo_applys_transactions[$i]['status'] == "PR Copay") {
                        $pdf->Cell(25, 5, number_format($depo_applys_transactions[$i]['balance'], 2), 1, 0, 'C');
                    } else {
                        $pdf->Cell(25, 5, '0.00', 1, 0, 'C');
                    }

                    if ($depo_applys_transactions[$i]['status'] == "PR CoIns") {
                        $pdf->Cell(25, 5, number_format($depo_applys_transactions[$i]['balance'], 2), 1, 0, 'C');
                    } else {
                        $pdf->Cell(25, 5, '0.00', 1, 0, 'C');
                    }


                    if ($depo_applys_transactions[$i]['status'] == "PR Ded") {
                        $pdf->Cell(27, 5, number_format($depo_applys_transactions[$i]['balance'], 2), 1, 1, 'C');
                    } else {
                        $pdf->Cell(27, 5, '0.00', 1, 1, 'C');
                    }

                    if ($i == 30) {
                        $pdf->AddPage('P', 'Letter');
                        $pdf->SetTextColor(255, 255, 255);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(30, 10, 'SERVICE DATE', 1, 0, 'C', true);
                        $pdf->Cell(90, 10, 'DESCRIPTION', 1, 0, 'C', true);
                        $pdf->Cell(77, 5, 'BALANCE', 1, 0, 'C', true);
                        $y = $pdf->GetY();
                        $pdf->SetXY(130, $y + 5);
                        $pdf->Cell(25, 5, 'COPAY', 1, 0, 'C', true);
                        $pdf->Cell(25, 5, 'COINS', 1, 0, 'C', true);
                        $pdf->Cell(27, 5, 'DEDUCTIBLE', 1, 1, 'C', true);
                        $pdf->SetTextColor(0, 0, 0);
                        $pdf->SetFont('Arial', '', 10);
                    }
                }

            }


            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(120, 5, 'TOTAL', 1, 0, 'C', true);
            $pdf->Cell(25, 5, number_format($coypay_sum, 2), 1, 0, 'C', true);
            $pdf->Cell(25, 5, number_format($pr_cpon_sum, 2), 1, 0, 'C', true);
            $pdf->Cell(27, 5, number_format($pr_ded_sum, 2), 1, 1, 'C', true);
            if ($date1) {
                $pdf->Cell(145, 5, 'INVOICE FROM ' . Carbon::parse($date1->dos)->format('m/d/Y') . ' THRU ' . Carbon::parse($date2->dos)->format('m/d/Y'), 1, 0, 'C', true);
            } else {
                $pdf->Cell(145, 5, 'INVOICE FROM ' . '' . ' THRU ' . '', 1, 0, 'C', true);
            }

            $pdf->Cell(52, 5, 'GRAND TOTAL: ' . number_format($total, 2), 1, 0, 'C', true);
            $pdf->SetTextColor(0, 0, 0);

            $pdf->Ln(20);

            $y = $pdf->GetY();

            if ($y > 185) {
                $pdf->AddPage('P', 'Letter');
                $y = $pdf->GetY();
            }

            $pdf->Cell(80, 5, 'Payment Coupon', 0, 1);
            $pdf->SetFont('Arial', '', '8');
            $pdf->Cell(80, 5, 'Please return this coupon with your payment.', 0, 1);
            $pdf->Cell(80, 5, 'Make your checks payable to:', 0, 1);
            $pdf->SetFont('Arial', 'B', 10);
            if ($seeting) {
                $pdf->Cell(80, 5,$seeting->facility_name, 0, 1);
            } else {
                $pdf->Cell(80, 5, '', 0, 1);
            }

            $pdf->Ln(5);
            $pdf->Cell(80, 5, 'Invoice# ' . $invoice_num, 0, 1);
            $pdf->Cell(80, 15, 'Date: ' . Carbon::now()->format('m/d/Y'), 0, 1);
            if ($no_cc != 1) {
                $pdf->Rect(92, $y - 5, 112, 75);

                $pdf->SetXY(92, $y - 5);
                $pdf->SetTextColor(255, 255, 255);

                $pdf->Cell(112, 10, 'Credit Card Authorization', 0, 1, 'C', true);

                $pdf->SetXY(92, $y + 8);
                $pdf->SetTextColor(0, 0, 0);
                for ($i = 0; $i < 16; $i++) {

                    $pdf->Cell(7, 6, '', 1, 0);
                }

                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(92, $y + 17);

                $pdf->Cell(25, 6, 'Type of Card:', 0, 0);
                $pdf->Cell(40, 6, '', 1, 0);
                $pdf->Cell(14, 6, ' CVV:', 0, 0);
                $pdf->Cell(10, 6, '', 1, 0);
                $pdf->Cell(10, 6, '', 1, 0);
                $pdf->Cell(10, 6, '', 1, 1);


                $pdf->SetXY(92, $y + 27);
                $pdf->Cell(20, 6, 'Exp. Date:', 0, 0);
                $pdf->Cell(6, 6, '', 1, 0);
                $pdf->Cell(6, 6, '', 1, 0);
                $pdf->Cell(3, 6, '', 0, 0);
                $pdf->Cell(6, 6, '', 1, 0);
                $pdf->Cell(6, 6, '', 1, 0);
                $pdf->Cell(6, 6, '', 1, 0);
                $pdf->Cell(6, 6, '', 1, 0);

                $pdf->Cell(16, 6, 'Amount:', 0, 0);
                $pdf->Cell(35, 6, '', 1, 1);
                $pdf->SetXY(92, $y + 37);
                $pdf->Cell(38, 6, 'Account Holder Name:', 0, 0);
                $pdf->Cell(72, 6, '', 1, 1);
                $pdf->SetX(92);
                $pdf->Cell(22, 8, 'Bill Address:', 0, 0);
                $pdf->MultiCell(90, 8, '____________________________________________ ____________________________________________', 0, 1);

                $pdf->SetX(92);
                $pdf->Cell(56, 8, 'Signature: ___________________', 0, 0);
                $pdf->Cell(56, 8, 'Date: ___________________', 0, 1);
            }


        }

        return $pdf;
    }


    public function billing_statement_delete($id)
    {
        $statement_delete = patient_statement::where('client_id', $id)->delete();
        return back()->with('success', 'Patient Statement Deleted Successfully');
    }


    public function submit_single_status(Request $request){
        $stat=patient_statement::select('id','is_submit')->where('id',$request->id)->first();
        $stat->is_submit = $request->check;
        $stat->save();
        return "success";
    }

    public function submit_all_status(Request $request){
        foreach($request->ids as $id){
            $stat=patient_statement::select('id','is_submit')->where('id',$id)->first();
            $stat->is_submit = $request->check;
            $stat->save();    
        }
        return "success";
    }

    public function billing_email_editor($c_id,$f_name){
        $c_id = $c_id;
        $f_name = $f_name;
        $f_path = public_path('statements/').$f_name;
        return view('superadmin.statement.include.statementEmail',compact('c_id','f_name','f_path'));
    }

    public function billing_statement_send(Request $request){

        $fileUrl = '';

        if ($request->hasFile('attachment_email')) {
            $file = $request->file('attachment_email');
            $name = $file->getClientOriginalName();
            $uploadPath = 'assets/dashboard/documents/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        }
        else{
            $fileUrl = '';
        }


        $f_path = '';
        if(isset($request->attached)){
                $f_path = $request->f_path;
        }
        else{
            $f_path = '';
        }

        $data = [
            "request" => $request,
            "fileUrl" => $fileUrl,
            "attachment" => $f_path
        ];

        if($request->cc !=null || $request->cc != ''){
            Mail::to($request->to_email)->cc($request->cc)->send(new StatementMail($data));
        }
        else{
            Mail::to($request->to_email)->send(new StatementMail($data));
        }


        return "success";
    }

}
