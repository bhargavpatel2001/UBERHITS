<?php
session_start();
?>

<!DOCTYPE html>
  <html lang-"en"  id="scroll">
   <head>
		<!-- JavaScript Link -->
		<script src="javascript/info.js"></script>
	<meta charset="utf-8">
	<title>Information Page</title>
	
	<!-- General Style Sheet Link-->
	<link rel="stylesheet" href="styleTemplate.css">
	
	
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
	
	
	
	
	
	
		<!-- Top Bar 
		
		<img src="photos/incognito.jpg"  width= "100%" height="100%" alt="incognito guy" class="image"></img>
		
		<div class="text-overlay">         
		   <div class= "center">
			   <h1>Uber Hits Information</h1>
			   <h3>Uber Hits, Where execution is our Specialty</h3>
			</div>			
		</div> -->
		
		<div class="MainBanner" id="info">
			
			<h1 class="center">Uber Hits Information</h1>
			<h3 class="center" id="infoFontColour">Uber Hits, Where execution is our Specialty</h3>
		</div>
		
		
		
		
		
		<!-- Navigation -->
		<nav class="navigationBar">
		  <a href="homepage.php">Home</a>
		  <a href="#" class="activeone">Info</a>
		  <a href="login.php">Login</a>
		  <a href="aboutUs.php">About Us</a>
		  <a href="registration.php">Customer Registration</a>
		  <a href="employee.php">Employee Registration</a>
		  <a href="bookings.php">Bookings</a>
		  <a href="feedback.php" class="moveright">Feedback</a>
		</nav>
		
		<hr></hr>
		
		<br></br>
		<br></br>
		
		
		
		
		
		<!-- Pic1 -->
		
		<img src="photos/Moneyheist.jpg" id="pic1" alt="Gang" width= "auto"height="auto" class="centerImage" onmouseover="imageNew1()" onmouseout="imageOld1()"></img>
		
		<br></br>
		
		<!-- Para1 -->
		
		<div class="column">
	
			<div id="para">
			
			<p id="p1" onmouseover="textOnHover1()" onmouseout="textNotHover1()" class="center"> Here at Uber Hits, we strive to protect our clients while getting the task at hand done at all costs. Our aim is to perform clean, untraceable executions of our targets.</p>
			
			</div>
			
		</div>
		
		<br></br>
		
		
		
		
		
		<!-- Pic2 -->
		
		<img src="photos/shooter-hitman.jpg" id="pic2" alt="Ops" width= "auto"height="auto" class="centerImage" onmouseover="imageNew2()" onmouseout="imageOld2()" ></img>
		
		
		<br></br>
		
		<!-- Para2 -->
		
		
		<div class="column">
		
			<div id="para">
			
			<p id="p2" onmouseover="textOnHover2()" onmouseout="textNotHover2()" class="center"> With our intelligent team of ex-private ops here to make sure what needs to be done, gets done. </p>
			
			</div>
		
		</div>
		
		<br></br>
		
		
		
		
		
		<!-- Pic3 -->
		
		<img src="photos/aboutus.jpg" id="pic3" alt="Book" width= "600px"height="600px"  class="centerImage2"; onmouseover="imageNew3()" onmouseout="imageOld3()" ></img>
		
		<br></br>
	
		<!-- Para3 -->
		
		<div class="column">
		
			<div id="para">
			
			<p id="p3" onmouseover="textOnHover3()" onmouseout="textNotHover3()"class="center"> No task is to small, even the most outrageous of requests. Let us know by reserving your very own hit today. We are simply only an email away, serious inquires only. We take our duties seriously.</p>
			
			</div>
			
		</div>
		
		<br></br>
		<br></br>
		
		
		
		
		
		<!-- Footer -->
		
		<div class="copywrite">
			<footer> 
					<span>Uber Hits Inc © </span>
					<h6>Nicholas Mohan N01361663 | Ripal Patel N01354619 | Bhargav Patel N01373029 | James Ricci N00411900</h6>
			</footer>
		</div>
		
		
		
		
	</body>
</html>
