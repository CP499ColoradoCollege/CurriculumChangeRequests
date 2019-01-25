<!-- this document contains the setup code necessary for including necessary files and variables to the site; all in PHP -->
<?php
// Setup File:

error_reporting(0);	//not necessary; gets rid of annoying error reporting

#Database Connection:
include('config/connection.php');	//for the connection to the database

#Constants:
$string_min = 6;
$string_max = 150;


#Functions:

include('functions/data.php');		//for importing all data-related functions
include('functions/sandbox.php');

/*
include('functions/template.php');	//for importing all template-related functions
include('functions/sandbox.php');	//for importing sandbox
include('functions/matching.php');	//for importing matching code
include('functions/calendar.php');
 * */


#Site Setup:
//$debug = data_setting_value($dbc, 'debug-status');	//gets the current debug setting value (for developing)
$path = get_path();		//gets the url/path
$site_title = 'Course Proposal System';	//sets the site's title



#Page Setup:
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


#Team Setup:
if($_SESSION['logged_in'] == true){
	$user = data_user($dbc, $_SESSION['user_email']);	
}


?>