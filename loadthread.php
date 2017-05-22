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
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script>
			$(document).ready(function(){
		    	$('form').on('submit', function(event){
		    		event.preventDefault(); //Prevent the default behaviour of submit and therefore make page not refresh.
		    			
		    		$.ajax({
		    			type:'post',
		    			url:'createpost.php',
		    			data:$('form').serialize(),
		    			success:function(){
							console.log("creating thread");
		       			}
		    		});
		    		location.reload();
		    	});
			});
		</script>
	</head>
	<body>
		<ul>
  			<li><a href="index.php" class="navbarlink">Startsida</a></li>
  			<li><a href="allthreads.php" class="navbarlink">Alla trådar</a></li>
			<li><a href="newthread.php" class="navbarlink">Ny tråd</a></li>
			<li class="navbarlogout"><a href="logout.php" class="navbarlink">Logga ut (<?php echo $_SESSION['username'] ?>)</a></li>
		</ul>	
			<?php
				$threadname = $_GET['threadname'];
				$page = 0;				
				if(isset($_GET['page'])){
					$page = $_GET['page'];
				}
				$conn = pg_connect("user=wass password=wasspass dbname=backflash");
				$posts = pg_query_params($conn, 'SELECT * FROM post WHERE thread=$1 ORDER BY time LIMIT 10 OFFSET $2', array($threadname, $page*10));
				while($post=pg_fetch_assoc($posts)){
					$timestamp = explode(" ", $post['time']);
					$date = $timestamp[0];
					$time = explode(".", $timestamp[1])[0];
					
					echo "<table class=\"post\"><tr><td valign=\"top\" class=\"postinfo\">$date <br> $time <br> <b>$post[username]</td><td valign=\"top\" class=\"posttext\">$post[text]</td></tr></table>";
				}
			?>
		<form>
			<input id="threadname" name="threadname" type="hidden" value="<?php echo $threadname ?>">
			<textarea required name="post" cols="40" rows="5" placeholder="inlägg"></textarea><br>
      		<input name="submit" type="submit" value="Submit">
		</form>

		<br>
		<?php
			$conn = pg_connect("user=wass password=wasspass dbname=backflash");
			$threadname = $_GET['threadname'];
			$postperpage = 10;
			$numposts = pg_fetch_row(pg_query_params($conn, 'SELECT COUNT(*) FROM post WHERE thread=$1', array($threadname)))[0];
			$numpages = ceil($numposts/$postperpage);
			if($numpages > 1){
				echo "Sidor: <br>";
				for($i = 0; $i < $numpages; $i++){
					echo "<a href=\"loadthread.php?threadname=$threadname&page=$i\">$i</a> ";
				}
			}
		?>
	</body>
</html>
