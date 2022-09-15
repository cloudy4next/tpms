<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Models\Appoinment_signature;
use App\Models\usf_one_form;
use App\Models\dsptn_two_form;
use App\Models\btsmf_three_form;
use App\Models\btusf_four_form;
use App\Models\msn_five_form;
use App\Models\tcsn_fix_form;
use App\Models\ct_seven_form;
use App\Models\ct_seven2_form;
use App\Models\tp_eight_form;
use App\Models\pc_nine_form;
use App\Models\pc_nine2_form;
use App\Models\ot_ten_form;
use App\Models\cn_eleven_form;
use App\Models\pt_twelve_form;
use App\Models\sn_thirteen_form;
use App\Models\register_fourteen_form;
use App\Models\register2_fifteen_form;
use App\Models\sp_sixteen_form;
use App\Models\sp_sixteen2_form;
use App\Models\sp_sixteen3_form;
use App\Models\cp_seventeen_form;
use App\Models\cp_eighteen_form;
use App\Models\cp_ninteen_form;
use App\Models\gs_twenty_form;
use App\Models\gs_twentyone_form;
use App\Models\gs_twentytwo_form;
use App\Models\gs_twentythree_form;
use App\Models\bio_twentyfour_form;
use App\Models\bio_twentyfour2_form;
use App\Models\bio_twentyfour3_form;
use App\Models\bio_twentyfour4_form;
use App\Models\bio_twentyfour5_form;
use App\Models\bio_twentyfour6_form;
use App\Models\birp_twentyfive_form;
use App\Models\birp_twentyfive2_form;
use App\Models\dis_twentysix_form;
use App\Models\lpro_twentyseven_form;
use App\Models\ls_twentyeight_form;
use App\Models\dia_twentynine_form;
use App\Models\ds_thirty1_form;
use App\Models\ds_thirty2_form;
use App\Models\ds_thirty3_form;
use App\Models\ds_thirty4_form;
use App\Models\ds_thirty5_form;
use App\Models\ds_thirty6_form;
use App\Models\ds_thirty7_form;
use App\Models\ds_thirty8_form;
use App\Models\ds_thirty9_form;
use App\Models\ds_thirty10_form;
use App\Models\ds_thirty11_form;
use App\Models\ds_thirty12_form;
use App\Models\general_setting;
use App\Models\setting_name_location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Http\Lib\extended2;

class Health_PDF extends Fpdf
{


    private $i = 0;
    var $widths;
    var $aligns;
    var $check;
    var $checkVar;
    public $logo;
    public $name_location;

    public function __construct($logo, $name_location)
    {
        parent::__construct();
        $this->logo = $logo;
        $this->name_location = $name_location;
    }
    function THead($txt)
    {
        $this->SetFillColor(32, 122, 199);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('OpenSans', 'B', 12);
        $this->Cell(0, 5, $txt, 1, 1, 'C', true);
        $this->SetTextColor(0, 0, 0);
    }
    function Header()
    {
        $address = $this->name_location->address . ' ' . $this->name_location->city . ', ' . $this->name_location->state . ' ' . $this->name_location->zip;
        $this->SetAutoPageBreak(true, 10);
        $this->SetFont('Arial', 'B', 24);
        $this->SetFillColor(32, 122, 199);
        $this->Rect(0, 0, 210, 300, 'F');
        $this->SetFillColor(255, 255, 255);
        $this->SetDrawColor(217, 83, 79);
        $this->Rect(5, 5, 200, 287, 'F');
        if ($this->logo != 'empty') {
            $this->Image($this->logo, 10, 7, 60, 25);
        }
        $this->Line(10, 35, 200, 35);
        $this->SetXY(110, 10);
        $this->HeadingText('blue');
        $this->Cell(13, 5, 'Mail:', 0, 0);
        $this->NormalText();
        $this->MultiCell(0, 5, $address, 0, 'L');
        $this->SetX(110);
        $this->HeadingText('blue');
        $this->Cell(13, 5, 'Email:', 0, 0);
        $this->NormalText();
        $this->MultiCell(0, 5, $this->name_location->email);
        $this->SetX(110);
        $this->HeadingText('blue');
        $this->Cell(13, 5, 'Phone:', 0, 0);
        $this->NormalText();
        $this->MultiCell(0, 5, $this->name_location->phone_one);
        $this->SetXY(10, 30);
        /*$this->SetX(110);
        $this->HeadingText('blue');
        $this->Cell(13,5,'Fax:',0,0);
        $this->NormalText();
        $this->MultiCell(0,5,$this->name_location->phone);*/
        if ($this->PageNo() == 1) {
            $this->Ln(5);
        } else {
            $this->Ln(15);
        }
        $this->SetFillColor(32, 122, 199);
    }
    function CustomFooter()
    {
        $address = $this->name_location->address . ' ' . $this->name_location->city . ', ' . $this->name_location->state . ' ' . $this->name_location->zip;
        $this->Ln(2);
        if ($this->GetY() > 282) {
            $this->AddPage();
        }
        $this->SetDrawColor(217, 83, 79);
        $this->SetY(-15);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->HeadingText();
        $this->Cell(66, 5, $this->name_location->facility_name, 0, 0, 'L');
        $this->NormalText();
        $this->Cell(0, 5, $address, 0, 1, 'R');
    }
    function Title($string, $size = 13)
    {
        $this->SetTextColor(217, 83, 79);
        $this->SetFont('Opensans', 'B', $size);
        $this->Cell(0, 10, $string, 0, 1, 'C');
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(217, 83, 79);
        $this->SetLineWidth(1);
        $y = $this->GetY();
        $this->Line(95, $y, 115, $y);
        $this->SetLineWidth(0.2);
        $this->Ln(5);
        $this->SetFillColor(32, 122, 199);
    }
    function HeadingText($color = 'black', $style = "B", $size = 10)
    {
        $this->SetDrawColor(32, 122, 199);
        $this->SetLineWidth(0.5);
        if ($color == 'black') {
            $this->SetTextColor(0, 0, 0);
        } else if ($color == 'brown') {
            $this->SetTextColor(217, 83, 79);
        } else if ($color == 'white') {
            $this->SetTextColor(255, 255, 255);
        } else {
            $this->SetTextColor(32, 122, 199);
        }

        if ($style == "B") {
            $this->SetFont('OpenSans', 'B', $size);
        } else {
            $this->SetFont('OpenSans', 'BI', $size);
        }
    }
    function NormalText()
    {
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('OpenSans', '', 10);
    }
    function CodeBlock($title, $txt)
    {
        $txt = '              ' . $txt;
        $this->Ln(5);

        if ($this->GetY() >= 275) {
            $this->AddPage();
        }
        $this->SetLeftMargin(10);
        $this->HeadingText('blue', 'B');
        $this->Cell(0, 10, $title, 'LTR', 1);
        $sign = $this->HeightCalculator(190, 5, $txt);
        $this->BottomLine($sign);
        $this->NormalText();
        $this->MultiCell(0, 5, $txt, 'LBR');
        $this->HeadingText('blue', 'B');
        $this->Heading($sign, $title);
    }

    function CC($title, $txt, $hc = 'black', $st = 'B', $sz = 10, $h2 = '', $h2c = 'brown', $st2 = 'I', $sz2 = 8.5)
    {

        $txt = '        ' . $txt;
        $this->Ln(5);

        $eh = 10;

        if ($h2 !== '') {
            $this->SetFont('', '', $sz2);
            $h2h = $this->GetMultiCellHeight(180, 5, $h2);
            $eh = $eh + $h2h;
        }

        if ($this->GetY() >= 285 - $eh) {
            $this->AddPage();
        }
        $this->SetLeftMargin(12.5);
        $this->SetRightMargin(12.5);
        $this->HeadingText($hc, $st, $sz);
        $this->Cell(0, 10, $title, 0, 1);
        if ($h2 !== '') {
            $this->HeadingText($h2c, $st2, $sz2);
            $this->MultiCell(0, 5, $h2, 0, 1);
        }
        $y1 = $this->GetY();
        $this->NormalText();

        $check = $this->HC(185, 5, $txt);
        if ($check["sign"] == true) {
            $h = $check["h"];
            $y2 = 285 + 5;
            $this->Rect(10, $y1 - $eh, 190, $y2 - $y1 + $eh);
            $this->MultiCell(0, 5, $txt);
            $y = 285 - $y1;
            $hr = $h - $y;
            $ty = $this->GetY();
            $this->SetY($this->GetY() - $hr - 10);
            $this->HeadingText($hc, $st, $sz);
            $this->Cell(0, 10, $title, 0, 1);
            $this->Rect(10, 40, 190, $hr + 5 + 10);
            $this->SetY($ty + 5);
        } else {
            $this->MultiCell(0, 5, $txt);
            $this->SetY($this->GetY() + 5);
            $y2 = $this->GetY();
            $this->Rect(10, $y1 - $eh, 190, $y2 - $y1 + $eh);
        }

        $this->SetLeftMargin(10);
        $this->SetRightMargin(10);
    }

    function AddingFonts()
    {
        $this->AddFont('Opensans', '', 'OpenSans-Regular.php');
        $this->AddFont('Opensans', 'B', 'OpenSans-Bold.php');
        $this->AddFont('Opensans', 'I', 'OpenSans-Italic.php');
        $this->AddFont('Opensans', 'BI', 'OpenSans-BoldItalic.php');
    }
    function HeightCalculator($w, $h, $txt)
    {
        global $sign;
        $ch = $this->GetMultiCellHeight($w, $h, $txt);
        $y = $this->GetY();
        if (285 - $y < $ch) {
            $sign = true;
        } else {
            $sign = false;
        }
        return $sign;
    }

    function HC($w, $h, $txt)
    {
        global $sign;
        $ch = $this->GetMultiCellHeight($w, $h, $txt);
        $y = $this->GetY();
        if (285 - $y < $ch) {
            $sign = true;
        } else {
            $sign = false;
        }
        return array("sign" => $sign, "h" => $ch);
    }

    function Heading($sign, $string)
    {
        if ($sign) {
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetXY(10, 40);
            $this->Cell(0, 10, $string, 'LTR');
            $this->SetXY($x, $y);
        }
    }

    function BottomLine($sign)
    {
        if ($sign) {
            $this->Line(10, 285, 200, 285);
        }
    }

    function DrawLine()
    {
        $this->SetDrawColor(32, 122, 199);
        $this->SetLineWidth(0.7);
        $y = $this->GetY();
        $this->Line(10, $y, 200, $y);
        $this->Ln(2);
    }

    function DrawBoldLine()
    {
        $this->SetLineWidth(2);
        $this->Ln(13);
        $y = $this->GetY();
        $y = $y - 2;
        $this->Line(0, $y, 210, $y);
    }

    function GetMultiCellHeight($w, $h, $txt, $border = null, $align = 'J')
    {
        // Calculate MultiCell with automatic or explicit line breaks height
        // $border is un-used, but I kept it in the parameters to keep the call
        //   to this function consistent with MultiCell()
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $ns = 0;
        $height = 0;
        while ($i < $nb) {
            // Get next character
            $c = $s[$i];
            if ($c == "\n") {
                // Explicit line break
                if ($this->ws > 0) {
                    $this->ws = 0;
                    $this->_out('0 Tw');
                }
                //Increase Height
                $height += $h;
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
                $ls = $l;
                $ns++;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                // Automatic line break
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                    if ($this->ws > 0) {
                        $this->ws = 0;
                        $this->_out('0 Tw');
                    }
                    //Increase Height
                    $height += $h;
                } else {
                    if ($align == 'J') {
                        $this->ws = ($ns > 1) ? ($wmax - $ls) / 1000 * $this->FontSize / ($ns - 1) : 0;
                        $this->_out(sprintf('%.3F Tw', $this->ws * $this->k));
                    }
                    //Increase Height
                    $height += $h;
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
            } else
                $i++;
        }
        // Last chunk
        if ($this->ws > 0) {
            $this->ws = 0;
            $this->_out('0 Tw');
        }
        //Increase Height
        $height += $h;

        return $height;
    }

