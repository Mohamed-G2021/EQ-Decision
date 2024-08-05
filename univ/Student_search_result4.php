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

    $request = $_POST['txtrequest'];
    $request = stripslashes($request);

    $user_role = $_SESSION['roleid'];

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

        if ($user_role == 10) {
            $selectt = ",universty_lookup.name as namee ,universty_lookup.id as idd";
            $fromm = ",universty_lookup";
            $wheree = "and universty_lookup.id = `applicant`.`univ_id` and  `universty_lookup`.`id` =$univ_id and `applicant`.`user_role`=$user_role";

        } else if ($user_role == 20) {
            $selectt = ",academy_lookup.name as namee ,academy_lookup.id as idd";
            $fromm = ",academy_lookup";
            $wheree = "and academy_lookup.id = `applicant`.`univ_id` and  `academy_lookup`.`id` =$univ_id and `applicant`.`user_role`=$user_role";

        } else {
            $selectt = ",institute_lookup.name as namee ,institute_lookup.id as idd";
            $fromm = ",institute_lookup";
            $wheree = "and institute_lookup.id = `applicant`.`univ_id` and  `institute_lookup`.`id` =$univ_id and `applicant`.`user_role`=$user_role ";

        }
    }
    ///////////////////////////////////////////////////////////////
    else // بحث بالجامعة و الطلب
    {

        if ($user_role == 10) {
            $selectt = ",universty_lookup.name as namee ,universty_lookup.id as idd";
            $fromm = ",universty_lookup";
            $wheree = "and universty_lookup.id = `applicant`.`univ_id` and  `universty_lookup`.`id` =$univ_id  and `request`.`REQUEST_ID` = $request and `applicant`.`user_role`=$user_role";

        } else if ($user_role == 20) {
            $selectt = ",academy_lookup.name as namee ,academy_lookup.id as idd";
            $fromm = ",academy_lookup";
            $wheree = " and academy_lookup.id = `applicant`.`univ_id` and  `academy_lookup`.`id` =$univ_id  and `request`.`REQUEST_ID` = $request and `applicant`.`user_role`=$user_role";

        } else {
            $selectt = ",institute_lookup.name as namee ,institute_lookup.id as idd";
            $fromm = ",institute_lookup";
            $wheree = " and institute_lookup.id = `applicant`.`univ_id` and  `institute_lookup`.`id` =$univ_id  and `request`.`REQUEST_ID` = $request and `applicant`.`user_role`=$user_role";

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
    $sql = "SELECT applicant.`Serial` as app_serial $selectt ,`degree`,`FK_matlob`,`fk_degree`,matlob.matlob_NAME,request.StatusID,request.REQUEST_ID,status.STATUS_VALUE as STATUS_VALUE,request.fk_tawseya,request.karar
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

        echo '
  <table class="table table-striped table-hover text-center table-bordered stylee"
            style="margin-bottom: 15px;">

    <thead class="thead-dark" style="background-color:#333; color:#fff;"><tr>
<th>تاريخ الحاله</th>
<th>الحالةإو القرار</th>
<th> المطلوب عمله</th>
<th> التخصص</th>
<th> الدرجه</th>

<th> رقم الطلب</th>
<th> المنشأه</th>
       </tr>
    </thead>
    <tbody>';
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {

            $Serial = $row['app_serial'];

            //echo $Serial;
            $_SESSION['Serial'] = $Serial;
            $STATUS_VALUE = $row['STATUS_VALUE'];
            $StatusID = $row['StatusID'];
            $fk_degree = $row['fk_degree'];

            $degree = $row['degree'];
            $matlob_NAME = $row['matlob_NAME'];
            $FK_matlob = $row['FK_matlob'];
            $REQUEST_ID = $row['REQUEST_ID'];
            $_SESSION['REQUEST_ID'] = $REQUEST_ID;
            $namee = $row['namee'];
            $idd = $row['idd'];
            $fk_tawseya = $row['fk_tawseya'];
            //echo $fk_tawseya;
            $karar = $row['karar'];

            // $tawseya_NAME=$row['tawseya_NAME'];

            $qlog = "SELECT max(`date`) as datelog FROM `status_log` where `fk_request_id`=? and `fk_status_id`=?";
            $stmtlog = $con->prepare($qlog);
            $stmtlog->bind_param("ss", $REQUEST_ID, $StatusID);
            $stmtlog->execute();
            $reslog = $stmtlog->get_result();
            $nlog = $stmt->affected_rows;
            if ($nlog > 0) {
                while ($rowlog = $reslog->fetch_array(MYSQLI_ASSOC)) {
                    echo '<tr>
	 ';

                    $datetime_formate = $rowlog['datelog'];
                    $format_date = date("Y-m-d", strtotime($datetime_formate));

                    echo '	 <td class="text-center">' . $format_date . ' </td>';
                }

                if ($StatusID == 3) {
                    echo '
		   <td class="text-center"><a  href="edituniv.php?id=' . $row['app_serial'] . '"> ' . $row['STATUS_VALUE'] . '</a> </td>';
                } elseif ($StatusID == 11 || $StatusID == 12) {
                    $qtawseya = "SELECT `tawseya_NAME` FROM `tawseya` WHERE `tawseya_ID`=$fk_tawseya";
                    $stmtqtawseya = $con->prepare($qtawseya);

                    $stmtqtawseya->execute();
                    $resqtawseya = $stmtqtawseya->get_result();
                    while ($rowtawseya = $resqtawseya->fetch_array(MYSQLI_ASSOC)) {
                        $tawseya_NAME = $rowtawseya['tawseya_NAME'];
                        echo '
		 <td class="text-center">' . "  " . $tawseya_NAME . "  " . " ( " . $karar . " ) " . '</td>

	 ';
                    }

                } else {
                    echo '
		   <td class="text-center">' . $row['STATUS_VALUE'] . '</td> ';

                }
                echo '
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>';

                $qdegree = "SELECT `name` FROM `degree` WHERE `id`=$fk_degree";
                $stmtqdegree = $con->prepare($qdegree);

                $stmtqdegree->execute();
                $resstmtqdegree = $stmtqdegree->get_result();
                while ($rowresstmtqdegree = $resstmtqdegree->fetch_array(MYSQLI_ASSOC)) {
                    $degree_NAME = $rowresstmtqdegree['name'];
                    echo '
		  <td class="text-center">' . $rowresstmtqdegree['name'] . ' </td>

	 ';
                }
                echo '

 <td class="text-center"><a  href="show_log.php?reqid=' . $row['REQUEST_ID'] . '"> ' . $row['REQUEST_ID'] . '</a> </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                echo '</tr>';

                ?>



<?php

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