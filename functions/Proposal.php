<?php

/* This class maps to the columns in our Proposals table, and contains logic involved in managing Proposal queries
 */

class Proposal{
	
	public $dbc;
	
	public $id;
	
	public $user_id;
	
	public $related_course_id;
	
	public $proposal_title;
	
	public $proposal_date;
	
	public $sub_status;
	
	public $approval_status;
	
	public $department;
	
	public $type;
	
	public $criteria;
	
	public $p_department;
	
	public $p_course_id;
	
	public $p_course_title;
	
	public $p_course_desc;
	
	public $p_extra_desc;
	
	public $p_prereqs;
	
	public $p_units;
	
	public $p_crosslisting;
	
	public $p_perspective;
	
	public $rationale;
	
	public $lib_impact;
	
	public $tech_impact;
	
	public $status;
	
	public function __construct($dbc){
		$this->dbc = $dbc;
	}
	
	
	public function fetchProposalFromID($id){
		$statement = $this->dbc->prepare("SELECT user_id, related_course_id, proposal_title, proposal_date, sub_status, approval_status, department, type, criteria, p_department, p_course_id, p_course_title, p_course_desc, p_extra_desc, p_prereqs, p_units, p_crosslisting, p_perspective, rationale, lib_impact, tech_impact, status FROM proposals WHERE id = ?");
		$statement->bind_param("s", $id);

		$bool = $statement->execute();
		$statement->store_result();
		$statement->bind_result($user_id, $related_course_id, $proposal_title, $proposal_date, $sub_status, $approval_status, $department, $type, $criteria, $p_department, $p_course_id, $p_course_title, $p_course_desc, $p_extra_desc, $p_prereqs, $p_units, $p_crosslisting, $p_perspective, $rationale, $lib_impact, $tech_impact, $status);
		$statement->fetch();
		if($bool && mysqli_stmt_num_rows($statement) == 1){
			$this->id = $id;
			$this->user_id = $user_id;
			$this->related_course_id = $related_course_id;
			$this->proposal_title = $proposal_title;
			$this->proposal_date = $proposal_date;
			$this->sub_status = $sub_status;
			$this->approval_status = $approval_status;
			$this->department = $department;
			$this->type = $type;
			$this->criteria = $criteria;
			$this->p_department = $p_department;
			$this->p_course_id = $p_course_id;
			$this->p_course_title = $p_course_title;
			$this->p_course_desc = $p_course_desc;
			$this->p_extra_desc = $p_extra_desc;
			$this->p_prereqs = $p_prereqs;
			$this->p_units = $p_units;
			$this->p_crosslisting = $p_crosslisting;
			$this->p_perspective = $p_perspective;
			$this->rationale = $rationale;
			$this->lib_impact = $lib_impact;
			$this->tech_impact = $tech_impact;
			$this->status = $status;
			
			return $this;
		}else{
			echo "Error: Less than/Greater than 1 row returned, can not be saved as 1 Proposal.";
			return false;
		}
	}
	
	

	
	public function createProposalAddNewCourse($user_id, $post_array){
		
		$dbc = $this->dbc;
		
		$statement = $dbc->prepare("INSERT INTO proposals (user_id, proposal_title, proposal_date, department, type, p_course_id, p_course_title, p_course_desc, p_prereqs, p_units, rationale, lib_impact, tech_impact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$statement->bind_param("sssssssssssss", $this->user_id, $this->proposal_title, $this->proposal_date, $this->department, $this->type, $this->p_course_id, $this->p_course_title, $this->p_course_desc, $this->p_prereqs, $this->p_units, $this->rationale, $this->lib_impact, $this->tech_impact);
		
		$course_id = mysqli_real_escape_string($dbc, $post_array['course_id']);
		$course_title = mysqli_real_escape_string($dbc, $post_array['course_title']);
		
		$this->user_id = $user_id;
		$this->proposal_title = 'New Course: '.$course_id.', '.$course_title;
		$this->proposal_date = date('m/d/Y');
		$this->department = mysqli_real_escape_string($dbc, $post_array['department']);
		$this->type = 'Add a New Course';
		$this->p_course_id = $course_id;
		$this->p_course_title = $course_title;
		$this->p_course_desc = mysqli_real_escape_string($dbc, $post_array['course_desc']);
		$this->p_prereqs = mysqli_real_escape_string($dbc, $post_array['course_prereqs']);
		if($this->p_prereqs == ''){
			$this->p_prereqs = 'None';
		}
		$this->p_units = $post_array['course_units'];
		$this->rationale = mysqli_real_escape_string($dbc, $post_array['rationale']);
		$this->lib_impact = mysqli_real_escape_string($dbc, $post_array['lib_impact']);
		if($this->lib_impact == ''){
			$this->lib_impact = 'None';
		}
		$this->tech_impact = mysqli_real_escape_string($dbc, $post_array['tech_impact']);
		if($this->tech_impact == ''){
			$this->tech_impact = 'None';
		}
		
		$bool = $statement->execute();
		if($bool){
			return true;
		}else{
			return false;
		}
	}

	
	public function createProposalChangeExistingCourse($user_id, $related_course_id, $criteria, $post_array){
				
		$dbc = $this->dbc;
		
		$statement = $dbc->prepare("INSERT INTO proposals (user_id, related_course_id, proposal_title, proposal_date, department, type, criteria, p_department, p_course_id, p_course_title, p_course_desc, p_prereqs, p_units, rationale, lib_impact, tech_impact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$statement->bind_param("ssssssssssssssss", $this->user_id, $this->related_course_id, $this->proposal_title, $this->proposal_date, $this->department, $this->type, $this->criteria, $this->p_department, $this->p_course_id, $this->p_course_title, $this->p_course_desc, $this->p_prereqs, $this->p_units, $this->rationale, $this->lib_impact, $this->tech_impact);
										
		$this->user_id = $user_id;
		$this->related_course_id = $related_course_id;		
		$this->type = "Change an Existing Course";
		$this->criteria = $criteria;
				
		$criteria = str_split($criteria);	
		$changes = "";
		
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($related_course_id);
		
		$this->department = $course->dept_desc;
				
		if(in_array('1', $criteria)){
			$this->p_department = $post_array['p_department'];
			$changes = $changes." Department";
		}else{
			$this->p_department = "";
		}
		
		if(in_array('2', $criteria)){
			$this->p_course_id = mysqli_real_escape_string($dbc, $post_array['p_course_id']);
			if($changes != ""){
				$changes = $changes.", Course ID";
			}else{
				$changes = $changes." Course ID";
			}
		}else{
			$this->p_course_id = "";
		}
		
		if(in_array('3', $criteria)){
			$this->p_course_title = mysqli_real_escape_string($dbc, $post_array['p_course_title']);
			if($changes != ""){
				$changes = $changes.", Title";
			}else{
				$changes = $changes." Title";
			}
		}else{
			$this->p_course_title = "";
		}
		
		if(in_array('4', $criteria)){
			$this->p_course_desc = mysqli_real_escape_string($dbc, $post_array['p_course_desc']);
			if($changes != ""){
				$changes = $changes.", Description";
			}else{
				$changes = $changes." Description";
			}
		}else{
			$this->p_course_desc = "";
		}
		
		if(in_array('5', $criteria)){
			$this->p_prereqs = mysqli_real_escape_string($dbc, $post_array['p_prereqs']);
			if($changes != ""){
				$changes = $changes.", Prerequisites";
			}else{
				$changes = $changes." Prerequisites";
			}
		}else{
			$this->p_prereqs = "";
		}
		
		if(in_array('6', $criteria)){
			$this->p_units = $post_array['p_units'];
			if($changes != ""){
				$changes = $changes.", Units";
			}else{
				$changes = $changes." Units";
			}
		}else{
			$this->p_units = "";
		}
		
		$this->proposal_title = 'Change'.$changes.' of Course: '.$related_course_id.', '.$course->course_title;
		$this->proposal_date = date('m/d/Y');
		$this->department = $course->dept_desc;
		$this->rationale = mysqli_real_escape_string($dbc, $post_array['rationale']);
		$this->lib_impact = mysqli_real_escape_string($dbc, $post_array['lib_impact']);
		if($this->lib_impact == ""){
			$this->lib_impact = "None";
		}
		$this->tech_impact = mysqli_real_escape_string($dbc, $post_array['tech_impact']);
		if($this->tech_impact == ""){
			$this->tech_impact = "None";
		}
						
		$bool = $statement->execute();
		if($bool){
			return true;
		}else{
			echo '<p class="bg-danger">Error: proposal could not be processed. '.mysqli_error($this->dbc)."</p>";
			return false;
		}
	}
	
}


?>