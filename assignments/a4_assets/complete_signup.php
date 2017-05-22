<?php session_start() ?>
<!doctype html>
<html>
	<head>
		<link href="css/default.css" rel="stylesheet" type="text/css">
		<script src="js/javascript.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<title>Signup Complete</title>
        
        
	</head>
	
	<body>
		<div id="wrapper">    
			<header>
				<h1>Steven Powers - CS290</h1>
				<p>Hello World, this is Steven Powers' page.</p>
			</header>
			
			<nav id="primary">
				<ul>
					<li><a href="../../index.html">home</a></li>
					<li><a href="../../about.html">about</a></li>
					<li><a href="../../assignments.html">assignments</a></li>
				</ul>
			</nav>
			
			<nav id="secondary">
				<ul>
					<li><a href="signup.php">Sign up</a></li>
					<li><a href="login.php">Login</a></li>
					<li><a href="members.php">Members Page</a></li>
					<li><a href="rps.php">Rock Paper Scissors</a></li>
					<li><a href="scoreboard.php">Scoreboard</a></li>
				</ul>    
			</nav>
			
			<div id="page">
				<article id="SignupComplete">
					
					<?php
						//session_start();
						require_once('connection.php');
						// Connect to the database
						//$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
						$dbc = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
						
						$userName = strip_tags($_POST["userName"]);
						$firstName = strip_tags($_POST["firstName"]);
						$lastName = strip_tags($_POST["lastName"]);
						$name = $firstName . " " . $lastName;
						$non_hashed_password = strip_tags($_POST["password1"]);
						$hashed_password = substr(md5($non_hashed_password), 0, 15);
						
						
					  /*$passwordFlag = false;
						
						echo '<script>';
						echo 'var regexPassword = new RegExp("^[A-Z][a-zA-Z0-9]*[0-9]{2}$");';
						echo 'if(!regexPassword.test(' . $non_hashed_password . '))';
						echo '{';
						echo $passwordFlag = true; 
						echo '}';
						echo '</script>';
						
						echo '$passwordFlag = ' . $passwordFlag;<?php 
						*/
						
						
						try 
						{
							// set the PDO error mode to exception
							$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
							$selectQuery = "SELECT * FROM Users WHERE userName = '".$userName."'";
							$selectQuery = $dbc->prepare($selectQuery);
							$selectQuery->execute();
							
							$count = $selectQuery->rowCount();
							
							if(empty($userName) || empty($non_hashed_password) || $count > 0)
							{	
								
								echo "<h2>Duplicate Record</h2>";
								
								echo "<p>Please return to the <a href='signup.php'>signup form</a></p>";
								
								echo "</div>";
								echo "<footer>";
								echo "<p>&copy; Copyright 2015 Steven Powers - All rights reserved.</p>";
								echo "</footer>";
								die();
								
							}
							else
							{
								$sql = "INSERT INTO Users (userName, firstName, lastName, password)	VALUES ('$userName', '$firstName', '$lastName', '$hashed_password')";
								$sql = $dbc->prepare($sql);
								$sql->execute();
								
								$scoreSQL = "INSERT INTO Scoreboard (userName, numWins)	VALUES ('$userName', '0')";
								$scoreSQL = $dbc->prepare($scoreSQL);
								$scoreSQL->execute();
								
								echo "<h2>Signup Complete</h2>";
								
								echo "<p>New record created successfully.</p>";
								echo "<p>Please login to use your account <a href='login.php'>login page</a></p>";
							}
						}
						catch(PDOException $e)
						{
							echo $sql . "<br>" . $e->getMessage();
						}
						
						$dbc = null;
					?>
					
					
					<p>Welcome <?php echo $userName ?><br>
					Your name is: <?php echo $name ?></p>
					
				</article>
				
				
				
				
				
			</div>
			<footer>
				<p>&copy; Copyright 2015 Steven Powers - All rights reserved.</p>
			</footer>
		</div>
	</body>
</html>