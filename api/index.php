<?php
header('Content-type: application/json');
if($_SERVER['HTTP_HOST']=='localhost'){
	header('Access-Control-Allow-Origin: http://localhost:3000');
}
// Core
include('classes/core/customdate.class.php');
include('classes/core/gamestate.class.php');
include('classes/core/standings.class.php');
include('classes/core/user.class.php');

// Api
include('classes/api.class.php');
include('classes/compare.api.php');
include('classes/teamrecords.api.php');
include('classes/userscores.api.php');

if(!isset($_GET['type'])){
	$api = new Api($_GET);
} elseif ($_GET['type'] == 'compare'){
	$api = new Compare($_GET);
} elseif ($_GET['type'] == 'teamrecords'){
	$api = new TeamRecords($_GET);
} elseif ($_GET['type'] == 'userscores'){
	$api = new UserScores($_GET);
}

echo json_encode($api->respond(), JSON_PRETTY_PRINT);