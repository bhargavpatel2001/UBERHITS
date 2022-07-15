<?php
session_start();
?>

<!DOCTYPE html>
	<meta charset="utf-8">
	<title>Successful Survey</title>
	
	<link rel="stylesheet" href="styleTemplate.css"/>
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
		
		<h2 class="loginTitle center" data-value="100">Completed 100%
		 <div class="progressBar">
		 <span style="width: 100%;"></span>
		 </div>
		</h2>
		
		<h2 class="center"> Thank you for your valuable feedback and letting us know how we did.</h2>
		<h3 class="center">Your submission has been received.</h3>		
	
		<div class="imageCenter">
			<img src="photos\seeyouagain.jpg" alt="seeyouagain" width="300" height="300">
		</div>
		
		<nav class="navigationBar">
		  <a href="homepage.php">Home</a>
		  <a href="Info.php">Info</a>
		  <a href="login.php">Login</a>
		  <a href="aboutUs.php">About Us</a>
		  <a href="registration.php">Customer Registration</a>
		  <a href="employee.php">Employee Registration</a>
		  <a href="bookings.php">Bookings</a>
		  <a href="feedback.php" class="moveright" >Feedback</a>
		</nav>
		<hr></hr>
		
		<?php
			//$_SESSION['username'] = "test"; //to be removed later
		
			if (isset($_SESSION['username'])){
			
				switch($_SESSION['hitman']){
				
					case 1:
						$hitman = "Nicholas";
						break;
					case 2:
						$hitman = "Ripal";
						break;
					case 3:
						$hitman = "Bhargav";
						break;
					case 4:
						$hitman = "James";
				}
			
				echo "<h2 class='center'>Your review of ".$hitman." is complete!</h2>";
				echo "<br><br>";
				echo "<h3 class='center'>".$_SESSION['review']."</h3>";
				echo "<h3 class='center'>Your feedback ID: ".$_SESSION['fid']."</h3>";
				
			echo '	 <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" name = "EditDelete" class="feedback">
					<input type="submit" name="edit" value="edit" class="feedbutt"/>
					<input type="submit" name="delete" value="delete" class="feedbutt"/>
				</form> ';
					
				if($_POST['edit'] == "edit"){
				
					$_SESSION['edit'] = 1;
					header('Location:/Uber_Hits_Final/feedback.php');
				}
				if($_POST['delete'] == "delete"){
				
					$dbc = mysqli_connect("localhost", "serverUser", "Ceng@256", "uberhits") or die ("Could not Connect!\n");
					$fid=$_SESSION['fid'];
					$sql = "delete from feedback where fid='$fid';";
					
					mysqli_query($dbc, $sql) or die ("Error querying database");
					
					echo "<h1>DELETED</h1>";
				}
			}
			else{
			
				echo "<br><br><br><h2 class='center'>Please login to view, edit, or delete your review</h2><br><br><br>";
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
