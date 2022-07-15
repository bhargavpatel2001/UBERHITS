<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Successfuly Logged In</title>
		<link rel="stylesheet" href="styleTemplate.css"/>
	
	</head>
	<body>
		<header>
		  <div class="contain">
			<img id="logo" src="photos/UberHitsLogo.jpg">
			<span>Uber Hits Inc.</span>
			<?php
        	if(isset($_COOKIE['username'])){
        	
        		echo "<span2>Welcome ".$_COOKIE['username']."</span2>";
        		echo '	 <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" name = "logout" class="feedback">
					<input type="submit" name="logout" value="logout" class="feedbutt"/>
				</form> ';
        	}
        	if($_POST['logout'] == "logout"){
				
			setcookie('username', 0, time()-1);
			session_destroy();
		}
        	
        ?>
		  </div>
		</header>
		
		<div class="MainBanner" id="successlogin">
			<h3 class="center">SUCCESSFULLY LOGGED IN</h3>
			<h3 class="center">WELCOME</h3>
		</div>		
		
		
		<nav class="navigationBar">
		  <a href="homepage.php">Home</a>
		  <a href="Info.php">Info</a>
		  <a href="login.php">Login</a>
		  <a href="aboutus.php">About Us</a>
		  <a href="registration.php">Customer Registration</a>
		  <a href="employee.php">Employee Registration</a>
		  <a href="bookings.php">Bookings</a>
		  <a href="feedback.php" class="moveright">Feedback</a>
		</nav>
		<hr></hr>
		
		<?php
			//$_SESSION['username'] = "test"; //to be removed later
		
			if (isset($_SESSION['username'])){
			
				if($_SESSION['checkboxOption'] == "employees"){
				
					echo "<h2 class='center'>Welcome ".$_SESSION['username'].", Time to get to work!</h2>";
					echo "<br><br><br>";
					echo "<h2 class='center'>Would you like to quit?</h2>";
					echo '	 <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" name = "QUIT" class="feedback">
					<input type="submit" name="QUIT" value="QUIT" class="feedbutt"/>
				</form> ';
				
					if($_POST['QUIT'] == "QUIT"){
				
						$dbc = mysqli_connect("localhost", "serverUser", "Ceng@256", "uberhits") or die ("Could not Connect!\n");
						$username=$_SESSION['username'];
						$sql = "delete from employees where username='$username';";
						mysqli_query($dbc, $sql) or die ("Error querying database");
						echo "<h1>EMPLOYEE TERMINATED</h1>";
						session_destroy();
						setcookie('username', 0, time()-1);
					}
				}
				else{
				
					echo "<h2 class='center'>Welcome ".$_SESSION['username'].", You have been successfully logged in!</h2>";
				}
			
				
			}
			else{
			
				echo "<h2 class='center'>Please log in first...</h2>";
			}
		?>
	
		<div class="copywrite">
			<footer> 
					<span>Uber Hits Inc © </span>
					<h6>Nicholas Mohan N01361663 | Ripal Patel N01354619 | Bhargav Patel N01373029 | James Ricci N00411900</h6>
			</footer>
		</div>
		
	</body>
</html>
