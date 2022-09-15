<?php
namespace App\Http\Lib;
use Codedge\Fpdf\Fpdf\Fpdf;
class extended extends FPDF{

    function Header(){
        $this->SetTopMargin(20);
        $this->SetAutoPageBreak(true,20);
        $this->SetFont('Arial','B',24);
        $this->SetFillColor(32,122,199);
        $this->Rect(0,0,210,300,'F');
        $this->SetFillColor(255,255,255);
        $this->Rect(5,5,200,287,'F');
    }
    function HeightCalculator($w,$h,$txt){
        global $sign;
        $ch=$this->GetMultiCellHeight($w,$h,$txt);
        $y=$this->GetY();
        if(277-$y<$ch)  {$sign=true;}
        else   {$sign=false;}
        return $sign;
    }
    function Heading($sign,$string){
        if($sign){
            $x=$this->GetX();$y=$this->GetY();
            $this->SetFont('Arial','B',14);
            $this->SetXY(12,10);
            $this->Cell(0,5,$string,0,0);
            $this->SetFont('Arial','',14);
            $this->SetXY($x,$y);
        }
    }
    function DrawLine(){
        $this->SetDrawColor(32,122,199);
        $this->SetLineWidth(0.7);
        $y=$this->GetY();
        $this->Line(10,$y,200,$y);
        $this->Ln(2);
    }

    function DrawBoldLine(){
        $this->SetLineWidth(2);
        $this->Ln(13);
        $y=$this->GetY();
        $y=$y-2;
        $this->Line(0,$y,210,$y);
    }


    function GetMultiCellHeight($w, $h, $txt, $border=null, $align='J') {
            // Calculate MultiCell with automatic or explicit line breaks height
            // $border is un-used, but I kept it in the parameters to keep the call
            //   to this function consistent with MultiCell()
            $cw = &$this->CurrentFont['cw'];
            if($w==0)
                $w = $this->w-$this->rMargin-$this->x;
            $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
            $s = str_replace("\r",'',$txt);
            $nb = strlen($s);
            if($nb>0 && $s[$nb-1]=="\n")
                $nb--;
            $sep = -1;
            $i = 0;
            $j = 0;
            $l = 0;
            $ns = 0;
            $height = 0;
            while($i<$nb)
            {
                // Get next character
                $c = $s[$i];
                if($c=="\n")
                {
                    // Explicit line break
                    if($this->ws>0)
                    {
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
                if($c==' ')
                {
                    $sep = $i;
                    $ls = $l;
                    $ns++;
                }
                $l += $cw[$c];
                if($l>$wmax)
                {
                    // Automatic line break
                    if($sep==-1)
                    {
                        if($i==$j)
                            $i++;
                        if($this->ws>0)
                        {
                            $this->ws = 0;
                            $this->_out('0 Tw');
                        }
                        //Increase Height
                        $height += $h;
                    }
                    else
                    {
                        if($align=='J')
                        {
                            $this->ws = ($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
                            $this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
                        }
                        //Increase Height
                        $height += $h;
                        $i = $sep+1;
                    }
                    $sep = -1;
                    $j = $i;
                    $l = 0;
                    $ns = 0;
                }
                else
                    $i++;
            }
            // Last chunk
            if($this->ws>0)
            {
                $this->ws = 0;
                $this->_out('0 Tw');
            }
            //Increase Height
            $height += $h;

            return $height;
        }
    }
?>
