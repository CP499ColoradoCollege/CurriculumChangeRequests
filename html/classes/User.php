<?php

/* This class maps to the columns in our Users table, and contains logic involved in managing User queries
 */

class User{
	
	public $dbc;
	
	public $id;
	
	public $email;
	
	public $first_name;
	
	public $last_name;
	
	public $username;
	
	public $department;
	
	public $position;

	public $permission;
	
	public $status;
	
	public function __construct($dbc){
		$this->dbc = $dbc;
	}

	public function fetchUserFromEmail($email){
		$statement = $this->dbc->prepare("SELECT id, first_name, last_name, username, department, position, permission, status FROM users WHERE email = ?");
		$statement->bind_param("s", $email);
		
		$bool = $statement->execute();
		$statement->store_result();
		$statement->bind_result($id, $first_name, $last_name, $username, $department, $position, $permission, $status);
		$statement->fetch();
		if($bool && mysqli_stmt_num_rows($statement) == 1){
			$this->id = $id;
			$this->email = $email;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->username = $username;
			$this->department = $department;
			$this->position = $position;
			$this->permission = $permission;
			$this->status = $status;
			return $this;	
		}else{
			echo "Error: Less than/Greater than 1 row returned, can not be saved as 1 User.";
			return false;
		}		
	}
	
	public function fetchUserFromUsername($username){
		$statement = $this->dbc->prepare("SELECT id, first_name, last_name, email, department, position, permission, status FROM users WHERE username = ?");
		$statement->bind_param("s", $username);
		
		$bool = $statement->execute();
		$statement->store_result();
		$statement->bind_result($id, $first_name, $last_name, $email, $department, $position, $permission, $status);
		$statement->fetch();
		if($bool && mysqli_stmt_num_rows($statement) == 1){
			$this->id = $id;
			$this->email = $email;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->username = $username;
			$this->department = $department;
			$this->position = $position;
			$this->permission = $permission;
			$this->status = $status;
			return $this;	
		}else{
			echo "Error: Less than/Greater than 1 row returned, can not be saved as 1 User.";
			return false;
		}
	}
	
	public function fetchUserFromID($id){
		//DEBUG
		$msg = "Hit fetchUserFromID in User.php";
		error_log(print_r($msg, TRUE)); 
		$msg = "Provided user ID: ".$id;
		error_log(print_r($msg, TRUE));

		$dbc = $dbc = $this->dbc;
		$statement = $dbc->prepare("SELECT email, first_name, last_name, username, department, 
		position, permission, status FROM users WHERE id = ?");
		$statement->bind_param("s", $id);
		
		$bool = $statement->execute();
		$statement->store_result();
		$statement->bind_result($email, $first_name, $last_name, $username, $department, 
		$position, $permission, $status);
		$statement->fetch();
		
		if($bool && mysqli_stmt_num_rows($statement) == 1){
			$this->id = $id;
			$this->email = $email;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->username = $username;
			$this->department = $department;
			$this->position = $position;
			$this->permission = $permission;
			$this->status = $status;
			return $this;
		}else{
			echo "Error: Less than/Greater than 1 row returned, can not be saved as 1 User.";
			return false;
		}
	}
	
	public function getProposals(){
		$proposals = array();
		$q = "SELECT id FROM proposals WHERE user_id = '$this->id' ORDER BY id DESC";
		$r = mysqli_query($this->dbc, $q);
		while($proposal_id = mysqli_fetch_assoc($r)){
			$current = new Proposal($this->dbc);
			$current = $current->fetchProposalFromID($proposal_id['id']);
			array_push($proposals, $current);
		}
		return $proposals;
	}
	
	public function getProposalHistory($id){
		$history = array();
		$q = "SELECT history_id, user_id, related_course_id, proposal_title, 
		proposal_date, sub_status, approval_status, department, type, criteria, p_department, 
		p_course_id, p_course_title, p_course_desc, p_extra_details, p_limit, p_prereqs, 
		p_units, p_crosslisting, p_perspective, rationale, lib_impact, tech_impact, status,p_aligned_assignments, 
		p_first_offering, p_course_status, p_designation_scope, p_designation_prof, p_feedback FROM proposalhistory WHERE id = '$id'";
		$r = mysqli_query($this->dbc, $q);
		
		while($row = mysqli_fetch_assoc($r)){
			$current = new Proposal($this->$dbc);
			$current->history_id = $row["history_id"];
			$current->id = $id;
			$current->user_id = $row["user_id"];
			$current->related_course_id = $row["related_course_id"];
			$current->proposal_title = $row["proposal_title"];
			$current->proposal_date = $row["proposal_date"];
			$current->sub_status = $row["sub_status"];
			$current->approval_status = $row["approval_status"];
			$current->department = $row["department"];
			$current->type = $row["type"];
			$current->criteria = $row["criteria"];
			$current->p_department = $row["p_department"];
			$current->p_course_id = $row["p_course_id"];
			$current->p_course_title = $row["p_course_title"];
			$current->p_course_desc = $row["p_course_desc"];
			$current->p_extra_details = $row["p_extra_details"];
			$current->p_limit = $row["p_limit"];
			$current->p_prereqs = $row["p_prereqs"];
			$current->p_units = $row["p_units"];
			$current->p_crosslisting = $row["p_crosslisting"];
			$current->p_perspective = $row["p_perspective"];
			$current->rationale = $row["rationale"];
			$current->lib_impact = $row["lib_impact"];
			$current->tech_impact = $row["tech_impact"];
			$current->status = $row["status"];
			$current->p_aligned_assignments = $row["p_aligned_assignments"];
			$current->p_first_offering = $row["p_first_offering"];
			$current->p_course_status = $row["p_course_status"];
			$current->p_designation_scope = $row["p_designation_scope"];
			$current->p_designation_prof = $row["p_designation_prof"];
			$current->p_feedback = $row["p_feedback"];
			array_unshift($history, $current);	
		}				
		
		return $history;
	}
	
	public function getDepartments(){
		$depts = array();
		$q = "SELECT dept_code, dept_desc FROM departments";
		$r = mysqli_query($this->dbc, $q);
		while($department = mysqli_fetch_assoc($r)){
			array_push($depts, $department);
		}
		return $depts;
	}
	
	public function getDivision($dept_desc){
		$q = "SELECT divs_desc FROM departments WHERE dept_desc = '$dept_desc'";
		$r = mysqli_query($this->dbc, $q);
		$div = mysqli_fetch_assoc($r);
		return $div['divs_desc'];
	}
}

?>
