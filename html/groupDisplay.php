<?php
include "../config.php";
$sql = "SELECT username FROM users";
$result = $link->query( $sql );

if ( $result->num_rows > 0 ) {
  while ( $row = mysqli_fetch_assoc( $result ) ) {
    echo "<div class='group_table'>" . $row[ "username" ] . "<br>" . "</div>";
  }
} else {
  echo "0 results";
}
$link->close();
?>