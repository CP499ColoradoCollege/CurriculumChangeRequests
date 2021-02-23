<?php

/*
 * This is a Test class for testing the site's Home page
 */

class HomeCest 
{
	/*
	 * Tests that the home page opens when requested
	 */
	public function homepageWorks(AcceptanceTester $I)
   	{
		$I->amOnPage('/home');
		$I->see('My Proposals');  
  	}
	
	/*
	 * Tests that the New Proposal button on the Home page redirects to the correct page
	 */
	public function newProposalButtonWorks(AcceptanceTester $I)
    	{
		$I->amOnPage('/home');
		$I->see('My Proposals');  
		$I->click('New Proposal');
		$I->canSeeInCurrentUrl('/new_proposal');
    	}
	
	/*
	 * Tests that the Edit button works for each Proposal on the Home page
	 */
	public function editProposalButtonWorks(AcceptanceTester $I)
    	{
		$I->amOnPage('/home');
		$I->see('Home');  
		$I->click('Edit');
		$I->canSeeInCurrentUrl('/edit_proposal');
    	}
	
	public function downloadButtonWorks(AcceptanceTester $I)
	{
		$I->amOnPage('/home');
		$I->see('Download');
		$I->click('Download');
	}

	public function historyButtonWorks(AcceptanceTester $I)
	{
		$I->amOnPage('/home');
		$I->see('History');
		$I->click('History');
		$I->canSeeInCurrentUrl('/history');
	}

	public function submitButtonWorks(AcceptanceTester $I)
	{
		$I->amOnPage('/home');
		$I->see('Submit');
		$I->click('Submit');
		$I->canSeeInCurrentUrl('/submit');
	}
}

?>
