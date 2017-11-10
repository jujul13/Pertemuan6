<?php require_once("../includes/session.php"); ?>
<?php include("../includes/db_connection.php"); ?>
<?php include("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>
	

	<div id="main">
		<div id="navigation">
		
			
			<?php echo public_navigation($current_subject, $current_page); ?>
	</div>
	
	
	<div id="page">

	
		<?php if ($current_subject) { ?>
		<h2>Manage Subject</h2>
		
			Menu name : <?php echo htmlentities($current_subject["menu_name"]); ?> <br />

			
		</div>
		<?php } elseif ($current_page) { ?>

		<h2>Manage Page</h2>
		
		Menu name : <?php echo htmlentities(string)($current_page["menu_name"]); ?> <br />
			Position: <?php echo $current_subject["position"]; ?><br/>
			Visible: <?php echo $current_page["visible"] == 1 ? 'yes': 'no';   ?><br/>

			Content:<br />
			<div class="view-content">
				<?php echo htmlentities($current_page["content"]); ?>
		
		

	<?php } else { ?>
		Please select a subject or a page.
	<?php } ?>

	</div>
</div>

	
	


<?php include("../includes/layouts/footer.php"); ?>

