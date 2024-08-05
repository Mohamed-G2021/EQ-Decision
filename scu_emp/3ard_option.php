<?php
include_once("header.php");
?>
<div align="center" class="style2" dir="rtl" style="color:#000000" >
<!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله 
</h2>-->
</div>

<body>


	<?php

if ($_POST['action'] == 'تم المراجعه')
{
	//echo "إسناد لجنة معادلات";
    //action for update here
	$id=$_POST['app_serial'];
		$REQUEST_ID=$_POST['REQUEST_ID'];
	
	 echo "<script> location.href='update_status.php?id=$REQUEST_ID'; </script>";
} 

else if ($_POST['action'] == 'تم المراجعه و يوجد استيفاء') 
{
		$id=$_POST['app_serial'];
		$REQUEST_ID=$_POST['REQUEST_ID'];
	
	 echo "<script> location.href='update_univ_estefa2.php?id=$id'; </script>";
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else
{
    //invalid action!
}





?>
  


<?php

include("footer.php");
?>



</body>
</html>
	
