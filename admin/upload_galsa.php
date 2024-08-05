<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script>
$(document).ready(function(){
    
     var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        maxItemCount:1000,
        searchResultLimit:1000,
        renderChoiceLimit:1000
      }); 
     
     
 });
</script>
<?php
include_once("header.php");
$user_role=$_SESSION['roleid'];
$univ_id=$_SESSION['univ_id'];
?>


<form id="form1" name="form1" method="post" action="upload_galsa_result.php" onsubmit="return checkform(this);" enctype="multipart/form-data" >

<center>
<h2 class="style1">جلسه جديده</h2>
<div style="color:#FF0000">       
<h4 align="center" class="style3">يجب ادخال جميع الحقول*</h4>
</div> 

</center>


<table width="90%" border="0" align="right" dir="ltr"  class="table table-striped">

<!------------------------------------------------------------------------------------------------------------------------------------------------->	
	  
       <tr>
        <td dir="rtl"><div align="right">
          <input type="text" name="session_id" id="session_id" style="width:10em"  
		  required="" 
 oninvalid="this.setCustomValidity('يجب ادخال تاريخ الجلسه')"
 oninput="setCustomValidity('')" /> 
		  </div>
		</td>
       
        <td>
		  <div align="right"  colspan="3">تاريخ الجلسة</div>
		</td>
      </tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------->	
<tr >
 <td dir="rtl" align="right">
<div class="row d-flex justify-content-center mt-100" align="right">
    <div  align="right"> 
	<select id="choices-multiple-remove-button"  name="cars[]" multiple placeholder="اختر الطلبات لهذه الجلسه"   required="" 
 oninvalid="this.setCustomValidity('يجب إختيار الطلبات لهذه الجلسه')"
 oninput="setCustomValidity('')">
  <?php

		$sql = 'SELECT distinct `REQUEST_ID` FROM `request` where (`StatusID`=11 or `StatusID`=12) and (fk_session_id =0)';
		$stmt = $con->prepare($sql);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $REQUEST_ID =$row['REQUEST_ID'];
		

		  ?>
            <option value="<?php echo $REQUEST_ID ?>" ><?php echo $REQUEST_ID?></option>
            <?php 
			}
			?>
			
        </select> 
		</div>
</div>
</td>
 <td>
		<div align="right">اختر الطلبات لهذه الجلسه</div>
  </td>
</tr>

<!------------------------------------------------------------------------------------------------------------------------------------------------->	 
<tr>
        <td >
		<div align="right">
         <input type="file" name="myfile" id="myfile" accept="application/pdf"  required="" >
        </div>
		</td>
		
        <td>
		<div align="right"> ملف الجلسه
		</div>
		</td>
      </tr>
	  <tr>
	  <input type="hidden" name="destination" id="destination" value="<?php echo"" ?>"  />	
	  </tr>


<!------------------------------------------------------------------------------------------------------------------------------------------------->	 
                
	  
      <tr>
      <td>
	  </td>
        <td align="rtl">
          <div align="left">
            <input type="reset" name="btnreset" id="btnreset" value="الغاء" style="width:10em ;height:2em;"/>
              
              <input type='hidden' name='csrf_token' value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>
              
               
            <input type="submit" name="btnregister" id="btnregister" value="التسجيل"  onclick="validatenameff();return false;" style="width:10em ;height:2em;"/>
			<p style='color:red;' ><?php echo ''.$error;?></p>
           </div>
		 </td>
		 
      </tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------->	 
    </table>

 
</form>
	<script>

function validatenameff(){
var session_id = document.getElementById("session_id").value;
if(session_id.length==0){
   var str="يرجى ادخال رقم الجلسه" ;
   alert(str);     
   //return false;
}
else if(session_id.length!=0)
{
	
	
	if(document.getElementById('myfile').files.length ===0)
	{
		var strr="يرجى رفع رول الجلسه"
	  alert(strr);
	}
	
	else
	{
		var fileName3 = document.getElementById('myfile').files[0].name;
    var fileSize3 = document.getElementById('myfile').files[0].size;
    var fileType3 = document.getElementById('myfile').files[0].type;
	
	if(fileType3 != 'application/pdf')
	{
		var strr="الملف يجب ان يكون بصيغة pdf"
	  alert(strr);
	}
	else
	{
		if( ((fileSize3/1048576) *2) > 200)
		{
			
			var strr="الملف يجب أن لا يزيد حجمه عن 200 ميجا"
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
		form.submit();
}
}


</script>    
<?php 

include_once("footer.php");
?>

