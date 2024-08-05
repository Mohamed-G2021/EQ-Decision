<?php 
include_once("header.php");
?>

<?php 


if (isset($_POST['btnsearch'])){
    
    if(!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
                    http_response_code(403);
                    die('');
                    exit;
                }


	  
$request =$_POST['txtrequest'];
      $request = stripslashes($request);
	  
	  $statusselect =$_POST['statusselect'];
	  
   // $user_role=$_SESSION['roleid'];

$univ_id=$_SESSION['univ_id'];

   
//**************************************** حاله و بس **********************************************************************//
if( strlen($request)==0 && $statusselect!=0)
{
	$selectt="";
	$fromm="";
	$wheree="and status.STATUS_ID=$statusselect ";
}

//**************************************** حاله و رقم طلب **********************************************************************//
if( strlen($request)!=0 && $statusselect!=0)
{
	$selectt="";
	$fromm="";
	$wheree="and status.STATUS_ID=$statusselect  and `request`.`REQUEST_ID` = $request";
}

//**************************************** رقم طلب بس **********************************************************************//
if( strlen($request)!=0 && $statusselect==0)
{
	$selectt="";
	$fromm="";
	$wheree="and `request`.`REQUEST_ID` = $request";
}


//**************************************** ولا رقم طلب ولا حاله **********************************************************************//
if( strlen($request)==0 && $statusselect==0)
{
	$selectt="";
	$fromm="";
	$wheree="";
}

/////////////////////////////////////////////////
/*

echo 	$selectt;
echo"<br>";

	echo 	$fromm;
	echo"<br>";
		echo 	$wheree;
		echo"<br>";
		*/
	
  $sql ="SELECT applicant.`Serial` as app_serial ,`applicant`.`univ_id` as u_i_a,`applicant`.`user_role` as u_role $selectt ,`degree`,`FK_matlob`,matlob.matlob_NAME,request.StatusID,request.REQUEST_ID,status.STATUS_VALUE,status.STATUS_ID,`request`.`destination`,`request`.`univ_destination`,`request`.`univ_emkanyat`,`request`.`univ_gadwa`,`request`.`scu_destination`,`request`.`mozakera_dest`, 
`request`.`fk_session_id`
FROM applicant , request $fromm ,matlob,status
where 

 applicant.FK_matlob=matlob.matlob_ID
 and status.STATUS_ID=request.StatusID
and request.FK_Applicant_serial = `applicant`.`Serial`  

 $wheree
 
 ";
//echo $sql;
 //

  $stmt = $con->prepare($sql);
    /* Execute statement */

    $x='1';
   // echo " q ". $q . $x.$ssn.$request.$mail;
  // $stmt->bind_param($fff,$tt);
 //$bindddddd;
    $stmt->execute();
    $res = $stmt->get_result();
 //echo $stmt->num_rows ;


	
$n =$stmt->affected_rows;


 if($n > 0) {
    
	 /* 
	  echo $Serial;
	  echo "<br>";
	   echo $STATUS_ID;
	  echo "<br>";
	   echo $degree;
	  echo "<br>";
	   echo $matlob_NAME;
	  echo "<br>";
	  echo $REQUEST_ID;
	  echo "<br>";
	   echo $namee;
	  echo "<br>";
	  
	 */ 
       //echo $Serial.$STATUS_ID.$STATUS_VALUE.$NATIONAL_ID;  
/* 1= طلب مقدم
2= تم المراجعة
3=تم المراجعة و يوجد استيفاء

*/	
echo'
  <table class="table table-striped table-hover">

    <thead><tr>
		<th> رول الجلسه </th>
	<th> المذكره </th>
	<th> تقرير لجنة القطاع </th>
	<th> خطاب الأمين</th>
	<th> اخرى </th>
	<th>الإمكانيات البشريه	</th>
	<th> اللائحه </th>
	<th> القطاع </th>
	<th> رقم الجلسة </th>
<th>تاريخ الحاله</th>
<th>الحالة</th>
<th> المطلوب عمله</th>
<th> اسم الدرجة</th>
<th> رقم الطلب</th>
<th> المنشأه</th> 
       </tr>
    </thead>
    <tbody>';
	while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		
	 $Serial=$row['app_serial'];
	 
	 //echo $Serial;
       $_SESSION['Serial']=$Serial;
       $STATUS_ID =$row['StatusID'];
	   
	       $STATUS_VALUE =$row['STATUS_VALUE'];
       $degree =$row['degree'];
       $matlob_NAME=$row['matlob_NAME'];
       $FK_matlob=$row['FK_matlob'];
	   $fk_session_id=$row['fk_session_id'];
	   
       $REQUEST_ID=$row['REQUEST_ID'];
       $_SESSION['REQUEST_ID']=$REQUEST_ID;
	     //$namee=$row['namee'];
		 //$idd=$row['idd'];
		   $u_i_a=$row['u_i_a'];
		//   echo "u_i_a".$u_i_a;
	   $u_role=$row['u_role'];
	 //   echo "u_role".$u_role;
	 if($fk_session_id==0)
	 {
		 $session="لم يتم اسناد جلسه";
		  $session_path="";
	 }
	 else
	 {
		  $session=$fk_session_id;
		  $sessionpathq="SELECT distinct `id_session`,`path` FROM `session`,request
where `session`.`id`=request.fk_session_id
and request.fk_session_id=?";
$stmtsession = $con->prepare($sessionpathq);
$stmtsession->bind_param("s", $fk_session_id);
$stmtsession->execute();
$ressession = $stmtsession->get_result();	
	while($rowsession = $ressession->fetch_array(MYSQLI_ASSOC))
		  $session_path=$rowsession['path'];
	 }
	   if($u_role==10)//univ
	   {
		   $qunivac="SELECT `id`,`name` FROM `universty_lookup` where `id`=?";
$stmtunivac = $con->prepare($qunivac);
$stmtunivac->bind_param("s", $u_i_a);
$stmtunivac->execute();
$resunivac = $stmtunivac->get_result();	
	while($rowunivac = $resunivac->fetch_array(MYSQLI_ASSOC))
		
		{
			$idd=$rowunivac['id'];
			$namee=$rowunivac['name'];
		}
		
	   }
	   else if($u_role==20)//acadm
	   {
		   		   $qunivac="SELECT `id`,`name` FROM `academy_lookup` where `id`=?";
$stmtunivac = $con->prepare($qunivac);
$stmtunivac->bind_param("s", $u_i_a);
$stmtunivac->execute();
$resunivac = $stmtunivac->get_result();	
	while($rowunivac = $resunivac->fetch_array(MYSQLI_ASSOC))
		
		{
			$idd=$rowunivac['id'];
			$namee=$rowunivac['name'];
		}
		
	   }
	   else if ($u_role==30)//inst
	   {
		      		   $qunivac="SELECT `id`,`name` FROM `institute_lookup` where `id`=?";
$stmtunivac = $con->prepare($qunivac);
$stmtunivac->bind_param("s", $u_i_a);
$stmtunivac->execute();
$resunivac = $stmtunivac->get_result();	
	while($rowunivac = $resunivac->fetch_array(MYSQLI_ASSOC))
		
		{
			$idd=$rowunivac['id'];
			$namee=$rowunivac['name'];
		}
	   }
	   else
	   {
		   $idd="";
			$namee="";
	   }
	   
$qlog="SELECT max(`date`) as datelog FROM `status_log` where `fk_request_id`=? and `fk_status_id`=?";
$stmtlog = $con->prepare($qlog);
$stmtlog->bind_param("ss", $REQUEST_ID,$STATUS_ID);
$stmtlog->execute();
$reslog = $stmtlog->get_result();	
$nlog =$stmt->affected_rows;

if($nlog > 0)
{

	

	while($rowlog = $reslog->fetch_array(MYSQLI_ASSOC)) {
	
		 
		
			
		 
if ($STATUS_ID == '1'  || $STATUS_ID == '4'  || $STATUS_ID == '13' )
{
	echo' <tr>';
	if($session_path=="")
	{
		echo'
	 	  <td class="text-center"> </td>';
	}
	else
	{
		echo'
	 <td class="text-center"><a  href="3ardfile.php?id='.$session_path.'" target="_blank" >عرض</a>  </td>';
	}
	 echo'
	 	  <td class="text-center"> </td>
		  	  <td class="text-center"> </td>
			  <td class="text-center"> </td>
			  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_gadwa'].'" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_emkanyat'].'" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_destination'].'" target="_blank" >عرض</a>  </td>
	  <td class="text-center"> </td>
	   <td class="text-center"> '.$session.'  </td>
	 	 
	  <td class="text-center">'.$rowlog['datelog'].' </td>

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$namee.' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
	
	
	
	
?>





 <?php 
}


else if($STATUS_ID == '2' )
{
   	
		echo' <tr>';
	if($session_path=="")
	{
		echo'
	 	  <td class="text-center"> </td>';
	}
	else
	{
		echo'
	 <td class="text-center"><a  href="3ardfile.php?id='.$session_path.'" target="_blank" >عرض</a>  </td>';
	}
	 echo'
		 	  <td class="text-center"> </td>
		  	  <td class="text-center"> </td>
			  <td class="text-center"> </td>
			  			  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_gadwa'].'" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_emkanyat'].'" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_destination'].'" target="_blank" >عرض</a>  </td> 
	<td class="text-center"> </td>
	 	
<td class="text-center"> '.$session.'  </td>
	
<td class="text-center">'.$rowlog['datelog'].' </td>
		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$namee.' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '3' )
{
  	echo' <tr>';
	if($session_path=="")
	{
		echo'
	 	  <td class="text-center"> </td>';
	}
	else
	{
		echo'
	 <td class="text-center"><a  href="3ardfile.php?id='.$session_path.'" target="_blank" >عرض</a>  </td>';
	}
	 echo'
		 	  <td class="text-center"> </td>
		  	  <td class="text-center"> </td>
			  <td class="text-center"> </td>
			  			  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_gadwa'].'" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_emkanyat'].'" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_destination'].'" target="_blank" >عرض</a>  </td> 
	<td class="text-center"> </td>
	 	  
<td class="text-center"> '.$session.'  </td>
	
<td class="text-center">'.$rowlog['datelog'].' </td>
		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$namee.' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}
else if( $STATUS_ID == '8') // استيفاء من لجنة القطاع
{
      	     $sqlx ="select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3	 
FROM  request,keta3
where 
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?
 
 ";
//echo $sql;
 //

  $stmtx = $con->prepare($sqlx);
  $stmtx->bind_param("s",$row['REQUEST_ID']);
    $stmtx->execute();
    $resx = $stmtx->get_result();
 	
$nx =$stmtx->affected_rows;


 if($nx > 0) {
	while($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
		echo' <tr>';
	if($session_path=="")
	{
		echo'
	 	  <td class="text-center"> </td>';
	}
	else
	{
		echo'
	 <td class="text-center"><a  href="3ardfile.php?id='.$session_path.'" target="_blank" >عرض</a>  </td>';
	}
	 echo'
	 <td class="text-center"> </td>
	 	 	  <td class="text-center"> <a  href="3ardfile.php?id='.$row['destination'].'" target="_blank" >عرض</a>  </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['scu_destination'].'" target="_blank" >عرض</a>   </td>
			  			  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_gadwa'].'" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_emkanyat'].'" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_destination'].'" target="_blank" >عرض</a>  </td>
	<td class="text-center"> '.$rowx['keta3_VALUE'].'</td>';	
	}
 }	 
	 
	
	 echo'
	 
	 	  
<td class="text-center"> '.$session.'  </td>
	<td class="text-center">'.$rowlog['datelog'].' </td>

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$namee.' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '5' )
{
   	
   	     $sqlx ="select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3	 
FROM  request,keta3
where 
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?
 
 ";
//echo $sql;
 //

  $stmtx = $con->prepare($sqlx);
  $stmtx->bind_param("s",$row['REQUEST_ID']);
    $stmtx->execute();
    $resx = $stmtx->get_result();
 	
$nx =$stmtx->affected_rows;


 if($nx > 0) {
	while($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
		echo' <tr>';
	if($session_path=="")
	{
		echo'
	 	  <td class="text-center"> </td>';
	}
	else
	{
		echo'
	 <td class="text-center"><a  href="3ardfile.php?id='.$session_path.'" target="_blank" >عرض</a>  </td>';
	}
	 echo'
	 <td class="text-center"> </td>
	 	 	 	 <td class="text-center"> </td> 
		  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['scu_destination'].'" target="_blank" >عرض</a>   </td>
			  			  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_gadwa'].'" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_emkanyat'].'" target="_blank" >عرض</a>  </td>
			  <td class="text-center"> <a  href="3ardfile.php?id='.$row['univ_destination'].'" target="_blank" >عرض</a>  </td>
			  	  
	<td class="text-center"> '.$rowx['keta3_VALUE'].'</td>';	
	}
 }	 
	 
	
	 echo'
	 	
<td class="text-center"> '.$session.'  </td>
	<td class="text-center">'.$rowlog['datelog'].' </td>

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$namee.' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '10' )
{
   	     $sqlx ="select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3	 
FROM  request,keta3
where 
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?
 
 ";
//echo $sql;
 //

  $stmtx = $con->prepare($sqlx);
  $stmtx->bind_param("s",$row['REQUEST_ID']);
    $stmtx->execute();
    $resx = $stmtx->get_result();
 	
$nx =$stmtx->affected_rows;


 if($nx > 0) {
	while($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
	 	echo' <tr>';
	if($session_path=="")
	{
		echo'
	 	  <td class="text-center"> </td>';
	}
	else
	{
		echo'
	 <td class="text-center"><a  href="3ardfile.php?id='.$session_path.'" target="_blank" >عرض</a>  </td>';
	}
	 echo'
	  <td class="text-center"> <a  href="3ardfile.php?id='.$row['mozakera_dest'].'" target="_blank" >عرض</a>  </td>
	 	 	 	  <td class="text-center"> <a  href="3ardfile.php?id='.$row['destination'].'" target="_blank" >عرض</a>  </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['scu_destination'].'" target="_blank" >عرض</a>   </td>
			  			  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_gadwa'].'" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_emkanyat'].'" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_destination'].'" target="_blank" >عرض</a>  </td>
	<td class="text-center"> '.$rowx['keta3_VALUE'].'</td>';	
	}
 }	 
	 
	
	 echo'
	<td class="text-center"> '.$session.'  </td> 	
<td class="text-center">'.$rowlog['datelog'].' </td>
		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$namee.' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '6' || $STATUS_ID == '7' )
{
   	
   	     $sqlx ="select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3	 
FROM  request,keta3
where 
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?
 
 ";
//echo $sql;
 //

  $stmtx = $con->prepare($sqlx);
  $stmtx->bind_param("s",$row['REQUEST_ID']);
    $stmtx->execute();
    $resx = $stmtx->get_result();
 	
$nx =$stmtx->affected_rows;


 if($nx > 0) {
	while($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
	 	echo' <tr>';
	if($session_path=="")
	{
		echo'
	 	  <td class="text-center"> </td>';
	}
	else
	{
		echo'
	 <td class="text-center"><a  href="3ardfile.php?id='.$session_path.'" target="_blank" >عرض</a>  </td>';
	}
	 echo'
	  <td class="text-center"> </td>
	 	 	 	  <td class="text-center"> <a  href="3ardfile.php?id='.$row['destination'].'" target="_blank" >عرض</a>  </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['scu_destination'].'" target="_blank" >عرض</a>   </td>
			  			  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_gadwa'].'" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_emkanyat'].'" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_destination'].'" target="_blank" >عرض</a>  </td>
	<td class="text-center"> '.$rowx['keta3_VALUE'].'</td>';	
	}
 }	 
	
	
	 echo'
	 	   
<td class="text-center"> '.$session.'  </td>
	<td class="text-center">'.$rowlog['datelog'].' </td>

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$namee.' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '9'  )
{
   	
   	     $sqlx ="select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3	 
FROM  request,keta3
where 
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?
 
 ";
//echo $sql;
 //

  $stmtx = $con->prepare($sqlx);
  $stmtx->bind_param("s",$row['REQUEST_ID']);
    $stmtx->execute();
    $resx = $stmtx->get_result();
 	
$nx =$stmtx->affected_rows;


 if($nx > 0) {
	while($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
	 	echo' <tr>';
	if($session_path=="")
	{
		echo'
	 	  <td class="text-center"> </td>';
	}
	else
	{
		echo'
	 <td class="text-center"><a  href="3ardfile.php?id='.$session_path.'" target="_blank" >عرض</a>  </td>';
	}
	 echo'
	 <td class="text-center"> </td>
	 	 	 	  <td class="text-center"> <a  href="3ardfile.php?id='.$row['destination'].'" target="_blank" >عرض</a>  </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['scu_destination'].'" target="_blank" >عرض</a>   </td>
			  			  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_gadwa'].'" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_emkanyat'].'" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_destination'].'" target="_blank" >عرض</a>  </td>
	<td class="text-center"> '.$rowx['keta3_VALUE'].'</td>';	
	}
 }	 
	
	
	 echo'
	
	 	 
<td class="text-center"> '.$session.'  </td>

<td class="text-center">'.$rowlog['datelog'].' </td>
	

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$namee.' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '11' || $STATUS_ID == '12')
{
   	     $sqlx ="select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3	 
FROM  request,keta3
where 
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?
 
 ";
//echo $sql;
 //

  $stmtx = $con->prepare($sqlx);
  $stmtx->bind_param("s",$row['REQUEST_ID']);
    $stmtx->execute();
    $resx = $stmtx->get_result();
 	
$nx =$stmtx->affected_rows;


 if($nx > 0) {
	while($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
		echo' <tr>';
	if($session_path=="")
	{
		echo'
	 	  <td class="text-center"> </td>';
	}
	else
	{
		echo'
	 <td class="text-center"><a  href="3ardfile.php?id='.$session_path.'" target="_blank" >عرض</a>  </td>';
	}
	 echo'
	 <td class="text-center"> <a  href="3ardfile.php?id='.$row['mozakera_dest'].'" target="_blank" >عرض</a>  </td>
	 	 	 	  <td class="text-center"> <a  href="3ardfile.php?id='.$row['destination'].'" target="_blank" >عرض</a>  </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['scu_destination'].'" target="_blank" >عرض</a>   </td>
			  			  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_gadwa'].'" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_emkanyat'].'" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id='.$row['univ_destination'].'" target="_blank" >عرض</a>  </td>
	<td class="text-center"> '.$rowx['keta3_VALUE'].'</td>';	
	}
 }	 
	
	
	 echo'
	 	   
<td class="text-center"> '.$session.'  </td>
	<td class="text-center">'.$rowlog['datelog'].' </td>

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$namee.' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else 
{
echo'
  <div align="center" class="style1" style="color:#FF0000">
        <h2>لا يوجد بيانات</h2>
		 ';

    
    
  echo' <td align="center" ><div align="center" class="style1" style="color:#FF0000"> <a href="emp_search3.php"> للرجوع للصفحة السابقة اضغط هنا </a> </div> </td>';
 
         

}

}
	}
 }
	echo'</tbody></table>';
}

else
{
	echo'<br/>
<center>
 <div  align="center" class="lggraytitle style1" style="margin-bottom:200px "> 
<h3 style="color:red;">

لا توجد نتائج للبحث 


</h3>
</div>
</center>
';	
}


}else{

	echo'
    <div align="center" class="style1" style="color:#FF0000">
        <h2>لا يمكن الرجوع لهذه الصفحة</h2>
		 </div>
         ';
       
	
}


?>

<script>

function validatenameff(){
var txtarname = document.getElementById("txtarname").value;
if(txtarname.length==0){
   var str="يرجى ادخال اسم المنشأه" ;
   alert(str);     
   //return false;
}
else if(txtarname.length!=0)
{


	//validatedate();
	var txtorg = document.getElementById("txtorg").value;
if(txtorg.length==0){
   var str="يرجى ادخال اسم الدرجة" ;
   alert(str);     
   //return false;
}
else
{
	var pattern = /^[\u0621-\u064A ]+$/;
   result2 = pattern.test(txtorg);
	if(result2)
	{
		form.submit();
	}
	else
	{
		 var strr="اسم الدرجة يجب ان يكون باللغة العربية"
	  alert(strr); 
	}
	
}
	

}
else{
//validatedate();
form.submit();
}
}
</script>
<?php 
include_once("footer.php");
?>

