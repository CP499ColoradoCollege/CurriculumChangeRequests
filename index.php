<?php

session_start();

if($_SESSION['logged_in'] == true){
	
	//dynamic header w/ navbar
	include('template/header.php');

	//dynamic pages
	include('views/'.$page.'.php');
	
	//footer
	//include('template/footer.php');	
	
	
}else{
	
	$page = 'login';

	//sign-in page
	include('views/login.php');

}


?>
