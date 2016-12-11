<?php

class Game {

	public $current;
	public $users;

	// point values
	protected $placement_points = 100;
	protected $placement_bonus = 50;
	protected $w_pct_points = 50;
	protected $w_pct_bonus = 100;

	function __construct($date){
		if(file_exists('data/entries.json')){
			$entries = json_decode(file_get_contents('data/entries.json'), true);
		} else {
			$entries = [];
		}
		foreach($entries as $user => $files){
			$picks = json_decode(file_get_contents('data/' . end($files) . '.json'), true);
			$users[$user] = new User($user, $picks);
		}
		$this->current = new Api($date);
		foreach($users as $user){
			$this->total_score($user);
		}
		$this->users = $this->sort_users($users);
	}

	// dispatches all scoring functions on users and picks
	// not pure, sets pick data and user data
	function total_score($user){
		$score = 0;
		foreach($user->picks as $conference => $teams){
			foreach($teams as $rank => $team){
				$pick_scores = $this->score_pick($team);
				$user->set_pick_info($team['team'], $pick_scores);
				$score += $pick_scores['score'];
			}
		}
		$user->set_user_info('score', $score);
	}

	// scores one individual pick, returns array of score info
	function score_pick($pick){
		$actual = $this->team_current($pick['team']);
		$score_info['placement'] = $this->score_placement($pick);
		$score_info['w_pct'] = $this->score_w_pct($pick);
		$score_info['score'] = $score_info['placement']['score'] + $score_info['w_pct']['score'];
		return $score_info;
	}

	// compare actual conference placement with predicted placement
	// scoring based on % correct
	function score_placement($pick){
		$actual = $this->team_current($pick['team'], 'RANK');
		$rank_value = 1/15;
		$difference = abs($actual - $pick['rank']);
		$correct = 1 - ($difference * $rank_value);
		$score = round($correct * $this->placement_points);
		if($correct == 1){
			$score += $this->placement_bonus;
		}
		return $score_info = [
			'predicted' => $pick['rank'],
			'actual'	=> $actual,
			'correct_%' => $correct,
			'score' 	=> $score
		];
	}

	// compare win percentages
	// scoring based on % correct
	function score_w_pct($pick){
		$actual = $this->team_current($pick['team'], 'W_PCT');
		$predicted = round($pick['wins']/82, 3);
		$difference = abs($actual - $predicted);
		$correct = 1 - $difference;
		$score = round($correct * $this->w_pct_points);
		if($correct == 1){
			$score += $this->w_pct_bonus;
		}
		return $score_info = [
			'predicted' => $predicted,
			'actual'	=> $actual,
			'correct_%' => $correct,
			'score' 	=> $score
		];
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
	function sort_users($users){
		foreach($users as $key => $user){
			$map[$key] = $user->score;
		}
		arsort($map);
		$new_users = [];
		foreach($map as $key => $whatever){
			array_push($new_users, $users[$key]);
		}
		return $new_users;
	}

}