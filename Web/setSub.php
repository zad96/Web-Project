<?php
      require 'core.inc.php';
      require 'connect.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>SubSelect</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .form-group{
      width: 400px;
      margin:100px auto;
    }
    </style>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <div class="navbar-brand" href="#">
      <?php 
      if (isset($_SESSION) && !empty($_SESSION)) {
          $user_id=$_SESSION['user_id'];
            echo $user_id;
            $query="Select u_id from students where id='$user_id'";
              $result=$conn->query($query);
              $value=mysqli_fetch_object($result);
              $u_id=$value->u_id;
              $_SESSION['u_id']=$u_id;
    		}
		else {
			echo '<script type="text/javascript">alert("Please Login");</script>';
      echo '<script type="text/javascript">window.location="my_index.html";</script>';
    }
      ?>	
      </div>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="studentHomepage.php">Home</a></li>
      <li class="active"><a href="setSub.php">View</a></li>
      <li><a href="setSubCalc.php">Calculate</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="Logout.php"><span class="glyphicon glyphicon-log-in"></span> Log-out</a></li>
    </ul>
  </div>
</nav>
<?php
$u_id=$_SESSION['u_id'];
$query = "Select s.name
			from subject s , dept_yr_div d 
			where d.id=$u_id and s.year=d.y_id";
 $result=$conn->query($query);
 $i=0;
  while ($row=mysqli_fetch_row($result)) {
    $arr[$i]=implode(";",$row);
    $i++;
  }
  $i=0;

  echo '<form action="viewdata.php" method="GET" id="selsub" name="selsub"><div class="form-group">';
  		echo '<h1>View Attendance</h1><br><br>';
echo '<label>Select Subject name</label>
		<select class="form-control" id="choose_div" name="sel_sub">
		<option>all</option>';
		while ($i<count($arr)) {
          echo '<option>'.$arr[$i].'</option>';
          $i++;
        }
                
echo '</select><br><br><button type="submit" class="btn btn-primary" name="generate">View Attendance</button>
      </div></from>';       
?>

</body>
</html>