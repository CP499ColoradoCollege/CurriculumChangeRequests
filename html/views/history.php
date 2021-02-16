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
				<span class="label-home"><strong>Date Edited:</strong></span>
			</div>
			<div class="col-md-2" style="margin-left: 40px;">
				<span class="label-home"><strong>Options:</strong></span>
			</div>
			
		</div>
				
		<?php
			//need to request the proposals that correspond to the current User from the database to display them on the page
			//the following for-loop produces HTML for each of the User's related Proposals
			$pid = $_GET['pid'];
			$edits = $user->getProposalHistory($pid);
			for($i = 0; $i < count($edits); $i += 1){
				$edit = $edits[$i];
		?>
		
		<div class="row" style="margin-top: 50px; padding-bottom: 20px; border-bottom: 3px dotted #D19E21">
			
			<!-- Proposal Title -->
			<div class="col-md-3">
				<span class="info-home"><strong><?php echo $edit->proposal_title; ?></strong></span>
			</div>
			<!-- Edit Date -->
			<div class="col-md-2">
				<span class="info-home"><strong><?php echo $edit->edit_date; ?></strong></span>
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
