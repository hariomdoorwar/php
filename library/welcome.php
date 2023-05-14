<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
</head>
<body>
	<?php 
		
		session_start();
		if(isset($_SESSION['username'])){
	
			$username = $_SESSION['username'];
			echo "<h1>Welcome, $username!</h1>";
			echo "<p>You are now logged in.</p>";
		
			echo "<form action='logout.php' method='post'>";
			echo "<button type='submit'>Logout</button>";
			echo "</form>";
		} else {
			
			header("Location: login.php");
			exit();
		}
	?>

</body>
</html>
