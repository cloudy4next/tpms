<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;

use App\Http\Edi\ChargeData;
use App\Http\Edi\ClaimData;
use App\Http\Edi\ClaimHeader;
use App\Http\Edi\SecClaimGenerator;
use App\Models\All_payor_detail;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_info;
use App\Models\deposit_apply;
use App\Models\Employee;
use App\Models\Employee_details_tx_type;
use App\Models\manage_claim;
use App\Models\manage_claim_boxone;
use App\Models\manage_claim_boxtwo;
use App\Models\manage_claim_transaction;
use App\Models\Payor_facility;
use App\Models\Rendering_provider;
use App\Models\report_notification;
use App\Models\setting_name_location;
use App\Models\setting_name_location_box_two;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class SuperAdminSecClaimController extends Controller
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


    public function pending_secondary()
    {
        return view('superadmin.secondaryClaim.secondaryClaimList');
    }

    public function pending_secondary_get(Request $request)
    {
        $dep_data = deposit_apply::distinct()->select('admin_id', 'status', 'status_apply', 'appointment_id')
            ->where('admin_id', $this->admin_id)
            ->where('status', 'Secondary Responsibility')
            ->where('status_apply', 1)
            ->where('sec_submited', 1)
            ->get();


        $array = [];
        foreach ($dep_data as $depdata) {
            array_push($array, $depdata->appointment_id);
        }

        $sec_claims = manage_claim_transaction::distinct()->select('admin_id', 'appointment_id', 'claim_id')
            ->whereIn('appointment_id', $array)
            ->where('admin_id', $this->admin_id)
            ->where('is_primary')
            ->get();
        $name_location = setting_name_location::select('admin_id', 'is_combo')->where('admin_id', $this->admin_id)->first();

        return response()->json([
            'notices' => $sec_claims,
            'view' => View::make('superadmin.secondaryClaim.include.secIncTable', compact('sec_claims', 'name_location'))->render(),
        ]);


    }


    public function pending_secondary_show_details(Request $request)
    {
        $claim_id = $request->array;
        $claim_filter = implode("','", $claim_id);
        $admin_id = $this->admin_id;
        $query = "SELECT * FROM manage_claim_transactions WHERE claim_id IN('" . $claim_filter . "') AND admin_id=$admin_id ";
        $name_location = setting_name_location::select('admin_id', 'is_combo')->where('admin_id', $admin_id)->first();

        $query .= "ORDER BY claim_id,schedule_date ASC";
        $query_exe = DB::select($query);

        return response()->json([
            'notices' => $query_exe,
            'view' => View::make('superadmin.secondaryClaim.include.secclaim_table_transaction', compact('query_exe', 'name_location'))->render(),
        ]);
    }


    public function pending_secondary_generate(Request $request)
    {
        $claim_ids = $request->array;
        $all_claims = manage_claim_transaction::distinct()->select('claim_id', 'admin_id')->whereIn('claim_id', $claim_ids)
            ->where('admin_id', $this->admin_id)
            ->orderBy('claim_id', 'desc')
            ->get();


        //get last batch id
        $batch_no_first = manage_claim::select('claim_id', 'batch_id', 'admin_id')
            ->where('admin_id', $this->admin_id)
            ->orderBy('claim_id', 'desc')
            ->first();


        if ($batch_no_first) {
            $batch_id = $batch_no_first->batch_id + 1;
        } else {
            $batch_id = 1000;
        }


        $claim_array = [];


        foreach ($all_claims as $bt_claim) {


            $last_claim_id = manage_claim::select('claim_id', 'batch_id', 'admin_id', 'client_id')
                ->where('admin_id', $this->admin_id)
                ->orderBy('claim_id', 'desc')
                ->first();


            if ($last_claim_id) {
                $lt_claim_id = $last_claim_id->claim_id + 1;
            } else {
                $lt_claim_id = 1000;
            }

            $all_claims_get = manage_claim_transaction::where('claim_id', $bt_claim->claim_id)->where('admin_id', $this->admin_id)->get();


            foreach ($all_claims_get as $get_claim) {
                $get_batch_data = manage_claim::select('client_id', 'claim_id', 'batch_id', 'admin_id', 'authorization_id')
                    ->where('admin_id', $get_claim->admin_id)
                    ->where('client_id', $get_claim->client_id)
                    ->where('authorization_id', $get_claim->authorization_id)
                    ->where('claim_id', $lt_claim_id)
                    ->where('batch_id', $batch_id)
                    ->count();


                $auth_no = Client_authorization::select('id', 'authorization_number')->where('id', $get_claim->authorization_id)->first();
                if ($get_batch_data == 0) {
                    $update_clm = new manage_claim();
                    $update_clm->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
                    $update_clm->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                    $update_clm->claim_id = $lt_claim_id;
                    $update_clm->batch_id = $batch_id;
                    $update_clm->appointment_id = $get_claim->appointment_id;
                    $update_clm->client_id = $get_claim->client_id;
                    $update_clm->provider_id = $get_claim->provider_id;
                    $update_clm->authorization_id = $get_claim->authorization_id;
                    $update_clm->activity_id = $get_claim->activity_id;
                    $update_clm->payor_id = $get_claim->payor_id;
                    $update_clm->activity_type = $get_claim->activity_type;
                    $update_clm->schedule_date = $get_claim->schedule_date;
                    $update_clm->cpt = $get_claim->cpt;
                    $update_clm->m1 = $get_claim->m1;
                    $update_clm->m2 = $get_claim->m2;
                    $update_clm->m3 = $get_claim->m3;
                    $update_clm->m4 = $get_claim->m4;
                    $update_clm->pos = $get_claim->pos;
                    $update_clm->units = $get_claim->units;
                    $update_clm->rate = $get_claim->rate;
                    $update_clm->cms_24j = $get_claim->cms_24j;
                    $update_clm->id_qualifier = $get_claim->id_qualifier;
                    $update_clm->status = $get_claim->status;
                    $update_clm->degree_level = $get_claim->degree_level;
                    $update_clm->zone = $get_claim->zone;
                    $update_clm->location = $get_claim->location;
                    $update_clm->units_value_calc = $get_claim->units_value_calc;
                    $update_clm->billed_am = $get_claim->billed_am;
                    $update_clm->billed_date = $get_claim->billed_date;
                    $update_clm->auth_no = isset($auth_no) ? $auth_no->authorization_number : '';
                    $update_clm->is_primary = 2;
                    $update_clm->save();

                    $set_box33 = manage_claim_boxone::where('admin_id', $this->admin_id)->where('claim_id', $lt_claim_id)->where('batch_id', $batch_id)->first();

                    if ($set_box33) {

                        $new_box33 = new manage_claim_boxone();
                        $new_box33->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
                        $new_box33->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                        $new_box33->claim_id = $lt_claim_id;
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

                    $client_zone = Client::where('admin_id', $this->admin_id)->where('id', $new_box33->client_id)->first();
                    $check_man_box32 = manage_claim_boxtwo::where('admin_id', $this->admin_id)->where('claim_id', $lt_claim_id)->where('batch_id', $batch_id)->first();


                    if ($check_man_box32) {
                        $new_box32 = new manage_claim_boxtwo();
                        $new_box32->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
                        $new_box32->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                        $new_box32->claim_id = $lt_claim_id;
                        $new_box32->batch_id = $batch_id;
                        $new_box32->client_id = $new_box33->client_id;
                        $new_box32->facility_name_two = $check_man_box32->facility_name_two;
                        $new_box32->zone_name = $check_man_box32->zone_name;
                        $new_box32->address = $check_man_box32->address;
                        $new_box32->city = $check_man_box32->city;
                        $new_box32->state = $check_man_box32->state;
                        $new_box32->zip = $check_man_box32->zip;
                        $new_box32->phone_one = $check_man_box32->phone_one;
                        $new_box32->save();
                    }


                    array_push($claim_array, $lt_claim_id);
                }


                $new_manage_claim = new manage_claim_transaction();
                $new_manage_claim->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
                $new_manage_claim->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
                $new_manage_claim->baching_id = $get_claim->id;
                $new_manage_claim->claim_id = $lt_claim_id; //$inset_claim_num
                $new_manage_claim->batch_id = $batch_id;
                $new_manage_claim->appointment_id = $get_claim->appointment_id;
                $new_manage_claim->client_id = $get_claim->client_id;
                $new_manage_claim->provider_id = $get_claim->provider_id;
                $new_manage_claim->authorization_id = $get_claim->authorization_id;
                $new_manage_claim->activity_id = $get_claim->activity_id;
                $new_manage_claim->payor_id = $get_claim->payor_id;
                $new_manage_claim->activity_type = $get_claim->activity_type;
                $new_manage_claim->schedule_date = $get_claim->schedule_date;
                $new_manage_claim->from_time = $get_claim->from_time;
                $new_manage_claim->to_time = $get_claim->to_time;
                $new_manage_claim->cpt = $get_claim->cpt;
                $new_manage_claim->m1 = $get_claim->m1;
                $new_manage_claim->m2 = $get_claim->m2;
                $new_manage_claim->m3 = $get_claim->m3;
                $new_manage_claim->m4 = $get_claim->m4;
                $new_manage_claim->pos = $get_claim->pos;
                $new_manage_claim->units = $get_claim->units;
                $new_manage_claim->rate = $get_claim->rate;
                $new_manage_claim->cms_24j = $get_claim->cms_24j;
                $new_manage_claim->id_qualifier = $get_claim->id_qualifier;
                $new_manage_claim->status = $get_claim->status;
                $new_manage_claim->degree_level = $get_claim->degree_level;
                $new_manage_claim->zone = $get_claim->zone;
                $new_manage_claim->location = $get_claim->location;
                $new_manage_claim->units_value_calc = $get_claim->units_value_calc;
                $new_manage_claim->billed_am = $get_claim->billed_am;
                $new_manage_claim->billed_date = $get_claim->billed_date;
                $new_manage_claim->resubmit_date = null;
                $new_manage_claim->auth_no = isset($auth_no) ? $auth_no->authorization_number : '';
                $new_manage_claim->is_primary = 2;
                $new_manage_claim->save();


                $dep_data = deposit_apply::select('admin_id', 'status', 'status_apply', 'appointment_id', 'sec_submited')
                    ->where('admin_id', $this->admin_id)
                    ->where('appointment_id', $new_manage_claim->appointment_id)
                    ->where('status', 'Secondary Responsibility')
                    ->where('status_apply', 1)
                    ->where('sec_submited', 1)
                    ->update(['sec_submited' => 2]);

            }


        }


        $generate_ed = $this->generate_edit_file($claim_array);

        return response()->json([
            'status' => 'new_claim_gen_done',
            'status' => 'new_claim_gen_done',
        ], 200);

    }


    protected function generate_edit_file($claims)
    {


        $all_claims = manage_claim_transaction::where('admin_id', $this->admin_id)
            ->whereIn('claim_id', $claims)
            ->get();


//Creating the EDI 837 Generation object

        $generate = new SecClaimGenerator();
        $header = new ClaimHeader();
        $listOfClaims = array();

// Hard-coded Values
        $header->ISA01AuthQual = '00';
        $header->ISA02AuthInfo = '';
        $header->ISA03SecQual = '00';
        $header->ISA04SecInfo = '';
        $header->ISA05SenderQual = 'ZZ';
// Sender ID - THiS ID IS PROVIDED BY ZIRMED
        $header->ISA06SenderID = '101410';
        $header->ISA07ReceiverQual = 'ZZ';
// RECEIVER ID - THiS ID IS PROVIDED BY ZIMRED
        $header->ISA08ReceiverID = 'ZIRMED';

// 9 Digit Unique Control Number For Every Batch
// Use any sequencer starting with 111111111 and incriment every time.
        $header->ISA13CntrlNumber = '111111111';

// File Indicator
// T for Test, P for Production
        $header->ISA15UsageIndi = 'T';

// Sender\Receiver IDs - ASSIGNED BY ZIMRED
        $header->GS02SenderID = '101410';
        $header->GS03ReceiverID = 'ZIRMED';

// PUT THE SUBMITTER\BILLING COMPANY HERE
        $header->SubmitterOrgName = 'TEST HOME HEALTH';
        $header->SubmitterID = '101410';        // ASIGNED BY ZIMRED

        $header->SubmitterContactName = 'IT SUPERVISOR';
        $header->SubmitterTelephone = '8470008291';
        $header->SubmitterEmail = '';
//
        $header->ReceiverOrgName = 'ZIRMED';
        $header->ReceiverID = 'ZIRMED';

// USE IT AS FALSE.
        $header->RelaxNpiValidation = true;        // Set this true, because in your case NPI is not used.

// Claim 1 Data -   Subscriber and Patient is SAME
// Secondary Claim
        foreach ($all_claims as $single_claim) {

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
            $claim->BillPrvSecondaryID = '401030600902';        // copied from your edi file

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
            }                   // not used here in your case

// Billing Provider Pay to Address (Where Checks will be droppd)		// empty in your case
            $claim->BillPrvPayToAddr = '';
            $claim->BillPrvPayToCity = '';
            $claim->BillPrvPayToState = '';
            $claim->BillPrvPayToZip = '';


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
            $claim->PayerType = 'CI';

// Claim Type
// For Secondary Claim = 'S'
// For Primary Claim = 'P'
            $claim->ClaimType = 'S';
            $claim->SbrGroupNumber = '';

            $client = Client::select('id', 'admin_id', 'client_first_name', 'client_middle', 'client_last_name', 'client_street', 'client_city', 'client_state', 'client_zip', 'client_dob', 'client_gender', 'zone')
                ->where('admin_id', $this->admin_id)
                ->where('id', $single_claim->client_id)
                ->first();
            $client_info = Client_info::select('id', 'admin_id', 'relationship', 'client_reffered_by')
                ->where('admin_id', $this->admin_id)
                ->where('client_id', $client->id)
                ->first();
            $client_dob_yer = Carbon::parse($client->client_dob)->isoFormat('YYYYMMDD');

// If claim is Secondary, then here Secondary Subscriber/Insured Name should be set
// Subscriber\Insured Name, Insrued ID, Address, Gender, DOB
            $claim->SBRLastName = $client->client_last_name;
            $claim->SBRFirstName = $client->client_first_name;
            $claim->SBRID = $client_auth->uci_id;
            $claim->SBRAddress = $client->client_street;
            $claim->SBRCity = $client->client_city;
            $claim->SBRState = $client->client_state;
            $claim->SBRZipCode = $client->client_zip;
            $claim->SBRDob = Carbon::parse($client->client_dob)->isoFormat('YYYYMMDD');
            $claim->SBRGender = $client->client_gender == "Male" ? 'M' : 'F';;      // M for Male, F for Female, U for Unknown

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

// IF PATIENT RELATION SHIP IS SELF (18), NO NEED TO SET PATIENT FEILDS
            if ($client_info->relationship == 'Self') {
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
// If claim is Secondary, then here Secondary Payer Name should be set
            if ($payor_name) {
                $claim->PayerName = $payor_name->payor_name;
            } else {
                $claim->PayerName = "";
            }
            if ($payor_details) {
                $claim->PayerID = $payor_details->ele_payor_id;
            } else {
                $claim->PayerID = '';
            }    // Payer ID - Will be selected from Office Allay Payer List


// Patient Account Number
            $pt_cntr_num = isset($admin_fac_settin) ? $admin_fac_settin->short_code . '' . $single_claim->claim_id : $single_claim->claim_id;
            $claim->PatientControlNumber = $pt_cntr_num;        // unique claim number
            $claim->MedicalRecordNumber = $single_claim->claim_id;    // medical record number

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
            }    // this is used in your case.

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


// primary Subscriber Relation Ship With Patient
// 18 for self
            $claim->OtherSBRPatRelationV = '';
// primary Subscriber Group Number
            $claim->OtherSBRGroupNumber = '';
// Other Subscriber Group Name
            $claim->OtherSBRGroupName = '';
// Other Payer Type
            $claim->OtherPayerTypeValue = '';

// Primary Paid Amount
            $claim->PrimaryPaidAmt = '30';


// Primary Subscriber Name, Address
            $claim->OtherSBRLastName = 'TENKE';
            $claim->OtherSBRFirstName = 'JOHN';
            $claim->OtherSBRMI = '';
            $claim->OtherSBRId = '890653812';
            $claim->OtherSBRAddress = '20 LEUCE PL';
            $claim->OtherSBRAddressLine2 = '';
            $claim->OtherSBRCity = 'GLEN COVE';
            $claim->OtherSBRState = 'NY';
            $claim->OtherSBRZipCode = '11542';

// Primary Payer Name
            $claim->OtherPayerName = 'SECONDARY PAYER NAME';
// Primary Payer ID
            $claim->OtherPayerID = '66208';
// Pimary Payer Address
            $claim->OtherPayerAddress = 'SEC PAYER';
            $claim->OtherPayerAddressLine2 = '';
            $claim->OtherPayerCity = 'CITY';
            $claim->OtherPayerState = 'NY';
            $claim->OtherPayerZipCode = '12345';


// For Secondary Visit: Set Payer Claim Control Number -> This would be received from 835
            $claim->PayerClaimCntrlNum = '423432424';


// Service Lines
            $charge1 = new ChargeData();
            $charge1->CptCode = '9989M';      // CPT
            $charge1->ChargeAmount = 100;    // Charge Amount
            $charge1->Units = '1';           // Units
            $charge1->Pointer1 = '1';         // Pointer 1
            $charge1->Pointer2 = '';         // Pointer 2
            $charge1->Pointer3 = '';         // Pointer 3
            $charge1->Pointer4 = '';         // Pointer 4
            $charge1->POS = '';             // POS - Don't set if, POS is same of All Charges and same with Claim POS
            $charge1->DateofServiceFrom = '20190706';      // Date of Service
            $charge1->DateOfServiceTo = '';
            $charge1->LineItemControlNum = '5853175';        // Charge Control Number - Unique Number - Era Payment will be mapped with this.
            $charge1->LIDescription = 'HOMEMAKER SERVICES';    // this is used in your case for few types of visits.


// Primary Paid Amount against the CPT
            $charge1->PrimaryPaidAmt = 30;
            // Primary CPT\HCPCS Code
            $charge1->PrimaryCPT = '9989M';
            // Primary Modifier 1
            $charge1->PrimaryMod1 = '';
            // Primary Modifier 2
            $charge1->PrimaryMod2 = '';
            // Primary Modifier 3
            $charge1->PrimaryMod3 = '';
            // Primary Modifier 4
            $charge1->PrimaryMod4 = '';
            // Primary Paid Units
            $charge1->PrimaryUnits = '1';
            // Primary WriteOff AMount
            $charge1->PrimaryWriteOffAmt = '20';
            // Primary Other WriteOff Amount
            // Primary Co Insurance
            $charge1->PrimaryCoIns = '';
            // Primary Deductible
            $charge1->PrimaryDeductable = '50';
            // Primary Adjudicated Quantity
            // Primary Paid Amount
            $charge1->PrimaryPaidDate = '20190806';

            // Adding Claim's Charges into List
            array_push($claim->ListOfChargesData, $charge1);

            // Adding Claims into Claims List
            array_push($listOfClaims, $claim);
        }


        $output = $generate->Generate837Transaction($header, $listOfClaims, '837.txt');

        echo "Processed Claims: " . $output->ProcessedClaims . "\n";

        // 	Based on the Output, you can maintain the SubmissionHistoryLog (batch wise) with following columns
        //	ID, Edi837FilePath, NumberOfClaims, Amount, Date etc.


        // Check For Not Processed Claims, that are put on hold due to required data missing.
        foreach ($output->ListOfClaims as $CLM) {
            // If Processed is True, that means this claim has been included in the claim string.
            // You can mark the claim Processed in your system, based on this variable.
            if ($CLM->Processed) {
                echo 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', Processed: ' . $CLM->Processed . ', Processed Date: ' . $CLM->ProcessedDate . "\n";
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

                if ($validationMsg != '')
                    echo 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', Validation Msg. ' . $CLM->ValidationMsg . "\n";
            }
        }


        echo "EDI Transaction:" . "\n";
        echo $output->Transaction837;
    }


}
