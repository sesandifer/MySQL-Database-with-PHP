<?php

    require("config.php");
    include("header.php");


// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('firstname', 'lastname', 'ip', 'w', 'l', 'sv', 'k');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[3];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'ASC' : 'DESC';

// Get the result...
if ($result = $mysqli->query('SELECT mlb_pitcher.firstname, mlb_pitcher.lastname, mlb_pitcher_game_result.ip, mlb_pitcher_game_result.w, mlb_pitcher_game_result.l, mlb_pitcher_game_result.sv, mlb_pitcher_game_result.k FROM mlb_pitcher_game_result INNER JOIN mlb_pitcher ON mlb_pitcher_game_result.pitcherid = mlb_pitcher.id
 ORDER BY ' .  $column . ' ' . $sort_order)) {
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
?>


            <h3><b>Sortable Pitcher List</b></h3>
            <br>
            <div class="tbl">
                <table class="table">
                    <thead class="thead-light">		    

    				<tr>
    					<th><a href="pitcher_sort.php?column=firstname&order=<?php echo $asc_or_desc; ?>">Name<i class="fas fa-sort<?php echo $column == 'firstname' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    					<th><a href="pitcher_sort.php?column=lastname&order=<?php echo $asc_or_desc; ?>"><i class="fas fa-sort<?php echo $column == 'lastname' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    					<th><a href="pitcher_sort.php?column=ip&order=<?php echo $asc_or_desc; ?>">IP<i class="fas fa-sort<?php echo $column == 'ip' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    					<th><a href="pitcher_sort.php?column=w&order=<?php echo $asc_or_desc; ?>">Win<i class="fas fa-sort<?php echo $column == 'w' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    					<th><a href="pitcher_sort.php?column=l&order=<?php echo $asc_or_desc; ?>">Loss<i class="fas fa-sort<?php echo $column == 'l' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    					<th><a href="pitcher_sort.php?column=sv&order=<?php echo $asc_or_desc; ?>">Saves<i class="fas fa-sort<?php echo $column == 'sv' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    					<th><a href="pitcher_sort.php?column=k&order=<?php echo $asc_or_desc; ?>">K<i class="fas fa-sort<?php echo $column == 'k' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    				</tr>
    				<?php while ($row = $result->fetch_assoc()): ?>
    				<tr>
    					<td<?php echo $column == 'firstname' ? $add_class : ''; ?>><?php echo $row['firstname']; ?></td>
    					<td<?php echo $column == 'lastname' ? $add_class : ''; ?>><?php echo $row['lastname']; ?></td>
    					<td align="center"<?php echo $column == 'ip' ? $add_class : ''; ?>><?php echo $row['ip']; ?></td>
    					<td align="center"<?php echo $column == 'w' ? $add_class : ''; ?>><?php echo $row['w']; ?></td>
    					<td align="center"<?php echo $column == 'l' ? $add_class : ''; ?>><?php echo $row['l']; ?></td>
    					<td align="center"<?php echo $column == 'sv' ? $add_class : ''; ?>><?php echo $row['sv']; ?></td>
    					<td align="center"<?php echo $column == 'k' ? $add_class : ''; ?>><?php echo $row['k']; ?></td>
    				</tr>
    				<?php endwhile; ?>
    			</table>
		</body>
	</html>
	<?php
	$result->free();
}
?>