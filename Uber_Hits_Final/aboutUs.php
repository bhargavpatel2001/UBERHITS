<?php
session_start();
?>

<!DOCTYPE html>
<html  id="scroll">
	<meta charset="utf-8">
	<title>About Us</title>
	
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
		<div class="MainBanner" id="about">
			<h1 class="center">About Us</h1>
			<h3 class="center">Uber Hits, Where execution is our Specialty</h3>
		</div>			
	
		<nav class="navigationBar">
		  <a href="homepage.php">Home</a>
		  <a href="Info.php">Info</a>
		  <a href="login.php">Login</a>
		  <a href="#" class="activeone">About Us</a>
		  <a href="registration.php">Customer Registration</a>
		  <a href="employee.php">Employee Registration</a>
		  <a href="bookings.php">Bookings</a>
		  <a href="feedback.php" class="moveright">Feedback</a>
		</nav>
		<hr></hr>
		<br></br>
		
		<h2 class="center">Our Staff</h2>
		
		<div class="container">
		
		<div class="row">
		  <div class="column">
			<div class="card">
			   <img id="bioID" src="photos/nickBio.jpg" alt="nickBio" width="280" height="280">
				<h2 class="center"> Nicholas Mohan</h2>
				
				<div id="para"> <p> I am the Groups Main Intel, I track the targets that we 
				are after and let the group know ahead of time about their everymove. I also am 
				the teams "Eyes in the sky", offering air support if needed.</p> </div>
				<br></br>
				<a href = "mailto: nicholasmohan341@gmail.com"> nicholasmohan341@gmail.com </a>
				<br></br>
			</div>
			</div>
		</div>
		
		

		<div class="row">
		  <div class="column">
			<div class="card">
			   <img id="bioID" src="photos/susRP.jpg" alt="susRP" width="280" height="280">
				<h2 class="center"> Ripal Patel </h2>
				
				<div id="para"> <p>I handle the schedule for assassination, when and where the execution will transpire.
Also, determining the price for scheduled assassination which depends on the target,
the target's importance, the amount of security that the target enjoys,
and the chosen asset.</p> </div>
				<br></br>
				<a href = "mailto: ripal1598@gmail.com"> ripal1598@gmail.com</a>
				<br></br>
			</div>
			</div>
		</div>
		
		<div class="row">
		  <div class="column">
			<div class="card">
			   <img id="bioID" src="photos/dishonored2.jpg" alt="susRP" width="280" height="280">
				<h2 class="center"> Bhargav Patel </h2>
				
				<div id="para"> <p> People know me as the best insider who would camouflage 
                near the targets and wait for a sign from the Groups Main Intel for the 
                execution.My speciality is grenades like Poision, Smoke, Compressed gas and
                more.</p> </div>
				<br></br>
				<a href = "mailto: bhargavvalsad2001@gmail.com"> bhargavvalsad2001@gmail.com </a>
				<br></br>
			</div>
			</div>
		</div>
		
		<div class="row">
		  <div class="column">
			<div class="card">
			   <img id="bioID" src="photos/james_bio_photo.jpg" alt="susRP" width="280" height="280">
				<h2 class="center"> James Ricci </h2>
				
				<div id="para"> <p>Position: Hacker<br>Age: unknown<br>Ethnicity: unknown<br>Location: unknown
									<br>I live in the shadows, seeing what you don't want other's to see,
									exposing your weaknesses then disappearing without a trace...</p> </div>
				<br></br>
				<a href = "mailto: riccis2@gmail.com"> riccis2@gmail.com </a>
				<br></br>
			</div>
			</div>
		</div>
		</div>
		
		<div class="copywrite">
			<footer> 
					<span>Uber Hits Inc © </span>
					<h6>Nicholas Mohan N01361663 | Ripal Patel N01354619 | Bhargav Patel N01373029 | James Ricci N00411900</h6>
				
			</footer>
		</div>
		
	</body>
</html>
