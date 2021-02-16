<?php

#This document is loaded on every page, and contains all logic for querying the MySQL Database on specific pages when forms are filled out
#This document also contains the logic for redirecting the user when some forms are submitted via POST

	switch ($page) {	//checks the value of the $page variable, which contains the label of the current view
	
		case 'login':
			
			$_SESSION['user_email'] = 'admin@proposals.com';
			$_SESSION['logged_in'] = true;
						
			$statement = $dbc->prepare("SELECT * FROM users WHERE email = ? AND password = SHA1(?)");
			$statement->bind_param("ss", $email, $password);
						
			
			if($_SESSION['logged_in'] == true){	//check if the user is already logged in; if so, redirect them to the HOME page
				header('Location: home');
			}
			
			break;
			
		case 'logout':
			
			unset($_SESSION['user_email']);
			unset($_SESSION['logged_in']);
			header("Location: login");
			break;
	
		case 'home':
						
			if($_POST['action'] == 'download'){			
				header("Location: download_docx_3?pid=".$_POST['openedid']);
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
					header("Location: home?success=add");
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
				$change_proposal = $change_proposal->createProposalReviseExistingCourse($user_id, $course_id, $criteria, $_POST);
				
				if($change_proposal == true){
					header("Location: home?success=change");
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

							if(isset($_POST['course_id'])){
								$criteria = $criteria."1";
							}
							
							if(isset($_POST['course_title'])){
								$criteria = $criteria."2";
							}
							
							if(isset($_POST['course_desc'])){
								$criteria = $criteria."3";
							}
							
							if(isset($_POST['extra_details'])){
								$criteria = $criteria."4";
							}
							
							if(isset($_POST['enrollment_limit'])){
							    $criteria = $criteria."5";
							}
							
							if(isset($_POST['prerequisites'])){
								$criteria = $criteria."6";
							}
							
							if(isset($_POST['units'])){
								$criteria = $criteria."7";
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
		                    $remove_proposal = $remove_proposal->createProposalDropExistingCourse($user_id, $course_id, $_POST);
		                    
		                    if($remove_proposal == true){
		                        header("Location: home?success=remove");
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
			
		case 'edit_proposal_add':
			
			if($_POST){
				
				$pid = $_GET['pid'];
				
				$user_id = $user->id;
				$new_proposal = new Proposal($dbc);
				$new_proposal = $new_proposal->editProposalAddNewCourse($user_id, $pid, $_POST);
				
				if($new_proposal != false){
					$message = '<p class="bg-success">Your edits were successfully saved.</p>';
				}else{
					$message = '<p class="bg-danger">Error: proposal could not be saved. '.mysqli_error($dbc)."</p>";
				}
			}
			
			break;
			
		case 'edit_proposal_revise':
			
			if($_POST){
				
				$user_id = $user->id;
				$pid = $_GET['pid'];
				
				$proposal = new Proposal($dbc);
				$proposal = $proposal->fetchProposalFromID($pid);
				
				$change = new Proposal($dbc);
				
				$updated = $change->editProposalReviseExistingCourse($pid, $proposal->proposal_date, $user_id, $proposal->related_course_id, $proposal->criteria, $_POST);
				
				if($updated == true){
					$message = '<p class="bg-success">Your edits were successfully saved.</p>';
				}else{
					$message = '<p class="bg-danger">Error: proposal could not be saved. '.mysqli_error($dbc)."</p>";
				}
					
			}
			
			break;
			
		case 'edit_proposal_drop':
			
			if($_POST){
					
				$user_id = $user->id;
				$pid = $_GET['pid'];
		        
		        $course_id = mysqli_real_escape_string($dbc, $_POST['existing_course_id']);
		        $course_id_array = str_split($course_id);
		        
		        if(count($course_id_array) == 5){
		            
		            if($course_id != ""){
		                
		                $course = new Course($dbc);
		                $course = $course->fetchCourseFromCourseID($course_id);
		                
		                if($course != false){
		                    
		                    $remove_proposal = new Proposal($dbc);
		                    $remove_proposal = $remove_proposal->editProposalDropExistingCourse($user_id, $pid, $_POST);
		                    
		                    if($remove_proposal == true){
		                        $message = '<p class="bg-success">Your edits were successfully saved.</p>';
		                    }else{
		                        $message = '<p class="bg-danger">Error: proposal could not be saved. '.mysqli_error($dbc)."</p>";
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
			
			
			break;
		    
			
		case 'demo':
			
			break;
		
		default:
			
			//$page = 'home';
			//header("Location: home");
			
			break;
			
	}
	
?>