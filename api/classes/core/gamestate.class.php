<?php

class GameState {

	// Y-m-d (2016-10-01)
	public $date_string;
	// NBA standings on given date
	public $standings;
	// User picks and scores for given date
	public $users;

	// point values for correct placement prediction
	private $placement_points = 15;
	private $placement_bonus = 15;
	// point values for correct win percentage prediction
	private $w_pct_points = 0;
	private $w_pct_bonus = 15;

	// given an already instantiated CustomDate object
	public function __construct($custom_date){

		// set the date_string for this GameState
		$this->date_string = $custom_date->format('Y-m-d');

		// create the standings
		$this->standings = new Standings($custom_date);

		// get the user entries
		// TODO create a new class that handles JSON getting/setting
		$entries = json_decode(file_get_contents('data/entries.json'), true);
		foreach($entries as $name => $files){
			// get last file in user's entries
			$picks = json_decode(file_get_contents('data/' . end($files) . '.json'), true);
			$users[$name] = new User($name, $picks);
		}

		// score all user picks
		foreach($users as $user){
			$this->total_score($user);
		}

		// sort users based on total score (higher first)
		$this->users = $this->sort_users($users);
	}

	// return full team info or stat for team with given team_id in standings
	public function team_actual($team_id, $stat = null){
		foreach($this->standings->teams as $team){
			if($team['TEAM_ID'] == $team_id){
				return $stat ? $team[$stat] : $team;
			}
		}
	}

	// dispatches all scoring on users and picks
	// not pure, injects pick data and user data
	private function total_score($user){
		$score = 0;
		foreach($user->picks as $team){
			// score both placement and win percentage for pick
			// also nests actual team info in pick (for easier use in JS)
			$pick_details = $this->set_pick_details($team);
			// set_pick_info is method of user object that injects info into user's picks
			$user->set_pick_info($team['team_id'], $pick_details);
			// add pick score to total score
			$score += $pick_details['score']['total'];
		}
		// set the user's total score in user object
		$user->set_user_info('score', $score);
	}

	// returns array of score and team info for given pick
	private function set_pick_details($pick){
		$pick_info['actual'] = $this->team_actual($pick['team_id']);
		$pick_info['score']['placement'] = $this->score_placement($pick);
		$pick_info['score']['w_pct'] = $this->score_w_pct($pick);
		$pick_info['score']['total'] = $pick_info['score']['placement']['score'] + $pick_info['score']['w_pct']['score'];
		return $pick_info;
	}

	// compare actual conference placement with predicted placement
	// scoring based on % correct
	private function score_placement($pick){
		// actual team rank
		$actual = $this->team_actual($pick['team_id'], 'RANK');
		// rank_value is based on 15 possible spots
		// predicted 1st place when actually 15th results in 0% correct
		$rank_value = 1/15;
		// absolute difference between actual and predicted 
		// absolute prevents negatives and positives affecting score, gets distance from actual rather than +/- difference
		$difference = abs($actual - $pick['rank']);
		// percent correct
		$correct = 1 - ($difference * $rank_value);
		// % correct multiplied by placement_points defined at the top
		$score = round($correct * $this->placement_points);
		// if pick is 100% correct, add the placement_bonus to it
		$score += $correct == 1 ? $this->placement_bonus : 0;
		// return corrct % along with calculated score
		return $score_info = [
			'correct' 	=> round($correct, 3),
			'score' 	=> $score
		];
	}

	// compare win percentages
	// scoring based on % correct
	private function score_w_pct($pick){
		// actual team win percentage
		$actual = $this->team_actual($pick['team_id'], 'W_PCT');
		// calculate predicted win percentage based on predicted wins divided by 82 games, rounded to 3 decimals
		$predicted = round($pick['wins']/82, 3);
		// get the absolute difference between actual and predicted
		// absolute prevents negatives and positives affecting score, gets distance from actual rather than +/- difference
		$difference = abs($actual - $predicted);
		// percent correct
		$correct = 1 - $difference;
		// % correct multiplied by w_pct_points defined at the top
		// currently set to 0, since differences are so small, and was decided that closeness of win percentage shouldn't matter
		// just matters if it's completely right or not
		$score = round($correct * $this->w_pct_points);
		// if prediction is 100% correct, add w_pct_bonus
		$score += $correct == 1 ? $this->w_pct_bonus : 0;
		// includes predicted win percentage to prevent calculation in JS
		// prevents possibility of differences between displayed and what was used to score
		return $score_info = [
			'predicted' => $predicted,
			'correct' 	=> round($correct, 3),
			'score' 	=> $score
		];
	}

	// sort the users by total score
	private function sort_users($users){
		// create temporary array of scores
		foreach($users as $key => $user){
			$scores[$key] = $user->score;
		}
		arsort($scores);
		// recreate users array based on keys in sorted scores
		foreach($scores as $key => $score){
			$sorted_users[] = $users[$key];
		}
		return $sorted_users;
	}

}