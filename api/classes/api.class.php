<?php

// QUERY PARAMETERS
// ?date = start date for getting games, default to now
// ?days = number of days to include, use large number to get all
// ?include = null, 'scores', 'standings', 'users' to get just those respective pieces, null defaults to all
// ?compare = flag to include comparison to nearest different gamestate, or last day in game_states created from ?days included
// ?compare_date = use a particular comparison date instead of nearest 

class Api{

	// array of games to get data from
	private $game_states;

	// what data to include in response
	private $include;

	// data to return in response
	private $data;

	function __construct($get){
		$start_date = isset($get['date']) ? $get['date'] : 'now';
		$this->include = isset($get['include']) ? $get['include'] : 'all';
		$days = isset($get['days']) ? $get['days'] : 1;
		$this->game_states = $this->make_games_historically($start_date, $days);
		if(isset($get['compare'])){
			$game_to_compare = null;
			if(isset($get['compare_date'])){
				$game_to_compare = new GameState(new DateTime($get['compare_date']));
			}
			if(isset($get['days'])){
				$game_to_compare = end($this->game_states);
			}
			$difference = new Compare($this->game_states[0], $game_to_compare);
			$this->game_states[0] = $difference->baseline;
		}	
	}

	public function respond(){
		$this->make_data();
		return $this->data;
	}

	private function make_games_historically($start_date, $number_of_days){
		$date = new Date($start_date);
		while($date->is_valid() && $number_of_days > 0){
			$games[] = new GameState($date->selected_day);
			$date->modify('-1 day');
			$number_of_days--;
		}
		return $games;
	}

	private function make_data(){
		foreach($this->game_states as $date => $game){
			$data['date'] = $game->date;
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