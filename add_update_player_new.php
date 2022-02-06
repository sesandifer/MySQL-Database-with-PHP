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

    $stmt = $mysqli->prepare("SELECT page_title, page_desc FROM web_pages WHERE page_alias like '%player_page%'");

    $stmt->execute();

    $stmt->bind_result($ptitle, $pdesc);
    
    while($stmt->fetch()){
        echo "<tr>\n<td>\n" . $ptitle . "\n</td>\n<td>\n" . $pdesc . "\n</td>\n</tr>";
    }
    $stmt->close();                            
?> 

</table>

        <section class="left-content">
            <h2><?php /*echo stripslashes($pageDetails["page_title"]); */ ?></h2>
            <?php /* echo stripslashes($pageDetails["page_desc"]); */ ?>
        </section>


    <form method = "post" action = "add_player.php">
    	<b>Add Players</b>
        <fieldset>
            <legend>Player Name</legend>
            <p>First Name: <input type = "text" name = "FirstName" /></p>
            <p>Last Name: <input type = "text" name = "LastName" /></p>
            <p>Nickname: <input type = "text" name = "NickName" /></p>
        </fieldset>
        
        <fieldset>
            <legend>Player Position(s)</legend>
            <input type="checkbox" name="position[1]" value=1>Catcher(C)<br>
            <input type="checkbox" name="position[2]" value=2>First Base(1B)<br>
            <input type="checkbox" name="position[3]" value=3>Second Base(2B)<br>
            <input type="checkbox" name="position[4]" value=4>Third Base(3B)<br>
            <input type="checkbox" name="position[5]" value=5>Shortstop(SS)<br>
            <input type="checkbox" name="position[6]" value=6>Outfield(OF)<br>
        </fieldset>
        
        <fieldset>
            <legend>Team</legend>
            <select name = "Team">
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
        </fieldset>
        <br>
        <input type="submit" name="add" value="Add Player" />
    
    </form>
    <br><br><br>







    <form method = "post" action = "update_player_position.php">
  		<p><b>Reset Player's Positions</b></p>
		<fieldset>
            <legend>Select Player</legend>
			<select name = "PlayerSel">
<?php
$stmt = $mysqli->prepare("SELECT id, firstname, lastname FROM mlb_player ORDER BY lastname ASC");

$stmt->execute();

$stmt->bind_result($id, $firstname, $lastname);

while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $firstname . ' ' . $lastname . '</option>\n';
}
$stmt->close();
?>
            </select>
		</fieldset>          
		<fieldset>

        <fieldset>
            <legend>Player Position(s).  This Overwrites Any Previous Selection</legend>
            <input type="checkbox" name="positionNew[1]" value=1>Catcher(C)<br>
            <input type="checkbox" name="positionNew[2]" value=2>First Base(1B)<br>
            <input type="checkbox" name="positionNew[3]" value=3>Second Base(2B)<br>
            <input type="checkbox" name="positionNew[4]" value=4>Third Base(3B)<br>
            <input type="checkbox" name="positionNew[5]" value=5>Shortstop(SS)<br>
            <input type="checkbox" name="positionNew[6]" value=6>Outfield(OF)<br>
        </fieldset>
        
        <br>
        <input type="submit" name="add" value="Update Player Positions" />
    
    </form>
    <br><br><br>













    <form method = "post" action = "update_player.php">
  		<p><b>Update Player's Team</b></p>
		<fieldset>
            <legend>Select Player</legend>
			<select name = "PlayerSelect">
<?php
$stmt = $mysqli->prepare("SELECT id, firstname, lastname FROM mlb_player ORDER BY lastname ASC");

$stmt->execute();

$stmt->bind_result($id, $firstname, $lastname);

while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $firstname . ' ' . $lastname . '</option>\n';
}
$stmt->close();
?>
            </select>
		</fieldset>          
		<fieldset>  
            <legend>Select New Team</legend>
            <select name = "NewTeam">
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
        </fieldset>
        <br>

        <input type="submit" name="update" value="Update Player" />
    
    </form>
    <br><br><br>

















	<form method="post" action="filter_player_team.php">
    	<b>Display Players By Team</b>
		<fieldset>
			<legend>Select Team to Show Players</legend>
				<select name="Team">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name, mascot FROM mlb_team ORDER BY name ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $team, $mascot)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $team . ' '. $mascot .'</option>\n';
					}
					$stmt->close();
					?>
				</select>
		</fieldset>
        <br>
		<input type="submit" value="Select" />
	</form><br><br>



    <table class="grid">
    	<caption><b>Complete Player List</b></caption>
        
        <tr>
            <th colspan="2">Name</th>
            <th colspan="2">Team</th>
        </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, mlb_team.name, mlb_team.mascot FROM mlb_player INNER JOIN mlb_team ON mlb_player.team = mlb_team.id ORDER BY lastname ASC");

$stmt->execute();

$stmt->bind_result($fname, $lname, $pteam, $mascot);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $pteam . "\n</td>\n<td>\n" . $mascot . "\n</td>\n</tr>";
}
$stmt->close();
?>

    </table>
</div>
</div>
</div>
</div>


</body>
</html>
