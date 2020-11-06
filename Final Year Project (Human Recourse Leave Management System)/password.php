<!DOCTYPE html>
<html>
<head>
<title>Homepage of Employee</title>	
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

.c{
	padding: 20px;
	height: 10px;
	display: inline-block;
	background: orange;
	color: white;
}			
</style>
</head>
<body>
	<div id="page">
		<div id="logo">
			<h1><a href="admin_homepage.php" id="logoLink">Leave Management System</a></h1>
		</div>
		<div id="nav">
			<ul>
				<li><a href="admin_homepage.php">Home</a></li>
				<li><a href="view-leave.php">Leave History</a></li>
				<li><a href="apply_leave.php">Apply Leave</a></li>
				<li><a href="chart-report.php">Leave Report</a></li>
				<li><a target="_blank" href="register.php">Add New Staff</a></li>
				<li><a href="profile.php">Update profile</a><li>
				<li><a href="logout.php">Logout</a><li>
			</ul>	
		</div>
		<div id="content">
		    <form name="" method="post" enctype='multipart/form-data'>
            <input id="browse" type="file" name="image"> 
            <input id="upload" type="submit" name="Submit"
            value="Change your primary picture" /> <br> <br> <br>
            </form>
            <form name="insert" method="post"><br>
            <p>Firstname:<input type="text" name="name" id="inputtype" value="<?php echo $first; ?>"></p>				
			<p>Lastname:<input type="text" name="lastname" id="inputtype" value="<?php echo $last; ?>"></p> <br>
            <p>Change Password: <input type="text" name="password" id="inputtype" value="<?php echo $pass; ?>"></p> <br>
            <p>EmailAddress:<input type="text" name="email" id="inputtype" value="<?php echo $email; ?>"></p> <br>

            <br> <br>
            <p align="right"style="padding-right: 129px; width: 121px; height: 48px;"><input type="submit" id="inputsubmit" name="insert" value="Save" id="save" width="10px"></p> <br />
</form>
<div class="art-blockcontent-body">
<h2 class="art-postheader"></h2>
<div class="cleared"></div>
<div>
<form method='post' action='profiletest.php'></form>
</div>
		</div>
		<div id="footer">
		    <p class="c"><a target="_blank" href="change_password.php">Change Password</a></p>
			<p>Leave Management System</p>
		</div>
	</div>
</body>
</html>
<?php
session_start();
include("connection.php");
include("function.php");

if($_SESSION['login'] != 'true'){
    header("location:index.php");
}
$id = $_SESSION['member_id'];   
$select = mysqli_query($dbc,"SELECT * FROM members WHERE member_id = '$id'");
$object = mysqli_fetch_array($select);


$username=$object['username'];
$first=$object['firstname'];
$last=$object['lastname'];
$pass=$object['password'];
$email=$object['email'];



 if(isset($_POST['insert'])) 
{
        $name = $_POST['name'];
        $lastname  = $_POST['lastname'];
        $password   = $_POST['password'];
        $email = $_POST['email'];



        $sql = mysqli_query($dbc,"UPDATE staff SET name = '$name', lastname = '$lastname', password = '$password', email = '$email',  WHERE member_id = '$id'") or die(mysqli_error($dbc));
        $result = mysqli_query($dbc,$sql);

        if ($result){
                $success = '<p style="color:blue;text-align:center;"> Records saved!</p>';
        }
    header("location:profiletest.php");


}
if(isset($_POST['Submit'])){
        $member_id=$_SESSION['member_id'];
        $name = $_FILES["image"] ["name"];
        $type = $_FILES["image"] ["type"];
        $size = $_FILES["image"] ["size"];
        $temp = $_FILES["image"] ["tmp_name"];
        $error = $_FILES["image"] ["error"];
        mysqli_query($dbc,"UPDATE members SET photo = '$name' WHERE member_id = '$member_id'") or die(mysqli_error($dbc));

        if ($error > 0){
            die("Error uploading file! Code $error.");
        }else{
            if($size > 10000000) //conditions for the file
            {
            die("Format is not allowed or file size is too big!");
            }
            else
            {
            move_uploaded_file($temp,"image/members/".$name);
            }
        } 
    }

?>