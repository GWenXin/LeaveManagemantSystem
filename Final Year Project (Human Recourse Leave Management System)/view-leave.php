<!DOCTYPE html>
<html>
<head>
<title>View Leave </title>
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
  ob_start();
  $connection = mysqli_connect("localhost", "root", "", "leave management");
  if(isset($_REQUEST['cancel'])!="")
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
  }
  ob_end_flush();

  $sql = "select * from leaveapplication where staff_id=".$_SESSION['uid'];
  $result = mysqli_query($connection,$sql);
  
  $count=mysqli_num_rows($result); // if uname/pass correct it returns must be 1 row

  
//echo "count=".$count."<br>";  
//print_r($row);
  if( $count >= 1) {
//echo $count;
  //     for ($i=1;$i<=$count;$i++) {
		 
 
?>
<script>
function confirmation()
{
	answer= confirm("Are you sure to delete?");
	return answer;
	
}
</script>
<div id="page">
		<div id="logo">
			<h1><a href="homepage.php" id="logoLink">Leave Managemen System</a></h1>
		</div>
		<div id="nav">
			<ul>
				<li><a href="homepage.php">Home</a></li>
				<li><a href="view-leave.php">Leave History</a></li>
				<li><a href="apply_leave.php">Apply Leave</a></li>
				<li><a href="chart-report.php">Leave Report</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="logout.php">Logout</a><li>
			</ul>	
		</div>
<div id="content">
<h2>Employee's name : <?php echo $_SESSION['user'];?></h2>
<table border="1" style="text-align:center;">
  <tr>	
    <th>Type of Leave</th>
	<th>Leave Date From</th>
	<th>Leave Date To</th>
	<th>Day(s)</th>
	<th>Leave Status</th>
	<th>Cancellation</th>
  </tr>
<?php
  while ($row=mysqli_fetch_array($result))
  {
	  $rows[] = $row;
	  
	  foreach ($rows as $row)
	  {
    $id = $row["Leave_id"];
    $leavetype = $row["LeaveType"];	
	$leavestart = $row["Startdate"];	
	$leaveend = $row["Enddate"];	
	$duration = $row["Duration"];	
	$comment = $row["comment"];	
	$status = $row["Status"];	
  } 
?>

   <tr>		
    <td><?php echo $leavetype; ?></td>
	<td><?php echo $leavestart;?></td>
	<td><?php echo $leaveend;?></td>
	<td><?php echo $duration;?></td>
	
	<?php 
		
		if($row['Status']=='Pending')
			echo "<td style='color: #cc00ff; font-weight: bold;'>".$row['Status']."</td>"; 
		else if($row['Status']=='Rejected')
			echo "<td style='color: #e60000; font-weight: bold;'>".$row['Status']."</td>"; 
		else if($row['Status']=='Approved') 
			echo "<td style='color: #3366ff; font-weight: bold;'>".$row['Status']."</td>"; 
		
		?>	

		<td><form>
		<?php 	if($row['Status']=='Pending') { ?>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="submit" name="cancel" value="Cancellation" class="cancel"  onclick="return confirm('Are you sure to delete?');"></form></td>
		<?php } ?>
  </tr>
  <?php
  }
  }
  ?>

  </table>
</div>

<div id="footer">			
			<p style="text-align:center;"> &reg; Leave management system <br/><br/>&copy; Copyright 2016. All Rights Reserved.</p>
			<p><a href="homepage.php">Leave Management System</a></p>
		</div>
</body>
</html>
