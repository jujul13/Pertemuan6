<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php find_selected_page(); ?>

<?php
if (isset($_POST['submit'])){


	
	$required_fields = array("menu_name", "position", "visible");
	validate_presences($required_fields);

	$field_with_max_lengths =  array("menu name" =>30);
	validate_max_lengths($field_with_max_lengths);

	if (empty($errors)){
		

	$id = $current_subject["id"];
	$menu_name = mysql_prep($_POST["menu_name"]);
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];


	$query = "UPDATE subjects SET ";
	$query .= " menu_name = '{$menu_name}', ";
	$query .= " position = '{$position}', ";
	$query .= " visible = '{$visible}', ";
	$query .= "WHERE id = {$id} ";
	$query .= "LIMIT 1";
	$result = mysqli_query($connection, $query);


if($result && mysqli_affected_rows($connection) >=0){
	//Success
	$_SESSION["message"] = "Subject Created.";
	redirect_to("manage_content.php");
} 

	else {
	//Failure
	$message = "Subject creation failed.";
	}
}
?>
<?php
	if(!$current_subject) {
		redirect_to("manage_content.php");
	}

?>
<html lang="en">
	<head>
	<title>Admin Pagetitle</title>
	<link href="public.css" media="all" rel="stylesheet" type="text/css" />
	</head>
<body>

<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject, $current_page); ?>
	</div>
		<ul class="subjects">

	<?php $subject_set = find_all_subjecst(); ?>
	
	<?php
	while ($subject = mysqli_fetch_assoc($subject_set)) {
	?>
		
		<?php
		 //3. Use returnetd data (if any)
		 while($subject = mysqli_fetch_assoc($subject_set)) {
			 //output data from each row
		?>

		<?php 
		echo "<li";
		if ($subject["id"] == $selected_subject_id){
			echo " class=\"selected\""; 
		}
		
		echo ">";
		?>
		<a href="manage_content.php?subject=<?php echo urlencode($subject["id"]); ?>"><?php echo  $subject["menu_name"];?>
	
		<?php $page_set = find_pages_for_subject($subject["id"]); ?>
		
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
	
	<?php mysqli_free_result($subject_set); ?>
	</ul>
	</div>
	<div id="main">
		<div id="navigation">
			<?php echo navigation($current_subject, $current_page); ?>
	</div>
	
	<div id="page">
		<?php
		if (!empty($message)){

		  echo "<div class=\"message\">" . htmlentities($message) . "</div>";

		}
		
		?>

		<?php echo form_errors($errors); ?>
		
		<h2>Edit subject: <?php echo htmlentities($current_subject["menu_name"]);?> </h2>

	<form action="edit_subject.php?subject=<?php echo urlencode$(current_subject["id"]); ?>" method="POST">

		<p>Menu name:
			<input type="text" name="menu_name" value="<?php echo htmlentities($current_subject["menu_name"]);?>"/>
		</p>
		<p>Position:
			<select name="position">
				<?php
				$subject_set = find_all_subjecst();
				$subject_count = mysqli_num_rows($subject_set);
				for($count=1; $count <= $subject_count; $count++){
					echo "<option value=\"{$count}\"";
					if ($current_subject["position"] == $count) {
						echo "selected";
					}
					echo ">{$count}</option>";
				}
				
				?>

			</select>
		</p>
		<p>Visible:
			<input type="radio" name="visible" value="0"  <?php if($current_subject["visible"] == 0){
				echo "checked";
			} ?> /> No

			&nbsp;
			<input type="radio" name="visible" value="1" /> <?php if($current_subject["visible"] == 1){
				echo "checked";
				}?>/> YES

		</p>
		<input type="submit" value="Edit Subject" />
	</form>
	<br />
	<a href="manage_content.php">Cancel</a>
	&nbsp;
	&nbsp;
	<a href="delete_subject.php?subject=<?php echo urelncode($current_subject["id"]); ?>" onclick="return confirm('are you sure?')">Delete subject</a>
 		&nbsp;
	</div>
</div>

	
	


<?php include("../includes/layouts/footer.php"); ?>

