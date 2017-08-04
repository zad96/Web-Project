<?php
      require 'core.inc.php';
      require 'connect.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Select Subjects</title>
  <meta charset="UTF-8">
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
      $user_name=$_SESSION['user_name'];
            echo $user_name;
            $user_id=$_SESSION['user_id'];
    }
    else {
      echo '<script type="text/javascript">alert("Please Login");</script>';
      echo '<script type="text/javascript">window.location="my_index.html";</script>';
     } 
      ?>  
      </div>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="teacherHomepage.php">Home</a></li>
      <li class="active"><a href="viewSheets.php">View Sheets</a>
      <li><a href="teacher-interface1.php">Add</a></li>
      <li><a href="edit.php">Edit</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="Logout.php"><span class="glyphicon glyphicon-log-in"></span> Log-out</a></li>
    </ul>
  </div>
</nav>
<?php
$query="select l.l_id,l.date,s.name,d.name 
        from lecture l, teacher_subject ts,subject s ,division d
        where ts.t_id=$user_id and ts.id=l.teach_sub_id and ts.sub_id=s.sub_id and ts.d_id=d.div_id";
$result=$conn->query($query);
 $arr="";
  while ($row=mysqli_fetch_row($result)) {
    $arr.=implode(" ",$row)." ";
  }
  $sheets = explode(' ', $arr);

echo '
<div class="container">
  <h1>Your Sheets</h1>
  <table id="sheetList" class="table table-hover">
    <thead>
      <tr>
        <th>lec.No</th>
        <th>date</th>
        <th>subject</th>
        <th>division</th>
      </tr>
    </thead>
<tbody>';
$i=0;
while ($i<count($sheets)-1) {
        echo '<tr>
        <td>'.$sheets[$i].'</td>';
        $i++;
        echo '<td>'.$sheets[$i].'</td>';
        $i++;
        echo '<td>'.$sheets[$i].'</td>';
        $i++;
        echo '<td>'.$sheets[$i].'</td>';
        $i++;

      echo'</tr>';
      }
?>
</body>
<script type="text/javascript">
  $('#sheetList').find('tr').click( function(){
    var row = $(this).find('td:first').text();
    window.location = 'sheet.php' + '?data=' + row;

  });
</script>
</html>