<?php

class Compare {

	public $baseline;
	private $compare;

	function __construct($baseline, $compare = null){
		$this->baseline = $baseline;
		if(!$compare){
			$new_date = new DateTime($this->baseline->date);
			$new_date->modify('-1 day');
		}
		$compare = $compare ? $compare : new GameState($new_date);
		$this->set_differences($compare);
		if(!$this->is_different()){
			$new_date->modify('-1 day');
			$this->set_differences(new GameState($new_date));
		}
	}

	private function set_differences($compare){
		$this->compare = $compare;
		$this->set_team_difference();
		$this->set_user_difference();
	}

	private function set_team_difference(){
		foreach($this->baseline->standings->teams as $key => $team){
			$this->baseline->standings->teams[$key]['difference'] = [
				'date' => $this->compare->date,
				'G' => $this->team_stat_difference($team['TEAM_ID'], 'G'),
				'W' => $this->team_stat_difference($team['TEAM_ID'], 'W'),
				'L' => $this->team_stat_difference($team['TEAM_ID'], 'L'),
				'W_PCT' => $this->team_stat_difference($team['TEAM_ID'], 'W_PCT'),
				'RANK' => $this->team_stat_difference($team['TEAM_ID'], 'RANK')
			];
		}
	}

	private function set_user_difference(){
		foreach($this->baseline->users as $key => $user){
			$this->baseline->users[$key]->difference = [
				'date' => $this->compare->date,
				'score' => $this->user_stat_difference($user->name, 'score')
			];
			foreach($user->picks as $pick_key => $team){
				$this->baseline->users[$key]->picks[$pick_key]['difference'] = $this->user_pick_difference($user->name, $team['team_id']);
			}
		}
	}

	private function user_stat_difference($username, $stat){ 
		$baseline_stat = $this->get_user_stat($username, $this->baseline, $stat); 
		$compare_stat = $this->get_user_stat($username, $this->compare, $stat); 
		return $baseline_stat - $compare_stat; 
	}

	private function get_user_stat($username, $game, $stat){ 
		foreach($game->users as $user){ 
			if($user->name == $username){ 
				return $user->$stat; 
			} 
		} 
	}

	private function user_pick_difference($username, $team_id){
		$baseline_pick = $this->get_user_pick($username, $this->baseline, $team_id);
		$compare_pick = $this->get_user_pick($username, $this->compare, $team_id);
		$difference = [
			'placement' => $baseline_pick["score"]["placement"]["score"] - $compare_pick["score"]["placement"]["score"],
			'w_pct' => $baseline_pick["score"]["w_pct"]["score"] - $compare_pick["score"]["w_pct"]["score"],
			'total' => $baseline_pick["score"]["total"]- $compare_pick["score"]["total"]
		];
		return $difference;
	}

	private function get_user_pick($username, $game, $team_id){
		$picks = $this->get_user_stat($username, $game, 'picks');
		foreach($picks as $key => $team){
			if($team['team_id'] == $team_id){
				return $team;
			}
		}
	}

	private function team_stat_difference($team_id, $stat){ 
		$baseline_stat = $this->get_team_stat($team_id, $this->baseline, $stat); 
		$compare_stat = $this->get_team_stat($team_id, $this->compare, $stat); 
		return $baseline_stat - $compare_stat; 
	}

	private function get_team_stat($team_id, $game_state, $stat){ 
		foreach($game_state->standings->teams as $team){
			if($team['TEAM_ID'] == $team_id){ 
				return $team[$stat]; 
			}
		}
	}

	private function is_different(){
		$total_different_games = 0;
		foreach($this->baseline->standings->teams as $team){
			$total_different_games += $team['difference']['G'];
		}
		return $total_different_games;
	}
}