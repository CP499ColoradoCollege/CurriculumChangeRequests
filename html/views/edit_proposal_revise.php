<?php
/*
 * Edit Change an Existing Course Proposal Page:
 * This PHP file contains all HTML and PHP needed to produce the correct form to edit an existing Change an Existing Course Proposal
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

$criteria = $proposal->criteria;
$criteria_array = str_split($criteria);
$criteria_num = count($criteria_array);

$course_id = $proposal->related_course_id;
$course = new Course($dbc);
$course = $course->fetchCourseFromCourseID($course_id);

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
		
		<?php if(isset($message)){ echo $message; } ?>
		
		<!-- the below HTML will dynamically display the info about the Course to be changed based on the Proposal's criteria-->
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
				<?php }else if($criteria_array[0] == '8'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[0] == '9'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[0] == 'c'){ ?>
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
				<?php }else if($criteria_array[1] == '8'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[1] == '9'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[1] == 'c'){ ?>
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
				<?php }else if($criteria_array[2] == '8'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[2] == '9'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[2] == 'c'){ ?>
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
				<?php }else if($criteria_array[3] == '8'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[3] == '9'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[3] == 'c'){ ?>
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
				<?php }else if($criteria_array[4] == '8'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[4] == '9'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[4] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[4] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[4] == 'c'){ ?>
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
				<?php }else if($criteria_array[5] == '8'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[5] == '9'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[5] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[5] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[5] == 'c'){ ?>
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
				<?php if($criteria_array[6] == '7'){ ?>
				<div class="col-md-3">
					<label for="p_units" style="font-size: 20px; float: right;">Units : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->units; ?></p>
				</div>
				<?php }else if($criteria_array[6] == '8'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[6] == '9'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[6] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[6] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[6] == 'c'){ ?>
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
				<?php if($criteria_array[0] == '8'){ ?>
				<div class="col-md-3">
					<label for="p_first_offering" style="font-size: 20px; float: right;">First Offering : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->first_offering; ?></p>
				</div>
				<?php }else if($criteria_array[7] == '9'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[7] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[7] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[7] == 'c'){ ?>
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
				<?php if($criteria_array[8] == '9'){ ?>
				<div class="col-md-3">
					<label for="p_aligned_assignments" style="font-size: 20px; float: right;">Aligned Assignments : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->aligned_assignments; ?></p>
				</div>
				<?php }else if($criteria_array[8] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[8] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[8] == 'c'){ ?>
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
				<?php if($criteria_array[9] == 'a'){ ?>
				<div class="col-md-3">
					<label for="p_designation_scope" style="font-size: 20px; float: right;">Designation Scope : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_scope; ?></p>
				</div>
				<?php }else if($criteria_array[9] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[9] == 'c'){ ?>
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
				<?php if($criteria_array[10] == 'b'){ ?>
				<div class="col-md-3">
					<label for="p_designation_prof" style="font-size: 20px; float: right;">Professor(s) : 
				</div>
				<div class="col-md-3">
					<p class="font-20"><?php echo $course->designation_prof; ?></p>
				</div>
				<?php }else if($criteria_array[10] == 'c'){ ?>
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
				<?php if($criteria_array[11] == 'c'){ ?>
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
		
		<!-- Edit Change an Existing Course Proposal form - the fields in this dynamically-created form contain the info already filled-in for the Proposal, which can then be editted -->
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
						<input class="form-control input-md" type="text" name="p_course_id" id="p_course_id" placeholder="i.e. 'CP112'" autocomplete="off" value="<?php echo $proposal->p_course_id; ?>">
					</div>
					<?php }else if($criteria_array[0] == '2'){ ?>
					<div class="col-md-4">
						<label for="p_course_title" style="font-size: 20px; float: right; text-align: right;">Proposed Course Title 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed title for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off" value="<?php echo $proposal->p_course_title; ?>">
					</div>
					<?php }else if($criteria_array[0] == '3'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"><?php echo $proposal->p_course_desc; ?></textarea>
					</div>
					<?php }else if($criteria_array[0] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"><?php echo $proposal->p_extra_details; ?></textarea>
					</div>
					<?php }else if($criteria_array[0] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off" value="<?php echo $proposal->p_limit; ?>">
					</div>
					<?php }else if($criteria_array[0] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
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
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php }else if($criteria_array[0] == '8'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off" value="<?php echo $proposal->p_first_offering; ?>">
					</div>
					<?php }else if($criteria_array[0] == '9'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off" value="<?php echo $proposal->p_aligned_assignments; ?>">
					</div>
					<?php }else if($criteria_array[0] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off" value="<?php echo $proposal->p_designation_scope; ?>">
					</div>
					<?php }else if($criteria_array[0] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[0] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
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
						<input class="form-control input-md" type="text" name="p_course_title" id="p_course_title" autocomplete="off" value="<?php echo $proposal->p_course_title; ?>">
					</div>
					<?php }else if($criteria_array[1] == '3'){ ?>
					<div class="col-md-4">
						<label for="p_course_desc" style="font-size: 20px; float: right; text-align: right;">Proposed Course Description  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed description of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"><?php echo $proposal->p_course_desc; ?></textarea>
					</div>
					<?php }else if($criteria_array[1] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"><?php echo $proposal->p_extra_details; ?></textarea>
					</div>
					<?php }else if($criteria_array[1] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off" value="<?php echo $proposal->p_limit; ?>">
					</div>
					<?php }else if($criteria_array[1] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
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
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php }else if($criteria_array[1] == '8'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off" value="<?php echo $proposal->p_first_offering; ?>">
					</div>
					<?php }else if($criteria_array[1] == '9'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off" value="<?php echo $proposal->p_aligned_assignments; ?>">
					</div>
					<?php }else if($criteria_array[1] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off" value="<?php echo $proposal->p_designation_scope; ?>">
					</div>
					<?php }else if($criteria_array[1] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[1] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
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
						<textarea class="form-control input-md text-box" type="text" name="p_course_desc" id="p_course_desc" autocomplete="off"><?php echo $proposal->p_course_desc; ?></textarea>
					</div>
					<?php }else if($criteria_array[2] == '4'){ ?>
					<div class="col-md-4">
						<label for="p_extra_details" style="font-size: 20px; float: right; text-align: right;">Proposed Extra Details  
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Additional details about the course, such as a field trip to Baca or required fee to be paid">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"><?php echo $proposal->p_extra_details; ?></textarea>
					</div>
					<?php }else if($criteria_array[2] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off" value="<?php echo $proposal->p_limit; ?>">
					</div>
					<?php }else if($criteria_array[2] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
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
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php }else if($criteria_array[2] == '8'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off" value="<?php echo $proposal->p_first_offering; ?>">
					</div>
					<?php }else if($criteria_array[2] == '9'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off" value="<?php echo $proposal->p_aligned_assignments; ?>">
					</div>
					<?php }else if($criteria_array[2] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off" value="<?php echo $proposal->p_designation_scope; ?>">
					</div>
					<?php }else if($criteria_array[2] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[2] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
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
						<textarea class="form-control input-md text-box" type="text" name="p_extra_details" id="p_extra_details" autocomplete="off"><?php echo $proposal->p_extra_details; ?></textarea>
					</div>
					<?php }else if($criteria_array[3] == '5'){ ?>
					<div class="col-md-4">
						<label for="p_limit" style="font-size: 20px; float: right; text-align: right;">Proposed Enrollment Limit
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed maximum number of students that can sign up for the course (typically either 25 or 32)">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off" value="<?php echo $proposal->p_limit; ?>">
					</div>
					<?php }else if($criteria_array[3] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
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
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php }else if($criteria_array[3] == '8'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off" value="<?php echo $proposal->p_first_offering; ?>">
					</div>
					<?php }else if($criteria_array[3] == '9'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off" value="<?php echo $proposal->p_aligned_assignments; ?>">
					</div>
					<?php }else if($criteria_array[3] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off" value="<?php echo $proposal->p_designation_scope; ?>">
					</div>
					<?php }else if($criteria_array[3] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[3] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
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
						<input class="form-control input-md" type="text" name="p_limit" id="p_limit" autocomplete="off" value="<?php echo $proposal->p_limit; ?>">
					</div>
					<?php }else if($criteria_array[4] == '6'){ ?>
					<div class="col-md-4">
						<label for="p_prereqs" style="font-size: 20px; float: right; text-align: right;">Proposed Course Prerequisites 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed prerequisites of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
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
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php }else if($criteria_array[4] == '8'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off" value="<?php echo $proposal->p_first_offering; ?>">
					</div>
					<?php }else if($criteria_array[4] == '9'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off" value="<?php echo $proposal->p_aligned_assignments; ?>">
					</div>
					<?php }else if($criteria_array[4] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off" value="<?php echo $proposal->p_designation_scope; ?>">
					</div>
					<?php }else if($criteria_array[4] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[4] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
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
						<input class="form-control input-md" type="text" name="p_prereqs" id="p_prereqs" autocomplete="off" value="<?php echo $proposal->p_prereqs; ?>">
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
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php }else if($criteria_array[5] == '8'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off" value="<?php echo $proposal->p_first_offering; ?>">
					</div>
					<?php }else if($criteria_array[5] == '9'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off" value="<?php echo $proposal->p_aligned_assignments; ?>">
					</div>
					<?php }else if($criteria_array[5] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off" value="<?php echo $proposal->p_designation_scope; ?>">
					</div>
					<?php }else if($criteria_array[5] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[5] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
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
							<option value="0 Units"<?php if ($proposal->p_units == '0 Units'){ echo ' selected'; } ?>>0 Units</option>
							<option value="0.25 Units"<?php if ($proposal->p_units == '0.25 Units'){ echo ' selected'; } ?>>0.25 Units</option>
							<option value="0.5 Units"<?php if ($proposal->p_units == '0.5 Units'){ echo ' selected'; } ?>>0.5 Units</option>
							<option value="1 Unit"<?php if ($proposal->p_units == '1 Unit'){ echo ' selected'; } ?>>1 Unit</option>
							<option value="2 Units"<?php if ($proposal->p_units == '2 Units'){ echo ' selected'; } ?>>2 Units</option>
						</select>
					</div>
					<?php }else if($criteria_array[6] == '8'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off" value="<?php echo $proposal->p_first_offering; ?>">
					</div>
					<?php }else if($criteria_array[6] == '9'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off" value="<?php echo $proposal->p_aligned_assignments; ?>">
					</div>
					<?php }else if($criteria_array[6] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off" value="<?php echo $proposal->p_designation_scope; ?>">
					</div>
					<?php }else if($criteria_array[6] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[6] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
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
					
					<?php if($criteria_array[7] == '8'){ ?>
					<div class="col-md-4">
						<label for="p_first_offering" style="font-size: 20px; float: right; text-align: right;">Proposed First Offering 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed first offering of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_first_offering" id="p_first_offering" autocomplete="off" value="<?php echo $proposal->p_first_offering; ?>">
					</div>
					<?php }else if($criteria_array[7] == '9'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off" value="<?php echo $proposal->p_aligned_assignments; ?>">
					</div>
					<?php }else if($criteria_array[7] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off" value="<?php echo $proposal->p_designation_scope; ?>">
					</div>
					<?php }else if($criteria_array[7] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[7] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }if($criteria_num > 8){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[8] == '9'){ ?>
					<div class="col-md-4">
						<label for="p_aligned_assignments" style="font-size: 20px; float: right; text-align: right;">Proposed Aligned Assignments 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed aligned assignments of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_aligned_assignments" id="p_aligned_assignments" autocomplete="off" value="<?php echo $proposal->p_aligned_assignments; ?>">
					</div>
					<?php }else if($criteria_array[8] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off" value="<?php echo $proposal->p_designation_scope; ?>">
					</div>
					<?php }else if($criteria_array[8] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[8] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }if($criteria_num > 9){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[9] == 'a'){ ?>
					<div class="col-md-4">
						<label for="p_designation_scope" style="font-size: 20px; float: right; text-align: right;">Proposed Designation Scope 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation scope of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_scope" id="p_designation_scope" autocomplete="off" value="<?php echo $proposal->p_designation_scope; ?>">
					</div>
					<?php }else if($criteria_array[9] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[9] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }if($criteria_num > 10){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[10] == 'b'){ ?>
					<div class="col-md-4">
						<label for="p_designation_prof" style="font-size: 20px; float: right; text-align: right;">Proposed Professor(s)
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed designation professor(s) of the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<input class="form-control input-md" type="text" name="p_designation_prof" id="p_designation_prof" autocomplete="off" value="<?php echo $proposal->p_designation_prof; ?>">
					</div>
					<?php }else if($criteria_array[10] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }if($criteria_num > 11){ ?>
			<div class="row" style="margin-top: 25px;">
				<div class="form-group">
					<div class="col-md-1"></div>
					
					<?php if($criteria_array[11] == 'c'){ ?>
					<div class="col-md-4">
						<label for="p_perspective" style="font-size: 20px; float: right; text-align: right;">Proposed Perspective 
						<button type="button" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="The proposed perspective for the course">
							  <i class="fa fa-question-circle" aria-hidden="true"></i>
						</button> : 
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left;" name="p_perspective" id="p_perspective">
							<option value="Analysis & Interpretation of Meaning"<?php if ($proposal->p_perspective == 'Analysis & Interpretation of Meaning'){ echo ' selected'; } ?>>Analysis & Interpretation of Meaning</option>
							<option value="Creative Process"<?php if ($proposal->p_perspective == 'Creative Process'){ echo ' selected'; } ?>>Creative Process</option>
							<option value="Equity & Power - Global"<?php if ($proposal->p_perspective == 'Equity & Power - Global'){ echo ' selected'; } ?>>Equity & Power - Global</option>
							<option value="Equity & Power - U.S."<?php if ($proposal->p_perspective == 'Equity & Power - U.S.'){ echo ' selected'; } ?>>Equity & Power - U.S.</option>
							<option value="Formal Reasoning & Logic"<?php if ($proposal->p_perspective == 'Formal Reasoning & Logic'){ echo ' selected'; } ?>>Formal Reasoning & Logic</option>
							<option value="Historical Perspectives"<?php if ($proposal->p_perspective == 'Historical Perspectives'){ echo ' selected'; } ?>>Historical Perspectives</option>
							<option value="Scientific Analysis"<?php if ($proposal->p_perspective == 'Scientific Analysis'){ echo ' selected'; } ?>>Scientific Analysis</option>
							<option value="Societies & Human Behaviors"<?php if ($proposal->p_perspective == 'Societies & Human Behaviors'){ echo ' selected'; } ?>>Societies & Human Behaviors</option>
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
						<textarea class="form-control input-md form-textbox" type="text" name="rationale" id="rationale" placeholder="Reason for change existing course proposal" autocomplete="off"><?php echo $proposal->rationale; ?></textarea>
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
						<input class="form-control input-md" type="text" name="lib_impact" id="lib_impact" autocomplete="off" value="<?php echo $proposal->lib_impact; ?>">
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
						<input class="form-control input-md" type="text" name="tech_impact" id="tech_impact" autocomplete="off" value="<?php echo $proposal->tech_impact; ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
					<!-- Save Button -->
					<button type="submit" class="btn btn-home" style="float: none; margin-top: 50px; margin-bottom: 20px; margin-left: 40%;"><strong>Save</strong></button>
					<input type="hidden" name="submitted" value="1">
				</div>
			</div>
		</form>
		
	</div>
</div>
