<?php

require("config.php");
include("header.php");

$stmt = $mysqli->prepare("DELETE FROM mlb_position_player WHERE plid = ?");
$stmt->bind_param('i', $_POST['PlayerSel']);

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}

$pos = $_POST['positionNew'];
foreach($pos as $val) {
if(!($stmt = $mysqli->prepare("INSERT INTO mlb_position_player(plid, posid) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->bind_param("ii", $_POST['PlayerSel'], $val);

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	header("refresh:1; url=player.php");
	echo "<script>alert('Player Position Updated!');</script>";
}

}

?>
