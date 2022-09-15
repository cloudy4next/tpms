<?php

namespace App\Console\Commands;

use App\Models\Appoinment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateGoogleCallender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:updatecallender';

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

        // $all_appoinments = Appoinment::all();
        // foreach ($all_appoinments as $appoinment) {
        //     $single_app = Appoinment::where('id', $appoinment->id)->first();
        //     $single_app->g_event_id = "demo";
        //     $single_app->save();
        // }


        $all_appoinments = Appoinment::where('week_day_name', null)->orWhere('week_day_name', '')->get();
        foreach ($all_appoinments as $appoinment) {
            $single_app = Appoinment::where('id', $appoinment->id)->first();
            if ($single_app) {
                $scdule_time_start = Carbon::parse($appoinment->from_time);
                $start = new \DateTime($scdule_time_start);

                $time_stamp = strtotime($start->format('Y-m-d\TH:i:s.z\Z'));
                $week = date('l', $time_stamp);


                $single_app->week_day_name = $week;
                $single_app->save();
            }

        }
    }
}
