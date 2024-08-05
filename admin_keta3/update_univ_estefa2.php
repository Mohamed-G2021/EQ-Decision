<?php
include_once("header.php");
?>
<div align="center" class="style2" dir="rtl" style="color:#000000" >
<!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله 
</h2>-->
</div>

<body>


	<?php


//id is app_serial
$id=$_GET['id'];
	
	
	$myUSER_ID=$_SESSION['myUSER_ID'];

	
	$date = date('Y-m-d');

$status_id=3;
 $user_role=$_SESSION['roleid'];
//////////////////////////////////////////////////////	

					
	$q="
	SELECT `Serial`,`univ_id`,`USER_ID`,`degree`,`FK_matlob` FROM `applicant`
			where 
	 `applicant`.`Serial`=? ";

	
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
			$id=$row['Serial'];
		$serallll=$row['Serial'];;
					$univ_id=$row['univ_id'];
					//echo $univ_id;
				
					$degree=$row['degree'];
					$FK_matlob=$row['FK_matlob'];
					
			
	?>  
     <form class="form-horizontal" action="update_univ_estefa22.php" method="post" >
	 <table class="table table-striped" dir="ltr">
<!------------------------------------------------------------------------------------------------------------>
            <tr>
        <td dir="rtl"><div align="right">
          <select name="txtarname" id="txtarname" required readonly   >
		  
            <?php
			
if($user_role==40)//univ

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

else if($user_role==50)//acadmy

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

else if($user_role==60)//instidute

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
          <select name="dplgov" id="dplgov" required   readonly >
		  
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
<!------------------------------------------------------------------------------------------------------------>		  
<!------------------------------------------------------------------------------------------------------------>
      <tr>
        <td dir="rtl"><div align="right">
          <input type="text" name="txtes" id="txtes" style="width:20em ;height:20em;"   maxlength="50000" required=""   
 oninvalid="this.setCustomValidity('يجب إدخال ملاحظات الاستيفاء')"
 oninput="setCustomValidity('')"  pattern="^[\u0621-\u064A ]+$" title="حروف فقط غير مسموح باستخدام ارقام" />
		  </div>
		</td>
       
        <td>
		  <div align="right">ملاحظات الاستيفاء</div>
		</td>
      </tr>
<!------------------------------------------------------------------------------------------------------------>		
<!------------------------------------------------------------------------------------------------------------>		  
   
    <tr>
    <td colspan="2" align="center">  <label>
	<div align="center" class="style1">
        <input type="submit" name="btnedit" id="btnedit" value="التالى"  onclick="validatenameff();return false;"  style="width:6em ;height:2em;">
        
        <input type='hidden' name='csrf_token' value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>
        </div>
    </label>
	</td>
    </tr>
	
	<tr>
    <td>
    <input name="serallll" id="serallll" type="hidden"   value="<?php echo $serallll ; ?> ">
 
 <input type="hidden" name="id" value="<?php echo $id;?>" />
    </td>
    </tr>
</table>	  


<!------------------------------------------------------------------------------------------------------------>
</form>
<?php }
}else{

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
		
		
		
		var txtes = document.getElementById("txtes").value;
if(txtes.length==0){
   var str="يرجى ادخال ملاحظات الاستيفاء" ;
   alert(str);     
   //return false;
}
else
{
	var pattern = /^[\u0621-\u064A ]+$/;
   result5 = pattern.test(txtes);
	if(result5)
	{
		form.submit();
	}
	else
	{
		 var strr="ملاحظات الاستيفاء يجب ان تكون باللغة العربية"
	  alert(strr); 
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

include("footer.php");
?>



</body>
</html>
	
