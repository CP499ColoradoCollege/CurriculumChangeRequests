<?php


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


/* This function retrieves the data related to the current settings
 * @param $dbc - the database connection
 * @param $id - the setting's id
 * @return $data['value'] - returns 1 if the setting is on, or 0 if it is off
 */
function data_setting_value($dbc, $id){
	$q = "SELECT * FROM settings WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);
	return $data['value'];
}


/* This function retrieves the data for a specific team
 * @param $dbc - the database connection
 * @param $id - the desired team's id
 * @return $data - returns the data related to the specified team
 */
function data_user($dbc, $id) {
	if(is_numeric($id)){	//this means its an id number, not an email
		$cond = "WHERE id = '$id'";	//the query
	} else{
		$cond = "WHERE email = '$id'";	//the query
	}
	$q = "SELECT * FROM users ".$cond;	//the query
	$r = mysqli_query($dbc, $q);	//the result
	if($r){
		$data = mysqli_fetch_assoc($r);	//array of info about the specified team
	}else{
		$data = false;
	}
	return $data;
}


?>