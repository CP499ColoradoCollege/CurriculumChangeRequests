<?php
use PhpOffice\PhpWord\Style\Font;

include_once 'Sample_Header.php';

$department = 'Department of Mathematics and Computer Science';
$proposalType = 'proposal to change a course';
$currentCourseTitle = 'CP 499: Senior Project';
$courseChangeDescription = 'The department of Mathematics and Computer Science proposes to change the title, description, and pre-requisites for CP 499: Senior Project, with the approval of the Natural Science Executive Committee and the Committee on Instruction.';
$currentCourseInfoHeader = 'CURRENT TITLE, PRE-REQUISITES, AND DESCRIPTION:';
$currentCourseDescription = 'Software project in computer science approved by the student’s advisor. Students design, document, implement, and test a long-term software project. Required for majors in computer science.';
$currentPrereqs = 'Computer science major, senior standing. Computer Science 222, Computer Science 274, Computer Science 275.';
$proposedCourseInfoHeader = 'PROPOSED TITLE, PRE-REQUISITES, AND DESCRIPTION:';
$proposedCourseTitle = 'CP499 – Team Software Project.';
$proposedCourseDescription = 'Students work in teams to design, document, implement, and test a software project. Required for majors in computer science.';
$proposedPrereqs = 'Computer science major, consent of instructor, CP 274, CP275.';
$rationale = 'The revised course will meet our goals of having students work on projects in teams that last longer than the assignments typically offered during their usual coursework but will avoid some of the issues involved in a one-year capstone. In particular, this will allow students to study abroad during their senior year and, if desired, take the course earlier in the curriculum so that the experience gained will help them on summer internships. It will also support students who cannot be on campus for all of their senior year for other reasons and will eliminate conflicts with other coursework. ';
$libraryImpact = 'None';
$techImpact = 'None';


// New Word Document
echo date('H:i:s') , ' Create new PhpWord object' , EOL;

$languageEnGb = new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::EN_GB);

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
echo write($phpWord, basename(__FILE__, '.php'), $writers);
if (!CLI) {
    include_once 'Sample_Footer.php';
}