    function CustomCheck($check = false, $checkVar = 0)
    {
        $this->check = $check;
        $this->checkVar = $checkVar;
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

    function Row($data)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            if ($this->check == true) {
                if ($i == 0 || $i == 2) {
                    if ($this->checkVar == 0) {
                        $this->SetFont('OpenSans', '', 10);
                    } else if ($this->checkVar == 1) {
                        $this->SetFont('OpenSans', 'B', 10);
                    }
                } else {
                    if ($this->checkVar == 0) {
                        $this->SetFont('OpenSans', 'B', 10);
                    } else if ($this->checkVar == 1) {
                        $this->SetFont('OpenSans', '', 10);
                    }
                }
            }
            $this->MultiCell($w, 5, $data[$i], 0, $a);
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
        $cw = &$this->CurrentFont['cw'];
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

    function ds_box($arr, $check)
    {
        if ($check == 1) {
            $this->Ln();
        } else {
            $this->SetXY(110, $this->GetY() - 35);
        }
        $this->HeadingText('white');
        $this->Cell(18, 5, 'Program', 1, 0, '', true);
        $this->NormalText();
        $this->Cell(72, 5, $arr["v1"], 1, 1, '');

        if ($check == 2) {
            $this->SetX(110);
        }

        $this->HeadingText('white');
        $this->Cell(18, 5, 'Target', 1, 0, '', true);
        $this->NormalText();
        $this->Cell(72, 5, $arr["v2"], 1, 1, '');

        if ($check == 2) {
            $this->SetX(110);
        }


        $this->NormalText();
        $this->Cell(11, 5, $arr["v3"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+1', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v4"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+2', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v5"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+3', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v6"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+4', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v7"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+5', 1, 1, '', true);
        if ($check == 2) {
            $this->SetX(110);
        }


        $this->NormalText();
        $this->Cell(11, 5, $arr["v8"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+6', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v9"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+7', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v10"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+8', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v11"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+9', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v12"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+10', 1, 1, '', true);

        if ($check == 2) {
            $this->SetX(110);
        }

        $this->NormalText();
        $this->Cell(11, 5, $arr["v13"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+11', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v14"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+12', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v15"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+13', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v16"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+14', 1, 0, '', true);

        $this->NormalText();
        $this->Cell(11, 5, $arr["v17"], 1);
        $this->HeadingText('white');
        $this->Cell(7, 5, '+15', 1, 1, '', true);

        if ($check == 2) {
            $this->SetX(110);
        }


        $this->HeadingText('white');
        $this->Cell(18, 5, 'Total:', 1, 0, '', true);
        $this->NormalText();
        $this->Cell(29, 5, $arr["v18"], 1);

        $this->HeadingText('white');
        $this->Cell(7, 5, '/', 1, 0, 'C', true);
        $this->NormalText();
        $this->Cell(36, 5, $arr["v19"], 1, 1);

        if ($check == 2) {
            $this->SetX(110);
        }

        $this->HeadingText('black');
        $this->Cell(19, 5, '=', 'LTB', 0, 'R');
        $this->NormalText();
        $this->Cell(71, 5, $arr["v20"], 'TBR', 1);
    }

    function ds_box2($arr, $check)
    {
        if ($check == 1) {
            $this->Ln();
        }
        if ($check == 2) {
            $this->SetXY(75, $this->GetY() - 65);
        }
        if ($check == 3) {
            $this->SetXY(140, $this->GetY() - 65);
        }

        $this->HeadingText('white');
        $this->Cell(60, 5, 'Task Analysis', 1, 1, '', true);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }
        $this->HeadingText('black');
        $this->Cell(60, 5, $arr["v1"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }
        $this->NormalText();
        $this->Cell(45, 5, $arr["v2"], 1);
        $this->Cell(15, 5, $arr["v12"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }

        $this->Cell(45, 5, $arr["v3"], 1);
        $this->Cell(15, 5, $arr["v13"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }

        $this->Cell(45, 5, $arr["v4"], 1);
        $this->Cell(15, 5, $arr["v14"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }

        $this->Cell(45, 5, $arr["v5"], 1);
        $this->Cell(15, 5, $arr["v15"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }

        $this->Cell(45, 5, $arr["v6"], 1);
        $this->Cell(15, 5, $arr["v16"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }

        $this->Cell(45, 5, $arr["v7"], 1);
        $this->Cell(15, 5, $arr["v17"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }

        $this->Cell(45, 5, $arr["v8"], 1);
        $this->Cell(15, 5, $arr["v18"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }

        $this->Cell(45, 5, $arr["v9"], 1);
        $this->Cell(15, 5, $arr["v19"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }

        $this->Cell(45, 5, $arr["v10"], 1);
        $this->Cell(15, 5, $arr["v20"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }

        $this->Cell(45, 5, $arr["v11"], 1);
        $this->Cell(15, 5, $arr["v21"], 1, 1);
        if ($check == 2) {
            $this->SetX(75);
        }
        if ($check == 3) {
            $this->SetX(140);
        }

        $this->HeadingText('white');
        $this->Cell(15, 5, 'Total:', 1, 0, '', true);
        $this->HeadingText('black');
        $this->Cell(45, 5, $arr["v22"], 1, 1);
    }

    function print_sig($data,$session_id){

        if($data->signature == "from_session"){
            $pro_sig=Appoinment_signature::select('id','session_id','signature','user_type','sign_time_pro')->where('session_id',$session_id)->where('user_type',2)->first();
            if($pro_sig){
                $data->signature= $pro_sig->signature;
                $pro_date=Carbon::parse($pro_sig->sign_time_pro)->format('m/d/Y');
            }
            else{
                $pro_date='';
            }
        }
        else if ($data->signature== null){
            $pro_date='';
        }
        else{
            $pro_sig=Appoinment_signature::select('id','session_id','user_type','sign_time_pro')->where('session_id',$session_id)->where('user_type',2)->first();
            if($pro_sig){
                $pro_date=Carbon::parse($pro_sig->sign_time_pro)->format('m/d/Y');
            }
            else{
                $pro_date=Carbon::parse($data->updated_at)->format('m/d/Y');
            }
        }


        if ($data->updload_sign == "from_session") {
            $care_sig = Appoinment_signature::select('session_id', 'signature', 'sign_time', 'user_type')->where('session_id', $session_id)->where('user_type', 1)->first();
            if ($care_sig) {
                $data->updload_sign = $care_sig->signature;
                $care_date = Carbon::parse($care_sig->sign_time)->format('m/d/Y');
            } else {
                $care_date = '';
            }
        } else if ($data->updload_sign == null) {
            $care_date = '';
        } else {
            $care_sig = Appoinment_signature::select('session_id', 'sign_time', 'user_type')->where('session_id', $session_id)->where('user_type', 1)->first();
            if ($care_sig) {
                $care_date = Carbon::parse($care_sig->sign_time)->format('m/d/Y');
            } else {
                $care_date = Carbon::parse($data->updated_at)->format('m/d/Y');
            }
        }

        $data->save();


        if ($data->signature != null || $data->updload_sign != null) {

            if ($this->GetY() > 247) {
                $this->AddPage();
            }

            $this->Ln(5);

            if ($data->signature != "from_session" && $data->signature != null && $data->signature != '') {
                $this->Image(public_path('/') . $data->signature, 25, $this->GetY(), 40, 20);
            }

            if ($data->updload_sign != "from_session" && $data->updload_sign != null && $data->updload_sign != '') {
                $this->Image(public_path('/') . $data->updload_sign, 140, $this->GetY(), 40, 20);
            }

            $this->SetXY(10, $this->GetY() + 25);
            $this->HeadingText('blue');
            $this->Cell(40, 5, 'Provider\'s Signature', 'T');
            $this->NormalText();
            $this->Cell(30, 5, ' (' . $pro_date . ')', 'T');

            $this->Cell(45, 5, '');
            $this->HeadingText('blue');
            $this->Cell(40, 5, 'Caregiver\'s Signature', 'T');
            $this->NormalText();
            $this->Cell(30, 5, ' (' . $care_date . ')', 'T');
        }
    }
}


class SuperAdminPDFController extends Controller
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

    public function declare_PDF()
    {
        $logo_obj = general_setting::where('admin_id', $this->admin_id)->first();
        $name_location = setting_name_location::where('admin_id', $this->admin_id)->first();

        if ($logo_obj && file_exists($logo_obj->logo)) {
            $this->fpdf = new Health_PDF($logo_obj->logo, $name_location);
            $this->fpdf->AddingFonts();
            $this->fpdf->AddPage();
            return true;
        } else {
            $this->fpdf = new Health_PDF('empty', $name_location);
            $this->fpdf->AddingFonts();
            $this->fpdf->AddPage();
            return false;
        }
    }


    //Form 1

    public function unique_supervision(Request $request)
    {
        $data = usf_one_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if ($this->declare_PDF() == false) {
            // return back()->with("alert","Please upload logo to proceed!");
            // exit();
        }

        $this->fpdf->Title('UNIQUE SUPERVISION FORM');

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(17, 5, 'Trainee:');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(78, 5, $data->tr_name);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(22, 5, 'Supervisor:');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->supervisor, 0, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(20, 5, 'Start Time:');
        $this->fpdf->NormalText();
        $time = Carbon::parse($data->starttm)->format('h:i A');
        $this->fpdf->Cell(40, 5, $time);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(20, 5, 'End Time:');
        $this->fpdf->NormalText();
        $time = Carbon::parse($data->endtime)->format('h:i A');
        $this->fpdf->Cell(40, 5, $time);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(12, 5, 'Date:');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->stdate)->format('m-d-Y'), 0, 1);
        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->Ln(5);
        $this->fpdf->THead('INDEPENDENT HOURS');

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(32, 5, 'Experience Type:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->exptyp, 1, 1);

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(32, 5, 'Setting Name:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(95, 5, $data->stgname, 1);

        if ($data->actcat == 1) $txt = "Restricted";
        else $txt = "Unrestricted";


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(33, 5, 'Activity Category:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1, 'C');

        $this->fpdf->CC('Activity Note(Client Initials)', $data->actnote);


        $this->fpdf->Ln(5);
        if ($this->fpdf->GetY() > 270) {
            $this->fpdf->AddPage();
        }
        $this->fpdf->THead('MONTH SUPERVISION PERIOD');

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(50, 5, 'Total Hours of Supervision:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, Carbon::parse($data->tlhrs)->format('h:m A'), 1, 0, 'C');

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(49, 5, 'Total Number of Contacts:', 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(14, 5, $data->tlcon, 1, 0, 'C');

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(20, 5, 'Individual:', 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->individual, 1, 1, 'C');

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(15, 5, 'Group:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, $data->group2, 1);

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(105, 5, 'Total number of Observations of the Trainee with Clients:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->traineewithclnt, 1, 1, 'C');

        $this->fpdf->Ln(5);
        if ($this->fpdf->GetY() > 260) {
            $this->fpdf->AddPage();
        }
        $this->fpdf->THead('SUPERVISED HOURS');

        if ($data->formate == 1) $txt = "Person";
        else $txt = "Online";

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(17, 5, 'Format:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $txt, 1, 0, 'C');


        if ($data->supervisiontype == 1) $txt = "Individual";
        else $txt = "Group";

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(33, 5, 'Supervision Type:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(29, 5, $txt, 1, 0, 'C');

        if ($data->actcat2 == 1) $txt = "Restricted";
        else $txt = "Unrestricted";

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(36, 5, 'Activity Category:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1, 'C');

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(32, 5, 'Experience Type:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(67, 5, $data->experience2, 1);

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(36, 5, 'BST-Task List Item:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->bsttask, 1, 1);

        $this->fpdf->CC('Summary of Supervision Activities:', $data->sumsup);
        $this->fpdf->CC('Supervisor Feedback:', $data->supfeed);
        $this->fpdf->CC('Action Items (Homework/research):', $data->actitem);

        if ($this->fpdf->GetY() > 247) {
            $this->fpdf->AddPage();
        }


        $this->fpdf->Ln(5);

        if ($data->signature != null) {
            $this->fpdf->Image(public_path('/') . $data->signature, 25, $this->fpdf->GetY(), 40, 20);
        }
        if ($data->updload_sign != null) {
            $this->fpdf->Image(public_path('/') . $data->updload_sign, 140, $this->fpdf->GetY(), 40, 20);
        }


        $this->fpdf->SetXY(10, $this->fpdf->GetY() + 25);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Supervisee/BACB ID#', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $data->bcbaid, 'T');
        $this->fpdf->Cell(30, 5, ' (' . Carbon::parse($data->signdate)->format('m-d-Y') . ')', 'T');

        $this->fpdf->Cell(12, 5, '');
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Supervisor/BACB ID#', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $data->bacbid2, 'T');
        $this->fpdf->Cell(30, 5, ' (' . Carbon::parse($data->signdate2)->format('m-d-Y') . ')', 'T');

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output('I', 'Unique Supervision Form.pdf');

        exit;
    }

    //Form 2
    public function parent_training(Request $request)
    {
        $data = dsptn_two_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('DIRECT-SERVICE PARENT TRAINING NOTE');

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(22, 5, 'Child Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(78, 5, $data->childname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(22, 5, 'Attendees:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->attendens, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(22, 5, 'Start Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(40, 5, Carbon::parse($data->starttime)->format('h:i A'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(40, 5, Carbon::parse($data->endtime)->format('h:i A'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->stdate)->format('m-d-Y'), 1, 1);
        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'GOALS FOR SESSION:', 'LTR', 1);
        $y1 = $this->fpdf->GetY();
        $this->fpdf->NormalText();
        $this->fpdf->SetLeftMargin(20);
        $i = 1;
        if ($data->goals1 == 1) {
            $this->fpdf->Cell(8, 5, $i . ')', 0, 0, 'R');
            $this->fpdf->Cell(0, 5, 'Explained specific behavior analytic concept / technique / procedure', 0, 1);
            $i++;
        }
        if ($data->goals2 == 1) {
            $this->fpdf->Cell(8, 5, $i . ')', 0, 0, 'R');
            $this->fpdf->Cell(0, 5, 'Role played new procedure / technique', 0, 1);
            $i++;
        }
        if ($data->goals3 == 1) {
            $this->fpdf->Cell(8, 5, $i . ')', 0, 0, 'R');
            $this->fpdf->Cell(0, 5, 'Gave performance feedback to parent on implementation', 0, 1);
            $i++;
        }
        if ($data->goals4 == 1) {
            $this->fpdf->Cell(8, 5, $i . ')', 0, 0, 'R');
            $this->fpdf->Cell(0, 5, 'Modified / created new goal based on parent information', 0, 1);
            $i++;
        }
        if ($data->goals5 == 1) {
            $this->fpdf->Cell(8, 5, $i . ')', 0, 0, 'R');
            $this->fpdf->Cell(0, 5, 'Modeled protocol with child (if child present (0368T/0369T)', 0, 1);
            $i++;
        }
        if ($data->goals6 == 1) {
            $this->fpdf->Cell(8, 5, $i . ')', 0, 0, 'R');
            $this->fpdf->Cell(0, 5, 'Other:', 0, 1);
            $i++;
        }



        $y2 = $this->fpdf->GetY();
        $this->fpdf->Line(10, $y1, 10, $y2);
        $this->fpdf->Line(200, $y1, 200, $y2);
        $this->fpdf->Line(10, $y2, 200, $y2);

        $this->fpdf->SetLeftMargin(10);
        $this->fpdf->CC('ACTIVITIES:', $data->act);


        $this->fpdf->CC('NEEDS:', $data->needs);

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();

        exit;
    }

    //Form 3
    public function bcba_monthly(Request $request)
    {

        $data = btsmf_three_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('BCBA TRAINEE SUPERVISION MONTHLY FORM');


        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(23, 5, 'Date:', 'LTR', 0, '', true);
        $this->fpdf->Cell(19, 5, 'Time:', 'LTR', 0, '', true);
        $this->fpdf->Cell(62, 5, 'Trainee:', 'LTR', 0, '', true);
        $this->fpdf->Cell(43, 5, 'Restricted Hours:', 'LTR', 0, '', true);
        $this->fpdf->Cell(43, 5, 'Unrestricted Hours:', 'LTR', 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(23, 5, Carbon::parse($data->stdate)->format('m-d-Y'), 'LBR');
        $this->fpdf->Cell(19, 5, $data->sttime, 'LBR');
        $this->fpdf->Cell(62, 5, $data->trainee, 'LBR');
        $this->fpdf->Cell(43, 5, $data->restricthours, 'LBR');
        $this->fpdf->Cell(43, 5, $data->unrestricthours, 'LBR', 1);

        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(55, 5, 'Setting:', 'LTR', 0, '', true);
        $this->fpdf->Cell(35, 5, 'Number of Clients:', 'LTR', 0, '', true);
        $this->fpdf->Cell(50, 5, 'Credential Pursuing:', 'LTR', 0, '', true);
        $this->fpdf->Cell(50, 5, 'Supervising BCBA:', 'LTR', 1, '', true);

        $this->fpdf->NormalText('blue');
        $this->fpdf->Cell(55, 5, $data->setting, 'LBR');
        $this->fpdf->Cell(35, 5, $data->numclient, 'LBR');
        $this->fpdf->Cell(50, 5, $data->cpurchaging, 'LBR');
        $this->fpdf->Cell(50, 5, $data->supervisingbcba, 'LBR', 1);

        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(73, 5, 'BCBA:', 'LTR', 0, '', true);
        $this->fpdf->Cell(60, 5, 'Number of Hours Independent:', 'LTR', 0, '', true);
        $this->fpdf->Cell(57, 5, 'Number of Hours Supervised:', 'LTR', 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(73, 5, $data->bcba, 'LBR');
        $this->fpdf->Cell(60, 5, $data->nohouri, 'LBR');
        $this->fpdf->Cell(57, 5, $data->nohs, 'LBR', 1);

        $this->fpdf->CC('TOPICS/FEEDBACK DISCUSSED IN SUPERVISION/FOLLOW UP:', $data->top_feed);

        $this->fpdf->CC('TASK LIST ITEMS COVERED:', $data->tlic);

        if ($this->fpdf->GetY() > 247) {
            $this->fpdf->AddPage();
        }


        $this->fpdf->Ln(5);

        if ($data->signature != null) {
            $this->fpdf->Image(public_path('/') . $data->signature, 25, $this->fpdf->GetY(), 40, 20);
        }
        if ($data->updload_sign != null) {
            $this->fpdf->Image(public_path('/') . $data->updload_sign, 140, $this->fpdf->GetY(), 40, 20);
        }


        $this->fpdf->SetXY(10, $this->fpdf->GetY() + 25);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Supervisee/BACB ID#', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $data->bacbid, 'T');
        $this->fpdf->Cell(30, 5, ' (' . Carbon::parse($data->bacbiddate)->format('m-d-Y') . ')', 'T');

        $this->fpdf->Cell(12, 5, '');
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Supervisor/BACB ID#', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $data->bacbid2, 'T');
        $this->fpdf->Cell(30, 5, ' (' . Carbon::parse($data->bacbiddate2)->format('m-d-Y') . ')', 'T');

        //Footer
        $this->fpdf->CustomFooter();

        //Output

        $this->fpdf->Output();

        exit;
    }

    //Form 4
    public function bcba_unique(Request $request)
    {

        $data = btusf_four_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('BCBA TRAINEE UNIQUE SUPERVISION FORM');


        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(23, 5, 'Date:', 'LTR', 0, '', true);
        $this->fpdf->Cell(19, 5, 'Time:', 'LTR', 0, '', true);
        $this->fpdf->Cell(62, 5, 'Trainee:', 'LTR', 0, '', true);
        $this->fpdf->Cell(43, 5, 'Restricted Hours:', 'LTR', 0, '', true);
        $this->fpdf->Cell(43, 5, 'Unrestricted Hours:', 'LTR', 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(23, 5, $data->stdate, 'LBR');
        $this->fpdf->Cell(19, 5, $data->sttime, 'LBR');
        $this->fpdf->Cell(62, 5, $data->trainee, 'LBR');
        $this->fpdf->Cell(43, 5, $data->restricthours, 'LBR');
        $this->fpdf->Cell(43, 5, $data->unrestricthours, 'LBR', 1);

        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(55, 5, 'Setting:', 'LTR', 0, '', true);
        $this->fpdf->Cell(35, 5, 'Number of Clients:', 'LTR', 0, '', true);
        $this->fpdf->Cell(50, 5, 'Credential Pursuing:', 'LTR', 0, '', true);
        $this->fpdf->Cell(50, 5, 'Supervising BCBA:', 'LTR', 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, $data->setting, 'LBR');
        $this->fpdf->Cell(35, 5, $data->numclient, 'LBR');
        $this->fpdf->Cell(50, 5, $data->cpurchaging, 'LBR');
        $this->fpdf->Cell(50, 5, $data->supervisingbcba, 'LBR', 1);

        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(73, 5, 'BCBA:', 'LTR', 0, '', true);
        $this->fpdf->Cell(60, 5, 'Session Length:', 'LTR', 0, '', true);
        $this->fpdf->Cell(57, 5, 'Number of Hours Supervised:', 'LTR', 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(73, 5, $data->bcba, 'LBR');
        $this->fpdf->Cell(60, 5, $data->seslength, 'LBR');
        $this->fpdf->Cell(57, 5, $data->nohs, 'LBR', 1);

        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'TYPE OF SUPERVISION:', 0, 1);
        $this->fpdf->NormalText();
        $txt = '';
        if ($data->suptypes1 == 1) $txt .= 'In person, ';
        if ($data->suptypes2 == 1) $txt .= 'Telehealth, ';
        if ($data->suptypes3 == 1) $txt .= 'Group Meeting, ';
        $this->fpdf->Cell(0, 5, $txt, 0, 1);

        $this->fpdf->Title('EVALUATION OF PERFORMANCE');
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(20, 5, '');
        $this->fpdf->Cell(4, 5, 'S');
        $this->fpdf->HeadingText('brown', 'BI');
        $this->fpdf->Cell(27, 5, ' - satisfactory');
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(6, 5, 'NI');
        $this->fpdf->HeadingText('brown', 'BI');
        $this->fpdf->Cell(40, 5, ' - needs improvement');
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(5, 5, 'U');
        $this->fpdf->HeadingText('brown', 'BI');
        $this->fpdf->Cell(30, 5, ' - unsatisfactory');
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(10, 5, 'N/A');
        $this->fpdf->HeadingText('brown', 'BI');
        $this->fpdf->Cell(30, 5, ' - not applicable', 0, 1);

        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText();
        $this->fpdf->SetWidths(array(10, 170, 10));
        $this->fpdf->SetAligns('C', 'L', 'C');
        $this->fpdf->CustomCheck(true);


        if ($data->arotime == 1) $txt = "S";
        else if ($data->arotime == 2) $txt = "NI";
        else if ($data->arotime == 3) $txt = "U";
        else if ($data->arotime == 4) $txt = "N/A";


        $this->fpdf->Row(array('1', 'Arrive on time for supervision', $txt));

        if ($data->coworkers == 1) $txt = "S";
        else if ($data->coworkers == 2) $txt = "NI";
        else if ($data->coworkers == 3) $txt = "U";
        else if ($data->coworkers == 4) $txt = "N/A";

        $this->fpdf->Row(array('2', 'Maintains professional and courteous interactions with: Clients/consumers Other service providers/ Coworkers:', $txt));

        if ($data->selfimprovement == 1) $txt = "S";
        else if ($data->selfimprovement == 2) $txt = "NI";
        else if ($data->selfimprovement == 3) $txt = "U";
        else if ($data->selfimprovement == 4) $txt = "N/A";

        $this->fpdf->Row(array('3', 'Maintains appropriate attire & demeanor Initiates professional self-improvement:', $txt));

        if ($data->appropriately == 1) $txt = "S";
        else if ($data->appropriately == 2) $txt = "NI";
        else if ($data->appropriately == 3) $txt = "U";
        else if ($data->appropriately == 4) $txt = "N/A";

        $this->fpdf->Row(array('4', 'Accepts supervisory feedback appropriately:', $txt));

        if ($data->seeks == 1) $txt = "S";
        else if ($data->seeks == 2) $txt = "NI";
        else if ($data->seeks == 3) $txt = "U";
        else if ($data->seeks == 4) $txt = "N/A";



        $this->fpdf->Row(array('5', 'Seeks supervision appropriately/ asks questions when needed:', $txt));

        if ($data->submission == 1) $txt = "S";
        else if ($data->submission == 2) $txt = "NI";
        else if ($data->submission == 3) $txt = "U";
        else if ($data->submission == 4) $txt = "N/A";

        $this->fpdf->Row(array('6', 'Timely submission of tasks assigned:', $txt));

        if ($data->communicates == 1) $txt = "S";
        else if ($data->communicates == 2) $txt = "NI";
        else if ($data->communicates == 3) $txt = "U";
        else if ($data->communicates == 4) $txt = "N/A";

        $this->fpdf->Row(array('7', 'Communicates effectively:', $txt));

        if ($data->sensitivity == 1) $txt = "S";
        else if ($data->sensitivity == 2) $txt = "NI";
        else if ($data->sensitivity == 3) $txt = "U";
        else if ($data->sensitivity == 4) $txt = "N/A";

        $this->fpdf->Row(array('8', 'Demonstrates appropriate sensitivity to nonbehavioral providers (teachers, other healthcare providers, caregivers etc):', $txt));

        if ($data->behanalytic == 1) $txt = "S";
        else if ($data->behanalytic == 2) $txt = "NI";
        else if ($data->behanalytic == 3) $txt = "U";
        else if ($data->behanalytic == 4) $txt = "N/A";

        $this->fpdf->Row(array('9', 'Acquisition of target behavior-analytic skills:', $txt));





        $this->fpdf->CC('TOPICS/FEEDBACK DISCUSSED IN SUPERVISION/FOLLOW UP:', $data->feeds);

        $this->fpdf->CC('TASK LIST ITEMS COVERED:', $data->tlic);





        if ($this->fpdf->GetY() > 247) {
            $this->fpdf->AddPage();
        }


        $this->fpdf->Ln(5);

        if ($data->signature != null) {
            $this->fpdf->Image(public_path('/') . $data->signature, 25, $this->fpdf->GetY(), 40, 20);
        }
        if ($data->updload_sign != null) {
            $this->fpdf->Image(public_path('/') . $data->updload_sign, 140, $this->fpdf->GetY(), 40, 20);
        }


        $this->fpdf->SetXY(10, $this->fpdf->GetY() + 25);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Supervisee/BACB ID#', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $data->bacb, 'T');
        $this->fpdf->Cell(30, 5, ' (' . Carbon::parse($data->bacbdate)->format('m-d-Y') . ')', 'T');

        $this->fpdf->Cell(12, 5, '');
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Supervisor/BACB ID#', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $data->bacb2, 'T');
        $this->fpdf->Cell(30, 5, ' (' . Carbon::parse($data->bacbdate2)->format('m-d-Y') . ')', 'T');

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
        exit;
    }

    //Form 5
    public function monthly_supervision(Request $request)
    {

        $data = msn_five_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('MONTHLY SUPERVISION NOTE');

        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(35, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(70, 5, $data->clname, 1);
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, $data->stdate, 1);
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->sttime)->format('h:i A'), 1, 1);
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(35, 5, 'RBT(s) Supervised:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->rbts, 1, 1);

        $txt = '';
        if ($data->format1 != NULL) $txt .= 'In-person, ';
        if ($data->format2 != NULL) $txt .= 'Remote, ';
        if ($data->format3 != NULL) $txt .= 'Group, ';
        if ($data->format4 != NULL) $txt .= 'Team Meeting';


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(35, 5, 'Format:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1);

        $txt = '';
        if ($data->activities1 != NULL) $txt .= 'Data Review, ';
        if ($data->activities2 != NULL) $txt .= 'Observation, ';
        if ($data->activities3 != NULL) $txt .= 'Protocol Demonstration/Modification, ';
        if ($data->activities4 != NULL) $txt .= 'Team Meeting';

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(35, 5, 'Activities:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1);

        $this->fpdf->CC('GOALS REVIEWED:', $data->goals);

        $txt = '';
        if ($data->responsetreat1 != NULL) $txt .= 'Making Progress, ';
        if ($data->responsetreat2 != NULL) $txt .= 'Regression, ';
        if ($data->responsetreat3 != NULL) $txt .= 'Maintaining, ';
        if ($data->responsetreat4 != NULL) $txt .= 'N/A';


        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(58, 5, 'Overall Response to Treatment:');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 0, 1);


        $this->fpdf->CC('FEEDBACK/SUGGESTIONS:', $data->feed);

        $this->fpdf->CC('PARENT/CAREGIVER CONCERNS DISCUSSED:', $data->pcondis);

        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'DID RBT PROVIDE SERVICES IN ACCORDANCE WITH BACB GUIDELINES FOR RESPONSIBLE CONDUCT FOR ', 0, 1);
        $this->fpdf->Cell(160, 5, 'BEHAVIOR ANALYSTS?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->rbt, 0, 1);
        $this->fpdf->CC('Conduct and action taken on back:', $data->rbt_exp);

        //Signature Module

        if ($this->fpdf->GetY() > 247) {
            $this->fpdf->AddPage();
        }

        $up_date = Carbon::parse($data->updated_at)->format('m-d-Y');

        $this->fpdf->Ln(5);

        if ($data->signature != null) {
            $this->fpdf->Image(public_path('/') . $data->signature, 25, $this->fpdf->GetY(), 40, 20);
        }


        $this->fpdf->SetXY(10, $this->fpdf->GetY() + 25);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(40, 5, 'Supervisor\'s Signature', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(40, 5, $data->supervisorname, 'T');
        $this->fpdf->Cell(25, 5, ' (' . Carbon::parse($data->signdate)->format('m-d-Y') . ')', 'T');

        //Footer
        $this->fpdf->CustomFooter();


        $this->fpdf->Output();

        exit;
    }

    //Form 6
    public function communication(Request $request)
    {
        $data = tcsn_fix_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('THERAPIST COMMUNICATION/SESSION NOTES');


        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(29, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(47, 5, $data->clname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(23, 5, Carbon::parse($data->stdate)->format('m-d-Y'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Start Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(19, 5, Carbon::parse($data->sttime)->format('h:i A'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(19, 5, Carbon::parse($data->endtime)->format('h:i A'), 1, 1);

        $txt = '';
        if ($data->setting1 != NULL) $txt .= 'Home, ';
        if ($data->setting2 != NULL) $txt .= 'Center, ';
        if ($data->setting3 != NULL) $txt .= 'Community';

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(29, 5, 'Setting:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1);


        $txt = '';
        if ($data->pepresent1 != NULL) $txt .= 'Client, ';
        if ($data->pepresent2 != NULL) $txt .= 'Therapist, ';
        if ($data->pepresent3 != NULL) $txt .= 'Parent, ';
        if ($data->pepresent4 != NULL) $txt .= 'Caregiver, ';
        if ($data->pepresent5 != NULL) $txt .= 'BCBA, ';
        if ($data->pepresent6 != NULL) $txt .= 'Other:';

        if ($data->pepresent6 != NULL) {
            $txt .= $data->pepresentiotr;
        }
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(29, 5, 'People Present:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1);



        $txt = '';
        if ($data->dangerousbehave1 != NULL) $txt .= 'Aggression, ';
        if ($data->dangerousbehave2 != NULL) $txt .= 'Non-compliance, ';
        if ($data->dangerousbehave3 != NULL) $txt .= 'Leaving area, ';
        if ($data->dangerousbehave4 != NULL) $txt .= 'Inattention, ';
        if ($data->dangerousbehave5 != NULL) $txt .= 'Difficult to motivate, ';
        if ($data->dangerousbehave6 != NULL) $txt .= 'Obsessive/preservative, ';
        if ($data->dangerousbehave7 != NULL) $txt .= 'Other:';
        if ($data->dangerousbehave7 != NULL) {
            $txt .= $data->dangerousbehaveotr;
        }

        $this->fpdf->Ln(5);
        $this->fpdf->CustomCheck(true, 1);
        $this->fpdf->SetWidths(array(50, 140));
        $this->fpdf->Row(array('Any dangerous behaviors during session?', $txt));

        $this->fpdf->Row(array('ABC LOG', 'Was an ABC Log completed on new or challenging behaviors?                               ' . $data->chabehaviors));

        $txt = '';
        if ($data->dtt != NULL) $txt .= 'Discrete trial training (DTT), ';
        if ($data->net != NULL) $txt .= 'Natural Environment Training (NET), ';
        if ($data->mt != NULL) $txt .= 'Mand training (requests), ';
        if ($data->ta != NULL) $txt .= 'Task analysis (TA), ';
        if ($data->bip != NULL) $txt .= 'Behavior Intervention Plan (BIP), ';
        if ($data->shaping != NULL) $txt .= 'Shaping, ';
        if ($data->bst != NULL) $txt .= 'Behavior Skills Training (BST), ';
        if ($data->iuotrcheck != NULL) $txt .= 'Other:';
        if ($data->iuotrcheck != NULL) {
            $txt .= $data->iuotrchecktxt;
        }


        $this->fpdf->Row(array('Interventions utilized:', $txt));

        $txt = '';
        if ($data->proarcom != NULL) $txt .= 'Communication, ';
        if ($data->proarpair != NULL) $txt .= 'Pairing/Rapport, ';
        if ($data->proarscoial != NULL) $txt .= 'Social Skills, ';
        if ($data->proarsc != NULL) $txt .= 'Adaptive/Self-care, ';
        if ($data->proarpsk != NULL) $txt .= 'Play Skills, ';
        if ($data->proarflu != NULL) $txt .= 'Fluency, ';
        if ($data->proartnc != NULL) $txt .= 'Tolerance of Novelty/Changes, ';
        if ($data->proarsmr != NULL) $txt .= 'Self-Management/Regulation:, ';
        if ($data->proarotr != NULL) $txt .= 'Other:';
        if ($data->proarotr != NULL) {
            $txt .= $data->proarotrtxt;
        }



        $this->fpdf->Row(array('Program areas worked on', $txt));



        $txt = '';
        if ($data->ensession1) $txt .= 'Few correct, ';
        if ($data->ensession2) $txt .= 'Some correct, ';
        if ($data->ensession3) $txt .= 'Most correct, ';
        if ($data->ensession4) $txt .= 'All correct, ';
        if ($data->ensession5) $txt .= 'None correct';

        $this->fpdf->Row(array('Client independent responding over entire session', $txt));



        $this->fpdf->CC('Things that were motivating/wanted', $data->motivating);

        $this->fpdf->CC('What went well?', $data->well);

        $this->fpdf->CC('What was a struggle?', $data->struggle);

        $this->fpdf->CC('What do you need or need help with?', $data->help);


        $txt = '';
        if ($data->supsession1) $txt .= 'My questions can wait until next supervision session, ';
        if ($data->supsession2) $txt .= 'I still need more clarification on some things before my next session, ';
        if ($data->supsession3) $txt .= 'All of my questions/ concerns were addressed, ';
        if ($data->supsession4) $txt .= 'N/A';

        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText();
        $this->fpdf->CustomCheck(true, 1);
        $this->fpdf->Row(array('If this was a supervision session, check the appropriate box:', $txt));


        $this->fpdf->CC('Therapist Communication/Comments:', $data->thcomts);



        //Signature Module

        if ($this->fpdf->GetY() > 247) {
            $this->fpdf->AddPage();
        }

        $up_date = Carbon::parse($data->updated_at)->format('m-d-Y');

        $this->fpdf->Ln(5);

        if ($data->signature != null) {
            $this->fpdf->Image(public_path('/') . $data->signature, 25, $this->fpdf->GetY(), 40, 20);
        }


        $this->fpdf->SetXY(10, $this->fpdf->GetY() + 25);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(40, 5, 'Therapist\'s Signature', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(40, 5, $data->priame1, 'T');
        $this->fpdf->Cell(25, 5, ' (' . Carbon::parse($data->thersigndate1)->format('m-d-Y') . ')', 'T');

        $this->fpdf->Ln(10);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(180, 5, 'Any dangerous behaviors reported since last sessions?', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(10, 5, $data->pcqrbt, 1, 1, 'C');
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Explanation', $data->pcqrbtexp);



        //Signature Module

        if ($this->fpdf->GetY() > 247) {
            $this->fpdf->AddPage();
        }

        $up_date = Carbon::parse($data->updated_at)->format('m-d-Y');

        $this->fpdf->Ln(5);

        if ($data->updload_sign != null) {
            $this->fpdf->Image(public_path('/') . $data->updload_sign, 25, $this->fpdf->GetY(), 40, 20);
        }


        $this->fpdf->SetXY(10, $this->fpdf->GetY() + 25);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(40, 5, 'Therapist\'s Signature', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(40, 5, $data->prname2, 'T');
        $this->fpdf->Cell(25, 5, ' (' . Carbon::parse($data->thersigndate2)->format('m-d-Y') . ')', 'T');

        $this->fpdf->Ln(10);
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(10, 5, 'Note:');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, 'Please forward all parent comments/questions to program managers/clinical managers within 48 hours.', 0, 1);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();

        exit;
    }

    //Form 7
    public function clinical_treatment(Request $request)
    {


        $txt = 'Lorem ipsum dolor sit amet Here is multicell value. Here is multicell value. Lorem ipsum dolor sit amet Here is multicell value. Here is multicell value. Lorem ipsum dolor sit amet Here is multicell value. Here is multicell value.';

        $data = ct_seven_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('CLINICAL TREATMENT, MANAGEMENT, & MODIFICATION NOTES');


        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(51, 5, $data->clname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(23, 5, Carbon::parse($data->date)->format('m-d-Y'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Start Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(19, 5, Carbon::parse($data->stime)->format('h:i A'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(19, 5, Carbon::parse($data->etime)->format('h:i A'), 1, 1);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'Settings', 0, 1);
        $this->fpdf->NormalText();

        $txt = '';
        if ($data->setting != null) $txt .= 'Home';
        if ($data->community != null) $txt .= ', Community';
        if ($data->clinic != null) $txt .= ', Clinic/Office';
        if ($data->school != null) $txt .= ', School';



        $txt = '';
        $txt2 = '';
        if ($data->report == 1) $txt2 = ': Yes';
        if ($data->report == 2) $txt2 = ': No';
        if ($data->report == 3) $txt2 = ': N/A';


        if ($data->langimp != null) $txt .= 'Rec. Language Impairment';
        if ($data->explang != null) $txt .= ', Exp Language Impairment';
        if ($data->ssdef != null) $txt .= ', Social Skills Deficits';
        if ($data->repbeh != null) $txt .= ', Repetitive Behaviors';
        if ($data->resint != null) $txt .= ', Restricted Interests';
        if ($data->hyper != null) $txt .= ', Hyper/Hypo-reactivity to sensory input';
        if ($data->insist != null) $txt .= ', Insistence on sameness';
        if ($data->harmself != null) $txt .= ', Harm to self or others* *Was an Incident Report filled out within 24 hours?' . $txt2;
        $this->fpdf->Ln(5);
        $this->fpdf->CustomCheck(true, 1);
        $this->fpdf->SetWidths(array(50, 140));
        $this->fpdf->Row(array('Signs/Symptoms Observed', $txt));

        $txt = '';
        if ($data->brc != null) $txt .= 'Build rapport with client/family/tech';
        if ($data->mag != null) $txt .= ', Modify acquisition goal, teaching technique, and/or procedure';
        if ($data->bmg != null) $txt .= ', Modify any component of Behavior Intervention Plan';
        if ($data->mac != null) $txt .= ', Modify parent goal, teaching technique, and/or procedure';
        if ($data->mpg != null) $txt .= ', Modify Reinforcement Schedule';
        if ($data->mrs != null) $txt .= ', Modify maintenance goal and/or procedure';
        if ($data->mmg != null) $txt .= ', Baseline/Mastery/Generalization Probes to modify goals, teaching technique, and/or procedure';
        if ($data->mtt != null) $txt .= ', Model teaching to technician';
        if ($data->ptr != null) $txt .= ', Parent Training';
        if ($data->asskill != null) $txt .= ', Assessment of Skills (standardized or curriculum-based)';
        if ($data->intobs != null) $txt .= ', Inter-observer agreement (IOA) data collection';
        if ($data->othdes != null) $txt .= ', Other- Describe:';
        $txt .= $data->othdesexp;

        $this->fpdf->Row(array('Goals for Session', $txt));

        $txt = '';
        if ($data->lcomm != null) $txt .= 'Language/Communication';
        if ($data->ttp != null) $txt .= ', Modify acquisition goal, teaching technique, and/or procedure';
        if ($data->socskill != null) $txt .= ', Social Skills';
        if ($data->playskill != null) $txt .= ', Play Skills';
        if ($data->adapskill != null) $txt .= ', Adaptive Skills';
        if ($data->selfman != null) $txt .= ', Executive Functioning Skills (self-management, organization, tolerance, and inhibition)';
        if ($data->motoskill != null) $txt .= ', Motor Skills';
        if ($data->tarsafe != null) $txt .= ', Safety';
        if ($data->disrupt != null) $txt .= ', Disruptive Behavior';
        if ($data->taroth != null) $txt .= ', Other- Describe:';

        $txt .= $data->tarothdes;


        $this->fpdf->Row(array('Targeted Domains', $txt));

        $txt = '';
        if ($data->dtt != null) $txt .= 'Discrete Trial (DTT)';
        if ($data->net != null) $txt .= ', Natural Environment Teaching (NET)';
        if ($data->vb != null) $txt .= ', Verbal Behavior (VB';
        if ($data->shaping != null) $txt .= ', Shaping';
        if ($data->chaining != null) $txt .= ', Chaining/Task Analysis';
        if ($data->bst != null) $txt .= ', Behavior Skills Training (BST)';
        if ($data->incteach != null) $txt .= ', Incidental Teaching';
        if ($data->propmt != null) $txt .= ', Prompting/Fading';

        $data = ct_seven2_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();



        if ($data->antec != null) $txt .= ', Antecedent Modifications';
        if ($data->pnrein != null) $txt .= ', Positive/Negative Reinforcement';
        if ($data->tokenecon != null) $txt .= ', Token Economy';
        if ($data->diffrein != null) $txt .= ', Differential Reinforcement';
        if ($data->nonharm != null) $txt .= ', Non-harmful, safe, caregiver-approved Positive/Negative Punishment';
        if ($data->tuother != null) $txt .= ', Other- Describe:';
        $txt .= $data->tuotherdes;



        $this->fpdf->Row(array('ABT/RBT\'s Techniques Utilized', $txt));

        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'Overall Response to Treatement:', 0, 1);

        $txt = '';
        if ($data->absbeh != null) $txt .= ', Absence of Problem Behavior';
        if ($data->decbeh != null) $txt .= ', Decrease of Problem Behavior';
        if ($data->mastar != null) $txt .= ', Mastery of Targets';
        if ($data->masgoal != null) $txt .= ', Mastery of Goals';
        if ($data->maingoal != null) $txt .= ', Maintenance of Mastered Goals';
        if ($data->rapidgoal != null) $txt .= ', Rapid Progress Toward Goals';
        if ($data->steadygoal != null) $txt .= ', Steady Progress towards Goals';



        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText();
        $this->fpdf->Row(array('Client responded positively to ABA therapy today exhibited by:', $txt));

        $txt = '';
        if ($data->incbeh != null) $txt .= 'Increase in problem behavior';
        if ($data->behplan != null) $txt .= 'Behavior Plan was Ineffective';
        if ($data->lackmot != null) $txt .= 'Lack of Motivation';
        if ($data->regresskill != null) $txt .= 'Regression of Skills';

        $this->fpdf->Row(array('Client responded negatively/did not respond to ABA therapy today exhibited by:', $txt));





        $this->fpdf->CC('TREATEMENT PLAN DETAILS AND PROTOCOL MODIFICATION CONDUCTED:', $data->tpdetail);


        $this->fpdf->CC('NEW BEHAVIORS OF CONCERN/RECOMMENDATIONS:', $data->newbeh);


        $this->fpdf->CC('PARENT COMMENTS/QUESTIONS DISCUSSED:', $data->ptdiss);


        $this->fpdf->CC('FOLLOW UP:', $data->followup);


        $txt = '';
        if ($data->inperson != null) $txt .= 'In Person';
        if ($data->remote != null) $txt .= ', Remote';
        if ($data->group != null) $txt .= ', Group';


        $this->fpdf->Ln();
        $this->fpdf->HeadingText();
        $this->fpdf->Row(array('ABT/RBT/PRESENT', $txt));


        $this->fpdf->CC('OBSERVATION NOTES:', $data->obsnote);

        $this->fpdf->Ln(5);

        $this->fpdf->Title('ABT/RBT FEEDBACK');


        $txt = '';
        if ($data->datreview != null) $txt .= 'Data Review';
        if ($data->observation != null) $txt .= ', Observation';
        if ($data->protdemon != null) $txt .= ', Protocol Demonstration/Modification';
        if ($data->teammeeting != null) $txt .= ', Team Meeting';
        if ($data->datother != null) $txt .= ', Other:';
        $txt .= $data->datotherexp;

        $this->fpdf->HeadingText();
        $this->fpdf->Row(array('ABT/RBT Activity', $txt));

        $this->fpdf->CC('POSITIVE FEEDBACK GIVEN:', $data->posfeed);


        $this->fpdf->CC('TEACH:', $data->teach);


        $this->fpdf->CC('MODEL:', $data->moddel);


        $this->fpdf->CC('COACH:', $data->coach);


        $this->fpdf->CC('REVIEW/FEEDBACK:', $data->review);

        $this->fpdf->Ln();

        $txt = '';
        if ($data->ioa == 1) $txt .= 'Yes';
        if ($data->ioa == 2) $txt .= 'No';

        $this->fpdf->Cell(180, 5, 'IOA Collected?', 1);
        //if(no)
        //$this->fpdf->Cell(0,5,'No',1,1);
        $this->fpdf->Cell(0, 5, $txt, 1, 1);
        $this->fpdf->CC('Program and Data:', $data->dttsheet);

        $this->fpdf->Ln(5);

        $this->fpdf->Title('ABT/RBT GOALS DATA COLLECTION');

        $this->fpdf->CC('GOAL 1:', $data->goal1);

        $this->fpdf->CC('GOAL 2:', $data->goal2);

        $this->fpdf->CC('GOAL 3:', $data->goal3);

        if ($this->fpdf->GetY() > 247) {
            $this->fpdf->AddPage();
        }


        $this->fpdf->Ln(5);

        if ($data->signature != null) {
            $this->fpdf->Image(public_path('/') . $data->signature, 25, $this->fpdf->GetY(), 40, 20);
        }
        if ($data->updload_sign != null) {
            $this->fpdf->Image(public_path('/') . $data->updload_sign, 140, $this->fpdf->GetY(), 40, 20);
        }


        $this->fpdf->SetXY(10, $this->fpdf->GetY() + 25);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(32, 5, 'Parent/Caregiver:', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, $data->parprint, 'T');
        $this->fpdf->Cell(25, 5, ' (' . Carbon::parse($data->pardate)->format('m-d-Y') . ')', 'T');

        $this->fpdf->Cell(12, 5, '');
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(15, 5, 'PM/CM:', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->pmprint, 'T');
        $this->fpdf->Cell(25, 5, ' (' . Carbon::parse($data->pmdate)->format('m-d-Y') . ')', 'T');

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();

        exit;
    }

    //Form 8
    public function treatment_plan(Request $request)
    {



        $data = tp_eight_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }


        $this->fpdf->Title('TREATEMENT PLAN');
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(45, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(105, 5, $data->clname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(10, 5, 'DOB:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, $data->stdate, 1, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(45, 5, 'Type of Treatment Plan:', 1, 0, '', true);

        $txt = '';
        if ($data->init != NULL) $txt .= 'initial, ';
        if ($data->ongoing != NULL) $txt .= 'ongoing';

        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1);

        //Goal 1
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'GOAL 1', 0, 1, 'C');
        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Open Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(80, 5, Carbon::parse($data->gl1opendt)->format('m-d-Y'), 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->gl1trdat)->format('m-d-Y'), 1, 1);

        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Goal 1:', $data->gl1);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Objective 1:', $data->gl1obj);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Intervention 1:', $data->gl1inter);


        //Goal 2
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'GOAL 2', 0, 1, 'C');
        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Open Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(80, 5, Carbon::parse($data->gl2opdt)->format('m-d-Y'), 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->gl2trdt)->format('m-d-Y'), 1, 1);

        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Goal 2:', $data->gl2);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Objective 1:', $data->gl2obj);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Intervention 1:', $data->gl2inter);


        //Goal 3
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'GOAL 3', 0, 1, 'C');
        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Open Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(80, 5, Carbon::parse($data->gl3opdt)->format('m-d-Y'), 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->gl3trdt)->format('m-d-Y'), 1, 1);

        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Goal 3:', $data->gl3);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Objective 1:', $data->gl3obj);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Intervention 1:', $data->gl3inter);


        //Goal 4
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'GOAL 4', 0, 1, 'C');
        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Open Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(80, 5, Carbon::parse($data->gl4opdt)->format('m-d-Y'), 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->gl4trdt)->format('m-d-Y'), 1, 1);

        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Goal 4:', $data->gl4);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Objective 1:', $data->gl4obj);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Intervention 1:', $data->gl4inter);

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();

        exit;
    }

    //Form 9
    public function client_intake(Request $request)
    {

        $data = pc_nine_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        $txt = 'Lorem ipsum dolor sit amet Here is multicell value. Here is multicell value. Lorem ipsum dolor sit amet Here is multicell value. Here is multicell value. Lorem ipsum dolor sit amet Here is multicell value. Here is multicell value.';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('PRIVATE CLIENT INTAKE FORM');

        $this->fpdf->HeadingText('white');
        $this->fpdf->SetX(10);
        $this->fpdf->Cell(24, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->SetX(34);
        $this->fpdf->Cell(71, 5, $data->clname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->SetX(105);
        $this->fpdf->Cell(10, 5, 'DOB:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->SetX(115);
        $this->fpdf->Cell(85, 5, $data->dob, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->SetX(10);
        $this->fpdf->Cell(36, 5, 'Date of Assessment:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->SetX(46);
        $this->fpdf->Cell(0, 5, $data->doa, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->SetX(105);
        $this->fpdf->Cell(37, 5, 'Place of Assessment:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->SetX(142);
        $this->fpdf->Cell(0, 5, $data->poa, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->SetX(10);
        $this->fpdf->Cell(16, 5, 'Address:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->SetX(26);
        $this->fpdf->Cell(174, 5, $data->address, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->SetX(10);
        $this->fpdf->Cell(20, 5, 'Phone No:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->SetX(30);
        $this->fpdf->Cell(0, 5, $data->phone, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->SetX(105);
        $this->fpdf->Cell(27, 5, 'Insurance/Id#:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->SetX(132);
        $this->fpdf->Cell(0, 5, $data->insid, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->SetX(10);
        $this->fpdf->Cell(31, 5, 'School/Employer:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->SetX(41);
        $this->fpdf->Cell(0, 5, $data->school, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->SetX(105);
        $this->fpdf->Cell(13, 5, 'Grade:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->SetX(118);
        $this->fpdf->Cell(0, 5, $data->grade, 1);
        $this->fpdf->Ln(5);

        $this->fpdf->CC('INTERPRETIVE', $data->intersum);


        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'TREATMENT HISTORY', 0, 1, 'C');

        $txt = '';
        if ($data->psyserv == 1) $txt = "Yes";
        if ($data->psyserv == 2) $txt = "No";


        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(182, 7, 'Are you currently receiving psychiatric services, professional counseling or psychotherapy elsewhere?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $txt, 0, 1);


        $txt = '';
        if ($data->prepsy == 1) $txt = "No";
        if ($data->prepsy == 2) $txt = "Yes ( " . $data->prename . " )";

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(70, 7, 'Have you had previous psychotherapy?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $txt, 0, 1);


        $txt = '';
        if ($data->psymed == 1) $txt = "No";
        if ($data->psymed == 2) $txt = "Yes";
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(174, 7, 'Are you currently taking prescribed psychiatric medication (antidepressants or others)?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $txt, 0, 1);
        if ($data->psymed == 2) {
            $this->fpdf->MultiCell(0, 7, $data->preslist);
            $this->fpdf->MultiCell(0, 7, $data->presby);
        }

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'HEALTH AND SOCIAL INFORMATION', 0, 1, 'C');

        $txt = '';
        if ($data->priphy == 1) $txt = 'Yes ( ' . $data->priphone . ' )';
        if ($data->priphy == 2) $txt = 'No';

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(130, 7, 'Do you currently have a primary physician?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $txt, 0, 1);



        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(160, 7, 'Are you currently seeing more than one medical health specialist?');
        $this->fpdf->NormalText();

        $txt = '';
        if ($data->mtomed == 1) $txt = 'Yes';
        if ($data->mtomed == 2) $txt = 'No';

        $this->fpdf->Cell(0, 7, $txt, 0, 1);
        $this->fpdf->MultiCell(0, 7, $data->mtolist);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(160, 7, 'When was your last physical?', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 7, $data->lastphy);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->MultiCell(160, 7, 'Please list any persistent physical symptoms or health concerns (e.g. chronic pain, headaches, hypertension, diabetes, etc.:', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 7, $data->hconc);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(160, 7, 'Are you currently on medication to manage a physical health concern? If yes, please list:');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $data->data, 0, 1);
        $this->fpdf->MultiCell(0, 7, $data->currmed);


        $txt = '';
        if ($data->sleephab == 1) $txt = "Yes";
        if ($data->sleephab == 2) $txt = "No";

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(100, 7, 'Are you having any problems with your sleep habits?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(10, 7, $txt);

        $txt = '';
        if ($data->sleepcheck == 1) $txt = 'Sleeping too little.';
        if ($data->sleepcheck == 2) $txt = 'Sleeping too much.';
        if ($data->sleepcheck == 3) $txt = 'Poor quality sleep.';
        if ($data->sleepcheck == 4) $txt = 'Disturbing dreams.';
        if ($data->sleepcheck == 5) $txt = 'Other.';

        $this->fpdf->Cell(0, 7, $txt, 0, 1);


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(160, 7, 'How many times per week do you excercise?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $data->wexc, 0, 1);

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(160, 7, 'Approximately how long each time?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $data->exclong, 0, 1);

        $txt = '';
        if ($data->ehabit == 1) $txt = "Yes";
        if ($data->ehabit == 2) $txt = "No";

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(110, 7, 'Are you having any difficulty with appetite or eating habits?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(10, 7, $txt);

        $txt = '';
        if ($data->ehabitcheck == 1) $txt = 'Eating Less.';
        if ($data->ehabitcheck == 2) $txt = 'Eating more.';
        if ($data->ehabitcheck == 3) $txt = 'Bingeing.';
        if ($data->ehabitcheck == 4) $txt = 'Restricting.';

        $this->fpdf->Cell(0, 7, $txt, 0, 1);

        $txt = '';
        if ($data->wchange == 1) $txt = 'Yes';
        if ($data->wchange == 2) $txt = 'No';


        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(160, 7, 'Have you experienced significant weight change in the last 2 months?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $txt, 0, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(160, 7, 'Do you regularly use alcohol?');
        $this->fpdf->NormalText();

        $txt = '';
        if ($data->usealc == 1) $txt = 'Yes';
        if ($data->usealc == 2) $txt = 'No';

        $this->fpdf->Cell(0, 7, $txt, 0, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(160, 7, 'In a typical month, how often do you have 4 or more drinks in a 24 hour period?');
        $this->fpdf->NormalText();

        $txt = '';
        if ($data->drinkp == 1) $txt = '1 times.';
        if ($data->drinkp == 2) $txt = '2 times.';
        if ($data->drinkp == 3) $txt = '3 times.';
        if ($data->drinkp == 4) $txt = '4 times.';
        if ($data->drinkp == 5) $txt = '5 times.';
        if ($data->drinkp == 6) $txt = '6 times.';
        if ($data->drinkp == 7) $txt = '7 times.';
        if ($data->drinkp == 8) $txt = '8 times.';

        $this->fpdf->Cell(0, 7, $txt, 0, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(160, 7, 'How often do you engage recreational drug use?');
        $this->fpdf->NormalText();

        $txt = '';
        if ($data->recdrug == 1) $txt = 'Daily';
        if ($data->recdrug == 2) $txt = 'Weekly';
        if ($data->recdrug == 3) $txt = 'Monthly';
        if ($data->recdrug == 4) $txt = 'Rarely';
        if ($data->recdrug == 5) $txt = 'Never';

        $this->fpdf->Cell(0, 7, $txt, 0, 1);



        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(160, 7, 'Do you smoke cigarettes or use other tobacco products?');
        $this->fpdf->NormalText();


        $txt = '';
        if ($data->cigar == 1) $txt = 'Yes';
        if ($data->cigar == 2) $txt = 'No';


        $this->fpdf->Cell(0, 7, $txt, 0, 1);


        $txt = '';
        if ($data->suith == 1) $txt = 'equently';
        if ($data->suith == 2) $txt = 'sometimes';
        if ($data->suith == 3) $txt = 'rarely';
        if ($data->suith == 4) $txt = 'never';

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(160, 7, 'Have you had suicidal thoughts recently?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $txt, 0, 1);

        $txt = '';
        if ($data->suipast == 1) $txt = 'equently';
        if ($data->suipast == 2) $txt = 'sometimes';
        if ($data->suipast == 3) $txt = 'rarely';
        if ($data->suipast == 4) $txt = 'never';



        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(160, 7, 'Have you had them in the past?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $txt, 0, 1);


        $txt = '';
        if ($data->romrel == 1) $txt = 'No';
        if ($data->romrel == 1) $txt = 'Yes ( ' . $data->rellong . ' )';

        $this->fpdf->HeadingText('blue');

        $this->fpdf->Cell(90, 7, 'Are you currently in a romantic relationship?');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 7, $txt, 0, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(174, 7, 'On a scale of 1-10 (10 being the highest quality), how would you rate your current relationship?', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 7, $data->relrate, 0, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 7, 'In the last year, have you experienced any significant life changes or stressors? If yes, please explain:', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 7, $data->lastchange, 0, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 7, 'Have you ever experienced any of the following?');
        $this->fpdf->Ln(8);

        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLeftMargin(11);

        $txt = '';
        if ($data->depress == 1) $txt = 'Yes';
        if ($data->depress == 2) $txt = 'No';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Extreme depressed mood', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');


        $txt = '';
        if ($data->mood == 1) $txt = 'Yes';
        if ($data->mood == 2) $txt = 'No';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Dramatic mood swings', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->rapids == 1) $txt = 'Yes';
        if ($data->rapids == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Rapid speech', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->extanx == 1) $txt = 'Yes';
        if ($data->extanx == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Extreme anxiety', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->panatt == 1) $txt = 'Yes';
        if ($data->panatt == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Panic attacks', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->phob == 1) $txt = 'Yes';
        if ($data->phob == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Phobias', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->sleepdis == 1) $txt = 'Yes';
        if ($data->sleepdis == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Sleep disturbances', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->hallu == 1) $txt = 'Yes';
        if ($data->hallu == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Hallucinations', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->unlosstime == 1) $txt = 'Yes';
        if ($data->unlosstime == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Unexplained losses of time', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->unexmemory == 1) $txt = 'Yes';
        if ($data->unexmemory == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Unexplained memory lapses', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->alabuse == 1) $txt = 'Yes';
        if ($data->alabuse == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Alcohol/substance abuse', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->freqcomp == 1) $txt = 'Yes';
        if ($data->freqcomp == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Frequent body complaints', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->eatdiss == 1) $txt = 'Yes';
        if ($data->eatdiss == 2) $txt = 'No';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Eating disorder', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->bodyimg == 1) $txt = 'Yes';
        if ($data->bodyimg == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Body image problems', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $data = pc_nine2_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        $txt = '';
        if ($data->repth == 1) $txt = 'Yes';
        if ($data->repth == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Repetitive thoughts (e.g. obsessions)', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->repbeh == 1) $txt = 'Yes';
        if ($data->repbeh == 2) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Repetitive behaviors (e.g. frequent checking, hand washing)', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->homith == 1) $txt = 'Yes';
        if ($data->homith == 2) $txt = 'No';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Homicidal thoughts', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $txt = '';
        if ($data->suiattm == 1) $txt = 'Yes';
        if ($data->suiattm == 2) $txt = 'No';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(174, 7, 'Suicidal attempts', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 7, $txt, 1, 1, 'C');

        $this->fpdf->Cell(0, 7, $data->suiwhen, 1, 1);
        $this->fpdf->SetLeftMargin(10);
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'OCCUPATIONAL INFORMATION', 0, 1, 'C');

        $txt = '';
        if ($data->curremp == 1) $txt = 'No';
        if ($data->curremp == 2) $txt = 'Yes';


        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(174, 7, 'Are you currently employed?');
        $this->fpdf->Cell(0, 7, $txt, 0, 1);

        if ($data->curremp == 2) {

            $this->fpdf->HeadingText();
            $this->fpdf->Cell(0, 7, 'Who is your currently employer/position?', 0, 1);
            $this->fpdf->NormalText();
            $this->fpdf->Cell(0, 7, $data->emppos, 0, 1);
            $this->fpdf->HeadingText();
            $this->fpdf->Cell(0, 7, 'Are you happy with your current position?', 0, 1);
            $this->fpdf->NormalText();
            $this->fpdf->Cell(0, 7, $data->emphappy, 0, 1);


            $this->fpdf->HeadingText();
            $this->fpdf->Cell(0, 7, 'Please list any work-related stressors, if any', 0, 1);
            $this->fpdf->NormalText();
            $this->fpdf->MultiCell(0, 7, $data->workstress, 0, 1);
        }

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'RELIGIOUS/SPIRITUAL INFORMATION', 0, 1, 'C');

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(174, 7, 'Do you consider yourself to be religious?');

        if ($data->religious == 2) {

            $this->fpdf->Cell(0, 7, 'Yes', 0, 1);

            $this->fpdf->HeadingText();
            $this->fpdf->Cell(0, 7, 'What is your faith?', 0, 1);
            $this->fpdf->NormalText();
            $this->fpdf->MultiCell(0, 7, $data->faith, 0, 1);
        } else {

            $this->fpdf->Cell(0, 7, 'No', 0, 1);
            $this->fpdf->HeadingText();
            $this->fpdf->Cell(174, 7, 'Do you consider yourself to be spiritual?');
            $txt = '';
            if ($data->spiritual == 1) $txt = 'No';
            if ($data->spiritual == 2) $txt = 'Yes';
            $this->fpdf->Cell(0, 7, $txt, 0, 1);
        }

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'FAMILY MENTAL HEALTH HISTORY', 0, 1, 'C');


        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(47, 7, 'Has anyone in your family ');
        $this->fpdf->SetFont('', 'I', 10);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(74, 7, '(either immediate family members or relatives)');
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 7, 'experienced difficulties with the', 0, 1);
        $this->fpdf->Cell(20, 7, ' following?');
        $this->fpdf->SetFont('', 'I', 10);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 7, ' (circle any that apply and list family member, e.g. sibling parent, uncle, etc.)', 0, 1);

        $txt = '';
        if ($data->difficulty == 1) $txt = 'Yes';
        if ($data->difficulty == 1) $txt = 'No';

        $this->fpdf->Ln(5);
        $this->fpdf->SetLeftMargin(11);
        $this->fpdf->HeadingText();
        $this->fpdf->SetFont('', 'B', 12);
        $this->fpdf->Cell(90, 10, 'Difficulty', 1, 0);
        $this->fpdf->Cell(20, 10, $txt, 1, 0);
        $this->fpdf->Cell(0, 10, 'Family Member', 1, 1);


        $txt = '';
        if ($data->depr == 1) $txt = 'Yes';
        if ($data->depr == 1) $txt = 'No';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Depression', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->depexp, 1, 1);

        $txt = '';
        if ($data->bipdis == 1) $txt = 'Yes';
        if ($data->bipdis == 1) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Bipolar disorder', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->bipdisexp, 1, 1);

        $txt = '';
        if ($data->anxdis == 1) $txt = 'Yes';
        if ($data->anxdis == 1) $txt = 'No';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Anxiety disorder', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->anxdisexp, 1, 1);

        $txt = '';
        if ($data->panicatt == 1) $txt = 'Yes';
        if ($data->panicatt == 1) $txt = 'No';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Panic attacks', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->panicattexp, 1, 1);


        $txt = '';
        if ($data->sch == 1) $txt = 'Yes';
        if ($data->sch == 1) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Schizophrenia', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->schexp, 1, 1);

        $txt = '';
        if ($data->abuse == 1) $txt = 'Yes';
        if ($data->abuse == 1) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Alcohol/substance abuse', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->abusexp, 1, 1);

        $txt = '';
        if ($data->eatdis == 1) $txt = 'Yes';
        if ($data->eatdis == 1) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Eating disorders', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->eatdisexp, 1, 1);

        $txt = '';
        if ($data->leardis == 1) $txt = 'Yes';
        if ($data->leardis == 1) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Learning disabilities', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->leardisexp, 1, 1);

        $txt = '';
        if ($data->trauma == 1) $txt = 'Yes';
        if ($data->trauma == 1) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Trauma history', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->traumaexp, 1, 1);

        $txt = '';
        if ($data->suiatt == 1) $txt = 'Yes';
        if ($data->suiatt == 1) $txt = 'No';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Suicide attempts', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->suiattexp, 1, 1);

        $txt = '';
        if ($data->chrill == 1) $txt = 'Yes';
        if ($data->chrill == 1) $txt = 'No';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(90, 7, 'Chronic illness', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 7, $txt, 1, 0);
        $this->fpdf->Cell(0, 7, $data->chrillexp, 1, 1);

        $this->fpdf->SetLeftMargin(10);
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'OTHER INFORMATION', 0, 1, 'C');



        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 7, 'What do you consider to be your strengths?', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 7, $data->strength);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 7, 'What do you like most about yourself?', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 7, $data->aboutyou);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 7, 'What are effective coping strategies that you have learned?', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 7, $data->copstra);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 7, 'What are your goals for therapy?', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 7, $data->goalthe);


        $this->fpdf->SetLeftMargin(10);
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('', 'B', 16);
        $this->fpdf->SetTextColor(217, 83, 79);
        $this->fpdf->Cell(0, 10, 'SERVICES BEING PROVIDED TO CONSUMER', 0, 1, 'C');


        $txt = '';
        if ($data->diagassess == 1) $txt .= 'Diagnostic Assessment';
        if ($data->nurse == 1) $txt .= ', Nursing Assessment & Care';
        if ($data->psytest == 1) $txt .= ', Psychological Testing';
        if ($data->psytreat == 1) $txt .= ', Psychiatric Treatment';
        if ($data->medadmin == 1) $txt .= ', Medication Administration';
        if ($data->commsupport == 1) $txt .= ', Community Support Individual';
        if ($data->indout == 1) $txt .= ', Individual Outpatient Services';
        if ($data->outser == 1) $txt .= ', Family Outpatient Services';
        if ($data->groupout == 1) $txt .= ', Group Outpatient Services';
        if ($data->intenfam == 1) $txt .= ', Intensive Family Intervention';
        if ($data->stab == 1) $txt .= ', Crisis Stabilization';
        if ($data->struct == 1) $txt .= ', Structured Activity Supports';
        if ($data->psyassess == 1) $txt .= ', Psychical Assessment';
        if ($data->behass == 1) $txt .= ', Behavior Assistant';
        if ($data->otherr == 1) $txt .= ', Other';
        if ($data->otherr2 == 1) $txt .= ', Other';


        $this->fpdf->HeadingText();
        $this->fpdf->MultiCell(0, 7, $txt);

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();

        exit;
    }

    //Form 10
    public function otr_form(Request $request)
    {

        $data = ot_ten_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();



        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('OUTPATIENT TREATMENT REQUEST [OTR] FORM:');


        $this->fpdf->CC('1) Level of Care: Risk of Harm:', $data->riskharm);
        $this->fpdf->CC('2) Level of Care: Functional Status:', $data->funcstatus);
        $this->fpdf->CC('3) Level of Care: Co-Morbidities:', $data->comorbid);
        $this->fpdf->CC('4) Level of Care: Environmental Stressors:', $data->envstress);
        $this->fpdf->CC('5) Level of Care: Support in the Environment:', $data->suppenv);
        $this->fpdf->CC('6) Level of Care: Response to Current Treatment Plan:', $data->rescurr);
        $this->fpdf->CC('7) Level of Care: Acceptance and Engagement:', $data->acceng);
        $this->fpdf->CC('8) Transportation Available:', $data->transp);
        $this->fpdf->CC('9) Presenting Problems:', $data->present);
        $this->fpdf->CC('10) Current Need for Treatment:', $data->currtreat);
        $this->fpdf->CC('11) Detail Member Behavior within Past 30 days:', $data->detail30);
        $this->fpdf->CC('12) Current Medications:', $data->currmed);
        $this->fpdf->CC('13) Treatment History/Facility:', $data->treat);

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();

        exit;
    }

    //Form 11
    public function cata(Request $request)
    {
        $data = cn_eleven_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('CATALYST NOTES');

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(24, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(66, 5, $data->clname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(22, 5, 'DOS:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->stdate)->format('m-d-Y'), 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(24, 5, 'Therapist:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(66, 5, $data->terp, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(22, 5, 'Start Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(32, 5, Carbon::parse($data->sttitme)->format('h:i A'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->endtime)->format('h:i A'), 1, 1);
        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);


        $this->fpdf->CC('Notes:', $data->notes);
        $this->fpdf->CC('Location:', $data->location);
        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(24, 5, 'Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(66, 5, Carbon::parse($data->lodate)->format('m-d-Y'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(22, 5, 'Start Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(32, 5, Carbon::parse($data->losttime)->format('h:i A'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->loendtime)->format('h:i A'), 1, 1);
        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->CC('Location of Service:', $data->los);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Supervisor present?', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->spyn, 1);
        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(70, 5, 'Caregiver Participated in Session?', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->cpins, 1, 1);
        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);



        $this->fpdf->CC('Strategies used during session:', $data->suds);
        $this->fpdf->CC('Targets worked on during session:', $data->twods);
        $this->fpdf->CC('What notable maladaptive behaviors were observed?', $data->wnmbwo);
        $this->fpdf->CC('If "Other", please describe behaviors:', $data->iopdb);
        $this->fpdf->CC('Notes:', $data->note2);
        $this->fpdf->CC('Location Address:', $data->ladd);

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();

        exit;
    }

    //Form 12
    public function p_training(Request $request)
    {

        $data = pt_twelve_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('PARENT TRAINING SESSION NOTE');


        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'CLIENT INFORMATION:', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(51, 5, $data->clname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'DOB:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(23, 5, Carbon::parse($data->dob)->format('m-d-Y'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Age:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(19, 5, $data->age, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'Insured Id:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(19, 5, $data->insured, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Diagnosis:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->diag, 1, 1);



        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'PROVIDER INFORMATION:', 0, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(30, 5, 'Provider Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(81, 5, $data->p_name, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Credentials:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->cred, 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'INDIVIDUAL PRESENT:', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'Caregiver:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(51, 5, $data->caregiver, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->clname2, 1, 1);

        if ($data->bcbarad != null)
            $this->fpdf->Cell(0, 5, $data->otherexp, 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'PARENT TRAINING SESSION DATE:', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(63.33, 5, 'Service Date:', 1, 0, '', true);
        $this->fpdf->Cell(63.33, 5, 'Service Start Time:', 1, 0, '', true);
        $this->fpdf->Cell(63.33, 5, 'Service End Time:', 1, 1, '', true);


        $this->fpdf->NormalText();


        $this->fpdf->Cell(63.33, 5, Carbon::parse($data->sd)->format('d-m-Y'), 1);
        $this->fpdf->Cell(63.33, 5, Carbon::parse($data->sst)->format('h:i A'), 1);
        $this->fpdf->Cell(63.33, 5, Carbon::parse($data->set)->format('h:i A'), 1, 1);
        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(63.33, 5, 'PARENT TRAINING PROVIDED:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $txt = '';
        if ($data->in_person != null) $txt .= 'In Person, ';
        if ($data->remote != null) $txt .= 'Remote, ';
        $this->fpdf->Cell(0, 5, $txt, 1, 1);



        $this->fpdf->CC('PARENT TRAINING OVERVIEW:', $data->pto);

        $this->fpdf->CC('FEEDBACK TO PARENT:', $data->fd);



        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(95, 5, 'Provider Full Name', 1, 0, '', true);
        $this->fpdf->Cell(95, 5, 'Provider Credentials', 1, 1, '', true);

        $this->fpdf->NormalText();

        $this->fpdf->Cell(95, 5, $data->pfn, 1);
        $this->fpdf->Cell(95, 5, $data->pcred, 1, 1);



        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();

        exit;
    }

    //Form 13
    public function session_notes(Request $request)
    {

        $data = sn_thirteen_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('SESSION NOTES');


        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(51, 5, $data->clname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'DOS:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(23, 5, Carbon::parse($data->sd)->format('m-d-Y'), 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Start Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(19, 5, Carbon::parse($data->stime)->format('h:i A'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(19, 5, Carbon::parse($data->etime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'Units:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(13, 5, $data->units, 1);



        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(16, 5, 'PX Code:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(22, 5, $data->pxcode, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(32, 5, 'Service Location:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->sl, 1, 1);

        $this->fpdf->CC('All Service Code Descriptions:', $data->scd);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'PROVIDERS', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(95, 5, 'Organization Name:', 1, 0, '', true);
        $this->fpdf->Cell(95, 5, 'Provider Name:', 1, 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(95, 5, $data->on, 1);
        $this->fpdf->Cell(95, 5, $data->pname, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(95, 5, 'Provider Credentials:', 1, 0, '', true);
        $this->fpdf->Cell(95, 5, 'Provider NPI:', 1, 1, '', true);


        $this->fpdf->NormalText();
        $this->fpdf->Cell(95, 5, $data->pcr, 1);
        $this->fpdf->Cell(95, 5, $data->pnpi, 1, 1);

        $txt = '';
        if ($data->skill != null) $txt .= 'Skill Acquisition, ';
        if ($data->social != null) $txt .= 'Social Skill Acquisition, ';
        if ($data->role != null) $txt .= 'Role Play, ';
        if ($data->prem != null) $txt .= 'Premack Prinicpal, ';
        if ($data->stimu != null) $txt .= 'Stimulus Prompts, ';
        if ($data->modeling != null) $txt .= 'Video Modeling, ';
        if ($data->shaping != null) $txt .= 'Shaping, ';
        if ($data->contract != null) $txt .= 'Behavior Contract, ';
        if ($data->timer != null) $txt .= 'Timer, ';
        if ($data->tboard != null) $txt .= 'Token Board, ';
        if ($data->selfm != null) $txt .= 'Self Monitor, ';
        if ($data->dtt != null) $txt .= 'DTT, ';
        if ($data->antm != null) $txt .= 'Antecedent Manipulation, ';
        if ($data->selfmn != null) $txt .= 'Self Management, ';
        if ($data->diffrein != null) $txt .= 'Differential Reinforcement, ';
        if ($data->fct != null) $txt .= 'FCT, ';
        if ($data->vaid != null) $txt .= 'Visual Aid, ';
        if ($data->errorlearn != null) $txt .= 'Errorless Learning, ';
        if ($data->net != null) $txt .= 'NET, ';
        if ($data->chaining != null) $txt .= 'Chaining, ';
        if ($data->others != null) $txt .= 'Others:';
        if ($data->other2 != null) $txt .= $data->other2;

        $this->fpdf->CC('PROCEDURES USED:', $txt);
        $this->fpdf->Ln();

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'GOALS FOR SESSIONS:', 0, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(30, 5, 'Service Type:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->stype, 1, 1);



        $this->fpdf->CC('Session Notes:', $data->sessionnotes);
        $this->fpdf->CC('SESSION SUMMARY:', $data->ssummary);

        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(95, 5, 'Provider Full Name', 1, 0, '', true);
        $this->fpdf->Cell(95, 5, 'Provider Credentials', 1, 1, '', true);

        $this->fpdf->NormalText();

        $this->fpdf->Cell(95, 5, $data->provider_name, 1);
        $this->fpdf->Cell(95, 5, $data->pcredent, 1, 1);

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();


        exit;
    }

    //Form 14
    public function reg_form_1(Request $request)
    {
        $data = register_fourteen_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('SUPERVISION: REGISTERED BEHAVIOR TECHNICIANE');


        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, "CLIENT INFORMATION", 0, 1);




        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(80, 5, $data->clname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'DOB:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(23, 5, $data->dob, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Age:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->age, 1, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Diagnosis:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->diagnosis, 1, 1);


        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, "SUPERVISOR/SUPERVISEE INFORMATION:", 0, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(95, 5, 'Supervisor\'s Name (BCBA/BCaBA):', 1, 0, '', true);
        $this->fpdf->Cell(95, 5, 'Registered Behavior Technician\'s Name:', 1, 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(95, 5, $data->supname, 1);
        $this->fpdf->Cell(95, 5, $data->regtech, 1, 1);


        $this->fpdf->Ln();

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'SUPERVISED SESSION DATE:', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(63.33, 5, 'Service Date:', 1, 0, '', true);
        $this->fpdf->Cell(63.33, 5, 'Service Start Time:', 1, 0, '', true);
        $this->fpdf->Cell(63.33, 5, 'Service End Time:', 1, 1, '', true);


        $this->fpdf->NormalText();


        $this->fpdf->Cell(63.33, 5, $data->sd, 1);
        $this->fpdf->Cell(63.33, 5, Carbon::parse($data->sst)->format('h:i A'), 1);
        $this->fpdf->Cell(63.33, 5, Carbon::parse($data->set)->format('h:i A'), 1, 1);
        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(55, 5, 'PARENT TRAINING PROVIDED:', 1, 0, '', true);

        $txt = '';
        if ($data->ptperson != null) $txt .= 'In Person, ';
        if ($data->ptremote != null) $txt .= 'Remote, ';

        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1);



        $this->fpdf->CC('SUPERVISION OVERVIEW:', $data->supoverview);
        $this->fpdf->CC('FEEDBACK FROM SUPERVISOR:', $data->supfeed);

        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(95, 5, 'Provider Full Name', 1, 0, '', true);
        $this->fpdf->Cell(95, 5, 'Provider Credentials', 1, 1, '', true);

        $this->fpdf->NormalText();

        $this->fpdf->Cell(95, 5, $data->pfn, 1);
        $this->fpdf->Cell(95, 5, $data->pcred, 1, 1);


        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();


        exit;
    }

    //Form 15
    public function reg_form_2(Request $request)
    {
        $data = register2_fifteen_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }


        $this->fpdf->Title('SUPERVISION: REGISTERED BEHAVIOR TECHNICIAN');


        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'CLIENT INFORMATION:', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(51, 5, $data->clname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'DOB:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(23, 5, Carbon::parse($data->dob)->format('m-d-Y'), 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(21, 5, 'Age:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(19, 5, $data->age, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'Insured Id:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(19, 5, $data->insured, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(32, 5, 'Claims Diagnosis:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->cldiag, 1, 1);



        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, "SUPERVISOR/SUPERVISEE INFORMATION:", 0, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(95, 5, 'Supervisor\'s Name (BCBA/BCaBA):', 1, 0, '', true);
        $this->fpdf->Cell(95, 5, 'Registered Behavior Technician\'s Name:', 1, 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(95, 5, $data->supname, 1);
        $this->fpdf->Cell(95, 5, $data->regtech, 1, 1);


        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'SUPERVISED SESSION DATE:', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(63.33, 5, 'Session Date:', 1, 0, '', true);
        $this->fpdf->Cell(63.33, 5, 'Start Time:', 1, 0, '', true);
        $this->fpdf->Cell(63.33, 5, 'End Time:', 1, 1, '', true);


        $this->fpdf->NormalText();


        $this->fpdf->Cell(63.33, 5, Carbon::parse($data->sd)->format('h:i A'), 1);
        $this->fpdf->Cell(63.33, 5, Carbon::parse($data->sst)->format('h:i A'), 1);
        $this->fpdf->Cell(63.33, 5, Carbon::parse($data->set)->format('h:i A'), 1, 1);
        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(63.33, 5, 'SUPERVISION PROVIDED:', 1, 0, '', true);

        $txt = '';
        if ($data->supprovide == 1) $txt = 'In Person';
        else $txt = 'Remote';
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1);



        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'RBT TASK LIST ITEMS', 0, 1);
        $txt = '';
        if ($data->a_1 != null) $txt .= '
A-1 Prepare for data collection.';
        if ($data->a_2 != null) $txt .= '
A-2 Implement continuous measurement procedures (e.g., frequency, duration).';
        if ($data->a_3 != null) $txt .= '
A-3 Implement discontinuous measurement procedures (e.g., partial & whole interval, momentary time sampling).';
        if ($data->a_4 != null) $txt .= '
A-4 Implement permanent-product recording procedures.';
        if ($data->a_5 != null) $txt .= '
A-5 Enter data and update graphs.';
        if ($data->a_6 != null) $txt .= '
A-6 Describe behavior and environment in observable and measurable terms.';



        $this->fpdf->CC('A. Measurement:', $txt);

        $txt = '';
        if ($data->b_1 != null) $txt .= '
B-1 Conduct preference assessments.';
        if ($data->b_2 != null) $txt .= '
B-2 Assist with individualized assessment procedures (e.g., curriculum-based, developmental, social skills).';
        if ($data->b_3 != null) $txt .= '
B-3 Assist with functional assessment procedures.';



        $this->fpdf->CC('B. Assessment:', $txt);


        $txt = '';
        if ($data->c_1 != null) $txt .= '
C-1 Identify the essential components of a written skill acquisition plan.';
        if ($data->c_2 != null) $txt .= '
C-2 Prepare for the session as required by the skill acquisition plan.';
        if ($data->c_3 != null) $txt .= '
C-3 Use contingencies of reinforcement (e.g., conditioned/unconditioned reinforcement, continuous /intermittent schedules).';
        if ($data->c_4 != null) $txt .= '
C-4 Implement discrete-trial teaching procedures.';
        if ($data->c_5 != null) $txt .= '
C-5 Implement naturalistic teaching procedures (e.g., incidental teaching).';
        if ($data->c_6 != null) $txt .= '
C-6 Implement task analyzed chaining procedures.';
        if ($data->c_7 != null) $txt .= '
C-7 Implement discrimination training.';
        if ($data->c_8 != null) $txt .= '
C-8 Implement stimulus control transfer procedures.';
        if ($data->c_9 != null) $txt .= '
C-9 Implement prompt and prompt fading procedures.';
        if ($data->c_10 != null) $txt .= '
C-10 Implement generalization and maintenance procedures.';
        if ($data->c_11 != null) $txt .= '
C-11 Implement shaping procedures.';
        if ($data->c_12 != null) $txt .= '
C-12 Implement token economy procedures.';


        $this->fpdf->CC('C. Skill Acquisition:', $txt);

        $txt = '';
        if ($data->d_1 != null) $txt .= '
D-1 Identify essential components of a written behavior reduction plan, ';
        if ($data->d_2 != null) $txt .= '
D-2 Describe common functions of behavior, ';
        if ($data->d_3 != null) $txt .= '
D-3 Implement interventions based on modification of antecedents such as motivating operations and discriminative stimuli, ';
        if ($data->d_4 != null) $txt .= '
D-4 Implement differential reinforcement procedures (e.g., DRA, DRO)., ';
        if ($data->d_5 != null) $txt .= '
D-5 Implement extinction procedures, ';
        if ($data->d_6 != null) $txt .= '
D-6 Implement crisis/emergency procedures according to protocol';


        $this->fpdf->CC('D. Behavior Reduction:', $txt);

        $txt = '';
        if ($data->e_1 != null) $txt .= '
E-1 Effectively communicate with a supervisor in an ongoing manner.';
        if ($data->e_2 != null) $txt .= '
E-2 Actively seek clinical direction from supervisor in a timely manner.';
        if ($data->e_3 != null) $txt .= '
E-3 Report other variables that might affect the client in a timely manner.';
        if ($data->e_4 != null) $txt .= '
E-4 Generate objective session notes for service verification by describing what occurred during the sessions, in accordance with applicable legal, regulatory, and workplace requirements.';
        if ($data->e_5 != null) $txt .= '
E-5 Comply with applicable legal, regulatory, and workplace data collection, storage, transportation, and documentation requirements.';


        $this->fpdf->CC('E. E-Documentation and Reporting:', $txt);

        $txt = '';
        if ($data->f_1 != null) $txt .= '
F-1 Describe the BACB\'s RBT supervision requirements and the role of RBTs in the service-delivery system.';
        if ($data->f_2 != null) $txt .= '
F-2 Respond appropriately to feedback and maintain or improve performance accordingly.';
        if ($data->f_3 != null) $txt .= '
F-3 Communicate with stakeholders (e.g., family, caregivers, other professionals) as authorized.';
        if ($data->f_4 != null) $txt .= '
F-4 Maintain professional boundaries (e.g., avoid dual relationships, conflicts of interest, social media contacts).';
        if ($data->f_5 != null) $txt .= '
F-5 Maintain client dignity.';



        $this->fpdf->CC('F. Professional Conduct and Scope of Practice:', $txt);


        $this->fpdf->CC('SUPERVISION OVERVIEW::', $data->supfeed);
        $this->fpdf->CC('FEEDBACK TO SUPERVISER::', $data->supoverview);

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();

        exit;
    }

    //Form 16
    public function service_plan(Request $request)
    {
        $data = sp_sixteen_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('BEHAVIOR ASSESSMENT SERVICE PLAN');
        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'CLIENT INFORMATION:', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(30, 5, 'Recipient Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->rec_name, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'ID:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, $data->ide, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(10, 5, 'Age:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(15, 5, $data->age, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(10, 5, 'DOB:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->dob, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(45, 5, 'Parent/Guardian Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(67, 5, $data->gname, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(35, 5, 'Guardian Contact:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->gcontact, 1, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'Address:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->address, 1, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(42, 5, 'Report Completed on:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->comdate, 1, 1);

        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(35, 5, 'Authored By:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->auth, 1, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(63.33, 5, 'Name:', 1, 0, '', true);
        $this->fpdf->Cell(63.33, 5, 'BCBA Certificate:', 1, 0, '', true);
        $this->fpdf->Cell(63.33, 5, 'NPI#:', 1, 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(63.33, 5, $data->authname, 1);
        $this->fpdf->Cell(63.33, 5, $data->bacbcer, 1);
        $this->fpdf->Cell(63.33, 5, $data->npi, 1, 1);

        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Recipient Diagnosis:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->recdia, 1, 1);


        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(37, 5, 'Referring Physician:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->refer, 1, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(95, 5, 'Name:', 1, 0, '', true);
        $this->fpdf->Cell(95, 5, 'NPI#:', 1, 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(95, 5, $data->phyname, 1);
        $this->fpdf->Cell(95, 5, $data->phynpi, 1, 1);


        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(42, 5, 'Physician Contact Info:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->phycontact, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(42, 5, 'Intervention Settings:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->intset, 1, 1);

        $this->fpdf->Ln();

        $txt = '';
        if ($data->radio1 == 1) $txt = 'Initial Assessment';
        if ($data->radio1 == 2) $txt = 'Reassessment';

        $this->fpdf->Cell(0, 5, $txt, 0, 1);

        $this->fpdf->CC('BACKGROUND INFORMATION', $data->bginfo);
        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'DOCUMENTS REVIEWED');

        $this->fpdf->CC('Medical Issues', $data->mdissue);

        $this->fpdf->CC('Reason for Referral:', $data->resref);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, 'ANECDOTAL REPORT', 0, 1, 'C');
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'MEDICATION', 0, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(55, 5, 'Date/Setting:', 1, 0, '', true);
        $this->fpdf->Cell(45, 5, 'Antecedent:', 1, 0, '', true);
        $this->fpdf->Cell(45, 5, 'Behavior:', 1, 0, '', true);
        $this->fpdf->Cell(45, 5, 'Consequence:', 1, 1, '', true);


        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, $data->date1, 1);
        $this->fpdf->Cell(45, 5, $data->ant1, 1);
        $this->fpdf->Cell(45, 5, $data->beh1, 1);
        $this->fpdf->Cell(45, 5, $data->con1, 1, 1);

        $this->fpdf->Cell(55, 5, $data->date2, 1);
        $this->fpdf->Cell(45, 5, $data->ant2, 1);
        $this->fpdf->Cell(45, 5, $data->beh2, 1);
        $this->fpdf->Cell(45, 5, $data->con2, 1, 1);

        $this->fpdf->Cell(55, 5, $data->date3, 1);
        $this->fpdf->Cell(45, 5, $data->ant3, 1);
        $this->fpdf->Cell(45, 5, $data->beh3, 1);
        $this->fpdf->Cell(45, 5, $data->con3, 1, 1);


        $data = sp_sixteen2_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();




        $this->fpdf->Ln();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, 'STRENGTHS AND WEAKNESSES', 0, 1, 'C');
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'PROCEDURAL CHECKLIST', 0, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(70, 5, 'Medication Name:', 1, 0, '', true);
        $this->fpdf->Cell(40, 5, 'Dosage:', 1, 0, '', true);
        $this->fpdf->Cell(40, 5, 'Purpose:', 1, 0, '', true);
        $this->fpdf->Cell(40, 5, 'Side Effects:', 1, 1, '', true);


        $this->fpdf->NormalText();
        $this->fpdf->Cell(70, 5, $data->medn1, 1);
        $this->fpdf->Cell(40, 5, $data->dos1, 1);
        $this->fpdf->Cell(40, 5, $data->pur1, 1);
        $this->fpdf->Cell(40, 5, $data->side1, 1, 1);

        $this->fpdf->Cell(70, 5, $data->medn2, 1);
        $this->fpdf->Cell(40, 5, $data->dos2, 1);
        $this->fpdf->Cell(40, 5, $data->pur2, 1);
        $this->fpdf->Cell(40, 5, $data->side2, 1, 1);

        $this->fpdf->Cell(70, 5, $data->medn3, 1);
        $this->fpdf->Cell(40, 5, $data->dos3, 1);
        $this->fpdf->Cell(40, 5, $data->pur3, 1);
        $this->fpdf->Cell(40, 5, $data->side3, 1, 1);





        $this->fpdf->Ln();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, 'BEHAVIOR PLAN COMPONENTS', 0, 1, 'C');
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'PROCEDURAL CHECKLIST', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(60, 5, 'Behavior Targeted for Reduction', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->beh, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Function/s:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->func, 1, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Baseline:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->bline, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Intensity:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->inten, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Data Measured with:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->datam, 1, 1);


        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'ASSESSMENTS CONDUCTED/FUNCTION', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(0, 5, 'Patterns Identified:', 1, 1, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->patid, 1, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(0, 5, 'Assessment of Basic Language and Learning Skills-Revised::', 1, 1, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->blang, 1, 1);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'FAMILY/CAREGIVER INVOLVEMENT', 0, 1);
        $this->fpdf->CC('Goal 1:', $data->goal1);
        $this->fpdf->CC('Goal 2:', $data->goal2);
        $this->fpdf->CC('Goal 3:', $data->goal3);

        $this->fpdf->CC('Generalization Training:', $data->gtrain);
        $this->fpdf->CC('Target Problem Behavior Goals:', $data->tgbgoal);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'SKILLS ACQUISITION GOALS', 0, 1);

        $this->fpdf->CC('Context/Antecedent(s):', $data->contextant);
        $this->fpdf->CC('Behavior(s):', $data->behv);
        $this->fpdf->CC('Function:', $data->funccon);
        $this->fpdf->CC('Consequence(s):', $data->consq);
        $this->fpdf->CC('Preventive Strategies (antecedent-based):', $data->preventst);
        $this->fpdf->CC('Replacement Skills (related to function):', $data->repskills);
        $this->fpdf->CC('Management Strategies (consequence-based):', $data->managest);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'INSTRUCTIONAL GOALS', 0, 1);

        $this->fpdf->CC('Long Term Objective Status:', $data->ltstat);
        $this->fpdf->CC('Long Term Objective:', $data->ltobj);
        $this->fpdf->CC('Intermediate Objective:', $data->interobj);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Target Behavior:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->tarbeh, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Short Term Objective:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->stobj, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Measure:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->mes, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Status:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->sttatus, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Baseline Level:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->baselevel, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Current Level:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->clevel, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Mastery Criteria:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->mcriteria, 1, 1);


        $this->fpdf->Ln();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, 'INTERVENTIONS', 0, 1, 'C');
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'PREFERENCE ASSESSMENT', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 5, 'Preference Assessment completed using parent interview, direct observation conducted on ____________');
        $this->fpdf->MultiCell(0, 5, 'Observations and preference assessments indicate that client is highly motivated by the following reinforcers.');

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'Activities', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->act, 1, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'Food/Drink', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->drink, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'Games/Toys', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->games, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'Social', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->social, 1, 1);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'RISK ASSESSMENT', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'Risk:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->risk, 1, 1);
        $this->fpdf->CC('Notes:', $data->notes);

        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'Benefit:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->benefit, 1, 1);
        $this->fpdf->CC('Notes:', $data->nott);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'MAINTAINING AND TRANSFERRING PROGRESS TO ALL RELEVANT SETTINGS', 0, 1);

        $this->fpdf->CC('Generalization:', $data->genez);
        $this->fpdf->CC('Maintenance:', $data->maint);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, 'PLAN FOR FADING SERVICES', 0, 1, 'C');


        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'Phase 1', 0, 1);
        $this->fpdf->CC('Action Steps:', $data->actstep1);
        $this->fpdf->CC('Criteria:', $data->crit1);
        $this->fpdf->CC('Time Frame:', $data->tframe1);
        $this->fpdf->CC('Service Reduction Behavior Analyst:', $data->srba1);
        $this->fpdf->CC('Service Reduction Behavior Assistant:', $data->srbas1);
        $this->fpdf->CC('Next Level of Care of Transition Notes:', $data->nlct1);
        $this->fpdf->CC('Description:', $data->desc1);
        $this->fpdf->Ln();


        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'Phase 2', 0, 1);
        $this->fpdf->CC('Action Steps:', $data->actstep2);
        $this->fpdf->CC('Criteria:', $data->crit2);
        $this->fpdf->CC('Time Frame:', $data->tframe2);
        $this->fpdf->CC('Service Reduction Behavior Analyst:', $data->srba2);
        $this->fpdf->CC('Service Reduction Behavior Assistant:', $data->srbas2);
        $this->fpdf->CC('Next Level of Care of Transition Notes:', $data->nlct2);
        $this->fpdf->CC('Description:', $data->desc2);
        $this->fpdf->Ln();


        $data = sp_sixteen3_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'Phase 3', 0, 1);
        $this->fpdf->CC('Action Steps:', $data->actstep3);
        $this->fpdf->CC('Criteria:', $data->crit3);
        $this->fpdf->CC('Time Frame:', $data->tframe3);
        $this->fpdf->CC('Service Reduction Behavior Analyst:', $data->srba3);
        $this->fpdf->CC('Service Reduction Behavior Assistant:', $data->srbas3);
        $this->fpdf->CC('Next Level of Care of Transition Notes:', $data->nlct3);
        $this->fpdf->CC('Description:', $data->desc3);
        $this->fpdf->Ln();

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'Phase 4', 0, 1);
        $this->fpdf->CC('Action Steps:', $data->actstep4);
        $this->fpdf->CC('Criteria:', $data->crit4);
        $this->fpdf->CC('Time Frame:', $data->tframe4);
        $this->fpdf->CC('Service Reduction Behavior Analyst:', $data->srba4);
        $this->fpdf->CC('Service Reduction Behavior Assistant:', $data->srbas4);
        $this->fpdf->CC('Next Level of Care of Transition Notes:', $data->nlct4);
        $this->fpdf->CC('Description:', $data->desc4);
        $this->fpdf->Ln();



        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'CRISIS PLAN');


        $this->fpdf->CC('Emergency protocol:', $data->emgprot);
        $this->fpdf->CC('Communication with other providers:', $data->compr);



        $this->fpdf->Ln();

        $this->fpdf->SetFont('', 'B');
        $this->fpdf->MultiCell(0, 5, 'Have you communicated with the recipient\'s prescriber of psychotropic drugs?');
        $this->fpdf->SetFont('');
        $this->fpdf->Cell(0, 5, $data->psydrug, 0, 1);

        $txt = '';

        if ($data->psydrug == 1) $txt = "Yes";
        if ($data->psydrug == 2) $txt = "No";
        if ($data->psydrug == 3) $txt = "Recipient Declined N/A, provider is the prescriber";
        if ($data->psydrug == 4) $txt = "N/A recipient is not on medications";



        $this->fpdf->SetFont('', 'B');
        $this->fpdf->MultiCell(0, 5, 'Have you communicated with the recipient\'s P.C.P.?');
        $this->fpdf->SetFont('');
        $this->fpdf->Cell(0, 5, $txt, 0, 1);

        $txt = '';

        if ($data->pcp == 1) $txt = "Yes";
        if ($data->pcp == 2) $txt = "No";
        if ($data->pcp == 3) $txt = "Recipient Declined";

        $this->fpdf->SetFont('', 'B');
        $this->fpdf->MultiCell(0, 5, 'Have you documented the communication or recipient declination?');

        $this->fpdf->SetFont('');
        $this->fpdf->Cell(0, 5, $txt, 0, 1);

        $txt = '';

        if ($data->decline == 1) $txt = "Yes";
        if ($data->decline == 2) $txt = "No";
        if ($data->decline == 3) $txt = "N/A, I did not contact P.C.P.";

        $this->fpdf->SetFont('', 'B');
        $this->fpdf->MultiCell(0, 5, 'Have you been in communication with other Behavior Health (B.H.) providers for this recipient?');
        $this->fpdf->SetFont('');
        $this->fpdf->Cell(0, 5, $txt, 0, 1);


        $txt = '';

        if ($data->bh == 1) $txt = $data->bhtype;
        if ($data->bh == 2) $txt = "No";
        if ($data->bh == 3) $txt = "N/A";


        $this->fpdf->SetFont('', 'B');
        $this->fpdf->MultiCell(0, 5, 'If yes, please indicate the type of B.H. provider.');
        $this->fpdf->SetFont('');
        $this->fpdf->Cell(0, 5, $txt, 0, 1);



        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, 'SUMMARY AND RECOMMENDATIONS', 0, 1, 'C');

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'RATIONALE/JUSTIFICATION:', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(50, 5, 'Services', 1, 0, '', true);
        $this->fpdf->Cell(0, 5, 'Hours per week/Month', 1, 1, 'C', true);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(50, 5, 'Lead Analyst: (H2019)', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->leadh, 1, 1, 'C');


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(50, 5, 'RBT (H2014)', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->rbth, 1, 1, 'C');


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(50, 5, 'Total recommended hours', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->trh, 1, 1, 'C');


        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Service Provider', 1, 0, '', true);
        $this->fpdf->Cell(30, 5, 'Monday', 1, 0, 'C', true);
        $this->fpdf->Cell(30, 5, 'Tuesday', 1, 0, 'C', true);
        $this->fpdf->Cell(30, 5, 'Wednesday', 1, 0, 'C', true);
        $this->fpdf->Cell(30, 5, 'Thursday', 1, 0, 'C', true);
        $this->fpdf->Cell(30, 5, 'Friday', 1, 1, 'C', true);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'BCBA', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, $data->bcbam, 1, 0, 'C');
        $this->fpdf->Cell(30, 5, $data->bcbatu, 1, 0, 'C');
        $this->fpdf->Cell(30, 5, $data->bcbawe, 1, 0, 'C');
        $this->fpdf->Cell(30, 5, $data->bcbath, 1, 0, 'C');
        $this->fpdf->Cell(30, 5, $data->bcbafri, 1, 1, 'C');

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'RBT', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, $data->rbtm, 1, 0, 'C');
        $this->fpdf->Cell(30, 5, $data->rbttu, 1, 0, 'C');
        $this->fpdf->Cell(30, 5, $data->rbtwe, 1, 0, 'C');
        $this->fpdf->Cell(30, 5, $data->rbtth, 1, 0, 'C');
        $this->fpdf->Cell(30, 5, $data->rbtfri, 1, 1, 'C');

        $this->fpdf->Ln();
        $this->fpdf->MultiCell(0, 5, 'Per Rule 59G-1.010, Florida Administrative Code (F.A.C.)');
        $this->fpdf->MultiCell(0, 5, 'CLIENT demonstrates medical necessity for services per the Functional Behavior Assessment and as described below, demonstrates deficits in verbal behavior, self-care, living skills, safety skills, adaptive living skills, and problem behaviors that are functioning as a barrier to further development and places the CLIENT at risk of significant disability and jeopardizes safety. The behavior analysis services described in the plan are necessary to protect life and prevent significant disability; they are also individualized, specific, and consistent with the confirmed diagnosis under treatment, and not more than the patient\'s needs. They are consistent with generally accepted professional medical standards as determined by the Medicaid program and not are not experimental or investigational. The services are reflective of the level of service that can be safely furnished, and for which there are currently not equally effective and more conservative or less costly treatment is available statewide and are furnished in a manner not primarily intended for the convenience of the recipient, the recipient\'s caretaker, or the provider');


        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, 'CONSENT TO TREATMENT', 0, 1, 'C');

        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 5, 'I hereby provide my consent to implement the behavior support plan for CLIENT developed by Falls Family Center, LLLC on ____________________. I understand that the interventions in this plan have been designed to result in the reduction of PROBLEM BEHAVIORS and enhance CLIENT\'s skills in communication, socialization, independence, and self-advocacy, as well as improve his/her overall quality of life. I agree that implementation of CLIENT\'s behavior support plan will occur in the school /home and involve the participation of the following individuals: CAREGIVER NAME (CAREGIVER RELATIONSHIP TO CLIENT). Commitment of these individuals to participate in plan implementation is evidenced by their signatures at the bottom of this form.');

        $this->fpdf->MultiCell(0, 5, 'The interventions included in this behavior support plan include modifications to CLIENT\'s surroundings and social conditions to reduce the likelihood of his/her challenging behavior and improve his/her independence, systematic instruction to shape and strengthen adaptive skills, and strategies to manage the consequences of CLIENT\'s behavior so that reinforcement is maximized for positive behavior and withheld or minimized for problem behavior. Specific strategies include using visuals/token boards to increase independence, prompting to increase spontaneous skills, and shaping socialization to improve relationships.');

        $this->fpdf->MultiCell(0, 5, 'I have had an opportunity to review the complete behavior support plan verbally and in written form and get clarification in response to any questions I have. I agree to be an active participant in implementing and/or supporting the implementation of this behavior intervention plan, participating in training, and monitoring to promote its success. I have been made aware of potential risks (including the possibility that CLIENT\'s behavior may escalate before improving and/or vary across settings based on how the plan is implemented, if relevant) and the anticipated benefits of intervention. I understand that these procedures can only be implemented as written with my approval. I reserve the right to refuse or discontinue consent to the plan or specific intervention practices at any point without repercussions. If I withdraw consent, interventions will be discontinued immediately. I recognize the importance of fidelity and consistency, and therefore agree to make every effort to implement the plan as designed.');


        $this->fpdf->Ln();
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'BACB Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->bacbname, 1, 1);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'BACB Certificate:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->bacbcer, 1, 1);

        //Signature Module

        if ($this->fpdf->GetY() > 247) {
            $this->fpdf->AddPage();
        }

        $up_date = Carbon::parse($data->updated_at)->format('m-d-Y');
        $this->fpdf->Ln(5);
        $this->fpdf->Image(public_path('/') . $data->signature, 25, $this->fpdf->GetY(), 40, 20);
        $this->fpdf->Image(public_path('/') . $data->updload_sign, 140, $this->fpdf->GetY(), 40, 20);
        $this->fpdf->SetXY(10, $this->fpdf->GetY() + 25);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(40, 5, 'BACB\'s Signature', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, ' (' . $up_date . ')', 'T');

        $this->fpdf->Cell(45, 5, '');
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(40, 5, 'Caregiver\'s Signature', 'T');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, ' (' . $up_date . ')', 'T');

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
        exit;
    }


    //Form 17
    public function cp_clinical(Request $request)
    {
        $data = cp_seventeen_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('CLINICAL FORM');

        $this->fpdf->CC('Current clinical status', $data->currstatus, 'black', 'B', 11);
        $this->fpdf->CC('Goals Targeted(Behaviors for increase) addressed during this session: (For daily progress, please see graphed data)', $data->goaltarget, 'black', 'B', 9);
        $this->fpdf->CC('Goals Targeted(Behaviors for decrease) addressed during this session noted', $data->goaladdress, 'black', 'B', 11);
        $this->fpdf->CC('Techniques Attempted During Session', $data->techattempt, 'black', 'B', 11);
        $this->fpdf->CC('Response to Treatment/Outcomes', $data->restreat, 'black', 'B', 11);
        $this->fpdf->CC('Progress Toward Treatment Goals', $data->progressdata, 'black', 'B', 11);
        $this->fpdf->CC('Length of Supervision of Session', $data->lengthsup, 'black', 'B', 11);
        $this->fpdf->CC('Rendering behavioral technician', $data->rendbehtech, 'black', 'B', 11);
        $this->fpdf->CC('Supervisor Providing Supervision', $data->superprovide, 'black', 'B', 11);
        $this->fpdf->CC('Feedback/Constructive Criticism Provided', $data->feedbackcrit, 'black', 'B', 11);


        $txt = '';
        if ($data->client != null) $txt .= 'Client, ';
        if ($data->therapist != null) $txt .= 'Therapist, ';
        if ($data->render_prov != null) $txt .= 'Rendering Provider';

        $this->fpdf->Ln(5);
        if ($this->fpdf->GetY() > 270) $this->fpdf->AddPage();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, $txt, 0, 0, '');

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }

    //Form 18
    public function cp_notes(Request $request)
    {
        $data = cp_eighteen_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }


        $this->fpdf->Title('NOTES');

        $this->fpdf->CC('Clinical Status', $data->clinicstatus, 'black', 'B', 11);
        $this->fpdf->CC('Who was present during the session', $data->whopresent, 'black', 'B', 11);
        $this->fpdf->CC('Behavior targeted for decrease', $data->behatarget, 'black', 'B', 11);
        $this->fpdf->CC('Techniques used during the session', $data->techused, 'black', 'B', 11);
        $this->fpdf->CC('Programs worked on', $data->programwork, 'black', 'B', 11);
        $this->fpdf->CC('Reinforcers used', $data->reinforce, 'black', 'B', 11);
        $this->fpdf->CC('Client Progress', $data->clientprogress, 'black', 'B', 11);
        $this->fpdf->CC('Plan for next session', $data->plannext, 'black', 'B', 11);


        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }


    //Form 19
    public function cp_soap(Request $request)
    {
        $data = cp_ninteen_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('SOAP');

        $this->fpdf->CC('Subjective', $data->subjective, 'black', 'B', 11);
        $this->fpdf->CC('Objective', $data->objective, 'black', 'B', 11);
        $this->fpdf->CC('Assessment', $data->assessment, 'black', 'B', 11);
        $this->fpdf->CC('Plan', $data->plan, 'black', 'B', 11);


        $txt = '';
        if ($data->client != null) $txt .= 'Client, ';
        if ($data->therapist != null) $txt .= 'Therapist, ';
        if ($data->render_prov != null) $txt .= 'Rendering Provider';

        $this->fpdf->Ln(5);
        if ($this->fpdf->GetY() > 270) $this->fpdf->AddPage();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, $txt, 0, 0, '');

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }

    //Form 20
    public function gs_assessment(Request $request)
    {
        $data = gs_twenty_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('ASSESSMENT FORM');

        $txt = '';
        if ($data->task == 1) $txt = 'Direct Assessment';
        if ($data->task == 2) $txt = 'Indirect Assessment';
        if ($data->task == 3) $txt = 'Creating Goals Language';
        if ($data->task == 4) $txt = 'Creating Behavior Intervention Plan Language';
        if ($data->task == 5) $txt = 'Creating Report Language';

        $this->fpdf->CC('Task Completed', $txt, 'black', 'B', 11);
        $this->fpdf->CC('Assessment Tools Used (Specify Indirect or Direct)', $data->assesstool, 'black', 'B', 11);
        $this->fpdf->CC('Description of Tasks Completed', $data->destask, 'black', 'B', 11);


        $txt = '';
        if ($data->client != null) $txt .= 'Client, ';
        if ($data->therapist != null) $txt .= 'Therapist, ';
        if ($data->render_prov != null) $txt .= 'Rendering Provider';

        $this->fpdf->Ln(5);
        if ($this->fpdf->GetY() > 270) $this->fpdf->AddPage();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, $txt, 0, 0, '');

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }

    //Form 21
    public function gs_parent(Request $request)
    {
        $data = gs_twentyone_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('PARENT TRAINING FORM');

        $txt = '';
        if ($data->parti == 1) $txt = 'BCBA';
        if ($data->parti == 2) $txt = 'Parent/Caregiver';
        if ($data->parti == 3) $txt = 'Behavior Therapist Language';
        if ($data->parti == 4) $txt = 'Learner Language';


        $this->fpdf->CC('Participants', $txt, 'black', 'B', 11);
        $this->fpdf->CC('Recommendations Provided to Parent', $data->recm, 'black', 'B', 11);
        $this->fpdf->CC('Goals Addressed', $data->goaladdress, 'black', 'B', 11);
        $this->fpdf->CC('Interventions Suggested/Modeled', $data->intervent, 'black', 'B', 11);
        $this->fpdf->CC('Feedback from Parent/Caregiver', $data->feedback, 'black', 'B', 11);


        $txt = '';
        if ($data->client != null) $txt .= 'Client, ';
        if ($data->therapist != null) $txt .= 'Therapist, ';
        if ($data->render_prov != null) $txt .= 'Rendering Provider';

        $this->fpdf->Ln(5);
        if ($this->fpdf->GetY() > 270) $this->fpdf->AddPage();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, $txt, 0, 0, '');

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }

    //Form 22
    public function gs_supervision(Request $request)
    {
        $data = gs_twentytwo_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('SUPERVISION FORM');

        $txt = '';
        if ($data->defict == 1) $txt = 'Social';
        if ($data->defict == 2) $txt = 'Play Skills';
        if ($data->defict == 3) $txt = 'Expressive Language';
        if ($data->defict == 4) $txt = 'Receptive Language';
        if ($data->defict == 5) $txt = 'Maladaptive Behaviors';
        if ($data->defict == 6) $txt = 'Restrictive and Repetitive Interests';


        $this->fpdf->CC('Deficits Addressed', $txt, 'black', 'B', 11);
        $this->fpdf->CC('Problem Behavior Observed', $data->pbo, 'black', 'B', 11);
        $this->fpdf->CC('Interventions Used', $data->iu, 'black', 'B', 11);
        $this->fpdf->CC('Progress Noted', $data->pn, 'black', 'B', 11);
        $this->fpdf->CC('Feedback Provided to Therapist', $data->fpt, 'black', 'B', 11);


        $txt = '';
        if ($data->client != null) $txt .= 'Client, ';
        if ($data->therapist != null) $txt .= 'Therapist, ';
        if ($data->render_prov != null) $txt .= 'Rendering Provider';

        $this->fpdf->Ln(5);
        if ($this->fpdf->GetY() > 270) $this->fpdf->AddPage();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, $txt, 0, 0, '');

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }

    //Form 23
    public function gs_treatment(Request $request)
    {
        $data = gs_twentythree_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('TREATMENT PLAN FORM');

        $txt = '';
        if ($data->task == 1) $txt = 'Analyzing Data';
        if ($data->task == 2) $txt = 'Modifying Program';
        if ($data->task == 3) $txt = 'Modifying/Adding Goals';
        if ($data->task == 4) $txt = 'Developing BIP';
        if ($data->task == 5) $txt = 'Developing Plan';

        $this->fpdf->CC('Task Completed', $txt, 'black', 'B', 11);
        $this->fpdf->CC('Description of Tasks Completed', $data->taskdes, 'black', 'B', 11);


        $txt = '';
        if ($data->client != null) $txt .= 'Client, ';
        if ($data->therapist != null) $txt .= 'Therapist, ';
        if ($data->render_prov != null) $txt .= 'Rendering Provider';

        $this->fpdf->Ln(5);
        if ($this->fpdf->GetY() > 270) $this->fpdf->AddPage();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, $txt, 0, 0, '');

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }

    //Form 24
    public function biopsych(Request $request)
    {
        $data = bio_twentyfour_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $data->data = '';


        $this->fpdf->Title('BIOPSYCHOSOCIAL');

        $this->fpdf->CC('Presenting Problem', $data->presentprob, 'black', 'B', 11, '(Why are they here? In client\'s own words when possible. Please include current behavior/ past 30 days of client\'s behavior)');

        $this->fpdf->CC('History:', $data->history, 'black', 'B', 11, '(Early symptoms and past diagnosis; describe the onset of symptoms)');

        $this->fpdf->CC('Risk of Harm:', $data->riskharm, 'black', 'B', 11, '(high risks behaviors i.e. SI/HI, Impulse Control, Substance Use, Sexual behavior /Perpetrator)');

        $this->fpdf->CC('Trauma:', $data->trauma, 'black', 'B', 11, '(i.e. sexual abuse, physical abuse, etc)');
        $this->fpdf->CC('Comorbidities:', $data->comorbid, 'black', 'B', 11);

        $this->fpdf->CC('Environmental Stressors:', $data->environ, 'black', 'B', 11, '(i.e. gang activity, poverty, etc)');

        $this->fpdf->CC('Deficits in Support System:', $data->defictsupport, 'black', 'B', 11, '(i.e. single parent household)');

        $this->fpdf->CC('Transportation:', $data->transportation, 'black', 'B', 11);

        $this->fpdf->CC('What service(s) is the client requesting?:', $data->clientrequest, 'black', 'B', 11, '(What do you want to get out of the services?)');

        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 260) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'Lifespan/Developmental History', 0, 1, 'C');
        $this->fpdf->CC('What is the client\'s prenatal history?:', $data->prenatal, 'black', 'B', 11);
        $this->fpdf->CC('Health at birth:', $data->health, 'black', 'B', 11);
        $this->fpdf->CC('Developmental milestones:', $data->devmile, 'black', 'B', 11);
        $this->fpdf->CC('Special services received during lifetime:', $data->specialserv, 'black', 'B', 11);
        $this->fpdf->CC('Other lifespan/developmental issues:', $data->otherlife, 'black', 'B', 11, '(Include mid-life, senior/elder, other issues)');



        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'Education Assessment', 0, 1, 'C');
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(50, 5, 'School currently attending');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(100, 5, $data->attending, 0, 1);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(50, 5, 'Grade');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(100, 5, $data->grade, 0, 1);
        $this->fpdf->CC('Has the client ever been suspended or expelled from school and/or bus?:', $data->expell, 'black', 'B', 11, '(Include both in-school suspensions and out-of-school suspensions) If so, include the number of times, dates of suspension and duration of suspension.');

        $txt = '';
        if ($data->absences == 1) $txt = "Yes";
        if ($data->absences == 2) $txt = "No";

        $this->fpdf->Ln(5);
        $this->fpdf->SetWidths(array(140, 50));
        $this->fpdf->Row(array('Does the client have frequent absences?', $txt));
        $txt = '';
        if ($data->retained == 1) $txt = "Yes";
        if ($data->retained == 2) $txt = "No";
        $this->fpdf->Row(array('Is the client currently failing, and has the client ever been retained?', $txt));
        $txt = '';
        if ($data->classes == 1) $txt = "Yes";
        if ($data->classes == 2) $txt = "No";
        $this->fpdf->Row(array('Is the client in special education classes?', $txt));

        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'Family of Origin History', 0, 1, 'C');




        $this->fpdf->CC('Family\'s current and past psychiatric history:', $data->pastpsy, 'black', 'B', 11);
        $this->fpdf->CC('Family\'s and client\'s physical/sexual/emotional abuse history:', $data->physical, 'black', 'B', 11);
        $this->fpdf->CC('Family\'s substance use/abuse history:', $data->substance, 'black', 'B', 11);
        $this->fpdf->CC('Families Presentation of the Problem:', $data->present, 'black', 'B', 11);
        $this->fpdf->CC('Families Expected Outcome for Services:', $data->outcome, 'black', 'B', 11);

        $this->fpdf->CC('Client\'s Current and Significant Past Supports:', $data->pastsupport, 'black', 'B', 11, '(Social supports, family supports, significant relationships, religious and spiritual supports/affiliations.)');

        $this->fpdf->CC('Other Providers/Systems involved with:', $data->otherprovider, 'black', 'B', 11, '(List agencies client is involved with or receiving services from. For example: CalWORKs, ASOC, Inpatient/outpatient hospitalization, Rehab centers, etc; Include the name of the agency and primary contact person)');

        $txt = '';
        if ($data->lhistinfo != null) $txt .= 'Informal Probation';
        if ($data->lhistwel != null) $txt .= 'Formal Probation, ';
        if ($data->lhistrestrain != null) $txt .= 'Parole, ';
        if ($data->lhistformal != null) $txt .= 'Child Welfare Services, ';
        if ($data->lhistconserv != null) $txt .= 'Conservatorship, ';
        if ($data->lhistnone != null) $txt .= 'D. U. I., ';
        if ($data->lhistparole != null) $txt .= 'Restraining Order, ';
        if ($data->lhistdui != null) $txt .= 'None reported';



        $this->fpdf->SetWidths(array(40, 150));
        $this->fpdf->Row(array('Client\'s Legal History:', $txt));

        $this->fpdf->CC('Client\'s Legal History:', $data->probationoff, 'black', 'B', 11, '(Describe and, if currently involved, give name of probation officer, parole office, or case manager and estimated start and end dates.)');

        $this->fpdf->Ln(5);
        $check = '';
        if ($data->ssubstance == 1) $check = 'Yes';
        if ($data->ssubstance == 2) $check = 'No';

        $this->fpdf->SetWidths(array(170, 20));
        $this->fpdf->Row(array('Client\'s Substance Use:', $check));

        $data2 = bio_twentyfour2_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        if ($check == 'Yes') {
            $txt = '';
            if ($data->caffeine != null) $txt .= 'Caffeine, ';
            if ($data->prescr != null) $txt .= 'Prescription Medication, ';
            if ($data->halluc != null) $txt .= 'Hallucinogens, ';

            if ($data2->sdativ != null) $txt .= 'Sedatives, ';
            if ($data2->barbit != null) $txt .= 'Barbituates, ';
            if ($data2->methad != null) $txt .= 'Methadone, ';
            if ($data2->subother != null) $txt .= 'Other, ';
            if ($data2->tobacco != null) $txt .= 'Tobacco, ';
            if ($data2->alcohol != null) $txt .= 'Alcohol, ';
            if ($data2->mariju != null) $txt .= 'Marijuana, ';
            if ($data2->tranqu != null) $txt .= 'Tranqulizers, ';
            if ($data2->metham != null) $txt .= 'Methamphetamines, ';
            if ($data2->overcount != null) $txt .= 'Over-the-counter Medication, ';
            if ($data2->inhalant != null) $txt .= 'Inhalants, ';
            if ($data2->stimul != null) $txt .= 'Stimulants, ';
            if ($data2->cocain != null) $txt .= 'Cocaine, ';



            $this->fpdf->MultiCell(190, 5, $txt, 1);
        }

        $data = $data2;

        $this->fpdf->CC('Client\'s history of withdrawal, DTs, blackouts (loss of time), seizures, etc. If applicable.', $data->withdrawal, 'black', 'B', 11);
        $this->fpdf->CC('Ask and record the response to, "What happens when you stop using?"', $data->askandrecord, 'black', 'B', 11);
        $this->fpdf->CC('What is the longest period of sobriety?', $data->sobriety, 'black', 'B', 11);
        $this->fpdf->CC('When?', $data->whensobriety, 'black', 'B', 11);


        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'Mental Health Services History', 0, 1, 'C');
        $this->fpdf->HeadingText('', 'B', 12);
        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->SetFillColor(32, 122, 199);
        $this->fpdf->Cell(0, 5, 'Mental Status Exam', 1, 1, 'C', true);


        $txt = '';
        if ($data->unremark != null) $txt .= 'Unremarkable, ';
        if ($data->unkempt != null) $txt .= 'Unkempt, ';
        if ($data->atypical != null) $txt .= 'Atypical Clothing, ';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(23, 5, 'Appearance', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(72, 5, $txt, 1);


        $txt = '';
        if ($data->person != null) $txt .= 'Person, ';
        if ($data->place != null) $txt .= 'Place, ';
        if ($data->oridate != null) $txt .= 'Date, ';
        if ($data->situation != null) $txt .= 'Situation, ';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(23, 5, 'Orientation', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(72, 5, $txt, 1, 1);

        $txt = '';
        if ($data->insightpoor != null) $txt .= 'Poor, ';
        if ($data->insightaverage != null) $txt .= 'Average, ';
        if ($data->insightgood != null) $txt .= 'Good, ';


        $this->fpdf->HeadingText();
        $this->fpdf->Cell(23, 5, 'Insight', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(72, 5, 'Unremarkable, Unkempt, Atypical Clothing', 1);

        $txt = '';
        if ($data->judgpoor != null) $txt .= 'Poor, ';
        if ($data->judgaver != null) $txt .= 'Average, ';
        if ($data->judggood != null) $txt .= 'Good, ';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(23, 5, 'Judgment', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(72, 5, $txt, 1, 1);


        $this->fpdf->CC('Comments:', $data->judgecomment, 'black', 'B', 11);

        $this->fpdf->Ln(5);

        $txt = '';
        if ($data->motorun != null) $txt .= 'Unremarkable, ';
        if ($data->motorrest != null) $txt .= 'Restless, ';
        if ($data->motorwith != null) $txt .= 'Withdrawn, ';
        if ($data->motorslurr != null) $txt .= 'Slurred Speech, ';

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(30, 5, 'Motor Activity', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1);

        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('', 'B', 12);
        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->SetFillColor(32, 122, 199);
        $this->fpdf->Cell(0, 5, 'Biological Functions', 1, 1, 'C', true);
        $txt = '';
        if ($data->limit != null) $txt = 'All within normal limits';
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt);
        $this->fpdf->Ln(5);

        $this->fpdf->CC('Sleep Pattern:', $data->sleeppat, 'black', 'B', 11);
        $this->fpdf->CC('Appetite:', $data->appetite, 'black', 'B', 11);
        $this->fpdf->CC('Comments:', $data->acomment, 'black', 'B', 11);

        $this->fpdf->Ln(5);

        $txt = '';
        if ($data->affun != null) $txt .= 'Unremarkable, ';

        $data = bio_twentyfour3_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        if ($data->affcrit != null) $txt .= 'Self Critical, ';
        if ($data->affflat != null) $txt .= 'Flat, ';
        if ($data->affangr != null) $txt .= 'Angry, ';
        if ($data->affeuph != null) $txt .= 'Euphoric, ';
        if ($data->affsilly != null) $txt .= 'Silly, ';
        if ($data->affirri != null) $txt .= 'Irritable, ';
        if ($data->affdepr != null) $txt .= 'Depressed, ';
        if ($data->affhope != null) $txt .= 'Hopelessness, ';

        $this->fpdf->NormalText();
        $this->fpdf->SetWidths(array(50, 140));
        $this->fpdf->Row(array('Affect', $txt));

        $txt = '';
        if ($data->depnone != null) $txt .= 'None, ';
        if ($data->dephypo != null) $txt .= 'Hypoactive, ';
        if ($data->depfati != null) $txt .= 'Fatigue, ';
        if ($data->depfee != null) $txt .= 'Feelings of Worthlessness, ';
        if ($data->depguilt != null) $txt .= 'Guilt Feelings, ';
        if ($data->dephelpless != null) $txt .= 'Feelings of Helpless/Hopeless, ';
        if ($data->depirrit != null) $txt .= 'Irritability, ';
        if ($data->deppoor != null) $txt .= 'Poor Concentration, ';
        if ($data->depsadn != null) $txt .= 'Sadness, ';
        if ($data->depsexual != null) $txt .= 'Change in Sexaul Interest, ';
        if ($data->deploss != null) $txt .= 'Loss of Ability to Enjoy (Anhedonia), ';
        if ($data->depwithdraw != null) $txt .= 'Withdrawn, ';
        if ($data->depself != null) $txt .= 'Self-Blame/Self-Criticism, ';
        if ($data->depinter != null) $txt .= 'Loss of Interest, ';
        if ($data->depcry != null) $txt .= 'Crying, ';


        $this->fpdf->Row(array('Depressive-Like Behavior', $txt));
        $this->fpdf->CC('Comments:', $data->deprcomm, 'black', 'B', 11);
        $this->fpdf->Ln(5);


        $txt = '';
        if ($data->thinun != null) $txt .= 'Unremarkable, ';
        if ($data->thindiss != null) $txt .= 'Distracted, ';
        if ($data->thindel != null) $txt .= 'Delusions, ';
        if ($data->thinhyp != null) $txt .= 'Hypochondriasis, ';
        if ($data->thindis != null) $txt .= 'Disorganized, ';
        if ($data->thinsus != null) $txt .= 'Suspicious, ';
        if ($data->thinobs != null) $txt .= 'Obsessions, ';
        if ($data->thinfli != null) $txt .= 'Flight of Ideas, ';
        if ($data->thinconf != null) $txt .= 'Confused, ';
        if ($data->thingrand != null) $txt .= ' Delusions Obsessions Grandiosity, ';


        $this->fpdf->Row(array('Thinking', $txt));
        $this->fpdf->CC('Comments:', $data->thinkcomm, 'black', 'B', 11);
        $this->fpdf->Ln(5);

        $txt = '';
        if ($data->attun != null) $txt .= 'Unremarkable, ';
        if ($data->attego != null) $txt .= 'Egocentric, ';
        if ($data->attsar != null) $txt .= 'Sarcastic, ';
        if ($data->attres != null) $txt .= 'Resistant, ';
        if ($data->attcont != null) $txt .= 'Controlling, ';

        $data = bio_twentyfour4_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        if ($data->atthost != null) $txt .= 'Hostile, ';
        if ($data->attneg != null) $txt .= 'Negativistic, ';
        if ($data->attpass != null) $txt .= 'Passive, ';
        if ($data->attaggr != null) $txt .= 'Passive-Aggressive, ';
        if ($data->attsedu != null) $txt .= 'Seductive, ';


        $this->fpdf->Row(array('Attitude', $txt));
        $this->fpdf->CC('Comments:', $data->attitudecomm, 'black', 'B', 11);

        $this->fpdf->CC('Medical History/Information:', $data->medhistory, 'black', 'B', 11);
        $this->fpdf->CC('Medical Conditions:', $data->medcond, 'black', 'B', 11, '(List significant past and present medical conditions, including allergies, recent lab results, etc .)');


        $this->fpdf->CC('Primary Care Physician\'s Contact Information:', $data->contactinfo, 'black', 'B', 11);

        $this->fpdf->Ln(5);
        $this->fpdf->CustomCheck(true, 1);
        $this->fpdf->SetWidths(array(80, 110));
        $this->fpdf->Row(array('Date of last physical examinations:', Carbon::parse($data->lastdate)->format('m-d-Y')));

        $txt = '';
        if ($data->immunizations == 1) $txt = 'Yes';
        if ($data->immunizations == 2) $txt = 'No';

        $this->fpdf->Row(array('Current with immunizations?', $txt));
        $this->fpdf->Row(array('Consumer\'s Height', $data->height));
        $this->fpdf->Row(array('Consumer\'s Weight', $data->weight));

        $txt = '';
        if ($data->satisfied == 1) $txt = "N/A";
        if ($data->satisfied == 2) $txt = "Yes";
        if ($data->satisfied == 3) $txt = "No";

        $this->fpdf->Row(array('Consumer Satisfied with Current Weight?', $txt));
        $txt = '';
        if ($data->diagnosed == 1) $txt = "N/A";
        if ($data->diagnosed == 2) $txt = "Yes";
        if ($data->diagnosed == 3) $txt = "No";
        $this->fpdf->Row(array('Ever Diagnosed with an Eating Disorder?', $txt));
        $txt = '';
        if ($data->referral == 1) $txt = "N/A";
        if ($data->referral == 2) $txt = "Yes";
        if ($data->referral == 3) $txt = "No";
        $this->fpdf->Row(array('Consumer Need a Referral for a Nutritional Assessment?', $txt));

        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'Medication History', 0, 1, 'C');

        $data2 = bio_twentyfour5_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();



        $arrs = array(

            array($data->med, $data->dosage, $data->effect, $data->compli, $data->prescrr),
            array($data->medname, $data->dosefreq, $data->effective, $data->compl, $data->presby),
            array($data->med3, $data->freq3, $data->effect3, $data->compl3, $data->med4),
            array($data->med4, $data->freq4, $data->effect4, $data->compl4, $data->pres4),
            array($data->med5, $data->freq5, $data->effect5, $data->compl5, $data2->pres5),

        );

        $data = $data2;

        $i = 0;
        foreach ($arrs as $arr) {
            $this->fpdf->HeadingText('brown', 'B', 12);
            $this->fpdf->Cell(0, 5, $i + 1, 0, 1);
            $this->fpdf->NormalText();

            $this->fpdf->SetWidths(array(40, 150));
            $this->fpdf->CustomCheck(true, 1);
            $this->fpdf->Row(array('Medication Name', $arr[0]));
            $this->fpdf->Row(array('Dosage/ Frequency', $arr[1]));
            $this->fpdf->Row(array('Effective', $arr[2]));
            $this->fpdf->Row(array('Compliance', $arr[3]));
            $this->fpdf->Row(array('Prescribed By', $arr[4]));
            $this->fpdf->Ln(5);

            $i++;
        }

        $this->fpdf->CC('Daily Living Skills:', $data->dailyliving, 'black', 'B', 11, '(Personal Care, Laundry, Cleaning)');
        $this->fpdf->CC('Daily Living Skills:', $data->alltask, 'black', 'B', 11, '(List All Tasks that consumer is able to complete/Strengths)');
        $this->fpdf->CC('Does client require assistive technology?', $data->assisrequire, 'black', 'B', 11, '(If yes, specify what is needed.)');
        $this->fpdf->CC('Relationship Analysis:', $data->relationana, 'black', 'B', 11, '(Consumer\'s relationship status, gender identity, etc.)');


        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'Current Symptoms/Problems', 0, 1, 'C');
        $this->fpdf->HeadingText('brown', 'I', 9);
        $this->fpdf->Cell(0, 10, 'Rate severity and duration for each:', 0, 1);


        $this->fpdf->HeadingText('', 'B', 12);
        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->SetFillColor(32, 122, 199);
        $this->fpdf->Cell(90, 5, 'SYMPTOMS', 1, 0, 'C', true);
        $this->fpdf->Cell(50, 5, 'SEVERITY', 1, 0, 'C', true);
        $this->fpdf->Cell(50, 5, 'DURATION', 1, 1, 'C', true);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Anxiety', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->anxtxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->anxtime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Panic Attacks', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->pantxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->pantime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Phobia Compulsive', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->photxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->photime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Obessive', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->obesstxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->obesstime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Somatization', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->somatxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->somatime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Depression', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->deprtxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->deprtime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Impaired Memory', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->impatxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->impatime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Poor Self Care Skills', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->poortxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->poortime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Loss of Interest', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->inttxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->inttime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Sexual Dysfunction', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->dystxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->dystime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Weight Change', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->weighttxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->weighttime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Bizarre Ideation', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->bizarrtxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->bizarrtime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Bizarre Behavior', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->bbtxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->bbtime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Paranoid Ideation', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->pitxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->pitime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Poor Judgment', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->pjtxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->pjtime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Poor Interpersonal Skills', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->pistxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->pistime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Conduct Problems', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->cptxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->cptime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'School Problems', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->sptxt, 1, 0);

        $data = bio_twentyfour6_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();



        $this->fpdf->Cell(50, 5, Carbon::parse($data->sptime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Family Problems', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->fptxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->fptime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Indep Living Problems', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->indetxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->indetime)->format('h:i A'), 1, 1);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(90, 5, 'Other', 1, 0);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(50, 5, $data->othtxt, 1, 0);
        $this->fpdf->Cell(50, 5, Carbon::parse($data->othtime)->format('h:i A'), 1, 1);



        $this->fpdf->CC('Briefly describe identified Symptoms:', $data->idensymp, 'black', 'B', 11);
        $this->fpdf->CC('Summary of Consumer\'s SNAPS:', $data->summarycons, 'black', 'B', 11);
        $this->fpdf->CC('(Consumer\'s Goals/Hopes for the Future)', $data->cghfuture, 'black', 'B', 11);
        $this->fpdf->CC('What things do you like about yourself?', $data->likeyour, 'black', 'B', 11);
        $this->fpdf->CC('What things would you like to improve about your behaviors/symptoms & how?', $data->likeimprove, 'black', 'B', 11);
        $this->fpdf->CC('What accomplishments are you most proud of in your personal life?', $data->proudlife, 'black', 'B', 11);
        $this->fpdf->CC('Consumer\'s and family\'s expectations from participating in this program?', $data->expectpart, 'black', 'B', 11);


        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'Summary of consumer\'s SNAPS', 0, 1, 'C');
        $this->fpdf->HeadingText('brown', 'I', 9);
        $this->fpdf->Cell(0, 10, '(Strengths, Needs, Abilities and Preferences)', 0, 1);


        $this->fpdf->CC('Strengths:', $data->strength, 'black', 'B', 11);
        $this->fpdf->CC('Needs:', $data->needs, 'black', 'B', 11);
        $this->fpdf->CC('Abilities:', $data->abilities, 'black', 'B', 11);
        $this->fpdf->CC('Preferences:', $data->prefer, 'black', 'B', 11);
        $this->fpdf->CC('Problems List:', $data->problemlist, 'black', 'B', 11);


        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'Clinical Summary', 0, 1, 'C');

        $this->fpdf->CC('Diagnostic Rationale/Summary of Findings:', $data->diagrational, 'black', 'B', 11, '(Strengths, Needs, Abilities and Preferences)');
        $this->fpdf->CC('Interpretive Summary:', $data->intersumm, 'black', 'B', 11);

        $txt = '';
        if ($data->rscomm != null) $txt .= 'Community referrals made, no further services needed, ';
        if ($data->rsmed != null) $txt .= 'Medication assessment, ';
        if ($data->rsind != null) $txt .= 'Individual therapy, ';
        if ($data->rsfam != null) $txt .= 'Family therapy, ';
        if ($data->rstesting != null) $txt .= 'Testing, ';
        if ($data->rscare != null) $txt .= 'By primary care physician, ';
        if ($data->rsbtl != null) $txt .= 'Brief therapy Long-term, ';
        if ($data->rscoll != null) $txt .= 'Collateral, ';
        if ($data->rsreha != null) $txt .= 'Day rehab/treatment, ';
        if ($data->rsasoc != null) $txt .= 'By ASOC or CSOG psychiatrist, ';
        if ($data->rsltt != null) $txt .= 'Long-term therapy, ';
        if ($data->rsgrou != null) $txt .= 'Group, ';
        if ($data->rsother != null) $txt .= 'Other, ';


        $this->fpdf->CC('Recommended Services:', $txt, 'black', 'B', 11, '(Check all that apply.)');




        $this->fpdf->CC('If community referrals were made, please describe:', $data->referrall, 'black', 'B', 11);
        $this->fpdf->CC('If client was placed on 1013, please give details:', $data->whichhospital, 'black', 'B', 11, '(IE: Which hospital, how transported, etc.)');
        $this->fpdf->CC('DSM V', $data->dsmv, 'black', 'B', 11);
        $this->fpdf->CC('Recommendations for Treatment/ Services:', $data->rectreat, 'black', 'B', 11, '(Please indicate what services you are recommended and how each service can benefit the client)');
        $this->fpdf->CC('Projected date of Discharge/Transition:', $data->projectdate, 'black', 'B', 11);
        $this->fpdf->CC('Anticipated Stepdown:', $data->clarea, 'black', 'B', 11, '(Please include specific step-down linkage in client\'s area, frequency, of attendance, and contact information of services that you will recommend once they have successfully completed services with A.C.E)');
        $this->fpdf->CC('Discharge Plan:', $data->dischplan, 'black', 'B', 11, '(Place all Objectives from the Treatment Plan in this section; the steps the individual has agreed to do to accomplish the goals)');



        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }


    //Form 25
    public function birp_progress(Request $request)
    {
        $data = birp_twentyfive_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }


        $this->fpdf->Title('B.I.R.P. PROGRESS NOTE FORM');


        $txt = "";
        if ($data->consumer != null) $txt .= 'Consumer, ';
        if ($data->pother != null) $txt .= 'Other, ';
        if ($data->pparent != null) $txt .= 'Foster Parents, ';
        if ($data->parent != null) $txt .= 'Parent/Guardian, ';
        if ($data->pgaurdian != null) $txt .= 'Group Home Staff';


        $this->fpdf->CC('PERSON(S) INVOLVED', $txt, 'black', 'B', 11, '(at least one must be selected)');

        $this->fpdf->Ln();


        $this->fpdf->CustomCheck(true, 1);
        $this->fpdf->SetWidths(array(150, 40));
        $this->fpdf->SetAligns(array('L', 'C'));

        $txt = '';
        if ($data->contacttype == 1) $txt = 'Face to Face';
        if ($data->contacttype == 2) $txt = 'Phone';
        if ($data->contacttype == 3) $txt = 'Attempts';
        if ($data->contacttype == 4) $txt = 'Telehealth';
        if ($data->contacttype == 5) $txt = 'N/A';

        $this->fpdf->Row(array('CONTACT TYPE:', $txt));

        $txt = '';
        if ($data->affect == 1) $txt = 'Agitated';
        if ($data->affect == 2) $txt = 'Calm';
        if ($data->affect == 3) $txt = 'Flat';
        if ($data->affect == 4) $txt = 'N/A';
        if ($data->affect == 5) $txt = 'Sad';
        if ($data->affect == 6) $txt = 'Angry';
        if ($data->affect == 7) $txt = 'Defiant';
        if ($data->affect == 8) $txt = 'Happy';
        if ($data->affect == 9) $txt = 'Other';
        if ($data->affect == 10) $txt = 'Suicidal';
        if ($data->affect == 11) $txt = 'Anxious';
        if ($data->affect == 12) $txt = 'Energetic';
        if ($data->affect == 13) $txt = 'Moody';
        if ($data->affect == 14) $txt = 'Playful';
        if ($data->affect == 15) $txt = 'Tired';



        $this->fpdf->Row(array('CONSUMER\'S OVERALL AFFECT:', $txt));
        $rel = '';
        if ($data->stressor == 1) $rel = "Yes";
        if ($data->stressor == 2) $rel = "None Reported";

        $this->fpdf->Row(array('RELEVANT CHANGES IN MEDICAL CONDITION AND/OR MEDICATIONS (HEALTH AND SAFETY STRESSOR) SINCE LAST VISIT?', 'Yes'));
        if ($rel === 'Yes') {
            $this->fpdf->MultiCell(0, 5, $data->stressexp, 1);
        }
        $this->fpdf->Row(array('PROGRESS: CONSUMER MET HIS/HER GOAL THIS SESSION:', $data->proselect));
        $this->fpdf->Row(array('ADD NEW GOALS FOR:', $data->newselect));



        $this->fpdf->CC('COMMENTS:', $data->stresscomm, 'black', 'B', 11);
        $this->fpdf->Ln();

        $txt = '';
        if ($data->imi != null) $txt = 'Yes';
        $this->fpdf->Row(array('INCLUDE MILEAGE INFORMATION?', $txt));


        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'SERVICE PLAN OBJECTIVES/INTERVENTIONS', 0, 1);
        $this->fpdf->HeadingText('brown', 'I', 9);
        $this->fpdf->Cell(0, 5, 'At least one GOAL, OBJECTIVE, and INTERVENTION must be selected.', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->SetWidths(array(100, 90));


        $this->fpdf->Ln();
        $this->fpdf->Row(array('Goal:', $data->goalselect));
        $this->fpdf->Row(array('Objective:', $data->objselect));
        $this->fpdf->Row(array('Intervention:', $data->intselect));


        $this->fpdf->CC('NON-BILLABLE NOTE?', $data->nonbill, 'black', 'B', 11);

        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'BEHAVIOR', 0, 1, 'C');

        $arr = array(
            'ENCOURAGED' => $data->enc1,
            'FORMULATED' => $data->formul1,
            'ASSISTED' => $data->ass1,
            'REMINDED' => $data->reminded1,
            'URGED' => $data->urged1,
            'REFERRED' => $data->refer1,
            'ENGAGED' => $data->engage1,
            'CONFIRMED' => $data->confirm1,
            'RESPONDED' => $data->resp1,
            'DIRECTED' => $data->direct1,
            'ARRANGED' => $data->arr1,
            'ASSURED' => $data->assur1,
            'RESCHEDULED' => $data->resch1,
        );

        foreach ($arr as $key => $value) {
            if ($value != '' && $value != null) {

                $this->fpdf->CC($key, $value, 'black', 'B', 11);
            }
        }


        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'INTERVENTION', 0, 1, 'C');

        $data = birp_twentyfive2_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $arr = array(
            'ENCOURAGED' => $data->enc2,
            'FORMULATED' => $data->fomul2,
            'ASSISTED' => $data->ass2,
            'REMINDED' => $data->reminded2,
            'URGED' => $data->urged2,
            'REFERRED' => $data->refer2,
            'ENGAGED' => $data->engage2,
            'CONFIRMED' => $data->confirm2,
            'RESPONDED' => $data->resp2,
            'DIRECTED' => $data->direct2,
            'ARRANGED' => $data->arr2,
            'ASSURED' => $data->assur2,
            'RESCHEDULED' => $data->resch2,
        );

        foreach ($arr as $key => $value) {
            if ($value != '' && $value != null) {

                $this->fpdf->CC($key, $value, 'black', 'B', 11);
            }
        }

        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }

        $this->fpdf->Cell(0, 10, 'RESPONSE', 0, 1, 'C');

        $arr = array(
            'ENCOURAGED' => $data->enc3,
            'FORMULATED' => $data->ass3,
            'ASSISTED' => $data->formul3,
            'REMINDED' => $data->reminded3,
            'URGED' => $data->urged3,
            'REFERRED' => $data->refer3,
            'ENGAGED' => $data->engage3,
            'CONFIRMED' => $data->confirm3,
            'RESPONDED' => $data->resp3,
            'DIRECTED' => $data->direct3,
            'ARRANGED' => $data->arr3,
            'ASSURED' => $data->assur3,
            'RESCHEDULED' => $data->resch3,
        );

        foreach ($arr as $key => $value) {
            if ($value != '' && $value != null) {

                $this->fpdf->CC($key, $value, 'black', 'B', 11);
            }
        }


        $this->fpdf->HeadingText('brown', 'I', 12);
        if ($this->fpdf->GetY() >= 265) {
            $this->fpdf->AddPage();
            $this->fpdf->SetY(40);
        }
        $this->fpdf->Cell(0, 10, 'PLAN', 0, 1, 'C');

        $arr = array(
            'ENCOURAGED' => $data->enc4,
            'FORMULATED' => $data->formul4,
            'ASSISTED' => $data->ass4,
            'REMINDED' => $data->reminded4,
            'URGED' => $data->urged4,
            'REFERRED' => $data->refer4,
            'ENGAGED' => $data->engage4,
            'CONFIRMED' => $data->confirm4,
            'RESPONDED' => $data->resp4,
            'DIRECTED' => $data->direct4,
            'ARRANGED' => $data->arr4,
            'ASSURED' => $data->assu4,
            'RESCHEDULED' => $data->resch4,
        );

        foreach ($arr as $key => $value) {
            if ($value != '' && $value != null) {

                $this->fpdf->CC($key, $value, 'black', 'B', 11);
            }
        }


        $this->fpdf->CC('STRENGTHS (OPTIONAL):', $data->strength, 'black', 'B', 11);

        $this->fpdf->CC('TRANSITIONAL CONSIDERATIONS: (OPTIONAL)', $data->transitional, 'black', 'B', 11);

        $this->fpdf->CC('ADDITIONAL COMMENTS/INFORMATION:', $data->additional, 'black', 'B', 11, 'Use this section to put additional information that will be printed out on your notes (i.e. County, Case Worker, misc. comments)');


        $this->fpdf->Ln();
        $this->fpdf->Row(array('CHANGE CLIENT STATUS?', $data->statusselect));
        $this->fpdf->Row(array('NEXT APPOINTMENT', Carbon::parse($data->nextapp)->format('m-d-Y')));

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }


    //Form 26
    public function dis_summary(Request $request)
    {
        $data = dis_twentysix_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('DISCHARGE SUMMARY');

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, '1) Session Date:', 'LTB');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, Carbon::parse($data->sdate)->format('m-d-Y'), 'TB', 0, 'C');
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Discharge Date:', 'TB');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, Carbon::parse($data->disdate)->format('m-d-Y'), 'TBR', 1, 'C');


        $this->fpdf->Ln();

        $this->fpdf->CC('2) What is the living situation at discharge?', $data->livsit, 'black', 'B', 11);
        $this->fpdf->Ln();
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(0, 5, '3) What are the Strengths, Needs, Abilities and Preferences of the individual?', 0, 1);
        $this->fpdf->NormalText();
        $this->fpdf->SetWidths(array(50, 140));
        $this->fpdf->CustomCheck(true, 1);
        $this->fpdf->Row(array('Strengths: ?', $data->strength));
        $this->fpdf->Row(array('Needs: ?', $data->needs));
        $this->fpdf->Row(array('Abilities: ?', $data->abilities));
        $this->fpdf->Row(array('Preferences: ?', $data->pref));

        $this->fpdf->Ln();

        $this->fpdf->CC('4) What Services and support did Resilient Focused Family Therapy Provide, while in care?', $data->incare, 'black', 'B', 11);
        $this->fpdf->CC('5) Significant findings', $data->sigfind, 'black', 'B', 11);
        $this->fpdf->CC('6) Summary of goals achieved', $data->summgoal, 'black', 'B', 11);
        $this->fpdf->CC('7) Summary of goals not achieved', $data->summnot, 'black', 'B', 11);
        $this->fpdf->CC('8) Current support system', $data->currss, 'black', 'B', 11);
        $this->fpdf->CC('9) Overall Recommendations', $data->overrec, 'black', 'B', 11);
        $this->fpdf->CC('10) What outside organization did you refer client too? If not referred out, please explain.', $data->outsideorg, 'black', 'B', 11);
        $this->fpdf->CC('11) What is the plan of services, please include if an appointment was scheduled (Please be specific)?', $data->planser, 'black', 'B', 10);
        $this->fpdf->CC('12) Any medical needs post discharge?', $data->medneed, 'black', 'B', 11);
        $this->fpdf->CC('13) What is the reason for discontinuing services?', $data->discont, 'black', 'B', 11);
        $this->fpdf->CC('14) Summary of Discharge', $data->summdis, 'black', 'B', 11);



        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }


    //Form 27
    public function language_progress(Request $request)
    {

        $data = lpro_twentyseven_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        $txt = '';

        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }


        $this->fpdf->Title('SPEECH LANGUAGE PROGRESS REPORT', 20);

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Name:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, $data->clname, 1, 0);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'DOB:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, Carbon::parse($data->dob)->format('m-d-Y'), 1, 1);

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Date of Summary:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, Carbon::parse($data->sdate)->format('m-d-Y'), 1, 0);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'CPT Code(s):', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, $data->cpt, 1, 1);

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'CA:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, $data->ca, 1, 0);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'ICD Code(s):', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, $data->icd, 1, 1);

        $this->fpdf->SetWidths(array(40, 150));
        $this->fpdf->CustomCheck(true, 1);
        $this->fpdf->Row(array('Address:', $data->address));

        $this->fpdf->CC('BACKGROUND INFORMATION:', $data->backinfo, 'black', 'B', 11);

        $this->fpdf->Ln();
        $this->fpdf->Title('SUMMARY OF THERAPY', 16);

        $this->fpdf->CC('LONG TERM GOAL (INSTRUMENTAL OUTCOMES):', $data->ltgoal, 'black', 'B', 11);
        $this->fpdf->CC('SHORT TERM GOALS (INTERMEDIATE OUTCOMES):', $data->stgoal, 'black', 'B', 11);
        $this->fpdf->CC('INTERVENTION STRATEGIES:', $data->intstra, 'black', 'B', 11);
        $this->fpdf->CC('RESPONSE TO THERAPY:', $data->resth, 'black', 'B', 11);
        $this->fpdf->CC('TESTING DONE DURING THE SEMESTER:', $data->testsem, 'black', 'B', 11);
        $this->fpdf->CC('RECOMMENDATIONS:', $data->recom, 'black', 'B', 11);
        $this->fpdf->CC('MEDICAL NECESSITY:', $data->mednec, 'black', 'B', 11);
        $this->fpdf->CC('RECOMMENDATIONS:', $data->recomm, 'black', 'B', 11);
        $this->fpdf->CC('LONG TERM GOALS:', $data->ltgoal2, 'black', 'B', 11);
        $this->fpdf->CC('SHORT TERM GOALS:', $data->stgoal2, 'black', 'B', 11);



        //Signature Module

        if ($this->fpdf->GetY() > 257) {
            $this->fpdf->AddPage();
        }

        $up_date = Carbon::parse($data->updated_at)->format('m-d-Y');
        $this->fpdf->Ln(5);
        $this->fpdf->Image(public_path('/') . $data->signature, 25, $this->fpdf->GetY(), 40, 20);
        $this->fpdf->Image(public_path('/') . $data->updload_sign, 140, $this->fpdf->GetY(), 40, 20);
        $this->fpdf->SetXY(10, $this->fpdf->GetY() + 25);
        $this->fpdf->HeadingText('blue');
        $y = $this->fpdf->GetY();
        $this->fpdf->MultiCell(50, 5, 'Kathleen Sposato, M.S., CCC-SLP,TSSLD', 'T', 'C');
        $this->fpdf->NormalText();
        $this->fpdf->SetXY($this->fpdf->GetX() + 50, $y);
        $this->fpdf->Cell(30, 5, ' (' . $up_date . ')', 'T');

        $this->fpdf->Cell(15, 5, '');
        $this->fpdf->HeadingText('blue');
        $this->fpdf->MultiCell(60, 5, 'Christiana Neophtyou, M.S., CCC-SLP Director of speech language progress report, PLLC', 'T', 'C');
        $this->fpdf->NormalText();
        $this->fpdf->SetXY($this->fpdf->GetX() + 155, $y);
        $this->fpdf->Cell(30, 5, ' (' . $up_date . ')', 'T');

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }

    //Form 28
    public function language_session(Request $request)
    {
        $data = ls_twentyeight_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();
        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('SPEECH LANGUAGE SESSION NOTE', 20);

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Client\'s Name:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, $data->clname, 1, 0);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Date of Birth:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, Carbon::parse($data->dob)->format('m-d-Y'), 1, 1);

        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'ICD-10 Code:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->icd, 1, 1);


        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Date of session:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, Carbon::parse($data->dos1)->format('m-d-Y'), 1);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'CPT Code:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, $data->cpt1, 1, 1);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Short-term goals Addressed:', $data->stg1, 'black', 'B', 11);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Activity, progress & carryover:', $data->apc1, 'black', 'B', 11);

        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'Date of session:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, Carbon::parse($data->dos2)->format('m-d-Y'), 1);
        $this->fpdf->HeadingText();
        $this->fpdf->Cell(40, 5, 'CPT Code:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(55, 5, $data->cpt2, 1, 1);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Short-term goals Addressed:', $data->stg2, 'black', 'B', 11);
        $this->fpdf->SetY($this->fpdf->GetY() - 5);
        $this->fpdf->CC('Activity, progress & carryover:', $data->apc2, 'black', 'B', 11);
        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(95, 5, 'Name', 1, 0, 'C');
        $this->fpdf->Cell(95, 5, 'Name', 1, 1, 'C');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(95, 5, $data->name1, 1, 0, 'C');
        $this->fpdf->Cell(95, 5, $data->name2, 1, 1, 'C');



        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }

    //Form 29
    public function diagnosis_summary(Request $request)
    {
        $data = dia_twentynine_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('DIAGNOSIS SESSION FORM', 20);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(15, 5, 'Name:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(100, 5, $data->clname, 1);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(15, 5, 'DOB:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->dob)->format('m-d-Y'), 1, 1);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(15, 5, 'ICD:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(100, 5, Carbon::parse($data->date)->format('m-d-Y'), 1);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(15, 5, 'Date:', 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->icd, 1);

        $this->fpdf->Ln();


        $this->fpdf->CC('REASON FOR TESTING:', $data->reason, 'black', 'B', 11);
        $this->fpdf->CC('TESTS ADMINISTERED:', $data->testadmin, 'black', 'B', 11);
        $this->fpdf->CC('SCORES:', $data->scores, 'black', 'B', 11);
        $this->fpdf->CC('IMPLICATIONS OF TESTING:', $data->implication, 'black', 'B', 11);
        $this->fpdf->CC('RECOMMENDATIONS:', $data->recom, 'black', 'B', 11);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(95, 5, 'Name', 1, 0, 'C');
        $this->fpdf->Cell(95, 5, 'Name', 1, 1, 'C');
        $this->fpdf->NormalText();
        $this->fpdf->Cell(95, 5, $data->name1, 1, 0, 'C');
        $this->fpdf->Cell(95, 5, $data->name2, 1, 1, 'C');


        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }


    //Form 30
    public function datasheet(Request $request)
    {
        $data = ds_thirty1_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();
        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('DATASHEET', 20);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(15, 5, 'Client:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(75, 5, $data->clname, 1, 0, '');

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(22, 5, 'Staff Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $data->stname, 1, 1, '');


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Session Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(65, 5, Carbon::parse($data->sdate)->format('m-d-Y'), 1, 0, '');


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(22, 5, 'Start Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, Carbon::parse($data->sttime)->format('h:i A'), 1, 0, '');

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(20, 5, 'End Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, Carbon::parse($data->etime)->format('h:i A'), 1, 1, '');
        $this->fpdf->HeadingText('black');
        $this->fpdf->Cell(90, 5, $data->select1, 1);
        $this->fpdf->Cell(0, 5, $data->select2, 1, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(70, 5, '', 1);
        $this->fpdf->Cell(30, 5, 'Hr1', 1, 0, '', true);
        $this->fpdf->Cell(30, 5, 'Hr2', 1, 0, '', true);
        $this->fpdf->Cell(30, 5, 'Hr3', 1, 0, '', true);
        $this->fpdf->Cell(30, 5, 'Total', 1, 1, '', true);

        $this->fpdf->HeadingText('black');
        $this->fpdf->Cell(70, 5, $data->hour1, 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, $data->hr1_1, 1);
        $this->fpdf->Cell(30, 5, $data->hr2_1, 1);
        $this->fpdf->Cell(30, 5, $data->hr3_1, 1);
        $this->fpdf->Cell(30, 5, $data->total_1, 1, 1);

        $this->fpdf->HeadingText('black');
        $this->fpdf->Cell(70, 5, $data->hour2, 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, $data->hr1_2, 1);
        $this->fpdf->Cell(30, 5, $data->hr2_2, 1);
        $this->fpdf->Cell(30, 5, $data->hr3_2, 1);
        $this->fpdf->Cell(30, 5, $data->total_2, 1, 1);

        $this->fpdf->HeadingText('black');
        $this->fpdf->Cell(70, 5, $data->hour3, 1);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, $data->hr1_3, 1);
        $this->fpdf->Cell(30, 5, $data->hr2_3, 1);
        $this->fpdf->Cell(30, 5, $data->hr3_3, 1);
        $this->fpdf->Cell(30, 5, $data->total_3, 1, 1);


        $box_arr = array(

            'v1' => $data->pro1,
            'v2' => $data->tar1,
            'v3' => $data->b1_1,
            'v4' => $data->b1_2,
            'v5' => $data->b1_3,
            'v6' => $data->b1_4,
            'v7' => $data->b1_5,
            'v8' => $data->b1_6,
            'v9' => $data->b1_7,
            'v10' => $data->b1_8,
            'v11' => $data->b1_9,
            'v12' => $data->b1_10,
            'v13' => $data->b1_11,
            'v14' => $data->b1_12,
            'v15' => $data->b1_13,
            'v16' => $data->b1_14,
            'v17' => $data->b1_15,
            'v18' => $data->b1_t,
            'v19' => $data->b1_ot,
            'v20' => $data->b1_s,
        );

        $this->fpdf->ds_box($box_arr, 1);

        $data = ds_thirty2_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        $box_arr = array(

            'v1' => $data->pro2,
            'v2' => $data->tar2,
            'v3' => $data->b2_1,
            'v4' => $data->b2_2,
            'v5' => $data->b2_3,
            'v6' => $data->b2_4,
            'v7' => $data->b2_5,
            'v8' => $data->b2_6,
            'v9' => $data->b2_7,
            'v10' => $data->b2_8,
            'v11' => $data->b2_9,
            'v12' => $data->b2_10,
            'v13' => $data->b2_11,
            'v14' => $data->b2_12,
            'v15' => $data->b2_13,
            'v16' => $data->b2_14,
            'v17' => $data->b2_15,
            'v18' => $data->b2_t,
            'v19' => $data->b2_ot,
            'v20' => $data->b2_s,
        );

        $this->fpdf->ds_box($box_arr, 2);

        $box_arr = array(

            'v1' => $data->pro3,
            'v2' => $data->tar3,
            'v3' => $data->b3_1,
            'v4' => $data->b3_2,
            'v5' => $data->b3_3,
            'v6' => $data->b3_4,
            'v7' => $data->b3_5,
            'v8' => $data->b3_6,
            'v9' => $data->b3_7,
            'v10' => $data->b3_8,
            'v11' => $data->b3_9,
            'v12' => $data->b3_10,
            'v13' => $data->b3_11,
            'v14' => $data->b3_12,
            'v15' => $data->b3_13,
            'v16' => $data->b3_14,
            'v17' => $data->b3_15,
            'v18' => $data->b3_t,
            'v19' => $data->b3_ot,
            'v20' => $data->b3_s,
        );

        $this->fpdf->ds_box($box_arr, 1);


        $data = ds_thirty3_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $box_arr = array(

            'v1' => $data->pro4,
            'v2' => $data->tar4,
            'v3' => $data->b4_1,
            'v4' => $data->b4_2,
            'v5' => $data->b4_3,
            'v6' => $data->b4_4,
            'v7' => $data->b4_5,
            'v8' => $data->b4_6,
            'v9' => $data->b4_7,
            'v10' => $data->b4_8,
            'v11' => $data->b4_9,
            'v12' => $data->b4_10,
            'v13' => $data->b4_11,
            'v14' => $data->b4_12,
            'v15' => $data->b4_13,
            'v16' => $data->b4_14,
            'v17' => $data->b4_15,
            'v18' => $data->b4_t,
            'v19' => $data->b4_ot,
            'v20' => $data->b4_s,
        );

        $this->fpdf->ds_box($box_arr, 2);


        $box_arr = array(

            'v1' => $data->pro5,
            'v2' => $data->tar5,
            'v3' => $data->b5_1,
            'v4' => $data->b5_2,
            'v5' => $data->b5_3,
            'v6' => $data->b5_4,
            'v7' => $data->b5_5,
            'v8' => $data->b5_6,
            'v9' => $data->b5_7,
            'v10' => $data->b5_8,
            'v11' => $data->b5_9,
            'v12' => $data->b5_10,
            'v13' => $data->b5_11,
            'v14' => $data->b5_12,
            'v15' => $data->b5_13,
            'v16' => $data->b5_14,
            'v17' => $data->b5_15,
            'v18' => $data->b5_t,
            'v19' => $data->b5_ot,
            'v20' => $data->b5_s,
        );

        $this->fpdf->ds_box($box_arr, 1);

        $data = ds_thirty4_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $box_arr = array(

            'v1' => $data->pro6,
            'v2' => $data->tar6,
            'v3' => $data->b6_1,
            'v4' => $data->b6_2,
            'v5' => $data->b6_3,
            'v6' => $data->b6_4,
            'v7' => $data->b6_5,
            'v8' => $data->b6_6,
            'v9' => $data->b6_7,
            'v10' => $data->b6_8,
            'v11' => $data->b6_9,
            'v12' => $data->b6_10,
            'v13' => $data->b6_11,
            'v14' => $data->b6_12,
            'v15' => $data->b6_13,
            'v16' => $data->b6_14,
            'v17' => $data->b6_15,
            'v18' => $data->b6_t,
            'v19' => $data->b6_ot,
            'v20' => $data->b6_s,
        );

        $this->fpdf->ds_box($box_arr, 2);


        $box_arr = array(

            'v1' => $data->pro7,
            'v2' => $data->tar7,
            'v3' => $data->b7_1,
            'v4' => $data->b7_2,
            'v5' => $data->b7_3,
            'v6' => $data->b7_4,
            'v7' => $data->b7_5,
            'v8' => $data->b7_6,
            'v9' => $data->b7_7,
            'v10' => $data->b7_8,
            'v11' => $data->b7_9,
            'v12' => $data->b7_10,
            'v13' => $data->b7_11,
            'v14' => $data->b7_12,
            'v15' => $data->b7_13,
            'v16' => $data->b7_14,
            'v17' => $data->b7_15,
            'v18' => $data->b7_t,
            'v19' => $data->b7_ot,
            'v20' => $data->b7_s,
        );

        $this->fpdf->ds_box($box_arr, 1);


        $data = ds_thirty5_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $box_arr = array(

            'v1' => $data->pro8,
            'v2' => $data->tar8,
            'v3' => $data->b8_1,
            'v4' => $data->b8_2,
            'v5' => $data->b8_3,
            'v6' => $data->b8_4,
            'v7' => $data->b8_5,
            'v8' => $data->b8_6,
            'v9' => $data->b8_7,
            'v10' => $data->b8_8,
            'v11' => $data->b8_9,
            'v12' => $data->b8_10,
            'v13' => $data->b8_11,
            'v14' => $data->b8_12,
            'v15' => $data->b8_13,
            'v16' => $data->b8_14,
            'v17' => $data->b8_15,
            'v18' => $data->b8_t,
            'v19' => $data->b8_ot,
            'v20' => $data->b8_s,
        );

        $this->fpdf->ds_box($box_arr, 2);


        $box_arr = array(

            'v1' => $data->pro9,
            'v2' => $data->tar9,
            'v3' => $data->b9_1,
            'v4' => $data->b9_2,
            'v5' => $data->b9_3,
            'v6' => $data->b9_4,
            'v7' => $data->b9_5,
            'v8' => $data->b9_6,
            'v9' => $data->b9_7,
            'v10' => $data->b9_8,
            'v11' => $data->b9_9,
            'v12' => $data->b9_10,
            'v13' => $data->b9_11,
            'v14' => $data->b9_12,
            'v15' => $data->b9_13,
            'v16' => $data->b9_14,
            'v17' => $data->b9_15,
            'v18' => $data->b9_t,
            'v19' => $data->b9_ot,
            'v20' => $data->b9_s,
        );

        $this->fpdf->ds_box($box_arr, 1);

        $data = ds_thirty6_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $box_arr = array(

            'v1' => $data->pro10,
            'v2' => $data->tar10,
            'v3' => $data->b10_1,
            'v4' => $data->b10_2,
            'v5' => $data->b10_3,
            'v6' => $data->b10_4,
            'v7' => $data->b10_5,
            'v8' => $data->b10_6,
            'v9' => $data->b10_7,
            'v10' => $data->b10_8,
            'v11' => $data->b10_9,
            'v12' => $data->b10_10,
            'v13' => $data->b10_11,
            'v14' => $data->b10_12,
            'v15' => $data->b10_13,
            'v16' => $data->b10_14,
            'v17' => $data->b10_15,
            'v18' => $data->b10_t,
            'v19' => $data->b10_ot,
            'v20' => $data->b10_s,
        );

        $this->fpdf->ds_box($box_arr, 2);
        $this->fpdf->CC('Session Notes:', $data->session_note, 'black', 'B', 11);


        $box_arr = array(

            'v1' => $data->pro11,
            'v2' => $data->tar11,
            'v3' => $data->b11_1,
            'v4' => $data->b11_2,
            'v5' => $data->b11_3,
            'v6' => $data->b11_4,
            'v7' => $data->b11_5,
            'v8' => $data->b11_6,
            'v9' => $data->b11_7,
            'v10' => $data->b11_8,
            'v11' => $data->b11_9,
            'v12' => $data->b11_10,
            'v13' => $data->b11_11,
            'v14' => $data->b11_12,
            'v15' => $data->b11_13,
            'v16' => $data->b11_14,
            'v17' => $data->b11_15,
            'v18' => $data->b11_t,
            'v19' => $data->b11_ot,
            'v20' => $data->b11_s,
        );

        $this->fpdf->ds_box($box_arr, 1);

        $data = ds_thirty7_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $box_arr = array(

            'v1' => $data->pro12,
            'v2' => $data->tar12,
            'v3' => $data->b12_1,
            'v4' => $data->b12_2,
            'v5' => $data->b12_3,
            'v6' => $data->b12_4,
            'v7' => $data->b12_5,
            'v8' => $data->b12_6,
            'v9' => $data->b12_7,
            'v10' => $data->b12_8,
            'v11' => $data->b12_9,
            'v12' => $data->b12_10,
            'v13' => $data->b12_11,
            'v14' => $data->b12_12,
            'v15' => $data->b12_13,
            'v16' => $data->b12_14,
            'v17' => $data->b12_15,
            'v18' => $data->b12_t,
            'v19' => $data->b12_ot,
            'v20' => $data->b12_s,
        );

        $this->fpdf->ds_box($box_arr, 2);

        $box_arr = array(

            'v1' => $data->pro13,
            'v2' => $data->tar13,
            'v3' => $data->b13_1,
            'v4' => $data->b13_2,
            'v5' => $data->b13_3,
            'v6' => $data->b13_4,
            'v7' => $data->b13_5,
            'v8' => $data->b13_6,
            'v9' => $data->b13_7,
            'v10' => $data->b13_8,
            'v11' => $data->b13_9,
            'v12' => $data->b13_10,
            'v13' => $data->b13_11,
            'v14' => $data->b13_12,
            'v15' => $data->b13_13,
            'v16' => $data->b13_14,
            'v17' => $data->b13_15,
            'v18' => $data->b13_t,
            'v19' => $data->b13_ot,
            'v20' => $data->b13_s,
        );

        $this->fpdf->ds_box($box_arr, 1);

        $data = ds_thirty8_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();

        $box_arr = array(

            'v1' => $data->pro14,
            'v2' => $data->tar14,
            'v3' => $data->b14_1,
            'v4' => $data->b14_2,
            'v5' => $data->b14_3,
            'v6' => $data->b14_4,
            'v7' => $data->b14_5,
            'v8' => $data->b14_6,
            'v9' => $data->b14_7,
            'v10' => $data->b14_8,
            'v11' => $data->b14_9,
            'v12' => $data->b14_10,
            'v13' => $data->b14_11,
            'v14' => $data->b14_12,
            'v15' => $data->b14_13,
            'v16' => $data->b14_14,
            'v17' => $data->b14_15,
            'v18' => $data->b14_t,
            'v19' => $data->b14_ot,
            'v20' => $data->b14_s,
        );

        $this->fpdf->ds_box($box_arr, 2);

        $box_arr = array(

            'v1' => $data->pro15,
            'v2' => $data->tar15,
            'v3' => $data->b15_1,
            'v4' => $data->b15_2,
            'v5' => $data->b15_3,
            'v6' => $data->b15_4,
            'v7' => $data->b15_5,
            'v8' => $data->b15_6,
            'v9' => $data->b15_7,
            'v10' => $data->b15_8,
            'v11' => $data->b15_9,
            'v12' => $data->b15_10,
            'v13' => $data->b15_11,
            'v14' => $data->b15_12,
            'v15' => $data->b15_13,
            'v16' => $data->b15_14,
            'v17' => $data->b15_15,
            'v18' => $data->b15_t,
            'v19' => $data->b15_ot,
            'v20' => $data->b15_s,
        );

        $this->fpdf->ds_box($box_arr, 1);

        $data = ds_thirty9_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        $box_arr = array(

            'v1' => $data->pro16,
            'v2' => $data->tar16,
            'v3' => $data->b16_1,
            'v4' => $data->b16_2,
            'v5' => $data->b16_3,
            'v6' => $data->b16_4,
            'v7' => $data->b16_5,
            'v8' => $data->b16_6,
            'v9' => $data->b16_7,
            'v10' => $data->b16_8,
            'v11' => $data->b16_9,
            'v12' => $data->b16_10,
            'v13' => $data->b16_11,
            'v14' => $data->b16_12,
            'v15' => $data->b16_13,
            'v16' => $data->b16_14,
            'v17' => $data->b16_15,
            'v18' => $data->b16_t,
            'v19' => $data->b16_ot,
            'v20' => $data->b16_s,
        );

        $this->fpdf->ds_box($box_arr, 2);

        $box_arr = array(

            'v1' => $data->pro17,
            'v2' => $data->tar17,
            'v3' => $data->b17_1,
            'v4' => $data->b17_2,
            'v5' => $data->b17_3,
            'v6' => $data->b17_4,
            'v7' => $data->b17_5,
            'v8' => $data->b17_6,
            'v9' => $data->b17_7,
            'v10' => $data->b17_8,
            'v11' => $data->b17_9,
            'v12' => $data->b17_10,
            'v13' => $data->b17_11,
            'v14' => $data->b17_12,
            'v15' => $data->b17_13,
            'v16' => $data->b17_14,
            'v17' => $data->b17_15,
            'v18' => $data->b17_t,
            'v19' => $data->b17_ot,
            'v20' => $data->b17_s,
        );

        $this->fpdf->ds_box($box_arr, 1);

        $data1 = ds_thirty10_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();
        $data2 = ds_thirty11_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();
        $data3 = ds_thirty12_form::where('sessionid', $request->session_id)->where('admin_id', $this->admin_id)->first();


        $box_arr = array(

            'v1' => $data->pro18,
            'v2' => $data->tar18,
            'v3' => $data->b18_1,
            'v4' => $data->b18_2,
            'v5' => $data->b18_3,
            'v6' => $data->b18_4,
            'v7' => $data->b18_5,
            'v8' => $data->b18_6,
            'v9' => $data->b18_7,
            'v10' => $data->b18_8,
            'v11' => $data->b18_9,
            'v12' => $data->b18_10,
            'v13' => $data->b18_11,
            'v14' => $data->b18_12,
            'v15' => $data->b18_13,
            'v16' => $data->b18_14,
            'v17' => $data->b18_15,
            'v18' => $data->b18_t,
            'v19' => $data->b18_ot,
            'v20' => $data->b18_s,
        );

        $this->fpdf->ds_box($box_arr, 2);
        $this->fpdf->AddPage();


        $data = $data1;
        $box_arr = array(

            "v1" => $data1->task1,
            "v2" => $data->task1_1,
            "v3" => $data->task1_2,
            "v4" => $data->task1_3,
            "v5" => $data->task1_4,
            "v6" => $data->task1_5,
            "v7" => $data->task1_6,
            "v8" => $data->task1_7,
            "v9" => $data->task1_8,
            "v10" => $data->task1_9,
            "v11" => $data->task1_10,
            "v12" => $data->v1_1,
            "v13" => $data->v1_2,
            "v14" => $data->v1_3,
            "v15" => $data->v1_4,
            "v16" => $data->v1_5,
            "v17" => $data->v1_6,
            "v18" => $data->v1_7,
            "v19" => $data->v1_8,
            "v20" => $data->v1_9,
            "v21" => $data->v1_10,
            "v22" => $data3->task1_t,

        );

        $this->fpdf->ds_box2($box_arr, 1);
        $data = $data2;

        $box_arr = array(

            "v1" => $data1->task2,
            "v2" => $data->task2_1,
            "v3" => $data->task2_2,
            "v4" => $data->task2_3,
            "v5" => $data->task2_4,
            "v6" => $data->task2_5,
            "v7" => $data->task2_6,
            "v8" => $data->task2_7,
            "v9" => $data->task2_8,
            "v10" => $data->task2_9,
            "v11" => $data->task2_10,
            "v12" => $data->v2_1,
            "v13" => $data->v2_2,
            "v14" => $data->v2_3,
            "v15" => $data->v2_4,
            "v16" => $data->v2_5,
            "v17" => $data->v2_6,
            "v18" => $data->v2_7,
            "v19" => $data->v2_8,
            "v20" => $data->v2_9,
            "v21" => $data->v2_10,
            "v22" => $data3->task2_t,

        );

        $this->fpdf->ds_box2($box_arr, 2);

        $box_arr = array(

            "v1" => $data1->task3,
            "v2" => $data->task3_1,
            "v3" => $data->task3_2,
            "v4" => $data->task3_3,
            "v5" => $data->task3_4,
            "v6" => $data->task3_5,
            "v7" => $data->task3_6,
            "v8" => $data->task3_7,
            "v9" => $data->task3_8,
            "v10" => $data->task3_9,
            "v11" => $data->task3_10,
            "v12" => $data->v3_1,
            "v13" => $data->v3_2,
            "v14" => $data->v3_3,
            "v15" => $data->v3_4,
            "v16" => $data->v3_5,
            "v17" => $data->v3_6,
            "v18" => $data->v3_7,
            "v19" => $data->v3_8,
            "v20" => $data->v3_9,
            "v21" => $data->v3_10,
            "v22" => $data3->task3_t,

        );

        $this->fpdf->ds_box2($box_arr, 3);

        $data = $data3;

        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(45, 5, 'Antecedent', 1, 0, '', true);
        $this->fpdf->Cell(45, 5, 'Behavior', 1, 0, '', true);
        $this->fpdf->Cell(45, 5, 'Consequence', 1, 0, '', true);
        $this->fpdf->Cell(30, 5, 'Function', 1, 0, '', true);
        $this->fpdf->Cell(25, 5, 'Frequency', 1, 1, '', true);

        $this->fpdf->NormalText();
        $this->fpdf->Cell(45, 5, $data->ant1, 1, 0, '');
        $this->fpdf->Cell(45, 5, $data->beh1, 1, 0, '');
        $this->fpdf->Cell(45, 5, $data->con1, 1, 0, '');
        $this->fpdf->Cell(30, 5, $data->fun1, 1, 0, '');
        $this->fpdf->Cell(25, 5, $data->fre1, 1, 1, '');

        $this->fpdf->NormalText();
        $this->fpdf->Cell(45, 5, $data->ant2, 1, 0, '');
        $this->fpdf->Cell(45, 5, $data->beh2, 1, 0, '');
        $this->fpdf->Cell(45, 5, $data->con2, 1, 0, '');
        $this->fpdf->Cell(30, 5, $data->fun2, 1, 0, '');
        $this->fpdf->Cell(25, 5, $data->fre2, 1, 1, '');

        $this->fpdf->NormalText();
        $this->fpdf->Cell(45, 5, $data->ant3, 1, 0, '');
        $this->fpdf->Cell(45, 5, $data->beh3, 1, 0, '');
        $this->fpdf->Cell(45, 5, $data->con3, 1, 0, '');
        $this->fpdf->Cell(30, 5, $data->fun3, 1, 0, '');
        $this->fpdf->Cell(25, 5, $data->fre3, 1, 1, '');

        //Signature Module
        $this->fpdf->print_sig($data, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }


    //Form 60
    public function supervision_and_session(Request $request)
    {
        $obj = \App\Models\saa_sixty_form::where('session_id', $request->session_id)->where('admin_id', $this->admin_id)->first();
        $data = json_decode($obj->data_obj);

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        $this->fpdf->Title('SUPERVISION NON-BILLABLE BRCT', 16);

        $this->fpdf->SetDrawColor(32, 122, 199);
        $this->fpdf->SetLineWidth(0.5);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, "CLIENT INFORMATION", 0, 1);


        $val = '';
        if (property_exists($data, 'clname')) {
            $val = $data->clname;
        }

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(80, 5, $val, 1);


        $val = '';
        if (property_exists($data, 'dob')) {
            $val = $data->dob;
        }

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'DOB:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(23, 5, $val, 1);

        $val = '';
        if (property_exists($data, 'age')) {
            $val = $data->age;
        }

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(10, 5, 'Age:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $val, 1, 1);


        $val = '';
        if (property_exists($data, 'diagnosis')) {
            $val = $data->diagnosis;
        }


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Diagnosis:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $val, 1, 1);


        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, "SUPERVISOR/SUPERVISEE INFORMATION:", 0, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(95, 5, 'Supervisor\'s Name (BCBA/BCaBA):', 1, 0, '', true);
        $this->fpdf->Cell(95, 5, 'Registered Behavior Technician\'s Name:', 1, 1, '', true);

        $this->fpdf->NormalText();

        $val = '';
        if (property_exists($data, 'supname')) {
            $val = $data->supname;
        }

        $this->fpdf->Cell(95, 5, $val, 1);

        $val = '';
        if (property_exists($data, 'regtech')) {
            $val = $data->regtech;
        }

        $this->fpdf->Cell(95, 5, $val, 1, 1);


        $this->fpdf->Ln();

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 10, 'SUPERVISED SESSION DATE:', 0, 1);

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(63.33, 5, 'Service Date:', 1, 0, '', true);
        $this->fpdf->Cell(63.33, 5, 'Service Start Time:', 1, 0, '', true);
        $this->fpdf->Cell(63.33, 5, 'Service End Time:', 1, 1, '', true);


        $this->fpdf->NormalText();

        $val = '';
        if (property_exists($data, 'sd')) {
            $val = $data->sd;
        }


        $this->fpdf->Cell(63.33, 5, $val, 1);


        $val = '';
        if (property_exists($data, 'sst')) {
            if ($data->sst != null)
                $val = Carbon::parse($data->sst)->format('g:i A');
        }


        $this->fpdf->Cell(63.33, 5, $val, 1);

        $val = '';
        if (property_exists($data, 'set')) {
            if ($data->set != null)
                $val = Carbon::parse($data->set)->format('g:i A');
        }

        $this->fpdf->Cell(63.33, 5, $val, 1, 1);
        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(55, 5, 'PARENT TRAINING PROVIDED:', 1, 0, '', true);

        $txt = '';
        if (property_exists($data, 'supprovide')) {
            if ($data->supprovide != null) $txt .= 'In Person, ';
        }
        if (property_exists($data, 'supremote')) {
            if ($data->supremote != null) $txt .= 'Remote, ';
        }

        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $txt, 1, 1);

        $val = '';
        if (property_exists($data, 'supoverview')) {
            $val = $data->supoverview;
        }

        $this->fpdf->CC('SUPERVISION OVERVIEW:', $val);

        $val = '';
        if (property_exists($data, 'supfeed')) {
            $val = $data->supfeed;
        }

        $this->fpdf->CC('FEEDBACK FROM SUPERVISOR:', $val);




        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'ORGANIZATION AND PROFESSIONALISM', 0, 1);
        $this->fpdf->Ln(2);
        $this->fpdf->NormalText();
        $this->fpdf->SetWidths(array(7, 168, 15));
        $this->fpdf->SetAligns(array('C', 'L', 'C'));

        $ans = '';
        if (property_exists($data, 'refrains')) {
            if ($data->refrains == 1) $ans = 'Yes';
            else if ($data->refrains == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('1', 'Refrains from speaking about client during session and in front of client', $ans));


        $ans = '';
        if (property_exists($data, 'mimic')) {

            if ($data->mimic == 1) $ans = 'Yes';
            else if ($data->mimic == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('2', 'Does not mock or mimic client', $ans));



        $ans = '';
        if (property_exists($data, 'compare')) {

            if ($data->compare == 1) $ans = 'Yes';
            else if ($data->compare == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('3', 'Does not compare client to another client', $ans));


        $ans = '';
        if (property_exists($data, 'demands')) {

            if ($data->demands == 1) $ans = 'Yes';
            else if ($data->demands == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('4', 'Only gives demands to own client', $ans));


        $ans = '';
        if (property_exists($data, 'Stays')) {

            if ($data->Stays == 1) $ans = 'Yes';
            else if ($data->Stays == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('5', 'Stays within arm\'s reach of client', $ans));



        $ans = '';
        if (property_exists($data, 'rbt_arrives')) {

            if ($data->rbt_arrives == 1) $ans = 'Yes';
            else if ($data->rbt_arrives == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('6', 'RBT arrives on-time and prepared?', $ans));


        $ans = '';
        if (property_exists($data, 'rbt_begins')) {

            if ($data->rbt_begins == 1) $ans = 'Yes';
            else if ($data->rbt_begins == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('7', 'RBT begins promptly/avoids wasted time?', $ans));


        $ans = '';
        if (property_exists($data, 'catalyst')) {

            if ($data->catalyst == 1) $ans = 'Yes';
            else if ($data->catalyst == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('8', 'Data taken on catalyst in real time', $ans));


        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'DIRECT INSTRUCTION', 0, 1);
        $this->fpdf->Ln(2);
        $this->fpdf->NormalText();


        $ans = '';
        if (property_exists($data, 'session')) {

            if ($data->session == 1) $ans = 'Yes';
            else if ($data->session == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('1', 'Was each target hit at least 5 times in the session', $ans));


        $ans = '';
        if (property_exists($data, 'establishes')) {

            if ($data->establishes == 1) $ans = 'Yes';
            else if ($data->establishes == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('2', 'RBT establishes instructional control?', $ans));


        $ans = '';
        if (property_exists($data, 'prompts')) {

            if ($data->prompts == 1) $ans = 'Yes';
            else if ($data->prompts == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('3', 'Instructions and prompts are clear and concise?', $ans));

        $ans = '';
        if (property_exists($data, 'presented')) {

            if ($data->presented == 1) $ans = 'Yes';
            else if ($data->presented == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('4', 'Sd presented only 1 time before either a response or prompt? (No repeated Sds)?', $ans));

        $ans = '';
        if (property_exists($data, 'neutral')) {

            if ($data->neutral == 1) $ans = 'Yes';
            else if ($data->neutral == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('5', 'Tone of voice neutral?', $ans));

        $ans = '';
        if (property_exists($data, 'enthusiasm')) {

            if ($data->enthusiasm == 1) $ans = 'Yes';
            else if ($data->enthusiasm == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('6', 'Correct level of enthusiasm', $ans));

        $ans = '';
        if (property_exists($data, 'operants')) {

            if ($data->operants == 1) $ans = 'Yes';
            else if ($data->operants == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('7', 'Tasks are mixed and varied across operants?', $ans));

        $ans = '';
        if (property_exists($data, 'Appropriate')) {

            if ($data->Appropriate == 1) $ans = 'Yes';
            else if ($data->Appropriate == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('8', 'Appropriate ratio of easy (mastered) vs. difficult (acquisition) tasks? 80/20 rule?', $ans));

        $ans = '';
        if (property_exists($data, 'errorless')) {

            if ($data->errorless == 1) $ans = 'Yes';
            else if ($data->errorless == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('9', 'Errorless teaching is used with appropriate time delay', $ans));

        $ans = '';
        if (property_exists($data, 'rbt_maintains')) {

            if ($data->rbt_maintains == 1) $ans = 'Yes';
            else if ($data->rbt_maintains == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('10', 'RBT maintains appropriate pace of instruction (inter-trial intervals no more than 3 seconds)', $ans));

        $ans = '';
        if (property_exists($data, 'fluency')) {

            if ($data->fluency == 1) $ans = 'Yes';
            else if ($data->fluency == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('11', ' Teaches to fluency', $ans));

        $ans = '';
        if (property_exists($data, 'maintenance')) {

            if ($data->maintenance == 1) $ans = 'Yes';
            else if ($data->maintenance == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('12', 'Updates maintenance targets and practices them within trials', $ans));


        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'REINFORCEMENT', 0, 1);
        $this->fpdf->Ln(2);
        $this->fpdf->NormalText();


        $ans = '';
        if (property_exists($data, 'immediately')) {

            if ($data->immediately == 1) $ans = 'Yes';
            else if ($data->immediately == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('1', 'Were reinforcers delivered immediately', $ans));

        $ans = '';
        if (property_exists($data, 'rbt_maintain')) {

            if ($data->rbt_maintain == 1) $ans = 'Yes';
            else if ($data->rbt_maintain == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('2', 'Did the RBT maintain control of the reinforcers?', $ans));

        $ans = '';
        if (property_exists($data, 'reinforcement')) {

            if ($data->reinforcement == 1) $ans = 'Yes';
            else if ($data->reinforcement == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('3', 'Was the reinforcement schedule appropriate for the learner?', $ans));

        $ans = '';
        if (property_exists($data, 'rbt_utilize')) {

            if ($data->rbt_utilize == 1) $ans = 'Yes';
            else if ($data->rbt_utilize == 2) $ans = 'No';
            else if ($data->rbt_utilize == 3) $ans = 'N/A';
        }
        $this->fpdf->Row(array('4', 'Did the RBT utilize differential reinforcement?', $ans));


        $ans = '';
        if (property_exists($data, 'variety')) {

            if ($data->variety == 1) $ans = 'Yes';
            else if ($data->variety == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('5', 'Were a variety of reinforcers used?', $ans));

        $ans = '';
        if (property_exists($data, 'behavior-specific')) {

            if ($data->{'behavior-specific'} == 1) $ans = 'Yes';
            else if ($data->{'behavior-specific'} == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('6', 'RBT paired behavior-specific praise with tangible reinforcers?', $ans));

        $ans = '';
        if (property_exists($data, 'inappropriate')) {

            if ($data->inappropriate == 1) $ans = 'Yes';
            else if ($data->inappropriate == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('7', 'Reinforcers were delivered contingent upon correct responses, attending, and lack of inappropriate behavior?', $ans));



        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'CONSEQUENCES: PROMPTING AND ERROR CORRECTION AND ERRORLESS TEACHING', 0, 1);
        $this->fpdf->Ln(2);
        $this->fpdf->NormalText();



        $ans = '';
        if (property_exists($data, 'necessary')) {

            if ($data->necessary == 1) $ans = 'Yes';
            else if ($data->necessary == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('1', 'Are prompts provided when necessary?', $ans));

        $ans = '';
        if (property_exists($data, 'response')) {

            if ($data->response == 1) $ans = 'Yes';
            else if ($data->response == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('2', 'Was there only a 3 second delay between the Sd and the response or prompt', $ans));

        $ans = '';
        if (property_exists($data, 'trial_presented')) {

            if ($data->trial_presented == 1) $ans = 'No';
            else if ($data->trial_presented == 2) $ans = 'Others';
        }
        $this->fpdf->Row(array('3', 'Are transfer trials presented after each prompted response?', $ans));

        $ans = '';
        if (property_exists($data, 'rbt_uses')) {

            if ($data->rbt_uses == 1) $ans = 'Yes';
            else if ($data->rbt_uses == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('4', 'RBT uses prompts that reliably evoke the appropriate response?', $ans));

        $ans = '';
        if (property_exists($data, 'prompt_verified')) {

            if ($data->prompt_verified == 1) $ans = 'Yes';
            else if ($data->prompt_verified == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('5', 'Are prompts varied depending on the skill being taught?', $ans));

        $ans = '';
        if (property_exists($data, 'progressively')) {

            if ($data->progressively == 1) $ans = 'Yes';
            else if ($data->progressively == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('6', 'Were prompts progressively and systematically faded?', $ans));

        $ans = '';
        if (property_exists($data, 'implemented')) {

            if ($data->implemented == 1) $ans = 'Yes';
            else if ($data->implemented == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('7', 'Are correction procedures implemented correctly? (Re-states Sd with 0 second time delay after error/no response?)', $ans));

        $ans = '';
        if (property_exists($data, 'consequence')) {

            if ($data->consequence == 1) $ans = 'Yes';
            else if ($data->consequence == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('8', 'Was every instruction followed by a consequence (reinforcement, prompt, or correction procedure)?', $ans));



        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'Behavior Management', 0, 1);
        $this->fpdf->Ln(2);
        $this->fpdf->NormalText();

        $ans = '';
        if (property_exists($data, 'behavior-protocols')) {

            if ($data->{'behavior-protocols'} == 1) $ans = 'Yes';
            else if ($data->{'behavior-protocols'} == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('1', 'Problem behavior protocols utilized correctly as outlined in Catalyst/BIP', $ans));


        $ans = '';
        if (property_exists($data, 'unwanted')) {

            if ($data->unwanted == 1) $ans = 'Yes';
            else if ($data->unwanted == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('2', 'Implements antecedent strategies appropriately when unwanted behaviors are not occurring?', $ans));

        $ans = '';
        if (property_exists($data, 'intervention')) {

            if ($data->intervention == 1) $ans = 'Yes';
            else if ($data->intervention == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('3', 'Utilizes appropriate behavior intervention when behavior occurs?', $ans));

        $ans = '';
        if (property_exists($data, 'reinforcement')) {

            if ($data->reinforcement == 1) $ans = 'Yes';
            else if ($data->reinforcement == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('4', 'Provides positive reinforcement for an appropriate behavior following behavior intervention?', $ans));

        $ans = '';
        if (property_exists($data, 'composure')) {

            if ($data->composure == 1) $ans = 'Yes';
            else if ($data->composure == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('5', 'Maintains composure during procedures?', $ans));

        $ans = '';
        if (property_exists($data, 'strategy')) {

            if ($data->strategy == 1) $ans = 'Yes';
            else if ($data->strategy == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('6', 'Employs wait/help/prompt strategy when possible', $ans));

        $ans = '';
        if (property_exists($data, 'recorded')) {

            if ($data->recorded == 1) $ans = 'Yes';
            else if ($data->recorded == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('7', 'RBT recorded appropriate data?', $ans));




        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'DATA COLLECTION/PROGRAM MANAGEMENT', 0, 1);
        $this->fpdf->Ln(2);
        $this->fpdf->NormalText();







        $ans = '';
        if (property_exists($data, 'begins-session')) {

            if ($data->{'begins-session'} == 1) $ans = 'Yes';
            else if ($data->{'begins-session'} == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('1', 'Plan validity', $ans));

        $ans = '';
        if (property_exists($data, 'ends-session')) {

            if ($data->{'ends-session'} == 1) $ans = 'Yes';
            else if ($data->{'ends-session'} == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('2', 'BCBA/ Clinic Director work with RBT', $ans));

        $ans = '';
        if (property_exists($data, 'objective-notes')) {

            if ($data->{'objective-notes'} == 1) $ans = 'Yes';
            else if ($data->{'objective-notes'} == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('3', 'Data collection modified for client', $ans));

        $ans = '';
        if (property_exists($data, 'supervisory')) {

            if ($data->supervisory == 1) $ans = 'Yes';
            else if ($data->supervisory == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('4', 'IOA done during session', $ans));


        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'BCBA Responsibilities', 0, 1);
        $this->fpdf->Ln(2);
        $this->fpdf->NormalText();


        $this->fpdf->SetWidths(array(7, 63, 120));



        $ans = '';
        if (property_exists($data, 'plan-validity')) {

            if ($data->{'plan-validity'} == 1) $ans = 'Targets mastered out during session by BCBA';
            else if ($data->{'plan-validity'} == 2) $ans = 'Targets added during session by BCBA';
            else if ($data->{'plan-validity'} == 3) $ans = 'Plan appropriate without changes';
        }
        $this->fpdf->Row(array('1', 'Plan validity', $ans));

        $ans = '';
        if (property_exists($data, 'clinic-director')) {

            if ($data->{'clinic-director'} == 1) $ans = 'Modeling done for RBT for accurate implementation of plan';
            else if ($data->{'clinic-director'} == 2) $ans = 'RBT implementing plan without direction';
        }
        $this->fpdf->Row(array('2', 'BCBA/ Clinic Director work with RBT', $ans));

        $ans = '';
        if (property_exists($data, 'data-collection')) {

            if ($data->{'data-collection'} == 1) $ans = 'Yes';
            else if ($data->{'data-collection'} == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('3', 'Data collection modified for client', $ans));

        $ans = '';
        if (property_exists($data, 'IOAion')) {

            if ($data->IOAion == 1) $ans = 'Yes';
            else if ($data->IOAion == 2) $ans = 'No';
        }
        $this->fpdf->Row(array('4', 'IOA done during session', $ans));

        $this->fpdf->Ln();

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(95, 5, 'Provider Full Name', 1, 0, '', true);
        $this->fpdf->Cell(95, 5, 'Provider Credentials', 1, 1, '', true);

        $this->fpdf->NormalText();

        $this->fpdf->Cell(95, 5, $data->pfn, 1);
        $this->fpdf->Cell(95, 5, $data->pcred, 1, 1);


        //Signature Module
        $this->fpdf->print_sig($obj, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }

    //Form 61
    public function session_notes_2(Request $request)
    {
        $obj = \App\Models\sn_sixtyone_form::where('session_id', $request->session_id)->where('admin_id', $this->admin_id)->first();
        $data = json_decode($obj->data_obj);

        $txt = '';
        if (!$this->declare_PDF()) {
            // return "Please upload logo to proceed!";exit();
        }

        error_reporting(0);
        $this->fpdf->Title('Session Notes',16);

        $val='';
        $val=$data->clname;
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Client Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(120, 5, $val, 1);


        $val='';
        if($data->birth_date!=null)
            $val=Carbon::parse($data->birth_date)->format('m/d/Y');
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(12, 5, 'DOB:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $val, 1, 1, 'C');


        $val='';
        $val=$data->client_diag;
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(32, 5, 'Client Diagnosis:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $val, 1, 1);

        $val='';
        $val=$data->payor_full_name;
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(55, 5, 'Payor (Subscriber) Full Name:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $val, 1, 1);

        $val='';
        $val=$data->home_address;
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(47, 5, 'Client Full Home Address:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $val, 1, 1);

        $val='';
        if($data->session_date!=null)
        $val=Carbon::parse($data->session_date)->format('m/d/Y');
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Session Date:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(25, 5, $val, 1);

        $val='';
        $val=$data->service_location;

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(40, 5, 'Service location Type:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $val, 1, 1);

        $val='';
        $val=$data->service_unit;
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(42, 5, 'Service Units this code:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(30, 5, $val, 1, 0, 'C');


        $val='';
        if($data->start_time!=null)
            $val=Carbon::parse($data->start_time)->format('g:i a');
      
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(35, 5, 'Service Start Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(25, 5, $val, 1);

        $val='';
        if($data->end_time!=null)
            $val=Carbon::parse($data->end_time)->format('g:i a');
     
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(35, 5, 'Session End Time:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $val, 1, 1, 'C');

        $val='';
        $val=$data->service_loc;
        $this->fpdf->CC('Service location full address:',$val);

        $val='';
        $val=$data->attendees;
        $this->fpdf->CC('All attendees in session:',$val);

        $val='';
        $val=$data->entire_age;
        $this->fpdf->CC('Parent/Guardian present during session:',$val);
        $this->fpdf->Ln();

        $ans = '';

        if($data->timeframe_rbt==1){
            $ans='Room A';
        }
        else{
            $ans='Room B';
        }
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(0, 5, 'LOCATION OF PARENT MEETING IF RBT IS WORKING 1:1 WITH CLIENT DURING SAME TIMEFRAME:', 1, 1, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $ans, 1, 1, 'C');

        $val='';
        $val=$data->auth_aba;

        $this->fpdf->CC('Name of the authorized ABA supervisor:', $val);


        $this->fpdf->Ln();
        $this->fpdf->HeadingText('brown');
        $this->fpdf->Cell(0, 5, 'CODE USED FOR THIS SESSION:', 0, 1);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->MultiCell(0, 5, 'IF SUPERVISION IS BEING CONDUCTED DO NOT USE THIS FORM. YOU MUST USE SUPERVISION FORM RELATED TO YOUR CREDENTIALING.', 0, 'L');

        $ans='';

        $ans.=$data->abadirect;
        $ans.=', '.$data->modification_97155;

        $this->fpdf->CC('BOARD CERTIFIED BEHAVIOR ANALYST CODES:', $ans);

        $ans='';
        $ans.=$data->RBT97153;
        $ans.=', '.$data->direct_h2;
   

        $this->fpdf->CC('REGISTERED BEHAVIOR TECHNICIAN CODES:', $ans);

        $this->fpdf->Ln();
        $this->fpdf->HeadingText('blue');
        $this->fpdf->MultiCell(0, 5, 'STRESSOR(S)/EXTRAORDINARY EVENTS/ SIGNIFICANT CHANGES SINCE LAST SESSION WITH PROVIDER FILLING OUT THIS NOTE:', 0, 'L');
        $this->fpdf->NormalText();



        $ans='';
        if($data->medication==1)  $ans='Yes';
        else if($data->medication==2)  $ans='No';

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(27.5, 5, 'Medication:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $ans, 1, 0, 'C');


        $ans='';
        if($data->living_situation==1)  $ans='Yes';
        else if($data->living_situation==2)  $ans='No';
    

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(30.5, 5, 'Living situation:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $ans, 1, 0, 'C');

        $ans='';
        if($data->insurance==1)  $ans='Yes';
        else if($data->insurance==2)  $ans='No';
      
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(27.5, 5, 'Insurance:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $ans, 1, 0, 'C');

        $ans='';
        if($data->illness==1)  $ans='Yes';
        else if($data->illness==2)  $ans='No';
    
        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(24, 5, 'Illness:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(20, 5, $ans, 1, 1, 'C');

        $ans='';
        if($data->other_notable_change==1)  $ans='NONE';
        else if($data->other_notable_change==2)  $ans='Home family activities';
        else if($data->other_notable_change==3)  $ans='Inappropriate behaviors in school';
        else if($data->other_notable_change==4)  $ans='Inappropriate behaviors in community';

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(45, 5, 'Other notable changes?', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $ans, 1, 1);


        $this->fpdf->HeadingText('brown');
        $this->fpdf->Ln(5);
        $this->fpdf->MultiCell(0,5,'If yes to any changes above, please list in detail changes and impact on client. Medications changes noted by RBT must be communicated to BCBA on date of session.',0,'L');

        $this->fpdf->CC('Changes Details:',$data->changes_text);
        $this->fpdf->Ln();


        $ans='';
        if($data->danger==1)  $ans='None';
        else if($data->danger==2)  $ans='Self';
        else if($data->danger==3)  $ans='Others';
        else if($data->danger==4)  $ans='Property';
        

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(25, 5, 'Danger to:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $ans, 1, 1);


        $ans='';
        if($data->response_danger==1)  $ans='Ideation';
        else if($data->response_danger==2)  $ans='Plan';
        else if($data->response_danger==3)  $ans='Attempt';
        else if($data->response_danger==4)  $ans='Intent';
        else if($data->response_danger==4)  $ans='Other';
       

        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(120, 5, 'If selected any option besides none select appropriate response:', 1, 0, '', true);
        $this->fpdf->NormalText();
        $this->fpdf->Cell(0, 5, $ans, 1, 1);

        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('brown');
        $this->fpdf->MultiCell(0, 5, '***If YES selected you must notify your supervising BCBA immediately. The BCBA will contact the office if warranted.', 0, 'L');

        $this->fpdf->CC('Disposition of client upon arrival:', $data->client_dispo);

        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->MultiCell(0, 5, 'Activities/Goals/Objectives worked on during this session:', 0, 'L');


        $ans='';
        $ans.=$data->social_skill;
        $ans.=$data->roleplay.', ';
        $ans.=$data->premack.', ';
        $ans.=$data->stimulus.', ';
        $ans.=$data->videomodeling.', ';
        $ans.=$data->shaping.', ';
        $this->fpdf->CC('SKILL ACQUISITION:',$ans);


        $ans='';
        $ans.=$data->timer;
        $ans.=$data->tokenboard.', ';
        $ans.=$data->selfmonitor.', ';
        $ans.=$data->dtt.', ';
        $ans.=$data->antecedent.', ';
        $ans.=$data->selfmanagement.', ';
        

        $this->fpdf->CC('Behavior Contract:', $ans);


        $ans='';
        $ans.=$data->fct;
        $ans.=$data->visualaid.', ';
        $ans.=$data->errorless.', ';
        $ans.=$data->net.', ';
        $ans.=$data->chaining.', ';
        $ans.=$data->other.', ';
     

        $this->fpdf->CC('Differential Reinforcement:', $ans);

        $this->fpdf->Ln(5);
        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'IF OTHER LIST BELOW WHAT PROCEDURES WERE USED:', 0, 1);

        $this->fpdf->Ln(3);


        $val='';
        $val=$data->goals;

        $this->fpdf->HeadingText('brown');
        $this->fpdf->MultiCell(0, 5, 'Goals/Targets- Must include goal from treatment plan and must be identical to what is written in the treatment plan. Trials Ran etc. Examples: matching and identifying', 0, 'L');
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 5, $val, 0, 'L');


        $val='';
        $val=$data->approach;
  
        $this->fpdf->Ln(3);
        $this->fpdf->HeadingText('brown');
        $this->fpdf->MultiCell(0, 5, 'Treatment Approach/ Measures: How did you work on goal(s) from #1? What tools/techniques/supplies did you use? This section must be more than a sentence or two.', 0, 'L');
        $this->fpdf->NormalText();
        $this->fpdf->MultiCell(0, 5, $val, 0, 'L');


        $this->fpdf->Ln(5);

        $this->fpdf->HeadingText('blue');
        $this->fpdf->Cell(0, 5, 'NEXT SCHEDULED SESSION:', 0, 1);


        $this->fpdf->HeadingText('white');
        $this->fpdf->Cell(63.33, 5, 'Date:', 1, 0, 'C', true);
        $this->fpdf->Cell(63.33, 5, 'Time:', 1, 0, 'C', true);
        $this->fpdf->Cell(63.33, 5, 'Location Type:', 1, 1, 'C', true);


        $this->fpdf->NormalText();

        $val='';
        if($data->nextshd_date!=null)
            $val=Carbon::parse($data->nextshd_date)->format('m/d/Y');

        $this->fpdf->Cell(63.33, 5, $val, 1, 0, 'C');

        $val='';
        if($data->nextshd_time!=null)
            $val=Carbon::parse($data->nextshd_time)->format('g:i a');

        $this->fpdf->Cell(63.33, 5, $val, 1, 0, 'C');

        $val='';
        $val=$data->nextshd_loc;
 
        $this->fpdf->Cell(63.33,5,$val,1,1,'C');
        $this->fpdf->Ln();


        //Signature Module
        $this->fpdf->print_sig($obj, $request->session_id);

        //Footer
        $this->fpdf->CustomFooter();

        $this->fpdf->Output();
    }
}
