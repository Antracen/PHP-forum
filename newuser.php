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
		    			url:'createuser.php',
		    			data:$('form').serialize(),
		    			success:function(){
							console.log("creating user");
		       			}
		    		});
		    		window.location.replace("index.php");
		    	});
			});
		</script>
	</head>
	<body>
		<ul>
			<li><a href="index.php" class="navbarlink">Startsida</a></li>
  			<li><a href="allthreads.php" class="navbarlink">Alla trådar</a></li>
			<li><a href="newthread.php" class="navbarlink">Ny tråd</a></li>
		</ul>
		<br><br><br><br><br><br>
		<center>
		<form method="post" action="">
			<input required id="username" name="username" type="text" placeholder="användarnamn"><br>
			<input required id="password" name="password" type="password" placeholder="lösen (skriv vad som helst)"><br>
	      	<input name="login" type="submit" value="Skapa användare">
		</form>
		</center>
	</body>
</html>
