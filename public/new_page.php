<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php
if (isset($_POST['submit'])){


	

	$required_fields = array("menu_name", "position", "visible", "content");
	validate_presences($required_fields);

	$field_with_max_lengths =  array("menu name" =>30);
	validate_max_lengths($field_with_max_lengths);

	if (!empty($errors)){
		$_SESSION["errors"] = $errors;
		redirect_to("new_subject.php");
	}
	$subject_id = $current_subject["id"];
	$menu_name = mysql_prep($_POST["menu_name"]);
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];
	$content = mysql_prep($_POST["content"]);

	$query = "INSERT INTO pages (";
	$query .= " subject_id, menu_name, position, visible, content";
	$query .= ") VALUES (";
	$query .= " '{$subject_id}', '{$menu_name}',{$position},{$visible}, '{$content}'";
	$query .= ")";
	$result = mysqli_query($connection, $query);


if(result){
	$_SESSION["message"] = "Page Created.";
	redirect_to("manage_content.php?subject=" . urlencode($current_subject["id"]));
} 
	else {
	$_SESSION["message"] = "Page creation failed";
	//this is probably a GET request
	
}
<?php 
if(isset($connection)){
	mysqli_close($connection);
}
?>