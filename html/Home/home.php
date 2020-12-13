<?php
// Initialize the session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if the user is logged in, if not then redirect him to login page
if ( !isset( $_SESSION[ "loggedin" ] ) || $_SESSION[ "loggedin" ] !== true ) {
  header( "location: ../Login/Login.php" );
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
<script type="text/javascript"> 
function anyvalidate() {
var valEmail = document.getElementById("contact");
var valGroup = document.getElementById("group");
if (   valEmail.value == ""
	&& valGroup.value == ""
	) {
alert( "You need to add a group or a contact!" );
     return false;
	 }
	 }
 </script>
<div class="page-header"> <img src="../Styles/Logo.png" alt="Logo" style="width:50%;">
  <p>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</p>
</div>
<div class="navBar"> 
	<a class="active" href="../Home/home.php">Home</a> 
	<a href="../NewAlias/newAlias.php">New Alias</a> 
	<a href="../Contact/contact.php">New Contact</a> 
	<a href="../EditAlias/editGroup.php">Edit Alias</a>
  <div class="navBar-right"> 
	  <a href="../ForgotPassword/index.php">Reset Password</a> 
	  <a href="../Login/logout.php">Sign Out</a> 
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
      include "../Config/config.php";
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
    <h2> Send Email </h2>
	  <p> If you want to email one contact fill "To Contact:" </br> If you want to email a group fill "To Group:"</p>
    <form name="form" action="../Home/sendEmail.php" onSubmit="return anyvalidate()" method="post">
	
		<input type="text" name="contact" id="contact" placeholder="To Contact:"/>
		
      <input type="text" name="group" id="group" placeholder="To Group:"/>
	
      <input type="text" style="text-align: center; width: 100%" name="subject" id="subject" required placeholder="Subject"/>
	</br>
       <textarea class="bodyArea" name="body" required id="body" placeholder="Enter text here..."></textarea>
	</br>
	<input type="submit" name="sendEmail" value="Send" />
    </form>
  </div>
</div>
</body>
</html>


