<?php
include_once("header.php");
?>
<div align="center" class="style2" dir="rtl" style="color:#000000">
    <!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله 
</h2>-->
</div>

<body>

    <?php 

echo '<div id="tit">';
?>
    <?php

		
	//$serallll=$_GET['id']; //app_serial
	$serallll=$_POST['id']; //app_serial
	$reqid=$_POST['reqid'];
	$myUSER_ID=$_SESSION['myUSER_ID'];
	$roleid=$_SESSION['roleid'];
	$fk_mo3adla=2;
	$matlob_ID = $_POST['matlob_ID'];
   $accept_dest = $_FILES['accept_dest']['name'];

		if($accept_dest == ""){
			$accept_destinationn = "";
	}else{
		

				$ff=$_FILES['accept_dest']['name'];		
$extinsion=".pdf";
$emp_accept="emp_accept";
$filename=$emp_accept.$reqid.$extinsion;
$accept_destinationn = '../uploads/scu/'.$filename;
$accept_destinationn_delete = '../delete/scu/'.$filename;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['accept_dest']['tmp_name'];

if(file_exists($accept_destinationn)) //find old file
{
//echo "yes";
//unlink($destination);
move_uploaded_file($file, $accept_destinationn_delete);
if(unlink($accept_destinationn)) // delete old file
{
//echo"unlink";

$file = $_FILES['accept_dest']['tmp_name'];

if ( move_uploaded_file($file,$accept_destinationn)) {

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
if ( move_uploaded_file($file,$accept_destinationn)) {
}
else
{
//echo"not uplood in destinamtion";
}
}
		}	
	 //   $keta3=$_POST['txtreq'];	
		
	
	
	$date = date('Y-m-d');
/*	
	echo $date;
	echo"<br>";
		echo $myUSER_ID;
	echo"<br>";
		echo $keta3;
	echo"<br>";
		echo $roleid;
	echo"<br>";
		echo $serallll;
	echo"<br>";
*/	
//////////////////////////////////////////////////////	
//////***************************************************************************file uploader*****************************************************************************************************************************************/////

if($matlob_ID == 4){
	$destinationn ="";
}else{
	
$dest=$_POST['destination_mozakera'];
 if($dest!="")
{ 
$destinationn_old=$_POST['destination'];
$ff=$_FILES['myfile']['name'];
//$ffff="";
$extinsion=".pdf";
$new="new";
$arname_temp="mozakera";
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
$arname_temp="mozakera";
$filename=$arname_temp.$reqid.$extinsion;
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
}
//////////*******************************************************************************************************************************************************************************************************/ 

 
//echo $txtstatusid;
if( $txtstatusid = '9' || $txtstatusid='6'|| $txtstatusid = '7' ) // 
{
	//echo"ggggggghhhhh";
	
		$q="SELECT `REQUEST_ID` from request where `FK_Applicant_serial`=? ";

	
	//echo $q; 
	// $con->set_charset("utf8");
	  $stmt = $con->prepare($q);
		/* Execute statement */
	  
	  $stmt->bind_param('s',$serallll);
	
		$stmt->execute();
		$res = $stmt->get_result();
		$n =$stmt->affected_rows;
//echo '--------------------------------------'.$n;
		
		if($row = $res->fetch_array(MYSQLI_ASSOC)) 
		{
			$REQUEST_ID=$row['REQUEST_ID'];
			
		}
		
		
	
	$sql2 = "UPDATE `request` SET `StatusID` = 10 , `updated_date_mo3adalat`= ?,`USER_ID`=? ,`fk_mo3adla`=? ,`user_role`=? ,`mozakera_dest`=?,`accept_dest`=? WHERE `FK_Applicant_serial` =?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("sssssss",$date,$myUSER_ID,$fk_mo3adla,$roleid,$destinationn,$accept_destinationn,$serallll);
//echo"ggggg";
$stmt2->execute();
$afrow2=$stmt2->affected_rows;
	 
	 $datetimestatus =date("Y-m-d h:i:sa");
 if ($afrow2 > 0){
	 
	$status_id=10; 
 //echo $afrow;
 //// create user session 
 //echo $reqid;
	$qlog="INSERT INTO `status_log`(`fk_request_id`,`fk_status_id` ,`fk_user_id`  ,`date` ) VALUES (?,?,?,?)";
$stmtlog = $con->prepare($qlog);
$stmtlog->bind_param("ssss", $REQUEST_ID,$status_id,$myUSER_ID,$datetimestatus);
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


?>
    <?php
echo '</div>';
include("footer.php");
?>



</body>

</html>