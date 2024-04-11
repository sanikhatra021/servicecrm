<?php  
	include("../connect.php");
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];


	$response = array();
	$posts = array();
	
	$ufullname="";
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
				
	  $eve1 =  "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re1 = mysqli_query($conn,$eve1);
															
	if(mysqli_num_rows($re1) > 0)
	{
		while($rt1 = mysqli_fetch_assoc($re1))
		{
			$samid=$rt1['samid'];

		}
	
		 $eve2 =  "SELECT * FROM  res_amc_master where samid = $samid";
		
		 $re2 = mysqli_query($conn,$eve2);
		if(mysqli_num_rows($re2) > 0)
		{
			
			while($rt2 = mysqli_fetch_assoc($re2))
			{
				$result="1";

				$custsdate=implode('-', array_reverse(explode('-', $rt2['custsdate'])));
				$custedate=implode('-', array_reverse(explode('-', $rt2['custedate'])));
				
				$custid=$rt2['umid'];
				$pmid=$rt2['pmid'];
				
				 $eve8 =  "SELECT * FROM  res_product_master where pmid = $pmid";
				  $re8 = mysqli_query($conn,$eve8);
						while($rt5 = mysqli_fetch_assoc($re8))
						{
							$pmname = $rt5['pmname'];
						}
				
				 $eve112 = "select * from res_user_master where utype='customer' and umid=$custid and samid=$samid";
				$re112 = mysqli_query($conn, $eve112);
				while($rt112 = mysqli_fetch_assoc($re112))
				{
					$umid=$rt112['umid'];
					$uname=$rt112['uname'];
			
				}
			
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $custsdate,'p3'=> $custedate,'p4'=> $umid,'p5'=> $uname,'p6'=> $pmname);
			}
			$response['posts'] = $posts;
			echo stripslashes(json_encode($posts));
		}
		else
		{
			$result="0";		
		$posts[] = array('p1'=> $result,'p2'=> "No Data Found");	
		echo stripslashes(json_encode($posts));
			
		}
	}
   else
   {
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "No Data Found");
	
		echo stripslashes(json_encode($posts));
   }
	mysqli_close($conn);
?>
