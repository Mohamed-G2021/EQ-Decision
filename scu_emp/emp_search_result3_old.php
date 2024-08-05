<?php 
include_once("header.php");
?>

<?php 


if (isset($_POST['btnsearch'])){
    
    if(!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
                    http_response_code(403);
                    die('');
                    exit;
                }

$txtarname = $_POST['txtarname'];
      $txtarname = stripslashes($txtarname);
//	echo $txtarname;  
	  
$request =$_POST['txtrequest'];
      $request = stripslashes($request);
	  
    $user_role=$_SESSION['roleid'];

$univ_id=$_SESSION['univ_id'];

    $Serial="";
       $STATUS_ID ="";
       $STATUS_VALUE = "";
       $FULLNAME="";
       $NATIONAL_ID="";
       $REQUEST_ID="";
       
/////////////////////////////////////////////////
	if(strlen($request)==0 ) // بحث بالجامعه بس
	{
	
		if($user_role==40)
{
	$selectt=",universty_lookup.name as namee ,universty_lookup.id as idd";
	$fromm=",universty_lookup";
	$wheree="and universty_lookup.id = `applicant`.`univ_id` and  `universty_lookup`.`id` =$txtarname ";
	
}
else if($user_role==50)
{
	$selectt=",academy_lookup.name as namee ,academy_lookup.id as idd";
	$fromm=",academy_lookup";
	$wheree="and academy_lookup.id = `applicant`.`univ_id` and  `academy_lookup`.`id` =$txtarname ";

}
else
{
	$selectt=",institute_lookup.name as namee ,institute_lookup.id as idd";
	$fromm=",institute_lookup";
	$wheree="and institute_lookup.id = `applicant`.`univ_id` and  `institute_lookup`.`id` =$txtarname ";
	
}
	}
	///////////////////////////////////////////////////////////////
	else // بحث بالجامعة و الطلب
	{
		
		
		if($user_role==40)
{
	$selectt=",universty_lookup.name as namee ,universty_lookup.id as idd";
	$fromm=",universty_lookup";
	$wheree="and universty_lookup.id = `applicant`.`univ_id` and  `universty_lookup`.`id` =$txtarname  and `request`.`REQUEST_ID` = $request ";
	
}
else if($user_role==50)
{
	$selectt=",academy_lookup.name as namee ,academy_lookup.id as idd";
	$fromm=",academy_lookup";
	$wheree=" and academy_lookup.id = `applicant`.`univ_id` and  `academy_lookup`.`id` =$txtarname  and `request`.`REQUEST_ID` = $request ";
	
}
else
{
	$selectt=",institute_lookup.name as namee ,institute_lookup.id as idd";
	$fromm=",institute_lookup";
	$wheree=" and institute_lookup.id = `applicant`.`univ_id` and  `institute_lookup`.`id` =$txtarname  and `request`.`REQUEST_ID` = $request ";
	
}

	}
/////////////////////////////////////////////////
/*

echo 	$selectt;
echo"<br>";

	echo 	$fromm;
	echo"<br>";
		echo 	$wheree;
		echo"<br>";
		*/
	
  $sql ="SELECT applicant.`Serial` as app_serial $selectt ,`degree`,`FK_matlob`,matlob.matlob_NAME,request.StatusID,request.REQUEST_ID,status.STATUS_VALUE
FROM applicant , request $fromm ,matlob,status
where 

 applicant.FK_matlob=matlob.matlob_ID
 and status.STATUS_ID=request.StatusID
and request.FK_Applicant_serial = `applicant`.`Serial`  
 $wheree
 
 ";
//echo $sql;
 //

  $stmt = $con->prepare($sql);
    /* Execute statement */

    $x='1';
   // echo " q ". $q . $x.$ssn.$request.$mail;
  // $stmt->bind_param($fff,$tt);
 //$bindddddd;
    $stmt->execute();
    $res = $stmt->get_result();
 //echo $stmt->num_rows ;


	
$n =$stmt->affected_rows;


 if($n > 0) {
    
	 /* 
	  echo $Serial;
	  echo "<br>";
	   echo $STATUS_ID;
	  echo "<br>";
	   echo $degree;
	  echo "<br>";
	   echo $matlob_NAME;
	  echo "<br>";
	  echo $REQUEST_ID;
	  echo "<br>";
	   echo $namee;
	  echo "<br>";
	  
	 */ 
       //echo $Serial.$STATUS_ID.$STATUS_VALUE.$NATIONAL_ID;  
/* 1= طلب مقدم
2= تم المراجعة
3=تم المراجعة و يوجد استيفاء

*/	
echo'
  <table class="table table-striped table-hover">

    <thead><tr>


<th> تعديل الحالة</th>
<th>الحالة</th>
<th> المطلوب عمله</th>
<th> اسم الدرجة</th>
<th> رقم الطلب</th>
<th> المنشأه</th> 
       </tr>
    </thead>
    <tbody>';
	while($row = $res->fetch_array(MYSQLI_ASSOC)) {
		
	 $Serial=$row['app_serial'];
	 
	 //echo $Serial;
       $_SESSION['Serial']=$Serial;
       $STATUS_ID =$row['StatusID'];
	   
	       $STATUS_VALUE =$row['STATUS_VALUE'];
       $degree =$row['degree'];
       $matlob_NAME=$row['matlob_NAME'];
       $FK_matlob=$row['FK_matlob'];
       $REQUEST_ID=$row['REQUEST_ID'];
       $_SESSION['REQUEST_ID']=$REQUEST_ID;
	     $namee=$row['namee'];
		 $idd=$row['idd'];
		 
		 
		 
if ($STATUS_ID == '1'  || $STATUS_ID == '4'  )
{
	
	
	 echo'<tr>
	 	   <td class="text-center"><a  href="3ard.php?id='.$row['app_serial'].'">عرض للمراجعه</a> </td>
	 
	

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$row['namee'].' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
	
	
	
	
?>





 <?php 
}


else if($STATUS_ID == '2' )
{
   	
	 echo'<tr>
	 
	
	 	   <td class="text-center"><a  href="selct_keta3.php?id='.$row['app_serial'].'">إختيار لجنة قطاع</a> </td>

	

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$row['namee'].' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '3' || $STATUS_ID == '8')
{
   	
	 echo'<tr>
	 
	
	 	   <td class="text-center">فى انتظار استيفاء الجامعه</td>

	

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$row['namee'].' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}
else if($STATUS_ID == '5' )
{
   	
	 echo'<tr>
	 
	  <td class="text-center"></td>
	 	 <td class="text-center">فى انتظار تقرير لجنة القطاع</td>

	

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$row['namee'].' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '10' )
{
   	
	 echo'<tr>
	 
	 
	 	 <td class="text-center">تم اسناد لجنة معادلات</td>

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$row['namee'].' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '6' || $STATUS_ID == '7' )
{
   	
	 echo'<tr>
	 
	 
	 	   <td class="text-center"><a  href="report_keta3.php?id='.$row['app_serial'].'">عرض تقرير لجنة القطاع</a> </td>

	

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$row['namee'].' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '9'  )
{
   	
	 echo'<tr>
	 
	
	 	   <td class="text-center"><a  href="selct_mo3adalat.php?id='.$row['app_serial'].'">إسناد لجنة معادلات</a> </td>



	

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$row['namee'].' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else if($STATUS_ID == '11' || $STATUS_ID == '12')
{
   	
	 echo'<tr>
	 
	 
	 	    <td class="text-center"><a  href="update_univ_mo3adalat.php?id='.$row['app_serial'].'">عرض توصية او قرار لجنة المعادلات</a> </td>

	

		 <td class="text-center">'.$row['STATUS_VALUE'].' </td>
        	<td class="text-center">'.$row['matlob_NAME'].' </td>
<td class="text-center">'.$row['degree'].' </td>
<td class="text-center">'.$row['REQUEST_ID'].' </td>
			  <td class="text-center">'.$row['namee'].' </td>
			
        
		
			';
			
			
			
      		echo'</tr>';
}

else 
{
echo'
  <div align="center" class="style1" style="color:#FF0000">
        <h2>لا يوجد بيانات</h2>
		 ';

    
    
  echo' <td align="center" ><div align="center" class="style1" style="color:#FF0000"> <a href="emp_search3.php"> للرجوع للصفحة السابقة اضغط هنا </a> </div> </td>';
 
         

}

}
	echo'</tbody></table>';
}

else
{
	echo'<br/>
<center>
 <div  align="center" class="lggraytitle style1" style="margin-bottom:200px "> 
<h3 style="color:red;">

لا توجد نتائج للبحث 


</h3>
</div>
</center>
';	
}


}else{

	echo'
    <div align="center" class="style1" style="color:#FF0000">
        <h2>لا يمكن الرجوع لهذه الصفحة</h2>
		 </div>
         ';
       
	
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
include_once("footer.php");
?>

