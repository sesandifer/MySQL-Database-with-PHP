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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>

    <link rel="stylesheet" href="css/style.css" />
    <title>Filter: Display Players By Team</title>
  </head>
  
<body>

<div class="btn">
    <a class="btn btn-primary" href="player.php" role="button">Return</a>
</div>

<div>

	<h3>Team Players</h3>
	<br>
    <div class="tbl">
        <table class="table">
            <thead class="thead-dark">
			<caption><b</b></caption>
        		<tr>
        			<td><h4>Name</h4></td>
        		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, mlb_team.name FROM mlb_player INNER JOIN mlb_team ON mlb_player.team = mlb_team.id WHERE mlb_team.id = ?
ORDER BY mlb_player.lastname asc"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['Team']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($firstname, $lastname, $team)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

$stmt->fetch();
echo "<h3>\n" . $team . "\n</h3>";

while($stmt->fetch()){
    echo "<tr>\n<td>\n" . $firstname . " " . $lastname . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>


</body>
</html>