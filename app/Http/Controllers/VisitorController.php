<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\All_payor;
use App\Models\All_payor_detail;
use App\Models\All_treatment;
use App\Models\Appoinment;
use App\Models\Batching_claim;
use App\Models\Client;
use App\Models\client_access_email;
use App\Models\Client_authorization_activity;
use App\Models\Client_authorization;
use App\Models\Client_info;
use App\Models\deposit;
use App\Models\deposit_apply;
use App\Models\deposit_apply_transaction;
use App\Models\setting_cpt_code;
use App\Models\Employee;
use App\Models\ledger_list;
use App\Models\ledger_note;
use App\Models\manage_claim_transaction;
use App\Models\note_form;
use App\Models\Payor_facility;
use App\Models\Payor_facility_details;
use App\Models\portal_access_email;
use App\Models\Processing_claim;
use App\Models\setting_name_location_box_two;
use App\Models\template_library;
use App\Models\Treatment_facility;
use App\Models\scrubbing_rule;
use App\Models\reset_password_link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;

class VisitorController extends Controller
{


    public function test_url()
    {
        // $get_app_save = Appoinment::where('admin_id', 35)
        //     ->where('billable', 1)
        //     ->where('is_locked', 0)
        //     ->where('is_show', 0)
        //     ->where('is_mark_gen', 0)
        //     ->where('status', 'Rendered')
        //     ->get();

        // return count($get_app_save);exit();
         
        // foreach($get_app_save as $data){
        //     $ac_n = client_authorization_activity::select('id','admin_id','cpt_code')->where('id', $data->authorization_activity_id)->where('admin_id',35)->first();
        //     $cpt_name = setting_cpt_code::select('id','admin_id','cpt_id','cpt_code')->where('cpt_id', $ac_n->cpt_code)->where('admin_id',35)->first();
        //     $data->cpt_code = $cpt_name->cpt_code;
        //     $data->save();
        // }


        // $arr=[];

        // $process_claim = \App\Models\Processing_claim::select('id','is_mark_gen','appointment_id','admin_id','cpt')->where('is_mark_gen', 0)->where('admin_id',35)->get();
        // foreach($process_claim as $pro){
        //     $id = $pro->id;
        //     $app_id = $pro->appointment_id;
        //     $m = \App\Models\manage_claim_transaction::select('id','appointment_id','admin_id','cpt')->where('appointment_id',$app_id)->where('admin_id',35)->where('cpt',$pro->cpt)->first();
        //     $prr = \App\Models\Processing_claim::select('id','is_mark_gen','appointment_id','admin_id','cpt')->where('appointment_id', $app_id)->where('id',$id)->where('admin_id',35)->where('cpt',$pro->cpt)->first();
        //     if($m){
        //         array_push($arr,$app_id);
        //         $prr->is_mark_gen = 1;
        //         $prr->save();
        //     }
        //     else{
        //         // $prr->is_mark_gen = 0;
        //         // $prr->save();
        //     }
        // }
        // return count($arr);

        // $arr = [];
        // $data = \App\Models\manage_claim_transaction::select('id','admin_id','baching_id','appointment_id')->where('admin_id',35)->get();
        // foreach($data as $d){
        //     $check = \App\Models\ledger_list::select('id','admin_id','batching_id','appointment_id')->where('batching_id',$d->baching_id)->where('appointment_id', $d->appointment_id)->where('admin_id',35)->first();
        //     if(!$check){
        //         array_push($arr,$d->id);
        //         $cat_claim = Batching_claim::where('admin_id', 35)
        //         ->where('id',$d->baching_id)
        //         ->where('status', 'Ready To Bill')
        //         ->first();
                

        //             $new_ledger = new ledger_list();
        //             $new_ledger->admin_id = $d->admin_id;
        //             $new_ledger->down_admin_id = 0;
        //             $new_ledger->batching_id = $cat_claim->id;
        //             $new_ledger->processing_claim_id = $cat_claim->processing_claim_id;
        //             $new_ledger->appointment_id = $cat_claim->appointment_id;
        //             $new_ledger->client_id = $cat_claim->client_id;
        //             $new_ledger->provider_id = $cat_claim->provider_id;
        //             $new_ledger->authorization_id = $cat_claim->authorization_id;
        //             $new_ledger->activity_id = $cat_claim->activity_id;
        //             $new_ledger->payor_id = $cat_claim->payor_id;
        //             $new_ledger->activity_type = $cat_claim->activity_type;
        //             $new_ledger->schedule_date = $cat_claim->schedule_date;
        //             $new_ledger->cpt = $cat_claim->cpt;
        //             $new_ledger->m1 = $cat_claim->m1;
        //             $new_ledger->m2 = $cat_claim->m2;
        //             $new_ledger->m3 = $cat_claim->m3;
        //             $new_ledger->m4 = $cat_claim->m4;
        //             $new_ledger->pos = $cat_claim->pos;
        //             $new_ledger->units = $cat_claim->units;
        //             $new_ledger->rate = (double)$cat_claim->rate;
        //             $new_ledger->cms_24j = $cat_claim->cms_24j;
        //             $new_ledger->id_qualifier = $cat_claim->id_qualifier;
        //             $new_ledger->status = $cat_claim->status;
        //             $new_ledger->degree_level = $cat_claim->degree_level;
        //             $new_ledger->zone = $cat_claim->zone;
        //             $new_ledger->location = $cat_claim->location;
        //             $new_ledger->units_value_calc = $cat_claim->units_value_calc;
        //             $new_ledger->billed_am = $cat_claim->billed_am;
        //             $new_ledger->billed_date = $cat_claim->billed_date;
        //             $new_ledger->is_mark_gen = $cat_claim->is_mark_gen;
        //             $new_ledger->has_manage_claim = $cat_claim->has_manage_claim;
        //             $new_ledger->save();

        //             $sing_batch = Batching_claim::where('id', $cat_claim->id)->first();
        //             $sing_batch->has_legder = 1;
        //             $sing_batch->save();

        //     }
        // }

        // return count($arr);


        // $data=\App\Models\Admin::select('email','id')->where('email','cars@tpms.com')->first();
        // dd($data);

        // $query = \App\Models\Appoinment::select('schedule_date','admin_id','cpt_code','client_id')->where('admin_id',26)->where('cpt_code','90791')->orderBy('schedule_date','ASC')->get();
        // echo "<table>";
        // echo "<tr>";
        // echo "<th>Sr#</th>";
        // echo "<th>Client Name</th>";
        // echo "<th>Schedule Date</th>";
        // echo "<th>CPT Code</th>";
        // echo "</tr>";
        // $i=1;
        // foreach($query as $q){
        //     $cl = \App\Models\Client::select('id','client_full_name')->where('id',$q->client_id)->where('admin_id',26)->first();

        //     echo "<tr>";
        //     echo "<td>".$i."</td>";
        //     if($cl){
        //         $name = $cl->client_full_name;
        //     }
        //     else{
        //         $name = '';
        //     }
        //     echo "<td>".$name."</td>";
        //     echo "<td>".\Carbon\Carbon::parse($q->schedule_date)->format('m/d/Y')."</td>";
        //     echo "<td>".$q->cpt_code."</td>";
        //     echo "</tr>";
        //     $i++;
        // }

        // $admin_id = 33;

        // // $data=\App\Models\Appoinment::select('id','admin_id')->where('admin_id',$admin_id)->get();
        // $data=\App\Models\Appoinment::select('id','admin_id')->where('admin_id',$admin_id)->get();



        // foreach($data as $d){
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
        //     }


        //     if($form_2){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_2->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 2;
        //         $save->save();
        //     }

        //     if($form_3){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_3->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 3;
        //         $save->save();
        //     }

        //     if($form_4){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_4->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 4;
        //         $save->save();
        //     }

        //     if($form_5){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_5->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 5;
        //         $save->save();
        //     }

        //     if($form_6){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_6->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 6;
        //         $save->save();
        //     }

        //     if($form_7){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_7->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 7;
        //         $save->save();
        //     }

        //     if($form_8){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_8->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 8;
        //         $save->save();
        //     }

        //     if($form_9){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_9->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 9;
        //         $save->save();
        //     }

        //     if($form_10){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_10->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 10;
        //         $save->save();
        //     }

        //     if($form_11){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_11->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 11;
        //         $save->save();
        //     }

        //     if($form_12){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_12->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 12;
        //         $save->save();
        //     }

        //     if($form_13){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_13->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 13;
        //         $save->save();
        //     }

        //     if($form_14){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_14->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 14;
        //         $save->save();
        //     }

        //     if($form_15){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_15->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 15;
        //         $save->save();
        //     }

        //     if($form_16){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_16->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 16;
        //         $save->save();
        //     }

        //     if($form_17){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_17->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 17;
        //         $save->save();
        //     }

        //     if($form_18){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_18->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 18;
        //         $save->save();
        //     }

        //     if($form_19){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_19->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 19;
        //         $save->save();
        //     }

        //     if($form_20){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_20->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 20;
        //         $save->save();
        //     }

        //     if($form_21){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_21->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 21;
        //         $save->save();
        //     }

        //     if($form_22){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_22->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 22;
        //         $save->save();
        //     }

        //     if($form_23){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_23->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 23;
        //         $save->save();
        //     }

        //     if($form_24){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_24->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 24;
        //         $save->save();
        //     }

        //     if($form_25){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_25->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 25;
        //         $save->save();
        //     }

        //     if($form_26){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_26->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 26;
        //         $save->save();
        //     }

        //     if($form_27){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_27->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 27;
        //         $save->save();
        //     }

        //     if($form_28){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_28->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 28;
        //         $save->save();
        //     }

        //     if($form_29){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_29->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 29;
        //         $save->save();
        //     }

        //     if($form_30){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_30->sessionid;
        //         $save->added = 1;
        //         $save->form_id = 30;
        //         $save->save();
        //     }

        //     if($form_60){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_60->session_id;
        //         $save->added = 1;
        //         $save->form_id = 60;
        //         $save->save();
        //     }

        //     if($form_61){
        //         $save = new \App\Models\Session_notes_avail();
        //         $save->admin_id = $admin_id;
        //         $save->session_id = $form_61->session_id;
        //         $save->added = 1;
        //         $save->form_id = 61;
        //         $save->save();
        //     }
        // }




        // $res = \App\Models\Session_notes_avail::select('id','admin_id')->where('admin_id',$admin_id)->count();

        // dd($res);


        // dd('Done');


        // $app = [];
        // $process = [];
        // $batching = [];
        // $man = [];


        // $admin_id = 26;
        // $cpt=['90791','90832'];
        // $data = \App\Models\Appoinment::select('id','admin_id','cpt_code','authorization_activity_id','client_id','schedule_date','status')->where('admin_id',$admin_id)->whereIn('cpt_code',$cpt)->get();


        // foreach($data as $d){
        //     $ac_n = \App\Models\Client_authorization_activity::select('id','admin_id','cpt_code')->where('id', $d->authorization_activity_id)->where('admin_id',$admin_id)->first();
        //     $cpt_name = \App\Models\setting_cpt_code::select('id','admin_id','cpt_id','cpt_code')->where('cpt_id', $ac_n->cpt_code)->where('admin_id',$admin_id)->first();

        //     if($d->cpt_code != $cpt_name->cpt_code){
        //         $d->cpt_code = $cpt_name->cpt_code;
        //         $d->save();
        //         array_push($app,$d->id);
        //     }

        //     $pro = \App\Models\Processing_claim::select('id','admin_id','appointment_id','cpt')->where('admin_id',$admin_id)->where('appointment_id',$d->id)->first();

        //     if($pro){
        //         if($pro->cpt != $cpt_name->cpt_code){
        //             $pro->cpt = $cpt_name->cpt_code;
        //             $pro->save();
         

        //             array_push($process, $pro->id);
        //         }
        //     }

        //     $batch = \App\Models\Batching_claim::select('id','admin_id','appointment_id','cpt')->where('admin_id',$admin_id)->where('appointment_id',$d->id)->first();
        //     if($batch){
        //         if($batch->cpt != $cpt_name->cpt_code){
        //             $batch->cpt = $cpt_name->cpt_code;
        //             $batch->save();

        //             array_push($batching,$batch->id);
        //         }
        //     }

        //     $manage = \App\Models\manage_claim_transaction::select('id','admin_id','appointment_id','cpt')->where('admin_id',$admin_id)->where('appointment_id',$d->id)->first();

        //     if($manage){
        //         if($manage->cpt != $cpt_name->cpt_code){
        //             $manage->cpt = $cpt_name->cpt_code;
        //             $manage->save();
                    
        //             array_push($man,$manage->id);
        //         }
        //     }
        // }


        // echo "Total in Sessions = ".count($app);
        // echo "<br>Total in Processing Claims = ".count($process);
        // echo "<br>Total in Batching Claims = ".count($batching);
        // echo "<br>Total in Manage Claims = ".count($man);


        // $data = \App\Models\manage_claim::select('id','payor_id','admin_id')->where('claim_id',1175)->get();
        //     echo '<table><tr><td>Admin ID</td><td>Payor ID</td></tr>';
        // foreach($data as $d){
        //     echo '<tr>';
        //     echo '<td>'.$d->admin_id.'</td>';
        //     echo '<td>'.$d->payor_id.'</td>';
        //     echo '<tr>';
        // }

        // echo '</table>';

        // $baching_claims = \App\Models\Batching_claim::select('id','admin_id','appointment_id','client_id','cpt','is_mark_gen')->where('is_mark_gen',0)->where('admin_id',39)->get();
        // $b_ids = [];
        // $d_ids = [];
        // $m_ids = [];
        // foreach($baching_claims as $bc){
        //     $data=\App\Models\manage_claim_transaction::select('id','appointment_id','client_id','cpt','admin_id')->where('admin_id',$bc->admin_id)->where('appointment_id',$bc->appointment_id)->where('client_id',$bc->client_id)->where('cpt',$bc->cpt)->first();
        //     if($data){
        //         array_push($b_ids,$bc->id);
        //     }
        // }

        // echo "Total Corrupted Records are:".count($b_ids).'<br>';


        // echo "(";
        // foreach($b_ids as $b){
        //     echo $b.',';
        // }
        // echo ")";

        // exit();

        // $b_ids = array(6863,6864,6865,6866,6867,6868,6869,6870,6872,6873,6874,6875,6876,6877,6878,6879,6880,6881,6882,6883,6884,6885,6886,6887,6888,6889,6890,6891,6892,6893,6894,6895,6896,6897,6898,6899,6900,6901,6902,6903,6904,6905,6906,6907,6908,6909,6910,6911,6912,6913,6914,6915,6916,6917,6918,6919,6920,6921,6922,6923,6924,6925,6926,6927,6928,6929,6930,6931,6932,6933,6934,6935,6936,6937,6938,6939,6940,6941,6942,6943,6944,6945,6946,6947,6948,6949,6950,6951,6952,6953,6954,6955,6956,6957,6958,6959,6960,6961,6962,6963,6964,6965,6966,64413,65233,65234,65236,65237,65713,65714,65719,65720,65721,65722,65728,65729,65730,65731,65732,65742,65743,65744,65745,65746,65751,65754,65755,65758,65759,65760,65761,65772,65773,65774,65775,65776,65777,65778,65779,65780,65781,65782,65783,65787,65788,65789,65790,65791,65792,65793,65795,65796,65797,65798,65799,65800,65801,65806,65807,65808,65810,65811,65812,65813,65814,65815,65820,65821,65822,65823,65833,65834,65835,65836,65841,65842,65846,65847,65848,65849,65852,65853,65854,65858,65859,65860,65862,65863,65864,65865,65866,65871,65872,65873,65874,65875,65876,65877,65881,65882,65885,65886,65887,65888,65889,65890,65897,65898,65899,65900,65901,65902,65903,65904,65910,65911,65913,65914,65916,65919,65922,65923,66034,66035,66036,66038,66039,66040,66042,66043,66044,66045,66047,66048,66049,66050,66052,66053,66054,66058,66059,66064,66065,66066,66068,66069,66072,66073,66074,66075,66078,66084,66085,66089,66090,66091,66092,66093,66094,66097,66098,66099,66100,66101,66102,66112,66113,66116,66117,66118,66119,66124,66125,66126,66128,66129,66130,66131,66137,66138,66139,66142,66143,66144,66146,66147,66153,66408,66409,66410,66411,66412,66413,70014,70016,70018,70020,70022,70024,70026,70028,75664,75666);

        // $data = \App\Models\Batching_claim::select('id','admin_id','appointment_id','cpt','client_id','is_mark_gen')->whereIn('id',$b_ids)->get();

        // $del = [];
        // $up = [];

        // foreach($data as $d){
        //     $check = \App\Models\Batching_claim::select('id','admin_id','appointment_id','cpt','client_id','is_mark_gen')->where('admin_id',$d->admin_id)->where('appointment_id',$d->appointment_id)->where('client_id',$d->client_id)->where('cpt',$d->cpt)->get();
        //     if(count($check)>1){
        //         foreach($check as $c){
        //             if($c->is_mark_gen == 0){
        //                 $c->delete();
        //                 array_push($del,$c->id);
        //             }
        //         }
        //     }
        //     else{
        //         if($d->is_mark_gen == 0){
        //             $d->is_mark_gen = 1;
        //             $d->save();
        //             array_push($up,$d->id);
        //         }
        //     }
        // }

        // echo "Total Updated Records are:".count($up);
        // echo "Total Deleted Records are:".count($del);

        $a_ids = [];
        $p_ids = [];
        $m_ids = [];
        $data=\App\Models\manage_claim_transaction::select('id','appointment_id','client_id','cpt','admin_id','claim_id')->where('admin_id',39)->where('claim_id','1127')->get();
        foreach($data as $d){
            $check=\App\Models\Batching_claim::select('id','appointment_id','client_id','cpt','admin_id','is_mark_gen')->where('admin_id',39)->where('appointment_id',$d->appointment_id)->where('client_id',$d->client_id)->where('cpt',$d->cpt)->first();
            if($check){
                echo $check->is_mark_gen.'<br>';
                array_push($m_ids,$check->id);
            }
            $p_check=\App\Models\Processing_claim::select('id','appointment_id','client_id','cpt','admin_id','is_mark_gen')->where('admin_id',39)->where('appointment_id',$d->appointment_id)->where('client_id',$d->client_id)->where('cpt',$d->cpt)->first();
            if($p_check){
                array_push($p_ids,$p_check->id);
            }

            $a_check=\App\Models\Appoinment::select('id','admin_id')->where('admin_id',39)->where('id',$d->appointment_id)->first();
            if($a_check){
                array_push($a_ids,$a_check->id);
            }
        }


        echo '<br>Data available in appointment:'.count($a_ids);
        echo '<br>Data available in processing claim:'.count($p_ids);
        echo '<br>Data available in batching claim:'.count($m_ids);
        echo '<br>Data available in manage claim:'.count($data);
        

    }

