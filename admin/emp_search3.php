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
include_once("header.php");
function generate_token(){
    //Generate a random string.
    $token = openssl_random_pseudo_bytes(16);

    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    //Return token
    return $token;
}
 $_SESSION['csrf_token'] = generate_token();
 
 $user_role=$_SESSION['roleid'];

$univ_id=$_SESSION['univ_id'];
?>
	
<form id="form1" name="form1" method="post" action="emp_search_result3.php" 
onsubmit="return checkform(this);">

<div dir="rtl" align="center">
<h3 style="font-weight: bold;
    font-family: 'Droid Arabic Naskh', serif;">
متابعة الطلبات
</h3>
</div>



  <table class="table table-striped">

<!---------------------------------------------------------------------------------------------------------------------------------->	  
	  
     <tr hidden>
        <td dir="rtl"><div align="right">
          <select name="txtarname" id="txtarname" required   class="form-control"
                        style="width:12em;font-size: 18px;">
		  <option value="0" >الكل</option>
		  
            <?php

		$sql = 'SELECT distinct `id` , `name` FROM `universty_lookup`';
		$stmt = $con->prepare($sql);
		//$stmt->bind_param('s', $univ_id);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $id =$row['id'];
		   $name=$row['name'];

		  ?>
		  
            <option value="<?php echo $id ?>" ><?php echo $name?></option>
            <?php 
			}

			?>
          </select>
            </div>
		  </td>
		  <td class="stylee">
                <div align="right">
                    الجامعة
                </div>
            </td>
 </tr> 
<!--------------------------------------------------------------------------------->
<tr hidden>
        <td dir="rtl"><div align="right">
          <select name="txtarname2" id="txtarname2" required   >
		  <option value="0" >الكل</option>
		  
            <?php

		$sql2 = 'SELECT distinct `id` , `name` FROM `academy_lookup`';
		$stmt2 = $con->prepare($sql2);
		$stmt2->execute();
		$res2 = $stmt2->get_result();

		while($row2 = $res2->fetch_array(MYSQLI_ASSOC)) {
		   $id =$row2['id'];
		   $name=$row2['name'];

		  ?>
		  
            <option value="<?php echo $id ?>" ><?php echo $name?></option>
            <?php 
			}

			?>
          </select>
            </div>
		  </td>

		  <td class="stylee">
                <div align="right">
                    الأكاديميه
                </div>
            </td>
 </tr> 
 <!--------------------------------------------------------------------------------->
      <tr hidden>
        <td dir="rtl"><div align="right">
          <select name="txtarname3" id="txtarname3" required   >
		  <option value="0" >الكل</option>
		  
            <?php

		$sql = 'SELECT distinct `id` , `name` FROM `institute_lookup`';
		$stmt = $con->prepare($sql);
		//$stmt->bind_param('s', $univ_id);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $id =$row['id'];
		   $name=$row['name'];

		  ?>
		  
            <option value="<?php echo $id ?>" ><?php echo $name?></option>
            <?php 
			}

			?>
          </select>
            </div>
		  </td>
		  
           <td class="stylee">
                <div align="right">
                    المعهد
                </div>
            </td>
 </tr> 


<!---------------------------------------------------------------------------------------------------------------------------------->	
 <tr>
        <td dir="rtl"><div align="right">
          <select name="typeselect" id="typeselect" required   class="form-control"
                        style="width:20em;font-size: 18px;">
		  <option value="0" >الكل</option>
	<?php	  $sql = "SELECT distinct `id`,`name` FROM `user_role` WHERE id IN(10,20,30)";/*'SELECT distinct `STATUS_ID` , `STATUS_VALUE` FROM `status`';*/
		$stmt = $con->prepare($sql);
	//		$stmt->bind_param('s', $univ_id);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $id =$row['id'];
		   $name=$row['name'];

		  ?>
		 
            <option value="<?php echo $id ?>" ><?php echo $name?></option>
            <?php 
			}


			?>
          </select>
            </div>
		  </td>
		  
		  <td class="stylee">
                <div align="right">
                    نوع المنشأه
                </div>
            </td>
	</tr>
	
<!---------------------------------------------------------------------------------------------------------------------------------->	

	  
     <tr>
        <td dir="rtl"><div align="right">
          <select name="statusselect" id="statusselect" required   class="form-control"
                        style="width:20em;font-size: 18px;">
		  <option value="0" >الكل</option>
	<?php	  $sql = 'SELECT distinct `STATUS_ID` , `STATUS_VALUE` FROM `status`';
		$stmt = $con->prepare($sql);
	//		$stmt->bind_param('s', $univ_id);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $id =$row['STATUS_ID'];
		   $name=$row['STATUS_VALUE'];

		  ?>
		 
            <option value="<?php echo $id ?>" ><?php echo $name?></option>
            <?php 
			}


			?>
          </select>
            </div>
		  </td>
		  <td class="stylee">
                <div align="right">
                    حالة الطلب
                </div>
            </td>
	</tr>
	
<!---------------------------------------------------------------------------------------------------------------------------------->	
    <tr>
      <td dir="rtl"><div align="right">
        <input type="text" name="txtrequest" id="txtrequest" style="width:15.5em" class="form-control" oninvalid="this.setCustomValidity('يجب إدخال رقم الطلب -أرقام فقط غير مسموح بإستخدام الحروف')"
 oninput="setCustomValidity('')" pattern="[0-9.]+"  title="أرقام فقط غير مسموح بإستخدام الحروف" />
      </div></td>
	  <td class="stylee">
                <div align="right">
                    رقم الطلب - رقم الإستمارة 
                </div>
            </td>
     
    </tr>
	
	
<!---------------------------------------------------------------------------------------------------------------------------------->	
 <!--     <tr>

<td>
<div class="capbox" style="margin-left:70%;">

<div id="CaptchaDiv"></div>

<div class="capbox-inner">
ادخل الرقم السابق:<br>

<input type="hidden" id="txtCaptcha">
<input type="text" s name="CaptchaInput" id="CaptchaInput" size="15"><br>

</div>
</div>

<br><br>
</td>

  <td  >
		<div align="right"> كود التحقيق
		</div>
		</td>
</tr>
<!-- END CAPTCHA -->


<!------------------------------------------------------------------------------------------------------------------------------------------------->	 

    
    <tr>
      <td colspan="2" align="center"><label>
        <input type="submit"  name="btnsearch" id="btnsearch" value="(الإستعلام (البحث"
                        style="width:9em ;height:2em;font-size:18px;" class="btn btn-info stylee"/>
          
           <input type='hidden' name='csrf_token' value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>
      </label></td>
    </tr>
<!---------------------------------------------------------------------------------------------------------------------------------->	
  </table>
</form>
<?php 
include_once("footer.php");
?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
<script type="text/javascript">
// Captcha Script

function checkform(theform){
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
function removeSpaces(string){
return string.split(' ').join('');
}
</script>                


