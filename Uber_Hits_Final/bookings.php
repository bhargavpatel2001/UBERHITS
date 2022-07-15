<?php
session_start();
?>
<!DOCTYPE HTML>
<!-- NICHOLAS MOHAN N01361663 I ACTUALLY DID THIS -->

<html lang-"en">
	<!-- General Style Sheet Link-->
	<head>
		<meta charset="utf-8">
		<title>Bookings Page</title>
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
		
		<div class="MainBanner" id="bookingsimg">
		</div>
		
		<div class="text-overlay">
		
           
		   <div class= "center">
			   <h1>Book your hit here!</h1>
			</div>
			
		</div>	
		
		
		<nav class="navigationBar">
		  <a href="homepage.php">Home</a>
		  <a href="Info.php">Info</a>
		  <a href="login.php">Login</a>
		  <a href="aboutUs.php">About Us</a>
		  <a href="registration.php">Customer Registration</a>
		  <a href="employee.php">Employee Registration</a>
		  <a href="bookings.php" class="activeone">Bookings</a>
		  <a href="feedback.php" class="moveright">Feedback</a>
		</nav>
		<hr></hr>
		
<!-- PHP Code Starts Here!  -->
<?php
	
	$dateErr = $targetErr = $locationErr = $paidErr = $methodErr = $methodSpecifyErr = "";

	
	$dbc = mysqli_connect('localhost', 'serverUser', 'Ceng@256', 'uberhits') or die ("Could not Connect!\n");
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	
		
		if(empty($_POST["date"]))
		{
			$dateErr = "Date required!";
		}
		else
		{
			$date = $_POST["date"];
		}
		
		if(empty($_POST["target"]))
		{
			$targetErr = "Target required!";
		}
		else
		{
			$target = $_POST["target"];
		}
		
		if(empty($_POST["location"]))
		{
			$locationErr = "Location required";
		}
		else
		{
			$location = $_POST["location"];
		}
		
		if($_POST["paid"] != 2 && $_POST["paid"] != 1)
		{
			$paidErr = "Paid Input required!";
		}
		else
		{
			$paid = (int) $_POST["paid"];
		}
		
		if($_POST["method"] != "Shoot Them"  && $_POST["method"] != "Stab Them" && $_POST["method"] != "Drug Them" && $_POST["method"] != "None of the Above")
		{
			$methodErr = "Kill Method required!";
		}
		else
		{
			$method = $_POST["method"];
		}
		
		if($_POST["method"] == "None of the Above" && empty($_POST["methodSpecify"]))
		{
			$methodSpecifyErr = "Required!";
		}
		elseif ($_POST["method"] == "Shoot Them" || $_POST["method"] == "Stab Them" || $_POST["method"] == "Drug Them")
		{
			$methodSpecify == "N/A";
		}
		else 
		{
			$methodSpecify = $_POST["methodSpecify"];
		}
		
		//$date = $_POST["date"];
		//$target = $_POST["target"];
		//$location = $_POST["location"];
		//$paid = $_POST["paid"];
		//$method = $_POST["method"];
		
		if ( $dateErr ==""&& $targetErr ==""&& $locationErr ==""&& $paidErr == ""&& $methodErr == ""&& $methodSpecifyErr == "")
		{
		
			if($_SESSION['editB'] == 1)
			{
				
				$bid = $_SESSION['bid'];
							
				$sql = "update bookings set date='$date', target='$target', location='$location', paid='$paid', method='$method', methodSpecify='$methodSpecify' where bid='$bid';";
				$_SESSION['editB'] = 0;
						
			}
			else
			{
						
				$sql = "insert into bookings values (null,'$date', '$target', '$location', '$paid', '$method', '$methodSpecify');";	
				
			
				
				
				
			
			}
			

		
			$bidSQL = "select max(bid) from bookings;";
			
			
			if(isset($_COOKIE['username'])){
				$result = mysqli_query($dbc, $sql) or die ("Error querying database");
			}
			else{
				header('Location:/Uber_Hits_Final/login.php');
			}
			
			$bidQuery = mysqli_query($dbc, $bidSQL) or die ("Error querying bid");
			$bidArray = mysqli_fetch_row($bidQuery);
			$bid = $bidArray[0];
			
			setcookie('bid', $bid, time()+1000);
			
			$_SESSION['bid']=$bid;
			$_SESSION['date']=$date;
			$_SESSION['target']=$target;
			$_SESSION['location']=$location;
			$_SESSION['paid']=$paid;
			$_SESSION['method']=$method;
			$_SESSION['methodSpecify']=$methodSpecify;				
			mysqli_close();
			
			header('Location:/Uber_Hits_Final/successBookings.php');	
			
		}		
			
		
	}
	
