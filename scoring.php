<?php

function scorePick($rank, $details, $teamStats){
    $score = 0;
    $actual = $teamStats[$details['team']];
    if($actual['RANK'] == $rank){
        $score += 50;
    }else{
        $score -= (abs($actual["RANK"] - $rank) * 10);
    }
    $win_differential = abs($actual['W'] - $details['wins']);
    if($win_differential == 0){
        $score += 100;
    } else {
        $score -= $win_differential;
    }
    return $score;
}

$totalScores = [];

foreach($picks as $user => $_picks){
    $total_score= 0;

    foreach($_picks as $conference => $standings){
        foreach($standings as $rank => $details){
            $score = scorePick($rank, $details, $teamStats);
            $picks[$user][$conference][$rank]['score'] = $score;
            $total_score += $score;
        }
    }

    $totalScores[$user] = $total_score;
}
arsort($totalScores);
