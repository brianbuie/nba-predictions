<?php

class Compare {

	public $current;
	public $compare;

	public function __construct($current_date, $compare_date){
		$this->current = new GameState($current_date);
		$this->compare = new GameState($compare_date);
	}

	public function user_score_difference($username){
		$current_score = $this->get_user_stat($username, $this->current, 'score');
		$compare_score = $this->get_user_stat($username, $this->compare, 'score');
		return $current_score - $compare_score;
	}

	public function pick_score_difference($username, $conference, $rank){
		$current_score = $this->get_user_stat($username, $this->current, 'picks')[$conference][$rank]['score'];
		$compare_score = $this->get_user_stat($username, $this->compare, 'picks')[$conference][$rank]['score'];
		return $current_score - $compare_score;
	}

	public function team_rank_difference($team_id){
		$current_rank = $this->get_team_stat($team_id, $this->current, 'RANK');
		$compare_rank = $this->get_team_stat($team_id, $this->compare, 'RANK');
		return $current_rank - $compare_rank;
	}

	private function get_user_stat($username, $game, $stat){
		foreach($game->users as $user){
			if($user->name == $username){
				return $user->$stat;
			}
		}
	}

	private function get_team_stat($team_id, $game, $stat){
		foreach($game->standings->standings as $conference){
			foreach($conference as $team){
				if($team['TEAM_ID'] == $team_id){
					return $team[$stat];
				}
			}
		}
	}
}