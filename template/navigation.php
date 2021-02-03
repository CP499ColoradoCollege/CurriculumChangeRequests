<!-- this document contains the code needed for the nav bar at the top of the Proposal Tool application; HTML and PHP -->

<nav class="navbar navbar-default" role="navigation">
	<img class="website-banner" src="banner.JPG"/>
		
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
       <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
       </button>
	
		<div class="collapse navbar-collapse" style="text-align: center;">
	
		<div class="pull-left">
			<ul class="nav navbar-nav" style="font-size = 50px;">
				
				<li<?php selected($page, 'home', ' class="active"'); ?>><a class="nav-button" href="home">Home</a></li>
			    			    
			</ul>
		</div>
		
		<span style="text-align: center; font-size: 25px;"><strong>Course Proposal System</strong></span>
	
		<div class="pull-right"><!-- for the right side buttons -->
			<ul class="nav navbar-nav" style="font-size = 50px;">
				
				<li<?php selected($page, 'logout', ' class="active"'); ?>><a class="nav-button" href="logout">Log Out</a></li>
				
				<li>
				
				</li>
			    			    
			</ul>
		</div>	<!-- END right side buttons -->
		</div>
	

</nav><!-- END nav -->
