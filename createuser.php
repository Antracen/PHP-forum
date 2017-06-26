<?php
	$conn = pg_connect("user=wass password=wasspass dbname=backflash");
	$username = $_POST['username'];
	$salt = $username . time();
	$password = sha1($salt . $_POST['password']);
	pg_query_params($conn, 'INSERT INTO usertable(username, salt, password) VALUES ($1, $2, $3)', array($username, $salt, $password));
?>
