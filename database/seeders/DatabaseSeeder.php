<?php

namespace Database\Seeders;

use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Client_info;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $faker = Faker::create();
        foreach (range(1,100) as $index){
            $client = Client::create([
                'is_active_client'=>1,
                'client_full_name'=>'Client '.$index,
                'client_first_name'=>'Client '.$index,
                'client_middle'=>null,
                'client_last_name'=>null,
                'client_preferred'=>null,
                'client_gender'=>'Male',
                'client_dob'=>Carbon::now()->format('Y-m-d'),
                'email'=>$faker->email,
                'email_type'=>null,
                'email_reminder'=>null,
                'is_email_ok'=>null,
                'phone_number'=>$faker->phoneNumber,
                'phone_type'=>null,
                'is_send_sms'=>null,
                'is_voice_sms'=>null,
                'location'=>null,
                'zone'=>null,
                'client_street'=>null,
                'client_city'=>null,
                'client_state'=>null,
                'client_zip'=>null,
                'supervisor_name'=>null,
            ]);

            $client_info = Client_info::create([
               'client_id'=> $client->id,
               'is_active_client'=> 1
            ]);


            $auth = Client_authorization::create([
               'client_id'=>$client->id,
               'authorization_name'=>$faker->name,
               'payor_id'=>rand(1,100),
               'treatment_type'=>"BT",
               'supervisor_id'=>6,
               'description'=>$faker->name,
               'selected_date'=>null,
               'onset_date'=>Carbon::now()->format('Y-m-d'),
               'end_date'=>Carbon::now()->format('Y-m-d'),
               'authorization_number'=>rand(00000000,11111111),
               'uci_id'=>"123456778",
               'cms_four'=>"123456778",
               'csm_eleven'=>"123456778",
               'diagnosis_one'=>"123456778",
               'diagnosis_two'=>"123456778",
               'diagnosis_three'=>"123456778",
               'diagnosis_four'=>"123456778",
               'deductible'=>"123456778",
               'in_network'=>1,
               'copay'=>"123456778",
               'max_total_auth'=>null,
               'value'=>null,
               'notes'=>$faker->paragraph,
               'is_primary'=>1,
            ]);

            $act = Client_authorization_activity::create([
                'client_id'=>$client->id,
                'dup_name'=>$faker->name,
                'activity_name'=>$faker->name,
                'authorization_id'=>$auth->id,
                'activity_one'=>"Assessment",
                'activity_two'=>"(BCBA)",
                'cpt_code'=>"0001",
                'onset_date'=>Carbon::now()->format('Y-m-d'),
                'end_date'=>Carbon::now()->addDays(300)->format('Y-m-d'),
                'm1'=>"HM",
                'm2'=>"HM",
                'm3'=>"HM",
                'm4'=>"HM",
                'auth_activity'=>null,
                'billed_type'=>"15 mins",
                'billed_time'=>"15 min",
                'rate'=>20,
                'hours_max_one'=>1,
                'hours_max_per_one'=>"Total Auth",
                'hours_max_is_one'=>"10000000",
                'hours_max_two'=>null,
                'hours_max_per_two'=>null,
                'hours_max_is_two'=>null,
                'hours_max_three'=>null,
                'hours_max_per_three'=>null,
                'hours_max_is_three'=>null,
                'notes'=>$faker->paragraph,
            ]);


//            $clients = Client::where('id',1)->first();
//            $client_auth = Client_authorization::where('client_id',$clients->id)->first();
//            $client_act = Client_authorization_activity::where('client_id',$clients->id)->first();
//
//            $app = Appoinment::create([
//                'recurring_id'=>218,
//                'billable'=>1,
//                'client_id'=>$clients->id,
//                'authorization_id'=>$client_auth->id,
//                'authorization_activity_id'=>$client_act->id,
//                'payor_id'=>$client_auth->payor_id,
//                'provider_id'=>1,
//                'location'=>"03",
//                'time_duration'=>15,
//                'from_time'=>Carbon::now()->format('Y-m-d H:m:s'),
//                'activity_type'=>$client_act->activity_one,
//                'to_time'=>Carbon::now()->addMinutes(15)->format('Y-m-d H:m:s'),
//                'cpt_code'=>$client_act->cpt_code,
//                'schedule_date'=>Carbon::now()->addDays(360)->format('Y-m-d H:m:s'),
//                'status'=>"Rendered",
//                'notes'=>null,
//                'm1'=>$client_act->m1,
//                'm2'=>$client_act->m2,
//                'm3'=>$client_act->m3,
//                'm4'=>$client_act->m4,
//                'weekly_date'=>null,
//                'week_day_name'=>"Sunday",
//                'degree_level'=>$client_act->activity_two,
//                'gender'=>"Male",
//                'zone'=>"All Zone",
//                'zip_code'=>null,
//                'lagunage'=>null,
//                'chkrecurrence'=>1,
//                'daily'=>2,
//                'is_locked'=>0,
//            ]);




        }





    }
}
