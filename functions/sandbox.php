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
		echo "Path:".$path['call'];
    $path['call_parts'] = explode('/', $path['call']);
    $path['query_utf8'] = urldecode($request_path[1]);
    $path['query'] = utf8_decode(urldecode($request_path[1]));
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = $t[1];
    }
	}
	echo "Path:".$path['call_parts'];
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


function convertDepartmentFromCode($dept_code){
	switch ($dept_code){
		case 'ART':
			return 'Art';
			break;
			
		case 'ANTH':
			return 'Anthropology';
			break;
			
		case 'BIOL':
			return 'Biology';
			break;
			
		case 'CLAS':
			return 'Classics';
			break;
			
		case 'GRRU':
			return 'German, Russian & E Asian Languages';
			break;
			
		case 'COLI':
			return 'Comparative Literature';
			break;
			
		case 'MATH':
			return 'Mathematics & Computer Science';
			break;
			
		case 'CHBI':
			return 'Chemistry & Biochemistry';
			break;
			
		case 'EDUC':
			return 'Education';
			break;
			
		case 'DRDA':
			return 'Drama & Dance';
			break;
			
		case 'ENSC':
			return 'Environmental Science';
			break;
			
		case 'ENGL':
			return 'English';
			break;
			
		case 'NOST':
			return 'Non-Departmental Studies';
			break;
			
		case 'ROLA':
			return 'Romance Languages';
			break;
			
		case 'FEGE':
			return 'Feminist & Gender Studies';
			break;
			
		case 'HIST':
			return 'History';
			break;
			
		case 'GEOL':
			return 'Geology';
			break;
			
		case 'RELI':
			return 'Religion';
			break;
			
		case 'MUSI':
			return 'Music';
			break;
			
		case 'POSC':
			return 'Political Science';
			break;
			
		case 'PHIL':
			return 'Philosophy';
			break;
			
		case 'PSYC':
			return 'Psychology';
			break;
			
		case 'PHYS':
			return 'Physics';
			break;
			
		case 'SOCI':
			return 'Sociology';
			break;
			
		case 'SOST':
			return 'Southwest Studies';
			break;
		
		default:
			return 'Error: No department found.';
			break;
	}
}


?>