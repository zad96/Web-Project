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

  <script type="text/javascript">
   
   	function onclk1(elem) {
   			$(document).ready(function()
			{
				$(elem).toggleClass("btn-danger");
				console.log("color changed1");
			});

    }
   	function onclk2(elem) {
   			$(document).ready(function()
			{
				if ($(elem).hasClass("btn btn-danger"))
				{
					$(elem).removeClass("btn btn-danger");
					$(elem).addClass("btn btn-success");
					console.log("color changed2");
				}
				else
					$(elem).toggleClass("btn-danger");
			});
   	}
   </script>

<?php
$lec_id=$_GET['data'];
$sub=$_GET['sname'];
$query1="select u_id from lecture where l_id=$lec_id";
$result1=$conn->query($query1);
$row1=mysqli_fetch_object($result1);
$u_id=($row1->u_id)."";
$query2="select div_id from dept_yr_div where id=$u_id";
$result2=$conn->query($query2);
$row2=mysqli_fetch_object($result2);
$div=($row2->div_id)."";
$query="select s_id,status from lecture_status where l_id=$lec_id";
$result=$conn->query($query);
 $arr="";
 $i=0;
  while ($row=mysqli_fetch_row($result)) {
		$arr[$i]=implode(";",$row);
		$i++;
	}
	$i=0; 
		echo '<form action="process1.php" method="POST" onsubmit="return checkalert(event)"';
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
			echo '<td><button type="button" class="btn btn-success" id="btn_'.($i).'" onclick="onclk1(this)">'.$dat[0]."</button></td>&nbsp;&nbsp";
		}
		else{
			echo '<td><button type="button" class="btn btn-danger"  id="btn_'.($i).'"onclick="onclk2(this)">'.$dat[0]."</button></td>&nbsp;&nbsp;";

		}
		if($i%4==3)
		{
			echo "</tr>";
			echo '<tr><td>&nbsp;</td></tr>';
		}
		$i++;
		
	}
	echo '<input type="hidden" name="absent" id="absent"/>';
	echo '<input type="hidden" name="present" id="present"/>';
	echo '<input type="hidden" name="subject" id="subject"/>';
	echo '<input type="hidden" name="division" id="division" />';
	echo '<input type="hidden" name="uniqueid" id="uniqueid" />';
	echo '<input type="hidden" name="lecture" id="lecture"/>';
	
	echo '<tr><td></td><td colspan="2"><button type="submit" name="atten-submit" style="display: block;margin: auto;width: 100%;" class="btn btn-primary" onclick="process();">SUBMIT SHEET</td></tr>';
	echo '</table></div><br><br>';
	echo '</form>';
	echo '<div id="abc"></div>';
?>
<script type="text/javascript">
	function process()
	{
		var ar = <?php echo '["' . implode('","', $arr) . '"]' ?>;
		var i=0;
		var str="";
		var str1="";
		console.log("Len="+ar.length);
		while(i< ar.length){
			if(($('#btn_'+i).hasClass("btn btn-success btn-danger")) || ($('#btn_'+i).hasClass("btn btn-danger")))
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
		var lec_id='<?php echo $lec_id ?>';
		var u_id='<?php echo $u_id ?>'
		document.getElementById("absent").value = str;
		document.getElementById("present").value = str1;
		document.getElementById("subject").value = sub;
		document.getElementById("division").value = div;
		document.getElementById("uniqueid").value = u_id;
		document.getElementById("lecture").value = lec_id;
		console.log("absent="+str);
		//console.log(str);
		// document.getElementById("abc").innerHTML="absent"+str+"<br>present"+str1

		//console.log("submit");
		//document.getElementById("disp").innerHTML=str;*/
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
</body>
</html>