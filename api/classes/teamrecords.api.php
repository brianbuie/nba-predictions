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
		foreach($this->game_states as $key => $game){
			foreach($game->standings->teams as $team){
				// check if specified 'include' is either the team's conference or abbreviation, or if it's set to 'all'
				if( in_array( strtoupper($this->include), [strtoupper($team['CONFERENCE']), $team['ABRV'], 'ALL'])){
					// push team's win/loss differential to array
					$data[$team["ABRV"]][] = [
						'date' => $game->date_string,
						'diff' => $team['W'] - $team['L']
					];
				}
			}
		}
		// reformat data into array for easier graphing
		foreach($data as $team => $days){
			$reversed = array_reverse($days);
			foreach($reversed as $key => $day){
				$day['day'] = $key;
				$reversed[$key] = $day;
			}
			$array_data[] = [
				'team' => $team,
				'data' => $reversed
			];
		}
		$this->data = $array_data;
	}
}