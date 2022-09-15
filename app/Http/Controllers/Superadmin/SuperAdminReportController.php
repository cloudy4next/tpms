<?php

namespace App\Http\Controllers\Superadmin;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use ZipArchive;
use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class MYPDF extends FPDF
{

    var $widths;
    var $aligns;
    public $logo;
    public $name_location;
    public $check;

    public function __construct($logo, $name_location, $d_from, $d_to, $check)
    {
        parent::__construct();
        $this->d_from = $d_from;
        $this->d_to = $d_to;
        $this->logo = $logo;
        $this->name_location = $name_location;
        $this->check = $check;
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
        $this->Row(array('Billed Year', 'Billed  Month', 'Billed Amount', 'Adjustment', 'Allowed Amount', 'Guarantor Paid', 'Insurance Paid', 'Total Paid', 'Patient Resp.', 'Insurance Resp.', 'Balance', 'Collection Rate'), 3, 5);
    }

    function Table2Heading()
    {
        $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $this->Row(array('Patient Name', 'Billed Amount', 'Adjustment', 'Allowed Amount', 'Guarantor Paid', 'Insurance Paid', 'Total Paid', 'Patient Resp.', 'Insurance Resp.', 'Balance', 'Collection Rate'), 3, 5);
    }

    function Header()
    {

        $address = $this->name_location->address . ' ' . $this->name_location->address2;
        $address2 = $this->name_location->city . ', ' . $this->name_location->state . ' ' . $this->name_location->zip;

        $this->SetAutoPageBreak(false);
        $this->SetFont('helvetica', '', 10);

        if(Auth::user()->is_up_admin==1){
            $logo = general_setting::where('admin_id', Auth::user()->id)->first();
        }
        else{
            $logo = general_setting::where('admin_id', Auth::user()->up_admin_id)->first();
        }

        if (!empty($logo->logo) && file_exists($logo->logo)) {
            $this->Image($logo->logo, 15, 5, 20, 20);
        } else {

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


class SuperAdminReportController extends Controller
{

    protected $fpdf;

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

    public function declare_PDF($d_from, $d_to, $check)
    {

        $logo_obj = general_setting::where('admin_id', $this->admin_id)->first();
        $name_location = setting_name_location::where('admin_id', $this->admin_id)->first();

        if (!$logo_obj) {
            return false;
        } else {
            $this->fpdf = new MYPDF($logo_obj->logo, $name_location, $d_from, $d_to, $check);

            return true;
        }
    }

    public function report()
    {
        return view('superadmin.report.report');
    }


    public function report_export(Request $request)
    {
        // dd($request->all());
        $report_type = $request->report_type;
        $report_name = $request->client_report;
        $date_type = $request->date_type;
        if ($date_type == 1) {
            $single_date = $request->single_date;

        } else if ($date_type == 2) {
            $date_range = $request->date_range;
            $date_from = Carbon::parse(substr($date_range, 0, 10))->format('Y-m-d');
            $date_to = Carbon::parse(substr($date_range, 13, 24))->format('Y-m-d');
        }


        if ($report_type == 1) {
            $file_name = 'report-insurance-collection-' . Auth::user()->id . time();
            if (isset($request->f1_check)) {
                if (is_string($request->f1_check)) {
                    $arr[0] = $request->f1_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f1_check);
                }
            } else {
                $extra = NULL;
            }

        } elseif ($report_type == 2) {
            $file_name = 'Payment-Deposits-' . Auth::user()->id . time();
            if (isset($request->f2_check)) {
                if (is_string($request->f2_check)) {
                    $arr[0] = $request->f2_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f2_check);
                }
            } else {
                $extra = NULL;
            }

        } elseif ($report_type == 3) {
            $file_name = 'Payment-Deposit-Breakdown-' . Auth::user()->id . time();
            if (isset($request->f3_check)) {
                if (is_string($request->f3_check)) {
                    $arr[0] = $request->f3_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f3_check);
                }
            } else {
                $extra = NULL;
            }

        } elseif ($report_type == 4) {
            $file_name = 'Billed-Sessions-' . Auth::user()->id . time();
            if (isset($request->f4_check)) {
                if (is_string($request->f4_check)) {
                    $arr[0] = $request->f4_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f4_check);
                }
            } else {
                $extra = NULL;
            }

        } elseif ($report_type == 5) {
            $file_name = 'Sessions-Pending-Billing-' . Auth::user()->id . time();
            if (isset($request->f5_check)) {
                if (is_string($request->f5_check)) {
                    $arr[0] = $request->f5_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f5_check);
                }
            } else {
                $extra = NULL;
            }

        } elseif ($report_type == 6) {
            $file_name = 'Max-Total-Auth-Utilization-' . Auth::user()->id . time();
            if (isset($request->f6_check)) {
                if (is_string($request->f6_check)) {
                    $arr[0] = $request->f6_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f6_check);
                }
            } else {
                $extra = NULL;
            }

        } elseif ($report_type == 7) {
            $file_name = 'Authorization-Breakdown-' . Auth::user()->id . time();
            if (isset($request->f7_check)) {
                if (is_string($request->f7_check)) {
                    $arr[0] = $request->f7_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f7_check);
                }
            } else {
                $extra = NULL;
            }

        } elseif ($report_type == 8) {
            $file_name = 'Provider-Session-Notes-' . Auth::user()->id . time();
            if (isset($request->f8_check)) {
                if (is_string($request->f8_check)) {
                    $arr[0] = $request->f8_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f8_check);
                }
            } else {
                $extra = NULL;
            }

        } elseif ($report_type == 9) {
            $file_name = 'Schedule-' . Auth::user()->id . time();
            if (isset($request->f9_check)) {
                if (is_string($request->f9_check)) {
                    $arr[0] = $request->f9_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f9_check);
                }
            } else {
                $extra = NULL;
            }

        } elseif ($report_type == 10) {
            $file_name = 'Patient-Schedule-' . Auth::user()->id . time();
            if (isset($request->f10_check)) {
                if (is_string($request->f10_check)) {
                    $arr[0] = $request->f10_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f10_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 11) {
            $file_name = 'Staff Schedule-' . Auth::user()->id . time();
            if (isset($request->f11_check)) {
                if (is_string($request->f11_check)) {
                    $arr[0] = $request->f11_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f11_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 12) {
            $file_name = 'Schedule-Billable-' . Auth::user()->id . time();
            if (isset($request->f12_check)) {
                if (is_string($request->f12_check)) {
                    $arr[0] = $request->f12_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f12_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 13) {
            $file_name = 'AR-Ledger-with-Balance-' . Auth::user()->id . time();
            if (isset($request->f13_check)) {
                if (is_string($request->f13_check)) {
                    $arr[0] = $request->f13_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f13_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 14) {
            $file_name = 'Aging-by-IBD-(initial-billed-date)-' . Auth::user()->id . time();
            if (isset($request->f14_check)) {
                if (is_string($request->f14_check)) {
                    $arr[0] = $request->f14_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f14_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 15) {
            $file_name = 'Primary-AR-' . Auth::user()->id . time();
            if (isset($request->f15_check)) {
                if (is_string($request->f15_check)) {
                    $arr[0] = $request->f15_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f15_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 16) {
            $file_name = 'Payee-Rate-list-' . Auth::user()->id . time();
            if (isset($request->f16_check)) {
                if (is_string($request->f16_check)) {
                    $arr[0] = $request->f16_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f16_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 17) {
            $file_name = 'Patient-AR-Ledger-w-Note-Payee-' . Auth::user()->id . time();
            if (isset($request->f17_check)) {
                if (is_string($request->f17_check)) {
                    $arr[0] = $request->f17_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f17_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 18) {
            $file_name = 'Expired-Auths-' . Auth::user()->id . time();
            if (isset($request->f18_check)) {
                if (is_string($request->f18_check)) {
                    $arr[0] = $request->f18_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f18_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 19) {
            $file_name = 'Expiring-Auths-' . Auth::user()->id . time();
            if (isset($request->f19_check)) {
                if (is_string($request->f19_check)) {
                    $arr[0] = $request->f19_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f19_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 20) {
            $file_name = 'Patient-Responsibility-' . Auth::user()->id . time();
            if (isset($request->f20_check)) {
                if (is_string($request->f20_check)) {
                    $arr[0] = $request->f20_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f20_check);
                }
            } else {
                $extra = NULL;
            }
        } elseif ($report_type == 20) {
            $file_name = 'Patient-Responsibility-' . Auth::user()->id . time();
            if (isset($request->f20_check)) {
                if (is_string($request->f20_check)) {
                    $arr[0] = $request->f20_check;
                    $extra = json_encode($arr);
                } else {
                    $extra = json_encode($request->f20_check);
                }
            } else {
                $extra = NULL;
            }
        } else {
            $file_name = '';
        }

        $new_noti = new report_notification();
        $new_noti->admin_id = $this->admin_id;
        $new_noti->name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $new_noti->notification_date = Carbon::now();
        $new_noti->file_name = $file_name;
        $new_noti->report_type = $report_type;
        $new_noti->report_name = "report";
        $new_noti->date_type = $date_type;
        $new_noti->form_date = isset($date_from) ? $date_from : null;
        $new_noti->to_date = isset($date_to) ? $date_to : null;
        $new_noti->s_date = isset($single_date) ? $single_date : null;
        $new_noti->extra = $extra;
        $new_noti->status = "Pending";
        $new_noti->type = 1;
        $new_noti->save();

        return redirect()->back()->with('success', 'Your File is generating. Once done you get notification');

    }

    public function report13Generate(Request $request)
    {

        if (isset($request->single_date)) {
            $single_date = $request->single_date;
            $ledger_lists = ledger_list::where('admin_id', '1')->where('schedule_date','=',$single_date)->get()->toArray();

        } else{
            $date_range = $request->daterange;
            $date_from = Carbon::parse(substr($date_range, 0, 10))->format('Y-m-d');
            $date_to = Carbon::parse(substr($date_range, 13, 24))->format('Y-m-d');

            $ledger_lists = ledger_list::where('admin_id', '1')
                ->where('schedule_date', '>=', $date_from)
                ->where('schedule_date', '<=',  $date_to)
                ->get()->toArray();
        }


        $ledger_lists = $this->arrayPaginator($ledger_lists, $request);
        return response()->json([
            'notices' => $ledger_lists,
            'view' => View::make('superadmin.report.include.report_table', compact('ledger_lists'))->render(),
            'pagination' => (string)$ledger_lists->links(),
            'count_ses' => count($ledger_lists),
        ]);
    }


    public function report13GenerateGet(Request $request)
    {

        if (isset($request->single_date)) {
            $single_date = $request->single_date;
            $ledger_lists = ledger_list::where('admin_id', '1')->where('schedule_date','=',$single_date)->get()->toArray();

        } else{
            $date_range = $request->daterange;
            $date_from = Carbon::parse(substr($date_range, 0, 10))->format('Y-m-d');
            $date_to = Carbon::parse(substr($date_range, 13, 24))->format('Y-m-d');

            $ledger_lists = ledger_list::where('admin_id', '1')
                ->where('schedule_date', '>=', $date_from)
                ->where('schedule_date', '<=',  $date_to)
                ->get()->toArray();
        }


        $ledger_lists = $this->arrayPaginator($ledger_lists, $request);
        return response()->json([
            'notices' => $ledger_lists,
            'view' => View::make('superadmin.report.include.report_table', compact('ledger_lists'))->render(),
        ]);

    }

    public function report_export_view()
    {
        $all_report_export = report_notification::where('admin_id', $this->admin_id)->orderBy('id', 'desc')->paginate(15);

        return view('superadmin.report.exporReportView', compact('all_report_export'));
    }


    public function report_export_download(Request $request)
    {
        $repport = report_notification::where('admin_id', $this->admin_id)->where('id', $request->report_id)->first();

        $pass = $request->password;
        $cpass = $request->confirm_password;
        if ($repport) {

            if ($pass != null && $cpass != null) {
                $zip = new ZipArchive();
                $password = "12345678";
                if($repport->report_name=="kpi"){

                    $download_file = public_path("report/pdf/" . $repport->file_name . ".pdf");
                }
                else{
                    $download_file = public_path("report/" . $repport->file_name . ".csv");
                }
                if (file_exists($download_file)) {
                    $fileName = "report" . time() . ".zip";
                    $zip = new ZipArchive();
                    if($repport->report_name=="kpi"){
                        $zip->open(public_path('report/pdf/' . $fileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);
                    }
                    else{
                        $zip->open(public_path('report/' . $fileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);
                    }
                    $alluser = report_notification::where('id', $request->report_id)->get();
                    //                    $zip->setPassword('123456');
                    $zip->setPassword($pass);
                    foreach ($alluser as $row) {
                        if($repport->report_name=="kpi"){
                            $filename = basename($row->file_name . ".pdf");
                            $zip->addFile(public_path("report/pdf/" . $row->file_name . ".pdf"), $filename);
                        }
                        else{
                            $filename = basename($row->file_name . ".csv");
                            $zip->addFile(public_path("report/" . $row->file_name . ".csv"), $filename);
                        }
                        $zip->setEncryptionName($filename, ZipArchive::EM_AES_256);
                    }
                    $zip->close();

                    if($repport->report_name="kpi"){
                        return Response::download(public_path('report/pdf/' . $fileName));
                    }
                    else{
                        return Response::download(public_path('report/' . $fileName));

                    }
                } else {
                    return back()->with('alert', 'File Not Found');
                }
            } else {

                if ($repport->report_name == 'edi') {
                    $gen = setting_name_location::where('admin_id', $this->admin_id)->first();


                    $download_file = public_path("edi/" . $repport->file_name);
                    $download_file_sftp = public_path("sftp/inbound/" . $gen->ftp_username . '/' . $repport->file_name);

                    if (file_exists($download_file)) {
                        return Response::download($download_file);
                    } elseif (file_exists($download_file_sftp)) {
                        return Response::download($download_file_sftp);
                    } else {
                        return back()->with('alert', 'File Not Found');
                    }
                } else {
                    if($repport->report_name=="kpi"){
                        $download_file = public_path("report/pdf/" . $repport->file_name . ".pdf");
                        if (file_exists($download_file)) {
                            return Response::download($download_file);
                        } else {
                            return back()->with('alert', 'File Not Found');
                        }
                    }
                    else{
                        $download_file = public_path("report/" . $repport->file_name . ".csv");
                        if (file_exists($download_file)) {
                            return Response::download($download_file);
                        } else {
                            return back()->with('alert', 'File Not Found');
                        }
                    }
                }
            }
        } else {
            return back()->with('alert', 'File Not Found');
        }

    }

    public function kpi_report_by_months_view()
    {
        return view('superadmin.report.kpi_month');
    }


    public function kpi_report_by_months(Request $request)
    {

        $date_range = $request->date_range;
        $date_from = Carbon::parse(substr($date_range, 0, 10))->format('Y-m-d');
        $date_to = Carbon::parse(substr($date_range, 13, 24))->format('Y-m-d');
        $file_name = 'KPI-REPORT-BY-MONTH-' . Auth::user()->id . time();

        $new_noti = new report_notification();
        $new_noti->admin_id = $this->admin_id;
        $new_noti->name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $new_noti->notification_date = Carbon::now();
        $new_noti->file_name = $file_name;
        $new_noti->report_type = "31";
        $new_noti->report_name = "kpi";
        $new_noti->date_type = null;
        $new_noti->form_date = $date_from;
        $new_noti->to_date = $date_to;
        $new_noti->s_date = null;
        $new_noti->extra = null;
        $new_noti->status = "Pending";
        $new_noti->type = 1;
        $new_noti->save();

        return "success";
    }

    public function kpi_report_by_patient_view()
    {
        return view('superadmin.report.kpi_patient');
    }

    public function kpi_report_by_patient(Request $request)
    {

        // $p_ids = json_decode($request->client_id);

        $date_range = $request->date_range;
        $date_from = Carbon::parse(substr($date_range, 0, 10))->format('Y-m-d');
        $date_to = Carbon::parse(substr($date_range, 13, 24))->format('Y-m-d');
        $file_name = 'KPI-REPORT-BY-PATIENT-' . Auth::user()->id . time();

        $new_noti = new report_notification();
        $new_noti->admin_id = $this->admin_id;
        $new_noti->name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $new_noti->notification_date = Carbon::now();
        $new_noti->file_name = $file_name;
        $new_noti->report_type = "32";
        $new_noti->report_name = "kpi";
        $new_noti->date_type = null;
        $new_noti->form_date = isset($date_from) ? $date_from : null;
        $new_noti->to_date = isset($date_to) ? $date_to : null;
        $new_noti->s_date = null;
        $new_noti->extra = $request->client_id;
        $new_noti->status = "Pending";
        $new_noti->type = 1;
        $new_noti->save();

        return "success";
    }

    public function kpi_report_by_insurance_view()
    {
        return view('superadmin.report.kpi_insurance');
    }

    public function kpi_report_by_insurance(Request $request)
    {

        $date_range = $request->date_range;
        $date_from = Carbon::parse(substr($date_range, 0, 10))->format('Y-m-d');
        $date_to = Carbon::parse(substr($date_range, 13, 24))->format('Y-m-d');
        $file_name = 'KPI-REPORT-BY-INSURANCE-' . Auth::user()->id . time();

        $new_noti = new report_notification();
        $new_noti->admin_id = $this->admin_id;
        $new_noti->name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $new_noti->notification_date = Carbon::now();
        $new_noti->file_name = $file_name;
        $new_noti->report_type = "33";
        $new_noti->report_name = "kpi";
        $new_noti->date_type = null;
        $new_noti->form_date = isset($date_from) ? $date_from : null;
        $new_noti->to_date = isset($date_to) ? $date_to : null;
        $new_noti->s_date = null;
        $new_noti->extra = $request->insurance_id;
        $new_noti->status = "Pending";
        $new_noti->type = 1;
        $new_noti->save();

        return "success";
        return redirect()->back()->with('success', '');
    }


    public function open_pdf_by_ajax(Request $request)
    {
        $file_path = $request->file_path;
        // Send Headers
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="myPDF.pdf');

        // Send Headers: Prevent Caching of File
        header('Cache-Control: private');
        header('Pragma: private');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

        $file = $file_path;
        readfile(public_path() . '/report/pdf/' . $file);
    }


    public function report_download_by_mail($id)
    {
        $report_name = $id;
        $file = public_path('report/' . $report_name);
        if (file_exists($file)) {
            $headers = [
                'Content-Type' => 'application/csv',
            ];

            return response()->download($file, $report_name, $headers);
        } else {
            return "No file found";
        }

    }

    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 20;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true),
            count($array),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }

}
