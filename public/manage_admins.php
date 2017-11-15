<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php 
	$admin_set = find_all_admins();
?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

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
	<br />
		<a href="admin.php">&laquo; Main Menu</a><br />
	
	</div>
<div id="page">
	<?php echo message(); ?>
	<h2>Manage Admins</h2><br>
	<tr>
	<th> style="text-align: left; width; 200px;">Username</th>
	<th colspan="2" style="text-align: left;">Actions</th></b>
	</tr>
	<?php
	while($admin = mysqli_fetch_assoc($admin_set)){
		?>
		<tr>
		<td><?php echo htmlentities($admin["username"]); ?>
		<br />
		<?php echo htmlentities($admin["hashed_password"]); ?>
		</td>
		<td>
			<a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">Edit</a> |
			<a href="Delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>" on click="return confirm('Are you sure');">Delete</a></td>
		
		</tr>
	<?php
	}
	?>
	</table>
	<br />
	<a href="new_admin.php">Add new admin</a>
	

</div>
</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>