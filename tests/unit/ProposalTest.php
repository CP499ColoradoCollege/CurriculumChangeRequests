<?php 

require_once "dependencies.php";

class ProposalTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $dbc;
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
    }

    protected function _after()
    {
        $this->dbc->query("TRUNCATE proposals"); #Clean up test proposal 
    }
    
    public function testFetchProposalFromID()
    {
        $proposal_fetched = $this->proposal->fetchProposalFromID(1) ? true : false;
        $this->assertTrue($proposal_fetched);
    }

    public function testDeleteProposal()
    {
        $successful_delete = $this->proposal->deleteProposal();
        $this->assertTrue($successful_delete);
    }

    public function testCreateProposalAddNewCourse()
    {
        $post_keys = ['user_id', 'related_course_id', 'proposal_title', 'proposal_date', 'sub_status', 'approval_status', 
        'department', 'type', 'criteria', 'department', 'course_id', 'course_title', 'course_desc', 'extra_details', 'p_limit', 'course_prereqs', 'course_units', 
        'crosslisting', 'course_perspective', 'rationale', 'lib_impact', 'tech_impact', 'status', 'aligned_assignments', 'first_offering', 'course_status', 'designation_scope', 
        'designation_prof', 'feedback' ];
        $post_values = [ '1', 'None', 'TEST CLASS', '02/23/2020', '0', '1', 'Mathematics & Computer Science', 
        'Add a New Course', 'None', 'None', 'CP999', 'Super Hard CS Class', 'This class is super hard.', '', '', 'none', '1 Unit', 'None', 'None', 'We need more CS courses.', 
        'None', 'None', '1', 'Code reality', 'Winter 2077', 'None', 'All Sections of Course', 'N/A', 'None'];
        $post_array = array_combine($post_keys, $post_values);
        $proposal_created = $this->proposal->createProposalAddNewCourse(1, $post_array); #1 is user_id; post_array simulates the data that would be passed through http POST into this function
        $this->assertTrue($proposal_created);
    }
    
    // public function testEditProposalAddNewCourse()
    // {
        
    // }
    
    // public function testCreateProposalReviseExistingCourse()
    // {
        
    // }
    
    // public function testEditProposalReviseExistingCourse()
    // {
        
    // }
    
    // public function testCreateProposalDropExistingCourse()
    // {
        
    // }
    
    // public function testEditProposalDropExistingCourse()
    // {
        
    // }

    
}