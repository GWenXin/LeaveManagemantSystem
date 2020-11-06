<!DOCTYPE html>
<html>
<head>
<title>Apply Leave</title>
<style>
p{ line-height: 22px; }
h1, h2, h3, h4{
    color: orange;
	font-weight: normal;
	line-height: 1.1em;
	margin: 0 0 .5em 0;
}
h1{ font-size: 30px; }
h2{ font-size: 25px; }
a{
	color: black;
	text-decoration: none;
}
	a:hover,
	a:active{ text-decoration: underline; }

body{
    font-family: arial; font-size: 80%; line-height: 1.2em; width: 100%; margin: 0; background: #eee;
}

#page{ margin: 20px; }


#logo{
	width: 35%;
	margin-top: 5px;
	font-family: georgia;
	display: inline-block;
}

#nav{
	width: 60%;
	display: inline-block;
	text-align: right;
	float: right;
}
	#nav ul{}
		#nav ul li{
			display: inline-block;
			height: 62px;
		}
			#nav ul li a{
				padding: 20px;
				background: orange;
				color: white;
			}
			#nav ul li a:hover{
				background-color: #ffb424;
				box-shadow: 0px 1px 1px #666;
			}
			#nav ul li a:active{ background-color: #ff8f00; }

#content{
	margin: 30px 0;
	background: white;
	padding: 20px;
	clear: both;
}
#footer{
	border-bottom: 1px #ccc solid;
	margin-bottom: 10px;
}
	#footer p{
		text-align: right;
		text-transform: uppercase;
		font-size: 80%;
		color: grey;
	}

#content,
ul li a{ box-shadow: 0px 1px 1px #999; }
form{background-color:#FFE4B5;}

input {
  font-family: 'Lucida Grande', Tahoma, Verdana, sans-serif;
  font-size: 16px;
}
input[type=text],[type=date], textarea, select{
  width: 90%;
  height: 34px;
  padding-left: 5px;
  margin-bottom: 20px;
  margin-top: 8px;
  box-shadow: 0 0 5px #EB984E;
  border: 2px solid #EB984E;
  color: #4f4f4f;
  font-size: 16px;
}
textarea{
  width: 90%;
  height: 100px;
  padding-left: 5px;
  margin-bottom: 20px;
  margin-top: 8px;
  box-shadow: 0 0 5px #EB984E;
  border: 2px solid #EB984E;
  color: #4f4f4f;
  font-size: 16px;
}
[type=number]{
  width: 90%;
  height: 34px;
  padding-left: 5px;
  margin-bottom: 20px;
  margin-top: 8px;
  box-shadow: 0 0 5px #EB984E;
  border: 2px solid #EB984E;
  color: #4f4f4f;
  font-size: 16px;
}

</style>
<?php
session_start();
$msg="";
$connection = mysqli_connect("localhost", "root", "", "leave management");

if(isset( $_REQUEST ['apply'])){
$startdate=$_REQUEST['startdate']; // Fetching Values from URL.
$enddate=$_REQUEST['enddate'];
$duration=$_REQUEST['duration'];
$leavetype=$_REQUEST['leavetype'];
$comment=$_REQUEST['comment'];

/*echo $startdate."<br>";
echo $enddate."<br>";
echo $duration."<br>";
echo $leavetype."<br>";
echo $comment."<br>";
echo $_SESSION["uid"]."<br>";*/


$sql = "insert into leaveapplication(Startdate, Enddate, Duration, Leavetype, comment, staff_id,Status) values ('".$startdate."','".$enddate."','".$duration."','".$leavetype."','".$comment."',".$_SESSION['uid'].",'Pending')";
$query1 = mysqli_query($connection,$sql); // Insert query
if($query1){
    $msg = '<script type="text/javascript">alert("You have Successfully Apply.")</script>';

}else
  {
    $msg = '<script type="text/javascript">alert("Error! Try to apply again.")</script>';
  }
}
?>
<div id="page">
		<div id="logo">
			<h1><a href="homepage.php" id="logoLink">Leave Management System</a></h1>
		</div>
		<div id="nav">
			<ul>
				<li><a href="admin_homepage.php">Home</a></li>
				<li><a href="admin_view_leave.php">Leave History</a></li>
				<li><a href="admin_apply_leave.php">Apply Leave</a></li>
				<li><a href="staff_list.php">Staff</a></li>
				<li><a target="_blank" href="register.php">New Staff</a></li>
				<li><a href="admin_profile.php">Profile</a></li>
				<li><a href="admin_chart-report.php">Leave Report</a></li>
				<li><a href="Logout.php">Logout</a><li>
			</ul>	
		</div>
<div id="content">
<script type="text/javascript" src="/Page/jquery.js"></script>
<script type="text/javascript" src="/Page/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="/Page/jquery-ui.css">
<script type="text/javascript">
        function GetDays(){
                var enddate = new Date(document.getElementById("enddate").value);
                var startdate = new Date(document.getElementById("startdate").value);
                return parseInt((enddate - startdate) / (24 * 3600 * 1000)+1);
        }

        function cal(){
        if(document.getElementById("enddate")){
            document.getElementById("duration").value=GetDays();
        }  
    }

    </script>
</head>
<body>
<h1> Leave Management System</h1>
<h2>Employee's name : <?php echo $_SESSION['user'];?></h2>
<form method="post">
<fieldset>
<legend><p style="font-size:18px;">Apply Leave</p></legend>
<p style="font-size:16px;">Apply Leave Date From : <input type="date" name="startdate" id="startdate" onchange="cal()" required></p>
<p style="font-size:16px;">Apply Leave Date To : <input type="date" name="enddate" id="enddate" onchange="cal()" required></p>
<p style="font-size:16px;">Duration : <input type="text" name="duration" id="duration" required> day(s)</p>
<p style="font-size:16px;">Type of Leave : <select name="leavetype" id="leavetype">
                  <option value="Annual Leave">Annual Leave</option>
                  <option value="Sick Leave">Sick Leave</option>
                  <option value="Emergency Leave">Emergency Leave</option>
				  </select></p>
<p style="font-size:16px;">Reason of Leave : <textarea name='comment' id='comment' required></textarea></p>
<p style="font-size:16px;"><input type="submit" name="apply" value="Apply Leave">
<input class="button" type="reset" name="clear" value="Clear"/></p>
</fieldset>

</form>
<?php
  echo $msg;
?>
</div>
<div id="footer">
            <p style="text-align:center;"> &reg; Leave management system <br />&copy; Copyright 2016. All Rights Reserved.</p>
			<p><a href="admin_homepage.php">Leave Management System</a></p>
</div>
</body>
</html>

