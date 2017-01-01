<?php

// Api called when:
// $_GET['type'] = 'teamrecords'

// UNIQUE PARAMETERS


class TeamRecords extends Api{

	function __construct($get){
		parent::__construct($get);
	}

	// make data separated by team
	protected function make_data(){
		$data = [];
		foreach($this->game_states as $key => $game){
			foreach($game->standings->teams as $team){
				// check if specified 'include' is either the team's conference or abbreviation, or if it's set to 'all'
				if( in_array( strtoupper($this->include), [strtoupper($team['CONFERENCE']), $team['ABRV'], 'ALL'])){
					// if team isn't in array yet, create entry
					if(!array_key_exists( $team["ABRV"], $data)){ $data[$team["ABRV"]] = []; }
					// add the entry with key of games played (avoids having to check if different before adding it)
					$data[ $team["ABRV"] ][ $team["G"] ] = [
						'G' => $team["G"],
						'diff' => $team['W'] - $team['L']
					];
				}
			}
		}
		$max_games_played = 0;
		// normalize, sort, and then count to get max games
		foreach($data as $team => $entries){
			// set game 0 (workaround for teams that played game 1 on opening night)
			$data[$team][0] = ['G' => 0, 'diff' => 0];
			// sort team's data by key
			ksort($data[$team]);
			// get last game played for team
			$last_game_played = end($data[$team])['G'];
			// set the max games played as this teams last game if last game is more than what's currently set
			$max_games_played = $last_game_played > $max_games_played ? $last_game_played : $max_games_played;
		}

		// fill array with null diffs if it has less games than league's max
		foreach($data as $team => $entries){
			while( end($data[$team])['G'] < $max_games_played ){
				$next_game = end($data[$team])['G'] + 1;
				$data[$team][] = [
					'G' => $next_game,
					'diff' => null
				];
			}
			// add data to final formatted object to return
			$array_data[] = [
				'team' => $team,
				'data' => $data[$team]
			];
		}

		$this->data = $array_data;
	}
}