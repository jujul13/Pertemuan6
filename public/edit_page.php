<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php require_once("../includes/validation_functions.php"); ?>

<?php find_selected_page(); ?>

<?php
	
	if(!$current_page) {
		redirect_to("manage_content.php");
	}
	
 ?>


<?php

if (isset($_POST['submit'])){
$id = $current_pages["id"];
	$menu_name = mysql_prep($_POST["menu_name"]);
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];


	$query = "UPDATE pages SET ";
	$query .= " menu_name = '{$menu_name}', ";
	$query .= " position = '{$position}', ";
	$query .= " visible = '{$visible}', ";
	$query .= " content = '{$content}', ";
	$query .= "WHERE id = {$id} ";
	$query .= "LIMIT 1";
	$result = mysqli_query($connection, $query);


if($result && mysqli_affected_rows($connection) >=0){
	//Success
	$_SESSION["message"] = "pages Created.";
	redirect_to("manage_content.php");
} 

	else {
	//Failure
	$message = "pages creation failed.";
	}
}

?>
<?php include("../includes/layouts/header.php"); ?>
<html lang="en">
	<head>
	<title>Admin Pagetitle</title>
	<link href="public.css" media="all" rel="stylesheet" type="text/css" />
	</head>
<body>

<div id="main">
	<div id="navigation">
		<?php echo navigation($current_page, $current_page); ?>
	</div>
		<ul class="pages">

	<?php $page_set = find_all_subjecst(); ?>
	
	<?php
	while ($page = mysqli_fetch_assoc($page_set)) {
	?>
		
		<?php
		 //3. Use returnetd data (if any)
		 while($page = mysqli_fetch_assoc($page_set)) {
			 //output data from each row
		?>

		<?php 
		echo "<li";
		if ($page["id"] == $selected_page_id){
			echo " class=\"selected\""; 
		}
		
		echo ">";
		?>
		<a href="manage_content.php?page=<?php echo urlencode($page["id"]); ?>"><?php echo  $page["menu_name"];?>
	
		<?php $page_set = find_pages_for_page($page["id"]); ?>
		
		<ul class="pages">
		<?php
		 
		 while($page = mysqli_fetch_assoc($page_set)) {
			 //output data from each row
		?>

		<?php 
		echo "<li";
		if ($page["id"] == $selected_page_id){
			echo " class=\"selected\""; 
		}
		
		echo ">";
		?>

		<a href="manage_content.php?page="><li><?php echo $page["menu_name"]; ?></li>
			
		 <?php

		 }

		 ?>

		 <?php mysqli_free_result($page_set); ?>
		</ul>
	   </li>

		<?php 
		}
		?>
	
	<?php mysqli_free_result($page_set); ?>
	</ul>
	</div>
	<div id="main">
		<div id="navigation">
			<?php echo navigation($current_page, $current_page); ?>
	</div>
	
	<div id="page">
		<?php
		if (!empty($message)){

		  echo "<div class=\"message\">" . htmlentities($message) . "</div>";

		}
		
		?>

		<?php echo form_errors($errors); ?>
		
		<h2>Edit page: <?php echo htmlentities($current_page["menu_name"]);?> </h2>

	<form action="edit_page.php?page=<?php echo urlencode$(current_page["id"]); ?>" method="POST">

		<p>Menu name:
			<input type="text" name="menu_name" value="<?php echo htmlentities($current_page["menu_name"]);?>"/>
		</p>
		<p>Position:
			<select name="position">
				<?php
				$page_set = find_all_subjecst();
				$page_count = mysqli_num_rows($page_set);
				for($count=1; $count <= $page_count; $count++){
					echo "<option value=\"{$count}\"";
					if ($current_page["position"] == $count) {
						echo "selected";
					}
					echo ">{$count}</option>";
				}
				
				?>

			</select>
		</p>
		<p>Visible:
			<input type="radio" name="visible" value="0"  <?php if($current_page["visible"] == 0){
				echo "checked";
			} ?> /> No

			&nbsp;
			<input type="radio" name="visible" value="1" /> <?php if($current_page["visible"] == 1){
				echo "checked";
				}?>/> YES

		</p>
		<input type="submit" value="Edit page" />
	</form>
	<br />
	<a href="manage_content.php">Cancel</a>
	&nbsp;
	&nbsp;
	<a href="delete_page.php?page=<?php echo urelncode($current_page["id"]); ?>" onclick="return confirm('are you sure?')">Delete page</a>
 		&nbsp;
	</div>
</div>

	
	


<?php include("../includes/layouts/footer.php"); ?>

