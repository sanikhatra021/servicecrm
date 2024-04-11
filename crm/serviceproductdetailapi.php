<?php
session_start();
include('connectp.php');
$samid=$_SESSION['samid'];
$servicecontractid=0;
$tt="";
$data="";
	if(isset($_POST["servicecontractid"])){
	
	$servicecontractid=$_POST["servicecontractid"];
	$tt=" and servicemid ='$servicecontractid' and servicestatus<>'Renewed' ";
	}else{
			$customerid=$_POST["customerid"];
		$tt=" and custid ='$customerid' and servicestatus<>'Renewed'";
	}
	//echo  $aa="select sremarks from res_service_master where samid='$samid' $tt";
	
	$q1 = $db7->prepare("select sremarks from res_service_master where samid='$samid' $tt" );
	 
		$q1->execute();
		if ($q1->rowCount() > 0)
		{
			
			$i=1;
			while($rt1 = $q1->fetch(PDO::FETCH_ASSOC))
			{
				$data=$rt1['sremarks'];
				
				
				
				
				
				
			}
		}
		else
		{
			
			
		}
echo $data;
return;
?>
