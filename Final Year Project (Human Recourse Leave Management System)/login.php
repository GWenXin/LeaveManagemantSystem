<!DOCTYPE html>
<head>
<?php
 ob_start();
 session_start();
 $connection = mysqli_connect("localhost", "root", "", "leave management"); 
//echo "line 215<br>"; 
 // it will never let you open index(login) page if session is set
 
//echo "line 223<br>"; 
 
 if( isset($_POST['login']) ) { 
  
 // echo "line 227<br>"; 

  $employee = $_POST{'employee'};
  $name= $_POST['name'];
  $password=$_POST['password'];
  
  $employee = strip_tags(trim($employee));
  $name = strip_tags(trim($name));
  $password = strip_tags(trim($password));
  
  $password= sha1($_POST['password']); // Password Encryption, If you like you can also leave sha1.  
  //$password = hash('Sha246@', $password); // password hashing using Sha246@
  $staff=$_POST['employee'];
  $query = "SELECT * FROM Staff WHERE Employee='$employee' and Name='$name' AND Password='$password'";
//echo $query."<br>"; 
 $result=mysqli_query($connection,$query);
  
  $row=mysqli_fetch_array($result);
  
  $count=mysqli_num_rows($result); // if uname/pass correct it returns must be 1 row

  
//echo "count=".$count."<br>";  
//print_r($row);
  if( $count == 1 && $row['Password']==$password ) {
	$_SESSION['uid'] = $row['id'];  
   $_SESSION['user'] = $row['Name'];
		header("refresh:0; url='homepage.php'");
  } else {
   $errMSG = "Wrong Credentials, Try again.";
  }
 }

 if ( isset($_SESSION['user']) ) {

//echo "line 218<br>"; 

    if (strlen($_SESSION['user'])>0) {
		if($_POST['employee']=='staff') {
		    header("refresh:0; url='homepage.php'");
	    } else {
		header("refresh:0; url='admin_homepage.php'");
			
		}
    }
 }

 
 mysqli_close ($connection); // Connection Closed.
?>
<title>Login System</title>
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
</head>
<body>
<div class="container">

 <div id="login-form">
    <form method="post" autocomplete="off">
    
     <div class="col-md-12">
        
         <div class="form-group">
		     <h1 style=" border:0; solid #fff;  border-bottom-width:1px; padding-bottom:10px; text-align: center;">Leave Management System</h1>
             <h1 style=" border:0; solid #fff;  border-bottom-width:1px; padding-bottom:10px; text-align: center;">Login</h1>
            </div>
        
         <div class="form-group">
             <hr />
            </div>
            
 
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
				<p style="text-align: center; font-size:20px;">Employee : <input type="radio" name="employee" value="admin" id="employee" checked>Admin
                                                                          <input type="radio" name="employee" value="staff" id="employee"> Staff</p>
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <p style="text-align: center; font-size:20px;">Name : <input type="text" name="name" class="form-control" placeholder="Name" required /></p>
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <p style="text-align: center; font-size:20px;">Password : <input type="password" name="password" class="form-control" placeholder="Password" required /></p>
                </div>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
<?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-danger">
                  <span class="glyphicon glyphicon-info-sign"></span><p style="text-align: center; font-size:20px;"><?php echo $errMSG; ?></p>
                </div>
             </div>
                <?php
   }
   ?> 
            <div class="form-group">
             <p style="text-align: center; font-size:20px;"><input type="submit" name="login" value="Login"></p>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
			
             <div class="form-group">
             <p style="text-align: center; font-size:18px;"><a target="_blank" style="text-decoration: none;" href="forgot_password_login.php">Forgot Password</a></p>
            </div>
			
  <?php /*  <div class="form-group">
             <p style="text-align: center; font-size:18px;"><a target="_blank" style="text-decoration: none;" href="register.php">Registration</a></p>
            </div> */ ?>
        
        </div>
   
     </form>
    </div> 
	<hr>	
	<p style="text-align:center;"> &reg; Leave management system <br>&copy; Copyright 2016. All Rights Reserved.</p>
	   
</div>

</body>
</html>
