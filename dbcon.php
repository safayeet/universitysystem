<?php

$dbName="universitysystem";
$dbUser="root";
$dbPass="1234";
$hostName="localhost";

$conn = new mysqli($hostName, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

