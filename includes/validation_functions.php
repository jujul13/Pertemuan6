<?php

$errors = array();

function fieldname_as_text($fieldname){
	$fieldname = str_replace(""," ", $fieldname);
	$fieldname = ucfirst($fieldname);
	return $fieldname;
}

function has_presence($value) {
	return isset($value) &&  $value !== "";

}

function validate_presences($required_fields) {
	global $errors;
	foreach($required_fields as $field) {
		$value = trim($_POST[$field]);
		if(!has_presence($value)){
			$errors[$field] = ucfirst($field). "can't be blank";
		}
	}
}

function has_max_length($value, $max) {
	return strlen($value) <= $max;
}

function validate_max_lengtsh($fields_with_max_lengths){
	global $errors;

	foreach ($field_with_max_length as $field => $max) {
		$value = trim($_POST[$field]);
		if(!has_max_length($value, $max)){
			$errors[$field] = fieldname_as_text($field) . "is to long";
		}
	}
}

function has_inclusion_in($value, $set) {
	return in_array($value, $set);
}

function form_errors($errors=array()){
	$output = "";
	if (!empty($errors)){
		$output .="<div class=\"error\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";
		foreach ($errors  as $key => $error) {
			$output .= "<li>{$error}</li>";
			
		}
	$output .= "</ul>";
	$output .= "</div>";
	}
	return $output;
}
?>