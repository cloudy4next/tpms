<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\sessionReminder;
use App\Mail\sessionReminderProvider;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Appoinment;
use App\Models\Client_authorization;
use Carbon\Carbon;

class SessionReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Session Reminder Email sending Command';

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

        $today=Carbon::now('EST')->format('Y-m-d');
        // $clients=Appoinment::select('client_id')->distinct()->where('schedule_date',$today)->get();
        // foreach($clients as $client){

        //     $cli=Client::where('id',$client->client_id)->first();
        //     $appointments=Appoinment::where('schedule_date',$today)->where('client_id',$client->client_id)->get();
        //     if(count($appointments)>0){
        //         foreach($appointments as $app){
        //             $arr=array(
        //                 "schedule_date"=>Carbon::parse($app->schedule_date)->format('d-m-Y'),
        //                 "from_time"=>Carbon::parse($app->from_time)->format('g:i A'),
        //                 "to_time"=>Carbon::parse($app->to_time)->format('g:i A'),
        //             );
                    
        //             Mail::to($cli->email)->send(new sessionReminder($arr));
        //         }
        //     }
        // }

        // $providers=Employee::select('id','office_email')->get();
        // $date=Carbon::now('EST')->format('d M Y');
        
        // foreach($providers as $provider){

        //     $appointments=Appoinment::where('schedule_date',$today)->where('provider_id',$provider->id)->orderBy('from_time','ASC')->get();
        //     if(count($appointments)>0){
        //         foreach($appointments as $appoint){
        //             $auth=Client_authorization::where('id',$appoint->authorization_id)->first();
        //             $client=Client::where('id',$appoint->client_id)->first();
        //             $arr2[]=array(
        //                 "ftime"=>Carbon::parse($appoint->from_time)->format('g:i A'),
        //                 "ttime"=>Carbon::parse($appoint->to_time)->format('g:i A'),
        //                 "auth"=>$auth->authorization_name,
        //                 "pat"=>$client->client_last_name.', '.$client->client_first_name
        //             );
        //         }

        //         Mail::to($provider->office_email)->send(new sessionReminderProvider($date,$arr2));
        //     }
        // }

        $facilities=\App\Models\setting_name_location::select('id','admin_id','facility_name')->where('email_reminder',1)->get();
        foreach($facilities as $facility){
            $providers=Employee::select('id','office_email')->where('admin_id',$facility->admin_id)->get();
            foreach($providers as $provider){
                $arr2=[];
                $appointments=Appoinment::where('schedule_date',$today)->where('provider_id',$provider->id)->orderBy('from_time','ASC')->get();
                if(count($appointments)>0){
                    foreach($appointments as $appoint){
                        $auth=Client_authorization::select('authorization_name')->where('id',$appoint->authorization_id)->first();
                        $client=Client::select('client_last_name','client_first_name')->where('id',$appoint->client_id)->first();
                        $arr2[]=array(
                            "ftime"=>Carbon::parse($appoint->from_time)->format('h:i A'),
                            "ttime"=>Carbon::parse($appoint->to_time)->format('h:i A'),
                            "auth"=>$auth->authorization_name,
                            "pat"=>$client->client_last_name.', '.$client->client_first_name,
                            "fac"=>$facility->facility_name
                        );
                    }

                    // Mail::to($provider->office_email)->send(new sessionReminderProvider($date,$arr2));
                }
            }

        }

        dd($providers);


    }
}
