

<div class="container">
	<div class="card">	<!-- start of card -->
		
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>New Proposal</strong></h1>
		</div>
					
						
		<form method="post" role="form">
			
			<div class="form-group">
				<div class="row" style="margin-top: 60px;">
					
					<div class="col-md-2"></div>
					
					<div class="col-md-3">
						<label for="type" style="font-size: 22px; float: right;">Type of New Proposal :  
					</div>
					
					<div class="col-md-3">
						<select class="input-sm" style="float: left; width: 75%; margin-left: -25px;" name="type" id="type">
							<option value="1" selected>Add a New Course</option>
							<option value="2">Change an Existing Course</option>
							<option value="3">Remove an Existing Course</option>
							<option value="4">Other...</option>
						</select>
					</div>
					
				</div>
				
				<div class="row" style="margin-top: 140px;">
					<div class="col-md-5"></div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-home" style="float: none; margin-bottom: 20px;"><strong>Begin Proposal</strong></button>
						<input type="hidden" name="submitted" value="1">
					</div>
				</div>
			</div>				
		
		</form>						
		
		
	</div>
</div>
