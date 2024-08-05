  
<?php 
include_once("header.php");
function generate_token(){
    //Generate a random string.
    $token = openssl_random_pseudo_bytes(16);

    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    //Return token
    return $token;
}
 $_SESSION['csrf_token'] = generate_token();
?>
  
<div align="center" >

<h2 class="style1">

إدخال بيانات منشأه خاصة
 
 </h2>
</div>
</br>
<form action="new_request.php" method="post">
   

   <table width="100%" border="0">



    
    <tr>
      <div align="right" dir="rtl">
      <p class="style4" align="right">
      <ul class="style4" align="right" style="list-style-type:circle">
      <u style="color:#0020C2" >
	  <b style="color:#0020C2">الأوراق المطلوبه لبدء الدراسة أو المعادلة  أو تجديد معادلة درجة علمية ممنوحة من مؤسسة تعليمية داخل ج.م.ع:</b></u>
<br>

1.	القرار الجمهورى /الوزارى الصادر والمتضمن منح الدرجات العلمية. <br>
2.	خطاب موجه باسم السيد الأستاذ الدكتور/ أمين المجلس الأعلى للجامعات. <br>
3.	عدد 5 نسخ من اللائحة الداخلية للكلية/المعهد معتمدة + CD2.<br>
4.	عدد 5 نسخ من الامكانات المادية والبشرية المتوافرة بالكلية / المعهد معتمدة.<br>
5.	دراسة الجدوى و خطة الجامعه لتوفير الأمكانيات اللازمه لجودة العملية التعليميه فى حالة بدء الدراسه<br>
6.	بيانات منسق الجامعه ( الاسم - الوظيفه - الإيميل - رقم التليفون ) لكليات الهندسه <br>

<br>
   
</ul>
    </p>
    </div>
    </tr>


    <tr>
      <div align="right" dir="rtl">
      <p class="style4" align="right">
      <ul class="style4" align="right" style="list-style-type:circle">
      <u style="color:#0020C2" >
	  <b style="color:#0020C2">الرسوم المطلوبه :</b></u>
<br>
1.	فى حالة الموافقة على اللائحة وبدء الدراسة أو انشاء شعبة جديدة سداد مبلغ 30000 (ثلاثون ألف جنيه) عن كل تخصص.<br>
2.	فى حالة معادلة الدرجة أول مرة سداد مبلغ 50000(خمسون ألف جنيه) عن كل تخصص كمقابل مادى نظير اجراءات النظر فى معادلة الدرجة.<br>
3.	فى حالة تجديد المعادلة سداد مبلغ 25000(خمسة وعشرون ألف جنيه) عن كل تخصص على الكود المؤسسى لأمانة المجلس الأعلى للجامعات رقم 13600201 الباب الأول (ايرادات).<br>

<br>

   
</ul>
    </p>
    </div>
    </tr>




    <tr>
      <div align="right" dir="rtl">
      <p class="style4" align="right">
      <ul class="style4" align="center" style="list-style-type:circle">
      
<!--	  <b style="color:#FF0000">ويتم تحميل هذه الأوراق واللوائح على الايميل الأتى :- pu@scu.eg</b>  -->

    </p>
    </div>
    </tr>
	
	
	    <tr>
      <div align="right" dir="rtl">
      <p class="style4" align="right">
      <ul class="style4" align="right" style="list-style-type:circle">
      <u style="color:#0020C2" >
	  <b style="color:#0020C2">التعهد :</b></u>
   <div style="color:red">
            <pre>
                <b style="font-size:18px">أتعهد بان جميع البيانات التى سيتم ادخالها بنموذج التقديم صحيحة و على مسئوليتى الشخصية </b>
            </pre>
      </div> 


   
</ul>
    </p>
    </div>
    </tr>



	

  <tr>
   <td>
 <div align="right"><span class="style2">
  
     <h4>
      <strong>أوافق على التعهد</strong>
  </h4> </span>
</div>
	   
	 </td>
	 
     <td dir="center" align="center" ><div align="center"><span class="style2">
  
    <input type="checkbox" name="formWheelchair" value="Yes" onClick="redirect('new_request.php')"   required="" 
 oninvalid="this.setCustomValidity('يجب الموافقة على التعهد')"
 oninput="setCustomValidity('')"/> </span>
</div>
 </td>

	
    </tr>
	

	<tr>
 <td dir="rtl" align="right"  >
  <div align="center">
  <input type="submit" name="formSubmit" value="التسجيل" style="width:6em ;height:2em;" />
      
       <input type='hidden' name='csrf_token' value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>
</div>
  </td>
	</tr>
	
   
</form> 
    
  </table>

  
<?php 
include_once("footer.php");
?>
<style type="text/css">
.btn {
background: #3498db;
background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
background-image: -moz-linear-gradient(top, #3498db, #2980b9);
background-image: -ms-linear-gradient(top, #3498db, #2980b9);
background-image: -o-linear-gradient(top, #3498db, #2980b9);
background-image: linear-gradient(to bottom, #3498db, #2980b9);
-webkit-border-radius: 28;
-moz-border-radius: 28;
border-radius: 28px;
font-family: Arial;
color: #ffffff;
font-size: 20px;
padding: 2px 20px 10px 20px;
text-decoration: none;

}



.btn:hover {
background: #3cb0fd;
background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
text-decoration: none;
}
</style>
