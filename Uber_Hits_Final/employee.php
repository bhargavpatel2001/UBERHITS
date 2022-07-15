<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js">
		</script>
		<script src="javascript/.js"> </script> 
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
		
		<div class="MainBanner" id="eregistration">
			<h1 class="center" id="feedTitle">Work with us!</h3>
		</div>		
		
		
		<nav class="navigationBar">
		  <a href="homepage.php">Home</a>
		  <a href="Info.php">Info</a>
		  <a href="login.php">Login</a>
		  <a href="aboutUs.php">About Us</a>
		  <a href="registration.php" >Customer Registration</a>
		  <a href="#" class="activeone">Employee Registration</a>
		  <a href="bookings.php">Bookings</a>
		  <a href="feedback.php" class="moveright" >Feedback</a>
		</nav>
		<hr></hr>
<?php

	$fnameErr = $lnameErr = $usernameErr = $passwordErr = $skillsetErr = $positionErr = "";
	$fname = $lname = $username = $password = $skillset = $position = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		if(empty($_POST["fname"])){
		
			$fnameErr = "First name required";
		}
		else{
		
			$fname = test_inputs($_POST["fname"]);
		
		}
		
		if(empty($_POST["lname"])){
		
			$lnameErr = "Last name required";
		}
		else{
		
			$lname = test_inputs($_POST["lname"]);
		}
		
		if(empty($_POST["username"])){
		
			$usernameErr = "username required";
		}
		else{
		
			$username = test_inputs($_POST["username"]);
			
			if(!preg_match("/^[a-zA-Z]*$/", $username)){
			
				$usernameErr = "username must only contain letters";
			}
		}
		
		if(empty($_POST["password"])){
		
			$passwordErr = "Password required";
		}
		else{
		
			$password = test_inputs($_POST["password"]);
			
			if(!preg_match('/^(?=.{8,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$/', $password)){
			
				$passwordErr =  "Must contain one uppercase, lowercase, number, special character. Mininum length 8";
			}
		}
		
		if(empty($_POST["skillset"])){
		
			$skillsetErr = "Skillset required";
		}
		else{
			$skillset = test_inputs($_POST["skillset"]);
		
		}
		
		
		if($_POST["position"] == "select"){
		
			$positionErr = "Position required";
		}
		
		elseif($_POST["position"] == "MI"){
		
			$position = 1;			
		}
		elseif($_POST["position"] == "BO"){
		
			$position = 2;			
		}
		
		elseif($_POST["position"] == "IN"){
		
			$position = 3;			
		}
		
		elseif($_POST["position"] == "HC"){
		
			$position = 4;			
		}
		
		
		if ( $fnameErr ==""&& $lnameErr ==""&& $usernameErr ==""&& $passwordErr ==""&& $skillsetErr ==""&& $positionErr ==""){
	
		$dbc = mysqli_connect("localhost", "serverUser", "Ceng@256", "uberhits") or die ("Could not Connect!\n");
		$sql = "select * from employees where username = '$username';";
		$result = mysqli_query($dbc, $sql) or die ("Error querying database1");
		$a = mysqli_num_rows($result);
	
		if($a > 0){
		
			$usernameErr = "Username already exists";
		}
		else{
			$salt = generateSalt();
			$saltPass = $password.$salt;
			$hashedPassword = hash('sha256',$saltPass);
			$sql = "insert into employees values (null,'$fname','$lname','$username','$hashedPassword','$salt','$skillset', '$position');";
			$result = mysqli_query($dbc, $sql) or die ("Error querying database2");
			$_SESSION['userid']=$row['uid'];
           		$_SESSION['time']=time();
           		$_SESSION['username']=$username;
			mysqli_close();
			setcookie('username', $username, time()+1000);
			header('Location:/Uber_Hits_Final/loginsuccessfull.php');
			
		}
		
	}
	
	}
	
	function test_inputs($data){
	
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
	
	function generateSalt($max = 15) {
        	$characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
        	$i = 0;
        	$salt = "";
        	while ($i < $max) {
            		$salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
            		$i++;
        	}
        return $salt;
	}

?>
<div class="eregistrationpage">
<div class="cn1">

<h2 id= "registrationTitle" class="feedback"> Employee Registration </h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"class="registrationPage">
	<p class="feedback">First name: </p>
	<input type="text" name="fname" value="<?php echo $fname;?>"/>
	<span class="error">*<?php echo $fnameErr;?></span>
	<br/>
	<p class="feedback">Last name:</p>
	<input type="text" name="lname" value="<?php echo $lname;?>"/>
	<span class="error">*<?php echo $lnameErr;?></span>
	<br/>
	<p class="feedback">Desired Username:</p>
	<input type="text" name="username" value="<?php echo $username;?>"/>
	<span class="error">*<?php echo $usernameErr;?></span>
	<br/>
	<p class="feedback">Password:</p>
	<input type="password" name="password" value="<?php echo $password;?>"/>
	<span class="error">*<?php echo $passwordErr;?></span>
	<br/>
 	<p class="feedback">Skillset:</p>
	<input type="text" name="skillset" value="<?php echo $skillset;?>"/>
	<span class="error">*<?php echo $skillsetErr;?></span>
	<br/>

	<!--<input type="number" name="position" value="<?php echo $position;?>"/>-->
	<label class="feedback" for="position">Position:</label><br>
                <select class="select-css" name="position">
                    <option value="select">Select</option>
                    <option value="MI">Main Intel</option>
                    <option value="BO">Booker</option>
                    <option value="IN">Insider</option>
                    <option value="HC">Hacker</option>
                </select><br>
	<span class="error">*<?php echo $positionErr;?></span>

	<button <input type="submit" name="submit" value="Submit"/> Register </button>
</form>
</div>
</div>
</br></br>
<div class="copywrite">
			<footer> 
				<span>Uber Hits Inc © </span>
				<h6>Nicholas Mohan N01361663 | Ripal Patel N01354619 | Bhargav Patel N01373029 | James Ricci N00411900</h6>
			</footer>
		</div>
</body>
</html>



