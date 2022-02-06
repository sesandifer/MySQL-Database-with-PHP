# MySQL-Database-with-PHP
Project: Major League Baseball Database

Outline

My database is a representation of the world of major league baseball with an emphasis on player statistics. Player statistics are recorded for each game that is played. Two teams play a game, which results in a list of offensive statistics for each player that participates, based on each player’s performance in different categories. Players are organized into teams and teams into divisions. Players are also categorized by their position. Player statistics that are of interest can be displayed and referred back to as needed. The player data can be organized by team, division, position, and game, and  is a valuable reference tool.


Database Outline

The database has six main entities: players, positions, teams, divisions, games, and game statistics. The six relationships include the following: each team has multiple players, each player has one or more positions, each player has player game results, each game has two teams, each game has multiple player game results, and each division has teams.
The game results table, mlb_player_game_result, contains the actual data for each player and has keys for player id and a game id.  For every entry in the table, there is a
 
player id and game id associated with those tables.  Game statistics are entered from a
form where the user must choose a game and a player. The statistics are entered for the selected player for that specific game. Thus the mlb_player_game_result table will have several rows for each player id and several rows for each game id. It is auto- incrementing and has attributes including plate appearances, at bats, hits, runs, steals, runs batted in, home runs, walks, strike outs, hit by pitch, and sacrifice flies.  The game id points to the mlb_game table, which keeps track of the two teams that participated in the game. The player id points to the id of the specific player in mlb_player table.
The mlb_player table contains the player’s identification: id (auto-incrementing), name, and a key for team id that references the mlb_team table, and the mlb_game table has keys for the two team’s ids- from mlb_team- that participated in the game.  The mlb_team table contains the team information and a key for the mlb_division id. The mlb_division table contains attributes pertaining to the details about the division and leagues.
There is also a table called mlb_position_player which is a many-to-many relationship between mlb_player and mlb_position. A player can play more than one position and a position has more than one player. The mlb_position_player table creates this relationship using constraints for player id and position id to allow for multiples of both. Each table provides additional levels of sorting options for displaying each aspect of the league and the data stored within.
 
ER Diagram: Attached

Schema: Attached

 
