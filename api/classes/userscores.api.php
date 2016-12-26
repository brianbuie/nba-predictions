<?php

// Api called when:
// $_GET['type'] = 'userscores'

class UserScores extends Api{

	function __construct($get){
		parent::__construct($get);
	}

	// make data separated by user
	protected function make_data(){
		foreach($this->game_states as $key => $game){
			foreach($game->users as $user){
				// push user's score to their key in data array
				$data[$user->name][] = [
					'date' => $game->date_string,
					'score' => $user->score
				];
			}
		}
		// reformat data into array for easier graphing
		foreach($data as $username => $scores){
			$reversed_scores = array_reverse($scores);
			foreach($reversed_scores as $key => $score_info){
				$score_info['day'] = $key;
				$reversed_scores[$key] = $score_info;
			}
			$array_data[] = [
				'name' => $username,
				'data' => $reversed_scores
			];
		}
		$this->data = $array_data;
	}
}