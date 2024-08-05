<?php 
include_once("header.php");
?>
 
	    <div align="right">
    <table width="90%" border="0">
	<?php 
  $user_role=$_SESSION['roleid'];
		 //جامعات خاصة
	if($user_role == 150){
		$where_role=" and universty_lookup.univ_role = 10"; ?>
    <tr>
        <td height="55">
		 <br/>  
        <div align="right" dir="rtl" >
<a href="emp_search3.php" class="stylee link">  متابعة طلبات الجامعات التكنولوجية </a></div>
         <br/>      
        </td>
      </tr>  
<tr>
        <td height="55">
		 <br/>  
        <div align="right" dir="rtl" >
<a href="emp_search4.php" class="stylee link">  متابعة طلبات المعاهد التكنولوجية </a></div>
         <br/>      
        </td>
      </tr>  

       <tr>
        <td height="55">
		 <br/>  
        <div align="right" dir="rtl" >
<a href="show_file.php" class="stylee link"> مراجعة جوابات الجامعات التكنولوجية</a></div>
         <br/>      
        </td>
      </tr> 

       <tr>
        <td height="55">
		 <br/>  
        <div align="right" dir="rtl" >
<a href="show_file2.php" class="stylee link"> مراجعة جوابات المعاهد التكنولوجية</a></div>
         <br/>      
        </td>
      </tr>  
	<?php }

  else{
		$where_role=" and universty_lookup.univ_role = 10"; ?>
    <tr>
        <td height="55">
		 <br/>  
        <div align="right" dir="rtl" >
<a href="emp_search3.php" class="stylee link">  متابعة الطلبات  </a></div>
         <br/>      
        </td>
      </tr>  

       <tr>
        <td height="55">
		 <br/>  
        <div align="right" dir="rtl" >
<a href="show_file.php" class="stylee link"> مراجعة الجوابات </a></div>
         <br/>      
        </td>
      </tr>  
	<?php } ?>
	       

	      
	  
	
 
      </table>
  </div>
  
<?php 
include_once("footer.php");
?>
 <script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script> 
     
 

