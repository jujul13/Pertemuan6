<?php require_once("../includes/session.php"); ?>
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
			<br />
			<a href="admin.php">&laquo; Main Menu</a><br />
			<?php echo navigation($current_subject, $current_page); ?>
	</div>
	
	<br />
	<a href="new_subject.php">+ Add a subject</a>
	<div id="page">

		<?php echo message(); ?>
		<?php if ($current_subject) { ?>
		<h2>Manage Subject</h2>
		
			Menu name : <?php echo htmlentities($current_subject["menu_name"]); ?> <br />

			Position: <?php echo $current_subject["position"]; ?><br/>
			Visible: <?php echo $current_subject["visible"] == 1 ? 'yes': 'no';   ?><br/>

			<br/>

			<a href="edit_subject.php?subject=<?php echo urlencode$current_subject["id"]; ?>">Edit Subject</a>

		<?php } elseif ($selected_page_id) {

			?>
		<div style="margin-top: 2cm; border-top: 1px solid #000000;" />
		<h3>Pages in this subject:</h3>
		<ul>
		<?php 
			$subject_pages = find_pages_for_subject($current_subject["id"]);
			while($page = mysqli_fetch_assoc($subject_pages)){
				echo "<li>";
				$safe_page_id = urlencode($page["id"]);
				echo "<a href =\"manage_content.php?page={$safe_page_id\">";
				echo htmlentities(page["menu_name"]);
				echo "</a>";
				echo "</li>";
			}
		?>
		</ul>
		<br />
		+ <a href="new_page.php"subject=<?php echo urlencode($current_subject["id"]); ?>">Add a new page to this subject</a>
		</div>
		<?php } elseif ($current_page) { ?>

		<h2>Manage Page</h2>
		
		Menu name : <?php echo htmlentities(string)($current_page["menu_name"]); ?> <br />
			Position: <?php echo $current_page["position"]; ?><br/>
			Visible: <?php echo $current_page["visible"] == 1 ? 'yes': 'no';   ?><br/>

			Content:<br />
			<div class="view-content">
				<?php echo htmlentities($current_page["content"]); ?>
			</div>
			<br />
			<br />
			<a href="edit_page.php?page=<?php echo urlencode($current_page['id']); ?>">Edit page</a>

	<?php } else { ?>
		Please select a subject or a page.
	<?php } ?>

	</div>
</div>

	
	


<?php include("../includes/layouts/footer.php"); ?>

