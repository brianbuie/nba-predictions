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
		$this->standings = new Standings($date);
		$entries = json_decode(file_get_contents('data/entries.json'), true);
		foreach($entries as $name => $files){
			$picks = json_decode(file_get_contents('data/' . end($files) . '.json'), true);
			$users[$name] = new User($name, $picks);
		}
		foreach($users as $user){
			$this->total_score($user);
		}
		$this->users = $this->sort_users($users);
	}

	// get the current team stats
	// or return one stat if specified in arguments
	public function team_actual($team_id, $stat = null){
		foreach($this->standings->teams as $team){
			if($team['TEAM_ID'] == $team_id){
				return $stat ? $team[$stat] : $team;
			}
		}
	}

	// dispatches all scoring on users and picks
	// not pure, sets pick data and user data
	private function total_score($user){
		$score = 0;
		foreach($user->picks as $team){
			// score both placement and win percentage for pick and get team info
			$pick_details = $this->set_pick_details($team);
			// set the pick info
			$user->set_pick_info($team['team_id'], $pick_details);
			// add pick score to total score
			$score += $pick_details['score']['total'];
		}
		// set the user's total score in user object
		$user->set_user_info('score', $score);
	}

	// scores one individual pick and gets team info, returns array of score and team info
	private function set_pick_details($pick){
		$pick_info['actual'] = $this->team_actual($pick['team_id']);
		$pick_info['score']['placement'] = $this->score_placement($pick);
		$pick_info['score']['w_pct'] = $this->score_w_pct($pick);
		$pick_info['score']['total'] = $pick_info['score']['placement']['score'] + $pick_info['score']['w_pct']['score'];
		// nested array
		return $pick_info;
	}

	// compare actual conference placement with predicted placement
	// scoring based on % correct
	private function score_placement($pick){
		$actual = $this->team_actual($pick['team_id'], 'RANK');
		$rank_value = 1/15;
		$difference = abs($actual - $pick['rank']);
		$correct = 1 - ($difference * $rank_value);
		$score = round($correct * $this->placement_points);
		$score += $correct == 1 ? $this->placement_bonus : 0;
		return $score_info = [
			'correct' 	=> round($correct, 3),
			'score' 	=> $score
		];
	}

	// compare win percentages
	// scoring based on % correct
	private function score_w_pct($pick){
		$actual = $this->team_actual($pick['team_id'], 'W_PCT');
		$predicted = round($pick['wins']/82, 3);
		$difference = abs($actual - $predicted);
		$correct = 1 - $difference;
		$score = round($correct * $this->w_pct_points);
		$score += $correct == 1 ? $this->w_pct_bonus : 0;
		return $score_info = [
			'correct' 	=> round($correct, 3),
			'score' 	=> $score
		];
	}

	// sort the users by total score
	private function sort_users($users){
		foreach($users as $key => $user){
			$scores[$key] = $user->score;
		}
		arsort($scores);
		foreach($scores as $key => $score){
			$sorted_users[] = $users[$key];
		}
		return $sorted_users;
	}

}