    private function create_batching_claim(){

    }

    public function update_record_for_text(Request $request)
    {


        $date = $request->date;
        $date = "2022-05-21 12:00:00";
        $date = Carbon::parse($date, 'Asia/Karachi')->toIso8601String();
        return $date;
        exit();
        $date = Carbon::parse($date, 'America/Los_Angeles')->toIso8601String();
        $date = Carbon::parse($date, 'UTC')->toIso8601String();
        $date = Carbon::parse($date, 'America/Los_Angeles')->toIso8601String();
        // $date=new \DateTime($date, new \DateTimeZone('America/New_York') );
        // $date=$date->format('Y-m-d H:i:s');


    }


//     public function update_record_for_text(Request $request)
//     {
//         $image = $request->file('csv_file');
//         $name = $image->getClientOriginalName();
//         $uploadPath = 'assets/dashboard/testcsvfiles/';
//         $image->move($uploadPath, $name);
//         $imageUrl = $uploadPath . $name;


//         if ($request->hasFile('csv_file')) {
//             $file_name = public_path($imageUrl);
//             $user = (new FastExcel)->import($file_name, function ($line) {

//                 return Employee::create([
//                     'admin_id' => 35,
//                     'is_active' => $line['is_active'] != null || $line['is_active'] != "" ? $line['is_active'] : null,
//                     'up_admin_id' => isset($line['up_admin_id']) ? $line['up_admin_id'] : null,
//                     'employee_type' => isset($line['employee_type']) ? $line['employee_type'] : null,
//                     'employee_id' => isset($line['employee_id']) ? $line['employee_id'] : null,
//                     'first_name' => isset($line['first_name']) ? $line['first_name'] : null,
//                     'middle_name' => isset($line['middle_name']) ? $line['middle_name'] : null,
//                     'last_name' => isset($line['last_name']) ? $line['last_name'] : null,
//                     'full_name' => isset($line['full_name']) ? $line['full_name'] : null,
//                     'nickname' => isset($line['nickname']) ? $line['nickname'] : null,
//                     'staff_birthday' => isset($line['staff_birthday']) ? $line['staff_birthday'] : null,
//                     'ssn' => isset($line['ssn']) ? $line['ssn'] : null,
//                     'staff_other_id' => isset($line['staff_other_id']) ? $line['staff_other_id'] : null,
//                     'office_phone' => isset($line['office_phone']) ? $line['office_phone'] : null,
//                     'office_fax' => isset($line['office_fax']) ? $line['office_fax'] : null,
//                     'office_email' => isset($line['office_email']) ? $line['office_email'] : null,
//                     'driver_license' => isset($line['driver_license']) ? $line['driver_license'] : null,
//                     'license_exp_date' => $line['license_exp_date'] != null || $line['license_exp_date'] != "" ? $line['license_exp_date'] : null,
//                     'title' => isset($line['title']) ? $line['title'] : null,
//                     'hir_date_compnay' => $line['hir_date_compnay'] != null || $line['hir_date_compnay'] != "" ? $line['hir_date_compnay'] : null,
//                     'credential_type' => $line['credential_type'] != null || $line['credential_type'] != "" ? $line['credential_type'] : null,
//                     'treatment_type' => isset($line['treatment_type']) ? $line['treatment_type'] : null,
//                     'individual_npi' => isset($line['individual_npi']) ? $line['individual_npi'] : null,
//                     'caqh_id' => isset($line['caqh_id']) ? $line['caqh_id'] : null,
//                     'service_area_zip' => isset($line['service_area_zip']) ? $line['service_area_zip'] : null,
//                     'terminated_date' => isset($line['terminated_date']) ? $line['terminated_date'] : null,
//                     'language' => isset($line['language']) ? $line['language'] : null,
//                     'taxonomy_code' => isset($line['taxonomy_code']) ? $line['taxonomy_code'] : null,
//                     'gender' => $line['gender'] != null || $line['gender'] != "" ? $line['gender'] : null,
//                     'military_service' => $line['military_service'] != null || $line['military_service'] != "" ? $line['military_service'] : null,
//                     'therapist_bill' => $line['therapist_bill'] != null || $line['therapist_bill'] != "" ? $line['therapist_bill'] : null,
//                     'is_staff_active' => $line['is_staff_active'] != null || $line['is_staff_active'] != "" ? $line['is_staff_active'] : null,
//                     'enable_fource_creation' => $line['enable_fource_creation'] != null || $line['enable_fource_creation'] != "" ? $line['enable_fource_creation'] : null,
//                     'has_catalsty_access' => $line['has_catalsty_access'] != null || $line['has_catalsty_access'] != "" ? $line['has_catalsty_access'] : null,
//                     'notes' => isset($line['notes']) ? $line['notes'] : null,
//                     'login_email' => isset($line['login_email']) ? $line['login_email'] : null,
//                     'password' => isset($line['password']) ? $line['password'] : null,
//                     'remember_token' => isset($line['remember_token']) ? $line['remember_token'] : null,
//                     'back_color' => isset($line['back_color']) ? $line['back_color'] : null,
//                     'text_color' => isset($line['text_color']) ? $line['text_color'] : null,
//                 ]);
//             });

//             unlink($file_name);
//         }


//         return 'employee uploaded';
//         exit();


// //        if ($request->hasFile('csv_file')) {
// //            $file_name = public_path($imageUrl);
// //            $user = (new FastExcel)->import($file_name, function ($line) {
// //
// //                return Client::create([
// //                    'admin_id' => 35,
// //                    'is_up_admin' => isset($line['is_up_admin']) ? $line['is_up_admin'] : null,
// //                    'down_admin_id' => isset($line['down_admin_id']) ? $line['down_admin_id'] : null,
// //                    'is_active_client' => isset($line['is_active_client']) ? $line['is_active_client'] : null,
// //                    'client_type' => $line['client_type'] != null || $line['client_type'] != '' ? $line['client_type'] : null,
// //                    'client_full_name' => isset($line['client_full_name']) ? $line['client_full_name'] : null,
// //                    'client_first_name' => isset($line['client_first_name']) ? $line['client_first_name'] : null,
// //                    'client_middle' => isset($line['client_middle']) ? $line['client_middle'] : null,
// //                    'client_last_name' => isset($line['client_last_name']) ? $line['client_last_name'] : null,
// //                    'client_preferred' => isset($line['client_preferred']) ? $line['client_preferred'] : null,
// //                    'client_gender' => isset($line['client_gender']) ? $line['client_gender'] : null,
// //                    'client_dob' => isset($line['client_dob']) ? $line['client_dob'] : null,
// //                    'email' => isset($line['email']) ? $line['email'] : null,
// //                    'email_type' => isset($line['email_type']) ? $line['email_type'] : null,
// //                    'email_reminder' => isset($line['email_reminder']) ? $line['email_reminder'] : null,
// //                    'is_email_ok' => $line['is_email_ok'] != null || $line['is_email_ok'] != '' ? $line['is_email_ok'] : null,
// //                    'phone_number' => isset($line['phone_number']) ? $line['phone_number'] : null,
// //                    'phone_type' => isset($line['phone_type']) ? $line['phone_type'] : null,
// //                    'is_send_sms' => $line['is_send_sms'] != null || $line['is_send_sms'] != '' ? $line['is_send_sms'] : null,
// //                    'is_voice_sms' => $line['is_voice_sms'] != null || $line['is_voice_sms'] != '' ? $line['is_voice_sms'] : null,
// //                    'location' => isset($line['location']) ? $line['location'] : null,
// //                    'zone' => isset($line['zone']) ? $line['zone'] : null,
// //                    'client_street' => isset($line['client_street']) ? $line['client_street'] : null,
// //                    'client_city' => isset($line['client_city']) ? $line['client_city'] : null,
// //                    'client_state' => isset($line['client_state']) ? $line['client_state'] : null,
// //                    'client_zip' => isset($line['client_zip']) ? $line['client_zip'] : null,
// //                    'supervisor_name' => isset($line['supervisor_name']) ? $line['supervisor_name'] : null,
// //                ]);
// //            });
// //
// //            unlink($file_name);
// //        }


//         return 'uploaded';
//         exit();

// //        $check_claim = Batching_claim::where('admin_id', 25)->where('status', 'Ready To Bill')->get();
// //        $array = [];
// //        foreach ($check_claim as $claim) {
// //            $check_man_claim = manage_claim_transaction::where('admin_id', 25)
// //                ->where('appointment_id', $claim->appointment_id)
// //                ->where('baching_id', $claim->id)
// //                ->first();
// //            if (!$check_man_claim) {
// //                $update_claim = Batching_claim::where('id', $claim->id)->first();
// //                if ($update_claim) {
// //                    $update_claim->has_manage_claim = 0;
// //                    $update_claim->is_mark_gen = 0;
// //                    $update_claim->save();
// //                }
// //                array_push($array, $claim->schedule_date);
// //            }
// //        }


//         return $array;
//         exit();

// //        $payor_fac = Payor_facility::where('admin_id', 27)->get();
// //        foreach ($payor_fac as $p_fac) {
// //            $singe_p_fac = Payor_facility::where('id', $p_fac->id)->first();
// //            $check_all_payor_det = All_payor_detail::where('admin_id', $p_fac->admin_id)
// //                ->where('payor_id', $p_fac->payor_id)
// //                ->where('facility_payor_id', $p_fac->facility_payor_id)
// //                ->first();
// //
// //
// //            if (!$check_all_payor_det) {
// //                $sing_payor = All_payor::where('id', $singe_p_fac->payor_id)->first();
// //                if ($sing_payor) {
// //                    $new_payor_details = new All_payor_detail();
// //                    $new_payor_details->admin_id = $singe_p_fac->admin_id;
// //                    $new_payor_details->payor_id = $sing_payor->id;
// //                    $new_payor_details->facility_payor_id = $sing_payor->facility_payor_id;
// //                    $new_payor_details->payor_name = $sing_payor->payor_name;
// //                    $new_payor_details->co_pay = $sing_payor->co_pay;
// //                    $new_payor_details->day_club = $sing_payor->day_club;
// //                    $new_payor_details->is_electronic = $sing_payor->is_electronic;
// //                    $new_payor_details->cms_1500_31 = $sing_payor->cms_1500_31;
// //                    $new_payor_details->cms_1500_32a = $sing_payor->cms_1500_32a;
// //                    $new_payor_details->cms_1500_32b = $sing_payor->cms_1500_32b;
// //                    $new_payor_details->cms_1500_33a = $sing_payor->cms_1500_33a;
// //                    $new_payor_details->cms_1500_33b = $sing_payor->cms_1500_33b;
// //                    $new_payor_details->is_active = $sing_payor->is_active;
// //                    $new_payor_details->npi = $sing_payor->npi;
// //                    $new_payor_details->tax_id = $sing_payor->tax_id;
// //                    $new_payor_details->ssn = $sing_payor->ssn;
// //                    $new_payor_details->box_17 = $sing_payor->box_17;
// ////            $new_payor_details->cms1500_32address = $sing_payor->cms1500_32address;
// ////            $new_payor_details->cms150033_address = $sing_payor->cms150033_address;
// //                    $new_payor_details->day_pay_cpt = $sing_payor->day_pay_cpt;
// //                    $new_payor_details->save();
// //                }
// //            }
// //
// //
// //        }


//         return 'appoinment updated';
//         exit();


// //        $all_payor = Payor_facility::all();
// //
// //        foreach ($all_payor as $payor) {
// //            $sing_payor = Payor_facility::where('id', $payor->id)->first();
// //            $all_p = All_payor::where('id', $sing_payor->payor_id)->first();
// //            if ($all_p) {
// //                $new_p_f = new All_payor_detail();
// //                $new_p_f->admin_id = $sing_payor->admin_id;
// //                $new_p_f->payor_id = $all_p->id;
// //                $new_p_f->facility_payor_id = $all_p->facility_payor_id;
// //                $new_p_f->payor_name = $all_p->payor_name;
// //                $new_p_f->co_pay = $all_p->co_pay;
// //                $new_p_f->day_club = $all_p->day_club;
// //                $new_p_f->is_electronic = $all_p->is_electronic;
// //                $new_p_f->cms_1500_31 = $all_p->cms_1500_31;
// //                $new_p_f->cms_1500_32a = $all_p->cms_1500_32a;
// //                $new_p_f->cms_1500_32b = $all_p->cms_1500_32b;
// //                $new_p_f->cms_1500_33a = $all_p->cms_1500_33a;
// //                $new_p_f->cms_1500_33b = $all_p->cms_1500_33b;
// //                $new_p_f->is_active = $all_p->is_active;
// //                $new_p_f->npi = $all_p->npi;
// //                $new_p_f->tax_id = $all_p->tax_id;
// //                $new_p_f->ssn = $all_p->ssn;
// //                $new_p_f->box_17 = $all_p->box_17;
// //                $new_p_f->cms150032_address = $all_p->cms150032_address;
// //                $new_p_f->cms150033_address = $all_p->cms150033_address;
// //                $new_p_f->day_pay_cpt = $all_p->day_pay_cpt;
// //                $new_p_f->save();
// //            }
// //        }

//         return 'appoinment updated';
//         exit();

//     }


