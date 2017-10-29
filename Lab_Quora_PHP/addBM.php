<?php
include('config.php');
session_start();
if(isset($_POST['qid']))
{
	$qid = $_POST['qid'];
    $uid = $_SESSION['login_user'];
    $sqlx = "INSERT INTO bookmarks (Username, QID) VALUES ('$uid','$qid')";
    mysqli_query($db,$sqlx);
    // Do whatever you want with the $uid
}
?>