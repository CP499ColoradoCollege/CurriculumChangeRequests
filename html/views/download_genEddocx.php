<?php
	require_once 'vendor/autoload.php';

	//DEBUG
	$msg = "Reached beginning of download_genEddocx.php";
	error_log(print_r($msg, TRUE)); 
	
	$proposal_id = $_GET['pid'];
	$proposal = new Proposal($dbc);
	$proposal = $proposal->fetchProposalFromID($proposal_id);
	
	if($proposal == false){
		//DEBUG
		$msg = "Hit abort condition in download_genEddocx.php; no proposal was found";
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
		
		$proposedCourseInfo = array("p_course_name" => $p_course_name, "p_course_desc" => $proposal->p_course_desc, 
									"p_course_extra_desc" => $proposal->p_extra_details, "p_course_prereqs" => $proposal->p_prereqs, 
									"p_course_units" => $proposal->p_units, "rationale" => $proposal->rationale, 
									"lib_impact" => $proposal->lib_impact, "tech_impact" => $proposal->tech_impact,
									"p_info_header" => $proposedCriteriaInfoHeader, "type" => $proposal->type, 
									"p_aligned_assignments" => $proposal->$p_aligned_assignments, "p_first_offering" => $proposal->$p_first_offering, 
									"p_course_status" => $proposal->$p_course_status, "p_designation_scope" => $proposal->$p_designation_scope, 
									"p_designation_prof" => $proposal->$p_designation_prof, "p_feedback" => $proposal->$p_feedback, 
									"department" => $department, "division" => $division, "p_perspective" => $proposal->$p_perspective);						
		
		//DEBUG
		$n = 1;
		foreach($proposedCourseInfo as $info){
			$msg = "Thing ".$n." of 19: ".$info;
			error_log(print_r($msg, TRUE));
			$n ++;
		}
		//end debug

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
		$phpWord->addFontStyle($standardStyle, array( 'size' => 12, 'name' => 'Calibri'));

		//new proposal set text NEEDS TO HAVE CONDITIONS DEPENDING ON WHAT GENED WE'RE USING
		$formDesc = "The following form should be used by Colorado College departments and/or faculty to submit courses for ";
		$genEdDesc = "No description set";
		$curricularGoals = array("No curricular goals defined"); //each entry is a bullet point
		$learningOutcomes = array("No learning outcomes defined"); //each entry is a bullet point
		$learningOutcomesDesc = "As a result of taking a course in ".$proposedCourseInfo["p_perspective"]." students will be able to:";

		switch ($proposedCourseInfo["p_perspective"]) {
			case "Analysis & Interpretation of Meaning":
				$genEdDesc = "Analysis & Interpretation of Meaning description not transcribed.";
				break;
			case "Creative Process":
				$genEdDesc = "Creative Process description not transcribed.";
			  	break;
			case "Equity & Power - Global":
				$genEdDesc = "Engaging questions of equity and power, in both U.S. and global contexts, 
					is essential to a liberal arts education. Courses that fulfill this requirement expect 
					students to examine how systems of power create and shape notions of self, relations with others, 
					access to resources and opportunities, and the production of knowledge. In these courses, 
					students develop analytical and interpretive tools and/or reflective habits and interpersonal 
					skills for thinking critically about how inequities are produced, reinforced, experienced, and resisted. 
					\nEquity and Power courses may be taken as part of the Critical Learning Across the Liberal Arts categories.";
				$curricularGoals = array("Students will gain an understanding of social, political, cultural, epistemological 
					and/or economic forces that have produced and/or now sustain multiple forms of inequalities and their intersections;", 
					"Students will identify, analyze, and evaluate the ways in which individuals and groups have unequal experiences, 
					social positions, opportunities or outcomes based on the intersections of race, indigeneity, caste or class, 
					citizenship, gender, gender identity, sexuality, size, (dis)ability, religious practices, belief systems, or 
					other dimensions of difference;", "Students will seek to identify and challenge their implicit biases and 
					assumptions while learning to participate respectfully and productively in potentially uncomfortable discussions 
					about equity and power and their position in relationship to others.");
				$learningOutcomes = array("Describe the relationship between power and inequality;", "Describe one or more ways that 
					a form of inequality, such as racism, is reproduced over time;", "•	Describe how the social identity, 
					historical context, or cultural context of a writer, artists, scientist, or other worker influences the work they do;", 
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
				$genEdDesc = "Default case. General Education requirement".$proposedCourseInfo["p_perspective"]."does not match case labels.";
		  }
		//DEBUG
		$msg = "Got past switch statement";
		error_log(print_r($msg, TRUE)); 
		
		//everything before "Submitter Information"
		//$section->addText('Application for consideration for the '.$proposedCourseInfo["p_perspective"].' category', 
			//$appHeaderStyle, $paragraphStyle);
		$textRunZ = $section->createTextRun($paragraphStyle);
		$textRunZ->addText($formDesc, $standardStyle);
		$perspectivePlusPeriod = "".$proposedCourseInfo["p_perspective"].".";
		$textRunZ->addText($perspectivePlusPeriod, $genEdStyle);

		$section->addText('Curricular goals', $secHeaderStyle, $paragraphStyle);
		foreach ($curricularGoals as $goal){
			$section->addListItem($goal, $standardStyle); //one for each bullet?
			//cut from after goal: 0, $TYPE_BULLET_FILLED, $paragraphStyle
		}
		$section->addTextBreak(2);

		$section->addText('Learning outcomes', $secHeaderStyle, $paragraphStyle);
		$section->addText($learningOutcomesDesc);
		foreach ($learningOutcomes as $outcome){
			$section->addListItem($outcome, $standardStyle); //one for each bullet?
			//cut from after goal: 0, $TYPE_BULLET_FILLED, $paragraphStyle
		}
		$section->addTextBreak(3);

		//for hollow bulleted lists: TYPE_BULLET_EMPTY ?

		//DEBUG
		$msg = "Got past final text formatting";
		error_log(print_r($msg, TRUE)); 


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
	}

?>