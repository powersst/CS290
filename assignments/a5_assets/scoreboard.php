<?php
	session_start();
	
	//$name = $_SESSION['valid_user'];
	//echo $name."<br/>";

	require_once('connection.php');
	// Connect to the database
	//$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  	$dbc = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	
	try 
	{
		// set the PDO error mode to exception
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$selectQuery = $dbc->prepare("SELECT `userName`, `numWins`, `numLosses`, `numTies` FROM Scoreboard ORDER BY `numWins` DESC");
		$selectQuery->execute();
	
	    //echo "database connected successfully";
	}
	catch(PDOException $e)
	{
		echo $selectQuery . "<br>" . $e->getMessage();
	}
	
	$dbc = null;
?>

<!doctype html>
<html>
<head>
<title>Scoreboard</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<script src="js/javascript.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
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
    <article id="scoreboard">
    <h2>Scoreboard</h2>
    
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


<table class="db-table">
<tr class="db-tr-header">
	<td class="db-td-header">User</td>
    <td class="db-td-header"></td>
    <td class="db-td-header">Wins</td>
    <td class="db-td-header"></td>
    <td class="db-td-header">Losses</td>
    <td class="db-td-header"></td>
    <td class="db-td-header">Ties</td>
    <td class="db-td-header"></td>
    <td class="db-td-header">Win Ratio</td>
</tr>
<?php foreach($selectQuery->fetchAll(PDO::FETCH_ASSOC) as $row) : $ratio = $row['numWins'] / $row['numLosses']; ?>
    <tr class="db-tr-inner">
        <td class="db-td-inner"><?php echo $row['userName']; ?></td>
        <td class="db-td-inner" style="border-bottom: none"></td>
        <td class="db-td-inner"><?php echo $row['numWins']; ?></td>
        <td class="db-td-inner" style="border-bottom: none"></td>
        <td class="db-td-inner"><?php echo $row['numLosses']; ?></td>
        <td class="db-td-inner" style="border-bottom: none"></td>
        <td class="db-td-inner"><?php echo $row['numTies']; ?></td>
        <td class="db-td-inner" style="border-bottom: none"></td>
        <td class="db-td-inner"><?php echo $ratio ?></td>
    </tr>
<?php endforeach;?>
</table>
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