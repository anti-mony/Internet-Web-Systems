<?php
$servername = "localhost";
$username = "sushant";
$password = "bansal";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
header("location:main.php");
?>