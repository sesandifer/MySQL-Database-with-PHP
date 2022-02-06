<?php
//Turn on error reporting
ini_set('display_errors', 'On');


//Connects to the database
$mysqli = new mysqli("localhost","sandifes-db","g5zipf1eSbkq5YbC","sandifes-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

/*
//Set the current page
$currentPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

//Get page info from web_pages table
function getPageDetailsByName($pageAlias) {

    $mysqli = new mysqli("localhost","sandifes-db","g5zipf1eSbkq5YbC","sandifes-db");
    global $DB;
    $rs = array();

    try {
        $sql = $mysqli->prepare("SELECT * FROM web_pages WHERE page_alias like '%player%'");
        $sql->execute();
        $results = $sql->fetchAll();
        
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }

    if (count($results) > 0) {
       $rs =  $results[0];
    }
    
    return $rs;
    
}
*/

?>

