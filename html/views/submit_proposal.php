<?php

$pid = $_GET['pid'];
$proposal = new Proposal($dbc);
$proposal = $proposal->fetchProposalFromID($pid);

if ($proposal == false) {
	header("Location: home");
}

$sub_status = $proposal->sub_status;

if ($sub_status == 0) {
	$sub_reversed = 1;
	$sub_message = "Make sure your proposal is ready to submit. If you haven't done so yet, make sure to <a href='#''>view your outstanding feedback</a>.";
	$button_message = "Submit";
} else {
	$sub_reversed = 0;
	$sub_message = "If you believe your proposal was submitted in error, you can retract it. Please take care not to overuse this feature, as it may cause confusion if an administrator has already begun to review your submission.";
	$button_message = "Unsubmit";
}

?>

<div class="container">
	<div class="card">
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong><?php echo $button_message; ?> Proposal "<?php echo $proposal->proposal_title; ?>"</strong></h1>
		</div>

		<p style="text-align: center; font-size: 18px; margin-top: 20px;"><strong><?php echo $sub_message; ?></strong></p>

	<form method="post" role="form">
		<div class="row">
			<!-- Submit Button -->
			<button type="submit" class="btn btn-home" style="margin-left: 48%; margin-top: 50px; margin-bottom: 20px;"><strong><?php echo $button_message; ?></strong></button>
		</div>
		<input type="hidden" name="confirm" value=<?php echo $sub_reversed; ?>>
	</form>
</div>