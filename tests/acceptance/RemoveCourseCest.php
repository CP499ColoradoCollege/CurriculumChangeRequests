<?php

/*
 * This is a Test class for testing the site's Remove Existing Proposal page and form functionality
 */

class RemoveCourseCest
{
	/*
	 * Tests that the user can navigate from the Home page to the Remove Existing Course Proposal page
	 */
	public function removeCourseProposalPageWorks(AcceptanceTester $I)
    	{
		$I->amOnPage('/home');
		$I->click('New Proposal');
		$I->amOnPage('/new_proposal');
		$I->see('New Proposal');  
		$I->selectOption('type','3');
		$I->click('Begin Proposal');
		$I->amOnPage('/remove_course_proposal');
		$I->see('Remove Existing Course Proposal');  
    	}
	
	/*
	 * Tests that the Remove Existing Course Proposal page/form load correctly, that the form redirects to the Home page once submitted,
	 * and that the saved proposal is added to the user's Home page once saved
	 */
	public function removeCourseProposalFormWorks(AcceptanceTester $I)
    	{
		$I->amOnPage('/home');
		$I->click('New Proposal');
		$I->amOnPage('/new_proposal');
		$I->see('New Proposal');  
		$I->selectOption('type','3');
		$I->click('Begin Proposal');
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
