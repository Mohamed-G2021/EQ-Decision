<?php

include_once("header.php");
include_once("../include/connection.php");

$user_role=$_SESSION['roleid'];

if (isset($_POST["btnregister"])) {

	

if($_POST["type"]=="10" || $_POST["type"]=="11" || $_POST["type"]=="12")
{
//echo $_POST["type"];
//echo	$_POST["txtarname"];
/*if($_POST["type"]=="10"){
	$univ_role = 1;
}else if($_POST["type"]=="40"){
	$univ_role = 2;
}else if($_POST["type"]=="50"){
	$univ_role = 3;
}*/
$univ_role = $_POST["type"];
$name=$_POST["txtarname"];

$q="INSERT INTO `universty_lookup` (`id`, `name`,`univ_role`) VALUES (NULL,?,?)";

$stmt = $con->prepare($q);
$stmt->bind_param("ss", $name,$univ_role);
$stmt->execute();
$afrow=$stmt->affected_rows;

if ($afrow > 0){
	echo'<div id="myDiv" align="center" class="stylee" style="color:green;"  >
        <h3>  لقد تم الإدخال بنجاح
		</h3>
     </div>';
}
else
{
	$errorr=' <div align="center" class="stylee" style="color:#FF0000">
                          <h2>لم يتم الادخال </h2>
	
     
		 </div>';
    echo $errorr;
}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if($_POST["type"]=="30" || $_POST["type"]=="31")
{
	/*if($_POST["type"]=="30"){
	$institute_role = 4;
}else if($_POST["type"]=="60"){
	$institute_role = 5;
}*/
$institute_role = $_POST["type"];
	$name=$_POST["txtarname"];

$q="INSERT INTO `institute_lookup` (`id`, `name`,`institute_role`) VALUES (NULL,?,?)";

$stmt = $con->prepare($q);
$stmt->bind_param("ss", $name,$institute_role);
$stmt->execute();
$afrow=$stmt->affected_rows;

if ($afrow > 0){
	echo'<div id="myDiv" align="center" class="stylee" style="color:green;"  >
        <h3>  لقد تم الإدخال بنجاح
		</h3>
     </div>';
}
else
{
	$errorr=' <div align="center" class="stylee" style="color:#FF0000">
                          <h2>لم يتم الادخال </h2>
	
     
		 </div>';
    echo $errorr;
}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if($_POST["type"]=="20")
{
		$name=$_POST["txtarname"];
//echo $name;
$q="INSERT INTO `academy_lookup` (`id`, `name`) VALUES (NULL,?)";

$stmt = $con->prepare($q);
$stmt->bind_param("s", $name);
$stmt->execute();
$afrow=$stmt->affected_rows;

if ($afrow > 0){
	echo'<div id="myDiv" align="center" class="stylee" style="color:green;"  >
        <h3>  لقد تم الإدخال بنجاح
		</h3>
     </div>';
}
else
{
	$errorr=' <div align="center" class="stylee" style="color:#FF0000">
                          <h2>لم يتم الادخال </h2>
	
     
		 </div>';
    echo $errorr;
}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else
{
}
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

	
<form id="form1" name="form1" method="post" action="" >

<center>
<h3 class="stylee">إدخال مؤسسه جديده للنظام</h3>
</center>
<br>


<table width="90%" border="0" align="right" dir="ltr"  class="table table-striped">
<!------------------------------------------------------------------------------------------------------------------------------------------------->		
<tr>
        <td dir="rtl"><div align="right">
          <select name="type" id="type" required  class="form-control"
                        style="width:12em;font-size: 18px;">
		   <option value="-1" >اختر نوع الجهه</option>
			 <option value="10" >جامعه خاصه</option>
			 <option value="11" >جامعه أهلية</option>
			 <option value="12" >جامعه تكنولوجية</option>
			 <option value="30" >معهد خاص</option>
			 <option value="31" >معهد تكنولوجي</option>
			  <option value="20" >أكاديميه خاصه</option>
		  </select>
		  </td>
		  <td class="stylee">
                <div align="right">
                    نوع الجهه
                </div>
            </td>
</tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------->			  
   <tr>
        <td  dir="rtl">
            <input type="text" name="txtarname" id="txtarname" style="width:15.5em" class="form-control"  required="" 
 oninvalid="this.setCustomValidity('يجب إدخال اسم المنشأة الخاصة ')"
 oninput="setCustomValidity('')" pattern="^[\u0621-\u064A ]+$" title="حروف فقط غير مسموح باستخدام ارقام"/> 
        </td>
		
<td class="stylee">
                <div align="right">
                    إسم الجامعة/ المعهد / الاكاديمية 
                </div>
            </td>
    </tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------->	 
      <tr>
      
        <td align="rtl" colspan="2">
          <div align="center">
               
            <input type="submit" name="btnregister" id="btnregister" value="التسجيل" onclick="validatenameff();return false;" style="width:9em ;height:2em;font-size:18px;" class="btn btn-info stylee"/>
			
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



<script>

function validatenameff(){
	//alert("ffff");
	
	var type = document.getElementById("type").value;
	if(type=="-1")
	{
		var str="يرجى اختيار نوع الجهه" ;
   alert(str);
	}
	else
	{
var txtarname = document.getElementById("txtarname").value;
if(txtarname.length==0){
   var str="يرجى ادخال اسم المنشأه" ;
   alert(str);     
   //return false;
}

else{

form.submit();
}
}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////

</script>