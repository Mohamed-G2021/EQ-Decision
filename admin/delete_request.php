<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-language" content="ar"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css"/>
	
</head>
<?php

include_once("header.php");
include_once("../include/connection.php");
$txtrequest = "";
if (isset($_POST["btndelete"])) {

	$txtrequest = $_POST['txtrequest'];
	$sql = "SELECT  `FK_Applicant_serial`, `StatusID`,status.STATUS_VALUE, `USER_ID`, `user_role`, `estefa2`, `fk_keta3`, `fk_mo3adla`, `fk_tawseya`, `destination`, `univ_destination`, `univ_emkanyat`, `univ_gadwa`, `scu_destination`,
	 `mozakera_dest`, `estefa2_report`, `karar`, `fk_session_id`, `CreationDate`, `updated_date`, `updated_date_keta3`, `updated_date_mo3adalat`, `updated_date_estefa2_report`, `updated_date_karar` 
	FROM `request`,`status` WHERE `REQUEST_ID`=? and request.StatusID = status.STATUS_ID";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $txtrequest);
    $stmt->execute();
    $res = $stmt->get_result();
    if($row = $res->fetch_array(MYSQLI_ASSOC) ){
		
        $FK_Applicant_serial  = $row['FK_Applicant_serial'];
        $destination  = $row['destination'];
        $univ_destination  = $row['univ_destination'];
        $univ_emkanyat  = $row['univ_emkanyat'];
        $univ_gadwa  = $row['univ_gadwa'];
        $scu_destination  = $row['scu_destination'];
        $mozakera_dest  = $row['mozakera_dest'];
        $estefa2_report  = $row['estefa2_report'];
        $StatusID  = $row['StatusID'];
        $STATUS_VALUE  = $row['STATUS_VALUE'];

    }
	/*echo $afrow;
	if($afrow <=0){
		?>
			<div align="center" class="lggraytitle style1" style="margin-bottom:20px"> 
				<p style="border:2px double"> لا يوجد بيانات </p>
         	</div>
	<?php
	}*/
	
	if($StatusID == 6 || $StatusID == 7 ||$StatusID == 8 ||$StatusID == 9 ||$StatusID == 10 ||$StatusID == 11 ||$StatusID == 12)
	{ 
		?>
			<div align="center" class="lggraytitle style1" style="margin-bottom:20px"> 
				<p style="border:2px double"> لا يمكن مسح الطلب حيث ان حالة الطلب <u style="color:red"><?php echo $STATUS_VALUE; ?></u> </p>
         	</div>
	<?php
	}else{

	
	/*echo $txtrequest;
echo "</br>";
echo $FK_Applicant_serial;
echo "</br>";
echo $univ_destination;
echo "</br>";
echo $univ_emkanyat;
echo "</br>";
echo $univ_gadwa;
echo "</br>";
echo $scu_destination;
echo "</br>";*/

    $sql_del_request = "DELETE FROM `request` WHERE `REQUEST_ID`=? AND `StatusID` IN(1,2,3,4,5,13)";
    $stmt_del_request = $con->prepare($sql_del_request);
    $stmt_del_request->bind_param("s", $txtrequest);
    //$stmt_del_request->execute();

	if (mysqli_stmt_execute($stmt_del_request)) { 
		$sql_del_app = "DELETE FROM `applicant` WHERE `Serial`=?";
    	$stmt_del_app = $con->prepare($sql_del_app);
    	$stmt_del_app->bind_param("s", $FK_Applicant_serial);
    	//$stmt_del_app->execute();

		if (mysqli_stmt_execute($stmt_del_app)) { 
			if (file_exists($univ_destination) && file_exists($univ_emkanyat) && file_exists($univ_gadwa)) {
            	if (unlink($univ_destination) && unlink($univ_emkanyat) && unlink($univ_gadwa)){
					if (file_exists($scu_destination)){
						if (unlink($scu_destination)){
						?>
						<div align="center" class="lggraytitle style1" style="margin-bottom:20px"> 
				   			<p style="border:2px double"> تم المسح بنجاح</p>
         				</div>
				<?php
						}
					}else{ ?>
						<div align="center" class="lggraytitle style1" style="margin-bottom:20px"> 
				   			<p style="border:2px double"> تم المسح بنجاح</p>
         				</div>
				<?php	}
				}
			}
		}

	}

}

    /*$type=$_POST['type'];
	$txtarname="'".$_POST['txtarname']."'";
	$txtusname="'".$_POST['txtusname']."'";
	$password=$_POST['txtpassword'];
	
	$password2="'".MD5($password)."'";
	
	 $q="INSERT INTO `user` ( `USER_EMAIL`, `USER_NAME`, `Name`, `roleid`, `univ_id`, `USER_PASSWORD`) VALUES ( $txtusname,$txtusname, $txtusname, $type,$txtarname,$password2)";
//echo $q;
$stmt = $con->prepare($q);
//$stmt->bind_param("sssss", $txtusname,$txtusname, $txtusname, $type,$txtarname,$password);
$stmt->execute();
$afrow=$stmt->affected_rows;

 if ($afrow > 0){
	?>


    <div align="center" class="lggraytitle style1" style="margin-bottom:20px"> 
				   <p style="border:2px double"> تم الإضافه بنجاح</p>
         		</div>
	<?php }	else { ?>
	<div align="center" class="lggraytitle style1" style="margin-bottom:20px"> 
				   <p style="border:2px double"><strong> حدث خطأ </strong></p>
</div>
	<?php
	
	 }	*/

} 

