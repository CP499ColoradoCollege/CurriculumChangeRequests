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
				<?php if($criteria_array[0] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_course_id" style="font-size: 20px; float: right;">Course ID : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->subj_code.$course->course_num; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_course_title" style="font-size: 20px; float: right;">Course Title : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->course_title; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'c'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Course Description : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->course_desc; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'd'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Extra Details : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->extra_details; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'e'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Enrollment Limit : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->enrollment_limit; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'f'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'g'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'h'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'i'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'j'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php if($criteria_num > 1){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[1] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_course_title" style="font-size: 20px; float: right;">Course Title : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->course_title; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'c'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Course Description : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->course_desc; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'd'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Extra Details : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->extra_details; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'e'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Enrollment Limit : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->enrollment_limit; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'f'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'g'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'h'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'i'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'j'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 2){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[2] == 'c'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Course Description : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->course_desc; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'd'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Extra Details : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->extra_details; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'e'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Enrollment Limit : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->enrollment_limit; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'f'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'g'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'h'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'i'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'j'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 3){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[3] == 'd'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Extra Details : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->extra_details; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'e'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Enrollment Limit : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->enrollment_limit; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'f'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'g'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'h'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'i'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'j'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 4){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[4] == 'e'){ ?>
				<div class="col-md-3">
					<label for="p_course_desc" style="font-size: 20px; float: right;">Enrollment Limit : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->enrollment_limit; ?></p>
				</div>
				<?php }else if($criteria_array[4] == 'f'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[4] == 'g'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php }else if($criteria_array[4] == 'h'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[4] == 'i'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[4] == 'j'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[4] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[4] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 5){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[5] == 'f'){ ?>
				<div class="col-md-3">
					<label for="p_prereqs" style="font-size: 20px; float: right;">Course Prerequisites : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->prereqs; ?></p>
				</div>
				<?php }else if($criteria_array[5] == 'g'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php }else if($criteria_array[5] == 'h'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[5] == 'i'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[5] == 'j'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[5] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[5] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 6){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[6] == 'g'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php }else if($criteria_array[6] == 'h'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[6] == 'i'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[6] == 'j'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[6] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[6] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 7){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[0] == 'h'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[7] == 'i'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[7] == 'j'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[7] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[7] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 8){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[8] == 'i'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[8] == 'j'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[8] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[8] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 9){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[9] == 'j'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[9] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[9] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 10){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[10] == 'k'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[10] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
				</div>
				<?php } ?>
			</div>
			<?php }
			if($criteria_num > 11){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="col-md-2"></div>
				<?php if($criteria_array[11] == 'l'){ ?>
				<div class="col-md-3">
					<label for="p_perspective" style="font-size: 20px; float: right;">Perspective : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->perspective; ?></p>
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
					<?php if($criteria_array[0] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_course_id" style="font-size: 20px; float: right; text-align: right;">Proposed Course ID 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed 5 character ID for the course, containing subject code and course number (i.e. CP112)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_id" id="p_course_id" placeholder="i.e. 'CP112'" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_course_title" style="font-size: 20px; float: right; text-align: right;">Proposed Course Title 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[0] == 'd'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[0] == 'e'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == 'f'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == 'g'){ ?>
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
					<?php }else if($criteria_array[0] == 'h'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == 'i'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == 'j'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[0] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php if($criteria_num > 1){ ?>
				
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[1] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_course_title" style="font-size: 20px; float: right; text-align: right;">Proposed Course Title 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[1] == 'd'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[1] == 'e'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == 'f'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == 'g'){ ?>
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
					<?php }else if($criteria_array[1] == 'h'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == 'i'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == 'j'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[1] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
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
					
					<?php if($criteria_array[2] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[2] == 'd'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[2] == 'e'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off">
					</div>
					<?php }else if($criteria_array[2] == 'f'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[2] == 'g'){ ?>
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
					<?php }else if($criteria_array[2] == 'h'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off">
					</div>
					<?php }else if($criteria_array[2] == 'i'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off">
					</div>
					<?php }else if($criteria_array[2] == 'j'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off">
					</div>
					<?php }else if($criteria_array[2] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[2] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
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
					
					<?php if($criteria_array[3] == 'd'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"></textarea>
					</div>
					<?php }else if($criteria_array[3] == 'e'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off">
					</div>
					<?php }else if($criteria_array[3] == 'f'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[3] == 'g'){ ?>
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
					<?php }else if($criteria_array[3] == 'h'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off">
					</div>
					<?php }else if($criteria_array[3] == 'i'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off">
					</div>
					<?php }else if($criteria_array[3] == 'j'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off">
					</div>
					<?php }else if($criteria_array[3] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[3] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
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
					
					<?php if($criteria_array[4] == 'e'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off">
					</div>
					<?php }else if($criteria_array[4] == 'f'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[4] == 'g'){ ?>
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
					<?php }else if($criteria_array[4] == 'h'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off">
					</div>
					<?php }else if($criteria_array[4] == 'i'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off">
					</div>
					<?php }else if($criteria_array[4] == 'j'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off">
					</div>
					<?php }else if($criteria_array[4] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[4] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
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
					
					<?php if($criteria_array[5] == 'f'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off">
					</div>
					<?php }else if($criteria_array[5] == 'g'){ ?>
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
					<?php }else if($criteria_array[5] == 'h'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off">
					</div>
					<?php }else if($criteria_array[5] == 'i'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off">
					</div>
					<?php }else if($criteria_array[5] == 'j'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off">
					</div>
					<?php }else if($criteria_array[5] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[5] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
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
					
					<?php if($criteria_array[6] == 'g'){ ?>
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
					<?php }else if($criteria_array[6] == 'h'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off">
					</div>
					<?php }else if($criteria_array[6] == 'i'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off">
					</div>
					<?php }else if($criteria_array[6] == 'j'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off">
					</div>
					<?php }else if($criteria_array[6] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[6] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 7){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[7] == 'h'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off">
					</div>
					<?php }else if($criteria_array[7] == 'i'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off">
					</div>
					<?php }else if($criteria_array[7] == 'j'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off">
					</div>
					<?php }else if($criteria_array[7] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[7] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 8){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[8] == 'i'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off">
					</div>
					<?php }else if($criteria_array[8] == 'j'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off">
					</div>
					<?php }else if($criteria_array[8] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[8] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 9){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[9] == 'j'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off">
					</div>
					<?php }else if($criteria_array[9] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[9] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
			if($criteria_num > 10){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[10] == 'k'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off">
					</div>
					<?php }else if($criteria_array[10] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } 
			if($criteria_num > 11){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[11] == 'l'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perpective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning" selected>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process">Creative Process</option>
							<option value="Equity & Power - Global">Equity & Power - Global</option>
							<option value="Equity & Power - U.S.">Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic">Formal Reasoning & Logic</option>		
							<option value="Historical Perspectives">Historical Perspectives</option>
							<option value="Scientific Analysis">Scientific Analysis</option>
							<option value="Societies & Human Behaviors">Societies & Human Behaviors</option>
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


