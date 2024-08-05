<?php 
include_once("header.php");
?>
	<?php
if (isset($_POST['btneditvalues'])){
$REQUEST_ID =$_POST['txtreq'];
    $REQUEST_ID = stripslashes($REQUEST_ID);
$myUSER_ID=$_SESSION['myUSER_ID'];    
//echo $myUSER_ID;
$Serial=$_POST['txtSerial'];
    $Serial = stripslashes($Serial);
	//echo $Serial;
    $updated_date_keta3=date('Y-m-d');

///////////////////// end sector id
$destinationn=$_POST['destinationn'];

/////////////////////////////
$keta3_id=$_SESSION['keta3_id'];
//////////////////////////////////////////

//$ffff="_";
$extinsion=".pdf";
$new="new";
$file_name_new=$REQUEST_ID.$new.$extinsion;
//echo "destinationn post".$destinationn;
//$ffff="_";
$extinsion=".pdf";
//$new="new";
$filename=$REQUEST_ID.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn2 = '../uploads/'.$filename;
    $destinationn3 = '../uploads/'.$filename;
	//echo"destinationn2".$destinationn2;
	if($destinationn==$destinationn2)
	{ //echo"destinationn==destinationn2";
	}
	else
	{
 //echo"destinationn!=destinationn2";
//echo "yes";
//unlink($destination);
if(unlink($destinationn2)) // delete old file
{ //echo "unlink";
if(file_exists($destinationn))
{
if(rename($destinationn,'../uploads/'.$filename))
{
//echo "remaned";
}
}
}

}
/*
echo $keta3_id;
echo "<br>";

echo $destinationn2;
echo "<br>";

echo $updated_date_keta3;
echo "<br>";

echo $Serial;
echo "<br>";
*/

$u="UPDATE `request` SET `StatusID`=6
,`fk_keta3`=?,`destination`=?,`updated_date_keta3`=?
WHERE request.`FK_Applicant_serial`=?";

$stmt = $con->prepare($u);
$stmt->bind_param("ssss",$keta3_id,$destinationn2,$updated_date_keta3,$Serial);
$stmt->execute();
$afrow=$stmt->affected_rows;
////////////////////////////////////////////////////////////////////
/*echo "gov".$gov;
echo "sectorid".$sectorid;
echo  "Serial".$Serial;
*/
//echo "destinationn".$destinationn;


$datetimestatus =date("Y-m-d h:i:sa");
 //echo $afrow;
 if ($afrow > 0 ){
 //// create user session 
 
	$qlog="INSERT INTO `status_log`(`fk_request_id`,`fk_status_id` ,`fk_user_id`  ,`date` ) VALUES (?,?,?,?)";

$x='6';
$stmtlog = $con->prepare($qlog);
$stmtlog->bind_param("ssss", $REQUEST_ID,$x,$myUSER_ID,$datetimestatus);
$stmtlog->execute();
$afrowlog=$stmtlog->affected_rows; 
	 
	 if($afrowlog > 0){

  echo '<div id="myDiv" align="center" class="style1" style="color:#67C404;"  >
        <h2> لقد تم رفع التقرير للطلب رقم <u>' . $REQUEST_ID.'</u> </h2>
    
  </div>';

  

} //end afrow 
// if afrow insert app
else{
$errorr=' <div align="center" class="style1" style="color:#FF0000">
                
        <h2>لم  تقوم بتعديل شىء </h2>
      
		 </div>';
    echo $errorr;
	;
} //num_id
 }
}else{

echo"<script>self.location='index.php'</script>"; 
} // end if submit
?>
<?php 
include_once("footer.php");
?>