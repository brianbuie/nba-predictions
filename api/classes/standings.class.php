<?php

class Standings {

	public $teams;

	function __construct($date){
		$abbreviations = json_decode(file_get_contents('data/team-abbreviations.json'));
		$results = $this->get_standings($date);
		foreach($results->resultSets as $set_key => $set){
			// east and west standings are 4 and 5 in resultSet
			if($set_key > 3 && $set_key < 6){
				foreach($set->rowSet as $key => $team){
					$standing = $this->map_headers($set->headers, $team);
					$standing['RANK'] = $key + 1;
					$standing['ABRV'] = $this->get_abbreviation($abbreviations, $team[0]);
					$this->teams[] = $standing;
				}
			}
		}
	}

	private function get_standings($date){
		$cache_location = 'data/nba/' . $date->format('Y-m-d') . '.json';
		$cache_threshold = new DateTime();
		$cache_threshold->modify('-3 days');
		if(file_exists($cache_location)){
			$data = file_get_contents($cache_location);
		} else {
			$data = json_encode($this->fetch_standings($date), JSON_PRETTY_PRINT);
			if( $date < $cache_threshold ){
				file_put_contents($cache_location, $data);
			}
		}
		return json_decode($data);
	}

	private function fetch_standings($date){
		$url = 'stats.nba.com/stats/scoreboard/';
		$data = '?GameDate=' . $date->format('m/d/Y') . '&LeagueID=00&DayOffset=0';
		$service_url = $url . $data;
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Referer: http://stats.nba.com/scores/'));
		if(curl_exec($curl) === false){
			echo 'Curl error: ' . curl_error($curl);
			die();
		}
		$curl_response = curl_exec($curl);
		return json_decode($curl_response);
	}

	private function map_headers($headers, $array){
		$mapped = [];
		foreach($headers as $key => $val){
			$mapped[$val] = $array[$key];
		}
		return $mapped;
	}

	private function get_abbreviation($abbreviations, $team_id){
		foreach($abbreviations as $id => $abbreviation){
			if($team_id == $id){
				return $abbreviation;
			}
		}
	}
}