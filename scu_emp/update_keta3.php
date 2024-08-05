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
		
		$serallll=$_POST['serallll'];
		$STATUS_ID=$_POST['txtstatusid'];
		$reqid=$_POST['reqid'];
	//echo $reqid;
	$myUSER_ID=$_SESSION['myUSER_ID'];
	$txtstatusid=$_POST['txtstatusid'];
	$roleid=$_SESSION['roleid'];
	

	    $keta3=$_POST['keta3'];	
		//$fk_matlob=$_POST['dplgov'];
	//echo $txtstatusid;
	$dest=$_POST['destination'];
	
	
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
//////***************************************************************************file uploader*****************************************************************************************************************************************/////


 if($dest!="")
{ 
$destinationn_old=$_POST['destination'];


$ff=$_FILES['myfile']['name'];
//$ffff="";
$extinsion=".pdf";
$new="new";
$arname_temp="amne";
$filename=$arname_temp.$reqid.$new.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn_new = '../uploads/scu/'.$filename;
 $destinationn= '../uploads/scu/'.$filename;
  $destinationn_delete = '../uploads/delete/scu/'.$filename;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn_new)) //find old file
{
//echo "yes";
//unlink($destination);
 copy($destinationn_new, $destinationn_delete);
if(unlink($destinationn_new)) // delete old file
{
//echo"unlink";

$file = $_FILES['myfile']['tmp_name'];

if ( move_uploaded_file($file, $destinationn_new)) {


}
else
{
//echo"not uplood in destinamtion";
}
}
else
{
//echo"can not delete old one";
}
}
else
{//elfile not found
if ( move_uploaded_file($file, $destinationn_new)) {
}
else
{
//echo"not uplood in destinamtion";
}
}

}
/////////////////////////////////////////////////////////////////
else
{
$ff=$_FILES['myfile']['name'];
//$ffff="_";
$extinsion=".pdf";
$arname_temp="amen";
$filename=$arname_temp.$reqid .$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn = '../uploads/scu/'.$filename;
 $destinationn_deletee = '../uploads/delete/scu/'.$filename;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn)) //find old file
{
//echo "yes";
//unlink($destination);
copy($destinationn, $destinationn_deletee);
if(unlink($destinationn)) // delete old file
{
//echo"unlink";

$file = $_FILES['myfile']['tmp_name'];

if ( move_uploaded_file($file,$destinationn)) {

}
else
{
//echo"not uplood in destinamtion";
}
}
else
{
//echo"can not delete old one";
}
}
else
{//elfile not found
if ( move_uploaded_file($file,$destinationn)) {
}
else
{
//echo"not uplood in destinamtion";
}
}
}
//////////*******************************************************************************************************************************************************************************************************/ 

if($txtstatusid==2) // من تم المراجعه إلى تم اسناد لجنة قطاع
{
	$sql2 = "UPDATE `request` SET `StatusID` = 5 , `updated_date`= ?,`USER_ID`=? ,`fk_keta3`=? 
,`user_role`=?,`scu_destination`=?
WHERE `FK_Applicant_serial` =?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("ssssss",$date,$myUSER_ID,$keta3,$roleid,$destinationn,$serallll);
//echo"ggggg";
$stmt2->execute();
$afrow2=$stmt2->affected_rows;
	

	
	

$datetimestatus =date("Y-m-d h:i:sa");
 if ($afrow2 > 0){
	 
	$qlog="INSERT INTO `status_log`(`fk_request_id`,`fk_status_id` ,`fk_user_id`  ,`date` ) VALUES (?,?,?,?)";

$x='5';
$stmtlog = $con->prepare($qlog);
$stmtlog->bind_param("ssss", $reqid,$x,$myUSER_ID,$datetimestatus);
$stmtlog->execute();
$afrowlog=$stmtlog->affected_rows; 
	 
	 if($afrowlog > 0)
{
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
}
?>
<?php
echo '</div>';
include("footer.php");
?>



</body>
</html>
	
