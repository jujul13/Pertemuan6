<?php
 session_start();
 if(isset($_SESSION['login']) && $_SESSION['login'] == 1){
	 header('Location: adminMenu.php');
 }
?>


<html lang="en">
	<head>
	<title>Login Page</title>
	<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
	</head>
<body>
<div id="header">
	<h1>Widget Corp Login</h1>
	</div>
	
<div id="main">
	<div id="navigation">
	<ul><li><a href="form_regis.php">Register</a></li></ul>
	</div>
	<div id="page">
<form action="proses_login.php" method="POST" /></br>
<h2>Login Menu</h2>
<p>Welcome Friends. </p> 
Username:
<input type="text" name="username" /></br></br>
Password:
<input type="password" name="password" /></br></br>
<input type="submit" value="Login" />
</div>
	</div>
<div id = "footer">Copyright 2017, Widget Corp</div>
</form>
</body>
</html>