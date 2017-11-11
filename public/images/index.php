<?php require_once("../includes/session.php"); ?>
<?php include("../includes/db_connection.php"); ?>
<?php include("../includes/functions.php"); ?>

<?php $layout_context = "public"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(true); ?>
	

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

		<?php echo htmlentities($current_page["menu_name"]); ?>
		<?php echo nl2br(htmlentities($current_page["content"])); ?>
		
		<h2>Manage Page</h2>
		
		Menu name : <?php echo htmlentities(string)($current_page["menu_name"]); ?> <br />
			Position: <?php echo $current_subject["position"]; ?><br/>
			Visible: <?php echo $current_page["visible"] == 1 ? 'yes': 'no';   ?><br/>

			Content:<br />
			<div class="view-content">
				<?php echo htmlentities($current_page["content"]); ?>
		
		

	<?php } else { ?>
		
	<p>Welcome!</p>

	<?php } ?>

	</div>
</div>

	
	


<?php include("../includes/layouts/footer.php"); ?>

