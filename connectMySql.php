<?php
$servername = "localhost"; 
$username_server = "friday";
$password_server = "Test@123";
$db = "cemetery";
$conn = mysqli_connect($servername, $username_server, $password_server,$db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>