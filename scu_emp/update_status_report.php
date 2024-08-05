<?php
include_once "header.php";
?>
<div align="center" class="style2" dir="rtl" style="color:#000000">
    <!--<h2>نظام الاستعلام عن الجامعات و المعاهد و الاكاديميات المعادله
</h2>-->
</div>


<body>


    <?php

$idxx = $_GET['id']; //app_serial
//echo $idxx;
$q = "
	SELECT `StatusID` ,estefa2 FROM `request` where `FK_Applicant_serial`=? ";

//echo $q;
// $con->set_charset("utf8");
$stmt = $con->prepare($q);
/* Execute statement */

$stmt->bind_param('s', $idxx);

$stmt->execute();
$res = $stmt->get_result();
$n = $stmt->affected_rows;
//echo '--------------------------------------'.$n;
if ($n > 0) {
    if ($row = $res->fetch_array(MYSQLI_ASSOC)) {
        $StatusID = $row['StatusID'];
        $estefa2 = $row['estefa2'];
    }

    //echo $StatusID;
}

//echo $id;

$q = "
	SELECT request.REQUEST_ID,applicant.`Serial`,applicant.`univ_id`,applicant.`user_role`,applicant.`USER_ID`,applicant.`degree`,applicant.`FK_matlob`,applicant.`fk_degree`,request.StatusID,`request`.`destination` FROM `applicant`,request
			where
			request.FK_Applicant_serial=`applicant`.`Serial` and
	 `applicant`.`Serial`=?";

//echo $q;
// $con->set_charset("utf8");
$stmt = $con->prepare($q);
/* Execute statement */

$stmt->bind_param('s', $idxx);

$stmt->execute();
$res = $stmt->get_result();
$n = $stmt->affected_rows;
//echo '--------------------------------------'.$n;
if ($n > 0) {
    if ($row = $res->fetch_array(MYSQLI_ASSOC)) {
        $id = $row['Serial'];
        $serallll = $row['Serial'];
        $univ_id = $row['univ_id'];
        $user_role = $row['user_role'];

        $USER_ID = $row['USER_ID'];
        $degree = $row['degree'];
        $FK_matlob = $row['FK_matlob'];
        $STATUS_ID = $row['StatusID'];
        $destination = $row['destination'];
        $REQUEST_ID = $row['REQUEST_ID'];
        $fk_degree = $row['fk_degree'];

        ?>
    <form class="form-horizontal" action="update_status_report_res.php" method="post" enctype="multipart/form-data">
        <table class="table table-striped" dir="ltr">
            <!------------------------------------------------------------------------------------------------------------>
            <tr>
                <td dir="rtl">
                    <div align="right">
                        <select name="txtarname" id="txtarname" required readonly>

                            <?php

        if ($user_role == 10) //univ

        {
            $sql = 'SELECT distinct `id` , `name` FROM `universty_lookup` where id =?';
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $univ_id);
            /* Execute statement */
            $stmt->execute();
            $res = $stmt->get_result();

            while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                $id = $row['id'];
                $name = $row['name'];

                ?>
                            <option value="<?php echo $id ?>"><?php echo $name ?></option>
                            <?php
}

            ?>
                        </select>
                    </div>
                </td>

                <td>
                    <div align="right">الجامعة</div>

                </td>
                <?php } else if ($user_role == 20) //acadmy

        {
            $sql = 'SELECT distinct `id` , `name` FROM `academy_lookup` where id =?';
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $univ_id);
            /* Execute statement */
            $stmt->execute();
            $res = $stmt->get_result();

            while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                $id = $row['id'];
                $name = $row['name'];

                ?>
                <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php
}

            ?>
                </select>
                </div>
                </td>

                <td>
                    <div align="right">أكاديمية</div>

                </td>
                <?php } else if ($user_role == 30) //instidute

        {
            $sql = 'SELECT distinct `id` , `name` FROM `institute_lookup` where id =?';
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $univ_id);
            /* Execute statement */
            $stmt->execute();
            $res = $stmt->get_result();

            while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                $id = $row['id'];
                $name = $row['name'];

                ?>
                <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php
}

            ?>
                </select>
                </div>
                </td>

                <td>
                    <div align="right">معهد</div>

                </td>
                <?php } else {
        }
        ?>
            </tr>
            <!------------------------------------------------------------------------------------------------------------>
            <tr>
                <td dir="rtl">
                    <div align="right">
                        <select name="degree" id="degree" required readonly>

                            <?php

        $sql = 'SELECT id,name FROM degree where id=? ';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $fk_degree);
        /* Execute statement */
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $id = $row['id'];
            $name = $row['name'];

            ?>
                            <option value="<?php echo $id ?>"><?php echo $name ?></option>
                            <input hidden name="degreename" id="degreename" style="width:20em" required=""
                                value="<?php echo $name; ?>" readonly />
                            <?php
}

        ?>
                        </select>
                    </div>
                </td>

                <td>
                    <div align="right">الدرجه</div>

                </td>

            </tr>
            <!------------------------------------------------------------------------------------------------------------------------------->
            <tr>
                <td dir="rtl">
                    <div align="right">
                        <input type="text" name="txtorg" id="txtorg" style="width:20em" required=""
                            value="<?php echo $degree; ?>" readonly
                            oninvalid="this.setCustomValidity('يجب إدخال اسم التخصص')" oninput="setCustomValidity('')"
                            pattern="^[\u0621-\u064A ]+$" title="حروف فقط غير مسموح باستخدام ارقام" />
                    </div>
                </td>

                <td>
                    <div align="right">التخصص</div>
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

        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $matlob_ID = $row['matlob_ID'];
            $matlob_NAME = $row['matlob_NAME'];

            ?>
                            <option value="<?php echo $matlob_ID ?>"><?php echo $matlob_NAME ?></option>
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
            <?php
