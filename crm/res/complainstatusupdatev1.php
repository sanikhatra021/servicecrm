<?php

 // mobile photo
 include("../connect.php");
 
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate1= date('Y-m-d');
	
	
	$par1 = $_GET['p1'];	//ummobile
	$par2 = $_GET['p2'];	//umpassword
	$par3 = $_GET['p3'];	//seid
	$par4 = $_GET['p4'];	//custid
	$par5 = 0;	//cmid
	$par6 =0;	//remark
	$par7 = $_GET['p7'];	//status
	$par8 = $_GET['p8'];	//charge
	$par9 = $_GET['p9'];	//cdid
	$par10 = $_GET['p10'];	//solution
	$par11 = $_GET['p11'];	//cdmachinemodel
	$par12 = $_GET['p12'];	//cdmachinesrno
	$par13 = $_GET['p13'];	//cdmachinelocation
	$par14 = $_GET['p14'];	//cdworkdone
	$par15 = $_GET['p15'];	//cdpendingwok
	$par16 = $_GET['p16'];	//cdsign
	$par17 = $_GET['p17'];	//cdcustremarks
	$par18 = $_GET['p18'];	// paystatus 
	$par19 = $_GET['p19'];	//paymentmode
	$par20 = $_GET['p20'];	//payamount
	$par21 = $_GET['p21'];	//paymentremark
	
	
	 if($_SERVER['REQUEST_METHOD']=='POST')
	 {
		$cdphoto1="";
		 if(empty($_FILES['image']['name']) == false  )
		 {
			$simplephoto11=$_FILES['image']['name'];
			$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
			$fileexplode1 = explode(".",$simplephoto11);
			$fileend1 = end($fileexplode1);

			$cdphoto1= date("YmdHis").rand(100,999).".".$fileend1;
			$path = "../images";
			
			move_uploaded_file( $_FILES['image']['tmp_name'], $path ."/". $cdphoto1);
		  }
		
		$cdsign1="";
		 if(empty($_FILES['sign']['name']) == false  )
		 {
			$simplephoto112=$_FILES['sign']['name'];
			$ext = pathinfo($simplephoto112, PATHINFO_EXTENSION);
			$fileexplode12 = explode(".",$simplephoto112);
			$fileend12 = end($fileexplode12);

			$cdsign1= date("YmdHis").rand(100,999).".".$fileend12;
			$path1 = "../images";
			
			move_uploaded_file( $_FILES['sign']['tmp_name'], $path1 ."/". $cdsign1);
		  }
		
	 }
	
	 $eve_category3 = "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re_category3 = mysqli_query($conn, $eve_category3);
	$umid=0;
	if(mysqli_num_rows($re_category3) > 0)
    {
		while($rt_category3 = mysqli_fetch_assoc($re_category3))
		{
			$samid = $rt_category3['samid'];
			/* $serviceengineerid=$rt_category3['serviceengineerid'];
			$custid=$rt_category3['custid']; */
		}
	
		   /* $eve1 = "update res_complain_detail set serviceengineerid='$par3',custid ='$par4',cdphoto='$cdphoto1',cdstatus='$par7',assigndate='$mdate1',cdupdatedon='$mdate',cdservicecharge='$par8',cdmachinemodel='$par11',cdmachinesrno='$par12',cdmachinelocation='$par13',cdworkdone='$par14',cdpendingwok='$par15',cdsign='$cdsign1',cdcustremarks='$par17' where cmid='$par9'"; */
		 
		  $eve1 = "INSERT INTO res_complain_detail (cmid,samid,custid,serviceengineerid,cdstatus,cdservicecharge,cdremark,assigndate,cdphoto,cdaddedon,cdmachinemodel,cdmachinesrno,cdmachinelocation,cdworkdone,cdpendingwok,cdsign,cdcustremarks) VALUES('$par9','$samid','$par4','$par3','$par7','$par8','$par10','$mdate1','$cdphoto1','$mdate','$par11','$par12','$par13','$par14','$par15','$cdsign1','$par17')";
		  
		if ($conn->query($eve1) === TRUE) 
		{
			
			/*  $eve2 = "update res_complain_master set cstatus='$par7',cmstatusudate='$mdate1',cmupdatedon='$mdate',cmupdatedby='$par3',cmsolution='$par10',cmservicecharge='$par8' where cmid='$par9'"; */
			
			 $eve2 = "update res_complain_master set cstatus='$par7',cmstatusudate='$mdate1',cmupdatedon='$mdate',cmupdatedby='$par3',cmsolution='$par10',cmservicecharge='$par8',cmpaystatus='$par18',cmpaymentmode='$par19',cmpayamount='$par20',cmpayremark='$par21' where cmid='$par9'";
			 if ($conn->query($eve2) === TRUE) 
			{
			} 
			 
			$result="1";

			$posts[] = array('p1'=> $result,'p2'=> "Successful");

			$response['posts'] = $posts;					
		}
		else
		{
			$result="0";
			
			$posts[] = array('p1'=> $result,'p2'=> "Failed");

			$response['posts'] = $posts;	
	   }
	}
	else
	{
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "Failed");

		$response['posts'] = $posts;	
   }		
	  echo stripslashes(json_encode( array('item' => $posts)));
 
 
 ?>