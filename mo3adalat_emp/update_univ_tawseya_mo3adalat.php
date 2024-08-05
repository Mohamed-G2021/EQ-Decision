<?php
include_once("header.php");
?>
<div align="center" class="style2" dir="rtl" style="color:#000000" >
<!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله 
</h2>-->
</div>

<body>


	<?php


if (isset($_POST['btnedit'])){
    
    if(!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
                    http_response_code(403);
                    die('');
                    exit;
                }
					$serallll = $_POST['serallll'];
						$txtes = $_POST['txtes'];
					
		$user_role=$_SESSION['roleid'];
		
	$myUSER_ID=$_SESSION['myUSER_ID'];

	
	$date = date('Y-m-d');

//$status_id=11;
		
///////////////////////////////////////////////////////////
	
	$sql = 'SELECT distinct `REQUEST_ID` ,StatusID FROM `request`,applicant
where request.FK_Applicant_serial=applicant.Serial
and applicant.Serial=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $serallll);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) { 
		$REQUEST_ID =$row['REQUEST_ID'];
		$StatusID =$row['StatusID'];
		}
		
		//echo $REQUEST_ID;
		
	if($StatusID==10)
	{
		$s=11;
	}
	else if ($StatusID==11)
	{
		$s=12;
	}
	else if ($StatusID==12)
	{
		$s=12;
	}
		////////////////////////////////////////////////////////////////////
			$sql2 = "UPDATE `request` SET `StatusID` =? ,`karar` =? 

, `updated_date_karar`= ?
,`USER_ID`=?
,`user_role`=?
WHERE `REQUEST_ID` =?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("ssssss",$s,$txtes,$date,$myUSER_ID,$user_role,$REQUEST_ID);
//echo"ggggg";
$stmt2->execute();
$afrow2=$stmt2->affected_rows;
	
$datetimestatus =date("Y-m-d h:i:sa");

 if ($afrow2 > 0){
	 
	 $qlog="INSERT INTO `status_log`(`fk_request_id`,`fk_status_id` ,`fk_user_id`  ,`date` ) VALUES (?,?,?,?)";
$stmtlog = $con->prepare($qlog);
$stmtlog->bind_param("ssss", $REQUEST_ID,$s,$myUSER_ID,$datetimestatus);
$stmtlog->execute();
$afrowlog=$stmtlog->affected_rows; 
	 
	 if($afrowlog > 0){
		 
	//echo"<script>self.location='university_search.php'</script>";
	?>
	<div align="center" class="lggraytitle style1" style="margin-bottom:200px"> 
				   <p style="border:2px double"><strong> تم التعديل بنجاح </strong></p>
</div>
<?php	
	}	else { ?>
	<div align="center" class="lggraytitle style1" style="margin-bottom:200px"> 
				   <p style="border:2px double"><strong> حدث خطأ </strong></p>
</div>
	<?php
	
	 }
		
 }		
}		
else
{
		echo'
    <div align="center" class="style1" style="color:#FF0000">
        <h2>لا يمكن الرجوع لهذه الصفحة</h2>
		 </div>
         ';
}
?>

<?php

include("footer.php");
?>



</body>
</html>
	
