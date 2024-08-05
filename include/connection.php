<?php
	$dbHost = "localhost";

	
	$dbDatabase = "private_university";
		
	$dbUser = "root";

$dbPass = "MisP@ss123";
//$dbPass = "";	
$con = new mysqli($dbHost, $dbUser, $dbPass,$dbDatabase);
$con->set_charset("utf8");

$tableYear2="2019";

$tableYear1="2018";

$currentYear=2020;
$prevYear=2019;
$prevprevYear=2018;
$copyRight="حقوق الملكية الفكرية ©  $currentYear  محفوظة لوحدة نظم المعلومات الادارية ودعم اتخاذ القرار بمركز الخدمات الالكترونية والمعرفية -المجلس الأعلى للجامعات";

//$db = new mysqli($dbHost, $dbUser, $dbPass,$dbDatabase);
//$db->set_charset("utf8");
//echo " Connection scucceed ";
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

	
	
?>