<?php  session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<script src="js/javascript.js"></script>
<script src="js/signup.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script>
function checkFields(form) 
{
	var regexPassword = new RegExp("^[A-Z]+[a-zA-Z0-9]*([0-9]{2})$");
	var password = form.password1;
	
	//Valid password assign 4
	if(!regexPassword.test(password.value)) 
	{
		alert("Passwords must start with an capital letter and end with two digits Example: Apples99.");
		password.value = "";
		password.focus();
		return false;
	}
	
	return true;
}
</script>	
    
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
    <article id="rockPaperScissors">
    <h2>Sign up</h2>
    
<?php
  //session_start();
  
  $name = $_SESSION['valid_user'];
  //echo $name."<br/>";


  require_once('connection.php');
  // Connect to the database
  //$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  $dbc = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	
	try 
	{
		//$dbc = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
		//echo "New record created successfully";
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$dbc = null;

?>
<?php
	if (isset($_SESSION['valid_user'])) 
	{
		echo "<div id='userPanel'>";
		echo "<p>You are logged in as User: " . $_SESSION['valid_user'] . "</p>";
		echo "<p>First Name: ".$_SESSION['firstName']; 
		echo "<p> <a href='logout.php'>Log out </a><br />";
		echo "</div>";
	}
  else
  {
	echo "<h3>You are not logged in</h3>";  
	//echo $_SESSION['valid_user'];
  }

?>
  


  <p>Please enter your username and desired password to sign up for an account.</p>
  
  <form method="post" action="complete_signup.php" onSubmit="return checkFields(this)">
    <fieldset>
      <legend>Registration Info</legend>
      <p>Username:</p>
      <input type="text" id="userName" name="userName" required value="<?php if (!empty($userName)) echo $userName; ?>" /><br />
      <p>Password: Requires first character Capital and last two characters digits</p>
      <input type="password" id="password1" name="password1" placeholder="Ex. Apples99" required /><br />
      <p>First name:</p>
      <input type="text" id="firstName" name="firstName" required /><br />      	  
      <p>Last name:</p>
      <input type="text" id="lastName" name="lastName" required /><br />      	  
    </fieldset>
    <input type="submit" value="Sign Up" name="submit"  />
  </form>
  
  </article>

  <br>

</div>
      <footer>
  
    <p>&copy; Copyright 2015 Steven Powers - All rights reserved.</p>
	</footer>
</div>
</body> 
</html>
