<?php




function set_up_download($proposal){
	
	$department = $proposal['department'];
	$proposalType = $proposal['type'];
	
	$currentCourseTitle = $proposal['current_course_title'];
	$currentCourseDescription = $proposal['current_course_description'];
	$currentPrereqs = $proposal['current_prerequisites'];
	$currentCourseInfoHeader = 'CURRENT TITLE, PRE-REQUISITES, AND DESCRIPTION:';
	
	$proposedCourseTitle = $proposal['proposed_course_title'];
	$proposedCourseDescription = $proposal['proposed_course_description'];
	$proposedPrereqs = $proposal['proposed_prerequisites'];
	$proposedCourseInfoHeader = 'PROPOSED TITLE, PRE-REQUISITES, AND DESCRIPTION:';
	
	$courseChangeDescription = $proposal['change_description'];
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
	echo write($phpWord, "test2", $writers);
	
	echo $proposal['id'];
}



?>
