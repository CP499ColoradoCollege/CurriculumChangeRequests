<?php

//This page is loaded on every request. 


session_start();

if($_SESSION['logged_in'] == true){

	include('template/header.php');
	
	//dynamic pages

	//the $page variable is set by setup.php, which is excecuted by header.php 
	include('views/'.$page.'.php');
	
	//footer
	//include('template/footer.php');	
	
	
}else{
	//ToDo: remove login page and replace with CAS authentication + automatic User creation (See User.php class)
	
	$page = 'login';

	//sign-in page
	include('views/login.php');

}


?>