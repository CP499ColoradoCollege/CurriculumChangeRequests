<?php 

$proposal_filepath = __DIR__.'/../../html/classes/Proposal.php';
require $proposal_filepath;

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
    }

    protected function _after()
    {

    }
    
    public function testFetchProposalFromID()
    {
        $proposal_fetched = $this->proposal->fetchProposalFromID(42) ? true : false;
        $this->assertTrue($proposal_fetched);
    }

    public function testDeleteProposal()
    {
        $this->dbc->query('DELETE FROM proposals WHERE id=42');
    }

    // public function testCreateProposalAddNewCourse()
    // {
        
    // }
    
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