<?php

$pid = $_GET['pid'];
$proposal = new Proposal($dbc);
$proposal = $proposal->fetchProposalFromID($pid);

if ($proposal == false) {
	header("Location: home");
}

$sub_status = $proposal->sub_status;

$feedback = $proposal->getAllFeedback();

?>

<div class="container">
	<div class="card">
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>Feedback for Proposal "<?php echo $proposal->proposal_title; ?>"</strong></h1>
		</div>

		<p style="text-align: center; font-size: 18px; margin-top: 20px;"><strong><?php echo $feedback; ?></strong></p>
</div>