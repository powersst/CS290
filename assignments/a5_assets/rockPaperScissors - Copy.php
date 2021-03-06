<!DOCTYPE html>
<html>
  <head>
     <title>Steven Powers - CS290 - Rock Paper Scissors</title>
  <link href="css/default.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/javascript.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
     <article id="rockPaperScissors">
	 <h2>Rock Paper Scissors</h2>
     
	 <p>Press Start Game, then make a selection of either Rock, Paper, or Scissors</p>
     <p>Then submit your choice, after the results are displayed you can click new game or reset at any time.</p>
     <p>Rock beats scissors, paper beats rock, scissors beats paper. Enjoy!</p>
    
     <div id="buttons">
     <input type="button" value="Start Game" id="startGame" onClick="return startGame();">
     <input type="button" value="Reset Game" id="resetGame" onClick="return hideGame();" style="display: none">
     <input type="button" value="New Round" id="newRound" onClick="return advanceRound();" style="display: none">
     <input type="button" value="Submit Choice" id="processGame" onClick="return processGame();" style="display: none">
     </div>
     
     <div id="gameDiv" style="display:none; margin-left: auto; margin-right: auto;">
     		
            <h3 id="theWinner"></h3>
            <h5 id="userWins"></h5>
            <h5 id="computerWins"></h5>
            <h5 id="gameCount"></h5>
            
           
            
     	 	<div id="images">
     	 		<img id="userImg" alt="Make your choice, then" title="User Choice" src="#">
         		<img id="computerImg" alt=" submit your choice." title="Computer Choice" src="#">
     		 </div>
         
         	<div id="userSide" style="float:left">
         
         	<input type="button" value="Rock" onClick="return userRock();">
         	<input type="button" value="Paper" onClick="return userPaper();">
        	<input type="button" value="Scissors" onClick="return userScissors();">
    	     
         		<p id="userSelection"></p>
         	</div>
        
        
         	<div id="computerSide">
         
 	        	<p id="computerSelection"></p>
         	</div>
         
         
         
     </div>


    
     </article>
   
     <section id="gameDiv2">
     
     
     </section>
   
   
     </div>
      <footer>
  
    <p>&copy; Copyright 2015 Steven Powers - All rights reserved.</p>
	</footer>
  </div>
 
</body>
</html>