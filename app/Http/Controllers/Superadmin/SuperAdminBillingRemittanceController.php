<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Edi\Eraparser\ERAParser;
use App\Models\eremittance_chargedata;
use App\Models\eremittance_checkdata;
use App\Models\eremittance_visitpay;
use App\Models\manage_claim_transaction;
use App\Models\sftp_file_manage;
use App\Models\deposit;
use App\Models\Batching_claim;
use App\Models\deposit_apply;
use App\Models\deposit_apply_transaction;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\All_payor_detail;
use App\Models\Client_authorization_activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class SuperAdminBillingRemittanceController extends Controller
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


    public function era_remittance()
    {
        return view('superadmin.Remittance.eraRemittance');
    }

    public function era_remittance_upload(Request $request)
    {
        if ($request->hasFile('era_file')) {
            $image = $request->file('era_file');
            $name = $image->getClientOriginalName();
            $uploadPath = 'assets/era/';
            $image->move($uploadPath, $name);
            $file_path = $uploadPath . $name;
        } else {
            return array(
                "status" => "error");
        }

        $obj = new ERAParser();
        $obj->ParseERAFile($file_path);

        $result = [];
        $check_array=[];
        $control_number=[];
        $check_data = [];
        $i=0;
        $t_billed=0;
        $t_adj=0;
        $t_pat=0;
        $t_denied=0;
        $t_net_pay=0;
        $t_check=0;
        $check_date='';
        $check_number='';
        $check_amount = '';
        $payment_method = '';

        foreach ($obj->ERAData as $checkData) {

            $check_date='';
            $check_number='';
            $check_amount = '';
            $payment_method = '';
            $t_billed=0;
            $t_adj=0;
            $t_pat=0;
            $t_denied=0;
            $t_net_pay=0;
            $t_check=0;

            $check_date = $checkData->__get('CheckDate') != "" ? $checkData->__get('CheckDate') : null;
            $check_number = $checkData->__get('CheckNumber') != "" ? $checkData->__get('CheckNumber') : null;
            $check_amount = $checkData->__get('CheckAmount') != "" ? $checkData->__get('CheckAmount') : null;
            $payment_method = $checkData->__get('PaymentMethod') != "" ? $checkData->__get('PaymentMethod') : null;

            $check_array[$i]["check_date"] = $check_date;
            $check_array[$i]["check_number"] = $check_number;
            $check_array[$i]["check_amount"] = $check_amount;
            $check_array[$i]["payment_method"] = $payment_method;
            $visit_array = [];
            $j = 0;

            $t_check = $check_amount;
            foreach ($checkData->ERAVisitPayments as $visitData) {


                $patient_control_number = $visitData->__get('PatientControlNumber') != "" ? $visitData->__get('PatientControlNumber') : null;
                $payor_control_number = $visitData->__get('PayerControlNumber') != "" ? $visitData->__get('PayerControlNumber') : null;
                $submitted_amount = $visitData->__get('SubmittedAmt') != "" ? $visitData->__get('SubmittedAmt') : 0;
                $paid_amount = $visitData->__get('PaidAmt') != "" ? $visitData->__get('PaidAmt') : 0;
                $pat_respon_am = $visitData->__get('PatResponsibilityAmt') != "" ? $visitData->__get('PatResponsibilityAmt') : 0;
                $copay_am = $visitData->__get('CopayAmt') != "" ? $visitData->__get('CopayAmt') : null;
                $ded_am = $visitData->__get('DeductableAmt') != "" ? $visitData->__get('DeductableAmt') : 0;
                $cocoins_am = $visitData->__get('CoInsuranceAmt') != "" ? $visitData->__get('CoInsuranceAmt') : 0;


                $visit_array[$j]["patient_control_number"] = $patient_control_number;
                $visit_array[$j]["payor_control_number"] = $payor_control_number;
                $visit_array[$j]["submitted_amount"] = $submitted_amount;
                $visit_array[$j]["paid_amount"] = $paid_amount;
                $visit_array[$j]["pat_respon_am"] = $pat_respon_am;
                $visit_array[$j]["copay_am"] = $copay_am;
                $visit_array[$j]["ded_am"] = $ded_am;
                $visit_array[$j]["cocoins_am"] = $cocoins_am;


                $charge_array = [];
                $k = 0;
                foreach ($visitData->ERAChargePayments as $ChargeData) {

                    $charge_control_number = $ChargeData->__get('ChargeControlNumber') != "" ? $ChargeData->__get('ChargeControlNumber') : null;
                    $service_date = $ChargeData->__get('ServiceDateFrom') != "" ? $ChargeData->__get('ServiceDateFrom') : null;
                    $cpt = $ChargeData->__get('CPTCode') != "" ? $ChargeData->__get('CPTCode') : null;
                    $submitted_amount = $ChargeData->__get('SubmittedAmt') != "" ? $ChargeData->__get('SubmittedAmt') : 0;
                    $paid_amount = $ChargeData->__get('PaidAmt') != "" ? $ChargeData->__get('PaidAmt') : 0;
                    $copay_amount = $ChargeData->__get('CopayAmt') != "" ? $ChargeData->__get('CopayAmt') : 0;
                    $ded_amount = $ChargeData->__get('DeductableAmt') != "" ? $ChargeData->__get('DeductableAmt') : 0;
                    $coins_amount = $ChargeData->__get('CoInsuranceAmt') != "" ? $ChargeData->__get('CoInsuranceAmt') : 0;
                    $write_off_amount = $ChargeData->__get('WriteOffAmt');

                    $other_adj_code_one = $ChargeData->__get('OtherAdjustmentCode1') != "" ? $ChargeData->__get('OtherAdjustmentCode1') : null;
                    $other_adj_amt_one = $ChargeData->__get('OtherAdjustmentAmt1') != "" ? $ChargeData->__get('OtherAdjustmentAmt1') : 0;
                    $other_adj_code_two = $ChargeData->__get('OtherAdjustmentCode2') != "" ? $ChargeData->__get('OtherAdjustmentCode2') : null;
                    $other_adj_amt_two = $ChargeData->__get('OtherAdjustmentAmt2') != "" ? $ChargeData->__get('OtherAdjustmentAmt2') : 0;
                    $other_adj_code_three = $ChargeData->__get('OtherAdjustmentCode3') != "" ? $ChargeData->__get('OtherAdjustmentCode3') : null;
                    $other_adj_amt_three = $ChargeData->__get('OtherAdjustmentAmt3') != "" ? $ChargeData->__get('OtherAdjustmentAmt3') : 0;
                    $other_adj_code_four = $ChargeData->__get('OtherAdjustmentCode4') != "" ? $ChargeData->__get('OtherAdjustmentCode4') : null;
                    $other_adj_amt_four = $ChargeData->__get('OtherAdjustmentAmt4') != "" ? $ChargeData->__get('OtherAdjustmentAmt4') : 0;
                    $other_adj_code_five = $ChargeData->__get('OtherAdjustmentCode5') != "" ? $ChargeData->__get('OtherAdjustmentCode5') : null;
                    $other_adj_amt_five = $ChargeData->__get('OtherAdjustmentAmt5') != "" ? $ChargeData->__get('OtherAdjustmentAmt5') : 0;


                    $other_adj_group_code_one = $ChargeData->__get('OtherAdjustmentGroupCode1') != "" ? $ChargeData->__get('OtherAdjustmentGroupCode1') : null;
                    $other_adj_group_code_two = $ChargeData->__get('OtherAdjustmentGroupCode2') != "" ? $ChargeData->__get('OtherAdjustmentGroupCode2') : null;
                    $other_adj_group_code_three = $ChargeData->__get('OtherAdjustmentGroupCode3') != "" ? $ChargeData->__get('OtherAdjustmentGroupCode3') : null;
                    $other_adj_group_code_four = $ChargeData->__get('OtherAdjustmentGroupCode4') != "" ? $ChargeData->__get('OtherAdjustmentGroupCode4') : null;
                    $other_adj_group_code_five = $ChargeData->__get('OtherAdjustmentGroupCode5') != "" ? $ChargeData->__get('OtherAdjustmentGroupCode5') : null;


                    $remark_one = $ChargeData->__get('RemarkCode1') != "" ? $ChargeData->__get('RemarkCode1') : null;
                    $remark_two = $ChargeData->__get('RemarkCode2') != "" ? $ChargeData->__get('RemarkCode2') : null;
                    $show_status = 1;

                    $charge_array[$k] = array(
                        "charge_control_number" => $charge_control_number,
                        "service_date" => $service_date,
                        "cpt" => $cpt,
                        "submitted_amount" => $submitted_amount,
                        "paid_amount" => $paid_amount,
                        "copay_amount" => $copay_amount,
                        "ded_amount" => $ded_amount,
                        "coins_amount" => $coins_amount,
                        "write_off_amount" => $write_off_amount,
                        "other_adj_code_one" => $other_adj_code_one,
                        "other_adj_amt_one" => $other_adj_amt_one,
                        "other_adj_code_two" => $other_adj_code_two,
                        "other_adj_amt_two" => $other_adj_amt_two,
                        "other_adj_code_three" => $other_adj_code_three,
                        "other_adj_amt_three" => $other_adj_amt_three,
                        "other_adj_code_four" => $other_adj_code_four,
                        "other_adj_amt_four" => $other_adj_amt_four,
                        "other_adj_code_five" => $other_adj_code_five,
                        "other_adj_amt_five" => $other_adj_amt_five,

                        "other_adj_group_code_one" => $other_adj_group_code_one,
                        "other_adj_group_code_two" => $other_adj_group_code_two,
                        "other_adj_group_code_three" => $other_adj_group_code_three,
                        "other_adj_group_code_four" => $other_adj_group_code_four,
                        "other_adj_group_code_five" => $other_adj_group_code_five,

                        "remark_one" => $remark_one,
                        "remark_two" => $remark_two,
                        "show_status" => $show_status,
                    );
                    $t_adj += $other_adj_amt_one;
                    $control_number[] = $charge_control_number;

                    $k++;
                }
                $visit_array[$j]["ERAChargePayments"] = $charge_array;
                $j++;
                $t_billed += $submitted_amount;
                $t_pat += $pat_respon_am;
                if ($paid_amount == 0) {
                    $t_denied += $submitted_amount;
                }
                $t_net_pay += $paid_amount;
            }
            $check_array[$i]["ERAVisitPayments"] = $visit_array;

            $check_data[$i]["check_number"] = $check_number;
            $check_data[$i]["check_date"] = $check_date==null?'':\Carbon\Carbon::parse($check_date)->format('m/d/Y');
            $check_data[$i]["total_check"] = number_format($t_check,2);
            $check_data[$i]["billed"] = number_format($t_billed,2);
            $check_data[$i]["adjusted"] = number_format($t_adj,2);
            $check_data[$i]["respons"] = number_format($t_pat,2);
            $check_data[$i]["denied"] = number_format($t_denied,2);
            $check_data[$i]["net"] = number_format($t_net_pay,2);
            $i++;
        }

        return response()->json([
            'status'=>"success",
            'result'=>$check_array,
            'control_number'=>$control_number,
            'topTable' => \View::make('superadmin.Remittance.include.topTable', compact('check_data'))->render(),
            'view' => \View::make('superadmin.Remittance.include.parseTable', compact('check_array'))->render(),
        ]);
    }

    public function era_process(Request $request)
    {


        $check_array = $request->raw_data;

        $control_number = $request->control_number;

        $check_array = json_decode($check_array);
        $control_number = json_decode($control_number);

        $matched = [];
        $unmatched = [];
        $payor_id = null;
        $payment_method = null;
        $check_number = null;
        $check_amount = null;
        $check_date = null;
        $deposit_id = 0;

        foreach ($check_array as $checkData) {
            $payor_id = null;
            $payment_method = null;
            $check_number = null;
            $check_amount = null;
            $check_date = null;
            $deposit_id = 0;

            $check = eremittance_checkdata::where('check_number', $checkData->check_number)->where('admin_id', $this->admin_id)->first();
            if ($check) {
                if($check->check_number == '4378890' && $this->admin_id == 53){
                    $check->delete();
                }
                else{
                    return response()->json([
                        'status' => "already"
                    ]);
                }
            }

            $erimt_check_data = new eremittance_checkdata();
            $erimt_check_data->admin_id = $this->admin_id;

            $erimt_check_data->check_date = $check_date = $checkData->check_date;
            $erimt_check_data->check_number = $check_number = $checkData->check_number;
            $erimt_check_data->check_amount = $check_amount = $checkData->check_amount;
            $erimt_check_data->save();

            $payment_method = $checkData->payment_method;

            foreach ($checkData->ERAVisitPayments as $visitData) {

                $eremit_visit_data = new eremittance_visitpay();
                $eremit_visit_data->admin_id = $this->admin_id;
                $eremit_visit_data->eremit_check_id = $erimt_check_data->id;
                $eremit_visit_data->patient_control_number = $visitData->patient_control_number;
                $eremit_visit_data->payor_control_number = $visitData->payor_control_number;
                $eremit_visit_data->submitted_amount = $visitData->submitted_amount;
                $eremit_visit_data->paid_amount = $visitData->paid_amount;
                $eremit_visit_data->pat_respon_am = $visitData->pat_respon_am;
                $eremit_visit_data->copay_am = $visitData->copay_am;
                $eremit_visit_data->ded_am = $visitData->ded_am;
                $eremit_visit_data->cocoins_am = $visitData->cocoins_am;
                $eremit_visit_data->save();

                foreach ($visitData->ERAChargePayments as $ChargeData) {

                    $eremit_charge_data = new eremittance_chargedata();
                    $eremit_charge_data->admin_id = $this->admin_id;
                    $eremit_charge_data->eremit_check_id = $erimt_check_data->id;
                    $eremit_charge_data->eremit_visitpay_id = $eremit_visit_data->id;
                    $eremit_charge_data->charge_control_number = $ChargeData->charge_control_number;
                    $eremit_charge_data->service_date = $ChargeData->service_date;
                    $eremit_charge_data->cpt = $ChargeData->cpt;
                    $eremit_charge_data->submitted_amount = $ChargeData->submitted_amount;
                    $eremit_charge_data->paid_amount = $ChargeData->paid_amount;
                    $eremit_charge_data->copay_amount = $ChargeData->copay_amount;
                    $eremit_charge_data->ded_amount = $ChargeData->ded_amount;
                    $eremit_charge_data->coins_amount = $ChargeData->coins_amount;
                    $eremit_charge_data->other_adj_code_one = $ChargeData->other_adj_code_one;
                    $eremit_charge_data->other_adj_amt_one = $ChargeData->other_adj_amt_one;
                    $eremit_charge_data->other_adj_code_two = $ChargeData->other_adj_code_two;
                    $eremit_charge_data->other_adj_amt_two = $ChargeData->other_adj_amt_two;
                    $eremit_charge_data->remark_one = $ChargeData->remark_one;
                    $eremit_charge_data->remark_two = $ChargeData->remark_two;

                    $check = manage_claim_transaction::where('control_number', $ChargeData->charge_control_number)->where('admin_id', $this->admin_id)->first();
                    if ($check) {
                        if ($payor_id == null) {
                            $payor_id = $check->payor_id;
                            if ($request->hasFile('txt_file')) {
                                $file = $request->file('txt_file');
                                $name = $file->getClientOriginalName();
                                $uploadPath = 'assets/deposits/';
                                $file->move($uploadPath, $name);
                                $fileUrl = $uploadPath . $name;
                            } else {
                                $fileUrl = 'empty';
                            }
                            $deposit_id = $this->deposit_eremittance($checkData, $payor_id, $fileUrl);
                        }

                        $eremit_charge_data->show_status = 1;
                        array_push($matched, array(
                            "check_date" => $checkData->check_date,
                            "check_number" => $checkData->check_number,
                            "check_amount" => $checkData->check_amount,
                            "charge_data" => $ChargeData,
                            "visit_data" => $visitData,
                        ));

                        $this->apply_eremittance($deposit_id, $check, $ChargeData, $payor_id);

                    } else {
                        $eremit_charge_data->show_status = 2;
                        array_push($unmatched, array(
                            "check_date" => $checkData->check_date,
                            "check_number" => $checkData->check_number,
                            "check_amount" => $checkData->check_amount,
                            "charge_data" => $ChargeData,
                            "visit_data" => $visitData,
                        ));
                    }

                    $eremit_charge_data->save();
                }
            }

        }

        // if(sizeof($m_ids)>0){
        //     $this->apply_eremittance($m_ids,$payor_id,$matched);
        // }

        return response()->json([
            'status' => "success",
            'matched' => $matched,
            'unmatched' => $unmatched,
            'matched_view' => \View::make('superadmin.Remittance.include.matchedTable', compact('matched'))->render(),
            'unmatched_view' => \View::make('superadmin.Remittance.include.unmatchedTable', compact('unmatched'))->render(),
        ]);
    }

    public function deposit_eremittance($checkData, $payor_id, $fileUrl)
    {
        $deposit = new deposit();
        $deposit->admin_id = $this->admin_id;
        $deposit->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
        $deposit->payor_type = 2;
        $deposit->payor_id = $payor_id;
        $deposit->deposit_date = Carbon::now()->format('Y-m-d');
        // $deposit->payment_method=$payment_method;
        $deposit->payment_method = 2;   //EFT
        $deposit->instrument = $checkData->check_number;
        $deposit->instrument_date = $checkData->check_date;
        $deposit->amount = $checkData->check_amount;
        if ($fileUrl != 'empty') {
            $deposit->file = $fileUrl;
        }
        $deposit->unapplied_amount = $checkData->check_amount;
        $deposit->save();

        return $deposit->id;
    }

    public function apply_eremittance($deposit_id, $claims, $ChargeData, $payor_id)
    {
        $adjustment = 0;
        $payment = 0;

        // $baching_claims = Batching_claim::where('id', $claims->baching_id)
        //     ->where('admin_id', $this->admin_id)
        //     ->get(); 

        $baching_claims = Batching_claim::where('appointment_id', $claims->appointment_id)
            ->where('client_id',$claims->client_id)
            ->where('cpt',$claims->cpt)
            ->where('admin_id', $this->admin_id)
            ->get();

        foreach ($baching_claims as $batc_claim) {
            $exists_dep_apply = deposit_apply::where('batching_claim_id', $batc_claim->id)
                ->where('deopsit_id', $deposit_id)
                ->where('admin_id', $this->admin_id)
                ->first();

            $check_has_sec = Client_authorization::select('id', 'client_id', 'is_primary')
                ->where('client_id', $batc_claim->client_id)
                ->where('is_primary', 2)
                ->where('admin_id', $this->admin_id)
                ->first();

            $activity = Client_authorization_activity::where('id', $batc_claim->activity_id)
                ->where('admin_id', $this->admin_id)
                ->first();

            $adjustment = 0;

            if ($ChargeData->write_off_amount != null && $ChargeData->write_off_amount != '') {
                $adjustment += (double)$ChargeData->write_off_amount;
            }


            // if($ChargeData->other_adj_code_one=="45" || $ChargeData->other_adj_group_code_one=="45"){
            //     $adjustment+=(float)$ChargeData->write_off_amount;
            // }
            // if($ChargeData->other_adj_code_two=="45" || $ChargeData->other_adj_group_code_two=="45"){
            //     $adjustment+=(float)$ChargeData->write_off_amount;
            // }
            // if($ChargeData->other_adj_code_three=="45" || $ChargeData->other_adj_group_code_three=="45"){
            //     $adjustment+=(float)$ChargeData->write_off_amount;
            // }
            // if($ChargeData->other_adj_code_four=="45" || $ChargeData->other_adj_group_code_four=="45"){
            //     $adjustment+=(float)$ChargeData->write_off_amount;
            // }
            // if($ChargeData->other_adj_code_five=="45" || $ChargeData->other_adj_group_code_five=="45"){
            //     $adjustment+=(float)$ChargeData->write_off_amount;
            // }


            $payment = (float)$ChargeData->paid_amount;

            if (!$exists_dep_apply) {


                $total = $payment + $adjustment;
                $balance = $batc_claim->billed_am - $total;

                if (!empty($ChargeData->copay_amount)) {
                    $status = "PR Copay";
                } else if (!empty($ChargeData->ded_amount)) {
                    $status = "PR Ded";
                } else if (!empty($ChargeData->coins_amount)) {
                    $status = "PR CoIns";

                } else if ($ChargeData->other_adj_code_one != "45" && !empty($ChargeData->other_adj_amt_one)) {
                    $status = "Denial";
                } else if ($ChargeData->other_adj_code_two != "45" && !empty($ChargeData->other_adj_amt_two)) {
                    $status = "Denial";
                } else if ($ChargeData->other_adj_code_three != "45" && !empty($ChargeData->other_adj_amt_three)) {
                    $status = "Denial";
                } else if ($ChargeData->other_adj_code_four != "45" && !empty($ChargeData->other_adj_amt_four)) {
                    $status = "Denial";
                } else if ($ChargeData->other_adj_code_five != "45" && !empty($ChargeData->other_adj_amt_five)) {
                    $status = "Denial";
                } else if ($balance == 0 || $balance == 0.00) {
                    $status = "Closed";
                } else if ($total > $batc_claim->billed_am) {
                    $status = "Overpayment";
                } else if ($total < $batc_claim->billed_am) {
                    $status = "Underpayment";
                } else if (($payment == 0.00 || $payment == 0) && ($adjustment == 0 || $adjustment == 0.00)) {
                    $status = "Open";
                }


                $d_apply = new deposit_apply();
                $d_apply->admin_id = $this->admin_id;
                $d_apply->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $d_apply->batching_claim_id = $batc_claim->id;
                $d_apply->appointment_id = $batc_claim->appointment_id;
                $d_apply->client_id = $batc_claim->client_id;
                $d_apply->provider_id = $batc_claim->provider_id;
                $d_apply->authorization_id = $batc_claim->authorization_id;
                $d_apply->activity_id = $batc_claim->activity_id;
                $d_apply->payor_id = $batc_claim->payor_id;
                $d_apply->dos = $batc_claim->schedule_date;
                $d_apply->units = $batc_claim->units;
                $d_apply->cpt = $batc_claim->cpt;
                $d_apply->m1 = $batc_claim->m1;
                $d_apply->m2 = $batc_claim->m2;
                $d_apply->m3 = $batc_claim->m3;
                $d_apply->m4 = $batc_claim->m4;
                $d_apply->amount = $batc_claim->billed_am;
                $d_apply->m5 = null;
                $d_apply->see_payor = $batc_claim->units_value_calc;
                $d_apply->provider_24j = $batc_claim->cms_24j;
                $d_apply->billed_am = $batc_claim->billed_am;
                $d_apply->status_apply = 1;
                $d_apply->id_qualifier = $batc_claim->id_qualifier;
                $d_apply->degree_level = $batc_claim->degree_level;
                $d_apply->zone = $batc_claim->zone;
                $d_apply->location = $batc_claim->location;
                $d_apply->units_value_calc = $batc_claim->units_value_calc;
                $d_apply->deopsit_id = $deposit_id;
                $d_apply->payment = $ChargeData->paid_amount; //same amount in er
                $d_apply->adjustment = $adjustment; //sum of all adjustment
                $d_apply->balance = $balance; //amount-(payment+adj);
                $d_apply->reason = null; //null
                $d_apply->status = $status; // in jquery (For applying amount)
                $d_apply->has_claim_id = 0;
                if ($check_has_sec) {
                    $d_apply->has_seceondary = $check_has_sec->id;
                } else {
                    $d_apply->has_seceondary = 0;
                }
                $d_apply->save();

                $apply_claim = deposit_apply::where('id', $d_apply->id)
                    ->where('admin_id', $this->admin_id)
                    ->first();

                $dep = deposit::where('id', $deposit_id)->where('admin_id', $this->admin_id)->first();

                $payor_name = All_payor_detail::where('payor_id', $dep->payor_id)->where('admin_id', $this->admin_id)->first();
                if ($payor_name) {
                    $who_paid = $payor_name->payor_name;
                } else {
                    $who_paid = '';
                }

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
            // else{
            //     $total=$payment+$adjustment;
            //     $balance=$batc_claim->billed_am-$total;

            //     if(!empty($ChargeData->copay_amount)){
            //         $status="PR Copay";
            //     }
            //     else if(!empty($ChargeData->ded_amount)){
            //         $status="PR Ded";
            //     }
            //     else if(!empty($ChargeData->coins_amount)){
            //         $status="PR CoIns";

            //     }
            //     else if($ChargeData->other_adj_code_one!="45" && !empty($ChargeData->other_adj_amt_one)){
            //             $status="Denial";
            //     }
            //     else if($ChargeData->other_adj_code_two!="45" && !empty($ChargeData->other_adj_amt_two)){
            //             $status="Denial";
            //     }
            //     else if($ChargeData->other_adj_code_three!="45" && !empty($ChargeData->other_adj_amt_three)){
            //             $status="Denial";
            //     }
            //     else if($ChargeData->other_adj_code_four!="45" && !empty($ChargeData->other_adj_amt_four)){
            //             $status="Denial";
            //     }
            //     else if($ChargeData->other_adj_code_five!="45" && !empty($ChargeData->other_adj_amt_five)){
            //             $status="Denial";
            //     }
            //     else if($balance==0 || $balance==0.00)
            //     {
            //         $status="Closed";
            //     }
            //     else if($total>$batc_claim->billed_am)
            //     {
            //         $status="Overpayment";
            //     }
            //     else if($total<$batc_claim->billed_am)
            //     {
            //         $status="Underpayment";
            //     }
            //     else if(($payment==0.00 || $payment==0) && ($adjustment==0 || $adjustment==0.00)){
            //       $status="Open";
            //     }


            //     $exists_dep_apply->deopsit_id = $deposit_id;
            //     $exists_dep_apply->payment = $payment; //same amount in er
            //     $exists_dep_apply->adjustment =$adjustment; //sum of all adjustment
            //     $exists_dep_apply->balance = $balance; //amount-(payment+adj);
            //     $exists_dep_apply->status = $status; // in jquery (For applying amount)
            //     $exists_dep_apply->reason = null; //null
            //     if ($check_has_sec) {
            //         $exists_dep_apply->has_seceondary = $check_has_sec->id;
            //     } else {
            //         $exists_dep_apply->has_seceondary = 0;
            //     }
            //     $exists_dep_apply->save();
            // }
        }
    }
}




