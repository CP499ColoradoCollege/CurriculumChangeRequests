<?php

/*
 * This is a Test class for testing the site's New Proposal page and dropdown menu functionality
 */

class NewProposalCest
{
	/*
	 * Tests if the user can navigate from the Home page to the New Proposal page
	 */
	public function newproposalPageWorks(AcceptanceTester $I)
	{
		$I->amOnPage('/home');
		$I->click('New Proposal');
		$I->amOnPage('/new_proposal');
		$I->see('New Proposal');  
	}
		
	/*
	 * Tests that the user can navigate from the Home page to the Add New Course Proposal page
	 */
	public function newCourseProposalWorks(AcceptanceTester $I)
    	{	
		$I->amOnPage('/home');
		$I->click('New Proposal');
		$I->amOnPage('/new_proposal');
		$I->see('New Proposal');  
		$I->selectOption('type','1');
		$I->click('Begin Proposal');
		$I->canSeeInCurrentUrl('/new_course_proposal');
    	}
	
	/*
	 * Tests that the user can navigate from the Home page to the Change Existing Course Proposal page
	 */
	public function changeCourseProposalWorks(AcceptanceTester $I)
   	{
		$I->amOnPage('/home');
		$I->click('New Proposal');
		$I->amOnPage('/new_proposal');
		$I->see('New Proposal');  
		$I->selectOption('type','2');
		$I->click('Begin Proposal');
		$I->canSeeInCurrentUrl('/change_course_proposal_select');
    	}
	
	/*
	 * Tests that the user can navigate from the Home page to the Remove Existing Course Proposal page
	 */
	public function removeCourseProposalWorks(AcceptanceTester $I)
    	{
		$I->amOnPage('/home');
		$I->click('New Proposal');
		$I->amOnPage('/new_proposal');
		$I->see('New Proposal');  
		$I->selectOption('type','3');
		$I->click('Begin Proposal');
		$I->canSeeInCurrentUrl('/remove_course_proposal');
    	}
	
}

?>
