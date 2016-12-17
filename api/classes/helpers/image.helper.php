<?php

class ImageHelper{

	private $users;

	function __construct(){
		// file relative to root api directory, where it is called
		$users = json_decode(file_get_contents('data/images.json'), true);
		$this->users = [];
		foreach($users as $user => $images){
			$this->users[$user] = end($images);
		}
	}

	public function get_user_image($username){
		if(array_key_exists($username, $this->users)){
			return '<img src="' . $this->users[$username] . '" />';
		}
	}
}