<?php

/* This file contains useful functions not specifically linked to one of the Classes in the classes folder, 
 * such as getting the current URL path; PHP
 * /


/* This function gets the path of the desired page to be loaded
 * @return $path - returns the path of the page to be loaded
 */
function get_path() {
  $path = array();
  if (isset($_SERVER['REQUEST_URI'])) {
    $request_path = explode('?', $_SERVER['REQUEST_URI']);
	  
    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
		}
    $path['call_parts'] = explode('/', $path['call']);
    $path['query_utf8'] = urldecode($request_path[1]);
    $path['query'] = utf8_decode(urldecode($request_path[1]));
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = $t[1];
    }
	}
  return $path;
}

/* This function retrieves the slug for the current page
 * @return $slug - returns the slug for the current page
 */
function get_slug($dbc, $url){
	$pos = strrpos($url, '/');
	$slug = substr($url, $pos + 1);
	return $slug;
}


/* This function returns the desired return value if the two params are equivalent
 * @param $value1 - first value for comparison
 * @param $value2 - second value for comparison
 * @param $return - the value to be returned
 * @return $return - returns the specified return value
 */
function selected($value1, $value2, $return) {
	if($value1 == $value2){
		echo $return;
	}
}


/* This function validates that the entered string is in email address format
 * @param $string - the supposed email address string
 * @return - returns true if the string is a valid email address, or false if it is not
 */
function validateEmail($string){
	return filter_var($string, FILTER_VALIDATE_EMAIL);
}


/* This function validates that the string entered doesn't use any illegal characters, including ' and ,
 * @param $string - the string to be tested
 * @return - returns true if the string is clean, or false if it contains illegal characters
 */
function validateString($string){
	return preg_match('/^\w+( \w+)*$/', $string);
}


//checks the length of a string within a range, returns true if in range
/* This function checks the length of a string within a range, returning true if it is in the range
 * @param $string - the string for which the length is to be checked
 * @param $min - the minimum length of the string
 * @param $max - the maximum length of the string
 * @return - returns true if the string is within the length range, or returns false if it is not
 */
function checkLength($string, $min, $max) {
	if((strlen($string) > $min) && (strlen($string) < $max)){
		return true;
	}else{
		return false;
	}
}


/* This function returns true if $needle is a substring of $haystack
 * @param $needle - the substring to look for
 * @param $haystack - the string to search through for the given $needle
 * @return - returns true if the $needle is in the $haystack, else returns false
 */
function contains($needle, $haystack){
    return strpos($haystack, $needle) !== false;
}


/* This function confirms whether or not a query returned a row from an existing table
 * @param $dbc - the database connection
 * @param $q - the query
 * @return - returns true if the query returned something, else returns false
 */
function check_query($dbc, $q){
	$r = mysqli_query($dbc, $q);
	if(mysqli_num_rows($r) == 0){	//if the return is blank
		return false;
	} else{
		return true;
	}
}

/*
 * This function strings a string of anything other than letters, numbers, spaces and basic punctuation (. , ? ! )
 */
function stripString($string){
	return preg_match("/^[a-zA-Z0-9 .'\-]+$/i", $string);
}



?>