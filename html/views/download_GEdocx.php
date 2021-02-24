<?php
	require_once 'vendor/autoload.php';

	/*
	This document contains all logic for generating .docx files for GenEd proposals and then downloading them.
	It should be loaded when a user hits a "download" button on the Home page.
	Tips: if Microsoft Word is refusing to open the documents but LibreOffice can do it, wrap every
	single string going into the document in htmlentities() or check for bad input like "&".
	If you're being redirected to a page full of question marks, there's some kind of encoding issue. Make
	sure your document title isn't too long and that you're using UTF-8. 
	If you want to make a new download php file but redirects aren't working right in queries.php, check that you 
	have added your file as an exception in headers.php.
	PHPWord has pretty good documentation. Be sure to check it out!
	*/
	
	$proposal_id = $_GET['pid'];
	$type = $_GET['type'];
	//DEBUG
	// $msg = "type: ".$type;
	// error_log(print_r($msg, TRUE));
	$proposal = new Proposal($dbc);
	if($type == 'proposal'){
		$proposal = $proposal->fetchProposalFromID($proposal_id);
	}else if($type == 'proposalhistory'){
		$proposal = $proposal->fetchProposalHistory($proposal_id);
	}
	else{
		//$type is probably broken
		$proposal = $proposal->fetchProposalFromID($proposal_id);
	}
	
	
	if($proposal == false){
		//DEBUG
		$msg = "Hit empty proposal abort condition in download_GEdocx.php";
		error_log(print_r($msg, TRUE)); 

		//header("Location: home");
		exit;
	}
	

	//everything from here to the if statement is just setup
	
	$filename = str_replace(' ', '_', $proposal->proposal_title);
	$filename = str_replace(',', '', $filename);
	$filename = str_replace("'", '', $filename);

	$division = $user->getDivision($proposal->department);
	$course_id = $proposal->related_course_id;
	$department = str_replace("&", "and", $proposal->department);	
			
	$proposedCriteriaInfoHeader = "Proposed: ";
	$p_course_name = trim(htmlentities("$proposal->p_course_id: $proposal->p_course_title")); //for new course proposals


	$proposedCourseInfo = array("p_course_name" => $p_course_name, "p_course_desc" => $proposal->p_course_desc, 
					"p_course_extra_desc" => $proposal->p_extra_details, "p_course_prereqs" => $proposal->p_prereqs, 
					"p_course_units" => $proposal->p_units, "rationale" => $proposal->rationale, 
					"lib_impact" => $proposal->lib_impact, "tech_impact" => $proposal->tech_impact,
					"p_info_header" => $proposedCriteriaInfoHeader, "type" => $proposal->type, "p_limit" => $proposal->p_limit, 
					"p_aligned_assignments" => $proposal->p_aligned_assignments, "p_first_offering" => $proposal->p_first_offering, 
					"p_course_status" => $proposal->p_course_status, "p_designation_scope" => $proposal->p_designation_scope, 
					"p_designation_prof" => $proposal->p_designation_prof, "p_feedback" => $proposal->p_feedback, 
					"department" => $department, "division" => $division, "p_perspective" => str_replace("&", "and", $proposal->p_perspective));

	// //DEBUG
	// $n = 1;
	// foreach($proposedCourseInfo as $info){
	// 	$msg = "Thing ".$n." of 19: ".$info;
	// 	error_log(print_r($msg, TRUE));
	// 	$n ++;
	// }
	//end debug
	foreach($proposedCourseInfo as $info){
		if(is_null($info)){
			$info = 'None';
		}
	}

	$perspectiveText = htmlentities($proposedCourseInfo["p_perspective"]); //needed bc "&" character breaks things

	$languageEnGb = new PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::EN_GB);
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	$phpWord->getSettings()->setThemeFontLang($languageEnGb);
	$section = $phpWord->addSection();

	$paragraphStyle = 'pStyle';
	$phpWord->addParagraphStyle($paragraphStyle, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 280));
	$noSpaceParagraphStyle = 'nspStyle';
	$phpWord->addParagraphStyle($noSpaceParagraphStyle, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 10));
	$phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));
	$boldStyle = 'bold';
	$phpWord->addFontStyle($boldStyle, array('bold' => true, 'size' => 12, 'name' => 'Calibri'));
	$italicStyle = 'italic';
	$phpWord->addFontStyle($italicStyle, array('italic' => true, 'size' => 12, 'name' => 'Calibri'));
	$boldCapsStyle = 'boldCaps';
	$phpWord->addFontStyle($boldCapsStyle, array('bold' => true, 'allCaps' => true, 'size' => 12, 'name' => 'Calibri'));

	//new and repurposed font types
	$appHeaderStyle = 'appHeader';//for first bold line of document
	$phpWord->addFontStyle($appHeaderStyle, array('bold' => true, 'allCaps' => true, 'size' => 14, 'name' => 'Calibri'));
	$appDescStyle = 'appDesc';//for second line about "this form should be used by faculty for X GenEd req"
	$phpWord->addFontStyle($appDescStyle, array('size' => 11, 'name' => 'Calibri'));
	$genEdStyle = 'gedEd';//for bolded genEd req at end of second line
	$phpWord->addFontStyle($genEdStyle, array('bold' => true, 'size' => 12, 'name' => 'Calibri'));
	$secHeaderStyle = 'secHeader';//for section headers on first page
	$phpWord->addFontStyle($secHeaderStyle, array('italic' => true, 'bold' => true, 'size' => 12, 'name' => 'Calibri'));
	$descStyle = 'desc';
	$phpWord->addFontStyle($descStyle, array( 'size' => 11, 'name' => 'Calibri'));
	$standardStyle = 'standard';
	$phpWord->addFontStyle($standardStyle, array( 'size' => 11, 'name' => 'Calibri'));
	$smallBoldStyle = 'smallBold';
	$phpWord->addFontStyle($smallBoldStyle, array( 'bold' => true, 'size' => 11, 'name' => 'Calibri'));

	if($proposal->type == "Add a New Course"){
		//DEBUG
		// $msg = "Reached interior of Add a New Course if statement";
		// error_log(print_r($msg, TRUE)); 

		$user = new $user($dbc);
		$user = $user->fetchUserFromID($proposal->user_id);
		if($user == false){
			//DEBUG
			// $msg = "Hit user abort condition in download_GEdocx.php";
			// error_log(print_r($msg, TRUE)); 
			header("Location: home");
			exit();
		}
		$instructor_name = htmlentities($user->first_name);
		$instructor_name .= htmlentities(" ".$user->last_name);
		$instructor_email = htmlentities($user->email);

		$section->addText(htmlentities("Department of ".$department), $appHeaderStyle);
		$section->addTextBreak(1);

		$section->addText("The ".$department." department proposes to add the new course ".$p_course_name. 
		" with the approval of the ".$division." Executive Committee and the Committee on Instruction.", $standardStyle);
		$section->addTextBreak(1);

		$section->addText("A. Proposal to Add Course to the Catalog", $boldCapsStyle);
		$section->addTextBreak(1);

		$descTextRun = $section->createTextRun($paragraphStyle);
		$descTextRun->addText("The Department of ".$department." proposes a new course ", $standardStyle);
		$descTextRun->addText($p_course_name, $smallBoldStyle);
		$descTextRun->addText(", with the approval of the ".$division." Executive Committee and the Committee on Instruction.", $standardStyle);
		$section->addTextBreak(1);

		$section->addText("ADD: ".$p_course_name, $boldStyle);
		$section->addTextBreak(1);

		//Need to do all this special stuff in order to get phpWord to process newlines inside a string
		//DEBUG: this could be a HUGE source of headaches if there is bad input
        $text = $proposedCourseInfo["p_course_desc"];
        $text = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $text);
		$section->addText($text, $standardStyle);
		//$section->addText(htmlentities($proposedCourseInfo["p_course_desc"]), $standardStyle);
		$section->addTextBreak(1);

		$courseTextRun = $section->createTextRun($paragraphStyle);
		$courseTextRun->addText("Units: ", $smallBoldStyle);
		$courseTextRun->addText($proposedCourseInfo['p_course_units'], $standardStyle);
		$courseTextRun->addTextBreak(2);
		$courseTextRun->addText("Prerequisite(s): ", $smallBoldStyle);
		$courseTextRun->addText($proposedCourseInfo['p_course_prereqs'], $standardStyle);
		$courseTextRun->addTextBreak(2);
		$courseTextRun->addText("Rationale: ", $smallBoldStyle);
		//DEBUG: the two lines below could be a HUGE source of headaches if there is bad input
        $text = $proposedCourseInfo["rationale"];
        $text = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $text);
		$courseTextRun->addText($text, $standardStyle);
		$courseTextRun->addTextBreak(2);
		$courseTextRun->addText("Library Impact: ", $smallBoldStyle);
		$courseTextRun->addText($proposedCourseInfo["lib_impact"], $standardStyle);
		$courseTextRun->addTextBreak(2);
		$courseTextRun->addText("Technology Impact: ", $smallBoldStyle);
		$courseTextRun->addText($proposedCourseInfo["tech_impact"], $standardStyle);

	}
	else if($proposal->type == "Change an Existing Course"){		
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($course_id);	
		$criteria = $proposal->criteria;
		$course_title = "$course->subj_code $course->course_num: $course->course_title";
		
		//0: boilerplate that doesn't depend on criteria
		$section->addText(htmlentities("Department of ".$department), $appHeaderStyle);
		$section->addTextBreak(1);

		//1: identify criteria being changed
		$headerString = "";
		$critArray = str_split($criteria);
		
		for( $i = 0; $i<count($critArray); $i += 1){
			switch($critArray[$i]){
				case 'a':
					$headerString.="Course ID-";
					break;
				case 'b':
					$headerString.="Course Title-";
					break;
				case 'c':
					$headerString.="Course Description-";
					break;
				case 'd':
					$headerString.="Extra Details-";
					break;
				case 'e':
					$headerString.="Enrolment Limit-";
					break;
				case 'f':
					$headerString.="Prerequisites-";
					break;
				case 'g':
					$headerString.="Units-";
					break;
				case 'h':
					$headerString.="First Offering-";
					break;
				case 'i':
					$headerString.="Aligned Assignments-";
					break;
				case 'j':
					$headerString.="General Education Categorization Scope-";
					break;
				case 'k':
					$headerString.="General Education Categorization Professors-";
					break;
				case 'l':
					$headerString.="General Education Category";
					break;
			}
		}
		$individual_criteria = array_filter(explode("-", $headerString)); 
		if(count($individual_criteria) == 1){
			//do nothing...?
		}
		else if(count($individual_criteria)==2){
			$individual_criteria[0] .= " and ";
		}else{
			for( $i = 0; $i<count($individual_criteria)-1; $i++ ) {
				$individual_criteria[$i] .= ", ";
			}
			$individual_criteria[count($individual_criteria)-2].= "and ";
		}
		$criteriaInfoHeader = implode($individual_criteria);

		//2: boilerplate that changes based on criteria

		$descTextRun = $section->createTextRun($paragraphStyle);
		$descTextRun->addText("The ".$department." department proposes to ", $standardStyle);
		$descTextRun->addText("change the ".$criteriaInfoHeader." of ", $smallBoldStyle);
		$descTextRun->addText($course_title, $smallBoldStyle);
		$descTextRun->addText(", with the approval of the ".$division." Executive Committee and the Committee on Instruction.", $standardStyle);

		$headerTextRun = $section->createTextRun($paragraphStyle);
		$headerTextRun->addText("B. Proposal to change ", $boldCapsStyle);
		$headerTextRun->addText($criteriaInfoHeader, $boldCapsStyle);

		//3: the current and proposed course info; only prints sections contained in $criteria array
		$printedPrereqs = false; //used to ensure prerequisite field prints on every proposal...
			//but not twice on a proposal where prerequisites are being changed
		foreach($critArray as $criteria){
			switch($criteria){
				case 'a':
					$section->addText("Current Course ID", $smallBoldStyle);
					$section->addTextBreak(1);
					if(is_null($course->id)){
						$course->id = "None";
					}
					$section->addText(htmlentities($course->id), $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed Course ID", $smallBoldStyle);
					$section->addTextBreak(1);
					$section->addText(htmlentities($proposal->p_course_id), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'b':
					$section->addText("Current Course Title", $smallBoldStyle);
					$section->addTextBreak(1);
					if(is_null($course->course_title)){
						$course->course_title = "None";
					}
					$section->addText(htmlentities($course->course_title), $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed Course Title", $smallBoldStyle);
					$section->addTextBreak(1);
					$section->addText(htmlentities($proposal->p_course_title), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'c':
					$section->addText("Current Course Description", $smallBoldStyle);
					$section->addTextBreak(1);
					//DEBUG: this could be a HUGE source of headaches if there is bad input
					if(is_null($course->course_desc)){
						$course->course_desc = "None";
					}
					$text = $course->course_desc;
					$text = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $text);
					$section->addText($text, $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed Course Description", $smallBoldStyle);
					$section->addTextBreak(1);
					$text = $proposedCourseInfo["p_course_desc"];
					$text = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $text);
					$section->addText($text, $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'd':
					$section->addText("Current Extra Details", $smallBoldStyle);
					$section->addTextBreak(1);
					if(is_null($course->extra_details)){
						$course->extra_details = "None";
					}
					$section->addText(htmlentities($course->extra_details), $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed Extra Details", $smallBoldStyle);
					$section->addTextBreak(1);
					$section->addText(htmlentities($proposedCourseInfo["p_course_extra_desc"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'e':
					$section->addText("Current Enrollment Limit", $smallBoldStyle);
					$section->addTextBreak(1);
					if(is_null($course->enrollment_limit)){
						$course->enrollment_limit = "Unspecified";
					}
					$section->addText(htmlentities($course->enrollment_limit), $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed Enrollment Limit", $smallBoldStyle);
					$section->addTextBreak(1);
					$section->addText(htmlentities($proposedCourseInfo["p_limit"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'f':
					$section->addText("Current Prerequisite(s)", $smallBoldStyle);
					$section->addTextBreak(1);
					if(is_null($course->prereqs)){
						$course->prereqs = "None";
					}
					$section->addText(htmlentities($course->prereqs), $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed Prerequisite(s)", $smallBoldStyle);
					$section->addTextBreak(1);
					$section->addText(htmlentities($proposedCourseInfo["p_course_prereqs"]), $standardStyle);
					$section->addTextBreak(1);
					$printedPrereqs = true;
					break;
				case 'g':
					$section->addText("Current Units", $smallBoldStyle);
					$section->addTextBreak(1);
					if(is_null($course->units)){
						$course->units = "Unspecified";
					}
					$section->addText(htmlentities($course->units), $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed Units", $smallBoldStyle);
					$section->addTextBreak(1);
					$section->addText(htmlentities($proposedCourseInfo["p_course_units"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'h':
					$section->addText("Current First Offering", $smallBoldStyle);
					$section->addTextBreak(1);
					if(is_null($course->first_offering)){
						$course->first_offering = "None";
					}
					$section->addText(htmlentities($course->first_offering), $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed First Offering", $smallBoldStyle);
					$section->addTextBreak(1);
					$section->addText(htmlentities($proposedCourseInfo["p_first_offering"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'i':
					$section->addText("Current Aligned Assignments", $smallBoldStyle);
					$section->addTextBreak(1);
					//DEBUG: this could be a HUGE source of headaches if there is bad input
					if(is_null($course->aligned_assignments)){
						$course->aligned_assignments = "None";
					}
					$text = $course->aligned_assignments;
					$text = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $text);
					$section->addText($text, $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed Aligned Assignments", $smallBoldStyle);
					$section->addTextBreak(1);
					$text = $proposedCourseInfo["p_aligned_assignments"];
					$text = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $text);
					$section->addText($text, $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'j':
					$section->addText("Current General Education Categorization Scope", $smallBoldStyle);
					$section->addTextBreak(1);
					if(is_null($course->designation_scope)){
						$course->designation_scope = "None";
					}
					$section->addText(htmlentities($course->designation_scope), $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed General Education Categorization Scope", $smallBoldStyle);
					$section->addTextBreak(1);
					$section->addText(htmlentities($proposedCourseInfo["p_designation_scope"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'k':
					$section->addText("Current Generation Education Categorization Instructor(s)", $smallBoldStyle);
					$section->addTextBreak(1);
					if(is_null($course->designation_prof)){
						$course->designation_prof = "None";
					}
					$section->addText(htmlentities($course->designation_prof), $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed General Education Categorization Instructor(s)", $smallBoldStyle);
					$section->addTextBreak(1);
					$section->addText(htmlentities($proposedCourseInfo["p_designation_prof"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'l':
					$section->addText("Current General Education Category", $smallBoldStyle);
					$section->addTextBreak(1);
					if(is_null($course->perspective)){
						$course->perspective = "None";
					}
					$section->addText(htmlentities($course->perspective), $standardStyle);
					$section->addTextBreak(1);
					$section->addText("Proposed General Education Category", $smallBoldStyle);
					$section->addTextBreak(1);
					$section->addText(htmlentities($proposedCourseInfo["p_perspective"]), $standardStyle);
					$section->addTextBreak(1);
			}
		}
		if(!$printedPrereqs){
			$section->addTextBreak(1);
			$prereqTextRun = $section->createTextRun($noSpaceParagraphStyle);
			$prereqTextRun->addText("Prerequisite(s): ", $smallBoldStyle);
			$section->addTextBreak(1);
			if(is_null($course->prereqs)){
				$course->prereqs = "None";
			}
			$prereqTextRun->addText(trim($course->prereqs), $standardStyle);
		}

		//4: Rationale and tech/lib impact
		$courseTextRun = $section->createTextRun($paragraphStyle);
		$courseTextRun->addText("Rationale: ", $smallBoldStyle);
		if(is_null($proposedCourseInfo["rationale"]) || $proposedCourseInfo["rationale"] == ""
		|| strlen($proposedCourseInfo["rationale"]) < 7){
			$proposedCourseInfo["rationale"] = "None";
			//strlen check because if it's empty in the db this if statement doesn't trigger
			//7 because it's the length of the word "because"
			//DEBUG: pray no one puts in a rationale less than 7 characters
		}
		//DEBUG: the two lines below could be a HUGE source of headaches if there is bad input
        $text = $proposedCourseInfo["rationale"];
        $text = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $text);
		$courseTextRun->addText($text, $standardStyle);
		$courseTextRun->addTextBreak(2);
		$courseTextRun->addText("Library Impact: ", $smallBoldStyle);
		$courseTextRun->addText($proposedCourseInfo["lib_impact"], $standardStyle);
		$courseTextRun->addTextBreak(2);
		$courseTextRun->addText("Technology Impact: ", $smallBoldStyle);
		$courseTextRun->addText($proposedCourseInfo["tech_impact"], $standardStyle);
			
	}
	else if($proposal->type == "Remove an Existing Course"){
		//TODO
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($course_id);	
		$course_title = htmlentities("$course->subj_code $course->course_num: $course->course_title");
		
		$section->addText(htmlentities("Department of ".$department), $appHeaderStyle);
		$section->addTextBreak(1);

		$subTextRun = $section->createTextRun($paragraphStyle);
		$subTextRun->addText("The ".$department." department proposes to remove an existing course, ", $standardStyle);
		$subTextRun->addText($course_title, $smallBoldStyle);
		$subTextRun->addText(", with the approval of the ".$division." Executive Committee and the Committee on Instruction.", $standardStyle);

		$section->addText("C. Proposal to Remove a Course from the Catalog", $boldCapsStyle);
		$section->addTextBreak(1);
		$section->addText("REMOVE: ".$course_title, $boldStyle);
		$section->addTextBreak(1);

		//Need to do all this special stuff in order to get phpWord to process newlines inside a string
		//DEBUG: this could be a HUGE source of headaches if there is bad input
        $text = $course->course_desc;
        $text = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $text);
		$section->addText($text, $standardStyle);
		//$section->addText(htmlentities($proposedCourseInfo["p_course_desc"]), $standardStyle);
		$section->addTextBreak(1);

		$courseTextRun = $section->createTextRun($paragraphStyle);
		$courseTextRun->addText("Units: ", $smallBoldStyle);
		$courseTextRun->addText($course->units, $standardStyle);
		$courseTextRun->addTextBreak(2);
		$courseTextRun->addText("Prerequisite: ", $smallBoldStyle);
		$courseTextRun->addText($course->prereqs, $standardStyle);
		$courseTextRun->addTextBreak(2);
		$courseTextRun->addText("Rationale: ", $smallBoldStyle);
		//DEBUG: the two lines below could be a HUGE source of headaches if there is bad input
        $text = $proposedCourseInfo["rationale"];
		if(is_null($text)){
			$text = "None";
		}
        $text = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $text);
		$courseTextRun->addText($text, $standardStyle);
		$courseTextRun->addTextBreak(2);
		$courseTextRun->addText("Library Impact: ", $smallBoldStyle);
		$courseTextRun->addText($proposedCourseInfo["lib_impact"], $standardStyle);
		$courseTextRun->addTextBreak(2);
		$courseTextRun->addText("Technology Impact: ", $smallBoldStyle);
		$courseTextRun->addText($proposedCourseInfo["tech_impact"], $standardStyle);

	}
	else if($proposal->type == "Custom Submission"){
		//TODO - if you're reading this, it was iceboxed
	}
	else{
		//DEBUG
		$msg = "Reached else statement in download_GEdocx.php";
		error_log(print_r($msg, TRUE)); 
		header('Location: home');
		exit;
	}
	$file = 'no_name_specified.docx';
	if($proposal->type == "Change an Existing Course"){
		//2019 group's filename architecture risked the filename becoming too long
		//that will cause encoding errors!!
		$filename = str_replace(' ', '_', $course_id);
		$filename = str_replace(',', '', $filename);
		$filename = str_replace("'", '', $filename);
		$file = htmlentities('Change_'.$filename.'.docx');
	}
	else if ($proposal->type == "Add a New Course"){
		$filename = str_replace(' ', '_', $proposal->p_course_id);
		$file = "New_Course_".htmlentities($filename).'.docx';
	}
	else if($proposal->type == "Remove an Existing Course"){
		$filename = str_replace(' ', '_', $course_id);
		$file = "Remove_Course_".htmlentities($filename).'.docx';
	}
	else{
		$filename = str_replace(' ', '_', $course_id);
		$file = htmlentities('Proposal_for_'.$filename.'.docx');
	}
	//DEBUG
	$msg = "file name: ".$file;
	error_log(print_r($msg, TRUE)); 
	
	//note: $file MUST have .docx at the end
	header("Content-Description: File Transfer");
	header('Content-Disposition: attachment; filename="' . $file . '"');
	header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.
	˓→document');
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Expires: 0');
	$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
	ob_clean();
	$xmlWriter->save("php://output");
	exit;
