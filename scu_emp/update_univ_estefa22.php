<?php
include_once "header.php";
?>
<div align="center" class="style2" dir="rtl" style="color:#000000">
    <!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله
</h2>-->
</div>

<body>


    <?php

if (isset($_POST['btnedit'])) {

    if (!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']) {
        http_response_code(403);
        die('');
        exit;
    }
    $arname_temp = $_POST['txtarname'];
    $arname = stripslashes($arname_temp);
    $serallll = $_POST['serallll'];
    $txtes = $_POST['txtes'];

    $user_role = $_SESSION['roleid'];

    $myUSER_ID = $_SESSION['myUSER_ID'];

    $date = date('Y-m-d');

    $status_id = 3;


///////////////////////////////////////////////////////////

    $sql = 'SELECT distinct `REQUEST_ID` FROM `request`,applicant
where request.FK_Applicant_serial=applicant.Serial
and applicant.Serial=?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $serallll);
    /* Execute statement */
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {$REQUEST_ID = $row['REQUEST_ID'];}

    //echo $REQUEST_ID;
    $estefaa_dest = $_FILES['estefaa_dest']['name'];
    if ($estefaa_dest == "") {
        $destinationn = "";
    } else {

        $ff = $_FILES['estefaa_dest']['name'];
        $extinsion = ".pdf";
        $emp_estefaa = "emp_estefaa";
        $filename = $arname_temp . $REQUEST_ID . $emp_estefaa . $extinsion;
        $destinationn = '../uploads/univ/' . $filename;
        $destinationn_delete = '../uploads/delete/univ/' . $filename;
        // get the file extension
        //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // the physical file on a temporary uploads directory on the server
        $file = $_FILES['estefaa_dest']['tmp_name'];

        if (file_exists($destinationn)) //find old file
        {
//echo "yes";
            //unlink($destination);
            move_uploaded_file($file, $destinationn_delete);
            if (unlink($destinationn)) // delete old file
            {
//echo"unlink";

                $file = $_FILES['estefaa_dest']['tmp_name'];

                if (move_uploaded_file($file, $destinationn)) {

                } else {
//echo"not uplood in destinamtion";
                }
            } else {
//echo"can not delete old one";
            }
        } else { //elfile not found
            if (move_uploaded_file($file, $destinationn)) {
            } else {
//echo"not uplood in destinamtion";
            }
        }
    }
    ////////////////////////////////////////////////////////////////////
    $sql2 = "UPDATE `request` SET `StatusID` =? ,`estefa2` =?

, `updated_date`= ?
,`USER_ID`=?
,`user_role`=?
,`estefaa_dest`=?

WHERE `REQUEST_ID` =?";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param("sssssss", $status_id, $txtes, $date, $myUSER_ID, $user_role, $destinationn, $REQUEST_ID);
//echo"ggggg";
    $stmt2->execute();
    $afrow2 = $stmt2->affected_rows;

    $datetimestatus = date("Y-m-d h:i:sa");
    if ($afrow2 > 0) {
        //echo"<script>self.location='university_search.php'</script>";
        $qlog = "INSERT INTO `status_log`(`fk_request_id`,`fk_status_id` ,`fk_user_id`  ,`date` ) VALUES (?,?,?,?)";

        $x = '1';
        $stmtlog = $con->prepare($qlog);
        $stmtlog->bind_param("ssss", $REQUEST_ID, $status_id, $myUSER_ID, $datetimestatus);
        $stmtlog->execute();
        $afrowlog = $stmtlog->affected_rows;

        if ($afrowlog > 0) {

            ?>
    <div align="center" class="lggraytitle style1" style="margin-bottom:200px">
        <p style="border:2px double"><strong> تم التعديل بنجاح </strong></p>
    </div>
    <?php
} else {?>
    <div align="center" class="lggraytitle style1" style="margin-bottom:200px">
        <p style="border:2px double"><strong> حدث خطأ </strong></p>
    </div>
    <?php

        }

    }
} else {
    echo '
    <div align="center" class="style1" style="color:#FF0000">
        <h2>لا يمكن الرجوع لهذه الصفحة</h2>
		 </div>
         ';
}
?>

    <?php

include "footer.php";
?>



</body>

</html>