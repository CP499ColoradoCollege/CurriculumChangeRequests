<!-- this document contains CSS styling for elements and data on the page; PHP and CSS -->

<?php
// CSS:




?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<!-- jQuery CSS -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

<!-- FontAwesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


<!-- Dropzone CSS -->
<link rel="stylesheet" href="css/dropzone.css">


<style>


	* {
	 box-sizing: border-box;
	}
	
	*:before,
	*:after {
	 box-sizing: border-box;
	}
	
	html, body {
	    font-family: 'Monda', Sans-Serif;
		font-size: 14px;
		color: black;
	    background-size: 100%;
	    background-color: white;
	    height: 100vh;
	    position: relative;
	    overflow-y: hidden;
	    overflow-x: hidden;
	}
	
	.container{
		min-height: calc(100vh - 120px); /* will cover the 100% of viewport */
		display: block;
		position: relative;
		margin-bottom: 0px;
	}
	
	.background-tint {
	  /*background-color: rgba(22, 197, 46,.5);*/
	  background-blend-mode: multiply;
	}   
	
	/* The magic: */
	.Site {
	  display: flex;
	  min-height: 100vh;
	  flex-direction: column;
	}
	
	.Site-content {
	  flex: 1;
	}
	
	.website-banner {
		height: 100%;
		float: left;
		margin-top: 0px;
		padding-bottom: 1px;
		overflow-x: hidden;
	}
	
	.btn-home{
		color: black;
		background-color: #D19E21;
		font-size: 15px;
		border-radius: 10px;
		float: none;
		margin-bottom: 5px;
	}
	
	.btn-new{
		color: black;
		background-color: #D19E21;
		font-size: 15px;
		border-radius: 10px;
		float: center;
		margin-top: 30px;
		margin-left: 100px;
	}
	
	.label-home{
		font-size: 20px;
	}
	
	.info-home{
		font-size: 18px;
	}

	
	/* Wrapper for page content to push down footer */
	#wrap {
		min-height: 100%;
		height: auto;
		/* Negative indent footer by its height */
		margin: 0 auto -60px;
		/* Pad bottom by footer height */
		padding 0 0 60px;
	}
	
	/* Set the fixed height of the footer here */
	#footer {
		height: 60px;
		background-color: #f5f5f5;
	}
	
	/* styling for debug button */
	#btn-debug {
		/*
		position: absolute;
		right: 5px;
		*/
	}
	
	/* styling for debug console */
	#console-debug {
		position: absolute;
		top: 50px;
		left: 0px;
		width: 30%;
		height:700px;
		overflow-y:scroll;
		background-color: #ffffff;
		box-shadow: 2px 2px 5px #cccccc;
	}
	#console-debug pre {
		height: 700px;
	}
		
	/* styling for user avatar */
	.avatar-container {
		width: 100px;
		height: 100px;
		
		border-radius: 3px;
		
		background-size: cover;
		background-position: center center;
	}
			
		
</style>