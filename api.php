<?php
header('Content-type: application/json');
// Classes
include('classes/standings.class.php');
include('classes/user.class.php');
include('classes/gamestate.class.php');
include('classes/date.class.php');
include('classes/api.class.php');

$api = new Api($_GET);

echo json_encode($api->respond(), JSON_PRETTY_PRINT);