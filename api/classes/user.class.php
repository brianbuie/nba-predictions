<?php

class User {
	
	public $name;
	public $picks;
	public $img;

	function __construct($name, $picks){
		$this->name = $name;
		foreach($picks as $conference => $teams){
			foreach($teams as $rank => $pick){
				$pick['rank'] = $rank;
				$this->picks[$conference][] = $pick;
			}
		}
		$images = json_decode(file_get_contents('data/images.json'), true);
		if(array_key_exists($this->name, $images)){
			$this->img = end($images[$this->name]);
		}
	}

	public function set_pick_info($team_id, $values_array){
		foreach($this->picks as $conference => $teams){
			foreach($teams as $rank => $team){
				if($team['team'] == $team_id){
					foreach($values_array as $key => $val){
						$this->picks[$conference][$rank][$key] = $val;
					}
				}
			}
		}
	}

	public function set_user_info($key, $val){
		$this->$key = $val;
	}
}