<?php
      require 'core.inc.php';
      require 'connect.inc.php';
      $p = $_REQUEST["p"];
   	$user_id=$_SESSION['user_id'];
    $str="";
   $query = "select distinct d.name from subject as s, teacher_subject as ts,division as d 
  where s.name='$p' and ts.t_id=$user_id and s.sub_id=ts.sub_id and ts.d_id=d.div_id";
   $result=$conn->query($query);

    while ($row=mysqli_fetch_row($result)) {
    $str.=implode(" ",$row)." ";
    }
    echo $str;
  ?>
  