    public function delete_all_record()
    {

        return 'done';
        exit();
    }

    public function account_setup($token)
    {
        $access = portal_access_email::where('verify_id', $token)->where('is_use', 0)->first();
        if ($access) {
            return view('auth.accPasswordSet', compact('access'));
        } else {
            return redirect(route('user.login'))->with('alert', 'Access Link Has Been Disabled');
        }
    }

    public function staff_reset_password_view($token){
        $url=route('reset.password.link', $token);
        $arr=explode('o',$token);
        $e_id=$arr[1];

        $data=reset_password_link::where('target_id',$e_id)->first();

        if($data->url==$url){
            $date=Carbon::parse($data->expiry_date)->format('Y-m-d');
            $today=Carbon::now()->format('Y-m-d');
            if($today<=$date){
                return view('auth.staffResetPassword', compact('token'));
            }
            else{
                return redirect(route('user.login'))->with('alert', 'Access Link Has Expired');
            }
        }
        else{
            return redirect(route('user.login'))->with('alert', 'Access Link is not available.');
        }
        
    }

    public function staff_reset_password_by_link(Request $request){
        $pass = $request->pass;
        $cpass = $request->cpass;
        $token=$request->token_id;
        $url=route('reset.password.link', $token);

        if ($pass != $cpass) {
            return back()->with('alert', 'Password Not Match');
        } elseif (strlen($pass) < 8 || strlen($cpass) < 8) {
            return back()->with('alert', 'Password and Confirm Password must be at least 8 characters with special characters');
        } else {

            $access = reset_password_link::where('url', $url)->first();
            if($access){
                $date=Carbon::parse($access->expiry_date)->format('Y-m-d');
                $today=Carbon::now()->format('Y-m-d');
                if($today<=$date){
                    $provider = Employee::where('id', $access->target_id)->first();
                    $provider->password = Hash::make($pass);
                    $provider->save();
                    $access->delete();
                    return redirect(route('user.login'))->with('success', 'Password Setup Successfull. Please Login');
                }
                else{
                    return redirect(route('user.login'))->with('alert', 'Access Link Has Expired');
                } 
            }
            else{
                return redirect(route('user.login'))->with('alert', 'Access Link is not available.');
            }

        }
    }

