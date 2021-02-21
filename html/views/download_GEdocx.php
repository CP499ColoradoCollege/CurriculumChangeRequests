<?php
	require_once 'vendor/autoload.php';

	/*
	This document contains all logic for generating .docx files for GenEd proposals and then downloading them.
	It should be loaded when a user hits a "download" button on the Home page.

	Tips: if Microsoft Word is refusing to open the documents but LibreOffice can do it, wrap every
	single string going into the document in htmlentities().
	If you're being redirected to a page full of question marks, there's some kind of encoding issue. Make
	sure your document title isn't too long and that you're using UTF-8. 
	If you want to make a new download php file but redirects aren't working right in queries.php, check that you 
	have added your file as an exception in headers.php.
	PHPWord has pretty good documentation. Be sure to check it out!
	*/
	
	$proposal_id = $_GET['pid'];
	$proposal = new Proposal($dbc);
	$proposal = $proposal->fetchProposalFromID($proposal_id);
	
	if($proposal == false){
		//DEBUG
		$msg = "Hit abort condition in download_GEdocx.php";
		error_log(print_r($msg, TRUE)); 

		header("Location: home");
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
	$p_course_name = "$proposal->p_course_id: $proposal->p_course_title";

	$proposedCourseInfo = array("p_course_name" => $p_course_name, "p_course_desc" => $proposal->p_course_desc, 
					"p_course_extra_desc" => $proposal->p_extra_details, "p_course_prereqs" => $proposal->p_prereqs, 
					"p_course_units" => $proposal->p_units, "rationale" => $proposal->rationale, 
					"lib_impact" => $proposal->lib_impact, "tech_impact" => $proposal->tech_impact,
					"p_info_header" => $proposedCriteriaInfoHeader, "type" => $proposal->type, "p_limit" => $proposal->p_limit, 
					"p_aligned_assignments" => $proposal->p_aligned_assignments, "p_first_offering" => $proposal->p_first_offering, 
					"p_course_status" => $proposal->p_course_status, "p_designation_scope" => $proposal->p_designation_scope, 
					"p_designation_prof" => $proposal->p_designation_prof, "p_feedback" => $proposal->p_feedback, 
					"department" => $department, "division" => $division, "p_perspective" => $proposal->p_perspective);

	// //DEBUG
	// $n = 1;
	// foreach($proposedCourseInfo as $info){
	// 	$msg = "Thing ".$n." of 19: ".$info;
	// 	error_log(print_r($msg, TRUE));
	// 	$n ++;
	// }
	//end debug

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

	//new and repurposed font types
	$appHeaderStyle = 'appHeader';//for first bold line of document
	$phpWord->addFontStyle($appHeaderStyle, array('bold' => true, 'size' => 14, 'name' => 'Calibri'));
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
		$msg = "Reached interior of Add a New Course if statement";
		error_log(print_r($msg, TRUE)); 

		//DEBUG: DOES NOT WORK
		$user = new $user($dbc);
		$msg = "user id: ".$proposal->user_id;
		error_log(print_r($msg, TRUE));
		$user = $user->fetchUserFromID($proposal->user_id); //try putting debug in fetchUserFromID to make sure it's being called
		if($user == false){
			//DEBUG
			$msg = "Hit user abort condition in download_GEdocx.php";
			error_log(print_r($msg, TRUE)); 
			header("Location: home");
			exit();
		}
		$instructor_name = htmlentities($user->first_name);
		$instructor_name .= htmlentities(" ".$user->last_name);
		$instructor_email = htmlentities($user->email);

		$formDesc = "The following form should be used by Colorado College departments and/or faculty to submit courses for ";
		$genEdDesc = array("No description set");
		$curricularGoals = array("No curricular goals defined"); //each entry will be a bullet point
		$learningOutcomes = array("No learning outcomes defined"); //each entry will be a bullet point
		$learningOutcomesDesc = "As a result of taking a course in ".$perspectiveText." students will be able to:";
		
		//note: all newlines within the quotes "" will transfer to word doc, so that's why the code lines go waaaaay off to the right
		if(is_null($proposedCourseInfo["p_perspective"])){
			$proposedCourseInfo["p_perspective"] = "No Perspective Specified";
		}
		switch ($proposedCourseInfo["p_perspective"]) {
			case "Analysis & Interpretation of Meaning":
				$genEdDesc = "Analysis & Interpretation of Meaning description not transcribed.";
				break;
			case "Creative Process":
				$genEdDesc = "Creative Process description not transcribed.";
			  	break;
			case "Equity & Power - Global":
				$genEd1 = "Engaging questions of equity and power, in both U.S. and global contexts, ";
				$genEd1 .= "is essential to a liberal arts education. Courses that fulfill this requirement expect ";
				$genEd1 .= "students to examine how systems of power create and shape notions of self, relations with others, ";
				$genEd1 .= "access to resources and opportunities, and the production of knowledge. In these courses, ";
				$genEd1 .= "students develop analytical and interpretive tools and/or reflective habits and interpersonal ";
				$genEd1 .= "skills for thinking critically about how inequities are produced, reinforced, experienced, and resisted.";
				$genEd2 = "Equity and Power courses may be taken as part of the Critical Learning Across the Liberal Arts categories.";
				$genEdDesc = array($genEd1, $genEd2);
				$curricularGoals = array("Students will gain an understanding of social, political, cultural, epistemological and/or economic forces that have produced and/or now sustain multiple forms of inequalities and their intersections;", 
					"Students will identify, analyze, and evaluate the ways in which individuals and groups have unequal experiences, social positions, opportunities or outcomes based on the intersections of race, indigeneity, caste or class, citizenship, gender, gender identity, sexuality, size, (dis)ability, religious practices, belief systems, or other dimensions of difference;", 
					"Students will seek to identify and challenge their implicit biases and assumptions while learning to participate respectfully and productively in potentially uncomfortable discussions about equity and power and their position in relationship to others.");
				$learningOutcomes = array("Describe the relationship between power and inequality;", 
					"Describe one or more ways that a form of inequality, such as racism, is reproduced over time;", 
					"Describe how the social identity, historical context, or cultural context of a writer, artists, scientist, or other worker influences the work they do;", 
					"Describe their own positionality with regard to one or more systems of inequality.");
				break;
			case "Equity & Power - U.S.":
				$genEdDesc = "Equity & Power - U.S. description not transcribed.";
				break;
			case "Formal Reasoning & Logic":
				$genEdDesc = "Formal Reasoning & Logic description not transcribed.";
				break;
			case "Historical Perspectives":
				$genEdDesc = "Historical Perspectives description not transcribed.";
				break;
			case "Scientific Analysis":
				$genEdDesc = "Scientific Analysis description not transcribed.";
				break;
			case "Societies & Human Behaviors":
				$genEdDesc = "Societies & Human Behaviors description not transcribed.";
				break;
			default:
				$genEdDesc = "Default case. General Education requirement ".$perspectiveText." does not match case labels.";
				break;
		  }

		//everything before "Submitter Information"
		$titleTextRun = $section->createTextRun($paragraphStyle);
		$a_1 = "Application for consideration for the ".$perspectiveText." category";
		$titleTextRun->addText($a_1, $appHeaderStyle);
		$textRunZ = $section->createTextRun($paragraphStyle);
		$textRunZ->addText($formDesc, $standardStyle);
		$perspectivePlusPeriod = "".$perspectiveText.".";
		$textRunZ->addText($perspectivePlusPeriod, $genEdStyle);

		foreach ($genEdDesc as $paragraph){
			$section->addText($paragraph, $standardStyle);
		}
		$section->addTextBreak(1);

		$section->addText('Curricular goals', $secHeaderStyle, $paragraphStyle);
		foreach ($curricularGoals as $goal){
			$section->addListItem($goal, 0, $standardStyle, $TYPE_BULLET_EMPTY, $noSpaceParagraphStyle);
		}
		$section->addTextBreak(2);

		$section->addText('Learning outcomes', $secHeaderStyle, $noSpaceParagraphStyle);
		$section->addText($learningOutcomesDesc, $standardStyle);
		$section->addTextBreak(1);
		foreach ($learningOutcomes as $outcome){
			$section->addListItem($outcome, 0, $standardStyle, $TYPE_BULLET_EMPTY, $noSpaceParagraphStyle);
		}
		$section->addTextBreak(3);

		//Submitter information and onward
		$section->addText('Submitter information', $boldStyle);
		$section->addText('------------------------------------------------------------------------------------------------------------------------------------'); //solid black line...isn't working
		
		//TODO: FIX THIS (right now, just blank)
		$section->addText('Instructor Name: '.$instructor_name, $standardStyle);
		$section->addText('Email address: '.$instructor_email, $standardStyle);
		$section->addTextBreak(1);

		$section->addText('Basic course information', $boldStyle);
		$section->addText('------------------------------------------------------------------------------------------------------------------------------------'); //solid black line...isn't working
		$section->addText('Department/program: '.$department, $standardStyle);
		$section->addText('Course number (if available): '.$course_id, $standardStyle);
		$course_title = "$course->subj_code $course->course_num: $course->course_title";
		$section->addText('Course title: '.htmlentities($p_course_name), $standardStyle);
		$section->addText('When is the first semester and year the course will be offered? '.$proposedCourseInfo["p_first_offering"], 
		 	$standardStyle);
		$section->addTextBreak(1);

		//TODO: have the bullet style change from EMPTY to FILLED based on submission/approval status
		$section->addText('This course is (select one):', $standardStyle);
		$section->addListItem('A new course not yet approved by COI', 1, $standardStyle, $TYPE_BULLET_EMPTY, $noSpaceParagraphStyle);
		$section->addListItem('A new course approved by COI, not yet offered', 1, $standardStyle, $TYPE_BULLET_EMPTY, $noSpaceParagraphStyle);
		$section->addListItem('A current course undergoing major revisions', 1, $standardStyle, $TYPE_BULLET_EMPTY, $noSpaceParagraphStyle);
		$section->addListItem('A current course undergoing minor revisions', 1, $standardStyle, $TYPE_BULLET_EMPTY, $noSpaceParagraphStyle);
		$section->addTextBreak(1);

		//TODO: have the bullet style change from EMPTY to FILLED based on p_designation_scope
		$section->addText('This designation is being sought for:', $boldStyle);
		$section->addText('------------------------------------------------------------------------------------------------------------------------------------'); //solid black line...isn't working
		$section->addListItem('All sections of this course', 1, $standardStyle, $TYPE_BULLET_EMPTY, $noSpaceParagraphStyle);
		$section->addListItem('An instructor-specific section of this course (please list instructor(s))', 
			1, $standardStyle, $TYPE_BULLET_EMPTY, $paragraphStyle);
		if(is_null($proposedCourseInfo["p_designation_prof"] || $proposedCourseInfo["p_designation_prof"] == "None" || $proposedCourseInfo["p_designation_prof"] == "N/A")){
			$section->addTextBreak(2);
		}
		else{
			$section->addText(htmlentities($proposedCourseInfo["p_designation_prof"]), $standardStyle);
			$section->addTextBreak(2);
		}

		$section->addText('Please provide the course description', $boldStyle);
		$section->addText('------------------------------------------------------------------------------------------------------------------------------------'); //solid black line...isn't working
		$section->addText(htmlentities($proposedCourseInfo["p_course_desc"]), $standardStyle);
		$section->addTextBreak(1);

		if(is_null($proposedCourseInfo["p_course_units"])){
			$proposedCourseInfo["p_course_units"] == "None specified";
		}
		$unitsDesc = "Units: ".$proposedCourseInfo["p_course_units"];
		if(is_null($proposedCourseInfo["p_limit"])){
			$proposedCourseInfo["p_limit"] == "None specified";
		}
		$limitDesc = "Enrolment Limit: ".$proposedCourseInfo["p_limit"];
		$libImpactDesc = "Library Impact: ".$proposedCourseInfo["lib_impact"];
		$techImpactDesc = "Technology Impact: ".$proposedCourseInfo["tech_impact"];
		$prereqDesc = "Prerequisites: ".htmlentities($proposedCourseInfo["p_course_prereqs"]);
		$section->addText($unitsDesc, $standardStyle);
		$section->addText($limitDesc, $standardStyle);
		$section->addText($libImpactDesc, $standardStyle);
		$section->addText($techImpactDesc, $standardStyle);
		$section->addText($prereqDesc, $standardStyle);
		$section->addPageBreak();

		$rationaleTextRun = $section->createTextRun($paragraphStyle);
		$rationaleTextRun->addText('Please provide a brief rationale addressing how the proposed course aligns with the description of the ', $boldStyle);
		$rationaleTextRun->addText($perspectiveText, $secHeaderStyle);
		$rationaleTextRun->addText(' category:', $boldStyle);
		$section->addText(htmlentities($proposedCourseInfo["rationale"]), $standardStyle);
		$section->addPageBreak();
		
		$assignTextRun = $section->createTextRun($paragraphStyle);
		$assignTextRun->addText('Courses in each General Education category need to include at least one assignment aligned ', $boldStyle);
		$assignTextRun->addText('to each learning outcome. What assignment(s) would enable students to reach the learning outcomes for the ', $boldStyle);
		$assignTextRun->addText($perspectiveText, $secHeaderStyle);
		$assignTextRun->addText(' category?', $boldStyle);
		$section->addText(htmlentities($proposedCourseInfo["p_aligned_assignments"]), $standardStyle);
		$section->addPageBreak();

		$section->addText('Submit to: Sub-Committee', $boldStyle);
		$section->addListItem('Accepted (on to COI)', 1, $standardStyle, $TYPE_BULLET_EMPTY, $noSpaceParagraphStyle);
		$section->addListItem('Revise and Resubmit (back to Faculty)', 1, $standardStyle, $TYPE_BULLET_EMPTY, $noSpaceParagraphStyle);
		$section->addListItem('Rejected (back to Faculty)', 1, $standardStyle, $TYPE_BULLET_EMPTY, $noSpaceParagraphStyle);
		$section->addTextBreak(1);

		$section->addText('Comments from Sub-Committee:', $boldStyle);
		if(is_null($proposedCourseInfo["p_feedback"] || $proposedCourseInfo["p_feedback"] == "None")){
			$section->addTextBreak(20);
		}
		else{
			$section->addText(htmlentities($proposedCourseInfo["p_feedback"]), $standardStyle);
		}

	}
	else if($proposal->type == "Change an Existing Course"){		
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($course_id);	
		$criteria = $proposal->criteria;	//237
		$course_title = "$course->subj_code $course->course_num: $course->course_title";
		
		//0: boilerplate
		$titleTextRun = $section->createTextRun($paragraphStyle);
		$a_2 = "Application for changes to ".htmlentities($course_title);
		$titleTextRun->addText($a_2, $appHeaderStyle);
		$formDesc = "The following form should be used by Colorado College departments and/or faculty to submit changes to existing courses.";
		$section->addText($formDesc, $standardStyle);
		$section->addTextBreak(1);

		//identify criteria being changed
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
		$section->addText("The department of ".$department." proposes changes to the ".$criteriaInfoHeader." of ".htmlentities($course_title).".", $standardStyle);
		$section->addTextBreak(2);

		//1: the existing criteria being changed
		$section->addText('Current course information', $boldStyle, $noSpaceParagraphStyle);
		$section->addText('------------------------------------------------------------------------------------------------------------------------------------'); //solid black line...isn't working
		foreach($critArray as $criteria){
			//use $course 
			switch($criteria){
				case 'a':
					$textRunA = $section->createTextRun();
					$textRunA->addText("Course ID: ", $smallBoldStyle);
					$textRunA->addText(htmlentities($course->id), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'b':
					$textRunB = $section->createTextRun();
					$textRunB->addText("Course Title: ", $smallBoldStyle);
					$textRunB->addText(htmlentities($course->course_title), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'c':
					$textRunC = $section->createTextRun();
					$textRunC->addText("Course Description: ", $smallBoldStyle);
					$textRunC->addText(htmlentities($course->course_desc), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'd':
					$textRunD = $section->createTextRun();
					$textRunD->addText("Extra Details: ", $smallBoldStyle);
					$textRunD->addText(htmlentities($course->extra_details), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'e':
					$textRunE = $section->createTextRun();
					$textRunE->addText("Enrolment Limit: ", $smallBoldStyle);
					$textRunE->addText(htmlentities($course->enrollment_limit), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'f':
					$textRunF = $section->createTextRun();
					$textRunF->addText("Prerequisites: ", $smallBoldStyle);
					$textRunF->addText(htmlentities($course->prereqs), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'g':
					$textRunG = $section->createTextRun();
					$textRunG->addText("Units: ", $smallBoldStyle);
					$textRunG->addText(htmlentities($course->units), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'h':
					$textRunH = $section->createTextRun();
					$textRunH->addText("First Offering: ", $smallBoldStyle);
					$textRunH->addText(htmlentities($course->first_offering), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'i':
					$textRunI = $section->createTextRun();
					$textRunI->addText("Aligned Assignments: ", $smallBoldStyle);
					$textRunI->addText(htmlentities($course->aligned_assignments), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'j':
					$textRunJ = $section->createTextRun();
					$textRunJ->addText("General Education Categorization Scope: ", $smallBoldStyle);
					$textRunJ->addText(htmlentities($course->designation_scope), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'k':
					$textRunK = $section->createTextRun();
					$textRunK->addText("General Education Categorization Instructor(s): ", $smallBoldStyle);
					$textRunK->addText(htmlentities($course->designation_prof), $standardStyle);
					$section->addTextBreak(1);
					break;
			}
		}
		$section->addTextBreak(2);

		//2: the proposed changes
		$section->addText('Proposed changes', $boldStyle, $noSpaceParagraphStyle);
		$section->addText('------------------------------------------------------------------------------------------------------------------------------------'); //solid black line...isn't working
		foreach($critArray as $criteria){
			//use $course 
			switch($criteria){
				case 'a':
					$textRunA = $section->createTextRun();
					$textRunA->addText("Course ID: ", $smallBoldStyle);
					$textRunA->addText(htmlentities($course_id), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'b':
					$textRunB = $section->createTextRun();
					$textRunB->addText("Course Title: ", $smallBoldStyle);
					$textRunB->addText(htmlentities($course_title), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'c':
					$textRunC = $section->createTextRun();
					$textRunC->addText("Course Description: ", $smallBoldStyle);
					$textRunC->addText(htmlentities($proposedCourseInfo["p_course_desc"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'd':
					$textRunD = $section->createTextRun();
					$textRunD->addText("Extra Details: ", $smallBoldStyle);
					$textRunD->addText(htmlentities($proposedCourseInfo["p_course_extra_desc"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'e':
					$textRunE = $section->createTextRun();
					$textRunE->addText("Enrolment Limit: ", $smallBoldStyle);
					$textRunE->addText(htmlentities($proposedCourseInfo["p_limit"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'f':
					$textRunF = $section->createTextRun();
					$textRunF->addText("Prerequisites: ", $smallBoldStyle);
					$textRunF->addText(htmlentities($proposedCourseInfo["p_course_prereqs"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'g':
					$textRunG = $section->createTextRun();
					$textRunG->addText("Units: ", $smallBoldStyle);
					$textRunG->addText(htmlentities($proposedCourseInfo["p_course_units"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'h':
					$textRunH = $section->createTextRun();
					$textRunH->addText("First Offering: ", $smallBoldStyle);
					$textRunH->addText(htmlentities($proposedCourseInfo["p_first_offering"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'i':
					$textRunI = $section->createTextRun();
					$textRunI->addText("Aligned Assignments: ", $smallBoldStyle);
					$textRunI->addText(htmlentities($proposedCourseInfo["p_aligned_assignments"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'j':
					$textRunJ = $section->createTextRun();
					$textRunJ->addText("General Education Categorization Scope: ", $smallBoldStyle);
					$textRunJ->addText(htmlentities($proposedCourseInfo["p_designation_scope"]), $standardStyle);
					$section->addTextBreak(1);
					break;
				case 'k':
					$textRunK = $section->createTextRun();
					$textRunK->addText("General Education Categorization Instructor(s): ", $smallBoldStyle);
					$textRunK->addText(htmlentities($proposedCourseInfo["p_designation_prof"]), $standardStyle);
					$section->addTextBreak(1);
					break;
			}
		}
		$section->addTextBreak(2);
		//3: the rationale behind those changes
		$section->addText('Rationale', $boldStyle, $noSpaceParagraphStyle);
		$section->addText('------------------------------------------------------------------------------------------------------------------------------------'); //solid black line...isn't working
			//it's one rationale
		$section->addText($proposedCourseInfo["rationale"]);
			
	}
	else if($proposal->type == "Remove an Existing Course"){
		//TODO
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($course_id);	
		$course_title = htmlentities("$course->subj_code $course->course_num: $course->course_title");
		
		//0: boilerplate
		$titleTextRun = $section->createTextRun($paragraphStyle);
		$a_2 = "Application to remove ".htmlentities($course_title);
		$titleTextRun->addText($a_2, $appHeaderStyle);
		$formDesc = "The following form should be used by Colorado College departments and/or faculty to remove existing courses.";
		$section->addText($formDesc, $standardStyle);
		$section->addTextBreak(1);
		

		$descTextRun = $section->createTextRun($paragraphStyle);
		$descTextRun->addText("The department of ".htmlentities($department)." proposes to remove the existing course ", $standardStyle);
		$descTextRun->addText(htmlentities($course_title), $smallBoldStyle);
		$section->addTextBreak(1);
		

		//1: everything else
		$section->addText('Course information', $boldStyle, $noSpaceParagraphStyle);
		$section->addText('------------------------------------------------------------------------------------------------------------------------------------'); //solid black line...isn't working
		$infoTextRun = $section->createTextRun($paragraphStyle);
		$infoTextRun->addText('Course description: ', $smallBoldStyle);
		$infoTextRun->addText(htmlentities($course->course_desc), $standardStyle);
		$infoTextRun->addTextBreak(1);
		$infoTextRun->addText('Units: ', $smallBoldStyle);
		$infoTextRun->addText(htmlentities($course->units), $standardStyle);
		$infoTextRun->addTextBreak(1);
		$infoTextRun->addText('Prerequisites: ', $smallBoldStyle);
		$infoTextRun->addText(htmlentities($course->prereqs), $standardStyle);
		$infoTextRun->addTextBreak(1);
		$infoTextRun->addText('Crosslisting (if applicable): ', $smallBoldStyle);
		$infoTextRun->addText(htmlentities($course->crosslisting), $standardStyle);
		$infoTextRun->addTextBreak(1);
		$infoTextRun->addText('General Education Category (if applicable): ', $smallBoldStyle);
		$infoTextRun->addText(htmlentities($course->perspective), $standardStyle);
		$infoTextRun->addTextBreak(1);
		

		$section->addText('Rationale', $boldStyle, $noSpaceParagraphStyle);
		$section->addText('------------------------------------------------------------------------------------------------------------------------------------'); //solid black line...isn't working
		$section->addText(htmlentities($proposedCourseInfo['rationale']), $standardStyle);
		$section->addTextBreak(2);
		

		$bonusTextRun = $section->createTextRun($paragraphStyle);
		$bonusTextRun->addText('Library Impact: ', $smallBoldStyle);
		$bonusTextRun->addText(htmlentities($proposedCourseInfo['lib_impact']), $standardStyle);
		$bonusTextRun->addTextBreak(1);
		$bonusTextRun->addText('Technology Impact: ', $smallBoldStyle);
		$bonusTextRun->addText(htmlentities($proposedCourseInfo['tech_impact']), $standardStyle);

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
		//something about just using $filename for change causes encoding errors
		//possibly length; I don't have the time/motivation to nail it down
		$filename = str_replace(' ', '_', $course_id.$p_course_name);
		$filename = str_replace(',', '', $filename);
		$filename = str_replace("'", '', $filename);
		$file = htmlentities('Change_'.$filename.'.docx');
	}
	else{
		$file = htmlentities($filename).'.docx';
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
