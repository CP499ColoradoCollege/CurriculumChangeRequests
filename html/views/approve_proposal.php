<?php

$pid = $_GET['pid'];
$proposal = new Proposal($dbc);
$proposal = $proposal->fetchProposalFromID($pid);

if ($proposal == false) {
	header("Location: home");
}

$approval_status = $proposal->approval_status;

if ($approval_status == 0) {
	$sub_reversed = 1;
	$approval_message = "Make sure you have reviewed this proposal and confirmed it is up to standards.";
	$button_message = "Approve";
} else {
	$approval_reversed = 0;
	$approval_message = "If this proposal does not meet the standards for approval, please <a href='#'>provide appropriate feedback</a> for the submitter's benefit.";
	$button_message = "Reject";
}

$next_approval_level = $user->permission + $approval_reversed;
echo $next_approval_level;

?>

<div class="container">
	<div class="card">
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong><?php echo $button_message; ?> Proposal "<?php echo $proposal->proposal_title; ?>"</strong></h1>
		</div>

		<p style="text-align: center; font-size: 18px; margin-top: 20px;"><strong><?php echo $approval_message; ?></strong></p>

	<form method="post" role="form">
		<div class="row">
			<!-- Submit Button -->
			<button type="submit" class="btn btn-home" style="margin-left: 48%; margin-top: 50px; margin-bottom: 20px;"><strong><?php echo $button_message; ?></strong></button>
		</div>
		<input type="hidden" name="confirm" value=<?php echo $next_approval_level; ?>>
	</form>
</div>