<?php  
session_start(); 
	include("connect.php");	
	include("connectp.php");
	header("Access-Control-Allow-Origin: *");
	
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
$samid=$_SESSION['samid'];

 $q = $db7->prepare("select * from res_banner_master where samid=$samid");
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
			
			 	$bmid=$rt['bmid'];
				
				$uedit="<a href='banneredit.php?id=".$rt['bmid']."' data-toggle='tooltip' data-placement='top' title='Edit' class='fa fa-edit fa-lg'>  </a>";
				
				$udelete="<a href='bannerdelete.php?id=".$rt['bmid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>";
				
				
				$view="<a href='bannerdetails.php?id=".$rt['bmid']."' data-toggle='tooltip' data-placement='top' title='View' class='fa fa-eye fa-lg' >  </a>";
				
				/* $duplicate="<a href='banneradd.php?id=".$rt['bmid']."' data-toggle='tooltip' data-placement='top' title='Duplicate' class='fa fa-clone' >  </a>"; */
				
				$op=$view."&nbsp;&nbsp;&nbsp; ".$uedit."&nbsp;&nbsp;&nbsp; ".$udelete;
				
							
				
			
							$bannerimg=$rt['bannerimg']; 
							$bannerimgsortorder=$rt['bannerimgsortorder'];
							$bmname=$rt['bmname'];
							//$admurl=$rt['admurl'];
							


				if(strlen($bannerimg)>3)
				{
					$bannerimg1="<img src='images/$bannerimg' width='50px' height='50px'>";
				}
				else
				{
					$bannerimg1="<img src='images/noimage.jpg' width='50px' height='50px'>";
				}
				
				/* echo $posts[] = array('cmid'=> $i++,'cmname'=> $cmname,'cmdesc'=> $cmdesc,'cmstatus'=> $cmstatus1,'op'=> $op); */
				$posts[]=array('bmid'=>$i++,'bannerimg'=>$bannerimg1,'bannerimgsortorder'=>$bannerimgsortorder,'bmname'=>$bmname,'op'=>$op);
			
			
			
		}
		 
		$response['posts'] = $posts;
		echo stripslashes(json_encode( array('data' => $posts)));
		mysqli_close($conn);
		return;
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