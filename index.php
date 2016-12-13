<?php
// Classes
include('classes/standings.class.php');
include('classes/user.class.php');
include('classes/gamestate.class.php');
include('classes/compare.class.php');
include('classes/date.class.php');

// Helpers
include('classes/helpers/image.helper.php');
$images = new ImageHelper;

// instantiation
if(isset($_GET['date'])){
	$date = new Date($_GET['date']);
} else {
	$date = new Date('now');
}
if(!$date->is_valid()){
	header('Location: /');
}

$game = new Compare($date->selected_day, $date->compare_day);

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