<?php
 
 // mobile photo
 include("../connect.php");
 
 
 
 if($_SERVER['REQUEST_METHOD']=='POST')
 {
 
	$ummobile = $_POST['p1'];
	/* $umphoto = $_POST['umphoto'];
	$bmlogo = $_POST['bmlogo']; */
	
	
	$tt1="";
	if(empty($_FILES['umphoto']['name']) == false  )
	{
		$simplephoto11=$_FILES['umphoto']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$umphoto1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "../images";
		move_uploaded_file( $_FILES['umphoto']['tmp_name'], $path ."/". $umphoto1);
		$tt1 = ",umphoto='$umphoto1'";		
	}	
	
	$tt2="";
	if(empty($_FILES['bmlogo']['name']) == false  )
	{
		$simplephoto11=$_FILES['bmlogo']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$bmlogo1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "../images";
		
			move_uploaded_file( $_FILES['bmlogo']['tmp_name'], $path ."/". $bmlogo1);
		  $tt2 = ",bmlogo='$bmlogo1'";
	}	
		$eve2 = "update res_user_master set ummobile='$ummobile' $tt1 $tt2 where ummobile='$ummobile'";
		 if ($conn->query($eve2) === TRUE) 
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