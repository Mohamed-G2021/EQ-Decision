<?php

include_once "header.php";
if (!isset($_POST['formSubmit'])) {

    echo '<div id="myDiv" align="center" class="stylee" style="color:green;"  >
        <h3>  لم توافق على التعهد


		</h3>

      <h3>   للرجوع للصفحة السابقة للموافقة على التعهد
        <a href="requestConditions.php" target ="_blank">أضغط هنا</a>

        </h3>

  </div>
	';

} else {
    if (!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']) {
        http_response_code(403);
        die('');
        exit;
    }

    function generate_token()
    {
        //Generate a random string.
        $token = openssl_random_pseudo_bytes(16);

        //Convert the binary data into hexadecimal representation.
        $token = bin2hex($token);

        //Return token
        return $token;
    }
    $_SESSION['csrf_token'] = generate_token();
    $user_role = $_SESSION['roleid'];

    $univ_id = $_SESSION['univ_id'];

/*
echo $user_role;
echo "<br>";
echo $univ_id;*/
    ?>



<style>
.capbox {
    background-color: #eee;
    border: #eee 0px solid;
    border-width: 0px 12px 0px 0px;
    display: inline-block;
    *display: inline;
    zoom: 1;
    /* FOR IE7-8 */
    padding: 8px 40px 8px 8px;
}

.capbox-inner {
    font: bold 11px arial, sans-serif;
    color: #000000;
    background-color: #56a3e6;
    margin: 5px auto 0px auto;
    padding: 3px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
}

#CaptchaDiv {
    font: bold 17px verdana, arial, sans-serif;
    font-style: italic;
    color: #000000;
    background-color: #56a3e6;
    padding: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
}

#CaptchaInput {
    margin: 1px 0px 1px 0px;
    width: 135px;
}
</style>


<form id="form1" name="form1" method="post" action="new_request_result.php" onsubmit="return checkform(this);"
    enctype="multipart/form-data">

    <center>
        <h2 class="stylee">تقديم طلب جديد </h2>
        <br />
        <div style="color:#FF0000">
            <h4 align="right" class="stylee">يجب ادخال جميع الحقول*</h4>
        </div>
        <div style="color:#FF0000">
            <h4 align="right" class="stylee">الرجاء التاكد من ان البيانات المدخلة صحيحة حتى يتم استكمال الطلب بنجاح*
            </h4>
        </div>
    </center>


    <table width="90%" border="0" align="right" dir="ltr" class="table table-striped">

        <!-- <tr>
        <td  dir="rtl">
            <input type="text" name="txtarname" id="txtarname" style="width:20em"  required=""
 oninvalid="this.setCustomValidity('يجب إدخال اسم المنشأة الخاصة ')"
 oninput="setCustomValidity('')" pattern="^[\u0621-\u064A ]+$" title="حروف فقط غير مسموح باستخدام ارقام"/>
        </td>


        <td  dir="rtl">
          <div align="right">إسم الجامعة/ المعهد / الاكاديمية </div>
		</td>
    </tr>

-->
        <tr>
            <td dir="rtl">
                <div align="right">
                    <select name="txtarname" id="txtarname" class="form-control" style="width:12em;font-size: 18px;"
                        required>

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

            <td class="stylee">
                <div align="right"><span style="color: red">*</span>
                    الجامعة
                </div>
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

            <td class="stylee">
                <div align="right"><span style="color: red">*</span>
                    الأكاديمية
                </div>
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
            <td class="stylee">
                <div align="right"><span style="color: red">*</span>
                    المعهد
                </div>
            </td>
            <?php } else {
    }
    ?>
        </tr>
        <!------------------------------------------------------------------------------------------------------------------------------------------------->
        <!------------------------------------------------------------------------------------------------------------------------------------------------->


        <tr>
            <td dir="rtl">
                <div align="right">
                    <select name="degree" id="degree" class="form-control" style="width:12em;font-size: 18px;" required>

                        <?php

    $sql = 'SELECT distinct id,name FROM  degree';
    $stmt = $con->prepare($sql);
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
            <td class="stylee">
                <div align="right"><span style="color: red">*</span>
                    الدرجه
                </div>
            </td>


        </tr>
        <!------------------------------------------------------------------------------------------------------------------------------------------------->

        <tr>
            <td dir="rtl">
                <div align="right">
                    <input type="text" name="txtorg" id="txtorg" style="width:20em" required="" class="form-control"
                        oninvalid="this.setCustomValidity('يجب إدخال التخصص')" oninput="setCustomValidity('')"
                        pattern="^[\u0621-\u064A ]+$" title="حروف فقط غير مسموح باستخدام ارقام" />
                </div>
            </td>

            <td class="stylee">
                <div align="right"><span style="color: red">*</span>
                    التخصص
                </div>
            </td>
        </tr>
        <!------------------------------------------------------------------------------------------------------------------------------------------------->

        <tr>
            <td dir="rtl">
                <div align="right">
                    <select name="dplgov" id="dplgov" class="form-control" style="width:12em;font-size: 18px;" required>

                        <?php

    $sql = 'SELECT matlob_ID,matlob_NAME FROM matlob';
    $stmt = $con->prepare($sql);
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
            <td class="stylee">
                <div align="right"><span style="color: red">*</span>
                    المطلوب
                </div>
            </td>

        </tr>
        <!------------------------------------------------------------------------------------------------------------------------------------------------->

        <!------------------------------------------------------------------------------------------------------------------------------------------------->
        <tr>
            <td>
                <div align="right">
                    <input type="file" name="myfile" id="myfile" accept="application/pdf" required="">
                </div>
            </td>

            <td class="stylee">
                <div align="right"><span style="color: red">*</span>
                    ملف اللائحه
                </div>
            </td>
        </tr>
        <tr>
            <input type="hidden" name="destination" id="destination" value="<?php echo "" ?>" />
        </tr>
        <!------------------------------------------------------------------------------------------------------------------------------------------------->
        <tr>
            <td>
                <div align="right">
                    <input type="file" name="univ_emkanyat" id="univ_emkanyat" accept="application/pdf" required="">
                </div>
            </td>

            <td class="stylee">
                <div align="right"><span style="color: red">*</span>
                    ملف الإمكانيات المادية والبشرية
                </div>
            </td>
        </tr>
        <tr>
            <input type="hidden" name="univ_emkanyat_destination" id="univ_emkanyat_destination"
                value="<?php echo "" ?>" />
        </tr>
        <!------------------------------------------------------------------------------------------------------------------------------------------------->
        <tr>
            <td>
                <div align="right">
                    <input type="file" name="univ_gadwa" id="univ_gadwa" accept="application/pdf" required="">
                </div>
            </td>

            <td class="stylee">
                <div align="right"><span style="color: red">*</span>
                    اخرى (الجواب و القرار الجمهورى للجامعه - أو االجواب و القرار الوزارى للمعهد)
                </div>
            </td>
        </tr>
        <tr>
            <input type="hidden" name="univ_gadwa_destination" id="univ_gadwa_destination" value="<?php echo "" ?>" />
        </tr>
        <!------------------------------------------------------------------------------------------------------------------------------------------------->






        <!------------------------------------------------------------------------------------------------------------------------------------------------->


        <tr>
            <br>
            <td>
            </td>
            <td align="rtl">
                <div align="left">
                    <input type="reset" name="btnreset" id="btnreset" value="الغاء"
                        style="width:8em ;height:2em;font-size:18px;" class="btn btn-danger stylee" />

                    <input type='hidden' name='csrf_token'
                        value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>


                    <input type="submit" name="btnregister" id="btnregister" value="التسجيل"
                        onclick="validatenameff();return false;" style="width:8em ;height:2em;font-size:18px;"
                        class="btn btn-info stylee" />
                    <p style='color:red;'><?php echo '' . $error; ?></p>
                </div>
            </td>

        </tr>
        <!------------------------------------------------------------------------------------------------------------------------------------------------->
    </table>
    </div>

