<script>
function printfn() {
    window.print();
}
</script>

<style type="text/css">
<!--
.style1 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
}
.style2 {font-family: "Times New Roman", Times, serif}
.style3 {font-weight: bold}
.style4 {font-weight: bold}
-->
</style>
<?php
include_once("header.php");
?>
<?php 
//session_start();
include_once("../include/connection.php");

if (isset($_POST['btnregister'])){

    if(!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
                    http_response_code(403);
                    die('');
                    exit;
                }
$arname_temp =$_POST['txtarname'];
$arname = stripslashes($arname_temp); 

$gov = $_POST['dplgov'];
$gov = stripslashes($gov);

$org_temp = $_POST['txtorg'];
$org = stripslashes($org_temp);


$degree =$_POST['degree'];
$degree = stripslashes($degree); 

$myUSER_ID=$_SESSION['myUSER_ID'];

$regdate = date('Y-m-d');

$user_role=$_SESSION['roleid'];
$dest=$_POST['destination'];
//echo "dest".$dest;
//$univ_emkanyat_destination=$_POST['univ_emkanyat_destination'];
//echo "univ_emkanyat_destination". $$univ_emkanyat_destination;
//$univ_gadwa_destination=$_POST['univ_gadwa_destination'];

$x=1;
$acknowledgement='0';

///////////////////////////////////////////////////////
//********************************************//

$degreequery ="SELECT `name` FROM `degree` WHERE `id`= ?";
$stmt = $con->prepare($degreequery);
	
  $stmt->bind_param('s', $degree);
		$stmt->execute();
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $degreeName =$row['name'];
		}
	

//********************************************//

$govquery ="SELECT `matlob_NAME` FROM `matlob` WHERE `matlob_ID`= ?";
$stmt = $con->prepare($govquery);
	
  $stmt->bind_param('s', $gov);
		$stmt->execute();
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $govName =$row['matlob_NAME'];
	
		   }
	

//**********************************************************//
///////////// create requestID/////////////////////
$date = date("Y-m-d"); //current date

$queryC ="SELECT count( * ) as c FROM `request` WHERE `CreationDate` = ?";
$stmt = $con->prepare($queryC);
	
  $stmt->bind_param('s', $date);
		$stmt->execute();
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {

		   $CountTodayRequest =$row['c'];
	
		   } 
if ($CountTodayRequest == 0)
		   {
		   $date = date("Y-m-d"); 
			//echo $date."<br>";
			$year =date("Y");
			//echo $year."<br>";
			$month =date("m");
			//echo $month."<br>";
			$day = date("d");
			//echo $day."<br>";
			$requestid = $year.$month.$day."1" ; 
			//echo $requestid."<br />";
		   } // end if c = 0 
		   else // $CountTodayRequest not equal zero 
		   {
		   //echo "else";
		  // $querymax = mysql_query("SELECT max( REQUEST_ID ) as reqid FROM `request` WHERE `CreationDate` = '".$date."' ");
		  
$querymax ="SELECT max( REQUEST_ID ) as reqid FROM `request` WHERE `CreationDate` = ?";
$stmt = $con->prepare($querymax);
		/* Execute statement */
  $stmt->bind_param('s', $date);
		$stmt->execute();
		$res = $stmt->get_result();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   
		 //  while($row = mysql_fetch_array($querymax)){
		   $requestID =$row['reqid'];
		   
		   //echo $requestID."requestID"."<br />";
		   $requestpart1 = substr($requestID,0,8);
		   //echo $requestpart1."requestpart1"."<br />";
		   $requestpart2 = substr($requestID,8,9);
		  // echo "requestpart2".$requestpart2."<br />";
		   $requestNo=$requestpart2+1;
		   $requestid = $requestpart1.$requestNo;
		  // echo $requestid."<br />";

		   } // end while
		
		   }// end else
