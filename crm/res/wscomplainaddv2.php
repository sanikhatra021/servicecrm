<?php  

error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	include("../mylibrary.php");
	include("../getcomplainno.php");
	
	 $par1=$_GET['p1'];	//mobile
	$par2=$_GET['p2'];	//university
	$par3=$_GET['p3'];	//ctmid
	$par4=$_GET['p4'];	//pmid
	$par5=0;	//ctmid
	$par6=$_GET['p6'];	//status
	$par7=$_GET['p7'];	//detail
	$par8=$_GET['p8'];	//complain category
	$par9=$_GET['p9'];	//call type name
	
	if($par4=='')
	{
		$par4=0;
	}
	
	if($par8=='')
	{
		$par8=0;
	}
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d');
	$mdate1= date('Y-m-d H:i:s');
	
	$response = array();
	$posts = array();
	$result ="0";
	$msg = "";
	
	 $eve_category =  "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re_category = mysqli_query($conn,$eve_category);
	if(mysqli_num_rows($re_category) > 0)
    {
		while($rt_category = mysqli_fetch_assoc($re_category))
		{
				//$ctmid=$rt_category['ctmid'];
				//$pmid=$rt_category['pmid'];
				//$customerid=$rt_category['customerid'];
				$umid=$rt_category['umid'];
				 $samid=$rt_category['samid'];
				//$cmdate=implode('-', array_reverse(explode('-', $rt1['cmdate'])));
			
		}	
		
		
		
		$eve22 = "select ptmname from res_problemtype_master where samid=$samid and ptmid=$par8";
		$re22 = mysqli_query($conn, $eve22);
		$ptmname="";
		while($rt22 = mysqli_fetch_assoc($re22))
		{
			$ptmname=$rt22['ptmname'];
		}
	
	$cyear = getFinancialYear2($mdate);
	$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where cyear='$cyear' and  samid=$samid";
	$remaxq = mysqli_query($conn, $evemaxq);
	while($rtmaxq = mysqli_fetch_assoc($remaxq))
	{
		$cmno=$rtmaxq['maxcmno'];
	}
	$cmno1=$cmno+1;
		//$saprefix=date("ymd");
		//$cmnowithprefix=$saprefix.$cmno1;
		$cmnowithprefix=generatecomplainno();
		
		 $eve11 = "select udefaultserviceengineer from res_user_master where umid=$umid and utype='customer'";
		$re11 = mysqli_query($conn, $eve11);
		$cmserviceengineerid=0;
		while($rt11 = mysqli_fetch_assoc($re11))
		{
			$cmserviceengineerid=$rt11['udefaultserviceengineer'];
		}
		
		
		
 
	
 
	
	
	$tt1="";
	if(empty($_FILES['image']['name']) == false  )
	{
		
		 $simplephoto11=$_FILES['image']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$cmphoto= date("YmdHis").rand(100,999).".".$fileend1;
		 $path = "../images";
		move_uploaded_file( $_FILES['image']['tmp_name'], $path ."/". $cmphoto);
				
	}	
 
	
		
		

 
 
		
			 $eve1 = "insert into res_complain_master (cmno,ctmid,pmid,customerid,cmdate,cmdetail,cstatus,samid,cmstatusudate,cmupdatedon,cmupdatedby,cmnowithprefix,cmaddedby,cmaddedon,cmserviceengineerid,cmproblemtype,cmphoto,cmtype,cyear) values($cmno1,'$par3','$par4','$umid','$par6','$par7','Pending','$samid','$mdate','$mdate1','$umid','$cmnowithprefix','$umid','$mdate1','$cmserviceengineerid','$ptmname','$cmphoto','$par9','$cyear')";
			
			if ($conn->query($eve1) === TRUE) 
			{
				$result="1";
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $msg);

		
			
				echo stripslashes(json_encode($posts));				
			}
			else
		   {
				
				$result="0";
				$msg = "Failure";	
				$posts[] = array('p1'=> $result,'p2'=> $msg);
				echo stripslashes(json_encode(array($posts)));
			
		   }

		
	}
	else
    {
	   $result="0";
	   $msg = "Invalid mobile OR password";
	   
		$posts[] = array('p1'=> $result,'p2'=> $msg);
				echo stripslashes(json_encode(array($posts)));
	
    }
   
    $response['posts'] = $posts;
	mysqli_close($conn);
	
	
?>