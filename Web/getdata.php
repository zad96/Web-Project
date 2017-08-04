<?php
      require 'core.inc.php';
      require 'connect.inc.php';
      $q = $_REQUEST["q"];
   	$user_id=$_SESSION['user_id'];
    $query = "Select DISTINCT s.name from subject s,teacher_subject ts where ts.t_id = $user_id and ts.sub_id=s.sub_id and s.year=$q" ;
    $result=$conn->query($query);
  $i=0;
  $str="";
  while ($row=mysqli_fetch_row($result)) {
    $str.=implode(" ",$row)." ";
    $i++;
  }/*
  $str.=":";
  $query = "select DISTINCT di.name from division di, teacher_subject ts where ts.t_id=$user_id and ts.d_id=di.div_id";
   $result=$conn->query($query);
while ($row=mysqli_fetch_row($result)) {
    $str.=implode(" ",$row)." ";
    $i++;
  }*/
echo $str;
?>
