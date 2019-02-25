<?php
/*
 * New Course Proposal Page:
 * This PHP file contains all HTML and PHP needed for the site's Add New Course Proposal page to generate, including the form for an Add New Course proposal
 * The form on this page redirects to the Home page when submitted correctly
 */
?>

<div class="container">
	<div class="card">
		
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Add New Course Proposal</strong></h1>
		</div>
		
		<?php if(isset($message)){ echo $message; } ?>
		
		<!-- Add New Course Proposal form -->
		<form method="post" role="form">
			<div class="shift-down row">
				<!-- Department -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="department" style="font-size: 20px; float: right;">Department : 
					</div>
					<div class="col-md-3">
						<select class="form-control input-sm" name="department" id="department">
							<?php 
							$departments = $user->getDepartments();
							for($i = 0; $i < count($departments); $i += 1){
								$dept = $departments[$i];
							?>
							<option value="<?php echo $dept['dept_desc']; ?>"><?php echo $dept['dept_desc']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Course ID -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="course_id" style="font-size: 20px; float: right;">Course ID
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The 5 character ID for the course, containing subject code and course number (i.e. CP112)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="course_id" id="course_id" placeholder="i.e. 'CP112'" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Course Title -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="course_title" style="font-size: 20px; float: right;">Course Title : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="course_title" id="course_title" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Course Description -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="course_desc" style="font-size: 20px; float: right;">Course Description
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Describes what the class is about/what students will learn">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md form-textbox" type="text" name="course_desc" id="course_desc" placeholder="Describe the new course" autocomplete="off"></textarea>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Extra Details -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="extra_details" style="font-size: 20px; float: right;">Extra Details
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md form-textbox" type="text" name="extra_details" id="extra_details" placeholder="i.e. Field trip, required fee, etc." autocomplete="off"></textarea>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Enrollment Limit -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="p_limit" style="font-size: 20px; float: right;">Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Maximum number of students that can sign up for a course (typically 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" placeholder="typically 25 or 32" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Course Prerequisites -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="course_prereqs" style="font-size: 20px; float: right;">Course Prerequisites
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Courses required before students are eligible to take this one">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="course_prereqs" id="course_prereqs" placeholder="Course IDs of prerequisite courses" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Course Units -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="course_units" style="font-size: 20px; float: right;">Course Units
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Units of credit received for taking this course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="course_units" id="course_units">
							<option value="0 Units" selected>0 Units</option>
							<option value="0.25 Units">0.25 Units</option>
							<option value="0.5 Units">0.5 Units</option>
							<option value="1 Unit">1 Unit</option>
							<option value="2 Units">2 Units</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Rationale -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="rationale" style="font-size: 20px; float: right;">Rationale
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The rationale behind this new course proposal">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md form-textbox" type="text" name="rationale" id="rationale" placeholder="Reason for new course proposal" autocomplete="off"></textarea>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Library Impact -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="lib_impact" style="font-size: 20px; float: right;">Library Impact
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The impact on the library from this course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="lib_impact" id="lib_impact" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Technology Impact -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="tech_impact" style="font-size: 20px; float: right;">Technology Impact
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The technology impact of this course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="tech_impact" id="tech_impact" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
					<!-- Save Proposal Button -->
					<button type="submit" class="btn btn-home" style="float: center; margin-top: 50px; margin-bottom: 20px;"><strong>Save</strong></button>
					<input type="hidden" name="submitted" value="1">
				</div>
			</div>
		</form>
										
	</div>
</div>
