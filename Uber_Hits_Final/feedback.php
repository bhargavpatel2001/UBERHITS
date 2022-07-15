<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js">
		</script>
		<script src="javascript/feedback.js"> </script> 
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
		
		<div class="MainBanner" id="feedback">
			<h1 class="center" id="feedTitle">Please let us know how we're doing</h3>
		</div>		
		
		
		<nav class="navigationBar">
		  <a href="homepage.php">Home</a>
		  <a href="Info.php">Info</a>
		  <a href="login.php">Login</a>
		  <a href="aboutUs.php">About Us</a>
		  <a href="registration.php">Customer Registration</a>
		  <a href="employee.php">Employee Registration</a>
		  <a href="bookings.php">Bookings</a>
		  <a href="feedback.php" class="moveright activeone" >Feedback</a>
		</nav>
		<hr></hr>
		
		<?php 
		
			
			
			
				$easeOfUseErr = $hitmanErr = $reviewErr = $ageErr = $genderErr = $languageErr = $reasonErr = $usedServiceErr = $ifyesErr = "";
				$dbc = mysqli_connect("localhost", "serverUser", "Ceng@256", "uberhits") or die ("Could not Connect!\n");
			
				if($_SERVER["REQUEST_METHOD"] == "POST"){
				
					
				       
					if(empty($_POST["ease"])){
					
						$easeOfUseErr = "Required";
					}
					else{
						$easeOfUse = (int)$_POST["ease"];
					}
					if(empty($_POST["hitman"])){
					
						$hitmanErr = "Required";
					}
					else{
						$hitman = (int)$_POST["hitman"];
					}
					if(empty($_POST["review"])){
					
						$reviewErr = "Required";
					}
					else{
						$review = $_POST["review"];
					}
					if(empty($_POST["age"]) || $_POST["age"] == 0){
					
						$ageErr = "Required";
					}
					else{
						$age = (int)$_POST["age"];
					}
					if(empty($_POST["gender"])){
					
						$genderErr = "Required";
					}
					else{
						$gender = (int)$_POST["gender"];
					}
					if(empty($_POST["language"])){
					
						$languageErr = "Required";
					}
					else{
						$language = $_POST["language"];
					}
					if(empty($_POST["reason"])){
					
						$reasonErr = "Required";
					}
					else{
						$reason = $_POST["reason"];
					}
					if($_POST["yesno"] != 2 && $_POST["yesno"] != 1){
					
						$usedServiceErr = "Required";
					}
					else{
						$usedService = (int)$_POST["yesno"];
					}
					
					if($_POST["yesno"] == 2 && empty($_POST["ifyes"])){
					
						$ifyesErr = "Required";
					}
					elseif($_POST["yesno"] == 1){
						$ifyes = "N/A";
					}
					else{
						$ifyes = $_POST["ifyes"];
					}
					
					
					
					if($easeOfUseErr == "" && $hitmanErr == "" && $reviewErr == "" && $ageErr == "" && $genderErr == "" && $languageErr == "" && $reasonErr == "" && $usedServiceErr == "" && $ifyesErr == ""){
					
					
						if($_SESSION['edit'] == 1){
						
							//$usedService = $usedService-1;
							
							$fid = $_SESSION['fid'];
							
								$sql = "update feedback set easeOfUse='$easeOfUse', hitman='$hitman', review='$review', age='$age', gender='$gender', language='$language', reason='$reason', usedService='$usedService', ifyes='$ifyes' where fid='$fid';";
							$_SESSION['edit'] = 0;
						
						}
						else{
						
							//$usedService = $usedService-1;
							$sql = "insert into feedback values (null, '$easeOfUse', '$hitman', '$review', '$age', '$gender', '$language', '$reason', '$usedService', '$ifyes');";
						}
						
						
						if(isset($_COOKIE['username'])){
							$result = mysqli_query($dbc, $sql) or die ("Error querying database");
						}
						else{
							header('Location:/Uber_Hits_Final/login.php');
						}
						
						$fidSQL = "select max(fid) from feedback;";
						$fidQuery = mysqli_query($dbc, $fidSQL) or die("Error querying database");
						$fidArray = mysqli_fetch_row($fidQuery);
						$fid = $fidArray[0];
						
						
						setcookie('fid', $fid, time()+1000);
						
						$_SESSION['fid']=$fid;
						
						$_SESSION['easeOfUse'] = $easeOfUse;
						$_SESSION['hitman'] = $hitman;
						$_SESSION['review'] = $review;
						$_SESSION['age'] = $age;
						$_SESSION['gender'] = $gender;
						$_SESSION['language'] = $language;
						$_SESSION['reason'] = $reason;
						$_SESSION['usedService'] = $usedService;
						$_SESSION['ifyes'] = $ifyes;
						
						header('Location:/Uber_Hits_Final/successFeedback.php');
						mysqli_close();
					}
					
				
				}
		
		
		?>
		
		<div>
			<h2 class="feedback">Feedback Form</h2>
			
			<?php 
				if(isset($_COOKIE['fid'])){
					
						$easeOfUse = $_SESSION["easeOfUse"];
						$hitman = $_SESSION["hitman"];
						$review = $_SESSION["review"];
						$age = $_SESSION["age"];
						$gender = $_SESSION["gender"];
						$language = $_SESSION["language"];
						$reason = $_SESSION["reason"];
						$usedService = $_SESSION["usedService"];
						$ifyes = $_SESSION["ifyes"];
						//echo "<h1>TEST</h1>";
						setcookie('fid', 0, time()-1);
					}
			
			?>
			
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name = "Feedback" class="feedback">
				<p class="feedback">How would you rate our site's ease of use?</p>
				<span class="error">* <?php echo $easeOfUseErr;?></span>
				<hr class="break"></hr>
				<input class="feedback radio" type="radio" id="easy" name="ease" value=1 <?php echo ($easeOfUse ==1)?'checked':'' ?>>
				<label class="feedback" for="easy">Easy</label><br>
				<input class="feedback radio" type="radio" id="complex" name="ease" value=2 <?php echo ($easeOfUse ==2)?'checked':'' ?>>
				<label class="feedback" for="complex">Complex</label><br>
				<input class="feedback radio" type="radio" id="neither" name="ease" value=3 <?php echo ($easeOfUse ==3)?'checked':'' ?>>
				<label class="feedback" for="neither">Neither easy or complex</label>
				<br><br>
				
				<p class="feedback">Please select a Hitman to review</p>
				<span class="error">* <?php echo $hitmanErr;?></span>
				<hr class="break"></hr>
				
				<input class="feedback radio" type="radio" id="Nicholas" name="hitman" value=1 <?php echo ($hitman==1)?'checked':''?> >
				<label class="feedback" for="Nicholas">Nicholas</label>
				<input class="feedback radio" type="radio" id="Ripal" name="hitman" value=2 <?php echo ($hitman ==2)?'checked':'' ?>>
				<label class="feedback" for="Ripal">Ripal</label>
				<input class="feedback radio" type="radio" id="Bhargav" name="hitman" value=3 <?php echo ($hitman ==3)?'checked':'' ?>>
				<label class="feedback" for="Bhargav">Bhargav</label>
				<input class="feedback radio" type="radio" id="James" name="hitman" value=4 <?php echo ($hitman ==4)?'checked':'' ?>>
				<label class="feedback" for="James">James</label><br><br>
				<label class="feedback" for="review">Please enter review below</label><br>
				<span class="error">* <?php echo $reviewErr;?></span>
				<textarea class="feedback" id="review" name="review" rows="4" cols="50"><?php echo $review;?></textarea>
				<br><br>
				
				
				<p class="feedback">Please enter some information about yourself</p>
				<hr class="break"></hr>
				<label class="feedback age" for="ages">Age</label><br>
				<span class="error">* <?php echo $ageErr;?></span>
				<select class="select-css" name="age">
					<option value=0>Please Select</option>
					<option value=1830 <?php echo ($age == 1830)?'selected':'' ?>>18 - 30</option>
					<option value=3150 <?php echo ($age == 3150)?'selected':'' ?>>31 - 50</option>
					<option value=5170 <?php echo ($age == 5170)?'selected':'' ?>>70+</option>
				</select><br>
				<p class="feedback">Gender</p>
				
				<input class="feedback radio" type="radio" id="male" name="gender" value=1 <?php echo ($gender ==1)?'checked':'' ?>>
				<label class="feedback" for="male">Male</label><br>
				<input class="feedback radio" type="radio" id="female" name="gender" value=2 <?php echo ($gender ==2)?'checked':'' ?>>
				<label class="feedback" for="female">Female</label><br>
				<input class="feedback radio" type="radio" id="other" name="gender" value=3 <?php echo ($gender ==3)?'checked':'' ?>>
				<label class="feedback" for="other">Other</label>
				<br>
				<span class="error">* <?php echo $genderErr;?></span>
				<br><br>
				
				<label class="feedback" for="language">Language</label>
				
				<input class="feedback" id="lang"type="text" name="language" id="language" placeholder="Enter primary language" value="<?php echo $language;?>"/><span class="error">* <?php echo $languageErr;?></span><br><br>
				
				<label class="feedback" for="reason">Reason for hit</label><br>
				
				<textarea class="feedback" id="review" name="reason" rows="4" cols="50"> <?php echo $reason;?></textarea><span class="error">* <?php echo $reasonErr; ?> </span><br><br>
				
				<p class="feedback">Have you used a service like ours before?</p>
				<span class="error">* <?php echo $usedServiceErr;?></span>
				<hr class="break"></hr>
				
				<input class="feedback radio" type="radio" id="yes" name="yesno" value=2 <?php echo ($usedService ==2)?'checked':'' ?>>
				<label class="feedback" for="yes">Yes</label>
				<input class="feedback radio" type="radio" id="no" name="yesno" value=1 <?php echo ($usedService ==1)?'checked':'' ?>>
				<label class="feedback" for="no">No</label><br>
				<label class="feedback" for="ifyes">If yes, please state which service you have used</label><br>
				
				<textarea class="feedback" id="ifyes" name="ifyes" rows="2" cols="25"><?php echo $ifyes;?></textarea>
				<span class="error"><?php echo $ifyesErr;?></span><br><br><br>
				<input type="submit" name="submit" value="Submit" class="feedbutt"/>
			</form> 
		</div>
		<div class="copywrite">
			<footer> 
					<span>Uber Hits Inc © </span>
					<h6>Nicholas Mohan N01361663 | Ripal Patel N01354619 | Bhargav Patel N01373029 | James Ricci N00411900</h6>
			</footer>
		</div>
	</body>
</html>
