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

            <h2>Position Leaders:</h2>
            <br><br>
            <table class="table">
                <thead class="thead-dark">
                <caption><b>Runs Batted In</b></caption>
                <tr>
                    <th>Position</th>
                    <th colspan="2">Player</th>
                    <th>RBI</th> 
                </tr>

<?php
$stmt = $mysqli->prepare("SELECT pl.firstname, pl.lastname, pos.position, SUM(gr.rbi) AS total
FROM mlb_position AS pos
LEFT JOIN mlb_position_player AS pospl ON pos.id = pospl.posid
LEFT JOIN mlb_player AS pl ON pospl.plid = pl.id
INNER JOIN mlb_player_game_result AS gr ON gr.playerid = pl.id
WHERE pos.id = ?
GROUP BY pl.id
ORDER BY total desc");

if(!($stmt->bind_param("i",$_POST['Position']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->execute();

$stmt->bind_result($firstname, $lastname, $position, $rbi);


while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $position . "\n</td>\n<td>\n"  . $firstname . "\n</td>\n<td>\n" . $lastname . "\n</td>\n<td>\n" . $rbi . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>



</div>

</body>
</html>