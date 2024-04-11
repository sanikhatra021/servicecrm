<?php  
session_start(); 
	include("connect.php");	
	include("connectp.php");
	header("Access-Control-Allow-Origin: *");
	
	if(!isset($_SESSION['lacomplainsuperadmin']))
	{
		header('Location: index.php');
		return;
	}

	$q = $db7->prepare("select * from res_superadmin_master where sautype!='superadmin' ");
	//$q->bindValue(':p1', "$par1");
	//$q->bindValue(':p2',  "$par2");
	$q->execute();
	
	
	
	
	$response = array();
	$posts = array();
	
	$result="0";
	$saurl="";
	
	if ($q->rowCount() > 0)
	{
		$i=1;
		while($i<=$q->rowCount())
		{
			$rt = $q->fetch(PDO::FETCH_ASSOC);
			
			 	$samid=$rt['samid'];
				
				$uedit="<a href='superadminedit.php?id=".$rt['samid']."' data-toggle='tooltip' data-placement='top' title='Edit' class='fa fa-edit fa-lg'>  </a>";
				
				$view1="<a href='superadmindetail.php?id=".$rt['samid']."' data-toggle='tooltip' data-placement='top' title='View' class='fa fa-eye fa-lg' >  </a>";
				
				 $udelete="<a href='superadmindelete.php?id=".$rt['samid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>"; 
				
				$view="<a href='superadmindetail.php?id=".$rt['samid']."' > Click Here </a>";
				
				
				$op=$view1."&nbsp;&nbsp;&nbsp; ".$uedit."&nbsp;&nbsp;&nbsp;" .$udelete."&nbsp;&nbsp;&nbsp;";
				
				$safullname=$rt['safullname'];
				$samobile=$rt['samobile'];
				/* $sausername=$rt['sausername'];
				$sapassword=$rt['sapassword']; */
				
				$saemailid=$rt['saemailid'];
				$saaddress=$rt['saaddress'];
				$sacity=$rt['sacity'];
				$sauloc1=$rt['sauloc1'];
				$sauloc2=$rt['sauloc2'];
				$sauserstatus=$rt['sauserstatus'];
				$sacurrentplanname=$rt['sacurrentplanname'];
				$sacurrentplantype=$rt['sacurrentplantype'];
				$satotusers=$rt['satotusers'];
				$saplanexpdate=implode('-', array_reverse(explode('-', $rt['saplanexpdate'])));
				$sacurrentplanstatus=$rt['sacurrentplanstatus'];
				$saurl=$rt['saurl'];
				$saprefix=$rt['saprefix'];
				
				if($saurl!='')
				{
					// output: /myproject/index.php
					$currentPath = $_SERVER['PHP_SELF']; 
					
					// output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
					$pathInfo = pathinfo($currentPath); 
					
					// output: localhost
					$hostName = $_SERVER['HTTP_HOST']; 
					
					// output: http://
					$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
					/* $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))==''; */
					
					// return: http://localhost/myproject/
					$main=$protocol.$hostName."/";
					//return;
					$saurl1=$main.$rt['saurl'];
					
					$saurl="<a href='$saurl1' target='_blank'>$saurl</a>";
				}
				
				if($sacurrentplanstatus=="Active")
				{
					$sacurrentplanstatus="<span class='label label-sm label-success'>Active</span>";
				}
				else if($sacurrentplanstatus=="Inactive")
				{
					$sacurrentplanstatus="<span class='label label-sm label-danger'>Inactive</span>";
				}
				else if($sacurrentplanstatus=="Expired")
				{
					$sacurrentplanstatus="<span class='label label-sm label-danger'>Expired</span>";
				}
				else 
				{
					$sacurrentplanstatus="<span class='label label-sm label-warning'>$sacurrentplanstatus</span>";
				}
				
				
				$sautype=$rt['sautype'];
				/* $sautype1="";
				if($sautype=="customer")
				{
					$sautype1="<span class='label label-sm label-success'>customer</span>";
				}
				else if($sautype=="serviceengineer")
				{
					$sautype1="<span class='label label-sm label-warning'>serviceengineer</span>";
				} */
				
				
			$posts[] = array('samid'=> $i++, 'safullname'=> $safullname, 'samobile'=> $samobile,'sautype'=> $sautype, 'saemailid'=> $saemailid,'saaddress'=> $saaddress,'sacity'=>$sacity,'sauloc1'=>$sauloc1,'sauloc2'=>$sauloc2,'sauserstatus'=>$sauserstatus,'sacurrentplanname'=>$sacurrentplanname,'sacurrentplantype'=>$sacurrentplantype,'satotusers'=>$satotusers,'saplanexpdate'=>$saplanexpdate,'sacurrentplanstatus'=>$sacurrentplanstatus,'view'=>$view,'saurl'=> $saurl,'saprefix'=> $saprefix,'op'=> $op);
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