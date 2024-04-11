<?php  
session_start(); 
	include("connect.php");	
	include("connectp.php");
	header("Access-Control-Allow-Origin: *");
	
	$samid=$_SESSION['samid'];
		$q = $db7->prepare("select * from res_problemtype_master where samid=$samid");
	//$q->bindValue(':p1', "$par1");
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
			
			 	$ptmid=$rt['ptmid'];
				
				$uedit="<a href='problemtypeedit.php?id=".$rt['ptmid']."' data-toggle='tooltip' data-placement='top' title='Edit' style='color:blue;' class='fa fa-edit fa-lg'>  </a>";
			
				$udelete="<a href='problemtypedelete.php?id=".$rt['ptmid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' style='color:red;' class='fa fa-trash-o fa-lg'>  </a>";
				
				$op=$uedit."&nbsp;&nbsp;&nbsp; ".$udelete;
				
				$ptmname=$rt['ptmname'];
				//$ptmimage=$rt['ptmimage'];
				$ptmrate=$rt['ptmrate'];
				
				/* if(strlen($ptmimage)>3)
				{
					$ptmimage="<img src='images/$ptmimage' width='50px' height='50px'>";
				}
				else
				{
					$ptmimage="<img src='images/noimage.jpg' width='50px' height='50px'>";
				} */
				
				$posts[] = array('srno'=> $i++,'ptmname'=> $ptmname,'ptmrate'=> $ptmrate,'op'=> $op);
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