    public function account_password_setup(Request $request)
    {
        $pass = $request->pass;
        $cpass = $request->cpass;

        if ($pass != $cpass) {
            return back()->with('alert', 'Password Not Match');
        } elseif (strlen($pass) < 8 || strlen($cpass) < 8) {
            return back()->with('alert', 'Password and Confirm Password must be at least 8 characters with special characters');
        } else {

            $access = portal_access_email::where('verify_id', $request->token_id)->first();
            $access->is_use = 1;
            $access->save();

            $provider = Employee::where('id', $access->provider_id)->first();
            $provider->login_email = $access->email;
            $provider->password = Hash::make($pass);
            $provider->save();
            return redirect(route('user.login'))->with('success', 'Password Setup Successfully. Please Login');
        }
    }


    public function patient_account_setup($token)
    {
        $access = client_access_email::where('verify_id', $token)->where('is_use', 0)->first();
        if ($access) {
            return view('auth.patientAccPasswordSet', compact('access'));
        } else {
            return redirect(route('user.login'))->with('alert', 'Access Link Has Been Disabled');
        }
    }


    public function patient_account_password_setup(Request $request)
    {
        $pass = $request->pass;
        $cpass = $request->cpass;

        if ($pass != $cpass) {
            return back()->with('alert', 'Password Not Match');
        } elseif (strlen($pass) < 8 || strlen($cpass) < 8) {
            return back()->with('alert', 'Password and Confirm Password must be at least 8 characters with special characters');
        } else {

            $access = client_access_email::where('verify_id', $request->token_id)->first();
            $access->is_use = 1;
            $access->save();

            $provider = Client::where('id', $access->client_id)->first();
            $provider->login_email = $access->email;
            $provider->password = Hash::make($pass);
            $provider->save();
            return redirect(route('user.login'))->with('success', 'Account Setup Successfully. Please Login');
        }
    }


    public function do_locked($id)
    {
        $admin = Admin::where('id', $id)->first();
        if ($admin->locked_token == null || $admin->locked_token == '') {
            $admin->locked_token = Str::random(20) . rand(0000, 8888) . $admin->id . time() . uniqid() . rand(0000000000, 9999999999) . Str::random(15);
        }
        $admin->lockout_time = 1;
        $admin->save();
        return redirect(route('user.show.login.locked', $admin->locked_token));
    }

    public function locked($token)
    {
        $user = Admin::where('locked_token', $token)->first();
        return view('auth.userScreenLocked', compact('user'));
    }

    public function unlock(Request $request)
    {
        $token = $request->token_data;
        $admin_token = Admin::where('locked_token', $token)->where('lockout_time', 1)->first();
        if ($admin_token) {
            $check_password = Hash::check($request->password, $admin_token->password);
            if ($check_password) {
                $admin_token->lockout_time = 0;
                $admin_token->locked_token = null;
                $admin_token->save();
                return redirect(route('superadmin.dashboard'));
            }
        }
        return back();
    }


}
