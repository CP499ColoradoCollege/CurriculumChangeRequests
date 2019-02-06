<?php

#This page is responsible for connection to the MySQL Database associated with the project

#Database Connection Here, sorted by host name, user name, user password, and then database name
$dbc = mysqli_connect('localhost', 'root', '', 'proposals') OR die('Error: '.mysqli_connect_error());

?>