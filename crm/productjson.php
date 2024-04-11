<?php  
session_start(); 
	include("connect.php");	
	include("connectp.php");
	header("Access-Control-Allow-Origin: *");
	$samid=$_SESSION['samid'];
		$q = $db7->prepare("select * from res_product_master where samid=$samid and ptype='Product'");
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
			
			 	$pmid=$rt['pmid'];
				
				$uedit="<a href='productedit.php?id=".$rt['pmid']."' data-toggle='tooltip' data-placement='top' title='Edit' style='color:blue;' class='fa fa-edit fa-lg'>  </a>";
			
				$udelete="<a href='productdelete.php?id=".$rt['pmid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' style='color:red;' class='fa fa-trash-o fa-lg'>  </a>";
				
				$view="<a href='productdetail.php?id=".$rt['pmid']."' data-toggle='tooltip' data-placement='top' title='View' style='color:Green;' class='fa fa-eye fa-lg' >  </a>";
				
			/* 	$duplicate="<a href='customeradd.php?id=".$rt['customermid']."' data-toggle='tooltip' data-placement='top' title='Duplicate' class='fa fa-clone' >  </a>";
			 */	
				$op=$view."&nbsp;&nbsp;&nbsp; ".$uedit."&nbsp;&nbsp;&nbsp; ".$udelete;
				
				$pmname=$rt['pmname'];
				$pmdesc=$rt['pmdesc'];
				$pmremark=$rt['pmremark'];
				$prate=$rt['prate'];
				$ptype=$rt['ptype'];
				$pimage=$rt['pimage'];
				if(strlen($pimage)>3)
				{
					$pimage1="<img src='../images/$pimage' width='50px' height='50px'>";
				}
				else
				{
					$pimage1="<img src='../images/noimage.jpg' width='50px' height='50px'>";
				}
				
				$posts[] = array('pmid'=> $i++,'pmname'=> $pmname,'pmdesc'=> $pmdesc,'pmremark'=> $pmremark,'prate'=> $prate,'ptype'=> $ptype,'pimage'=> $pimage1,'op'=> $op);
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