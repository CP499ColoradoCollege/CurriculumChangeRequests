<?php
	require_once 'vendor/autoload.php';
	
	$proposal_id = $_GET['pid'];
	$proposal = new Proposal($dbc);
	$proposal = $proposal->fetchProposalFromID($proposal_id);
	
	if($proposal == false){
		header("Location: home");
	}
	
	$filename = str_replace(' ', '_', $proposal->proposal_title);
	$filename = str_replace(',', '', $filename);
	$filename = str_replace("'", '', $filename);

	$division = $user->getDivision($proposal->department);
	
	if($proposal->type == "Add a New Course"){
		
		$course_id = $proposal->related_course_id;
		$department = str_replace("&", "and", $proposal->department);	
			
		$proposedCriteriaInfoHeader = "Proposed: ";
		$p_course_name = "$proposal->p_course_id: $proposal->p_course_title";		
		$proposedCourseInfo = array("p_course_name" => $p_course_name , "p_course_desc" => $proposal->p_course_desc, 
									"p_course_extra_desc" => $proposal->p_extra_details, "p_course_prereqs" => $proposal->p_prereqs, 
									"p_course_units" => $proposal->p_units, "rationale" => $proposal->rationale, 
									"lib_impact" => $proposal->lib_impact, "tech_impact" => $proposal->tech_impact,
									"p_info_header" => $proposedCriteriaInfoHeader, "type" => $proposal->type,
									"department" => $department, "division" => $division);
									
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
		
		$section->addText('Department of '.$proposedCourseInfo["department"], $deptHeaderStyle, $paragraphStyle);
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
		
	}else if($proposal->type == "Change an Existing Course"){	//this needs to dynamically understand what the proposal wants to change, and ONLY display relevant info
		
		$course_id = $proposal->related_course_id;
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($course_id);	
		$criteria = $proposal->criteria;	//237
		
		$headerString = "";
		$headerString.=" ";
		$critArray = str_split($criteria);
		for( $i = 0; $i<count($critArray); $i += 1){
			switch($critArray[$i]){
				case 1:
					$headerString.="Course ID-";
					break;
				case 2:
					$headerString.="Course Title-";
					break;
				case 3:
					$headerString.="Course Description-";
					break;
				case 4:
					$headerString.="Extra Details-";
					break;
				case 5:
					$headerString.="Enrollment Limit-";
					break;
				case 6:
					$headerString.="Prerequisites-";
					break;
				case 7:
					$headerString.="Units-";
					break;
			}
		}
		
		$individual_criteria = explode("-", $headerString);
		if(count($individual_criteria)==2){
			return $individual_criteria[0];
		}else{
			for( $i = 0; $i<count($individual_criteria)-2; $i++ ) {
				$individual_criteria[$i] .= ", ";
			}
			$individual_criteria[count($individual_criteria)-3].= "and ";
		}
		$criteriaInfoHeader = implode($individual_criteria);
				
		$headerString = "Current";
		$headerString.=" ";
		$critArray = str_split($criteria);
		for( $i = 0; $i<count($critArray); $i += 1){
			switch($critArray[$i]){
				case 1:
					$headerString.="Course ID-";
					break;
				case 2:
					$headerString.="Course Title-";
					break;
				case 3:
					$headerString.="Course Description-";
					break;
				case 4:
					$headerString.="Extra Details-";
					break;
				case 5:
					$headerString.="Enrollment Limit-";
					break;
				case 6:
					$headerString.="Prerequisites-";
					break;
				case 7:
					$headerString.="Units-";
					break;
			}
		}
		
		$individual_criteria = explode("-", $headerString);
		if(count($individual_criteria)==2){
			return $individual_criteria[0];
		}else{
			for( $i = 0; $i<count($individual_criteria)-2; $i++ ) {
				$individual_criteria[$i] .= ", ";
			}
			$individual_criteria[count($individual_criteria)-3].= "and ";
		}
		$currentCriteriaInfoHeader = implode($individual_criteria);	//THIS IS WRONG!!! produces incorrect string
		
		//criteria = 237
		
		
		$department = str_replace("&", "and", $course->dept_desc);
				
		$deptProposalHeader1 = "The department of $department proposes to change the$criteriaInfoHeader for ";
		$course_title = "$course->subj_code $course->course_num: $course->course_title";
		$deptProposalHeader2 = ", with the approval of the $course->divs_desc Executive Committee and the Committee on Instruction.";
		
		$c_course_name = "$course->subj_code $course->course_num: $course->course_title";
		
		$currentCourseInfo = array("c_course_name" => $c_course_name, "c_course_desc" => $course->course_desc, 
									"c_course_extra_desc" => $course->extra_details, "c_course_prereqs" => $course->prereqs, 
									"c_course_units" => $course->units, "c_info_header" => $currentCriteriaInfoHeader, 
									"deptProposalHeader" => $deptProposalHeader, "department"=>$department);

		if ($proposal->p_course_title == ""){
			$proposal->p_course_title = $course->course_title;
		}
		if ($proposal->p_course_desc == ""){
			$proposal->p_course_desc = $course->course_desc;
		}
		if ($proposal->p_extra_details == ""){
			$proposal->p_extra_details = $course->extra_details;
		}
		if ($proposal->p_limit == ""){
			$proposal->p_limit = $course->enrollment_limit;
		}
		if ($proposal->p_prereqs == ""){
			$proposal->p_prereqs = $course->prereqs;
		}
		if ($proposal->p_units == ""){
			$proposal->p_units = $course->units;
		}

				
		$headerString = "Proposed";
		$headerString.=" ";
		$critArray = str_split($criteria);
		for( $i = 0; $i<count($critArray); $i += 1){
			switch($critArray[$i]){
				case 1:
					$headerString.="Course ID-";
					break;
				case 2:
					$headerString.="Course Title-";
					break;
				case 3:
					$headerString.="Course Description-";
					break;
				case 4:
					$headerString.="Extra Details-";
					break;
				case 5:
					$headerString.="Enrollment Limit-";
					break;
				case 6:
					$headerString.="Prerequisites-";
					break;
				case 7:
					$headerString.="Units-";
					break;
			}
		}
		
		$individual_criteria = explode("-", $headerString);
		if(count($individual_criteria)==2){
			return $individual_criteria[0];
		}else{
			for( $i = 0; $i<count($individual_criteria)-2; $i++ ) {
				$individual_criteria[$i] .= ", ";
			}
			$individual_criteria[count($individual_criteria)-3].= "and ";
		}
		$proposedCriteriaInfoHeader = implode($individual_criteria);
		
		
		$p_course_name = "$course->subj_code $course->course_num: $proposal->p_course_title";
		
		$proposedCourseInfo = array("p_course_name" => $p_course_name , "p_course_desc" => $proposal->p_course_desc, 
									"p_course_extra_desc" => $proposal->p_extra_details, "p_course_prereqs" => $proposal->p_prereqs, 
									"p_course_units" => $proposal->p_units, "rationale" => $proposal->rationale, 
									"lib_impact" => $proposal->lib_impact, "tech_impact" =>  $proposal->tech_impact,
									"p_info_header" => $proposedCriteriaInfoHeader, "type" => $proposal->type);
		
				
		//start
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
		$section->addText('A) '.$proposedCourseInfo["type"], $boldCapsStyle, $paragraphStyle);
		
		$textRun = $section->createTextRun($paragraphStyle);
		$textRun->addText('1) ', $standardStyle);
		$textRun->addText($currentCourseInfo["c_course_name"], $boldStyle);
		
		$textrunA = $section->createTextRun();
		$textrunA->addText(''.$deptProposalHeader1, $standardStyle);
		$textrunA->addText(''.$course_title, $boldStyle);
		$textrunA->addText(''.$deptProposalHeader2, $standardStyle);
		
		$section->addText(''.$currentCourseInfo["c_info_header"].':', $boldCapsStyle, $paragraphStyle);
		$section->addText(''.$currentCourseInfo["c_course_name"], $boldStyle, $paragraphStyle);
		$section->addText('Course Description: '.$currentCourseInfo["c_course_desc"], $standardStyle, $paragraphStyle);
		//$section->addText('Additional Description: '.$course->extra_details, $standardStyle, $paragraphStyle);
		
		$textRunB = $section->createTextRun();
		$textRunB->addText('Prerequisite: ', $italicStyle);
		$textRunB->addText($currentCourseInfo["c_course_prereqs"], $standardStyle);
		
		$textRunB1 = $section->createTextRun();
		$textRunB1->addText('Units: ', $italicStyle);
		$textRunB1->addText($currentCourseInfo["c_course_units"], $standardStyle);
		
		$section->addText($proposedCourseInfo["p_info_header"].':', $boldCapsStyle, $paragraphStyle);
		$section->addText(''.$proposedCourseInfo["p_course_name"], $boldStyle, $paragraphStyle);
		$section->addText('Course Description: '.$proposedCourseInfo["p_course_desc"], $standardStyle, $paragraphStyle);
		//$section->addText('Additional Description: '.$proposal->p_extra_details, $standardStyle, $paragraphStyle);
		
		$textRunC = $section->createTextRun();
		$textRunC->addText('Prerequisite: ', $italicStyle);
		$textRunC->addText($proposedCourseInfo["p_course_prereqs"], $standardStyle);
		
		$textRunC1 = $section->createTextRun();
		$textRunC1->addText('Units: ', $italicStyle);
		$textRunC1->addText($proposedCourseInfo["p_course_units"], $standardStyle);
				
		$textRunD = $section->createTextRun();
		$textRunD->addText('Rationale: ', $boldStyle);
		$textRunD->addText($proposedCourseInfo["rationale"], $standardStyle);
		
		$textRunE = $section->createTextRun();
		$textRunE->addText('Library Impact: ', $boldStyle);
		$textRunE->addText($proposedCourseInfo["lib_impact"], $standardStyle);
		
		$textRunF = $section->createTextRun();
		$textRunF->addText('Technology Impact: ', $boldStyle);
		$textRunF->addText($proposedCourseInfo["tech_impact"], $standardStyle);

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
	}else if($proposal->type == "Remove an Existing Course"){
		
		//this doc should probably look similar to the add new course doc
		
		$course_id = $proposal->related_course_id;
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($course_id);	
		
		$department = str_replace("&", "and", $proposal->department);	
		
		
		//course id and title, description, prerequisites, units, rationale, lib impact, tech impact
		
		$course_name = "$course_id: $course->course_title";	
		$course_desc = $course->course_desc;
		$course_prereqs = $course->prereqs;
		$course_units = $course->units;
		$rationale = $proposal->rationale;
		$lib_impact = $proposal->lib_impact;
		$tech_impact = $proposal->tech_impact;
		
									
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
		
		$a_1 = "The Department of ".$department." proposes to remove an existing course, ";
		$a_2 = $course_name;
		$a_3 = ", with the approval of the ".$division." Executive Committee and the Committee on Instruction.";
		$b_1 = "Remove: ";
		$b_2 = "".$course_name.".";
		$b_3 = " ".$course_desc;
		$f_prereq1 = "Prerequisite: ";
		$f_prereq2 = $course_prereqs;
		$f_units1 = "Units: ";
		$f_units2 = $course_units;
		$c_1 = "Rationale: ";
		$c_2 = $rationale;
		$d_1 = "Library Impact: ";
		$d_2 = $lib_impact;
		$e_1 = "Technology Impact: ";
		$e_2 = $tech_impact;
		
		$section->addText('Department of '.$department, $deptHeaderStyle, $paragraphStyle);
		$section->addText('1) Remove an Existing Course', $boldStyle, $paragraphStyle);
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