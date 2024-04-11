<?php  
session_start(); 
	include("connect.php");	
	include("connectp.php");
	header("Access-Control-Allow-Origin: *");
	//$samid=$_SESSION['samid'];
	$samid=$_SESSION['samid'];

	
		$q = $db7->prepare("select * from res_service_master where  samid=$samid  order by servicemid desc");
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
			
			 	$servicemid=$rt['servicemid'];
			 	$servicestatus=$rt['servicestatus'];
				
			    $uedit="<a href='servicenewedit.php?id=".$rt['servicemid']."' data-toggle='tooltip' data-placement='top' title='Edit' style='color:blue;' class='fa fa-edit fa-lg  hidden-print'>  </a>";
			
				$udelete="<a href='servicenewdelete.php?id=".$rt['servicemid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' style='color:red;' class='fa fa-trash-o fa-lg  hidden-print'>  </a>"; 
				
				$view="<a href='servicedetail.php?id=".$rt['servicemid']."' data-toggle='tooltip' data-placement='top' title='View' style='color:Green;' class='fa fa-eye fa-lg  hidden-print' >  </a>";
				
				
				$op=$view."&nbsp;&nbsp;&nbsp;".$uedit."&nbsp;&nbsp;&nbsp;".$udelete;
				
				$sstartdate=implode('-', array_reverse(explode('-', $rt['sstartdate'])));
				$senddate=implode('-', array_reverse(explode('-', $rt['senddate'])));
				$pdate=implode('-', array_reverse(explode('-', $rt['spurchasedate'])));
				
				if($servicestatus=="Active")
				{
					
					$servicestatus1="<a href='servicestatus.php?id=".$rt['servicemid']."' class=' hidden-print'><span class='label label-sm label-success'>Active</span></a>";
				}
				else if($servicestatus=="Inactive")
				{
					
					$servicestatus1="<a href='servicestatus.php?id=".$rt['servicemid']."' class=' hidden-print'><span class='label label-sm label-danger'>Inactive</span></a>";
				}
				else
				{
					$servicestatus1="<span class='label label-sm label label-default '>$servicestatus</span>";
				}
				
				$sremarks=$rt['sremarks'];
				$sserialno=$rt['sserialno'];
				$servicetype=$rt['servicetype'];
				$snoofseat=$rt['snoofseat'];
				$sservicecharge=$rt['sservicecharge'];
				
				$pmid=$rt['pmid'];
				$eve1 = "select * from res_product_master where pmid=$pmid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$pmname=$rt1['pmname'];
				}
				$custid=$rt['custid'];
				$eve1 = "select * from res_user_master where umid=$custid";
				$re1 = mysqli_query($conn, $eve1);
				$uname="";
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$uname=$rt1['uname'];
				}
				
				$serviceno="<span class='label label-sm label-success'>$rt[senofordisplay]</span>";
					$servicenonew="<a href='servicedetail.php?id=".$rt['servicemid']."&page=Service' title='Click Here' class=' hidden-print'>$serviceno </a>";
			
				$posts[] = array('amcid'=> $i++,'pmname'=> $pmname,'uname'=>$uname,'sstartdate'=>$sstartdate,'senddate'=> $senddate,'sremarks'=>$sremarks,'pdate'=>$pdate,'sserialno'=>$sserialno,'servicetype'=>$servicetype,'snoofseat'=>$snoofseat,'sservicecharge'=>$sservicecharge,'op'=>$op,'servicestatus'=> $servicestatus1,'serviceno'=>$serviceno);
		}
		 
		$response['posts'] = $posts;
		echo stripslashes(json_encode( array('data' => $posts)));
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