<?php

$entries = json_decode(file_get_contents('data/images.json'), true);

if(isset($_POST['name'])){
	$name = strtolower($_POST['name']);
	$image = $_POST['image'];
	$password = hash('sha256', $_POST['password']);
	if($password == "b39b76d1936fcb6674461b01834b7da43d5edb6a3b8a7be229827cba2cc9ce68"){
		if(array_key_exists($name, $entries)){
			$entries[$name][] = $image;
		} else {
			$entries[$name] = [];
			$entries[$name][] = $image;
		}
		file_put_contents('data/images.json', json_encode($entries, JSON_PRETTY_PRINT));
	}
	header('Location: /');
} else {
	echo '<pre>';
	var_dump($entries);
}