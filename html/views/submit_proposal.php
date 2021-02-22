<?php

$pid = $_GET['pid'];
$proposal = new Proposal($dbc);
$proposal = $proposal->fetchProposalFromID($pid);

if ($proposal == false) {
	header("Location: home");
}

$sub_status = $proposal->sub_status;

$sub_reversed = 0;
if ($sub_status == 0) {
	$sub_reversed = 1;
}

?>

<div class="container">
	<div class="card">
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Submit Proposal "<?php echo $proposal->proposal_title; ?>"</strong></h1>
		</div>

		<p style="text-align: center; font-size: 18px; margin-top: 20px;"><strong>Make sure your proposal is ready to submit. If you haven't done so yet, make sure to <a href="#">view your outstanding feedback</a>.</strong></p>

	<form method="post" role="form">
		<div class="row">
			<!-- Submit Button -->
			<button type="submit" class="btn btn-home" style="margin-left: 48%; margin-top: 50px; margin-bottom: 20px;"><strong>Submit</strong></button>
		</div>
		<input type="hidden" name="confirm" value=<?php echo $sub_reversed; ?>>
	</form>
</div>