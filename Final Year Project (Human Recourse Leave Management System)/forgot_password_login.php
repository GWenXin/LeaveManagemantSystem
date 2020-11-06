<?php
// Initialize Variables to Null.
$email =""; // Sender's E-mail ID
$Error ="";
$successMessage ="";
// On Submitting Form Below Function Will Execute
if(isset($_POST['submit']))
{
if (!($_POST["email"]==""))
{
$email =$_POST["email"];  // Calling Function To Remove Special Characters From E-mail
$email = filter_var($email, FILTER_SANITIZE_EMAIL);  // Sanitizing E-mail(Remove unexpected symbol like <,>,?,#,!, etc.)
if (filter_var($email, FILTER_VALIDATE_EMAIL))
{
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_"; // Generating Password
$password = substr( str_shuffle( $chars ), 0, 8 );
$password1= sha1($password);
$connection = mysql_connect("localhost", "root", "", "leave management");  // Establishing Connection With Server..
//$db = mysql_select_db("staff", $connection);  // Selecting Database
$query = mysql_query("UPDATE staff SET password='$password1' WHERE email='$email'");
if($query)
{
$to = $email;
$subject = 'Your New Password...';
// Let's Prepare The Message For E-mail.
$message = 'Hello User
Your new password : '.$password.'
E-mail: '.$email.'
Now you can login with this email and password.';
// Send The Message Using mail() Function.
if(mail($to, $subject, $message ))
{
$successMessage = "New Password has been sent to your mail, Please check your mail and SignIn.";
}
}
}
else{
$Error = "Invalid Email";
}
}
else{
$Error = "Email is required";
}
}
?>
<!DOCTYPE html>
<html>
<style>
body {
  font: 13px/20px 'Lucida Grande', Tahoma, Verdana, sans-serif;
  color: #404040;
  background: #FFE4C4;
}
.container {
  margin: 80px auto;
  width: 640px;
}
.login {
  position: relative;
  margin: 0 auto;
  padding: 20px 20px 20px;
  width: 310px;
  background: white;
  border-radius: 3px;
  @include box-shadow(0 0 200px rgba(white, .5), 0 1px 2px rgba(black, .3));

  &:before {
    content: '';
    position: absolute;
    top: -8px; right: -8px; bottom: -8px; left: -8px;
    z-index: -1;
    background: rgba(black, .08);
    border-radius: 4px;
  }
  h1 {
    margin: -20px -20px 21px;
    line-height: 40px;
    font-size: 30px;
    font-weight: bold;
    color: #555;
    text-align: center;
    text-shadow: 0 1px white;
    background: #f3f3f3;
    border-bottom: 1px solid #cfcfcf;
    border-radius: 3px 3px 0 0;
    @include linear-gradient(top, whiteffd, #eef2f5);
    @include box-shadow(0 1px #f5f5f5);
  }
  p {margin: 20px 0 0; }
  p:first-child { margin-top: 0; }
  input[type=text], input[type=password] { width: 278px; }
  p.remember_me {
    float: left;
    line-height: 31px;

    label {
      font-size: 12px;
      color: #777;
      cursor: pointer;
    }
    input {
      position: relative;
      bottom: 1px;
      margin-right: 4px;
      vertical-align: middle;
    }
  }
  p.submit { text-align: right;}
}
.login-help {
  margin: 20px 0;
  font-size: 11px;
  color: white;
  text-align: center;
  text-shadow: 0 1px #2a85a1;
  a {
    color: #cce7fa;
    text-decoration: none;

    &:hover { text-decoration: underline; }
  }
}
:-moz-placeholder {
  color: #c9c9c9 !important;
  font-size: 13px;
}

::-webkit-input-placeholder {
  color: #ccc;
  font-size: 13px;
}
input {
  font-family: 'Lucida Grande', Tahoma, Verdana, sans-serif;
  font-size: 14px;
}
input[type=text], input[type=password] {
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

input[type=submit] {
  padding: 0 18px;
  height: 29px;
  font-size: 12px;
  font-weight: bold;
  color: #527881;
  text-shadow: 0 1px #e3f1f1;
  background: #cde5ef;
  border: 1px solid;
  border-color: #b4ccce #b3c0c8 #9eb9c2;
  border-radius: 16px;
  outline: 0;
  @include box-sizing(content-box); // Firefox sets this to border-box by default
  @include linear-gradient(top, #edf5f8, #cde5ef);
  @include box-shadow(inset 0 1px white, 0 1px 2px rgba(black, .15));

  &:active {
    background: #cde5ef;
    border-color: #9eb9c2 #b3c0c8 #b4ccce;
    @include box-shadow(inset 0 0 3px rgba(black, .2));
  }
}
.lt-ie9 {
  input[type=text], input[type=password] { line-height: 34px; }
}
.button {font-size: 20px;}
</style>
<head>
<title>Forgot Password</title>
</head>
<body>
<div class="container">
 <h1 style=" border:0; solid #fff;  border-bottom-width:1px; padding-bottom:10px; text-align: center;">Leave Management System</h1>
 <h1 style=" border:0; solid #fff;  border-bottom-width:1px; padding-bottom:10px; text-align: center;">Forgot Password</h1>
 <hr />
<form method="post">
<p style="text-align: center; font-size:20px;"><label class="heading">E-mail :</label>
<input name="email" type="text"></p>
<p style="text-align: center; font-size:20px;"><input name="submit" type="submit" value="Resend Password"></p>
<hr />
<p style="text-align: center; font-size:20px;"><span class="error"><?php echo $Error;?></span></p>
<p style="text-align: center; font-size:20px;"><span class="success"><?php echo $successMessage;?></span></p>
</form> 
<p style="text-align: center; font-size:20px;"><b>Note :</b> Enter your email, password will be send to your email address.</p>
<p style="text-align: center; font-size:18px;"><a style="text-decoration: none;" href="login.php">Sign In</a></p>
<hr>	
	<p style="text-align:center;"> &reg; Leave management system <br>&copy; Copyright 2016. All Rights Reserved.</p>
</div>

</body>
</html>