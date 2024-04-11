<?php
 
 // mobile photo
 include("../connect.php");
 
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate1= date('Y-m-d');
 
 if($_SERVER['REQUEST_METHOD']=='POST')
 {
 
	$par1 = $_POST['p1'];	//ummobile
	$par2 = $_POST['p2'];	//umpassword
	$par3 = $_POST['p3'];	//status
	$par4 = $_POST['p4'];	//date
	
	
	$eve_category3 = "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re_category3 = mysqli_query($conn, $eve_category3);
	$umid=0;
	while($rt_category3 = mysqli_fetch_assoc($re_category3))
	{
		//$umid=$rt_category3['umid'];
	}
	
	
	$cmphoto1="";
	 if(empty($_FILES['cmphoto']['name']) == false  )
	 {
		$simplephoto11=$_FILES['cmphoto']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$cmphoto1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "images";
		
		move_uploaded_file( $_FILES['cmphoto']['tmp_name'], $path ."/". $cmphoto1);
	  }
	
	
		
			$eve1 = "INSERT INTO res_complain_master (cmphoto,cstatus,cmdate) VALUES('$cmphoto1','$par3','$par4')";
			if ($conn->query($eve1) === TRUE) 
			{
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
			
	   echo stripslashes(json_encode($posts));
 }
 
 ?>