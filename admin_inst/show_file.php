<?php
include_once("header.php");
?>

<body>


      <?php
	  

	echo'

  <table class="table table-striped table-hover text-center table-bordered stylee"
            style="margin-bottom: 15px;">

    <thead class="thead-dark" style="background-color:#333; color:#fff;"><tr>
<th> الجواب</th>
<th> تاريخ ارسال الجواب</th>
<th> رقم الجواب</th>
       </tr>
    </thead>
    <tbody>';
	
	$q="SELECT `file_destination`, `user_from_id`, `file_date` FROM `file_uploads` WHERE `user_to_role` = 130 ORDER BY `file_date` DESC ";
	  $stmt = $con->prepare($q);
		$stmt->execute();
		$res = $stmt->get_result();
		$n =$stmt->affected_rows;
//echo '--------------------------------------'.$n;
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
	
		    
			$file_destination=$row['file_destination'];
			$file_date=$row['file_date'];
            $n= 1;

echo'<tr>
 <td class="text-center"><a  href="3ardfile.php?id='.$row['file_destination'].'" target="_blank" >عرض</a>  </td>
 <td class="text-center">'.$file_date.'</td>
 <td class="text-center">'.$n.'</td>
 </tr>
 ';
 $n++;
 }
 echo'</tbody></table>';

include_once("footer.php");
