<?php
include_once("header.php");
include_once("../include/connection.php");
?>
<div align="center" class="style2" dir="rtl" style="color:#000000" >
<!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله 
</h2>-->
</div>

<body>


	<?php
    
    if (isset($_POST['btnadd'])){
        if(!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
                    http_response_code(403);
                    die('');
                    exit;
                }

                $USER_ID=$_SESSION['myUSER_ID'];
	$date = date('Y-m-d');
 $user_role=$_SESSION['roleid'];
 $selectgeha = $_POST['selectgeha'];
 $file_dest = $_POST['file_dest'];
 if($selectgeha == 110){
$temp_name="univ";
$destinationn = '../uploads/admin_uploads/univ/';
}else if($selectgeha == 130){
$temp_name="inst";
$destinationn = '../uploads/admin_uploads/inst/';
}


$sql="SELECT count(`id`) as max_id FROM `file_uploads` where `user_to_role`=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $selectgeha);
$stmt->execute();
$res = $stmt->get_result();	
$n =$stmt->affected_rows;

if (is_numeric($n))
{ 
 while($row = $res->fetch_array(MYSQLI_ASSOC)) {
    $max_id = $row['max_id'] + 1;

 }
}else{
    $max_id = 1;

}
		if($file_dest != ""){
			$destinationn = "";
		}else{

						$ff=$_FILES['file_dest']['name'];
$extinsion=".pdf";
$filename=$temp_name.$max_id.$extinsion;
$destinationn = $destinationn.$filename;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file_dest']['tmp_name'];

if(file_exists($destinationn)) //find old file
{
//echo "yes";
unlink($destinationn);
if(unlink($destinationn)) // delete old file
{
//echo"unlink";

$file = $_FILES['file_dest']['tmp_name'];

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

        $q="INSERT INTO `file_uploads`(`file_destination`, `user_from_id`, `user_to_role`, `file_date`) VALUES (?,?,?,?)";
$stmt = $con->prepare($q);
$stmt->bind_param("ssss", $destinationn, $USER_ID,$selectgeha,$date);
$stmt->execute();
$afrow=$stmt->affected_rows;

if ($afrow > 0){
$errorr=' <div align="center" class="stylee" style="color:green">
                          <h2>تم الادخال</h2>
	
     
		 </div>';
    echo $errorr;
    }else{
        $errorr=' <div align="center" class="stylee" style="color:#FF0000">
                          <h2>لم يتم الادخال </h2>
	
     
		 </div>';
    echo $errorr;
    } }
    else{

    }
?>
</body>
<?php
include_once("footer.php");
?>