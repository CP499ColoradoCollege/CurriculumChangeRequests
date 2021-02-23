<?php
/*
 * Edit Remove an Existing Course Proposal Page:
 * This PHP file contains all HTML and PHP needed to produce the correct form to edit an existing Remove an Existing Course Proposal
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

$course = new Course($dbc);
$course = $course->fetchCourseFromCourseID($proposal->related_course_id);

if($course == false){ //if the course doesn't exist
	header("Location: home");
}

?>



<div class="container">
	<div class="card">
		
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Edit Proposal "<?php echo $proposal->proposal_title;  ?>"</strong></h1>
		</div>
		
		<?php if(isset($message)){ echo $message; }?>
		
		<p style="text-align: center; font-size: 18px; margin-top: 20px;"><strong>Check with the <span style="color: red;">department</span> before requesting to drop a course!<br>The course may be a prerequisite for another course, or a Major/Minor requirement.</strong></p>			
						
		<!-- Edit Remove an Existing Course Proposal form - the fields in this form contain the info already filled-in for the Proposal, which can then be editted -->
		<form method="post" role="form">
			<div class="shift-down row">
				<!-- Course ID of Course to be Removed -->
				<div class="form-group">
					<div class="col-md-5">
						<label for="existing_course_id" style="font-size: 20px; float: right; text-align: right;">Course ID of Course to be Dropped
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The Course ID (i.e. CP112) of the course you wish to drop">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="existing_course_id" id="existing_course_id" placeholder="i.e. CP122" autocomplete="off" value="<?php echo $course->subj_code.$course->course_num;?>">
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-top: 25px;">
				<!-- Rationale -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="rationale" style="font-size: 20px; float: right;">Rationale : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md form-textbox" type="text" name="rationale" id="rationale" placeholder="Reason for dropping this course" autocomplete="off"><?php echo $proposal->rationale; ?></textarea>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Library Impact -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="lib_impact" style="font-size: 20px; float: right;">Library Impact 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The impact on the library from removing this course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="lib_impact" id="lib_impact" autocomplete="off" value="<?php echo $proposal->lib_impact; ?>">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<!-- Technology Impact -->
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="tech_impact" style="font-size: 20px; float: right;">Technology Impact 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The technology impact of removing this course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i> 
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="tech_impact" id="tech_impact" autocomplete="off" value="<?php echo $proposal->tech_impact; ?>">
					</div>
				</div>
			</div>
			<div class="row">
					<!-- Save Button -->
					<button type="submit" class="btn btn-home" style="margin-left: 48%; margin-top: 50px; margin-bottom: 20px;"><strong>Save</strong></button>
					<input type="hidden" name="submitted" value="1">
			</div>
		</form>					
		
	</div>
</div>