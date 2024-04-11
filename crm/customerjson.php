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
	
	/* if($_SESSION['currentid']==1)
	{
		$tt1=" and utype='customer'";
	}
	else if($_SESSION['currentid']==2)
	{
		$tt1=" and utype='serviceengineer'";
	} */

	//$q = $db7->prepare("select * from res_user_master");
	$q = $db7->prepare("select * from res_user_master where samid=$samid and utype='customer'");
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
			
			 	$umid=$rt['umid'];
				
				$uedit="<a href='customeredit.php?id=".$rt['umid']."' data-toggle='tooltip' data-placement='top' title='Edit' style='color:blue;' class='fa fa-edit fa-lg'>  </a>";
				
				$view="<a href='customerdetail.php?id=".$rt['umid']."' data-toggle='tooltip' data-placement='top' title='View' style='color:green;' class='fa fa-eye fa-lg' >  </a>";
				
				 $udelete="<a href='customerdelete.php?id=".$rt['umid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' style='color:red;' class='fa fa-trash-o fa-lg'>  </a>"; 
				
				
				
				
				$op=$view."&nbsp;&nbsp;&nbsp; ".$uedit."&nbsp;&nbsp;&nbsp;".$udelete;
				
				 $uname=$rt['uname'];
				$umobile=$rt['umobile'];
				$upassword=$rt['upassword'];
				
				$emailid=$rt['emailid'];
				$uaddress=$rt['uaddress'];
				$ucity=$rt['ucity'];
				$usite=$rt['usite'];
				$managername=$rt['uprojectmanagername'];
				$managermobile=$rt['uprojectmanagermobile'];
				$inchargename=$rt['uprojectinchargename'];
				$inchargemobile=$rt['uprojectinchargemobile'];
				
				$udefaultserviceengineer=$rt['udefaultserviceengineer'];
				
				$eve11 = "select uname from res_user_master where umid=$udefaultserviceengineer";
				$re11 = mysqli_query($conn, $eve11);
				$udefaultserviceengineer1="";
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					 $udefaultserviceengineer1=$rt11['uname'];
				}
					
				$utype=$rt['utype'];
				$upriority=$rt['upriority'];
				$uforgototp=$rt['uforgototp'];
				
				$utype1="";
				if($utype=="customer")
				{
					$utype1="<span class='label label-sm label-success'>customer</span>";
				}
				else if($utype=="serviceengineer")
				{
					$utype1="<span class='label label-sm label-warning'>serviceengineer</span>";
				}
				
				
			$posts[] = array('umid'=> $i++, 'uname'=> $uname, 'umobile'=> $umobile,'upassword'=> $upassword, 'utype'=> $utype1,'emailid'=> $emailid, 'uaddress'=> $uaddress,'ucity'=> $ucity,'upriority'=> $upriority,'udefaultserviceengineer'=> $udefaultserviceengineer1,'uforgototp'=> $uforgototp,'op'=> $op,'managername'=>$managername,'managermobile'=>$managermobile,'inchargename'=>$inchargename,'inchargemobile'=>$inchargemobile,'usite'=>$usite);
	
			
			
			
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