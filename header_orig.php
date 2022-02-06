<?php

?>

<!doctype html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>MLB Database</title>
  </head>
  
  <body>
      
    
      
	<div id="wrap">
	    <div id="navigate">
	          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
                aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php">MLB Home
                    </a>
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
                  <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>Log Out</a></li>
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
