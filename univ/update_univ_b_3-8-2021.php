<?php
include_once("header.php");
?>
<div align="center" class="style2" dir="rtl" style="color:#000000" >
<!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله 
</h2>-->
</div>

<body>

<?php 

echo '<div id="tit">';
?>
	<?php



if (isset($_POST['btnedit'])) 
{
	  if(!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
                    http_response_code(403);
                    die('');
                    exit;
                }
				
		$id =$_POST['id'];
		
	    $degree=$_POST['txtorg'];	
		$fk_matlob=$_POST['dplgov'];
		$serallll=$_POST['serallll'];
		$STATUS_ID=$_POST['txtstatusid'];
		$reqid=$_POST['reqid'];
	
	$myUSER_ID=$_SESSION['myUSER_ID'];
	$txtstatusid=$_POST['txtstatusid'];
	$roleid=$_SESSION['roleid'];
		$univ_destination=$_POST['univ_destination'];
	

	//echo $txtstatusid;
	
	
	$date = date('Y-m-d');
/*	
	echo $degree;
	echo"<br>";
		echo $fk_matlob;
	echo"<br>";
		echo $date;
	echo"<br>";
		echo $myUSER_ID;
	echo"<br>";
		echo $serallll;
	echo"<br>";
*/	
//////////////////////////////////////////////////////	
 
if($txtstatusid==1)
{
	$sql2 = "UPDATE `request` SET `StatusID` = 1 , `updated_date`= ?,`USER_ID`=?
,`user_role`=?
WHERE `FK_Applicant_serial` =?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("ssss",$date,$myUSER_ID,$roleid,$serallll);
//echo"ggggg";
$stmt2->execute();
$afrow2=$stmt2->affected_rows;
	
}

if($txtstatusid==3)
{
	$sql2 = "UPDATE `request` SET `StatusID` = 4 , `updated_date`= ?,`USER_ID`=?
,`user_role`=?
WHERE `FK_Applicant_serial` =?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("ssss",$date,$myUSER_ID,$roleid,$serallll);
//echo"ggggg";
$stmt2->execute();
$afrow2=$stmt2->affected_rows;
	
}

if($txtstatusid==8)
{
	$sql2 = "UPDATE `request` SET `StatusID` = 9 , `updated_date`= ?,`USER_ID`=?
,`user_role`=?
WHERE `FK_Applicant_serial` =?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("ssss",$date,$myUSER_ID,$roleid,$serallll);
//echo"ggggg";
$stmt2->execute();
$afrow2=$stmt2->affected_rows;
	
}


	$sql2 = "UPDATE `applicant` SET `degree` =?
, `FK_matlob`=? 
, `edit_Date`= ?
,`USER_ID`=?
WHERE `Serial` =?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("sssss",$degree,$fk_matlob,$date,$myUSER_ID,$serallll);
//echo"ggggg";
$stmt2->execute();
$afrow2=$stmt2->affected_rows;
	


 if ($afrow2 > 0){
	 
	 
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
?>
<?php
echo '</div>';
include("footer.php");
?>



</body>
</html>
	