?>
		
		<!-- MAIN Code Begins here  -->

		<div>
			<h2 id="formatbold" class="feedback">Bookings</h2>
			
			<?php 
				if(isset($_COOKIE['bid']))
				{
					
					$bid=$_SESSION['bid'];
					$date=$_SESSION['date'];
					$target=$_SESSION['target'];
					$location=$_SESSION['location'];
					$paid=$_SESSION['paid'];
					$method=$_SESSION['method'];
					$methodSpecify=$_SESSION['methodSpecify'];
						
					setcookie('bid', 0, time()-1);
				}
			
			?>
				
			<br></br>
			<form method="post" name="bookings" class="feedback"> 
			
			<!-- Date Picker  -->

			<label for="booking date" class="kill-radio">Booking Date:</label>
			<input type="date" name="date" value="<?php echo $date;?>">
			<span class="error">* <?php echo $dateErr;?></span>
			<br></br>
			
			<!-- Targets Info  -->
			<br></br>
			<h3 id="formatbold">Target</h3>
			<hr class="break"></hr>
			
			<p id="formatbold">Please State Targets Name and General Description</p>
			<br></br>
			<textarea class="bookings" name="target" rows="4" cols="50" ><?php echo $target;?></textarea>
			<span class="error">* <?php echo $targetErr;?></span>
			<br></br>
			
			<!-- Targets Location Info  -->
			<h3 id="formatbold">Location</h3>
			<hr class="break"></hr>
			<p id="formatbold">State the targets location</p>
			<br></br>
			<textarea class="bookings" name="location" rows="4" cols="50" ><?php echo $location;?></textarea>
			<span class="error">* <?php echo $locationErr;?></span>
			<br></br>
			
			<!-- Paid Status Radio Buttons  -->
			<h3 id="formatbold">Have You Paid ?</h3>
			<hr class="break"></hr>
			
			<input type="radio" name="paid" value = 2 <?php echo ($paid == 2)?'checked':''?>>
			<label class="kill-radio" >Yes</label>
			
			<input type="radio" name="paid" value = 1 <?php echo ($paid == 1)?'checked':''?>>
			<label class="kill-radio" >No</label>
			<span class="error">* <?php echo $paidErr;?></span>
			
			<br></br>
			
			<!-- Method of Kill Radio Buttons  -->
			<h3 id="formatbold">Method of Kill</h3>
			<hr class="break"></hr>
			
			<input type="radio" id="Shoot Them" name="method" value="Shoot Them" <?php echo ($method == "Shoot Them")?'checked':''?>>
			<label class="kill-radio" for="Shoot Them">Shoot Them</label>
			
			<input type="radio" id="Stab Them" name="method" value="Stab Them" <?php echo ($method == "Stab Them")?'checked':''?>>
			<label class="kill-radio" name="method" for="Stab Them">Stab Them</label>
			
			<input type="radio" id="Drug Them" name="method" value="Drug Them" <?php echo ($method == "Drug Them")?'checked':''?>>
			<label class="kill-radio" for="Drug Them">Drug Them</label>
			
			<input type="radio" id="none" name="method" value="None of the Above" <?php echo ($method == "None of the Above")?'checked':''?>>
			<label class="kill-radio" for="none">None of the Above</label>
			<span class="error">* <?php echo $methodErr;?></span>
			<br></br>
			
			
			<label id="formatbold" for="ifnone">If none of the above, please specify a kill method</label>
			<br></br>
			<textarea id="ifnone" name="methodSpecify" rows="2" cols="25"><?php echo $methodSpecify;?></textarea>		<span class="error">* <?php echo $methodSpecifyErr;?></span>
		
			<br></br>
			<br></br>

			<!-- Save and Submit Button  -->
			<input type="submit" name="submit" value="submit" class="bookingsbutton"></input>
			<br></br>
			<hr class="break"></hr>
			
			</form>
			
		<!-- Footer  -->
		</div>
		<div class="copywrite">
			<footer> 
				<span>Uber Hits Inc © </span>
				<h6>Nicholas Mohan N01361663 | Ripal Patel N01354619 | Bhargav Patel N01373029 | James Ricci N00411900</h6>
			</footer>
		</div>
	</body>
</html>
