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

    $txtarname = $_POST['txtarname']; // el univ id
    $txtarname = stripslashes($txtarname);
//    echo $txtarname;

    $request = $_POST['txtrequest'];
    $request = stripslashes($request);

    $statusselect = $_POST['statusselect'];

    $user_role = $_SESSION['roleid'];

    $univ_id = $_SESSION['univ_id'];

    $Serial = "";
    $STATUS_ID = "";
    $STATUS_VALUE = "";
    $FULLNAME = "";
    $NATIONAL_ID = "";
    $REQUEST_ID = "";

//**************************************** اختار الكل **********************************************************************//
    if ($txtarname == 0 && strlen($request) == 0 && $statusselect == 0) {
        if ($user_role == 40) {
            $selectt = ",universty_lookup.name as namee ,universty_lookup.id as idd";
            $fromm = ",universty_lookup";
            $wheree = "and universty_lookup.id = `applicant`.`univ_id` and applicant.user_role=10";

        } else if ($user_role == 50) {
            $selectt = ",academy_lookup.name as namee ,academy_lookup.id as idd";
            $fromm = ",academy_lookup";
            $wheree = "and academy_lookup.id = `applicant`.`univ_id`  and applicant.user_role=20 ";

        } else {
            $selectt = ",institute_lookup.name as namee ,institute_lookup.id as idd";
            $fromm = ",institute_lookup";
            $wheree = "and institute_lookup.id = `applicant`.`univ_id`  and applicant.user_role=30";

        }
    }
//**************************************** إختار حاله بس **********************************************************************//
    if ($txtarname == 0 && strlen($request) == 0 && $statusselect != 0) {
        if ($user_role == 40) {
            $selectt = ",universty_lookup.name as namee ,universty_lookup.id as idd";
            $fromm = ",universty_lookup";
            $wheree = "and universty_lookup.id = `applicant`.`univ_id` and status.STATUS_ID=$statusselect  and applicant.user_role=10";

        } else if ($user_role == 50) {
            $selectt = ",academy_lookup.name as namee ,academy_lookup.id as idd";
            $fromm = ",academy_lookup";
            $wheree = "and academy_lookup.id = `applicant`.`univ_id`  and status.STATUS_ID=$statusselect and applicant.user_role=20";

        } else {
            $selectt = ",institute_lookup.name as namee ,institute_lookup.id as idd";
            $fromm = ",institute_lookup";
            $wheree = "and institute_lookup.id = `applicant`.`univ_id`  and status.STATUS_ID=$statusselect  and applicant.user_role=30";

        }
    }
//**************************************** إختار رقم طلب بس **********************************************************************//
    if ($txtarname == 0 && strlen($request) != 0 && $statusselect == 0) {
        if ($user_role == 40) {
            $selectt = ",universty_lookup.name as namee ,universty_lookup.id as idd";
            $fromm = ",universty_lookup";
            $wheree = "and universty_lookup.id = `applicant`.`univ_id` and  `request`.`REQUEST_ID` = $request  and applicant.user_role=10";

        } else if ($user_role == 50) {
            $selectt = ",academy_lookup.name as namee ,academy_lookup.id as idd";
            $fromm = ",academy_lookup";
            $wheree = "and academy_lookup.id = `applicant`.`univ_id`  and `request`.`REQUEST_ID` = $request and applicant.user_role=20";

        } else {
            $selectt = ",institute_lookup.name as namee ,institute_lookup.id as idd";
            $fromm = ",institute_lookup";
            $wheree = "and institute_lookup.id = `applicant`.`univ_id`  and `request`.`REQUEST_ID` = $request and applicant.user_role=30";

        }
    }
