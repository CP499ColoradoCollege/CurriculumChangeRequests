<?php

#This document is loaded on every page, and contains all logic for querying the MySQL Database on specific pages when forms are filled out
#This document also contains the logic for redirecting the user when some forms are submitted via POST
	echo $page;
	switch ($page) {	//checks the value of the $page variable, which contains the label of the current view
	
		case 'login':
		$_SESSION['logged_in'] = true;
			$statement = $dbc->prepare("SELECT * FROM users WHERE email = ? AND password = SHA1(?)");
			echo "Statemend: $statement";
			$statement->bind_param("ss", $email, $password);
						
			
			if($_SESSION['logged_in'] == true){	//check if the user is already logged in; if so, redirect them to the HOME page
				header('Location: home');
			}
			
			if($_POST) {	//check if the LOGIN form has been submitted by the current session
			
				$email = $_POST['email'];
				$password = $_POST['password'];
				
				$bool = $statement->execute();
				
				if($bool){
					$_SESSION['user_email'] = $_POST['email'];
					$_SESSION['logged_in'] = true;
					header('Location: home');				//once logged in, redirect to HOME page instead of LOGIN page
				}
			}
			break;
			
		case 'logout':
			
			unset($_SESSION['user_email']);
			unset($_SESSION['logged_in']);
			header("Location: login");
			
			
			break;
	
		case 'home':
			
			// include('functions/phpword.php');
			// include('functions/download.php');
		
						
			if($_POST['action'] == 'download'){				
				header("Location: download_docx?pid=".$_POST['openedid']);
			}
			if($_POST['action'] == 'edit'){				
				header("Location: edit_proposal?pid=".$_POST['openedid']);
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
			
			if($_POST){
								
				$user_id = $user->id;
				
				$new_proposal = new Proposal($dbc);
				$new_proposal = $new_proposal->createProposalAddNewCourse($user_id, $_POST);
				
				if($new_proposal != false){
					header("Location: home");
				}else{
					echo '<p class="bg-danger">Error: proposal could not be processed. '.mysqli_error($dbc)."</p>";
				}
			}
			
			
			break;
			
		case 'change_course_proposal':
		
			if($_POST){
				
				$user_id = $user->id;
				$course_id = $_GET['cid'];
				$criteria = $_GET['type'];
				
				$change_proposal = new Proposal($dbc);
				$change_proposal = $change_proposal->createProposalChangeExistingCourse($user_id, $course_id, $criteria, $_POST);
				
				if($change_proposal == true){
					header("Location: home");
				}else{
					echo '<p class="bg-danger">Error: proposal could not be processed. '.mysqli_error($dbc)."</p>";
				}
				
			}
			
				
			break;
			
		case 'change_course_proposal_select':
			
			if($_POST){
				
				$course_id = mysqli_real_escape_string($dbc, $_POST['existing_course_id']);
				$course_id_array = str_split($course_id);
				
				if(count($course_id_array) == 5){
					
					//first, make sure the existing_course_id isn't blank
					
					//next, check that at least one of the check boxes was checked
					//set $fields equal to a string of the numerals for each criteria
					
					//then, redirect to header("Location: change_course_proposal?type=".$selected_fields);
					
					if($course_id != ""){
						
						$course = new Course($dbc);
						$course = $course->fetchCourseFromCourseID($course_id);
						
						if($course != false){
							
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
			
		case 'remove_course_proposal':
		    
		    if($_POST){
		    	
				$user_id = $user->id;
		        
		        $course_id = mysqli_real_escape_string($dbc, $_POST['existing_course_id']);
		        $course_id_array = str_split($course_id);
		        
		        if(count($course_id_array) == 5){
		            
		            //first, make sure the existing_course_id isn't blank
		            
		            //next, check that at least one of the check boxes was checked
		            //set $fields equal to a string of the numerals for each criteria
		            
		            //then, redirect to header("Location: change_course_proposal?type=".$selected_fields);
		            
		            if($course_id != ""){
		                
		                $course = new Course($dbc);
		                $course = $course->fetchCourseFromCourseID($course_id);
		                
		                if($course != false){
		                    
		                    $remove_proposal = new Proposal($dbc);
		                    $remove_proposal = $remove_proposal->createProposalRemoveExistingCourse($user_id, $course_id, $_POST);
		                    
		                    if($remove_proposal == true){
		                        header("Location: home");
		                    }else{
		                        echo '<p class="bg-danger">Error: proposal could not be processed. '.mysqli_error($dbc)."</p>";
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
			
		case 'edit_proposal':
			
			if($_POST){
				
				$user_id = $user->id;
				
				$pid = $_POST['pid'];
				
				$proposal = new Proposal($dbc);
				$proposal = $proposal->fetchProposalFromID($pid);
				$title_array = explode(" ", $proposal->proposal_title);
				$page_type = $title_array[0];
				
				if($page_type == 'Add'){
				
					$new_proposal = new Proposal($dbc);
					$new_proposal = $new_proposal->createProposalAddNewCourse($user_id, $_POST);
					
					if($new_proposal != false){
						header("Location: home");
					}else{
						echo '<p class="bg-danger">Error: proposal could not be processed. '.mysqli_error($dbc)."</p>";
					}
						
				}else if($page_type == 'Change'){
					
					
				}else if($page_type == 'Remove'){
					
					
				}else{
					
					
				}
				
				
			}
			
			break;
		    
			
		case 'demo':
			
			break;
		
		default:
			
			$page = 'home';
			header("Location: home");
			
			break;
			
	}
	
?>