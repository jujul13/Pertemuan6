<?php include("../includes/db_connection.php"); ?>
<?php include("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php
	if(isset($_GET["subject"])){
		$selected_subject_id = $_GET["subject"];
		$selected_page_id = null;
	}
	elseif (isset($_GET["page"])){
		$selected_page_id = $_GET["page"];
		$selected_subject_id = null;
	}
	else {
		$selected_subject_id =null;
		$selected_page_id = null;
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
			<?php echo navigation($selected_subject_id, $selected_page_id); ?>
	</div>
	
	<div id="page">
		<h2>Manage Content</h2>
	<?php echo $selected_subject_id; ?> <br />
	<?<?php echo $selected_subject_id; ?>
	</div>
</div>

	
	


<?php include("../includes/layouts/footer.php"); ?>

