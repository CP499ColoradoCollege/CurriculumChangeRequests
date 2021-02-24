<?php

require_once "dependencies.php";

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $dbc;
    public $user;
    public $proposal;
    
    protected function _before()
    {
        $this->dbc = mysqli_connect('localhost', 'root', '', 'testproposaltoolDB');
        $this->user = new User($this->dbc);
        
        $this->proposal = new Proposal($this->dbc);
        #create test proposal
        $this->dbc->query("INSERT INTO `proposals` (`id`, `user_id`, `related_course_id`, `proposal_title`, `proposal_date`, `sub_status`, `approval_status`, 
        `department`, `type`, `criteria`, `p_department`, `p_course_id`, `p_course_title`, `p_course_desc`, `p_extra_details`, `p_limit`, `p_prereqs`, `p_units`, 
        `p_crosslisting`, `p_perspective`, `rationale`, `lib_impact`, `tech_impact`, `status`, `p_aligned_assignments`, `p_first_offering`, `p_course_status`, `p_designation_scope`, 
        `p_designation_prof`, `p_feedback`) VALUES ('1', '1', 'None', 'TEST CLASS', '02/23/2020', '0', '1', 'Mathematics & Computer Science', 
        'Add a New Course', 'None', 'None', 'CP999', 'Super Hard CS Class', 'This class is super hard.', '', '', 'none', '1 Unit', 'None', 'None', 'We need more CS courses.', 
        'None', 'None', '1', 'Code reality', 'Winter 2077', 'None', 'All Sections of Course', 'N/A', 'None')");

        $this->proposal->fetchProposalFromID(1);
    }

    protected function _after()
    {
        $this->dbc->query("TRUNCATE proposals"); #Clean up test proposal 
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
        $this->assertTrue($num_proposals_fetched == 1); #there should be 1 proposals in made by h_helm
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