////////////////////////////////////////////////////////////////////////////////


 if($dest!="")
{ 
$destinationn_old=$_POST['destination'];


$ff=$_FILES['myfile']['name'];
//$ffff="";
$extinsion=".pdf";
$new="new";
$filename=$arname_temp.$requestid.$new.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn_new = '../uploads/univ/'.$filename;
	$destinationn_delete = '../uploads/delete/univ/'.$filename;
 $destinationn= '../uploads/univ/'.$filename;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn_new)) //find old file
{
//echo "yes";
//unlink($destination);
move_uploaded_file($file, $destinationn_delete);
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
$filename=$arname_temp.$requestid.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn = '../uploads/univ/'.$filename;
$destinationn_delete = '../uploads/delete/univ/'.$filename;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn)) //find old file
{
//echo "yes";
//unlink($destination);
move_uploaded_file($file, $destinationn_delete);
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


//////////////////////////////


 
$ff=$_FILES['univ_emkanyat']['name'];
//$ffff="_";
$extinsion=".pdf";
$univ_emkanyat="univ_emkanyat";
$filename=$arname_temp.$requestid.$univ_emkanyat.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn_univ_emkanyat = '../uploads/univ/'.$filename;

    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['univ_emkanyat']['tmp_name'];

if(file_exists($destinationn_univ_emkanyat)) //find old file
{
//echo "yes";
//unlink($destination);
if(unlink($destinationn_univ_emkanyat)) // delete old file
{
//echo"unlink";

$file = $_FILES['univ_emkanyat']['tmp_name'];

if ( move_uploaded_file($file,$destinationn_univ_emkanyat)) {

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
if ( move_uploaded_file($file,$destinationn_univ_emkanyat)) {
}
else
{
//echo"not uplood in destinamtion";
}
}


/////////////////////////////////////////////////////////////////


//////////////////////////////


 
$ff=$_FILES['univ_gadwa']['name'];
//$ffff="_";
$extinsion=".pdf";
$univ_gadwa="univ_gadwa";
$filename=$arname_temp.$requestid.$univ_gadwa.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn_univ_gadwa = '../uploads/univ/'.$filename;

    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['univ_gadwa']['tmp_name'];

if(file_exists($destinationn_univ_gadwa)) //find old file
{
//echo "yes";
//unlink($destination);
if(unlink($destinationn_univ_gadwa)) // delete old file
{
//echo"unlink";

$file = $_FILES['univ_gadwa']['tmp_name'];

if ( move_uploaded_file($file,$destinationn_univ_gadwa)) {

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
if ( move_uploaded_file($file,$destinationn_univ_gadwa)) {
}
else
{
//echo"not uplood in destinamtion";
}
}


/////////////////////////////////////////////////////////////////


//////////////////////////////


	$q=" INSERT INTO `applicant`(`univ_id` ,`fk_degree`,`degree` ,`user_id`, `user_role`, `FK_matlob` ,`registerd_Date`) VALUES (?,?,?,?,?,?,?)";

$stmt = $con->prepare($q);
$stmt->bind_param("sssssss", $arname,$degree, $org, $myUSER_ID, $user_role ,$gov, $regdate);
$stmt->execute();
$afrow=$stmt->affected_rows;

if ($afrow > 0){
	//echo "insrted to app";
	//////////////////////////////////////////////////serial of app/////////////////////////////////////
	$serial =0;
 $q_max_app="SELECT max( serial ) AS serial FROM `applicant`";
$stmt_max_app = $con->prepare($q_max_app);
		$stmt_max_app->execute();
		$res_max_app = $stmt_max_app->get_result();
		 //$serial =0;
		if($row_max_app = $res_max_app->fetch_array(MYSQLI_ASSOC))
		{
					   $serial =$row_max_app['serial'];	   
		}




/*
echo $requestid;
echo "<br>";
echo $x;echo "<br>";
echo $date;echo "<br>";
echo $serial;echo "<br>";
echo $destinationn;echo "<br>";
*/





$q="INSERT INTO `request`(`REQUEST_ID`,`StatusID`  ,`CreationDate` ,`FK_Applicant_serial`,`univ_destination`,`univ_emkanyat`,`univ_gadwa`,`user_id`, `user_role` , `acknowledgement` )
VALUES (?,?,?,?,?,?,?,?,?,?)";

// $x='1';
$stmt = $con->prepare($q);
$stmt->bind_param("ssssssssss", $requestid,$x,$date,$serial,$destinationn,$destinationn_univ_emkanyat,$destinationn_univ_gadwa,$myUSER_ID, $user_role,$acknowledgement);
$stmt->execute();
$afrow=$stmt->affected_rows;

 //echo "affected_rows  " . $afrow;
 if ($afrow > 0){
 //// create user session 
// $_SESSION['FULLNAME'] =$arname;
// $_SESSION['NATIONAL_ID'] =$ssn;
// $_SESSION['BIRTH_DATE']=$BD;
// $_SESSION['Region_DATE']=$center;
// $_SESSION['Address']=$address;
// $_SESSION['TELEPHONE']=$mobile;
// $_SESSION['EMAIL_ADDRESS']=$mail;
// $_SESSION['Qualification_Date'] = $qualdate;
// $_SESSION['Specialization']=$spec;
// $_SESSION['School']=$certificate;
// $_SESSION['Card_Issuer']=$org;
// $_SESSION['Card_Issuer_date']=$cardIssuerdate;
// $_SESSION['registerd_Date']=$regdate;
// $_SESSION['FK_governate']=$gov;
// $_SESSION['matlob_NAME']=$govName;
// $_SESSION['Qualification_NAME']=$qualName;
// $_SESSION['FK_Qualification_ID']=$qualification;
// $_SESSION['school_address']=$certaddress;
// $_SESSION['REQUEST_ID']= $requestid ;
// $_SESSION['CreationDate']=$date;
// $_SESSION['FK_moodle'] ='1';
// $_SESSION['moodle_name']='المسابقة المركزية' ;
// $_SESSION['sectorid']=$sectorid;
  $datetimestatus =date("Y-m-d h:i:sa");


$qlog="INSERT INTO `status_log`(`fk_request_id`,`fk_status_id` ,`fk_user_id`  ,`date` ) VALUES (?,?,?,?)";

$x='1';
$stmtlog = $con->prepare($qlog);
$stmtlog->bind_param("ssss", $requestid,$x,$myUSER_ID,$datetimestatus);
$stmtlog->execute();
$afrowlog=$stmtlog->affected_rows;

if($afrowlog > 0)
{


echo'<div id="myDiv" align="center" class="style1" style="color:green;"  >
        <h3>  لقد تم التسجيل بنجاح لرقم طلب 
		
		<u> "'.$requestid .'" </u> 
		ويرجى الاحتفاظ به لاستخدامه لاحقا 
		</h3>
     <br>
	 <br>';
     ?>

    <?php
     echo '
  </div>
	';
}
else
{
	$errorr=' <div align="center" class="style1" style="color:#FF0000">
                          <h2>لم يتم الادخال </h2>
	
     
		 </div>';
    echo $errorr;
	;
}
}
}else{
$errorr=' <div align="center" class="style1" style="color:#FF0000">
                          <h2>لم يتم الادخال </h2>
	
     
		 </div>';
    echo $errorr;
	;
}

 // end else if rowNo 0


} // end if submit
else{

echo"<script>self.location='index.php'</script>"; 
}
?>
<?php
include_once("footer.php");
?>