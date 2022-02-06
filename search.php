
<form method = "POST">
    <h2>Search for Players</h2>
    <input type = "text" name = "search" />
    <input type = "submit" name = "submit" value = "Click to Search" />
</form>

            <h3>Matching results:</h3>
            <div class="tbl">
                <table class="table">
                    <thead class="thead-dark">
                    <caption><b></b></caption>
                    <tr>
                        <th colspan="2">Player</th>
                        <th>AVG</th> 
                    </tr>
<?php

    $output = NULL;

    if (isset($_POST['submit'])) {
        $search = $mysqli->real_escape_string($_POST['search']);
        
        //DB qyuery
        $result = $mysqli->query("SELECT * FROM mlb_player_game_result 
        INNER JOIN mlb_player ON mlb_player_game_result.playerid = mlb_player.id 
        INNER JOIN mlb_team ON mlb_player.team = mlb_team.id 
        WHERE mlb_player.lastname LIKE '%$search%'");
    
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                //echo "Name: " . $row["firstname"]. " " . $row["lastname"]. "  Average: " .$row["avg"]."<br>";
                 echo "<tr>\n<td>\n" . $row["firstname"] . "\n</td>\n<td>\n"  . $row["lastname"] . "\n</td>\n<td>\n" . $row["avg"] . "\n</td>\n</tr>";
            }
        } else {
            echo "0 results";
        }
    }


?>

            </div>


