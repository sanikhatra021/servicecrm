<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
include("../connect.php");
	
	 $cmid=(int)mysqli_real_escape_string($conn,$_GET['cmid']);
	$count=1;
	
	 $eve2 = "select uname,umobile,samid from res_user_master where umid in(select customerid from res_complain_master where cmid=$cmid)";
	$re2 = mysqli_query($conn, $eve2) or die("failed1");
	while($rt2 = mysqli_fetch_assoc($re2))
	{
		$custname=$rt2['uname'];
		$custmobile=$rt2['umobile'];
		$_SESSION['samid']=$rt2['samid'];
	} 
	
		$_SESSION['cmid']=$cmid;
		
		 $eve1="select * from res_complainitem_detail where cidid=$cmid";
		$re1 = mysqli_query($conn, $eve1) or die("failed2");;
		while($rt1 = mysqli_fetch_assoc($re1))
		{
			// $_SESSION['cidid']=$rt1['cidid'];
			
			 $_SESSION['pmid']=$rt1['pmid'];
			 $_SESSION['cidqty']=$rt1['cidqty'];
			 $_SESSION['cidrate']=$rt1['cidrate'];			 
			 
		}	
require('fpdf.php');

class PDF_MC_Table extends FPDF
{
	var $widths;
	var $aligns;

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
function GenerateWord()
{
    //Get a random word
    $nb=rand(3,10);
    $w='';
    for($i=1;$i<=$nb;$i++)
        $w.=chr(rand(ord('a'),ord('z')));
    return $w;
}

function GenerateSentence()
{
    //Get a random sentence
    $nb=rand(1,10);
    $s='';
    for($i=1;$i<=$nb;$i++)
        $s.=GenerateWord().' ';
    return substr($s,0,-1);
}

/*
$pdf=new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->SetWidths(array(30,50,30,40));
srand(microtime()*1000000);
for($i=0;$i<20;$i++)
    $pdf->Row(array(GenerateSentence(),GenerateSentence(),GenerateSentence(),GenerateSentence()));
$pdf->Output();

return;
*/


class PDF extends FPDF
{


var $widths;
	var $aligns;

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


function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
// Page header
function Header()
{
		include "../connect.php";

	
	$cmid=(int)mysqli_real_escape_string($conn,$_GET['cmid']);
	$count=1;
	$samid=0;
	
	 $eve2 = "select uname,umobile,samid from res_user_master where umid in(select customerid from res_complain_master where cmid=$cmid)";
	$re2 = mysqli_query($conn, $eve2);
	while($rt2 = mysqli_fetch_assoc($re2))
	{
		$custname=$rt2['uname'];
		$custmobile=$rt2['umobile'];
		 $samid=$rt2['samid'];
		
	} 
	$headerimg="";
	$eve_header="select * from res_generalsettings_master where samid='$samid'";
	$re_header = mysqli_query($conn, $eve_header);
	while($rt_header = mysqli_fetch_assoc($re_header))
	{
		$headerimg=$rt_header['headerimg'];
	}

	$header = "../allimages/$headerimg";
	
	if(strlen($headerimg)>5)
	{
		
		$this->Image("$header",8,6,194,30);
	}
}

// Page footer
function Footer()
{
	include "../connect.php";
	//$samid=$_SESSION['samid'];
	$footerimg="";
	$cmid=(int)mysqli_real_escape_string($conn,$_GET['cmid']);
	$count=1;
	
	$eve_header10="select footerimg from res_generalsettings_master where samid=(select samid from res_user_master where umid in(select customerid from res_complain_master where cmid=$cmid))";
	$re_header10 = mysqli_query($conn, $eve_header10);
	while($rt_header10 = mysqli_fetch_assoc($re_header10))
	{
		$footerimg=$rt_header10['footerimg'];
	}

	$footer = "../allimages/$footerimg";
	
	
	if(strlen($footerimg)>5)
	{
		
		$this->Image("$footer",10,270,190,15);
 	}
}


function ImprovedTable_3()
{
	$kindatten="";
		$w = array(95,95);
		$this->Ln(0);
		$this->SetFont('Arial','',12);
		if($kindatten=='')
		{
		}
		else
		{
			$this->Cell(190,5,"Kind Attn. $kindatten",0,0,'C');
		}
		$_SESSION['disc1']="";
		$disc1=strip_tags($_SESSION['disc1']);
		if($disc1=="")
		{
		}
		else
		{
			$this->SetFont('Arial','B',10);
			$this->Cell(10,5,'',0,0,'L');
			$this->Ln();
			$this->SetFont('Arial','',10);
			$this->MultiCell(0,5,"$disc1");
			$this->SetLineWidth(.3);
			$this->Ln();
		}
}

function ImprovedTable_9()
{
	$_SESSION['disc2']="";
	$w = array(95,95);
	$disc2=strip_tags($_SESSION['disc2']);
	if($disc2=="")
	{
	}
	else
	{
		$this->SetFont('Arial','',10);
		$this->MultiCell(0,5,"$disc2");
		$this->SetLineWidth(.3);
	}
}
function ImprovedTable_4()
{
	include "../connect.php";

	$w = array(15,20,40,20);
	

		$this->SetWidths(array(30,90,20,20,30));
		$this->SetAligns(array('C','C','C','C','C'));
		//$this->SetFillColor(128, 0, 0);
		$this->SetFont('Arial','B',10);
		$this->Row(array('SR. No.','Item','QTY','Rate','Amount'));
		$this->SetFont('Arial','',10);
		$this->SetAligns(array('C','L','L','R','R'));
		
		$prefinalamount=0;
		$ccount="0";
		$subtotal="0";
		$extra1charges="0";
		$extra2charges="0";
		$extra3charges="0";
		$taxtotal="0";
		$grandtotal="0";

		$cmid=$_SESSION['cmid'];
		
		$eve2 = "select * from res_complainitem_detail where cmid=$cmid";
		$re2 = mysqli_query($conn, $eve2);
		
		while($rt2 = mysqli_fetch_assoc($re2))
		{
			$ccount++;
			$pmid=$rt2['pmid'];
			 $eve11 = "select * from res_product_master where pmid=$pmid";
				$re11 = mysqli_query($conn, $eve11);
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$pmname=$rt11['pmname'];
				}
			
			$cidqty=$rt2['cidqty'];
			$cidrate=$rt2['cidrate'];
			//$cmservicecharge=$rt2['cmservicecharge'];
			$total=$cidqty*$cidrate;
			$subtotal=$subtotal+$total;
			
			$this->Row(array($ccount,$pmname,$cidqty,$cidrate,$total));
		
		}
		$_SESSION['subtotal']=$subtotal;
		
		
    $this->Cell(array_sum($w),0,'','T');
	$this->Ln();
}
function ImprovedTable_4_2()
{
	$kindatten="541";
		$w = array(95,95);
		$this->Ln(0);
		$this->SetFont('Arial','',12);
		if($kindatten=='')
		{
		}
		else
		{
			$this->Cell(190,5,"Total $kindatten",0,0,'C');
		}
		$_SESSION['disc1']="";
		$disc1=strip_tags($_SESSION['disc1']);
		if($disc1=="")
		{
		}
		else
		{
			$this->SetFont('Arial','B',10);
			$this->Cell(10,5,'',0,0,'L');
			$this->Ln();
			$this->SetFont('Arial','',10);
			$this->MultiCell(0,5,"$disc1");
			$this->SetLineWidth(.3);
			$this->Ln();
		}
}
function ImprovedTable_2()
{
	include "../connect.php";
	
	$address="";
	$company="";
	//$cmplogo='Arth Technology';
	//$cgstno = $_SESSION['cgstno'];
	$samid=0;
	$custname='';
		$custmobile='';
		$samid=0;
	 $eve2 = "select uname,umobile,res_user_master.samid as samid,cmservicecharge from res_user_master,res_complain_master where res_user_master.umid=res_complain_master.customerid and res_complain_master.cmid=".$_GET['cmid'];
	$re2 = mysqli_query($conn, $eve2);
	while($rt2 = mysqli_fetch_assoc($re2))
	{
		$custname=$rt2['uname'];
		$custmobile=$rt2['umobile'];
		$samid=$rt2['samid'];
		$_SESSION['cmservicecharge']=$rt2['cmservicecharge'];
	} 
	
	/*  $totalamount=$_SESSION['subtotal']+$_SESSION['cmservicecharge'];
	 $_SESSION['totalamount']=$totalamount;
		 */
			 $address='';
		 $company='';	
	$eve21 = "select saaddress,safullname from res_superadmin_master where samid = $samid";
	$re21 = mysqli_query($conn, $eve21);
	while($rt21 = mysqli_fetch_assoc($re21))
	{
		 $address=$rt21['saaddress'];
		 $company=$rt21['safullname'];	
	}
	//$address=$_SESSION['cmpaddress'];
	//$company=$_SESSION['cmpname'];
	
	/* $invshipto1= substr($invshipto,1,40);
	$invshipto2= substr($invshipto,41,60);
	$invshipto3= substr($invshipto,61,100);
	$invshipto4= substr($invshipto,101,140); */
	
	$line1="";
	if (preg_match('/^.{1,52}\b/s', $address, $match))
	{
		$line1=$match[0];
	}
	$tt = strlen($line1);
	$linesub = substr($address,$tt);
	$line2="";
	if (preg_match('/^.{1,48}\b/s', $linesub, $match2))
	{
		$line2=$match2[0];
	}
	//echo "line2: ".$line2;
	$line3="";
	$line3 = substr($address,strlen($line1)+strlen($line2),50);
	
	
    $w = array(190,0);
	$this->SetFont('Arial','B',10);
	$this->SetLineWidth(.3);
	$this->Cell($w[0],6,"Company Name:$company",'LRT');
	$this->SetFont('Arial','B',10);
	/* $this->Cell($w[1],6,"Invoice Number: $invoicefordisplay      Date: $invoicedate",'LRT'); */
	$this->Cell($w[1],6,"",'LRT');

	$this->Ln();
	$this->SetFont('Arial','',10);
	$this->Cell($w[0],6,"$line1",'L');
	$this->SetFont('Arial','B',10);
	$this->Cell($w[1],6,"",'LR');
	$this->SetFont('Arial','',10);
	
	$this->Ln();
	$this->Cell($w[0],6,"$line2",'LR');
	/* $this->Cell($w[1],6,"$pdfheaderline1",'LR'); */
	$this->SetFont('Arial','B',10);
	$this->Cell($w[1],6,"",'LR');
	
	$this->Ln();
	$this->SetFont('Arial','',10);
	$this->Cell($w[0],6,"$line3",'LR');
	/* $this->Cell($w[1],6,"$pdfheaderline2",'LR'); */
	$this->SetFont('Arial','B',10);
	$this->Cell($w[1],6,"",'LR');
	$this->Ln();

	$this->SetFont('Arial','B',10);
	$this->Cell($w[0],6,"Customer Details:",'LR');
	$this->SetFont('Arial','B',10);
	$this->Cell($w[1],6,"",'LR');
	$this->Ln();
	
	$this->SetFont('Arial','',10);
	$this->Cell($w[0],6,"Customer Name: $custname",'LR');
	$this->SetFont('Arial','',10);
	$this->Cell($w[1],6,"",'LR');
	$this->Ln(6);
	
	$this->SetFont('Arial','',10);
	$this->Cell($w[0],6,"Mobile:$custmobile",'LRB');
	$this->SetFont('Arial','',10);
	$this->Cell($w[1],6,"",'LRB');
	$this->Ln(6);
	
	/* $this->SetFont('Arial','',10);
	$this->Cell($w[0],6,"Email ID:$_SESSION[emailid]",'LR');
	$this->SetFont('Arial','',10);
	$this->Cell($w[1],6,"",'LRB');
	$this->Ln(6);
	
	$this->SetFont('Arial','',10);
	$this->Cell($w[0],6,"Inquiry Date:$_SESSION[cmdate]",'LRB');
	$this->SetFont('Arial','',10);
	$this->Cell($w[1],6,"",'LRB');
	$this->Ln(6); */
	
	$this->Ln(6);
	/* $this->Ln(15); */
	
    $this->Cell(array_sum($w),0,'','T');
	$this->Ln();
}
function ImprovedTable_5()
{ $w = array(140,20,30);

		 $amount = $_SESSION['subtotal'];
		 $_SESSION['cmpdetail5']="";
		 $cmpdetail5=$_SESSION['cmpdetail5'];
		// setlocale(LC_MONETARY, 'en_IN');
		//$pckamt = money_format('%!i', $amount);
		$pckamt = $amount;
		 $this->SetFont('Arial','',10);
		 $this->SetLineWidth(.3);
         $this->Cell($w[0],6,"$cmpdetail5",'LRTB');
		$this->Cell($w[1],6,"Sub-Total",'LRTB',0,'R');
		 $this->Cell($w[2],6,"$pckamt",'LRTB',0,'R');
         $this->Ln();
}
function ImprovedTable_5_1()
{ $w = array(120,40,30);
if(isset($_SESSION['cmservicecharge'])){
$amount = $_SESSION['cmservicecharge'];
}else{
	$amount = 0;
}
		 $_SESSION['cmpdetail5']="";
		$cmpdetail5=$_SESSION['cmpdetail5'];
		// setlocale(LC_MONETARY, 'en_IN');
		//$pckamt = money_format('%!i', $amount);
		$pckamt = $amount;
		 $this->SetFont('Arial','',10);
		 $this->SetLineWidth(.3);
         $this->Cell($w[0],6,"$cmpdetail5",'LRTB');
		$this->Cell($w[1],6,"Service Charge",'LRTB',0,'R');
		 $this->Cell($w[2],6,"$pckamt",'LRTB',0,'R');
         $this->Ln();
}

function ImprovedTable_6()
{ $w = array(138,29,23);
	
	$_SESSION['cmpstate']="";

	// if($_SESSION['cstate']==$_SESSION['cmpstate'])
	// {
		// $tclass1=$_SESSION['tclass'];
		// foreach($tclass1 as $key => $value) {
			// $key2=$key/2;
			// $value1=$value/2;
			// $this->SetFont('Arial','',10);
			// $this->SetLineWidth(.3);
			// $this->Cell($w[0],6,"",'L');
			// setlocale(LC_MONETARY, 'en_IN');
			// /* $value2 = money_format('%!i', $value1); */
			// $value2 = $value1;
			// $value2= number_format($value2,2,'.','');
			// $this->Cell($w[1],6,"CGST $key2%",'LRTB',0,'R');
			// $this->Cell($w[2],6,"$value2",'LRTB',0,'R');
			// $this->Ln();
			// $this->SetFont('Arial','',10);
			// $this->SetLineWidth(.3);
			// $this->Cell($w[0],6,"",'L');
			// $this->Cell($w[1],6,"SGST $key2%",'LRTB',0,'R');
			// $this->Cell($w[2],6,"$value2",'LRTB',0,'R');
			// $this->Ln();
		// }
	// }
	// else
	// {
		// $tclass1=$_SESSION['tclass'];
		// foreach($tclass1 as $key => $value) {
		// $this->SetFont('Arial','',10);
		// $this->SetLineWidth(.3);
		// $this->Cell($w[0],6,"",'L');
		// setlocale(LC_MONETARY, 'en_IN');
		// //$value1 = money_format('%!i', $value);
		// $value1 = $value;
		// $value1= number_format($value1,2,'.','');
		// $this->Cell($w[1],6,"IGST $key%",'LRTB',0,'R');
		// $this->Cell($w[2],6,"$value1",'LRTB',0,'R');
		// $this->Ln();
		// }
	// }
}

function ImprovedTable_7()
{ $w = array(120,40,30);
    if(isset($_SESSION['cmservicecharge'])){
$amount = $_SESSION['cmservicecharge'];
}else{
	$amount = 0;
}
		$invoicenetamount=$_SESSION['subtotal']+$amount;
		setlocale(LC_MONETARY, 'en_IN');
		//$gt1 = money_format('%!i', $invoicenetamount);
		$gt1 = "Rs.".number_format($invoicenetamount,2,'.','');
		//$qroundoffamount = money_format('%!i', $qroundoffamount);
		//$qroundoffamount = $qroundoffamount;
		$amountinwords =  convert_number_to_words($invoicenetamount);
		
		$this->SetFont('Arial','',9);
		$this->SetLineWidth(.3);
		$this->SetFont('Arial','B',10);
		$this->Cell($w[0],6,"",'LRB',0,'R');
		$this->Cell($w[1],6,"Total Amount",'LRTB',0,'R');
		$this->Cell($w[2],6,"$gt1",'LRTB',0,'R');
		$this->SetFont('Arial','',10);
		$this->Ln();
		
		$w = array(190,0);

		$this->SetFont('Arial','B',10);
		$this->SetLineWidth(.3);
        $this->Cell($w[0],6,"Amount In Words",'LRT');
		$this->Ln();
		$this->SetFont('Arial','',10);
		$this->Cell($w[0],4,"$amountinwords",'LR');
		$this->Ln();
		
		$this->SetFont('Arial','',10);
		$this->Cell($w[0],4,"",'LRB');
		$this->Ln();

		
		
		/* $this->SetFont('Arial','',10);
		$this->Cell($w[0],6,"",'LR');
		$this->Cell($w[1],6,"",'LR');
		$this->Ln(); */

 }
function ImprovedTable_1()
{
	 $this->Ln(30);
	$this->SetFont('Arial','B',15);
	$this->Cell(190,5,"Payment Receipt",0,0,'C');
    $this->Ln(6);

}
function ImprovedTable_8()
{

}

function ImprovedTable_10()
{
    $w = array(95,95);
	
		
}
}

