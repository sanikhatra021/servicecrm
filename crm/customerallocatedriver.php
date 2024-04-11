<?php
session_start();
include "connect.php";
		$samid=$_SESSION['samid'];
		$id = intval($_REQUEST['id']);
?>

		<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<input type="hidden" name="cmid" value="<?php echo $id; ?>">
		    <tr>
			    <th>Select Service Engineer</th>
				<td>
					<select class="form-control" name="umid">
						<option value='0'>Select Service Engineer</option>
						<?php
						$evedriver = "select umid,uname from res_user_master where utype='serviceengineer' and samid=$samid";
						$redriver = mysqli_query($conn, $evedriver);
						$uname="";
						
						while($rtdriver = mysqli_fetch_assoc($redriver))
						{
							$umid=$rtdriver['umid'];
							$uname=$rtdriver['uname'];
							
							
							echo "<option value='$umid'>$uname</option>";
						}
					?>
					</select>
				</td>
			</tr>
		</table>

		</div>
