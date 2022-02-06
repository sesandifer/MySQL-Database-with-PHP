
            <h3><b>All Batters</b></h3>
            <br>
            <div class="tblscrl">
                <table class="table">
                    <thead class="thead-dark">
                    <caption><b></b></caption>
                    <tr>
                        <th>Player</th>
                        <th>AB</th>
                        <th>H</th>
                        <th>R</th>
                        <th>HR</th>
                        <th>RBI</th>
                        <th>BB</th>
                        <th>SB</th>
                        <th>AVG</th>
                    </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.ab), SUM(mlb_player_game_result.hit), SUM(mlb_player_game_result.run), SUM(mlb_player_game_result.hr), SUM(mlb_player_game_result.rbi), SUM(mlb_player_game_result.walk), SUM(mlb_player_game_result.steal), ROUND(mlb_player_game_result.hit/mlb_player_game_result.ab, 3) AS avg FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.id ORDER BY rbi desc");

$stmt->execute();

$stmt->bind_result($fname, $lname, $ab, $hit, $run, $hr, $rbi, $walk, $steal, $average);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td>\n" . $ab . "\n</td>\n<td>\n" . $hit . "\n</td>\n<td>\n" . $run . "\n</td>\n<td>\n" . $hr . "\n</td>\n<td>\n" . $rbi . "\n</td>\n<td>\n" . $walk . "\n</td>\n<td>\n" . $steal . "\n</td>\n<td>\n" . $average . "\n</td>\n</tr>";
}
$stmt->close();
?>

    	    	</table>
            </div>