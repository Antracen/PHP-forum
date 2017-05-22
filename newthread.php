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
		    			url:'createthread.php',
		    			data:$('form').serialize(),
		    			success:function(){
							console.log("creating thread");
		       			}
		    		});
		    		window.location.replace("allthreads.php");
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
		<br><br><br><br><br>
		<center>
		<form>
			<textarea class="textareathreadname" required id="threadname" name="threadname" type="text" placeholder="trådnamn" rows="1"></textarea><br>
			<textarea required name="post" rows="5" placeholder="inlägg"></textarea><br>
      		<input name="submit" type="submit" value="Submit">
		</form>
		</center>
	</body>
</html>
