<?php 
include_once("header.php");
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
<?php
$id =$_GET['id']; // app serial


if(1==1){
  $sql ='SELECT distinct applicant.serial ,applicant.`degree`,applicant.`FK_matlob`,applicant.`fk_degree`,request.REQUEST_ID,request.StatusID,request.`destination`,`applicant`.`user_role`,applicant.`univ_id`

FROM `applicant`,request
where applicant.Serial=request.FK_Applicant_serial
and applicant.Serial= ?';
//echo $sql;
 //

  $stmt = $con->prepare($sql);
    /* Execute statement */

    $x='1';
   // echo " q ". $q . $x.$ssn.$request.$mail;
    $stmt->bind_param('s',$id);
    $stmt->execute();
    $res = $stmt->get_result();
 //echo $stmt->num_rows ;

 if($row = $res->fetch_array(MYSQLI_ASSOC)) {
  $app_serial=$row['serial'];
        $degree=$row['degree'];
		 $FK_matlob=$row['FK_matlob'];
		  $REQUEST_ID=$row['REQUEST_ID'];
		   $StatusID=$row['StatusID'];
	   $destination=$row['destination'];
	     $user_role=$row['user_role'];
		 $univ_id=$row['univ_id'];
		 $fk_degree=$row['fk_degree'];
		 
    
	
  
      }
       //echo $Serial.$STATUS_ID.$STATUS_VALUE.$NATIONAL_ID;  
/* 1= طلب مقدم
5=مرفوض (خطأ بشهادة التخرج داخل الملف )
6=مرفوض ( خطأ بالرقم القمومى داخل الملف )
7=مرفوض ( خطأ بإيصال الدفع داخل الملف)
8=مرفوض ( الملف لا يفتح)
*/	   
if ($StatusID == '5' ){

?>	
<form id="form1" name="form1" method="post" action="confirm_request3.php" onsubmit="return checkform(this);" enctype="multipart/form-data" >
<div align="center">
<div align="center" dir="rtl">
<h2 class="style1">رفع التقرير</h2>
</div>
<div style="color:#FF0000">

</div>
<table class="table table-striped" >
<tr hidden>
  <input hidden type="text" name="app_serial" id="app_serial" style="width:20em"   required=""  value="<?php echo $app_serial ; ?>" readonly
 />
</tr>

<tr hidden>
  <input hidden type="text" name="REQUEST_ID" id="REQUEST_ID" style="width:20em"   required=""  value="<?php echo $REQUEST_ID ; ?>" readonly
 />
</tr>


<!------------------------------------------------------------------------------------------------------------>
            <tr>
        <td dir="rtl"><div align="right">
          <select name="txtarname" id="txtarname" required readonly   >
		  
            <?php
			
if($user_role==10)//univ

{	
		$sql = 'SELECT distinct `id` , `name` FROM `universty_lookup` where id =?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $univ_id);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $id =$row['id'];
		   $name=$row['name'];

		  ?>
            <option value="<?php echo $id ?>" ><?php echo $name?></option>
			<input hidden name="txtarnamevalue" id="txtarnamevalue" style="width:20em"   required=""  value="<?php echo $name ; ?>" readonly />
            <?php 
			}

			?>
          </select>
            </div>
		  </td>
		  
           <td>
		<div align="right">الجامعة</div>
	
		   </td>
<?php } 

else if($user_role==20)//acadmy

{	
		$sql = 'SELECT distinct `id` , `name` FROM `academy_lookup` where id =?';
		$stmt = $con->prepare($sql);
			$stmt->bind_param('s', $univ_id);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $id =$row['id'];
		   $name=$row['name'];

		  ?>
            <option value="<?php echo $id ?>" ><?php echo $name?></option>
				<input hidden name="txtarnamevalue" id="txtarnamevalue" style="width:20em"   required=""  value="<?php echo $name ; ?>" readonly />
            <?php 
			}


			?>
          </select>
            </div>
		  </td>
		  
           <td>
		<div align="right">أكاديمية</div>
	
		   </td>
<?php } 

else if($user_role==30)//instidute

{	
		$sql = 'SELECT distinct `id` , `name` FROM `institute_lookup` where id =?';
		$stmt = $con->prepare($sql);
			$stmt->bind_param('s', $univ_id);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $id =$row['id'];
		   $name=$row['name'];

		  ?>
            <option value="<?php echo $id ?>" ><?php echo $name?></option>
				<input hidden name="txtarnamevalue" id="txtarnamevalue" style="width:20em"   required=""  value="<?php echo $name ; ?>" readonly />
            <?php 
			}


			?>
          </select>
            </div>
		  </td>
		  
           <td>
		<div align="right">معهد</div>
	
		   </td>
<?php } 

else
{
}
?>
      </tr>
<!------------------------------------------------------------------------------------------------------------>   
<tr>
        <td dir="rtl"><div align="right">
          <select name="degree" id="degree" required  readonly  >
		  
            <?php

		
		$sql = 'SELECT id,name FROM degree where id=? ';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $fk_degree);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $id =$row['id'];
		   $name=$row['name'];

		  ?>
            <option value="<?php echo $id ?>" ><?php echo $name?></option>
			<input hidden name="degreename" id="degreename" style="width:20em"   required=""  value="<?php echo $name ; ?>" readonly />
            <?php 
			}
			
		
			
			?>
          </select>
            </div>
		  </td>
		  
           <td>
		<div align="right">الدرجه</div>
	
		   </td>
    
      </tr>
