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

    $stmt = $mysqli->prepare("SELECT page_title, page_desc FROM web_pages WHERE page_alias like '%team%'");

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

    <form method = "post" action = "add_team.php">
    	<h3>Add a Team</h3>
        <fieldset>

            
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" name = "TeamName" placeholder="Team Name">
            </div>
            <div class="col">
              <input type="text" class="form-control" name = "TeamMascot" placeholder="Mascot">
            </div>
          </div>            

        </fieldset>

        <fieldset>

            Division <select class="form-control" name = "Division">
<?php
$stmt = $mysqli->prepare("SELECT id, league, dname FROM mlb_division ORDER BY league ASC, dname ASC");

$stmt->execute();

$stmt->bind_result($id, $league, $dname);

while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $league .' '. $dname .'</option>\n';
}
$stmt->close();
?>
            </select>
        </fieldset>

        <button type="submit" class="btn btn-primary">Add Team</button>
    
    </form>
</div>

<div class="col">

	<form method="post" action="delete_team.php">
		<h3>Delete a Team</h3>
        <fieldset>
			<legend>Select Team to Delete</legend>
				<select class="form-control" name="Team">
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
        <button type="submit" class="btn btn-primary">Delete</button>
	</form>
	
</div>
</div>
<br><br>
<?php
	include("all_teams.php");
?>

</body>
</html>
