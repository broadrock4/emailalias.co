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
$email1 = mysqli_real_escape_string($link, $_POST['email1']);
$email2 = mysqli_real_escape_string($link, $_POST['email2']);
$email3 = mysqli_real_escape_string($link, $_POST['email3']);
$email4 = mysqli_real_escape_string($link, $_POST['email4']);
$email5 = mysqli_real_escape_string($link, $_POST['email5']);
$email6 = mysqli_real_escape_string($link, $_POST['email6']);
$email7 = mysqli_real_escape_string($link, $_POST['email7']);
$email8 = mysqli_real_escape_string($link, $_POST['email8']);
$email9 = mysqli_real_escape_string($link, $_POST['email9']);
$email10 = mysqli_real_escape_string($link, $_POST['email10']);
$id_user = $_SESSION["id"];

 $sql = "INSERT INTO groups (group_name, email1, email2, email3, email4, email5, email6, email7, email8, email9, email10, id_user) VALUES ('$group_name','$email1', '$email2', '$email3', '$email4', '$email5', '$email6', '$email7', '$email8', '$email9', '$email10', '$id_user')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
	header("location: ../home.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>