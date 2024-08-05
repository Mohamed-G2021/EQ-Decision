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
//echo $id;
	$q="
	SELECT `StatusID` ,estefa2 FROM `request` where `FK_Applicant_serial`=? ";

	
	//echo $q; 
	// $con->set_charset("utf8");
	  $stmt = $con->prepare($q);
		/* Execute statement */
	  
	  $stmt->bind_param('s',$id);
	
		$stmt->execute();
		$res = $stmt->get_result();
		$n =$stmt->affected_rows;
//echo '--------------------------------------'.$n;
		if($n>0){
		if($row = $res->fetch_array(MYSQLI_ASSOC)) 
		{
			$StatusID=$row['StatusID'];
			$estefa2=$row['estefa2'];
		}
		
		//echo $StatusID;
		}

if($StatusID='10'|| $StatusID='11'|| $StatusID='12' ){
	//echo $id;
	
  $sql ='SELECT distinct applicant.serial ,applicant.`degree`,applicant.`FK_matlob`,request.REQUEST_ID,request.StatusID,request.`destination`,`applicant`.`user_role`,applicant.`univ_id`

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
    
	
      }
       //echo $Serial.$STATUS_ID.$STATUS_VALUE.$NATIONAL_ID;  
/* 1= طلب مقدم
5=مرفوض (خطأ بشهادة التخرج داخل الملف )
6=مرفوض ( خطأ بالرقم القمومى داخل الملف )
7=مرفوض ( خطأ بإيصال الدفع داخل الملف)
8=مرفوض ( الملف لا يفتح)
*/	   
if ($StatusID = '10' || $StatusID='11' || $StatusID='12' ){

?>	
<form id="form1" name="form1" method="post" action="update_univ_mo3adalat.php" onsubmit="return checkform(this);" enctype="multipart/form-data" >
<div align="center">
<div align="center" dir="rtl">
<h2 class="style1">عرض البيانات</h2>
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
          <input type="text" name="txtorg" id="txtorg" style="width:20em"   required=""  value="<?php echo $degree ; ?>" readonly
 oninvalid="this.setCustomValidity('يجب إدخال اسم الدرجة')"
 oninput="setCustomValidity('')"  pattern="^[\u0621-\u064A ]+$" title="حروف فقط غير مسموح باستخدام ارقام" />
		  </div>
		</td>
       
        <td>
		  <div align="right">إسم الدرجة</div>
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
  <tr hidden>
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
<?php }
else
{ ?>
  <tr>
        <td hidden >
		<div align="right">
         <input type="file" name="myfile" id="myfile" accept="application/pdf"   >
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

<!------------------------------------------------------------------------------------------------------------------------------------------------->

<!------------------------------------------------------------------------------------------------------------------------------------------------->	

	     	  <!-- START CAPTCHA -->
<tr hidden>

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
<!-- END CAPTCHA -->

	
 
<!--------------------------------------------------------------------------------->
  <tr>
  <td>

<input type="hidden" name="txtreq" id="txtreq" 	   value="<?php echo $REQUEST_ID; ?>"  />
 <input type="hidden" name="txtSerial" id="txtSerial" value="<?php echo $Serial;?>"  /> 
 <input type="hidden" name="destinationn" id="destinationn" value="<?php echo $destination;?>"  /> 
 <?php }
 
//if(1=1)
}
 

 else{

echo"<script>self.location='index.php'</script>"; 
}?>
      </td>
  </tr>
  
</table>

</div>
 
	  
	  <div align="center">
		<input type="submit" name="action"  value="إضافة التوصيه او القرار" style="width:10em ;height:2em;"/>
		
		
	  </div>
</form>





<?php
include_once("footer.php");
?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4","integer", {allowNegative:false});
<!--var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
-->
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "email", {useCharacterMasking:true});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8","integer", {allowNegative:false,minChars:14});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");





var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4");
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5");
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6");
var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8");
var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9");
var spryselect10 = new Spry.Widget.ValidationSelect("spryselect10");
//-->
</script>
<script type="text/javascript">
//<![CDATA[
window.addEvent('domready', function() {
myCal = new Calendar({

eSD: 'Y-m-d',
eSD2: 'Y-m-d' ,
eSD3: 'Y-m-d' 
}
);
});
//]]>
</script>
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
		form.submit();
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

<script type="text/javascript">
// Captcha Script

function checkform(theform){

//checkextension(); 
    var file = document.querySelector("#myfile");
  if ( /\.(pdf)$/i.test(file.files[0].name) === false ) 
  { 
      var err = "يجب ان يكون امداد الملف pdf";
      alert(err);
//       alert("false1");
      return false;
 // break;
  }
  else
  {
    var size = parseFloat(file.files[0].size / 1024).toFixed(2);
    //alert(size + " KB."); 
    if(size > 2048)
    {
        var err = "يجب ألا يزيد حجم الملف عن 2 ميجا ";
          alert(err);
//        alert("false2");
        return false;
    //break;
    }
    else
    {
//        return true;
//        alert("true");
        var why = "";

if(theform.CaptchaInput.value == ""){
why += "- يجب ادخال كود التحقق.\n";
}
if(theform.CaptchaInput.value != ""){
if(ValidCaptcha(theform.CaptchaInput.value) == false){
why += "- الكود غير مطابق.\n";
}
}
if(why != ""){
alert(why);
return false;
}
}




    }

}
    ////////////////////////////////////
var a = Math.ceil(Math.random() * 9)+ '';
var b = Math.ceil(Math.random() * 9)+ '';
var c = Math.ceil(Math.random() * 9)+ '';
var d = Math.ceil(Math.random() * 9)+ '';
var e = Math.ceil(Math.random() * 9)+ '';

var code = a + b + c + d + e;
document.getElementById("txtCaptcha").value = code;
document.getElementById("CaptchaDiv").innerHTML = code;

// Validate input against the generated number
function ValidCaptcha(){
var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
var str2 = removeSpaces(document.getElementById('CaptchaInput').value);
if (str1 == str2){
return true;

}else{
return false;
}
}
// Remove the spaces from the entered and generated code
function removeSpaces(string){
return string.split(' ').join('');
}
</script>
