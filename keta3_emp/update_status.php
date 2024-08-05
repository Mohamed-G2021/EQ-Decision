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


//id is request_id
$id=$_GET['id'];
	
	
	$myUSER_ID=$_SESSION['myUSER_ID'];
		$roleid=$_SESSION['roleid'];

	
	$date = date('Y-m-d');

//from 1 to 2
$status_id=2;
//////////////////////////////////////////////////////	

	$sql2 = "UPDATE `request` SET `StatusID` =?

, `updated_date`= ?
,`USER_ID`=?
,`user_role`=?
WHERE `REQUEST_ID` =?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("sssss",$status_id,$date,$myUSER_ID,$roleid,$id);
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
					




?>
<?php
echo '</div>';
include("footer.php");
?>



</body>
</html>
	
