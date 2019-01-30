<?php

	$proposal_id = $_GET['pid'];

	$q = "SELECT * FROM proposals WHERE id = '$proposal_id'";
	$r = mysqli_query($dbc, $q);
	$proposal = mysqli_fetch_assoc($r);
		
	if($proposal['type'] == "Change an Existing Course"){
		
		$course_id = $proposal['related_course_id'];
		$course_id_array = str_split($course_id);
		
		
		$course_subj_code = $course_id_array[0].$course_id_array[1];
		$course_num = $course_id_array[2].$course_id_array[3].$course_id_array[4];
		
		
		$query = "SELECT * FROM courses WHERE subj_code = '$course_subj_code' AND course_num = '$course_num'";
		$result = mysqli_query($dbc, $query);
		$course = mysqli_fetch_assoc($result); 				
		
		$filename = str_replace(' ', '_', $proposal['proposal_title']);
		$filename = str_replace(',', '', $filename);
		$filename = str_replace("'", '', $filename);		
						
		$department = $course['dept_desc'];
		$proposalType = $proposal['type'];
		
		$currentCourseTitle = $course['course_title'];
		$currentCourseDescription = $course['course_desc'];
		$currentCourseExtraDescription = $course['extra_desc'];
		$currentPrereqs = $course['prereqs'];
		$currentPostreqs = $course['postreqs'];
		$currentUnits = $course['units'];
		$currentCourseInfoHeader = 'CURRENT TITLE, COURSE DESCRIPTION, EXTRA COURSE DESCRIPTION, PREREQUISITES, POSTREQUISITES, AND UNITS:';
		
		$proposedCourseTitle = $proposal['proposed_course_title'];
		$proposedCourseDescription = $proposal['proposed_course_desc'];
		$proposedCourseExtraDescription = $proposal['proposed_extra_desc'];
		$proposedPrereqs = $proposal['proposed_prereqs'];
		$proposedPrereqs = $proposal['proposed_postreqs'];
		$proposedUnits = $proposal['units'];
		$proposedCourseInfoHeader = 'PROPOSED TITLE, COURSE DESCRIPTION, EXTRA COURSE DESCRIPTION, PREREQUISITES, POSTREQUISITES, AND UNITS:';
		
		$courseChangeDescription = $proposal['change_desc'];
		$rationale = $proposal['rationale'];
		$libraryImpact = $proposal['library_impact'];
		$techImpact = $proposal['tech_impact'];
		
		
		// New Word Document				
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
		$section->addText('Course Description: '.$currentCourseDescription, $standardStyle, $paragraphStyle);
		$section->addText('Additional Description: '.$currentCourseExtraDescription, $standardStyle, $paragraphStyle);
		$section->addText('Prerequisites: '.$currentPrereqs, $standardStyle, $paragraphStyle);
		$section->addText('Postrequisites: '.$currentPostreqs, $standardStyle, $paragraphStyle);
		$section->addText('Units: '.$currentUnits, $standardStyle, $paragraphStyle);
		$section->addText($proposedCourseInfoHeader, $boldCapsStyle, $paragraphStyle);
		$section->addText($proposedCourseTitle, $boldStyle, $paragraphStyle);
		$section->addText('Course Description: '.$proposedCourseDescription, $standardStyle, $paragraphStyle);
		$section->addText('Additional Description: '.$proposedCourseExtraDescription, $standardStyle, $paragraphStyle);
		$section->addText('Prerequisites: '.$proposedPrereqs, $standardStyle, $paragraphStyle);
		$section->addText('Postrequisites: '.$proposedPostreqs, $standardStyle, $paragraphStyle);
		$section->addText('Units: '.$proposedUnits, $standardStyle, $paragraphStyle);
		$section->addText('Rationale: '.$rationale, $standardStyle, $paragraphStyle);
		$section->addText('Library Impact: '.$libraryImpact, $standardStyle, $paragraphStyle);
		$section->addText('Tech Impact: '.$techImpact, $standardStyle, $paragraphStyle);
					
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
						
		
	}else if($proposal['type'] == 'Add a New Course'){
		
		$course_id = $proposal['related_course_id'];
		
		$department = $proposal['department'];
		$proposalType = $proposal['type'];
		$proposalTitle = $proposal['proposal_title'];			
		
		$filename = str_replace(' ', '_', $proposal['proposal_title']);
		$filename = str_replace(',', '', $filename);
		$filename = str_replace("'", '', $filename);		
		
		$proposedCourseTitle = $proposal['proposed_course_title'];
		$proposedCourseDescription = $proposal['proposed_course_desc'];
		$proposedCourseExtraDescription = $proposal['proposed_extra_desc'];
		$proposedPrereqs = $proposal['proposed_prereqs'];
		$proposedPrereqs = $proposal['proposed_postreqs'];
		$proposedUnits = $proposal['proposed_units'];
		
		$courseChangeDescription = $proposal['change_desc'];
		$rationale = $proposal['rationale'];
		$libraryImpact = $proposal['lib_impact'];
		$techImpact = $proposal['tech_impact'];
		
		$a_1 = "The Department of ".$department." proposes a new course, ";
		$a_2 = $course_id.":".$proposedCourseTitle;
		$a_3 = ", with the approval of the (__division__) Executive Committee and the Committee on Instruction.";
		
		$b_1 = "Add: ".$course_id." - ".$proposedCourseTitle.". ";
		$b_2 = $proposedCourseDescription;
		$b_3 = " Prerequisite: ";
		$b_4 = $proposedPrereqs.". ".$proposedUnits.".";
		
		$c_1 = "Rationale: ";
		$c_2 = $rationale;
		
		$d_1 = "Library Impact: ";
		$d_2 = $libraryImpact;
		
		$e_1 = "Technology Impact: ";
		$e_2 = $techImpact;
		
		
		// New Word Document				
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
		
		$italicStyle = 'italic';
		$phpWord->addFontStyle($italicStyle, array('italic' => true, 'size' => 12, 'name' => 'Calibri'));
		
		$section->addText($department, $deptHeaderStyle, $paragraphStyle);
		$section->addText('A: '.$proposalType, $boldStyle, $paragraphStyle);
		
		$textrunA = $section->createTextRun();
		$textrunA->addText($a_1, $standardStyle);
		$textrunA->addText($a_2, $boldStyle);
		$textrunA->addText($a_3, $standardStyle);
		
		$textrunB = $section->createTextRun();
		$textrunB->addText($b_1, $boldStyle);
		$textrunB->addText($b_2, $standardStyle);
		$textrunB->addText($b_3, $italicStyle);
		$textrunB->addText($b_4, $standardStyle);
				
		$textrunC = $section->createTextRun();
		$textrunC->addText($c_1, $boldStyle);
		$textrunC->addText($c_2, $standardStyle);
		
		$textrunD = $section->createTextRun();
		$textrunD->addText($d_1, $boldStyle);
		$textrunD->addText($d_2, $standardStyle);
		
		$textrunE = $section->createTextRun();
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
		
	}else{
		$filename = "Not_yet";
	}
		
		
		
?>