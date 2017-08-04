<?php
require 'core.inc.php';
require 'connect.inc.php';

if(isset($_POST['login']))
{

	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "Select t_id,name,d_id from teacher where t_id = $username AND password = '$password'";
	$result=$conn->query($query);
	if($result->num_rows>0)
	{
		$value = mysqli_fetch_object($result);
		$user_id=$value->t_id;
		$user_name=$value->name;
		$dept=$value->d_id;
		$_SESSION['user_id']=$user_id."";
		$_SESSION['user_name']=$user_name."";
		$_SESSION['dept']=$dept."";
		header('Location: teacherHomepage.php');
	}
	else {
		echo '<script type="text/javascript">alert("Invalid Username or password");</script>';
		echo '<script type="text/javascript">window.location="my_index.html";</script>';
	}
}
?>