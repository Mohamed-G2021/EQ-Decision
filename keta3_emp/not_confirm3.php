<?php 
include_once("header.php");
?>
	<?php
if (isset($_POST['btnreset'])){

///////////////////// end sector id
$destinationn=$_POST['destinationn'];


if(file_exists($destinationn)) //find old file
{
//echo "yes";
//unlink($destination);
if(unlink($destinationn)) // delete old file
{
//echo"unlink";

echo"<script>self.location='index.php'</script>"; 

}
else
{
//echo"can not delete old one";
}
}

}

else{

echo"<script>self.location='index.php'</script>"; 
} // end if submit
?>
<?php 
include_once("footer.php");
?>