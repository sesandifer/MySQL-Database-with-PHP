
<?php

require("config.php");
include("header.php");

if(!($stmt = $mysqli->prepare("UPDATE mlb_player SET team = ? WHERE id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->bind_param("ii",$_POST['NewTeam'],$_POST['PlayerSelect']);

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	header("refresh:1; url=player.php");
	echo "<script>alert('Player Team Updated!');</script>";
}

?>
