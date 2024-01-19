<?php
// start the session 
session_start();

// create constants to store non-repeating values
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Fixed typo in constant name
define('DB_NAME', 'food-order');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); // Use constant values instead of constant names

$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); // Use constant value instead of constant name
?>
