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
  <p>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Create New Contact.</p>
</div>
<div class="navBar"> 
	<a href="../home.php">Home</a> 
	<a href="#newEmail.php">New Email</a> 
	<a href="../newAlias.php">New Alias</a> 
	<a class="active" href="../newContact.php">New Contact</a> 
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
      <h3> <?PHP echo htmlspecialchars($_SESSION["username"]); ?>'s Contacts </h3> 
      <?php
      include "../html/config.php";
		$tempUser = ($_SESSION['id']);
      $sql = "SELECT contact_name FROM contact WHERE user_id = '$tempUser'";
      $result = $link->query( $sql );

      if ( $result->num_rows > 0 ) {
        while ( $row = mysqli_fetch_assoc( $result ) ) {
          echo "<div class='group_table'>" . $row[ "contact_name" ] . "<br>" . "</div>";
        }
      } else {
        echo "0 results"; 
      }
		
      ?>
    </div>
  </div>
  <div class="col-2">
	<br/>
    <br/>
    <br/>
	  <div style="background-color: rgba(17, 18, 35, 0.79); height: 460px">
    <h2> Contact Name </h2>
    <form action="newContact.php" method="POST">
     <input type="text" name="contact_name" required placeholder="Name" class="newContactForm"/>
		<h2> Contact Email </h2>
		<input type="text" name="contact_email" required placeholder="Email" class="newContactForm"/>
		</br>
		<input type="submit" id="submit" name="submit" class="submitButtons" value="Submit">
    </form>
		  <p> Click to add contact to an existing group</p>
		<a href="../editGroup.php"> Edit Alias </a>
	  </div>
  </div>
</div>
</body>
</html>