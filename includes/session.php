<?php

	session_start();

	function message() {
		if(isset($_SESSION["message"])){
			$output = "<div class = \"messages\">";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			

			$_SESSION["message"] = null;
			return $Output;
	}
}
function errors() {
		if(isset($_SESSION["errors"])){
			$output = "<div class = \"messages\">";
			$errors = $_SESSION["message"]);
			

			$_SESSION["errors"] = null;
			return $Output;
	}
}
?>