//**************************************** إختار رقم طلب و حاله  **********************************************************************//
    if ($txtarname == 0 && strlen($request) != 0 && $statusselect != 0) {
        if ($user_role == 40) {
            $selectt = ",universty_lookup.name as namee ,universty_lookup.id as idd";
            $fromm = ",universty_lookup";
            $wheree = "and universty_lookup.id = `applicant`.`univ_id` and  `request`.`REQUEST_ID` = $request and status.STATUS_ID=$statusselect and applicant.user_role=10";

        } else if ($user_role == 50) {
            $selectt = ",academy_lookup.name as namee ,academy_lookup.id as idd";
            $fromm = ",academy_lookup";
            $wheree = "and academy_lookup.id = `applicant`.`univ_id`  and `request`.`REQUEST_ID` = $request and status.STATUS_ID=$statusselect  and applicant.user_role=20";

        } else {
            $selectt = ",institute_lookup.name as namee ,institute_lookup.id as idd";
            $fromm = ",institute_lookup";
            $wheree = "and institute_lookup.id = `applicant`.`univ_id`  and `request`.`REQUEST_ID` = $request and status.STATUS_ID=$statusselect  and applicant.user_role=30";

        }
    }
//**************************************** إختار جامعه بس **********************************************************************//
    if ($txtarname != 0 && strlen($request) == 0 && $statusselect == 0) {
        if ($user_role == 40) {
            $selectt = ",universty_lookup.name as namee ,universty_lookup.id as idd";
            $fromm = ",universty_lookup";
            $wheree = "and universty_lookup.id = `applicant`.`univ_id` and  `universty_lookup`.`id` =$txtarname  and applicant.user_role=10";

        } else if ($user_role == 50) {
            $selectt = ",academy_lookup.name as namee ,academy_lookup.id as idd";
            $fromm = ",academy_lookup";
            $wheree = "and academy_lookup.id = `applicant`.`univ_id`  and  `academy_lookup`.`id` =$txtarname and applicant.user_role=20";

        } else {
            $selectt = ",institute_lookup.name as namee ,institute_lookup.id as idd";
            $fromm = ",institute_lookup";
            $wheree = "and institute_lookup.id = `applicant`.`univ_id`  and  `institute_lookup`.`id` =$txtarname and applicant.user_role=30";

        }
    }
//**************************************** إختار جامعه و حاله **********************************************************************//
    if ($txtarname != 0 && strlen($request) == 0 && $statusselect != 0) {
        if ($user_role == 40) {
            $selectt = ",universty_lookup.name as namee ,universty_lookup.id as idd";
            $fromm = ",universty_lookup";
            $wheree = "and universty_lookup.id = `applicant`.`univ_id` and  `universty_lookup`.`id` =$txtarname and status.STATUS_ID=$statusselect  and applicant.user_role=10";

        } else if ($user_role == 50) {
            $selectt = ",academy_lookup.name as namee ,academy_lookup.id as idd";
            $fromm = ",academy_lookup";
            $wheree = "and academy_lookup.id = `applicant`.`univ_id`  and  `academy_lookup`.`id` =$txtarname and status.STATUS_ID=$statusselect  and applicant.user_role=20";

        } else {
            $selectt = ",institute_lookup.name as namee ,institute_lookup.id as idd";
            $fromm = ",institute_lookup";
            $wheree = "and institute_lookup.id = `applicant`.`univ_id`  and  `institute_lookup`.`id` =$txtarname and status.STATUS_ID=$statusselect and applicant.user_role=30";

        }
    }

//**************************************** إختار جامعه و رقم طلب **********************************************************************//
    if ($txtarname != 0 && strlen($request) != 0 && $statusselect == 0) {
        if ($user_role == 40) {
            $selectt = ",universty_lookup.name as namee ,universty_lookup.id as idd";
            $fromm = ",universty_lookup";
            $wheree = "and universty_lookup.id = `applicant`.`univ_id` and  `universty_lookup`.`id` =$txtarname  and `request`.`REQUEST_ID` = $request  and applicant.user_role=10";

        } else if ($user_role == 50) {
            $selectt = ",academy_lookup.name as namee ,academy_lookup.id as idd";
            $fromm = ",academy_lookup";
            $wheree = "and academy_lookup.id = `applicant`.`univ_id`  and  `academy_lookup`.`id` =$txtarname  and `request`.`REQUEST_ID` = $request and applicant.user_role=20";

        } else {
            $selectt = ",institute_lookup.name as namee ,institute_lookup.id as idd";
            $fromm = ",institute_lookup";
            $wheree = "and institute_lookup.id = `applicant`.`univ_id`  and  `institute_lookup`.`id` =$txtarname  and `request`.`REQUEST_ID` = $request and applicant.user_role=30";

        }
    }
