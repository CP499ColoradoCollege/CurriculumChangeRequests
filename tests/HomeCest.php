<?php
class HomeCest 
{
    public function homepageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/home');
        $I->see('Home');  
    }
	
	public function newProposalButtonWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/home');
        $I->see('Home');  
		$I->click('new_proposal');
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