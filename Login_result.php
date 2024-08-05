<?php

include_once("include/connection.php");
session_start();
if( isset( $_POST['btnlogin'] ))
{ 
    if(!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
                    http_response_code(403);
                    die('');
                    exit;
                }
    
	if (!isset($_POST['txtusname']) || !isset($_POST['txtpassword'])) {
	$error='You Must Enter Username and Password To Login';
		exit;
	}
	

//convert the field values to simple variables 
//add slashes to the username and md5() the password 

$usname = stripslashes(trim($_POST['txtusname']));
$pass = md5(stripslashes(trim($_POST['txtpassword'])));

//$Tpass = md5('scucomp');
//echo "usname ".$usname;
//echo "<br />";
//echo "pass  ".$pass;
//set the database connection variables


$q="select `USER_ID`,`USER_NAME`,`USER_PASSWORD`,`roleid`,`name`,`univ_id`  from  `user` where `USER_NAME`=? and `USER_PASSWORD` =? and active>0";
//$q="select `USER_ID`,`USER_NAME`,`USER_PASSWORD`,`roleid`  from  `user` where `USER_NAME`=? and `USER_PASSWORD` =? ";
//echo $q;
	// $con->set_charset("utf8");
	  $stmt = $con->prepare($q);
		/* Execute statement */
	  
	  $stmt->bind_param('ss',$usname,$pass);
	
		$stmt->execute();
		$res = $stmt->get_result();
		if($row = $res->fetch_array(MYSQLI_ASSOC)) {
		
			$_SESSION['myUSER_ID']=$row['USER_ID'];
			//create session 
			$_SESSION['loginusername']= $row['USER_NAME'];
			$_SESSION['name']= $row['name'];
			$roleid	=$row['roleid'];
			$_SESSION['roleid']=$row['roleid'];
				$_SESSION['univ_id']=$row['univ_id'];
			
			//$_SESSION['sectorid']=$row['sectorid'];
			//echo  'roleid   =  ' .$roleid;
			if($roleid=='10' || $roleid=='20' || $roleid=='30'){
				 echo"<script>self.location='univ/index.php'</script>";
			}
			
			else if($roleid=='40' || $roleid=='50' || $roleid=='60'){
				 echo"<script>self.location='scu_emp/index.php'</script>";
			}
			else if($roleid=='70' ){
				 echo"<script>self.location='keta3_emp/index.php'</script>";
			}
			else if($roleid=='80' ){
				 echo"<script>self.location='mo3adalat_emp/index.php'</script>";
			}
			else if($roleid=='100' ){
				 echo"<script>self.location='admin/index.php'</script>";
			}
			else if($roleid=='110' || $roleid=='140' || $roleid=='150'){
				 echo"<script>self.location='admin_univ/index.php'</script>";
			}
			else if($roleid=='130'){
				 echo"<script>self.location='admin_inst/index.php'</script>";
			}
			else if($roleid=='120' ){
				 echo"<script>self.location='admin_keta3/index.php'</script>";
			}
	else{}
				

			}else{

if(active==0)
						 {
			$errorx = '<center>	<h3 style="color:red;">
               هذا المستخدم غير مفعل<br/></h3>
               </center>';
	  $_SESSION['errorx']=$errorx;
	  echo"<script>self.location='logins.php'</script>";
		}
		else{
				$errorx = '<center>	<h3 style="color:red;">
                اسم المستخدم او كلمة المرور  غير صحيحة رجاءا ادخل اسم المستخدم وكلمة المرور الصحيحة<br/></h3>
               </center>';
	  $_SESSION['errorx']=$errorx;
	  echo"<script>self.location='logins.php'</script>";
			 
			 
		}
			 
			 
		
	}

	
}
?>