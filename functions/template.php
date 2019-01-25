<?php

//adds the buttons for the desired pages to the nav bar
function nav_buttons($dbc, $path, $dynamic, $side){
	$q = "SELECT * FROM navigation WHERE dynamic = $dynamic AND side = $side ORDER BY position ASC";
	$r = mysqli_query($dbc, $q);
	while($nav = mysqli_fetch_assoc($r)) {?>
		<li<?php selected($path['call_parts'][0], $nav['slug'], ' class="active"'); ?>>
		<a href="<?php echo $nav['url']; ?>"><?php echo $nav['label']; ?></a></li>
	<?php }
}


?>