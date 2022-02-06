<?php

?>

<!doctype html>
<html>
  <head>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    
    <title>MLB Database</title>
  </head>
  
  <body>
      
      
	<div id="wrap">
	    <div id="navigate2">
	        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                        <a class="nav-link" href="index.php">MLB Home
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pitcher_sort.php">Stats</a>
                      </li>                      
                      <li class="nav-item">
                        <a class="nav-link" href="team.php">Teams</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="player.php">Players</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="game.php">New Game</a>
                      </li>
                    </ul>
                
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="register.php"><span class="glyphicon glyphicon-user"></span>Register</a></li>
                      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                
                </div>
            </nav>
	    </div>
	    
        <div id="content" class="clearfix">
        	<div id="info">

            <h3>
                <?php 


                    echo '<img src = "img/banner_mlb_db.jpg" style="width:100%;">';



                ?>                
                
            </h3>
				