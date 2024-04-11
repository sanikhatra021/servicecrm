<?php  
error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	$par3=$_GET['p3'];


	$response = array();
	$posts = array();
	
	$ufullname="";
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$myObj2 = new stdClass();
    $eve1 = "SELECT * FROM res_user_master where  umobile='$par1' and upassword='$par2'";
	$re1 = mysqli_query($conn,$eve1);
																	
		if(mysqli_num_rows($re1) > 0)
	{
		//$result="1";
		$evenewpass = "update res_user_master set upassword='$par3' where umobile='$par1'";
		$renewpass = mysqli_query($conn, $evenewpass);
		$msg = "Password Updated";
		$myObj2->status = "1";
		$myObj2->message = $msg;   

	echo stripslashes(json_encode( array( $myObj2)));

	}
   else
   {
		$result="0";
		$msg = "Password Not Updated";	
		$myObj2->status = $result;
		$myObj2->message = $msg;
	echo stripslashes(json_encode( array( $myObj2)));
   }
	mysqli_close($conn);
?>
