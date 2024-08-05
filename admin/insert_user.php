<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-language" content="ar"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css"/>
	
</head>
<?php

include_once("header.php");
include_once("../include/connection.php");
if (isset($_POST["btnregister"])) {

$type=$_POST['type'];
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

	
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >

<center>
<h2 class="style1">إدخال مستخدم جديد للنظام</h2>
</center>


<table width="90%" border="0" align="right" dir="ltr"  class="table table-striped">
<!------------------------------------------------------------------------------------------------------------------------------------------------->		
<tr>
        <td dir="rtl"><div align="right">
          <select name="type" id="type" required style="width:30em"  onchange="validateForm()" >
		   <?php if (isset($_GET["w1"]) ) {
	   $type = $_GET["w1"];
	   
	   if($type =="10")
	   {
		   
		  ?>
			 <option value="10" >جامعه خاصه</option>
			 <option value="11" >جامعه أهلية</option>
			 <option value="12" >جامعه تكنولوجية</option>
			 <option value="30" >معهد خاص</option>
			 <option value="31" >معهد تكنولوجي</option>
			  <option value="20" >أكاديميه خاصه</option>
	 <?php  }
	 if($type =="11")
	   {
		   
		  ?>
			 <option value="11" >جامعه أهلية</option>
			   <option value="10" >جامعه خاصه</option>
			 <option value="12" >جامعه تكنولوجية</option>
			 <option value="20" >أكاديميه خاصه </option>
			  <option value="30" >معهد خاص </option>
			 <option value="31" >معهد تكنولوجي</option>
	 <?php  }
	 if($type =="12")
	   {
		   
		  ?>
		  
			 <option value="12" >جامعه تكنولوجية</option>
			   <option value="10" >جامعه خاصه</option>
			 <option value="11" >جامعه أهلية</option>
			 <option value="20" >أكاديميه خاصه </option>
			  <option value="30" >معهد خاص </option>
			 <option value="31" >معهد تكنولوجي</option>
	 <?php  }
	  if($type =="20")
	   {
		   
		  ?>
			
			 <option value="20" >أكاديميه خاصه </option>
			  <option value="30" >معهد خاص </option>
			 <option value="31" >معهد تكنولوجي</option>
			   <option value="10" >جامعه خاصه</option>
			 <option value="11" >جامعه أهلية</option>
			 <option value="12" >جامعه تكنولوجية</option>
	 <?php  }
	  if($type =="30")
	   {
		   
		  ?>
			
			 
			  <option value="30" >معهد خاص</option>
			 <option value="31" >معهد تكنولوجي</option>
			   <option value="10" >جامعه خاصه</option>
			 <option value="11" >جامعه أهلية</option>
			 <option value="12" >جامعه تكنولوجية</option>
			   <option value="20" >أكاديميه خاصه</option>
	 <?php  }
	 if($type =="31")
	   {
		   
		  ?>
			 <option value="31" >معهد تكنولوجي</option>
			  <option value="30" >معهد خاص</option>
			   <option value="10" >جامعه خاصه</option>
			 <option value="11" >جامعه أهلية</option>
			 <option value="12" >جامعه تكنولوجية</option>
			   <option value="20" >أكاديميه خاصه</option>
	 <?php  }
		   }
		   else
		   {
			   ?>  <option value="-1" >اختر نوع الجهه</option>
                   <option value="10" >جامعه خاصه</option>
			 <option value="11" >جامعه أهلية</option>
			 <option value="12" >جامعه تكنولوجية</option>
			 <option value="30" >معهد خاص</option>
			 <option value="31" >معهد تكنولوجي</option>
			  <option value="20" >أكاديميه خاصه</option>		   <?php
		   } ?>
		  </select>
		  </td>
		   <td  dir="rtl">
          <div align="right">نوع الجهه</div>
		</td>
</tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------->
	<?php
			echo'<p id="demo"></p>
			
			   
  ';

 
 function datatest ($y)
 {
	// $y="<script>document.write("ii");</script>";
	 //echo "walaa".$y;
 }
	?>
<!------------------------------------------------------------------------------------------------------------------------------------------------->	
   <tr>
        <td  dir="rtl">
         
   <select name="txtarname" id="txtarname" style="width:30em" required   >
   <?php if (isset($_GET["w1"]) ) {
	   $type = $_GET["w1"];
	   
	   if($type =="10" || $type =="11" || $type =="12")
	   {
		
		//where "univ_role = ?"   
          $sql = 'SELECT distinct `id`,`name` FROM `universty_lookup` ';
          $stmt = $con->prepare($sql);
		  $stmt->execute();
		  $res = $stmt->get_result();
		  while($row = $res->fetch_array(MYSQLI_ASSOC))
		  {
					   $ID =$row['id'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
		  }
	   }
	      if($type =="30" || $type =="31")
	   {
		   //where "institute_role = ?" 
          $sql = 'SELECT distinct `id`,`name` FROM `institute_lookup` ';
          $stmt = $con->prepare($sql);
		  $stmt->execute();
		  $res = $stmt->get_result();
		  while($row = $res->fetch_array(MYSQLI_ASSOC))
		  {
					   $ID =$row['id'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
		  }
	   }
	        if($type =="20")
	   {
		   
          $sql = 'SELECT distinct `id`,`name` FROM `academy_lookup` ';
          $stmt = $con->prepare($sql);
		  $stmt->execute();
		  $res = $stmt->get_result();
		  while($row = $res->fetch_array(MYSQLI_ASSOC))
		  {
					   $ID =$row['id'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
		  }
	   }
   }
   else {
	?>  <option value="-1" >أختر الجهه</option>
	 <?php }
   ?>
        </td>
		

        <td  dir="rtl">
          <div align="right">إسم الجامعة/ المعهد / الاكاديمية </div>
		</td>
    </tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------->	
 <tr>
        <td dir="rtl"><div align="right">
            <input type="text" name="txtusname" id="txtusname"  style="width:20em;"   
                   oninvalid="this.setCustomValidity(' يجب إدخال اسم المستخدم حروف لغه انجليزية او ارقام ')"
 oninput="setCustomValidity('')" pattern="[0-9A-Za-z. ]+$" title="حروف لغه انجليزية و ارقام " required />
         </div> </td>
      
        <td  dir="rtl">اسم المستخدم</td>
      </tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------->
      <tr>
        <td>
       <div align="right">     <input type="password" name="txtpassword" id="txtpassword"  style="width:20em;" required  autocomplete="off" />
         </div>   </td>
       
      <td  dir="rtl">كلمة المرور</td>
      </tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------->
  
      <tr>
      
        <td align="rtl" colspan="2">
          <div align="center">
               
            <input type="submit" name="btnregister" id="btnregister" value="التسجيل" onclick="validatenameff();return false;" style="width:6em ;height:2em;"/>
			
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
$("#type").select2();
$("#txtarname").select2();
</script>
<script>

function validateForm() {
	 var x = document.getElementById("type").value;
document.getElementById("demo").innerHTML =x;
    window.location.href = "insert_user.php?w1=" + x;

}

</script>

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
form.submit();

}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////

</script>