<!DOCTYPE html>
<html>
<head>
<title>Leave Management System</title>
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
textarea{
  width: 97.7%;
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
table{font-size:20px;}
</style>
</head>
<div id="page">
		<div id="logo">
			<h1><a href="index.php" id="logoLink">Leave Management System</a></h1>
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
<?php 
  session_start();
  $connection = mysqli_connect("localhost", "root", "", "leave management");
 $sql = "select * from staff where Name='".$_SESSION["user"]."'";
  $result = mysqli_query($connection,$sql);
 if (mysqli_num_rows($result) > 0) 
  {
 if($row = mysqli_fetch_assoc($result))
 {
   $name=$row['Name'];
   $id=$row['id'];
   $employee=$row['Employee'];
   $dob=$row['Birthday'];
   $address=$row['Address'];
   $phone=$row['Phone'];
   $department=$row['Department'];
   $gender=$row['Gender'];
   $email=$row['Email'];
   $_SESSION['user']=$name;
  // $picture=$row['picture'];
  }
 }

  $ssid=mysqli_query($connection,"Select id from Staff where Name='$name'");
     if($row=mysqli_fetch_assoc($ssid))
       $id=$row['id'];
       $count=mysqli_query($connection,"Select * from Staff where id='$id' ");
       $countt=mysqli_num_rows($count);
       //echo $countt;	
	
    $name=$_SESSION['user'];
	
    $profile=mysqli_query($connection,"Select * from Staff where Name='$name'");
	if($row = mysqli_fetch_assoc($profile))
{
 ?>
	<form name="profile" class="profile">
	<fieldset>
    <table width="398" border="0" align="center" cellpadding="0">
      <tr>
        <td height="26" colspan="2"><h1>Profile Information</h1></td>       
      </tr>
	  
      <tr>       
        <td width="82" valign="top"><div align="left"><h3>Name :</h3></div></td>
        <td width="165" valign="top"><?php echo $row['Name']; ?></td>
      </tr>
      <tr>
        <td valign="top"><div align="left"><h3>ID :</h3></div></td>
        <td valign="top"><?php echo $row['id']; ?></td>
      </tr>
	  <tr>
        <td valign="top"><div align="left"><h3>Employee :</h3></div></td>
        <td valign="top"><?php echo $row['Employee']; ?></td>
      </tr>
	  <tr>
        <td valign="top"><div align="left"><h3>Address :</h3></div></td>
        <td valign="top"><?php echo $row['Address']; ?></td>
      </tr>
	  <tr>
        <td valign="top"><div align="left"><h3>Phone :</h3></div></td>
        <td valign="top"><?php echo $row['Phone']; ?></td>
      </tr>
	  <tr>
        <td valign="top"><div align="left"><h3>Department :</h3></div></td>
        <td valign="top"><?php echo $row['Department']; ?></td>
      </tr>
      <tr>
        <td valign="top"><div align="left"><h3>Gender :</h3></div></td>
        <td valign="top"><?php echo $row['Gender']; ?></td>
      </tr>
      <tr>
        <td valign="top"><div align="left"><h3>Email :</h3></div></td>
        <td valign="top"><?php echo $row['Email']; ?></td>
      </tr>
	  <tr>
      <td><input type="button" name="edit" value="Edit Profile" onclick="location.href='admin_edit_profile.php'"/></td>
      <td><input type="button" name="changepassword" value="Change Password" onclick="location.href='admin_change_password.php'" /></td>	
	</tr>
    </table>
	<br/>
	
</fieldset>
<?php
}
 ?>
</form>
</div>
	<div id="footer">
			<p style="text-align:center;"> &reg; Leave management system <br/>&copy; Copyright 2016. All Rights Reserved.</p>
			<p><a href="admin_homepage.php">Leave Management System</a></p>
    </div>	
  </div>	
	

