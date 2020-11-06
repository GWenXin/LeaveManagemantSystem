<!DOCTYPE html>
<html>
<head>
<title>Homepage of Admin</title>	
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

.c{
	padding: 20px;
	height: 10px;
	display: inline-block;
	background: orange;
	color: white;
}
			
</style>
</head>
<?php 
session_start();
$connection = mysqli_connect("localhost", "root", "", "leave management");
 $query = "SELECT * FROM Staff WHERE Name='".$_SESSION["user"]."'";
// echo $query;
 $result=mysqli_query($connection,$query);
 $row=mysqli_fetch_array($result);
 $leave = $row["Leave"];
 $leave_added = (int)date("Y",strtotime($row["Leave_added"]));
 if ($leave_added < (int)date("Y")) 
 {
    $leave += 20;
    mysqli_query($connection,"UPDATE Staff SET Leave=$leave WHERE Name='".$_SESSION["user"]."'");	
    mysqli_query($connection,"UPDATE Staff SET Leave_added='".date("Y-m-d")."' WHERE Name='".$_SESSION["user"]."'");	
 }
 
?>
<body>
	<div id="page">
		<div id="logo">
			<h1><a href="admin_homepage.php" id="logoLink">Leave Management System</a></h1>
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
		    <h1>Admin Name : <?php echo $_SESSION['user'];?></h1>
            <h2>Leaves Available : <?php echo $leave;?> days</h2>	
			<?php
              include 'calendar.php';          
            ?>					
			
		</div>
		<div id="footer">	  
			<p style="text-align:center;"> &reg; Leave management system <br/><br/>&copy; Copyright 2016. All Rights Reserved.</p>
			<p><a href="admin_homepage.php">Leave Management System</a></p>
		</div>
	</div>
</body>
</html>