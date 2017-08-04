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
  <title>Generated</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<?php //date lecture teacher status
$user_id=$_SESSION['user_id'];
$u_id=$_SESSION['u_id'];
if ($sub=='all') {
$query="Select l.l_id,s.name ,l.date ,t.name , ls.status
       from lecture l , lecture_status ls , teacher_subject ts , teacher t , subject s 
       where l.u_id=$u_id and l.l_id=ls.l_id and ls.s_id=$user_id and l.teach_sub_id=ts.id and ts.t_id=t.t_id and ts.sub_id=s.sub_id";
$result=$conn->query($query);
 $i=0;
 $arr="";
  while ($row=mysqli_fetch_row($result)) {
    $arr.=implode(" ",$row)." ";
    $i++;
  }
//echo $arr; 

  $attend_array = explode(' ', $arr);
echo '
<div class="container">
  <h1>Attendance of all subjects</h1>
  <table class="table">
    <thead>
      <tr>
        <th>lec.No</th>
        <th>lecture</th>
        <th>date</th>
        <th>teacher</th>
        <th>status</th>
      </tr>
    </thead>
<tbody>';
$i=0;
while ($i<count($attend_array)-1) {
      if($attend_array[$i+5]=="P"){
        echo '<tr class="success">
        <td>'.$attend_array[$i].'</td>';
        $i++;
        echo '<td>'.$attend_array[$i].'</td>';
        $i++;
        echo '<td>'.$attend_array[$i].'</td>';
        $i++;
        echo '<td>'.$attend_array[$i]." ".$attend_array[$i+1].'</td>';
        $i+=2;
        echo '<td>'.$attend_array[$i].'</td>';
        $i++;

      echo'</tr>';
      }
      else{ 
        echo '<tr class="danger">
        <td>'.$attend_array[$i].'</td>';
        $i++;
        echo '<td>'.$attend_array[$i].'</td>';
        $i++;
        echo '<td>'.$attend_array[$i].'</td>';
        $i++;
        echo '<td>'.$attend_array[$i]." ".$attend_array[$i+1].'</td>';
        $i+=2;
        echo '<td>'.$attend_array[$i].'</td>';
        $i++;

      }
    }
    $i=0 ;     
echo '</tbody>
  </table>
</div>' ;

}

else {
$query = "Select sub_id from subject where name='$sub'";
$result=$conn->query($query);
$value=mysqli_fetch_object($result);
$s_id=$value->sub_id;
$query="Select l.date ,t.name , ls.status
       from lecture l , lecture_status ls , teacher_subject ts , teacher t 
       where l.u_id=$u_id and l.l_id=ls.l_id and ls.s_id=$user_id and l.teach_sub_id=ts.id and ts.t_id=t.t_id and ts.sub_id=$s_id";

$result=$conn->query($query);
 $i=0;
 $arr="";
  while ($row=mysqli_fetch_row($result)) {
    $arr.=$sub." ".implode(" ",$row)." ";
    $i++;
  }

  $attend_array = explode(' ', $arr);
echo '
<div class="container">
    <h1>'.$sub." Attendance".'</h1>
  <table class="table">
    <thead>
      <tr>
        <th>lecture</th>
        <th>date</th>
        <th>teacher</th>
        <th>status</th>
      </tr>
    </thead>
<tbody>';
$i=0;
while ($i<count($attend_array)-1) {
      if($attend_array[$i+4]=="P"){
        echo '<tr class="success">
        <td>'.$attend_array[$i].'</td>';
        $i++;
        echo '<td>'.$attend_array[$i].'</td>';
        $i++;
        echo '<td>'.$attend_array[$i]." ".$attend_array[$i+1].'</td>';
        $i+=2;
        echo '<td>'.$attend_array[$i].'</td>';
        $i++;

      echo'</tr>';
      }
      else{ 
       echo '<tr class="danger">
        <td>'.$attend_array[$i].'</td>';
        $i++;
        echo '<td>'.$attend_array[$i].'</td>';
        $i++;
        echo '<td>'.$attend_array[$i]." ".$attend_array[$i+1].'</td>';
        $i+=2;
        echo '<td>'.$attend_array[$i].'</td>';
        $i++;

      echo'</tr>';
      }
    }
    $i=0 ;     
echo '</tbody>
  </table>
</div>' ;

}
?>


</body>
</html>
