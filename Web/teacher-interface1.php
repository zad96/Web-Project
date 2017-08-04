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
      <li><a href="teacherHomepage.php">Home</a></li>
      <li><a href="viewSheets.php">View Sheets</a>
      <li class="active"><a href="teacher-interface1.php">Add</a></li>
      <li><a href="edit.php">Edit</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="Logout.php"><span class="glyphicon glyphicon-log-in"></span> Log-out</a></li>
    </ul>
  </div>
</nav>
<div class="container-fluid">
    <?php
    $user_id=$_SESSION['user_id'];

  echo '<form action="marking-attendance.php" method="GET" id="generator_id" name="generateSheet" ><div class="form-group">
      <label>Select year:</label>
      <select class="form-control" id="choose_year" name="sel_year" onchange="getval(this)">
      <option value=0>Year</option>
      <option value="1">FE</option><option value="2">SE</option><option value="3">TE</option><option value="4">BE</option>
      </select><br><br>
      <label>Select Subject:</label>
      <select class="form-control" id="choose_sub" name="sel_subject" onchange="getsub(this)"></select><br><br>';
echo '<input type="hidden" id="refreshed" value="no">';
  echo '<label>Select division:</label>
        <select class="form-control" id="choose_div" name="sel_division">
      </select><br><br>';
  echo   ' <button type="submit" class="btn btn-primary" name="generate">Proceed to Generate Sheet</button>
      </div></form>';
  ?>
</div>
</div>

</body>
<script type="text/javascript">
        function getval(str) {
          console.log("passed "+str.value);
          var x = document.getElementById("choose_sub");
                    var y = document.getElementById("choose_div");
            $('#choose_sub').empty();
            $('#choose_div').empty();
            var option = document.createElement("option");
                  option.text = "Subject";
                  x.add(option);
                  var option1 = document.createElement("option");
                  option1.text = "Division";
                  y.add(option1);
        var xmlhttp = new XMLHttpRequest();
               
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var str = this.responseText;
                console.log(str);
                var arr=str.split(" ");
                  if(arr.length>1){
                for (var i = 0; i <arr.length-1; i++) {
                  var option = document.createElement("option");
                  option.text = arr[i];
                  x.add(option);
                }/*
                for (var i = 0; i <d.length-1 ; i++) {
                  var option = document.createElement("option");
                  option.text = d[i];
                  if(d[i]=='A')
                    option.value=1;
                  else if(d[i]=='B')
                    option.value=2;
                  y.add(option);
                }*/
            /*    $('#choose_sub').trigger("chosen:updated");
                $('#choose_div').trigger("chosen:updated");*/
                }
            }
        };
        xmlhttp.open("GET", "getdata.php?q=" + str.value, true);
        xmlhttp.send();
    }
    </script>
<script type="text/javascript">
         function getsub(str) {
           console.log(str.value);
        var y = document.getElementById("choose_div");
            $('#choose_div').empty(); 
                        var option = document.createElement("option");
                  option.text = "Division";
                  y.add(option);  
        var xmlhttp = new XMLHttpRequest();
               
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var str = this.responseText;
                console.log(str);
                 var arr=str.split(" ");
                for (var i = 0; i <arr.length-3; i++) {
                  var option = document.createElement("option");
                  option.text = arr[i];
                  option.value=i+1;
                  y.add(option);
                }
               // var x = document.getElementById("choose_sub");
                //console.log("Length of sub "+x.length);
                //var y = document.getElementById("choose_div");
                //console.log("Length of div "+y.length); 
                $('#choose_div').trigger("chosen:updated");
              }
            };
            xmlhttp.open("GET", "getdata1.php?p=" + str.value, true);
           xmlhttp.send();
        }
        
    </script>
    
<script type="text/javascript">
onload=function(){
var e=document.getElementById("refreshed");
if(e.value=="no")e.value="yes";
else{e.value="no";location.reload();}
}
</script>
</html>