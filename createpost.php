<?php
	session_start();
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
		$conn = pg_connect("user=wass password=wasspass dbname=backflash");
		$threadname = $_POST['threadname'];
		$username = $_SESSION['username'];
		$post = $_POST['post'];
		pg_query_params($conn, 'INSERT INTO post(username, time, text, thread) VALUES ($1, CURRENT_TIMESTAMP, $2, $3)', array($username, $post, $threadname));
	}
?>
