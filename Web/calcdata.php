<?php
      require 'core.inc.php';
      require 'connect.inc.php';
?>
<?php
if(isset($_GET['generate'])){
  $sub=$_GET['sel_sub'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Calculated</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <style>
    .container{
      width: 550px;
      margin:100px auto;
    }
    </style>
</head>
<body>
<?php //date lecture teacher status
$user_id=$_SESSION['user_id'];
$u_id=$_SESSION['u_id'];
if ($sub=='all') {
$query="Select count(ls.status) as tot
       from lecture l , lecture_status ls , teacher_subject ts , teacher t , subject s 
       where l.u_id=$u_id and l.l_id=ls.l_id and ls.s_id=$user_id and l.teach_sub_id=ts.id and ts.t_id=t.t_id and ts.sub_id=s.sub_id and ls.status='P'";
       //echo $query;
$result=$conn->query($query);
              $value=mysqli_fetch_object($result);
              $totalP=$value->tot;
$query="Select count(ls.status) as tot
       from lecture l , lecture_status ls , teacher_subject ts , teacher t , subject s 
       where l.u_id=$u_id and l.l_id=ls.l_id and ls.s_id=$user_id and l.teach_sub_id=ts.id and ts.t_id=t.t_id and ts.sub_id=s.sub_id ";
$result=$conn->query($query);
              $value=mysqli_fetch_object($result);
              $total=$value->tot;
$total=(int)$total;
$totalP=(int)$totalP;
$percentage=($totalP*100)/$total;

echo '
<div class="container">
    <h2>Overall Attendance</h2><br>
  <table class="table">
    <thead>
      <tr>
        <th>total lecture\'s conducted</th>
        <th>lecture\'s Present</th>
        <th>lecture\'s Absent</th>
        <th>% Lecture attended</th>
      </tr>
    </thead>
<tbody>';
echo '<tr><td>'.$total.'</td>';
echo '<td>'.$totalP.'</td>';
echo '<td>'.($total-$totalP).'</td>';
echo '<td>'.number_format((float)$percentage, 2, '.', '').'</td></tr>';
echo '</tbody>';
}

else {
$query = "Select sub_id from subject where name='$sub'";
$result=$conn->query($query);
$value=mysqli_fetch_object($result);
$s_id=$value->sub_id;

$query="Select count(ls.status) as tot
       from lecture l , lecture_status ls , teacher_subject ts , teacher t 
       where l.u_id=$u_id and l.l_id=ls.l_id and ls.s_id=$user_id and l.teach_sub_id=ts.id and ts.t_id=t.t_id and ts.sub_id=$s_id and ls.status='P'";
$result=$conn->query($query);
              $value=mysqli_fetch_object($result);
              $totalP=$value->tot;
$query="Select count(ls.status) as tot
       from lecture l , lecture_status ls , teacher_subject ts , teacher t 
       where l.u_id=$u_id and l.l_id=ls.l_id and ls.s_id=$user_id and l.teach_sub_id=ts.id and ts.t_id=t.t_id and ts.sub_id=$s_id";
$result=$conn->query($query);
              $value=mysqli_fetch_object($result);
              $total=$value->tot;
$total=(int)$total;
$totalP=(int)$totalP;
$percentage=($totalP*100)/$total;

echo '
<div class="container">';
echo '<h2 align="center">'."Attendance of ".$sub.'</h2><br>';
echo '
  <table class="table">
    <thead>
      <tr>
        <th>total lecture\'s conducted</th>
        <th>lecture\'s Present</th>
        <th>lecture\'s Absent</th>
        <th>% Lecture attended</th>
      </tr>
    </thead>
<tbody>';
echo '<tr><td>'.$total.'</td>';
echo '<td>'.$totalP.'</td>';
echo '<td>'.($total-$totalP).'</td>';
echo '<td>'.number_format((float)$percentage, 2, '.', '').'</td></tr>';
echo '</tbody>';
}
?>


</body>
</html>
