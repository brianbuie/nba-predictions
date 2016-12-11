<?php

class Api {

	public $standings;

	function __construct($date){
		$results = $this->fetch_standings($date);
		$standings = [];
		foreach($results->resultSets[4]->rowSet as $key => $team){
		    $standings['east'][$key] = $this->map_headers($results->resultSets[4]->headers, $team);
		    $standings['east'][$key]['RANK'] = $key + 1;
		}
		foreach($results->resultSets[5]->rowSet as $key => $team){
		    $standings['west'][$key] = $this->map_headers($results->resultSets[5]->headers, $team);
		    $standings['west'][$key]['RANK'] = $key + 1;
		}
		$this->standings = array_reverse($standings);
	}

	protected function fetch_standings($date){
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

	protected function map_headers($headers, $array){
	    $mapped = [];
	    foreach($headers as $key => $val){
	        $mapped[$val] = $array[$key];
	    }
	    return $mapped;
	}

	public function get_team_stats($team_id){
		foreach($this->standings as $conference){
			foreach($conference as $team){
				if($team['TEAM_ID'] == $team_id){
					return $team;
				}
			}
		}
	}
}