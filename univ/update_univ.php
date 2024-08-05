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
    //echo "vvvvvv".$id;
    
    $arname_temp =$_POST['txtarname'];
		
	    $degree=$_POST['txtorg'];	
		$fk_matlob=$_POST['dplgov'];
		$serallll=$_POST['serallll'];
		$STATUS_ID=$_POST['txtstatusid'];
				$fk_degree=$_POST['degree'];
		//$reqid=$_POST['reqid'];
   
	$REQUEST_ID=$_POST['reqid'];
   // echo $REQUEST_ID.'x<br>';
    $REQUEST_ID = substr($REQUEST_ID, 0, -1); // To Delete Last Space
    //echo $REQUEST_ID.'xx<br>';
    
	$myUSER_ID=$_SESSION['myUSER_ID'];
	$txtstatusid=$_POST['txtstatusid'];
	$roleid=$_SESSION['roleid'];
		$univ_destination=$_POST['univ_destination'];
	$univ_emkanyat=$_POST['univ_emkanyat'];
	$univ_gadwa=$_POST['univ_gadwa'];

	
	
	
	$date = date('Y-m-d h:i:s');
    	//echo $date;
	//echo"<br>";
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


           
///////////////////////////////////////////////////////////////////////////
       
if ($univ_destination != "")
{
	

$ff=$_FILES['myfile']['name'];
//echo "jjjee".$ff;
	//exit(0);
 if($ff == "")
 {
	// echo"ggg";
    $destination_new = $_POST['univ_destination'];
	
 }
else{

	
$destination_old=$_POST['univ_destination'];
$destination_old=$_POST['univ_destination'];

    //echo $destination_old;
//$ffff="_";
$extinsion=".pdf";
//$new="new";
//$file_name_new=$REQUEST_ID.$ffff.$ssn.$new.$extinsion;
     $filename=$arname_temp.$REQUEST_ID.$extinsion;
     $destination_new = '../uploads/univ/'.$filename;
	 $destinationn_delete = '../uploads/delete/univ/'.$filename;
     //$namefile_database ='../uploads/univ/'.$arname_temp.$REQUEST_ID.$extinsion;
    //echo $destination_new;
    $file = $_FILES['myfile']['tmp_name'];
    //echo $file;
    if(file_exists($destination_old))
    {
		 
		 copy($destination_old, $destinationn_delete);
		 
        if(unlink($destination_old)) // delete old file
{
//echo"unlink";

if( move_uploaded_file($file, $destination_new)) {

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
if ( move_uploaded_file($file, $destination_new)) {
}
else
{
//echo"not uplood in destinamtion";
}
 }   
}
}    
    
    
    
//////////////////////////////////////////////////////////////////////////////////////////
if ($univ_emkanyat != "")
{
$fff=$_FILES['univ_emkanyat']['name'];
 if($fff == "")
 {
	// echo"ggg";
    $destination_univ_emkanyat_new = $_POST['univ_emkanyat'];
 }
else{
$destination_old_univ_emkanyat=$_POST['univ_emkanyat'];
$destination_old_univ_emkanyat=$_POST['univ_emkanyat'];
    //echo $destination_old;
//$ffff="_";
$extinsion=".pdf";
$emkanyat="emkanyat";
//$file_name_new=$REQUEST_ID.$ffff.$ssn.$new.$extinsion;
     $filename=$arname_temp.$REQUEST_ID.$emkanyat.$extinsion;
     $destination_univ_emkanyat_new = '../uploads/univ/'.$filename;
     //$namefile_database ='../uploads/univ/'.$arname_temp.$REQUEST_ID.$extinsion;
    //echo $destination_new;
	 $destination_univ_emkanyat_delete = '../uploads/delete/univ/'.$filename;
    $file = $_FILES['univ_emkanyat']['tmp_name'];
    //echo $file;
    if(file_exists($destination_old_univ_emkanyat))
    {
		 copy($destination_old_univ_emkanyat, $destination_univ_emkanyat_delete);
        if(unlink($destination_old_univ_emkanyat)) // delete old file
{
//echo"unlink";

if( move_uploaded_file($file, $destination_univ_emkanyat_new)) {

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
if ( move_uploaded_file($file, $destination_univ_emkanyat_new)) {
}
else
{
//echo"not uplood in destinamtion";
}
 }   
}
}   
//////////////////////////////////////////////////////////////////////////////////////////
if ($univ_gadwa != "")
{
$ffff=$_FILES['univ_gadwa']['name'];
 if($ffff == "")
 {
	// echo"ggg";
    $destination_univ_gadwa_new = $_POST['univ_gadwa'];
 }
else{
$destination_old_univ_gadwa=$_POST['univ_gadwa'];
$destination_old_univ_gadwa=$_POST['univ_gadwa'];
    //echo $destination_old;
//$ffff="_";
$extinsion=".pdf";
$gadwa="gadwa";
//$file_name_new=$REQUEST_ID.$ffff.$ssn.$new.$extinsion;
     $filename=$arname_temp.$REQUEST_ID.$gadwa.$extinsion;
     $destination_univ_gadwa_new = '../uploads/univ/'.$filename;
	 $destination_univ_gadwa_deleted = '../uploads/delete/univ/'.$filename;
     //$namefile_database ='../uploads/univ/'.$arname_temp.$REQUEST_ID.$extinsion;
    //echo $destination_new;
    $file = $_FILES['univ_gadwa']['tmp_name'];
    //echo $file;
    if(file_exists($destination_old_univ_gadwa))
    {
		 copy($destination_old_univ_gadwa, $destination_univ_gadwa_deleted);
        if(unlink($destination_old_univ_gadwa)) // delete old file
{
//echo"unlink";

if( move_uploaded_file($file, $destination_univ_gadwa_new)) {

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
if ( move_uploaded_file($file, $destination_univ_gadwa_new)) {
}
else
{
//echo"not uplood in destinamtion";
}
 }   
}
}   
//////////////////////////////    
    $afrow11=0;
    $afrow22=0;
    $afrow33=0;
 $log_status=0; 
 
if($txtstatusid==1)
{
	$sql11 = "UPDATE `request` SET `StatusID` = 13 , `updated_date`= ?,`USER_ID`=?
,`user_role`=?,`univ_destination`=?,`univ_emkanyat`=?,`univ_gadwa`=?
WHERE `FK_Applicant_serial` =?";
$stmt11 = $con->prepare($sql11);
$stmt11->bind_param("sssssss",$date,$myUSER_ID,$roleid,$destination_new,$destination_univ_emkanyat_new,$destination_univ_gadwa_new,$serallll);
//echo"ggggg1";
$stmt11->execute();
$afrow11=$stmt11->affected_rows;
  //  echo $afrow11;
 $log_status=13; 

}

if($txtstatusid==3)
{
	 $log_status=4; 
	$sql22 = "UPDATE `request` SET `StatusID` = 4 , `updated_date`= ?,`USER_ID`=?
,`user_role`=?,`univ_destination`=?,`univ_emkanyat`=?,`univ_gadwa`=?
WHERE `FK_Applicant_serial` =?";
$stmt22 = $con->prepare($sql22);
$stmt22->bind_param("sssssss",$date,$myUSER_ID,$roleid,$destination_new,$destination_univ_emkanyat_new,$destination_univ_gadwa_new,$serallll);
//echo"ggggg2";
$stmt22->execute();
$afrow22=$stmt22->affected_rows;
//	echo $afrow22;
}

if($txtstatusid==8)
{
	 $log_status=9; 
	$sql33 = "UPDATE `request` SET `StatusID` = 9 , `updated_date`= ?,`USER_ID`=?
,`user_role`=?,`univ_destination`=?,`univ_emkanyat`=?,`univ_gadwa`=?
WHERE `FK_Applicant_serial` =?";
$stmt33 = $con->prepare($sql33);
$stmt33->bind_param("sssssss",$date,$myUSER_ID,$roleid,$destination_new,$destination_univ_emkanyat_new,$destination_univ_gadwa_new,$serallll);
//echo"ggggg3";
$stmt33->execute();
$afrow33=$stmt33->affected_rows;
	//echo $afrow33;
}

$datetimestatus =date("Y-m-d h:i:sa");

if($txtstatusid==13)
{
	 $log_status=13; 
	$sql33 = "UPDATE `request` SET `StatusID` = 13 , `updated_date`= ?,`USER_ID`=?
,`user_role`=?,`univ_destination`=?,`univ_emkanyat`=?,`univ_gadwa`=?
WHERE `FK_Applicant_serial` =?";
$stmt33 = $con->prepare($sql33);
$stmt33->bind_param("sssssss",$date,$myUSER_ID,$roleid,$destination_new,$destination_univ_emkanyat_new,$destination_univ_gadwa_new,$serallll);
//echo"ggggg3";
$stmt33->execute();
$afrow33=$stmt33->affected_rows;
	//echo $afrow33;
}

$qlog="INSERT INTO `status_log`(`fk_request_id`,`fk_status_id` ,`fk_user_id`  ,`date` ) VALUES (?,?,?,?)";

$x='1';
$stmtlog = $con->prepare($qlog);
$stmtlog->bind_param("ssss", $REQUEST_ID,$log_status,$myUSER_ID,$datetimestatus);
$stmtlog->execute();
$afrowlog=$stmtlog->affected_rows;
	
if($afrowlog > 0)
{

	$sql = "UPDATE `applicant` SET `degree` =?
, `FK_matlob`=? 
, `edit_Date`= ?
,`USER_ID`=?
,`fk_degree`=?

WHERE `Serial` =?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssss",$degree,$fk_matlob,$date,$myUSER_ID,$fk_degree,$serallll);
//echo"ggggg4";
$stmt->execute();
$afrow=$stmt->affected_rows;
	
//echo $afrow;

 if (($afrow > 0 && $afrow11 > 0) || ($afrow > 0 && $afrow22 > 0) || ($afrow > 0 && $afrow33 > 0)){
	 
	 
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
	
