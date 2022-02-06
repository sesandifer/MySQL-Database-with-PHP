<?php
    require("config.php");
    session_start();

    if(isset($_SESSION["id"])){
        include("header_orig.php");
    }
    else {
        include("header.php");
    }    
?>

<table class="grid">
    <tr>
        <th>Title</th>
        <th>Description</th> 
    </tr>



<?php

    $stmt = $mysqli->prepare("SELECT page_title, page_desc FROM web_pages WHERE page_alias like '%game%'");

    $stmt->execute();

    $stmt->bind_result($ptitle, $pdesc);
    
    while($stmt->fetch()){
        echo "<tr>\n<td>\n" . $ptitle . "\n</td>\n<td>\n" . $pdesc . "\n</td>\n</tr>";
    }
    $stmt->close();                            
?>

</table>
    
<br>
<div class="row">
<div class="col">
    

    <form method = "post" action = "add_game.php">
  		<p><h3>Create A New Game</h3></p>
		<fieldset>
            <legend>Select Visiting Team</legend>
			<select class="form-control" name = "TeamA">
<?php
$stmt = $mysqli->prepare("SELECT id, name, mascot FROM mlb_team ORDER BY name ASC");

$stmt->execute();

$stmt->bind_result($id, $team, $mascot);

while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $team .' '. $mascot .'</option>\n';
}
$stmt->close();
?>
            </select>
            
            
            <legend>Select Home Team</legend>
			<select class="form-control" name = "TeamB">
<?php
$stmt = $mysqli->prepare("SELECT id, name, mascot FROM mlb_team ORDER BY name ASC");

$stmt->execute();

$stmt->bind_result($id, $team, $mascot);

while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $team .' '. $mascot .'</option>\n';
}
$stmt->close();
?>
            </select>            

            <br>
            <div class="form-group row">
              <label for="example-date-input" class="col-2 col-form-label"><h4>Date</h4></label>
              <div class="col-10">
                <input class="form-control" type="date" value="2020-05-19" id="example-date-input">
              </div>
            </div>

		</fieldset>
        
        <button type="submit" class="btn btn-primary">Create Game</button>
        
    </form>
    <br>        
        
        
        
        
        
        
        
        
        
        
    <form method = "post" action = "add_stats.php">
  		<p><h3>Enter Player Game Results</h3></p>
		<fieldset>
            <legend>Select Player</legend>
			<select class="form-control" name = "Player">
<?php
$stmt = $mysqli->prepare("SELECT id, firstname, lastname FROM mlb_player ORDER BY lastname ASC");

$stmt->execute();

$stmt->bind_result($id, $firstname, $lastname);

while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $lastname . ', ' . $firstname . '</option>\n';
}
$stmt->close();
?>
            </select>
		</fieldset>          
		<fieldset>  
            <legend>Select Game</legend>
			<select class="form-control" name = "Game">
<?php
$stmt = $mysqli->prepare("SELECT a.id AS GameID, ta.name AS TeamA_Name, tb.name AS TeamB_Name FROM mlb_game AS a
INNER JOIN mlb_team AS ta ON ta.id = a.teama
INNER JOIN mlb_team AS tb ON tb.id = a.teamb ORDER BY GameID ASC");

$stmt->execute();

$stmt->bind_result($gameid, $TeamA_Name, $TeamB_Name);

while($stmt->fetch()){
	echo '<option value=" '. $gameid . ' "> ' . $gameid . ' ' . $TeamA_Name . ' vs. ' . $TeamB_Name . '</option>\n';
}
$stmt->close();
?>
            </select>
            
        </fieldset>
    
        <fieldset>
            <legend>Player Game Results</legend>
            
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">PA</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Plate Appearances" name = "pa">
                </div>
              </div>
              
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">AB</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="At Bats" name = "ab">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">H</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Hits" name = "hit">
                </div>
              </div>
              
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">R</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Runs" name = "run">
                </div>
              </div>  
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">SB</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Steals" name = "steal">
                </div>
              </div>
 
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">RBI</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Runs Batted In" name = "rbi">
                </div>
              </div>
              
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">HR</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Home Runs" name = "hr">
                </div>
              </div>  
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">BB</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Walks" name = "walk">
                </div>
              </div>
    
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">K</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Strike Outs" name = "so">
                </div>
              </div>
              
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">HBP</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Hit By Pitch" name = hbp>
                </div>
              </div>  
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">SF</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Sacrifice Flies" name = "sac">
                </div>
              </div>

        </fieldset>

        <button type="submit" class="btn btn-primary">Submit Game Results</button>
    
    </form>
	<br>








    <form method = "post" action = "display_game.php">
  		<p><h3>View Game Statistics</h3></p>
        
		<fieldset>  
            <legend>Select Game</legend>
			<select class="form-control" name = "Game">
<?php
$stmt = $mysqli->prepare("SELECT a.id AS GameID, ta.mascot AS TeamA_Name, tb.mascot AS TeamB_Name FROM mlb_game AS a
INNER JOIN mlb_team AS ta ON ta.id = a.teama
INNER JOIN mlb_team AS tb ON tb.id = a.teamb ORDER BY GameID ASC");

$stmt->execute();

$stmt->bind_result($gameid, $TeamA_Name, $TeamB_Name);

while($stmt->fetch()){
	echo '<option value=" '. $gameid . ' "> ' . $gameid . ' ' . $TeamA_Name . ' vs. ' . $TeamB_Name . '</option>\n';
}
$stmt->close();
?>
            </select>

        <br><br><button type="submit" class="btn btn-primary">Display Game Results</button>
 	</form>
    	</fieldset>
	<br /><br />

	




</div>


<br><br>
<div class="col">













    <h3>All Player Stats</h3>
    <br>
    <div class="tblscrl">
        <table class="table">
            <thead class="thead-dark">
        		<caption><b></b></caption>
                <tr>
                    <th>Player</th>
                    <th>Average</th> 
                    <th>R</th>
                    <th>HR</th>
                    <th>RBI</th>
                    <th>SB</th>
                </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, ROUND(mlb_player_game_result.hit/mlb_player_game_result.ab, 3) AS avg, mlb_player_game_result.run AS runs, mlb_player_game_result.hr AS hr, mlb_player_game_result.rbi AS rbi, mlb_player_game_result.steal AS steal FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.lastname ORDER BY runs desc");

$stmt->execute();

$stmt->bind_result($fname, $lname, $average, $runs, $hr, $rbi, $steal);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td>\n" . $average . "\n</td>\n<td>\n" . $runs .  "\n</td>\n<td>\n" . $hr . "\n</td>\n<td>\n" . $rbi . "\n</td>\n<td>\n" . $steal. "\n</td>\n</tr>";
}
$stmt->close();
?>




    </table>
</div>
</div>    
    
    
</div>
</div>
</div>


</body>
</html>
