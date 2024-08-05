

<?php
include_once("header.php");
?>
<?php 
//session_start();
include_once("../include/connection.php");

if (isset($_POST['btnregister'])){

$session_id =$_POST['session_id'];
$session_id = stripslashes($session_id); 

//$requestes = $_POST['choices-multiple-remove-button'];
$cars = $_POST['cars'];
//print_r ($cars);
$dest=$_POST['destination'];


//echo "session_id".$session_id."<br>";
//echo "requestes".$requestes."<br>";
//echo "dest".$dest."<br>";




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

////////////////////////////////////////////////////////////////////////////////


 if($dest!="")
{ 
$destinationn_old=$_POST['destination'];


$ff=$_FILES['myfile']['name'];
//$ffff="";
$extinsion=".pdf";
$new="new";
$filename=$session_id.$new.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn_new = '../uploads/session/'.$filename;
	$destinationn_delete = '../uploads/delete/session/'.$filename;
 $destinationn= '../uploads/session/'.$filename;
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
$filename=$session_id.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn = '../uploads/session/'.$filename;
$destinationn_delete = '../uploads/delete/session/'.$filename;
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


	$q=" INSERT INTO `session`(`id_session` ,`path` ) VALUES (?,?)";
$stmt = $con->prepare($q);
$stmt->bind_param("ss", $session_id, $destinationn);
$stmt->execute();
$afrow=$stmt->affected_rows;

if ($afrow > 0){
	$last_id = mysqli_insert_id($con);
	
	//echo "last_id".$last_id."<br>";
	
	foreach ($_POST['cars'] as $request) 
	{
//    echo "request".$request."<br>";
	$qu=" update `request` set `fk_session_id`=? where `REQUEST_ID`=?";
$stmtu = $con->prepare($qu);
$stmtu->bind_param("ss", $last_id, $request);
$stmtu->execute();
$afrowu=$stmtu->affected_rows;
	if($afrowu>0)
	{
		$errorr=' <div align="center" class="style1" style="color:green">
                          <h2>تم الادخال</h2>
	
     
		 </div>';
    echo $errorr;
	}
	else
	{
		$errorr=' <div align="center" class="style1" style="color:#FF0000">
                          <h2>لم يتم تعديل رقم الجلسه لأرقام الطلبات</h2>
	
     
		 </div>';
    echo $errorr;
	;
	}
}

}
else
{
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