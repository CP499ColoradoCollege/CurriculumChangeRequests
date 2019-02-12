<?php
class RemoveCourseCest
{
    public function removeCourseProposalPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','3');
		$I->click('begin');
        $I->amOnPage('/remove_course_proposal');
        $I->see('Remove Existing Course Proposal');  
    }
	
	public function removeCourseProposalFormWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','3');
		$I->click('begin');
        $I->amOnPage('/remove_course_proposal');
        $I->see('Remove Existing Course Proposal');  
		
		
		$I->fillField('existing_course_id', 'CP122');
		$I->fillField('rationale', 'In order to test the site once again.');
		$I->fillField('lib_impact', 'None');
		$I->fillField('tech_impact', 'None.');
		
		$I->click('Save');
		$I->canSeeInCurrentUrl('/home');
		$I->see('Remove Course: CP122, Computer Science I');		
    }
	
	
}

?>