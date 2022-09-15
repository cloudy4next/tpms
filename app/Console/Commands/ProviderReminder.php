<?php

namespace App\Console\Commands;

use App\Mail\ProviderAccessEmail;
use App\Models\Appoinment;
use App\Models\Employee;
use App\Models\setting_name_location;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ProviderReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:providerreminder';

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
        $providers = Employee::select('id', 'admin_id', 'full_name', 'office_email')->get();
        $today = Carbon::now()->format('Y-m-d');
        foreach ($providers as $pro) {
            $sett = setting_name_location::where('admin_id', $pro->admin_id)->first();
            $array = [];
            $appoinments = Appoinment::where('provider_id', $pro->id)->where('schedule_date', $today)->get();

            foreach ($appoinments as $app) {
                array_push($array, $app);
            }

//            $to = $pro->office_email;
//            $to = "srt35552@gmail.com";
//            $msg = [
//                'apps' => $array,
//                'name_location' => $sett->facility_name,
//            ];
            //   Mail::to($to)->send(new ProviderReminder($msg));
        }
    }
}
