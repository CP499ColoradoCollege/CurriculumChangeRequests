<?php 

require_once 'dependencies.php';

class EditHistoryTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $proposal;
    
    protected function _before()
    {
        $this->dbc = mysqli_connect('localhost', 'root', '', 'testproposaltoolDB') OR die('Error: '.mysqli_connect_error());
        
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
        #Clean up test data
        $this->dbc->query("TRUNCATE proposals"); 
        $this->dbc->query("TRUNCATE proposalhistory");
        
    }

    public function testCreateProposalHistory()
    {
        $proposal = $this->proposal;
        $history_added = $proposal->createProposalHistory($proposal) ? true : false;
        $this->assertTrue($history_added);
    }

    public function testFetchProposalHistory()
    {
        $proposal = $this->proposal;
        $proposal->createProposalHistory($proposal); # create 3 proposal histories 
        $proposal->createProposalHistory($proposal);
        $proposal->createProposalHistory($proposal);
        $history_1_fetched = $proposal->fetchProposalHistory(1) ? true : false;
        $history_2_fetched = $proposal->fetchProposalHistory(2) ? true : false;
        $history_3_fetched = $proposal->fetchProposalHistory(3) ? true : false;

        $this->assertTrue($history_1_fetched and $history_2_fetched and $history_3_fetched);
    }
}