<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );
session_start();

// Check if the user is logged in, if not then redirect him to login page
if ( !isset( $_SESSION[ "loggedin" ] ) || $_SESSION[ "loggedin" ] !== true ) {
  header( "location: ../Login/Login.php" );
  exit;
}
include "../Config/config.php";
$tempGroup = $_SESSION[ "group_name" ];
$tempUser = $_SESSION[ "id" ];
$tempEmail = mysqli_real_escape_string( $link, $_POST[ 'delete_email' ] );
$emailIndex = "email";
$sql2 = "SELECT email1, email2, email3, email4, email5, email6, email7, email8, email9, email10 FROM groups WHERE id_user ='$tempUser' AND group_name = '$tempGroup'";
$result2 = $link->query( $sql2 );
$row = mysqli_fetch_array( $result2 );
for ( $i = 0; $i < 10; $i++ ) {
  if ( $row[ $i ] == $tempEmail ) {
    ++$i;
    $index = ( string )$i;
    $deleteEmail = $emailIndex . $index;
    $sql = "UPDATE groups SET $deleteEmail = NULL WHERE group_name = '$tempGroup' AND id_user='$tempUser'";
    if ( $link->query( $sql ) === TRUE ) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $link->error;
    }

    break 1;
  }
	header("location: ../EditAlias/editGroup.php");
}

// Close connection
mysqli_close( $link );
?>