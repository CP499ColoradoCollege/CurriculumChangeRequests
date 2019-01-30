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
			
			include('functions/phpword.php');
			include('functions/download.php');
			
						
			if($_POST['action'] == 'download'){				
				header("Location: download_docx?pid=".$_POST['openedid']);
			}
			
			break;
			
		case 'new_proposal':
			
			if($_POST){
				
				$type = $_POST['type'];
				
				switch($type){
					case '1':
						header("Location: new_course_proposal");
						break;
				
					case '2':
						header("Location: change_course_proposal_select");
						break;
						
					case '3':
						header("Location: remove_course_proposal");
						break;
						
					case '4':
						header("Location: other_proposal");
						break;
					
					default:
						break;
				}
				
			}
			
			break;
			
		case "new_course_proposal":
			
			$statement = $dbc->prepare("INSERT INTO proposals (user_id, related_course_id, proposal_title, proposal_date, department, type, proposed_course_title, proposed_course_desc, proposed_prereqs, proposed_postreqs, proposed_units, rationale, lib_impact, tech_impact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$statement->bind_param("ssssssssssssss", $user_id, $course_id, $proposal_title, $date, $dept, $proposal_type, $course_title, $course_desc, $prereqs, $postreqs, $units, $rationale, $lib_impact, $tech_impact);
			
			if($_POST){
								
				$email = $_SESSION['user_email'];				
				$q = "SELECT * FROM users WHERE email = '$email'";
				$r = mysqli_query($dbc, $q);
				$data = mysqli_fetch_assoc($r);
								
				$user_id = $data['id'];
				$course_id = mysqli_real_escape_string($dbc, $_POST['course_id']);
				$course_title = mysqli_real_escape_string($dbc, $_POST['course_title']);
				$proposal_title = 'New Course: '.$course_id.', '.$course_title;
				$date = date('m/d/Y');
				$dept = mysqli_real_escape_string($dbc, $_POST['department']);
				$proposal_type = 'Add a New Course';
				$course_desc = mysqli_real_escape_string($dbc, $_POST['course_desc']);
				$prereqs = mysqli_real_escape_string($dbc, $_POST['course_prereqs']);
				$postreqs = mysqli_real_escape_string($dbc, $_POST['course_postreqs']);
				$units = $_POST['course_units'];
				$rationale = mysqli_real_escape_string($dbc, $_POST['rationale']);
				$lib_impact = mysqli_real_escape_string($dbc, $_POST['lib_impact']);
				$tech_impact = mysqli_real_escape_string($dbc, $_POST['tech_impact']);
				
				echo $user_id." | ".$course_id." | ".$course_title." | ".$proposal_title." | ".$date." | ".$dept." | ".$course_desc." | ".$prereqs." | ".$postreqs." | ".$units;
				
				$bool = $statement->execute();
				
				if($bool){
					header("Location: home");
				}else{
					
					echo "Error: proposal could not be processed. ".mysqli_error($dbc);
				}

			}
			
			
			break;
			
		case 'change_course_proposal_select':
			
			if($_POST){
				
				//first, make sure the existing_course_id isn't blank
				
				//next, check that at least one of the check boxes was checked
				//set $fields equal to a string of the numerals for each criteria
				
				//then, redirect to header("Location: change_course_proposal?type=".$selected_fields);
				
				$message = "course_id = ";
				
				if(isset($_POST['course_id'])){
					$message = $message."SET; course_title = ";
				}else{
					$message = $message."NOT SET; course_title = ";
				}
				
				if(isset($_POST['course_title'])){
					$message = $message."SET; department = ";
				}else{
					$message = $message."NOT SET; department = ";
				}
				
				if(isset($_POST['department'])){
					$message = $message."SET; ";
				}else{
					$message = $message."NOT SET; ";
				}
								
				
			}
			
			
			break;
			
		case 'demo':
			
			break;
		
		default:
			
			//$page = 'home';
			//header("Location: home");
			
			break;
			
	}
	
?>