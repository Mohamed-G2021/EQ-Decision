<?php
include_once("header.php");
?>
<div align="center" class="style2" dir="rtl" style="color:#000000" >
<!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله 
</h2>-->
</div>


<body>


      <?php
	  
	  
	
	  
	$id=$_GET['id']; //app_serial
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
	
	
	
	//echo $id;
	
	$q="
	SELECT applicant.`Serial`,applicant.`univ_id`,applicant.`user_role`,applicant.`USER_ID`,applicant.`degree`,applicant.`FK_matlob`,request.StatusID FROM `applicant`,request
			where 
			request.FK_Applicant_serial=`applicant`.`Serial` and
	 `applicant`.`Serial`=?";

	
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
					$user_role=$row['user_role'];
					
					$USER_ID=$row['USER_ID'];
					$degree=$row['degree'];
					$FK_matlob=$row['FK_matlob'];
					$STATUS_ID=$row['StatusID'];
					
					
			
	?>  
     <form class="form-horizontal" action="update_keta3.php" method="post" >
	 <table class="table table-striped" dir="ltr">
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
<?php
if ($STATUS_ID == '2')
{
	
	?>        <tr>
        <td dir="rtl"><div align="right">
          <select name="keta3" id="keta3" required   >
		  
            <?php

		
		$sql = 'SELECT distinct keta3_ID,keta3_VALUE FROM keta3 ';
		$stmt = $con->prepare($sql);
		//$stmt->bind_param('s', $FK_matlob);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $matlob_ID =$row['keta3_ID'];
		   $matlob_NAME=$row['keta3_VALUE'];

		  ?>
            
			<option value="<?php echo $matlob_ID ?>" ><?php echo $matlob_NAME?></option>
         
       
<?php }
?>
   
			
          </select>
            </div>
		  </td>
		  
    <td>
		<div align="right">لجنة القطاع</div>
	
		   </td>
    
      </tr>

<?php }

?>
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
 <input name="txtstatusid" id="txtstatusid" type="hidden"   value="<?php echo $STATUS_ID ; ?> ">
 <input name="reqid" id="reqid" type="hidden"   value="<?php echo $REQUEST_ID ; ?> ">
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

	   <?php
	  //echo '</div>';

include("footer.php");
?>



</body>

      