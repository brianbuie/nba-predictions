<?php
// Classes
include('classes/api.class.php');
include('classes/user.class.php');
include('classes/game.class.php');
include('classes/difference.class.php');

// instantiation


if(isset($_GET['date'])){
	$date = new DateTime($_GET['date']);
} else {
	$date = new DateTime();
}
$day_before = new DateTime($date->format('Y-m-d'));
$day_before->modify('-2 days');
$game = new Difference($date, $day_before);

$today = $game->get_current_game();

// echo '<pre>';
// var_dump($game->current->current);
// var_dump($game->compare->current);

// View helpers
include('views/helpers/display_difference.php');
// Views
include('views/head.php');
include('views/scoreboard.php');
include('views/current-standings.php');
foreach( $today->users as $user ){
	include('views/user-table.php');
}
include('views/footer.php');
?>