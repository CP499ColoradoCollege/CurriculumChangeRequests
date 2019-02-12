<?php
class EditCourseCest
{
    public function changeCourseProposalSelectPageWorks(AcceptanceTester $I)
    {
		$I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','2');
		$I->click('begin');
		$I->canSeeInCurrentUrl('/change_course_proposal_select');
        $I->amOnPage('/change_course_proposal_select');
        $I->see('Change Existing Course Proposal');  
    }
	
	public function changeCourseProposalSelectFormWorks(AcceptanceTester $I)
    {
		$I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','2');
		$I->click('begin');
		$I->canSeeInCurrentUrl('/change_course_proposal_select');
        $I->amOnPage('/change_course_proposal_select');
        $I->see('Change Existing Course Proposal');  
		
		$I->fillField('existing_course_id', 'CP122');
		$I->checkOption('course_id');
		$I->checkOption('course_title');
		$I->checkOption('course_desc');
		$I->checkOption('extra_details');
		$I->checkOption('enrollment_limit');
		$I->checkOption('prerequisites');
		$I->checkOption('units');
		
		$I->click('Save');
		$I->amOnPage('/change_course_proposal?type=1234567');
    }
	
	public function changeCourseProposalPageWorks(AcceptanceTester $I)
    {
		$I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','2');
		$I->click('begin');
		$I->canSeeInCurrentUrl('/change_course_proposal_select');

		$I->fillField("existing_course_id", "CP122");
		$I->checkOption('course_id');
		
		$I->click('Save');

        $I->amOnPage('/change_course_proposal?type=1&cid=CP122');
        $I->see('Change Course Proposal');  
    }
	
	public function changeCourseProposalFormWorks(AcceptanceTester $I)
    {
		$I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','2');
		$I->click('begin');
		$I->canSeeInCurrentUrl('/change_course_proposal_select');

		$I->fillField("existing_course_id", "CP122");
		$I->checkOption('course_id');
		$I->checkOption('course_title');
		$I->checkOption('course_desc');
		$I->checkOption('extra_details');
		$I->checkOption('enrollment_limit');
		$I->checkOption('prerequisites');
		$I->checkOption('units');
		
		$I->click('Save');

        $I->amOnPage('/change_course_proposal?type=1234567&cid=CP122');
        $I->see('Change Course Proposal');  
		$I->see('Proposed Course ID');
		
		$I->fillField("p_course_id", 'TE222');
		$I->fillField('p_course_title', 'Test Two');
		$I->fillField('p_course_desc', 'This is a second test.');
		$I->fillField('p_extra_details', 'None');
		$I->fillField('p_limit', '25');
		$I->fillField('p_prereqs', 'None');
		$I->selectOption('p_units', '1 Unit');
		$I->fillField('rationale', 'To conduct yet another test.');
		$I->fillField('lib_impact', 'None');
		$I->fillField('tech_impact', 'None');
		
		$I->click('Save');
		$I->canSeeInCurrentUrl('/home');
		$I->see("Change Course ID, Title, Description, Extra Details, Limit, Prerequisites, Units of Course: CP122, Computer Science I");
		
    }
	
	
}

?>