<?php
// Setup File:
// error_reporting(E_ALL); 
// ini_set('display_errors', 'On');
 error_reporting(0);	//not necessary; gets rid of annoying error reporting

#Database Connection:
include_once('config/connection.php');	//for the connection to the database

#Constants:
$string_min = 6;
$string_max = 150;


#Functions:
include('functions/data.php');		//for importing all data-related functions
include('functions/sandbox.php');


#Classes
include('functions/User.php');

include('functions/Course.php');

include('functions/Proposal.php');


//PhpWord includes
//include('functions/phpWordSample/code/New_Header.php');
//include('php_word_header.php');
$_SESSION['user_email'] = "admin@proposals.com";
  
#Site Setup:
//$debug = data_setting_value($dbc, 'debug-status');	//gets the current debug setting value (for developing)
$path = get_path();		//gets the url/path
$site_title = 'Course Proposal System';	//sets the site's title


#Page Setup:
// $_SESSION['logged_in'] = true;
if(!isset($path['call_parts'][0]) || $path['call_parts'][0] == '' ){
	if($_SESSION['logged_in'] == true){
		$page = 'home';
		header('Location: home');	//sets blank/empty url to the home page
	} else{
		header('Location: login');	//sets blank/empty url to the dashboard
	}
} else{
	$page = $path['call_parts'][0];
}


#User Setup:
// $_SESSION['logged_in'] = true;
if($_SESSION['logged_in'] == true){
	$user = new User($dbc);
	$user->fetchUserFromEmail($_SESSION['user_email']);
}



?>