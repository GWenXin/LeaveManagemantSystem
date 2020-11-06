<!DOCTYPE html>
<html>
<head>
<title>Staff List</title>
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
table, th, td { border: 1px solid black;background-color:#F5FFFA}
</style>
</head>
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
				<li><a href="admin_profile.php">Profile</a></li>
				<li><a href="chart-report.php">Leave Report</a></li>
				<li><a href="Logout.php">Logout</a></li>
			</ul>	
		</div>
<div id="content">
<body>
<table border="1" style="text-align:center;">
  <tr>
    <th>Department</th>
    <th>Employees</th>
</tr>
<?php
$connection = mysqli_connect("localhost", "root", "", "leave management");
$row = '';
$rows = '';
$sql = "select * from staff WHERE Department = 'Human Resource'";
$result = mysqli_query($connection,$sql);
//$row = mysqli_fetch_assoc($result);
?>
<tr>
    <td><a href="request.php?dept=Human%20Resource" style="font-size:Comic Sans MS, cursive, sans-serif;">Human Resource</a></td>
    <td>
      <ul>
	<?php  
	  while ($row=mysqli_fetch_array($result))
      {
	    $rows[] = $row;
//	   foreach ($rows as $row)
//	    {
         echo "<li>".$row['Name']."</li>"; 
        }
//      }
    ?>
     </ul>
   </td>
</tr>
<?php
$row = '';
$rows = '';
$sql = "select * from staff WHERE Department = 'Marketing'";
$result = mysqli_query($connection,$sql);
?>
<tr>
    <td><a href="request.php?dept=marketing">Marketing</td>
    <td>
      <ul>
        <?php  
	  while ($row=mysqli_fetch_array($result))
      {
	    $rows[] = $row;
//	   foreach ($rows as $row)
//	    {
         $name = $row['Name'];
		 echo "<li>".$name."</li>"; 
        }
 //     }
     ?>
      </ul> 
   </td>   
</tr>
<?php
$row = '';
$rows = '';
$sql = "select * from staff WHERE Department = 'Management'";
$result = mysqli_query($connection,$sql);
?>
<tr>
    <td><a href="request.php?dept=Management">Management</a></td>
     <td>
      <ul>   
      <?php  
	  while ($row=mysqli_fetch_assoc($result))
      {
	    $rows[] = $row;
	  
//	   foreach ($rows as $row)
//	    {
         echo "<li>".$row['Name']."</li>"; 
        }
 //     }
     ?>
      </ul> 
   </td>   
</tr>
<?php
$row = '';
$rows = '';
$sql = "select * from staff WHERE Department = 'Finance & Accounting'";
$result = mysqli_query($connection,$sql);
?>
<tr>
    <td><a href="request.php?dept=<?php echo urlencode("Finance & Accounting"); ?>">Finance & Accounting</a></td>
     <td>
       <ul> 
      <?php  
	  while ($row=mysqli_fetch_assoc($result))
      {
	    $rows[] = $row;
	  
//	   foreach ($rows as $row)
//	    {
         echo "<li>".$row['Name']."</li>"; 
        }
 //     }
     ?>
      </ul>
   </td>
</tr>
<?php
$row = '';
$rows = '';
$sql = "select * from staff WHERE Department = 'Customer/Technical Support'";
$result = mysqli_query($connection,$sql);
?>
<tr>
    <td><a href="request.php?dept=Customer/Technical%20Support">Customer/Technical Support</a></td>
    <td>
      <ul>
 <?php  
	  while ($row=mysqli_fetch_assoc($result))
      {
	    $rows[] = $row;
	  
//	   foreach ($rows as $row)
//	    {
         echo "<li>".$row['Name']."</li>"; 
        }
 //     }
     ?>
    </ul>
  </td>
</tr>
<?php
$row = '';
$rows = '';
$sql = "select * from staff WHERE Department = 'Sales'";
$result = mysqli_query($connection,$sql);
?>
<tr>
    <td><a href="request.php?dept=Sales">Sales</a></td>
    <td>
      <ul>
  <?php  
	  while ($row=mysqli_fetch_assoc($result))
      {
	    $rows[] = $row;
	  
//	   foreach ($rows as $row)
//	    {
         echo "<li>".$row['Name']."</li>"; 
        }
 //     }
     ?>
    </ul>
  </td>	 
</tr>
<?php
$row = '';
$rows = '';
$sql = "select * from staff WHERE Department = 'IT'";
$result = mysqli_query($connection,$sql);
?>
<tr>
    <td><a href="request.php?dept=IT">IT</a></td>
    <td>
      <ul>
 <?php  
	  while ($row=mysqli_fetch_assoc($result))
      {
	    $rows[] = $row;
	  
//	   foreach ($rows as $row)
//	    {
         echo "<li>".$row['Name']."</li>"; 
        }
 //     }
     ?>
	</ul>
  </td>	
</tr>
</table>
</div>

<div id="footer">			
			<p style="text-align:center;"> &reg; Leave management system <br/><br/>&copy; Copyright 2016. All Rights Reserved.</p>
			<p><a href="admin_homepage.php">Leave Management System</a></p>
		</div>
</body>
</html>