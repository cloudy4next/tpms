<?php

namespace App\Console\Commands;

use App\Mail\ResetPasswordMail;
use App\Models\Admin;
use App\Models\All_payor;
use App\Models\All_payor_detail;
use App\Models\Appoinment;
use App\Models\Batching_claim;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Client_info;
use App\Models\deposit;
use App\Models\deposit_apply;
use App\Models\deposit_apply_transaction;
use App\Models\Employee;
use App\Models\ledger_list;
use App\Models\ledger_note;
use App\Models\manage_claim_transaction;
use App\Models\Processing_claim;
use App\Models\rate_list;
use App\Models\report_notification;
use App\Models\setting_name_location;
use App\Models\setting_name_location_box_two;
use App\Models\setting_service;
use App\Mail\ReportConfirmMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Rap2hpoutre\FastExcel\FastExcel;
use ZipArchive;

class GenerateCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:downloadcsv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //        $to = "srt7142@gmail.com";
        //        $msg = [
        //            'name' => "ami",
        //            'code'=>"12345678"
        //        ];
        //        Mail::to($to)->send(new ResetPasswordMail($msg));


        $all_report = report_notification::where('status', "Pending")
            ->where('report_name', 'report')
            ->get();

        foreach ($all_report as $report) {


            $user = Admin::select('login_email', 'name')->where('id', $report->admin_id)->first();
            $to = $user->login_email;
            $user_name = $user->name;

            if ($report->date_type == null) {
                if ($report->report_type == 101) {
                    $start_date = null;
                    $end_date = null;
                }
            } else if ($report->date_type == 1) {
                $start_date = $end_date = Carbon::parse($report->s_date)->format('F d, Y');
            } else {
                $start_date = Carbon::parse($report->form_date)->format('F d, Y');
                $end_date = Carbon::parse($report->to_date)->format('F d, Y');
            }

            $data_arr = array(
                "name" => $user_name,
                "sd" => $start_date,
                "ed" => $end_date,
                "report" => $report->file_name . '.csv'
            );


            if ($report->report_type == 1) {

                $data = ledger_list::distinct()->select('admin_id', 'client_id', 'provider_id', 'authorization_id', 'activity_id', 'payor_id')
                    ->where('admin_id', $report->admin_id);

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('schedule_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('schedule_date', '>=', $date_from)->where('schedule_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $single_ledger = ledger_list::where('admin_id', $line->admin_id)
                        ->where('client_id', $line->client_id)
                        ->where('provider_id', $line->provider_id)
                        ->where('authorization_id', $line->authorization_id)
                        ->where('activity_id', $line->activity_id)
                        ->where('payor_id', $line->payor_id)
                        ->first();

                    $payor_name = All_payor::select('payor_name')
                        ->where('id', $single_ledger->payor_id)
                        ->first();

                    $deposit_app = deposit_apply::where('batching_claim_id', $line->batching_id)->first();
                    if ($deposit_app) {
                        $allow_am = $line->billed_am - $deposit_app->adjustment;
                    } else {
                        $allow_am = $line->billed_am - 0.00;
                    }

                    $patient_payment = deposit_apply::where('batching_claim_id', $line->batching_id)
                        ->where('status', 'Patient Responsibility')
                        ->orWhere('status', 'PR CoIns')
                        ->orWhere('status', 'PR Copay')
                        ->orWhere('status', 'PR Ded')
                        ->first();

                    $ins_res = deposit_apply::where('batching_claim_id', $line->batching_id)
                        ->where('status', '!=', 'Patient Responsibility')
                        ->where('status', '!=', 'PR CoIns')
                        ->where('status', '!=', 'PR Copay')
                        ->where('status', '!=', 'PR Ded')
                        ->first();

                    if ($deposit_app) {
                        $dep_data = deposit::where('id', $deposit_app->deopsit_id)->first();

                        if ($dep_data->payor_type == 2) {
                            $ins_paid_am = $deposit_app->payment;
                        } else {
                            $ins_paid_am = 0.00;
                        }
                    } else {
                        $ins_paid_am = 0.00;
                    }


                    if ($deposit_app && $deposit_app->has_seceondary == 1) {
                        $sec_pay = $deposit_app->payment;
                    } else {
                        $sec_pay = 0.00;
                    }

                    $gaurantor = deposit_apply::where('batching_claim_id', $line->batching_id)->where('payor_id', "1")->sum('balance');


                    $ins_billma = isset($ins_res->balance) ? $ins_res->balance : 0.00;
                    $extra_array = $report->extra;
                    $extra_array = json_decode($extra_array);

                    if (in_array("Payorid", $extra_array)) $r_arr["Payorid"] = $payor_name->facility_payor_id;
                    if (in_array("Payor Name", $extra_array)) $r_arr["Payor Name"] = $payor_name->payor_name;

                    if (in_array("Billed Amount", $extra_array)) $r_arr["Billed Amount"] = $line->billed_am;

                    if (in_array("Adjustment", $extra_array)) $r_arr["Adjustment"] = isset($deposit_app->adjustment) ? $deposit_app->adjustment : 0.00;

                    if (in_array("Allowed Amount", $extra_array)) $r_arr["Allowed Amount"] = $allow_am;

                    if (in_array("Patient Payment", $extra_array)) $r_arr["Patient Payment"] = isset($patient_payment->payment) ? $patient_payment->payment : 0.00;

                    if (in_array("Insurance Paid", $extra_array)) $r_arr["Insurance Paid"] = $ins_paid_am;

                    if (in_array("Secondary Insurance Paid", $extra_array)) $r_arr["Secondary Insurance Paid"] = $sec_pay;

                    if (in_array("Total Paid", $extra_array)) $r_arr["Total Paid"] = isset($deposit_app->payment) ? $deposit_app->payment : 0.00;

                    if (in_array("Patient Responsibility", $extra_array)) $r_arr["Patient Responsibility"] = isset($patient_payment->balance) ? $patient_payment->balance : 0.00;

                    if (in_array("Insurance Responsibility", $extra_array)) $r_arr["Insurance Responsibility"] = isset($ins_res->balance) ? $ins_res->balance : 0.00;

                    if (in_array("Balance", $extra_array)) $r_arr["Balance"] = (isset($patient_payment->balance) ? $patient_payment->balance : 0.00) + (isset($ins_res->balance) ? $ins_res->balance : 0.00);

                    if (in_array("Billed year", $extra_array)) $r_arr["Billed year"] = Carbon::parse($line->dos)->format('Y');

                    if (in_array("Billed Month", $extra_array)) $r_arr["Billed Month"] = Carbon::parse($line->dos)->format('M');

                    if (in_array("Insurance / Billed Amount %", $extra_array)) $r_arr["Insurance / Billed Amount %"] = $ins_billma > 0 ? ($ins_billma / $allow_am) * 100 : 0.00;

                    if (in_array("Collection %", $extra_array)) $r_arr["Collection"] = $allow_am - $ins_paid_am - $gaurantor - $sec_pay;

                    return $r_arr;

                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));
            } elseif ($report->report_type == 2) {

                $data = deposit::where('admin_id', $report->admin_id);
                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('deposit_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('deposit_date', '>=', $date_from)->where('deposit_date', '<=', $date_to);
                }

                $data = $data->get();
                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $payor_name = All_payor::select('payor_name')
                        ->where('id', $line->payor_id)
                        ->first();
                    $extra_array = $report->extra;
                    $extra_array = json_decode($extra_array);
                    if (in_array("Payorid", $extra_array)) $r_arr["Payorid"] = isset($payor_name) ? $payor_name->facility_payor_id : '';
                    if (in_array("Payee Name", $extra_array)) $r_arr["Payee Name"] = isset($payor_name) ? $payor_name->payor_name : '';
                    if (in_array("Deposit Date", $extra_array)) $r_arr["Deposit Date"] = Carbon::parse($line->deposit_date)->format('m/d/Y');
                    if (in_array("Check No", $extra_array)) $r_arr["Check No"] = $line->instrument;
                    if (in_array("Check Date", $extra_array)) $r_arr["Check Date"] = Carbon::parse($line->instrument_date)->format('m/d/Y');
                    if (in_array("Check Type", $extra_array)) $r_arr["Check Type"] = $line->payment_method;
                    if (in_array("Allocated Check Amt.", $extra_array)) $r_arr["Allocated Check Amt."] = $line->amount;
                    if (in_array("Unallocated", $extra_array)) $r_arr["Unallocated"] = $line->unapplied_amount;
                    if (in_array("Description", $extra_array)) $r_arr["Description"] = $line->notes;

                    return $r_arr;

                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));
            } elseif ($report->report_type == 3) {
                $data = deposit_apply_transaction::where('admin_id', $report->admin_id);
                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('dos', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('dos', '>=', $date_from)->where('dos', '<=', $date_to);
                }

                $data = $data->get();


                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {

                    $dep_apply = deposit_apply::where('id', $line->deposit_apply_id)->first();
                    if ($dep_apply) {
                        $dep = deposit::where('id', $dep_apply->deopsit_id)->first();
                        if ($dep->payment_method == 1) {
                            $dep_type = "Check";
                        } elseif ($dep->payment_method == 2) {
                            $dep_type = "EFT";
                        } elseif ($dep->payment_method == 3) {
                            $dep_type = "Card";
                        } elseif ($dep->payment_method == 4) {
                            $dep_type = "Cash";
                        } elseif ($dep->payment_method == 5) {
                            $dep_type = "Credit";
                        } elseif ($dep->payment_method == 5) {
                            $dep_type = "Write off";
                        }
                    } else {
                        $dep_type = "";
                        $dep = deposit::where('id', 0)->first();
                    }
                    $payor_name = All_payor::select('payor_name')
                        ->where('id', $line->payor_id)
                        ->first();

                    $client = Client::where('id', $line->client_id)->first();
                    $auth_id = $line->authorization_id;
                    $tx_type = Client_authorization::where('id', $auth_id)->first();
                    $tx_type = $tx_type->treatment_type;

                    $dep_apply = deposit_apply::where('id', $line->deposit_apply_id)->first();
                    $deposit = deposit::where('id', $dep_apply->deopsit_id)->first();
                    $all_amount = $deposit->amount;

                    $extra_array = $report->extra;


                    $extra_array = json_decode($extra_array);

                    if (in_array("Deposit Date", $extra_array)) $r_arr["Deposit Date"] = Carbon::parse($line->created_at)->format('m/d/Y');
                    if (in_array("Payee Type", $extra_array)) $r_arr["Payee Type"] = $dep_type;
                    if (in_array("Payee Name", $extra_array)) $r_arr["Payee Name"] = isset($payor_name) ? $payor_name->payor_name : '';
                    if (in_array("Check Date", $extra_array)) $r_arr["Check Date"] = Carbon::parse($dep->deposit_date)->format('m/d/Y');
                    if (in_array("Check Number", $extra_array)) $r_arr["Check Number"] = $line->instrument;
                    if (in_array("Check Amount", $extra_array)) $r_arr["Check Amount"] = $line->amount;
                    if (in_array("Allocated Check Amount", $extra_array)) $r_arr["Allocated Check Amount"] = $all_amount;
                    if (in_array("Unallocated Amount", $extra_array)) $r_arr["Unallocated Amount"] = $line->unapplied_amount;
                    if (in_array("Patient Name", $extra_array)) $r_arr["Patient Name"] = $client->full_name;
                    if (in_array("DOS", $extra_array)) $r_arr["DOS"] = Carbon::parse($line->dos)->format('m/d/Y');
                    if (in_array("Payment Amount", $extra_array)) $r_arr["Payment Amount"] = $line->payment;
                    if (in_array("Adjustment Amount", $extra_array)) $r_arr["Adjustment Amount"] = $line->adjustment;
                    if (in_array("Tx Type", $extra_array)) $r_arr["Tx Type"] = $tx_type;
                    if (in_array("Description", $extra_array)) $r_arr["Description"] = $dep->notes;

                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 4) {
                $data = Batching_claim::where('admin_id', $report->admin_id);

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('schedule_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('schedule_date', '>=', $date_from)->where('schedule_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {

                    $client = Client::where('id', $line->client_id)->first();
                    $payor_name = All_payor::where('id', $line->payor_id)->first();
                    $act = Client_authorization_activity::where('id', $line->activity_id)->first();
                    $emp = Employee::where('id', $line->provider_id)->first();
                    $auth = Client_authorization::where('id', $line->authorization_id)->first();
                    if ($auth) {
                        $ren_em = Employee::where('id', $auth->supervisor_id)->first();
                    }
                    $zone = setting_name_location_box_two::where('id', $client->zone)->first();
                    $manage_claim_tran = manage_claim_transaction::where('appointment_id', $line->appointment_id)->first();
                    $extra_array = $report->extra;


                    $extra_array = json_decode($extra_array);
                    if (in_array("Patient Last name", $extra_array)) $r_arr["Patient Last name"] = $client->client_last_name;
                    if (in_array("Patient First name", $extra_array)) $r_arr["Patient First name"] = $client->client_first_name;
                    if (in_array("Session Rendered Date", $extra_array)) $r_arr["Session Rendered Date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Start Time", $extra_array)) $r_arr["Start Time"] = Carbon::parse($line->from_time)->format('m/d/Y');
                    if (in_array("End Time", $extra_array)) $r_arr["End Time"] = Carbon::parse($line->to_time)->format('m/d/Y');
                    if (in_array("Payor Name", $extra_array)) $r_arr["Payor Name"] = isset($payor_name) ? $payor_name->payor_name : '';
                    if (in_array("Activity", $extra_array)) $r_arr["Activity"] = isset($act) ? $act->activity_name : '';
                    if (in_array("Description", $extra_array)) $r_arr["Description"] = $line->notes;
                    if (in_array("Staff last name", $extra_array)) $r_arr["Staff last name"] = isset($emp) ? $emp->last_name : "";
                    if (in_array("Staff first name", $extra_array)) $r_arr["Staff first name"] = isset($emp) ? $emp->first_name : "";
                    if (in_array("Render Last name", $extra_array)) $r_arr["Render Last name"] = isset($ren_em) ? $ren_em->last_name : '';
                    if (in_array("Render First name", $extra_array)) $r_arr["Render First name"] = isset($ren_em) ? $ren_em->first_name : '';
                    if (in_array("Rendering Provider Degree", $extra_array)) $r_arr["Rendering Provider Degree"] = isset($ren_em) ? $ren_em->credential_type : '';
                    if (in_array("Zone", $extra_array)) $r_arr["Zone"] = isset($zone) ? $zone->zone_name : '';
                    if (in_array("CPT", $extra_array)) $r_arr["CPT"] = $line->cpt_code;
                    if (in_array("Modifier", $extra_array)) $r_arr["Modifier"] = $line->m1;
                    if (in_array("Individual Npi", $extra_array)) $r_arr["Individual Npi"] = isset($ren_em) ? $ren_em->individual_npi : '';
                    if (in_array("DOB", $extra_array)) $r_arr["DOB"] = Carbon::parse($client->dob)->format('m/d/Y');
                    if (in_array("Pos", $extra_array)) $r_arr["Pos"] = $line->location;
                    if (in_array("Charge per unit", $extra_array)) $r_arr["Charge per unit"] = $line->rate;
                    if (in_array("Units", $extra_array)) $r_arr["Units"] = $line->units;
                    if (in_array("Total", $extra_array)) $r_arr["Total"] = $line->rate * $line->units;
                    if (in_array("Original Bill Date Created", $extra_array)) $r_arr["Original Bill Date Created"] = isset($manage_claim_tran) && $manage_claim_tran->billed_date != null ? Carbon::parse($manage_claim_tran->billed_date)->format('m/d/Y') : '';
                    if (in_array("Resubmitted Date", $extra_array)) $r_arr["Resubmitted Date"] = isset($manage_claim_tran) && $manage_claim_tran->resubmit_date != null ? Carbon::parse($manage_claim_tran->resubmit_date)->format('/m/d/Y') : '';
                    if (in_array("Auth Number", $extra_array)) $r_arr["Auth Number"] = $auth->authorization_number;
                    if (in_array("Billing Modifier2", $extra_array)) $r_arr["Billing Modifier2"] = $line->m2;
                    if (in_array("Billing Modifier3", $extra_array)) $r_arr["Billing Modifier3"] = $line->m3;
                    if (in_array("Billing Modifier4", $extra_array)) $r_arr["Billing Modifier4"] = $line->m4;
                    if (in_array("Uci", $extra_array)) $r_arr["Uci"] = $auth->uci_id;
                    if (in_array("Claim#", $extra_array)) $r_arr["Claim#"] = isset($manage_claim_tran) ? $manage_claim_tran->claim_id : '';

                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 5) {
                $data = Batching_claim::where('admin_id', $report->admin_id)
                    ->where('is_mark_gen', 0);
                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('schedule_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('schedule_date', '>=', $date_from)->where('schedule_date', '<=', $date_to);
                }

                $data = $data->get();
                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {

                    $client = Client::where('id', $line->client_id)->first();
                    $payor_name = All_payor::where('id', $line->payor_id)->first();
                    $act = Client_authorization_activity::where('id', $line->activity_id)->first();
                    $emp = Employee::where('id', $line->provider_id)->first();
                    $auth = Client_authorization::where('id', $line->authorization_id)->first();
                    if ($auth) {
                        $ren_em = Employee::where('id', $auth->supervisor_id)->first();
                    }
                    $zone = setting_name_location_box_two::where('id', $client->zone)->first();
                    $manage_claim_tran = manage_claim_transaction::where('appointment_id', $line->appointment_id)->first();
                    $con_rate = rate_list::where('payor_id', $line->payor_id)->where('cpt_code', $line->cpt)->where('m1', $line->m1)->first();
                    $provider = Employee::where('id', $line->cms_24j)->first();
                    $act_provider = Employee::where('id', $line->provider_id)->first();

                    $hrs = Appoinment::where('admin_id', $line->admin_id)
                        ->where('client_id', $line->client_id)
                        ->where('authorization_activity_id', $act->id)
                        ->sum('time_duration');
                    $hrs = $hrs / 60;

                    $extra_array = $report->extra;

                    $extra_array = json_decode($extra_array);
                    if (in_array("Patient Last name", $extra_array)) $r_arr["Patient Last name"] = $client->client_last_name;
                    if (in_array("Patient First name", $extra_array)) $r_arr["Patient First name"] = $client->client_first_name;
                    if (in_array("Activity rendered date", $extra_array)) $r_arr["Activity rendered date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Activity", $extra_array)) $r_arr["Activity"] = isset($act) ? $act->activity_name : '';
                    if (in_array("CPT", $extra_array)) $r_arr["CPT"] = $line->cpt;
                    if (in_array("M1", $extra_array)) $r_arr["M1"] = $line->m1;
                    if (in_array("M2", $extra_array)) $r_arr["M2"] = $line->m2;
                    if (in_array("POS", $extra_array)) $r_arr["POS"] = $line->location;
                    if (in_array("Units", $extra_array)) $r_arr["Units"] = $line->units;
                    if (in_array("Charge per unit", $extra_array)) $r_arr["Charge per unit"] = $line->rate;
                    if (in_array("Contracted rate", $extra_array)) $r_arr["Contracted rate"] = isset($con_rate) ? $con_rate->contracted_rate : '';
                    if (in_array("Billed Rate", $extra_array)) $r_arr["Billed Rate"] = $line->billed_am;
                    if (in_array("Total Charge", $extra_array)) $r_arr["Total Charge"] = $line->rate * $line->units;
                    if (in_array("JLast Name", $extra_array)) $r_arr["JLast Name"] = $act_provider->last_name; //add
                    if (in_array("JFirst Name", $extra_array)) $r_arr["JFirst Name"] = $act_provider->first_name; //add
                    if (in_array("JNPI", $extra_array)) $r_arr["JNPI"] = $act_provider->individual_npi; //add
                    if (in_array("Hours", $extra_array)) $r_arr["Hours"] = $hrs; //add
                    if (in_array("Auth number", $extra_array)) $r_arr["Auth number"] = $auth->authorization_number;
                    if (in_array("Auth start date", $extra_array)) $r_arr["Auth start date"] = Carbon::parse($auth->onset_date)->format('m/d/');
                    if (in_array("Auth end date", $extra_array)) $r_arr["Auth end date"] = Carbon::parse($auth->end_date)->format('m/d/');
                    if (in_array("Supervisor Last Name", $extra_array)) $r_arr["Supervisor Last Name"] = $ren_em->last_name;
                    if (in_array("Supervisor First Name", $extra_array)) $r_arr["Supervisor First Name"] = $ren_em->first_name;
                    if (in_array("Render Last name", $extra_array)) $r_arr["Render Last name"] = $provider->last_name;
                    if (in_array("Render First name'", $extra_array)) $r_arr["Render First name"] = $provider->last_name;
                    if (in_array("Highest Degree", $extra_array)) $r_arr["Highest Degree"] = $act_provider->credential_type;
                    if (in_array("Start Time", $extra_array)) $r_arr["Start Time"] = Carbon::parse($line->from_time)->format('m/d/');
                    if (in_array("End Time", $extra_array)) $r_arr["End Time"] = Carbon::parse($line->to_time)->format('m/d/');
                    if (in_array("Payor Name", $extra_array)) $r_arr["Payor Name"] = isset($payor_name) ? $payor_name->payor_name : '';
                    if (in_array("Zone", $extra_array)) $r_arr["Zone"] = isset($zone) ? $zone->zone_name : '';
                    if (in_array("DOB", $extra_array)) $r_arr["DOB"] = Carbon::parse($client->dob)->format('m/d/Y');
                    if (in_array("Uci", $extra_array)) $r_arr["Uci"] = $auth->uci_id;

                    return $r_arr;

                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 6) {
                $data = Client_authorization::where('admin_id', $report->admin_id);
                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('onset_date', $s_date)->orWhere('end_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('onset_date', '>=', $date_from)->where('end_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::select('id', 'client_full_name')->where('admin_id', $line->admin_id)->where('id', $line->client_id)->first();
                    $zone = setting_name_location_box_two::select('zone_name')->where('id', $client->zone)->first();
                    $act = Client_authorization_activity::select('id', 'activity_name', 'hours_max_one', 'hours_max_is_one')
                        ->where('authorization_id', $line->id)
                        ->first();
                    $payor = All_payor::where('id', $line->payor_id)->first();
                    $emp_sub = Employee::where('id', $line->supervisor_id)->first();

                    $scheduled_hrs_get = Appoinment::where('admin_id', $line->admin_id)
                        ->where('client_id', $line->client_id)
                        ->where('authorization_activity_id', $line->id)
                        ->sum('time_duration');
                    $rendered_hrs_get = Appoinment::where('admin_id', $line->admin_id)
                        ->where('client_id', $line->client_id)
                        ->where('authorization_activity_id', $line->id)
                        ->where('status', 'Rendered')
                        ->sum('time_duration');
                    $scheduled_hrs = $scheduled_hrs_get / 60;
                    $rendered_hrs = $rendered_hrs_get / 60;

                    if ($act) {
                        $total_hrs = $act->hours_max_is_one;
                        $rem_hours = $act->hours_max_is_one - $scheduled_hrs;
                    } else {
                        $total_hrs = 0.00;
                        $rem_hours = 0.00;
                    }

                    $extra_array = $report->extra;

                    $extra_array = json_decode($extra_array);
                    if (in_array("Patient Name", $extra_array)) $r_arr["Patient Name"] = $client->client_full_name;
                    if (in_array("Zone name", $extra_array)) $r_arr["Zone name"] = isset($zone) ? $zone->zone_name : '';
                    if (in_array("Activity Type", $extra_array)) $r_arr["Activity Type"] = isset($act) ? $act->activity_name : '';
                    if (in_array("Payor", $extra_array)) $r_arr["Payor"] = isset($payor) ? $payor->payor_name : '';
                    if (in_array("Supervisor", $extra_array)) $r_arr["Supervisor"] = $emp_sub->full_name;
                    if (in_array("Start date", $extra_array)) $r_arr["Start date"] = Carbon::parse($line->onset_date)->format('m/d/Y');
                    if (in_array("End date", $extra_array)) $r_arr["End date"] = Carbon::parse($line->end_date)->format('m/d/Y');
                    if (in_array("Frequency", $extra_array)) $r_arr["Frequency"] = isset($act) ? $act->hours_max_one == 1 ? 'Hours' : 'Unit' : null;
                    if (in_array("Hours total", $extra_array)) $r_arr["Hours total"] = $total_hrs;
                    if (in_array("Total Scheduled", $extra_array)) $r_arr["Total Scheduled"] = $scheduled_hrs;
                    if (in_array("Scheduled Units", $extra_array)) $r_arr["Scheduled Units"] = "";
                    if (in_array("Total Rendered", $extra_array)) $r_arr["Total Rendered"] = $rendered_hrs;
                    if (in_array("Rendered Units", $extra_array)) $r_arr["Rendered Units"] = "";
                    if (in_array("Remaining To Sch", $extra_array)) $r_arr["Remaining To Sch"] = $rem_hours;

                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 7) {/*
                $ledger_lists = ledger_list::where('admin_id', $report->admin_id)->get();

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                } else if ($report->date_type == 2) {
                    $date_from = $report->date_from;
                    $date_to = $report->date_to;
                }

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($ledger_lists))->export($name, function ($line) use ($report) {

                    $extra_array = $report->extra;
                    if ($extra_array == null) {
                        $r_arr = [
                            'Last name' => "",
                            'First name' => "",
                            'Supervisor last name' => "",
                            'Supervisor first name' => "",
                            'Zone' => "",
                            'UCI Insurance' => "",
                            'Vendor' => "",
                            'Auth' => "",
                            'Auth Start' => "",
                            'Auth End' => "",
                            'Payor' => "",
                            'Activity type' => "",
                            'Sub type' => "",
                            'Activity auth start' => "",
                            'Activity auth end' => "",
                            'Rate per' => "",
                            'Mins In Unit' => "",
                            'Rate' => "",
                            'Service code' => "",
                            'Max By' => "",
                            'Freq' => "",
                            'Value' => "",
                            'Gender' => "",
                            'Dob' => "",
                            'Address1' => "",
                            'Address2' => "",
                            'City' => "",
                            'State' => "",
                            'Zip' => "",
                            'Phone1' => "",
                            'Phone2' => "",
                            'Patient id' => "",
                            'Episode id' => "",
                            'Auth id' => "",
                            'Auth details regional id' => "",
                            'Auth details regional max id' => "",
                            'Facility id' => "",
                            'Is primaryauth' => "",
                            'PlaceHolder' => "",
                            'External Acct Number' => "",
                            'Custom1' => "",
                            'Service Coordinator' => "",
                            'Service Sub Code' => "",
                            'Correspondance email' => "",
                        ];
                    } else {
                        $extra_array = json_decode($extra_array);

                        if (in_array("Last name", $extra_array)) $r_arr["Last name"] = "";
                        if (in_array("First name", $extra_array)) $r_arr["First name"] = "";
                        if (in_array("Supervisor last name", $extra_array)) $r_arr["Supervisor last name"] = "";
                        if (in_array("Supervisor first name", $extra_array)) $r_arr["Supervisor first name"] = "";
                        if (in_array("Zone", $extra_array)) $r_arr["Zone"] = "";
                        if (in_array("UCI Insurance", $extra_array)) $r_arr["UCI Insurance"] = "";
                        if (in_array("Vendor", $extra_array)) $r_arr["Vendor"] = "";
                        if (in_array("Auth", $extra_array)) $r_arr["Auth"] = "";
                        if (in_array("Auth Start", $extra_array)) $r_arr["Auth Start"] = "";
                        if (in_array("Auth End", $extra_array)) $r_arr["Auth End"] = "";
                        if (in_array("Payor", $extra_array)) $r_arr["Payor"] = "";
                        if (in_array("Activity type", $extra_array)) $r_arr["Activity type"] = "";
                        if (in_array("Sub type", $extra_array)) $r_arr["Sub type"] = "";
                        if (in_array("Activity auth start", $extra_array)) $r_arr["Activity auth start"] = "";
                        if (in_array("Activity auth end", $extra_array)) $r_arr["Activity auth end"] = "";
                        if (in_array("Rate per", $extra_array)) $r_arr["Rate per"] = "";
                        if (in_array("Mins In Unit", $extra_array)) $r_arr["Mins In Unit"] = "";
                        if (in_array("Rate", $extra_array)) $r_arr["Rate"] = "";
                        if (in_array("Service code", $extra_array)) $r_arr["Service code"] = "";
                        if (in_array("Max By", $extra_array)) $r_arr["Max By"] = "";
                        if (in_array("Freq", $extra_array)) $r_arr["Freq"] = "";
                        if (in_array("Value", $extra_array)) $r_arr["Value"] = "";
                        if (in_array("Gender", $extra_array)) $r_arr["Gender"] = "";
                        if (in_array("Dob", $extra_array)) $r_arr["Dob"] = "";
                        if (in_array("Address1", $extra_array)) $r_arr["Address1"] = "";
                        if (in_array("Address2", $extra_array)) $r_arr["Address2"] = "";
                        if (in_array("City", $extra_array)) $r_arr["City"] = "";
                        if (in_array("State", $extra_array)) $r_arr["State"] = "";
                        if (in_array("Zip", $extra_array)) $r_arr["Zip"] = "";
                        if (in_array("Phone1", $extra_array)) $r_arr["Phone1"] = "";
                        if (in_array("Phone2", $extra_array)) $r_arr["Phone2"] = "";
                        if (in_array("Patient id", $extra_array)) $r_arr["Patient id"] = "";
                        if (in_array("Episode id", $extra_array)) $r_arr["Episode id"] = "";
                        if (in_array("Auth id", $extra_array)) $r_arr["Auth id"] = "";
                        if (in_array("Auth details regional id", $extra_array)) $r_arr["Auth details regional id"] = "";
                        if (in_array("Auth details regional max id", $extra_array)) $r_arr["Auth details regional max id"] = "";
                        if (in_array("Facility id", $extra_array)) $r_arr["Facility id"] = "";
                        if (in_array("Is primaryauth", $extra_array)) $r_arr["Is primaryauth"] = "";
                        if (in_array("PlaceHolder", $extra_array)) $r_arr["PlaceHolder"] = "";
                        if (in_array("External Acct Number", $extra_array)) $r_arr["External Acct Number"] = "";
                        if (in_array("Custom1", $extra_array)) $r_arr["Custom1"] = "";
                        if (in_array("Service Coordinator", $extra_array)) $r_arr["Service Coordinator"] = "";
                        if (in_array("Service Sub Code", $extra_array)) $r_arr["Service Sub Code"] = "";
                        if (in_array("Correspondance email", $extra_array)) $r_arr["Correspondance email"] = "";
                    }

                    return $r_arr;
                });
                    Mail::to($to)->send(new ReportConfirmMail($data_arr));
                */
            } elseif ($report->report_type == 8) {
                $data = Appoinment::where('admin_id', $report->admin_id);

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('schedule_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('schedule_date', '>=', $date_from)->where('schedule_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::where('id', $line->client_id)->first();
                    $act = Client_authorization_activity::where('id', $line->authorization_activity_id)->first();

                    $cl_info = client_info::where('client_id', $client->id)->first();
                    $rel = $cl_info->client_relationship;

                    $extra_array = $report->extra;

                    $extra_array = json_decode($extra_array);

                    if (in_array("Patient Last Name", $extra_array)) $r_arr["Patient Last Name"] = $client->client_first_name;
                    if (in_array("Patient First Name", $extra_array)) $r_arr["Patient First Name"] = $client->client_last_name;
                    if (in_array("Activity Type", $extra_array)) $r_arr["Activity Type"] = $act->activity_name;
                    if (in_array("Activity scheduled date", $extra_array)) $r_arr["Activity scheduled date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Subtype", $extra_array)) $r_arr["Subtype"] = $act->activity_two;
                    if (in_array("Render Date", $extra_array)) $r_arr["Render Date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Service Type", $extra_array)) $r_arr["Service Type"] = $line->billable = 1 ? 'Billable' : 'Non-billable';
                    if (in_array("Service Type Code", $extra_array)) $r_arr["Service Type Code"] = $line->cpt_code;
                    if (in_array("Related To Patient", $extra_array)) $r_arr["Related To Patient"] = $rel;
                    if (in_array("Has Signature", $extra_array)) $r_arr["Has Signature"] = "";
                    if (in_array("Activity Status", $extra_array)) $r_arr["Activity Status"] = $line->status;
                    if (in_array("Hours Rendered", $extra_array)) $r_arr["Hours Rendered"] = $line->time_duration;

                    return $r_arr;
                });

                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 9) {
                $data = Appoinment::where('admin_id', $report->admin_id);

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('schedule_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('schedule_date', '>=', $date_from)->where('schedule_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::where('id', $line->client_id)->first();
                    $staff = Employee::where('id', $line->provider_id)->first();
                    $payor = All_payor::where('id', $line->payor_id)->first();
                    $auth = Client_authorization::where('client_id', $line->client_id)->first();
                    $act = Client_authorization_activity::where('client_id', $line->client_id)->first();
                    if ($client) {
                        $zone = setting_name_location_box_two::where('id', $client->zone)->first();
                    }
                    if ($auth) {
                        $sup = Employee::where('id', $auth->supervisor_id)->first();
                    }

                    $admin = Admin::where('id', $line->admin_id)->first();

                    $extra_array = $report->extra;


                    $extra_array = json_decode($extra_array);


                    if (in_array("Patient First Name", $extra_array)) $r_arr["Patient First Name"] = $client->client_first_name;
                    if (in_array("Patient Last name", $extra_array)) $r_arr["Patient Last name"] = $client->client_last_name;
                    if (in_array("Middle name", $extra_array)) $r_arr["Middle name"] = $client->client_middle;
                    if (in_array("Staff Last name", $extra_array)) $r_arr["Staff Last name"] = $staff->last_name;
                    if (in_array("Staff First name", $extra_array)) $r_arr["Staff First name"] = $staff->first_name;
                    if (in_array("Payor", $extra_array)) $r_arr["Payor"] = $payor->payor_name;
                    if (in_array("Activity type", $extra_array)) $r_arr["Activity type"] = $auth->authorization_name;
                    if (in_array("Activity Sub Type", $extra_array)) $r_arr["Activity Sub Type"] = $act->activity_name;
                    if (in_array("Schedule Date", $extra_array)) $r_arr["Schedule Date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Render Date", $extra_array)) $r_arr["Render Date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Render End Date", $extra_array)) $r_arr["Render End Date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Location", $extra_array)) $r_arr["Location"] = $line->location;
                    if (in_array("Status", $extra_array)) $r_arr["Status"] = $line->status;
                    if (in_array("Duration", $extra_array)) $r_arr["Duration Sch"] = $line->time_duration;
                    if (in_array("Zone name", $extra_array)) $r_arr["Zone name"] = isset($zone) ? $zone->zone_name : '';
                    if (in_array("Supervisor last name", $extra_array)) $r_arr["Supervisor last name"] = $sup->last_name;
                    if (in_array("Supervisor first name", $extra_array)) $r_arr["Supervisor first name"] = $sup->first_name;
                    if (in_array("Created By", $extra_array)) $r_arr["Created By"] = $admin->first_name . ' ' . $admin->last_name;
                    if (in_array("Create Date", $extra_array)) $r_arr["Create Date"] = Carbon::parse($line->created_at)->format('m/d/Y');
                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 10) {
                $data = Appoinment::where('admin_id', $report->admin_id);

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('schedule_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('schedule_date', '>=', $date_from)->where('schedule_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::where('id', $line->client_id)->first();
                    $staff = Employee::where('id', $line->provider_id)->first();
                    $payor = All_payor::where('id', $line->payor_id)->first();
                    $auth = Client_authorization::where('id', $line->authorization_id)->first();
                    $act = Client_authorization_activity::where('id', $line->authorization_activity_id)->first();
                    if ($client) {
                        $zone = setting_name_location_box_two::where('id', $client->zone)->first();
                    }
                    if ($auth) {
                        $sup = Employee::where('id', $auth->supervisor_id)->first();
                    }

                    $admin = Admin::where('id', $line->admin_id)->first();
                    $extra_array = $report->extra;
                    $extra_array = json_decode($extra_array);

                    if (in_array("Patient First Name", $extra_array)) $r_arr["Patient First Name"] = $client->client_first_name;
                    if (in_array("Patient Last name", $extra_array)) $r_arr["Patient Last name"] = $client->client_last_name;
                    if (in_array("Middle name", $extra_array)) $r_arr["Middle name"] = $client->client_middle;
                    if (in_array("Staff Last name", $extra_array)) $r_arr["Staff Last name"] = $staff->last_name;
                    if (in_array("Staff First name", $extra_array)) $r_arr["Staff First name"] = $staff->first_name;
                    if (in_array("Payor", $extra_array)) $r_arr["Payor"] = $payor->payor_name;
                    if (in_array("Activity type", $extra_array)) $r_arr["Activity type"] = $auth->authorization_name;
                    if (in_array("Activity Sub Type", $extra_array)) $r_arr["Activity Sub Type"] = $act->activity_name;
                    if (in_array("Schedule Date", $extra_array)) $r_arr["Schedule Date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Render Date", $extra_array)) $r_arr["Render Date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Location", $extra_array)) $r_arr["Location"] = $line->location;
                    if (in_array("Status", $extra_array)) $r_arr["Status"] = $line->status;
                    if (in_array("Duration", $extra_array)) $r_arr["Duration"] = $line->time_duration;
                    if (in_array("Supervisor Last name", $extra_array)) $r_arr["Supervisor last name"] = $sup->last_name;
                    if (in_array("Supervisor First name", $extra_array)) $r_arr["Supervisor first name"] = $sup->first_name;

                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 11) {
                $data = Appoinment::where('admin_id', $report->admin_id);

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('schedule_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('schedule_date', '>=', $date_from)->where('schedule_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::where('id', $line->client_id)->first();
                    $staff = Employee::where('id', $line->provider_id)->first();
                    $payor = All_payor::where('id', $line->payor_id)->first();
                    $auth = Client_authorization::where('id', $line->authorization_id)->first();
                    $act = Client_authorization_activity::where('id', $line->authorization_activity_id)->first();
                    if ($client) {
                        $zone = setting_name_location_box_two::where('id', $client->zone)->first();
                    }
                    if ($auth) {
                        $sup = Employee::where('id', $auth->supervisor_id)->first();
                    }

                    $admin = Admin::where('id', $line->admin_id)->first();
                    $extra_array = $report->extra;

                    $extra_array = json_decode($extra_array);

                    if (in_array("Patient First Name", $extra_array)) $r_arr["Patient First Name"] = $client->client_first_name;
                    if (in_array("Patient Last name", $extra_array)) $r_arr["Patient Last name"] = $client->client_last_name;
                    if (in_array("Middle name", $extra_array)) $r_arr["Middle name"] = $client->client_middle;
                    if (in_array("Staff Last name", $extra_array)) $r_arr["Staff Last name"] = $staff->last_name;
                    if (in_array("Staff First name", $extra_array)) $r_arr["Staff First name"] = $staff->first_name;
                    if (in_array("Payor", $extra_array)) $r_arr["Payor"] = $payor->payor_name;
                    if (in_array("Activity type", $extra_array)) $r_arr["Activity type"] = $auth->authorization_name;
                    if (in_array("Activity Sub Type", $extra_array)) $r_arr["Activity Sub Type"] = $act->activity_name;
                    if (in_array("Schedule Date", $extra_array)) $r_arr["Schedule Date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Render Date", $extra_array)) $r_arr["Render Date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Location", $extra_array)) $r_arr["Location"] = $line->location;
                    if (in_array("Status", $extra_array)) $r_arr["Status"] = $line->status;
                    if (in_array("Duration", $extra_array)) $r_arr["Duration"] = $line->time_duration;
                    if (in_array("Zone", $extra_array)) $r_arr["Zone"] = isset($zone) ? $zone->zone_name : '';
                    if (in_array("Supervisor Last name", $extra_array)) $r_arr["Supervisor Last name"] = $sup->last_name;
                    if (in_array("Supervisor First name", $extra_array)) $r_arr["Supervisor First name"] = $sup->first_name;
                    if (in_array("Create Date", $extra_array)) $r_arr["Create Date"] = Carbon::parse($line->created_at)->format('m/d/Y');

                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 12) {
                $data = Appoinment::where('admin_id', $report->admin_id);

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('schedule_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('schedule_date', '>=', $date_from)->where('schedule_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::where('id', $line->client_id)->first();
                    $staff = Employee::where('id', $line->provider_id)->first();
                    $payor = All_payor::where('id', $line->payor_id)->first();
                    $auth = Client_authorization::where('id', $line->authorization_id)->first();
                    $act = Client_authorization_activity::where('id', $line->authorization_activity_id)->first();
                    $extra_array = $report->extra;

                    $extra_array = json_decode($extra_array);

                    if (in_array("Patient First Name", $extra_array)) $r_arr["Patient First Name"] = isset($client) ? $client->client_first_name : '';
                    if (in_array("Patient Last name", $extra_array)) $r_arr["Patient Last name"] = isset($client) ? $client->client_last_name : '';
                    if (in_array("Staff Last name", $extra_array)) $r_arr["Staff Last name"] = isset($staff) ? $staff->last_name : '';
                    if (in_array("Staff First name", $extra_array)) $r_arr["Staff First name"] = isset($staff) ? $staff->first_name : '';
                    if (in_array("Payor", $extra_array)) $r_arr["Payor"] = isset($payor) ? $payor->payor_name : '';
                    if (in_array("Cpt code", $extra_array)) $r_arr["Cpt code"] = $line->cpt_code;
                    if (in_array("Activity type", $extra_array)) $r_arr["Activity type"] = isset($auth) ? $auth->authorization_name : '';
                    if (in_array("Activity Sub Type", $extra_array)) $r_arr["Activity Sub Type"] = isset($act) ? $act->activity_name : '';
                    if (in_array("Schedule Date", $extra_array)) $r_arr["Schedule Date"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("Render Date From", $extra_array)) $r_arr["Render Date From"] = Carbon::parse($line->from_time)->format('m/d/Y');
                    if (in_array("Render Date TO", $extra_array)) $r_arr["Render Date TO"] = Carbon::parse($line->to_time)->format('m/d/Y');
                    if (in_array("Duration Render in Hours", $extra_array)) $r_arr["Duration Render in Hours"] = $line->time_duration;
                    if (in_array("Location", $extra_array)) $r_arr["Location"] = $line->location;
                    if (in_array("Status", $extra_array)) $r_arr["Status"] = $line->status;
                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 13) {
                if ($report->date_type == 2) {
                    $ledger_lists = ledger_list::where('admin_id', $report->admin_id)
                        ->where('schedule_date', '>=', $report->form_date)
                        ->where('schedule_date', '<=', $report->to_date)
                        ->get();
                } elseif ($report->date_type == 1) {
                    $ledger_lists = ledger_list::where('admin_id', $report->admin_id)->where('schedule_date', $report->s_date)->get();
                } else {

                }

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($ledger_lists))->export($name, function ($line) {
                    $client = Client::select('id', 'client_full_name', 'client_dob')->where('id', $line->client_id)->first();
                    $provider = Employee::select('id', 'full_name')->where('id', $line->provider_id)->first();
                    $auth = Client_authorization::select('id', 'uci_id', 'onset_date', 'end_date', 'authorization_number', 'supervisor_id')->where('id', $line->authorization_id)->first();
                    $super = Employee::select('id', 'full_name')->where('id', $auth->supervisor_id)->first();
                    $adj = deposit_apply::select('payment', 'batching_claim_id')->where('batching_claim_id', $line->batching_id)->sum('payment');
                    $copay = deposit_apply_transaction::select('balance', 'batching_claim_id', 'status')->where('batching_claim_id', $line->batching_id)->where('status', "PR Copay")->sum('balance');
                    $coins = deposit_apply_transaction::select('batching_claim_id', 'status', 'balance')->where('batching_claim_id', $line->batching_id)->where('status', "PR CoIns")->sum('balance');
                    $deduct = deposit_apply_transaction::select('batching_claim_id', 'status', 'balance')->where('batching_claim_id', $line->batching_id)->where('status', "PR Ded")->sum('balance');
                    $claim = manage_claim_transaction::select('admin_id', 'claim_id', 'baching_id')->where('baching_id', $line->batching_id)->where('admin_id', $line->admin_id)->first();
                    $ledger_note = ledger_note::where('ledger_id', $line->id)->first();
                    $zone = setting_name_location_box_two::where('id', $client->zone)->where('admin_id', $client->admin_id)->first();
                    $dep = deposit::where('id', $line->deopsit_id)->first();
                    $payor_name = All_payor_detail::where('payor_id', $line->payor_id)->where('admin_id', $line->admin_id)->first();
                    $name_loca = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $line->admin_id)->first();
                    $total_am = 0;
                    $total_pay = 0;
                    $total_adj = 0;
                    $total_bal = 0;

                    if ($name_loca->is_combo == 1) {
                        $deposit_aplly_1 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('cpt', $line->cpt)
                            ->where('admin_id', $line->admin_id)
                            ->first();


                        $deposit_aplly_2 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id', 'deopsit_id')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('cpt', $line->cpt)
                            ->where('admin_id', $line->admin_id)
                            ->first();
                    } else {
                        $deposit_aplly_1 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('admin_id', $line->admin_id)
                            ->first();


                        $deposit_aplly_2 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id', 'deopsit_id')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('admin_id', $line->admin_id)
                            ->first();
                    }


                    if ($deposit_aplly_2) {
                        $dep_data_single = deposit::where('id', $deposit_aplly_2->deopsit_id)->first();
                    } else {
                        $dep_data_single = deposit::where('id', 0)->first();
                    }


                    $check_dep_data = deposit_apply::distinct()->select('deopsit_id', 'appointment_id', 'dos', 'admin_id')
                        ->where('appointment_id', $line->appointment_id)
                        ->where('dos', $line->schedule_date)
                        ->where('admin_id', $line->admin_id)
                        ->first();

                    if ($name_loca->is_combo == 1) {
                        $last_status = deposit_apply::select('id', 'appointment_id', 'dos', 'admin_id', 'status')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('cpt', $line->cpt)
                            ->where('admin_id', $line->admin_id)
                            ->orderBy('id', 'desc')
                            ->first();

                        $billed_am = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('admin_id', $line->admin_id)
                            ->where('cpt', $line->cpt)
                            ->sum('billed_am');


                        $deposit_aplly_pay = deposit_apply::select('appointment_id', 'dos', 'admin_id')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('admin_id', $line->admin_id)
                            ->where('cpt', $line->cpt)
                            ->sum('payment');

                        $deposit_aplly_adj = deposit_apply::select('appointment_id', 'dos', 'amount')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('admin_id', $line->admin_id)
                            ->where('cpt', $line->cpt)
                            ->sum('adjustment');
                    } else {
                        $last_status = deposit_apply::select('id', 'appointment_id', 'dos', 'admin_id', 'status')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('admin_id', $line->admin_id)
                            ->orderBy('id', 'desc')
                            ->first();


                        $billed_am = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('admin_id', $line->admin_id)
                            ->sum('billed_am');


                        $deposit_aplly_pay = deposit_apply::select('appointment_id', 'dos', 'admin_id')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('admin_id', $line->admin_id)
                            ->sum('payment');

                        $deposit_aplly_adj = deposit_apply::select('appointment_id', 'dos', 'amount')
                            ->where('appointment_id', $line->appointment_id)
                            ->where('dos', $line->schedule_date)
                            ->where('admin_id', $line->admin_id)
                            ->sum('adjustment');
                    }


                    $v1 = "PR CoIns";
                    $v2 = "PR Copay";
                    $v3 = "PR Ded";

                    if ($name_loca->is_combo == 1) {
                        $check_who_paid = deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'dos', 'who_paid', 'client_id', 'payment')
                            ->where('batching_claim_id', $line->batching_id)
                            ->where('cpt', $line->cpt)
                            ->where('admin_id', $line->admin_id)
                            ->get();
                    } else {
                        $check_who_paid = deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'dos', 'who_paid', 'client_id', 'payment')
                            ->where('batching_claim_id', $line->batching_id)
                            ->where('admin_id', $line->admin_id)
                            ->get();
                    }


                    $sum_pt_bal = deposit_apply::select('appointment_id', 'dos', 'amount')
                        ->where('appointment_id', $line->appointment_id)
                        ->where('dos', $line->schedule_date)
                        ->where('admin_id', $line->admin_id)
                        ->where(function ($query) use ($v1, $v2, $v3) {
                            $query->where('status', '=', $v1);
                            $query->orWhere('status', '=', $v2);
                            $query->orWhere('status', '=', $v3);
                        })->sum('payment');


                    $t_pat_paid = 0;
                    $t_payo_paid = 0;
                    foreach ($check_who_paid as $who_paid) {
                        $check_pt = Client::select('id', 'client_full_name', 'admin_id')
                            ->where('admin_id', $who_paid->admin_id)
                            ->where('client_full_name', $who_paid->who_paid)
                            ->first();

                        if ($check_pt) {
                            $t_pat_paid += $who_paid->payment;
                        } else {
                            $t_pat_paid += 0;
                        }

                        $check_payor = All_payor_detail::select('payor_name', 'admin_id')
                            ->where('admin_id', $who_paid->admin_id)
                            ->where('payor_name', $who_paid->who_paid)
                            ->first();

                        $check_payor1 = All_payor::select('id', 'payor_name')
                            ->where('payor_name', $who_paid->who_paid)
                            ->first();

                        if ($check_payor) {
                            $t_payo_paid += $who_paid->payment;
                        } elseif ($check_payor1) {
                            $t_payo_paid += $who_paid->payment;
                        } else {
                            $t_payo_paid += 0;
                        }
                    }


                    $sub_total = $deposit_aplly_pay + $deposit_aplly_adj;
                    $balance = $billed_am - $sub_total;


                    if ($deposit_aplly_1) {
                        $total_am += $billed_am;
                        $total_pay += $deposit_aplly_pay;
                        $total_adj += $deposit_aplly_adj;
                        $total_bal += $balance;
                    } else {
                        $total_am += $line->billed_am;
                        $total_pay += 0.00;
                        $total_adj += 0.00;
                        $total_bal += $line->billed_am;
                    }


                    $final_ins_bal = $total_pay - $sum_pt_bal;

                    return [
                        'PATIENT' => $client->client_full_name,
                        'DOB' => Carbon::parse($client->client_dob)->format('m/d/Y'),
                        'THERAPIST' => isset($provider) ? $provider->full_name : '',
                        'SUPERVISOR' => isset($super) ? $super->full_name : '',
                        'INSURANCE' => isset($payor_name) ? $payor_name->payor_name : '',
                        'MEMBER ID' => isset($auth) ? $auth->uci_id : '',
                        'DOS' => $line->schedule_date,
                        'CPT' => $line->cpt,
                        'UNITS' => $line->units,
                        'BILLED DATE' => Carbon::parse($line->created_at)->format('m/d/Y'),
                        'Billed Amount' => number_format($total_am, 2),
                        'ALLOWED AMOUNT' => number_format($total_am, 2),
                        'INS PAID' => number_format($t_payo_paid, 2),
//                        'Payment Amount' => number_format($total_pay, 2),
                        'ADJUSTMENT' => number_format($total_adj, 2),
                        'PT PAID' => number_format($t_pat_paid, 2),
                        // 'SEC PAID' => 0.00,
                        'CHECK NO' => isset($dep_data_single) ? $dep_data_single->instrument : '',
                        'CHECK DATE' => isset($dep_data_single) ? Carbon::parse($dep_data_single->instrument_date)->format('m/d/Y') : '',
                        // 'INS BAL' => number_format($final_ins_bal, 2),
                        'TOTAL BAL' => number_format($total_bal, 2),
                        'STATUS' => isset($last_status) ? $last_status->status : '',
                        'COPAY' => is_numeric($copay) ? number_format($copay, 2) : 0.00,
                        'COINS' => is_numeric($coins) ? number_format($coins, 2) : 0.00,
                        'DED' => is_numeric($deduct) ? number_format($deduct, 2) : 0.00,
                        'CLAIM NO' => isset($claim) ? $claim->claim_id : '',
                        'AGING CATEGORY' => isset($ledger_note) ? $ledger_note->category_name : '',
                        'AGING NOTES' => isset($ledger_note) ? $ledger_note->notes : '',
                        'AGING WORKED DATE' => isset($ledger_note) ? $ledger_note->worked_date : '',
                        'NEXT FOLLOW UP DATE' => isset($ledger_note) ? $ledger_note->followup_date : '',
                        'LOCATION' => $line->location,
                        'ZONE' => isset($zone) ? $zone->zone_name : '',
                        'AUTH START DATE' => isset($auth) ? Carbon::parse($auth->onset_date)->format('m/d/Y') : '',
                        'AUTH END DATE' => isset($auth) ? Carbon::parse($auth->end_date)->format('m/d/Y') : '',
                        'AUTH NO' => isset($auth) ? $auth->authorization_number : '',
                    ];
                });

            } elseif ($report->report_type == 14) {/*
                $ledger_lists = ledger_list::where('admin_id', $report->admin_id)->get();

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                } else if ($report->date_type == 2) {
                    $date_from = $report->date_from;
                    $date_to = $report->date_to;
                }

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($ledger_lists))->export($name, function ($line) use ($report) {
                    $extra_array = $report->extra;
                    if ($extra_array == null) {

                        $r_arr = [
                            'Last Name' => "",
                            'First Name' => "",
                            'Payor' => "",
                            '0 to 30' => "",
                            '31 to 45' => "",
                            '46 to 60' => "",
                            '61 to 90' => "",
                            '91 to 150' => "",
                            'OLD' => "",
                            'Total' => "",
                            'Facility Id' => "",
                        ];
                    } else {
                        $extra_array = json_decode($extra_array);

                        if (in_array("Last Name", $extra_array)) $r_arr["Last Name"] = "";
                        if (in_array("First Name", $extra_array)) $r_arr["First Name"] = "";
                        if (in_array("Payor", $extra_array)) $r_arr["Payor"] = "";
                        if (in_array("0 to 30", $extra_array)) $r_arr["0 to 30"] = "";
                        if (in_array("31 to 45", $extra_array)) $r_arr["31 to 45"] = "";
                        if (in_array("46 to 60", $extra_array)) $r_arr["46 to 60"] = "";
                        if (in_array("61 to 90", $extra_array)) $r_arr["61 to 90"] = "";
                        if (in_array("91 to 150", $extra_array)) $r_arr["91 to 150"] = "";
                        if (in_array("OLD", $extra_array)) $r_arr["OLD"] = "";
                        if (in_array("Total", $extra_array)) $r_arr["Total"] = "";
                        if (in_array("Facility Id", $extra_array)) $r_arr["Facility Id"] = "";
                    }

                    return $r_arr;
                });
                    Mail::to($to)->send(new ReportConfirmMail($data_arr));
                */
            } elseif ($report->report_type == 15) {
                $data = ledger_list::where('admin_id', $report->admin_id);

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('schedule_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('schedule_date', '>=', $date_from)->where('schedule_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::where('id', $line->client_id)->first();
                    $auth = Client_authorization::where('id', $line->authorization_id)->first();
                    $claim = manage_claim_transaction::select('admin_id', 'claim_id', 'baching_id')->where('baching_id', $line->batching_id)->where('admin_id', $line->admin_id)->first();
                    $adj = deposit_apply::where('batching_claim_id', $line->batching_id)->sum('payment');
                    $ledger_note = ledger_note::where('ledger_id', $line->id)->first();
                    $payor_name = All_payor::where('id', $line->payor_id)->first();
                    $payor_name = $payor_name->payor_name;
                    $extra_array = $report->extra;

                    $extra_array = json_decode($extra_array);

                    if (in_array("Payor", $extra_array)) $r_arr["Payor"] = $payor_name;
                    if (in_array("Patient", $extra_array)) $r_arr["Patient"] = $client->client_full_name;
                    if (in_array("DOB", $extra_array)) $r_arr["DOB"] = Carbon::parse($client->client_dob)->format('m/d/Y');
                    if (in_array("Dx1", $extra_array)) $r_arr["Dx1"] = $auth->diagnosis_one;
                    if (in_array("Dx2", $extra_array)) $r_arr["Dx2"] = $auth->diagnosis_two;
                    if (in_array("Dx3", $extra_array)) $r_arr["Dx3"] = $auth->diagnosis_three;
                    if (in_array("Dx4", $extra_array)) $r_arr["Dx4"] = $auth->diagnosis_four;
                    if (in_array("DOS", $extra_array)) $r_arr["DOS"] = Carbon::parse($line->schedule_date)->format('m/d/Y');
                    if (in_array("CPT Code", $extra_array)) $r_arr["CPT Code"] = $line->cpt;
                    if (in_array("Date billed", $extra_array)) $r_arr["Date billed"] = Carbon::parse($line->billed_date)->format('m/d/');
                    if (in_array("Claim Number", $extra_array)) $r_arr["Claim Number"] = isset($claim) ? $claim->claim_id : '';
                    if (in_array("Allowed Amount", $extra_array)) $r_arr["Allowed Amount"] = $line->billed_am;
                    if (in_array("Adjustment", $extra_array)) $r_arr["Adjustment"] = $adj;
                    if (in_array("Aging Notes", $extra_array)) $r_arr["Aging Notes"] = $ledger_note->note;
                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 16) { //Having issue
                $data = rate_list::where('admin_id', $report->admin_id);

                /*if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data=$data->where('schedule_date',$s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data=$data->where('schedule_date','>=',$date_from)->where('schedule_date','<=',$date_to);
                }*/

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::where('id', $line->client_id)->first();
                    $auth = Client_authorization::where('id', $line->authorization_id)->first();
                    $act = Client_authorization_activity::where('id', $line->activity_id)->first();
                    $extra_array = $report->extra;
                    $extra_array = json_decode($extra_array);

                    if (in_array("Name", $extra_array)) $r_arr["Name"] = $client->client_full_name;
                    if (in_array("Activity Type", $extra_array)) $r_arr["Activity Type"] = $auth->authorization_name;
                    if (in_array("Sub type", $extra_array)) $r_arr["Sub type"] = $act->activity_name;
                    if (in_array("Service Code", $extra_array)) $r_arr["Service Code"] = "";//left
                    if (in_array("Cpt code", $extra_array)) $r_arr["Cpt code"] = $line->cpt;
                    if (in_array("M1", $extra_array)) $r_arr["M1"] = $line->m1;
                    if (in_array("Rate Per", $extra_array)) $r_arr["Rate Per"] = $line->rate;
                    if (in_array("Mins per unit", $extra_array)) $r_arr["Mins per unit"] = $line->rate_per;
                    if (in_array("Contracted Rate", $extra_array)) $r_arr["Contracted Rate"] = $line->contracted_rate;
                    if (in_array("Billing Rate", $extra_array)) $r_arr["Billing Rate"] = $line->billed_rate;
                    if (in_array("M2", $extra_array)) $r_arr["M2"] = $line->m2;
                    if (in_array("M3", $extra_array)) $r_arr["M3"] = $line->m3;
                    if (in_array("M4", $extra_array)) $r_arr["M4"] = $line->m4;

                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 17) {
                $data = ledger_list::where('admin_id', $report->admin_id);

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('schedule_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('schedule_date', '>=', $date_from)->where('schedule_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::where('id', $line->client_id)->first();
                    $payor = All_payor::where('id', $line->payor_id)->first();
                    $adj = deposit_apply::where('batching_claim_id', $line->batching_id)->sum('adjustment');
                    $allow = deposit_apply::where('batching_claim_id', $line->batching_id)->sum('balance');
                    $pay = deposit_apply::where('batching_claim_id', $line->batching_id)->sum('payment');
                    $ledger_note = ledger_note::where('ledger_id', $line->id)->first();

                    $total_am = 0;
                    $total_pay = 0;
                    $total_adj = 0;
                    $total_bal = 0;


                    $copay = deposit_apply::where('batching_claim_id', $line->batching_id)->where('status', "PR Copay")->sum('balance');
                    $coins = deposit_apply::where('batching_claim_id', $line->batching_id)->where('status', "PR CoIns")->sum('balance');
                    $deduct = deposit_apply::where('batching_claim_id', $line->batching_id)->where('status', "PR Ded")->sum('balance');
                    $gaurantor = deposit_apply::where('batching_claim_id', $line->batching_id)->where('payor_id', "1")->sum('balance');
                    $sec_paid = deposit_apply::where('batching_claim_id', $line->batching_id)->where('status', "Secondary Responsibility")->sum('balance');


                    $deposit_aplly_1 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                        ->where('appointment_id', $line->appointment_id)
                        ->where('dos', $line->schedule_date)
                        ->where('admin_id', $line->admin_id)
                        ->first();

                    $billed_am = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                        ->where('appointment_id', $line->appointment_id)
                        ->where('dos', $line->schedule_date)
                        ->where('admin_id', $line->admin_id)
                        ->sum('billed_am');

                    $deposit_aplly_pay = deposit_apply::select('appointment_id', 'dos', 'admin_id')
                        ->where('appointment_id', $line->appointment_id)
                        ->where('dos', $line->schedule_date)
                        ->where('admin_id', $line->admin_id)
                        ->sum('payment');

                    $deposit_aplly_adj = deposit_apply::select('appointment_id', 'dos', 'amount')
                        ->where('appointment_id', $line->appointment_id)
                        ->where('dos', $line->schedule_date)
                        ->where('admin_id', $line->admin_id)
                        ->sum('adjustment');

                    $sub_total = $deposit_aplly_pay + $deposit_aplly_adj;
                    $balance = $billed_am - $sub_total;

                    if ($deposit_aplly_1) {
                        $total_am += $billed_am;
                        $total_pay += $deposit_aplly_pay;
                        $total_adj += $deposit_aplly_adj;
                        $total_bal += $balance;
                    } else {
                        $total_am += $line->billed_am;
                        $total_pay += 0.00;
                        $total_adj += 0.00;
                        $total_bal += $line->billed_am;
                    }
                    $ins_paid = $total_pay - (($copay + $coins + $deduct) - $total_adj);
                    $patient_res = $copay + $coins + $deduct;
                    $ins_balance = $total_am - $ins_paid - $gaurantor - $sec_paid;
                    $total_paid = $ins_paid + $gaurantor;
                    $extra_array = $report->extra;

                    $extra_array = json_decode($extra_array);

                    if (in_array("Patient Name", $extra_array)) $r_arr["Patient Name"] = $client->client_full_name;
                    if (in_array("Payor", $extra_array)) $r_arr["Payor"] = $payor->payor_name;
                    if (in_array("Billed Amount", $extra_array)) $r_arr["Billed Amount"] = $line->billed_am;
                    if (in_array("Adjustment", $extra_array)) $r_arr["Adjustment"] = $adj;
                    if (in_array("Allowed Amount", $extra_array)) $r_arr["Allowed Amount"] = $allow;
                    if (in_array("Guarantor Paid", $extra_array)) $r_arr["Guarantor Paid"] = $gaurantor;
                    if (in_array("Insurance Paid", $extra_array)) $r_arr["Insurance Paid"] = $ins_paid;
                    if (in_array("Secondary Insurance Paid", $extra_array)) $r_arr["Secondary Insurance Paid"] = $sec_paid;
                    if (in_array("Total Paid", $extra_array)) $r_arr["Total Paid"] = $pay;
                    if (in_array("Patient Responsibility", $extra_array)) $r_arr["Patient Responsibility"] = $patient_res;
                    if (in_array("Insurance Responsibility", $extra_array)) $r_arr["Insurance Responsibility"] = $ins_res;
                    if (in_array("Balance", $extra_array)) $r_arr["Balance"] = $allow;
                    if (in_array("AR Note", $extra_array)) $r_arr["AR Note"] = isset($ledger_note->note) ? $ledger_note->note : '';
                    if (in_array("AR Note Worked Date", $extra_array)) $r_arr["AR Note Worked Date"] = isset($ledger_note->worked_date) ? $ledger_note->worked_date : '';
                    if (in_array("AR Note Follow up Date", $extra_array)) $r_arr["AR Note Follow up Date"] = isset($ledger_note->followup_date) ? $ledger_note->followup_date : '';
                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 18) {
                $data = Client_authorization::where('admin_id', $report->admin_id);
                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('onset_date', $s_date)->orWhere('end_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('onset_date', '>=', $date_from)->where('end_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) {
                    $client = Client::where('id', $line->client_id)->first();
                    $extra_array = $report->extra;

                    $extra_array = json_decode($extra_array);

                    if (in_array("Patient Lastname", $extra_array)) $r_arr["Patient Lastname"] = $client->client_last_name;
                    if (in_array("Patient Firstname", $extra_array)) $r_arr["Patient Firstname"] = $client->client_first_name;
                    if (in_array("Auth start date", $extra_array)) $r_arr["Auth start date"] = Carbon::parse($client->onset_date)->format('m/d/Y');
                    if (in_array("Auth end date", $extra_array)) $r_arr["Auth end date"] = Carbon::parse($client->end_date)->format('m/d/Y');
                    if (in_array("Is placeholder", $extra_array)) $r_arr["Is placeholder"] = $line->is_placeholder == 1 ? 'yes' : 'No';
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 19) {
                $data = Client_authorization::where('admin_id', $report->admin_id);

                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('onset_date', $s_date)->orWhere('end_date', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('onset_date', '>=', $date_from)->where('end_date', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::where('id', $line->client_id)->first();
                    $extra_array = $report->extra;

                    $extra_array = json_decode($extra_array);

                    if (in_array("Patient Lastname", $extra_array)) $r_arr["Patient Lastname"] = $client->client_last_name;
                    if (in_array("Patient Firstname", $extra_array)) $r_arr["Patient Firstname"] = $client->client_first_name;
                    if (in_array("Auth start date", $extra_array)) $r_arr["Auth start date"] = Carbon::parse($client->onset_date)->format('m/d/Y');
                    if (in_array("Auth end date", $extra_array)) $r_arr["Auth end date"] = Carbon::parse($client->end_date)->format('m/d/Y');
                    if (in_array("Is placeholder", $extra_array)) $r_arr["Is placeholder"] = $line->is_placeholder == 1 ? 'yes' : 'No';

                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 20) {
                $data = deposit_apply_transaction::where('admin_id', $report->admin_id);
                if ($report->date_type == 1) {
                    $s_date = $report->s_date;
                    $data = $data->where('dos', $s_date);
                } else if ($report->date_type == 2) {
                    $date_from = $report->form_date;
                    $date_to = $report->to_date;
                    $data = $data->where('dos', '>=', $date_from)->where('dos', '<=', $date_to);
                }

                $data = $data->get();

                $name = public_path('report/' . $report->file_name . ".csv");
                $user = (new FastExcel($data))->export($name, function ($line) use ($report) {
                    $client = Client::where('id', $line->client_id)->first();
                    $auth = Client_authorization::where('id', $line->authorization_id)->first();
                    $zone = setting_name_location_box_two::where('id', $client->zone)->first();
                    $act = Client_authorization_activity::where('id', $line->activity_id)->first();
                    $dep_app = deposit_apply::where('id', $line->deposit_apply_id)->first();
                    $dep = deposit::where('id', $dep_app->deopsit_id)->first();
                    $staf = Employee::where('id', $dep_app->provider_id)->first();
                    $cpt = setting_service::where('service', $line->cpt)->first();
                    $extra_array = $report->extra;


                    $extra_array = json_decode($extra_array);


                    if (in_array("Last name", $extra_array)) $r_arr["Last name"] = $client->client_last_name;
                    if (in_array("First name", $extra_array)) $r_arr["First name"] = $client->client_first_name;
                    if (in_array("Address1", $extra_array)) $r_arr["Address1"] = $client->client_street;
                    if (in_array("City", $extra_array)) $r_arr["City"] = $client->client_city;
                    if (in_array("State", $extra_array)) $r_arr["State"] = $client->client_state;
                    if (in_array("Zip", $extra_array)) $r_arr["Zip"] = $client->client_zip;
                    if (in_array("Facility address1", $extra_array)) $r_arr["Facility address1"] = isset($zone) ? $zone->address : '';
                    if (in_array("Facility city", $extra_array)) $r_arr["Facility city"] = isset($zone) ? $zone->city : '';
                    if (in_array("Facility state", $extra_array)) $r_arr["Facility state"] = isset($zone) ? $zone->state : '';
                    if (in_array("Facility zip", $extra_array)) $r_arr["Facility zip"] = isset($zone) ? $zone->zip : '';
                    if (in_array("Activity rendered date", $extra_array)) $r_arr["Activity rendered date"] = Carbon::parse($line->dos)->format('m/d/Y');
                    if (in_array("Activity type", $extra_array)) $r_arr["Activity type"] = $act->activity_name;
                    if (in_array("Cpt code billed", $extra_array)) $r_arr["Cpt code billed"] = $line->cpt;
                    if (in_array("Units", $extra_array)) $r_arr["Units"] = $line->units;
                    if (in_array("Payment amount", $extra_array)) $r_arr["Payment amount"] = $line->payment;
                    if (in_array("Patient payment amount", $extra_array)) $r_arr["Patient payment amount"] = "";
                    if (in_array("Payor payment amount", $extra_array)) $r_arr["Payor payment amount"] = "";
                    if (in_array("Contractual adjustment", $extra_array)) $r_arr["Contractual adjustment"] = $line->adjustment;
                    if (in_array("Balance", $extra_array)) $r_arr["Balance"] = $line->balance;
                    if (in_array("Date of deposit", $extra_array)) $r_arr["Date of deposit"] = Carbon::parse($dep->deposit_date)->format('m/d/');
                    if (in_array("Who paid payor", $extra_array)) $r_arr["Who paid payor"] = $line->who_paid;
                    if (in_array("Staff last name", $extra_array)) $r_arr["Staff last name"] = $staf->last_name;
                    if (in_array("Staff first name", $extra_array)) $r_arr["Staff first name"] = $staf->first_name;
                    if (in_array("Description", $extra_array)) $r_arr["Description"] = $dep->notes;
                    if (in_array("Treatment type", $extra_array)) $r_arr["Treatment type"] = $auth->treatment_type;

                    if (in_array("Diagnosis", $extra_array)) $r_arr["Diagnosis"] = $auth->diagnosis_one . ' ' . $auth->diagnosis_two . ' ' . $auth->diagnosis_three . ' ' . $auth->diagnosis_four;
                    if (in_array("Cpt Description", $extra_array)) $r_arr["Cpt Description"] = $cpt->description;


                    return $r_arr;
                });
                Mail::to($to)->send(new ReportConfirmMail($data_arr));

            } elseif ($report->report_type == 101) {
                $name = public_path('report/' . $report->file_name . ".csv");
                $data = json_decode($report->extra, true);
                $user = (new FastExcel($data))->export($name, function ($bat_claim) use ($report) {

                    $proc_claim = \App\Models\Processing_claim::select('id', 'admin_id', 'time_duration')
                        ->where('id', $bat_claim["processing_claim_id"])
                        ->where('admin_id', $report->admin_id)
                        ->first();

                    $claint = \App\Models\Client::select('id', 'admin_id', 'client_full_name')->where('id', $bat_claim["client_id"])
                        ->where('admin_id', $report->admin_id)
                        ->first();

                    $provider = \App\Models\Employee::select('id', 'admin_id', 'full_name')->where('id', $bat_claim["provider_id"])
                        ->where('admin_id', $report->admin_id)
                        ->first();
                    $cms_24_provider = \App\Models\Employee::select('id', 'admin_id', 'full_name')->where('id', $bat_claim["cms_24j"])
                        ->where('admin_id', $report->admin_id)
                        ->first();

                    $payor_name = \App\Models\All_payor::where('id', $bat_claim["payor_id"])->first();

                    $activity = \App\Models\Client_authorization_activity::where('id', $bat_claim["activity_id"])->first();
                    $hours = $proc_claim["time_duration"] / 60;

                    $date = \Carbon\Carbon::parse($bat_claim["schedule_date"])->format('m/d/Y');
                    $amount = is_numeric($bat_claim["billed_am"]) ? number_format($bat_claim["billed_am"], 2) : $bat_claim["billed_am"];
                    $units = is_numeric($bat_claim["units"]) ? number_format($bat_claim["units"], 2) : $bat_claim["units"];
                    $status = $bat_claim["status"];

                    if (!$claint) $claint = ''; else $claint = $claint->client_full_name;
                    if (!$cms_24_provider) $cms_24_provider = ''; else $cms_24_provider = $cms_24_provider->full_name;
                    if (!$provider) $provider = ''; else $provider = $provider->full_name;

                    return [
                        'Patient' => $claint,
                        'Billing Provider' => $cms_24_provider,
                        'Treating Therapist' => $provider,
                        'Insurance' => $payor_name->payor_name,
                        'Service' => $activity->activity_name . '(' . $hours . ' Hrs)',
                        'DOS' => $date,
                        'Cpt' => $bat_claim["cpt"],
                        'POS' => $bat_claim["location"],
                        'M1' => $bat_claim["m1"],
                        'M2' => $bat_claim["m2"],
                        'M3' => $bat_claim["m3"],
                        'M4' => $bat_claim["m4"],
                        'Amount' => $amount,
                        'Units' => $units,
                        'Status' => $status
                    ];

                });
            }


            $update_report = report_notification::where('id', $report->id)->first();
            $update_report->status = "Complete";
            $update_report->save();

        }

    }
}
