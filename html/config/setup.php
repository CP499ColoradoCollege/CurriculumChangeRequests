<?php

// Setup File:

//ini_set('display_errors', 'On');
//error_reporting(E_ALL); //if error reporting is on, errors WILL cause issues/errors with PHPWord data stream
 							//turning error reporting on will add errors to PHPWord data stream and CORRUPT the downloaded file						

 error_reporting(0);

#Database Connection:
include_once('config/connection.php');	//for the connection to the database

#Constants:
$string_min = 6;
$string_max = 150;

#Functions:

include('functions/sandbox.php');


#Classes
include('classes/User.php');

include('classes/Course.php');

include('classes/Proposal.php');


//PhpWord includes

$_SESSION['user_email'] = "admin@proposals.com";	//TEMPORARY - for local access to application
  
#Site Setup:
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


#User Setup:

if($_SESSION['logged_in'] == true){
	$user = new User($dbc);
	$user->fetchUserFromEmail($_SESSION['user_email']);
}



?>
