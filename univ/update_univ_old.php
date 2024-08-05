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
		//$reqid=$_POST['reqid'];
   
	$REQUEST_ID=$_POST['reqid'];
   // echo $REQUEST_ID.'x<br>';
    $REQUEST_ID = substr($REQUEST_ID, 0, -1); // To Delete Last Space
    //echo $REQUEST_ID.'xx<br>';
    
	$myUSER_ID=$_SESSION['myUSER_ID'];
	$txtstatusid=$_POST['txtstatusid'];
	$roleid=$_SESSION['roleid'];
		$univ_destination=$_POST['univ_destination'];
	

	//echo $txtstatusid;
	
	
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
    
 /*   
if($univ_destination!="")
{
    //$destinationn_old=$_POST['univ_destination'];
    $ff=$_FILES['myfile']['name'];
    $extinsion=".pdf";    
    $filename=$arname_temp.$REQUEST_ID.$extinsion;
     // $destinationn_new = '../uploads/univ/'.$filename;
      $destinationn= '../uploads/univ/'.$filename;
    
    //echo $_FILES['myfile']['tmp_name'];
    $namefile_database ='../uploads/univ/'.$arname_temp.$REQUEST_ID.$extinsion;
    
    
    if(file_exists($univ_destination)) //find old file
    {
         $file = $_FILES['myfile']['tmp_name'];
        //if($file !="")
        if(is_file($file))
        {
        unlink($univ_destination);
       
        move_uploaded_file($file, $univ_destination);
         }
        else
        {
            
        }
    }
    else
    {
        
    }
}
    
    ////////////// 
    
else
{
    $ff=$_FILES['myfile']['name'];
    $extinsion=".pdf";    
    $filename=$arname_temp.$RequestID.$extinsion;
    $univ_destination = '../uploads/univ/'.$filename; 
    $namefile_database ='../uploads/univ/'.$arname_temp.$REQUEST_ID.$extinsion;
    move_uploaded_file($file,$univ_destination);   
} 
*/

    
    
    
if ($univ_destination != "")
{
$ff=$_FILES['myfile']['name'];
 if($ff == "")
 {
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
     //$namefile_database ='../uploads/univ/'.$arname_temp.$REQUEST_ID.$extinsion;
    //echo $destination_new;
    $file = $_FILES['myfile']['tmp_name'];
    //echo $file;
    if(file_exists($destination_old))
    {
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
    /*
 if($univ_destination!="")
{ 
$destinationn_old=$_POST['univ_destination'];


$ff=$_FILES['myfile']['name'];
$extinsion=".pdf";
$new="new";
     

     
$filename=$arname_temp.$REQUEST_ID.$new.$extinsion;
    $destinationn_new = '../uploads/univ/'.$filename;
 $destinationn= '../uploads/univ/'.$filename;
     
      $namefile_database ='../uploads/univ/'.$arname_temp.$REQUEST_ID.$extinsion;
 
    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn_new)) //find old file
{
//echo "yes";
//unlink($destination);
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
/*    
////////////////////////////////////
elseif($univ_destination!="" && $txtstatusid==1)
{
$ff=$_FILES['myfile']['name'];
//$ffff="_";
$extinsion=".pdf";
$filename=$arname_temp.$requestid .$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn = '../uploads/univ/'.$filename;

    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn)) //find old file
{
//echo "yes";
//unlink($destination);
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
  */  
/////////////////////////////////////////////////////////////////
/*    
else
{
$ff=$_FILES['myfile']['name'];
//$ffff="_";
$extinsion=".pdf";
$filename=$arname_temp.$REQUEST_ID.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn = '../uploads/univ/'.$filename;

     $namefile_database ='../uploads/univ/'.$arname_temp.$REQUEST_ID.$extinsion;
     //echo $namefile_database;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn)) //find old file
{
//echo "yes";
//unlink($destination);
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

*/    


//////////////////////////////    
    $afrow11=0;
    $afrow22=0;
    $afrow33=0;
 
if($txtstatusid==1)
{
	$sql11 = "UPDATE `request` SET `StatusID` = 1 , `updated_date`= ?,`USER_ID`=?
,`user_role`=?,`univ_destination`=?
WHERE `FK_Applicant_serial` =?";
$stmt11 = $con->prepare($sql11);
$stmt11->bind_param("sssss",$date,$myUSER_ID,$roleid,$destination_new,$serallll);
//echo"ggggg1";
$stmt11->execute();
$afrow11=$stmt11->affected_rows;
  //  echo $afrow11;
	
}

if($txtstatusid==3)
{
	$sql22 = "UPDATE `request` SET `StatusID` = 4 , `updated_date`= ?,`USER_ID`=?
,`user_role`=?,`univ_destination`=?
WHERE `FK_Applicant_serial` =?";
$stmt22 = $con->prepare($sql22);
$stmt22->bind_param("sssss",$date,$myUSER_ID,$roleid,$destination_new,$serallll);
//echo"ggggg2";
$stmt22->execute();
$afrow22=$stmt22->affected_rows;
//	echo $afrow22;
}

if($txtstatusid==8)
{
	$sql33 = "UPDATE `request` SET `StatusID` = 9 , `updated_date`= ?,`USER_ID`=?
,`user_role`=?,`univ_destination`=?
WHERE `FK_Applicant_serial` =?";
$stmt33 = $con->prepare($sql33);
$stmt33->bind_param("sssss",$date,$myUSER_ID,$roleid,$destination_new,$serallll);
//echo"ggggg3";
$stmt33->execute();
$afrow33=$stmt33->affected_rows;
	//echo $afrow33;
}


	$sql = "UPDATE `applicant` SET `degree` =?
, `FK_matlob`=? 
, `edit_Date`= ?
,`USER_ID`=?
WHERE `Serial` =?";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssss",$degree,$fk_matlob,$date,$myUSER_ID,$serallll);
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
?>
<?php
echo '</div>';
include("footer.php");
?>



</body>
</html>
	
