<?php
session_start();

	date_default_timezone_set("Asia/Kolkata");
	$hh = date('H');


	include("connectp.php");
	include("connect.php");

  	$samid=$_POST['samid'];
  	$par1=$_POST['cmobile'];
	$par2= $_POST['cpassword'];
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d H:i:s');

	//$eve = "select * from res_user_master where ualmobile='$par1' and upass='$par2' and ustatus='Approved'";
	$q = $db7->prepare("select * from res_user_master where samid=$samid and utype='customer' and upassword=:p2 and (umobile=:p1 or emailid=:p1)");
	$q->bindValue(':p1', "$par1");
	$q->bindValue(':p2',  "$par2");
	$q->execute();



	if ($q->rowCount() > 0)
	{
		$i=0;
		while($i<=$q->rowCount())
		{
			$rt = $q->fetch(PDO::FETCH_ASSOC);
			
				$_SESSION['sminderweb'] = "yes";
				$_SESSION['customerid'] = $rt['umid'];
				$_SESSION['sadminid'] = $rt['samid'];
				$_SESSION['cname'] = $rt['uname'];
				//$_SESSION['utype'] = $rt['utype'];
				$_SESSION['cmobile'] = $rt['umobile'];
				$_SESSION['cemail'] = $rt['uemail'];
			
				$_SESSION['sloginmsg'] = "Login Success";
				header("Location: myaccount.php");
				return;
			//echo $row_id;
			$i++;
		}
	}
	else
	{
	   $_SESSION['sloginmsg1'] = "Invalid Mobile or Password";
		header('Location: login.php');
	}

?>
