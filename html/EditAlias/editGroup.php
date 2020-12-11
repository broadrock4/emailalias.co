<?php
//Initialize the session
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
<div class="page-header"> <img src="../Styles/Logo.png" alt="Logo" style="width:50%;">
  <p>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Edit an Existing Group.</p>
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
	<div class="row">
	
  <div class="column"> <br/>
    <br/>
    <br/>
    <br/>
    <div style="background-color: rgba(17, 18, 35, 0.79); height: 500px; overflow-y: scroll"> <br/>
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
  <div class="column">
	<br/>
    <br/>
    <br/>
	  <div style="background-color: rgba(17, 18, 35, 0.79); height: 500px">
		  <h3> Enter Group Name </h>
  	<form action="../EditAlias/showGroupEmails.php" method="post">
     <input type="text" name="group_name" required placeholder="Name" class="form-control"/>
		</br>
		<input type="submit" id="submit" name="submit" class="submitButtons" value="Submit"> 
    </form>
		  <h3> Emails </h3> 
		  <div class="showEmails">
		  <?php 
			  include "../Config/config.php";
		  $tempGroup = $_SESSION["group_name"];
		  $tempUser = $_SESSION["id"];
		  $sql2 = "SELECT email1, email2, email3, email4, email5, email6, email7, email8, email9, email10 FROM groups WHERE id_user ='$tempUser' AND group_name = '$tempGroup'";
			  echo "Selected Group ";
			  echo("</br>");
			  echo($tempGroup);
		  $result2 = $link->query( $sql2 );
		  $row = mysqli_fetch_array($result2);
		  for($i =0; $i < 10; $i++){
		  		if ($row[$i] != NULL){
        	echo "<div style='padding: 10px; font-size: 2vh;'>" . $row[$i] . "<br />" . "</div>";
				
				}
		  }
		  ?>
		</div>
	  </div>
  </div>
		<div class="column">
			<br/>
    <br/>
    <br/>
		 <div style="background-color: rgba(17, 18, 35, 0.79); height: 500px">
		  <h3> Edit Group </h3>
			 <p style="font-size: 1.5vh"> Must specify group name to the left before editing a group</p>
  	<form action="../EditAlias/addContact.php" method="post">
		</br>
		</br>
		<label> Add email</label>
		</br>
     <input type="email" name="add_email" required placeholder="Enter Email" class="form-control"/>
		</br>
		<input type="submit" id="submit" name="submit" class="submitButtons" value="Add"> 
    </form>
	
		<form action="../EditAlias/deleteContact.php" method="post">
		</br>
		</br>
		<label> Delete Email </label>
		</br>
     <input type="email" name="delete_email" required placeholder="Enter Email" class="form-control"/>
</br>
		<input type="submit" id="submit" name="submit" class="submitButtons" value="Delete"> 
    </form>
		 
		</div>
	  </div>
		
		</div>
		
</div>
</body>
</html>

