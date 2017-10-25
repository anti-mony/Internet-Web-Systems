<?php
	$DB_SERVER = "localhost";
   	$DB_USERNAME ="sushant";
   	$DB_PASSWORD = "bansal";
   	$DB_DATABASE = "prashn-uttar";
   	$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
   	if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
	}
?>