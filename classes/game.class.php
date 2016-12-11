<?php

class Game {

	public $current;
	public $users;

	// point values
	protected $placement_points = 100;
	protected $placement_bonus = 50;
	protected $w_pct_points = 50;
	protected $w_pct_bonus = 100;

	function __construct($date, $users){
		$this->current = new Api($date);
		foreach($users as $user){
			$this->total_score($user);
		}
		$this->users = $users;
		$this->sort_users();
	}

	// dispatches all scoring functions on users and picks
	// not pure, sets pick data and user data
	function total_score($user){
		$total_score = 0;
		foreach($user->picks as $conference => $teams){
			foreach($teams as $rank => $team){
				$pick_scores = $this->score_pick($team);
				$pick_scores['correct_placement'] = false;
				if($pick_scores['placement_score'] == $this->placement_points + $this->placement_bonus){
					$pick_scores['correct_placement'] = true;
				}
				$pick_scores['w_pct'] = round($team['wins']/82, 3);
				$user->set_pick_info($team['team'], $pick_scores);
				$total_score += $pick_scores['total_score'];
			}
		}
		$user->set_user_info('total_score', $total_score);
	}

	// scores one individual pick, returns array of score info
	function score_pick($pick){
		$actual = $this->team_current($pick['team']);
		$scores['placement_score'] = $this->score_placement($pick);
		$scores['w_pct_score'] = $this->score_w_pct($pick);
		$scores['total_score'] = $scores['placement_score'] + $scores['w_pct_score'];
		return $scores;
	}

	// compare actual conference placement with predicted placement
	// scoring based on % correct
	function score_placement($pick){
		$actual = $this->team_current($pick['team'])['RANK'];
		$rank_value = 1/15;
		$difference = abs($actual - $pick['rank']);
		$correct = 1 - ($difference * $rank_value);
		$score = round($correct * $this->placement_points);
		if($correct == 1){
			$score += $this->placement_bonus;
		}
		return $score;
	}

	// compare win percentages
	// scoring based on % correct
	function score_w_pct($pick){
		$actual = $this->team_current($pick['team'])['W_PCT'];
		$predicted = round($pick['wins']/82, 3);
		$difference = abs($actual - $predicted);
		$correct = 1 - $difference;
		$score = round($correct * $this->w_pct_points);
		if($correct == 1){
			$score += $this->w_pct_bonus;
		}
		return $score;
	}

	// get the current team stats
	// or return one stat if specified in arguments
	function team_current($id, $stat = null){
		foreach($this->current->standings as $conference){
			foreach($conference as $rank => $team){
				if($team['TEAM_ID'] == $id){
					if($stat){
						return $team[$stat];
					}
					return $team;
				}
			}
		}
	}

	// sort the users by total score
	function sort_users(){
		$map = [];
		foreach($this->users as $key => $user){
			$map[$key] = $user->total_score;
		}
		arsort($map);
		$new_users = [];
		foreach($map as $key => $whatever){
			$new_users[$key] = $this->users[$key];
		}
		$this->users = $new_users;
	}

}