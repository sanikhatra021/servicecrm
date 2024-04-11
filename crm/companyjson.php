<?php  
session_start(); 
	include("connect.php");	
	include("connectp.php");
	header("Access-Control-Allow-Origin: *");
	$samid=$_SESSION['samid'];
		$q = $db7->prepare("select * from res_company_master");
	//$q->bindValue(':p1', "$samid");
	//$q->bindValue(':p2',  "$par2");
	$q->execute();
	
	
	
	
	$response = array();
	$posts = array();
	
	$result="0";
	
	if ($q->rowCount() > 0)
	{
		$i=1;
		while($i<=$q->rowCount())
		{
			$rt = $q->fetch(PDO::FETCH_ASSOC);
			
			 	$cpmid=$rt['cpmid'];
				
				$uedit="<a href='companyedit.php?id=".$rt['cpmid']."' data-toggle='tooltip' data-placement='top' title='Edit' class='fa fa-edit fa-lg'>  </a>";
			
				$udelete="<a href='companydelete.php?id=".$rt['cpmid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>";
				
				$view="<a href='companydetail.php?id=".$rt['cpmid']."' data-toggle='tooltip' data-placement='top' title='View' class='fa fa-eye fa-lg' >  </a>";
				
			/* 	$duplicate="<a href='customeradd.php?id=".$rt['customermid']."' data-toggle='tooltip' data-placement='top' title='Duplicate' class='fa fa-clone' >  </a>";
			 */	
				$op=$view."&nbsp;&nbsp;&nbsp; ".$uedit."&nbsp;&nbsp;&nbsp; ".$udelete;
				
				$cpmname=$rt['cpmname'];
				$cpmcontacto=$rt['cpmcontacto'];
				$cpmaddress=$rt['cpmaddress'];
				$cpmwhatsappno=$rt['cpmwhatsappno'];
				$cpmemail=$rt['cpmemail'];
				$cpmcontactpname=$rt['cpmcontactpname'];
				$cpmwebsitedetails=$rt['cpmwebsitedetails'];
				
				
				
				$posts[] = array('cpmid'=> $i++,'cpmname'=> $cpmname,'cpmcontacto'=> $cpmcontacto,'cpmaddress'=> $cpmaddress,'cpmwhatsappno'=> $cpmwhatsappno,'cpmemail'=> $cpmemail,'cpmcontactpname'=> $cpmcontactpname,'cpmwebsitedetails'=> $cpmwebsitedetails,'op'=> $op);
		}
		 
		$response['posts'] = $posts;
		echo stripslashes(json_encode( array('data' => $posts)));
		//mysqli_close($conn);
		//return;
	}
	
   else
	{
		$result="0";
		$msg="Invalid Error";
		
		$posts[] = array('p1'=> $result,'p2'=> $msg);
	
		$response['posts'] = $posts;
		echo stripslashes(json_encode( array('item' => $posts)));
	}
   
	mysqli_close($conn);	
?>