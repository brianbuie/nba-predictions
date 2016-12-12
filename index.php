<?php
// Classes
include('classes/standings.class.php');
include('classes/user.class.php');
include('classes/gamestate.class.php');
include('classes/compare.class.php');

// instantiation
if(isset($_GET['date'])){
	$date = new DateTime($_GET['date']);
} else {
	$date = new DateTime();
}
$day_before = new DateTime($date->format('Y-m-d'));
$day_before->modify('-2 days');
$game = new Compare($date, $day_before);

// View helpers
include('views/helpers/display_difference.php');
// Views
include('views/head.php');
include('views/scoreboard.php');
include('views/current-standings.php');
foreach( $game->current->users as $user ){
	include('views/user-table.php');
}
include('views/footer.php');
?>