<?php
/*
 * Home Page:
 * This PHP file contains all HTML and PHP needed for the site's Home page to generate, including showing info about a user's existing Proposals
 */
?>

<div class="container">
	<div class="card">
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<form class="form-inline" method="post" action="new_proposal">
				<h1 style="float: left;"><strong>My Proposals</strong></h1>
				
				<!-- New Proposal Button -->
				<button type="submit" class="btn btn-new"><strong>New Proposal</strong></button>
			</form>
		</div>
		
		<?php 
		$success = $_GET['success'];
		if($success == 'add'){
			echo '<p class="bg-success">Your Add a New Course proposal was successfully saved!</p>'; 
		}else if($success == 'change'){
			echo '<p class="bg-success">Your Change an Existing Course proposal was successfully saved!</p>'; 
		}else if($success == 'remove'){
			echo '<p class="bg-success">Your Remove an Existing Course proposal was successfully saved!</p>'; 
		} ?>
		
		<!-- Set up columns to be displayed: -->
		<div class="row" style="margin-top: 30px;">
			<div class="col-md-3">
				<span class="label-home"><strong>Title:</strong></span>
			</div>
			<div class="col-md-2">
				<span class="label-home"><strong>Date Created:</strong></span>
			</div>
			<div class="col-md-3">
				<span class="label-home"><strong>Submission Status:</strong></span>
			</div>
			<div class="col-md-2" style="margin-left: -40px;">
				<span class="label-home"><strong>Approval Status:</strong></span>
			</div>
			<div class="col-md-2" style="margin-left: 40px;">
				<span class="label-home"><strong>Options:</strong></span>
			</div>
			
		</div>
				
		<?php
			//need to request the proposals that correspond to the current User from the database to display them on the page
			//the following for-loop produces HTML for each of the User's related Proposals
			$proposals = $user->getProposals();
			for($i = 0; $i < count($proposals); $i += 1){
				$prop = $proposals[$i];

				$sub_status = $prop->sub_status;
				if ($sub_status) {
					$submit_message = "Unsubmit";
				} else {
					$submit_message = "Submit";
				}

				$approval_status = $prop->approval_status;
				if ($approval_status) {
					$approval_message = "Reject";
				} else {
					$approval_message = "Approve";
				}

				if ($user->permission > 1) {
					$submission_status = convertSubmissionStatus($prop->sub_status);
					if ($user->permission === $prop->approval_status) {
						$submission_status = "Awaiting approval from you.";
					}
		?>

		<div class="row" style="margin-top: 50px; padding-bottom: 20px; border-bottom: 3px dotted #D19E21">
			
			<!-- Proposal Title -->
			<div class="col-md-3">
				<span class="info-home"><strong><?php echo $prop->proposal_title; ?></strong></span>
			</div>
			<!-- Proposal Date -->
			<div class="col-md-2">
				<span class="info-home"><strong><?php echo $prop->proposal_date; ?></strong></span>
			</div>
			<!-- Proposal Submission Status -->
			<div class="col-md-3">
				<span class="info-home"><strong><?php echo convertSubmissionStatus($prop->sub_status); ?></strong></span>
			</div>
			<!-- Proposal Approval Status -->
			<div class="col-md-2" style="margin-left: -40px;">
				<span class="info-home"><strong><?php echo convertApprovalStatus($prop->approval_status); ?></strong></span>
			</div>

			<div class="col-md-2" style="margin-left: 40px;">
				<form method="post" action="home">
					<!-- Download Button -->
					<button type="submit" class="btn btn-home" name="action" value="download"><strong>Download</strong></button><br>
					<!-- Edit Button -->
					<button type="submit" class="btn btn-home" name="action" value="edit"><strong>Edit</strong></button><br>
					<!-- View History Button -->	
					<button type="submit" class="btn btn-home" name="action" value="history"><strong>History</strong></button><br>
					<!-- Approve Button (IN PROGRESS) -->
					<button type="submit" class="btn btn-home" name="action" value="approve_proposal"><strong><?php echo $approval_message ?></strong></button><br>
					<!-- Email Button (NOT YET WORKING) -->
					<!-- <span class="btn btn-home" name="action" value="email"><strong>Email</strong></span><br> -->
					<!-- Add Feedback Button (NOT YET WORKING) -->
					<button type="submit" class="btn btn-home" name="action" value="add_feedback"><strong>Add Feedback</strong></span>
					<!-- Delete Button -->
					<button type="submit" class="btn btn-home" name="action" value="delete_proposal"><strong>Delete</strong></span>
					<!-- Specific Proposal's ID -->			
					<input type="hidden" name="openedid" value="<?php echo $prop->id; ?>">
				</form>
			</div>
			
		</div>

		<?php 	
				} else {
		?>

		<div class="row" style="margin-top: 50px; padding-bottom: 20px; border-bottom: 3px dotted #D19E21">
			
			<!-- Proposal Title -->
			<div class="col-md-3">
				<span class="info-home"><strong><?php echo $prop->proposal_title; ?></strong></span>
			</div>
			<!-- Proposal Date -->
			<div class="col-md-2">
				<span class="info-home"><strong><?php echo $prop->proposal_date; ?></strong></span>
			</div>
			<!-- Proposal Submission Status -->
			<div class="col-md-3">
				<span class="info-home"><strong><?php echo convertSubmissionStatus($prop->sub_status); ?></strong></span>
			</div>
			<!-- Proposal Approval Status -->
			<div class="col-md-2" style="margin-left: -40px;">
				<span class="info-home"><strong><?php echo convertApprovalStatus($prop->approval_status); ?></strong></span>
			</div>
			<div class="col-md-2" style="margin-left: 40px;">
				<form method="post" action="home">
					<!-- Download Button -->
					<button type="submit" class="btn btn-home" name="action" value="download"><strong>Download</strong></button><br>
					<!-- Edit Button -->
					<button type="submit" class="btn btn-home" name="action" value="edit"><strong>Edit</strong></button><br>
					<!-- View History Button -->	
					<button type="submit" class="btn btn-home" name="action" value="history"><strong>History</strong></button><br>
					<!-- Submit Button (IN PROGRESS) -->
					<button type="submit" class="btn btn-home" name="action" value="submit_proposal"><strong><?php echo $submit_message ?></strong></button><br>
					<!-- Email Button (NOT YET WORKING) -->
					<!-- <span class="btn btn-home" name="action" value="email"><strong>Email</strong></span><br> -->
					<!-- View Feedback Button (NOT YET WORKING) -->
					<button type="submit" class="btn btn-home" name="action" value="view_feedback"><strong>View Feedback</strong></span>
					<!-- Delete Button -->
					<button type="submit" class="btn btn-home" name="action" value="delete_proposal"><strong>Delete</strong></span>
					
					<!-- Specific Proposal's ID -->			
					<input type="hidden" name="openedid" value="<?php echo $prop->id; ?>">
				</form>
			</div>
			
		</div>
			
		<?php 	
				} 
			}
		?>
		
	</div>
</div>
