<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Edi\ChargeData;
use App\Http\Edi\ClaimData;
use App\Http\Edi\ClaimGenerator;
use App\Http\Edi\ClaimHeader;
use App\Models\All_payor;
use App\Models\All_payor_detail;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_info;
use App\Models\Employee;
use App\Models\Employee_details_tx_type;
use App\Models\manage_claim;
use App\Models\manage_claim_boxone;
use App\Models\manage_claim_boxtwo;
use App\Models\manage_claim_transaction;
use App\Models\Payor_facility;
use App\Models\Payor_facility_details;
use App\Models\Rendering_provider;
use App\Models\report_notification;
use App\Models\setting_name_location;
use App\Models\setting_name_location_box_two;
use App\Models\setting_service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SuperAdmiEdiController extends Controller
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

    public function edi_data(Request $request)
    {

        $all_claims = manage_claim::where('admin_id', $this->admin_id)
            ->where('batch_id', 1000)
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
        $header->SubmitterOrgName = 'ABCOR HOME HEALTH';
        $header->SubmitterID = '101410';        // ASIGNED BY ZIMRED

        $header->SubmitterContactName = 'IT SUPERVISOR';
        $header->SubmitterTelephone = '8476708268';
        $header->SubmitterEmail = '';
        //
        $header->ReceiverOrgName = 'ZIRMED';
        $header->ReceiverID = 'ZIRMED';

        // USE IT AS FALSE.
        $header->RelaxNpiValidation = true;        // Set this true, because in your case NPI is not used.

        // Claim 1 Data -   Subscriber and Patient is SAME
        foreach ($all_claims as $single_claim) {
            $setting_name = setting_name_location::first();
            $client_auth = Client_authorization::select('id', 'admin_id', 'authorization_number', 'uci_id', 'diagnosis_one', 'diagnosis_two', 'diagnosis_three', 'diagnosis_four')
                ->where('id', $single_claim->authorization_id)
//                ->where('admin_id', $this->admin_id)
                ->first();

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


            $claim = new ClaimData();
            // Billing Provider\Practice\Facility
            $claim->BillPrvOrgName = $setting_name->facility_name;
            $claim->BillPrvFirstName = '';
            $claim->BillPrvEntityType = '2';
            $claim->BillPrvNPI = $setting_name->npi;             // this will be empty in your case

            // Practice\Billing Provider Address
            $claim->BillPrvAddress1 = $setting_name->address;
            $claim->BillPrvCity = $setting_name->city;
            $claim->BillPrvState = $setting_name->state;
            $claim->BillPrvZipCode = $setting_name->zip;

            // Billing Provider Tax ID\EIN

            $claim->BillPrvTaxID = $setting_name->ein;

            // Billing Provider Secondary ID
            $claim->BillPrvSecondaryID = '203030621902';        // copied from your edi file

            // Billing Provider Taxonomy
            $claim->BillPrvTaxonomyCode = $setting_name->taxonomy_code;           // not used here in your case

            // Billing Provider Pay to Address (Where Checks will be droppd)        // empty in your case
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
            // P for Primary, S for Secondary
            $claim->ClaimType = 'P';
            $claim->SbrGroupNumber = '';

            // Subscriber\Insured Name, Insrued ID, Address, Gender, DOB

            $client = Client::select('id', 'client_first_name', 'client_middle', 'client_last_name', 'client_street', 'client_city', 'client_state', 'client_zip', 'client_dob', 'client_gender')->where('id', $single_claim->client_id)->first();
            $client_info = Client_info::select('id', 'relationship')->where('client_id', $client->id)->first();


            $claim->SBRLastName = $client->client_last_name;
            $claim->SBRFirstName = $client->client_first_name;
            $claim->SBRID = $client_auth->uci_id;
            $claim->SBRAddress = $client->client_street;
            $claim->SBRCity = $client->client_city;
            $claim->SBRState = $client->client_state;
            $claim->SBRZipCode = $client->client_zip;
            $claim->SBRDob = Carbon::parse($client->client_dob)->format('YYYYMMDD');
            $claim->SBRGender = $client->client_gender == "Male" ? 'M' : 'F';      // M for Male, F for Female, U for Unknown

            // Patient Relation Ship With Insured.
            // Self             -   18
            // Child            -   19
            // Spouse           -   01
            // Unknown/Other    -   21
            if ($client_info->relationship == 'self') {
                $claim->PatientRelationShip = 18;
            } elseif ($client_info->relationship == 'child') {
                $claim->PatientRelationShip = 19;
            } elseif ($client_info->relationship == 'Spouse') {
                $claim->PatientRelationShip = 01;
            } else {
                $claim->PatientRelationShip = 21;
            }

            if ($client_info->relationship == 'self') {
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
                $claim->PATAddress = $client->client_middle;
                $claim->PATCity = $client->client_street;
                $claim->PATState = $client->client_state;
                $claim->PATZipCode = $client->client_zip;
                $claim->PATDob = $client->client_dob;
                $claim->PATGender = $client->client_gender;
            }
            //

            // Insurace\Payer Name, Payer ID
            $payor_name = All_payor::select('id', 'payor_name')->where('id', $single_claim->payor_id)->first();
            $claim->PayerName = $payor_name->payor_name;
            $claim->PayerID = '26337';    // Payer ID - Will be selected from Office Allay Payer List


            // Patient Account Number
            $claim->PatientControlNumber = $single_claim->claim_id;        // unique claim number
            $claim->MedicalRecordNumber = $single_claim->claim_id;   // medical record number

            // Total Charge Amount
            $total_change_am = manage_claim_transaction::select('claim_id', 'billed_am')->where('claim_id', $single_claim->claim_id)->sum('billed_am');
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

            $claim->PriorAuthNumber = $client_auth->authorization_number;   // this is used in your case.


            // Rendering Provider
            $cms_24j = Employee::select('id', 'last_name', 'first_name', 'middle_name', 'individual_npi')->where('id', $single_claim->cms_24j)->first();
            $claim->RendPrvLastName = isset($cms_24j->last_name) ? $cms_24j->last_name : '';    // empty in your case
            $claim->RendPrvFirstName = isset($cms_24j->first_name) ? $cms_24j->first_name : '';
            $claim->RendPrvMI = isset($cms_24j->middle_name) ? $cms_24j->middle_name : '';
            $claim->RendPrvNPI = isset($cms_24j->individual_npi) ? $cms_24j->individual_npi : '';


            // Referring Provider           // empty in your case
            $claim->RefPrvLastName = '';
            $claim->RefPrvFirstName = '';
            $claim->RefPrvMI = '';
            $claim->RefPrvNPI = '';

            // Supervising Provider         // empty in your case
            $claim->SuperPrvLastName = '';
            $claim->SuperPrvFirstName = '';
            $claim->SuperPrvMI = '';
            $claim->SuperPrvNPI = '';

            // Location
            $claim->LocationOrgName = '';    // empty in your case
            $claim->LocationNPI = '';
            $claim->LocationAddress = '';
            $claim->LocationCity = '';
            $claim->LocationState = '';
            $claim->LocationZip = '';


            // Service Lines
            $charge1 = new ChargeData();
            $charge1->CptCode = '9989M';      // CPT
            $charge1->ChargeAmount = 39.15;    // Charge Amount
            $charge1->Units = '45';           // Units
            $charge1->Pointer1 = '1';         // Pointer 1
            $charge1->Pointer2 = '';         // Pointer 2
            $charge1->Pointer3 = '';         // Pointer 3
            $charge1->Pointer4 = '';         // Pointer 4
            $charge1->POS = '';             // POS - Don't set if, POS is same of All Charges and same with Claim POS
            $charge1->DateofServiceFrom = '20190706';      // Date of Service
            $charge1->DateOfServiceTo = '';
            $charge1->LineItemControlNum = '5853175';        // Charge Control Number - Unique Number - Era Payment will be mapped with this.
            $charge1->LIDescription = 'HOMEMAKER SERVICES';    // this is used in your case for few types of visits.


            // Adding Claim's Charges into List
            array_push($claim->ListOfChargesData, $charge1);


            // Adding Claims into Claims List
            array_push($listOfClaims, $claim);

            $manage_claim_transactions = manage_claim_transaction::where('claim_id', $single_claim->claim_id)->get();
            foreach ($manage_claim_transactions as $single_claim_transaction) {
                $claim_single_auth = Client_authorization::select('id', 'diagnosis_one', 'diagnosis_two', 'diagnosis_three', 'diagnosis_four')->where('id', $single_claim_transaction->authorization_id)->first();
                $cpt_desc = setting_service::where('id', 'service', 'description')->where('service', $single_claim_transaction->cpt)->first();
                $charge1 = new \App\Http\Edi\ChargeData();
                $charge1->CptCode = $single_claim_transaction->cpt;      // CPT
                $charge1->ChargeAmount = $single_claim_transaction->billed_am;    // Charge Amount
                $charge1->Units = $single_claim_transaction->units;           // Units
                $charge1->Pointer1 = $claim_single_auth->diagnosis_one == null ? '' : '1';         // Pointer 1
                $charge1->Pointer2 = $claim_single_auth->diagnosis_two == null ? '' : '2';         // Pointer 2
                $charge1->Pointer3 = $claim_single_auth->diagnosis_three == null ? '' : '3';         // Pointer 3
                $charge1->Pointer4 = $claim_single_auth->diagnosis_four == null ? '' : '4';
                $charge1->DateofServiceFrom = $single_claim_transaction->schedule_date;
                $charge1->LineItemControlNum = 'ABC' . $single_claim_transaction->id;
            }


            // Adding Claim's Charges into List
            array_push($claim->ListOfChargesData, $charge1);


            // Adding Claims into Claims List
            array_push($listOfClaims, $claim);
        }

        //List<ClaimData> claims = new List<ClaimData>() { claim, claim2 };
        //List<ClaimData> claims = new List<ClaimData>() { claim};
        $file_path = public_path("edi/" . time() . "txt");
        $output = $generate->Generate837Transaction($header, $listOfClaims, $file_path);

        echo "Processed Claims: " . $output->ProcessedClaims . '</br>';

        //  Based on the Output, you can maintain the SubmissionHistoryLog (batch wise) with following columns
        //  ID, Edi837FilePath, NumberOfClaims, Amount, Date etc.


        // Check For Not Processed Claims, that are put on hold due to required data missing.
        foreach ($output->ListOfClaims as $CLM) {
            // If Processed is True, that means this claim has been included in the claim string.
            // You can mark the claim Processed in your system, based on this variable.
            if ($CLM->Processed) {
                echo 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', Processed: ' . $CLM->Processed . ', Processed Date: ' . $CLM->ProcessedDate . '</br>';
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
                    echo 'Provider Claim Number: ' . $CLM->PatientControlNumber . ', Validation Msg. ' . $CLM->ValidationMsg . '</br>';
            }
        }
    }


    public function claim_edi_by_id($id)
    {

        $all_claims = manage_claim::where('admin_id', $this->admin_id)
            ->where('claim_id', $id)
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
//            $setting_name = setting_name_location::where('admin_id', $this->admin_id)->first();

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

            $payor_name = All_payor_detail::select('id', 'admin_id', 'payor_id', 'payor_name', 'facility_payor_id', 'ssn', 'cms_1500_32b', 'cms_1500_33b', 'cms_1500_32a', 'cms_1500_33a', 'day_pay_cpt')
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


            // this will be empty in your case

            $check_inv_npi = Employee::where('id', $single_claim->cms_24j)
                ->first();


            if ($check_inv_npi) {
                if ($check_inv_npi->individual_npi != null || $check_inv_npi->individual_npi != '') {
                    $claim->BillPrvNPI = $check_inv_npi->individual_npi;
                } else {
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
                }
            } elseif ($payor_name) {
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
                    $claim->BillPrvZipCode = isset($admin_fac_settin) ? $admin_fac_settin->zip : "";
                }
            } else {
                $claim->BillPrvAddress1 = isset($admin_fac_settin) ? $admin_fac_settin->address : '';
                $claim->BillPrvCity = isset($admin_fac_settin) ? $admin_fac_settin->city : '';
                $claim->BillPrvState = isset($admin_fac_settin) ? $admin_fac_settin->state : '';
                $claim->BillPrvZipCode = isset($admin_fac_settin) ? $admin_fac_settin->zip : "";
            }


            // Billing Provider Tax ID\EIN

            $claim->BillPrvTaxID = isset($admin_fac_settin) ? $admin_fac_settin->ein : '';

            // Billing Provider Secondary ID
            $claim->BillPrvSecondaryID = '';        // copied from your edi file

            // Billing Provider Taxonomy


            if ($payor_name) {
                if ($payor_name->cms_1500_32b != null && $payor_name->cms_1500_33b != null) {
//                    $claim->BillPrvTaxonomyCode = $payor_name->cms_1500_32b . ' ' . $payor_name->cms_1500_33b;
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
            }
            // not used here in your case

            // Billing Provider Pay to Address (Where Checks will be droppd)        // empty in your case
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
                $claim->PayerName = '';
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
                    $claim->PriorAuthNumber = $single_claim->auth_no;
                } else {
                    $claim->PriorAuthNumber = '';
                }

            } else {
                $claim->PriorAuthNumber = $client_auth->authorization_number;
            }
            // this is used in your case.

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


            // Referring Provider           // empty in your case
            $ref_provider = Rendering_provider::where('id', $client_info->client_reffered_by)
                ->where('admin_id', $this->admin_id)
                ->first();

            $claim->RefPrvLastName = isset($ref_provider) ? $ref_provider->provider_name : '';
            $claim->RefPrvFirstName = isset($ref_provider) ? $ref_provider->provider_last_name : '';
            $claim->RefPrvMI = '';
            $claim->RefPrvNPI = isset($ref_provider) ? $ref_provider->npi : '';

            // Supervising Provider         // empty in your case
            $claim->SuperPrvLastName = '';
            $claim->SuperPrvFirstName = '';
            $claim->SuperPrvMI = '';
            $claim->SuperPrvNPI = '';

            // Location
