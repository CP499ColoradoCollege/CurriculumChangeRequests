<?php
class HomeCest 
{
    public function homepageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/home');
        $I->see('My Proposals');  
    }
	
	public function newProposalButtonWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/home');
        $I->see('My Proposals');  
		$I->click('New Proposal');
		$I->canSeeInCurrentUrl('/new_proposal');
    }
	
	public function editProposalButtonWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/home');
        $I->see('Home');  
		$I->click('Edit');
		$I->canSeeInCurrentUrl('/edit_proposal');
    }
	
}

?>
