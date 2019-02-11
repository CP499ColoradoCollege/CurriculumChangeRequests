<?php
class RemoveCourseCest
{
    public function removeCourseProposalPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/remove_course_proposal');
        $I->see('Remove Existing Course Proposal');  
    }
	
	public function removeCourseProposalFormWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/remove_course_proposal');
        $I->see('Remove Existing Course Proposal');  
		
		
		$I->fillField('Course ID of Course to be Dropped : ', 'CP122');
		$I->fillField('Rationale : ', 'In order to test the site once again.');
		$I->fillField('Library Impact : ', 'None');
		$I->fillField('Technology Impact : ', 'None.');
		
		$I->click('Save');
		$I->canSeeInCurrentUrl('/home');
		$I->see('Remove Course: CP122, Computer Science I');		
    }
	
	
}

?>