<?php
class NewCourseCest
{
    public function newCourseProposalPageWorks(AcceptanceTester $I)
    {
		$I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','1');
		$I->click('begin');
        $I->amOnPage('/new_course_proposal');
        $I->see('Add New Course Proposal');  
    }
	
	public function newCourseProposalFormWorks(AcceptanceTester $I)
    {
		$I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','1');
		$I->click('begin');
        $I->amOnPage('/new_course_proposal');
        $I->see('Add New Course Proposal');  
		
		$I->selectOption('department','Art');
		$I->fillField('course_id', 'TE111');
		$I->fillField('course_title', 'Test Course 1');
		$I->fillField('course_desc', 'A testing course.');
		$I->fillField('extra_details', 'None');
		$I->fillField('p_limit', '25');
		$I->fillField('course_prereqs', 'None');
		$I->selectOption('course_units','1 Unit');
		$I->fillField('rationale', 'In order to test the site.');
		$I->fillField('lib_impact', 'None');
		$I->fillField('tech_impact', 'None.');
		
		$I->click('Save');
		$I->canSeeInCurrentUrl('/home');
		$I->see('New Course: TE111, Test Course 1');		
    }
	
	
}

?>