
<?php

require("config.php");
include("header.php");

if(!($stmt = $mysqli->prepare("DELETE FROM mlb_team WHERE id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}


$stmt->bind_param("i",$_POST['Team']);

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	header("refresh:1; url=team.php");
	echo "<script>alert('Team Removed!');</script>";
}

?>

