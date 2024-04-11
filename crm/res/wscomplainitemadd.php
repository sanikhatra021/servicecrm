<?php  

error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	
	$par1=$_GET['p1'];	//mobile
	$par2=$_GET['p2'];	//university
	$par3=$_GET['p3'];	//cmid
	$par4=$_GET['p4'];	//pmid
	$par5=$_GET['p5'];	//QTY
	$par6=$_GET['p6'];	//rate
	
	
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d');
	
	$response = array();
	$posts = array();
	$result ="0";
	$msg = "";
	
	$eve_category =  "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re_category = mysqli_query($conn,$eve_category);
	if(mysqli_num_rows($re_category) > 0)
    {
		while($rt_category = mysqli_fetch_assoc($re_category))
		{
				$cmid=$rt_category['cmid'];
				$pmid=$rt_category['pmid'];
		}	
			
		   	  $eve1 = "insert into res_complainitem_detail (cmid,pmid,cidqty,cidrate) values('$par3','$par4','$par5','$par6')";
			
			if ($conn->query($eve1) === TRUE) 
			{
				 $sql11 = "select cmservicecharge,cmtotalamount from res_complain_master where cmid=$par3";
				 $re_category1 = mysqli_query($conn,$sql11);
				while($rt_category1 = mysqli_fetch_assoc($re_category1))
				{
						 $cmservicecharge=$rt_category1['cmservicecharge'];
						$cmtotalamount=$rt_category1['cmtotalamount'];
						
				}
				$totalamount =$cmtotalamount + ($par4 * $par6); 
				$totalnetamount = $totalamount+ $cmservicecharge;
				$sql12 ="update res_complain_master set cmtotalamount='$totalamount',cmnetamount = '$totalnetamount' where cmid=$par3 ";
				$re_category3 = mysqli_query($conn,$sql12);
				$msg = "Success";
				$result="1"	;
				$posts[] = array('p1'=> $result,'p2'=> $msg);
	
		//$response['posts'] = $posts;
		echo stripslashes(json_encode($posts));
			}
			else
		   {
				
				$result="0";
				$msg = "Failure";	
				$posts[] = array('p1'=> $result,'p2'=> $msg);
				echo stripslashes(json_encode($posts));
		   }
		
	}
	else
    {
	   $result="0";
	   $msg = "Invalid mobile OR password";
	   
		$myObj2->status = $result;
		$myObj2->message = $msg;
		echo stripslashes(json_encode(array($myObj2)));	
	
    }
   
    $response['posts'] = $posts;
	mysqli_close($conn);
	
?>