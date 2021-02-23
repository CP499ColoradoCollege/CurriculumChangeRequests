<?php

$user_filepath = __DIR__.'/../../html/classes/User.php';
require $user_filepath;
$proposal_filepath = __DIR__.'/../../html/classes/Proposal.php';
require $proposal_filepath;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $dbc;
    public $user;

    
    protected function _before()
    {
        $this->dbc = mysqli_connect('localhost', 'root', '', 'testproposaltoolDB');
        $this->user = new User($this->dbc);
    }

    public function testFetchUserFromEmail()
	{
        $user_fetched = $this->user->fetchUserFromEmail("admin@proposals.com") ? true : false; #false if something goes wrong, otherwise correctly populates
        $this->assertTrue($user_fetched); 
	}

	public function testFetchUserFromUsername()
	{
        $user_fetched = $this->user->fetchUserFromUsername("h_helm") ? true : false;
        $this->assertTrue($user_fetched);
	}	

    public function testFetchUserFromID() 
    {
        $user_fetched = $this->user->fetchUserFromID(1) ? true : false; 
        $this->assertTrue($user_fetched); 
    }   
    
    public function testGetProposals() 
    {
        $this->user->fetchUserFromID(1); #this function requires the user id to have already been queried 
        $proposals_fetched = $this->user->getProposals();
        $num_proposals_fetched = sizeof($proposals_fetched);
        $this->assertTrue($num_proposals_fetched == 5); #there should be 5 proposals in made by h_helm
    }

    public function testGetDepartments() 
    {
        $this->user->fetchUserFromID(1);
        $departments_fetched = $this->user->getProposals() ? true : false;
        $this->assertTrue($departments_fetched);
        // $education = $departments_fetched["EDUC"];
        // $this->assertTrue($education == "Education"); #see if we can get a dept_desc from dept_code    
    }

    public function testGetDivision()
    {
        $division_fetched = $this->user->getDivision("Mathematics & Computer Science") ? true : false;
        $this->assertTrue($division_fetched == "Natural Sciences");
    }

}

?>