<?php

session_start();

	switch ($page) {	//checks the value of the $page variable, which contains the label of the current view
	
		case 'login':
			if($_SESSION['logged_in'] == true){
				header('Location: home');
			}
			
			if($_POST) {	//check if a form has been submitted by the current session
				$q = "SELECT * FROM users WHERE email = '$_POST[email]' AND password = SHA1('$_POST[password]')";	//the query
				$r = mysqli_query($dbc, $q);	//the result from the query
				if(mysqli_num_rows($r) == 1){	//if the result from the query returned one row for the user, then the user is valid
					$_SESSION['user_email'] = $_POST['email'];	//save the email submitted in the form under the current session as value 'username'
					$_SESSION['logged_in'] = true;
					header('Location: home');				//once logged in, redirect to index.php instead of login page
				}
			}
			break;
			
		case 'logout':
			
			unset($_SESSION['user_email']);
			unset($_SESSION['logged_in']);
			header("Location: login");
			break;
			
			
			break;
	
		case 'home':
			
			break;
			
		case 'new_proposal':
			
			
			break;
		
		default:
			
			$page = 'home';
			header("Location: home");
			
			break;
			
	}
	
?>