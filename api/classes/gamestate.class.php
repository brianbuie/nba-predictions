<?php

class GameState {

	public $standings;
	public $users;

	// point values
	private $placement_points = 15;
	private $placement_bonus = 15;
	private $w_pct_points = 0;
	private $w_pct_bonus = 15;

	public function __construct($date){
		$entries = json_decode(file_get_contents('data/entries.json'), true);
		foreach($entries as $user => $files){
			$picks = json_decode(file_get_contents('data/' . end($files) . '.json'), true);
			// create users from their picks
			$users[$user] = new User($user, $picks);
		}
		// get standings
		$this->standings = new Standings($date);
		foreach($users as $user){
			// score user picks
			$this->total_score($user);
		}
		// sort users based on total score
		$this->users = $this->sort_users($users);
	}

	// get the current team stats
	// or return one stat if specified in arguments
	public function team_actual($id, $stat = null){
		foreach($this->standings->standings as $conference){
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

	// dispatches all scoring on users and picks
	// not pure, sets pick data and user data
	private function total_score($user){
		$score = 0;
		foreach($user->picks as $conference => $teams){
			foreach($teams as $rank => $team){
				$pick_scores = $this->score_pick($team);
				// set team name in pick object
				$user->set_pick_info($team['team'], $pick_scores);
				// add pick score to total score
				$score += $pick_scores['score'];
			}
		}
		// set the user's total score in user object
		$user->set_user_info('score', $score);
	}

	// scores one individual pick, returns array of score info
	private function score_pick($pick){
		$actual = $this->team_actual($pick['team']);
		$score_info['placement'] = $this->score_placement($pick);
		$score_info['w_pct'] = $this->score_w_pct($pick);
		$score_info['score'] = $score_info['placement']['score'] + $score_info['w_pct']['score'];
		// nested array
		return $score_info;
	}

	// compare actual conference placement with predicted placement
	// scoring based on % correct
	private function score_placement($pick){
		$actual = $this->team_actual($pick['team'], 'RANK');
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
	private function score_w_pct($pick){
		$actual = $this->team_actual($pick['team'], 'W_PCT');
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

	// sort the users by total score
	private function sort_users($users){
		foreach($users as $key => $user){
			$map[$key] = $user->score;
		}
		arsort($map);
		$sorted_users = [];
		foreach($map as $key => $whatever){
			array_push($sorted_users, $users[$key]);
		}
		return $sorted_users;
	}

}