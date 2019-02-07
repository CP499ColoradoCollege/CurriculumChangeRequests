<?php
$pid = $_GET['pid'];
$proposal = new Proposal($dbc);
$proposal = $proposal->fetchProposalFromID($pid);

$title_array = explode(" ", $proposal->proposal_title);
$p_type = $title_array[0];

?>

<div class="container">
	<div class="card">	<!-- start of card -->
		
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Edit Proposal "<?php echo $proposal->proposal_title;  ?>"</strong></h1>
		</div>
		
		<?php
		//if the first word is change, keep going until you hit of
			
			if($p_type == 'New'){
				//load a new course proposal form
		?>
		
		
		<form method="post" role="form">	<!-- fills in the form if a page is already open when reloaded-->
			<div class="shift-down row">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-4"><p style="font-size: 16px;"><strong>Current Department</strong>
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The department the new course falls under">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> :
					</p></div>
					<div class="col-md-4">
						<select class="form-control input-sm" name="department" id="department">
							<?php 
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
				<div class="form-group">	<!-- start of page form -->
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
				<div class="form-group">	<!-- start of page form -->
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
				<div class="form-group">	<!-- start of page form -->
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
				<div class="form-group">	<!-- start of page form -->
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
				<div class="form-group">	<!-- start of page form -->
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
				<div class="form-group">	<!-- start of page form -->
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
				<div class="form-group">	<!-- start of page form -->
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
				<div class="form-group">	<!-- start of page form -->
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
				
					<button type="submit" class="btn btn-home" style="margin-left: 48%; margin-top: 50px; margin-bottom: 20px; text-align: center;"><strong>Save</strong></button>
					<input type="hidden" name="pid" value="<?php echo $proposal->id; ?>">
					<input type="hidden" name="submitted" value="1">
			</div>
			

		</form>
		
				
		<?php	}else if($p_type == 'Change'){
				//load a change existing course proposal form
			
			$criteria = $proposal->criteria;
			$criteria_array = str_split($criteria);
			$criteria_num = count($criteria_array);
			
			$course_id = $proposal->related_course_id;
			$course = new Course($dbc);
			$course = $course->fetchCourseFromCourseID($course_id);
			
			if($course == false){
				header("Location: home");
			}
			
		?>
		
		<div class="shift-down row">
			<p class="text-20 div-center"><strong>Course to be changed: <?php echo $course->subj_code.$course->course_num." ".$course->course_title; ?></strong></p>
		</div>
		
		<div class="shift-down row">
				<?php if($criteria_array[0] == '1'){ ?>
				<div class="col-md-4">
					<label style="font-size: 16px; float: left; text-align: left;">Current Department : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->dept_desc; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '2'){ ?>
				<div class="col-md-4">
					<label for="p_course_id" style="font-size: 16px; float: left; text-align: left;">Current Course ID : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->subj_code.$course->course_num; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '3'){ ?>
				<div class="col-md-4">
					<label for="p_course_title" style="font-size: 16px; float: left; text-align: left;">Current Course Title : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->course_title; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '4'){ ?>
				<div class="col-md-4">
					<label for="p_course_desc" style="font-size: 16px; float: left; text-align: left;">Current Course Description : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->course_desc; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '5'){ ?>
				<div class="col-md-4">
					<label for="p_prereqs" style="font-size: 16px; float: left; text-align: left;">Current Course Prerequisites : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '6'){ ?>
				<div class="col-md-4">
					<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Current Units : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php if($criteria_num > 1){ ?>
			<div class="row" style="margin-top: 25px;">
				<?php if($criteria_array[1] == '2'){ ?>
				<div class="col-md-4">
					<label for="p_course_id" style="font-size: 16px; float: left; text-align: left;">Current Course ID : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->subj_code.$course->course_num; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '3'){ ?>
				<div class="col-md-4">
					<label for="p_course_title" style="font-size: 16px; float: left; text-align: left;">Current Course Title : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->course_title; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '4'){ ?>
				<div class="col-md-4">
					<label for="p_course_desc" style="font-size: 16px; float: left; text-align: left;">Current Course Description : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->course_desc; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '5'){ ?>
				<div class="col-md-4">
					<label for="p_prereqs" style="font-size: 16px; float: left; text-align: left;">Current Course Prerequisites : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '6'){ ?>
				<div class="col-md-4">
					<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Current Units : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 2){ ?>
			<div class="row" style="margin-top: 25px;">
				<?php if($criteria_array[2] == '3'){ ?>
				<div class="col-md-4">
					<label for="p_course_title" style="font-size: 16px; float: left; text-align: left;">Current Course Title : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->course_title; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '4'){ ?>
				<div class="col-md-4">
					<label for="p_course_desc" style="font-size: 16px; float: left; text-align: left;">Current Course Description : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->course_desc; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '5'){ ?>
				<div class="col-md-4">
					<label for="p_prereqs" style="font-size: 16px; float: left; text-align: left;">Current Course Prerequisites : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '6'){ ?>
				<div class="col-md-4">
					<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Current Units : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 3){ ?>
			<div class="row" style="margin-top: 25px;">
				<?php if($criteria_array[3] == '4'){ ?>
				<div class="col-md-4">
					<label for="p_course_desc" style="font-size: 16px; float: left; text-align: left;">Current Course Description : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->course_desc; ?></p>
				</div>
				<?php }else if($criteria_array[3] == '5'){ ?>
				<div class="col-md-4">
					<label for="p_prereqs" style="font-size: 16px; float: left; text-align: left;">Current Course Prerequisites : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[3] == '6'){ ?>
				<div class="col-md-4">
					<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Current Units : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 4){ ?>
			<div class="row" style="margin-top: 25px;">
				<?php if($criteria_array[4] == '5'){ ?>
				<div class="col-md-4">
					<label for="p_prereqs" style="font-size: 16px; float: left; text-align: left;">Current Course Prerequisites : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[4] == '6'){ ?>
				<div class="col-md-4">
					<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Current Units : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 5){ ?>
			<div class="row" style="margin-top: 25px;">
				<?php if($criteria_array[5] == '6'){ ?>
				<div class="col-md-4">
					<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Current Units : 
				</div>
				<div class="col-md-4">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
		
		<form method="post" role="form">	<!-- fills in the form if a page is already open when reloaded-->
			<div class="shift-down row">
				<div class="form-group">	<!-- start of page form -->
					<?php if($criteria_array[0] == '1'){ ?>
					<div class="col-md-4">
						<label for="p_department" style="font-size: 16px; float: left; text-align: left;">Proposed Department
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed department the course falls under">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<select class="form-control input-sm" name="department" id="department">
							<?php 
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
					<?php }else if($criteria_array[0] == '2'){ ?>
					<div class="col-md-4">
						<label for="p_course_id" style="font-size: 16px; float: left; text-align: left;">Proposed Course ID
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed 5 character Course ID (i.e. AA999)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_course_id" id="p_course_id" autocomplete="off" value="<?php echo $proposal->p_course_id; ?>">
					</div>
					<?php }else if($criteria_array[0] == '3'){ ?>
					<div class="col-md-4">
						<label for="p_course_title" style="font-size: 16px; float: left; text-align: left;">Proposed Course Title
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off" value="<?php echo $proposal->p_course_title; ?>">
					</div>
					<?php }else if($criteria_array[0] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 16px; float: left; text-align: left;">Proposed Course Description
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"><?php echo $proposal->p_course_desc; ?></textarea>
					</div>
					<?php }else if($criteria_array[0] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 16px; float: left; text-align: left;">Proposed Course Prerequisites
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
					</div>
					<?php }else if($criteria_array[0] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Proposed Units
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<select class="input-sm" style="float: left;" name="course_units" id="course_units">
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php if($criteria_num > 1){ ?>
				
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->					
					<?php if($criteria_array[1] == '2'){ ?>
					<div class="col-md-4">
						<label for="p_course_id" style="font-size: 16px; float: left; text-align: left;">Proposed Course ID
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed 5 character Course ID (i.e. AA999)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_course_id" id="p_course_id" autocomplete="off" value="<?php echo $proposal->p_course_id; ?>">
					</div>
					<?php }else if($criteria_array[1] == '3'){ ?>
					<div class="col-md-4">
						<label for="p_course_title" style="font-size: 16px; float: left; text-align: left;">Proposed Course Title
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off" value="<?php echo $proposal->p_course_title; ?>">
					</div>
					<?php }else if($criteria_array[1] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 16px; float: left; text-align: left;">Proposed Course Description
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"><?php echo $proposal->p_course_desc; ?></textarea>
					</div>
					<?php }else if($criteria_array[1] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 16px; float: left; text-align: left;">Proposed Course Prerequisites
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
					</div>
					<?php }else if($criteria_array[1] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Proposed Units
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<select class="input-sm" style="float: left;" name="course_units" id="course_units">
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 2){ ?>
			
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->					
					<?php if($criteria_array[2] == '3'){ ?>
					<div class="col-md-4">
						<label for="p_course_title" style="font-size: 16px; float: left; text-align: left;">Proposed Course Title
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off" value="<?php echo $proposal->p_course_title; ?>">
					</div>
					<?php }else if($criteria_array[2] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 16px; float: left; text-align: left;">Proposed Course Description
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"><?php echo $proposal->p_course_desc; ?></textarea>
					</div>
					<?php }else if($criteria_array[2] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 16px; float: left; text-align: left;">Proposed Course Prerequisites
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
					</div>
					<?php }else if($criteria_array[2] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Proposed Units
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<select class="input-sm" style="float: left;" name="course_units" id="course_units">
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 3){ ?>
				
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->					
					<?php if($criteria_array[3] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 16px; float: left; text-align: left;">Proposed Course Description
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"><?php echo $proposal->p_course_desc; ?></textarea>
					</div>
					<?php }else if($criteria_array[3] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 16px; float: left; text-align: left;">Proposed Course Prerequisites
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
					</div>
					<?php }else if($criteria_array[3] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Proposed Units
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<select class="input-sm" style="float: left;" name="course_units" id="course_units">
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 4){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->					
					<?php if($criteria_array[4] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 16px; float: left; text-align: left;">Proposed Course Prerequisites
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
					</div>
					<?php }else if($criteria_array[4] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Proposed Units
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<select class="input-sm" style="float: left;" name="course_units" id="course_units">
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 5){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->					
					<?php if($criteria_array[5] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_units" style="font-size: 16px; float: left; text-align: left;">Proposed Units
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed units for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<select class="input-sm" style="float: left;" name="course_units" id="course_units">
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-4">
						<label for="rationale" style="font-size: 16px; float: left; text-align: left;">Rationale
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The rationale behind this change existing course proposal">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md form-textbox" type="text" name="rationale" id="rationale" placeholder="Reason for change existing course proposal" autocomplete="off"><?php echo $proposal->rationale; ?></textarea>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-4">
						<label for="lib_impact" style="font-size: 16px; float: left; text-align: left;">Library Impact
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The impact on the library from this course change">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="lib_impact" id="lib_impact" autocomplete="off" value="<?php echo $proposal->lib_impact; ?>">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-4">
						<label for="tech_impact" style="font-size: 16px; float: left; text-align: left;">Technology Impact
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The technology impact of this course change">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="tech_impact" id="tech_impact" autocomplete="off" value="<?php echo $proposal->tech_impact; ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-home" style="float: none; margin-top: 50px; margin-bottom: 20px; margin-left: 40%;"><strong>Save</strong></button>
					<input type="hidden" name="pid" value="<?php echo $proposal->id; ?>">
					<input type="hidden" name="submitted" value="1">
				</div>
			</div>
		</form>
		
	</div>
</div>

		
		<?php  }else if($p_type == 'Remove'){
				//load a remove existing course proposal form
				$course = new Course($dbc);
				$course = $course->fetchCourseFromCourseID($proposal->related_course_id);
				
				if($course == false){
					header("Location: home");
				}
		?>
				
		<form method="post" role="form">	<!-- fills in the form if a page is already open when reloaded-->
			<div class="shift-down row">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<label for="existing_course_id" style="font-size: 16px; float: left; text-align: left;">Course ID of Course to be Removed
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The Course ID (i.e. AA999) of the course you wish to remove">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="existing_course_id" id="existing_course_id" autocomplete="off" value="<?php echo $course->subj_code.$course->course_num;?>">
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<label for="rationale" style="font-size: 16px; float: left; text-align: left;">Rationale
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The rationale behind this removing course proposal">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<textarea class="form-control input-md form-textbox" type="text" name="rationale" id="rationale" placeholder="Reason for removing course proposal" autocomplete="off"><?php echo $proposal->rationale; ?></textarea>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<label for="lib_impact" style="font-size: 16px; float: right;">Library Impact
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The impact on the library from removing this course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="lib_impact" id="lib_impact" autocomplete="off" value="<?php echo $proposal->lib_impact; ?>">
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<label for="tech_impact" style="font-size: 16px; float: right;">Technology Impact
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The technology impact of removing this course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i> 
						</button> : 
					</div>
					<div class="col-md-4">
						<input class="form-control input-md" type="text" name="tech_impact" id="tech_impact" autocomplete="off" value="<?php echo $proposal->tech_impact; ?>">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-home" style="float: center; margin-top: 50px; margin-bottom: 20px;"><strong>Save</strong></button>
					<input type="hidden" name="pid" value="<?php echo $proposal->id; ?>">
					<input type="hidden" name="submitted" value="1">
				</div>
			</div>
			

		</form>	
				
		<?php	}else{
				header("Location: home");
			}

		?>
		
	</div>
</div>
