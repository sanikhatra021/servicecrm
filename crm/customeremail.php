<?php
session_start();
include('connectp.php');



if(isset($_POST["customerid"]) && !empty($_POST["customerid"])){
    //Get all state data
	//echo "<option value='all' >All</option>";
	
	$customerid=$_POST["customerid"];
	
	$q1 = $db7->prepare("select emailid from res_user_master where umid ='$customerid' " );
	 
		$q1->execute();
		if ($q1->rowCount() > 0)
		{
			
			$i=1;
			while($rt1 = $q1->fetch(PDO::FETCH_ASSOC))
			{
				$uaddress=$rt1['emailid'];
			
				$tt='';
				
				?>
					<input type="text"  name="uemail"  rows="2" class="form-control" value="<?php echo $uaddress; ?>" readonly>
				<?php 
				
				
			}
		}
		else
		{
			?>
					<input type="text"  name="uemail"  rows="2" placeholder="Enter Customer Email" class="form-control" value="">
				<?php 
		}
		
}
?>
