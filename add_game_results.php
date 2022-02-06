<?php

    require("config.php");
    
    session_start();
    
?>

<?php
    if(isset($_SESSION["id"])){
        include("header_orig.php");
?>

<?php
    }
    else {
        include("header.php");
    }    
?>
    

    <form method = "post" action = "add_game.php">
  		<p><b>Create A New Game Between Two Teams</b></p>
		<fieldset>
            <legend>Select Visiting Team</legend>
			<select name = "TeamA">
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
			<select name = "TeamB">
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


		</fieldset>
        
        <p><input type = "submit" value="Create Game" /></p>
        
    </form>
    <br>        
        
        
        
        
        
        
        
        
        
        
    <form method = "post" action = "add_stats.php">
  		<p><b>Enter Player Game Results</b></p>
		<fieldset>
            <legend>Select Player</legend>
			<select name = "Player">
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
			<select name = "Game">
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
            <p>Plate Appearances: <input type = "text" name = "pa" /></p>
            <p>At Bats(AB): <input type = "text" name = "ab" /></p>
            <p>Hits: <input type = "text" name = "hit" /></p>
            <p>Runs: <input type = "text" name = "run" /></p>
            <p>Steals: <input type = "text" name = "steal" /></p>
            <p>Runs Batted In(RBI): <input type = "text" name = "rbi" /></p>
            <p>Home Runs(HR): <input type = "text" name = "hr" /></p>
            <p>Walks: <input type = "text" name = "walk" /></p>
            <p>Strike Outs(K): <input type = "text" name = "so" /></p>
            <p>Hit By Pitch: <input type = "text" name = "hbp" /></p>
            <p>Sacrifice Flies: <input type = "text" name = "sac" /></p>
        </fieldset>

        <p><input type = "submit" value="Submit Game Results" /></p>
    
    </form>
	<br>








    <form method = "post" action = "display_game.php">
  		<p><b>View Game Statistics</b></p>
        
		<fieldset>  
            <legend>Select Game</legend>
			<select name = "Game">
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

        <p><input type = "submit" value="Display Game Results" /></p>
 	</form>
    	</fieldset>
	<br /><br />

	





















    <table class="grid">
		<caption><b>All Player Stats</b></caption>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Average</th> 
            <th>Runs</th>
            <th>RBI</th>
        </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.hit)/SUM(mlb_player_game_result.ab) AS avg, SUM(mlb_player_game_result.run) AS runs, SUM(mlb_player_game_result.rbi) AS rbi FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.lastname ORDER BY avg desc");

$stmt->execute();

$stmt->bind_result($fname, $lname, $average, $runs, $rbi);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $average . "\n</td>\n<td>\n" . $runs . "\n</td>\n<td>\n" . $rbi. "\n</td>\n</tr>";
}
$stmt->close();
?>




    </table>
</div>
</div>
</div>


</body>
</html>
