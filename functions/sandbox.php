<?php

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


function validateEmail($string){
	return filter_var($string, FILTER_VALIDATE_EMAIL);
}

function validateString($string){
	return preg_match('/^\w+( \w+)*$/', $string);
}


function checkStringLength($string){
	$parts = explode("", $string);
	if(count($parts) > 255){
		return false;
	}
	return true;
}




//checks if the string is a valid entry; returns TRUE if valid, and FALSE if invalid
function isValid($string) {
	//return !preg_match("/^([A-Za-z0-9 \-]+/@/(?:\'|&#0*39;)*)*[A-Za-z0-9]+$/", $string);
    return preg_match('/^\w+( \w+)*$/', $string);
}

//checks the length of a string within a range, returns true if in range
function checkLength($string, $min, $max) {
	if((strlen($string) > $min) && (strlen($string) < $max)){
		return true;
	}else{
		return false;
	}
}


//Master function for checking strings for validity
function checkString($string){
	$valid = false;
	$valid = isValid($string);
	if($valid){
		//$valid = checkLength((string)$string, $string_min, $string_max);
	}
	//any other string checks go here
	return $valid;
}



/* This function returns true if $needle is a substring of $haystack
 * @param $needle - the substring to look for
 * @param $haystack - the string to search through for the given $needle
 * @return - returns true if the $needle is in the $haystack, else returns false
 */
function contains($needle, $haystack){
    return strpos($haystack, $needle) !== false;
}


/* This function verifies if there are any matches for any of the criteria in the criteria_array within the tables in the tables_array
 * @param $dbc - the database connection
 * @param $criteria_array - array of different criteria to look for
 * @param $table_array - array of tables to search through
 * @return $match - returns true if any of the criteria existed in any of the tables, else returns false
 */
function check_matches($dbc, $criteria_array, $table_array){
	$match = false;
	$i = 0;
	while($i < (count($criteria_array) * count($table_array)) && $match == false){
		$table = $table_array[$i / count($criteria_array)];
		$criteria = $criteria_array[$i % count($criteria_array)];
		$q = "SELECT * FROM ".$table." WHERE ".$criteria;
		$match = check_query($dbc, $q);
		if($match == true){
			return $match;
		}
		$i++;	
	}
	return $match;
}

/* This function verifies if there are any matches for the specified criteria within the tables in the tables_array
 * @param $dbc - the database connection
 * @param $criteria - specific criteria string
 * @param $table_array - array of tables to search through
 * @return $match - returns true if any of the criteria existed in any of the tables, else returns false
 */
function check_match($dbc, $criteria, $table_array){
	$i = 0;
	while($i < count($table_array)){
		$table = $table_array[i];
		$q = "SELECT * FROM ".$table." WHERE ".$criteria;
		$r = mysqli_query($dbc, $q);
		if(mysqli_num_rows($r) > 1){
			return true;
		}
		$i++;	
	}
	return false;
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



?>