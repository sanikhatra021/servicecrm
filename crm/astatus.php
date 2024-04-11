	<?php
	session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include "connect.php";



		$id = intval($_REQUEST['id']);
		$eve="select cstatus from res_complain_master where cmid=$id";
		$re = mysqli_query($conn, $eve);
		while($rt = mysqli_fetch_assoc($re))
		{
			$cstatus=$rt['cstatus'];
			
		}
		
?>

		<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<input type="hidden" name="cmid" value="<?php echo $id; ?>">
		    <tr>
			    <th>Select Status</th>
				<td>
					<select class="form-control" name="cstatus">

						<option <?php if($cstatus=='Pending'){ echo'selected';}?> value="Pending">Pending</option>
						<option <?php if($cstatus=='In Process'){ echo'selected';}?> value="In Process">In Process</option>
						<option <?php if($cstatus=='Completed'){ echo'selected';}?> value="Completed">Completed</option>
						<option <?php if($cstatus=='Cancel'){ echo'selected';}?> value="Cancel">Cancel</option>
						<option <?php if($cstatus=='Pending Payment'){ echo'selected';}?> value="Pending Payment">Pending Payment</option>
						
						<option <?php if($cstatus=='Complain Verified'){ echo'selected';}?> value="Complain Verified">Complain Verified</option>
					</select>
				</td>
			</tr>
			
		</table>

		</div>
