<?php

include('config/setup.php'); //adds all setup code
include('config/queries.php'); //static queries

if($page != 'download_docx'){

 ?>
<!DOCTYPE  html>
<html>
<head>
	<!-- below line changes the page's title to the page title + the site title, dynamically changing -->
	<title><?php echo ucfirst($page).' | '.ucfirst($site_title);?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include('config/css.php'); ?>
	<?php include('config/js.php'); ?>
</head>
<body class="Site">
	<main class="Site-content">
		<div class="background-tint">
			<?php include('template/navigation.php'); //Main Navigation ?>
			<div id="wrap">	<!-- keeps column layout consistent -->
<?php } ?>