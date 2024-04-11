<?php
session_start();
include('connectp.php');
include('connect.php');

$samid=$_SESSION['samid'];

if(isset($_POST["customerid"]) && !empty($_POST["customerid"])){
    //Get all state data
	//echo "<option value='all' >All</option>";
	
	$customerid=$_POST["customerid"];
	
	echo "<option value='0'>Select Service Engineer</option>";
	$q1 = $db7->prepare("select * from res_user_master where utype='serviceengineer' and samid='$samid'" );
	 
		$q1->execute();
		if ($q1->rowCount() > 0)
		{
			
			$i=1;
			while($rt1 = $q1->fetch(PDO::FETCH_ASSOC))
			{
				$uaddress=$rt1['umid'];
				$uname1=urldecode($rt1['uname']);
				
				$eve_category1 = "select * from res_user_master where samid='$samid' and umid='$customerid'";
										$re_category1 = mysqli_query($conn, $eve_category1);
										while($rt_category1 = mysqli_fetch_assoc($re_category1))
										{

											$umid1=$rt_category1['udefaultserviceengineer'];
											
											
										}
										if($umid1==$uaddress){
											echo "<option value='$uaddress' selected>$uname1</option>";
											}
											else{
												echo "<option value='$uaddress'>$uname1</option>";
											}
			
			}
		}

		
}

?>
