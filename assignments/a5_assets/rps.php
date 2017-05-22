<?php session_start(); 
	require_once('connection.php');
	
	$name = $_SESSION['valid_user'];
	//echo $name."<br/>";
?>

<?php
    if(isset($_POST['action']) && !empty($_POST['action']))
	{
	     
	   if(isset($_SESSION['valid_user'])) 
	   {
		  $userName =	$_SESSION['valid_user'];
	   }
	   else
	   {
	      $userName =	"Anonymous";
	   }
	   
	   if (isset($userName)) 
	   {
		//$userName =	$_SESSION['valid_user'];		
		$dbc = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		
		try 
		{
			// set the PDO error mode to exception
			$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			$selectQuery = $dbc->prepare("SELECT `userName`, `numWins`, `numLosses`, `numTies` FROM Scoreboard WHERE `userName` = '$userName'");
			$selectQuery->execute();
			
			//$dbc->query($selectQuery) as $row;
			
			$score = $selectQuery -> fetch(1);
 			
			$numWins = $score['numWins'];
			$numLosses = $score['numLosses'];
			$numTies = $score['numTies'];
			
			//echo 'numWins = ' . $numWins;
			//echo 'numLosses = ' . $numLosses;
			//echo 'numTies = ' . $numTies;
		    //echo 'score = ' . $score['numWins'];
			//echo "database connected successfully";
			
			
		}
		catch(PDOException $e)
		{
			echo $selectQuery . "<br>" . $e->getMessage();
		}
	   }
	   
	   
	   $action = $_POST['action'];
	   switch($action)
	   {
	      case 'user': 
		     //echo 'User Wins!';
		     incrementWins($numWins, $userName, $dbc); 
	 	     $output = array(
			 "wins" => $numWins+1,
			 "losses" => $numLosses,
			 "ties" => $numTies,
			 );
			 echo json_encode($output);
			 break;   
	      case 'computer':
		     //echo 'Computer Wins!';
			 incrementLosses($numLosses, $userName, $dbc); 
			 $output = array(
			 "wins" => $numWins,
			 "losses" => $numLosses+1,
			 "ties" => $numTies,
			 );
			 echo json_encode($output);
		     break;
		  case 'tie':
             //echo 'Tie, Nobody Wins!';
			 incrementTies($numTies, $userName, $dbc); 
			 $output = array(
			 "wins" => $numWins,
			 "losses" => $numLosses,
			 "ties" => $numTies+1,
			 );
			 echo json_encode($output);
		     break;

	   }
	   

	}
	
	


	
	
	//$dbc = null;
?>

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
 
 ?>
 <?php

/*//echo 'User Choice = ' . $_POST['userChoice'];
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
	
	echo '<p><a href="rps.php">Play Again ?</a><br>';
	echo '<a href="scoreboard.php" target="_blank">View Scoreboard</a></p>';
}
else if(!$_POST['userChoice'])
{
	$userWins = 0;
	$computerWins = 0;
	$ties = 0;
}
*/


function incrementWins($initialNumber, $userName, $conn)
{
	$numWins = $initialNumber + 1;
	//$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	
	//$numWins = $increasedNumber;
	
/*	if(isset($_SESSION['valid_user']))
	{
		$userName =	$_SESSION['valid_user'];
	}
	else
	{
		$userName =	"Anonymous";
	}*/
	//echo '$initial number = ' . $initialNumber . '<br>';
	//echo '$increased number = ' . $numWins . '<br>';
	
	//$updateDBC = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	
	//If logged in
	if(isset($userName)) 
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
	/*else
	{
		
		$_SESSION['nonUserScore'] = $_SESSION['nonUserScore'] + 1;
	
		echo 'Non user score = ' . $_SESSION['nonUserScore'];
	}*/

			
	$conn = null;
		
}

function incrementLosses($initialNumber, $userName, $conn)
{
	$numLosses = $initialNumber + 1;
	//$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	
	//$numWins = $increasedNumber;
	
/*	if(isset($_SESSION['valid_user']))
	{
		$userName =	$_SESSION['valid_user'];
	}
	else
	{
		$userName =	"Anonymous";
	}*/
	//echo '$initial number = ' . $initialNumber . '<br>';
	//echo '$increased number = ' . $numWins . '<br>';
	
	//$updateDBC = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	
	//If logged in
	if(isset($userName)) 
	{
		try 
		{
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Scoreboard SET `numLosses` = '$numLosses' WHERE `userName` = '$userName'";
			$sql = $conn->prepare($sql);
			$sql->execute();
			
		}
		catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
		
	}
	/*else
	{
		
		$_SESSION['nonUserScore'] = $_SESSION['nonUserScore'] + 1;
	
		echo 'Non user score = ' . $_SESSION['nonUserScore'];
	}*/

			
			
	$conn = null;
}


function incrementTies($initialNumber, $userName, $conn)
{
	echo '\nTie!';
	
	$numTies = $initialNumber + 1;
	echo $numTies;
	//$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	echo '\nTie!';
	//$numWins = $increasedNumber;
	
/*	if(isset($_SESSION['valid_user']))
	{
		$userName =	$_SESSION['valid_user'];
	}
	else
	{
		$userName =	"Anonymous";
	}*/
	//echo '$initial number = ' . $initialNumber . '<br>';
	//echo '$increased number = ' . $numWins . '<br>';
	
	//$updateDBC = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	
	//If logged in
	if(isset($userName)) 
	{
		try 
		{
			echo '\n\nInside Try Portion';
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Scoreboard SET `numTies` = '$numTies' WHERE `userName` = '$userName'";
			$sql = $conn->prepare($sql);
			$sql->execute();
			
		}
		catch(PDOException $e)
		{
			echo '\n\nInside Catch Portion';
			echo $sql . "<br>" . $e->getMessage();
		}
		
	}
	/*else
	{
		
		$_SESSION['nonUserScore'] = $_SESSION['nonUserScore'] + 1;
	
		echo 'Non user score = ' . $_SESSION['nonUserScore'];
	}*/

			
	$conn = null;	
		
}
	
?>



 
