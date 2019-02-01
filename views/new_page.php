

<div class="container">
	<div class="card">	<!-- start of card -->
		
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>New Page</strong></h1>
		</div>
		
		<?php if(isset($message)){ echo $message; }?>
					
						
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
				<div class="form-group">	<!-- start of page form -->
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
				<div class="form-group">	<!-- start of page form -->
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
					<button type="submit" class="btn btn-home" style="float: center; margin-top: 50px; margin-bottom: 20px;"><strong>Save</strong></button>
					<input type="hidden" name="submitted" value="1">
				</div>
			</div>
			

		</form>					
		
		
	</div>
</div>
