<head>
<title>Demo Edit Employee's Leave</title>	
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

input[type=number] {
width: 97.7%;
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
</head>
<?php
session_start();
 if(isset($_REQUEST['dept'])) $_SESSION['dept'] = $_REQUEST['dept'];

$connection = mysqli_connect("localhost", "root", "", "leave management"); // Establishing connection with server..
 if(isset($_REQUEST['updateleaves']))
 {
     $Leave = $_REQUEST["Leave"];
	 $Leave = $Leave + $_REQUEST['editleave'];
	 $update="Update `staff` SET `Leave`=$Leave where id=".$_REQUEST['staff_id'];
	 echo $update;
	 $result1=mysqli_query($connection,$update);	 
	 $result1=mysqli_query($connection,"select Leave from staff where id = ".$_REQUEST['staff_id']); 
	 if($result1){
    $msg = '<script type="text/javascript">alert("You have Successfully Update Staff Leaves.")</script>';

}else
  {
    $msg = '<script type="text/javascript">alert("Error! Try to apply again.")</script>';
  }
	 }   
  $sql = "select * from  staff WHERE Department = '".$_SESSION['dept']."'";
  $result = mysqli_query($connection,$sql);
  
   $count=mysqli_num_rows($result);

  if( $count >= 1) {

 ?>

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
				<li><a href="chart-report.php">Leave Report</a></li>
				<li><a href="Logout.php">Logout</a><li>
			</ul>	
		</div>
<div id="content">
<body>
<table border="1" style="text-align:center;">
<tr>
  <th>Name</th>
  <th>Leaves Available</th>
  <th>Edit Leaves</th>
</tr>
<?php
  while ($row=mysqli_fetch_array($result))
  {
	  $rows[] = $row;
	  $id = $row["id"];
	  $name = $row["Name"];
	  $leave = $row["Leave"];
	  ?>
<tr>		
    <td><?php echo $name; ?></td>
    <td><?php echo $leave; ?></td>
	<td><form><input type="number" name="editleave" id="editleave">
   	<br />
	<input type="hidden" name="Leave" value="<?php echo $leave; ?>">
	<input type="hidden" name="staff_id" value=<?php echo $row['id']; ?>>
	<input type="submit" name="updateleaves" value="Update Leaves" style="font-family:Comic Sans MS, cursive, sans-serif; font-weight: bold; "/></form></td>	
</tr>
<?php 
 }
  }
  ?>
</table>
</div>
<div id="footer">
            <p style="text-align:center;"> &reg; Leave management system <br /><br/>&copy; Copyright 2016. All Rights Reserved.</p>
			<p><a href="admin_homepage.php">Leave Management System</a></p>
</div>
</body>
</html>