
<div class="container">
	<div class="card">	<!-- start of card -->
		
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Change Existing Course Proposal</strong></h1>
		</div>
		
		<?php if(isset($message)){ echo $message; } ?>
		
		<form method="post" role="form">
			
			<div class="row shift-down">
				<div class="form-group">
					<div class="col-md-3"></div>
					<div class="col-md-4">
						<label for="existing_course_id" style="font-size: 20px; float: right;" value="<?php echo $_POST['existing_course_id']; ?>">Existing Course's Course ID
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The Course ID (i.e. AA999) of the course you wish to propose a change to">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : </label>
					</div>
					<div class="col-md-2">
						<input class="form-control input-md" type="text" name="existing_course_id" id="existing_course_id" autocomplete="off">
					</div>
					
				</div>
			</div>
		
		
		<p style="font-size: 20px; text-align: center; margin-top: 60px;"><strong>Please check all criteria that you would like to propose changing:</strong></p>
		
		<div class="col-md-4"></div>
		<div class="col-md-4">
				
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="course_id" name="course_id">						
						<label class="form-check-label change-label" for="defaultCheck1">
							Course ID
						</label>
					</div>
				</div>
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="course_title" name="course_title">
						<label class="form-check-label change-label" for="defaultCheck1">
							Course Title
						</label>
					</div>
				</div>
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="course_desc" name="course_desc">
						<label class="form-check-label change-label" for="defaultCheck1">
							Course Description
						</label>
					</div>
				</div>
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="extra_details" name="extra_details">
						<label class="form-check-label change-label" for="defaultCheck1">
							Extra Course Details
						</label>
					</div>
				</div>
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="enrollment_limit" name="enrollment_limit">
						<label class="form-check-label change-label" for="defaultCheck1">
							Enrollment Limit
						</label>
					</div>
				</div>
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="prerequisites" name="prerequisites">
						<label class="form-check-label change-label" for="defaultCheck1">
							Prerequisites
						</label>
					</div>
				</div>
				<div class="row" style="margin-top: 25px;">
					<div class="form-check div-left shift-right">
						<input class="form-check-input" type="checkbox" id="units" name="units">
						<label class="form-check-label change-label" for="defaultCheck1">
							Units
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5"></div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-home" style="float: center; margin-top: 50px; margin-bottom: 20px;"><strong>Save</strong></button>
						<input type="hidden" name="submitted" value="1">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
