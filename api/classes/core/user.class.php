<?php

class User {
	
	// string name of user
	public $name;
	// array of their picks
	public $picks;
	// url for profile picture (if given)
	public $img;

	// given user's name and an array of their picks
	function __construct($name, $picks){
		$this->name = $name;
		// a little bit of cleanup, 
		// user picks were stored as rank keyed objects by conference, so they are flattened out into one big array with rank inserted
		foreach($picks as $conference => $teams){
			foreach($teams as $rank => $pick){
				$pick['rank'] = $rank;
				$this->picks[] = $pick;
			}
		}
		// get all user images and add this user's image url if they have chosen one
		$images = json_decode(file_get_contents('data/images.json'), true);
		if(array_key_exists($this->name, $images)){
			$this->img = end($images[$this->name]);
		}
	}

	// public interface for setting team info on user's pick based on team_id
	// this is where scores and team actual are injected by GameState and Compare
	public function set_pick_info($team_id, $values_array){
		foreach($this->picks as $team_key => $team){
			if($team['team_id'] == $team_id){
				foreach($values_array as $value_key => $value){
					$this->picks[$team_key][$value_key] = $value;
				}
			}
		}
	}

	// public interface for setting general user_info (total score)
	public function set_user_info($key, $val){
		$this->$key = $val;
	}
}