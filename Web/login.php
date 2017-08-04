<?php
require 'core.inc.php';
require 'connect.inc.php';
include 'my_index.html';
if(isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
	// if(!empty($username)&&!empty($password)){
	// 	echo 'ok.';
	// }
}
	// else{
	// echo 'you must supply a username and password';
	// }

//}
?>