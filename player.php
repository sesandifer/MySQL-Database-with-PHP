<?php
    require("config.php");
    session_start();

    if(isset($_SESSION["id"])){
        include("header_orig.php");
    }
    else {
        include("header.php");
    }    
    
?>

<table class="grid">
    <tr>
        <th>Title</th>
        <th>Description</th> 
    </tr>

<?php

    $stmt = $mysqli->prepare("SELECT page_title, page_desc FROM web_pages WHERE page_alias like '%player%'");

    $stmt->execute();

    $stmt->bind_result($ptitle, $pdesc);
    
    while($stmt->fetch()){
        echo "<tr>\n<td>\n" . $ptitle . "\n</td>\n<td>\n" . $pdesc . "\n</td>\n</tr>";
    }
    $stmt->close();                            
?>



</table>



<br>
<div class="row">
<div class="col">

    <form method = "post" action = "add_player.php">
        <h3>Add Players</h3>
        <fieldset>
            <b>Player Name</b>

            <div class="form-row">
                <div class="col">
                  <input type="text" class="form-control" name = "FirstName" placeholder="First Name">
                </div>
                <div class="col">
                  <input type="text" class="form-control" name = "LastName" placeholder="Last Name">
                </div>
                <div class="col">
                  <input type="text" class="form-control" name = "NickName" placeholder="Nickname"">
                </div>
          </div>   
          
        </fieldset>
        <br>
        <b>Player Position(s)</b>
        <div class="form-check">
        
            <fieldset>
                <legend></legend>
                <input class="form-check-input" type="checkbox" name="position[1]" value=1>Catcher(C)<br>
                <input class="form-check-input" type="checkbox" name="position[2]" value=2>First Base(1B)<br>
                <input class="form-check-input" type="checkbox" name="position[3]" value=3>Second Base(2B)<br>
                <input class="form-check-input" type="checkbox" name="position[4]" value=4>Third Base(3B)<br>
                <input class="form-check-input" type="checkbox" name="position[5]" value=5>Shortstop(SS)<br>
                <input class="form-check-input" type="checkbox" name="position[6]" value=6>Outfield(OF)<br>
            </fieldset>
        </div>
        
        <fieldset>
            <br>
            <b>Add Player to Team</b>
            <br>
            <select class="form-control" name = "Team">

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
        <button type="submit" class="btn btn-primary">Add Player</button>
    
    </form>
    <br><br>

    <form method = "post" action = "update_player_position.php">
  		<h3>Reset Player's Positions</h3>
		<fieldset>
		    <b>Select Player</b>
		    <br>
            <select class="form-control" name = "PlayerSel">

<?php
$stmt = $mysqli->prepare("SELECT id, firstname, lastname FROM mlb_player ORDER BY lastname ASC");

$stmt->execute();

$stmt->bind_result($id, $firstname, $lastname);

while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $lastname . ', ' . $firstname . '</option>\n';
}
$stmt->close();
?>
            </select>
		</fieldset>
		<br>
        <b>Position(s)  **Overwrites Any Previous Selection</b>
        <div class="form-check">
            <fieldset>
                <legend></legend>
                
                <input class="form-check-input" type="checkbox" name="positionNew[1]" value=1>Catcher(C)<br>
                <input class="form-check-input" type="checkbox" name="positionNew[2]" value=2>First Base(1B)<br>
                <input class="form-check-input" type="checkbox" name="positionNew[3]" value=3>Second Base(2B)<br>
                <input class="form-check-input" type="checkbox" name="positionNew[4]" value=4>Third Base(3B)<br>
                <input class="form-check-input" type="checkbox" name="positionNew[5]" value=5>Shortstop(SS)<br>
                <input class="form-check-input" type="checkbox" name="positionNew[6]" value=6>Outfield(OF)<br>
            </fieldset>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update Player Positions</button>
    
    </form>
    <br><br>


    <form method = "post" action = "update_player.php">
  		<h3>Update Player's Team</h3>
  		<br>
  		<b>Select Player</b>
		<fieldset>
			<select class="form-control" name = "PlayerSelect">

<?php
$stmt = $mysqli->prepare("SELECT id, firstname, lastname FROM mlb_player ORDER BY lastname ASC");

$stmt->execute();

$stmt->bind_result($id, $firstname, $lastname);

while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $lastname . ', ' . $firstname . '</option>\n';
}
$stmt->close();
?>
            </select>
		</fieldset>
		<br>
		<b>Select New Team</b>
		<br>
		<fieldset>
            <select class="form-control" name = "NewTeam">
            
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

        <button type="submit" class="btn btn-primary">Update Player</button>
    
    </form>
    <br><br>


	<form method="post" action="filter_player_team.php">
    	<h3>Display Players By Team</h3>
		<fieldset>

			<b>Select Team to Show Players</b>
			 <br>

				<select class="form-control" name = "Team">
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
		<button type="submit" class="btn btn-primary">Select</button>
		
	</form><br><br>

</div>


<br><br>
<div class="col">





            <h3>Player List</h3>
            <br>
            <div class="tblscrl">
                <table class="table">
                    <thead class="thead-dark">
    	            <caption><b></b></caption>
        
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Team</th>
                    </tr>

<?php
$stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, mlb_position.position, mlb_team.name, mlb_team.mascot FROM mlb_player INNER JOIN mlb_team ON mlb_player.team = mlb_team.id INNER JOIN mlb_position_player ON mlb_position_player.plid = mlb_player.id INNER JOIN mlb_position ON mlb_position.id = mlb_position_player.posid GROUP BY mlb_player.id ORDER BY mlb_team.name ASC, mlb_player.lastname ASC");

$stmt->execute();

$stmt->bind_result($fname, $lname, $position, $pteam, $mascot);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . " " . $lname . "\n</td>\n<td>\n" . $position ."\n</td>\n<td>\n" . $pteam . " " . $mascot . "\n</td>\n</tr>";
}
$stmt->close();
?>

    </table>

</div>




</div>

</body>
</html>
