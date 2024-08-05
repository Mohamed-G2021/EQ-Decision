<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
<!--
.style1 {font-family: "Times New Roman", Times, serif}
.style2 {font-family: "Times New Roman", Times, serif; font-weight: bold; 
font-size: 17px; direction:rtl}
.style4 {font-weight: bold}
div.page {page-break-before: always}
.style6 {font-family: "Times New Roman", Times, serif; font-weight: bold; }
-->
</style>
<link rel="icon" href="../favicon.ico" type="image/x-icon"/><link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/></head>

<!--onload="printfn();return false;"-->
<body  >
<?php 
//include_once("../include/connection.php");
//session_start(); 

include_once("header.php");
?>
 <?php   
if (isset($_POST['btneditvalues']))
{


$app_serial =$_POST['app_serial'];
$app_serial = stripslashes($app_serial); 

//echo $app_serial;

$txtarname =$_POST['txtarname'];
$txtarname = stripslashes($txtarname); 

$txtarnamevalue =$_POST['txtarnamevalue'];
$txtarnamevalue = stripslashes($txtarnamevalue); 

$txtorg =$_POST['txtorg'];
$txtorg = stripslashes($txtorg); 

$dplgov =$_POST['dplgov'];
$dplgov = stripslashes($dplgov); 

$dplgovname =$_POST['dplgovname'];
$dplgovname = stripslashes($dplgovname); 


$dest=$_POST['destination'];


$REQUEST_ID =$_POST['REQUEST_ID'];
$REQUEST_ID = stripslashes($REQUEST_ID); 
//echo $REQUEST_ID;
//echo "dest".$dest;
if($dest!="")
{ 
$destinationn_old=$_POST['destination'];


$ff=$_FILES['myfile']['name'];
//$ffff="";
$extinsion=".pdf";
$new="new";
$filename=$REQUEST_ID.$ssn.$new.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn_new = '../uploads/'.$filename;

    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn_new)) //find old file
{
//echo "yes";
//unlink($destination);
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
$filename=$REQUEST_ID.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn = '../uploads/'.$filename;

    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn)) //find old file
{
//echo "yes";
//unlink($destination);
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
//********************************************//


?>
<form id="form1" name="form1" method="post" action="emp_edit_result3.php" onsubmit="return checkform(this);" enctype="multipart/form-data" >

<div align="center" class="style1" style="color:#000000" valign="top">
        <!--<h2 class="style1"> تقرير الطلب</h2>-->
    <h2 class="style1">  البيانات التى تم ادخالها </h2>
</div>
<div align="center" valign="top" >
<table width="80%" border="0" valign="top" >


    <tr>
    <td  dir="rtl" align="right">
	<input type="output" name="txtarname" 
           id="txtarname"  readonly="true" style="width:30em" class="style2"
            value ="<?php echo $txtarnamevalue; ?> "/>
    </td>
	
    <td  dir="rtl" align="right"><span class="style6" style="width:10em">اسم المنشأه</span>
	</td>
    </tr>
<!---------------------------------------------------------------------------------------------------------------->	 
    <tr hidden>
    <td  align="right" dir="rtl"><input type="output" name="txtorg" id="txtorg" readonly="true"  class="style2"
           value="<?php echo $txtorg; ?>" />
    </td>
    <td  align="right" dir="rtl"><span class="style6" style="width:10em">إسم الدرجة</span></td>
	</tr>
<!---------------------------------------------------------------------------------------------------------------->	
<tr>	
    <td  align="right" dir="rtl"><input type="output" name="dplgov" id="dplgov" readonly="true" class="style2"
          value="<?php echo $dplgovname; ?>"  />
    </td>
    <td   align="right" dir="rtl"><span class="style6">المطلوب عملة</span></td>
  </tr>
 <!---------------------------------------------------------------------------------------------------------------->	
 
<!---------------------------------------------------------------------------------------------------------------->	
<tr hidden>
    
     <td  align="right" dir="rtl"><input type="text" hidden  name="REQUEST_ID" id="REQUEST_ID" readonly="true" class="style2"
        value="<?php echo $REQUEST_ID; ?>"  /></td>
        

  </tr>
<!---------------------------------------------------------------------------------------------------------------->	 
 
 <!---------------------------------------------------------------------------------------------------------------->
  <tr style="height:2em;">
</tr>
<!-------------------------------------------------------------------------->
<?php if($dest!="")
{
?>
   <tr>
    <td   align="right" dir="rtl">
     <iframe id="iframepdf" src="<?php echo $destinationn_new; ?>" title="PDF in an i-Frame" style="border:1px solid #666CCC" scrolling="auto" height="500" width="500" ></iframe>
 
    </td>
    <td   align="right" dir="rtl"><span class="style6">الملف</span></td>
	<input type="hidden" name="destinationn" id="destinationn" value="<?php echo $destinationn_new;?>"  />
	<input type="hidden" name="destinationn2" id="destinationn2" value="<?php echo $destinationn_old;?>"  />
  </tr>
 <?php  }
 
 else
 { ?>
  <tr>
    <td   align="right" dir="rtl">
     <iframe id="iframepdf" src="<?php echo $destinationn; ?>" title="PDF in an i-Frame" style="border:1px solid #666CCC" scrolling="auto" height="500" width="500" ></iframe>
 
    </td>
    <td   align="right" dir="rtl"><span class="style6">الملف</span></td>
	
	<input type="hidden" name="destinationn" id="destinationn" value="<?php echo $destinationn;?>"  />
  </tr>
 <?php  }
   ?>
	    
	<!----------------------------------------------------------------------------------->
   <tr>
   <td>
  
   <input type="hidden" name="txtreq" id="txtreq" value="<?php echo $REQUEST_ID; ?>"  />
   <input type="hidden" name="txtSerial" id="txtSerial" value="<?php echo $app_serial; ?>"  />
   <input type="hidden" name="ddlday2" id="ddlday2" value="<?php echo $BDday; ?>"  />
   <input type="hidden" name="ddlmonth2" id="ddlmonth2" value="<?php echo $BDmon; ?>"  />
   <input type="hidden" name="ddlyear2" id="ddlyear2" value="<?php echo $BDyear; ?>"  />
    <input type="hidden" name="qualification" id="qualification" value="<?php echo $qualification; ?>"  />
    <input type="hidden" name="dplgov" id="dplgov" value="<?php echo $gov; ?>"  />	
	
    
   
   </td>
   </tr>
  

<!------------------------------------------------------------------------------------------>
 <tr style="height:2em;">
</tr>
<!------------------------------------------------> 
<tr>
<td>
		
		
		<input type="submit" name="btnreset" id="btnreset" value="إلغاء" formaction="not_confirm3.php" style="width:6em ;height:2em;"/>
		</td>
		<td>
		
		<input type="submit" name="btneditvalues" id="btneditvalues" onclick="validatename();return false;" value="تأكيد رفع الملف" style="width:8em ;height:2em;"/>
		</td>
	  
</tr>
<!------------------------------------------------------------------------------->
</table>
</div>

</form>
<?php 
} 
else
{ 
echo"<script>self.location='index.php'</script>"; 
 } 

  ?>
 

</body>
</html>

<?php 
include_once("footer.php");
?>