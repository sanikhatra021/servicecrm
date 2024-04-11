<?php 
$custsdate='2021-10-26';
$custedate='2021-10-31';
$amcnoofseat=5;
$cdate= $custsdate;
$startDate = new DateTime($custsdate);
$endDate = new DateTime($custedate);

	$difference = $endDate->diff($startDate);
	echo "days: ".$days=$difference->format("%a");
	echo "<br>daydiff: ".$daydiff=(int)$days / $amcnoofseat;
	
	
	$i=0;
	while ($i < $amcnoofseat)
	{
		
		
		echo "<br>". $cdate=date('Y-m-d', strtotime($cdate. ' + '.$daydiff.' days'));
		
		$i++;
	}
	
	
?>