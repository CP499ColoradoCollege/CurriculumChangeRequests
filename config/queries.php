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
			
			// New Word Document
					/*		
			$languageEnGb = new PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::EN_GB);
							
			$phpWord = new \PhpOffice\PhpWord\PhpWord();
			$phpWord->getSettings()->setThemeFontLang($languageEnGb);
			
			
			$paragraphStyle = 'pStyle';
			$phpWord->addParagraphStyle($paragraphStyle, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 280));
			
			$phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));
							
			// New portrait section
			$section = $phpWord->addSection();
			
			$deptHeaderStyle = 'deptHeader';
			$phpWord->addFontStyle($deptHeaderStyle, array('bold' => true, 'size' => 14, 'name' => 'Calibri'));
			
			$boldCapsStyle = 'boldCaps';
			$phpWord->addFontStyle($boldCapsStyle, array('bold' => true, 'allCaps' => true, 'size' => 12, 'name' => 'Calibri'));
			
			$boldStyle = 'bold';
			$phpWord->addFontStyle($boldStyle, array('bold' => true, 'size' => 12, 'name' => 'Calibri'));
			
			$standardStyle = 'standard';
			$phpWord->addFontStyle($standardStyle, array( 'size' => 12, 'name' => 'Calibri'));
			
			
			$section->addText($department, $deptHeaderStyle, $paragraphStyle);
			$section->addText('A) '.$proposalType, $boldCapsStyle, $paragraphStyle);
			$section->addText('1)'.$currentCourseTitle, $boldStyle, $paragraphStyle);
			$section->addText($courseChangeDescription, $standardStyle, $paragraphStyle);
			$section->addText($currentCourseInfoHeader, $boldCapsStyle, $paragraphStyle);
			$section->addText($currentCourseTitle, $boldStyle, $paragraphStyle);
			$section->addText($currentCourseDescription, $standardStyle, $paragraphStyle);
			$section->addText('Prerequisite: '.$currentPrereqs, $standardStyle, $paragraphStyle);
			$section->addText($proposedCourseInfoHeader, $boldCapsStyle, $paragraphStyle);
			$section->addText($proposedCourseTitle, $boldStyle, $paragraphStyle);
			$section->addText($proposedCourseDescription, $standardStyle, $paragraphStyle);
			$section->addText('Prerequisite: '.$currentPrereqs, $standardStyle, $paragraphStyle);
			$section->addText('Rationale: '.$rationale, $standardStyle, $paragraphStyle);
			$section->addText('Library Impact: '.$libraryImpact, $standardStyle, $paragraphStyle);
			$section->addText('Tech Impact: '.$techImpact, $standardStyle, $paragraphStyle);
							
			
			// Save file
			echo write($phpWord, "test1", $writers);
			 
			 
			 */
						
			if($_POST['action'] == 'download'){
				
				
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
						header("Location: change_course_proposal");
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
			
		case 'demo':
			
			break;
		
		default:
			
			//$page = 'home';
			//header("Location: home");
			
			break;
			
	}
	
?>