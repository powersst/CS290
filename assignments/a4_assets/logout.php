<?php
	session_start();
	require_once('connection.php');
	$old_user = $_SESSION['valid_user'];
	unset($_SESSION['valid_user']);
	session_destroy();
?>


<!doctype html>
<html>
<head>
<link href="css/default.css" rel="stylesheet" type="text/css">
<script src="js/javascript.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Member Logout</title>
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
	<article id="logout">
    <h2>Logout</h2>

<?php
	if (!empty($old_user)) {
		echo 'User: '.$old_user.' is now logged out';
	} else {
		echo 'You were not logged in!';
	}
?>

</article>
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