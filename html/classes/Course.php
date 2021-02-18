<?php

/* This class maps to the columns in our Courses table, and contains logic involved in managing Course queries
 */
 
 
class Course{
	
	public $dbc;
	
	public $id;
	
	public $subj_code;
	
	public $subj_desc;
	
	public $course_num;
	
	public $divs_code;
	
	public $divs_desc;
	
	public $dept_code;
	
	public $dept_desc;
	
	public $course_title;
	
	public $course_desc;
	
	public $extra_details;
	
	public $enrollment_limit;
	
	public $prereqs;
	
	public $units;
	
	public $crosslisting;
	
	public $perspective;
	
	public $date_last_modified;
	
	public $related_proposals;
	
	public $status;
	
	public function __construct($dbc){
		$this->dbc = $dbc;
	}
	
	public function fetchCourseFromCourseID($course_id){
		$dbc = $this->dbc;
		$course_id_array = str_split($course_id);
		
		$subj_code = $course_id_array[0].$course_id_array[1];
		$course_num = $course_id_array[2].$course_id_array[3].$course_id_array[4];
		$statement = $dbc->prepare("SELECT id, subj_desc, divs_code, divs_desc, dept_code, dept_desc, course_title, course_desc, extra_details, enrollment_limit, prereqs, units, crosslisting, perspective, date_last_modified, related_proposals, status FROM courses WHERE subj_code = ? AND course_num = ?");
		$statement->bind_param("ss", $subj_code, $course_num);
		
		$bool = $statement->execute();
		$statement->store_result();
		$statement->bind_result($id, $subj_desc, $divs_code, $divs_desc, $dept_code, $dept_desc, $course_title, $course_desc, $extra_details, $enrollment_limit, $prereqs, $units, $crosslisting, $perspective, $date_last_modified, $related_proposals, $status);
		$statement->fetch();
		
		if($bool && mysqli_stmt_num_rows($statement) == 1){
			
			$this->id = $id;
			$this->subj_code = $subj_code;
			$this->subj_desc = $subj_desc;
			$this->course_num = $course_num;
			$this->divs_code = $divs_code;
			$this->divs_desc = $divs_desc;
			$this->dept_code = $dept_code;
			$this->dept_desc = $dept_desc;
			$this->course_title = $course_title;
			$this->course_desc = $course_desc;
			$this->extra_details = $extra_details;
			$this->enrollment_limit = $enrollment_limit;
			$this->prereqs = $prereqs;
			$this->units = $units;
			$this->crosslisting = $crosslisting;
			$this->perspective = $perspective;
			$this->date_last_modified = $date_last_modified;
			$this->related_proposals = $related_proposals;
			$this->status = $status;
			return $this;
		}else{
			echo "afaeffa";
			return false;
		}
	}


	public function fetchCourseFromTitle($course_title){
		
		$statement = $this->dbc->prepare("SELECT id, subj_code, subj_desc, course_num, divs_code, divs_desc, dept_code, dept_desc, course_desc, extra_details, enrollment_limit, prereqs, units, crosslisting, perspective, date_last_modified, related_proposals, status FROM courses WHERE course_title = ?");
		$statement->bind_param("s", $course_title);
		
		$bool = $statement->execute();
		$statement->store_result();
		$statement->bind_result($id, $subj_code, $subj_desc, $course_num, $divs_code, $divs_desc, $dept_code, $dept_desc, $course_desc, $extra_details, $enrollment_limit, $prereqs, $units, $crosslisting, $perspective, $date_last_modified, $related_proposals, $status);
		$statement->fetch();
		if($bool && mysqli_stmt_num_rows($statement) == 1){
			
			$this->id = $id;
			$this->subj_code = $subj_code;
			$this->subj_desc = $subj_desc;
			$this->course_num = $course_num;
			$this->divs_code = $divs_code;
			$this->divs_desc = $divs_desc;
			$this->dept_code = $dept_code;
			$this->dept_desc = $dept_desc;
			$this->course_title = $course_title;
			$this->course_desc = $course_desc;
			$this->extra_details = $extra_details;
			$this->enrollment_limit = $enrollment_limit;
			$this->prereqs = $prereqs;
			$this->units = $units;
			$this->crosslisting = $crosslisting;
			$this->perspective = $perspective;
			$this->date_last_modified = $date_last_modified;
			$this->related_proposals = $related_proposals;
			$this->status = $status;
			return $this;
		}else{
			//echo "Error: Less than/Greater than 1 row returned, can not be saved as 1 Course.";
			return false;
		}
	}
	
	
	
}


?>
