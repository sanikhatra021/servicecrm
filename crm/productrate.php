<?php
	session_start();
	include("connect.php");

	$par3 = $_GET['skills2'];
    //$par3 = 58;

	// $query_mobile = "select skuname,skumid from res_sku_master where itemid='$par3' order by imitemname asc";
	$query_mobile = "select prate from res_product_master where pmid='$par3'";
	$result_mobile = mysqli_query($conn, $query_mobile);
	
				

	if(mysqli_num_rows($result_mobile) > 0)
	{
		while($rtcc = mysqli_fetch_assoc($result_mobile))
		{
			$unitname = $rtcc['prate'];
			
			
		}
	}
	else{
		$unitname='';
		
	}
	
	echo trim($unitname);
	
?>		