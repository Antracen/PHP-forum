<?php
	session_start();
	$conn = pg_connect("user=wass password=wasspass dbname=backflash");

	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
		header("Location: start.php");
		exit();
	}

	if(isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])){
		$username = $_POST['username'];
		$res = pg_num_rows(pg_query_params($conn, "SELECT username FROM usertable WHERE username=$1", array($username)));
		// See if user exists.
		if($res != 0){
			$salt = pg_fetch_assoc(pg_query_params($conn, "SELECT salt FROM usertable WHERE username=$1", array($username)))['salt'];
			$password = sha1($salt . $_POST['password']);
			$res = pg_num_rows(pg_query_params($conn, "SELECT username FROM usertable WHERE username=$1 AND password=$2", array($username, $password)));
			// See if password correct.
			if($res != 0){
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $_POST['username'];
				header("Location: start.php");
				exit();	
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Backflash forum </title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<ul>
  			<li><a href="allthreads.php" class="navbarlink">Alla trådar</a></li>
			<li><a href="newthread.php" class="navbarlink">Ny tråd</a></li>
		</ul>

		<br><br><br><br><br><br><br><br>
		<center>
			Logga in:
			<form method="post" action="">
				<input required id="username" name="username" type="text" placeholder="användarnamn"><br>
				<input required id="password" name="password" type="password" placeholder="lösen (skriv vad som helst)"><br>
	      		<input name="login" type="submit" value="Logga in">
			</form>
			<br>
			<a href="newuser.php" class="newuserlink">Ny användare</a>
		</center>
	</body>
</html>
