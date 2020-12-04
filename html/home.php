<?php
// Initialize the session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if the user is logged in, if not then redirect him to login page
if ( !isset( $_SESSION[ "loggedin" ] ) || $_SESSION[ "loggedin" ] !== true ) {
  header( "location: Login.php" );
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
body {
    font: 14px sans-serif;
    text-align: center;
}
</style>
</head>
<body>
<div class="page-header"> <img src="../Styles/Logo.png" alt="Logo" style="width:50%;">
  <p>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</p>
</div>
<div class="navBar"> 
	<a class="active" href="../home.php">Home</a> 
	<a href="#newEmail.php">New Email</a> 
	<a href="../newAlias.php">New Alias</a> 
	<a href="../contact.php">New Contact</a> 
	<a href="../editGroup.php">Edit Alias</a>
  <div class="navBar-right"> 
	  <a href="../index.php">Reset Password</a> 
	  <a href="../logout.php">Sign Out</a> 
	</div>
</div>
<div class="container-grid">
  <div class="col-1"> <br/>
    <br/>
    <br/>
    <br/>
    <div class="oval flipped"> <br/>
      <h3> <?PHP echo htmlspecialchars($_SESSION["username"]); ?>'s Groups </h3> 
      <?php
      include "../html/config.php";
		$tempUser = ($_SESSION['id']);
      $sql = "SELECT group_name FROM groups WHERE id_user = '$tempUser'";
      $result = $link->query( $sql );

      if ( $result->num_rows > 0 ) {
        while ( $row = mysqli_fetch_assoc( $result ) ) {
          echo "<div class='group_table'>" . $row[ "group_name" ] . "<br>" . "</div>";
        }
      } else {
        echo "0 results"; 
      }
		
      ?>
    </div>
  </div>
  <div class="col-2">
    <h2> Inbox </h2>
    <form action="">
       <textarea class="inboxArea" placeholder="Insert inbox?"> </textarea>
    </form>
  </div>
</div>
</body>
</html>