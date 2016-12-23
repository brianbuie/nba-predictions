<?php

// QUERY PARAMETERS
// ?date = start date for getting games, default to now
// ?days = number of days to include, use large number to get all
// ?include = null, 'scores', 'standings', 'users' to get just those respective pieces, null defaults to all
// ?compare = flag to include comparison to nearest different gamestate, or last day in game_states created from ?days included
// ?compare_date = use a particular comparison date instead of nearest 

class Api{

	// array of games to make data from
	private $game_states;

	// what part of the game_states to include in data
	private $include;

	// data to return in response
	private $data;

	// fed raw $_GET variable
	function __construct($get){
		// set start date string, default to now if not specified
		$start_date_string = isset($get['date']) ? $get['date'] : 'now';

		// include users, standings, scores, or all if not specified
		$this->include = isset($get['include']) ? $get['include'] : 'all';

		// number of gamestates to create, 1 if not specified
		$days = isset($get['days']) ? $get['days'] : 1;

		// create an array of gamestates, [0] being selected day, additional past gamestates based on ?days
		$this->game_states = $this->make_games_historically($start_date_string, $days);

		// if the compare flag is set, then compare data is injected in to game_states[0]
		if(isset($get['compare'])){

			// default to no campare game_state (will compare nearest difference, usually -1 or -2 days depending on today's nba games)
			$compare_state = null;

			// create gamestate from compare date if specified
			if(isset($get['compare_date'])){
				$compare_state = new GameState(new CustomDate($get['compare_date']));
			}

			// if days is specified, then use last gamestate in array as $compare
			if(isset($get['days'])){
				$compare_state = end($this->game_states);
			}

			// calculates difference between $baseline and $compare then injects difference stats into $baseline
			$difference = new Compare($this->game_states[0], $compare_state);
			
			// get the modified $baseline gamestate and set it as first gamestate in response
			$this->game_states[0] = $difference->baseline_state;
		}	
	}

	public function respond(){
		// itterate over game_states and create data object of included data
		$this->make_data();
		// return to index.php to do with it what it will (echo JSON)
		return $this->data;
	}

	private function make_games_historically($start_date_string, $number_of_days){
		$custom_date = new CustomDate($start_date_string);
		// while the date is valid and days greater than 0, move back in history 1 day and push the gamestate to the array of game_states
		while($custom_date->is_valid() && $number_of_days > 0){
			$games[] = new GameState($custom_date);
			$custom_date->modify('-1 day');
			$number_of_days--;
		}
		return $games;
	}

	private function make_data(){
		foreach($this->game_states as $date => $game){
			$data['date'] = $game->date_string;
			// include standings
			if($this->include == 'all' || $this->include == 'standings'){
				$data['standings'] = $game->standings->teams;
			}
			// include users
			if($this->include == 'all' || $this->include == 'users'){
				$data['users'] = $game->users;
			}
			// ONLY include scores (does not include comparison)
			if($this->include == 'scores'){
				foreach($game->users as $user){
					$data['scores'][$user->name] = $user->score;
				}
			}
			$this->data[] = $data;
		}
	}
}