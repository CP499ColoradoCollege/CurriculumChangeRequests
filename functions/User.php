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
		$statement = $this->dbc->prepare("SELECT email, first_name, last_name, username, department, position, permission, status FROM users WHERE id = ?");
		$statement->bind_param("s", $id);
		
		$bool = $statement->execute();
		$statement->store_result();
		$statement->bind_result($email, $first_name, $last_name, $username, $department, $position, $permission, $status);
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
		$q = "SELECT id FROM proposals WHERE user_id = '$this->id'";
		$r = mysqli_query($this->dbc, $q);
		while($proposal_id = mysqli_fetch_assoc($r)){
			$current = new Proposal($this->dbc);
			$current = $current->fetchProposalFromID($proposal_id['id']);
			array_push($proposals, $current);
		}
		return $proposals;
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
