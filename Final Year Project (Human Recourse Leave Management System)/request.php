<!DOCTYPE html>
<html>
<head>
<title>Request Leave</title>
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
table, th, td { border: 1px solid black;}
#content,
ul li a{ box-shadow: 0px 1px 1px #999; }
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
	 $result1=mysqli_query($connection,$update);
	 
	 $result1=mysqli_query($connection,"select * from staff where id = ".$_REQUEST['staff_id']);
  while ($row=mysqli_fetch_array($result1))
  {
	  $rows[] = $row;
	  $leave = $row["Leave"];  
      $newDuration = $leave - $_REQUEST['Duration'];
  }	 
   $sql="update `staff` set `Leave` = $newDuration where id =".$_REQUEST['staff_id'];
   echo $sql;
  $result2=mysqli_query($connection,$sql);

	 } else if (isset($_REQUEST['Reject']))
 {
	 $status="Rejected";
	 $update="Update leaveapplication SET Status='$status' where Leave_id=".$_REQUEST['Leave_id'];
	 echo $update;
	 $result3=mysqli_query($connection,$update);

 }

/* if(isset($_REQUEST['cancel'])!="")
  {
	  
  $id=$_REQUEST['id'];
  $delete=mysqli_query($connection,"DELETE FROM leaveapplication WHERE Leave_id='$id'");
  if($delete)
  {
      header("Location:view-leave.php");
  }
  else
  {
      echo mysqli_error();
  }
  } */
//  ob_end_flush();
  
 $sql = "select * from leaveapplication left join staff on staff.id=leaveapplication.staff_id WHERE Department = '".$_SESSION['dept']."'";
  $result = mysqli_query($connection,$sql);
  
   $count=mysqli_num_rows($result);
//echo $count;  
//  $sql1 = "select * from leaveapplication";
//  $result1 = mysqli_query($connection,$sql1);
  
//  $count=mysqli_num_rows($result1); // if uname/pass correct it returns must be 1 row

  
//echo "count=".$count."<br>";  
//print_r($row);
  if( $count >= 1) {
//echo $count;
  //     for ($i=1;$i<=$count;$i++) { 
 ?>
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
				<li><a href="chart-report.php">Leave Report</a></li>
				<li><a href="Logout.php">Logout</a><li>
			</ul>	
		</div>
<div id="content">
<input type="button" name="edit_staff_leave" value="Edit Staff Leave" style="font-weight: bold; font-family:Comic Sans MS, cursive, sans-serif; font-size:16px;" onclick="location.href='edit_staff_leave.php'"/>
<br/><br/>
<table border="1" style="text-align:center;">
  <tr>
    <th>Name</th>  
    <th>Type of Leave</th>
	<th>Leave Date From</th>
	<th>Leave Date To</th>
	<th>Duration - Day(s)</th>	
	<th>Comment</th>
	<th>Leave Status</th> 
	<th>Request Leave</th> 
  </tr>
<?php
  while ($row=mysqli_fetch_array($result))
  {
	  $rows[] = $row;
	  
//	  foreach ($rows as $row)
//	  {
	   $name = $row["Name"];
       $id = $row["Leave_id"];
       $leavetype = $row["LeaveType"];	
	   $leavestart = $row["Startdate"];	
	   $leaveend = $row["Enddate"];	
	   $duration = $row["Duration"];	
	   $comment = $row["comment"];	
	   $status = $row["Status"];	
//  } 
?>

   <tr>		
    <td><?php echo $name; ?></td>
    <td><?php echo $leavetype; ?></td>
	<td><?php echo $leavestart;?></td>
	<td><?php echo $leaveend;?></td>
	<td><?php echo $duration;?></td>	
    <td><?php echo $comment; ?></td>	
	<?php 
		
		if($row['Status']=='Pending')
			echo "<td style='color: #cc00ff; font-weight: bold;'>".$row['Status']."</td>"; 
		else if($row['Status']=='Rejected')
			echo "<td style='color: #e60000; font-weight: bold;'>".$row['Status']."</td>"; 
		else if($row['Status']=='Approved') 
			echo "<td style='color: #3366ff; font-weight: bold;'>".$row['Status']."</td>"; 
		
?>
<?php
	if($row['Status']=='Pending') {
	?>
    <td>	
	<form>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
	    <input type="hidden" name="staff_id" value="<?php echo $row['staff_id']; ?>">
        <input type="hidden" name="Leave_id" value="<?php echo $row['Leave_id']; ?>">
        <input type="hidden" name="Duration" value="<?php echo $row['Duration']; ?>">
        <input type="submit" name="Approved" value="Approved" style="font-weight: bold; font-family:Comic Sans MS, cursive, sans-serif;"/>
        <input type="submit" name="Reject" value="Reject" style="font-weight: bold; font-family:Comic Sans MS, cursive, sans-serif;"/></form>

		</td>
		<?php
          }
		?></tr>
  <?php
  }
  }
  ?>

  </table>
</div>

<div id="footer">			
			<p style="text-align:center;"> &reg; Leave management system <br/><br/>&copy; Copyright 2016. All Rights Reserved.</p>
			<p><a href="admin_homepage.php">Leave Management System</a></p>
		</div>
</body>
</html>
