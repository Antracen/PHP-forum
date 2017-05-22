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
	<body class="allthreadsbody">
		<ul>
  			<li><a href="index.php" class="navbarlink">Startsida</a></li>
  			<li><a href="allthreads.php" class="navbarlink">Alla trådar</a></li>
			<li><a href="newthread.php" class="navbarlink">Ny tråd</a></li>
			<li class="navbarlogout"><a href="logout.php" class="navbarlink">Logga ut (<?php echo $_SESSION['username'] ?>)</a></li>
		</ul>
		<table class="allthreads">	
			<?php
				$conn = pg_connect("user=wass password=wasspass dbname=backflash");
				$page = 0;				
				if(isset($_GET['page'])){
					$page = $_GET['page'];
				}
				$threads = pg_query_params($conn, "SELECT name, time FROM thread ORDER BY time DESC LIMIT 10 OFFSET $1", array($page*10));
				while($thread = pg_fetch_assoc($threads)){
					$timestamp = explode(" ", $thread['time']);
					$date = $timestamp[0];
					$time = explode(".", $timestamp[1])[0];
					$replycount = 0+pg_fetch_row(pg_query($conn, "SELECT COUNT(*) FROM post WHERE thread='$thread[name]'"))[0];
					echo "<tr><td><a href='loadthread.php?threadname=$thread[name]'>$thread[name]</a><br></td><td class=\"threadinfo\">$date<br>$time<br>$replycount inlägg</td></tr>";
				}
			?>
		</table>
		<br>

		<?php
			$conn = pg_connect("user=wass password=wasspass dbname=backflash");
			$postperpage = 10;
			$numposts = pg_fetch_row(pg_query($conn, 'SELECT COUNT(*) FROM thread'))[0];
			$numpages = ceil($numposts/$postperpage);
			if($numpages > 1){
				echo "Sidor: <br>";
			}
			for($i = 0; $i < $numpages; $i++){
				echo "<a href=\"allthreads.php?page=$i\">$i</a> ";
			}
		?>
	</body>
</html>
