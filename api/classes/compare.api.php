<?php

// Api called when:
// $_GET['type'] = 'compare'

// UNIQUE PARAMETERS
// ?compare_date = use a specific comparison date

class Compare extends Api{

	// baseline gamestate, differences will be injected into this
	private $baseline_state;

	// gamestate to compare baseline to
	private $compare_state;

	function __construct($get){
		parent::__construct($get);
		$this->baseline_state = $this->game_states[0];
		$compare_state = null;
		if(isset($get['compare-date'])){
			$compare_state = new GameState(new CustomDate($get['compare-date']));
		}
		if(isset($get['days'])){
			$compare_state = end($this->game_states);
		}
		// if no compare gamestate given, create date object -1 day from baseline->date_string
		if(!$compare_state){
			$custom_compare_date = new CustomDate($this->baseline_state->date_string);
			$custom_compare_date->modify('-1 day');
			// if compare date isn't valid, exit and don't perform comparisons
			// prevents comparison on season opener (day before season opener is last year's standings)
			if(!$custom_compare_date->is_valid()){ return; }
		}
		// $compare_state is $compare_state gamestate given or new gamestate from custom_compare_date
		$compare_state = $compare_state ? $compare_state : new GameState($custom_compare_date);
		// compare everything
		$this->set_differences($compare_state);
		// if baseline is not different from compare, modify date -1 more day and try again
		// this is necessary because if today's nba games haven't been played, there is no difference between today and yesterday
		while(!$this->is_different() && $custom_compare_date->is_valid()){
			$custom_compare_date->modify('-1 day');
			if(!$custom_compare_date->is_valid()){ return; }
			$this->set_differences(new GameState($custom_compare_date));
		}
		// set game_state to array with one value of baseline_state
		// allows for parent method of making data to be valid (custom includes)
		$this->game_states = [$this->baseline_state];
	}

	private function set_differences($compare_state){
		// set this compare gamestate and then find difference between standings and users
		$this->compare_state = $compare_state;
		$this->set_team_difference();
		$this->set_user_difference();
	}

	private function set_team_difference(){
		foreach($this->baseline_state->standings->teams as $key => $team){
			// compare various stats, put new array of differences in actual baseline gamestate
			$this->baseline_state->standings->teams[$key]['difference'] = [
				'date' => $this->compare_state->date_string,
				'G' => $this->team_stat_difference($team['TEAM_ID'], 'G'),
				'W' => $this->team_stat_difference($team['TEAM_ID'], 'W'),
				'L' => $this->team_stat_difference($team['TEAM_ID'], 'L'),
				'W_PCT' => $this->team_stat_difference($team['TEAM_ID'], 'W_PCT'),
				'RANK' => $this->team_stat_difference($team['TEAM_ID'], 'RANK')
			];
		}
	}

	private function set_user_difference(){
		foreach($this->baseline_state->users as $key => $user){
			// compare scores and put differences in baseline_state user object
			$this->baseline_state->users[$key]->difference = [
				'date' => $this->compare_state->date_string,
				'score' => $this->user_stat_difference($user->name, 'score')
			];
			foreach($user->picks as $pick_key => $team){
				// put pick difference in actual baseline_state user's picks
				$this->baseline_state->users[$key]->picks[$pick_key]['difference'] = $this->user_pick_difference($user->name, $team['team_id']);
			}
		}
	}

	private function user_stat_difference($username, $stat){
		// difference between same stat for same user in both gamestates
		$baseline_state_stat = $this->get_user_stat($username, $this->baseline_state, $stat); 
		$compare_state_stat = $this->get_user_stat($username, $this->compare_state, $stat); 
		return $baseline_state_stat - $compare_state_stat; 
	}

	private function get_user_stat($username, $gamestate, $stat){
		// return stat for given user in given gamestate
		foreach($gamestate->users as $user){ 
			if($user->name == $username){ 
				return $user->$stat; 
			} 
		} 
	}

	// get difference for team with given team_id picked by user with given username
	private function user_pick_difference($username, $team_id){
		// get the pick in baseline_state and the compare_state
		$baseline_state_pick = $this->get_user_pick($username, $this->baseline_state, $team_id);
		$compare_state_pick = $this->get_user_pick($username, $this->compare_state, $team_id);
		// difference array mimics score array in structure
		$difference = [
			'date' => $this->compare_state->date_string,
			'placement' => [
				'correct' => $baseline_state_pick["score"]["placement"]["correct"] - $compare_state_pick["score"]["placement"]["correct"],
				'score' => $baseline_state_pick["score"]["placement"]["score"] - $compare_state_pick["score"]["placement"]["score"]
			],
			'w_pct' => [
				'correct' => $baseline_state_pick["score"]["w_pct"]["correct"] - $compare_state_pick["score"]["w_pct"]["correct"],
				'score' => $baseline_state_pick["score"]["w_pct"]["score"] - $compare_state_pick["score"]["w_pct"]["score"]
			],
			'total' => $baseline_state_pick["score"]["total"]- $compare_state_pick["score"]["total"]
		];
		return $difference;
	}

	private function get_user_pick($username, $gamestate, $team_id){
		// return full pick details for given team_id in given user's picks in given gamestate
		$picks = $this->get_user_stat($username, $gamestate, 'picks');
		foreach($picks as $key => $team){
			if($team['team_id'] == $team_id){
				return $team;
			}
		}
	}

	private function team_stat_difference($team_id, $stat){
		// difference between same stat in both gamestates
		$baseline_state_stat = $this->get_team_stat($team_id, $this->baseline_state, $stat); 
		$compare_state_stat = $this->get_team_stat($team_id, $this->compare_state, $stat); 
		return $baseline_state_stat - $compare_state_stat; 
	}

	private function get_team_stat($team_id, $gamestate, $stat){
		// return stat for team in given gamestate
		foreach($gamestate->standings->teams as $team){
			if($team['TEAM_ID'] == $team_id){ 
				return $team[$stat]; 
			}
		}
	}

	private function is_different(){
		// add up the difference in all games played for each team
		// returns falsey (0) if every team has played the same amount of games in $baseline_state and $compare_state
		$total_different_games = 0;
		foreach($this->baseline_state->standings->teams as $team){
			$total_different_games += $team['difference']['G'];
		}
		return $total_different_games;
	}
}