            <h3><b>All Pitchers</b></h3>
            <br>
            <div class="tblscrl">
                <table class="table table-hover">
                    <thead class="table-primary thead-dark">
 
                    <caption><b></b></caption>
                    <tr>
                        <th>Player</th>
                        <th>IP</th>
                        <th>W</th>
                        <th>L</th>
                        <th>SV</th>
                        <th>K</th>
                        <th>ERA</th>
                        <th>WHIP</th>
                    </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_pitcher.firstname, mlb_pitcher.lastname, mlb_pitcher_game_result.ip, mlb_pitcher_game_result.w, mlb_pitcher_game_result.l, mlb_pitcher_game_result.sv, mlb_pitcher_game_result.k, FORMAT(mlb_pitcher_game_result.era, 2), FORMAT(mlb_pitcher_game_result.whip, 2)
FROM mlb_pitcher_game_result INNER JOIN
mlb_pitcher ON mlb_pitcher_game_result.pitcherid = mlb_pitcher.id
GROUP BY mlb_pitcher.id ORDER BY w desc, era asc");

$stmt->execute();

$stmt->bind_result($fname, $lname, $ip, $w, $l, $sv, $k, $era, $whip);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td>\n" . $ip . "\n</td>\n<td>\n" . $w . "\n</td>\n<td>\n" . $l . "\n</td>\n<td>\n" . $sv . "\n</td>\n<td>\n" . $k . "\n</td>\n<td>\n" . $era . "\n</td>\n<td>\n" . $whip . "\n</td>\n</tr>";
}
$stmt->close();
?>

    	    	</table>
            </div>