//****************************************  إختار جامعه و طلب و حاله**********************************************************************//
    if ($txtarname != 0 && strlen($request) != 0 && $statusselect != 0) {
        if ($user_role == 40) {
            $selectt = ",universty_lookup.name as namee ,universty_lookup.id as idd";
            $fromm = ",universty_lookup";
            $wheree = "and universty_lookup.id = `applicant`.`univ_id` and  `universty_lookup`.`id` =$txtarname  and `request`.`REQUEST_ID` = $request and status.STATUS_ID=$statusselect and  applicant.user_role=10";

        } else if ($user_role == 50) {
            $selectt = ",academy_lookup.name as namee ,academy_lookup.id as idd";
            $fromm = ",academy_lookup";
            $wheree = "and academy_lookup.id = `applicant`.`univ_id`  and  `academy_lookup`.`id` =$txtarname  and `request`.`REQUEST_ID` = $request and status.STATUS_ID=$statusselect and applicant.user_role=20";

        } else {
            $selectt = ",institute_lookup.name as namee ,institute_lookup.id as idd";
            $fromm = ",institute_lookup";
            $wheree = "and institute_lookup.id = `applicant`.`univ_id`  and  `institute_lookup`.`id` =$txtarname  and `request`.`REQUEST_ID` = $request and status.STATUS_ID=$statusselect and applicant.user_role=30";

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

    $sql = "SELECT DISTINCT applicant.`Serial` as app_serial $selectt ,`degree`,degree.name as deg_name,`FK_matlob`,matlob.matlob_NAME,request.StatusID,request.REQUEST_ID,status.STATUS_VALUE,status.STATUS_ID,`request`.`destination`,
  `request`.`univ_destination`,`request`.`univ_emkanyat`,`request`.`univ_gadwa`,`request`.`scu_destination`,`request`.`mozakera_dest` ,`request`.`estefaa_dest` ,`request`.`estefa2`,`request`.`accept_dest`
  ,`request`.`keta3_estefaa_dest`,ss.datelog
FROM applicant $fromm ,matlob,status,degree,status_log,request

inner join
(
    select sl.fk_request_id,sl.fk_status_id, max(sl.`date`) as datelog,max(sl.id) as log_maxid
    from status_log sl
    group by sl.fk_request_id
) ss on (ss.`fk_request_id`= request.REQUEST_ID)

where applicant.FK_matlob=matlob.matlob_ID
 and status.STATUS_ID=request.StatusID
and request.FK_Applicant_serial = `applicant`.`Serial`
and degree.id=`applicant`.`fk_degree`
AND status_log.fk_request_id = request.REQUEST_ID
AND status_log.fk_status_id = request.StatusID
$wheree

ORDER BY ss.datelog DESC";

    /* SELECT DISTINCT request.REQUEST_ID,request.StatusID FROM `status_log`,request WHERE status_log.fk_request_id = request.REQUEST_ID AND request.StatusID NOT IN (SELECT status_log.fk_status_id FROM status_log WHERE status_log.fk_request_id = request.REQUEST_ID) ORDER BY `request`.`REQUEST_ID` ASC;

    $sql ="SELECT applicant.`Serial` as app_serial $selectt ,`degree`,degree.name as deg_name,`FK_matlob`,matlob.matlob_NAME,request.StatusID,request.REQUEST_ID,status.STATUS_VALUE,status.STATUS_ID,`request`.`destination`,
    `request`.`univ_destination`,`request`.`univ_emkanyat`,`request`.`univ_gadwa`,`request`.`scu_destination`,`request`.`mozakera_dest` , max(`date`) as datelog
    FROM applicant , request $fromm ,matlob,status,degree,status_log
    where

    applicant.FK_matlob=matlob.matlob_ID
    and status.STATUS_ID=request.StatusID
    and request.FK_Applicant_serial = `applicant`.`Serial`
    and degree.id=`applicant`.`fk_degree`
    and `status_log`.`fk_request_id`= request.REQUEST_ID
    and `status_log`.`fk_status_id`= request.StatusID

    $wheree

    ";*/

    /*$sql ="SELECT applicant.`Serial` as app_serial $selectt ,`degree`,degree.name as deg_name,`FK_matlob`,matlob.matlob_NAME,request.StatusID,request.REQUEST_ID,status.STATUS_VALUE,status.STATUS_ID,`request`.`destination`,`request`.`univ_destination`,`request`.`univ_emkanyat`,`request`.`univ_gadwa`,`request`.`scu_destination`,`request`.`mozakera_dest`
    FROM applicant , request $fromm ,matlob,status,degree
    where

    applicant.FK_matlob=matlob.matlob_ID
    and status.STATUS_ID=request.StatusID
    and request.FK_Applicant_serial = `applicant`.`Serial`
    and degree.id=`applicant`.`fk_degree`

    $wheree

    ";*/
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
  <table class="table table-striped table-hover text-center table-bordered stylee"
            style="margin-bottom: 15px;">

    <thead class="thead-dark" style="background-color:#333; color:#fff;"><tr>
	<th> المذكره </th>
	<th> تقرير لجنة القطاع </th>
	<th> خطاب الأمين</th>
	<th> ملاحظات الاستيفاء </th>
	<th> ملف الاستيفاء </th>
	<th> ملف موافقة لجنة القطاع </th>
	<th> ملف الاستيفاء بعد رد لجنة القطاع </th>
	<th> اخرى </th>
	<th>الإمكانيات البشريه	</th>
	<th> اللائحه </th>
<th> القطاع </th>
<th> الأمر</th>
<th>تاريخ الحاله</th>
<th>الحالة</th>
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
            $STATUS_ID = $row['StatusID'];

            $STATUS_VALUE = $row['STATUS_VALUE'];
            $degree = $row['degree'];
            $matlob_NAME = $row['matlob_NAME'];
            $FK_matlob = $row['FK_matlob'];
            $REQUEST_ID = $row['REQUEST_ID'];
            $_SESSION['REQUEST_ID'] = $REQUEST_ID;

            $namee = $row['namee'];
            $idd = $row['idd'];
            $deg_name = $row['deg_name'];
            $datetime_formate = $row['datelog'];
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

/*$qlog="SELECT max(`date`) as datelog FROM `status_log` where `fk_request_id`=? and `fk_status_id`=?";
$stmtlog = $con->prepare($qlog);
$stmtlog->bind_param("ss", $REQUEST_ID,$STATUS_ID);
$stmtlog->execute();
$reslog = $stmtlog->get_result();
$nlog =$stmt->affected_rows;

if($nlog > 0)
{

while($rowlog = $reslog->fetch_array(MYSQLI_ASSOC)) {*/

            if ($STATUS_ID == '1' || $STATUS_ID == '4' || $STATUS_ID == '13') {

                echo ' <tr>
	 	  <td class="text-center"> </td>
		  	  <td class="text-center"> </td>
			  <td class="text-center"> </td>
              <td class="text-center">' . $row['estefa2'] . '</td>';
                if ($row['estefaa_dest'] != "") {
                    echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                } else {
                    echo '<td class="text-center"> </td>';
                }
                if ($row['accept_dest'] != "") {
                    echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['accept_dest'] . '" target="_blank" >عرض</a>  </td>';
                } else {
                    echo '<td class="text-center"> </td>';
                }
                if ($row['keta3_estefaa_dest'] != "") {
                    echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['keta3_estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                } else {
                    echo '<td class="text-center"> </td>';
                }

                echo '
				 <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>

	  <td class="text-center"> </td>

	 	   <td class="text-center"><a  href="3ard.php?id=' . $row['app_serial'] . '">عرض للمراجعه</a> </td>
';

                echo '	 <td class="text-center">' . $format_date . ' </td>';

                echo '

		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $deg_name . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                echo '</tr>';

                ?>





<?php
} else if ($STATUS_ID == '2') {

                echo '<tr>
		 	  <td class="text-center"> </td>
		  	  <td class="text-center"> </td>
			  <td class="text-center"> </td>
			  <td class="text-center"> </td>
			  <td class="text-center"> </td>
			  ';
                if ($row['accept_dest'] != "") {
                    echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['accept_dest'] . '" target="_blank" >عرض</a>  </td>';
                } else {
                    echo '<td class="text-center"> </td>';
                }if ($row['keta3_estefaa_dest'] != "") {
                    echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['keta3_estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                } else {
                    echo '<td class="text-center"> </td>';
                }

                echo '
			  			  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>

	<td class="text-center"> </td>
	 	   <td class="text-center"><a  href="selct_keta3.php?id=' . $row['app_serial'] . '">إختيار لجنة قطاع</a> </td>



';
//$datetime_formate=$rowlog['datelog'];
                //$format_date = date("Y-m-d", strtotime($datetime_formate));

                echo '	 <td class="text-center">' . $format_date . ' </td>';

                echo '
		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $deg_name . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                echo '</tr>';
            } else if ($STATUS_ID == '3') {

                echo '<tr>
		 	  <td class="text-center"> </td>
		  	  <td class="text-center"> </td>
			  <td class="text-center"> </td>
			  <td class="text-center">' . $row['estefa2'] . '</td>';
                if ($row['estefaa_dest'] != "") {
                    echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                } else {
                    echo '<td class="text-center"> </td>';
                }

                if ($row['accept_dest'] != "") {
                    echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['accept_dest'] . '" target="_blank" >عرض</a>  </td>';
                } else {
                    echo '<td class="text-center"> </td>';
                }if ($row['keta3_estefaa_dest'] != "") {
                    echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['keta3_estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                } else {
                    echo '<td class="text-center"> </td>';
                }

                echo '
				<td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>
	<td class="text-center"> </td>
	 	   <td class="text-center">فى انتظار استيفاء الجامعه</td>



';
//$datetime_formate=$rowlog['datelog'];
                //$format_date = date("Y-m-d", strtotime($datetime_formate));

                echo '	 <td class="text-center">' . $format_date . ' </td>';

                echo '
		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $deg_name . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                echo '</tr>';
            } else if ($STATUS_ID == '8') // استيفاء من لجنة القطاع
            {
                $sqlx = "select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3
FROM  request,keta3
where
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?

 ";
//echo $sql;
                //

                $stmtx = $con->prepare($sqlx);
                $stmtx->bind_param("s", $row['REQUEST_ID']);
                $stmtx->execute();
                $resx = $stmtx->get_result();

                $nx = $stmtx->affected_rows;

                if ($nx > 0) {
                    while ($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
                        echo '
	 <tr>
	 <td class="text-center"> </td>
	 	 	  <td class="text-center"> <a  href="3ardfile.php?id=' . $row['destination'] . '" target="_blank" >عرض</a>  </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['scu_destination'] . '" target="_blank" >عرض</a>   </td>
			  <td class="text-center"> </td>
			  <td class="text-center"> </td>';
                        if ($row['accept_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['accept_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }if ($row['keta3_estefaa_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['keta3_estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }

                        echo '
			  			  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>
	<td class="text-center"> ' . $rowx['keta3_VALUE'] . '</td>';
                    }
                }

                echo '

	 	   <td class="text-center">فى انتظار استيفاء الجامعه</td>


';
//$datetime_formate=$rowlog['datelog'];
                //$format_date = date("Y-m-d", strtotime($datetime_formate));

                echo '	 <td class="text-center">' . $format_date . ' </td>';

                echo '

		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $deg_name . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                echo '</tr>';
            } else if ($STATUS_ID == '5') {

                $sqlx = "select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3
FROM  request,keta3
where
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?

 ";
//echo $sql;
                //

                $stmtx = $con->prepare($sqlx);
                $stmtx->bind_param("s", $row['REQUEST_ID']);
                $stmtx->execute();
                $resx = $stmtx->get_result();

                $nx = $stmtx->affected_rows;

                if ($nx > 0) {
                    while ($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
                        echo '
	 <tr ' . $style . '>
	 <td class="text-center"> </td>
	 	 	 	 <td class="text-center"> </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['scu_destination'] . '" target="_blank" >عرض</a>   </td>
			  <td class="text-center">' . $row['estefa2'] . '</td>';
                        if ($row['estefaa_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }
                        if ($row['accept_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['accept_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }if ($row['keta3_estefaa_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['keta3_estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }

                        echo '
			  			  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  <td class="text-center"> <a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>

	<td class="text-center"> ' . $rowx['keta3_VALUE'] . '</td>';
                    }
                }

                echo '
	 	 <td class="text-center">فى انتظار تقرير لجنة القطاع</td>


';
//$datetime_formate=$rowlog['datelog'];
                //$format_date = date("Y-m-d", strtotime($datetime_formate));

                echo '	 <td class="text-center">' . $format_date . ' </td>';

                echo '

		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $deg_name . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                echo '</tr>';
            } else if ($STATUS_ID == '10') {
                $sqlx = "select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3
FROM  request,keta3
where
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?

 ";
//echo $sql;
                //

                $stmtx = $con->prepare($sqlx);
                $stmtx->bind_param("s", $row['REQUEST_ID']);
                $stmtx->execute();
                $resx = $stmtx->get_result();

                $nx = $stmtx->affected_rows;

                if ($nx > 0) {
                    while ($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
                        echo '
	 <tr>
	  <td class="text-center"> <a  href="3ardfile.php?id=' . $row['mozakera_dest'] . '" target="_blank" >عرض</a>  </td>
	 	 	 	  <td class="text-center"> <a  href="3ardfile.php?id=' . $row['destination'] . '" target="_blank" >عرض</a>  </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['scu_destination'] . '" target="_blank" >عرض</a>   </td>
			  <td class="text-center"> </td>
			  <td class="text-center"> </td>';
                        if ($row['accept_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['accept_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }if ($row['keta3_estefaa_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['keta3_estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }

                        echo '
			  			  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>
	<td class="text-center"> ' . $rowx['keta3_VALUE'] . '</td>';
                    }
                }

                echo '
	 	 <td class="text-center"><a  href="report_mo3adalat.php?id=' . $row['app_serial'] . '">إضافة توصيه أو قرار</a></td>

';
//$datetime_formate=$rowlog['datelog'];
                //$format_date = date("Y-m-d", strtotime($datetime_formate));

                echo '	 <td class="text-center">' . $format_date . ' </td>';

                echo '
		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $deg_name . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                echo '</tr>';
            } else if ($STATUS_ID == '6' || $STATUS_ID == '7'|| $STATUS_ID == '9') {

                $sqlx = "select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3
FROM  request,keta3
where
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?

 ";
//echo $sql;
                //

                $stmtx = $con->prepare($sqlx);
                $stmtx->bind_param("s", $row['REQUEST_ID']);
                $stmtx->execute();
                $resx = $stmtx->get_result();

                $nx = $stmtx->affected_rows;

                if ($nx > 0) {
                    while ($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
                        echo '
	 <tr>
	  <td class="text-center"> </td>
	 	 	 	  <td class="text-center"> <a  href="3ardfile.php?id=' . $row['destination'] . '" target="_blank" >عرض</a>  </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['scu_destination'] . '" target="_blank" >عرض</a>   </td>
			  <td class="text-center"> </td>
			  <td class="text-center"> </td>';
                        if ($row['accept_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['accept_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }if ($row['keta3_estefaa_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['keta3_estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }

                        echo '
			  			  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>
	<td class="text-center"> ' . $rowx['keta3_VALUE'] . '</td>';
                    }
                }

                echo '
	 	   <td class="text-center"><a  href="report_keta3.php?id=' . $row['app_serial'] . '">عرض تقرير لجنة القطاع</a> </td>


';
//$datetime_formate=$rowlog['datelog'];
                //$format_date = date("Y-m-d", strtotime($datetime_formate));

                echo '	 <td class="text-center">' . $format_date . ' </td>';

                echo '

		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $deg_name . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                echo '</tr>';
            } else if ($STATUS_ID == '9') {

                $sqlx = "select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3
FROM  request,keta3
where
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?

 ";
//echo $sql;
                //

                $stmtx = $con->prepare($sqlx);
                $stmtx->bind_param("s", $row['REQUEST_ID']);
                $stmtx->execute();
                $resx = $stmtx->get_result();

                $nx = $stmtx->affected_rows;

                if ($nx > 0) {
                    while ($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
                        echo '
	 <tr>
	 <td class="text-center"> </td>
	 	 	 	  <td class="text-center"> <a  href="3ardfile.php?id=' . $row['destination'] . '" target="_blank" >عرض</a>  </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['scu_destination'] . '" target="_blank" >عرض</a>   </td>
			  <td class="text-center"> </td>
			  <td class="text-center"> </td>';
                        if ($row['accept_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['accept_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }if ($row['keta3_estefaa_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['keta3_estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }

                        echo '
			  			  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>
	<td class="text-center"> ' . $rowx['keta3_VALUE'] . '</td>';
                    }
                }

                echo '

	 	   <td class="text-center"><a  href="selct_mo3adalat.php?id=' . $row['app_serial'] . '">إسناد لجنة معادلات و رفع المزكره</a> </td>

';
//$datetime_formate=$rowlog['datelog'];
                //$format_date = date("Y-m-d", strtotime($datetime_formate));

                echo '	 <td class="text-center">' . $format_date . ' </td>';

                echo '
		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $deg_name . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                echo '</tr>';
            } else if ($STATUS_ID == '11' || $STATUS_ID == '12') {
                $sqlx = "select request.fk_keta3 ,keta3.keta3_VALUE,request.fk_keta3
FROM  request,keta3
where
request.fk_keta3=keta3.keta3_ID
and request.REQUEST_ID=?

 ";
//echo $sql;
                //

                $stmtx = $con->prepare($sqlx);
                $stmtx->bind_param("s", $row['REQUEST_ID']);
                $stmtx->execute();
                $resx = $stmtx->get_result();

                $nx = $stmtx->affected_rows;

                if ($nx > 0) {
                    while ($rowx = $resx->fetch_array(MYSQLI_ASSOC)) {
                        echo '
	 <tr>
	 <td class="text-center"> <a  href="3ardfile.php?id=' . $row['mozakera_dest'] . '" target="_blank" >عرض</a>  </td>
	 	 	 	  <td class="text-center"> <a  href="3ardfile.php?id=' . $row['destination'] . '" target="_blank" >عرض</a>  </td>
		  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['scu_destination'] . '" target="_blank" >عرض</a>   </td>
			  <td class="text-center"> </td>
			  <td class="text-center"> </td>';
                        if ($row['accept_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['accept_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }if ($row['keta3_estefaa_dest'] != "") {
                            echo ' <td class="text-center"><a  href="3ardfile.php?id=' . $row['keta3_estefaa_dest'] . '" target="_blank" >عرض</a>  </td>';
                        } else {
                            echo '<td class="text-center"> </td>';
                        }

                        echo '
			  			  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_gadwa'] . '" target="_blank" >عرض</a>  </td>
			   <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_emkanyat'] . '" target="_blank" >عرض</a>  </td>
			  	  <td class="text-center"><a  href="3ardfile.php?id=' . $row['univ_destination'] . '" target="_blank" >عرض</a>  </td>
	<td class="text-center"> ' . $rowx['keta3_VALUE'] . '</td>';
                    }
                }

                echo '
	 	    <td class="text-center"><a  href="update_univ_mo3adalat22.php?id=' . $row['app_serial'] . '">تعديل التوصية أو القرار</a> </td>


';
//$datetime_formate=$rowlog['datelog'];
                //$format_date = date("Y-m-d", strtotime($datetime_formate));

                echo '	 <td class="text-center">' . $format_date . ' </td>';

                echo '

		 <td class="text-center">' . $row['STATUS_VALUE'] . ' </td>
        	<td class="text-center">' . $row['matlob_NAME'] . ' </td>
<td class="text-center">' . $row['degree'] . ' </td>
<td class="text-center">' . $deg_name . ' </td>
<td class="text-center">' . $row['REQUEST_ID'] . ' </td>
			  <td class="text-center">' . $row['namee'] . ' </td>



			';

                echo '</tr>';
            } else {
                echo '
  <div align="center" class="style1" style="color:#FF0000">
        <h2>لا يوجد بيانات</h2>
		 ';

                echo ' <td align="center" ><div align="center" class="style1" style="color:#FF0000"> <a href="emp_search3.php"> للرجوع للصفحة السابقة اضغط هنا </a> </div> </td>';

            }

//}
            //}
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