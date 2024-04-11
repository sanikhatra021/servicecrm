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
				
				$uamc="<a href='customeramcdetail.php?id=".$rt['umid']."' class='btn sbold green' title='Add AMC' > Add AMC </a>";
					
				/* $view="<a href='customerdetail.php?id=".$rt['umid']."' data-toggle='tooltip' data-placement='top' title='View' class='fa fa-eye fa-lg' >  </a>"; */
				
				/* $udelete="<a href='userdelete.php?id=".$rt['umid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>"; */
				
				$op=$uamc."&nbsp;&nbsp;&nbsp;";
				
				$uname=$rt['uname'];
				$umobile=$rt['umobile'];
				$upassword=$rt['upassword'];
				
				$emailid=$rt['emailid'];
				$uaddress=$rt['uaddress'];
				$ucity=$rt['ucity'];
				$uloc1=$rt['uloc1'];
				$uloc2=$rt['uloc2'];
				
				$utype=$rt['utype'];
				$utype1="";
				if($utype=="customer")
				{
					$utype1="<span class='label label-sm label-success'>customer</span>";
				}
				else if($utype=="serviceengineer")
				{
					$utype1="<span class='label label-sm label-warning'>serviceengineer</span>";
				}
				
				
			$posts[] = array('umid'=> $i++, 'uname'=> $uname, 'umobile'=> $umobile,'upassword'=> $upassword, 'utype'=> $utype1,'emailid'=> $emailid, 'uaddress'=> $uaddress,'ucity'=> $ucity,'uloc1'=>$uloc1,'uloc2'=>$uloc2,'op'=> $op);
	
			
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