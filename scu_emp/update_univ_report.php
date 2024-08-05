<?php
include_once("header.php");
?>
<div align="center" class="style2" dir="rtl" style="color:#000000">
    <!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله 
</h2>-->
</div>

<body>


    <?php

if ($_POST['action'] == 'إسناد لجنة معادلات (موافقة)' || $_POST['action'] == 'موافقة' || $_POST['action'] == 'إسناد لجنة معادلات')
{
	//echo "إسناد لجنة معادلات";
    //action for update here
	$id=$_POST['app_serial'];
//	echo $id;
	 //echo "<script> location.href='update_mo3adalat.php?id=$id'; </script>";
	 echo "<script> location.href='selct_mo3adalat.php?id=$id'; </script>";
} 

else if ($_POST['action'] == 'ارجاع الطلب للجنة القطاع') {
    //echo "إسناد لجنة معادلات";
    //action for update here
    $id = $_POST['app_serial'];
//    echo $id;
    //echo "<script> location.href='update_mo3adalat.php?id=$id'; </script>";
    echo "<script> location.href='update_status_report.php?id=$id'; </script>";
}


else if ($_POST['action'] == 'يوجد إستيفاء') 
{
  //id is app_serial
  $id=$_POST['app_serial'];
    $REQUEST_ID=$_POST['REQUEST_ID'];
 // echo $id;
//$id=$_GET['id'];
	
	
	$myUSER_ID=$_SESSION['myUSER_ID'];

	
	$date = date('Y-m-d');

$status_id=3;
 $user_role=$_SESSION['roleid'];
//////////////////////////////////////////////////////	

					
	$q="
	SELECT applicant.`Serial`,applicant.`univ_id`,applicant.`USER_ID`,applicant.`degree`,applicant.`FK_matlob`,request.destination FROM `applicant` ,request
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
					
			
	?>
    <form class="form-horizontal" action="update_univ_estefa_report.php" method="post" enctype="multipart/form-data">
        <table class="table table-striped" dir="ltr">
            <!------------------------------------------------------------------------------------------------------------>
            <tr>
                <td dir="rtl">
                    <div align="right">
                        <select name="txtarname" id="txtarname" required readonly>

                            <?php
			
if($user_role==40)//univ

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
                            <option value="<?php echo $id ?>"><?php echo $name?></option>
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

else if($user_role==50)//acadmy

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
                <option value="<?php echo $id ?>"><?php echo $name?></option>
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

else if($user_role==60)//instidute

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
                <option value="<?php echo $id ?>"><?php echo $name?></option>
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
                <td dir="rtl">
                    <div align="right">
                        <input type="text" name="txtorg" id="txtorg" style="width:20em" required=""
                            value="<?php echo $degree ; ?>" readonly
                            oninvalid="this.setCustomValidity('يجب إدخال اسم الدرجة')" oninput="setCustomValidity('')"
                            pattern="^[\u0621-\u064A ]+$" title="حروف فقط غير مسموح باستخدام ارقام" />
                    </div>
                </td>

                <td>
                    <div align="right">إسم الدرجة</div>
                </td>
            </tr>
            <!------------------------------------------------------------------------------------------------------------>
            <tr>
                <td dir="rtl">
                    <div align="right">
                        <select name="dplgov" id="dplgov" required readonly>

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
                            <option value="<?php echo $matlob_ID ?>"><?php echo $matlob_NAME?></option>
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
                <td>
                    <div align="right">
                        <input type="file" name="myfile" id="myfile" accept="application/pdf" required="">
                    </div>
                </td>

                <td>
                    <div align="right"> الملف
                    </div>
                </td>
            </tr>
            <tr>
                <input type="hidden" name="destination" id="destination" value="<?php echo"" ?>" />
            </tr>
            <?php }
else
{ ?>
            <tr>
                <td hidden>
                    <div align="right">
                        <input type="file" name="myfile" id="myfile" accept="application/pdf">
                    </div>
                </td>
                <td align="right" dir="rtl">
                    <iframe id="iframepdf" src="<?php echo $destination; ?>" title="PDF in an i-Frame"
                        style="border:1px solid #666CCC" scrolling="auto" height="500" width="500"></iframe>

                </td>
                <td>
                    <div align="right"> الملف
                    </div>
                </td>
            </tr>
            <tr>
                <input type="hidden" name="destination" id="destination" value="<?php echo $destination; ?>" />
            </tr>
            <?php 
} ?>
            <!------------------------------------------------------------------------------------------------------------>
            <tr>
                <td dir="rtl">
                    <div align="right">
                        <input type="text" name="txtes" id="txtes" style="width:20em ;height:20em;" maxlength="50000"
                            required="" oninvalid="this.setCustomValidity('يجب إدخال ملاحظات الاستيفاء')"
                            oninput="setCustomValidity('')" pattern="^[\u0621-\u064A ]+$"
                            title="حروف فقط غير مسموح باستخدام ارقام" />
                    </div>
                </td>

                <td>
                    <div align="right">ملاحظات الاستيفاء</div>
                </td>
            </tr>
            <!------------------------------------------------------------------------------------------------------------>
            <tr>
                <td>
                    <div align="right">
                        <input type="file" name="estefaa_dest" id="estefaa_dest" accept="application/pdf" required="">
                    </div>
                </td>

                <td>
                    <div align="right"> ملف استيفاء لجنة القطاع
                    </div>
                </td>
            </tr>
            <tr>
                <input type="hidden" name="estefaa_dest" id="estefaa_dest" value="<?php echo"" ?>" />
            </tr>
            <!------------------------------------------------------------------------------------------------------------>

            <tr>
                <td colspan="2" align="center"> <label>
                        <div align="center" class="style1">
                            <input type="submit" name="btnedit" id="btnedit" value="التالى"
                                onclick="validatenameff();return false;" style="width:6em ;height:2em;">

                            <input type='hidden' name='csrf_token'
                                value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>
                        </div>
                    </label>
                </td>
            </tr>

            <tr>
                <td>
                    <input name="serallll" id="serallll" type="hidden" value="<?php echo $serallll ; ?> ">

                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                </td>
            </tr>
        </table>


        <!------------------------------------------------------------------------------------------------------------>
    </form>
    <?php }
}else{

}

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else
{
    //invalid action!
}





?>

    <script>
    function validatenameff() {
        var txtarname = document.getElementById("txtarname").value;
        if (txtarname.length == 0) {
            var str = "يرجى ادخال اسم المنشأه";
            alert(str);
            //return false;
        } else if (txtarname.length != 0) {


            //validatedate();
            var txtorg = document.getElementById("txtorg").value;
            if (txtorg.length == 0) {
                var str = "يرجى ادخال اسم الدرجة";
                alert(str);
                //return false;
            } else {
                var pattern = /^[\u0621-\u064A ]+$/;
                result2 = pattern.test(txtorg);
                if (result2) {



                    var txtes = document.getElementById("txtes").value;
                    if (txtes.length == 0) {
                        var str = "يرجى ادخال ملاحظات الاستيفاء";
                        alert(str);
                        //return false;
                    } else {
                        var pattern = /^[\u0621-\u064A ]+$/;
                        result5 = pattern.test(txtes);
                        if (result5) {
                            form.submit();
                        } else {
                            var strr = "ملاحظات الاستيفاء يجب ان تكون باللغة العربية"
                            alert(strr);
                        }
                    }




                } else {
                    var strr = "اسم الدرجة يجب ان يكون باللغة العربية"
                    alert(strr);
                }

            }


        } else {
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