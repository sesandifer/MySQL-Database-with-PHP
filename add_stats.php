
<?php

require("config.php");
include("header.php");

if(!($stmt = $mysqli->prepare("INSERT INTO mlb_player_game_result(playerid, gameid, pa, ab, hit, run, steal, rbi, hr, walk, so, hbp, sac) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->bind_param("iiiiiiiiiiiii",$_POST['Player'],$_POST['Game'],$_POST['pa'],$_POST['ab'],$_POST['hit'],$_POST['run'],$_POST['steal'],$_POST['rbi'],$_POST['hr'],$_POST['walk'],$_POST['so'],$_POST['hbp'],$_POST['sac']);

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	header("refresh:1; url=game.php");
	echo "<script>alert('Game Stats Added!');</script>";
}

?>
