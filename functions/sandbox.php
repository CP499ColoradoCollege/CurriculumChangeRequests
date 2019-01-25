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

/* This function converts a drop # value into a drop string value
 * @param $drop - the drop # value
 * @return $value - returns the drop string value
 */
function convert_drop($drop){
	switch ($drop){
		case '1':
			$value = "Skill";
			break;
		case '2':
			$value = "Time";
			break;
		case '3':
			$value = "Day";
			break;
		default:
			$value = 'N/A';
			break;
	}
	return $value;
}

/* This function converts a priority # value into a priority string value
 * @param $p - the priority # value
 * @return $value - returns the priority string value
 */
function convert_priority($p){
	switch ($p){
		case '1':
			$value = "Time";
			break;
		case '2':
			$value = "Day";
			break;
		default:
			$value = 'N/A';
			break;
	}
	return $value;
}


/* This function converts a teams time and timezone into a time string
 * @param $time - the time in military time
 * @return $value - the standard version time
 */
function convert_time($time){	
	switch ($time){
		case '12':
			$value = '12:00pm';
			break;
		case '13':
			$value = '1:00pm';
			break;
		case '14':
			$value = '2:00pm';
			break;
		case '15':
			$value = '3:00pm';
			break;
		case '16':
			$value = '4:00pm';
			break;
		case '17':
			$value = '5:00pm'; 
			break;
		case '18':
			$value = '6:00pm'; 
			break;
		case '19':
			$value = '7:00pm'; 
			break;
		case '20':
			$value = '8:00pm'; 
			break;
		case '21':
			$value = '9:00pm'; 
			break;
		case '22':
			$value = '10:00pm'; 
			break;
		case '23':
			$value = '11:00pm'; 
			break;
		default:
			$value = 'N/A';
			break;
	}
	return $value;
}


//converts from timezone# to timezone abbreviation
function convert_timezone($timezone){
	switch ($timezone){
		case '1':
			$zone = 'HAST';
			break;
		case '2':
			$zone = 'AST';
			break;
		case '3':
			$zone = 'PST';
			break;
		case '4':
			$zone = 'MST';
			break;
		case '5':
			$zone = 'CST';
			break;
		case '6':
			$zone = 'EST'; 
			break;
		default:
			$zone = 'N/A';
			break;
	}
	return $zone;
}

//converts from weekday# to weekday value
function convert_weekday($weekday){
	switch ($weekday){
		case '1':
			$day = 'Monday';
			break;
		case '2':
			$day = 'Tuesday';
			break;
		case '3':
			$day = 'Wednesday';
			break;
		case '4':
			$day = 'Thursday';
			break;
		case '5':
			$day = 'Friday';
			break;
		case '6':
			$day = 'Saturday';
			break;
		case '7':
			$day = 'Sunday';
			break;
		default:
			$day = 'N/A';
			break;
	}
	return $day;
}

function validateEmail($string){
	return filter_var($string, FILTER_VALIDATE_EMAIL);
}

function validateString($string){
	return preg_match('/^\w+( \w+)*$/', $string);
}

function validateDiscord($string){
	return preg_match('/^\w*#[0-9]{4}/', $string);
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



function convert_game($game_id){
	switch ($game_id){
		case '1':
			return 'Overwatch';
		case '2':
			return 'League of Legends';
		default:
			return 'N/A';	
	}
}

function convert_skill($game_value, $skill_value){
	if($game_value == '1'){
		switch ($skill_value){
			case '0':
				return 'N/A';
				break;
			case '1':
				return '<1000';
				break;
			case '2':
				return '1000-1250';
				break;
			case '3':
				return '1250-1500';
				break;
			case '4':
				return '1500-1750';
				break;
			case '5':
				return '1750-2000';
				break;
			case '6':
				return '2000-2250';
				break;
			case '7':
				return '2250-2500';
				break;
			case '8':
				return '2500-2750';
				break;
			case '9':
				return '2750-3000';
				break;
			case '10':
				return '3000-3200';
				break;
			case '11':
				return '3200-3400';
				break;
			case '12':
				return '3400-3600';
				break;
			case '13':
				return '3600-3800';
				break;
			case '14':
				return '3800-3900';
				break;
			case '15':
				return '3900-4000';
				break;
			case '16':
				return '4000-4100';
				break;
			case '17':
				return '4100-4200';
				break;
			case '18':
				return '4200-4300';
				break;
			case '19';
				return '>4300';
				break;
			default:
				return 'N/A';
		}
	}else if($game_value == '2'){
		switch ($skill_value){
			case '0':
				return 'N/A';
				break;
			case '1':
				return 'Bronze';
				break;
			case '2':
				return 'Silver';
				break;
			case '3':
				return 'Gold';
				break;
			case '4':
				return 'Platinum';
				break;
			case '5':
				return 'Diamond';
				break;
			default:
				return 'N/A';
				break;
		}
	}
}

function convert_prefskill($skill_value){
	if($skill_value < 0){
		return "Lower";
	}else if($skill_value > 0){
		return "Higher";
	}else{
		return "Equal";
	}
}




?>