<?php
      require 'connect.inc.php';
?>
<?php
if(isset($_GET['generate'])){
	$sub=$_GET['sel_subject'];
	$div=$_GET['sel_division'];
	$year=$_GET['sel_year'];
}
?>
<html>
<head>
 <title>Attendance Sheet</title>
 <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

   <script type="text/javascript">
   
   	function onclk(elem) {
   			$(document).ready(function()
			{
				$(elem).toggleClass("btn-danger");
				console.log("color changed");				
			});
   		}
   </script>
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
<body>
<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	$dept=$_SESSION['dept'];
	$query = "Select id from dept_yr_div where div_id=$div and y_id=$year and d_id=$dept" ;
	$result=$conn->query($query);
	$value=mysqli_fetch_object($result);
	$u_id=$value->id; //gets unique id 
	//gets students according to unique id
	$query = "Select id from students where u_id=$u_id";
	//echo	$query;
	$result=$conn->query($query);

	//inside loop
	$i=0;
	while ($row=mysqli_fetch_row($result)) {
		$arr[$i]=implode(";",$row);
		$i++;
	}
	$i=0; 
	echo '<form action="process.php" method="POST" onsubmit="return checkalert(event)"';
	echo '<div class="btn-grp">';
	echo '<td><button type="button" class="btn btn-success" disabled>Present</button></td>&nbsp;';
	echo '<td><button type="button" class="btn btn-danger" disabled>Absent</button></td>';
	echo '<table class="btn-table">';
	while ($i<count($arr)) {
		if($i%4==0)
			echo "<tr>";
		echo '<td><button type="button" class="btn btn-success" onclick="onclk(this)" id="btn_'.$i.'">'.$arr[$i]."</button></td>"."&nbsp;&nbsp;";
		if($i%4==3)
		{
			echo "</tr>";
			echo '<tr><td>&nbsp</td></tr>';
		}
		$i++;
		
	}
	//convenient purpose
	echo '<input type="hidden" name="absent" id="absent"/>';
	echo '<input type="hidden" name="present" id="present"/>';
	echo '<input type="hidden" name="subject" id="subject"/>';
	echo '<input type="hidden" name="division" id="division" />';
	echo '<input type="hidden" name="uniqueid" id="uniqueid" />';

	echo '<input type="hidden" name="year" id="year"/>';

	echo '<tr><td></td><td colspan="2"><button type="submit" name="atten-submit" style="display: block;margin: auto;width: 100%;" class="btn btn-primary" onclick="process();">SUBMIT SHEET</td></tr>';
	echo "</table><br><br><br>";
	// echo '<br><p id="disp"></p>';
	echo "</div>";
	echo '</form>';
?>

<script type="text/javascript">
	function process()
	{
		var ar = <?php echo '["' . implode('", "', $arr) . '"]' ?>;
		var i=0;
		var str="";
		var str1="";
		while(i< ar.length){
			if($('#btn_'+i).hasClass("btn btn-success btn-danger"))
			{
				str+=ar[i]+":";
			}
			else{
				str1+=ar[i]+":";
			}
			i++;
		}
		var sub='<?php echo $sub; ?>';
		var div='<?php echo $div ?>';
		var year='<?php echo $year ?>';
		var u_id='<?php echo $u_id ?>'
		document.getElementById("absent").value = str;
		document.getElementById("present").value = str1;
		document.getElementById("subject").value = sub;
		document.getElementById("division").value = div;
		document.getElementById("year").value = year;
		document.getElementById("uniqueid").value = u_id;
	

		/*console.log("submit");
		console.log(str);
		document.getElementById("disp").innerHTML=str;*/
	}
</script>
<script type="text/javascript">
	function checkalert(evt)
	{
		var t=confirm('Do you really want to submit the sheet?');
		if(t==false){
			evt.preventDefault();
			return false;
		}
		else
		{
			return true;
		}
	}
</script>

</script>
</body>
</html>