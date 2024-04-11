<?php  
session_start(); 
	include("connect.php");	
	include("connectp.php");
	header("Access-Control-Allow-Origin: *");
	//$samid=$_SESSION['samid'];
	$samid=$_SESSION['samid'];

	
		$q = $db7->prepare("select * from res_service_master where  samid=$samid  order by amcid desc");
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
			
			 	$amcid=$rt['amcid'];
				
			    $uedit="<a href='amcedit.php?id=".$rt['amcid']."' data-toggle='tooltip' data-placement='top' title='Edit' class='fa fa-edit fa-lg'>  </a>";
			
				$udelete="<a href='amcdelete.php?id=".$rt['amcid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>"; 
				
				$view="<a href='amcdetail.php?id=".$rt['amcid']."' data-toggle='tooltip' data-placement='top' title='View' class='fa fa-eye fa-lg' >  </a>";
				
				
				$op=$view."&nbsp;&nbsp;&nbsp;".$uedit."&nbsp;&nbsp;&nbsp;".$udelete;
				
				$sstartdate=implode('-', array_reverse(explode('-', $rt['sstartdate'])));
				$senddate=implode('-', array_reverse(explode('-', $rt['senddate'])));
				$pdate=implode('-', array_reverse(explode('-', $rt['spurchasedate'])));
				
				
				$sremarks=$rt['sremarks'];
				$sserialno=$rt['sserialno'];
				$servicetype=$rt['servicetype'];
				$snoofservice=$rt['snoofservice'];
				
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
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$uname=$rt1['uname'];
				}
				
			
				$posts[] = array('amcid'=> $i++,'pmname'=> $pmname,'uname'=>$uname,'sstartdate'=>$sstartdate,'senddate'=> $senddate,'sremarks'=>$sremarks,'pdate'=>$pdate,'sserialno'=>$sserialno,'servicetype'=>$servicetype,'snoofservice'=>$snoofservice,'op'=>$op);
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