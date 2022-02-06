<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","sandifes-db","g5zipf1eSbkq5YbC","sandifes-db");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>

    <link rel="stylesheet" href="css/style.css" />
    <title>Filter: Display Players By Team</title>
  </head>
  
<body>
<div>
	<table>
		<tr>
			<td><b>Team Players</b></td>
		</tr>
		<tr>
			<td><h4>Team</h4></td>
			<td><h4>First Name</h4></td>
			<td><h4>Last Name</h4></td>
            <td><h4>Nickname</h4></td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT mlb_player.firstname, mlb_player.lastname, mlb_player.nickname, mlb_team.name FROM mlb_player INNER JOIN mlb_team ON mlb_player.team = mlb_team.id WHERE mlb_team.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['Team']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($firstname, $lastname, $nickname, $team)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $team . "\n</td>\n<td>\n" . $firstname . "\n</td>\n<td>\n" . $lastname . "\n</td>\n<td>\n" . $nickname . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

</body>
</html>