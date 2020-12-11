<?php

$hostname = "csusm.c0uo1rgt9ctn.us-west-2.rds.amazonaws.com"; // the hostname you created when creating the database
$username = "cs441";      // the username specified when setting up the database
$password = "csusmcs441";      // the password specified when setting up the database
$database = "Email_Alias"; // the database name chosen when setting up the database 
$error="";

$link = mysqli_connect($hostname, $username, $password, $database);
if (mysqli_connect_errno()) {
   die("Connect failed: %s\n" + mysqli_connect_error());
   exit();
}
?>