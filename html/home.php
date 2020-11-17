<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
 	<link rel="stylesheet" href="../Styles/emailAlias.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
		<img src="../Styles/Logo.png" alt="Logo" style="width:50%;">
        <p>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Email Alias.</p>
    </div>
	
	<div class="navBar">
	
  <a class="active" href="../home.php">Home</a>
  <a href="#newEmail">New Email</a>
  <a href="#newAlias">New Alias</a>
  <a href="#newContact">New Contact</a>
  <a href="#editAlias">Edit Alias</a>

	</div>
	
	<footer>
	<p>
        <a href="index.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
	</footer>
    
</body>
</html>