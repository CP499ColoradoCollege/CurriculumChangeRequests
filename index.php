<?php

//This page handles all requests

session_start();
	
	//dynamic header w/ navbar
include('template/header.php');

	//dynamic pages
include('views/'.$page.'.php');
	
	//footer
	//include('template/footer.php');	


?>
