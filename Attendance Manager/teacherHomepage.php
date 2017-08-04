<?php
      require 'core.inc.php';
      require 'connect.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Teacher Homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <div class="navbar-brand" href="#">
      <?php 
      if (isset($_SESSION) && !empty($_SESSION)) {
      $user_id=$_SESSION['user_name'];
            echo $user_id;
		}
		else {
      echo '<script type="text/javascript">alert("Please Login");</script>';
      echo '<script type="text/javascript">window.location="my_index.html";</script>';
      }
      ?>	
      </div>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="teacherHomepage.php">Home</a></li>
      <li><a href="viewSheets.php">View Sheets</a>
      <li><a href="teacher-interface1.php">Add</a></li>
      <li><a href="edit.php">Edit</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="Logout.php"><span class="glyphicon glyphicon-log-in"></span> Log-out</a></li>
    </ul>
  </div>
</nav>
</body>
</html>
