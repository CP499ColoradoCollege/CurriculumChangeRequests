<?php

$pid = $_GET['pid'];
$proposal = new Proposal($dbc);
$proposal = $proposal->fetchProposalFromID($pid);

if ($proposal == false) {
	header("Location: home");
}

?>

<div class="container">
	<div class="card">
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Add Feedback for Proposal "<?php echo $proposal->proposal_title; ?>"</strong></h1>
		</div>

	<form method="post" role="form">
		<div class="row">
			<textarea name="comment" rows=10 style="width: 100%; margin-top: 50px; margin-bottom: 20px; resize: none;" onClick="this.select();">Enter your comment here.</textarea>
		</div>
		<div class="row">
			<!-- Submit Button -->
			<button type="submit" class="btn btn-home" style="margin-left: 40%; margin-top: 50px; margin-bottom: 20px;"><strong>Submit Feedback</strong></button>
		</div>
		<input type="hidden" name="confirm" value=1>
	</form>
</div>