<?php

namespace App\Console\Commands;

use App\Models\Appoinment;
use App\Models\Batching_claim;
use App\Models\Client;
use App\Models\Employee;
use App\Models\manage_claim_transaction;
use App\Models\Processing_claim;
use App\Models\Recurring_session;
use App\Models\setting_name_location;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateReminderDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:updatereminder';

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

        // $ids = [];

        // $data=\App\Models\Appoinment::select('id','admin_id','schedule_date')->where('admin_id',$admin_id)->where('schedule_date','<','2022-08-01')->get();
        // Log::info('Total session available till august are:'.count($data));
        
        // foreach($data as $d){
        //     $save = new \App\Models\Session_notes_avail();
        //     $save->admin_id = $admin_id;
        //     $save->session_id = $d->id;
        //     $save->added = 1;
        //     $save->form_id = 0;
        //     $save->save();
        //     array_push($ids,$save->id);
        // }

        // $total = count($ids);

        // Log::info('Total dummy records added in ECF are:'.$total);

        // exit();


        // $data = \App\Models\Session_notes_avail::get();
        // Log::info("Total Sessions notes available are: ".count($data));
        // exit();

        // $admins = [33];
        // $ids = [];
        // $sess=[];

        // $data=\App\Models\Appoinment::select('id','admin_id')->where('admin_id',33)->where('schedule_date','>=','2022-08-01')->get();

        // foreach($data as $d){
        //     $admin_id = $d->admin_id;
        //     $form_1 = \App\Models\usf_one_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_2 = \App\Models\dsptn_two_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_3 = \App\Models\btsmf_three_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_4 = \App\Models\btusf_four_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_5 = \App\Models\msn_five_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_6 = \App\Models\tcsn_fix_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_7 = \App\Models\ct_seven_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_8 = \App\Models\tp_eight_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_9 = \App\Models\pc_nine_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_10 = \App\Models\ot_ten_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_11 = \App\Models\cn_eleven_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_12 = \App\Models\pt_twelve_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_13 = \App\Models\sn_thirteen_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_14 = \App\Models\register_fourteen_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_15 = \App\Models\register2_fifteen_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_16 = \App\Models\sp_sixteen_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_17 = \App\Models\cp_seventeen_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_18 = \App\Models\cp_eighteen_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_19 = \App\Models\cp_ninteen_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_20 = \App\Models\gs_twenty_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_21 = \App\Models\gs_twentyone_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_22 = \App\Models\gs_twentytwo_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_23 = \App\Models\gs_twentythree_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_24 = \App\Models\bio_twentyfour_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_25 = \App\Models\birp_twentyfive_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_26 = \App\Models\dis_twentysix_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_27 = \App\Models\lpro_twentyseven_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_28 = \App\Models\ls_twentyeight_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_29 = \App\Models\dia_twentynine_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_30 = \App\Models\ds_thirty1_form::select('id','sessionid','admin_id')->where('sessionid', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_60 = \App\Models\saa_sixty_form::select('id','session_id','admin_id')->where('session_id', $d->id)->where('admin_id', $admin_id)->first();
        //     $form_61 = \App\Models\sn_sixtyone_form::select('id','session_id','admin_id')->where('session_id', $d->id)->where('admin_id', $admin_id)->first();


        //     if($form_1){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_1->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 1;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }


        //     if($form_2){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_2->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 2;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_3){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_3->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 3;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_4){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_4->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 4;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_5){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_5->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 5;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_6){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_6->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 6;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_7){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_7->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 7;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_8){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_8->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 8;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_9){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_9->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 9;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_10){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_10->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 10;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_11){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_11->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 11;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_12){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_12->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 12;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_13){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_13->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 13;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_14){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_14->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 14;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_15){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_15->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 15;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_16){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_16->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 16;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_17){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_17->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 17;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_18){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_18->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 18;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_19){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_19->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 19;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_20){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_20->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 20;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_21){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_21->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 21;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_22){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_22->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 22;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_23){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_23->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 23;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_24){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_24->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 24;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_25){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_25->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 25;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_26){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_26->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 26;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_27){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_27->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 27;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_28){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_28->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 28;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_29){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_29->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 29;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_30){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_30->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 30;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_60){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_60->session_id;
        //         $save->added = 1;
        //         $save->form_id = 60;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }

        //     if($form_61){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_61->session_id;
        //         $save->added = 1;
        //         $save->form_id = 61;
        //         $save->save();
        //         array_push($ids,$save->id);
        //     }
        // }

        // $total = count($ids);

        // Log::info($admins);
        // Log::info('Total session available for accounts:'.count($data));
        // Log::info('Total records added in table are:'.$total);


        $ids = [];
        $sess=[];

        $a_id = 33;
        $data=\App\Models\Appoinment::select('id','admin_id')->where('admin_id',$a_id)->where('schedule_date','>=','2022-08-01')->get();

        foreach($data as $d){
            $admin_id = $d->admin_id;
            $data2 = \App\Models\custom_form::select('id','session_id','admin_id','form_id')->where('session_id', $d->id)->where('admin_id', $admin_id)->get();
            foreach($data2 as $dd){
                // $save = new \App\Models\Session_notes_avail();
                // $save->admin_id = $admin_id;
                // $save->session_id = $dd->session_id;
                // $save->added = 1;
                // $save->form_id = $dd->form_id;
                // $save->save();
                // array_push($ids,$save->id);
            }
        }

        $total = count($ids);

        Log::info('Total session available for accounts:'.count($data));
        Log::info('Total records added in table are:'.$total);


    }
}
