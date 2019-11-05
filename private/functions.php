<?php
// add the leading '/' if not present
	function url_for($script_path) { 
	  if($script_path[0] != '/') {
	    $script_path = "/" . $script_path;
	  }
	  return WWW_ROOT . $script_path;
	}
// function to minimise urlencode typing to - u (for encoding strings) when getting values from db
	function u($string="") {
		return urlencode($string);
	}

// function to minimise rawurlencode typing to - raw_u (for encoding strings) when getting values from db
	function raw_u($string="") {
		return rawurlencode($string);
	}

// encode to harmless html to prevent any scross-site scripting (trisck the webpage into outputting JavaScript)
	function h($string="") {
		return htmlspecialchars($string);
	}

	function error_404() {
		header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
		exit();
	}

	function error_500() {
		header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
		exit();
	}

	function redirect_to($location) {
		header("Location: " . $location);
		exit();
	}

	function is_post_request() {
			return $_SERVER['REQUEST_METHOD'] == 'POST'; //returns true or false
	}

	function is_get_request() {
			return $_SERVER['REQUEST_METHOD'] == 'GET'; //returns true or false
	}

	function display_errors($errors=array()) {
		$output = '';
		if(!empty($errors)) {
		  $output .= "<div class=\"errors\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach($errors as $error) {
			$output .= "<li>" . h($error) . "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	  }

?>