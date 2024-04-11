<?php
session_start();
include "connect.php";

	 
	$samid=$_SESSION['businessid'];
	
	$customerid=$_SESSION['customerid'];
	
	$id = intval($_REQUEST['id']);
	$eve="select pmname,pimage,prate from res_product_master where pmid=$id";
	$re = mysqli_query($conn, $eve);
	while($rt = mysqli_fetch_assoc($re))
	{
		$pmname=$rt['pmname'];
		$pimage=$rt['pimage'];
		$prate=$rt['prate'];
	}

?>
	
		<div class="row">
			<input type="hidden" name="pmid" value="<?php echo $id; ?>">
			<input type="hidden" name="samid" value="<?php echo $samid; ?>">
			<input type="hidden" name="customerid" value="<?php echo $customerid; ?>">
			
		     <div class="col-lg-5 col-md-6 col-12 col-sm-12">
                                <div class="tab-content quickview-big-img">
                                    <div id="pro-1" class="tab-pane fade show active">
                                        <img src="./images/<?php echo $pimage; ?>" alt="<?php echo $pimage; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 col-sm-12">
                                <div class="product-details-content quickview-content">
                                    <h2><?php echo $pmname; ?></h2>
                                   
                                   <!-- <p>Seamlessly predominate enterprise metrics without performance based process improvements.</p>-->
                                    

                                   
									
									<label class="control-label">Standard Problem </label>
                                       <select class="form-control" name="problemname" id="problemname">
										<option value="0">Select Standard Problem</option>
										<?php
										$eve_main1 = "select * from res_problemtype_master where samid=$samid";
										$re_main1= mysqli_query($conn, $eve_main1);
										while($rt_main1 = mysqli_fetch_assoc($re_main1))
										{

											//$ptmid=$rt_main1['ptmid'];
											$ptmname=$rt_main1['ptmname'];
											$ptmrate=$rt_main1['ptmrate'];
											if($ptmrate==0)
											{
												$price="";
											}
											else
											{
												$price="(Rs. ".$ptmrate.")";
											}
											if($ptmname1==$ptmname)
											{
												echo "<option value='$ptmname' selected>$ptmname $price</option>";
											}
											else
											{
												echo "<option value='$ptmname'>$ptmname $price</option>";
											}

										}
									?>
									</select>
									
										<label class="control-label">Call Type </label>
                                       <select class="form-control" name="ctmname" id="ctmname">
										<option value="0">Select Call Type</option>
										<?php
										$eve_main1 = "select * from res_complaintype_master where samid=$samid";
										$re_main1= mysqli_query($conn, $eve_main1);
										while($rt_main1 = mysqli_fetch_assoc($re_main1))
										{

											//$ptmid=$rt_main1['ptmid'];
											$ctmname=$rt_main1['ctmname'];
											$ctmid=$rt_main1['ctmid'];
											
												echo "<option value='$ctmname'>$ctmname</option>";
											

										}
									?>
									</select>
									
										<label class="control-label">Problem Detail </label>
										<textarea type="text" name="cmdetail" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error"  ></textarea>
										<label class="control-label">Photo </label>
										<input class="form-control" type="file" name="cmphoto" accept="images/*" >
                                    </div>
                                </div>
                            </div>
                        

		</div>
		
		
<script type="text/javascript">
		
	$(function()
	{
		$('#myForm').submit(function(e)
		{
			if($('#ctmname').val() == '0')
			{
				alert('Select Complain!');
				e.preventDefault();
				return;
			}

			 if($('#problemname').val() == '0')
			{
				alert('Select problem Type!');
				e.preventDefault();
					return;
			} 
		});
	});
</script>