<?php
	session_start();

	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
		
	}
	else{
		header("Location: index.php");
		exit();
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
			<li class="navbarlogout"><a href="logout.php" class="navbarlink">Logga ut (<?php echo $_SESSION['username'] ?>)</a></li>
		</ul>

		<br><br><br><br><br><br>
		<center>
		Hej där <?php echo $_SESSION['username']; ?>! <br>
		Denna sida är skapad av Martin Wass.
		</center>
	</body>
</html>
