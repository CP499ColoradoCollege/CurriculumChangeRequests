<?php

class ProposalTest extends PHPunit_Framework_Testcase{
	
	public function testFetchProposalFromID(){
		$proposal = new Proposal($dbc);
		$proposal = $proposal->fetchProposalFromID('999');
		$result = $proposal->proposal_title;
		$this->assertEquals('Test Proposal', $result);
	}
	
	public function testCreateProposalAddNewCourse(){
		$post_array = array();
		$post_array['course_id'] = 'TE001';
		$post_array['course_title'] = 'Test Add New Course Proposal';
		$post_array['department'] = 'Test Department';
		$post_array['course_desc'] = 'Test Desc';
		$post_array['course_prereqs'] = 'Test Prereqs';
		$post_array['course_units'] = 'Test Units';
		$post_array['rationale'] = 'Test Rationale';
		$post_array['lib_impact'] = 'Test Lib Impact';
		$post_array['tech_impact'] = 'Test Tech Impact';
		
		$proposal = new Proposal($dbc);
		$result = $proposal->createProposalAddNewCourse('1', $post_array);
		$this->assertEquals(true, $result);
	}
	
	public function testCreateProposalChangeExistingCourse(){
		
		$criteria = '23';
		$related_course_id = 'TE000';
		
		$post_array = array();
		
		$post_array['p_department'] = '';
		$post_array['p_course_id'] = 'TE002';
		$post_array['p_course_title'] = 'Test Change Existing Course Proposal';
		$post_array['p_course_desc'] = 'Test Description';
		$post_array['p_prereqs'] = 'Test Prereqs';
		$post_array['p_units'] = 'Test Units';
		$post_array['rationale'] = 'Test Rationale';
		$post_array['lib_impact'] = 'Test Lib Impact';
		$post_array['tech_impact'] = 'Test Tech Impact';
		
		$proposal = new Proposal($dbc);
		$result = $proposal->createProposalChangeExistingCourse('1', $related_course_id, $criteria, $post_array);
		$this->assertEquals(true, $result);
	}

	
	public function testCreateProposalRemoveExistingCourse(){		
		$related_course_id = 'TE000';
		
		$post_array = array();
		
		$post_array['rationale'] = 'Test Rationale';
		$post_array['lib_impact'] = 'Test Lib Impact';
		$post_array['tech_impact'] = 'Test Tech Impact';
		
		$proposal = new Proposal($dbc);
		$result = $proposal->createProposalRemoveExistingCourse('1', $related_course_id, $post_array);
		$this->assertEquals(true, $result);
	}
	

}

?>