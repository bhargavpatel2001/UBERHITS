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
		
		<div class="MainBanner" id="eregistration">
			<h1 class="center" id="feedTitle">Register with us!</h3>
		</div>		
		
		
		<nav class="navigationBar">
		  <a href="homepage.php">Home</a>
		  <a href="Info.php">Info</a>
		  <a href="login.php">Login</a>
		  <a href="aboutUs.php">About Us</a>
		  <a href="#" class="activeone">Customer Registration</a>
		  <a href="employee.php">Employee Registration</a>
		  <a href="bookings.php">Bookings</a>
		  <a href="feedback.php" class="moveright" >Feedback</a>
		</nav>
		<hr></hr>
<?php

	$fnameErr = $lnameErr = $usernameErr = $passwordErr = "";
	$fname = $lname = $username = $password = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		if(empty($_POST["fname"])){
		
			$fnameErr = "First name required";
		}
		else{
		
			$fname = test_inputS($_POST["fname"]);
		
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
			
				$passwordErr = "Must contain one uppercase, lowercase, number, special character. Mininum length 8";
			}
		}
		
		if ( $fnameErr ==""&& $lnameErr ==""&& $usernameErr ==""&& $passwordErr ==""){
	
		$dbc = mysqli_connect("localhost", "serverUser", "Ceng@256", "uberhits") or die ("Could not Connect!\n");
		$sql = "select * from usercredentials where username = '$username';";
		$result = mysqli_query($dbc, $sql) or die ("Error querying database1");
		$a = mysqli_num_rows($result);
	
		if($a > 0){
		
			$usernameErr = "Username already exists";
		}
		else{
		
			$salt = generateSalt();
			$saltPass = $password.$salt;
			$hashedPassword = hash('sha256',$saltPass);
			$sql = "insert into usercredentials values (null, '$fname', '$lname', '$username', '$hashedPassword', '$salt', 1);";
			$result = mysqli_query($dbc, $sql) or die ("Error querying database2");
			$row=mysqli_fetch_array($result);
			$_SESSION['userid']=$row['uid'];
			$_SESSION['time']=time();
			$_SESSION['username']=$username;
			setcookie('username', $username, time()+1000);				
			header('Location:/Uber_Hits_Final/loginsuccessfull.php');
			mysqli_close();
			
			
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
<div class="cn1">
<h2 id= "registrationTitle" class="feedback"> Customer Registration </h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"class="registrationPage">
    <p class="feedback">First name: </p>
    <input type="text" name="fname" value="<?php echo $fname;?>"/>
    <span class="error">* <?php echo $fnameErr;?></span>
    <br/><br/>
    <p class="feedback">Last name:</p>
    <input type="text" name="lname" value="<?php echo $lname;?>"/>
    <span class="error">* <?php echo $lnameErr;?></span>
    <br/><br/>
    <p class="feedback">Desired Username:</p>
    <input type="text" name="username" value="<?php echo $username;?>"/>
    <span class="error"><?php echo $usernameErr;?></span>
    <br/><br/>
    <p class="feedback">Password:</p>
    <input type="password" name="password" value="<?php echo $password;?>"/>
    <span class="error"><?php echo $passwordErr;?></span>
    <br/><br/>
    <button type="submit" name="submit" value="Submit"/>  Register</button>

</form>
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


