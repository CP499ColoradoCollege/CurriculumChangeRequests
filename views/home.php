
<div class="container">
	<div class="card">	<!-- start of card -->
		
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<form class"form-inline" method="post" action="new_proposal">
				<h1 style="float: left;"><strong>My Proposals</strong></h1>
				<button type="submit" class="btn btn-new"><strong>New Proposal</strong></button>
			</form>
		</div>
		
		
		<!--<form class"form-inline" method="post" action="apply">
			<button type="submit" class="btn btn-apply"><strong>Apply</strong></button>
		</form>-->
		
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
			<div class="col-md-2">
				<span class="label-home"><strong>Approval Status:</strong></span>
			</div>
			<div class="col-md-2">
				<span class="label-home"><strong>Options:</strong></span>
			</div>
			
		</div>
		
		<?php
		
			$q = "SELECT * FROM proposals WHERE user_id = '$user[id]'";
			$r = mysqli_query($dbc, $q);
			while($data = mysqli_fetch_assoc($r)){ 
		?>
		
		<div class="row" style="margin-top: 50px; padding-bottom: 20px; border-bottom: 3px dotted #D19E21">
			
			<div class="col-md-3">
				<span class="info-home"><strong><?php echo $data['title']; ?></strong></span>
			</div>
			<div class="col-md-2">
				<span class="info-home"><strong><?php echo $data['date']; ?></strong></span>
			</div>
			<div class="col-md-3">
				<span class="info-home"><strong><?php echo $data['sub_status']; ?></strong></span>
			</div>
			<div class="col-md-2">
				<span class="info-home"><strong><?php echo $data['approval_status']; ?></strong></span>
			</div>
			<div class="col-md-2">
				<form method="post" action="home">
					<button type="submit" class="btn btn-home" name="action" value="download"><strong>Download</strong></button><br>
					<button type="submit" class="btn btn-home" name="action" value="edit"><strong>Edit</strong></button><br>
					<button type="submit" class="btn btn-home" name="action" value="email"><strong>Email</strong></button><br>
					<button type="submit" class="btn btn-home" name="action" value="feedback"><strong>View Feedback</strong></button>
					
					<!--<button type="submit" class="btn btn-home" name="action" value="download"><strong>Download</strong></button>-->
					
					<input type="hidden" name="openedid" value="<?php echo $data['id']; ?>">
					
				</form>
			</div>
			
		</div>
			
			
			
			
		<?php } ?>
		
	</div>
</div>
