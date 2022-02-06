

<?php

    require("config.php");
    
    session_start();
    
?>

<?php
    if(isset($_SESSION["id"])){
        include("header_orig.php");
?>
        <h1>Welcome <?php echo strtoupper($_SESSION["username"]); ?>!</h1>
        



<div class="row">
<div class="col">
            
            <form method="post" action="filter_by_division.php">
                <h4>Division HR Leaders</h4>
                <fieldset>
                    <legend></legend>
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

</div>

<div class="col">            

            <form method="post" action="filter_by_team.php">
                <h4>Team Batting Average</h4>
                <fieldset>
                    <legend></legend>
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
            
</div>

<div class="col">
            
            <form method="post" action="filter_by_position.php">
                <h4>Position RBI Leaders</h4>

                <fieldset>
                    <legend></legend>
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
</div>
</div>



<?php
    }
    else {
        include("header.php");
    }    
?>
    <h4>
    &nbsp; &nbsp;
    LEADERBOARD <button id="btnA" class="btn btn-outline-primary btn-sm"><b>- Batter -</b></button>
    <button id="btnB" class="btn btn-outline-primary btn-sm"><b>- Pitcher -</b></button>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    PLAYER STATS  <button id="btnC" class="btn btn-outline-primary btn-sm"><b>- Batter -</b></button>
    <button id="btnD" class="btn btn-outline-primary btn-sm"><b>- Pitcher -</b></button>
    </h4>
    <br>

<div id="1">
<?php
    
	include("batter_leaders.php");
?> 
</div>

<div id="2" style="display:none;">
<?php
	include("pitcher_leaders.php");
?> 
</div>

<div id="3" style="display:none;">
<?php
	include("all_stats.php");
?> 
</div>

<div id="4" style="display:none;">
<?php
	include("pitcher_stats.php");
?> 
</div>
 
 
 
 
</div>
</div>
            

  </body>
</html>