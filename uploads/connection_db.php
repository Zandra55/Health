<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "health";

// Establish connection
$connectivity = mysqli_connect($hostname, $username, $password, $dbName);

// Check connection
if (!$connectivity) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
