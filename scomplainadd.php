<?php
session_start(); 
include("connect.php");
	if(!isset($_SESSION['complainweb']))
	{
		header("Location: $_SERVER[HTTP_REFERER]");
		return;
	}
	
	$umid=$_SESSION['currentumid'];
	$samid=$_SESSION['currentsamid'];
	
?>
<html>
	<head>
	<title>Complain Add</title>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet"/>
	</head>
	<body>
	<?php 
	if(isset($_SESSION["cmsg"]))
	{
		echo "<h2 id='mydiv' style='color:green'>$_SESSION[cmsg]</h2>";
	}unset($_SESSION['cmsg']);
	if(isset($_SESSION["cmsg1"]))
	{
		echo "<h2 style='color:red'>$_SESSION[cmsg1]</h2>";
	}unset($_SESSION['cmsg1']);
	?><br>
	
	<div class="container">
		<form method="POST" action="scomplainadd2.php">
			<input type="hidden" name="customerid" value="<?php echo $umid; ?>">
			<input type="hidden" name="samid" value="<?php echo $samid; ?>">
			 <!----Start row-->
			<div class="row">
			<div class="col-md-1"></div>
					  <div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Complain Type<span class="required">*</span></label>
							<select class="form-control select2" name="ctmid">
								<option value="0">Select Complain Type</option>
								<?php
								$eve_main = "select * from res_complaintype_master where samid=$samid";
								$re_main = mysqli_query($conn, $eve_main);
								while($rt_main = mysqli_fetch_assoc($re_main))
								{

									$ctmid=$rt_main['ctmid'];
									$ctmname=$rt_main['ctmname'];
									
									echo "<option value='$ctmid'>$ctmname</option>";
								}
							?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label class="control-label">Product<span class="required">*</span></label>
						<select class="form-control select2" name="pmid" id="product" required>
							<option value="0">Select Product</option>
							<?php
							$eve_main = "select * from res_product_master where samid=$samid and ptype='Product'";
							$re_main = mysqli_query($conn, $eve_main);
							while($rt_main = mysqli_fetch_assoc($re_main))
							{

								$pmid=$rt_main['pmid'];
								$pmname=$rt_main['pmname'];
							
								echo "<option value='$pmid'>$pmname</option>";

							}
						?>
						</select>
					</div>
					<div class="col-md-1"></div>
		   </div>
		   <!----End row-->
		   <!----Start row-->
		   	<div class="row">
			<div class="col-md-1"></div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Problem</label>
							<textarea type="text" name="cmdetail" class="form-control" ></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<label class="control-label">Photo</label>
						<input class="form-control" type="file" name="cmphoto" accept="images/*">
					</div>
					<div class="col-md-1"></div>
		   </div>
			<!----End row-->
			
			<!----Start row-->
				<div class="row">
				  <div class="col-md-12">
				   <div class="col-md-1"></div>
				    <div class="col-md-10">
					<button type="submit" class="btn btn-lg btn-primary">Submit <i class="fa fa-check"></i/></button>
					</div>
					<div class="col-md-1"></div>
				  </div>
				</div>
			<!----End row-->
			
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js">
    </script>
	</body>
</html>