?>



<style>
.capbox {
	background-color: 	#eee;
	border: 	#eee 0px solid;
	border-width: 0px 12px 0px 0px;
	display: inline-block;
	*display: inline; zoom: 1; /* FOR IE7-8 */
	padding: 8px 40px 8px 8px;
	}

.capbox-inner {
	font: bold 11px arial, sans-serif;
	color: #000000;
	background-color:#56a3e6;
	margin: 5px auto 0px auto;
	padding: 3px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	}

#CaptchaDiv {
	font: bold 17px verdana, arial, sans-serif;
	font-style: italic;
	color: #000000;
	background-color: #56a3e6;
	padding: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	}

#CaptchaInput { margin: 1px 0px 1px 0px; width: 135px; }
</style> 

	
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >

<center>
<h2 class="style1">مسح الطلبات</h2>
</center>


<table width="90%" border="0" align="right" dir="ltr"  class="table table-striped">
<!------------------------------------------------------------------------------------------------------------------------------------------------->		
<tr>
        <td>
			<div align="right">
        <input type="text" name="txtrequest" id="txtrequest" style="width:10em" oninvalid="this.setCustomValidity('يجب إدخال رقم الطلب -أرقام فقط غير مسموح بإستخدام الحروف')"
 oninput="setCustomValidity('')" pattern="[0-9.]+"  title="أرقام فقط غير مسموح بإستخدام الحروف" value="<?php echo $txtrequest ?>"/>
      </div>
		  </td>
		   <td  dir="rtl">
          <div align="right">رقم الطلب</div>
		</td>
</tr>

<!------------------------------------------------------------------------------------------------------------------------------------------------->	
   
      <tr>
      
        <td align="rtl" colspan="2">
          <div align="center">
               
            <input type="submit" name="btndelete" id="btndelete" value="مسح" onclick="validatenameff();return false;" style="width:6em ;height:2em;"/>
			
           </div>
		 </td>
		 
      </tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------->	 
    </table>
</div>
 
</form>

	
	<?php 

include_once("footer.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>


<script>

function validatenameff(){
	var txtrequest = document.getElementById("txtrequest").value;
	if(txtrequest=="")
	{
		var str="يرجى ادخال رقم الطلب" ;
        alert(str);
	}
	else
	{
		var erorr = confirm(
            "يرجي التأكد من أن رقم الطلب صحيح هل تريد المسح؟؟"
        );
        if (erorr == true) {
            form.submit();
        } else {
            return false;
        }

}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////

</script>