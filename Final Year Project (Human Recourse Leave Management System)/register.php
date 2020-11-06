<!DOCTYPE html>
<html>
<head>
<title>Register Page</title>
<style>
h2{
text-align: center;
font-size: 24px;
}
body{background: #FFE4C4;}
hr{
margin-bottom: 30px;
}
div.container{
width: 960px;
height: 610px;
margin:50px auto;
font-family: 'Droid Serif', serif;
position:relative;
}
div.main{
width: 320px;
float:left;
padding: 10px 55px 40px;
background-color: rgba(187, 255, 184, 0.65);
border: 15px solid white;
box-shadow: 0 0 10px;
border-radius: 2px;
font-size: 13px;
}
input[type=text],[type=password],[type=tel],[type=date],[type=date],select {
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
label{
color: #EB984E;
text-shadow: 0 1px 0 #fff;
font-size: 20px;
font-weight: bold;
}
#register {
font-size: 20px;
margin-top: 15px;
background: linear-gradient(#22abe9 5%, #36caf0 100%);
border: 1px solid #0F799E;
padding: 7px 35px;
color: white;
text-shadow: 0px 1px 0px #13506D;
font-weight: bold;
border-radius: 2px;
cursor: pointer;
width: 100%;
}
#register:hover{
background: linear-gradient(#36caf0 5%, #22abe9 100%);
}
</style>
<script type="text/javascript">
  function checkForm(form)
  {
    if(form.name.value == "") {
      alert("Error: Name cannot be blank!");
      form.name.focus();
      return false;
    }
	re = /[0-9]/;
	if(!re.test(form.phone.value)) {
        alert("Error: Phone must contain number!");
        form.phone.focus();
        return false;
      }
    
    if(form.password.value != "" && form.password.value == form.cpassword.value) {
      if(form.password.value.length < 8) {
        alert("Error: Password must contain at least 8 characters!");
        form.password.focus();
        return false;
      }
      if(form.password.value == form.name.value) {
        alert("Error: Password must be different from Username!");
        form.password.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.password.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.password.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.password.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.password.focus();
      return false;
    }
   return true;
}
</script>
</head>
<body>
<h1>Leave Management System</h1>
<form method="post" onsubmit="return checkForm(this);"> 
<fieldset>
<legend>Register Form</legend>
<p>Name : <input type="text" name="name" id="name" placeholder="Name" required></p>
<?php //<p>ID : <input type="text" name="id" id="id"placeholder="Id" required></p> /?>
<p>Employee : <input type="radio" name="employee" value="admin" id="employee" checked>Admin
              <input type="radio" name="employee" value="Staff" id="employee"> Staff</p>
<p>Birthday : <input type="date" name="dob" id="dob" required></p>
<p>Address : <input type="text" name="address" id="address" size="100" placeholder="Address" required></p>
<p>Phone : <input type="tel" name="phone" id="phone" placeholder="eg.60198877788" required></p>
<p>Password : <input type="password" name="password" id="password" placeholder="Password" required></p>
<p>Confirm Password : <input type="password" name="cpassword" id="cpassword" placeholder=" Confirm Password" required></p>
<p>Department : <select name="department" id="department">
  <option value="Human Resource">Human Resource</option>
  <option value="Marketing">Marketing</option>
  <option value="Management">Management</option>
  <option value="Finance & Accounting">Finance & Accounting</option>
  <option value="Customer/Technical Support">Customer/Technical Support</option>
  <option value="Sales">Sales</option>
  <option value="IT">IT</option>
</select>
<p>Gender : <input type="radio" name="gender" id="gender" value="male" checked> Male
            <input type="radio" name="gender" id="gender" value="female"> Female</p>
<p>E-mail : <input type="text" name="email" id="email" placeholder="Email" required></p>

<input type="submit" name="register" value="Register" style="font-weight: bold;"/>
<input type="button" type="clear" name="clear" value="Clear" style="font-weight: bold;"/>
<?php //<input type="button" name="login" value="Login" style="font-weight: bold;" onclick="location.href='login.php'"/> ?>
</fieldset>
</form>
<?php
$connection = mysqli_connect("localhost", "root", "", "leave management"); // Establishing connection with server..
if(isset( $_POST ['register'])){
$name=$_POST['name']; // Fetching Values from URL.
//$id=$_POST['id'];
$employee=$_POST['employee'];
$dob=$_POST['dob'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$password= sha1($_POST['password']); // Password Encryption, If you like you can also leave sha1.
$department=$_POST['department'];
$gender=$_POST['gender'];
$email=$_POST['email'];
// Check if e-mail address syntax is valid or not
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "Invalid Email.";
}else{
$result = mysqli_query($connection,"SELECT * FROM staff WHERE email='$email'");
$data = mysqli_num_rows($result);
if(($data)==0){
$query = mysqli_query($connection,"insert into staff(name, employee, birthday, address, phone, password, department, gender, email) values ('$name','$employee','$dob','$address','$phone', '$password','$department', '$gender', '$email')"); // Insert query
if($query){
    echo '<script type="text/javascript">alert("You have Successfully Registered.")</script>';

}else
  {
    echo '<script type="text/javascript">alert("Error!")</script>';
  }
}else{
   echo '<script type="text/javascript">alert("This email is already registered, Please try another email.")</script>';
     }
}

}
mysqli_close ($connection);
?>