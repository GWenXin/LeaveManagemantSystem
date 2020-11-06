<!DOCTYPE html>
<html> 
<head>
<title>Leave Request</title>
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
fieldset{background-color:#bcd4e6;}
table, th, td { border: 1px solid black; background-color:#99badd;}
</style>
</head>
<?php
session_start();
 if(isset($_REQUEST['dept'])) $_SESSION['dept'] = $_REQUEST['dept'];

$connection = mysqli_connect("localhost", "root", "", "leave management"); // Establishing connection with server..
 if(isset($_REQUEST['Approved']))
 {
	 $status="Approved";
	 $update="Update leaveapplication SET Status='$status' where Leave_id=".$_REQUEST['Leave_id'];
	 echo $update;
	 $result=mysqli_query($connection,$update);
 } else if (isset($_REQUEST['Reject']))
 {
	 $status="Rejected";
	 $update="Update leaveapplication SET Status='$status' where Leave_id=".$_REQUEST['Leave_id'];
	 echo $update;
	 $result=mysqli_query($connection,$update);

 }

?>
<body>
<?php
 $sql = "select * from leaveapplication left join staff on staff.id=leaveapplication.staff_id WHERE Department = '".$_SESSION['dept']."'";
echo $sql;
 $result = mysqli_query($connection,$sql);
 if (mysqli_num_rows($result) > 0) 
  {
   if($row = mysqli_fetch_array($result))
   {
    $name=$row['Name'];
    $department=$row['Department'];
    $leavetype=$row['LeaveType'];
    $startdate=$row['Startdate'];
    $enddate=$row['Enddate'];
    $comment=$row['comment'];
	$status=$row['Status'];
   }
  }
?>
<div id="page">
		<div id="logo">
			<h1><a href="admin_homepage.php" id="logoLink">Leave Managemen System</a></h1>
		</div>
		<div id="nav">
			<ul>
				<li><a href="admin_homepage.php">Home</a></li>
				<li><a href="admin_view_leave.php">Leave History</a></li>
				<li><a href="admin_apply_leave.php">Apply Leave</a></li>
				<li><a href="staff_list.php">Staff</a></li>
				<li><a target="_blank" href="register.php">New Staff</a></li>
				<li><a href="admin_profile.php">Profile</a><li>
				<li><a href="chart-report.php">Leave Report</a></li>
				<li><a href="Logout.php">Logout</a><li>
			</ul>
		</div>
<div id="content">
<h1>Leave Request</h1>
<fieldset>

<table border="1">
<tr>
    <th>Detail of Leave</th>
</tr>
<tr>
     <td>
        Name : <?php echo $row['Name']; ?><br/>
        Department : <?php echo $row['Department']; ?><br/>
        Leave Type : <?php echo $row['LeaveType']; ?><br/>
	    Leave Date From : <?php echo $row['Startdate']; ?><br/>
	    Leave Date To : <?php echo $row['Enddate']; ?><br/>
	    Reason of Leave : <?php echo $row['comment']; ?><br/>
		Leave Status : <?php		
		if($row['Status']=='Pending')
			echo "<p style='color: #cc00ff; font-weight: bold; text-align:center;'>".$row['Status']."</p>"; 
		else if($row['Status']=='Rejected')
			echo "<p style='color: #e60000; font-weight: bold;'>".$row['Status']."</p>"; 
		else if($row['Status']=='Approved') 
			echo "<p style='color: #3366ff; font-weight: bold;'>".$row['Status']."</p>";		
		?>
		</td>
</tr>
</table>
<form>
<input type="hidden" name="staff_id" value="<?php echo $row['staff_id']; ?>">
<input type="hidden" name="Leave_id" value="<?php echo $row['Leave_id']; ?>">
<input type="submit" name="Approved" value="Approved" style="font-weight: bold;"/>
<input type="submit" name="Reject" value="Reject" style="font-weight: bold;"/>
</form>
</fieldset>
</div>
<div id="footer">
			<p>Leave Management System</p>
</div>
</body>
</html>