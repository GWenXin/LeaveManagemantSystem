<?php
 session_start();
 
// if (!isset($_SESSION['user'])) {
//  header("Location: login.php");
// } else if(isset($_SESSION['user'])!="") {
//  header("Location: login.php");
// }
 
// if (isset($_REQUEST['logout'])) {
  session_destroy();
  unset($_SESSION['user']);

  // exit;
// }
    header("refresh:0; url='login.php'");
 
?> 
