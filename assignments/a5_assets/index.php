<?php
	session_start();
?>

<!doctype html>
<html>
<head>
<link href="css/default.css" rel="stylesheet" type="text/css">
<script src="js/javascript.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Index Page</title>
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
            <li><a href="rockPaperScissors.php">Rock Paper Scissors</a></li>
            <li><a href="scoreboard.php">Scoreboard</a></li>
        </ul>    
    </nav>
    
    <div id="page">
	<article id="logout">
    <h2>Index</h2>

<?php
if (isset($_SESSION['valid_user'])) 
{
	echo "<div id='userPanel'>";
	echo "<p>You are logged in as User: " . $_SESSION['valid_user'] . "</p>";
	echo "<p>First Name: ".$_SESSION['firstName']; 
	echo "<p><a href='logout.php'>Log out </a></p>";
	echo "</div>";
}

?>

<p>Hello, on these pages you are able to create an account,<br>
   login/logout, view your members page, play rock paper scissors,<br>
   and view your score if logged in.</p>
   
   <p>Please use the navigation above.</p>

</article>



</div>
      <footer>
  
    <p>&copy; Copyright 2015 Steven Powers - All rights reserved.</p>
	</footer>
</div>
</body>
</html>