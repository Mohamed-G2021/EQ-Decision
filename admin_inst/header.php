<style>
.stylee {
    font-weight: bold;
    font-family: 'Droid Arabic Naskh', serif;
}

.button {
    background: none !important;
    border: none;
    padding: 0 !important;
    color: #337ab7;
    font-size: 20px;
    cursor: pointer;

}

.button:visited {
    color: red;
    text-decoration: underline;
}

.button:hover,
.button:focus,
.button:active {
    color: red;
    text-decoration: underline;
}
</style>

<?php
include_once("../include/connection.php");
session_start();
$error='';
echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8" />

<title>المعاهد الخاصة</title>

 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.css">

<!-- jQuery library -->
<script src="../js/jquery.js"></script>


<link rel="icon" href="../favicon.ico" type="image/x-icon"/><link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/></head>
<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css" />




<!--

<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<link href="../css/navigation.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

style type="text/css">

.style1 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;direction:rtl;
}
.style2 {font-family: "Times New Roman", Times, serif;}
.style3 {font-family: "Times New Roman", Times, serif; font-weight: bold;font-size:12px;}

</style

<link href="../css/navigation.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="../favicon.ico" type="image/x-icon"/><link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/></head>
 -->
<body>

         
<div class="container" style="width:89%;">
  <div class="row">
    <div class="col-sm-12">
<center>      <a href="index.php">
      <img class="img-responsive" src="../images/p.jpg"  /></a>
      </center> 
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <nav class="navbar navbar-default">
  <div class="container-fluid">
      
    <center><ul class="nav navbar-nav" style="
    margin-right: -14px;">
        <li><a class="active stylee" href="empHome.php">الصفحة الرئيسية</a>  </li>';
        if ($_SESSION['roleid'] != "") {
    echo '<li><a class="stylee" href="../logout.php">خروج</a></li>';
} else {
    echo '<li><a class="stylee" href="../logins.php">دخول النظام</a></li>';
    echo "<script>self.location='../logout.php'</script>";
}
  
  echo' 
  
     </ul>
     </center>
  </div>
  </nav>

    </div>
  </div>
      
<div class="row">
    <div class="col-sm-12">';

?>