<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if the user is logged in, if not then redirect him to login page
if ( !isset( $_SESSION[ "loggedin" ] ) || $_SESSION[ "loggedin" ] !== true ) {
  header( "location: ../Login/Login.php" );
  exit;
}
 include "../Config/config.php";
//user input
$contact_name = mysqli_real_escape_string($link, $_POST['contact_name']);
$contact_email = mysqli_real_escape_string($link, $_POST['contact_email']);
$user_id = $_SESSION["id"];

 $sql = "INSERT INTO contact (contact_name, contact_email, user_id) VALUES ('$contact_name', '$contact_email', '$user_id')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
	header("location: ../Contact/contact.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>