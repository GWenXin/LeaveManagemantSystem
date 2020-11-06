<!DOCTYPE html>
<html>
<title>Leave Report</title>
<?php
$connection = mysqli_connect("localhost", "root", "", "leave management"); 
?>
<style>
p{ line-height: 1em; }
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
</style>
<?php
$query=mysqli_query($connection, "SELECT count(Leave_id) FROM `leaveapplication` WHERE LeaveType='Annual Leave'"); // and Startdate>='2016-01-01' and Startdate<='2016-01-31'");
$row=mysqli_fetch_array($query);
$al = $row[0];
$query1=mysqli_query($connection, "SELECT count(Leave_id) FROM `leaveapplication` WHERE LeaveType='Sick Leave'"); // and Startdate>='2016-01-01' and Startdate<='2016-01-31'");
$row1=mysqli_fetch_array($query1);
$sl = $row1[0];
$query2=mysqli_query($connection, "SELECT count(Leave_id) FROM `leaveapplication` WHERE LeaveType='Emergency Leave'"); // and Startdate>='2016-01-01' and Startdate<='2016-01-31'");
$row2=mysqli_fetch_array($query2);
$el = $row2[0];
?>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Leave', 'Percentage'],
         ['Annual Leave', <?php  echo $al; ?>],
         ['Sick Leave',      <?php  echo $sl; ?>],
         ['Emergency Leave',  <?php  echo $el; ?>],
        ]);

        var options = {
          title: 'Leave Monthly Report',
          pieHole: 0.35,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
</script>
</head>
<div id="page">
		<div id="logo">
			<h1><a href="homepage.php" id="logoLink">Leave Managemen System</a></h1>
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
				<li><a href="Logout.php">Logout</a></li>
			</ul>	
		</div>
<div id="content">
<body>
    <div id="donutchart" style="width: 1100px; height: 800px;"></div>
</div>
<div id="footer">
			<p style="text-align:center;"> &reg; Leave management system <br/>&copy; Copyright 2016. All Rights Reserved.</p>
			<p><a href="homepage.php">Leave Management System</a></p>
    </div>
  </body>
</html>