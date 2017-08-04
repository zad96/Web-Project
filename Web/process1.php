<?php
require 'core.inc.php';
require 'connect.inc.php';
if(isset($_POST['atten-submit']))
{
	   $absentees = $_POST['absent'];
	   $presentees = $_POST['present'];
	   $subject = $_POST['subject'];
	   $div=$_POST['division'];
	   $u_id=$_POST['uniqueid'];
	   $lec_id=$_POST['lecture'];
	   $user_id=$_SESSION['user_id'];
	   $absent_array = explode(':', $absentees);
	   $present_array = explode(':', $presentees);
	   
	   $date = date("Y/m/d");
	   $user_id = $_SESSION['user_id'];
	   $query = "select ts.id 
	   				from teacher_subject ts,subject s
	   				where ts.t_id='$user_id' and s.name='$subject' and ts.sub_id=s.sub_id and ts.d_id=$div";
	   $result = $conn->query($query);
	   $value = mysqli_fetch_object($result);
	   $t_s_id = $value->id."";
	   // $query = "insert into lecture (teach_sub_id,u_id,date)values('$t_s_id',$u_id,'$date')";
	   // $result= $conn->query($query);
	   // $at_id = mysqli_insert_id($conn);
	   $i=0;
		$query="";
		// echo count($absent_array);
			while ($i<count($absent_array)-1) {
			$a_arr=explode(';',$absent_array[$i]);
			$query="update lecture_status set status='A' where l_id=$lec_id and s_id=$a_arr[0];";
			$result=$conn->query($query);
			$i++;
		}
		$i=0;
		 while ($i<count($present_array)-2) {
		 	$p_arr=explode(';',$present_array[$i]);
		 	$query="update lecture_status set status='P' where l_id=$lec_id and s_id=$p_arr[0];";
		 	$result=$conn->query($query);
		 	$i++;
		 }
		 	$p_arr=explode(';',$present_array[$i]);
			$query="update lecture_status set status='P' where l_id=$lec_id and s_id=$p_arr[0];	";
			$result=$conn->query($query);
		// echo $query;
		//$result = $conn->query($query);
      	echo '<script type="text/javascript">alert("Successfully Submitted");</script>';
		echo '<script type="text/javascript">window.location="teacherHomepage.php";</script>';
	}
?>