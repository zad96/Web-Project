<?php
require 'core.inc.php';
require 'connect.inc.php';

if(isset($_POST['login']))
{

	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "Select id,u_id from students where id = $username AND password = '$password'";
	$result=$conn->query($query);
	if($result->num_rows>0)
	{
		$value = mysqli_fetch_object($result);
		$user_id=$value->id;
		$u_id=$value->u_id;

		$_SESSION['user_id']=$user_id."";
		$_SESSION['u_id']=$u_id."";

		header('Location:studentHomepage.php');
	}
	else {
		echo '<script type="text/javascript">alert("Invalid Username or password");</script>';
		echo '<script type="text/javascript">window.location="my_index.html";</script>';

	}
}
?>