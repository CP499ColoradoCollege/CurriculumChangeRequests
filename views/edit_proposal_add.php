<?php
/*
 * Edit Add a New Course Proposal Page:
 * This PHP file contains all HTML and PHP needed to produce the correct form to edit an existing Add a New Course Proposal
 */
?>

<?php
//Need to get the proposal's id from the page URL:
$pid = $_GET['pid'];

$proposal = new Proposal($dbc);
$proposal = $proposal->fetchProposalFromID($pid);

if($proposal == false){ //if the proposal doesn't exist/wasn't created by the current User
	header("Location: home");
}
?>

<div class="container">
	<div class="card">
		
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Edit Proposal "<?php echo $proposal->proposal_title;  ?>"</strong></h1>
		</div>
		
		<?php if(isset($message)){ echo $message; } ?>

		<!-- Edit Add a New Course Proposal form - the fields in this form contain the info already filled-in for the Proposal, which can then be editted -->
		<form method="post" role="form">
			<div class="shift-down row">
				<!-- Current Department -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Department</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The department the new course falls under">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> :
					</p></div>
					<div class="col-md-4">
						<select class="form-control input-sm" name="department" id="department">
							<?php 
							//below PHP gets all departments, and then determines which one was already chosen in the original Proposal
							$departments = $user->getDepartments();
							for($i = 0; $i < count($departments); $i += 1){
								$dept = $departments[$i];
								if($dept['dept_desc'] == $proposal->department){?>
									<option value="<?php echo $dept['dept_desc']; ?>" selected><?php echo $dept['dept_desc']; ?></option>
								<?php } else {
							?>
							<option value="<?php echo $dept['dept_desc']; ?>"><?php echo $dept['dept_desc']; ?></option>
							<?php }
								} ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Current Course ID -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Course ID</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The 5 character ID for the course (i.e. CP112)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</p></div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="course_id" id="course_id" placeholder="5 character course ID" autocomplete="off" value="<?php echo $proposal->p_course_id; ?>">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Current Course Title -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Course Title</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Title for the new course (i.e. Calculus I)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</p></div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="course_title" id="course_title" autocomplete="off" value="<?php echo $proposal->p_course_title; ?>">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Current Course Description -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Course Description</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Describes what the class is about/what students will learn">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</p></div>
					<div class="col-md-4">
						<textarea class="form-control input-md form-textbox" type="text" name="course_desc" id="course_desc" placeholder="Describe the new course" autocomplete="off"><?php echo $proposal->p_course_desc; ?></textarea>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Current Extra Details -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Extra Details</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</p></div>
					<div class="col-md-4">
						<textarea class="form-control input-md form-textbox" type="text" name="extra_details" id="extra_details" placeholder="i.e. Field trip, required fee, etc." autocomplete="off"><?php echo $proposal->p_extra_details; ?></textarea>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Current Enrollment Limit -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Enrollment Limit</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Maximum number of students that can sign up for a course (typically 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</p></div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="limit" id="limit" placeholder="typically 25 or 32" autocomplete="off" value="<?php echo $proposal->p_limit; ?>">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Current Course Prerequisites -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Course Prerequisites</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Courses required before students are eligible to take this one">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</p></div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="course_prereqs" id="course_prereqs" placeholder="Course IDs of prerequisite courses" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Current Course Units -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Course Units</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The 5 character ID for the course (i.e. CP112)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</p></div>
					<div class="col-md-4">
						<select class="input-sm" style="float: left;" name="course_units" id="course_units">
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Current Rationale -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Rationale:</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The rationale behind this new course proposal">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</p></div>
					<div class="col-md-4">
						<textarea class="form-control input-md form-textbox" type="text" name="rationale" id="rationale" placeholder="Reason for new course proposal" autocomplete="off"><?php echo $proposal->rationale; ?></textarea>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Current Library Impact -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Library Impact</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The impact on the library from this course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</p></div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="lib_impact" id="lib_impact" autocomplete="off" value="<?php echo $proposal->lib_impact; ?>">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Current Technology Impact -->
				<div class="form-group">
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Technology Impact</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The technology impact of this course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</p></div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="tech_impact" id="tech_impact" autocomplete="off" value="<?php echo $proposal->tech_impact; ?>">
					</div>
				</div>
			</div>
			<div class="row">
					<!-- Save Button -->
					<button type="submit" class="btn btn-home" style="margin-left: 48%; margin-top: 50px; margin-bottom: 20px; text-align: center;"><strong>Save</strong></button>
					<input type="hidden" name="pid" value="<?php echo $proposal->id; ?>">
					<input type="hidden" name="submitted" value="1">
			</div>
		</form>
		
	</div>
</div>