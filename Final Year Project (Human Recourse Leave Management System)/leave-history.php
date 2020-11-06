<!DOCTYPE html>
<html>
<head>
<title>Demo Admin View Leave Record</title>
<style>
p{ line-height: 1em; }
h1, h2, h3, h4{
    color: orange;
	font-weight: normal;
	line-height: 1.1em;
	margin: 0 0 .5em 0;
}
h1{ font-size: 1.7em; }
h2{ font-size: 1.5em; }
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
table, th, td { border: 1px solid black; background-color:#F5FFFA}
</style>
</head>
<div id="page">
		<div id="logo">
			<h1><a href="admin_homepage.php" id="logoLink">Leave Managemen System</a></h1>
		</div>
		<div id="nav">
			<ul>
				<li><a href="admin_homepage.php">Home</a></li>
				<li><a href="view-leave.php">Leave History</a></li>
				<li><a href="apply_leave.php">Apply Leave</a></li>
				<li><a href="chart-report.php">Leave Report</a></li>
				<li><a href="leave_history.php">Staff List</a></li>
				<li><a target="_blank" href="register.php">Add New Staff</a></li>
				<li><a href="profile.php">Update profile</a><li><br>
				<li><a href="logout.php">Logout</a><li>
			</ul>	
		</div>
<div id="content">
<body>
<h1>Leave Management System</h1>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Employee's Name</th>
    <th>Department</th>	
    <th>Type of Leave</th>
	<th>Leave Date From</th>
	<th>Leave Date To</th>
	<th>Day(s)</th>
	<th>Leave Status</th>
	<th>Cancellation</th>
  </tr>
  <tr>
    <td>3456</td>
    <td>Abbey</td>
    <td>Management</td>	
    <td>Sick Leave</td>
	<td>2 January 2016</td>
	<td>5 January 2016</td>
	<td>3</td>
	<td>Reject</td>
	<td><input type="submit" name="cancel" value="Cancellation" class="cancel"></td>
  </tr>
   <tr>
    <td>4567</td>
    <td>Wallace</td>
    <td>Marketing</td>	
    <td>Annual Leave</td>
	<td>6 January 2016</td>
	<td>7 January 2016</td>
	<td>1</td>
	<td>Approved</td>
	<td><input type="submit" name="cancel" value="Cancellation" class="cancel"></td>
  </tr>
  <tr>
    <td>3456</td>
    <td>Abbey</td>
	<td>management</td>
    <td>Sick Leave</td>
	<td>10 January 2016</td>
	<td>13 January 2016</td>
	<td>3</td>
	<td>Reject</td>
	<td><input type="submit" name="cancel" value="Cancellation" class="cancel"></td>
  </tr>
   <tr>
   <td>1234</td>
    <td>Jackson</td>	
    <td>management</td>	
    <td>Sick Leave</td>
	<td>15 January 2016</td>
	<td>17 January 2016</td>
	<td>2</td>
	<td>Approved</td>
	<td><input type="submit" name="cancel" value="Cancellation" class="cancel"></td>
   </tr>  
    <tr>
    <td>6789</td>
    <td>Mark</td>
    <td>Finance & Accounting</td>	
    <td>Sick Leave</td>
	<td>25 January 2016</td>
	<td>26 January 2016</td>
	<td>1</td>
	<td>Approved</td>
	<td><input type="submit" name="cancel" value="Cancellation" class="cancel"></td>
  </tr>
  <tr>
    <td>4567</td>
    <td>Wallace</td>		
	<td>Marketing</td>
    <td>Emergency Leave</td>
	<td>10 February 2016</td>
	<td>18 February 2016</td>
	<td>8</td>
	<td>Approved</td>
	<td><input type="submit" name="cancel" value="Cancellation" class="cancel"></td>
  </tr>
  <tr>
    <td>2345</td>
    <td>Simon</td>
    <td>IT</td>	
    <td>Sick Leave</td>
	<td>24 February 2016</td>
	<td>26 February 2016</td>
	<td>2</td>
	<td>Approved</td>
	<td><input type="submit" name="cancel" value="Cancellation" class="cancel"></td>
  </tr>
  <tr>
    <td>0987</td>
    <td>Ashlee</td>	
    <td>Human Resource</td>	
    <td>Emergency Leave</td>
	<td>4 March 2016</td>
	<td>5 March 2016</td>
	<td>1</td>
	<td>Pending</td>
	<td><input type="submit" name="cancel" value="Cancellation" class="cancel"></td>
  </tr>
  
</table>
</div>
<div id="footer"> 		
		<p style="text-align:center;"> &reg; Leave management system <br/><br/>&copy; Copyright 2016. All Rights Reserved.</p>
		<p><a href="admin_homepage.php">Leave Management System</a></p>
</div>
</body>
</html>
<?php
  ob_start();
  $connection = mysqli_connect("localhost", "root", "", "leave management");
  if(isset($_GET['cancel'])!="")
  {
  $delete=$_GET['cancel'];
  $delete=mysqli_query($connection,"DELETE FROM Staff WHERE leave='$delete'");
  if($delete)
  {
      header("Location:view-leave.php");
  }
  else
  {
      echo mysqli_error();
  }
  }
  ob_end_flush();
?>