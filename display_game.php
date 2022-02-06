
<?php
require("config.php");
include("header.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Game Results</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>

<body>
    
<div class="btn">
    <a class="btn btn-primary" href="game.php" role="button">Return</a>
</div>
<div>
    
    <h3>Game Result</h3>
    <br>
    <div class="tbl">
        <table class="table">
            <thead class="thead-dark">
                <caption><b></b></caption>
                <tr>
                    <th>Team</th>
                    <th>Player</th>
                    <th>H</th>
                    <th>R</th>
                    <th>SB</th> 
                    <th>RBI</th>
                    <th>HR</th>  
                    <th>BB</th> 
                    <th>K</th> 
                </tr>

<?php
$stmt = $mysqli->prepare("SELECT tm.name, pl.firstname, pl.lastname, gr.hit, gr.run, gr.steal, gr.rbi, gr.hr, gr.walk, gr.so FROM
mlb_game g INNER JOIN
mlb_player_game_result gr ON gr.gameid = g.id
INNER JOIN
mlb_player pl ON gr.playerid = pl.id
INNER JOIN
mlb_team tm ON pl.team = tm.id
WHERE g.id = ?
ORDER BY tm.name desc");

if(!($stmt->bind_param("i",$_POST['Game']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->execute();

$stmt->bind_result($tmname, $plfirstname, $pllastname, $grhit, $grrun, $grsteal, $grrbi, $grhr, $grwalk, $grso);


while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $tmname . "\n</td>\n<td>\n"  . $plfirstname . " " . $pllastname . "\n</td>\n<td>\n" . $grhit . "\n</td>\n<td>\n" . $grrun . "\n</td>\n<td>\n"  . $grsteal . "\n</td>\n<td>\n"  . $grrbi . "\n</td>\n<td>\n"  . $grhr . "\n</td>\n<td>\n"  . $grwalk . "\n</td>\n<td>\n"  . $grso . "\n</td>\n</tr>";
}
$stmt->close();
?>

			</table><br><br>

</div>


</body>
</html>