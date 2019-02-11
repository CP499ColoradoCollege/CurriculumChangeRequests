<?php
class EditCourseCest
{
    public function changeCourseProposalSelectPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/change_course_proposal_select');
        $I->see('Change Existing Course Proposal');  
    }
	
	public function changeCourseProposalSelectFormWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/change_course_proposal_select');
        $I->see('Change Existing Course Proposal');  
		
		
		$I->checkOption('Course ID');
		$I->checkOption('Course Title');
		$I->checkOption('Course Description');
		$I->checkOption('Extra Course Details');
		$I->checkOption('Enrollment Limit');
		$I->checkOption('Prerequisites');
		$I->checkOption('Units');
		
		$I->click('Save');
		$I->canSeeInCurrentUrl('type=1234567');
    }
	
	public function changeCourseProposalPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/change_course_proposal?type=1&cid=CP122');
        $I->see('Change Course Proposal');  
    }
	
	public function changeCourseProposalFormWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/change_course_proposal?type=1234567&cid=CP122');
        $I->see('Change Course Proposal');  
		
		
		$I->fillField('Proposed Course ID', 'TE222');
		$I->fillField('Proposed Course Title', 'Test Two');
		$I->fillField('Proposed Course Description', 'This is a second test.');
		$I->fillField('Proposed Extra Details', 'None');
		$I->fillField('Proposed Enrollment Limit', '25');
		$I->fillField('Proposed Course Prerequisites', 'None');
		$I->selectOption('Proposed Units', '1 Unit');
		$I->fillField('Rationale', 'To conduct yet another test.');
		$I->fillField('Library Impact', 'None');
		$I->fillField('Technology Impact', 'None');
		
		$I->click('Save');
		$I->canSeeInCurrentUrl('/home');
		
    }
	
	
}

?>