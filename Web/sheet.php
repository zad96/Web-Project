<?php
require 'core.inc.php';
require 'connect.inc.php';
?>
<html>
<head>
 <title>Attendance Sheet</title>
 <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <style type="text/css">
   	.btn-grp{
   		padding-top: 10px;
		width: 400px;
		margin:auto;
	}
	.btn-table{
		padding-top: 40px;
	}
   </style>
</head>
<body >
<?php
$lec_id=$_GET['data'];
$query="select s_id,status from lecture_status where l_id=$lec_id";
$result=$conn->query($query);
 $arr="";
 $i=0;
  while ($row=mysqli_fetch_row($result)) {
		$arr[$i]=implode(";",$row);
		$i++;
	}
	$i=0; 
	echo '<div class="btn-grp">';
	echo '<td><button type="button" class="btn btn-success" disabled>Present</button></td>&nbsp;';
	echo '<td><button type="button" class="btn btn-danger" disabled>Absent</button></td>';
	echo '<table class="btn-table">';
while ($i<count($arr)) {
		if($i%4==0){
			echo "<tr>";
		}
		$dat = explode(";", $arr[$i]);
		if($dat[1]=='P'){
			echo '<td><button type="button" class="btn btn-success" disabled>'.$dat[0]."</button></td>&nbsp;&nbsp";
		}
		else{
			echo '<td><button type="button" class="btn btn-danger" disabled>'.$dat[0]."</button></td>&nbsp;&nbsp;";

		}
		if($i%4==3)
		{
			echo "</tr>";
			echo '<tr><td>&nbsp;</td></tr>';
		}
		$i++;
		
	}
	echo '</table></div><br><br>';
?>
</body>
</html>