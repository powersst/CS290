// JavaScript Document
//Written By: Steven Powers

//Global variables
var userChoice;
var gameCount;
var userWinCount;
var computerWinCount;


//Starts the game, initializes the global variables to 0.
//Hides and shows the required items for game start.
function startGame()
{
	gameCount = 0;
	userWinCount = 0;
	computerWinCount = 0;

	document.getElementById("gameDiv").style.display = "block";
	document.getElementById("startGame").style.display = "none";
	document.getElementById("resetGame").style.display = "block";
	document.getElementById("newRound").style.display = "none";
	document.getElementById("processGame").style.display = "none";
	document.getElementById("userSide").style.display = "block";
}

//This function executes when the user clicks reset game
//This resets the game to only show the start game button for cleanliness 
function hideGame()
{
	document.getElementById("gameDiv").style.display = "none";
	document.getElementById('userSelection').innerHTML = "";	
	
	document.getElementById("theWinner").innerHTML = "";
	document.getElementById("userWins").innerHTML = "";
	document.getElementById("computerWins").innerHTML = "";
	document.getElementById("gameCount").innerHTML = "";
	
	document.getElementById("userImg").src = "#";
	document.getElementById("computerImg").src = "#";
	
	document.getElementById("resetGame").style.display = "none";
	document.getElementById("newRound").style.display = "none";
	document.getElementById("processGame").style.display = "none";
	document.getElementById("startGame").style.display = "block";
	

}

//This function unhides the user options if they click on the new round button.
//This function also hides the button that called it.
function advanceRound()
{
	document.getElementById('userSelection').innerHTML = "";
	document.getElementById("userImg").src = "#";
	document.getElementById("computerImg").src = "#";
	document.getElementById("newRound").style.display = "none";
	document.getElementById("userSide").style.display = "block";
}


//This function serves as the main for when the user clicks submit choice.
//The function will call the computerRandom function to return a random choice
//The function will then compare the user choice to the computer choice and determine a winner.
//This will then output an appropriate message, increment the game count, and update the win totals
//and finally setup the game for the next round. 
function processGame()
{
	document.getElementById("userSide").style.display = "none";
	//generate computer random choice
	var computerChoice = computerRandom();

	var winner = compare(userChoice, computerChoice);
	
	
	if (winner == "user")
	{
		userWins();	
		document.getElementById("theWinner").innerHTML = "The winner is the " + winner;
	}
	else if (winner == "computer")
	{
		computerWins();	
		document.getElementById("theWinner").innerHTML = "The winner is the " + winner;
	}
	else
	{
		document.getElementById("theWinner").innerHTML = "There is no winner, it's a tie!";
	}
	
	//Increment game 
	gameCount++;
	
	document.getElementById("userWins").innerHTML = "Number of user wins: " + userWinCount;
	document.getElementById("computerWins").innerHTML = "Number of computer wins: " + computerWinCount;
	document.getElementById("gameCount").innerHTML = "Number of games: " + gameCount;

	document.getElementById("processGame").style.display = "none";
	document.getElementById("newRound").style.display = "block";
}

//Called if the user wins, simply increments the userWinCount.
function userWins()
{
	//Increment win counter	
	userWinCount++;
}

//Called if the computer wins, simply increments the computerWinCount.
function computerWins()
{
	//Increment win counter	
	computerWinCount++;
}

//The user selects rock, show the appropriate image and flavor text.
function userRock()
{
	//User selected rock
	//alert("Rock!");
	document.getElementById('userSelection').innerHTML = "You selected Rock!";
	document.getElementById("userImg").src = "images/rock.jpg";
	document.getElementById("processGame").style.display = "inline-block";
	userChoice = "rock";
}

//The user selects paper, show the appropriate image and flavor text.
function userPaper()
{
	//User selected paper
	//alert("Paper!");
	document.getElementById('userSelection').innerHTML = "You selected Paper!";
	document.getElementById("userImg").src = "images/paper.jpg";
	document.getElementById("processGame").style.display = "inline-block";
	userChoice = "paper";
}

//The user selects scissors, show the appropriate image and flavor text.
function userScissors()
{
	//User selected scissors
	//alert("Scissors!");
	document.getElementById('userSelection').innerHTML = "You selected Scissors!";
	document.getElementById("userImg").src = "images/scissors.jpg";
	document.getElementById("processGame").style.display = "inline-block";
	userChoice = "scissors";
}


//Generates a random number and determines the 
//computers choice using 1st third to represent rock
//second third to represent paper
//last third to represent scissors
//Then return the computerChoice string.
function computerRandom()
{
	var randomNumber = Math.random();
	var computerChoice;
	
	if (randomNumber < 0.34)
	{
		computerChoice = "rock";
		document.getElementById("computerImg").src = "images/rockComp.jpg";
	}
	else if(randomNumber <= 0.67)
	{
		computerChoice = "paper";	
		document.getElementById("computerImg").src = "images/paperComp.jpg";
	}
	else
	{
		computerChoice = "scissors";
		document.getElementById("computerImg").src = "images/scissorsComp.jpg";
	}
	
	
	return computerChoice;
}


//Function that compares the two string values for user choice and computer choice.
function compare(user, computer) 
{
	var winner;
	
	if (user === computer)
	{
		winner = "tie";
	}
	
	else if (user === "rock")
	{
		if (computer === "scissors")
		{
			//user wins
			winner = "user";
		}
		else //paper
		{
			//computer wins	
			winner = "computer";
		}
	}
	
	else if (user === "paper")
	{
		if (computer === "scissors")
		{
			//computer wins	
			winner = "computer";
		}
		else //rock
		{
			//user wins 
			winner = "user";	
		}
	}
	
	else if (user === "scissors")
	{
		if (computer === "rock")
		{
			//computer wins	
			winner = "computer";
		}
		else //paper
		{
			//user wins
			winner = "user";
		}
	}
		
    //return who won
	return winner;
}




