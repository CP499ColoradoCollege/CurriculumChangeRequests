<?php
	require_once 'vendor/autoload.php';

	//DEBUG
	$msg = "Reached beginning of download_GEdocx.php";
	error_log(print_r($msg, TRUE)); 
	
	$proposal_id = $_GET['pid'];
	$proposal = new Proposal($dbc);
	$proposal = $proposal->fetchProposalFromID($proposal_id);
	
	if($proposal == false){
		//DEBUG
		$msg = "Hit abort condition in download_GEdocx.php";
		error_log(print_r($msg, TRUE)); 

		header("Location: home");
		exit();
	}
	
	$filename = str_replace(' ', '_', $proposal->proposal_title);
	$filename = str_replace(',', '', $filename);
	$filename = str_replace("'", '', $filename);

	$division = $user->getDivision($proposal->department);

	if($proposal->type == "Add a New Course"){
		//DEBUG
		$msg = "Reached interior of Add a New Course if statement";
		error_log(print_r($msg, TRUE)); 
		
		$course_id = $proposal->related_course_id;
		$department = str_replace("&", "and", $proposal->department);	
			
		$proposedCriteriaInfoHeader = "Proposed: ";
		$p_course_name = "$proposal->p_course_id: $proposal->p_course_title";

		//DEBUG: DOES NOT WORK
		$msg = "user id: ".$proposal->user_id;
		error_log(print_r($msg, TRUE));
		$p_user = $user->fetchUserFromID($proposal->user_id);
		if($p_user == false){
			//DEBUG
			$msg = "Hit user abort condition in download_GEdocx.php";
			error_log(print_r($msg, TRUE)); 

			header("Location: home");
			exit();
		}
		$instructor_name = $p_user->$first_name;
		$instructor_name .= " ".$p_user->$last_name;
		$instructor_email = $p_user->$email;
		//DEBUG
		$msg = "instructor name: ".$instructor_name;
		error_log(print_r($msg, TRUE));
		$msg = "instructor email: ".$instructor_email;
		error_log(print_r($msg, TRUE));


		$proposedCourseInfo = array("p_course_name" => $p_course_name, "p_course_desc" => $proposal->p_course_desc, 
						"p_course_extra_desc" => $proposal->p_extra_details, "p_course_prereqs" => $proposal->p_prereqs, 
						"p_course_units" => $proposal->p_units, "rationale" => $proposal->rationale, 
						"lib_impact" => $proposal->lib_impact, "tech_impact" => $proposal->tech_impact,
						"p_info_header" => $proposedCriteriaInfoHeader, "type" => $proposal->type, 
						"p_aligned_assignments" => $proposal->p_aligned_assignments, "p_first_offering" => $proposal->p_first_offering, 
						"p_course_status" => $proposal->p_course_status, "p_designation_scope" => $proposal->p_designation_scope, 
						"p_designation_prof" => $proposal->p_designation_prof, "p_feedback" => $proposal->p_feedback, 
						"department" => $department, "division" => $division, "p_perspective" => $proposal->p_perspective);

		//DEBUG
		$n = 1;
		foreach($proposedCourseInfo as $info){
			$msg = "Thing ".$n." of 19: ".$info;
			error_log(print_r($msg, TRUE));
			$n ++;
		}

		//end debug
		$perspectiveText = htmlspecialchars($proposedCourseInfo["p_perspective"]); //needed bc "&" character breaks things

		$languageEnGb = new PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::EN_GB);
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getSettings()->setThemeFontLang($languageEnGb);
		$section = $phpWord->addSection();

		$paragraphStyle = 'pStyle';
		$phpWord->addParagraphStyle($paragraphStyle, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 280));
		$phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));
		$boldCapsStyle = 'boldCaps';
		$phpWord->addFontStyle($boldCapsStyle, array('bold' => true, 'allCaps' => true, 'size' => 12, 'name' => 'Calibri'));
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

		$formDesc = "The following form should be used by Colorado College departments and/or faculty to submit courses for ";
		$genEdDesc = "No description set";
		$curricularGoals = array("No curricular goals defined"); //each entry is a bullet point
		$learningOutcomes = array("No learning outcomes defined"); //each entry is a bullet point
		$learningOutcomesDesc = "As a result of taking a course in ".$perspectiveText." students will be able to:";
		
		//note: all newlines within the quotes "" will transfer to word doc, so that's why the code lines go waaaaay off to the right
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
				$genEd1 .= "\nEquity and Power courses may be taken as part of the Critical Learning Across the Liberal Arts categories.";
				$genEdDesc = $genEd1;
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
				$genEdDesc = "Default case. General Education requirement".$perspectiveText."does not match case labels.";
				
		  }

		//everything before "Submitter Information"
		$titleTextRun = $section->createTextRun($paragraphStyle);
		$a_1 = "Application for consideration for the ".$perspectiveText." category";
		$titleTextRun->addText($a_1, $appHeaderStyle);
		$textRunZ = $section->createTextRun($paragraphStyle);
		$textRunZ->addText($formDesc, $standardStyle);
		$perspectivePlusPeriod = "".$perspectiveText.".";
		$textRunZ->addText($perspectivePlusPeriod, $genEdStyle);

		$section->addText('Curricular goals', $secHeaderStyle, $paragraphStyle);
		foreach ($curricularGoals as $goal){
			$section->addListItem($goal, $standardStyle);
			//cut from after goal: 0, $TYPE_BULLET_FILLED, $paragraphStyle
		}
		$section->addTextBreak(2);

		$section->addText('Learning outcomes', $secHeaderStyle, $paragraphStyle);
		$section->addText($learningOutcomesDesc, $standardStyle);
		$section->addTextBreak(1);
		foreach ($learningOutcomes as $outcome){
			$section->addListItem($outcome, $standardStyle);
			//cut from after goal: 0, $TYPE_BULLET_FILLED, $paragraphStyle
		}
		$section->addTextBreak(3);

		//Submitter information and onward (approximately the lower third of the first page)
		$section->addText('Submitter information', $boldStyle);
		$section->addText('------------------------------------------------------------------'); //solid black line...isn't working
		
		//TODO: FIX THIS (right now, just blank)
		$section->addText('Instructor Name: '.$instructor_name, $standardStyle);
		$section->addText('Email address: '.$instructor_email, $standardStyle);
		$section->addTextBreak(1);

		$section->addText('Basic course information', $boldStyle);
		$section->addText('------------------------------------------------------------------'); //solid black line...isn't working
		$section->addText('Department/program: '.$department, $standardStyle);
		$section->addText('Course number (if available): '.$course_id, $standardStyle);
		$section->addText('Course title: '.$p_course_name, $standardStyle);
		$section->addText('When is the first semester and year the course will be offered? '.$proposedCourseInfo["p_first_offering"], 
		 	$standardStyle);
		$section->addTextBreak(1);

		//TODO: have the bullet style change from EMPTY to FILLED based on submission/approval status
		$section->addText('This course is (select one):', $standardStyle);
		$section->addListItem('A new course not yet approved by COI', 1, $standardStyle, $TYPE_BULLET_EMPTY, $paragraphStyle);
		$section->addListItem('A new course approved by COI, not yet offered', 1, $standardStyle, $TYPE_BULLET_EMPTY, $paragraphStyle);
		$section->addListItem('A current course undergoing major revisions', 1, $standardStyle, $TYPE_BULLET_EMPTY, $paragraphStyle);
		$section->addListItem('A current course undergoing minor revisions', 1, $standardStyle, $TYPE_BULLET_EMPTY, $paragraphStyle);
		$section->addTextBreak(1);

		//TODO: have the bullet style change from EMPTY to FILLED based on p_designation_scope
		$section->addText('This designation is being sought for:', $boldStyle);
		$section->addText('------------------------------------------------------------------'); //solid black line...isn't working
		$section->addListItem('All sections of this course', 1, $standardStyle, $TYPE_BULLET_EMPTY, $paragraphStyle);
		$section->addListItem('An instructor-specific section of this course (please list instructor(s))', 
			1, $standardStyle, $TYPE_BULLET_EMPTY, $paragraphStyle);
		$section->addTextBreak(2);

		$section->addText('Please provide the course description', $boldStyle);
		$section->addText('------------------------------------------------------------------'); //solid black line...isn't working
		$section->addText(htmlspecialchars($proposedCourseInfo["p_course_desc"]), $standardStyle);
		$section->addPageBreak();

		$rationaleTextRun = $section->createTextRun($paragraphStyle);
		$rationaleTextRun->addText('Please provide a brief rationale addressing how the proposed course aligns with the description of the ', $boldStyle);
		$rationaleTextRun->addText($perspectiveText, $secHeaderStyle);
		$rationaleTextRun->addText(' category:', $boldStyle);
		$section->addText(htmlspecialchars($proposedCourseInfo["rationale"]), $standardStyle);
		$section->addPageBreak();
		
		$assignTextRun = $section->createTextRun($paragraphStyle);
		$assignTextRun->addText('Courses in each General Education category need to include at least one assignment aligned ', $boldStyle);
		$assignTextRun->addText('to each learning outcome. What assignment(s) would enable students to reach the learning outcomes for the ', $boldStyle);
		$assignTextRun->addText($perspectiveText, $secHeaderStyle);
		$assignTextRun->addText(' category?', $boldStyle);
		$section->addText(htmlspecialchars($proposedCourseInfo["p_aligned_assignments"]), $standardStyle);
		$section->addPageBreak();

		$section->addText('Submit to: Sub-Committee', $boldStyle);
		$section->addListItem('Accepted (on to COI)', 1, $standardStyle, $TYPE_BULLET_EMPTY, $paragraphStyle);
		$section->addListItem('Revise and Resubmit (back to Faculty)', 1, $standardStyle, $TYPE_BULLET_EMPTY, $paragraphStyle);
		$section->addListItem('Rejected (back to Faculty)', 1, $standardStyle, $TYPE_BULLET_EMPTY, $paragraphStyle);
		$section->addTextBreak(1);

		$section->addText('Comments from Sub-Committee:', $boldStyle);
		if(is_null($proposedCourseInfo["p_feedback"] || $proposedCourseInfo["p_feedback"] == "None")){
			$section->addTextBreak(20);
		}
		else{
			$section->addText(htmlspecialchars($proposedCourseInfo["p_feedback"]), $standardStyle);
		}
		

	}
		
		$file = $filename.'.docx';
		header("Content-Description: File Transfer");
		header('Content-Disposition: attachment; filename="' . $file . '"');
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.
		˓→document');
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Expires: 0');
		$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$xmlWriter->save("php://output");
		
		
?>