<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Codedge\Fpdf\Fpdf\Fpdf;

class Pdf extends Fpdf
{
    

    private $i=0;
    var $widths;
    var $aligns;
    var $check;
    var $checkVar;
    
    function THead($txt){
        $this->SetFillColor(32,122,199);
        $this->SetTextColor(255,255,255);
        $this->SetFont('OpenSans','B',12);
        $this->Cell(0,5,$txt,1,1,'C',true);
        $this->SetTextColor(0,0,0);
    }
    function Header(){
        $this->SetAutoPageBreak(true,10);
        $this->SetFont('Arial','B',24);
        $this->SetFillColor(32,122,199);
        $this->Rect(0,0,210,300,'F');
        $this->SetFillColor(255,255,255);
        $this->Rect(5,5,200,287,'F');
        $this->Image(public_path().'/assets/dashboard/images/pdf_logo.png',10,7,60,25);
        $this->SetXY(110,10);
        $this->HeadingText('blue');
        $this->Cell(13,5,'Mail:',0,0);
        $this->NormalText();
        $this->MultiCell(0,5,'5658 Sepulveda Blvd. Suite 200 Sherman Oaks, CA 91411',0,'L');
        $this->SetX(110);
        $this->HeadingText('blue');
        $this->Cell(13,5,'Email:',0,0);
        $this->NormalText();
        $this->MultiCell(0,5,'info@behaviortrend.com');
        $this->SetX(110);
        $this->HeadingText('blue');
        $this->Cell(13,5,'Phone:',0,0);
        $this->NormalText();
        $this->MultiCell(0,5,'818.369.4440');
        $this->SetX(110);
        $this->HeadingText('blue');
        $this->Cell(13,5,'Fax:',0,0);
        $this->NormalText();
        $this->MultiCell(0,5,'818.369.5800');
        if($this->PageNo()==1){
            $this->Ln(5);
        }
        else{
            $this->Ln(15);
        }
        $this->SetFillColor(32,122,199);
    }
    function CustomFooter(){
        $this->Ln(2);
        if($this->GetY()>272){
            $this->AddPage();
        }
        $this->SetY(-25);
        $this->HeadingText();
        $this->Cell(66,5,'Behavior Trend Inc.',0,0,'R');
        $this->NormalText();
        $this->Cell(0,5,'5658 Sepulveda Blvd. Suite 200 Sherman Oaks, CA 91411',0,1);
        $this->HeadingText('blue');
        $this->Cell(0,5,'Phone: 818.369.4440, Email: info@behaviortrend.com, Fax: 818.369.5800',0,1,'C');
        $this->Cell(0,5,'behaviortrend.com',0,1,'C');
    }
    function Title($string,$size=13){
        $this->SetTextColor(217,83,79);
        $this->SetFont('Opensans','B',$size);
        $this->Cell(0,10,$string,0,1,'C');
        $this->SetTextColor(0,0,0);
        $this->SetDrawColor(217,83,79);
        $this->SetLineWidth(1);
        $y=$this->GetY();
        $this->Line(95,$y,115,$y);
        $this->SetLineWidth(0.2);
        $this->Ln(5);
        $this->SetFillColor(32,122,199);
    }
    function HeadingText($color='black',$style="B",$size=10){
        $this->SetDrawColor(32,122,199);
        $this->SetLineWidth(0.5);
        if($color=='black'){
            $this->SetTextColor(0,0,0);
        }
        else if($color=='brown'){
            $this->SetTextColor(217,83,79);
        }
        else if($color=='white'){
            $this->SetTextColor(255,255,255);
        }
        else{
            $this->SetTextColor(32,122,199);
        }

        if($style=="B"){
            $this->SetFont('OpenSans','B',$size);
        }
        else{
            $this->SetFont('OpenSans','BI',$size);
        }
    }
    function NormalText(){
        $this->SetTextColor(0,0,0);
        $this->SetFont('OpenSans','',10);
    }
    function CodeBlock($title,$txt){
        $txt='              '.$txt;
        $this->Ln(5);

        if($this->GetY()>=275){
            $this->AddPage();
        }
        $this->SetLeftMargin(10);
        $this->HeadingText('blue','B');
        $this->Cell(0,10,$title,'LTR',1);
        $sign=$this->HeightCalculator(190,5,$txt);
        $this->BottomLine($sign);
        $this->NormalText();
        $this->MultiCell(0,5,$txt,'LBR');
        $this->HeadingText('blue','B');
        $this->Heading($sign,$title);
    }

