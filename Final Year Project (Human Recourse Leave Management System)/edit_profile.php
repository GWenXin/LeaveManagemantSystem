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
input[type=text],[type=date],[type=tel], textarea, select{
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
  height: 50px;
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
p{
  color:orange;
  font-size:20px;
}
</style>
</head>
<body>
<?php
 session_start();
$connection = mysqli_connect("localhost", "root", "", "leave management");
?>
<div id="page">
		<div id="logo">
			<h1><a href="index.php" id="logoLink">Leave Management System</a></h1>
		</div>	
		
		<div id="nav">
			<ul>
				<li><a href="homepage.php">Home</a></li>				
				<li><a href="apply_leave.php">Apply Leave</a></li>
				<li><a href="view-leave.php">Leave History</a></li>
				<li><a href="chart-report.php">Leave Report</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="logout.php">Logout</a><li>
			</ul>
		</div>

<div id="content"> 
<?php 
  $sql = "select * from staff where Name='".$_SESSION["user"]."'";
  $result = mysqli_query($connection,$sql);
 if (mysqli_num_rows($result) > 0) 
  
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
   
    $ssid=mysqli_query($connection,"Select id from Staff where Name='$name'");
     if($row=mysqli_fetch_assoc($ssid))
	 {
       $id=$row['id'];
       $count=mysqli_query($connection,"Select * from Staff where id='$id' ");
       $countt=mysqli_num_rows($count);
      // echo $countt;	
	 }  
	$edit=mysqli_query($connection,"Select * from Staff where Name='$name'");
	while($row = mysqli_fetch_assoc($edit))
	{
?>
<form method="post">
 <fieldset> 
 <p><label>Name: </label><input type="text" value="<?php echo $row['Name'];?>" name="name" /></p>
 <p><label>ID</label> <u><?php echo $row['id'];?></u></p> 
 <p><label>Employee: </label><input type="radio" name="employee" value="admin" <?php echo ($employee=='admin')?'checked':'' ?>>Admin
                             <input type="radio" name="employee" value="Staff" <?php echo ($employee=='Staff')?'checked':'' ?>>Staff</p>
 <p><label>Birthday:  </label><input type="date" name="dob" value="<?php echo $row['Birthday'];?>"/></p>	
 <p><label>Address:  </label><textarea rows="2" cols="30" name="address"><?php echo $row['Address'];?></textarea></p> 
 <p><label>Phone:  </label><input type="tel" name="phone" value="<?php echo $row['Phone'];?>"/></p>
 <p><label>Department:  </label><select name="department" required>
                                <option value="Human Resource" <?php if (isset($department) && $department=="Human Resource") echo ' Department';else if ($row['Department']=="Human Resource") echo ' Department="Department"'; ?>>Human Resource</option>
                                <option value="Marketing" <?php if (isset($department) && $department=="Marketing") echo ' Department';else if ($row['Department']=="Marketing") echo ' Department="Department"'; ?>>Marketing</option>
                                <option value="Management" <?php if (isset($department) && $department=="Management") echo ' Department';else if ($row['Department']=="Management") echo ' Department="Department"'; ?>>Management</option>
                                <option value="Finance & Accounting" <?php if (isset($department) && $department=="Finance & Accounting") echo ' Department';else if ($row['Department']=="Finance & Accounting") echo ' Department="Department"'; ?>>Finance & Accounting</option>
                                <option value="Customer/Technical Support" <?php if (isset($department) && $department=="Customer/Technical Support") echo ' Department';else if ($row['Department']=="Customer/Technical Support") echo ' Department="Department"'; ?>>Customer/Technical Support</option>
                                <option value="Sales" <?php if (isset($department) && $department=="Sales") echo ' Department';else if ($row['department']=="Sales") echo ' Department="Department"'; ?>>Sales</option>
                                <option value="IT" <?php if (isset($department) && $department=="IT") echo ' Department';else if ($row['Department']=="IT") echo ' Department="Department"'; ?>>IT</option>
								</select>
                                </p>
 <p><label>Gender:  </label><input type="radio" name="gender" value="male" <?php echo ($gender=='male')?'checked':'' ?>>Male
                            <input type="radio" name="gender" value="female"<?php echo ($gender=='female')?'checked':'' ?>> Female</p>
 <p><label>Email: </label><input type="text" name="email" value="<?php echo $row['Email'];?>"/></p>
 <p><input type="submit" name="edit" value="Submit" id="edit"/></p>
<?php
}
?>
 </fieldset>
 </form>
 <?php
if(isset($_POST['edit']))
{   
    $name=$_POST['name'];
	$employee=$_POST['employee'];
	$dob=$_POST['dob'];	
	$address=$_POST['address'];
	$phone=$_POST['phone'];	
	$department=$_POST['department'];
	$gender=$_POST['gender'];
	$email=$_POST['email'];
	$update="Update Staff SET Name='$name', Employee='$employee',Birthday='$dob', Address='$address', Phone='$phone', Department='$department', Gender='$gender', Email='$email' where id='$id'";
	if(mysqli_query($connection,$update))
	{
		echo "<script>alert('Your profile has been changed.');
		      window.location.href='profile.php';
			  </script>";
	}
	
}
}
?>
   </div>
	<div id="footer">		   
				<p style="text-align:center;"> &reg; Leave management system <br/><br/>copy; Copyright 2016. All Rights Reserved.</p>
				<p><a href="homepage.php">Leave Management System</a></p>
		</div>
	</div>
</body>
</html>
