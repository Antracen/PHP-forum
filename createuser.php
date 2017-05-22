<?php
	$conn = pg_connect("user=wass password=wasspass dbname=backflash");
	$username = $_POST['username'];
	$password = $_POST['password'];
	pg_query_params($conn, 'INSERT INTO usertable(username, password) VALUES ($1, $2)', array($username, $password));
?>
