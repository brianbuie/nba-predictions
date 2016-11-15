<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

// header("Content-Type: 'application/json'");
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Headers: Content-Type");


if($_POST){

	$name = strtolower($_POST['name']);

	$filename = $name . time();
	$directory = 'data/';

	$picks = [];
	$picks['west'] = [];
	$picks['east'] = [];
	$i = 1;
	while($i < 9){
		foreach($picks as $division => $val){
			$picks[$division][$i] = [];
			$picks[$division][$i]['team'] = $_POST[$division . $i];
			$picks[$division][$i]['wins'] = $_POST[$division . $i . '-wins'];
		}
		$i++;
	}

	file_put_contents($directory . $filename . '.txt', serialize($picks));

	if(file_exists($directory . 'entries.txt')){
		$entries = unserialize(file_get_contents($directory . 'entries.txt'));
	} else {
		$entries = [];
	}

	if(array_key_exists($name, $entries)){
		$entries[$name][] = $filename;
	} else {
		$entries[$name] = [];
		$entries[$name][] = $filename;
	}

	file_put_contents($directory . 'entries.txt', serialize($entries));

	$picks = [];
	foreach($entries as $user => $files){
		$picks[$user] = unserialize(file_get_contents($directory . end($files) . '.txt'));
	}

	header('Location: index.php');

} else {
	$directory = 'data/';

	if(file_exists($directory . 'entries.txt')){
		$entries = unserialize(file_get_contents($directory . 'entries.txt'));
	} else {
		$entries = [];
	}
	$picks = [];
	foreach($entries as $user => $files){
		$picks[$user] = unserialize(file_get_contents($directory . end($files) . '.txt'));
	}

	echo '<pre>';
	var_dump($entries);
	var_dump($picks);
}
?>