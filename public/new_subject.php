<?php include("../includes/db_connection.php"); ?>
<?php include("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>
	


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
		<h2>Create subject </h2>

	<form action="create_subject.php" method ="POST" >
		<p>Menu name:
			<input type="text" name="menu_name" value="" />
		</p>
		<p>Position:
			<select name="position">
				<?php
				$subject_set = find_all_subjecst();
				$subject_count = mysqli_num_rows($subject_set);
				for($count=1; $count <= $subject_count; $count++){
					echo "<option value=\"{$count}\">{$count}</option>";
				}
				
			</select>
		</p>
		<p>Visible:
			<input type="radio" name="visible" value="0" /> NO &nbsp;
			<input type="radio" name="visible" value="1" /> YES &nbsp;

		</p>
		<input type="submit" value="Create Subject" />
	</form>
	<br />
	<a href="manage_content.php">Cancel</a>

	</div>
</div>

	
	


<?php include("../includes/layouts/footer.php"); ?>

