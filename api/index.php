<?php
ignore_user_abort(true);
set_time_limit(0);
ob_start();
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

$clean_query = str_replace("&", "__", $_SERVER['QUERY_STRING']);
$cached_request = 'data/responses/' . $clean_query . '.json';
// if cached version exists, deliver it and pretend you're done before actually recomputing state and saving new cache
if(file_exists($cached_request)){
	echo file_get_contents($cached_request);
	header('Connection: close');
	header('Content-Length: '.ob_get_length());
	ob_end_flush();
	ob_flush();
	flush();
}

// recompute response
if(!isset($_GET['type'])){
	$api = new Api($_GET);
} elseif ($_GET['type'] == 'compare'){
	$api = new Compare($_GET);
} elseif ($_GET['type'] == 'teamrecords'){
	$api = new TeamRecords($_GET);
} elseif ($_GET['type'] == 'userscores'){
	$api = new UserScores($_GET);
}

// save new version of response
$response = json_encode($api->respond(), JSON_PRETTY_PRINT);
file_put_contents($cached_request, $response);

// just in case there was no cached response saved and browser is waiting
echo $response;
header('Connection: close');
header('Content-Length: '.ob_get_length());
ob_end_flush();
ob_flush();
flush();