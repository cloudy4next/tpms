<?php

namespace App\Console\Commands;
use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\All_payor_detail;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\deposit_apply_transaction;
use App\Models\Employee;
use App\Models\ledger_note;
use App\Models\manage_claim_transaction;
use App\Models\report_notification;
use App\Models\general_setting;
use App\Models\setting_name_location;
use App\Models\ledger_list;
use App\Models\deposit;
use App\Models\deposit_apply;
use App\Models\Payor_facility;
use App\Models\setting_name_location_box_two;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Console\Command;


class MYPDF extends FPDF
{

    var $widths;
    var $aligns;
    public $logo;
    public $name_location;
    public $check;
    protected $admin_id;

    public function __construct($name_location, $d_from, $d_to, $check, $admin_id)
    {
        parent::__construct();
        $this->name_location = $name_location;
        $this->d_from = $d_from;
        $this->d_to = $d_to;
        $this->check = $check;
        $this->admin_id = $admin_id;
    }


    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data, $head = 0, $cell_w = 5)
    {
        $this->SetDrawColor(32, 122, 199);
        if ($head == 3) {
            $this->SetFont('', 'B', 10);
        } else if ($head == 0) {
            $this->SetFont('', '', 9);
        } else if ($head == 5) {
            $this->SetFont('', 'B', 10);
        }

        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $cell_w * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            if ($head == 0) {
                if ($i == 0 || $i == 1) {
                    $this->SetFont('', 'B', 10);
                } else {
                    $this->SetFont('', '', 9);
                }
            }
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            if ($head == 0) {
                //Draw the border
                if ($i == 0 || $i == 1) {
                    $this->SetFillColor(152, 206, 252);
                    if (strpos($data[$i], "-") !== false) {
                        $this->SetTextColor(246, 29, 0);
                    } else {
                        $this->SetTextColor(0, 0, 0);
                    }
                    $this->Rect($x, $y, $w, $h, 'FD');
                } else {
                    $this->SetFillColor(255, 255, 255);
                    if (strpos($data[$i], "-") !== false) {
                        $this->SetTextColor(246, 29, 0);
                    } else {
                        $this->SetTextColor(0, 0, 0);
                    }
                    $this->Rect($x, $y, $w, $h, 'FD');
                }

            } else if ($head == 1) {
                //Draw the border
                $this->SetFillColor(0, 32, 96);
                $this->SetTextColor(255, 255, 255);
                $this->Rect($x, $y, $w, $h, 'FD');
            } else if ($head == 2) {
                //Draw the border
                $this->SetFillColor(204, 192, 218);
                $this->SetTextColor(0, 0, 0);
                $this->Rect($x, $y, $w, $h, 'FD');
            } else if ($head == 3) {
                //Draw the border
                $this->SetFillColor(32, 122, 199);
                $this->SetTextColor(255, 255, 255);
                $this->Rect($x, $y, $w, $h, 'FD');
            } else if ($head == 4) {
                //Draw the border
                if ($i == 0) {
                    $this->SetFillColor(32, 122, 199);
                    $this->SetTextColor(255, 255, 255);
                    $this->SetFont('', 'B', 11);
                } else {
                    $this->SetFillColor(255, 190, 188);
                    $this->SetTextColor(0, 0, 0);
                    $this->SetFont('', 'B', 9);
                }
                $this->Rect($x, $y, $w, $h, 'FD');
            } else if ($head == 5) {
                //Draw the border
                if ($i == 0) {
                    $this->SetFillColor(152, 206, 252);
                    if (strpos($data[$i], "-") !== false) {
                        $this->SetTextColor(246, 29, 0);
                    } else {
                        $this->SetTextColor(0, 0, 0);
                    }
                    $this->Rect($x, $y, $w, $h, 'FD');
                } else {
                    $this->SetFillColor(255, 255, 255);
                    if (strpos($data[$i], "-") !== false) {
                        $this->SetTextColor(246, 29, 0);
                    } else {
                        $this->SetTextColor(0, 0, 0);
                    }
                    $this->Rect($x, $y, $w, $h, 'FD');
                }
            } else {
                //Draw the border
                $this->Rect($x, $y, $w, $h);
            }

            //Print the text
            $this->MultiCell($w, $cell_w, $data[$i], 0, $a);

            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw =& $this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

    function TableHeading()
    {
        $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        // $this->Row(array('Billed Year', 'Billed  Month', 'Billed Amount', 'Adjustment', 'Allowed Amount', 'Guarantor Paid', 'Insurance Paid', 'Total Paid', 'Patient Resp.', 'Insurance Resp.', 'Balance', 'Collection Rate'), 3, 5);
        $this->Row(array('Billed Year', 'Billed  Month', 'Billed Amount', 'Insurance Paid', 'Adjustment','Patient Resp.', 'Guarantor Paid', 'Total Paid', 'Insurance Resp.', 'Balance','Collection Rate'), 3, 5);
    }

    function Table2Heading()
    {
        $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $this->Row(array('Patient Name', 'Billed Amount', 'Insurance Paid', 'Adjustment','Patient Resp.', 'Guarantor Paid', 'Total Paid', 'Insurance Resp.', 'Balance','Collection Rate'), 3, 5);
    }

    function Table3Heading()
    {
        $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $this->Row(array('Insurance Name', 'Billed Amount', 'Insurance Paid', 'Adjustment','Patient Resp.', 'Guarantor Paid', 'Total Paid', 'Insurance Resp.', 'Balance','Collection Rate'), 3, 5);
    }

    function Header()
    {

        $address = $this->name_location->address . ' ' . $this->name_location->address2;
        $address2 = $this->name_location->city . ', ' . $this->name_location->state . ' ' . $this->name_location->zip;

        $this->SetAutoPageBreak(false);
        $this->SetFont('helvetica', '', 10);

        $logo = general_setting::where('admin_id', $this->admin_id)->first();
        if($logo){
            if($logo->logo != null && $logo->logo != ''){
                $logo_path=public_path($logo->logo);
                if(file_exists($logo_path)) {
                    $this->Image($logo_path, 15, 5, 20, 20);
                }
            }
        }

        $this->SetXY(38, 5);
        $w = 5;
        $this->SetFont('', '', 11);
        $this->Cell(110, $w, $address, 0, 1);
        $this->SetX(38);
        $this->Cell(110, $w, $address2, 0, 1);
        $this->SetX(38);
        $this->Cell(110, $w, 'Phone: ' . $this->name_location->phone_one, 0, 1);
        $this->SetX(38);
        $this->Cell(110, $w, $this->name_location->email, 0, 1);
        $this->SetXY(155, 10);
        $this->SetFont('', 'B', 14);
        if ($this->check == "patient") {
            $this->SetTextColor(217, 83, 79);
            $this->Cell(125, 10, 'KPI Report By Patients', 0, 1, 'C');
            $this->SetFont('', 'B', 12);
            $this->SetX(155);
            $this->SetDrawColor(217, 83, 79);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(125, $w, 'Entry date between ' . $this->d_from . ' and ' . $this->d_to, 0, 1, 'C');
        } else if ($this->check == "month") {
            $this->SetTextColor(217, 83, 79);
            $this->Cell(125, 10, 'KPI Report By Months', 0, 1, 'C');
            $this->SetFont('', 'B', 12);
            $this->SetX(155);
            $this->SetDrawColor(217, 83, 79);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(125, $w, 'Entry date between ' . $this->d_from . ' and ' . $this->d_to, 0, 1, 'C');
        } else if ($this->check == "insurance") {
            $this->SetTextColor(217, 83, 79);
            $this->Cell(125, 10, 'KPI Report By Insurance', 0, 1, 'C');
            $this->SetFont('', 'B', 12);
            $this->SetX(155);
            $this->SetDrawColor(217, 83, 79);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(125, $w, 'Entry date between ' . $this->d_from . ' and ' . $this->d_to, 0, 1, 'C');
        }
        $this->SetY(30);
        $this->Line(10.5, 27.5, 287, 27.5);
        $this->Line(10.5, 5, 10.5, 27.5);
        $this->SetLineWidth(0.1);
    }
}



class GenerateKPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:downloadkpi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'KPI Reports Months/Patient/Insurance';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $fpdf;
    protected $admin_id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function declare_PDF($d_from, $d_to, $check, $admin_id)
    {
        $name_location = setting_name_location::where('admin_id', $admin_id)->first();
        $this->fpdf = new MYPDF($name_location, $d_from, $d_to, $check, $admin_id);
    }

    public function handle()
    {
        $all_report = report_notification::where('status', "Pending")
            ->where('report_name', 'kpi')
            ->get();
        foreach($all_report as $report){
            $this->admin_id=$report->admin_id;
            if($report->report_type=="31"){

                $combo_check=setting_name_location::select('admin_id','is_combo')->where('admin_id',$report->admin_id)->first();

                $date_from = Carbon::parse($report->form_date)->format('Y-m-d');
                $date_to = Carbon::parse($report->to_date)->format('Y-m-d');

                $d_from = Carbon::parse($date_from)->format('m/d/Y');
                $d_to = Carbon::parse($date_to)->format('m/d/Y');
                
                $this->declare_PDF($d_from, $d_to, "month",$report->admin_id);

                $result = CarbonPeriod::create($date_from, '1 month', $date_to);
                $p_date=array();
                foreach ($result as $dt) {
                    array_push($p_date, array(
                        "m" => $dt->format('m'),  //07
                        "y" => $dt->format('Y'),  //2022
                        "M" => $dt->format('F'),  //July
                    ));
                }


                $this->fpdf->AddPage('L');
                $this->fpdf->SetFont('', '', 8);

                //Height of row
                $w = 7;

                /*
                $this->fpdf->SetFillColor(255,255,0);
                $this->fpdf->Cell(70,10,'As of 09/20/2021',1,1,'C','F');*/

                //Setting widths for rows
                $this->fpdf->SetWidths(array(23,23, 26, 26, 26, 26, 26, 26, 26, 25, 24));


                //Calling table heading
                $this->fpdf->TableHeading();

                //Alignment of data rows
                $this->fpdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $t1 = 0;
                $t2 = 0;
                $t3 = 0;
                $t4 = 0;
                $t5 = 0;
                $t6 = 0;
                $t7 = 0;
                $t8 = 0;
                $t9 = 0;
                foreach ($p_date as $dat) {


                    $y = $this->fpdf->GetY();
                    $y = floor($y);
                    $y = $y + $w;

                    //Checking for page break and applying table header on every page.
                    if ($y >= 200) {
                        $this->fpdf->AddPage('L');
                        $this->fpdf->TableHeading();
                        $this->fpdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                    }

                    $lines = ledger_list::where('admin_id', $this->admin_id)
                        ->whereMonth('schedule_date', '=', $dat["m"])
                        ->whereYear('schedule_date', '=', $dat["y"])
                        ->where('schedule_date', '>=', $date_from)
                        ->where('schedule_date', '<=', $date_to)->get();

                    $t_am = 0;
                    $t_adj = 0;
                    $t_ins = 0;
                    $t_bal = 0;
                    $t_gaurantor = 0;
                    $t_paid = 0;
                    $t_p_res = 0;
                    $t_ins_balance = 0;


                    foreach ($lines as $line) {

                        $total_am = 0;
                        $total_pay = 0;
                        $total_adj = 0;
                        $total_bal = 0;

                        if($combo_check->is_combo==1){

                            $copay = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('cpt',$line->cpt)->where('status', "PR Copay")->sum('balance');
                            $coins = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('cpt',$line->cpt)->where('status', "PR CoIns")->sum('balance');
                            $deduct = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('cpt',$line->cpt)->where('status', "PR Ded")->sum('balance');
                            $deposit_aplly_1 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $billed_am = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->sum('billed_am');
                            $check_dep_data = deposit_apply::distinct()->select('deopsit_id', 'appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $deposit_aplly_pay = deposit_apply::select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->sum('payment');

                            $deposit_aplly_adj = deposit_apply::select('appointment_id', 'dos', 'amount')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->sum('adjustment');

                            $v1 = "PR CoIns";
                            $v2 = "PR Copay";
                            $v3 = "PR Ded";

                            $check_who_paid = deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'dos', 'who_paid', 'client_id', 'payment')
                            ->where('batching_claim_id', $line->batching_id)
                            ->where('cpt',$line->cpt)
                            ->where('admin_id', $line->admin_id)
                            ->get();
                        }
                        else{

                            $copay = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('status', "PR Copay")->sum('balance');
                            $coins = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('status', "PR CoIns")->sum('balance');
                            $deduct = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('status', "PR Ded")->sum('balance');
                            $deposit_aplly_1 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $billed_am = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->sum('billed_am');
                            $check_dep_data = deposit_apply::distinct()->select('deopsit_id', 'appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $deposit_aplly_pay = deposit_apply::select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->sum('payment');

                            $deposit_aplly_adj = deposit_apply::select('appointment_id', 'dos', 'amount')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->sum('adjustment');
                                
                                $v1 = "PR CoIns";
                                $v2 = "PR Copay";
                                $v3 = "PR Ded";

                                $check_who_paid = deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'dos', 'who_paid', 'client_id', 'payment')
                                ->where('batching_claim_id', $line->batching_id)
                                ->where('admin_id', $line->admin_id)
                                ->get();
                        }


                        $t_pat_paid = 0;
                        $t_payo_paid = 0;
                        foreach ($check_who_paid as $who_paid) {
                            $check_pt = Client::select('id', 'client_full_name', 'admin_id')
                                ->where('admin_id', $who_paid->admin_id)
                                ->where('client_full_name', $who_paid->who_paid)
                                ->first();

                            if ($check_pt) {
                                $t_pat_paid += $who_paid->payment;
                            } else {
                                $t_pat_paid += 0;
                            }

                            $check_payor = All_payor_detail::select('payor_name', 'admin_id')
                                ->where('admin_id', $who_paid->admin_id)
                                ->where('payor_name', $who_paid->who_paid)
                                ->first();

                            if ($check_payor) {
                                $t_payo_paid += $who_paid->payment;
                            } else {
                                $t_payo_paid += 0;
                            }
                        }   
                        $t_ins_p = 0;
                        $t_ins_p += $t_payo_paid;

                        $t_g_p = 0;
                        $t_g_p += $t_pat_paid;

                        $sub_total = $deposit_aplly_pay + $deposit_aplly_adj;
                        $balance = $billed_am - $sub_total;


                        if ($deposit_aplly_1) {
                            $total_am += $billed_am;
                            $total_pay += $deposit_aplly_pay;
                            $total_adj += $deposit_aplly_adj;
                            $total_bal += $balance;
                        } else {
                            $total_am += $line->billed_am;
                            $total_pay += 0.00;
                            $total_adj += 0.00;
                            $total_bal += $line->billed_am;
                        }

                        $patient_res = $copay + $coins + $deduct - $t_pat_paid;
                        $final_ins_bal=$total_bal-$patient_res;
                        $t_am += $total_am;
                        $t_adj += $total_adj;
                        $t_ins += $t_ins_p;
                        $t_bal += $total_bal;
                        $t_gaurantor += $t_g_p;
                        $t_paid += $total_pay;
                        $t_p_res += $patient_res;
                        $t_ins_balance += $final_ins_bal;

                    }

                    $billed_amount = '$' . number_format($t_am, 2);
                    $adjustment = '$' . number_format($t_adj, 2);
                    $allowed_amount = '$' . number_format($t_am, 2);
                    $gaurantor = '$' . number_format($t_gaurantor, 2); //done
                    $ins_paid = '$' . number_format($t_ins, 2);
                    // $sec_ins="";   //remove
                    $total_paid = '$' . number_format($t_paid, 2); //done
                    $patient_res = '$' . number_format($t_p_res, 2);//done
                    $ins_res = '$' . number_format($t_ins_balance, 2); //
                    $balance = '$' . number_format($t_bal, 2);
                    $percent = $t_am == 0 ? 0.00 : $t_ins_balance / $t_am * 100;
                    $percent = number_format(100 - $percent, 2) . '%';


                    $this->fpdf->Row(array($dat["y"], $dat["M"], $billed_amount,$ins_paid, $adjustment, $patient_res, $gaurantor,$total_paid, $ins_res, $balance, $percent), 0, $w);

                    $t1 += $t_am;
                    $t5 += $t_ins;
                    $t2 += $t_adj;
                    $t7 += $t_p_res;
                    $t4 += $t_gaurantor;
                    // $t3 += $t_am;   //hide
                    $t6 += $t_paid;
                    $t8 += $t_ins_balance;
                    $t9 += $t_bal;
                }

                $tp = $t1 == 0 ? 0.00 : $t8 / $t1 * 100;
                $tp = number_format(100 - $tp, 2) . '%';
                $t1 = '$' . number_format($t1, 2);
                $t2 = '$' . number_format($t2, 2);
                $t3 = '$' . number_format($t3, 2);
                $t4 = '$' . number_format($t4, 2);
                $t5 = '$' . number_format($t5, 2);
                $t6 = '$' . number_format($t6, 2);
                $t7 = '$' . number_format($t7, 2);
                $t8 = '$' . number_format($t8, 2);
                $t9 = '$' . number_format($t9, 2);

                $this->fpdf->SetWidths(array(46, 26, 26, 26, 26, 26, 26, 26, 25, 24));
                $this->fpdf->Row(array("Total", $t1, $t5, $t2, $t7, $t4 , $t6, $t8, $t9, $tp), 4, $w);
                $path = public_path() . '/report/pdf/';
                $filename = $report->file_name . '.pdf';

                $this->fpdf->Output($path . $filename, 'F');
                $update_report = report_notification::where('id', $report->id)->first();
                $update_report->status = "Complete";
                $update_report->save();
            }
            else if($report->report_type=="32"){

                $combo_check=setting_name_location::select('admin_id','is_combo')->where('admin_id',$report->admin_id)->first();

                $p_ids=json_decode($report->extra);
                $date_from = Carbon::parse($report->form_date)->format('Y-m-d');
                $date_to = Carbon::parse($report->to_date)->format('Y-m-d');

                $d_from = Carbon::parse($date_from)->format('m/d/Y');
                $d_to = Carbon::parse($date_to)->format('m/d/Y');
                
                if (!$this->declare_PDF($d_from, $d_to, "patient",$report->admin_id)) {
                    return false;
                }

                $this->fpdf->AddPage('L');
                $this->fpdf->SetFont('', '', 8);

                //Height of row
                $w = 7;

                //Setting widths for rows
                $this->fpdf->SetWidths(array(46, 26, 26, 26, 26, 26, 26, 26, 25, 24));


                //Calling table heading
                $this->fpdf->Table2Heading();

                //Alignment of data rows
                $this->fpdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $t1 = 0;
                $t2 = 0;
                $t3 = 0;
                $t4 = 0;
                $t5 = 0;
                $t6 = 0;
                $t7 = 0;
                $t8 = 0;
                $t9 = 0;
                foreach ($p_ids as $id) {
                    $p_name = Client::select('client_full_name')->where('id', $id)->first();
                    $p_name = $p_name->client_full_name;

                    $y = $this->fpdf->GetY();
                    $y = floor($y);
                    $y = $y + $w;

                    //Checking for page break and applying table header on every page.
                    if ($y >= 200) {
                        $this->fpdf->AddPage('L');
                        $this->fpdf->Table2Heading();
                        $this->fpdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                    }


                    $lines = ledger_list::where('admin_id', $this->admin_id)
                        ->where('client_id', $id)
                        ->where('schedule_date', '>=', $date_from)
                        ->where('schedule_date', '<=', $date_to)
                        ->get();

                    $t_am = 0;
                    $t_adj = 0;
                    $t_ins = 0;
                    $t_bal = 0;
                    $t_gaurantor = 0;
                    $t_paid = 0;
                    $t_p_res = 0;
                    $t_ins_balance = 0;


                    foreach ($lines as $line) {

                        $total_am = 0;
                        $total_pay = 0;
                        $total_adj = 0;
                        $total_bal = 0;


                        if($combo_check->is_combo==1){

                            $copay = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('cpt',$line->cpt)->where('status', "PR Copay")->sum('balance');
                            $coins = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('cpt',$line->cpt)->where('status', "PR CoIns")->sum('balance');
                            $deduct = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('cpt',$line->cpt)->where('status', "PR Ded")->sum('balance');
                            $deposit_aplly_1 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $billed_am = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->sum('billed_am');
                            $check_dep_data = deposit_apply::distinct()->select('deopsit_id', 'appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $deposit_aplly_pay = deposit_apply::select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->sum('payment');

                            $deposit_aplly_adj = deposit_apply::select('appointment_id', 'dos', 'amount')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->sum('adjustment');

                            $v1 = "PR CoIns";
                            $v2 = "PR Copay";
                            $v3 = "PR Ded";

                            $check_who_paid = deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'dos', 'who_paid', 'client_id', 'payment')
                            ->where('batching_claim_id', $line->batching_id)
                            ->where('cpt',$line->cpt)
                            ->where('admin_id', $line->admin_id)
                            ->get();
                        }
                        else{

                            $copay = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('status', "PR Copay")->sum('balance');
                            $coins = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('status', "PR CoIns")->sum('balance');
                            $deduct = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('status', "PR Ded")->sum('balance');
                            $deposit_aplly_1 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $billed_am = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->sum('billed_am');
                            $check_dep_data = deposit_apply::distinct()->select('deopsit_id', 'appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $deposit_aplly_pay = deposit_apply::select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->sum('payment');

                            $deposit_aplly_adj = deposit_apply::select('appointment_id', 'dos', 'amount')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->sum('adjustment');
                                
                            $v1 = "PR CoIns";
                            $v2 = "PR Copay";
                            $v3 = "PR Ded";

                            $check_who_paid = deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'dos', 'who_paid', 'client_id', 'payment')
                            ->where('batching_claim_id', $line->batching_id)
                            ->where('admin_id', $line->admin_id)
                            ->get();
                        }

                        $t_pat_paid = 0;
                        $t_payo_paid = 0;
                        foreach ($check_who_paid as $who_paid) {
                            $check_pt = Client::select('id', 'client_full_name', 'admin_id')
                                ->where('admin_id', $who_paid->admin_id)
                                ->where('client_full_name', $who_paid->who_paid)
                                ->first();

                            if ($check_pt) {
                                $t_pat_paid += $who_paid->payment;
                            } else {
                                $t_pat_paid += 0;
                            }

                            $check_payor = All_payor_detail::select('payor_name', 'admin_id')
                                ->where('admin_id', $who_paid->admin_id)
                                ->where('payor_name', $who_paid->who_paid)
                                ->first();

                            if ($check_payor) {
                                $t_payo_paid += $who_paid->payment;
                            } else {
                                $t_payo_paid += 0;
                            }
                        }   
                        $t_ins_p = 0;
                        $t_ins_p += $t_payo_paid;

                        $t_g_p = 0;
                        $t_g_p += $t_pat_paid;

                        $sub_total = $deposit_aplly_pay + $deposit_aplly_adj;
                        $balance = $billed_am - $sub_total;


                        if ($deposit_aplly_1) {
                            $total_am += $billed_am;
                            $total_pay += $deposit_aplly_pay;
                            $total_adj += $deposit_aplly_adj;
                            $total_bal += $balance;
                        } else {
                            $total_am += $line->billed_am;
                            $total_pay += 0.00;
                            $total_adj += 0.00;
                            $total_bal += $line->billed_am;
                        }

                        $patient_res = $copay + $coins + $deduct - $t_pat_paid;
                        $final_ins_bal=$total_bal-$patient_res;
                        $t_am += $total_am;
                        $t_adj += $total_adj;
                        $t_ins += $t_ins_p;
                        $t_bal += $total_bal;
                        $t_gaurantor += $t_g_p;
                        $t_paid += $total_pay;
                        $t_p_res += $patient_res;
                        $t_ins_balance += $final_ins_bal;

                    }

                    $billed_amount = '$' . number_format($t_am, 2);
                    $adjustment = '$' . number_format($t_adj, 2);
                    $allowed_amount = '$' . number_format($t_am, 2);
                    $gaurantor = '$' . number_format($t_gaurantor, 2); //done
                    $ins_paid = '$' . number_format($t_ins, 2);
                    // $sec_ins="";   //remove
                    $total_paid = '$' . number_format($t_paid, 2); //done
                    $patient_res = '$' . number_format($t_p_res, 2);//done
                    $ins_res = '$' . number_format($t_ins_balance, 2); //
                    $balance = '$' . number_format($t_bal, 2);
                    $percent = $t_am == 0 ? 0.00 : $t_ins_balance / $t_am * 100;
                    $percent = number_format(100 - $percent, 2) . '%';

                    $this->fpdf->Row(array($p_name, $billed_amount,$ins_paid, $adjustment, $patient_res, $gaurantor,$total_paid, $ins_res, $balance, $percent), 0, $w);

                    $t1 += $t_am;
                    $t5 += $t_ins;
                    $t2 += $t_adj;
                    $t7 += $t_p_res;
                    $t4 += $t_gaurantor;
                    // $t3 += $t_am;   //hide
                    $t6 += $t_paid;
                    $t8 += $t_ins_balance;
                    $t9 += $t_bal;
                }

                $tp = $t1 == 0 ? 0.00 : $t8 / $t1 * 100;
                $tp = number_format(100 - $tp, 2) . '%';
                $t1 = '$' . number_format($t1, 2);
                $t2 = '$' . number_format($t2, 2);
                $t3 = '$' . number_format($t3, 2);
                $t4 = '$' . number_format($t4, 2);
                $t5 = '$' . number_format($t5, 2);
                $t6 = '$' . number_format($t6, 2);
                $t7 = '$' . number_format($t7, 2);
                $t8 = '$' . number_format($t8, 2);
                $t9 = '$' . number_format($t9, 2);

                $this->fpdf->SetWidths(array(46, 26, 26, 26, 26, 26, 26, 26, 25, 24));
                $this->fpdf->Row(array("Total", $t1, $t5, $t2, $t7, $t4 , $t6, $t8, $t9, $tp), 4, $w);

                $path = public_path() . '/report/pdf/';
                $filename = $report->file_name . '.pdf';

                $this->fpdf->Output($path . $filename, 'F');
                $update_report = report_notification::where('id', $report->id)->first();
                $update_report->status = "Complete";
                $update_report->save();
            }
            else if($report->report_type=="33"){

                $combo_check=setting_name_location::select('admin_id','is_combo')->where('admin_id',$report->admin_id)->first();


                $i_ids=json_decode($report->extra);
                $date_from = Carbon::parse($report->form_date)->format('Y-m-d');
                $date_to = Carbon::parse($report->to_date)->format('Y-m-d');

                $d_from = Carbon::parse($date_from)->format('m/d/Y');
                $d_to = Carbon::parse($date_to)->format('m/d/Y');
                
                if (!$this->declare_PDF($d_from, $d_to, "insurance",$report->admin_id)) {
                    return false;
                }

                $this->fpdf->AddPage('L');
                $this->fpdf->SetFont('', '', 8);

                //Height of row
                $w = 7;

                /*
                $this->fpdf->SetFillColor(255,255,0);
                $this->fpdf->Cell(70,10,'As of 09/20/2021',1,1,'C','F');*/

                //Setting widths for rows
                $this->fpdf->SetWidths(array(46, 26, 26, 26, 26, 26, 26, 26, 25, 24));


                //Calling table heading
                $this->fpdf->Table3Heading();

                //Alignment of data rows
                $this->fpdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $t1 = 0;
                $t2 = 0;
                $t3 = 0;
                $t4 = 0;
                $t5 = 0;
                $t6 = 0;
                $t7 = 0;
                $t8 = 0;
                $t9 = 0;
                foreach ($i_ids as $id) {
                    $i_name = Payor_facility::select('payor_name')->where('payor_id', $id)->first();
                    $i_name = $i_name->payor_name;

                    $y = $this->fpdf->GetY();
                    $y = floor($y);
                    $y = $y + $w;

                    //Checking for page break and applying table header on every page.
                    if ($y >= 200) {
                        $this->fpdf->AddPage('L');
                        $this->fpdf->Table2Heading();
                        $this->fpdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                    }

                    $lines = ledger_list::where('admin_id', $this->admin_id)
                        ->where('payor_id', $id)
                        ->where('schedule_date', '>=', $date_from)
                        ->where('schedule_date', '<=', $date_to)
                        ->get();

                    $t_am = 0;
                    $t_adj = 0;
                    $t_ins = 0;
                    $t_bal = 0;
                    $t_gaurantor = 0;
                    $t_paid = 0;
                    $t_p_res = 0;
                    $t_ins_balance = 0;


                    foreach ($lines as $line) {

                        $total_am = 0;
                        $total_pay = 0;
                        $total_adj = 0;
                        $total_bal = 0;


                        if($combo_check->is_combo==1){

                            $copay = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('cpt',$line->cpt)->where('status', "PR Copay")->sum('balance');
                            $coins = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('cpt',$line->cpt)->where('status', "PR CoIns")->sum('balance');
                            $deduct = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('cpt',$line->cpt)->where('status', "PR Ded")->sum('balance');
                            $deposit_aplly_1 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $billed_am = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->sum('billed_am');
                            $check_dep_data = deposit_apply::distinct()->select('deopsit_id', 'appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $deposit_aplly_pay = deposit_apply::select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->sum('payment');

                            $deposit_aplly_adj = deposit_apply::select('appointment_id', 'dos', 'amount')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('cpt',$line->cpt)
                                ->where('admin_id', $line->admin_id)
                                ->sum('adjustment');

                            $v1 = "PR CoIns";
                            $v2 = "PR Copay";
                            $v3 = "PR Ded";

                            $check_who_paid = deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'dos', 'who_paid', 'client_id', 'payment')
                            ->where('batching_claim_id', $line->batching_id)
                            ->where('cpt',$line->cpt)
                            ->where('admin_id', $line->admin_id)
                            ->get();
                        }
                        else{

                            $copay = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('status', "PR Copay")->sum('balance');
                            $coins = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('status', "PR CoIns")->sum('balance');
                            $deduct = deposit_apply_transaction::where('batching_claim_id', $line->batching_id)->where('status', "PR Ded")->sum('balance');
                            $deposit_aplly_1 = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $billed_am = deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->sum('billed_am');
                            $check_dep_data = deposit_apply::distinct()->select('deopsit_id', 'appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->first();

                            $deposit_aplly_pay = deposit_apply::select('appointment_id', 'dos', 'admin_id')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->sum('payment');

                            $deposit_aplly_adj = deposit_apply::select('appointment_id', 'dos', 'amount')
                                ->where('appointment_id', $line->appointment_id)
                                ->where('dos', $line->schedule_date)
                                ->where('admin_id', $line->admin_id)
                                ->sum('adjustment');
                                
                            $v1 = "PR CoIns";
                            $v2 = "PR Copay";
                            $v3 = "PR Ded";

                            $check_who_paid = deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'dos', 'who_paid', 'client_id', 'payment')
                            ->where('batching_claim_id', $line->batching_id)
                            ->where('admin_id', $line->admin_id)
                            ->get();
                        }

                        $t_pat_paid = 0;
                        $t_payo_paid = 0;
                        foreach ($check_who_paid as $who_paid) {
                            $check_pt = Client::select('id', 'client_full_name', 'admin_id')
                                ->where('admin_id', $who_paid->admin_id)
                                ->where('client_full_name', $who_paid->who_paid)
                                ->first();

                            if ($check_pt) {
                                $t_pat_paid += $who_paid->payment;
                            } else {
                                $t_pat_paid += 0;
                            }

                            $check_payor = All_payor_detail::select('payor_name', 'admin_id')
                                ->where('admin_id', $who_paid->admin_id)
                                ->where('payor_name', $who_paid->who_paid)
                                ->first();

                            if ($check_payor) {
                                $t_payo_paid += $who_paid->payment;
                            } else {
                                $t_payo_paid += 0;
                            }
                        }   
                        $t_ins_p = 0;
                        $t_ins_p += $t_payo_paid;

                        $t_g_p = 0;
                        $t_g_p += $t_pat_paid;

                        $sub_total = $deposit_aplly_pay + $deposit_aplly_adj;
                        $balance = $billed_am - $sub_total;


                        if ($deposit_aplly_1) {
                            $total_am += $billed_am;
                            $total_pay += $deposit_aplly_pay;
                            $total_adj += $deposit_aplly_adj;
                            $total_bal += $balance;
                        } else {
                            $total_am += $line->billed_am;
                            $total_pay += 0.00;
                            $total_adj += 0.00;
                            $total_bal += $line->billed_am;
                        }

                        $patient_res = $copay + $coins + $deduct - $t_pat_paid;
                        $final_ins_bal=$total_bal-$patient_res;
                        $t_am += $total_am;
                        $t_adj += $total_adj;
                        $t_ins += $t_ins_p;
                        $t_bal += $total_bal;
                        $t_gaurantor += $t_g_p;
                        $t_paid += $total_pay;
                        $t_p_res += $patient_res;
                        $t_ins_balance += $final_ins_bal;

                    }

                    $billed_amount = '$' . number_format($t_am, 2);
                    $adjustment = '$' . number_format($t_adj, 2);
                    $allowed_amount = '$' . number_format($t_am, 2);
                    $gaurantor = '$' . number_format($t_gaurantor, 2); //done
                    $ins_paid = '$' . number_format($t_ins, 2);
                    // $sec_ins="";   //remove
                    $total_paid = '$' . number_format($t_paid, 2); //done
                    $patient_res = '$' . number_format($t_p_res, 2);//done
                    $ins_res = '$' . number_format($t_ins_balance, 2); //
                    $balance = '$' . number_format($t_bal, 2);
                    $percent = $t_am == 0 ? 0.00 : $t_ins_balance / $t_am * 100;
                    $percent = number_format(100 - $percent, 2) . '%';

                    $this->fpdf->SetWidths(array(46, 26, 26, 26, 26, 26, 26, 26, 25, 24));
                    $this->fpdf->Row(array($i_name, $billed_amount,$ins_paid, $adjustment, $patient_res, $gaurantor,$total_paid, $ins_res, $balance, $percent), 0, $w);

                    $t1 += $t_am;
                    $t5 += $t_ins;
                    $t2 += $t_adj;
                    $t7 += $t_p_res;
                    $t4 += $t_gaurantor;
                    // $t3 += $t_am;   //hide
                    $t6 += $t_paid;
                    $t8 += $t_ins_balance;
                    $t9 += $t_bal;
                }

                $tp = $t1 == 0 ? 0.00 : $t8 / $t1 * 100;
                $tp = number_format(100 - $tp, 2) . '%';
                $t1 = '$' . number_format($t1, 2);
                $t2 = '$' . number_format($t2, 2);
                $t3 = '$' . number_format($t3, 2);
                $t4 = '$' . number_format($t4, 2);
                $t5 = '$' . number_format($t5, 2);
                $t6 = '$' . number_format($t6, 2);
                $t7 = '$' . number_format($t7, 2);
                $t8 = '$' . number_format($t8, 2);
                $t9 = '$' . number_format($t9, 2);

                $this->fpdf->SetWidths(array(46, 26, 26, 26, 26, 26, 26, 26, 25, 24));
                $this->fpdf->Row(array("Total", $t1, $t5, $t2, $t7, $t4 , $t6, $t8, $t9, $tp), 4, $w);

                $path = public_path() . '/report/pdf/';
                $filename = $report->file_name . '.pdf';

                $this->fpdf->Output($path . $filename, 'F');
                $update_report = report_notification::where('id', $report->id)->first();
                $update_report->status = "Complete";
                $update_report->save();

            }
        }

    }
}
