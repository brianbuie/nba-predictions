<?php

// QUERY PARAMETERS
// ?date = start date for getting games, default to now
// ?days = number of days to include, use large number to get all
// ?include = null, 'scores', 'standings', 'users' to get just those respective pieces, null defaults to all

class Api{

	// array of games to get data from
	private $game_states;

	// what data to include in response
	private $include;

	// data to return in response
	private $data;

	function __construct($get){
		$start_date = isset($get['date']) ? $get['date'] : 'now';
		$days = isset($get['days']) ? $get['days'] : 1;
		$this->make_games_historically($start_date, $days);
		$this->include = isset($get['include']) ? $get['include'] : 'all';
	}

	public function respond(){
		$this->make_data();
		return $this->data;
	}

	private function make_one_game($date_string){
		$date = new Date($date_string);
		$this->game_states[$date->format($date->selected_day, 'Y-m-d')] = new GameState($date->selected_day);
	}

	private function make_games_historically($start_date, $number_of_days){
		$date = new Date($start_date);
		while($date->is_valid() && $number_of_days > 0){
			$this->make_one_game($date->format($date->selected_day, 'Y-m-d'));
			$date->modify('-1 day');
			$number_of_days--;
		}
	}

	private function make_data(){
		foreach($this->game_states as $date => $game){
			$data['date'] = $date;
			if($this->include == 'all' || $this->include == 'standings'){
				$data['standings'] = $game->standings->teams;
			}
			if($this->include == 'all' || $this->include == 'users'){
				$data['users'] = $game->users;
			}
			if($this->include == 'scores'){
				foreach($game->users as $user){
					$data['scores'][$user->name] = $user->score;
				}
			}
			$this->data[] = $data;
		}
	}
}