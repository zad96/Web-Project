<?php
require 'core.inc.php';
require 'connect.inc.php';
if(isset($_POST['atten-submit']))
{
	   $absentees = $_POST['absent'];
	   $presentees = $_POST['present'];
	   $subject = $_POST['subject'];
	   $year= $_POST['year'];
	   $div=$_POST['division'];
	   $u_id=$_POST['uniqueid'];
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
	   $query = "insert into lecture (teach_sub_id,u_id,date)values('$t_s_id',$u_id,'$date')";
	   $result= $conn->query($query);
	   $at_id = mysqli_insert_id($conn);
	   $query = "insert into lecture_status (l_id,s_id,status)values ";
	   $i=0;
		
		while ($i<count($absent_array)-1) {
			$query.="($at_id,$absent_array[$i],'A') , ";
			$i++;
		}
		$i=0;
		 while ($i<count($present_array)-2) {
		 	$query.="($at_id,$present_array[$i],'P') , ";
		 	$i++;
		 }
			$query.="($at_id,$present_array[$i],'P') ;";
		$result = $conn->query($query);
		 if($result==true){
      			echo '<script type="text/javascript">alert("Successfully Submitted");</script>';
				echo '<script type="text/javascript">window.location="teacherHomepage.php";</script>';
		 			}   
	}
?>