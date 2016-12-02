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

function isCorrectRank($rank, $details, $teamStats){
    $actual = $teamStats[$details['team']];
    if($actual['RANK'] == $rank){
        return true;
    }else{
        return false;
    }
}

$totalScores = [];

foreach($picks as $user => $_picks){
    $total_score= 0;

    foreach($_picks as $conference => $standings){
        foreach($standings as $rank => $details){
            $score = scorePick($rank, $details, $teamStats);
            $picks[$user][$conference][$rank]['score'] = $score;
            $picks[$user][$conference][$rank]['correct'] = isCorrectRank($rank, $details, $teamStats);
            $total_score += $score;
        }
    }

    $totalScores[$user] = $total_score;
}
arsort($totalScores);
