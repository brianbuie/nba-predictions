<?php
// Classes
include('classes/api.class.php');
include('classes/user.class.php');
include('classes/game.class.php');

// instantiation
$users = [];
if(file_exists('data/entries.json')){
	$entries = json_decode(file_get_contents('data/entries.json'), true);
} else {
	$entries = [];
}
foreach($entries as $user => $files){
	$picks = json_decode(file_get_contents('data/' . end($files) . '.json'), true);
	$users[$user] = new User($user, $picks);
}

if(isset($_GET['date'])){
	$date = new DateTime($_GET['date']);
	
} else {
	$date = new DateTime();
}

$today = new Game($date, $users);

// echo '<pre>';
// var_dump($today);

// View
include('views/head.php'); 
include('views/current-standings.php');
foreach( $today->users as $user ){
	include('views/user-table.php');
}
include('views/footer.php');
?>