<?php
session_start();
include('connectp.php');
include('connect.php');
date_default_timezone_set("Asia/Kolkata");
	$datenew= date('Y-m-d');
$samid=$_SESSION['samid'];

if(isset($_POST["customerid"]) && !empty($_POST["customerid"])){
    //Get all state data
	//echo "<option value='all' >All</option>";
						echo "<option value='0'>select</option>";

	$customerid=$_POST["customerid"];
	$s="selected";
	
	$q1 = $db7->prepare("select * from res_service_master,res_product_master where res_service_master.pmid=res_product_master.pmid and res_service_master.custid='$customerid'  and servicestatus<>'Renewed' and res_service_master.samid='$samid'" );
	 
		$q1->execute();
		if ($q1->rowCount() > 0)
		{

			$i=1;
			while($rt1 = $q1->fetch(PDO::FETCH_ASSOC))
			{
				$servicemid=$rt1['servicemid'];
				$senofordisplay=$rt1['senofordisplay'];
				$pmname=$rt1['pmname'];
				$servicetype=$rt1['servicetype'];
				$servicestatus=$rt1['servicestatus'];
				
				
				echo "<option value='$servicemid' $s >$pmname-$servicetype($senofordisplay-$servicestatus)</option>";
											
				$s="";
			}
		}

		
}

?>
