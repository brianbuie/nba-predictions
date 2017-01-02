<?php

class Standings {

	public $teams;

	// given a fully instantiated CustomDate object
	// checking if custom_date->is_valid should have been done before getting this far
	function __construct($custom_date){
		// file contains team_id keyed object with abbreviation values
		$abbreviations = json_decode(file_get_contents('data/team-abbreviations.json'));
		// get the standings either from cache or from nba api
		$results = $this->get_standings($custom_date);
		// refine results
		foreach($results->resultSets as $set_key => $set){
			// east and west standings are 4 and 5 in resultSet
			if($set_key > 3 && $set_key < 6){
				// nba api sucks and returns separate arrays of keys and values
				foreach($set->rowSet as $key => $team){
					// create a nicely keyed array for each team
					$standing = $this->map_headers($set->headers, $team);
					// add rank stat value
					$standing['RANK'] = $key + 1;
					// add team abbreviation
					$standing['ABRV'] = $this->get_abbreviation($abbreviations, $team[0]);
					// push standing to this->teams
					$this->teams[] = $standing;
				}
			}
		}
	}

	// either get api response from cache or fetch it from nba api
	private function get_standings($custom_date){
		// define filename where the request would be cached at
		$cache_location = 'data/nba/' . $custom_date->format('Y-m-d') . '.json';
		// if the response is cached, get it from the file
		if(file_exists($cache_location)){
			$data = file_get_contents($cache_location);
		} else {
			// fetch the standings, data is decoded and encoded for consistency between fetched data and data retrieved from cache
			$data = json_encode($this->fetch_standings($custom_date), JSON_PRETTY_PRINT);
			// set the minimum date for caching the response (3 days old) to ensure data won't change after being cached
			$cache_threshold = new DateTime();
			$cache_threshold->modify('-3 days');
			// if the date is less than the cache threshold, save the response where it should be found (Y-m-d.json)
			if( $custom_date->date < $cache_threshold ){
				file_put_contents($cache_location, $data);
			}
		}
		return json_decode($data);
	}

	// fetch data from NBA api
	private function fetch_standings($custom_date){
		// craft url and curl it
		$url = 'stats.nba.com/stats/scoreboard/';
		$data = '?GameDate=' . $custom_date->format('m/d/Y') . '&LeagueID=00&DayOffset=0';
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

	// take nba's shitty response and create pretty keyed array of team stats
	private function map_headers($headers, $array){
		$mapped = [];
		foreach($headers as $key => $val){
			$mapped[$val] = $array[$key];
		}
		return $mapped;
	}

	// return the abbreviation for team_id given
	private function get_abbreviation($abbreviations, $team_id){
		foreach($abbreviations as $id => $abbreviation){
			if($team_id == $id){
				return $abbreviation;
			}
		}
	}
}