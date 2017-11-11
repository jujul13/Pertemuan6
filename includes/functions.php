<?php

	function redirect_to($new_location) {
	
	}

	function mysql_prep($string) {
		global $connection;
		$escaped_string = mysqli_real_escape_string($connection,$string);
		return $escaped_string;
	}

	function form_errors($errors= array()){
		$output = "";
		if (!empty($errors)){
			$output .= "<div class=\"error\">";
			$output .= "Please fix the following error";
			$output .= "<ul>";
			foreach ($errors as $key => $error){
				$output .="<li>";
				$output .= htmlentities($error};
				$output .= "</li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}
			return $output;
	}
	function confirm_query($result_set) {
		
	function find_all_subjects($public = true){
	
		global $connection;

		$query = "SELECT * ";
		$query .= "FROM subjects ";
		if ($public) {
			$query .= "WHERE visible = 1";
		}
		
		$query .= "ORDER BY position ASC";
		$subject_set = mysqli_query($connection, $query);
		confirm_query($subject_set);
		return $subject_set;

	}
	function find_pages_for_subject($subject_id, $public=true){

		global $connection;

		$safe_subject_id = mysqli_real_escape_string($connection, $subject_id);

		$query = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE subject_id = {$safe_subject_id} ";
		if ($public) {
			$query .= "AND visible = 1";
		}
		
		$query .= "ORDER BY position ASC";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		return $page_set;

	}
		
	function find_page_by_id($page_id, $public=true) {
		global $connection;

		$safe_page_id = mysqli_real_escape_string($connection, $page_id);

		$query = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id = {$safe_page_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "LIMIT 1";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		if($page = mysqli_fetch_assoc($page_set)){
			return $page;
		} else {
			return null;
		}
	}
	

	function find_default_page_for_subject($subject_id){
		  $page_set = find_pages_for_subject($subject_id);

		  if($first_page = mysqli_fetch_assoc($page_set)){
		  return $first_page;
		} else {
			return null;
		}
	}

		
	
	function find_selected_page($public=false) {
		global $current_subject;
		global $current_page;

		if(isset($_GET["subject"])) {
			$current_subject = find_subject_by_id($GET["subject"],$public);
			if ($current_subject && $public) {
				$current_page = find_default_page_for_subject($current_subject["id"]);
			} else {
				$current_page = null;
			}
			
			
		} elseif(isset($_GET["page"])){
			$current_subject = null;
			$current_page = find_page_by_id($_GET["page"], $public);
		} else{
			$current_subject = null;
			$current_page = null;
		}
	}

	function find_subject_by_id($subject_id, $public=true) {
		global $current_subject;
		global $current_page;
		
		if(isset($_GET["subject"])){
		$current_subject = find_subject_by_id($_GET["subject"]);
		$current_page = null;
	}
	elseif (isset($_GET["page"])){
		$current_subject = null;
		$current_page = find_page_by_id($_GET["page"]);
	}
	else {
		$current_subject = null;
		$current_page = null;
	}
}
function navigation($subject_array, $page_array){
	$output = "<ul class=\"subjects\">";
	$subject_set = find_all_subjects(false);
	while($subject = mysqli_fetch_assoc($subject_set)){
		$output .= "<li";
		if ($subject_array && $subject["id"] == $subject_array["id"]){
			$output .= "class=\"selected\"";
		}
		$output .= ">";
		$output .= "<a href=\"manage_content.php?subject=";
		$output .= urlencode($subject["id"]);
		$output .= "\">";
		$output .= htmlentities($subject["menu_name"]);
		$output .= "</a>";

		$page_set = find_pages_for_subject($subject["id"]), false);
		$output .= "<ul class=\"pages\">";
		while($page =mysqli_fetch_assoc($page_set)){
			$output .= "<li";
		}
	}

}

function public_navigation($subject_array, $page_array) {

}


	// navigation takes 2 arguments
	// - the currently selected subject ID(if any)
	// - the currently selected page ID(if any)
	$output = "<ul class=\"subjects\">";
	<?php $subject_set = find_all_subjects(; ?>
	
	<?php
	while ($subject = mysqli_fetch_assoc($subject_set)) {
		$output .= "<li";
			if ($subject_array && $subject["id"] == $subject_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .=">";
			$output .= "<a href="index.php?subject=";
		    $output .= urlencode($subject["id"]); 
		    $output .= "\">";
		    $output .=  htmlentities($subject["menu_name"]);
		    $output .= "</a>";
		   	$page_set = find_pages_for_subject($subject["id"]); 
			$output .= "<ul class=\"pages\">";
		 	while($page = mysqli_fetch_assoc($page_set)) {

				$output .= "<li";
		if ($page_array && $page["id"] == $page_array["id"]){
			$output .= " class=\"selected\""; 
		}
		$output .= ">";
		$output .= "<a href=\"index.php?page="; 
		$output .= urlencode($page["id"]); 
		$output .= "\">";
		$output .= htmlentities($page["menu_name"]);
		$output .= "</a></li>";	
	}

	if($subject_array["id"] == $subject["id"] ||
	   $page_array["subject_id"] == $subject["id"]){
		$page_set = find_pages_for_subject($subject["id"]); 
		$output .= "<ul class=\"page\">"?>
	
	<?php
	while ($page = mysqli_fetch_assoc($pagesubject_set)) {
		$output .= "<li";
			if ($page_array && $page["id"] == $page_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .=">";
			$output .= "<a href="index.php?page=";
		    $output .= urlencode($page["id"]); 
		    $output .= "\">";
		    $output .=  htmlentities($page["menu_name"]);
		    $output .= "</a>";
		   	$page_set = find_pages_for_subject($page["id"]); 
			$output .= "<ul class=\"pages\">";
		 	while($page = mysqli_fetch_assoc($page_set)) {

				$output .= "<li";
		if ($page_array && $page["id"] == $page_array["id"]){
			$output .= " class=\"selected\""; 
		}
		$output .= ">";
		$output .= "<a href=\"index.php?page="; 
		$output .= urlencode($page["id"]); 
		$output .= "\">";
		$output .= htmlentities($page["menu_name"]);
		$output .= "</a></li>";	
	}
	$output .= "</ul>";
	mysqli_free_result($page_set); 
	}

	    
		$output .= "</ul></li>"
	   
	}
	
	 mysqli_free_result($subject_set);
	$output .= "</ul>";
	return $output;
}

?>