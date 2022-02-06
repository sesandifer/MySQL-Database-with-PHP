<?php

    require("config.php");
    include("header.php");
?>    

    
<table class="grid">
    <caption><b><?php echo "Current Page: " . $currentPage; ?></b></caption>
    <tr>
        <th>Title</th>
        <th>Desc</th> 
    </tr>



<?php

    $stmt = $mysqli->prepare("SELECT page_title, page_desc FROM web_pages WHERE page_alias like '%index%'");

    $stmt->execute();

    $stmt->bind_result($ptitle, $pdesc);
    
    while($stmt->fetch()){
        echo "<tr>\n<td>\n" . $ptitle . "\n</td>\n<td>\n" . $pdesc . "\n</td>\n</tr>";
    }
    $stmt->close();                            
?>    

</table><br><br>

            
            <form method="post" action="filter_by_division.php">
                <b>Display 'Home Run' Leaders <u>by Division</u></b>
                <fieldset>
                    <legend>Select Division</legend>
                        <select name="Division">
                            
                        
                            
<?php
if(!($stmt = $mysqli->prepare("SELECT id, league, dname FROM mlb_division ORDER BY league ASC"))){
echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
        
if(!$stmt->execute()){
echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $league, $dname)){
echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
echo '<option value=" '. $id . ' "> ' . $league . ' League '. $dname .'</option>\n';
}
$stmt->close();
?>
                        </select>
                
                <br><br>
                <input type="submit" value="Select" />
                </fieldset>
            </form><br><br>            
            

            <form method="post" action="filter_by_team.php">
                <b>Display 'Batting Average' Leaders <u>by Team</u></b>
                <fieldset>
                    <legend>Select Team</legend>
                        <select name="Team">
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
                
                <br><br>
                <input type="submit" value="Select" />
                </fieldset>
            </form><br><br>   
            

            
            <form method="post" action="filter_by_position.php">
                <b>Display 'Runs Batted In' Leaders <u>by Position</u></b>
                <fieldset>
                    <legend>Select Position</legend>
                        <select name="Position">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, position FROM mlb_position ORDER BY id ASC"))){
echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
        
if(!$stmt->execute()){
echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $position)){
echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
echo '<option value=" '. $id . ' "> ' . $position . '</option>\n';
}
$stmt->close();
?>
                        </select>
                
                <br><br>
                <input type="submit" value="Select" />
                </fieldset>
            </form><br><br>   


            
            <h2>Overall League Leaders:</h2>
            <br><br>
            <table class="grid">
                <caption><b>Batting Average</b></caption>
                <tr>
                    <th colspan="2">Name</th>
                    <th>Average</th> 
                </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.hit)/SUM(mlb_player_game_result.ab) AS avg FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.lastname ORDER BY avg desc LIMIT 4");

$stmt->execute();

$stmt->bind_result($fname, $lname, $average);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $average . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>

            <table class="grid">
                <caption><b>Home Runs</b></caption>
                <tr>
                    <th colspan="2">Name</th>
                    <th>HR</th> 
                </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.hr) AS hrtotal FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.lastname ORDER BY hrtotal desc LIMIT 4");

$stmt->execute();

$stmt->bind_result($fname, $lname, $hr);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $hr . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>
            
            <table class="grid">
                <caption><b>Runs Batted In</b></caption>
                <tr>
                    <th colspan="2">Name</th>
                    <th>RBI</th> 
                </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.rbi) AS rbitotal FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.lastname ORDER BY rbitotal desc LIMIT 4");

$stmt->execute();

$stmt->bind_result($fname, $lname, $rbi);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $rbi . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>

            <table class="grid">
                <caption><b>Stolen Bases</b></caption>
                <tr>
                    <th colspan="2">Name</th>
                    <th>SB</th> 
                </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, SUM(mlb_player_game_result.steal) AS stealtotal FROM mlb_player_game_result INNER JOIN
mlb_player ON mlb_player_game_result.playerid = mlb_player.id
GROUP BY mlb_player.lastname ORDER BY stealtotal desc LIMIT 4");

$stmt->execute();

$stmt->bind_result($fname, $lname, $steal);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $steal . "\n</td>\n</tr>";
}
$stmt->close();
?>

    		</table><br><br>


			</div>

        </div>
	</div>	
  </body>
</html>