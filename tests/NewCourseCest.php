<?php
class NewCourseCest
{
    public function newCourseProposalPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/new_course_proposal');
        $I->see('Add New Course Proposal');  
    }
	
	public function newCourseProposalFormWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/new_course_proposal');
        $I->see('Add New Course Proposal');  
		
		$I->selectOption('Department','Math & Computer Science');
		$I->fillField('Course ID', 'TE111');
		$I->fillField('Course Title', 'Test Course 1');
		$I->fillField('Course Description', 'A testing course.');
		$I->fillField('Extra Details', 'None');
		$I->fillField('Enrollment Limit', '25');
		$I->fillField('Course Prerequisites', 'None');
		$I->selectOption('Units','1');
		$I->fillField('Rationale', 'In order to test the site.');
		$I->fillField('Library Impact', 'None');
		$I->fillField('Technology Impact', 'None.');
		
		$I->click('Save');
		$I->canSeeInCurrentUrl('/home');
		$I->see('New Course: TE111, Test Course 1');		
    }
	
	
}

?>