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

$status_id=3;
		
///////////////////////////////////////////////////////////
	
	$sql = 'SELECT distinct `REQUEST_ID` FROM `request`,applicant
where request.FK_Applicant_serial=applicant.Serial
and applicant.Serial=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $serallll);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) { $REQUEST_ID =$row['REQUEST_ID'];}
		
		//echo $REQUEST_ID;
		
	
		////////////////////////////////////////////////////////////////////
			$sql2 = "UPDATE `request` SET `StatusID` =? ,`estefa2` =? 

, `updated_date`= ?
,`USER_ID`=?
,`user_role`=?
WHERE `REQUEST_ID` =?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("ssssss",$status_id,$txtes,$date,$myUSER_ID,$user_role,$REQUEST_ID);
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
	
