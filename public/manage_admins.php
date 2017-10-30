<?php
$koneksi = mysqli_connect("localhost","root","","web_video");
$query = "SELECT * FROM users WHERE username";
$hasil = mysqli_query($koneksi,$query);

?>
<html lang="en">
	<head>
	<title>Admin Pagetitle</title>
	<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
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
	<h2>Manage Admins</h2><br>
	<tr>
	<th><b>Username</th></b>
	<th><b>Actions</th></b>
	</tr>
	<?php
	while($row = mysqli_fetch_assoc($hasil)){
		?>
		<tr>
		<td><?php echo $row('username'); ?></td>
		<td>
			<a href="edit_admin.php">Edit</a> |
			<a href="Delete_admin.php">Delete</a>
		</td>
		</tr>
	<?php
	}
	?>

	</div>
	</div>
<div id = "footer">Copyright 2017, Widget Corp</div>

</body>
</html>
