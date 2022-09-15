<?php

namespace App\Jobs;

use App\Models\manage_claim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateClaimCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $claim_data;
    public $file_name;
    public function __construct($claim_data,$file)
    {
        $this->claim_data = $claim_data;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $file = $this->file;
//        $datas = $this->claim_data;
//
//        $claim_data_update = manage_claim::where('claim_id',$datas)->first();
//        if ($claim_data_update) {
//            $claim_data_update->resubmit_code = "001";
//            $claim_data_update->save();
//        }
//
//
//        $file_name = fopen(public_path('claimcsv/').$file, 'w');
//        fputcsv($file_name, [
//            $datas->id
//        ]);
//
//        fclose($file_name);

    }
}
