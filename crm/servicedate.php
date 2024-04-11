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
			  //$cmdate=implode('-', array_reverse(explode('-', $rt['cmdate'])));
			  $cmdate=$rt['cmdate'];
			  $cmdatenew=date("d-m-Y",strtotime($rt['cmdate']));
			
		}
		
?>

		<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<input type="hidden" name="cmid" value="<?php echo $id; ?>">
		    <tr>
			    <th>Select PPM change date</th>
				<td>
					  
							 
							 
								<div class="col-md-8">
											<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" id="datepicker1" name="edate"  value="<?php echo $cmdatenew; ?>">
									<!-- <input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="cmdate" value="<?php echo $cmdate;?>" required>   --->
								</div>
						
				</td>
			</tr>
			
		</table>

		</div>
		 <script>
		 $( function()
		 {
			 $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
			 $( "#datepicker1" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
			 $( "#mask_date2" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
		 } );
	 </script>