//            $box_32_data = setting_name_location_box_two::where('admin_id', $this->admin_id)->first();

            $box_32_data = manage_claim_boxtwo::where('admin_id', $this->admin_id)
                ->where('claim_id', $single_claim->claim_id)
                ->where('batch_id', $single_claim->batch_id)
                ->where('client_id', $single_claim->client_id)
                ->first();

            $box_32_client = setting_name_location_box_two::where('id', $client->zone)->first();


            if ($payor_name) {
                if ($payor_name->cms1500_32address != null && $payor_name->cms1500_32city != null && $payor_name->cms1500_32state != null && $payor_name->cms1500_32zip != null) {
                    $claim->LocationOrgName = isset($box_32_data) ? $box_32_data->facility_name_two : '';    // empty in your case // use 32 box in here
                    if ($payor_name->cms_1500_32a != null) {
                        $claim->LocationNPI = $payor_name->cms_1500_32a; //optional 32 npi
                    } else {
                        $claim->LocationNPI = isset($box_32_client) ? $box_32_client->npi : ''; //optional 32 npi
                    }

                    $claim->LocationAddress = $payor_name->cms1500_32address;
                    $claim->LocationCity = $payor_name->cms1500_32city;
                    $claim->LocationState = $payor_name->cms1500_32state;
                    $claim->LocationZip = $payor_name->cms1500_32zip;
                } else {
                    $claim->LocationOrgName = isset($box_32_client) ? $box_32_client->facility_name_two : '';    // empty in your case // use 32 box in here
                    if ($payor_name->cms_1500_32a != null) {
                        $claim->LocationNPI = $payor_name->cms_1500_32a; //optional 32 npi
                    } else {
                        $claim->LocationNPI = isset($box_32_client) ? $box_32_client->npi : ''; //optional 32 npi
                    }
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
//                    ->where('admin_id', $this->admin_id)
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
                if($payor_name){
                    if ($payor_name->day_pay_cpt == 1) {
                        $charge1->ServiceLineNotes = $time_in_12_hour_format . '-' . $time_in_12_hour_format_2;
                    } else {
                        $charge1->ServiceLineNotes = '';
                    }    
                } else {
                    $charge1->ServiceLineNotes = '';
                }

                $charge1->Units = $single_claim_transaction->units;           // Units
                $charge1->Pointer1 = $claim_single_auth->diagnosis_one == null ? null : '1';         // Pointer 1
                $charge1->Pointer2 = $claim_single_auth->diagnosis_two == null ? null : '2';         // Pointer 2
                $charge1->Pointer3 = $claim_single_auth->diagnosis_three == null ? null : '3';         // Pointer 3
                $charge1->Pointer4 = $claim_single_auth->diagnosis_four == null ? null : '4';
                $charge1->DateofServiceFrom = Carbon::parse($single_claim_transaction->schedule_date)->isoFormat('YYYYMMDD'); //Carbon::parse($client->client_dob)->isoFormat('YYYYMMDD')
                $charge1->LineItemControlNum = $lmnum; // in era find charge control number
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
        $time = time();
        $output = $generate->Generate837Transaction($header, $listOfClaims, public_path('edi/' . $time . ".txt"));
        $f_name = "EDI-837-" . Auth::user()->id . time() . ".txt";
        $file_path = public_path("edi/" . $f_name);
        File::put($file_path, strtoupper($output->Transaction837));

        $s3 = Storage::disk('s3');
        $s3filepath = 'edi/' . $f_name;
        $s3->put($s3filepath, file_get_contents($file_path), 'public');
        $file_two = public_path('edi/' . $time . ".txt");
//        unlink($file_path);
//        unlink($file_two);

//        File::put($file_path, strtoupper($output->Transaction837));
        // return $output->ListOfClaims;
        //    echo "Processed Claims: " . $output->ProcessedClaims . '</br>';
        //        return substr($output->Transaction837,0,20);
        //  Based on the Output, you can maintain the SubmissionHistoryLog (batch wise) with following columns
        //  ID, Edi837FilePath, NumberOfClaims, Amount, Date etc.


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

//        $report_name = 'https://therapypms.s3.us-east-2.amazonaws.com/edi/' . $file_path;
//        $new_noti = new report_notification();
//        $new_noti->admin_id = Auth::user()->is_up_admin == 1 ? $this->admin_id : Auth::user()->up_admin_id;
//        $new_noti->name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
//        $new_noti->notification_date = Carbon::now();
//        $new_noti->file_name = $f_name;
//        $new_noti->report_type = 22;
//        $new_noti->report_name = "edi";
//        $new_noti->form_date = null;
//        $new_noti->to_date = null;
//        $new_noti->status = "Complete";
//        $new_noti->type = 1;
//        $new_noti->save();

//        return back()->with('success', 'Edi File is Preparing to ready. Once it ready you can download');
        $download_file = $f_name;
        return Response::download(public_path("edi/" . $download_file));
    }


    public function billing_claim_management_generate_837(Request $request)
    {
        $clim_ids = $request->claim_id;

        $all_claims = manage_claim::where('admin_id', $this->admin_id)
            ->whereIn('claim_id', $clim_ids)
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
//            $setting_name = setting_name_location::where('admin_id', $this->admin_id)->first();

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


            // 1st check provider NPI
            // 2nd check payor NPI
            //3rd check facility NPI

            $check_inv_npi = Employee::where('id', $single_claim->cms_24j)
                ->first();

            if ($check_inv_npi) {
                if ($check_inv_npi->individual_npi != null || $check_inv_npi->individual_npi != '') {
                    $claim->BillPrvNPI = $check_inv_npi->individual_npi;
                } else {
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
                                    return response()->json([
                                        "status" => "error",
                                        "msg" => "NPI not found."
                                    ], 200);
                                }
                            } else {
                                return response()->json([
                                    "status" => "error",
                                    "msg" => "NPI not found."
                                ], 200);
                            }
                        }
                    } else {
                        if ($admin_fac_settin) {
                            if ($admin_fac_settin->npi != null) {
                                $claim->BillPrvNPI = $admin_fac_settin->npi;
                            } else {
                                return response()->json([
                                    "status" => "error",
                                    "msg" => "NPI not found."
                                ], 200);
                            }
                        } else {
                            return response()->json([
                                "status" => "error",
                                "msg" => "NPI not found."
                            ], 200);
                        }
                    }
                }
            } elseif ($payor_name) {
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
                            return response()->json([
                                "status" => "error",
                                "msg" => "NPI not found."
                            ], 200);
                        }
                    } else {
                        return response()->json([
                            "status" => "error",
                            "msg" => "NPI not found."
                        ], 200);
                    }
                }
            } else {
                if ($admin_fac_settin) {
                    if ($admin_fac_settin->npi != null) {
                        $claim->BillPrvNPI = $admin_fac_settin->npi;
                    } else {
                        return response()->json([
                            "status" => "error",
                            "msg" => "NPI not found."
                        ], 200);
                    }
                } else {
                    return response()->json([
                        "status" => "error",
                        "msg" => "NPI not found."
                    ], 200);
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

            // Billing Provider Pay to Address (Where Checks will be droppd)        // empty in your case
            $claim->BillPrvPayToAddr = "";
            $claim->BillPrvPayToCity = "";
            $claim->BillPrvPayToState = "";
            $claim->BillPrvPayToZip = "";

            $claim->PayerType = 'CI'; // need to discuss with peter

            $claim->ClaimType = 'P';
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

            $claim->SBRLastName = $client->client_last_name;
            $claim->SBRFirstName = $client->client_first_name;
            $claim->SBRID = $client_auth->uci_id;
            $claim->SBRAddress = $client->client_street;
            $claim->SBRCity = $client->client_city;
            $claim->SBRState = $client->client_state;
            $claim->SBRZipCode = $client->client_zip;
            $claim->SBRDob = Carbon::parse($client->client_dob)->isoFormat('YYYYMMDD');
            $claim->SBRGender = $client->client_gender == "Male" ? 'M' : 'F';
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

            // Referring Provider           // empty in your case
            $ref_provider = Rendering_provider::where('id', $client_info->client_reffered_by)
                ->where('admin_id', $this->admin_id)
                ->first();

            $claim->RefPrvLastName = isset($ref_provider) ? $ref_provider->provider_name : '';
            $claim->RefPrvFirstName = isset($ref_provider) ? $ref_provider->provider_last_name : '';
            $claim->RefPrvMI = '';
            $claim->RefPrvNPI = isset($ref_provider) ? $ref_provider->npi : '';

            // Supervising Provider         // empty in your case
            $claim->SuperPrvLastName = '';
            $claim->SuperPrvFirstName = '';
            $claim->SuperPrvMI = '';
            $claim->SuperPrvNPI = '';

            // Location
//            $box_32_data = setting_name_location_box_two::where('admin_id', $this->admin_id)->first();

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
            $claim->PayerClaimCntrlNum = isset($single_claim->orginal_ref_number) ? $single_claim->orginal_ref_number : '';

            $manage_claim_transactions = manage_claim_transaction::where('claim_id', $single_claim->claim_id)
                ->where('admin_id', $this->admin_id)
                ->get();

            foreach ($manage_claim_transactions as $single_claim_transaction) {
                $claim_single_auth = Client_authorization::select('id', 'admin_id', 'diagnosis_one', 'diagnosis_two', 'diagnosis_three', 'diagnosis_four')
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
                
                if($payor_name){
                    if ($payor_name->day_pay_cpt == 1) {
                        $charge1->ServiceLineNotes = $time_in_12_hour_format . '-' . $time_in_12_hour_format_2;
                    } else {
                        $charge1->ServiceLineNotes = '';
                    }    
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

            array_push($listOfClaims, $claim);
        }

        $time = $this->admin_id . time();
        $output = $generate->Generate837Transaction($header, $listOfClaims, public_path('edi/' . $time . ".txt"));
        $f_name = "837-" . $this->admin_id . time() . ".txt";
        $file_path = public_path("edi/" . $f_name);
        //        return $output->Transaction837;
        File::put($file_path, strtoupper($output->Transaction837));
        //        echo "Processed Claims: " . $output->ProcessedClaims . '</br>';
        //        return substr($output->Transaction837,0,20);
        //  Based on the Output, you can maintain the SubmissionHistoryLog (batch wise) with following columns
        //  ID, Edi837FilePath, NumberOfClaims, Amount, Date etc.


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
                    return response()->json([
                        "status" => "error",
                        "msg" => $error_msg
                    ], 200);
                }
            }
        }

        $download_file = $f_name;

        return response()->json([
            "status" => "success",
            "msg" => $download_file
        ], 200);
    }


    public function billing_claim_management_generate_837_download($file)
    {
        $txt_download = public_path('edi/') . $file;
        return response()->download($txt_download);
    }
}
