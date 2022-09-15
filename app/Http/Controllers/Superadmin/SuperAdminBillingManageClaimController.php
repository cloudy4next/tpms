<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Edi\ChargeData;
use App\Http\Edi\ClaimData;
use App\Http\Edi\ClaimGenerator;
use App\Http\Edi\ClaimHeader;
use App\Jobs\GenerateClaimCsv;
use App\Models\All_payor;
use App\Models\All_payor_detail;
use App\Models\Appoinment;
use App\Models\Batching_claim;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Client_guarantar_info;
use App\Models\Client_info;
use App\Models\deposit_apply;
use App\Models\deposit_apply_transaction;
use App\Models\Employee;
use App\Models\Employee_credential;
use App\Models\Employee_department;
use App\Models\Employee_details_tx_type;
use App\Models\general_setting;
use App\Models\ledger_list;
use App\Models\ledger_note;
use App\Models\manage_claim;
use App\Models\manage_claim_boxone;
use App\Models\manage_claim_boxtwo;
use App\Models\manage_claim_transaction;
use App\Models\Payor_facility;
use App\Models\Processing_claim;
use App\Models\Rendering_provider;
use App\Models\report_notification;
use App\Models\setting_name_location;
use App\Models\setting_name_location_box_two;
use App\Models\setting_service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class SuperAdminBillingManageClaimController extends Controller
{


    protected $admin_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->is_up_admin == 1) {
                $this->admin_id = Auth::user()->id;
            } else {
                $this->admin_id = Auth::user()->up_admin_id;
            }
            return $next($request);
        });
    }

    public function process_to_edi(Request $request)
    {
        // get all batch data
        $batch_ids=$request->batch_ids;
        $data = Carbon::now()->format('Y-m-d');
        $all_batch_claim = DB::table('batching_claims')
            ->whereIn('id',$batch_ids)
            ->where('has_manage_claim', 0)
            ->where('admin_id',$this->admin_id)
            ->orderBy('client_id', 'asc')
            ->orderBy('cms_24j', 'asc')
            ->where('status', "Ready To Bill")
            ->get();

        
        //get last batch id
        $batch_no_first = manage_claim::select('claim_id', 'batch_id', 'admin_id')
            ->where('admin_id', $this->admin_id)
            ->orderBy('claim_id', 'desc')
            ->first();

        $name_loc = setting_name_location::select('id', 'admin_id', 'short_code')->where('admin_id', $this->admin_id)->first();


        if ($batch_no_first) {
            $batch_id = $batch_no_first->batch_id + 1;
        } else {
            $batch_id = 1000;
        }


        $claim_array = [];


        foreach ($all_batch_claim as $bt_claim) {


            $last_no_batch = manage_claim::select('claim_id', 'batch_id', 'admin_id', 'client_id')
                ->where('admin_id', $this->admin_id)
                ->orderBy('claim_id', 'desc')
                ->first();

            if ($last_no_batch) {
                $lt_batch = $last_no_batch->claim_id;
            } else {
                $lt_batch = 1000;
            }


            $get_batch_data = manage_claim::select('client_id', 'claim_id', 'batch_id', 'admin_id', 'authorization_id')
                ->where('admin_id', $this->admin_id)
                ->where('client_id', $bt_claim->client_id)
                ->where('authorization_id', $bt_claim->authorization_id)
                ->where('claim_id', $lt_batch)
                ->where('batch_id', $batch_id)
                ->count();

            if ($get_batch_data > 0) {

                $update_claim = manage_claim::select('claim_id', 'batch_id', 'admin_id', 'client_id', 'authorization_id')
                    ->where('admin_id', $this->admin_id)
                    ->where('client_id', $bt_claim->client_id)
                    ->where('authorization_id', $bt_claim->authorization_id)
                    ->where('batch_id', $batch_id)
                    ->where('claim_id', $lt_batch)
                    ->orderBy('claim_id', 'desc')
                    ->first();

                $new_claim_id = $update_claim->claim_id;
            } else {

                $get_cliam_id = manage_claim::select('claim_id', 'batch_id', 'admin_id')
                    ->where('admin_id', $this->admin_id)
                    ->orderBy('claim_id', 'desc')
                    ->first();
                if ($get_cliam_id) {
                    $new_claim_id = $get_cliam_id->claim_id + 1;
                } else {
                    $new_claim_id = 1000;
                }
            }


            $count_client_data = manage_claim::select('claim_id', 'batch_id', 'admin_id', 'authorization_id', 'client_id')
                ->where('admin_id', $this->admin_id)
                ->where('client_id', $bt_claim->client_id)
                ->where('authorization_id', $bt_claim->authorization_id)
                ->where('claim_id', $lt_batch)
                ->where('batch_id', $batch_id)
                ->count();

            $auth_no = Client_authorization::select('id', 'authorization_number')->where('id', $bt_claim->authorization_id)->first();

            if ($count_client_data == 0) {
                $update_clm = new manage_claim();
                $update_clm->admin_id = $this->admin_id;
                $update_clm->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $update_clm->claim_id = $new_claim_id;
                $update_clm->batch_id = $batch_id;
                $update_clm->appointment_id = $bt_claim->appointment_id;
                $update_clm->client_id = $bt_claim->client_id;
                $update_clm->provider_id = $bt_claim->provider_id;
                $update_clm->authorization_id = $bt_claim->authorization_id;
                $update_clm->activity_id = $bt_claim->activity_id;
                $update_clm->payor_id = $bt_claim->payor_id;
                $update_clm->activity_type = $bt_claim->activity_type;
                $update_clm->schedule_date = $bt_claim->schedule_date;
                $update_clm->cpt = $bt_claim->cpt;
                $update_clm->m1 = $bt_claim->m1;
                $update_clm->m2 = $bt_claim->m2;
                $update_clm->m3 = $bt_claim->m3;
                $update_clm->m4 = $bt_claim->m4;
                $update_clm->pos = $bt_claim->pos;
                $update_clm->units = $bt_claim->units;
                $update_clm->rate = $bt_claim->rate;
                $update_clm->cms_24j = $bt_claim->cms_24j;
                $update_clm->id_qualifier = $bt_claim->id_qualifier;
                $update_clm->status = $bt_claim->status;
                $update_clm->degree_level = $bt_claim->degree_level;
                $update_clm->zone = $bt_claim->zone;
                $update_clm->location = $bt_claim->location;
                $update_clm->units_value_calc = $bt_claim->units_value_calc;
                $update_clm->billed_am = $bt_claim->billed_am;
                $update_clm->billed_date = $bt_claim->billed_date;
                $update_clm->auth_no = isset($auth_no) ? $auth_no->authorization_number : '';
                $update_clm->save();
            }


            $count_batch_data = manage_claim_transaction::where('claim_id', $new_claim_id)
                ->where('admin_id', $this->admin_id)
                ->where('client_id', $bt_claim->client_id)
                ->where('authorization_id', $bt_claim->authorization_id)
                //                    ->where('cms_24j', $bt_claim->cms_24j)
                ->where('claim_id', $lt_batch)
                ->where('batch_id', $batch_id)
                ->count();

            if ($count_batch_data == 6) {
                $inset_claim_num = $new_claim_id + 1;
                $new_clma = new manage_claim();
                $new_clma->admin_id = $this->admin_id;
                $new_clma->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_clma->claim_id = $inset_claim_num;
                $new_clma->batch_id = $batch_id; //$set_batch_number
                $new_clma->appointment_id = $bt_claim->appointment_id;
                $new_clma->client_id = $bt_claim->client_id;
                $new_clma->provider_id = $bt_claim->provider_id;
                $new_clma->authorization_id = $bt_claim->authorization_id;
                $new_clma->activity_id = $bt_claim->activity_id;
                $new_clma->payor_id = $bt_claim->payor_id;
                $new_clma->activity_type = $bt_claim->activity_type;
                $new_clma->schedule_date = $bt_claim->schedule_date;
                $new_clma->cpt = $bt_claim->cpt;
                $new_clma->m1 = $bt_claim->m1;
                $new_clma->m2 = $bt_claim->m2;
                $new_clma->m3 = $bt_claim->m3;
                $new_clma->m4 = $bt_claim->m4;
                $new_clma->pos = $bt_claim->pos;
                $new_clma->units = $bt_claim->units;
                $new_clma->rate = $bt_claim->rate;
                $new_clma->cms_24j = $bt_claim->cms_24j;
                $new_clma->id_qualifier = $bt_claim->id_qualifier;
                $new_clma->status = $bt_claim->status;
                $new_clma->degree_level = $bt_claim->degree_level;
                $new_clma->zone = $bt_claim->zone;
                $new_clma->location = $bt_claim->location;
                $new_clma->units_value_calc = $bt_claim->units_value_calc;
                $new_clma->billed_am = $bt_claim->billed_am;
                $new_clma->billed_date = $bt_claim->billed_date;
                $new_clma->resubmit_date = null;
                $new_clma->auth_no = isset($auth_no) ? $auth_no->authorization_number : '';
                $new_clma->save();
            } else {
                $inset_claim_num = $new_claim_id;
            }


            $new_manage_claim = new manage_claim_transaction();
            $new_manage_claim->admin_id = $this->admin_id;
            $new_manage_claim->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
            $new_manage_claim->baching_id = $bt_claim->id;
            $new_manage_claim->claim_id = $inset_claim_num; //$inset_claim_num
            $new_manage_claim->batch_id = $batch_id;
            $new_manage_claim->appointment_id = $bt_claim->appointment_id;
            $new_manage_claim->client_id = $bt_claim->client_id;
            $new_manage_claim->provider_id = $bt_claim->provider_id;
            $new_manage_claim->authorization_id = $bt_claim->authorization_id;
            $new_manage_claim->activity_id = $bt_claim->activity_id;
            $new_manage_claim->payor_id = $bt_claim->payor_id;
            $new_manage_claim->activity_type = $bt_claim->activity_type;
            $new_manage_claim->schedule_date = $bt_claim->schedule_date;
            $new_manage_claim->from_time = $bt_claim->from_time;
            $new_manage_claim->to_time = $bt_claim->to_time;
            $new_manage_claim->cpt = $bt_claim->cpt;
            $new_manage_claim->m1 = $bt_claim->m1;
            $new_manage_claim->m2 = $bt_claim->m2;
            $new_manage_claim->m3 = $bt_claim->m3;
            $new_manage_claim->m4 = $bt_claim->m4;
            $new_manage_claim->pos = $bt_claim->pos;
            $new_manage_claim->units = $bt_claim->units;
            $new_manage_claim->rate = $bt_claim->rate;
            $new_manage_claim->cms_24j = $bt_claim->cms_24j;
            $new_manage_claim->id_qualifier = $bt_claim->id_qualifier;
            $new_manage_claim->status = $bt_claim->status;
            $new_manage_claim->degree_level = $bt_claim->degree_level;
            $new_manage_claim->zone = $bt_claim->zone;
            $new_manage_claim->location = $bt_claim->location;
            $new_manage_claim->units_value_calc = $bt_claim->units_value_calc;
            $new_manage_claim->billed_am = $bt_claim->billed_am;
            $new_manage_claim->billed_date = $bt_claim->billed_date;
            $new_manage_claim->resubmit_date = null;
            $new_manage_claim->auth_no = isset($auth_no) ? $auth_no->authorization_number : '';
            $new_manage_claim->save();


            $up_con_num = manage_claim_transaction::select('id', 'control_number')->where('id', $new_manage_claim->id)->first();
            if ($up_con_num) {
                $up_con_num->control_number = $name_loc->short_code . '' . $new_manage_claim->id;
                $up_con_num->save();
            }


            array_push($claim_array, $inset_claim_num);


            $box_33 = manage_claim_boxone::where('admin_id', $this->admin_id)->where('claim_id', $inset_claim_num)->where('batch_id', $batch_id)->count();

            if ($box_33 <= 0) {
                $set_box33 = setting_name_location::where('admin_id', $this->admin_id)->first();

                $new_box33 = new manage_claim_boxone();
                $new_box33->admin_id = $this->admin_id;
                $new_box33->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_box33->claim_id = $inset_claim_num;
                $new_box33->batch_id = $batch_id;
                $new_box33->company_id = $set_box33->company_id;
                $new_box33->facility_name = $set_box33->facility_name;
                $new_box33->address = $set_box33->address;
                $new_box33->address_two = $set_box33->address_two;
                $new_box33->city = $set_box33->city;
                $new_box33->state = $set_box33->state;
                $new_box33->zip = $set_box33->zip;
                $new_box33->phone_one = $set_box33->phone_one;
                $new_box33->short_code = $set_box33->short_code;
                $new_box33->email = $set_box33->email;
                $new_box33->ein = $set_box33->ein;
                $new_box33->npi = $set_box33->npi;
                $new_box33->taxonomy_code = $set_box33->taxonomy_code;
                $new_box33->contact_person = $set_box33->contact_person;
                $new_box33->is_deafilt_facility = $set_box33->is_deafilt_facility;
                $new_box33->start_time = $set_box33->start_time;
                $new_box33->end_time = $set_box33->end_time;
                $new_box33->service_area_miles = $set_box33->service_area_miles;
                $new_box33->user_default_password = $set_box33->user_default_password;
                $new_box33->default_pos = $set_box33->default_pos;
                $new_box33->message = $set_box33->message;
                $new_box33->save();
            }

            $client_zone = Client::where('admin_id', $this->admin_id)->where('id', $bt_claim->client_id)->first();
            $set_box32 = setting_name_location_box_two::where('admin_id', $this->admin_id)->where('id', $client_zone->zone)->first();

            if ($set_box32) {
                $check_man_box32 = manage_claim_boxtwo::where('admin_id', $this->admin_id)->where('claim_id', $inset_claim_num)->where('batch_id', $batch_id)->count();

                if ($check_man_box32 <= 0) {
                    $new_box32 = new manage_claim_boxtwo();
                    $new_box32->admin_id = $this->admin_id;
                    $new_box32->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                    $new_box32->claim_id = $inset_claim_num;
                    $new_box32->batch_id = $batch_id;
                    $new_box32->client_id = $bt_claim->client_id;
                    $new_box32->facility_name_two = $set_box32->facility_name_two;
                    $new_box32->zone_name = $set_box32->zone_name;
                    $new_box32->address = $set_box32->address;
                    $new_box32->city = $set_box32->city;
                    $new_box32->state = $set_box32->state;
                    $new_box32->zip = $set_box32->zip;
                    $new_box32->phone_one = $set_box32->phone_one;
                    $new_box32->save();
                }
            }

            $b_claim_update = Batching_claim::where('id', $bt_claim->id)
                ->where('admin_id', $this->admin_id)
                ->first();

            $b_claim_update->has_manage_claim = 1;
            $b_claim_update->save();

        }


        $generate_ed = $this->generate_edit_file($claim_array);


        return response()->json('new_claim_gen_done', 200);
    }


    protected function generate_edit_file($claims)
    {


        $all_claims = manage_claim::where('admin_id', $this->admin_id)
            ->whereIn('claim_id', $claims)
            ->get();


        $generate = new ClaimGenerator();
        $header = new ClaimHeader();
        $listOfClaims = array();

        // Hard-coded Values
        $header->ISA01AuthQual = '00';
        $header->ISA02AuthInfo = '';
        $header->ISA03SecQual = '00';
        $header->ISA04SecInfo = '';
        $header->ISA05SenderQual = 'ZZ';
        // Sender ID - THiS ID IS PROVIDED BY ZIRMED
        $header->ISA06SenderID = '811837060';
        $header->ISA07ReceiverQual = 'ZZ';
        // RECEIVER ID - THiS ID IS PROVIDED BY ZIMRED
        $header->ISA08ReceiverID = '330897513';

        // 9 Digit Unique Control Number For Every Batch
        // Use any sequencer starting with 111111111 and incriment every time.
        $header->ISA13CntrlNumber = rand(000000000, 999999999); //unique number for every time generate claim

        // File Indicator
        // T for Test, P for Production
        $header->ISA15UsageIndi = 'T';

        // Sender\Receiver IDs - ASSIGNED BY ZIMRED
        $header->GS02SenderID = '101410';
        $header->GS03ReceiverID = '330897513';

        // PUT THE SUBMITTER\BILLING COMPANY HERE
        $header->SubmitterOrgName = 'THERAPYPMS';
        $header->SubmitterID = '101410';        // ASIGNED BY ZIMRED

        $header->SubmitterContactName = 'Peter Brown';
        $header->SubmitterTelephone = '9094069004';
        $header->SubmitterEmail = 'peter@amromed.com';
        //
        $header->ReceiverOrgName = 'Office Ally';
        $header->ReceiverID = '330897513';

        // USE IT AS FALSE.
        $header->RelaxNpiValidation = false;        // Set this true, because in your case NPI is not used.

        // Claim 1 Data -   Subscriber and Patient is SAME
        foreach ($all_claims as $single_claim) {
//            $setting_name = setting_name_location::where('admin_id', Auth::user()->id)->first();

            $setting_name = manage_claim_boxone::where('admin_id', $this->admin_id)
                ->where('claim_id', $single_claim->claim_id)
                ->where('batch_id', $single_claim->batch_id)
                ->first();
            $client_auth = Client_authorization::select('id', 'admin_id', 'authorization_number', 'uci_id', 'diagnosis_one', 'diagnosis_two', 'diagnosis_three', 'diagnosis_four', 'treatment_type')
                ->where('id', $single_claim->authorization_id)
                ->where('admin_id', $this->admin_id)
                ->first();

            $admin_fac_settin = setting_name_location::where('admin_id', $this->admin_id)->first();


            $dis_array = "";

            if ($client_auth->diagnosis_one != null || $client_auth->diagnosis_one != '') {
                $dis_array .= '1';
            }
            if ($client_auth->diagnosis_two != null || $client_auth->diagnosis_two != '') {
                $dis_array .= '2';
            }
            if ($client_auth->diagnosis_three != null || $client_auth->diagnosis_three != '') {
                $dis_array .= '3';
            }
            if ($client_auth->diagnosis_four != null || $client_auth->diagnosis_four != '') {
                $dis_array .= '4';
            }

            $payor_name = All_payor_detail::select('id', 'admin_id', 'payor_id', 'payor_name', 'facility_payor_id', 'ssn', 'cms_1500_32b', 'cms_1500_33b', 'cms_1500_32a',
                'cms_1500_33a', 'cms1500_32address', 'cms1500_32city', 'cms1500_32state', 'cms1500_32zip', 'cms1500_33address', 'cms1500_33city', 'cms1500_33state', 'cms1500_33zip', 'day_pay_cpt')
                ->where('admin_id', $this->admin_id)
                ->where('payor_id', $single_claim->payor_id)->first();

            $payor_details = Payor_facility::where('payor_id', $single_claim->payor_id)
                ->where('admin_id', $this->admin_id)
                ->first();


            $claim = new ClaimData();
            // Billing Provider\Practice\Facility
            $claim->BillPrvOrgName = isset($admin_fac_settin) ? $admin_fac_settin->facility_name : '';
            $claim->BillPrvFirstName = '';
            $claim->BillPrvEntityType = '2';


            if ($payor_name) {
                if ($payor_name->cms_1500_32a != null && $payor_name->cms_1500_33a != null) {
                    $claim->BillPrvNPI = $payor_name->cms_1500_32a . $payor_name->cms_1500_33a;
                } elseif ($payor_name->cms_1500_32a != null && $payor_name->cms_1500_33a == null) {
                    $claim->BillPrvNPI = $payor_name->cms_1500_32a;
                } elseif ($payor_name->cms_1500_32a == null && $payor_name->cms_1500_33a != null) {
                    $claim->BillPrvNPI = $payor_name->cms_1500_33a;
                } else {
                    if ($admin_fac_settin) {
                        if ($admin_fac_settin->npi != null) {
                            $claim->BillPrvNPI = $admin_fac_settin->npi;
                        } else {
                            return back()->with('alert', 'NPI not found');
                        }
                    } else {
                        return back()->with('alert', 'NPI not found');
                    }
                }
            } else {
                if ($admin_fac_settin) {
                    if ($admin_fac_settin->npi != null) {
                        $claim->BillPrvNPI = $admin_fac_settin->npi;
                    } else {
                        return back()->with('alert', 'NPI not found');
                    }
                } else {
                    return back()->with('alert', 'NPI not found');
                }
            }

            //$claim->BillPrvNPI = isset($setting_name->npi) ? $setting_name->npi : '';             // this will be empty in your case

            // Practice\Billing Provider Address
            if ($payor_name) {
                if ($payor_name->cms1500_33address != null && $payor_name->cms1500_33city != null && $payor_name->cms1500_33state != null && $payor_name->cms1500_33zip != null) {
                    $claim->BillPrvAddress1 = $payor_name->cms1500_33address;
                    $claim->BillPrvCity = $payor_name->cms1500_33city;
                    $claim->BillPrvState = $payor_name->cms1500_33state;
                    $claim->BillPrvZipCode = $payor_name->cms1500_33zip;
                } else {
                    $claim->BillPrvAddress1 = isset($admin_fac_settin) ? $admin_fac_settin->address : '';
                    $claim->BillPrvCity = isset($admin_fac_settin) ? $admin_fac_settin->city : '';
                    $claim->BillPrvState = isset($admin_fac_settin) ? $admin_fac_settin->state : '';
                    $claim->BillPrvZipCode = isset($admin_fac_settin) ? $admin_fac_settin->zip : '';
                }
            } else {
                $claim->BillPrvAddress1 = isset($admin_fac_settin) ? $admin_fac_settin->address : '';
                $claim->BillPrvCity = isset($admin_fac_settin) ? $admin_fac_settin->city : '';
                $claim->BillPrvState = isset($admin_fac_settin) ? $admin_fac_settin->state : '';
                $claim->BillPrvZipCode = isset($admin_fac_settin) ? $admin_fac_settin->zip : '';
            }


            // Billing Provider Tax ID\EIN

            $claim->BillPrvTaxID = isset($admin_fac_settin) ? $admin_fac_settin->ein : '';

            // Billing Provider Secondary ID
            $claim->BillPrvSecondaryID = '';        // copied from your edi file

            // Billing Provider Taxonomy

            if ($payor_name) {
                if ($payor_name->cms_1500_32b != null && $payor_name->cms_1500_33b != null) {
//                    $claim->BillPrvTaxonomyCode = $payor_name->cms_1500_32b . $payor_name->cms_1500_33b;
                    $claim->BillPrvTaxonomyCode = $payor_name->cms_1500_33b;
                } elseif ($payor_name->cms_1500_32b != null && $payor_name->cms_1500_33b == null) {
                    $claim->BillPrvTaxonomyCode = $payor_name->cms_1500_32b;
                } elseif ($payor_name->cms_1500_32b == null && $payor_name->cms_1500_33b != null) {
                    $claim->BillPrvTaxonomyCode = $payor_name->cms_1500_33b;
                } else {
                    if ($admin_fac_settin) {
                        if ($admin_fac_settin->taxonomy != null) {
                            $claim->BillPrvTaxonomyCode = $admin_fac_settin->taxonomy;
                        } else {
//                            return back()->with('alert', 'Taxonomy Code can not be blank');
                            $claim->BillPrvTaxonomyCode = '';
                        }
                    } else {
//                        return back()->with('alert', 'Taxonomy Code can not found.');
                        $claim->BillPrvTaxonomyCode = '';
                    }
                }
            } else {
                if ($admin_fac_settin) {
                    if ($admin_fac_settin->taxonomy != null) {
                        $claim->BillPrvTaxonomyCode = $admin_fac_settin->taxonomy;
                    } else {
//                        return back()->with('alert', 'Taxonomy Code can not be blank');
                        $claim->BillPrvTaxonomyCode = '';
                    }
                } else {
//                    return back()->with('alert', 'Taxonomy Code can not found.');
                    $claim->BillPrvTaxonomyCode = '';
                }
            }          // not used here in your case

            // Billing Provider Pay to Address (Where Checks will be droppd)		// empty in your case
            $claim->BillPrvPayToAddr = "";
            $claim->BillPrvPayToCity = "";
            $claim->BillPrvPayToState = "";
            $claim->BillPrvPayToZip = "";


            // Set Following Values for Payer Type

            // For Medicare Part A          -   MA
            // For Medicare Part B          -   MB
            // For Blue Cross/Blue Sheild   -   BS
            // For Medicaid                 -   MC
            // For Champus                  -   CH
            // For Commercial Insurances    -   CI
            // For Veteran Administration   -   VA
            // For Other Federal Program    -   OF
            // For Health Maintenance Org   -   HM
            // For Worker Compensation      -   WC
            $claim->PayerType = 'CI'; // need to discuss with peter

            // Claim Type
            // P for Primary, S for Secondary
            $claim->ClaimType = 'P';
            $claim->SbrGroupNumber = '';

            // Subscriber\Insured Name, Insrued ID, Address, Gender, DOB

            $client = Client::select('id', 'admin_id', 'client_first_name', 'client_middle', 'client_last_name', 'client_street', 'client_city', 'client_state', 'client_zip', 'client_dob', 'client_gender', 'zone')
                ->where('admin_id', $this->admin_id)
                ->where('id', $single_claim->client_id)
                ->first();
            $client_info = Client_info::select('id', 'admin_id', 'relationship', 'client_reffered_by')
                ->where('admin_id', $this->admin_id)
                ->where('client_id', $client->id)
                ->first();


            $client_dob_yer = Carbon::parse($client->client_dob)->isoFormat('YYYYMMDD');

            $claim->SBRLastName = $client->client_last_name;
            $claim->SBRFirstName = $client->client_first_name;
            $claim->SBRID = $client_auth->uci_id;
            $claim->SBRAddress = $client->client_street;
            $claim->SBRCity = $client->client_city;
            $claim->SBRState = $client->client_state;
            $claim->SBRZipCode = $client->client_zip;
            $claim->SBRDob = Carbon::parse($client->client_dob)->isoFormat('YYYYMMDD');
            $claim->SBRGender = $client->client_gender == "Male" ? 'M' : 'F';      // M for Male, F for Female, U for Unknown

            // Patient Relation Ship With Insured.
            // Self             -   18
            // Child            -   19
            // Spouse           -   01
            // Unknown/Other    -   21
            if ($client_info->relationship == 'Self') {
                $claim->PatientRelationShip = 18;
            } elseif ($client_info->relationship == 'Child') {
                $claim->PatientRelationShip = 19;
            } elseif ($client_info->relationship == 'Spouse') {
                $claim->PatientRelationShip = 01;
            } else {
                $claim->PatientRelationShip = 21;
            }

            if ($client_info->relationship == 'Self') {
                // IF PATIENT RELATION SHIP IS SELF (18), NO NEED TO SET PATIENT FEILDS
                $claim->PATLastName = '';
                $claim->PATFirstName = '';
                $claim->PATMiddleInitial = '';
                $claim->PATAddress = '';
                $claim->PATCity = '';
                $claim->PATState = '';
                $claim->PATZipCode = '';
                $claim->PATDob = '';
                $claim->PATGender = '';
            } else {

                // IF PATIENT RELATION SHIP IS SELF (18), NO NEED TO SET PATIENT FEILDS
                $claim->PATLastName = $client->client_last_name;
                $claim->PATFirstName = $client->client_first_name;
                $claim->PATMiddleInitial = $client->client_middle;
                $claim->PATAddress = $client->client_street;
                $claim->PATCity = $client->client_city;
                $claim->PATState = $client->client_state;
                $claim->PATZipCode = $client->client_zip;
                $claim->PATDob = Carbon::parse($client->client_dob)->isoFormat('YYYYMMDD');
                $claim->PATGender = $client->client_gender == "Male" ? 'M' : 'F';
            }
            //

            // Insurace\Payer Name, Payer ID
            if ($payor_name) {
                $claim->PayerName = $payor_name->payor_name;
            } else {
                $claim->PayerName = "";
            }

            if ($payor_details) {
                $claim->PayerID = $payor_details->ele_payor_id;
            } else {
                $claim->PayerID = '';
            }
            // Payer ID - Will be selected from Office Allay Payer List


            // Patient Account Number
            $pt_cntr_num = isset($admin_fac_settin) ? $admin_fac_settin->short_code . '' . $single_claim->claim_id : $single_claim->claim_id;
            $claim->PatientControlNumber = $pt_cntr_num;        // unique claim number
            $claim->MedicalRecordNumber = $single_claim->claim_id;   // medical record number

            // Total Charge Amount
            $total_change_am = manage_claim_transaction::select('admin_id', 'claim_id', 'billed_am')->where('admin_id', $this->admin_id)->where('claim_id', $single_claim->claim_id)->sum('billed_am');


            $claim->ClaimAmount = $total_change_am;
            // Place of Service - Set Place of Service from First Service Line
            $claim->POSCode = $single_claim->location;

            // ICD\Diagnosis
            $claim->ICD1Code = $client_auth->diagnosis_one;
            $claim->ICD2Code = $client_auth->diagnosis_two;
            $claim->ICD3Code = $client_auth->diagnosis_three;
            $claim->ICD4Code = $client_auth->diagnosis_four;
            $claim->ICD5Code = '';
            $claim->ICD6Code = '';
            $claim->ICD7Code = '';
            $claim->ICD8Code = '';
            $claim->ICD9Code = '';
            $claim->ICD10Code = '';
            $claim->ICD11Code = '';
            $claim->ICD12Code = '';


            $claim->AccidentDate = '';                // accident info empty in you case
            // Auto Accident    -   AA
            // Employment       -   EM
            // Other Accident   -   OA
            $claim->AccidentType = '';
            $claim->AccidentState = '';

            // Claim Dates
            $claim->AdmissionDate = '';        // this is date time yyyyMMddhhmmss
            $claim->DischargeDate = '';
            $claim->LMPDate = '';
            $claim->InitialTreatmentDate = '';
            $claim->DisabilityStartDate = '';
            $claim->DisabilityEndDate = '';

            if ($admin_fac_settin->is_combo == 1) {
                if ($single_claim->auth_no != null || $single_claim->auth_no != '') {
                    $claim->PriorAuthNumber = $single_claim->auth_no;   // this is used in your case.
                } else {
                    $claim->PriorAuthNumber = '';   // this is used in your case.
                }

            } else {
                $claim->PriorAuthNumber = $client_auth->authorization_number;   // this is used in your case.
            }


            // Rendering Provider
            $cms_24j = Employee::select('id', 'admin_id', 'last_name', 'first_name', 'middle_name', 'individual_npi')
                ->where('admin_id', $this->admin_id)
                ->where('id', $single_claim->cms_24j)
                ->first();


            $em_tx_types = Employee_details_tx_type::where('employee_id', $cms_24j->id)
                ->where('treatment_name', $client_auth->treatment_type)
                ->first();


            $claim->RendPrvLastName = isset($cms_24j->last_name) ? $cms_24j->last_name : null;    // empty in your case
            $claim->RendPrvFirstName = isset($cms_24j->first_name) ? $cms_24j->first_name : null;
            $claim->RendPrvMI = isset($cms_24j->middle_name) ? $cms_24j->middle_name : null;
            $claim->RendPrvNPI = isset($cms_24j->individual_npi) ? $cms_24j->individual_npi : null;
            if ($em_tx_types) {
                if ($em_tx_types->id_qualifire == 'ZZ' && $em_tx_types->box_24j != null || $em_tx_types->box_24j != "")
                    $claim->RendPrvTaxonomy = $em_tx_types->box_24j; // ren prov taxnomy
            } else {
                $claim->RendPrvTaxonomy = ""; // ren prov taxnomy
            }

            // Referring Provider			// empty in your case
            $ref_provider = Rendering_provider::where('id', $client_info->client_reffered_by)
                ->where('admin_id', $this->admin_id)
                ->first();

            $claim->RefPrvLastName = isset($ref_provider) ? $ref_provider->provider_name : '';
            $claim->RefPrvFirstName = isset($ref_provider) ? $ref_provider->provider_last_name : '';
            $claim->RefPrvMI = '';
            $claim->RefPrvNPI = isset($ref_provider) ? $ref_provider->npi : '';

            // Supervising Provider			// empty in your case
            $claim->SuperPrvLastName = '';
            $claim->SuperPrvFirstName = '';
            $claim->SuperPrvMI = '';
            $claim->SuperPrvNPI = '';

            // Location
//            $box_32_data = setting_name_location_box_two::where('admin_id', Auth::user()->id)->first();

            $box_32_data = manage_claim_boxtwo::where('admin_id', $this->admin_id)
                ->where('claim_id', $single_claim->claim_id)
                ->where('batch_id', $single_claim->batch_id)
                ->where('client_id', $single_claim->client_id)
                ->first();

            $box_32_client = setting_name_location_box_two::where('id', $client->zone)->first();


            if ($payor_name) {
                if ($payor_name->cms1500_32address != null && $payor_name->cms1500_32city != null && $payor_name->cms1500_32state != null && $payor_name->cms1500_32zip != null) {
                    $claim->LocationOrgName = isset($box_32_client) ? $box_32_client->facility_name_two : '';    // empty in your case // use 32 box in here
                    if ($payor_name->cms_1500_32a != null) {
                        $claim->LocationNPI = $payor_name->cms_1500_32a; //optional 32 npi
                    } else {
                        $claim->LocationNPI = isset($box_32_client) ? $box_32_client->npi : ''; //optional 32 npi
                    }
                    $claim->LocationAddress = $payor_name->cms1500_32address;
                    $claim->LocationCity = $payor_name->cms1500_32city;
                    $claim->LocationState = $payor_name->cms1500_32zip;
                    $claim->LocationZip = $payor_name->cms1500_32zip;
                } else {
                    $claim->LocationOrgName = isset($box_32_client) ? $box_32_client->facility_name_two : '';    // empty in your case // use 32 box in here
                    $claim->LocationNPI = isset($box_32_client) ? $box_32_client->npi : ''; //optional 32 npi
                    $claim->LocationAddress = isset($box_32_client) ? $box_32_client->address : '';
                    $claim->LocationCity = isset($box_32_client) ? $box_32_client->city : '';
                    $claim->LocationState = isset($box_32_client) ? $box_32_client->state : '';
                    $claim->LocationZip = isset($box_32_client) ? $box_32_client->zip : '';
                }
            } else {
                $claim->LocationOrgName = isset($box_32_client) ? $box_32_client->facility_name_two : '';    // empty in your case // use 32 box in here
                $claim->LocationNPI = isset($box_32_client) ? $box_32_client->npi : ''; //optional 32 npi
                $claim->LocationAddress = isset($box_32_client) ? $box_32_client->address : '';
                $claim->LocationCity = isset($box_32_client) ? $box_32_client->city : '';
                $claim->LocationState = isset($box_32_client) ? $box_32_client->state : '';
                $claim->LocationZip = isset($box_32_client) ? $box_32_client->zip : '';
            }


            $claim->ClaimNotes = isset($single_claim->box_19) ? $single_claim->box_19 : ''; // box 19
            $claim->ClaimFreqCode = isset($single_claim->resubmit_code) ? $single_claim->resubmit_code : '1'; // Resubmission Code
            $claim->PayerClaimCntrlNum = isset($single_claim->orginal_ref_number) ? $single_claim->orginal_ref_number : ''; //Org. Ref. Number


            // Service Lines
            //            $charge1 = new ChargeData();
            //            $charge1->CptCode = '9989M';      // CPT
            //            $charge1->ChargeAmount = 39.15;    // Charge Amount
            //            $charge1->Units = '45';           // Units
            //            $charge1->Pointer1 = '1';         // Pointer 1
            //            $charge1->Pointer2 = '';         // Pointer 2
            //            $charge1->Pointer3 = '';         // Pointer 3
            //            $charge1->Pointer4 = '';         // Pointer 4
            //            $charge1->POS = '';             // POS - Don't set if, POS is same of All Charges and same with Claim POS
            //            $charge1->DateofServiceFrom = '20190706';      // Date of Service
            //            $charge1->DateOfServiceTo = '';
            //            $charge1->LineItemControlNum = '5853175';        // Charge Control Number - Unique Number - Era Payment will be mapped with this.
            //            $charge1->LIDescription = 'HOMEMAKER SERVICES';    // this is used in your case for few types of visits.


            // Adding Claim's Charges into List
            //            array_push($claim->ListOfChargesData, $charge1);


            // Adding Claims into Claims List
            //            array_push($listOfClaims, $claim);

            $manage_claim_transactions = manage_claim_transaction::where('claim_id', $single_claim->claim_id)
                ->where('admin_id', $this->admin_id)
                ->get();

            foreach ($manage_claim_transactions as $single_claim_transaction) {
                $claim_single_auth = Client_authorization::select('id', 'admin_id', 'diagnosis_one', 'diagnosis_two', 'diagnosis_three', 'diagnosis_four')
                    //->where('admin_id', Auth::user()->id)
                    ->where('id', $single_claim_transaction->authorization_id)
                    ->first();

                $app_data = Appoinment::select('id', 'admin_id', 'from_time', 'to_time')->where('id', $single_claim_transaction->appointment_id)->first();
                $form_time = Carbon::parse($app_data->from_time)->format('g:i a');
                $to_time = Carbon::parse($app_data->to_time)->format('g:i a');

                $time_in_12_hour_format = date("Hi", strtotime($form_time));
                $time_in_12_hour_format_2 = date("Hi", strtotime($to_time));


                $lmnum = isset($setting_name->short_code) ? $setting_name->short_code . '' . $single_claim_transaction->id : $single_claim_transaction->id;

                $charge1 = new ChargeData();
                $charge1->CptCode = str_replace(' ', '', $single_claim_transaction->cpt);      // CPT
                $charge1->Modifier1 = $single_claim_transaction->m1;         // Modifier 1
                $charge1->Modifier2 = $single_claim_transaction->m2;         // Modifier 2
                $charge1->Modifier3 = $single_claim_transaction->m3;         // Modifier 3
                $charge1->Modifier4 = $single_claim_transaction->m4;         // Modifier 4
                $charge1->POS = $single_claim_transaction->location;
                $charge1->ChargeAmount = $single_claim_transaction->billed_am;    // Charge Amount
                if ($payor_name->day_pay_cpt == 1) {
                    $charge1->ServiceLineNotes = $time_in_12_hour_format . '-' . $time_in_12_hour_format_2;
                } else {
                    $charge1->ServiceLineNotes = '';
                }

                $charge1->Units = $single_claim_transaction->units;           // Units
                $charge1->Pointer1 = $claim_single_auth->diagnosis_one == null ? null : '1';         // Pointer 1
                $charge1->Pointer2 = $claim_single_auth->diagnosis_two == null ? null : '2';         // Pointer 2
                $charge1->Pointer3 = $claim_single_auth->diagnosis_three == null ? null : '3';         // Pointer 3
                $charge1->Pointer4 = $claim_single_auth->diagnosis_four == null ? null : '4';
                $charge1->DateofServiceFrom = Carbon::parse($single_claim_transaction->schedule_date)->isoFormat('YYYYMMDD'); //Carbon::parse($client->client_dob)->isoFormat('YYYYMMDD')
                $charge1->LineItemControlNum = $lmnum;
                $charge1->LIDescription = ''; // show time 10.00AM 11.00 AM
                array_push($claim->ListOfChargesData, $charge1);
            }


            // Adding Claim's Charges into List

            //            return $claim->ListOfChargesData;
            //            return $claim->ListOfChargesData;

            // Adding Claims into Claims List
            array_push($listOfClaims, $claim);
        }


        //List<ClaimData> claims = new List<ClaimData>() { claim, claim2 };
        //List<ClaimData> claims = new List<ClaimData>() { claim};
        $time = Auth::user()->id . time();
        $output = $generate->Generate837Transaction($header, $listOfClaims, public_path('edi/' . $time . ".txt"));
        $f_name = "837-" . Auth::user()->id . time() . ".txt";
        $file_path = public_path("edi/" . $f_name);
        //        return $output->Transaction837;
        File::put($file_path, strtoupper($output->Transaction837));
        //        echo "Processed Claims: " . $output->ProcessedClaims . '</br>';
        //        return substr($output->Transaction837,0,20);
        // 	Based on the Output, you can maintain the SubmissionHistoryLog (batch wise) with following columns
        //	ID, Edi837FilePath, NumberOfClaims, Amount, Date etc.


        // Check For Not Processed Claims, that are put on hold due to required data missing.
        foreach ($output->ListOfClaims as $CLM) {
            // If Processed is True, that means this claim has been included in the claim string.
            // You can mark the claim Processed in your system, based on this variable.
            if ($CLM->Processed) {
                //                echo 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', Processed: ' . $CLM->Processed . ', Processed Date: ' . $CLM->ProcessedDate . '</br>';
            }
            // If claim is not Processed, it will have the Validation Message
            // Probably the required data is not provided.
            else {
                // You can get ValidationMsg
                // And Save into your system.
                // Can Resubmit Again after fixing the data.
                // Validation Msgs could be: Billing Provider NPI is required Or Payer Type is required etc.

                // Validation Msgs are put so that clean claim should be submitted to OFFICEALLY in the first place.
                $validationMsg = $CLM->ValidationMsg;

                if ($validationMsg != '') {
                    //                    echo 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', Validation Msg. ' . $CLM->ValidationMsg . '</br>';
                    $error_msg = 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', ERROR :. ' . $CLM->ValidationMsg . '</br>';
                    return back()->with('alert', $error_msg);
                }
            }
        }


        $new_noti = new report_notification();
        $new_noti->admin_id = $this->admin_id;
        $new_noti->name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $new_noti->notification_date = Carbon::now();
        $new_noti->file_name = $f_name;
        $new_noti->report_type = 22;
        $new_noti->report_name = "edi";
        $new_noti->form_date = null;
        $new_noti->to_date = null;
        $new_noti->status = "Complete";
        $new_noti->type = 1;
        $new_noti->save();

        return 'edi_added';


//        $download_file = $f_name;

//        return response()->json($download_file, 200);
    }


    public function billing_claim_management_get_batchid(Request $request)
    {
        $claim = manage_claim_transaction::distinct()->select('batch_id', 'admin_id')
            ->where('admin_id', $this->admin_id)
            ->orderBy('batch_id', 'desc')
            ->get();

        return $claim;
    }

    public function billing_claim_management_get_payor(Request $request)
    {
        $name_loca = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        $array = [];
        $auth = manage_claim_transaction::distinct()->select('payor_id')
            ->where('admin_id', $this->admin_id)
            ->get();


        foreach ($auth as $au) {
            array_push($array, $au->payor_id);
        }

        $payors = All_payor_detail::select('id', 'payor_id', 'admin_id', 'payor_name')
            ->whereIn('payor_id', $array)
            ->where('admin_id', $this->admin_id)
            ->orderBy('payor_name', 'Asc')
            ->get();


        return response()->json([
            'payors' => $payors,
            'name_loca' => $name_loca->is_combo,
        ]);
    }

    public function billing_claim_management_get_client(Request $request)
    {
        $array = [];

        $auth = manage_claim_transaction::distinct()->select('client_id')
            ->where('admin_id', $this->admin_id)
            ->get();
        foreach ($auth as $au) {
            array_push($array, $au->client_id);
        }
        $clients = Client::whereIn('id', $array)->orderBy('client_full_name', 'asc')->get();

        return $clients;
    }


    public function billing_claim_management_get_treating_employee(Request $request)
    {
        $employee = Employee::where('admin_id', $this->admin_id)->orderBy('full_name', 'asc')->get();

        return $employee;
    }


    public function billing_claim_management_get_cms_employee(Request $request)
    {

        $employee_sup = manage_claim_transaction::distinct()->select('cms_24j')->where('admin_id', $this->admin_id)->get();

        $array = [];

        foreach ($employee_sup as $ap) {
            array_push($array, $ap->cms_24j);
        }

        $employee = Employee::whereIn('id', $array)
            ->where('admin_id', $this->admin_id)
            ->orderBy('full_name', 'asc')->get();

        return $employee;
    }


    public function billing_claim_management_get_activitytype(Request $request)
    {
        $app = manage_claim_transaction::distinct()->select('activity_id')
            ->where('admin_id', $this->admin_id)
            ->get();


        $array = [];

        foreach ($app as $ap) {
            array_push($array, $ap->activity_id);
        }

        $client_activity = Client_authorization_activity::whereIn('id', $array)
            ->where('admin_id', $this->admin_id)
            ->orderBy('activity_one', 'asc')
            ->get();

        return $client_activity;
    }


    public function billing_claim_management_get_claimstatus(Request $request)
    {
        $app = manage_claim_transaction::distinct()->select('status')
            ->where('admin_id', $this->admin_id)
            ->get();


        return $app;
    }


    public function billing_claim_byfilter(Request $request)
    {

        $batch_id = $request->batch_id;
        $claim_name = $request->claim_name;
        $payor = $request->payor;
        $client = $request->client;
        $treating_therapist = $request->treating_therapist;
        $cms_emloyee = $request->cms_emloyee;
        $activitytype = $request->activitytype;
        $claimstatus = $request->claimstatus;
        $reportrange = $request->reportrange;
        $reportrange1 = substr($reportrange, 0, 10);
        $reportrange1_format = Carbon::parse($reportrange1)->format('Y-m-d');
        $reportrange2 = substr($reportrange, 13, 24);
        $reportrange2_format = Carbon::parse($reportrange2)->format('Y-m-d');
        $sumiteddate = $request->sumiteddate;
        $sumiteddate1 = Carbon::parse($sumiteddate)->format('Y-m-d');

        $batch_id_one = $request->batch_id_one;
        $claim_name_one = $request->claim_name_one;
        $payor_one = $request->payor_one;
        $client_one = $request->client_one;
        $treating_therapist_one = $request->treating_therapist_one;
        $cms_emloyee_one = $request->cms_emloyee_one;
        $activitytype_one = $request->activitytype_one;
        $claimstatus_one = $request->claimstatus_one;
        $reportrange_one = $request->reportrange_one;
        $reportrange_one_1 = substr($reportrange_one, 0, 10);
        $reportrange_one_format_1 = Carbon::parse($reportrange_one_1)->format('Y-m-d');
        $reportrange_one_2 = substr($reportrange_one, 13, 24);
        $reportrange_one_format_2 = Carbon::parse($reportrange_one_2)->format('Y-m-d');
        $sumiteddate_one = $request->sumiteddate_one;
        $sumiteddate_one_1 = Carbon::parse($sumiteddate_one)->format('Y-m-d');


        $admin_id = $this->admin_id;
        $up_admin_id = Auth::user()->up_admin_id;

        $name_loca = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();

        $query = "SELECT * FROM manage_claims WHERE admin_id=$admin_id ";
        $name_location = setting_name_location::select('admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();


        if (isset($batch_id)) {
            $query .= "AND batch_id =$batch_id ";
        }
        if (isset($claim_name)) {
            $query .= "AND claim_id ='$claim_name' ";
        }

        if (isset($payor)) {
            if ($name_loca->is_combo == 1) {
                $payor_filter = implode("','", $payor);
                $query .= "AND payor_id IN('" . $payor_filter . "') ";
            } else {
                $query .= "AND payor_id =$payor ";
            }

        }

        if (isset($client)) {
            $query .= "AND client_id =$client ";
        }

        if (isset($treating_therapist)) {
            $query .= "AND provider_id =$treating_therapist ";
        }

        if (isset($cms_emloyee)) {
            $query .= "AND cms_24j =$cms_emloyee ";
        }

        if (isset($activitytype)) {
            $query .= "AND activity_id =$activitytype ";
        }
        if (isset($sumiteddate)) {
            $query .= "AND created_at =$sumiteddate1 ";
        }

        if (isset($reportrange)) {
            $query .= "AND schedule_date >= '$reportrange1_format' ";
            $query .= "AND schedule_date <= '$reportrange2_format' ";
        }

        //filter two
        if (isset($batch_id_one)) {
            $query .= "AND batch_id =$batch_id_one ";
        }

        if (isset($claim_name_one)) {
            $query .= "AND claim_id =$claim_name_one ";
        }


        if (isset($payor_one)) {
            if ($name_loca->is_combo == 1) {
                $payorone_filter = implode("','", $payor_one);
                $query .= "AND payor_id IN('" . $payorone_filter . "') ";
            } else {
                $query .= "AND payor_id =$payor_one ";
            }

        }

        if (isset($client_one)) {
            $query .= "AND client_id =$client_one ";
        }

        if (isset($treating_therapist_one)) {
            $query .= "AND provider_id =$treating_therapist_one ";
        }

        if (isset($cms_emloyee_one)) {
            $query .= "AND cms_24j =$cms_emloyee_one ";
        }

        if (isset($activitytype_one)) {
            $query .= "AND activity_id =$activitytype_one ";
        }
        if (isset($sumiteddate)) {
            $query .= "AND created_at =$sumiteddate_one_1 ";
        }

        if (isset($reportrange_one)) {
            $query .= "AND schedule_date >= '$reportrange_one_format_1' ";
            $query .= "AND schedule_date <= '$reportrange_one_format_2' ";
        }


        $query .= "ORDER BY claim_id ASC";
        $query_exe = DB::select($query);


        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.claimManagement.include.claim_table', compact('query_exe', 'name_location'))->render(),
        ]);
    }


    public function billing_claim_update_auth(Request $request)
    {

        $name_loca = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();

        $claims = $request->claim_id;
        $data = $request->all();
        for ($i = 0; $i < count($data['claim_id']); $i++) {

            $clm = manage_claim::where('claim_id', $data['claim_id'][$i])
                ->where('admin_id', $this->admin_id)
                ->first();

            if ($clm) {
                $clm->resubmit_date = Carbon::now()->format('Y-m-d');
                if ($name_loca->is_combo == 1) {
                    $clm->auth_no = $data['authno'][$i];
                }
                $clm->save();
                $manage_claim = manage_claim_transaction::where('admin_id', $this->admin_id)
                    ->where('claim_id', $clm->claim_id)
                    ->update(['resubmit_date' => Carbon::now()->format('Y-m-d'), 'auth_no' => $clm->auth_no]);
            }
        }

        return "success";
    }


    public function billing_claim_update_data(Request $request)
    {

        $name_loca = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();
        $claims = $request->claim_id;
        $data = $request->all();
        for ($i = 0; $i < count($data['claim_id']); $i++) {
            $clm = manage_claim::where('claim_id', $data['claim_id'][$i])
                ->where('admin_id', $this->admin_id)
                ->first();

            if ($clm) {
                if ($data['box19'][$i] != null && $data['box19'][$i] != '') {
                    $clm->box_19 = $data['box19'][$i];
                }
                if ($data['resubmitcode'][$i] != null && $data['resubmitcode'][$i] != '') {
                    $clm->resubmit_code = $data['resubmitcode'][$i];
                }

                if ($data['orginal'][$i] != null && $data['orginal'][$i] != '') {
                    $clm->orginal_ref_number = $data['orginal'][$i];
                }

                $clm->resubmit_date = Carbon::now()->format('Y-m-d');
                $clm->save();

                $manage_claim = manage_claim_transaction::where('admin_id', $this->admin_id)
                    ->where('claim_id', $clm->claim_id)
                    ->update(['box_19' => $clm->box_19, 'resubmit_code' => $clm->resubmit_code, 'orginal_ref_number' => $clm->orginal_ref_number, 'resubmit_date' => Carbon::now()->format('Y-m-d')]);
            }
        }

        return "success";
    }


    public function billing_claim_management_history(Request $request)
    {
        $claim_id = $request->claim_id;
        $claim_filter = implode("','", $claim_id);
        $admin_id = $this->admin_id;
        $up_admin_id = Auth::user()->up_admin_id;
        $query = "SELECT * FROM manage_claim_transactions WHERE claim_id IN('" . $claim_filter . "') AND admin_id=$admin_id ";
        $name_location = setting_name_location::select('admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();

        $query .= "ORDER BY claim_id,schedule_date ASC";
        $query_exe = DB::select($query);

        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.claimManagement.include.claim_table_transaction', compact('query_exe', 'name_location'))->render(),
        ]);
    }


    public function billing_claim_rebilled_transaction(Request $request)
    {
        $claim_id = $request->claim_id;

        $get_claim = manage_claim_transaction::whereIn('id', $claim_id)
            ->where('admin_id', $this->admin_id)
            ->get();

        $name_loca = setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();

        foreach ($get_claim as $claim) {

            $dep_transaction = deposit_apply_transaction::where('batching_claim_id', $claim->baching_id)
                ->where('admin_id', $this->admin_id)
                ->where('appointment_id', $claim->appointment_id)
                ->first();
            if (!$dep_transaction) {
                $dep_apply = deposit_apply::where('batching_claim_id', $claim->baching_id)
                    ->where('admin_id', $this->admin_id)
                    ->where('appointment_id', $claim->appointment_id)
                    ->first();
                if ($dep_apply) {
                    $dep_apply->delete();
                }
            }


            $legder_data = ledger_list::where('admin_id', $this->admin_id)->where('batching_id', $claim->baching_id)->first();
            if ($legder_data) {
                $leger_note_del = ledger_note::where('ledger_id', $legder_data->id)->first();
                if ($leger_note_del) {
                    $leger_note_del->delete();
                }
                $legder_data->delete();
            }

            $batching_claim = Batching_claim::where('id', $claim->baching_id)
                ->where('admin_id', $this->admin_id)
                ->where('appointment_id', $claim->appointment_id)
                ->delete();
            // if ($batching_claim) {
            //     $batching_claim->delete();
            // }

            if ($name_loca->is_combo == 1) {


                $proceccing_claim = Processing_claim::where('appointment_id', $claim->appointment_id)
                    ->where('cpt', $claim->cpt)
                    ->where('admin_id', $this->admin_id)
                    ->get();
                foreach ($proceccing_claim as $bprclaim) {
                    $sing_bpro_claim = Processing_claim::select('id', 'admin_id', 'appointment_id', 'is_mark_gen')
                        ->where('admin_id', $this->admin_id)
                        ->where('appointment_id', $bprclaim->appointment_id)
                        ->where('cpt', $claim->cpt)
                        ->update(['is_mark_gen' => 0]);

                    $app_mark_update = Appoinment::where('id', $claim->appointment_id)->update(['is_mark_gen' => 0]);
                    // if ($app_mark_update) {
                    //     $app_mark_update->is_mark_gen = 0;
                    //     $app_mark_update->save();
                    // }
                }

            } else {
                $proceccing_claim = Processing_claim::where('appointment_id', $claim->appointment_id)
                    ->where('admin_id', $this->admin_id)
                    ->update(['is_mark_gen' => 0]);

                $app_mark_update = Appoinment::where('id', $claim->appointment_id)
                    ->update(['is_mark_gen' => 0]);

                // if ($proceccing_claim) {
                //     $proceccing_claim->is_mark_gen = 0;
                //     $proceccing_claim->save();


                //     $app_mark_update = Appoinment::where('id', $proceccing_claim->appointment_id)->first();
                //     if ($app_mark_update) {
                //         $app_mark_update->is_mark_gen = 0;
                //         $app_mark_update->save();
                //     }


                // }
            }


            $box_del33 = manage_claim_boxone::where('claim_id', $claim->claim_id)->where('batch_id', $claim->batch_id)->first();
            if ($box_del33) {
                $box_del33->delete();
            }

            $box_del32 = manage_claim_boxtwo::where('claim_id', $claim->claim_id)->where('batch_id', $claim->batch_id)->first();
            if ($box_del32) {
                $box_del32->delete();
            }


            $claim->delete();

            $count_manage_claim = manage_claim_transaction::where('admin_id', $this->admin_id)->where('claim_id', $claim->claim_id)->count();
            if ($count_manage_claim <= 0) {
                $delete_cliam = manage_claim::where('claim_id', $claim->claim_id)
                    ->where('admin_id', $this->admin_id)
                    ->delete();
                // $delete_cliam->delete();
            }
        }


        return 'rebullid_done';
    }


    public function billing_claim_split_transaction(Request $request)
    {
        $transaction_id = $request->claim_id;
        $last_claim_id = manage_claim::select('claim_id')->orderBy('claim_id', 'desc')->first();


        $last_batch_id = manage_claim_transaction::select('batch_id')
            ->where('admin_id', $this->admin_id)
            ->orderBy('batch_id', 'desc')
            ->first();

        $new_claim_id = $last_claim_id->claim_id + 1;
        $new_batch_id = $last_batch_id->batch_id + 1;


        $get_claim = manage_claim_transaction::whereIn('id', $transaction_id)
            ->where('admin_id', $this->admin_id)
            ->get();

        foreach ($get_claim as $claim_tran) {


            $claim_data = manage_claim::select('claim_id')->where('claim_id', $new_claim_id)
                ->where('admin_id', $this->admin_id)
                ->first();
            $count_claim = manage_claim_transaction::select('claim_id')->where('claim_id', $claim_tran->claim_id)
                ->where('admin_id', $this->admin_id)
                ->count();


            if ($count_claim > 1) {
                if (!$claim_data) {
                    $new_create_claim = new manage_claim();
                    $new_create_claim->admin_id = $this->admin_id;
                    $new_create_claim->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                    $new_create_claim->claim_id = $new_claim_id;
                    $new_create_claim->batch_id = $new_batch_id;
                    $new_create_claim->appointment_id = $claim_tran->appointment_id;
                    $new_create_claim->client_id = $claim_tran->client_id;
                    $new_create_claim->provider_id = $claim_tran->provider_id;
                    $new_create_claim->activity_id = $claim_tran->activity_id;
                    $new_create_claim->payor_id = $claim_tran->payor_id;
                    $new_create_claim->authorization_id = $claim_tran->authorization_id;
                    $new_create_claim->activity_type = $claim_tran->activity_type;
                    $new_create_claim->schedule_date = $claim_tran->schedule_date;
                    $new_create_claim->cpt = $claim_tran->cpt;
                    $new_create_claim->m1 = $claim_tran->m1;
                    $new_create_claim->m2 = $claim_tran->m2;
                    $new_create_claim->m3 = $claim_tran->m3;
                    $new_create_claim->m4 = $claim_tran->m4;
                    $new_create_claim->pos = $claim_tran->pos;
                    $new_create_claim->units = $claim_tran->units;
                    $new_create_claim->rate = $claim_tran->rate;
                    $new_create_claim->cms_24j = $claim_tran->cms_24j;
                    $new_create_claim->id_qualifier = $claim_tran->id_qualifier;
                    $new_create_claim->status = $claim_tran->status;
                    $new_create_claim->degree_level = $claim_tran->degree_level;
                    $new_create_claim->zone = $claim_tran->zone;
                    $new_create_claim->location = $claim_tran->location;
                    $new_create_claim->units_value_calc = $claim_tran->units_value_calc;
                    $new_create_claim->billed_am = $claim_tran->billed_am;
                    $new_create_claim->billed_date = $claim_tran->billed_date;
                    $new_create_claim->is_mark_gen = $claim_tran->is_mark_gen;
                    $new_create_claim->resubmit_date = $claim_tran->resubmit_date;
                    $new_create_claim->box_19 = $claim_tran->box_19;
                    $new_create_claim->resubmit_code = $claim_tran->resubmit_code;
                    $new_create_claim->orginal_ref_number = $claim_tran->orginal_ref_number;
                    $new_create_claim->save();
                }

                $new_claim_transaction = new manage_claim_transaction();
                $new_claim_transaction->admin_id = $this->admin_id;
                $new_claim_transaction->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_claim_transaction->baching_id = $claim_tran->baching_id;
                $new_claim_transaction->claim_id = $new_claim_id;
                $new_claim_transaction->batch_id = $new_batch_id;
                $new_claim_transaction->appointment_id = $claim_tran->appointment_id;
                $new_claim_transaction->client_id = $claim_tran->client_id;
                $new_claim_transaction->provider_id = $claim_tran->provider_id;
                $new_claim_transaction->authorization_id = $claim_tran->authorization_id;
                $new_claim_transaction->activity_id = $claim_tran->activity_id;
                $new_claim_transaction->payor_id = $claim_tran->payor_id;
                $new_claim_transaction->activity_type = $claim_tran->activity_type;
                $new_claim_transaction->schedule_date = $claim_tran->schedule_date;
                $new_claim_transaction->cpt = $claim_tran->cpt;
                $new_claim_transaction->m1 = $claim_tran->m1;
                $new_claim_transaction->m2 = $claim_tran->m2;
                $new_claim_transaction->m3 = $claim_tran->m3;
                $new_claim_transaction->m4 = $claim_tran->m4;
                $new_claim_transaction->pos = $claim_tran->pos;
                $new_claim_transaction->units = $claim_tran->units;
                $new_claim_transaction->rate = $claim_tran->rate;
                $new_claim_transaction->cms_24j = $claim_tran->cms_24j;
                $new_claim_transaction->id_qualifier = $claim_tran->id_qualifier;
                $new_claim_transaction->status = $claim_tran->status;
                $new_claim_transaction->degree_level = $claim_tran->degree_level;
                $new_claim_transaction->zone = $claim_tran->zone;
                $new_claim_transaction->location = $claim_tran->location;
                $new_claim_transaction->units_value_calc = $claim_tran->units_value_calc;
                $new_claim_transaction->billed_am = $claim_tran->billed_am;
                $new_claim_transaction->billed_date = $claim_tran->billed_date;
                $new_claim_transaction->save();

                $claim_tran->delete();
            }
        }


        return 'done';
    }


    public function billing_claim_transaction_search(Request $request)
    {
        $claim_id = $request->claim_id;
        $search = $request->search;
        $admin_id = $this->admin_id;
        $up_admin_id = Auth::user()->up_admin_id;
        if (isset($search)) {
            if ($search == "" || $search == null) {
                $query = "SELECT * FROM manage_claim_transactions WHERE admin_id=$admin_id ";
                $type_filter = implode("','", $claim_id);
                $query .= "AND claim_id IN('" . $type_filter . "')   ";
                $query_exe = DB::select($query);

                return response()->json([
                    'notices' => $query_exe,
                    'view' => View::make('superadmin.claimManagement.include.claim_table_transaction', compact('query_exe'))->render(),
                ]);
            } else {
                $query = "SELECT * FROM manage_claim_transactions WHERE admin_id=$admin_id ";

                $type_filter = implode("','", $claim_id);
                $query .= "AND claim_id IN('" . $type_filter . "') ";
                $query .= "AND claim_id LIKE '%$search%' ";
                $query_exe = DB::select($query);

                return response()->json([
                    'notices' => $query_exe,
                    'view' => View::make('superadmin.claimManagement.include.claim_table_transaction', compact('query_exe'))->render(),
                ]);
            }
        }
    }


    public function claim_generate_sec_claim(Request $request)
    {
        $claim_ids = $request->claim_id;

        $user_claims = manage_claim::where('admin_id', $this->admin_id)->whereIn('claim_id', $claim_ids)->get();


        if (count($user_claims) > 0) {

            $payor_ids = [];

            foreach ($user_claims as $uclaim) {
                array_push($payor_ids, $uclaim->payor_id);
            }

            $get_client_auth = Client_authorization::where('admin_id', $this->admin_id)->where('is_primary', 2)->first();

            if ($get_client_auth) {


                $get_depost_data = deposit_apply::where('admin_id', $this->admin_id)
                    ->whereIn('payor_id', $payor_ids)
                    ->where('status', "Secondary Responsibility")
                    ->where('has_seceondary', '!=', 0)
                    ->where('has_claim_id', 0)
                    ->get();

                $batch_no_first = manage_claim::select('claim_id', 'batch_id', 'admin_id')->where('admin_id', $this->admin_id)->orderBy('id', 'desc')->first();


                if ($batch_no_first) {
                    $batch_id = $batch_no_first->batch_id + 1;
                    $clam_no = $batch_no_first->claim_id + 1;
                } else {
                    $batch_id = 1000;
                    $clam_no = 1000;
                }


                $new_clm = new manage_claim();
                $new_clm->admin_id = $this->admin_id;
                $new_clm->claim_id = $clam_no;
                $new_clm->resubmit_date = Carbon::now()->format('Y-m-d');
                $new_clm->save();


                foreach ($get_depost_data as $bt_claim) {


                    $batch_no = manage_claim::select('claim_id', 'batch_id', 'admin_id')
                        ->where('admin_id', $this->admin_id)
                        ->orderBy('id', 'desc')->first();

                    if ($batch_no) {
                        $claim_id = $batch_no->claim_id;
                        $set_batch_number = $batch_no->batch_id;
                    } else {
                        $claim_id = 1000;
                        $set_batch_number = 1000;
                    }


                    $count_batch_data = manage_claim_transaction::where('claim_id', $claim_id)
                        ->where('admin_id', $this->admin_id)
                        ->count();

                    if ($count_batch_data == 6) {
                        $inset_claim_num = $claim_id + 1;
                        $new_clma = new manage_claim();
                        $new_clma->admin_id = $this->admin_id;
                        $new_clma->claim_id = $inset_claim_num;
                        $new_clma->batch_id = $batch_id; //$set_batch_number
                        $new_clma->appointment_id = $bt_claim->appointment_id;
                        $new_clma->client_id = $bt_claim->client_id;

                        $new_clma->provider_id = $bt_claim->provider_id;

                        $new_clma->authorization_id = $bt_claim->authorization_id;
                        $new_clma->activity_id = $bt_claim->activity_id;
                        $new_clma->payor_id = $bt_claim->payor_id;
                        $new_clma->activity_type = $bt_claim->activity_type;
                        $new_clma->schedule_date = $bt_claim->dos;
                        $new_clma->cpt = $bt_claim->cpt;
                        $new_clma->m1 = $bt_claim->m1;
                        $new_clma->m2 = $bt_claim->m2;
                        $new_clma->m3 = $bt_claim->m3;
                        $new_clma->m4 = $bt_claim->m4;
                        $new_clma->pos = $bt_claim->pos;
                        $new_clma->units = $bt_claim->units;
                        $new_clma->rate = $bt_claim->rate;
                        $new_clma->cms_24j = $bt_claim->provider_24j;
                        $new_clma->id_qualifier = $bt_claim->id_qualifier;
                        $new_clma->status = $bt_claim->status;
                        $new_clma->degree_level = $bt_claim->degree_level;
                        $new_clma->zone = $bt_claim->zone;
                        $new_clma->location = $bt_claim->location;
                        $new_clma->units_value_calc = $bt_claim->units_value_calc;
                        $new_clma->billed_am = $bt_claim->billed_am;
                        $new_clma->billed_date = $bt_claim->billed_date;
                        $new_clma->resubmit_date = Carbon::now()->format('Y-m-d');
                        $new_clma->save();
                    } else {
                        $inset_claim_num = $claim_id;
                    }


                    $update_clm = manage_claim::where('id', $new_clm->id)->first();
                    if ($update_clm->batch_id == null) {
                        $update_clm->claim_id = $inset_claim_num;
                        $update_clm->batch_id = $batch_id;
                        $update_clm->appointment_id = $bt_claim->appointment_id;
                        $update_clm->client_id = $bt_claim->client_id;
                        $update_clm->provider_id = $bt_claim->provider_id;
                        $update_clm->authorization_id = $bt_claim->authorization_id;
                        $update_clm->activity_id = $bt_claim->activity_id;
                        $update_clm->payor_id = $bt_claim->payor_id;
                        $update_clm->activity_type = $bt_claim->activity_type;
                        $update_clm->schedule_date = $bt_claim->schedule_date;
                        $update_clm->cpt = $bt_claim->cpt;
                        $update_clm->m1 = $bt_claim->m1;
                        $update_clm->m2 = $bt_claim->m2;
                        $update_clm->m3 = $bt_claim->m3;
                        $update_clm->m4 = $bt_claim->m4;
                        $update_clm->pos = $bt_claim->pos;
                        $update_clm->units = $bt_claim->units;
                        $update_clm->rate = $bt_claim->rate;
                        $update_clm->cms_24j = $bt_claim->cms_24j;
                        $update_clm->id_qualifier = $bt_claim->id_qualifier;
                        $update_clm->status = $bt_claim->status;
                        $update_clm->degree_level = $bt_claim->degree_level;
                        $update_clm->zone = $bt_claim->zone;
                        $update_clm->location = $bt_claim->location;
                        $update_clm->units_value_calc = $bt_claim->units_value_calc;
                        $update_clm->billed_am = $bt_claim->billed_am;
                        $update_clm->billed_date = $bt_claim->billed_date;
                        $update_clm->save();
                    }

                    $b_claim_update = deposit_apply::where('id', $bt_claim->id)
                        ->where('admin_id', $this->admin_id)
                        ->first();
                    $b_claim_update->has_claim_id = 1;
                    $b_claim_update->save();

                    $new_manage_claim = new manage_claim_transaction();
                    $new_manage_claim->admin_id = $this->admin_id;
                    $new_manage_claim->baching_id = $bt_claim->id;
                    $new_manage_claim->claim_id = $inset_claim_num;
                    $new_manage_claim->batch_id = $batch_id;
                    $new_manage_claim->appointment_id = $bt_claim->appointment_id;
                    $new_manage_claim->client_id = $bt_claim->client_id;
                    $new_manage_claim->provider_id = $bt_claim->provider_id;
                    $new_manage_claim->authorization_id = $bt_claim->authorization_id;
                    $new_manage_claim->activity_id = $bt_claim->activity_id;
                    $new_manage_claim->payor_id = $bt_claim->payor_id;
                    $new_manage_claim->activity_type = $bt_claim->activity_type;
                    $new_manage_claim->schedule_date = $bt_claim->schedule_date;
                    $new_manage_claim->cpt = $bt_claim->cpt;
                    $new_manage_claim->m1 = $bt_claim->m1;
                    $new_manage_claim->m2 = $bt_claim->m2;
                    $new_manage_claim->m3 = $bt_claim->m3;
                    $new_manage_claim->m4 = $bt_claim->m4;
                    $new_manage_claim->pos = $bt_claim->pos;
                    $new_manage_claim->units = $bt_claim->units;
                    $new_manage_claim->rate = $bt_claim->rate;
                    $new_manage_claim->cms_24j = $bt_claim->cms_24j;
                    $new_manage_claim->id_qualifier = $bt_claim->id_qualifier;
                    $new_manage_claim->status = $bt_claim->status;
                    $new_manage_claim->degree_level = $bt_claim->degree_level;
                    $new_manage_claim->zone = $bt_claim->zone;
                    $new_manage_claim->location = $bt_claim->location;
                    $new_manage_claim->units_value_calc = $bt_claim->units_value_calc;
                    $new_manage_claim->billed_am = $bt_claim->billed_am;
                    $new_manage_claim->billed_date = $bt_claim->billed_date;
                    $new_manage_claim->save();
                }
            } else {
                return response()->json('nosecauth', 200);
            }
        } else {
            return response()->json('empty', 200);
        }
    }


    public function billing_claim_management_generate_csv(Request $request)
    {

    }


    public function billing_claim_management_generate_csv_download($file)
    {
        $txt_download = public_path('claimcsv/') . $file;
        return response()->download($txt_download);
    }
}
