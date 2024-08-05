<?php 
include_once("headerlogin.php");
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

<form id="form1" name="form1" method="post" action="Login_result.php">
    <center>
        <h2 class="stylee">دخول النظام </h2>
    </center>
    </br>
    <table class="table table-striped" align="right">
        <tr>
            <td dir="rtl" align="right"><input dir="ltr" type="text" name="txtusname" id="txtusname" required
                    class="form-control" placeholder="اسم المستخدم" style="width:40%;" /></td>
            <td class="stylee" dir="rtl">اسم المستخدم</td>
        </tr>
        <tr>
            <td dir="rtl" align="right"><input dir="ltr" type="password" name="txtpassword" id="txtpassword"
                    placeholder="كلمة المرور" required class="form-control" style="width:40%;" autocomplete="off" /><input
                    type='hidden' name='csrf_token' value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>
            </td>
            <td class="stylee" dir="rtl">كلمة المرور</td>
        </tr>
        <tr>
            <td colspan="4" align="center"><label><input type="submit" name="btnlogin" id="btnlogin" value="دخول"
                        style="width:6em ;height:2em;" class=" btn btn-info stylee" /></label></td><?php if (isset($_SESSION['errorx'])) {
    $errorx = $_SESSION['errorx'];

    echo $errorx;
    $_SESSION['errorx'] = ' ';
}

?>

        </tr>
    </table>
</form>



<!--<form id="form1" name="form1" method="post" action="Login_result.php" >
<center>
<h2 class="style1">
دخول النظام</h2>
</center>
  <table class="table table-striped">
    <tr>
      <td dir="rtl">
        <input type="text" name="txtusname" id="txtusname"  required  />
        </td>
      <td dir="rtl">
        اسم المستخدم
     </td>
    </tr>
    <tr>
      <td dir="rtl">
        <input type="password" name="txtpassword" id="txtpassword"  required autocomplete="off" />
      </td>
      <td   dir="rtl">كلمة المرور
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><label>
        <input type="submit" name="btnlogin" id="btnlogin" value="دخول" style="width:6em ;height:2em;"/>
          
          <input type='hidden' name='csrf_token' value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>
      </label></td>
	  
    </tr>
  </table>

 
</form> -->

<?php 
include_once("footer.php");
?>
