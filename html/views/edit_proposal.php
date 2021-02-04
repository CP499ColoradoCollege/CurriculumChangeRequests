<?php
/*
 * edit_proposal.php:
 * This PHP file looks at the Proposal that is to be editted, and determines what page the User should be redirected to for the specific Proposal type
 */
?>

<?php
//Need to get the proposal's id from the page URL:
$pid = $_GET['pid'];

$proposal = new Proposal($dbc);
$proposal = $proposal->fetchProposalFromID($pid);

if($proposal == false){
	header("Location: home");
}

$title_array = explode(" ", $proposal->proposal_title);
$p_type = $title_array[0];

//We want to check what the first word of each proposal title is; this will tell us the Proposal type
	
if($p_type == 'New'){
		//load a new course proposal form
	header("Location: edit_proposal_add?pid=".$pid);	
}else if($p_type == 'Change'){
		//load a change existing course proposal form
	header("Location: edit_proposal_revise?pid=".$pid);
}else if($p_type == 'Remove'){
		//load a remove existing course proposal form
	header("Location: edit_proposal_drop?pid=".$pid);
}else{
		//load the home page
		header("Location: home");
}

?>
