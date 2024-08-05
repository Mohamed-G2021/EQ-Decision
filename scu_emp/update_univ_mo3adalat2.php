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
 
 // echo $id;
//$id=$_GET['id']; //app serial
	
	
	$myUSER_ID=$_SESSION['myUSER_ID'];

	
	$date = date('Y-m-d');


 $id=$_POST['app_serial'];
 //   $REQUEST_ID=$_POST['REQUEST_ID'];
 //$user_role=$_SESSION['roleid'];
//////////////////////////////////////////////////////	

					
	$q="
	SELECT applicant.`Serial`,applicant.`univ_id`,applicant.`USER_ID`,applicant.`degree`,applicant.`fk_degree`,applicant.`FK_matlob`,request.destination,`applicant`.`user_role` ,`request`.`karar`,`request`.REQUEST_ID
	FROM `applicant` ,request
			where 
			`request`.`FK_Applicant_serial`=`applicant`.`Serial`
			and 
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
					$destination=$row['destination'];
					$REQUEST_ID=$row['REQUEST_ID'];
					$user_role=$row['user_role'];
					$karar=$row['karar'];
					$fk_degree=$row['fk_degree'];
					
				//	echo $user_role;
					
			
	?>  
     <form class="form-horizontal" action="update_univ_tawseya_mo3adalat.php" method="post" >
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
          <select name="degree" id="degree" required  readonly  >
		  
            <?php

		
		$sql = 'SELECT id,name FROM degree where id=? ';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $fk_degree);
		/* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $id =$row['id'];
		   $name=$row['name'];

		  ?>
            <option value="<?php echo $id ?>" ><?php echo $name?></option>
			<input hidden name="degreename" id="degreename" style="width:20em"   required=""  value="<?php echo $name ; ?>" readonly />
            <?php 
			}
			
		
			
			?>
          </select>
            </div>
		  </td>
		  
           <td>
		<div align="right">الدرجه</div>
	
		   </td>
    
      </tr>
<!------------------------------------------------------------------------------------------------------------------------------->
      <tr>
        <td dir="rtl"><div align="right">
          <input type="text" name="txtorg" id="txtorg" style="width:20em"   required=""  value="<?php echo $degree ; ?>" readonly 
 oninvalid="this.setCustomValidity('يجب إدخال التخصص')"
 oninput="setCustomValidity('')"  pattern="^[\u0621-\u064A ]+$" title="حروف فقط غير مسموح باستخدام ارقام" />
		  </div>
		</td>
       
        <td>
		  <div align="right">التخصص</div>
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
		<div align="right"> ملف لجنة القطاع
		</div>
		</td>
      </tr>
	  <tr>
	  <input type="hidden" name="destination" id="destination" value="<?php echo $destination; ?>"  />	
	  </tr>
<?php 
} ?>
<!------------------------------------------------------------------------------------------------------------>
    <tr>
        <td dir="rtl"><div align="right">
          <select name="tawsselect" id="tawsselect" required    >
		  
            <?php

		
		$sql = 'SELECT distinct tawseya_ID,tawseya_NAME FROM tawseya';
		$stmt = $con->prepare($sql);
		//$stmt->bind_param('s', $FK_matlob);
		///* Execute statement */
		$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		   $tawseya_ID =$row['tawseya_ID'];
		   $tawseya_NAME=$row['tawseya_NAME'];

		  ?>
            <option value="<?php echo $tawseya_ID ?>" ><?php echo $tawseya_NAME?></option>
            <?php 
			}
			
			
			
			?>
          </select>
            </div>
		  </td>
		  
           <td>
		<div align="right">التوصيه او القرار</div>
	
		   </td>
    
      </tr>
	  <!------------------------------------------------------------------------------------------------------------------>
      <tr>
        <td dir="rtl"><div align="right">
          <input type="text" name="txtes" id="txtes" style="width:40em ;height:20em;"   maxlength="50000" required=""  value="<?php echo $karar; ?>"  
  />
  
		  </div>
		</td>
       
        <td>
		  <div align="right">ملاحظات</div>
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


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






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
   var str="يرجى اداخال التوصيه او القرار" ;
   alert(str);     
   //return false;
}
else
{
	
		form.submit();
	
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
	
