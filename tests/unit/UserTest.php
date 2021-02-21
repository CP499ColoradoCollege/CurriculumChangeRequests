<?php

$user_filepath = __DIR__.'/../../html/classes/User.php';
require $user_filepath;

class ExampleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $dbc;
    public $user;

    
    protected function _before()
    {
        codecept_debug(getcwd());
        $this->dbc = mysqli_connect('localhost', 'root', '', 'proposaltoolDB');
        $this->user = new User($this->dbc);
    }

    public function testFetchUserFromEmail()
	{
        $user_fetched = (bool)$this->user->fetchUserFromEmail("admin@proposals.com"); #false if something goes wrong, otherwise correctly populates
        $this->assertTrue($user_fetched); 
	}

	public function testFetchUserFromUsername()
	{
        $user_fetched = $this->user->fetchUserFromUsername("h_helm") ? true : false;
        $this->assertTrue($user_fetched);
	}	

    public function testFetchUserFromID() 
    {
        $user_fetched = (bool)$this->user->fetchUserFromID(1); 
        $this->assertTrue($user_fetched); 
    }   
    
    public function testGetProposals() 
    {
        $proposals_fetched = $this->user->getProposals();
        $num_proposals_fetched = sizeof($proposals_fetched);
        $this->assertTrue($num_proposals_fetched == 5); #there should be 5 proposals in made by h_helm
    }

    public function testGetDepartments() 
    {
        $departments_fetched = $this->user->getProposals();
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