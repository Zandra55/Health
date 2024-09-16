<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "health";

$connectivity = mysqli_connect($hostname, $username, $password, $dbName);

if (!$connectivity) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
