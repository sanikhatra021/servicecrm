<?php
if (session_status() === PHP_SESSION_NONE) {
    // Start the session
    session_start();
}


function generateNumber2($prefix,$cmno,$cyear) {
  
    $number = str_pad("$cmno", 6, "0", STR_PAD_LEFT);
    
    return $prefix . "/" .$cyear. "/" . $number;
}


function getFinancialYear2($date) {
    $year = date('y', strtotime($date));
    $month = date('m', strtotime($date));
    
    if ($month >= 4) {
        $financialYear = $year . '-' . ($year + 1);
    } else {
        $financialYear = ($year - 1) . '-' . $year;
    }
    
    return $financialYear;
}

// Example usage
function generatecomplainno(){
	$samid=$_SESSION['samid'];
	$umid=$_SESSION['umid'];
	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	//$mdate1= date('Y-m-d h:i:sa');
	$mdate2= date('Y-m-d');
	$mdate= date('Y-m-d');
	
$eve11 = "select saprefix from res_superadmin_master where samid=$samid";
	$re11 = mysqli_query($conn, $eve11);
	$saprefix="";
	while($rt11 = mysqli_fetch_assoc($re11))
	{
		$saprefix=$rt11['saprefix'];
	}
		
	

$cyear = getFinancialYear2($mdate);

	$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where cyear='$cyear' and  samid=$samid";
	$remaxq = mysqli_query($conn, $evemaxq);
	while($rtmaxq = mysqli_fetch_assoc($remaxq))
	{
		$cmno=$rtmaxq['maxcmno'];
	}
	$cmno1=$cmno+1;
	//$saprefix=date("ymd");
	//$cmnowithprefix=$saprefix.$cmno1;
	$cmnowithprefix = generateNumber2($saprefix,$cmno1,$cyear);
	
	return $cmnowithprefix;
}

?>
