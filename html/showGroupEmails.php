<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if the user is logged in, if not then redirect him to login page
if ( !isset( $_SESSION[ "loggedin" ] ) || $_SESSION[ "loggedin" ] !== true ) {
  header( "location: Login.php" );
  exit;
}
 include "../html/config.php";
//user input
$group_name = mysqli_real_escape_string($link, $_POST['group_name']);
$_SESSION["group_name"] = $group_name;  
 header("location: ../editGroup.php");
// Close connection
mysqli_close($link);
?>