<?php
include_once("header.php");
?>
<div align="center" class="style2" dir="rtl" style="color:#000000" >
<!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله 
</h2>-->
</div>

<body>


	<?php


	$myUSER_ID=$_SESSION['myUSER_ID'];
	$date = date('Y-m-d');
 $user_role=$_SESSION['roleid'];
//////////////////////////////////////////////////////	

			
	?>  
    <div dir="rtl" align="center">
<h3 style="font-weight: bold;
    font-family: 'Droid Arabic Naskh', serif;">
تحميل جوابات
</h3>
</div>
<br>
     <form class="form-horizontal" action="add_file_result.php" method="post" enctype="multipart/form-data">
	 <table class="table table-striped" dir="ltr">	  
    <tr>
        <td dir="rtl"><div align="right">
          <select name="selectgeha" id="selectgeha" required  readonly class="form-control"
                        style="width:15em;font-size: 18px;">
            <option value="-1" >اختيار الجهة</option>
            <option value="110" >مجلس الجامعات الخاصة</option>
            <option value="130" >مجلس المعاهد الخاصة</option>
            <option value="140" >مجلس الجامعات الاهلية</option>
            <option value="150" >مجلس الجامعات و المعاهد التكنولوجية</option>
          </select>
            </div>
		  </td>
		  
          <td class="stylee">
                <div align="right">
                    الجهة الموجه لها الخطاب
                </div>
            </td>
    
      </tr>
<!------------------------------------------------------------------------------------------------------------>		
<tr>
        <td >
		<div align="right">
         <input type="file" name="file_dest" id="file_dest" accept="application/pdf" required>
        </div>
		</td>
        <td class="stylee">
                <div align="right">
                    ملف الجواب
                </div>
            </td>
		
      </tr>
	  <tr>
	  <input type="hidden" name="file_dest" id="file_dest" value="<?php echo"" ?>"  />	
	  </tr> 
<!------------------------------------------------------------------------------------------------------------------------------------------------->
   
    <tr>
    <td colspan="2" align="center">  <label>
	<div align="center" class="style1">
        <input type="submit" name="btnadd" id="btnadd" value="التالى"  onclick="validatenameff();return false;"  style="width:9em ;height:2em;font-size:18px;" class="btn btn-info stylee">
        
        <input type='hidden' name='csrf_token' value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>
        <input name="serallll" id="serallll" type="hidden"   value="<?php echo $serallll ; ?> ">
 
 <input type="hidden" name="id" value="<?php echo $id;?>" />
        </div>
    </label>
	</td>
	
    </tr>

</table>	  
</form>

  <script>

function validatenameff(){
var selectgeha = document.getElementById("selectgeha").value;
if(selectgeha==-1){
   var str="يرجى اختيار الجهة" ;
   alert(str);     
   //return false;
}

else{
//validatedate();
form.submit();
}
}
</script>    

<?php

include("footer.php");
?>



</body>
</html>
	
