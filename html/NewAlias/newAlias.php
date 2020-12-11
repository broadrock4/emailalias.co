<?php
// Initialize the session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if the user is logged in, if not then redirect him to login page
if ( !isset( $_SESSION[ "loggedin" ] ) || $_SESSION[ "loggedin" ] !== true ) {
  header( "location: /Login/Login.php" );
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
  <p><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Create new groups .</p>
</div>
<div class="navBar"> 
	<a class="active" href="../Home/home.php">Home</a> 
	<a href="#newEmail.php">New Email</a> 
	<a href="../NewAlias/newAlias.php">New Alias</a> 
	<a href="../Contact/contact.php">New Contact</a> 
	<a href="../EditAlias/editGroup.php">Edit Alias</a>
  <div class="navBar-right"> 
	  <a href="../ForgotPassword/index.php">Reset Password</a> 
	  <a href="../Login/logout.php">Sign Out</a> 
	</div>
</div>
<div class="container-grid-alias">
  <div class="col-1"> <br/>
    <br/>
    <br/>
    <br/>
    <div class="oval-newAlias flipped"> <br/>
      <h3> <?PHP echo htmlspecialchars($_SESSION["username"]); ?>'s Groups </h3> 
      <?php
      include "../Config/config.php";
		$tempUser = ($_SESSION['id']);
      $sql = "SELECT username FROM users";
      $result = $link->query( $sql );

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
    <br/>
    <br/>
    <br/>
	<br/>
      
	<div class="oval-newAlias"> <br/>
		<h2> Add Group </h2>
      <form action="../NewAlias/addGroup.php" method="post">
      <input type="text" name="group_name" required placeholder="Enter Group Name" class="form-control"/>
		 <p> Must specify at least two emails. </p>
      <input type="email" name="email1" required placeholder="Enter email" class="form-control"/>
      <input type="email" name="email2" required placeholder="Enter email" class="form-control"/>
      <input type="email" name="email3" placeholder="Enter email" class="form-control"/>
      <input type="email" name="email4" placeholder="Enter email" class="form-control"/>
      <input type="email" name="email5" placeholder="Enter email" class="form-control"/>
      <input type="email" name="email6" placeholder="Enter email" class="form-control"/>
      <input type="email" name="email7" placeholder="Enter email" class="form-control"/>
      <input type="email" name="email8" placeholder="Enter email" class="form-control"/>
      <input type="email" name="email9" placeholder="Enter email" class="form-control"/>
      <input type="email" name="email10" placeholder="Enter email" class="form-control"/>
	  <input type="submit" id="submit" name="submit" class="submitButtons" value="Submit">
    </form>
   </div>
  </div>
</div>
</body>
</html>

