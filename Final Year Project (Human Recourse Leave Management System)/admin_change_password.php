<!DOCTYPE html>
<html>
<head>
<?php
 session_start();
$_SESSION["user"];
$connection = mysqli_connect("localhost","root","","leave management");
if(count($_POST)>0) {
$result = mysqli_query($connection,"SELECT *from staff WHERE Name='".$_SESSION["user"]."'");
$row=mysqli_fetch_array($result);

//echo $_SESSION["user"]."<br>";

//echo $row["Password"]."<br>";
//echo sha1($_POST["currentPassword"])."<br>";
//echo $_POST["currentPassword"]."<br>";

if(sha1($_POST["currentPassword"]) == $row["Password"]) {
mysqli_query($connection,"UPDATE staff set Password='" . sha1($_POST["newpassword"]) . "' WHERE Name='" . $_SESSION["user"] . "'");
$message = '<script type="text/javascript">alert("Password Changed")</script>';
} else $message = <script type="text/javascript">alert("Current Password is not correct")</script>;
}
?>

<title>Change Password</title>
<style>
p{ line-height: 18px; }
h1, h2, h3, h4{
    color: orange;
	font-weight: normal;
	line-height: 1.1em;
	margin: 0 0 .5em 0;
}
h1{ font-size: 25px; }
h2{ font-size: 20px; }
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
input[type=password], select{
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
  width:50%;
  height:40px;
  padding-left: 5px; 
  margin-top: 8px;
  box-shadow: 0 0 5px #EB984E;
  border: 2px solid #EB984E;
  color: #4f4f4f;
  font-size: 18px;
}

</style>
</head>
<script>
function validatePassword() {
var currentpassword,newpassword,cpassword,output = true;

currentpassword = document.frmChange.currentpassword;
newpassword = document.frmChange.newpassword;
cpassword = document.frmChange.cpassword;

if(!password.value) {
currentpassword.focus();
document.getElementById("currentpassword").innerHTML = "required";
output = false;
}
else if(!newpassword.value) {
newpassword.focus();
document.getElementById("newpassword").innerHTML = "required";
output = false;
}
else if(!cpassword.value) {
cpassword.focus();
document.getElementById("cpassword").innerHTML = "required";
output = false;
}
if(newpassword.value != cpassword.value) {
newpassword.value="";
cpassword.value="";
newpassword.focus();
document.getElementById("cpassword").innerHTML = "Password not same with the confirm password";
output = false;
} 	
return output;
}

</script>
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
<body>
<h1>Change Password</h1>
<form name="frmChange" method="post" onSubmit="return validatePassword()">
<div style="width:500px;">

<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr class="table">
</tr>
<tr>
<td width="40%"><h2>Current Password</h2></td>
<td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentpassword" class="required"></span></td>
</tr>
<tr>
<td><h2>New Password</h2></td>
<td><input type="password" name="newpassword" class="txtField" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
  if(this.checkValidity()) form.cpassword.pattern = this.value;"><span id="newpassword" class="required"></span></td>
</tr>
<td><h2>Confirm Password</h2></td>
<td><input type="password" name="confirmPassword" class="txtField" title="Please enter the same Password as above" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"><span id="cpassword" class="required"></span></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="Submit">
<input class="button" type="reset" name="clear" value="Clear"/>
<input type="button" name="profile" value="Profile" onclick="location.href='admin_profile.php'"/></td>
</tr>
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
</table>
</div>
</form>
</body>
<div id="footer">   
	<p style="text-align:center;"> &reg; Leave management system <br/>&copy; Copyright 2016. All Rights Reserved.</p>
	<p><a href="admin_homepage.php">Leave Management System</a></p>
</div>
</html>

