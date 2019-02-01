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
			
		case "new_page":
			
			//$statement = $dbc->prepare("INSERT INTO proposals (user_id, proposed_course_id, proposal_title, proposal_date, department, type, rationale, lib_impact, tech_impact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			//$statement->bind_param("ssssssssssssss", $user_id, $course_id, $proposal_title, $date, $dept, $proposal_type, $course_title, $course_desc, $prereqs, $postreqs, $units, $rationale, $lib_impact, $tech_impact);
			
			if($_POST){
				
				$email = $_SESSION['user_email'];				
				$q = "SELECT * FROM users WHERE email = '$email'";
				$r = mysqli_query($dbc, $q);
				$data = mysqli_fetch_assoc($r);
				
				$user_id = $data['id'];
				$course_id = $_POST['course_id'];
				
				
				$message = "The button was pushed!";
				
				
			}else{
				$message = '<p class="bg-danger">Error: button has not yet been pushed. </p>';
			}
			
			
			break;
			
		case "new_course_proposal":
			
			$statement = $dbc->prepare("INSERT INTO proposals (user_id, proposed_course_id, proposal_title, proposal_date, department, type, proposed_course_title, proposed_course_desc, proposed_prereqs, proposed_postreqs, proposed_units, rationale, lib_impact, tech_impact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
					
					echo '<p class="bg-danger">Error: proposal could not be processed. '.mysqli_error($dbc)."</p>";
				}

			}
			
			
			break;
			
		case 'change_course_proposal':
		
			$statement = $dbc->prepare("INSERT INTO proposals (user_id, related_course_id, proposal_title, proposal_date, department, type, proposed_department, proposed_course_id, proposed_course_title, proposed_course_desc, proposed_prereqs, proposed_units, rationale, lib_impact, tech_impact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$statement->bind_param("sssssssssssssss", $user_id, $course_id, $proposal_title, $date, $dept, $proposal_type, $p_department, $p_course_id, $p_course_title, $p_course_desc, $p_prereqs, $p_units, $rationale, $lib_impact, $tech_impact);
		
			if($_POST){
				
				$email = $_SESSION['user_email'];				
				$q = "SELECT * FROM users WHERE email = '$email'";
				$r = mysqli_query($dbc, $q);
				$data = mysqli_fetch_assoc($r);
								
				$user_id = $data['id'];
				$course_id = $_GET['cid'];
				$course_id_array = str_split($course_id);
				$subj_code = $course_id_array[0].$course_id_array[1];
				$course_number = $course_id_array[2].$course_id_array[3].$course_id_array[4];
				$criteria = str_split($_GET['type']);				
				
				$proposal_type = "Change an Existing Course";
				
				$changes = "";
				
				$q = "SELECT * FROM courses WHERE subj_code = '$subj_code' AND course_num = '$course_number'";
				$r = mysqli_query($dbc, $q);
				$course = mysqli_fetch_assoc($r);
				
				if(in_array('1', $criteria)){
					$p_department = $_POST['p_department'];
					$changes = $changes." Department";
				}else{
					$p_department = "";
				}
				
				if(in_array('2', $criteria)){
					$p_course_id = mysqli_real_escape_string($dbc, $_POST['p_course_id']);
					if($changes != ""){
						$changes = ", Course ID";
					}else{
						$changes = $changes." Course ID";
					}
				}else{
					$p_course_id = "";
				}
				
				if(in_array('3', $criteria)){
					$p_course_title = mysqli_real_escape_string($dbc, $_POST['p_course_title']);
					if($changes != ""){
						$changes = $changes.", Title";
					}else{
						$changes = $changes." Title";
					}
				}else{
					$p_course_title = "";
				}
				
				if(in_array('4', $criteria)){
					$p_course_desc = mysqli_real_escape_string($dbc, $_POST['p_course_desc']);
					if($changes != ""){
						$changes = $changes.", Description";
					}else{
						$changes = $changes." Description";
					}
				}else{
					$p_course_desc = "";
				}
				
				if(in_array('5', $criteria)){
					$p_prereqs = mysqli_real_escape_string($dbc, $_POST['p_prereqs']);
					if($changes != ""){
						$changes = $changes.", Prerequisites";
					}else{
						$changes = $changes." Prerequisites";
					}
				}else{
					$p_prereqs = "";
				}
				
				if(in_array('6', $criteria)){
					$p_units = $_POST['units'];
					if($changes != ""){
						$changes = $changes.", Units";
					}else{
						$changes = $changes." Units";
					}
				}else{
					$p_units = "";
				}
				
				$proposal_title = 'Change'.$changes.' of Course: '.$course_id.', '.$course['course_title'];
				
				$date = date('m/d/Y');
				$dept = $course['dept_desc'];
				
				$rationale = mysqli_real_escape_string($dbc, $_POST['rationale']);
				$lib_impact = mysqli_real_escape_string($dbc, $_POST['lib_impact']);
				$tech_impact = mysqli_real_escape_string($dbc, $_POST['tech_impact']);
				
				
				$bool = $statement->execute();
				
				if($bool){
					header("Location: home");
				}else{
					
					echo '<p class="bg-danger">Error: proposal could not be processed. '.mysqli_error($dbc)."</p>";
				}
				
				
			}
			
				
			break;
			
		case 'change_course_proposal_select':
						
			$statement = $dbc->prepare("SELECT id FROM courses WHERE subj_code = ? AND course_num = ?");
			$statement->bind_param("ss", $subj_code, $course_number);
			
			if($_POST){
				
				$course_id = mysqli_real_escape_string($dbc, $_POST['existing_course_id']);
				$course_id_array = str_split($course_id);
				
				if(count($course_id_array) == 5){
					$subj_code = $course_id_array[0].$course_id_array[1];
					$course_number = $course_id_array[2].$course_id_array[3].$course_id_array[4];
					
					//first, make sure the existing_course_id isn't blank
					
					//next, check that at least one of the check boxes was checked
					//set $fields equal to a string of the numerals for each criteria
					
					//then, redirect to header("Location: change_course_proposal?type=".$selected_fields);
					
					if($course_id != ""){
						
						$bool = $statement->execute();
						$statement->store_result();
						$statement->bind_result($course_real_id);
						$statement->fetch();
						if($bool && mysqli_stmt_num_rows($statement) == 1){
							
							
							$criteria = "";
							
							if(isset($_POST['department'])){
								$criteria = $criteria."1";
							}
							
							if(isset($_POST['course_id'])){
								$criteria = $criteria."2";
							}
							
							if(isset($_POST['course_title'])){
								$criteria = $criteria."3";
							}
							
							if(isset($_POST['course_desc'])){
								$criteria = $criteria."4";
							}
							
							if(isset($_POST['prerequisites'])){
								$criteria = $criteria."5";
							}
							
							if(isset($_POST['units'])){
								$criteria = $criteria."6";
							}
							
							if($criteria != ""){
								header("Location: change_course_proposal?type=".$criteria."&cid=".$course_id);
							}else{
								$message = '<p class="bg-danger">Error: No criteria selected to be changed.</p>';
							}
							
							
						}else{
							$message = '<p class="bg-danger">The Existing Course ID entered does not match any existing courses.</p>';
						}
					}else{
						$message = '<p class="bg-danger">The Existing Course ID field is blank.</p>';
					}
					
				}else{
					$message = '<p class="bg-danger">The Existing Course ID entered is invalid.</p>';
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