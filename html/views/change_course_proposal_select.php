<?php
/*
 * Change Existing Course Proposal Select Page:
 * This PHP file contains all HTML and PHP needed for the site's Change Existing Course Proposal Select page, which is where the user indicates the course ID of the course to be changed as well as the criteria to propose changing
 * The form on this page redirects to the Change Existing Course Proposal page when submitted correctly
 */
?>

<div class="container">
	<div class="card">
		
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Change Existing Course Proposal</strong></h1>
		</div>
		
		<?php if(isset($message)){ echo $message; } ?>
		
		<!-- Change Existing Course Proposal Select form -->
		<form method="post" role="form">
			<div class="row shift-down">
				<!-- Existing Course ID -->
				<div class="form-group">
					<div class="col-md-3"></div>
					<div class="col-md-4">
						<label for="existing_course_id" style="font-size: 20px; float: right;" value="<?php echo $_POST['existing_course_id']; ?>">Existing Course's Course ID
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The 5 character Course ID (i.e. CP122) of the course you wish to propose a change to">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : </label>
					</div>
					<div class="col-md-2">
						<input class="form-control input-md" type="text" name="existing_course_id" id="existing_course_id" autocomplete="off" placeholder="i.e. CP122">
					</div>
				</div>
			</div>
		<p style="font-size: 20px; text-align: center; margin-top: 60px;"><strong>Please check all criteria that you would like to propose changing:</strong></p>
		<div class="col-md-4"></div>
		<div class="col-md-4">
				<!-- Course ID checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="course_id" name="course_id">						
						<label class="form-check-label change-label" for="defaultCheck1">Course ID</label>
					</div>
				</div>
				<!-- Course Title checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="course_title" name="course_title">
						<label class="form-check-label change-label" for="defaultCheck1">Course Title</label>
					</div>
				</div>
				<!-- Course Description checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="course_desc" name="course_desc">
						<label class="form-check-label change-label" for="defaultCheck1">Course Description</label>
					</div>
				</div>
				<!-- Extra Course Details checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="extra_details" name="extra_details">
						<label class="form-check-label change-label" for="defaultCheck1">Extra Course Details</label>
					</div>
				</div>
				<!-- Enrollment Limit checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="enrollment_limit" name="enrollment_limit">
						<label class="form-check-label change-label" for="defaultCheck1">Enrollment Limit</label>
					</div>
				</div>
				<!-- Prerequisites checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="prerequisites" name="prerequisites">
						<label class="form-check-label change-label" for="defaultCheck1">Prerequisites</label>
					</div>
				</div>
				<!-- Units checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="units" name="units">
						<label class="form-check-label change-label" for="defaultCheck1">Units</label>
					</div>
				</div>
				<!-- First Offering checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="first_offering" name="first_offering">
						<label class="form-check-label change-label" for="defaultCheck1">First Offering</label>
					</div>
				</div>
				<!-- Aligned Assignments checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="aligned_assignments" name="aligned_assignments">
						<label class="form-check-label change-label" for="defaultCheck1">Aligned Assignments</label>
					</div>
				</div>
				<!-- Designation Scope checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="designation_scope" name="designation_scope">
						<label class="form-check-label change-label" for="defaultCheck1">Designation Scope</label>
					</div>
				</div>
				<!-- Designation Professor(s) checkbox -->
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="designation_prof" name="designation_prof">
						<label class="form-check-label change-label" for="defaultCheck1">Designation Professor(s)</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5"></div>
					<div class="col-md-2">
						<!-- Save Button -->
						<button type="submit" class="btn btn-home" style="float: center; margin-top: 50px; margin-bottom: 20px;"><strong>Save</strong></button>
						<input type="hidden" name="submitted" value="1">
					</div>
				</div>
			</form>
			
		</div>
	</div>
</div>
