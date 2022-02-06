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

            <h2>Division Home Run Leaders:</h2>
            <br><br>
            <table class="table">
                <thead class="thead-dark">
                <caption><b>Home Runs</b></caption>
                <tr>
                    <th>League</th>
                    <th>Division</th>
                    <th colspan="2">Player</th>
                    <th>Home Runs</th> 
                </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_division.league, mlb_division.dname, mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.hr) AS total FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
INNER JOIN
mlb_team ON mlb_player.team = mlb_team.id
INNER JOIN
mlb_division ON mlb_team.division = mlb_division.id
WHERE mlb_division.id = ?
GROUP BY mlb_player.id
ORDER BY total desc");

if(!($stmt->bind_param("i",$_POST['Division']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->execute();

$stmt->bind_result($league, $dname, $firstname, $lastname, $hr);


while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $league . "\n</td>\n<td>\n"  . $dname . "\n</td>\n<td>\n" . $firstname . "\n</td>\n<td>\n" . $lastname . "\n</td>\n<td>\n" . $hr . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>



</div>

</body>
</html>