    function CC($title,$txt,$hc='black',$st='B',$sz=10,$h2='',$h2c='brown',$st2='I',$sz2=8.5){

        $txt='        '.$txt;
        $this->Ln(5);

        $eh=10;

        if($h2!==''){
            $this->SetFont('','',$sz2);
            $h2h=$this->GetMultiCellHeight(180,5,$h2);
            $eh=$eh+$h2h;
        }

        if($this->GetY()>=285-$eh){
            $this->AddPage();
        }
        $this->SetLeftMargin(12.5);
        $this->SetRightMargin(12.5);
        $this->HeadingText($hc,$st,$sz);
        $this->Cell(0,10,$title,0,1);
        if($h2!==''){
            $this->HeadingText($h2c,$st2,$sz2);
            $this->MultiCell(0,5,$h2,0,1);
        }
        $y1=$this->GetY();
        $this->NormalText();

        $check=$this->HC(185,5,$txt);
        if($check["sign"]==true){
            $h=$check["h"];
            $y2=285+5;
            $this->Rect(10,$y1-$eh,190,$y2-$y1+$eh);
            $this->MultiCell(0,5,$txt);
            $y=285-$y1;
            $hr=$h-$y;
            $ty=$this->GetY();
            $this->SetY($this->GetY()-$hr-10);
            $this->HeadingText($hc,$st,$sz);
            $this->Cell(0,10,$title,0,1);
            $this->Rect(10,40,190,$hr+5+10);
            $this->SetY($ty+5);
        }
        else{
            $this->MultiCell(0,5,$txt);
            $this->SetY($this->GetY()+5);
            $y2=$this->GetY();
            $this->Rect(10,$y1-$eh,190,$y2-$y1+$eh);
        }

        $this->SetLeftMargin(10);
        $this->SetRightMargin(10);
    }

    function AddingFonts(){
        $this->AddFont('Opensans','','OpenSans-Regular.php');
        $this->AddFont('Opensans','B','OpenSans-Bold.php');
        $this->AddFont('Opensans','I','OpenSans-Italic.php');
        $this->AddFont('Opensans','BI','OpenSans-BoldItalic.php');
    }
    function HeightCalculator($w,$h,$txt){
        global $sign;
        $ch=$this->GetMultiCellHeight($w,$h,$txt);
        $y=$this->GetY();
        if(285-$y<$ch)  {$sign=true;}
        else   {$sign=false;}
        return $sign;
    }

    function HC($w,$h,$txt){
        global $sign;
        $ch=$this->GetMultiCellHeight($w,$h,$txt);
        $y=$this->GetY();
        if(285-$y<$ch)  {$sign=true;}
        else   {$sign=false;}
        return array("sign"=>$sign,"h"=>$ch);
    }

    function Heading($sign,$string){
        if($sign){
            $x=$this->GetX();$y=$this->GetY();
            $this->SetXY(10,40);
            $this->Cell(0,10,$string,'LTR');
            $this->SetXY($x,$y);
        }
    }


    function BottomLine($sign){
        if($sign){
            $this->Line(10,285,200,285);
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

    function CustomCheck($check=false,$checkVar=0){
        $this->check=$check;
        $this->checkVar=$checkVar;
    }

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            if($this->check==true){
                if($i==0 || $i==2){
                    if($this->checkVar==0){
                        $this->SetFont('OpenSans','',10);
                    }
                    else if($this->checkVar==1){
                        $this->SetFont('OpenSans','B',10);
                    }
                }
                else{
                    if($this->checkVar==0){
                        $this->SetFont('OpenSans','B',10);
                    }
                    else if($this->checkVar==1){
                        $this->SetFont('OpenSans','',10);
                    }
                }
            }
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
}
