<?php 
    session_start();
	require_once('connection.php');
	
	$name = $_SESSION['valid_user'];
	//echo $name."<br/>";

	
	
	if (isset($_SESSION['valid_user'])) 
	{
		$userName =	$_SESSION['valid_user'];		
		$dbc = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		
		try 
		{
			// set the PDO error mode to exception
			$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			$selectQuery = $dbc->prepare("SELECT `userName`, `numWins` FROM Scoreboard WHERE `userName` = '$userName'");
			$selectQuery->execute();
			
			//$dbc->query($selectQuery) as $row;
			
			$score = $selectQuery -> fetch(1);
 			
			$numWins = $score['numWins'];
			//echo 'numWins = ' . $numWins;
		    //echo 'score = ' . $score['numWins'];
			//echo "database connected successfully";
			
			
		}
		catch(PDOException $e)
		{
			echo $selectQuery . "<br>" . $e->getMessage();
		}
	}
	
	
	
  	
  	
	
	
	
	




	//$dbc = null;
?>
<!doctype html>
<html>
<head>
<title>PHP RPS</title>
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
            <li><a href="rps.php">Rock Paper Scissors</a></li>
            <li><a href="scoreboard.php">Scoreboard</a></li>
        </ul>    
    </nav>
    
    <div id="page">
<article id="phpRockPaperScissors">
<h2>Rock Paper Scissors</h2>

<?php
    
    
	if (isset($_SESSION['valid_user'])) 
	{
		echo "<div id='userPanel'>";
		echo "<p>You are logged in as User: " . $_SESSION['valid_user'] . "</p>";
		echo "<p>First Name: ".$_SESSION['firstName']; 
		echo "<p><a href='logout.php'>Log out </a></p>";
		echo "</div>";
		
		$_SESSION['nonUserScore'] = 0;
	}
 

    //echo 'User Choice = ' . $_POST['userChoice'];
	if($_POST['userChoice'])
	{
		$userChoice = $_POST['userChoice'];
		
		
		
		$choices = array(Rock, Paper, Scissors);
		$choice = rand(0,2);
		$computerChoice = $choices[$choice];
		
		echo '<p>Computer Chooses: ' . $computerChoice . '<br>';
		echo 'You chose: ' . $userChoice . '</p>';
		
		if($userChoice == $computerChoice)
		{
			//it's a tie
			echo '<p>Result: Tie</p>';
			$ties++;
			$_SESSION['Score'] = (int)$_SESSION['Score'];
		}
		else if($userChoice == 'Rock' && $computerChoice == 'Scissors')
		{
			//Update Scoreboard Table
			echo '<p>Result: User Wins</p>';
			$_SESSION['Score'] = (int)$_SESSION['Score'] + 1;
			incrementWins($numWins, $dbc);
			$userWins++;
		}
		else if($userChoice == 'Rock' && $computerChoice == 'Paper')
		{
			//Update Scoreboard Table
			echo '<p>Result: Computer Wins</p>';
			$_SESSION['Score'] = (int)$_SESSION['Score'] - 1;
			$computerWins++;
			
		}
	    else if($userChoice == 'Scissors' && $computerChoice == 'Rock')
		{
		    echo '<p>Result: Computer Wins</p>';
		    $_SESSION['Score']= (int)$_SESSION['Score'] - 1;
			$computerWins++;
	    }
	    else if($userChoice == 'Scissors' && $computerChoice == 'Paper')
		{
		    echo '<p>Result: User Wins</p>';
		    $_SESSION['Score']= (int)$_SESSION['Score'] + 1;
			incrementWins($numWins, $dbc);
			$userWins++;
	    }
	    else if($userChoice == 'Paper' && $computerChoice == 'Rock')
		{
		    echo '<p>Result: User Wins</p>';
		    $_SESSION['Score']= (int)$_SESSION['Score'] + 1;
			incrementWins($numWins, $dbc);
			$userWins++;
	    }
	    else if($userChoice == 'Paper' && $computerChoice == 'Scissors')
		{
		    echo '<p>Result: Computer Wins</p>';
		    $_SESSION['Score']= (int)$_SESSION['Score'] - 1;
			$computerWins++;
	    }

	    /* 
	    echo 'You\'re score is currently: '.$_SESSION['Score'].' ';
		echo "<br>";
		echo 'user wins :' . $userWins;
		echo "<br>";
		echo 'computer wins :' . $computerWins;
		echo "<br>";
		echo 'ties :' . $ties;
		echo "<br>";
		*/
	    echo '<p><a href="rps.php">Play Again ?</a><br>';
		echo '<a href="scoreboard.php" target="_blank">View Scoreboard</a></p>';
	}
	else if(!$_POST['userChoice'])
	{
		$userWins = 0;
		$computerWins = 0;
		$ties = 0;
	}

	function incrementWins($initialNumber, $conn)
	{
		$numWins = $initialNumber + 1;
		
		
		//$numWins = $increasedNumber;
		$userName =	$_SESSION['valid_user'];	
		//echo '$initial number = ' . $initialNumber . '<br>';
		//echo '$increased number = ' . $numWins . '<br>';
		
		//$updateDBC = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		
		//If logged in
		if(isset($_SESSION['valid_user'])) 
		{
			try 
			{
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE Scoreboard SET `numWins` = '$numWins' WHERE `userName` = '$userName'";
				$sql = $conn->prepare($sql);
				$sql->execute();
				
			}
			catch(PDOException $e)
			{
				echo $sql . "<br>" . $e->getMessage();
			}
			
		}
		else
		{
			
			$_SESSION['nonUserScore'] = $_SESSION['nonUserScore'] + 1;
		
			echo 'Non user score = ' . $_SESSION['nonUserScore'];
		}

		
		
	
	}

?>

<p>Hello, please select either rock, paper, or scissors and then submit the form. <br>You then are able to choose another option and submit again or click play again.</p>
<div id="gameDiv2">
<form id="userChoice"  action="rps.php" method="post" >
	<img src="images/rock.jpg" alt="Rock" style="width: 100px;"><br>
    <input type="radio" name="userChoice" value="Rock" title="Rock" style="margin-left: 3.25em" /><br /><br />
    <img src="images/paper.jpg" alt="Paper" style="width: 100px;"><br>
	<input type="radio" name="userChoice" value="Paper" title="Paper" style="margin-left: 3.25em" /><br /><br />
    <img src="images/scissors.jpg" alt="Scissors" style="width: 100px;"><br>
	<input type="radio" name="userChoice" value="Scissors" title="Scissors" style="margin-left: 3.25em" /><br /><br />
    
    <input id="submit" name="submit" title="Submit form" type="submit" value="Submit" onClick="return hideGame2();">
</form>
</div>
</article>
</div>

      <footer>
  
    <p>&copy; Copyright 2015 Steven Powers - All rights reserved.</p>
	</footer>
</div>

</body>
</html>