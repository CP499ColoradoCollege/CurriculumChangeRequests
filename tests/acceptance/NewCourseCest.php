<?php

/*
 * This is a Test class for testing the site's Add New Course Proposal page and form functionality
 */
 
class NewCourseCest
{
	/*
	 * Tests that the user can navigate from the Home page to the Add New Course Proposal page
	 */
	public function newCourseProposalPageWorks(AcceptanceTester $I)
    {
		$I->amOnPage('/home');
		$I->click('New Proposal');
		$I->amOnPage('/new_proposal');
		$I->see('New Proposal');  
		$I->selectOption('type','1');
		$I->click('Begin Proposal');
		$I->amOnPage('/new_course_proposal');
		$I->see('Add New Course Proposal');  
	}
	
	/*
	 * Tests that the Add New Course Proposal form loads, that saving proposal correctly redirects the user,
	 * and that the new proposal is added to user's Home page after saving the proposal
	 */
	public function newCourseProposalFormWorks(AcceptanceTester $I)
    {
		$I->amOnPage('/home');
		$I->click('New Proposal');
		$I->amOnPage('/new_proposal');
		$I->see('New Proposal');  
		$I->selectOption('type','1');
		$I->click('Begin Proposal');
		$I->amOnPage('/new_course_proposal');
		$I->see('Add New Course Proposal');  
		$I->selectOption('department','Art');
		$I->fillField('course_id', 'TE111');
		$I->fillField('course_title', 'Test Course 1');
		$I->fillField('course_desc', 'A testing course.');
		$I->fillField('extra_details', 'None');
		$I->fillField('p_limit', '25');
		$I->fillField('course_prereqs', 'ART100');
		$I->selectOption('course_units','1 Unit');
		$I->selectOption('course_perspective','Formal Reasoning & Logic');
		$I->fillField('rationale', 'In order to test the site.');
		$I->fillField('lib_impact', 'None');
		$I->fillField('tech_impact', 'None.');
		$I->fillField('aligned_assignments', "We will try to paint like Picasso");
		$I->fillField('first_offering', 'Semester 2, 2022');
		$I->selectOption('course_status', "A new course not yet approved by COI");
		$I->fillField('designation_scope', 'All Sections');
		$I->fillField('designation_prof', 'None');
		$I->click(['class' => 'btn']);
		$I->canSeeInCurrentUrl('/home');
		
		$I->see('New Course: TE111, Test Course 1');		
    	}
	
	
}

?>
