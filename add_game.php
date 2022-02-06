<?php

require("config.php");

if(!($stmt = $mysqli->prepare("INSERT INTO mlb_game(teama, teamb) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->bind_param("ii",$_POST['TeamA'],$_POST['TeamB']);

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	header("refresh:1; url=game.php");
	echo "<script>alert('Game Added!');</script>";
}

?>
