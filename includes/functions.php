<?php

	function confirm_query($result_set) {
		
	function find_all_subjecst(){
	

	function find_pages_for_subject(){
	
function navigation($subject_id, $page_id) {


	// navigation takes 2 arguments
	// - the currently selected subject ID(if any)
	// - the currently selected page ID(if any)
	$output = "<ul class=\"subjects\">";
	<?php $subject_set = find_all_subjecst(); ?>
	
	<?php
	while ($subject = mysqli_fetch_assoc($subject_set)) {
		$output .= "<li";
			if ($subject["id"] == $subject_id) {
				$output .= " class=\"selected\"";
			}
			$output .=">";
			$output .= "<a href="manage_content.php?subject=";
		    $output .= urlencode($subject["id"]); 
		    $output .= "\">";
		    $output .=  $subject["menu_name"];
		    $output .= "</a>";
		   	$page_set = find_pages_for_subject($subject["id"]); 
			$output .= "<ul class=\"pages\">";
		 	while($page = mysqli_fetch_assoc($page_set)) {

				$output .= "<li";
		if ($page["id"] == $page_id){
			$output .= " class=\"selected\""; 
		}
		$output .= ">";
		$output .= "<a href=\"manage_content.php?page="; 
		$output .= urlencode($page["id"]); 
		$output .= "\">";
		$output .= $page["menu_name"];
		$output .= "</a></li>";	
	}

	    mysqli_free_result($page_set); 
		$output .= "</ul></li>"
	   
	}
	
	 mysqli_free_result($subject_set);
	$output .= "</ul>";
	return $output;
}

?>