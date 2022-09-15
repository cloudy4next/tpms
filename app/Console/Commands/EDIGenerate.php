<?php

namespace App\Console\Commands;

use App\Mail\ResetPasswordMail;
use App\Models\Appoinment;
use App\Models\manage_claim_transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EDIGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate EDI';

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
        //schdule run on script.sh
//        $to = "srt7142@gmail.com";
//
//        $msg = [
//            'name' => "ami",
//            'code'=>"12345678"
//        ];

//        Mail::to($to)->send(new ResetPasswordMail($msg));

            
//        $manage_claims = manage_claim_transaction::where('from_time', null)
//            ->where('to_time', null)
//            ->get();
//
//        foreach ($manage_claims as $claim) {
//            $single_claim = manage_claim_transaction::where('id', $claim->id)->first();
//            $single_app = Appoinment::select('id', 'from_time', 'to_time')->where('id', $single_claim->appointment_id)->first();
//
//            $single_claim->from_time = $single_app->from_time;
//            $single_claim->to_time = $single_app->to_time;
//            $single_claim->save();
//
//        }


    }
}
