<?php

 // mobile photo
 include("../connect.php");
 
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate1= date('Y-m-d');
	
	
	$par1 = $_GET['p1'];	//ummobile
	$par2 = $_GET['p2'];	//umpassword
	$par3 = $_GET['p3'];	//cmid
	$par4 = $_GET['p4'];	//itemtotal
	$par5 = $_GET['p5'];	//servicvecharge
	$par6 = $_GET['p6'];	//finaltotal
	
	$par7 = $_GET['p7'];	//paidamount
	$par8 = $_GET['p8'];	//paymenttype
	$par9 = $_GET['p9'];	//paymentremarks
	$pendamt = $par6-$par7;
	
	
	
	 $eve_category3 = "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re_category3 = mysqli_query($conn, $eve_category3);
	$umid=0;
	if(mysqli_num_rows($re_category3) > 0)
    {
		while($rt_category3 = mysqli_fetch_assoc($re_category3))
		{
			$samid = $rt_category3['samid'];
			$umid = $rt_category3['umid'];
			
		}
	
		  
		
			
			
			$tt="";
			if($par7 >= $par6)
			{
				$cpstatus = "Paid";
			}else{
				$cpstatus = "Partially paid";
			}
				$tt=",cmpaystatus='$cpstatus',cmpaymentmode = '$par8',cmpayamount = cmpayamount+$par7,cmpayremark = '$par9',cmpendingamount=cmnetamount-$par7";
				$eve11 = "insert into res_complainpayment_detail (cmid,cmnetamount,cmpayamount,cmpaymentmode,cmpayremark,cmpendingamount,samid,cmpaymentdate) VALUES($par3,'$par6','$par7','$par8','$par9','$pendamt','$samid','$mdate1')";		
				$re11 = mysqli_query($conn, $eve11);
							
					
					
			 $eve2 = "update res_complain_master set cmupdatedon='$mdate',cmupdatedby='$umid',cmservicecharge='$par5' $tt where cmid =$par3";
			 if ($conn->query($eve2) === TRUE) 
			{
				
			} 
			 
			$result="1";

			$posts[] = array('p1'=> $result,'p2'=> "Success");

			$response['posts'] = $posts;	
// mail whatsapp process start..................


	
		
	}
	else
	{
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "Failed");

		$response['posts'] = $posts;	
   }		
	  echo stripslashes(json_encode( array('item' => $posts)));
 
 
 ?>