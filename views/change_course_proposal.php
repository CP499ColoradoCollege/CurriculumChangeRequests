<?php
/*
 * Change Existing Course Proposal Page:
 * This PHP file contains all HTML and PHP needed for the site's Change Existing Course Proposal page to generate, including generating the correct form via the information from the Change Existing Course Proposal Select page
 * The form on this page redirects to the Home page when submitted correctly
 */
?>

<div class="container">
	<div class="card">
		
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Change Course Proposal</strong></h1>
		</div>
		
		<?php if(isset($message)){ echo $message; } ?>
		
		
		<?php 
			/*
			 * This page contains important info in the URL; need to save this info as variables, $criteria and $course_id, and use info to fetch data from database
			 */
			$criteria = $_GET['type'];
			$criteria_array = str_split($criteria);
			$criteria_num = count($criteria_array);
			
			$course_id = $_GET['cid'];
			$course = new Course($dbc);
			$course = $course->fetchCourseFromCourseID($course_id);
			
			if($course == false){ 	//redirects the user if the URL contains an invalid course ID
				header("Location: change_course_proposal_select");
			}
			
		?>
		
		
		<!-- the below HTML is for displaying info about the existing course, showing only fields that have been proposed for change -->
		<div class="shift-down row">
			<p class="text-20 div-center"><strong>Course to be changed: <?php echo $course_id." ".$course->course_title; ?></strong></p>
		</div>
		
		<div class="shift-down row">
				<div class="col-md-2"></div>
				<?php if($criteria_array[0] == '1'){ ?>
				<div class="col-md-3">
					<label for="p_course_id" style="font-size: 20px; float: right;">Course ID : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->subj_code.$course->course_num; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '2'){ ?>
				<div class="col-md-3">
					<label for="p_course_title" style="font-size: 20px; float: right;">Course Title : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->course_title; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '3'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Course Description : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->course_desc; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '4'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Extra Details : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->extra_details; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '5'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Enrollment Limit : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->enrollment_limit; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '7'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php if($criteria_num > 1){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[1] == '2'){ ?>
				<div class="col-md-3">
					<label for="p_course_title" style="font-size: 20px; float: right;">Course Title : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->course_title; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '3'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Course Description : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->course_desc; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '4'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Extra Details : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->extra_details; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '5'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Enrollment Limit : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->enrollment_limit; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '7'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 2){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[2] == '3'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Course Description : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->course_desc; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '4'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Extra Details : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->extra_details; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '5'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Enrollment Limit : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->enrollment_limit; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '7'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 3){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[3] == '4'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Extra Details : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->extra_details; ?></p>
				</div>
				<?php }else if($criteria_array[3] == '5'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Enrollment Limit : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->enrollment_limit; ?></p>
				</div>
				<?php }else if($criteria_array[3] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[3] == '7'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 4){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[4] == '5'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Enrollment Limit : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->enrollment_limit; ?></p>
				</div>
				<?php }else if($criteria_array[4] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[4] == '7'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 5){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[5] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[5] == '7'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 6){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[6] == '7'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			
			<!-- END existing course info HTML -->
		
		
		<!-- Change Existing Course Proposal form - this form dynamically includes only the criteria that were selected to be changed on the Change Existing Course Proposal Select page -->
		<form method="post" role="form">
			<div class="shift-down row">
				<div class="form-group">
					<div class="col-md-1"></div>
					<?php if($criteria_array[0] == '1'){ ?>
					<div class="col-md-4">
						<label for="p_course_id" style="font-size: 20px; float: right; text-align: right;">Proposed Course ID 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed 5 character ID for the course, containing subject code and course number (i.e. CP112)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_id" id="p_course_id" placeholder="i.e. 'CP112'" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == '2'){ ?>
					<div class="col-md-4">
						<label for="p_course_title" style="font-size: 20px; float: right; text-align: right;">Proposed Course Title 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == '3'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[0] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[0] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == '7'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 20px; float: right; text-align: right;">Proposed Units 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_units" id="p_units">
							<option value="0 Units" selected>0 Units</option>
							<option value="0.25 Units">0.25 Units</option>
							<option value="0.5 Units">0.5 Units</option>
							<option value="1 Unit">1 Unit</option>
							<option value="2 Units">2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php if($criteria_num > 1){ ?>
				
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[1] == '2'){ ?>
					<div class="col-md-4">
						<label for="p_course_title" style="font-size: 20px; float: right; text-align: right;">Proposed Course Title 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == '3'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[1] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[1] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == '7'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 20px; float: right; text-align: right;">Proposed Units 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_units" id="p_units">
							<option value="0 Units" selected>0 Units</option>
							<option value="0.25 Units">0.25 Units</option>
							<option value="0.5 Units">0.5 Units</option>
							<option value="1 Unit">1 Unit</option>
							<option value="2 Units">2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 2){ ?>
			
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[2] == '3'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[2] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[2] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off">
					</div>
					<?php }else if($criteria_array[2] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[2] == '7'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 20px; float: right; text-align: right;">Proposed Units 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_units" id="p_units">
							<option value="0 Units" selected>0 Units</option>
							<option value="0.25 Units">0.25 Units</option>
							<option value="0.5 Units">0.5 Units</option>
							<option value="1 Unit">1 Unit</option>
							<option value="2 Units">2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 3){ ?>
				
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[3] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[3] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off">
					</div>
					<?php }else if($criteria_array[3] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[3] == '7'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 20px; float: right; text-align: right;">Proposed Units 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_units" id="p_units">
							<option value="0 Units" selected>0 Units</option>
							<option value="0.25 Units">0.25 Units</option>
							<option value="0.5 Units">0.5 Units</option>
							<option value="1 Unit">1 Unit</option>
							<option value="2 Units">2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 4){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[4] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off">
					</div>
					<?php }else if($criteria_array[4] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[4] == '7'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 20px; float: right; text-align: right;">Proposed Units 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_units" id="p_units">
							<option value="0 Units" selected>0 Units</option>
							<option value="0.25 Units">0.25 Units</option>
							<option value="0.5 Units">0.5 Units</option>
							<option value="1 Unit">1 Unit</option>
							<option value="2 Units">2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 5){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[5] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[5] == '7'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 20px; float: right; text-align: right;">Proposed Units 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_units" id="p_units">
							<option value="0 Units" selected>0 Units</option>
							<option value="0.25 Units">0.25 Units</option>
							<option value="0.5 Units">0.5 Units</option>
							<option value="1 Unit">1 Unit</option>
							<option value="2 Units">2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 6){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[6] == '7'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 20px; float: right; text-align: right;">Proposed Units 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_units" id="p_units">
							<option value="0 Units" selected>0 Units</option>
							<option value="0.25 Units">0.25 Units</option>
							<option value="0.5 Units">0.5 Units</option>
							<option value="1 Unit">1 Unit</option>
							<option value="2 Units">2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="rationale" style="font-size: 20px; float: right;">Rationale 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The rationale behind this change existing course proposal">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md form-textbox" type="text" name="rationale" id="rationale" placeholder="Reason for change existing course proposal" autocomplete="off"></textarea>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="lib_impact" style="font-size: 20px; float: right;">Library Impact 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The impact on the library from this course change">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="lib_impact" id="lib_impact" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="tech_impact" style="font-size: 20px; float: right;">Technology Impact 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The technology impact of this course change">
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
					<button type="submit" class="btn btn-home" style="float: none; margin-top: 50px; margin-bottom: 20px; margin-left: 40%;"><strong>Save</strong></button>
					<input type="hidden" name="submitted" value="1">
				</div>
			</div>
		</form>
		
	</div>
</div>



