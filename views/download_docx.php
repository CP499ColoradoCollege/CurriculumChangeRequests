<?php
	require_once 'vendor/autoload.php';
	
	// ini_set('display_errors', 'On');
	// error_reporting(E_ALL);
	$proposal_id = $_GET['pid'];
	
	$proposal = new Proposal($dbc);
	$proposal = $proposal->fetchProposalFromID($proposal_id);

	$filename = getFilenameForDownload($proposal);
	$division = $user->getDivision($department);

	

	if($proposal->type == "Change an Existing Course"){
		
		$course_id = $proposal->related_course_id;
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($course_id);		
		$criteriaInfoHeader = getInfoHeader($proposal->criteria, "");
		$currentCriteriaInfoHeader = getInfoHeader($proposal->criteria, "Current");
		$department = str_replace("&", "and", $course->dept_desc);
		$deptProposalHeader = getDepartmentProposalHeader($course, $criteriaInfoHeader, $department);
		$c_course_name = "$course->subj_code $course->course_num: $course->course_title";//produces something like "CP122: Introduction to Computer Science"
		
		$currentCourseInfo = array("c_course_name" => $c_course_name, "c_course_desc" => $course->course_desc, 
									"c_course_extra_desc" => $course->extra_desc, "c_course_prereqs" => $course->prereqs, 
									"c_course_units" => $course->units, "c_info_header" => $currentCriteriaInfoHeader, 
									"deptProposalHeader" => $deptProposalHeader, "department"=>$department);

		$proposal = checkChangedAndSame($proposal, $course);
		
		$proposedCriteriaInfoHeader = getInfoHeader($proposal->criteria, "Proposed");
		$p_course_name = "$course->subj_code $course->course_num: $proposal->p_course_title"; //produces something like "CP122: Introduction to Computer Science"
		
		$proposedCourseInfo = array("p_course_name" => $p_course_name , "p_course_desc" => $proposal->p_course_desc, 
									"p_course_extra_desc" => $proposal->p_extra_desc, "p_course_prereqs" => $proposal->p_prereqs, 
									"p_course_units" => $proposal->p_units, "rationale" => $proposal->rationale, 
									"lib_impact" => $proposal->lib_impact, "tech_impact" =>  $proposal->tech_impact,
									"p_info_header" => $proposedCriteriaInfoHeader, "type" => $proposal->type);
		
		generateDoc($currentCourseInfo, $proposedCourseInfo, $proposal);
						
	}else if($proposal->type == 'Add a New Course'){
		$course_id = $proposal->related_course_id;
		$division = $user->getDivision($proposal->department);
		$department = str_replace("&", "and", $proposal->department);
	
		$deptProposalHeader = getDepartmentProposalHeader($course, $criteriaInfoHeader, $department);

		$p_course_name = "$proposal->p_course_id: $proposal->p_course_title"; //produces something like "CP122: Introduction to Computer Science"
		
		$proposedCourseInfo = array("p_course_name" => $p_course_name , "p_course_desc" => $proposal->p_course_desc, 
									"p_course_extra_desc" => $proposal->p_extra_desc, "p_course_prereqs" => $proposal->p_prereqs, 
									"p_course_units" => $proposal->p_units, "rationale" => $proposal->rationale, 
									"lib_impact" => $proposal->lib_impact, "tech_impact" =>  $proposal->tech_impact,
									"p_info_header" => $proposedCriteriaInfoHeader, "type" => $proposal->type,
									"department" => $department, "division" => $division);
		
		generateAddCourseDoc($proposedCourseInfo, $proposal);
		
	}else{
		$filename = "Not_yet";
	}

	function getDepartmentProposalHeader($course, $courseChangeInfoHeader, $department ){
		
		$deptProposalHeader = "The department of $department proposes to change the$courseChangeInfoHeader for $course->subj_code $course->course_num: $course->course_title, with the approval of the $course->divs_desc Executive Committee and the Committee on Instruction.";

		return $deptProposalHeader;
	}
	
	function getInfoHeader($criteria, $current_or_proposed){
		$headerString = $current_or_proposed;
		$headerString.=" ";
		$critArray = str_split($criteria);
		for( $i = 0; $i<count($critArray); $i++ ){
			switch($critArray[$i]){
				case 1:
					$headerString.="Department-";
					break;
				case 2:
					$headerString.="Course ID-";
					break;
				case 3:
					$headerString.="Course Title-";
					break;
				case 4:
					$headerString.="Course Description-";
					break;
				case 5:
					$headerString.="Prerequisites-";
					break;
				case 6:
					$headerString.="Units-";
					break;
			}
		}
		$punctuatedHeaderString = addPunctuation($headerString);
		return $punctuatedHeaderString;
	}
	function addPunctuation($headerString){
		$individual_criteria = explode("-", $headerString);
		if(count($individual_criteria)==2){
			return $individual_criteria[1];
		}else{
			for( $i = 0; $i<count($individual_criteria)-2; $i++ ) {
				$individual_criteria[$i] .= ", ";
			}
			$individual_criteria[count($individual_criteria)-3].= "and ";
		}
		$punctuatedHeaderString = implode($individual_criteria);
		return $punctuatedHeaderString;

	}

	function checkChangedAndSame($proposal, $course){
		if ($proposal->p_course_title == ""){
			$proposal->p_course_title = $course->course_title;
		}
		if ($proposal->p_course_desc == ""){
			$proposal->p_course_desc = $course->course_desc;
		}
		if ($proposal->p_prereqs == ""){
			$proposal->p_prereqs = $course->prereqs;
		}
		if ($proposal->p_extra_desc == ""){
			$proposal->p_extra_desc = $course->extra_desc;
		}
		if ($proposal->p_units == ""){
			$proposal->p_units = $course->units;
		}
		return $proposal;
	}
	function getFilenameForDownload($proposal){
		$filename = str_replace(' ', '_', $proposal->proposal_title);
		$filename = str_replace(',', '', $filename);
		$filename = str_replace("'", '', $filename);	//revise - this should strip ALL extra characters
		return $filename;
	}

	function generateDoc($currentCourseInfo, $proposedCourseInfo, $proposal){	
		$filledPhpWord = addTextToDoc($currentCourseInfo, $proposedCourseInfo);
		serveFile($filledPhpWord, $proposal);
	}

	function generateAddCourseDoc($proposedCourseInfo, $proposal){
		$filledPhpWord = addTextToAddCourseDoc($proposedCourseInfo);
		serveFile($filledPhpWord, $proposal);
	}

	function addTextToAddCourseDoc($proposedCourseInfo){
		$languageEnGb = new PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::EN_GB);

		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getSettings()->setThemeFontLang($languageEnGb);

		$section = $phpWord->addSection();
		$paragraphStyle = 'pStyle';

		$phpWord->addParagraphStyle($paragraphStyle, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 280));
		
		$phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));
		
		$deptHeaderStyle = 'deptHeader';
		$phpWord->addFontStyle($deptHeaderStyle, array('bold' => true, 'size' => 14, 'name' => 'Calibri'));
		
		$boldCapsStyle = 'boldCaps';
		$phpWord->addFontStyle($boldCapsStyle, array('bold' => true, 'allCaps' => true, 'size' => 12, 'name' => 'Calibri'));
		
		$boldStyle = 'bold';
		$phpWord->addFontStyle($boldStyle, array('bold' => true, 'size' => 12, 'name' => 'Calibri'));
		
		$standardStyle = 'standard';
		$phpWord->addFontStyle($standardStyle, array( 'size' => 12, 'name' => 'Calibri'));
		
		$italicStyle = 'italic';
		$phpWord->addFontStyle($italicStyle, array('italic' => true, 'size' => 12, 'name' => 'Calibri'));

		$a_1 = "The Department of ".$proposedCourseInfo["department"]." proposes a new course, ";
		$a_2 = $proposedCourseInfo["p_course_name"];
		$a_3 = ", with the approval of the ".$proposedCourseInfo["division"]." Executive Committee and the Committee on Instruction.";
		
		$b_1 = "Add: ";
		$b_2 = "".$proposedCourseInfo["p_course_name"].".";
		$b_3 = " ".$proposedCourseInfo["p_course_desc"];

		$f_prereq1 = "Prerequisite: ";
		$f_prereq2 = $proposedCourseInfo["p_course_prereqs"];

		$f_units1 = "Units: ";
		$f_units2 = $proposedCourseInfo["p_course_units"];
		
		$c_1 = "Rationale: ";
		$c_2 = $proposedCourseInfo["rationale"];
		
		$d_1 = "Library Impact: ";
		$d_2 = $proposedCourseInfo["lib_impact"];
		
		$e_1 = "Technology Impact: ";
		$e_2 = $proposedCourseInfo["tech_impact"];
		
		$section->addText($proposedCourseInfo["department"], $deptHeaderStyle, $paragraphStyle);
		$section->addText('1) '.$proposedCourseInfo["type"], $boldStyle, $paragraphStyle);
		
		$textrunA = $section->createTextRun($paragraphStyle);
		$textrunA->addText($a_1, $standardStyle);
		$textrunA->addText($a_2, $boldStyle);
		$textrunA->addText($a_3, $standardStyle);
		
		$textrunB = $section->createTextRun();
		$textrunB->addText($b_1, $standardStyle);
		$textrunB->addText($b_2, $boldStyle);
		$textrunB->addText($b_3, $standardStyle);

		$textrun_prereq = $section->createTextRun();
		$textrun_prereq->addText($f_prereq1, $italicStyle);
		$textrun_prereq->addText($f_prereq2, $standardStyle);

		$textrun_units = $section->createTextRun();
		$textrun_units->addText($f_units1, $italicStyle);
		$textrun_units->addText($f_units2, $standardStyle);

		$textrunC = $section->createTextRun($paragraphStyle);
		$textrunC->addText($c_1, $boldStyle);
		$textrunC->addText($c_2, $standardStyle);
		
		$textrunD = $section->createTextRun($paragraphStyle);
		$textrunD->addText($d_1, $boldStyle);
		$textrunD->addText($d_2, $standardStyle);
		
		$textrunE = $section->createTextRun($paragraphStyle);
		$textrunE->addText($e_1, $boldStyle);
		$textrunE->addText($e_2, $standardStyle);

		return $phpWord;
	}
	function addTextToDoc($currentCourseInfo, $proposedCourseInfo){
		$languageEnGb = new PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::EN_GB);

		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getSettings()->setThemeFontLang($languageEnGb);

		$section = $phpWord->addSection();
		$paragraphStyle = 'pStyle';

		$phpWord->addParagraphStyle($paragraphStyle, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 280));
		
		$phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));
		
		$deptHeaderStyle = 'deptHeader';
		$phpWord->addFontStyle($deptHeaderStyle, array('bold' => true, 'size' => 14, 'name' => 'Calibri'));
		
		$boldCapsStyle = 'boldCaps';
		$phpWord->addFontStyle($boldCapsStyle, array('bold' => true, 'allCaps' => true, 'size' => 12, 'name' => 'Calibri'));
		
		$boldStyle = 'bold';
		$phpWord->addFontStyle($boldStyle, array('bold' => true, 'size' => 12, 'name' => 'Calibri'));
		
		$standardStyle = 'standard';
		$phpWord->addFontStyle($standardStyle, array( 'size' => 12, 'name' => 'Calibri'));
		
		$italicStyle = 'italic';
		$phpWord->addFontStyle($italicStyle, array('italic' => true, 'size' => 12, 'name' => 'Calibri'));

		$section->addText("Department of ".$currentCourseInfo["department"], $deptHeaderStyle, $paragraphStyle);
		$section->addText('A. '.$proposedCourseInfo["type"], $boldCapsStyle, $paragraphStyle);
		$section->addText('1) '.$currentCourseInfo["c_course_name"], $boldStyle, $paragraphStyle);
		$section->addText(''.$currentCourseInfo["c_info_header"], $boldCapsStyle, $paragraphStyle);
		$section->addText(''.$currentCourseInfo["deptProposalHeader"], $standardStyle, $paragraphStyle);
		$section->addText(''.$currentCourseInfo["c_course_name"], $boldStyle, $paragraphStyle);
		$section->addText('Course Description: '.$currentCourseInfo["c_course_desc"], $standardStyle, $paragraphStyle);
		$section->addText('Additional Description: '.$currentCourseInfo["c_course_extra_desc"], $standardStyle, $paragraphStyle);
		$section->addText('Prerequisites: '.$currentCourseInfo["c_course_prereqs"], $standardStyle, $paragraphStyle);
		$section->addText('Units: '.$currentCourseInfo["c_course_units"], $standardStyle, $paragraphStyle);
		
		$section->addText($proposedCourseInfo["p_info_header"], $boldCapsStyle, $paragraphStyle);
		$section->addText(''.$proposedCourseInfo["p_course_name"], $boldStyle, $paragraphStyle);
		$section->addText('Course Description: '.$proposedCourseInfo["p_course_desc"], $standardStyle, $paragraphStyle);
		$section->addText('Additional Description: '.$proposedCourseInfo["p_course_extra_desc"], $standardStyle, $paragraphStyle);
		$section->addText('Prerequisites: '.$proposedCourseInfo["p_course_prereqs"], $standardStyle, $paragraphStyle);
		$section->addText('Units: '.$proposedCourseInfo["p_course_units"], $standardStyle, $paragraphStyle);
		$section->addText('Rationale: '.$proposedCourseInfo["rationale"], $standardStyle, $paragraphStyle);
		$section->addText('Library Impact: '.$proposedCourseInfo["lib_impact"], $standardStyle, $paragraphStyle);
		$section->addText('Tech Impact: '.$proposedCourseInfo["tech_impact"], $standardStyle, $paragraphStyle);
		return $phpWord;
	}
	
	function serveFile($phpWord, $proposal){
		$filename = str_replace(' ', '_', $proposal->proposal_title);
		$filename = str_replace(',', '', $filename);
		$filename = str_replace("'", '', $filename);	//revise - this should strip ALL extra characters
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