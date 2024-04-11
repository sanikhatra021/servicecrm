<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include "connect.php";



		$id = intval($_REQUEST['id']);
		$eve="select * from res_complain_master where cmid=$id";
		$re = mysqli_query($conn, $eve);
		while($rt = mysqli_fetch_assoc($re))
		{
			$cmdate=implode('-', array_reverse(explode('-', $rt_deal['cmdate'])));
			
		}
		
?>

		<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<input type="hidden" name="rfmid" value="<?php echo $id; ?>">
		    <tr>
			    <th>Select Status</th>
				<td>
					  
							<label class="col-md-3 control-label">Select Date<span class="required"> * </span></label>
							<div class="col-md-5">
								<input type="date" name="sdate" value="" class="form-control" placeholder="Select Date" required >
							 </div>
						
				</td>
			</tr>
			
		</table>

		</div>