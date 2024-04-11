<?php
session_start();
include('connectp.php');



if(isset($_POST["customerid"]) && !empty($_POST["customerid"])){
    //Get all state data
	//echo "<option value='all' >All</option>";
	
	$customerid=$_POST["customerid"];
	
	$q1 = $db7->prepare("select uaddress,ucity from res_user_master where umid ='$customerid' " );
	 
		$q1->execute();
		if ($q1->rowCount() > 0)
		{
			
			$i=1;
			while($rt1 = $q1->fetch(PDO::FETCH_ASSOC))
			{
				$uaddress=$rt1['uaddress'];
				$ucity=$rt1['ucity'];
				$tt='';
				
				?>
					<textarea type="text"  name="customeraddress"  rows="1" class="form-control" readonly><?php echo $uaddress; ?></textarea>
				<?php 
				
				
			}
		}
		else{
			?>
			<textarea type="text"  name="customeraddress"  placeholder="Enter Address" rows="1" class="form-control"></textarea>
			<?php
		}
		
}
?>