if ($STATUS_ID == '6' || $STATUS_ID == '7' || $STATUS_ID == '9') {
            ?>
            <?php if ($destination == "") {
                ?>
            <tr hidden>
                <td>
                    <div align="right">
                        <input type="file" name="myfilex" id="myfilex" accept="application/pdf" required="">
                    </div>
                </td>

                <td>
                    <div align="right"> الملف
                    </div>
                </td>
            </tr>
            <tr>
                <input type="hidden" name="destination" id="destination" value="<?php echo "" ?>" />
            </tr>
            <?php } else {?>
            <tr>
                <td hidden>
                    <div align="right">
                        <input type="file" name="myfilexx" id="myfilexx" accept="application/pdf">
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
}?>




            <?php }

        ?>
            <!------------------------------------------------------------------------------------------------------------>
            <?php if ($matlob_ID == 4 || $matlob_ID == 1 || $matlob_ID == 2) {?>
            <tr>
                <td>
                    <div align="right">
                        <input type="file" name="toketa3again_dest" id="toketa3again_dest" accept="application/pdf">
                    </div>
                </td>

                <td>
                    <div align="right"> ملف ارجاع الطلب للجنة القطاع مرة اخرى
                    </div>
                </td>
            </tr>
            <tr>
                <input type="hidden" name="toketa3again_dest" id="toketa3again_dest" value="<?php echo "" ?>" />
            </tr>
            <?php }?>
            <!------------------------------------------------------------------------------------------------>

            <tr>
                <td colspan="2" align="center"> <label>
                        <div align="center" class="style1">
                            <input type="submit" name="btnedit" id="btnedit" value="التالى"
                                onclick="validatenameff();return false;" style="width:6em ;height:2em;">

                            <input type='hidden' name='csrf_token'
                                value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>
                            <input type="hidden" name="destination_mozakera" id="destination_mozakera"
                                value="<?php echo"" ?>" />
                            <input name="serallll" id="serallll" type="hidden" value="<?php echo $serallll ; ?> ">
                            <input name="txtstatusid" id="txtstatusid" type="hidden"
                                value="<?php echo $STATUS_ID ; ?> ">
                            <input name="reqid" id="reqid" type="hidden" value="<?php echo $REQUEST_ID ; ?> ">
                            <input type="hidden" name="id" value="<?php echo $idxx;?>" />
                        </div>
                    </label>
                </td>
            </tr>


        </table>


        <!------------------------------------------------------------------------------------------------------------>
    </form>
    <?php }
} else {

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
                    //form.submit();

                    if (document.getElementById('myfile').files.length === 0) {
                        var strr = "يرجى رفع المذكره"
                        alert(strr);
                    } else {

                        var fileName3 = document.getElementById('myfile').files[0].name;
                        var fileSize3 = document.getElementById('myfile').files[0].size;
                        var fileType3 = document.getElementById('myfile').files[0].type;

                        if (fileType3 != 'application/pdf') {
                            var strr = "المذكره يجب ان تكون بصيغة pdf"
                            alert(strr);
                        } else {
                            if ((fileSize3 / 1048576) > 5) {
                                var strr = "المذكره يجب ان لا يزيد حجمه عن 5 ميجا"
                                alert(strr);
                            } else {
                                form.submit();
                            }

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
//echo '</div>';

include "footer.php";
?>



</body>