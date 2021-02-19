<?php

/* This class maps to the columns in the Proposals table, and contains logic involved in managing Proposal queries
   There are three types of proposal queries: addNewCourse, ReviseExistingCourse, and DropExisting Course.
   Each of these three proposal types has two functions: one to create the proposal, and one to edit the proposal.
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
	
	public $criteria; //probably needs to be adjusted
	
	public $p_department;
	
	public $p_course_id;
	
	public $p_course_title;
	
	public $p_course_desc;
	
	public $p_extra_details;
	
	public $p_limit;
	
	public $p_prereqs;
	
	public $p_units;
	
	public $p_crosslisting;
	
	public $p_perspective; //probably deprecated...or can be switched to GenEd category?
	
	public $rationale; //probably deprecated...or can be switched to GenEd rationale?
	
	public $lib_impact; //possibly deprecated
	
	public $tech_impact; //possibly deprecated
	
	public $status;

	public $p_aligned_assignments; //"Courses in each GenEd category need to include >=1 assignment aligned to each learning outcome"
	public $p_first_offering; //first semester and year course will be offered
	public $p_course_status; //new not yet approved by COI, new approved but not yet offered, current under minor revision, current under major revision
	public $p_designation_scope; //GenEd designation sought for all sections of course or instructor-specific
	public $p_designation_prof; //addendum to above: list of professor(s) for instructor-specific sections
	public $p_feedback;
	
	public $edit_date;
	
	public function __construct($dbc){
		$this->dbc = $dbc;
	}
	
	
	public function fetchProposalFromID($id){
		
		$dbc = $this->dbc;
		
		$statement = $dbc->prepare("SELECT user_id, related_course_id, proposal_title, 
		proposal_date, sub_status, approval_status, department, type, criteria, p_department, 
		p_course_id, p_course_title, p_course_desc, p_extra_details, p_limit, p_prereqs, 
		p_units, p_crosslisting, p_perspective, rationale, lib_impact, tech_impact, status,p_aligned_assignments, 
		p_first_offering, p_course_status, p_designation_scope, p_designation_prof, p_feedback FROM proposals WHERE id = ?");
		$statement->bind_param("s", $id);

		$bool = $statement->execute();
		$statement->store_result();
		$statement->bind_result($user_id, $related_course_id, $proposal_title, $proposal_date, 
		$sub_status, $approval_status, $department, $type, $criteria, $p_department, $p_course_id, 
		$p_course_title, $p_course_desc, $p_extra_details, $p_limit, $p_prereqs, $p_units, $p_crosslisting, 
		$p_perspective, $rationale, $lib_impact, $tech_impact, $status, $p_aligned_assignments, 
		$p_first_offering, $p_course_status, $p_designation_scope, $p_designation_prof, $p_feedback);

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
			$this->p_extra_details = $p_extra_details;
			$this->p_limit = $p_limit;
			$this->p_prereqs = $p_prereqs;
			$this->p_units = $p_units;
			$this->p_crosslisting = $p_crosslisting;
			$this->p_perspective = $p_perspective;
			$this->rationale = $rationale;
			$this->lib_impact = $lib_impact;
			$this->tech_impact = $tech_impact;
			$this->status = $status;
			$this->p_aligned_assignments = $p_aligned_assignments;
			$this->p_first_offering = $p_first_offering;
			$this->p_course_status = $p_course_status;
			$this->p_designation_scope = $p_designation_scope;
			$this->p_designation_prof = $p_designation_prof;
			$this->p_feedback = $p_feedback;
			
			return $this;
		}else{
			echo "Error: Less than/Greater than 1 row returned, can not be saved as 1 Proposal.";
			return false;
		}
	}
	

	
	public function createProposalAddNewCourse($user_id, $post_array){
		
		$dbc = $this->dbc;
		
		$statement = $dbc->prepare("INSERT INTO proposals (user_id, proposal_title, 
		proposal_date, department, type, p_course_id, p_course_title, p_course_desc, 
		p_extra_details, p_limit, p_prereqs, p_units, rationale, lib_impact, tech_impact, 
		p_aligned_assignments, p_first_offering, p_course_status, p_designation_scope, 
		p_designation_prof, p_feedback) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

		$statement->bind_param("sssssssssssssssssssss", $this->user_id, $this->proposal_title, 
		$this->proposal_date, $this->department, $this->type, $this->p_course_id, 
		$this->p_course_title, $this->p_course_desc, $this->p_extra_details, 
		$this->p_limit, $this->p_prereqs, $this->p_units, $this->rationale, 
		$this->lib_impact, $this->tech_impact, $this->p_aligned_assignments, 
		$this->p_first_offering, $this->p_course_status, $this->p_designation_scope, 
		$this->p_designation_prof, $this->p_feedback);

		//one s for every variable...make sure to add all 6!

		$course_id = mysqli_real_escape_string($dbc, $post_array['course_id']);
		$course_title = $post_array['course_title'];
		
		$this->user_id = $user_id;
		$this->proposal_title = 'New Course: '.$course_id.', '.$course_title;
		$this->proposal_date = date('m/d/Y');
		$this->department = $post_array['department'];
		$this->type = 'Add a New Course';
		$this->p_course_id = $course_id;
		$this->p_course_title = $course_title;
		$this->p_course_desc = $post_array['course_desc'];
		$this->p_extra_details = $post_array['extra_details'];
		$this->p_limit = $post_array['p_limit'];
		
		$this->p_prereqs = $post_array['course_prereqs'];
		if($this->p_prereqs == ''){
			$this->p_prereqs = 'None';
		}
		$this->p_units = $post_array['course_units'];
		$this->rationale = $post_array['rationale'];
		$this->lib_impact = $post_array['lib_impact'];
		if($this->lib_impact == ''){
			$this->lib_impact = 'None';
		}
		$this->tech_impact = $post_array['tech_impact'];
		if($this->tech_impact == ''){
			$this->tech_impact = 'None';
		}
		
		$this->p_aligned_assignments = $post_array['aligned_assignments'];
		$this->p_first_offering = $post_array['first_offering'];
		$this->p_course_status = $post_array['course_status'];
		$this->p_designation_scope = $post_array['designation_scope'];
		$this->p_designation_prof = $post_array['designation_prof'];
		$this->p_feedback = 'None';
		$bool = $statement->execute();
		if($bool){
			return true;
		}else{
			return false;
		}
	}

	public function addProposalHistory($pid, $user_id, $post_array, $original_proposal){
		
		$dbc = $this->dbc;
		
		$statement = $dbc->prepare("INSERT INTO proposal_history (id, user_id, edit_date, proposal_title, p_course_id, p_course_title, p_course_desc, p_extra_details, p_limit, p_prereqs, p_units, rationale, lib_impact, tech_impact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$statement->bind_param("ssssssssssssss", $this->id, $this->user_id, $this->edit_date, $this->proposal_title, $this->p_course_id, $this->p_course_title, $this->p_course_desc, $this->p_extra_details, $this->p_limit, $this->p_prereqs, $this->p_units, $this->rationale, $this->lib_impact, $this->tech_impact);
		
		$this->id = $pid;
		$this->user_id = $user_id;
		$this->edit_date = date('m/d/Y');
		$this->proposal_title = $original_proposal->proposal_title;
		if($post_array['course_id'] != $original_proposal->p_course_id){
			$this->p_course_id = $post_array['course_id'];	
							
		}else{
			$this->p_course_id = 'unchanged';
		}
		if($post_array['course_title'] != $original_proposal->p_course_title){
			$this->p_course_title = $post_array['course_title'];	
							
		}else{
			$this->p_course_title = 'Unchanged';
		}
		if($post_array['course_desc'] != $original_proposal->p_course_desc){
			$this->p_course_desc = $post_array['course_desc'];
							
		}else{
			$this->p_course_desc = 'Unchanged';
		}
		if($post_array['course_details'] != $original_proposal->p_course_details){
			$this->p_extra_details = $post_array['extra_details'];
							
		}else{
			$this->p_extra_details = 'Unchanged';
		}
		if($post_array['limit'] != $original_proposal->p_limit){
			$this->p_limit = $post_array['limit'];
							
		}else{
			$this->p_limit = 'Unchanged';
		}
		if($post_array['course_prereqs'] != $original_proposal->p_prereqs){
			$this->p_prereqs = $post_array['course_prereqs'];
							
		}else{
			$this->p_prereqs = 'Unchanged';
		}
		if($post_array['course_units'] != $original_proposal->p_units){
			$this->p_units = $post_array['course_units'];
							
		}else{
			$this->p_units = 'Unchanged';
		}
		if($post_array['rationale'] != $original_proposal->rationale){
			$this->rationale = $post_array['rationale'];
							
		}else{
			$this->rationale = 'Unchanged';
		}
		if($post_array['lib_impact'] != $original_proposal->lib_impact){
			$this->lib_impact = $post_array['lib_impact'];
			if($this->$lib_impact == ''){
				$this->lib_impact = 'None';
			}
							
		}else{
			$this->lib_impact = 'Unchanged';
		}
		if($post_array['tech_impact'] != $original_proposal->tech_impact){
			$this->tech_impact = $post_array['tech_impact'];
			if($this->tech_impact == ''){
				$this->tech_impact = 'None';
			}
							
		}else{
			$this->tech_impact = 'Unchanged';
		}	
		
		$bool = $statement->execute();
		if($bool){
			return true;
		}else{
			echo 'error: '.mysqli_error($dbc);
			return false;
		}
	}

	public function editProposalAddNewCourse($user_id, $pid, $post_array){
			
		$dbc = $this->dbc;
		
		$statement = $dbc->prepare("UPDATE proposals SET p_course_id = ?, p_course_title = ?, p_course_desc = ?, p_extra_details = ?, p_limit = ?, p_prereqs = ?, p_units = ?, rationale = ?, lib_impact = ?, tech_impact = ?, p_aligned_assignments = ?, p_first_offering = ?, p_course_status = ?, p_designation_scope = ?, p_designation_prof = ? WHERE id = ?");
		$statement->bind_param("ssssssssssssssss", $p_course_id, $p_course_title, $p_course_desc, $p_extra_details, $p_limit, $p_prereqs, $p_units, $rationale, $lib_impact, $tech_impact, $p_aligned_assignments, $p_first_offering, $p_course_status, $p_designation_scope, $p_designation_prof, $pid);
		
		$p_course_id = $post_array['course_id'];
		$p_course_title = $post_array['course_title'];
		$p_course_desc = $post_array['course_desc'];
		$p_extra_details = $post_array['extra_details'];
		$p_limit = $post_array['limit'];
		$p_prereqs = $post_array['course_prereqs'];
		$p_units = $post_array['course_units'];
		$rationale = $post_array['rationale'];
		$lib_impact = $post_array['lib_impact'];
		if($lib_impact == ''){
			$lib_impact = 'None';
		}
		$tech_impact = $post_array['tech_impact'];
		if($tech_impact == ''){
			$tech_impact = 'None';
		}
		$p_aligned_assignments = $post_array['aligned_assignments'];
		$p_first_offering = $post_array['first_offering'];
		$p_course_status = $post_array['course_status'];
		$p_designation_scope = $post_array['designation_scope'];
		$p_designation_prof = $post_array['designation_prof'];
		$bool = $statement->execute();
		if($bool){
			return true;
		}else{
			echo 'error: '.mysqli_error($dbc);
			return false;
		}
	}

	
	public function createProposalReviseExistingCourse($user_id, $related_course_id, $criteria, $post_array){	
		$dbc = $this->dbc;
		
		$statement = $dbc->prepare("INSERT INTO proposals (user_id, proposal_title, 
		proposal_date, department, type, p_course_id, p_course_title, p_course_desc, 
		p_extra_details, p_limit, p_prereqs, p_units, rationale, lib_impact, tech_impact, p_aligned_assignments, p_first_offering, p_designation_scope, p_designation_prof ) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

		$statement->bind_param("sssssssssssssssssss", $this->user_id, $this->proposal_title, 
		$this->proposal_date, $this->department, $this->type, $this->p_course_id, 
		$this->p_course_title, $this->p_course_desc, $this->p_extra_details, 
		$this->p_limit, $this->p_prereqs, $this->p_units, $this->rationale, 
		$this->lib_impact, $this->tech_impact, $this->p_aligned_assignments, $this->p_first_offering, $this->p_designation_scope, $this->p_designation_prof);
									
		$this->user_id = $user_id;
		$this->related_course_id = $related_course_id;		
		$this->type = "Change an Existing Course";
		$this->criteria = $criteria;
				
		
		
		
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($related_course_id);
		
		$this->department = $course->dept_desc;

		$criteria = str_split($criteria);
			
		/* the $criteria array contains which criteria the user has selected to propose changes to. For example Course Id or Prerequisites.
		   These criteria are numbered from 1 - 7
		   1 : Course Id
		   2 : Course Title
		   3 : Course Description
		   4 : Extra details (Additional costs, field trips, etc)
		   5 : Enrollment Limit
		   6 : Prerequisites
		   7 : Units
		*/

		$changes = "";
		if(in_array('1', $criteria)){
			$this->p_course_id = $post_array['p_course_id'];
			$changes = $changes." Course ID";
		}else{
			$this->p_course_id = "";
		}
		
		if(in_array('2', $criteria)){
			$this->p_course_title = $post_array['p_course_title'];
			if($changes != ""){
				$changes = $changes.", Title";
			}else{
				$changes = $changes." Title";
			}
		}else{
			$this->p_course_title = "";
		}
		
		if(in_array('3', $criteria)){
			$this->p_course_desc = $post_array['p_course_desc'];
			if($changes != ""){
				$changes = $changes.", Description";
			}else{
				$changes = $changes." Description";
			}
		}else{
			$this->p_course_desc = "";
		}
		
		if(in_array('4', $criteria)){
			$this->p_extra_details = $post_array['p_extra_details'];
			if($changes != ""){
				$changes = $changes.", Extra Details";
			}else{
				$changes = $changes." Extra Details";
			}
		}else{
			$this->p_extra_details = "";
		}
		
		if(in_array('5', $criteria)){
			$this->p_limit = $post_array['p_limit'];
			if($changes != ""){
				$changes = $changes.", Limit";
			}else{
				$changes = $changes." Limit";
			}
		}else{
			$this->p_limit = "";
		}
		
		if(in_array('6', $criteria)){
			$this->p_prereqs = $post_array['p_prereqs'];
			if($changes != ""){
				$changes = $changes.", Prerequisites";
			}else{
				$changes = $changes." Prerequisites";
			}
		}else{
			$this->p_prereqs = "";
		}
		
		if(in_array('7', $criteria)){
			$this->p_units = $post_array['p_units'];
			if($changes != ""){
				$changes = $changes.", Units";
			}else{
				$changes = $changes." Units";
			}
		}else{
			$this->p_units = "";
		}
		
		if(in_array('8', $criteria)){
			$this->p_first_offering = $post_array['p_first_offering'];
			if($changes != ""){
				$changes = $changes.", First Offering";
			}else{
				$changes = $changes." First Offering";
			}
		}else{
			$this->p_first_offering = "";
		}
		
		if(in_array('9', $criteria)){
			$this->p_aligned_assignments = $post_array['p_aligned_assignments'];
			if($changes != ""){
				$changes = $changes.", Aligned Assignments";
			}else{
				$changes = $changes." Aligned Assignments";
			}
		}else{
			$this->p_aligned_assignments = "";
		}
		
		if(in_array('a', $criteria)){
			$this->p_designation_scope = $post_array['p_designation_scope'];
			if($changes != ""){
				$changes = $changes.", Designation Scope";
			}else{
				$changes = $changes." Designation Scope";
			}
		}else{
			$this->p_designation_scope = "";
		}
		
		if(in_array('b', $criteria)){
			$this->p_designation_prof = $post_array['p_designation_prof'];
			if($changes != ""){
				$changes = $changes.", Designation Professor(s)";
			}else{
				$changes = $changes." Designation Professor(s)";
			}
		}else{
			$this->p_designation_prof = "";
		}
		
		$this->proposal_title = 'Change'.$changes.' of Course: '.$related_course_id.', '.$course->course_title;
		$this->proposal_date = date('m/d/Y');
		$this->department = $course->dept_desc;
		$this->rationale = $post_array['rationale'];
		$this->lib_impact = $post_array['lib_impact'];
		if($this->lib_impact == ""){
			$this->lib_impact = "None";
		}
		$this->tech_impact = $post_array['tech_impact'];
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
		return true;
	}


	public function editProposalReviseExistingCourse($pid, $date, $user_id, $related_course_id, $criteria, $post_array){		
		
		$dbc = $this->dbc;

		$statement = $dbc->prepare("UPDATE proposals SET p_course_id = ?, p_course_title = ?, p_course_desc = ?, p_extra_details = ?, p_limit = ?, p_prereqs = ?, p_units = ?, rationale = ?, lib_impact = ?, tech_impact = ?, p_aligned_assignments = ?, p_first_offering = ?, p_designation_scope = ?, p_designation_prof = ? WHERE id = ?");
		$statement->bind_param("sssssssssssssss", $p_course_id, $p_course_title, $p_course_desc, $p_extra_details, $p_limit, $p_prereqs, $p_units, $rationale, $lib_impact, $tech_impact, $p_aligned_assignments, $p_first_offering, $p_designation_scope, $p_designation_prof, $pid);
				
		$criteria = str_split($criteria);	
		$changes = "";
		
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($related_course_id);
		
		if(in_array('1', $criteria)){
			$p_course_id = $post_array['p_course_id'];
			$changes = $changes." Course ID";
		}else{
			$p_course_id = "";
		}
		
		if(in_array('2', $criteria)){
			$p_course_title = $post_array['p_course_title'];
			if($changes != ""){
				$changes = $changes.", Title";
			}else{
				$changes = $changes." Title";
			}
		}else{
			$p_course_title = "";
		}
		
		if(in_array('3', $criteria)){
			$p_course_desc = $post_array['p_course_desc'];
			if($changes != ""){
				$changes = $changes.", Description";
			}else{
				$changes = $changes." Description";
			}
		}else{
			$p_course_desc = "";
		}
		
		if(in_array('4', $criteria)){
			$p_extra_details = $post_array['p_extra_details'];
			if($changes != ""){
				$changes = $changes.", Extra Details";
			}else{
				$changes = $changes." Extra Details";
			}
		}else{
			$p_extra_details = "";
		}
		
		if(in_array('5', $criteria)){
			$p_limit = $post_array['p_limit'];
			if($changes != ""){
				$changes = $changes.", Limit";
			}else{
				$changes = $changes." Limit";
			}
		}else{
			$p_limit = "";
		}
		
		if(in_array('6', $criteria)){
			$p_prereqs = $post_array['p_prereqs'];
			if($changes != ""){
				$changes = $changes.", Prerequisites";
			}else{
				$changes = $changes." Prerequisites";
			}
		}else{
			$p_prereqs = "";
		}
		
		if(in_array('7', $criteria)){
			$p_units = $post_array['p_units'];
			if($changes != ""){
				$changes = $changes.", Units";
			}else{
				$changes = $changes." Units";
			}
		}else{
			$p_units = "";
		}
		
		if(in_array('8', $criteria)){
			$p_first_offering = $post_array['p_first_offering'];
			if($changes != ""){
				$changes = $changes.", First Offering";
			}else{
				$changes = $changes." First Offering";
			}
		}else{
			$p_first_offering = "";
		}
		
		if(in_array('9', $criteria)){
			$p_aligned_assignments = $post_array['p_aligned_assignments'];
			if($changes != ""){
				$changes = $changes.", Aligned Assignments";
			}else{
				$changes = $changes." Aligned Assignments";
			}
		}else{
			$p_aligned_assignments = "";
		}
		
		if(in_array('a', $criteria)){
			$p_designation_scope = $post_array['p_designation_scope'];
			if($changes != ""){
				$changes = $changes.", Designation Scope";
			}else{
				$changes = $changes." Designation Scope";
			}
		}else{
			$p_designation_scope = "";
		}
		
		if(in_array('b', $criteria)){
			$p_designation_prof = $post_array['p_designation_prof'];
			if($changes != ""){
				$changes = $changes.", Designation Professor(s)";
			}else{
				$changes = $changes." Designation Professor(s)";
			}
		}else{
			$p_designation_prof = "";
		}
		
		$rationale = $post_array['rationale'];
		$lib_impact = $post_array['lib_impact'];
		if($lib_impact == ""){
			$lib_impact = "None";
		}
		$tech_impact = $post_array['tech_impact'];
		if($tech_impact == ""){
			$tech_impact = "None";
		}
						
		$bool = $statement->execute();
		if($bool){
			return true;
		}else{
			echo '<p class="bg-danger">Error: proposal could not be processed. '.mysqli_error($this->dbc)."</p>";
			return false;
		}
		return true;
		
		
		
	}



	public function createProposalDropExistingCourse($user_id, $course_id, $post_array){
		
		$dbc = $this->dbc;
		
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID($course_id);
		
		$statement = $dbc->prepare("INSERT INTO proposals (user_id, related_course_id, proposal_title, proposal_date, department, type, rationale, lib_impact, tech_impact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$statement->bind_param("sssssssss", $this->user_id, $this->related_course_id, $this->proposal_title, $this->proposal_date, $this->department, $this->type, $this->rationale, $this->lib_impact, $this->tech_impact);
		
		$this->user_id = $user_id;
		$this->related_course_id = $course_id;
		
		$this->proposal_title = 'Remove Course: '.$course_id.', '.$course->course_title;
		$this->proposal_date = date('m/d/Y');
		$this->department = $course->dept_desc;
		$this->type = 'Remove an Existing Course';
		
		$this->rationale = $post_array['rationale'];
		$this->lib_impact = $post_array['lib_impact'];
		if($this->lib_impact == ''){
			$this->lib_impact = 'None';
		}
		$this->tech_impact = $post_array['tech_impact'];
		if($this->tech_impact == ''){
			$this->tech_impact = 'None';
		}
		
		$bool = $statement->execute();
		if($bool){
			return true;
		}else{
			echo "Error: ".mysqli_error($dbc);
			return false;
		}
	}

	public function editProposalDropExistingCourse($user_id, $pid, $post_array){
		
		$dbc = $this->dbc;
				
		$statement = $dbc->prepare("UPDATE proposals SET related_course_id = ?, rationale = ?, lib_impact = ?, tech_impact = ? WHERE id = ?");
		$statement->bind_param("sssss", $related_course_id, $rationale, $lib_impact, $tech_impact, $pid);
	
		$related_course_id = $post_array['existing_course_id'];
		$rationale = $post_array['rationale'];
		$lib_impact = $post_array['lib_impact'];
		if($lib_impact == ''){
			$lib_impact = 'None';
		}
		$tech_impact = $post_array['tech_impact'];
		if($tech_impact == ''){
			$tech_impact = 'None';
		}
		
		$bool = $statement->execute();
		if($bool){
			return true;
		}else{
			echo "Error: ".mysqli_error($dbc);
			return false;
		}
	}
	
	
	
}


?>
