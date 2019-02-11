<?php
class SigninCest
{
    public function loginSuccessfully(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Home');

	$I->see('New Proposal');



    }
}
