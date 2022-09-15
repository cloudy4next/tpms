<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\All_payor_detail;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Client_guarantar_info;
use App\Models\Client_info;
use App\Models\Employee;
use App\Models\Employee_details_tx_type;
use App\Models\manage_claim;
use App\Models\manage_claim_boxone;
use App\Models\manage_claim_boxtwo;
use App\Models\manage_claim_transaction;
use App\Models\payor_details_tx_type;
use App\Models\Payor_facility;
use App\Models\Payor_facility_details;
use App\Models\Rendering_provider;
use App\Models\setting_name_location;
use App\Models\setting_name_location_box_two;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuperAdminHecfaFormController extends Controller
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

    public function claim_hcfa_with_bg(Request $request)
    {
        $claim_ids = $request->claim_ids;

        $action_type = $request->action_type_selected;

        $claims = manage_claim::distinct()->select('id', 'claim_id', 'admin_id')
            ->whereIn('claim_id', $claim_ids)
            ->where('admin_id', $this->admin_id)
            ->get();

        if (count($claims) <= 0) {
            return back()->with('alert', 'No Claim Found');
        }
        $pdf = new FPDF();
        foreach ($claims as $claim_data) {

            $clm = manage_claim::select('id', 'admin_id', 'claim_id', 'batch_id', 'client_id', 'payor_id', 'authorization_id', 'box_19', 'orginal_ref_number', 'resubmit_code', 'created_at', 'auth_no')
                ->where('id', $claim_data->id)
                ->where('admin_id', $this->admin_id)
                ->first();
            //client
            $client = Client::select('id', 'client_first_name', 'client_middle', 'client_last_name', 'client_dob', 'client_gender', 'client_street', 'client_city', 'client_state', 'client_zip', 'phone_number', 'zone')
                ->where('id', $clm->client_id)
                ->where('admin_id', $this->admin_id)
                ->first();
            //client info
            $clent_info = Client_info::select('client_id', 'relationship', 'client_reffered_by')
                ->where('client_id', $client->id)
                ->where('admin_id', $this->admin_id)
                ->first();
            //client grarenter
            $client_grander = Client_guarantar_info::select('client_id', 'guarantor_first_name', 'guarantor_last_name', 'g_street', 'g_city', 'g_state', 'g_zip')
                ->where('client_id', $client->id)
                ->where('admin_id', $this->admin_id)
                ->first();
            //client authorization
            $client_authorization = Client_authorization::select('id', 'authorization_number', 'payor_id', 'treatment_type', 'uci_id', 'diagnosis_one', 'diagnosis_two', 'diagnosis_three', 'diagnosis_four')
                ->where('id', $clm->authorization_id)
                ->where('admin_id', $this->admin_id)
                ->first();

            $all_payor_details = All_payor_detail::where('payor_id', $clm->payor_id)->where('admin_id', $this->admin_id)->first();

            $setting_name = manage_claim_boxone::where('admin_id', $this->admin_id)
                ->where('claim_id', $clm->claim_id)
                ->where('batch_id', $clm->batch_id)
                ->first();
            $total_change = manage_claim_transaction::select('claim_id', 'billed_am')
                ->where('claim_id', $clm->claim_id)
                ->where('admin_id', $this->admin_id)
                ->sum('billed_am');

            $setting_box_32 = manage_claim_boxtwo::where('admin_id', $this->admin_id)
                ->where('claim_id', $clm->claim_id)
                ->where('batch_id', $clm->batch_id)
                ->where('client_id', $clm->client_id)
                ->first();

            $name_location = setting_name_location::where('admin_id', $this->admin_id)->first();

            $dis_array = "";

            if ($client_authorization->diagnosis_one != null || $client_authorization->diagnosis_one != '') {
                $dis_array .= 'A';
            }
            if ($client_authorization->diagnosis_two != null || $client_authorization->diagnosis_two != '') {
                $dis_array .= 'B';
            }
            if ($client_authorization->diagnosis_three != null || $client_authorization->diagnosis_three != '') {
                $dis_array .= 'C';
            }
            if ($client_authorization->diagnosis_four != null || $client_authorization->diagnosis_four != '') {
                $dis_array .= 'D';
            }

            $image = public_path('assets/dashboard/images/client/background.png');
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 9);

            //background image
            if ($action_type == 1) {
                $pdf->Image($image, 10, 10, 190, 270);
            } else {
                $pdf->Image($image, 10, 10, 1, 1);
            }


            //1.
            $pdf->SetXY(12.5, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(28.5, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(44.8, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(66, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(82, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(100.7, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(114.8, 43.5);
            $pdf->Cell(3.5, 4, 'X', 0, 0);

            //Pair ID
            $payor_id = Payor_facility::select('admin_id', 'payor_id')->where('payor_id', $clm->payor_id)->where('admin_id', $this->admin_id)->first();
            $payor_facility = Payor_facility::where('payor_id', $clm->payor_id)->where('admin_id', $this->admin_id)->first();

            $all_payor = All_payor::select('id', 'facility_payor_id', 'ssn')
                ->where('id', $payor_id->payor_id)
                ->first();

//            $payor_facility = Payor_facility_details::where('id', $all_payor->facility_payor_id)->first();


            $pdf->SetXY(130, 15);
            if ($payor_facility) {
                $pdf->Cell(60, 4, $payor_facility->payor_name . ', ' . $payor_facility->ele_payor_id, 0, 0);        //Address1
            } else {
                $pdf->Cell(60, 4, '', 0, 0);        //Address1
            }


            $pdf->SetXY(130, 20);
            if ($payor_facility) {
                $pdf->Cell(60, 4, $payor_facility->address . ', ' . $payor_facility->city, 0, 0);        //Address2
            } else {
                $pdf->Cell(60, 4, '', 0, 0);        //Address2
            }


            $pdf->SetXY(130, 25);
            if ($payor_facility) {
                $pdf->Cell(60, 4, $payor_facility->state . ', ' . $payor_facility->zip, 0, 0);        //Zip Code
            } else {
                $pdf->Cell(60, 4, '', 0, 0);        //Zip Code
            }


            //1a. Insured's I.D Number
            $pdf->SetXY(130, 43.5);
            $pdf->Cell(65, 4, $client_authorization->uci_id, 0, 0);


            //2 Patient's Name
            $pdf->SetXY(13, 52);
            $pdf->Cell(65, 4, $client->client_last_name . ' , ' . $client->client_first_name . ' , ' . $client->client_middle, 0, 0);

            //3.    client dob
            $dob_mm = Carbon::parse($client->client_dob)->format('m');
            $dob_dd = Carbon::parse($client->client_dob)->format('d');
            $dob_yyyy = Carbon::parse($client->client_dob)->format('Y');
            $pdf->SetXY(82, 52);
            $pdf->Cell(6, 4, $dob_mm, 0, 0);        //MM

            $pdf->SetXY(89, 52);
            $pdf->Cell(6, 4, $dob_dd, 0, 0);        //DD

            $pdf->SetXY(95, 52);
            $pdf->Cell(11, 4, $dob_yyyy, 0, 0);        //YY


            $pdf->SetXY(108, 52);
            if ($client->client_gender == "Male") {
                $pdf->Cell(3.5, 4, 'X', 0, 0);        //Sex-M
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0);        //Sex-M
            }


            $pdf->SetXY(119.5, 52);
            if ($client->client_gender == "Female") {
                $pdf->Cell(3.5, 4, 'X', 0, 0);        //Sex-F
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0);        //Sex-F
            }


            //4. insured name
            $ins_name = $client_grander->guarantor_last_name . ' ,' . $client_grander->guarantor_first_name;
            $pdf->SetXY(130, 52);
            $pdf->Cell(65, 4, $ins_name, 0, 0);

            //5.
            $pdf->SetXY(13, 61);
            $pdf->Cell(65, 4, $client->client_street, 0, 0);    //Street No.
            $pdf->SetXY(13, 69);
            $pdf->Cell(57, 4, $client->client_city, 0, 0); //City
            $pdf->SetXY(71, 69);
            $pdf->Cell(8, 4, $client->client_state, 0, 0, 'C'); //State

            $pdf->SetXY(13, 78);
            $pdf->Cell(30, 4, $client->client_zip, 0, 0); //Zip Code


            $phone_1 = substr($client->phone_number, 1, 3);
            $phone_2 = substr($client->phone_number, 6, 8);
            $pdf->SetXY(45.5, 78);
            $pdf->Cell(8, 4, $phone_1, 0, 0); //Area Code

            $pdf->SetXY(55, 78);
            $pdf->Cell(24, 4, $phone_2, 0, 0);    //Telephone

            //6.
            $pdf->SetXY(87, 61);
            if ($clent_info->relationship == "Self") {
                $pdf->Cell(3.5, 4, 'X', 0, 0); //SELF
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0); //SELF
            }


            $pdf->SetXY(98.5, 61);
            if ($clent_info->relationship == "Spouse") {
                $pdf->Cell(3.5, 4, 'X', 0, 0);    //Spouse
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0);    //Spouse
            }


            $pdf->SetXY(108, 61);
            if ($clent_info->relationship == "Child") {
                $pdf->Cell(3.5, 4, 'X', 0, 0);    //Child
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0);    //Child
            }


            $pdf->SetXY(119.5, 61);
            if ($clent_info->relationship != "Self" && $clent_info->relationship != "Spouse" && $clent_info->relationship != "Child") {
                $pdf->Cell(3.5, 4, 'X', 0, 0);    //Other
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0);    //Other
            }


            //7.
            $pdf->SetXY(130, 61);
            $pdf->Cell(65, 4, $client_grander->g_street, 0, 0);    //Street No.
            $pdf->SetXY(127, 69);
            $pdf->Cell(54, 4, $client_grander->g_city, 0, 0); //City

            $pdf->SetXY(182, 69);
            $pdf->Cell(14, 4, $client_grander->g_state, 0, 0); //State

            $pdf->SetXY(127, 78);
            $pdf->Cell(28, 4, $client_grander->g_zip, 0, 0); //Zip code

            $pdf->SetXY(161.5, 78);
            $pdf->Cell(8, 4, '', 0, 0);        //Area Code

            $pdf->SetXY(171, 78);
            $pdf->Cell(24, 4, '', 0, 0);    //Telephone


            //8.
            $pdf->SetXY(80, 69);
            $pdf->MultiCell(46, 4, '', 0, 0);


            //9.
            $pdf->SetXY(13, 86);
            $pdf->Cell(66, 4, '', 0, 0);

            $pdf->SetXY(13, 95);
            $pdf->Cell(66, 4, '', 0, 0);        //9.a
            $pdf->SetXY(13, 104);
            $pdf->Cell(66, 4, '', 0, 0);        //9.b
            $pdf->SetXY(13, 112.5);
            $pdf->Cell(66, 4, '', 0, 0);        //9.c
            $pdf->SetXY(13, 121);
            $pdf->Cell(66, 4, '', 0, 0);        //9.d

            //10.
            $pdf->SetXY(91.5, 95.5);
            $pdf->Cell(3, 4, '', 0, 0); //10.a Yes

            $pdf->SetXY(105.5, 95.5);
            $pdf->Cell(3, 4, 'X', 0, 0);    //10.a No

            $pdf->SetXY(91.5, 104);
            $pdf->Cell(3, 4, '', 0, 0);    //10.b Yes

            $pdf->SetXY(105.5, 104);
            $pdf->Cell(3, 4, 'X', 0, 0);    //10.b No

            $pdf->SetXY(115, 104);
            $pdf->Cell(7, 4, '', 0, 0);    //10.b Place

            $pdf->SetXY(91.5, 112.5);
            $pdf->Cell(3, 4, '', 0, 0);    //10.c Yes

            $pdf->SetXY(105.5, 112.5);
            $pdf->Cell(3, 4, 'X', 0, 0);    //10.c No

            $pdf->SetXY(80, 121);
            $pdf->Cell(45, 4, '', 0, 0); //10.d

            //11.
            $pdf->SetXY(129, 86);
            $pdf->Cell(66, 4, '', 0, 0);

            $pdf->SetXY(134, 95.5);
            $pdf->Cell(5, 4, '', 0, 0);    //11.a MM

            $pdf->SetXY(141, 95.5);
            $pdf->Cell(5, 4, '', 0, 0);    //11.a DD

            $pdf->SetXY(148, 95.5);
            $pdf->Cell(14, 4, '', 0, 0);    //11.a YY

            $pdf->SetXY(168.2, 95);
            $pdf->Cell(3.5, 4, '', 0, 0);        //11.a Sex-M

            $pdf->SetXY(184.5, 95);
            $pdf->Cell(3.5, 4, '', 0, 0);        //11.a Sex-F

            $pdf->SetXY(126.5, 104);
            $pdf->Cell(5, 4, '', 0, 0);        //11.b ID

            $pdf->SetXY(133, 104);
            $pdf->Cell(62, 4, '', 0, 0); //11.b ID


            $pdf->SetXY(129, 112.5);
            $pdf->Cell(66, 4, '', 0, 0);    //11.c


            $pdf->SetXY(130.7, 121);
            $pdf->Cell(4, 4, '', 0, 0);    //11.d Yes

            $pdf->SetXY(142.7, 121);
            $pdf->Cell(4, 4, 'X', 0, 0);    //11.d No

            //12.
            $pdf->SetXY(26, 137);
            $pdf->Cell(58, 4, 'SIGNATURE ON FILE', 0, 0);    //signed

            $pdf->SetXY(95, 137);
            $pdf->Cell(30, 4, Carbon::parse($clm->created_at)->format('m/d/Y'), 0, 0);    //Date

            //13.
            $pdf->SetXY(140, 137);
            $pdf->Cell(55, 4, 'SIGNATURE ON FILE', 0, 0);

            //14.
            $pdf->SetXY(15.5, 147);
            $pdf->Cell(7, 4, '', 0, 0);    //MM

            $pdf->SetXY(22.5, 147);
            $pdf->Cell(7, 4, '', 0, 0);    //DD

            $pdf->SetXY(29, 147);
            $pdf->Cell(11, 4, '', 0, 0);    //YY

            $pdf->SetXY(48, 147);
            $pdf->Cell(26, 4, '', 0, 0);    //QUAL

            //15.
            $pdf->SetXY(82, 147);
            $pdf->Cell(13, 4, '', 0, 0);            //QUAL

            $pdf->SetXY(96, 147);
            $pdf->Cell(6, 4, '', 0, 0);        //MM

            $pdf->SetXY(104, 147);
            $pdf->Cell(6, 4, '', 0, 0);        //DD

            $pdf->SetXY(112, 147);
            $pdf->Cell(12, 4, '', 0, 0);        //YY


            //16.
            $pdf->SetXY(136, 147);
            $pdf->Cell(6, 4, '', 0, 0);    //FROM MM

            $pdf->SetXY(143, 147);
            $pdf->Cell(6, 4, '', 0, 0);    //FROM DD

            $pdf->SetXY(150, 147);
            $pdf->Cell(12, 4, '', 0, 0);    //FROM YY

            $pdf->SetXY(168.5, 147);
            $pdf->Cell(6, 4, '', 0, 0);        //TO MM

            $pdf->SetXY(175, 147);
            $pdf->Cell(6, 4, '', 0, 0);        //TO DD

            $pdf->SetXY(182, 147);
            $pdf->Cell(12, 4, '', 0, 0);    //TO YY

            //17.
            $reffered_employee = Rendering_provider::where('id', $clent_info->client_reffered_by)
                ->where('admin_id', $this->admin_id)
                ->first();

            $pdf->SetXY(13, 156);
            $pdf->Cell(6, 4, '', 0, 0);    //MR

            $pdf->SetXY(20, 156);
            if ($reffered_employee) {
                $pdf->Cell(54, 4, $reffered_employee->provider_name . ' ' . $reffered_employee->provider_last_name, 0, 0);    //Name
            } else {
                $pdf->Cell(54, 4, '', 0, 0);    //Name
            }


            $pdf->SetXY(80, 151);
            $pdf->Cell(5, 4, '', 0, 0);    //17.a

            $pdf->SetXY(85, 151);
            $pdf->Cell(40, 4, '', 0, 0);    //17.a

            $pdf->SetXY(86, 156);
            if ($reffered_employee) {
                $pdf->Cell(40, 4, $reffered_employee->npi, 0, 0);    //17.b NPI
            } else {
                $pdf->Cell(40, 4, '', 0, 0);    //17.b NPI
            }


            //18.
            $pdf->SetXY(136.5, 156);
            $pdf->Cell(5.5, 4, '', 0, 0);    //FROM MM

            $pdf->SetXY(143, 156);
            $pdf->Cell(5.5, 4, '', 0, 0);    //FROM DD

            $pdf->SetXY(149, 156);
            $pdf->Cell(12, 4, '', 0, 0);    //FROM YY


            $pdf->SetXY(169, 156);
            $pdf->Cell(5.5, 4, '', 0, 0);        //TO MM

            $pdf->SetXY(176, 156);
            $pdf->Cell(5.5, 4, '', 0, 0);        //TO DD

            $pdf->SetXY(183, 156);
            $pdf->Cell(12, 4, '', 0, 0);    //TO YY

            //19.
            $pdf->SetXY(13, 164);
            $pdf->Cell(112, 4, $clm->box_19, 0, 0);

            //20.
            $pdf->SetXY(131, 164);
            $pdf->Cell(4, 4, '', 0, 0);        //Yes

            $pdf->SetXY(143, 164);
            $pdf->Cell(4, 4, '', 0, 0);        //No

            $pdf->SetXY(154, 164);
            $pdf->Cell(21, 4, '', 0, 0);    //Charges 1

            $pdf->SetXY(176, 164);
            $pdf->Cell(20, 4, '', 0, 0);    //Charges 2

            //21.
            $pdf->SetXY(108, 169);
            $pdf->Cell(4, 4, '0', 0, 0);        //ICD


            $pdf->SetXY(17, 173);
            $pdf->Cell(16, 3.5, $client_authorization->diagnosis_one, 0, 0);    //A

            $pdf->SetXY(47.5, 173);
            $pdf->Cell(16, 3.5, $client_authorization->diagnosis_two, 0, 0);    //B

            $pdf->SetXY(78, 173);
            $pdf->Cell(16, 3.5, $client_authorization->diagnosis_three, 0, 0);    //C

            $pdf->SetXY(108, 173.5);
            $pdf->Cell(16, 3.5, $client_authorization->diagnosis_four, 0, 0);    //D

            $pdf->SetXY(17, 177.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //E

            $pdf->SetXY(47.5, 177.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //F

            $pdf->SetXY(78, 177.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //G

            $pdf->SetXY(108, 178);
            $pdf->Cell(16, 3.5, '', 0, 0);    //H

            $pdf->SetXY(17, 181.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //I

            $pdf->SetXY(47.5, 181.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //J

            $pdf->SetXY(78, 181.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //K

            $pdf->SetXY(108, 181.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //L

            //22.
            $pdf->SetXY(129, 173);
            $pdf->Cell(25, 4, $clm->resubmit_code, 0, 0);    //Resubmission Code

            $pdf->SetXY(153, 173);
            $pdf->Cell(42, 4, $clm->orginal_ref_number, 0, 0);    //Ref. No

            //23.
            $pdf->SetXY(127, 181.5);

            if ($name_location->is_combo == 1) {
                if ($clm->auth_no != null || $clm->auth_no != '') {
                    $pdf->Cell(68, 4, $clm->auth_no, 0, 0);
                } else {
                    $pdf->Cell(68, 4, '', 0, 0);
                }
            } else {
                $pdf->Cell(68, 4, $client_authorization->authorization_number, 0, 0);
            }


            //24 Row 1
            $y = 198.5;

            $claim_transactions = manage_claim_transaction::where('claim_id', $clm->claim_id)
                ->where('admin_id', $this->admin_id)
                ->orderBy('schedule_date', 'asc')
                ->get();

            for ($i = 0; $i < count($claim_transactions); $i++) {

                $claim_transactions_single = manage_claim_transaction::select('id', 'appointment_id', 'schedule_date', 'rate', 'units', 'cms_24j', 'provider_id')
                    ->where('id', $claim_transactions[$i]->id)
//                    ->where('admin_id', $this->admin_id)
                    ->first();

                $from_date_mm = Carbon::parse($claim_transactions_single->schedule_date)->format('m');
                $from_date_dd = Carbon::parse($claim_transactions_single->schedule_date)->format('d');
                $from_date_yy = Carbon::parse($claim_transactions_single->schedule_date)->format('Y');

                $app_data = Appoinment::select('id', 'admin_id', 'from_time', 'to_time')->where('id', $claim_transactions_single->appointment_id)->first();
                $form_time = Carbon::parse($app_data->from_time)->format('H:i');
                $to_time = Carbon::parse($app_data->to_time)->format('H:i');


                $yy = substr($from_date_yy, 2, 3);
                $charges = number_format((float)$claim_transactions_single->rate, 2) * number_format((float)$claim_transactions_single->units, 2);
                $cms_24_em = Employee::select('first_name', 'middle_name', 'last_name', 'individual_npi')
                    ->where('id', $claim_transactions[$i]->cms_24j)
//                    ->where('admin_id', $this->admin_id)
                    ->first();

                $pdf->SetXY(13, $y - 4);
                if ($all_payor_details) {
                    if ($all_payor_details->day_pay_cpt == 1) {
                        $pdf->Cell(20, 4, $form_time, 0, 0, 'C');
                    } else {
                        $pdf->Cell(20, 4, '', 0, 0, 'C');
                    }
                } else {
                    $pdf->Cell(20, 4, '', 0, 0, 'C');
                }


                $pdf->SetXY(13, $y);
                $pdf->Cell(5.5, 4, $from_date_mm, 0, 0);

                $pdf->SetXY(19.5, $y);
                $pdf->Cell(6, 4, $from_date_dd, 0, 0);

                $pdf->SetXY(26.5, $y);
                $pdf->Cell(6, 4, $yy, 0, 0);

                $pdf->SetXY(33, $y - 4);
                if ($all_payor_details) {
                    if ($all_payor_details->day_pay_cpt == 1) {
                        $pdf->Cell(20, 4, $to_time, 0, 0, 'C');
                    } else {
                        $pdf->Cell(20, 4, '', 0, 0, 'C');
                    }
                } else {
                    $pdf->Cell(20, 4, '', 0, 0, 'C');
                }


                $pdf->SetXY(33, $y);
                $pdf->Cell(6, 4, $from_date_mm, 0, 0);

                $pdf->SetXY(40, $y);
                $pdf->Cell(6.5, 4, $from_date_dd, 0, 0);

                $pdf->SetXY(47, $y);
                $pdf->Cell(6.5, 4, $yy, 0, 0);

                $pdf->SetXY(54.1, $y);
                $pdf->Cell(6.5, 4, $claim_transactions[$i]->location, 0, 0);

                $pdf->SetXY(61, $y);
                $pdf->Cell(6.5, 4, '', 0, 0);

                $pdf->SetXY(70, $y);
                $pdf->Cell(14, 4, str_replace(' ', '', $claim_transactions[$i]->cpt), 0, 0);

                $pdf->SetXY(86, $y);
                $pdf->Cell(7, 4, $claim_transactions[$i]->m1, 0, 0);

                $pdf->SetXY(94, $y);
                $pdf->Cell(6.5, 4, $claim_transactions[$i]->m2, 0, 0);

                $pdf->SetXY(101, $y);
                $pdf->Cell(6.5, 4, $claim_transactions[$i]->m3, 0, 0);

                $pdf->SetXY(108, $y);
                $pdf->Cell(6.5, 4, $claim_transactions[$i]->m4, 0, 0);

                $pdf->SetXY(114, $y);
                $pdf->Cell(9.5, 4, $dis_array, 0, 0);

                $pdf->SetXY(128, $y);
                $pdf->Cell(13, 4, $charges, 0, 0);

                $pdf->SetXY(141, $y);
                $pdf->Cell(5.5, 4, '00', 0, 0);

                $pdf->SetXY(147, $y);
                $pdf->Cell(9, 4, $claim_transactions[$i]->units, 0, 0);

                $pdf->SetXY(155.5, $y);


                $payor_tx_type = payor_details_tx_type::where('admin_id', $this->admin_id)
                    ->where('payor_id', $client_authorization->payor_id)
                    ->where('treatment_name', $client_authorization->treatment_type)
                    ->first();

                $em_tx_types = Employee_details_tx_type::where('employee_id', $claim_transactions_single->cms_24j)
                    ->where('treatment_name', $client_authorization->treatment_type)
                    ->first();


                $pdf->Cell(5, 4, '', 0, 0);
                $pdf->setXY($pdf->getX() + 1, $pdf->getY() - 4);
                if ($em_tx_types) {
                    if ($em_tx_types->id_qualifire != null || $em_tx_types->id_qualifire != "") {
                        $pdf->Cell(7, 4, $em_tx_types->id_qualifire, 0, 0);
                    } else {
                        if ($payor_tx_type) {
                            if ($payor_tx_type->id_qualifire != null || $payor_tx_type->id_qualifire != "") {
                                $pdf->Cell(7, 4, $payor_tx_type->id_qualifire, 0, 0);
                            } else {
                                $pdf->Cell(7, 4, "", 0, 0);
                            }
                        } else {
                            $pdf->Cell(7, 4, "", 0, 0);
                        }
                    }
                } elseif ($payor_tx_type) {
                    if ($payor_tx_type) {
                        if ($payor_tx_type->id_qualifire != null || $payor_tx_type->id_qualifire != "") {
                            $pdf->Cell(7, 4, $payor_tx_type->id_qualifire, 0, 0);
                        } else {
                            $pdf->Cell(7, 4, "", 0, 0);
                        }
                    } else {
                        $pdf->Cell(7, 4, "", 0, 0);
                    }
                } else {
                    $pdf->Cell(7, 4, "", 0, 0);
                }


                $pdf->SetXY(168, $y - 4);
                if ($em_tx_types) {
                    if ($em_tx_types->box_24j != null && $em_tx_types->box_24j != "") {
                        $pdf->Cell(28, 4, $em_tx_types->box_24j, 0, 0);

                    } else {
                        if ($payor_tx_type) {
                            if ($payor_tx_type->box_24j != null) {
                                $pdf->Cell(28, 4, $payor_tx_type->box_24j, 0, 0);
                            } elseif ($all_payor_details) {
                                if ($all_payor_details->ssn != null || $all_payor_details->ssn != '') {
                                    $pdf->Cell(28, 4, $all_payor->ssn, 0, 0);
                                } else {
                                    $pdf->Cell(28, 4, '', 0, 0);
                                }
                            } else {
                                $pdf->Cell(28, 4, '', 0, 0);
                            }
                        }
                    }
                } elseif ($payor_tx_type) {
                    if ($payor_tx_type->box_24j != null) {
                        $pdf->Cell(28, 4, $payor_tx_type->box_24j, 0, 0);
                    } elseif ($all_payor_details) {
                        if ($all_payor_details->ssn != null || $all_payor_details->ssn != '') {
                            $pdf->Cell(28, 4, $all_payor->ssn, 0, 0);
                        } else {
                            $pdf->Cell(28, 4, '', 0, 0);
                        }
                    } else {
                        $pdf->Cell(28, 4, '', 0, 0);
                    }
                } elseif ($all_payor_details) {
                    if ($all_payor_details->ssn != null || $all_payor_details->ssn != '') {
                        $pdf->Cell(28, 4, $all_payor->ssn, 0, 0);
                    } else {
                        $pdf->Cell(28, 4, '', 0, 0);
                    }
                } else {
                    $pdf->Cell(28, 4, '', 0, 0);
                }


                $pdf->SetXY(168, $y);
                if ($cms_24_em) {
                    $pdf->Cell(28, 4, $cms_24_em->individual_npi, 0, 0);
                } else {
                    $pdf->Cell(28, 4, "", 0, 0);
                }


                $y = $y + 8.5;
            }

            //25.
            $pdf->SetXY(13, 250);
            if ($setting_name) {
                $pdf->Cell(36, 4, $setting_name->ein, 0, 0);
            } else {
                $pdf->Cell(36, 4, '', 0, 0);
            }


            $pdf->SetXY(50, 250);
            $pdf->Cell(4, 4, '', 0, 0);    //SSN

            $pdf->SetXY(54.5, 250);
            $pdf->Cell(4, 4, 'X', 0, 0);    //EIN

            //26.
            $pdf->SetXY(63.5, 250);
            $pdf->Cell(34, 4, $name_location->short_code . $clm->claim_id, 0, 0);

            //27.
            $pdf->SetXY(98.7, 250);
            $pdf->Cell(4, 4, 'X', 0, 0);    //Yes

            $pdf->SetXY(110.3, 250);
            $pdf->Cell(3.5, 4, '', 0, 0);    //No

            //28.
            $pdf->SetXY(130, 250);
            $pdf->Cell(16, 4, $total_change, 0, 0);

            $pdf->SetXY(146, 250);
            $pdf->Cell(6, 4, '00', 0, 0);
            //29.
            $pdf->SetXY(156, 250);
            $pdf->Cell(13, 4, '', 0, 0);

            $pdf->SetXY(169, 250);
            $pdf->Cell(5.5, 4, '', 0, 0);
            //30.
            $pdf->SetXY(175, 250);
            $pdf->Cell(15, 4, '', 0, 0);

            $pdf->SetXY(190, 250);
            $pdf->Cell(5.5, 4, '', 0, 0);

            //31.
            $pdf->SetXY(13, 266);
            $pdf->SetFont('Arial', '', 9);
            if ($cms_24_em) {
                $pdf->Cell(50, 4, $cms_24_em->first_name . ' ' . $cms_24_em->middle_name . ' ' . $cms_24_em->last_name, 0, 0);
            } else {
                $pdf->Cell(50, 4, '', 0, 0);
            }


            $pdf->SetXY(22, 272);
            $pdf->Cell(26, 4, Carbon::parse($clm->created_at)->format('m/d/Y'), 0, 0);    //Signed


            //32.

//            $setting_box_32 = setting_name_location_box_two::where('admin_id', $this->admin_id)->first();


            $box_32_client = setting_name_location_box_two::where('id', $client->zone)->first();

            $pdf->SetFont('Arial', '', 9);
            $pdf->SetXY(64, 258);
            //            $pdf->SetFont('Arial','',9);

            //32
            if ($all_payor_details) {
                if ($all_payor_details->cms1500_32address != null &&
                    $all_payor_details->cms1500_32city != null &&
                    $all_payor_details->cms1500_32state != null &&
                    $all_payor_details->cms1500_32zip != null) {
                    $pdf->MultiCell(63, 4, $box_32_client->facility_name_two . "\n" . $all_payor_details->cms1500_32address . "\n" . $all_payor_details->cms1500_32city . ', ' . $all_payor_details->cms1500_32state . ', ' . $all_payor_details->cms1500_32zip, 0, 'L');
                } else {
                    if ($box_32_client) {
                        $pdf->MultiCell(63, 4, $box_32_client->facility_name_two . "\n" . $box_32_client->address . ' ' . $box_32_client->address_two . "\n" . $box_32_client->city . ', ' . $box_32_client->state . ', ' . $box_32_client->zip, 0, 'L');
                    } else {
                        $pdf->MultiCell(63, 4, '', 0, 'L');
                    }

                }
            } elseif ($box_32_client) {
                $pdf->MultiCell(61, 4, $box_32_client->facility_name_two . "\n" . $box_32_client->address . ' ' . $box_32_client->address_two . "\n" . $box_32_client->city . ', ' . $box_32_client->state . ', ' . $box_32_client->zip, 0, 'L');
            } else {
                $pdf->MultiCell(61, 4, '', 0, 0);
            }

            $pdf->SetXY(66, 272);
            if ($all_payor_details) {
                if ($all_payor_details->cms_1500_32a != null) {
                    $pdf->Cell(24, 4, $all_payor_details->cms_1500_32a, 0, 0);    //32.a
                } else {
                    if ($box_32_client) {
                        $pdf->Cell(24, 4, $box_32_client->npi, 0, 0);    //32.a
                    } else {
                        $pdf->Cell(24, 4, '', 0, 0);    //32.a
                    }
                }
            } elseif ($box_32_client) {
                $pdf->Cell(24, 4, $box_32_client->npi, 0, 0);    //32.a
            } else {
                $pdf->Cell(24, 4, '', 0, 0);    //32.a
            }


            $pdf->SetXY(92, 272);
            if ($all_payor_details) {
                $pdf->Cell(33, 4, $all_payor_details->cms_1500_32b, 0, 0);    //32.b
            } else {
                $pdf->Cell(33, 4, '', 0, 0);    //32.b
            }


            //33.

            

            $pdf->SetXY(127, 258);
            if ($all_payor_details) {
                if ($all_payor_details->cms1500_32address != null &&
                    $all_payor_details->cms1500_32city != null &&
                    $all_payor_details->cms1500_32state != null &&
                    $all_payor_details->cms1500_32zip != null) {
                    $pdf->MultiCell(69, 4, $name_location->facility_name . "\n" . $all_payor_details->cms1500_33address . "\n" . $all_payor_details->cms1500_33city . ', ' . $all_payor_details->cms1500_33state . ', ' . $all_payor_details->cms1500_33zip, 0, 'L');
                } else {
                    $pdf->MultiCell(69, 4, $name_location->facility_name . "\n" . $name_location->address . " " . $name_location->address_two . "\n" . $name_location->city . ', ' . $name_location->state . ', ' . $name_location->zip, 0, 'L');
                }
            } elseif ($setting_name) {
                $pdf->MultiCell(69, 4, $name_location->facility_name . "\n" . $name_location->address . ' ' . $name_location->address_two . "\n" . $name_location->city . ', ' . $name_location->state . ', ' . $name_location->zip, 0, 'L');
            } else {
                $pdf->MultiCell(70, 4, '', 0, 0);
            }

            $pdf->SetXY(163.5, 254.5);
            if ($name_location) {
                $s_phone_1 = substr($name_location->phone_one, 1, 3);
                $pdf->Cell(8, 4, $s_phone_1, 0, 0);        //Area Code
            } else {
                $pdf->Cell(8, 4, '', 0, 0);        //Area Code
            }


            $pdf->SetXY(172, 254.5);
            if ($box_32_client) {
                $s_phone_2 = substr($box_32_client->phone_one, 6);
                $pdf->Cell(24, 4, $s_phone_2, 0, 0);        //Phone Number
            } else {
                $pdf->Cell(24, 4, '', 0, 0);        //Phone Number
            }


            $pdf->SetXY(129, 272);
            if ($all_payor_details) {
                if ($all_payor_details->cms_1500_33a != null) {
                    $pdf->Cell(24, 4, $all_payor_details->cms_1500_33a, 0, 0);        //33.a
                } else {
                    $pdf->Cell(24, 4, $name_location->npi, 0, 0);
                }

            } elseif ($name_location) {
                $pdf->Cell(24, 4, $name_location->npi, 0, 0);        //33.a
            } else {
                $pdf->Cell(24, 4, '', 0, 0);        //33.a
            }

            $pdf->SetXY(156, 272);
            if ($all_payor_details) {
                $pdf->Cell(40, 4, $all_payor_details->cms_1500_33b, 0, 0);            //33.b
            } else {
                $pdf->Cell(40, 4, '', 0, 0);            //33.b
            }
        }

        $pdf->Output();
    }


    public function with_bg_pdf($claim_ids)
    {
    }


    public function claim_hcfa_show_by_claim_id(Request $request, $clid)
    {
        $action_type = 1;

        $claims = manage_claim::select('id')
            ->where('claim_id', $clid)
            ->where('admin_id', $this->admin_id)
            ->get();

        $pdf = new FPDF();
        foreach ($claims as $claim_data) {

            $clm = manage_claim::select('id', 'admin_id', 'claim_id', 'batch_id', 'client_id', 'payor_id', 'authorization_id', 'box_19', 'orginal_ref_number', 'resubmit_code', 'created_at', 'auth_no')
                ->where('id', $claim_data->id)
                ->where('admin_id', $this->admin_id)
                ->first();
            //client
            $client = Client::select('id', 'client_first_name', 'client_middle', 'client_last_name', 'client_dob', 'client_gender', 'client_street', 'client_city', 'client_state', 'client_zip', 'phone_number', 'zone')
                ->where('id', $clm->client_id)
                ->where('admin_id', $this->admin_id)
                ->first();
            //client info
            $clent_info = Client_info::select('client_id', 'relationship', 'client_reffered_by')
                ->where('client_id', $client->id)
                ->where('admin_id', $this->admin_id)
                ->first();
            //client grarenter
            $client_grander = Client_guarantar_info::select('client_id', 'guarantor_first_name', 'guarantor_last_name', 'g_street', 'g_city', 'g_state', 'g_zip')
                ->where('client_id', $client->id)
                ->where('admin_id', $this->admin_id)
                ->first();
            //client authorization
            $client_authorization = Client_authorization::select('id', 'client_id', 'authorization_number', 'payor_id', 'treatment_type', 'uci_id', 'diagnosis_one', 'diagnosis_two', 'diagnosis_three', 'diagnosis_four')
                ->where('id', $clm->authorization_id)
                ->where('admin_id', $this->admin_id)
                ->first();

            //
            //            $client_authorization_act = Client_authorization_activity::where('id',$clm->activity_id)->first();
            //            $employee_provider = Employee::where('id',$claim_data->provider_id)->first();
            //            $employee_cms24 = Employee::where('id',$claim_data->cms_24j)->first();
//            $setting_name = setting_name_location::where('admin_id', $this->admin_id)->first();


            $all_payor_details = All_payor_detail::where('payor_id', $clm->payor_id)->where('admin_id', $this->admin_id)->first();
            $setting_name = manage_claim_boxone::where('admin_id', $this->admin_id)
                ->where('claim_id', $clm->claim_id)
                ->where('batch_id', $clm->batch_id)
                ->first();
            $total_change = manage_claim_transaction::select('claim_id', 'billed_am')
                ->where('claim_id', $clm->claim_id)
                ->where('admin_id', $this->admin_id)
                ->sum('billed_am');

            $setting_box_32 = manage_claim_boxtwo::where('admin_id', $this->admin_id)
                ->where('claim_id', $clm->claim_id)
                ->where('batch_id', $clm->batch_id)
                ->where('client_id', $clm->client_id)
                ->first();

            $name_loca = setting_name_location::where('admin_id', $this->admin_id)->first();

            $dis_array = "";

            if ($client_authorization->diagnosis_one != null || $client_authorization->diagnosis_one != '') {
                $dis_array .= 'A';
            }
            if ($client_authorization->diagnosis_two != null || $client_authorization->diagnosis_two != '') {
                $dis_array .= 'B';
            }
            if ($client_authorization->diagnosis_three != null || $client_authorization->diagnosis_three != '') {
                $dis_array .= 'C';
            }
            if ($client_authorization->diagnosis_four != null || $client_authorization->diagnosis_four != '') {
                $dis_array .= 'D';
            }

            $image = public_path('assets/dashboard/images/client/background.png');
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 9);

            //background image
            if ($action_type == 1) {
                $pdf->Image($image, 10, 10, 190, 270);
            } else {
                $pdf->Image($image, 10, 10, 1, 1);
            }


            //1.
            $pdf->SetXY(12.5, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(28.5, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(44.8, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(66, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(82, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(100.7, 43.5);
            $pdf->Cell(3.5, 4, '', 0, 0);

            $pdf->SetXY(114.8, 43.5);
            $pdf->Cell(3.5, 4, 'X', 0, 0);

            //Pair ID
            $payor_id = Payor_facility::select('admin_id', 'payor_id')->where('payor_id', $clm->payor_id)->where('admin_id', $this->admin_id)->first();
            $payor_facility = Payor_facility::where('payor_id', $clm->payor_id)->where('admin_id', $this->admin_id)->first();

            $all_payor = All_payor::select('id', 'facility_payor_id', 'ssn')->where('id', $payor_id->payor_id)->first();
//            $payor_facility = Payor_facility_details::where('id', $all_payor->facility_payor_id)->first();


            $pdf->SetXY(130, 15);
            if ($payor_facility) {
                $pdf->Cell(60, 4, $payor_facility->payor_name . ', ' . $payor_facility->ele_payor_id, 0, 0);        //Address1
            } else {
                $pdf->Cell(60, 4, '', 0, 0);        //Address1
            }

            $pdf->SetXY(130, 20);
            if ($payor_facility) {
                $pdf->Cell(60, 4, $payor_facility->address . ', ' . $payor_facility->city, 0, 0);        //Address2
            } else {
                $pdf->Cell(60, 4, '', 0, 0);        //Address2
            }

            $pdf->SetXY(130, 25);
            if ($payor_facility) {
                $pdf->Cell(60, 4, $payor_facility->state . ', ' . $payor_facility->zip, 0, 0);        //Zip Code
            } else {
                $pdf->Cell(60, 4, '', 0, 0);        //Zip Code
            }


            //1a. Insured's I.D Number
            $pdf->SetXY(130, 43.5);
            $pdf->Cell(65, 4, $client_authorization->uci_id, 0, 0);


            //2 Patient's Name
            $pdf->SetXY(13, 52);

            $client_n = '';
            if ($client->client_last_name != null) $client_n .= $client->client_last_name;
            if ($client->client_first_name != null) $client_n .= ', ' . $client->client_first_name;
            if ($client->client_middle != null) $client_n .= ', ' . $client->client_middle;
            $pdf->Cell(65, 4, $client_n, 0, 0);

            //3.    client dob
            $dob_mm = Carbon::parse($client->client_dob)->format('m');
            $dob_dd = Carbon::parse($client->client_dob)->format('d');
            $dob_yyyy = Carbon::parse($client->client_dob)->format('Y');
            $pdf->SetXY(82, 52);
            $pdf->Cell(6, 4, $dob_mm, 0, 0);        //MM

            $pdf->SetXY(89, 52);
            $pdf->Cell(6, 4, $dob_dd, 0, 0);        //DD

            $pdf->SetXY(96, 52);
            $pdf->Cell(11, 4, $dob_yyyy, 0, 0);        //YY


            $pdf->SetXY(108, 52);
            if ($client->client_gender == "Male") {
                $pdf->Cell(3.5, 4, 'X', 0, 0);        //Sex-M
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0);        //Sex-M
            }


            $pdf->SetXY(119.5, 52);
            if ($client->client_gender == "Female") {
                $pdf->Cell(3.5, 4, 'X', 0, 0);        //Sex-F
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0);        //Sex-F
            }


            //4. insured name
            $ins_name = '';
            if ($client_grander->guarantor_last_name != null) $ins_name .= $client_grander->guarantor_last_name;
            if ($client_grander->guarantor_first_name != null) $ins_name .= ', ' . $client_grander->guarantor_first_name;
            $pdf->SetXY(130, 52);
            $pdf->Cell(65, 4, $ins_name, 0, 0);

            //5.
            $pdf->SetXY(13, 61);
            $pdf->Cell(65, 4, $client->client_street, 0, 0);    //Street No.
            $pdf->SetXY(13, 69);
            $pdf->Cell(57, 4, $client->client_city, 0, 0); //City
            $pdf->SetXY(71, 69);
            $pdf->Cell(8, 4, $client->client_state, 0, 0, 'C'); //State

            $pdf->SetXY(13, 78);
            $pdf->Cell(30, 4, $client->client_zip, 0, 0); //Zip Code


            $phone_1 = substr($client->phone_number, 1, 3);
            $phone_2 = substr($client->phone_number, 6, 8);
            $pdf->SetXY(45.5, 78);
            $pdf->Cell(8, 4, $phone_1, 0, 0); //Area Code

            $pdf->SetXY(55, 78);
            $pdf->Cell(24, 4, $phone_2, 0, 0);    //Telephone

            //6.
            $pdf->SetXY(87, 61);
            if ($clent_info->relationship == "Self") {
                $pdf->Cell(3.5, 4, 'X', 0, 0); //SELF
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0); //SELF
            }


            $pdf->SetXY(98.5, 61);
            if ($clent_info->relationship == "Spouse") {
                $pdf->Cell(3.5, 4, 'X', 0, 0);    //Spouse
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0);    //Spouse
            }


            $pdf->SetXY(108, 61);
            if ($clent_info->relationship == "Child") {
                $pdf->Cell(3.5, 4, 'X', 0, 0);    //Child
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0);    //Child
            }


            $pdf->SetXY(119.5, 61);
            if ($clent_info->relationship != "Self" && $clent_info->relationship != "Spouse" && $clent_info->relationship != "Child") {
                $pdf->Cell(3.5, 4, 'X', 0, 0);    //Other
            } else {
                $pdf->Cell(3.5, 4, '', 0, 0);    //Other
            }


            //7.
            $pdf->SetXY(130, 61);
            $pdf->Cell(65, 4, $client_grander->g_street, 0, 0);    //Street No.
            $pdf->SetXY(127, 69);
            $pdf->Cell(54, 4, $client_grander->g_city, 0, 0); //City

            $pdf->SetXY(182, 69);
            $pdf->Cell(14, 4, $client_grander->g_state, 0, 0); //State

            $pdf->SetXY(127, 78);
            $pdf->Cell(28, 4, $client_grander->g_zip, 0, 0); //Zip code

            $pdf->SetXY(161.5, 78);
            $pdf->Cell(8, 4, '', 0, 0);        //Area Code

            $pdf->SetXY(171, 78);
            $pdf->Cell(24, 4, '', 0, 0);    //Telephone


            //8.
            $pdf->SetXY(80, 69);
            $pdf->MultiCell(46, 4, '', 0, 0);


            //9.
            $pdf->SetXY(13, 86);
            $pdf->Cell(66, 4, '', 0, 0);

            $pdf->SetXY(13, 95);
            $pdf->Cell(66, 4, '', 0, 0);        //9.a
            $pdf->SetXY(13, 104);
            $pdf->Cell(66, 4, '', 0, 0);        //9.b
            $pdf->SetXY(13, 112.5);
            $pdf->Cell(66, 4, '', 0, 0);        //9.c
            $pdf->SetXY(13, 121);
            $pdf->Cell(66, 4, '', 0, 0);        //9.d

            //10.
            $pdf->SetXY(91.5, 95.5);
            $pdf->Cell(3, 4, '', 0, 0); //10.a Yes

            $pdf->SetXY(105.5, 95.5);
            $pdf->Cell(3, 4, 'X', 0, 0);    //10.a No

            $pdf->SetXY(91.5, 104);
            $pdf->Cell(3, 4, '', 0, 0);    //10.b Yes

            $pdf->SetXY(105.5, 104);
            $pdf->Cell(3, 4, 'X', 0, 0);    //10.b No

            $pdf->SetXY(115, 104);
            $pdf->Cell(7, 4, '', 0, 0);    //10.b Place

            $pdf->SetXY(91.5, 112.5);
            $pdf->Cell(3, 4, '', 0, 0);    //10.c Yes

            $pdf->SetXY(105.5, 112.5);
            $pdf->Cell(3, 4, 'X', 0, 0);    //10.c No

            $pdf->SetXY(80, 121);
            $pdf->Cell(45, 4, '', 0, 0); //10.d

            //11.
            $pdf->SetXY(129, 86);
            $pdf->Cell(66, 4, '', 0, 0);

            $pdf->SetXY(134, 95.5);
            $pdf->Cell(5, 4, '', 0, 0);    //11.a MM

            $pdf->SetXY(141, 95.5);
            $pdf->Cell(5, 4, '', 0, 0);    //11.a DD

            $pdf->SetXY(148, 95.5);
            $pdf->Cell(14, 4, '', 0, 0);    //11.a YY

            $pdf->SetXY(168.2, 95);
            $pdf->Cell(3.5, 4, '', 0, 0);        //11.a Sex-M

            $pdf->SetXY(184.5, 95);
            $pdf->Cell(3.5, 4, '', 0, 0);        //11.a Sex-F

            $pdf->SetXY(126.5, 104);
            $pdf->Cell(5, 4, '', 0, 0);        //11.b ID

            $pdf->SetXY(133, 104);
            $pdf->Cell(62, 4, '', 0, 0); //11.b ID


            $pdf->SetXY(129, 112.5);
            $pdf->Cell(66, 4, '', 0, 0);    //11.c


            $pdf->SetXY(130.7, 121);
            $pdf->Cell(4, 4, '', 0, 0);    //11.d Yes

            $pdf->SetXY(142.7, 121);
            $pdf->Cell(4, 4, 'X', 0, 0);    //11.d No

            //12.
            $pdf->SetXY(26, 137);
            $pdf->Cell(58, 4, 'SIGNATURE ON FILE', 0, 0);    //signed

            $pdf->SetXY(95, 137);
            $pdf->Cell(30, 4, Carbon::parse($clm->created_at)->format('m/d/Y'), 0, 0);    //Date

            //13.
            $pdf->SetXY(140, 137);
            $pdf->Cell(55, 4, 'SIGNATURE ON FILE', 0, 0);

            //14.
            $pdf->SetXY(15.5, 147);
            $pdf->Cell(7, 4, '', 0, 0);    //MM

            $pdf->SetXY(22.5, 147);
            $pdf->Cell(7, 4, '', 0, 0);    //DD

            $pdf->SetXY(29, 147);
            $pdf->Cell(11, 4, '', 0, 0);    //YY

            $pdf->SetXY(48, 147);
            $pdf->Cell(26, 4, '', 0, 0);    //QUAL

            //15.
            $pdf->SetXY(82, 147);
            $pdf->Cell(13, 4, '', 0, 0);            //QUAL

            $pdf->SetXY(96, 147);
            $pdf->Cell(6, 4, '', 0, 0);        //MM

            $pdf->SetXY(104, 147);
            $pdf->Cell(6, 4, '', 0, 0);        //DD

            $pdf->SetXY(112, 147);
            $pdf->Cell(12, 4, '', 0, 0);        //YY


            //16.
            $pdf->SetXY(136, 147);
            $pdf->Cell(6, 4, '', 0, 0);    //FROM MM

            $pdf->SetXY(143, 147);
            $pdf->Cell(6, 4, '', 0, 0);    //FROM DD

            $pdf->SetXY(150, 147);
            $pdf->Cell(12, 4, '', 0, 0);    //FROM YY

            $pdf->SetXY(168.5, 147);
            $pdf->Cell(6, 4, '', 0, 0);        //TO MM

            $pdf->SetXY(175, 147);
            $pdf->Cell(6, 4, '', 0, 0);        //TO DD

            $pdf->SetXY(182, 147);
            $pdf->Cell(12, 4, '', 0, 0);    //TO YY

            //17.
            $reffered_employee = Rendering_provider::where('id', $clent_info->client_reffered_by)
                ->where('admin_id', $this->admin_id)
                ->first();
            $pdf->SetXY(13, 156);
            $pdf->Cell(6, 4, '', 0, 0);    //MR

            $pdf->SetXY(20, 156);
            if ($reffered_employee) {
                $pdf->Cell(54, 4, $reffered_employee->provider_name . ' ' . $reffered_employee->provider_last_name, 0, 0);    //Name
            } else {
                $pdf->Cell(54, 4, '', 0, 0);    //Name
            }


            $pdf->SetXY(80, 151);
            $pdf->Cell(5, 4, '', 0, 0);    //17.a

            $pdf->SetXY(85, 151);
            $pdf->Cell(40, 4, '', 0, 0);    //17.a

            $pdf->SetXY(86, 156);
            if ($reffered_employee) {
                $pdf->Cell(40, 4, $reffered_employee->npi, 0, 0);    //17.b NPI
            } else {
                $pdf->Cell(40, 4, '', 0, 0);    //17.b NPI
            }


            //18.
            $pdf->SetXY(136.5, 156);
            $pdf->Cell(5.5, 4, '', 0, 0);    //FROM MM

            $pdf->SetXY(143, 156);
            $pdf->Cell(5.5, 4, '', 0, 0);    //FROM DD

            $pdf->SetXY(149, 156);
            $pdf->Cell(12, 4, '', 0, 0);    //FROM YY


            $pdf->SetXY(169, 156);
            $pdf->Cell(5.5, 4, '', 0, 0);        //TO MM

            $pdf->SetXY(176, 156);
            $pdf->Cell(5.5, 4, '', 0, 0);        //TO DD

            $pdf->SetXY(183, 156);
            $pdf->Cell(12, 4, '', 0, 0);    //TO YY

            //19.
            $pdf->SetXY(13, 164);
            $pdf->Cell(112, 4, $clm->box_19, 0, 0);

            //20.
            $pdf->SetXY(131, 164);
            $pdf->Cell(4, 4, '', 0, 0);        //Yes

            $pdf->SetXY(143, 164);
            $pdf->Cell(4, 4, '', 0, 0);        //No

            $pdf->SetXY(154, 164);
            $pdf->Cell(21, 4, '', 0, 0);    //Charges 1

            $pdf->SetXY(176, 164);
            $pdf->Cell(20, 4, '', 0, 0);    //Charges 2

            //21.
            $pdf->SetXY(108, 169);
            $pdf->Cell(4, 4, '0', 0, 0);        //ICD


            $pdf->SetXY(17, 173);
            $pdf->Cell(16, 3.5, $client_authorization->diagnosis_one, 0, 0);    //A

            $pdf->SetXY(47.5, 173);
            $pdf->Cell(16, 3.5, $client_authorization->diagnosis_two, 0, 0);    //B

            $pdf->SetXY(78, 173);
            $pdf->Cell(16, 3.5, $client_authorization->diagnosis_three, 0, 0);    //C

            $pdf->SetXY(108, 173.5);
            $pdf->Cell(16, 3.5, $client_authorization->diagnosis_four, 0, 0);    //D

            $pdf->SetXY(17, 177.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //E

            $pdf->SetXY(47.5, 177.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //F

            $pdf->SetXY(78, 177.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //G

            $pdf->SetXY(108, 178);
            $pdf->Cell(16, 3.5, '', 0, 0);    //H

            $pdf->SetXY(17, 181.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //I

            $pdf->SetXY(47.5, 181.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //J

            $pdf->SetXY(78, 181.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //K

            $pdf->SetXY(108, 181.5);
            $pdf->Cell(16, 3.5, '', 0, 0);    //L

            //22.
            $pdf->SetXY(129, 173);
            $pdf->Cell(25, 4, $clm->resubmit_code, 0, 0);    //Resubmission Code

            $pdf->SetXY(153, 173);
            $pdf->Cell(42, 4, $clm->orginal_ref_number, 0, 0);    //Ref. No

            //23.
            $pdf->SetXY(127, 181.5);
            if ($name_loca->is_combo == 1) {
                if ($clm->auth_no != null || $clm->auth_no != '') {
                    $pdf->Cell(68, 4, $clm->auth_no, 0, 0);
                } else {
                    $pdf->Cell(68, 4, '', 0, 0);
                }
            } else {
                $pdf->Cell(68, 4, $client_authorization->authorization_number, 0, 0);
            }


            //24 Row 1
            $y = 198.5;

            $claim_transactions = manage_claim_transaction::where('claim_id', $clm->claim_id)
                ->where('batch_id', $clm->batch_id)
                ->where('admin_id', $this->admin_id)
                ->orderBy('schedule_date', 'asc')
                ->get();


            for ($i = 0; $i < count($claim_transactions); $i++) {


                $claim_transactions_single = manage_claim_transaction::select('id', 'appointment_id', 'schedule_date', 'rate', 'units', 'cms_24j', 'provider_id')
                    ->where('id', $claim_transactions[$i]->id)
//                    ->where('admin_id', $this->admin_id)
                    ->first();

                $from_date_mm = Carbon::parse($claim_transactions_single->schedule_date)->format('m');
                $from_date_dd = Carbon::parse($claim_transactions_single->schedule_date)->format('d');
                $from_date_yy = Carbon::parse($claim_transactions_single->schedule_date)->format('Y');

                $app_data = Appoinment::select('id', 'admin_id', 'from_time', 'to_time')->where('id', $claim_transactions_single->appointment_id)->first();
                $form_time = Carbon::parse($app_data->from_time)->format('H:i');
                $to_time = Carbon::parse($app_data->to_time)->format('H:i');

                $yy = substr($from_date_yy, 2, 3);
                $charges = number_format((float)$claim_transactions_single->rate, 2) * number_format((float)$claim_transactions_single->units, 2);
                $cms_24_em = Employee::select('id', 'first_name', 'middle_name', 'last_name', 'individual_npi')
                    ->where('id', $claim_transactions[$i]->cms_24j)
//                    ->where('admin_id', $this->admin_id)
                    ->first();

                $pdf->SetXY(13, $y - 4);
                if ($all_payor_details) {
                    if ($all_payor_details->day_pay_cpt == 1) {
                        $pdf->Cell(20, 4, $form_time, 0, 0, 'C');
                    } else {
                        $pdf->Cell(20, 4, '', 0, 0, 'C');
                    }
                } else {
                    $pdf->Cell(20, 4, '', 0, 0, 'C');
                }


                $pdf->SetXY(13, $y);
                $pdf->Cell(5.5, 4, $from_date_mm, 0, 0);

                $pdf->SetXY(19.5, $y);
                $pdf->Cell(6, 4, $from_date_dd, 0, 0);

                $pdf->SetXY(26.5, $y);
                $pdf->Cell(6, 4, $yy, 0, 0);

                $pdf->SetXY(33, $y - 4);
                if ($all_payor_details) {
                    if ($all_payor_details->day_pay_cpt == 1) {
                        $pdf->Cell(20, 4, $to_time, 0, 0, 'C');
                    } else {
                        $pdf->Cell(20, 4, '', 0, 0, 'C');
                    }
                } else {
                    $pdf->Cell(20, 4, '', 0, 0, 'C');
                }


                $pdf->SetXY(33, $y);
                $pdf->Cell(6, 4, $from_date_mm, 0, 0);

                $pdf->SetXY(40, $y);
                $pdf->Cell(6.5, 4, $from_date_dd, 0, 0);

                $pdf->SetXY(47, $y);
                $pdf->Cell(6.5, 4, $yy, 0, 0);

                $pdf->SetXY(54.1, $y);
                $pdf->Cell(6.5, 4, $claim_transactions[$i]->location, 0, 0);

                $pdf->SetXY(61, $y);
                $pdf->Cell(6.5, 4, '', 0, 0);

                $pdf->SetXY(70, $y);
                $pdf->Cell(14, 4, str_replace(' ', '', $claim_transactions[$i]->cpt), 0, 0);

                $pdf->SetXY(86, $y);
                $pdf->Cell(7, 4, $claim_transactions[$i]->m1, 0, 0);

                $pdf->SetXY(94, $y);
                $pdf->Cell(6.5, 4, $claim_transactions[$i]->m2, 0, 0);

                $pdf->SetXY(101, $y);
                $pdf->Cell(6.5, 4, $claim_transactions[$i]->m3, 0, 0);

                $pdf->SetXY(108, $y);
                $pdf->Cell(6.5, 4, $claim_transactions[$i]->m4, 0, 0);

                $pdf->SetXY(114, $y);
                $pdf->Cell(9.5, 4, $dis_array, 0, 0);

                $pdf->SetXY(128, $y);
                $pdf->Cell(13, 4, $charges, 0, 0);

                $pdf->SetXY(141, $y);
                $pdf->Cell(5.5, 4, '00', 0, 0);

                $pdf->SetXY(147, $y);
                $pdf->Cell(9, 4, $claim_transactions[$i]->units, 0, 0);

                $payor_tx_type = payor_details_tx_type::where('admin_id', $this->admin_id)
                    ->where('payor_id', $client_authorization->payor_id)
                    ->where('treatment_name', $client_authorization->treatment_type)
                    ->first();

                $em_tx_types = Employee_details_tx_type::where('employee_id', $claim_transactions_single->cms_24j)
                    ->where('treatment_name', $client_authorization->treatment_type)
                    ->first();

                $pdf->SetXY(155.5, $y);
                $pdf->Cell(5, 4, '', 0, 0);
                $pdf->setXY($pdf->getX() + 1, $pdf->getY() - 4);
                if ($em_tx_types) {
                    if ($em_tx_types->id_qualifire != null || $em_tx_types->id_qualifire != "") {
                        $pdf->Cell(7, 4, $em_tx_types->id_qualifire, 0, 0);
                    } else {
                        if ($payor_tx_type) {
                            if ($payor_tx_type->id_qualifire != null || $payor_tx_type->id_qualifire != "") {
                                $pdf->Cell(7, 4, $payor_tx_type->id_qualifire, 0, 0);
                            } else {
                                $pdf->Cell(7, 4, "", 0, 0);
                            }
                        } else {
                            $pdf->Cell(7, 4, "", 0, 0);
                        }
                    }
                } elseif ($payor_tx_type) {
                    if ($payor_tx_type) {
                        if ($payor_tx_type->id_qualifire != null || $payor_tx_type->id_qualifire != "") {
                            $pdf->Cell(7, 4, $payor_tx_type->id_qualifire, 0, 0);
                        } else {
                            $pdf->Cell(7, 4, "", 0, 0);
                        }
                    } else {
                        $pdf->Cell(7, 4, "", 0, 0);
                    }
                } else {
                    $pdf->Cell(7, 4, "", 0, 0);
                }

                $pdf->SetXY(168, $y - 4);

                if ($em_tx_types) {
                    if ($em_tx_types->box_24j != null || $em_tx_types->box_24j != "") {
                        $pdf->Cell(28, 4, $em_tx_types->box_24j, 0, 0);
                    } else {
                        if ($payor_tx_type) {
                            if ($payor_tx_type->box_24j != null || $payor_tx_type->box_24j != '') {
                                $pdf->Cell(28, 4, $payor_tx_type->box_24j, 0, 0);
                            } elseif ($all_payor_details) {
                                if ($all_payor_details->ssn != null || $all_payor_details->ssn != '') {
                                    $pdf->Cell(28, 4, $all_payor->ssn, 0, 0);
                                } else {
                                    $pdf->Cell(28, 4, '', 0, 0);
                                }
                            } else {
                                $pdf->Cell(28, 4, '', 0, 0);
                            }
                        }
                    }

                } elseif ($payor_tx_type) {
                    if ($payor_tx_type->box_24j != null || $payor_tx_type->box_24j != '') {
                        $pdf->Cell(28, 4, $payor_tx_type->box_24j, 0, 0);
                    } elseif ($all_payor_details) {
                        if ($all_payor_details->ssn != null || $all_payor_details->ssn != '') {
                            $pdf->Cell(28, 4, $all_payor->ssn, 0, 0);
                        } else {
                            $pdf->Cell(28, 4, '', 0, 0);
                        }
                    } else {
                        $pdf->Cell(28, 4, '', 0, 0);
                    }
                } elseif ($all_payor_details) {
                    if ($all_payor_details->ssn != null || $all_payor_details->ssn != '') {
                        $pdf->Cell(28, 4, $all_payor->ssn, 0, 0);
                    } else {
                        $pdf->Cell(28, 4, '', 0, 0);
                    }
                } else {
                    $pdf->Cell(28, 4, '', 0, 0);
                }


                $pdf->SetXY(168, $y);
                if ($cms_24_em) {
                    $pdf->Cell(28, 4, $cms_24_em->individual_npi, 0, 0);
                } else {
                    $pdf->Cell(28, 4, "", 0, 0);
                }


                $y = $y + 8.5;
            }

            //25.
            $pdf->SetXY(13, 250);
            if ($setting_name) {
                $pdf->Cell(36, 4, $setting_name->ein, 0, 0);
            } else {
                $pdf->Cell(36, 4, '', 0, 0);
            }


            $pdf->SetXY(50, 250);
            $pdf->Cell(4, 4, '', 0, 0);    //SSN

            $pdf->SetXY(54.5, 250);
            $pdf->Cell(4, 4, 'X', 0, 0);    //EIN

            //26.
            $pdf->SetXY(63.5, 250);
            $pdf->Cell(34, 4, $name_loca->short_code . $clm->claim_id, 0, 0);

            //27.
            $pdf->SetXY(98.7, 250);
            $pdf->Cell(4, 4, 'X', 0, 0);    //Yes

            $pdf->SetXY(110.3, 250);
            $pdf->Cell(3.5, 4, '', 0, 0);    //No

            //28.
            $pdf->SetXY(130, 250);
            $pdf->Cell(16, 4, $total_change, 0, 0);

            $pdf->SetXY(146, 250);
            $pdf->Cell(6, 4, '00', 0, 0);
            //29.
            $pdf->SetXY(156, 250);
            $pdf->Cell(13, 4, '', 0, 0);

            $pdf->SetXY(169, 250);
            $pdf->Cell(5.5, 4, '', 0, 0);
            //30.
            $pdf->SetXY(175, 250);
            $pdf->Cell(15, 4, '', 0, 0);

            $pdf->SetXY(190, 250);
            $pdf->Cell(5.5, 4, '', 0, 0);

            //31.
            $pdf->SetXY(13, 266);
            $pdf->SetFont('Arial', '', 9);
            if ($cms_24_em) {
                $pdf->Cell(50, 4, $cms_24_em->first_name . ' ' . $cms_24_em->middle_name . ' ' . $cms_24_em->last_name, 0, 0);
            } else {
                $pdf->Cell(50, 4, '', 0, 0);
            }


            $pdf->SetXY(22, 272);
            $pdf->Cell(26, 4, Carbon::parse($clm->created_at)->format('m/d/Y'), 0, 0);    //Signed


            //32.

//            $setting_box_32 = setting_name_location_box_two::where('admin_id', $this->admin_id)->first();


            $box_32_client = setting_name_location_box_two::where('id', $client->zone)->first();

            $pdf->SetFont('Arial', '', 9);
            $pdf->SetXY(63, 258);
            //            $pdf->SetFont('Arial','',9);

            //32
            if ($all_payor_details) {
                if ($all_payor_details->cms1500_32address != null &&
                    $all_payor_details->cms1500_32city != null &&
                    $all_payor_details->cms1500_32state != null &&
                    $all_payor_details->cms1500_32zip != null) {
                    $pdf->MultiCell(63, 4, $box_32_client->facility_name_two . "\n" . $all_payor_details->cms1500_32address . "\n" . $all_payor_details->cms1500_32city . ', ' . $all_payor_details->cms1500_32state . ', ' . $all_payor_details->cms1500_32zip, 0, 'L');
                } else {
                    if ($box_32_client) {
                        $pdf->MultiCell(63, 4, $box_32_client->facility_name_two . "\n" . $box_32_client->address . ' ' . $box_32_client->address_two . "\n" . $box_32_client->city . ', ' . $box_32_client->state . ', ' . $box_32_client->zip, 0, 'L');
                    } else {
                        $pdf->MultiCell(63, 4, '', 0, 'L');
                    }

                }
            } elseif ($box_32_client) {
                $pdf->MultiCell(61, 4, $box_32_client->facility_name_two . "\n" . $box_32_client->address . ' ' . $box_32_client->address_two . "\n" . $box_32_client->city . ', ' . $box_32_client->state . ', ' . $box_32_client->zip, 0, 'L');
            } else {
                $pdf->MultiCell(61, 4, '', 0, 0);
            }


            $pdf->SetXY(66, 272);
            if ($all_payor_details) {
                if ($all_payor_details->cms_1500_32a != null) {
                    $pdf->Cell(24, 4, $all_payor_details->cms_1500_32a, 0, 0);    //32.a
                } else {
                    if ($box_32_client) {
                        $pdf->Cell(24, 4, $box_32_client->npi, 0, 0);    //32.a
                    } else {
                        $pdf->Cell(24, 4, '', 0, 0);    //32.a
                    }
                }
            } elseif ($box_32_client) {
                $pdf->Cell(24, 4, $box_32_client->npi, 0, 0);    //32.a
            } else {
                $pdf->Cell(24, 4, '', 0, 0);    //32.a
            }


            $pdf->SetXY(92, 272);
            if ($all_payor_details) {
                $pdf->Cell(33, 4, $all_payor_details->cms_1500_32b, 0, 0);    //32.b
            } else {
                $pdf->Cell(33, 4, '', 0, 0);    //32.b
            }


            //33.
            $pdf->SetXY(126, 258);
            if ($all_payor_details) {
                if ($all_payor_details->cms1500_32address != null &&
                    $all_payor_details->cms1500_32city != null &&
                    $all_payor_details->cms1500_32state != null &&
                    $all_payor_details->cms1500_32zip != null) {
                    $pdf->MultiCell(71, 4, $name_loca->facility_name . "\n" . $all_payor_details->cms1500_33address . "\n" . $all_payor_details->cms1500_33city . ', ' . $all_payor_details->cms1500_33state . ', ' . $all_payor_details->cms1500_33zip, 0, 'L');
                } else {
                    $pdf->MultiCell(71, 4, $name_loca->facility_name . "\n" . $name_loca->address . ' ' . $name_loca->address_two . "\n" . $name_loca->city . ', ' . $name_loca->state . ', ' . $name_loca->zip, 0, 'L');
                }

            } elseif ($name_loca) {
                $pdf->MultiCell(71, 4, $name_loca->facility_name . "\n" . $name_loca->address . '  ' . $name_loca->address_two . "\n" . $name_loca->city . ', ' . $name_loca->state . ', ' . $name_loca->zip, 0, 'L');
            } else {
                $pdf->MultiCell(70, 4, '', 0, 0);
            }

            $pdf->SetXY(163.5, 254.5);
            if ($name_loca) {
                $s_phone_1 = substr($name_loca->phone_one, 1, 3);
                $pdf->Cell(8, 4, $s_phone_1, 0, 0);        //Area Code
            } else {
                $pdf->Cell(8, 4, '', 0, 0);        //Area Code
            }


            $pdf->SetXY(172, 254.5);
            if ($box_32_client) {
                $s_phone_2 = substr($box_32_client->phone_one, 6);
                $pdf->Cell(24, 4, $s_phone_2, 0, 0);        //Phone Number
            } else {
                $pdf->Cell(24, 4, '', 0, 0);        //Phone Number
            }


            $pdf->SetXY(129, 272);
            if ($all_payor_details) {
                if ($all_payor_details->cms_1500_33a != null) {
                    $pdf->Cell(24, 4, $all_payor_details->cms_1500_33a, 0, 0);        //33.a
                } else {
                    $pdf->Cell(24, 4, $name_loca->npi, 0, 0);        //33.a
                }
            } elseif ($name_loca) {
                $pdf->Cell(24, 4, $name_loca->npi, 0, 0);        //33.a
            } else {
                $pdf->Cell(24, 4, '', 0, 0);        //33.a
            }

            $pdf->SetXY(156, 272);
            if ($all_payor_details) {
                $pdf->Cell(40, 4, $all_payor_details->cms_1500_33b, 0, 0);            //33.b
            } else {
                $pdf->Cell(40, 4, '', 0, 0);            //33.b
            }
        }

        $pdf->Output();

    }
}