</form>

<?php
}
include_once "footer.php";
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
        if (degree.length == 0) {
            var str = "يرجى أحتيار الدرجه";
            alert(str);
            //return false;
        } else {
            var txtorg = document.getElementById("txtorg").value;
            if (txtorg.length == 0) {
                var str = "يرجى ادخال التخصص";
                alert(str);
                //return false;
            } else {
                //validatedate();
                var pattern = /^[\u0621-\u064A ]+$/;
                result2 = pattern.test(txtorg);
                if (result2) {
                    //form.submit();


                    if (document.getElementById('myfile').files.length === 0) {
                        var strr = "يرجى رفع ملف اللائحه الداخلية"
                        alert(strr);
                    } else {
                        var fileName = document.getElementById('myfile').files[0].name;
                        var fileSize = document.getElementById('myfile').files[0].size;
                        var fileType = document.getElementById('myfile').files[0].type;

                        if (fileType != 'application/pdf') {
                            var strr = " ملف اللائحه الداخلية يجب ان يكون pdf "
                            alert(strr);
                        } else {
                            if ((fileSize / 1048576) > 200) {
                                var strr = "ملف اللائحه الداخليه يجب أن لا يزيد حجمه عن 200 ميجا"
                                alert(strr);
                            } else {
                                if (document.getElementById('univ_emkanyat').files.length === 0) {
                                    var strr = "يرجى رفع ملف الإمكانيات البشريه"
                                    alert(strr);
                                } else {
                                    var fileName2 = document.getElementById('univ_emkanyat').files[0].name;
                                    var fileSize2 = document.getElementById('univ_emkanyat').files[0].size;
                                    var fileType2 = document.getElementById('univ_emkanyat').files[0].type;
                                    if (fileType2 != 'application/pdf') {
                                        var strr = " ملف الإمكانيات البشريه يجب ان يكون pdf "
                                        alert(strr);
                                    } else {
                                        if ((fileSize2 / 1048576) > 200) {
                                            var strr = "ملف الإمكانيات البشريه يجب ان لا يزيد حجمه عن 200 ميجا"
                                            alert(strr);
                                        } else {
                                            if (document.getElementById('univ_gadwa').files.length === 0) {
                                                var strr = "يرجى رفع ملف  أخرى "
                                                alert(strr);
                                            } else {
                                                var fileName3 = document.getElementById('univ_gadwa').files[0].name;
                                                var fileSize3 = document.getElementById('univ_gadwa').files[0].size;
                                                var fileType3 = document.getElementById('univ_gadwa').files[0].type;

                                                if (fileType3 != 'application/pdf') {
                                                    var strr = " ملف أخرى يجب ان يكون pdf "
                                                    alert(strr);
                                                } else {
                                                    if ((fileSize3 / 1048576) > 200) {
                                                        var strr = "ملف اخرى يجب ان لا يزيد حجمه عن 200 ميجا"
                                                        alert(strr);
                                                    } else {
                                                        form.submit();
                                                    }

                                                }


                                            }


                                        }
                                    }

                                }

                            }
                        }
                    }
                } else {
                    var strr = "التخصص يجب ان يكون باللغه العربيه"
                    alert(strr);
                }

            }

        }
    } else {

        form.submit();
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
</script>