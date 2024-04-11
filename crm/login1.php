<?php
session_start();

	date_default_timezone_set("Asia/Kolkata");
	$hh = date('H');


	include("connectp.php");
	include("connect.php");

   	$par1=$_POST['username'];
	$par2=$_POST['password']; 
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d H:i:s');
	
	
	if(isset($_POST['submit']))
	{	
		$response = $_POST["g-recaptcha-response"];
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array(
			'secret' => '6LcxJ0EdAAAAANAeBIjzU7dgxyFPosr1kyiqQrcU',
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
		$_SESSION['msg1']="The reCAPTCHA wasn't entered correctly.";
		header('Location: index.php');
		exit();	 
	}
	else if ($captcha_success->success==true)
	{
		//echo $q="select * from res_admin_master where ausername='$par1' and apassword='$par2' and astatus='Active'";
	 $q = $db7->prepare("select * from res_admin_master where ausername=:p1 and apassword=:p2 and astatus='Active'");
	
		$q->bindValue(':p1', "$par1");
		$q->bindValue(':p2',  "$par2");
		$q->execute();



		 if ($q->rowCount() > 0)
		{
			$i=0;
			while($rt = $q->fetch(PDO::FETCH_ASSOC))
			{
			
				 $_SESSION['lacomplainsuperadmin'] = "yes";
				$_SESSION['amid'] = $rt['amid'];
				$_SESSION['ausername'] = $rt['ausername'];
				$_SESSION['astatus'] = $rt['astatus'];
				$_SESSION['lasuperadmintype'] = 'superadmin';
				
				 header("Location: dashboard.php");
				 

			}
		}
		else
		{
			

		   $_SESSION['msg1'] = "Username or Password";
			header('Location: index.php');
		}
	}
	} 
	
?>
