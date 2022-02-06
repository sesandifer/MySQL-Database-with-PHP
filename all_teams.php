<div class="row">
<div class="col">
<div class="item">           
            
            
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>AL East</th>

                    </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_team.name, mlb_team.mascot FROM mlb_team INNER JOIN mlb_division ON mlb_team.division = mlb_division.id
WHERE mlb_division.id = 1 ORDER BY name ASC");

$stmt->execute();

$stmt->bind_result($team, $mascot);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $team . " " . $mascot . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>


</div>
</div>

<div class="col">
<div class="item">


            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>AL Central</th>

                    </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_team.name, mlb_team.mascot FROM mlb_team INNER JOIN mlb_division ON mlb_team.division = mlb_division.id
WHERE mlb_division.id = 3 ORDER BY name ASC");

$stmt->execute();

$stmt->bind_result($team, $mascot);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $team . " " . $mascot . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>


</div>
</div>


<div class="col">
<div class="item">


            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>AL West</th>

                    </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_team.name, mlb_team.mascot FROM mlb_team INNER JOIN mlb_division ON mlb_team.division = mlb_division.id
WHERE mlb_division.id = 5 ORDER BY name ASC");

$stmt->execute();

$stmt->bind_result($team, $mascot);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $team . " " . $mascot . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>


</div>
</div>
</div>

<br><br>


<div class="row">
<div class="col">
<div class="item">           
            
            
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>NL East</th>

                    </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_team.name, mlb_team.mascot FROM mlb_team INNER JOIN mlb_division ON mlb_team.division = mlb_division.id
WHERE mlb_division.id = 2 ORDER BY name ASC");

$stmt->execute();

$stmt->bind_result($team, $mascot);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $team . " " . $mascot . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>


</div>
</div>

<div class="col">
<div class="item">


            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>NL Central</th>

                    </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_team.name, mlb_team.mascot FROM mlb_team INNER JOIN mlb_division ON mlb_team.division = mlb_division.id
WHERE mlb_division.id = 4 ORDER BY name ASC");

$stmt->execute();

$stmt->bind_result($team, $mascot);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $team . " " . $mascot . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>


</div>
</div>


<div class="col">
<div class="item">


            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>NL West</th>

                    </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_team.name, mlb_team.mascot FROM mlb_team INNER JOIN mlb_division ON mlb_team.division = mlb_division.id
WHERE mlb_division.id = 6 ORDER BY name ASC");

$stmt->execute();

$stmt->bind_result($team, $mascot);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $team . " " . $mascot . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>


</div>
</div>
</div>

