
<div class="container">
	<div class="card">	<!-- start of card -->
		
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Change Course Proposal</strong></h1>
		</div>
		
		<?php if(isset($message)){ echo $message; } ?>
		
		
		<?php $criteria = $_GET['type'];
			$criteria_array = str_split($criteria);
			$criteria_num = count($criteria_array);
			
			$course_id = $_GET['cid'];
			$course_id_array = str_split($course_id);
			$subj_code = $course_id_array[0].$course_id_array[1];
			$course_number = $course_id_array[2].$course_id_array[3].$course_id_array[4];
			
			$statement = $dbc->prepare("SELECT id FROM courses WHERE subj_code = ? AND course_num = ?");
			$statement->bind_param("ss", $subj_code, $course_number);
			
			$bool = $statement->execute();
			$statement->store_result();
			$statement->bind_result($course_real_id);
			$statement->fetch();
			if($bool && mysqli_stmt_num_rows($statement) == 1){
				$q = "SELECT * FROM courses WHERE id = '$course_real_id'";
				$r = mysqli_query($dbc, $q);
				$course = mysqli_fetch_assoc($r);	
			}else{
				header("Location: change_course_proposal_select");
			}
		?>
		
		<div class="shift-down row">
			<p class="text-20 div-center"><strong>Course to be changed: <?php echo $course_id." ".$course['course_title']; ?></strong></p>
		</div>
		
		<div class="shift-down row">
				<div class="col-md-2"></div>
				<?php if($criteria_array[0] == '1'){ ?>
				<div class="col-md-3">
					<label style="font-size: 20px; float: right;">Department : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['dept_desc']; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '2'){ ?>
				<div class="col-md-3">
					<label for="p_course_id" style="font-size: 20px; float: right;">Course ID : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['subj_code'].$course['course_num']; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '3'){ ?>
				<div class="col-md-3">
					<label for="p_course_title" style="font-size: 20px; float: right;">Course Title : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['course_title']; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '4'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Course Description : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['course_desc']; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '5'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['prereqs']; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['units']; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php if($criteria_num > 1){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[1] == '2'){ ?>
				<div class="col-md-3">
					<label for="p_course_id" style="font-size: 20px; float: right;">Course ID : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['subj_code'].$course['course_num']; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '3'){ ?>
				<div class="col-md-3">
					<label for="p_course_title" style="font-size: 20px; float: right;">Course Title : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['course_title']; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '4'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Course Description : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['course_desc']; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '5'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['prereqs']; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['units']; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 2){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[2] == '3'){ ?>
				<div class="col-md-3">
					<label for="p_course_title" style="font-size: 20px; float: right;">Course Title : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['course_title']; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '4'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Course Description : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['course_desc']; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '5'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['prereqs']; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['units']; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 3){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[3] == '4'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Course Description : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['course_desc']; ?></p>
				</div>
				<?php }else if($criteria_array[3] == '5'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['prereqs']; ?></p>
				</div>
				<?php }else if($criteria_array[3] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['units']; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 4){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[4] == '5'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['prereqs']; ?></p>
				</div>
				<?php }else if($criteria_array[4] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['units']; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 5){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[5] == '6'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course['units']; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
		
		<form method="post" role="form">	<!-- fills in the form if a page is already open when reloaded-->
			<div class="shift-down row">
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<?php if($criteria_array[0] == '1'){ ?>
					<div class="col-md-3">
						<label for="p_department" style="font-size: 20px; float: right;">Proposed Department 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed department the course falls under">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_department" id="p_department" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == '2'){ ?>
					<div class="col-md-3">
						<label for="p_course_id" style="font-size: 20px; float: right;">Proposed Course ID 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed 5 character Course ID (i.e. AA999)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_id" id="p_course_id" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == '3'){ ?>
					<div class="col-md-3">
						<label for="p_course_title" style="font-size: 20px; float: right;">Proposed Course Title 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == '4'){ ?>
					<div class="col-md-3">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[0] == '5'){ ?>
					<div class="col-md-3">
						<label for="p_prereqs" style="font-size: 20px; float: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == '6'){ ?>
					<div class="col-md-3">
						<label for="p_units" style="font-size: 20px; float: right;">Proposed Units 
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
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					
					<?php if($criteria_array[1] == '2'){ ?>
					<div class="col-md-3">
						<label for="p_course_id" style="font-size: 20px; float: right;">Proposed Course ID 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed 5 character Course ID (i.e. AA999)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_id" id="p_course_id" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == '3'){ ?>
					<div class="col-md-3">
						<label for="p_course_title" style="font-size: 20px; float: right;">Proposed Course Title 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == '4'){ ?>
					<div class="col-md-3">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[1] == '5'){ ?>
					<div class="col-md-3">
						<label for="p_prereqs" style="font-size: 20px; float: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == '6'){ ?>
					<div class="col-md-3">
						<label for="p_units" style="font-size: 20px; float: right;">Proposed Units 
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
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					
					<?php if($criteria_array[2] == '3'){ ?>
					<div class="col-md-3">
						<label for="p_course_title" style="font-size: 20px; float: right;">Proposed Course Title 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off">
					</div>
					<?php }else if($criteria_array[2] == '4'){ ?>
					<div class="col-md-3">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[2] == '5'){ ?>
					<div class="col-md-3">
						<label for="p_prereqs" style="font-size: 20px; float: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[2] == '6'){ ?>
					<div class="col-md-3">
						<label for="p_units" style="font-size: 20px; float: right;">Proposed Units 
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
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					
					<?php if($criteria_array[3] == '4'){ ?>
					<div class="col-md-3">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[3] == '5'){ ?>
					<div class="col-md-3">
						<label for="p_prereqs" style="font-size: 20px; float: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[3] == '6'){ ?>
					<div class="col-md-3">
						<label for="p_units" style="font-size: 20px; float: right;">Proposed Units 
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
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					
					<?php if($criteria_array[4] == '5'){ ?>
					<div class="col-md-3">
						<label for="p_prereqs" style="font-size: 20px; float: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[4] == '6'){ ?>
					<div class="col-md-3">
						<label for="p_units" style="font-size: 20px; float: right;">Proposed Units 
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
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					
					<?php if($criteria_array[5] == '6'){ ?>
					<div class="col-md-3">
						<label for="p_units" style="font-size: 20px; float: right;">Proposed Units 
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
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-3">
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
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-3">
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
				<div class="form-group">	<!-- start of page form -->
					<div class="col-md-2"></div>
					<div class="col-md-3">
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



