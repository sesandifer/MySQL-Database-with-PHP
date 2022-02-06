
<?php

require("config.php");
include("header.php");

if(!($stmt = $mysqli->prepare("INSERT INTO mlb_team(name, mascot, division) VALUES (?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

$stmt->bind_param("ssi",$_POST['TeamName'],$_POST['TeamMascot'],$_POST['Division']);

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	header("refresh:1; url=team.php");
	echo "<script>alert('Team Added!');</script>";
}

?>


