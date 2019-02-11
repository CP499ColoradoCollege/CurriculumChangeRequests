<?php
$pid = $_GET['pid'];
$proposal = new Proposal($dbc);
$proposal = $proposal->fetchProposalFromID($pid);

if($proposal == false){
	header("Location: home");
}

$title_array = explode(" ", $proposal->proposal_title);
$p_type = $title_array[0];

//if the first word is change, keep going until you hit of
	
if($p_type == 'New'){
		//load a new course proposal form
	header("Location: edit_proposal_add?pid=".$pid);	

}else if($p_type == 'Change'){
		//load a change existing course proposal form
	
	header("Location: edit_proposal_revise?pid=".$pid);


}else if($p_type == 'Remove'){
	
	header("Location: edit_proposal_drop?pid=".$pid);
		
}else{
		header("Location: home");
}

?>
