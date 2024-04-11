<?php
if(!isset($_SESSION)) { 
  session_start(); 
} 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	
	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('Y-m-d');
	$cdphoto1="";
	 if(empty($_FILES['cdphoto']['name']) == false  )
	{
		$simplephoto11=$_FILES['cdphoto']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$cdphoto1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='PNG' || $ext=='JPG' || $ext=='JPEG' || $ext=='GIF')
		{
		  move_uploaded_file( $_FILES['cdphoto']['tmp_name'], $path ."/". $cdphoto1);
		  $flag=1;
		}
		else 
		{
		  $_SESSION['msg1'] = "Only Upload Image";
		  header('Location: complain.php');
		  return;
		  $flag=0;
		}
	}

	
	$samid=$_SESSION['samid'];
	$cmid=$_POST['cmid'];
	$custid=0;
	$serviceengineerid=$_POST['serviceengineerid'];
	$eve1="select fcmtoken from res_user_master where umid=$serviceengineerid";
	$re1 = mysqli_query($conn, $eve1);
	while($rt1 = mysqli_fetch_assoc($re1))
	{
		$token=$rt1['fcmtoken'];
	}
		
			
	 $eve1 = "INSERT INTO res_complain_detail (cmid,custid,serviceengineerid,assigndate,cdstatus,cdphoto,cdaddedon,cdupdatedon,samid) VALUES('$cmid','$custid','$serviceengineerid','$mdate2','In Process','$cdphoto1','$mdate1','$mdate1','$samid')";	
	if ($conn->query($eve1) === TRUE)
	{
		$last_id = $conn->insert_id;
		$_SESSION['msg'] = "Record has been added successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	
	$title='Complain Allocated';
	$message='Please check the details Complain.';
	 
	  $result=push_notification_android($token,$title,$message);
	  
header('Location: complaindetail.php?id='.$cmid);

	function push_notification_android($token,$title,$message){

    //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';

    /*api_key available in:
    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    
	
	$api_key = 'AAAAv2KDXjw:APA91bGlIeTu2Ars2yQmO1eocKcn1yz6gUw5xej3fkJhVK9bIS6Qi8d3EctCikhO1p30k5cUDdkTniPKuXJxgJrClgc13Gf94UbAqMvEXiHPLeFYK_ic6mOXBJBwg-c3fIt--w_4VpUg';
	
	 
                
    $fields = array (
    'registration_ids' => array
	(
		$token
    ),
	  'data' => array 
	  (
		'title' => $title,
		'imgurl' => "",
		'body' => $message,
				
       ),
		'priority' => 'high'
		
    );

    //header includes Content type and api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
    );
                
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
	
	
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
	//echo $result;
    curl_close($ch);
    return $result;
}
	

?>