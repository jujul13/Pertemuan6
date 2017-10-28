<?php
$koneksi = mysqli_connect("localhost","root","","web_video");


?>
<html lang="en">
	<head>
	<title>Admin Pagetitle>
	<link href="public.css" media="all" rel="stylesheet" type="text/css" />
	</head>
<body>

 <div id="header">
	<h1>Widget Corp Admin </h1>
	</div>
	
<div id="main">
	<div id="navigation">
	&nbsp;
	</div>
<div id="page">
	<h2>Admin Menu</h2>
	<p>Welcome to the admin area. </p> 
		<ul>
			<li><a href="Managewebsite.php">Manage Website Content</a></li>
			<li><a href="Manageadmin.php">Manage Admin Users</a></li>
			<li><th><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	</div>
<div id = "footer">Copyright 2017, Widget Corp</div>

</body>
</html>
