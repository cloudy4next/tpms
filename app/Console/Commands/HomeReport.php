<?php

namespace App\Console\Commands;

use App\Models\All_payor;
use App\Models\Client;
use App\Models\deposit;
use App\Models\deposit_apply;
use App\Models\deposit_apply_transaction;
use App\Models\ledger_list;
use App\Models\manage_claim;
use App\Models\manage_claim_transaction;
use App\Models\report_notification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class HomeReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:homereport';

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
        $reports = report_notification::where('report_type', 21)->where('status', 'Pending')->get();
        foreach ($reports as $report) {
            $name = public_path('report/' . $report->file_name . ".csv");

            if ($report->filter_type == 1) {
                $last_month = Carbon::parse($report->form_date)->format('m');
                $last_month_claim = manage_claim_transaction::where('admin_id', $report->admin_id)
                    ->whereMonth('created_at', $last_month)
                    ->get();
            } else {

                $last_month_claim = manage_claim_transaction::where('admin_id', $report->admin_id)
                    ->whereDate('created_at', '>=', $report->form_date)
                    ->whereDate('created_at', '<=', $report->to_date)
                    ->get();
            }


            $user = (new FastExcel($last_month_claim))->export($name, function ($line) {

                $payor_name = All_payor::select('id', 'payor_name')->where('id', $line->payor_id)->first();
                $client = Client::select('id', 'admin_id', 'client_full_name')->where('id', $line->client_id)
                    ->first();


                $dep_app_trac = deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'payment')
                    ->where('admin_id', $line->admin_id)
                    ->where('appointment_id', $line->appointment_id)
                    ->first();

                if ($dep_app_trac) {
                    $dep_app_trac_paid = is_numeric($dep_app_trac->payment) ? number_format($dep_app_trac->payment, 2) : $dep_app_trac->payment;
                } else {
                    $dep_app_trac_paid = '0.00';
                }


                return [
                    "Claim ID" => $line->claim_id,
                    'Batch ID' => $line->batch_id,
                    'Payor' => isset($payor_name) ? $payor_name->payor_name : '',
                    'Patient' => isset($client) ? $client->client_full_name : '',
                    'Service Date' => Carbon::parse($line->schedule_date)->format('m/d/Y'),
                    'Cpt' => $line->cpt,
                    'M1' => $line->m1,
                    'M2' => $line->m2,
                    'M3' => $line->m3,
                    'M4' => $line->m4,
                    'Units' => is_numeric($line->units) ? number_format($line->units, 2) : $line->units,
                    'Total Charge' => is_numeric($line->billed_am) ? number_format($line->billed_am, 2) : $line->billed_am,
                    'Created Date' => Carbon::parse($line->created_at)->format('m/d/Y'),
                    'Paid' => $dep_app_trac_paid,
                ];
            });
            $report_update = report_notification::where('id', $report->id)->first();
            $report_update->status = "Complete";
            $report_update->save();

        }
    }
}
