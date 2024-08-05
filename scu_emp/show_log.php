<?php
include_once("header.php");
?>

<body>


      <?php
	  
	  
	
	  
	$reqid=$_GET['reqid'];

	echo'

  <table class="table table-striped table-hover">

    <thead><tr>
<th>تاريخ الحاله</th>
<th>ملف استيفاء لجنة القطاع</th>
<th>ملف موافقة لجنة القطاع</th>
<th>الحاله</th>
<th> المطلوب عمله</th>
<th> التخصص</th>
<th> الدرجه</th>
<th> رقم الطلب</th>
       </tr>
    </thead>
    <tbody>';
	
	$q="SELECT status_log.`fk_status_id` ,
status_log.`date` as status_date,
applicant.fk_degree,
degree.name as degree_name,
applicant.degree as special_name,
applicant.FK_matlob,
matlob.matlob_NAME as matlob_name ,
status.STATUS_VALUE as status_name,
request.accept_dest,
request.keta3_estefaa_dest
FROM `status_log` ,request,applicant,status,matlob,degree

where
`fk_request_id`=?
and request.REQUEST_ID=status_log.fk_request_id
and request.FK_Applicant_serial=applicant.Serial
and status.STATUS_ID=status_log.fk_status_id
and matlob.matlob_ID=applicant.FK_matlob
and degree.id= applicant.fk_degree
order by `date`";

	
	//echo $q; 
	// $con->set_charset("utf8");
	  $stmt = $con->prepare($q);
		/* Execute statement */
	  
	  $stmt->bind_param('s',$reqid);
	
		$stmt->execute();
		$res = $stmt->get_result();
		$n =$stmt->affected_rows;
//echo '--------------------------------------'.$n;
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
	
		    
			$degree_name=$row['degree_name'];
			$special_name=$row['special_name'];
			$fk_status_id=$row['fk_status_id'];
			$matlob_name=$row['matlob_name'];
			$status_name=$row['status_name'];
			$status_date=$row['status_date'];
			$accept_dest=$row['accept_dest'];
			$keta3_estefaa_dest=$row['keta3_estefaa_dest'];

 $datetime_formate=$status_date;
$format_date = date("Y-m-d", strtotime($datetime_formate));

echo'<tr>
 <td class="text-center">'.$format_date.'</td>';
 
 if($fk_status_id == 8 && $keta3_estefaa_dest !=""){
 echo' <td class="text-center"><a  href="3ardfile.php?id='.$row['keta3_estefaa_dest'].'" target="_blank" >عرض</a>  </td>';
			  }else{
				echo '<td class="text-center"> </td>';
			  }
			  if($fk_status_id == 10 && $accept_dest !=""){
 echo' <td class="text-center"><a  href="3ardfile.php?id='.$row['accept_dest'].'" target="_blank" >عرض</a>  </td>';
			  }else{
				echo '<td class="text-center"> </td>';
			  }
			echo'
 <td class="text-center">'.$status_name.'</td>
 <td class="text-center">'.$matlob_name.'</td>
 <td class="text-center">'.$special_name.'</td>
 <td class="text-center">'.$degree_name.'</td>
 <td class="text-center">'.$reqid.'</td> 
 </tr>
 ';
 }
 echo'</tbody></table>';

include_once("footer.php");
