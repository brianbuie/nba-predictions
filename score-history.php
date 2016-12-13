<?php
// Classes
include('classes/standings.class.php');
include('classes/user.class.php');
include('classes/gamestate.class.php');
include('classes/date.class.php');

// instantiation
$date = new Date('now');
$history = [];
while($date->is_valid()){
	$game = new GameState($date->selected_day);
	foreach($game->users as $user){
		$scores[$user->name] = $user->score;
	}
	$history[$date->format($date->selected_day, 'Y-m-d')] = $scores;
	$date->modify('-1 day');
}
header('Content-type: application/json');
echo json_encode($history, JSON_PRETTY_PRINT);