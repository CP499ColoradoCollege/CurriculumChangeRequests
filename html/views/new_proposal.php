<?php
/*
 * New Proposal Page:
 * This PHP file contains all HTML and PHP needed for the site's New Proposal page to generate, including the dropdown menu form for choosing the new Proposal's type
 * The form on this page redirects to either the Add New Course Proposal page, Remove Existing Course Proposal page, or Change Existing Course Proposal Select page
 */
?>

<div class="container">
	<div class="card">
		
		<!-- Page Header -->
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<h1 style="float: left;"><strong>New Proposal</strong></h1>
		</div>
					
		<!-- Dropdown Menu Form -->	
		<form method="post" role="form">
			<div class="form-group">
				<div class="row" style="margin-top: 60px;">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<label for="type" style="font-size: 22px; float: right;">Type of New Proposal : </label>
					</div>
					<div class="col-md-3">
						<select class="input-sm" style="float: left; width: 75%; margin-left: -25px;" name="type" id="type">
							<option value="1" selected>Add a New Course</option>
							<option value="2">Change an Existing Course</option>
							<option value="3">Remove an Existing Course</option>
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
