<?php
$servername = "localhost";
$username = "root";
$password = "";
$mysql_db="attendance";
// Create connection
// Check connection
$conn =mysqli_connect($servername, $username, $password,$mysql_db);
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
