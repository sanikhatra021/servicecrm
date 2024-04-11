<?php
session_start();

	date_default_timezone_set("Asia/Kolkata");
	$hh = date('H');


	include("connectp.php");
	include("connect.php");

  	$samid=$_POST['samid'];
  	$saurl=$_POST['saurl'];
  	$par1=$_POST['username'];
	$par2=$_POST['password'];
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d H:i:s');
	$cdate= date('Y-m-d');

	
	
 	 $update = "update  res_superadmin_master set sacurrentplanstatus='Expired' where sacurrentplanstatus='Active' and saplanexpdate<'$cdate'";
   
	  $re = mysqli_query($conn, $update);
	  
	if(isset($_POST['g-recaptcha-response']))
	{	
		$response = $_POST["g-recaptcha-response"];
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array(
			'secret' => '6Lck11seAAAAADh1Z14juNPSx6klq1Pq9fxLsGUc',
			'response' => $_POST["g-recaptcha-response"]
		);
		$options = array(
			'http' => array (
				'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$verify = file_get_contents($url, false, $context);
		$captcha_success=json_decode($verify);

	if ($captcha_success->success==false)
	{
		$_SESSION['loginmsg1']="The reCAPTCHA wasn't entered correctly.";
		header("Location: $saurl");
		exit();	 
	} 
	else if ($captcha_success->success==true)
	{ /* echo 2;
		echo $q="select * from res_user_master where umobile='$par1' and upassword='$par2' and samid=$samid and utype in('admin')";
		return; */
 		$q = $db7->prepare("select * from res_user_master where umobile=:p1 and upassword=:p2 and samid=$samid and utype in('admin')");
		$q->bindValue(':p1', "$par1");
		$q->bindValue(':p2',  "$par2");
		$q->execute();
		if ($q->rowCount() > 0)
		{
		while($rt = $q->fetch(PDO::FETCH_ASSOC))
			{
			    $sacurrentplanstatus="Expired";
				$eve1 = "select * from res_superadmin_master where  samid=$samid";

				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$sacurrentplanstatus=$rt1['sacurrentplanstatus'];
				}
				if($sacurrentplanstatus=='Active')
				{ 
					$_SESSION['complainweb'] = "yes";
					$_SESSION['currentumid'] = $rt['umid'];
					$_SESSION['currentuname'] = $rt['uname'];
					$_SESSION['currentumobile'] = $rt['umobile'];
					$_SESSION['currentutype'] = $rt['utype'];
					$_SESSION['currentsamid'] = $rt['samid'];
					
					$_SESSION['loginmsg'] = "Login Success";
					header("Location: scomplainadd.php");
					return;
					$i++;
				 }else{
					/* echo 3; */
					 $_SESSION['loginmsg1'] = "Please Contact Admin";
					header("Location: $saurl");
				} 
			}
		}
		else
		{/* echo 4; */
			$_SESSION['loginmsg1'] = "Invalid Mobile or Password";
			header("Location: $saurl");
		}
	}
	} 
	
?>
