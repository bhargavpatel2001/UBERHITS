<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>

		<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js">
		</script>
		<script src="javascript/login.js"> </script> 
		<link rel="stylesheet" href="styleTemplate.css"/>

		  <title>Login</title>

	</head>
	<body>
	
	
	<?php

	$usernameErr = $passwordErr = $loginErr ="";
	$username = $password = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		
		if(empty($_POST["username"])){
		
			$usernameErr = "Username required";
		}
		else{
		
			$username = $_POST['username'];
			
		}
		
		if(empty($_POST["password"])){
		
			$passwordErr = "Password required";
		}
		else{
			$password = $_POST['password'];	
		}
		
		
		
		if($_POST['checkbox'] == 1){
	
			$checkboxOption = "employees";		
		}
		else{
			$checkboxOption = "usercredentials";
		
		}
		
		
		if ( $usernameErr ==""&& $passwordErr ==""){
		
	
	
		$dbc = mysqli_connect('localhost', 'serverUser', 'Ceng@256', 'uberhits') or die ("Could not Connect!\n");
		$saltSQL = "select * from $checkboxOption where username = '$username';";
       		$saltQueryResult = mysqli_Query($dbc, $saltSQL);
        	$saltArray = mysqli_fetch_assoc($saltQueryResult);
        	$salt = $saltArray["salt"];
        	$saltPass = $password.$salt;
		$hashedPassword = hash('sha256',$saltPass);
		$sql = "select * from $checkboxOption where username = '$username' and password = '$hashedPassword';";
		
		
		$result = mysqli_Query($dbc, $sql) or die ("Error querying database");
		$a = mysqli_num_rows($result);
	
		if($a == 0){
		
			$loginErr = "Invalid username or password";
		}
		else{
			setcookie('username', $username, time()+1000);
		
			$row=mysqli_fetch_array($result) or die ("fetch array no work");
			$_SESSION['userid']=$row['uid'];
			$_SESSION['time']=time();
			$_SESSION['username']=$username;	
			//$_SESSION['checkboxOption'] = $checkboxOption;				
			header('Location:/Uber_Hits_Final/loginsuccessfull.php');			
		}		
	}
	
	}

?>


	
	<div class="mainpage">
		<div class="cn">
		
		  <h2 id="loginTitle">Login</h2>
		  
		  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="registration" class="loginPage">

			<label for="checkbox">Employees login</label>
			<input type="checkbox" name="checkbox" value=1 id="checkbox">
			<br> </br>
			
			<label for="username">Username</label>
			<input type="text" name="username" id="username" placeholder="Username" value="<?php echo $username;?>"/>
			<span class="error"><?php echo $usernameErr;?></span>
			<br/><br/>

			<label for="password">Password</label>
			<input type="password" name="password" id="password" placeholder="8-16 Characters" value="<?php echo $password;?>"/>

			<span class="error"><?php echo $passwordErr;?></span>
			<br/><br/>
	
			<span class="error"><?php echo $loginErr;?></span>
			<br/><br/>

			
			
			<button type="submit" name="submit" value="Submit" >Login</button>
			
		  </form>
		</div>
	</div>
	
	</body>

</html>
