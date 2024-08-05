<?php
include_once "header.php";
?>

<?php

if (isset($_POST['btnsearch'])) {

    if (!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']) {
        http_response_code(403);
        die('');
        exit;
    }

    $txtarname = $_POST['txtarname'];
    $txtarname = stripslashes($txtarname);
//    echo $txtarname;

    $request = $_POST['txtrequest'];
    $request = stripslashes($request);

    $user_role = $_SESSION['roleid'];

    $_SESSION['keta3_id'] = $txtarname;

    $univ_id = $_SESSION['univ_id'];

    $Serial = "";
    $STATUS_ID = "";
    $STATUS_VALUE = "";
    $FULLNAME = "";
    $NATIONAL_ID = "";
    $REQUEST_ID = "";

/////////////////////////////////////////////////
    if (strlen($request) == 0) // بحث بالجامعه بس
    {

        if ($user_role == 70) {
            $selectt = ",keta3.keta3_VALUE as namee ,keta3.keta3_ID as idd";
            $fromm = ",keta3";
            $wheree = "and keta3.keta3_ID = `request`.`fk_keta3` and  keta3.keta3_ID =$txtarname ";

        }

    }
    ///////////////////////////////////////////////////////////////
    else // بحث بالجامعة و الطلب
    {

        if ($user_role == 70) {
            $selectt = ",keta3.keta3_VALUE as namee ,keta3.keta3_ID as idd";
            $fromm = ",keta3";
            $wheree = "and keta3.keta3_ID = `request`.`fk_keta3` and  keta3.keta3_ID =$txtarname   and `request`.`REQUEST_ID` = $request ";

        }

    }
/////////////////////////////////////////////////
    /*

    echo     $selectt;
    echo"<br>";

    echo     $fromm;
    echo"<br>";
    echo     $wheree;
    echo"<br>";
     */

    $sql = "SELECT DISTINCT applicant.`Serial` as app_serial,`applicant`.`user_role` as approle , `applicant`.`univ_id` as appuniv  $selectt ,`degree`,`FK_matlob`,matlob.matlob_NAME,request.StatusID,request.REQUEST_ID,status.STATUS_VALUE,
  `request`.`destination`,`request`.`univ_destination`,`request`.`univ_emkanyat`,`request`.`univ_gadwa`,`request`.`scu_destination`,`request`.`toketa3again_dest`
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

    $x = '1';
    // echo " q ". $q . $x.$ssn.$request.$mail;
    // $stmt->bind_param($fff,$tt);
    //$bindddddd;
    $stmt->execute();
    $res = $stmt->get_result();
    //echo $stmt->num_rows ;

    $n = $stmt->affected_rows;

    if ($n > 0) {

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
        echo '
<h3 style="color: red;text-align: right;">ملاحظة : عند تظليل الصف باللون الاحمر هذا يعني انه تم مرور اكثر من 60 يوم علي تاريخ الحالة</h3>
  <table class="table table-striped table-hover">

    <thead><tr>


<th> الأمر</th>
<th> ملف ارجاع الطلب للجنة القطاع من قبل الموظف</th>
<th> خطاب الأمين</th>
	<th> أخرى </th>
	<th>الإمكانيات البشريه	</th>
	<th> اللائحه </th>
<th>تاريخ الحاله</th>
<th>الحالة</th>
<th> المطلوب عمله</th>
<th> اسم الدرجة</th>
<th> رقم الطلب</th>
<th> اسم الجهه</th>
<th> إسم لجنة القطاع</th>
       </tr>
    </thead>
    <tbody>';
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {

            $Serial = $row['app_serial'];

            //echo $Serial;
            $_SESSION['Serial'] = $Serial;
            $STATUS_ID = $row['StatusID'];

            $STATUS_VALUE = $row['STATUS_VALUE'];
            $degree = $row['degree'];
            $matlob_NAME = $row['matlob_NAME'];
            $FK_matlob = $row['FK_matlob'];
            $REQUEST_ID = $row['REQUEST_ID'];
            $_SESSION['REQUEST_ID'] = $REQUEST_ID;
            $namee = $row['namee'];
            $idd = $row['idd'];

            $approle = $row['approle'];
            $appuniv = $row['appuniv'];

            if ($approle == "10") //univ
            {
                $univ_table = "universty_lookup";
                $qunivvv = "SELECT `id`,`name` as univvvname FROM `universty_lookup` where `id`=$appuniv";
                $stmtqunivvv = $con->prepare($qunivvv);
                $stmtqunivvv->execute();
                $resunivvv = $stmtqunivvv->get_result();
                while ($rowunivvv = $resunivvv->fetch_array(MYSQLI_ASSOC)) {
                    $univvvname = $rowunivvv['univvvname'];
                }

            }

            if ($approle == "30") //inst
            {
                $univ_table = "institute_lookup";
                $qunivvv = "SELECT `id`,`name` as univvvname FROM `institute_lookup` where `id`=$appuniv";
                $stmtqunivvv = $con->prepare($qunivvv);
                $stmtqunivvv->execute();
                $resunivvv = $stmtqunivvv->get_result();
                while ($rowunivvv = $resunivvv->fetch_array(MYSQLI_ASSOC)) {
                    $univvvname = $rowunivvv['univvvname'];
                }
            }

            if ($approle == "20") //acadmy
            {
                $univ_table = "academy_lookup";
                $qunivvv = "SELECT `id`,`name` as univvvname FROM `academy_lookup` where `id`=$appuniv";
                $stmtqunivvv = $con->prepare($qunivvv);
                $stmtqunivvv->execute();
                $resunivvv = $stmtqunivvv->get_result();
                while ($rowunivvv = $resunivvv->fetch_array(MYSQLI_ASSOC)) {
                    $univvvname = $rowunivvv['univvvname'];
                }
            }

            $qlog = "SELECT MAX(`date`) as datelog FROM `status_log` where `fk_request_id`=? and `fk_status_id`=?";
            $stmtlog = $con->prepare($qlog);
            $stmtlog->bind_param("ss", $REQUEST_ID, $STATUS_ID);
            $stmtlog->execute();
            $reslog = $stmtlog->get_result();
            $nlog = $stmt->affected_rows;

            if ($nlog > 0) {

                while ($rowlog = $reslog->fetch_array(MYSQLI_ASSOC)) {

                    $datetime_formate = $rowlog['datelog'];
                    $format_date = date("Y-m-d", strtotime($datetime_formate));
                    $format_date2 = strtotime($format_date);
                    $current_date = strtotime(date("Y-m-d"));
                    $sub = $current_date - $format_date2;
                    $sub = $sub / 86400;
                    if ($sub >= 60) {
                        $style = 'style="background-color: red;"';
                    } else {
                        $style = "";
                    }

                    if ($STATUS_ID == '5') {

                        echo '<tr ' . $style . '>


	 	   <td class="text-center"><a  href="upload_report_keta3.php?id=' . $row['app_serial'] . '">رفع تقرير لجنة القطاع</a> </td>';
                        if ($row['toketa3again_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['toketa3again_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }
                        echo '<td class="text-center"><a  href="3ardfile.php?id=' . $row['scu_destination'] . '" target="_blank" >عرض</a>   </td>
			  			  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>
	<td class="text-center">' . $rowlog['datelog'] . ' </td>

		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
<td class="text-center">' . $univvvname . ' </td>

			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                        echo '</tr>';
                    }

                    if ($STATUS_ID == '6' || $STATUS_ID == '7') {

                        echo '<tr ' . $style . '>


	 	   <td class="text-center"><a  href="upload_report_keta3_update.php?id=' . $row['app_serial'] . '">لتعديل الملف المرفوع</a> </td>
		   ';
                        if ($row['toketa3again_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['toketa3again_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }
                        echo '
<td class="text-center"><a  href="3ardfile.php?id=' . $row['scu_destination'] . '" target="_blank" >عرض</a>   </td>
			  			  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>
	<td class="text-center">' . $rowlog['datelog'] . ' </td>

		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
<td class="text-center">' . $univvvname . ' </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                        echo '</tr>';
                    } else {

                    }

                }
            }
        }
        echo '</tbody></table>';
    } else {
        echo '<br/>
<center>
 <div  align="center" class="lggraytitle style1" style="margin-bottom:200px ">
<h3 style="color:red;">

لا توجد نتائج للبحث


</h3>
</div>
</center>
';
    }

} else {

    echo '
    <div align="center" class="style1" style="color:#FF0000">
        <h2>لا يمكن الرجوع لهذه الصفحة</h2>
		 </div>
         ';

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
                form.submit();
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
include_once "footer.php";
?>