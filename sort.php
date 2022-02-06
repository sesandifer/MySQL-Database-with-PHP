<?php

    require("config.php");
    


// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('lastname','w','sv');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
if ($result = $mysqli->query('SELECT mlb_pitcher.lastname, mlb_pitcher_game_result.w, mlb_pitcher_game_result.sv FROM mlb_pitcher_game_result INNER JOIN mlb_pitcher ON mlb_pitcher_game_result.pitcherid = mlb_pitcher.id
 ORDER BY ' .  $column . ' ' . $sort_order)) {
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>PHP & MySQL Table Sorting by CodeShack</title>
			<meta charset="utf-8">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
			<style>
			html {
				font-family: Tahoma, Geneva, sans-serif;
				padding: 10px;
			}
			table {
				border-collapse: collapse;
				width: 500px;
			}
			th {
				background-color: #54585d;
				border: 1px solid #54585d;
			}
			th:hover {
				background-color: #64686e;
			}
			th a {
				display: block;
				text-decoration:none;
				padding: 10px;
				color: #ffffff;
				font-weight: bold;
				font-size: 13px;
			}
			th a i {
				margin-left: 5px;
				color: rgba(255,255,255,0.4);
			}
			td {
				padding: 10px;
				color: #636363;
				border: 1px solid #dddfe1;
			}
			tr {
				background-color: #ffffff;
			}
			tr .highlight {
				background-color: #f9fafb;
			}
			</style>
		</head>
		<body>
			<table>
				<tr>
					<th><a href="sort.php?column=lastname&order=<?php echo $asc_or_desc; ?>">Name<i class="fas fa-sort<?php echo $column == 'lastname' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="sort.php?column=w&order=<?php echo $asc_or_desc; ?>">Wins<i class="fas fa-sort<?php echo $column == 'w' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="sort.php?column=sv&order=<?php echo $asc_or_desc; ?>">Saves<i class="fas fa-sort<?php echo $column == 'sv' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td<?php echo $column == 'lastname' ? $add_class : ''; ?>><?php echo $row['lastname']; ?></td>
					<td<?php echo $column == 'w' ? $add_class : ''; ?>><?php echo $row['w']; ?></td>
					<td<?php echo $column == 'sv' ? $add_class : ''; ?>><?php echo $row['sv']; ?></td>
				</tr>
				<?php endwhile; ?>
			</table>
		</body>
	</html>
	<?php
	$result->free();
}
?>