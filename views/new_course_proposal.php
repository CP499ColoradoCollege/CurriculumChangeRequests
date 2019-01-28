
<div class="container">
	<div class="card">	<!-- start of card -->
		
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Add New Course Proposal</strong></h1>
		</div>
		
		<form method="post" role="form">	<!-- fills in the form if a page is already open when reloaded-->
			<div class="shift-down row">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="course_id" style="font-size: 20px; float: right;">Course ID 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The 5 character ID for the course (i.e. CP112)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="course_id" id="course_id" placeholder="5 character course ID" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="course_title" style="font-size: 20px; float: right;">Course Title 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Title for the new course (i.e. Calculus I)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="course_title" id="course_title" placeholder="Title for the new course" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="course_desc" style="font-size: 20px; float: right;">Course Description 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Describes what the class is about/what students will learn">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="course_desc" id="course_desc" placeholder="Describe the new course" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
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
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="course_postreqs" style="font-size: 20px; float: right;">Course ID 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Courses for which you receive no credit after taking this course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="course_postreqs" id="course_postreqs" placeholder="Course IDs of postrequisite courses" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="course_units" style="font-size: 20px; float: right;">Course Units 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The 5 character ID for the course (i.e. CP112)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="course_units" id="course_units">
							<option value="1" selected>0 Units</option>
							<option value="2">0.25 Units</option>
							<option value="3">0.5 Units</option>
							<option value="4">1 Unit</option>
							<option value="5">2 Units</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="rationale" style="font-size: 20px; float: right;">Rationale 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The rationale behind this new course proposal">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="rationale" id="rationale" placeholder="Reason for new course proposal" autocomplete="off">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-home" style="float: center; margin-top: 50px; margin-bottom: 20px;">Save</button>
					<input type="hidden" name="submitted" value="1">
				</div>
			</div>
			

		</form>
										
		
		
	</div>
</div>
