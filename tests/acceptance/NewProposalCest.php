<?php
class NewProposalCest
{
    public function newproposalPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
    }
	
	public function newCourseProposalWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','1');
		$I->click('begin');
		$I->canSeeInCurrentUrl('/new_course_proposal');
    }
	
	public function changeCourseProposalWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','2');
		$I->click('begin');
		$I->canSeeInCurrentUrl('/change_course_proposal_select');
    }
	
	public function removeCourseProposalWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/home');
        $I->click('New Proposal');
        $I->amOnPage('/new_proposal');
        $I->see('New Proposal');  
		$I->selectOption('type','3');
		$I->click('begin');
		$I->canSeeInCurrentUrl('/remove_course_proposal');
    }
	
}

?>