function convert_number_to_words($myno,$part2=1)
{
   $number = $myno;
   $no = (int)($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '',
   '1' => 'One',
   '2' => 'Two',
    '3' => 'Three',
	'4' => 'Four',
	'5' => 'Five',
	'6' => 'Six',
    '7' => 'Seven',
	'8' => 'Eight',
	'9' => 'Nine',
    '10' => 'Ten',
	'11' => 'Eleven',
	'12' => 'Twelve',
    '13' => 'Thirteen',
	'14' => 'Fourteen',
    '15' => 'Fifteen',
	'16' => 'Sixteen',
	'17' => 'Seventeen',
    '18' => 'Eighteen',
	'19' =>'Nineteen',
	'20' => 'Twenty',
    '30' => 'Thirty',
	'40' => 'Forty',
	'50' => 'Fifty',
    '60' => 'Sixty',
	'70' => 'Seventy',
    '80' => 'Eighty',
	'90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " .
          $words[$point = $point % 10] : '';


	$tnumber = $myno;

	$whole = floor($tnumber);
	$fraction = ($tnumber - $whole)*100;

	if($fraction>0.00)
	{
		$pointvalue = convert_number_to_words( (int)$fraction,-7);

		return $result . "Rupees and ".$pointvalue."Paisa Only.";
	}
	else if($part2==-7)
	{
		return $result;
	}
	else
	{
		return $result."Rupees Only.";

	}
}

function convert_number_to_words2($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ' ';
    $negative    = 'negative ';
    $decimal     = ' and ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words2(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words2($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words2($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words2($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}


// Instanciation of inherited class
$pdf = new PDF();
$header = array();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->ImprovedTable_1();
$pdf->ImprovedTable_2();
$pdf->ImprovedTable_3();
$pdf->ImprovedTable_4();
$pdf->ImprovedTable_5();
$pdf->ImprovedTable_5_1();
$pdf->ImprovedTable_6();
$pdf->ImprovedTable_7();
$pdf->ImprovedTable_8();
$pdf->ImprovedTable_9();
$pdf->ImprovedTable_10();
$pdf->SetFont('Times','',12);
//$pdf->Output();
 //$cmid=$_SESSION['cmid'];
$pdf->Output('F',"../download/$cmid.pdf");

//return;
header("Location: ../paymentreceiptdetail.php?id=".$cmid);
?>