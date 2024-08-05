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
<h3 class="style1">
مراجعة الطلبات
</h3>
</div>



  <table class="table table-striped">

<!---------------------------------------------------------------------------------------------------------------------------------->	  
	  
     <tr>
        <td dir="rtl"><div align="right">
          <select name="txtarname" id="txtarname" required   >
		   <option value="-1" ><?php echo "الكل"?></option>
            <?php




if($user_role==120)//keta3 user

{	
		$sql = 'SELECT distinct `keta3_ID` as id ,`keta3_VALUE`  as name FROM `keta3` ';
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
            <?php 
			}

			?>
          </select>
            </div>
		  </td>
		  
           <td>
		<div align="right">لجنة قطاع</div>
	
		   </td>
<?php } 



else
{
}
?>
      </tr>
<!---------------------------------------------------------------------------------------------------------------------------------->	

    <tr >
      <td dir="rtl"><div align="right">
        <input type="text" name="txtrequest" id="txtrequest" style="width:10em" oninvalid="this.setCustomValidity('يجب إدخال رقم الطلب -أرقام فقط غير مسموح بإستخدام الحروف')"
 oninput="setCustomValidity('')" pattern="[0-9.]+"  title="أرقام فقط غير مسموح بإستخدام الحروف" />
      </div></td>
      <td>
        <div align="right" class="style2">رقم الطلب - رقم الإستمارة </div>
      
      <div align="right">&nbsp;</div></td>
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
        <input type="submit"  name="btnsearch" id="btnsearch" value="(الإستعلام(البحث"  style="width:8em ;height:2em;"/>
          
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


