
<?php

require("config.php");
include("header.php");

	
if(!($stmt = $mysqli->prepare("INSERT INTO mlb_player(firstname, lastname, nickname, team) VALUES (?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->bind_param("sssi",$_POST['FirstName'],$_POST['LastName'],$_POST['NickName'],$_POST['Team']);

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}

$last = mysqli_insert_id($mysqli);

$pos = $_POST['position'];
foreach($pos as $val) {
if(!($stmt = $mysqli->prepare("INSERT INTO mlb_position_player(plid, posid) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->bind_param("ii", $last, $val);


if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	header("refresh:1; url=player.php");
	echo "<script>alert('Player Added!');</script>";
	
}

}

?>
