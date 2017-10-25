<?php 
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

	$myusername = mysqli_real_escape_string($db,$_POST['username']);
	$mypassword = mysqli_real_escape_string($db,$_POST['password']); 

	$sql = "SELECT * FROM users WHERE Username = '$myusername' and Password = '$mypassword'";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	$count = mysqli_num_rows($result);

   	if($count == 1) {
   		$_SESSION['login_user'] = $myusername;
		header("location: index.php");
	}else {
		$error = "Your Login Name or Password is invalid";
	}
}

?> 
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Prashn-Uttar</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="top">
			<img  id="title" src="logo.png" alt="Prashn-Uttar" height="48" width="320">
		</div>
		<div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Log In</h2>
			</div>
			<form action="" method="post" accept-charset="utf-8">
				<label for="username">Username</label>
				<br/>
				<input type="text" name="username">
				<br/>
				<label for="password">Password</label>
				<br/>
				<input type="password" name="password">
				<br/>
				<button type="submit" value="submit" >Sign In</button>
				<br/>
				<a href="#"><p class="small">Forgot your password?</p></a>
			</form>
		</div>
	</div>
</body>

<script>
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>

</html>