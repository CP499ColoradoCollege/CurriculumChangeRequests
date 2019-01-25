<!-- this document contains the instructions necessary to successfully log a user in, as well as the layout of the login page; PHP and HTML -->

<?php 
include('config/connection.php');	//database connection
include('config/queries.php');
include('config/css.php');
include('config/js.php');
 ?>

<!DOCTYPE  html>
<html>
<head>
	<title>Course Proposal System Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
	
	
<body>
	
	<div id="wrap">
				
		<div class="container">
						
			<div class="row">
			
				<div class="col-md-4 col-md-offset-4">
										
					<div class="card">
						
					  <div class="card-header">
					    <h1><strong>Course Proposal System Login<br><br></strong></h1>
					  </div>
					  
					  <div class="card-body">
					  	
					  	<form action="login.php" method="post" role="form">
				
							<div class="form-group">
								
						  		<label for="email">Email address</label>
						  		
						  		<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
						  									
							</div>
							
							<div class="form-group">
						  		<label for="password">Password</label>
						  		<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							</div>
							
							<!-- this is for a checkbox
							<div class="form-group form-check">
						  		<input type="checkbox" class="form-check-input" id="exampleCheck1">
						  		<label class="form-check-label" for="exampleCheck1">Check me out</label>
							</div>
							-->
							
							<button type="submit" class="btn btn-primary">Submit</button>
						</form> <!-- END login form -->
						
					  </div><!-- END panel -->
					</div>

					
					
					
				</div> <!-- END col -->
			
			</div> <!-- END row -->
			
			
			
			
		</div> <!-- END container -->

	</div><!-- END wrap -->
	
			
</body>
	
	
</html>