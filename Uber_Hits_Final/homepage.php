<?php
session_start();
?>

<!DOCTYPE html>
<html id="scroll">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Welcome to Uber Hits</title>
		
			<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js">
			</script>
			<script src="javascript/homepage.js"> </script>
			
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
	
	<div class="contain"> 
			<div class="slogan" id="float">
			  <h1>Uber Hits</h1>
			</div>
		  </div>
	
	
		<div class="MainBanner carousel" id="banner">
		</div>
		
		
		
		
		<!-- Navigation -->
		<nav class="navigationBar">
		  <a href="#" class="activeone">Home</a>
		  <a href="Info.php">Info</a>
		  <a href="login.php">Login</a>
		  <a href="aboutUs.php">About Us</a>
		  <a href="registration.php">Customer Registration</a>
		  <a href="employee.php">Employee Registration</a>
		  <a href="bookings.php">Bookings</a>
		  <a href="feedback.php" class="moveright">Feedback</a>
		</nav>
		<hr></hr>

		<div id="MainParaContain"><h3 class="MainPara">Uber Hits Where Execution Is Key!</h3>
		<p class="MainPara">

Have you ever dream't of getting rid of that one pain in your life? <br> If so you've come to the right place! <br> 

Here at Uber Hits we are that solution for dealing with those scumbags that walk the earth.<br>

Our main goal is to be clean, untraceable and totally anonymous.<br>

If you are interested in learning more please visit our information page on how to get started.</p></div>
		
		
		<div class="copywrite">
			<footer> 
					<span>Uber Hits Inc © </span>
					<h6>Nicholas Mohan N01361663 | Ripal Patel N01354619 | Bhargav Patel N01373029 | James Ricci N00411900</h6>
			</footer>
		</div>

	</body>

</html>
