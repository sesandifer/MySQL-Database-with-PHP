 
 
            
            <h3><b>Pitching League Leaders</b></h3>
            <br>
            
            
<div class="row">
<div class="col">
         
            
            
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>

                        <th colspan="2">Wins</th> 
                    </tr>
</thead>
<tbody>

<?php
$stmt = $mysqli->prepare("SELECT mlb_pitcher.firstname, mlb_pitcher.lastname, mlb_pitcher_game_result.w FROM mlb_pitcher_game_result INNER JOIN
mlb_pitcher ON mlb_pitcher_game_result.pitcherid = mlb_pitcher.id
GROUP BY mlb_pitcher.id ORDER BY w desc LIMIT 12");

$stmt->execute();

$stmt->bind_result($fname, $lname, $win);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td><b>\n" . $win . "\n</b></td>\n</tr>";
}
$stmt->close();
?>
</tbody>
    		</table><br><br>
</div>

<div class="col">

            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="2">Saves</th> 
                    </tr>
</thead>
<tbody>
    
<?php
$stmt = $mysqli->prepare("SELECT mlb_pitcher.firstname, mlb_pitcher.lastname, mlb_pitcher_game_result.sv FROM mlb_pitcher_game_result INNER JOIN
mlb_pitcher ON mlb_pitcher_game_result.pitcherid = mlb_pitcher.id
GROUP BY mlb_pitcher.id ORDER BY sv desc LIMIT 12");

$stmt->execute();

$stmt->bind_result($fname, $lname, $sv);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td><b>\n" . $sv . "\n</b></td>\n</tr>";
}
$stmt->close();
?>
</tbody>
    		</table><br><br>


</div>


<div class="col">
   
            
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="2">ERA</th> 
                    </tr>
</thead>
<tbody>
    
<?php
$stmt = $mysqli->prepare("SELECT mlb_pitcher.firstname, mlb_pitcher.lastname, FORMAT(mlb_pitcher_game_result.era, 2) FROM mlb_pitcher_game_result INNER JOIN
mlb_pitcher ON mlb_pitcher_game_result.pitcherid = mlb_pitcher.id
GROUP BY mlb_pitcher.id ORDER BY era asc LIMIT 12");

$stmt->execute();

$stmt->bind_result($fname, $lname, $era);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td><b>\n" . $era . "\n</b></td>\n</tr>";
}
$stmt->close();
?>

</tbody>
    		</table><br><br>
    		
</div>

<div class="col">

            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="2">WHIP</th> 
                    </tr>
</thead>
<tbody>
    
<?php
$stmt = $mysqli->prepare("SELECT mlb_pitcher.firstname, mlb_pitcher.lastname, FORMAT(mlb_pitcher_game_result.whip, 2) FROM mlb_pitcher_game_result INNER JOIN
mlb_pitcher ON mlb_pitcher_game_result.pitcherid = mlb_pitcher.id
GROUP BY mlb_pitcher.id ORDER BY whip asc LIMIT 12");

$stmt->execute();

$stmt->bind_result($fname, $lname, $whip);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td><b>\n" . $whip . "\n</b></td>\n</tr>";
}
$stmt->close();
?>
</tbody>
    		</table><br><br>
</div>
</div>

 
