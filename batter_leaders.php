 
 
            
            <h3><b>Batting League Leaders</b></h3>
            <br>
            
            
<div class="row">
<div class="col">
         
            
            
            <table class="table table-hover">
                <thead class="table-primary thead-dark">
                    <tr>

                        <th scope="col" colspan="2">Batting Average</th> 
                    </tr>
</thead>
<tbody>

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, ROUND(mlb_player_game_result.hit/mlb_player_game_result.ab, 3) AS avg FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.id ORDER BY avg desc LIMIT 12");

$stmt->execute();

$stmt->bind_result($fname, $lname, $average);

while($stmt->fetch()){
 echo "<tr>\n<td scope='row'>\n" . $fname . " " . $lname . "\n</td>\n<td><b>\n" . $average . "\n</b></td>\n</tr>";
}
$stmt->close();
?>

</tbody>
    		</table><br><br>



</div>

<div class="col">




            <table class="table table-hover">
                <thead class="table-primary thead-dark">
                    <tr>
                        <th scope="col" colspan="2">Home Runs</th> 
                    </tr>
                    
</thead>
<tbody>                    

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.hr) AS hrtotal FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.id ORDER BY hrtotal desc LIMIT 12");

$stmt->execute();

$stmt->bind_result($fname, $lname, $hr);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td><b>\n" . $hr . "\n</b></td>\n</tr>";
}
$stmt->close();
?>
</tbody>
    		</table><br><br>


</div>


<div class="col">
   
            
            <table class="table table-hover">
                <thead class="table-primary thead-dark">
                    <tr>
                        <th colspan="2">RBI</th> 
                    </tr>

</thead>
<tbody> 

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.rbi) AS rbitotal FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.id ORDER BY rbitotal desc LIMIT 12");

$stmt->execute();

$stmt->bind_result($fname, $lname, $rbi);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td><b>\n" . $rbi . "\n</b></td>\n</tr>";
}
$stmt->close();
?>

</tbody>
    		</table><br><br>
    		
</div>

<div class="col">

            <table class="table table-hover">
                <thead class="table-primary thead-dark">
                    <tr>
                        <th colspan="2">Stolen Bases</th> 
                    </tr>
</thead>
<tbody> 

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.steal) AS stealtotal FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.id ORDER BY stealtotal desc LIMIT 12");

$stmt->execute();

$stmt->bind_result($fname, $lname, $steal);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td><b>\n" . $steal . "\n</b></td>\n</tr>";
}
$stmt->close();
?>
</tbody>
    		</table><br><br>
</div>
</div>

