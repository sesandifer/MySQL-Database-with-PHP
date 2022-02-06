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

<div class="btn">
    <a class="btn btn-primary" href="index.php" role="button">Return</a>
</div>			
<div>
            <h2>Team Batting Average Leaders:</h2>
            <br><br>
            <table class="table">
                <thead class="thead-dark">
                <caption><b>Batting Average</b></caption>
                <tr>
                    <th colspan="2">Team</th>
                    <th colspan="2">Player</th>
                    <th>AVG</th> 
                </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_team.name, mlb_team.mascot, mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.hit)/SUM(mlb_player_game_result.ab) AS avg FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
INNER JOIN
mlb_team ON mlb_player.team = mlb_team.id

WHERE mlb_team.id = ?
GROUP BY mlb_player.id
ORDER BY avg desc");

if(!($stmt->bind_param("i",$_POST['Team']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->execute();

$stmt->bind_result($name, $mascot, $firstname, $lastname, $avg);


while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n"  . $mascot . "\n</td>\n<td>\n" . $firstname . "\n</td>\n<td>\n" . $lastname . "\n</td>\n<td>\n" . $avg . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>



</div>

</body>
</html>