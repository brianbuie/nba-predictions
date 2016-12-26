<?php

// Api called when:
// $_GET['type'] is not specified, this is the default responder

// QUERY PARAMETERS
// ?date = start date for getting games, null default to now
// ?days = number of days to include, use large number to get all, null defaults to 1
// ?include = 'standings', 'users', or scores to get just those respective pieces, null defaults to all


class Api{

	// array of games to make data from
	protected $game_states;

	// what part of the game_states to include in data
	protected $include;

	// data to return in response
	protected $data;

	// fed raw $_GET variable
	function __construct($get){
		// set start date string, default to now if not specified
		$start_date_string = isset($get['date']) ? $get['date'] : 'now';

		// include users, standings, scores, or all if not specified
		// cascades down to specify what to include in teamrecords child class
		$this->include = isset($get['include']) ? $get['include'] : 'all';

		// number of gamestates to create, 1 if not specified
		$days = isset($get['days']) ? $get['days'] : 1;

		// create an array of gamestates, [0] being selected day, additional past gamestates based on ?days
		$this->game_states = $this->make_games_historically($start_date_string, $days);
	}

	public function respond(){
		$this->make_data();
		return $this->data;
	}

	protected function make_games_historically($start_date_string, $number_of_days){
		$custom_date = new CustomDate($start_date_string);
		// while the date is valid and days greater than 0, move back in history 1 day and push the gamestate to the array of game_states
		while($custom_date->is_valid() && $number_of_days > 0){
			$games[] = new GameState($custom_date);
			$custom_date->modify('-1 day');
			$number_of_days--;
		}
		return $games;
	}

	// make data separated by date
	protected function make_data(){
		foreach($this->game_states as $date => $game){
			$data['date'] = $game->date_string;
			// include standings
			if(in_array($this->include, ['all', 'standings'])){
				$data['standings'] = $game->standings->teams;
			}
			// include users
			if(in_array($this->include, ['all', 'users'])){
				$data['users'] = $game->users;
			}
			// scores formatted differently and only included if specified
			if($this->include == 'scores'){
				foreach($game->users as $user){
					$data['scores'][$user->name] = $user->score;
				}
			}
			// push game's data to data object
			$this->data[] = $data;
		}
	}
}