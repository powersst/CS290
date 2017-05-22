<?php
	session_start();
	require_once('connection.php');
 
	if ((isset($_POST['userName'])) && (isset($_POST['password'])) )
	{
		$userName = $_POST['userName'];
		$password = substr(md5($_POST['password']), 0, 15);
	
	    //echo $userName;
		//echo $password;
	
		$dbc = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		if (!$dbc) 
		{
			die('Could not connect: ');
		}
		else
		{
		    //echo '<p>Successfully connected to database!</p>';	
		}
	
		//$query = "SELECT * FROM Users WHERE userName='$userName' and password='$password'";
		//$result = mysqli_query($dbc, $query);
		
		//$selectQuery = "SELECT * FROM Users WHERE userName = '".$userName."' and password = '".$password."'";
		$selectQuery = "SELECT * FROM Users WHERE userName = '$userName' and password = '$password'";
		//$selectQuery = "SELECT * FROM Users WHERE userName = '".$userName."'";
		$selectQuery = $dbc->prepare($selectQuery);
		$selectQuery->execute();
		
		
		$sample = $selectQuery -> fetch();
		//echo "sample printout = " . $sample["userName"];
		
		$test = "SELECT * FROM Users WHERE userName = '$userName' and password = '$password'";
		foreach ($dbc->query($test) as $row)
		{
			//print $row['userName'] . "\t";
			//print $row['password'] . "\t";
			//print $row['firstName'] . "\t";
			//print $row['lastName'] . "\t";			
		}
		
	    $count = $selectQuery->rowCount();
		//echo $count;
		if ($count == 1) 
		{
	          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
			  //$row = $selectQuery->fetchAll();
			  //echo $row;
			  $_SESSION['firstName'] = $row['firstName'];
			  $_SESSION['valid_user'] = $row['userName'];
			  
			  //echo "session " . $_SESSION['valid_user'];
		}
		else 
		{
          // The username/password are incorrect so set an error message
			echo "<p>Sorry, you must enter a valid username and password to log in.</p>";
		}
		
		$result = null;
		$dbc = null;
	}  

?>


<!doctype html>
<html>
<head>
<link href="css/default.css" rel="stylesheet" type="text/css">
<script src="js/javascript.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Member Login</title>
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
    <article id="login">
    <h2>Login</h2>
    
<?php
    
	if (isset($_SESSION['valid_user'])) 
	{
		echo "<div id='userPanel'>";
		echo "<p>You are logged in as User: " . $_SESSION['valid_user'] . "</p>";
		echo "<p>First Name: ".$_SESSION['firstName']; 
		echo "<p> <a href='logout.php'>Log out </a><br />";
		echo "</div>";
		
		echo " <form method='post' action=''  > ";
		echo " <p>User name</p><input type='text' name='userName' disabled> <br /> ";
		echo " <p>Password</p><input type='password' name='password' disabled/> <br />";
		echo '<input type="submit" value="Log In" name="submit" disabled />';
		echo "</form>";
	}
	else 
	{
		if (isset($userName)) 
		{
			// user tried but can't log in
			echo "<h2>Sorry these credentials are incorrect; could not log you in.</h2>";
		} 
		else 
		{
			// user has not tried
			echo "<p>Hello, you need to log in.</p>";
		}
		// Log in form

		echo " <form method='post' action='login.php' > ";
		echo " <p>User name</p><input type='text' name='userName'> <br /> ";
		echo " <p>Password</p><input type='password' name='password' /> <br />";
		echo '<input type="submit" value="Log In" name="submit" />';
		echo "</form>";
	}	
?>

</article>

<br>
<!--
<p><a href="signup.php">Sign up</a></p>
<p><a href="complete_signup.php">Complete Sign up</a></p>
<p><a href="login.php">Login</a></p>
<p><a href="members.php">Members Page</a></p>
<p><a href="logout.php">Logout</a></p>
<p><a href="scoreboard.php">Scoreboard</a></p>
-->
</div>
      <footer>
  
    <p>&copy; Copyright 2015 Steven Powers - All rights reserved.</p>
	</footer>
</div>
</body>
</html>