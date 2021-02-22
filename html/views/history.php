<?php
/*
 * History Page:
 * This PHP file contains all HTML and PHP needed for the site's History page to show info about a user's existing edits to a proposal
 */
?>

<div class="container">
	<div class="card">
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<form class="form-inline" method="post" action="edit">
				<h1 style="float: left;"><strong>My Edits</strong></h1>
				

			</form>
		</div>
				
				<!-- Set up columns to be displayed: -->
		<div class="row" style="margin-top: 30px;">
			<div class="col-md-3">
				<span class="label-home"><strong>Title:</strong></span>
			</div>
			<div class="col-md-2">
				<span class="label-home"><strong>Date Editted:</strong></span>
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
			$pid = $_GET['pid'];
			$proposals = $user->getProposalHistory($pid);
			for($i = 0; $i < count($proposals); $i += 1){
				$prop = $proposals[$i];
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
					
					<!-- Specific Proposal's ID -->			
					<input type="hidden" name="openedid" value="<?php echo $prop->id; ?>">
				</form>
			</div>
			
		</div>
			
		<?php } ?>
		
	</div>
</div>
