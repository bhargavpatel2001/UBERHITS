<?php
session_start();
?>
<!DOCTYPE HTML>
<!-- NICHOLAS MOHAN N01361663 I ACTUALLY DID THIS -->

<html lang-"en">
	<!-- General Style Sheet Link-->
	<head>
		<meta charset="utf-8">
		<title>Success Bookings Page</title>
		<link rel="stylesheet" href="styleTemplate.css">
	</head>
	
	
	<body>
	       <header>
		<!-- UBER HITS LOGO -->
		
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
		
		<!-- Top Bar -->
		
		<img src="photos/bookings.jpg"  width= "100%" height="50%" alt="bookings"></img>
		
		</h2>
		
		<div class="text-overlay">
		
		   <div class= "center">
			  <?php if(isset($_SESSION["username"])){ echo "<h1>Booking Received!</h1>"; } ?>
			</div>
			
		</div>	
	       
		<nav class="navigationBar">
		  <a href="homepage.php">Home</a>
		  <a href="Info.php">Info</a>
		  <a href="login.php">Login</a>
		  <a href="aboutUs.php">About Us</a>
		  <a href="registration.php">Customer Registration</a>
		  <a href="employee.php">Employee Registration</a>
		  <a href="bookings.php">Bookings</a>
		  <a href="feedback.php" class="moveright">Feedback</a>
		</nav>
		<hr></hr>

<?php
if(isset($_SESSION["username"]))
	{

		echo "</br>";
		echo "<h2 class=center>BID: ".$_SESSION['bid']." </h2>";
		echo "</br>";
		echo "<h2 class=center>Date: ".$_SESSION['date']." </h2>";
		echo "</br>";
		echo "<h2 class=center>Target: ".$_SESSION['target']." </h2>";
		echo "</br>";
		echo "<h2 class=center>Location: ".$_SESSION['location']." </h2>";
		echo "</br>";
		echo "<h2 class=center>Paid: ".$_SESSION['paid']." </h2>";
		echo "</br>";
		echo "<h2 class=center>Method: ".$_SESSION['method']." </h2>";
		echo "</br>";
		echo "<h2 class=center>Specified Method: ".$_SESSION['methodSpecify']." </h2>";
		echo "</br>";
		
		echo '	 <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" name = "EditDelete" >
		
		<div id="cButton">

			<input type="submit" name="editB" value="Edit" class="bookingsbutton"/>
					
			<input type="submit" name="delete" value="Delete" class="bookingsbutton"/>
	
		</div>
		
		</form> ';
		
		if($_POST['editB'] == "Edit")
		{
			$_SESSION['editB'] = 1;
			header('Location:/Uber_Hits_Final/bookings.php');
		}
		if($_POST['delete'] == "Delete")
		{
				
			$dbc = mysqli_connect("localhost", "serverUser", "Ceng@256", "uberhits") or die ("Could not Connect!\n");
			$bid=$_SESSION['bid'];
			$sql = "delete from bookings where bid='$bid';";
					
			mysqli_query($dbc, $sql) or die ("Error querying database");
					
			echo "<h1 id = del>DELETED</h1>";
		}


		
	}
else 
{
	echo "</br><br><br>";
	echo "<h2 class = center> Please Login First! </h2>";
	echo "</br><br>";
}
	
?>

<br></br>



	
<br></br>

<div class="copywrite">
	<footer> 
	<span>Uber Hits Inc © </span>
	<h6>Nicholas Mohan N01361663 | Ripal Patel N01354619 | Bhargav Patel N01373029 | James Ricci N00411900</h6>
	</footer>
</div>
</body>
</html>