<!------------------------------------------------------------------------------------------------------------------------------->
  
    <tr>
        <td dir="rtl"><div align="right">
          <input type="text" name="txtorg" id="txtorg" style="width:20em"   required=""  value="<?php echo $degree ; ?>" readonly
 oninvalid="this.setCustomValidity('يجب إدخال التخصص')"
 oninput="setCustomValidity('')"  pattern="^[\u0621-\u064A ]+$" title="حروف فقط غير مسموح باستخدام ارقام" />
		  </div>
		</td>
       
        <td>
		  <div align="right">التخصص</div>
		</td>
      </tr>
<!------------------------------------------------------------------------------------------------------------>		  
    <tr>
        <td dir="rtl"><div align="right">
          <select name="dplgov" id="dplgov" required  readonly  >
		  
            <?php

		
		$sql = 'SELECT matlob_ID,matlob_NAME FROM matlob where matlob_ID=? ';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $FK_matlob);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $matlob_ID =$row['matlob_ID'];
		   $matlob_NAME=$row['matlob_NAME'];

		  ?>
            <option value="<?php echo $matlob_ID ?>" ><?php echo $matlob_NAME?></option>
			<input hidden name="dplgovname" id="dplgovname" style="width:20em"   required=""  value="<?php echo $matlob_NAME ; ?>" readonly />
            <?php 
			}
			
		
			
			?>
          </select>
            </div>
		  </td>
		  
           <td>
		<div align="right">المطلوب عملة</div>
	
		   </td>
    
      </tr>
<!------------------------------------------------------------------------------------------------------------------------------->
<?php if($destination=="")
{
?>
  <tr>
        <td >
		<div align="right">
         <input type="file" name="myfile" id="myfile" accept="application/pdf"  required="" >
        </div>
		</td>
		
        <td>
		<div align="right"> الملف
		</div>
		</td>
      </tr>
	  <tr>
	  <input type="hidden" name="destination" id="destination" value="<?php echo"" ?>"  />	
	  </tr>
	  
  	     	  <!-- START CAPTCHA -->
<!--	<tr>

<td>
<div class="capbox" style="margin-left:50%;">

<div id="CaptchaDiv"></div>

<div class="capbox-inner">
ادخل الرقم السابق:<br>

<input type="hidden" id="txtCaptcha">
<input type="text" s name="CaptchaInput" id="CaptchaInput" size="15"><br>

</div>
</div>

</br></br>
</td>

  <td colspan = "2" >
		<div align="right"> كود التحقيق
		</div>
		</td>
</tr>
-->
<tr hidden>
  <td>

<input type="hidden" name="txtreq" id="txtreq" 	   value="<?php echo $REQUEST_ID; ?>"  />
 <input type="hidden" name="txtSerial" id="txtSerial" value="<?php echo $app_serial;?>"  /> 
 <input type="hidden" name="destinationn" id="destinationn" value="<?php echo $destination;?>"  /> 
    </td>
	</tr>
<tr>
        <td >
		<div align="right">
		<input type="reset" name="btnreset" id="btnreset" value="إلغاء" style="width:6em ;height:2em;"/>
		</div>
		</td>
		
		 <td >
		<div align="right">
		<input type="submit" name="btneditvalues" id="btneditvalues" onclick="validatenameff();return false;"
		value="تسجيل" style="width:8em ;height:2em;"/>
		</div>
		</td>
		
	  
</tr>


<?php }
else
{ ?>
  <tr>
        <td >
		<div align="right">
       <?php  echo '<div id="myDiv" align="center" class="style1" style="color:#67C404;"  >
        <h2>  لقد تم تسجيل الملف التالى , 
فى حالة التعديل يمكنك الدخول على رابط تعديل طلب	 </h2>
     
  </div>'; ?>
        </div>
		</td>
		 <td   align="right" dir="rtl">
     <iframe id="iframepdf" src="<?php echo $destination; ?>" title="PDF in an i-Frame" style="border:1px solid #666CCC" scrolling="auto" height="500" width="500" ></iframe>
 
    </td>
        <td>
		<div align="right"> الملف
		</div>
		</td>
      </tr>
	  <tr>
	  <input type="hidden" name="destination" id="destination" value="<?php echo $destination; ?>"  />	
	  </tr>
<?php 
} ?>
</table>
</form>
<?php	 


}


}



?>

<script>

function validatenameff(){
var txtarname = document.getElementById("txtarname").value;
if(txtarname.length==0){
   var str="يرجى ادخال اسم المنشأه" ;
   alert(str);     
   //return false;
}
else if(txtarname.length!=0)
{


	//validatedate();
	var txtorg = document.getElementById("txtorg").value;
if(txtorg.length==0){
   var str="يرجى ادخال اسم الدرجة" ;
   alert(str);     
   //return false;
}
else
{
	var pattern = /^[\u0621-\u064A ]+$/;
   result2 = pattern.test(txtorg);
	if(result2)
	{
		//form.submit();
		
					if(document.getElementById('myfile').files.length ===0)
	{
		var strr="يرجى رفع تقرير لجنة القطاع"
	  alert(strr);
	}
	else
	{
		var fileName3 = document.getElementById('myfile').files[0].name;
    var fileSize3 = document.getElementById('myfile').files[0].size;
    var fileType3 = document.getElementById('myfile').files[0].type;
	
	if(fileType3 != 'application/pdf')
	{
		var strr=" تقرير لجنة القطاع يجب ان يكون بصيغة pdf"
	  alert(strr);
	}
	else
	{
		if( (fileSize3/1048576) > 5)
		{
			var strr="التقرير يجب ان لا يزيد حجمه عن 5 ميجا"
	  alert(strr);
		}
		else
		{
			form.submit();
		}
		
	}
	
		
	}
	}
	else
	{
		 var strr="اسم الدرجة يجب ان يكون باللغة العربية"
	  alert(strr); 
	}
	
}
	

}
else{
//validatedate();
form.submit();
}
}
</script>     

<?php
include_once("footer.php");
?>

