<?php

$debug = false;
if(isset($_GET['debug'])){
    $debug = true;
}


function scorePick($rank, $details, $teamStats, $debug){
    if($debug){
        echo '<tr><th colspan="5" class="center">';
        echo $details['team'];
        echo '</th></tr>';
    }
    $actual = $teamStats[$details['team']];
    $score = scoreRank($rank, $details, $teamStats, $debug);
    $score += scoreWinPercentage($details, $teamStats, $debug);
    return $score;
}

function scoreWinPercentage($details, $teamStats, $debug){
    $actual = $teamStats[$details['team']]['W_PCT'];
    $predicted = round($details['wins']/82, 3);
    $difference = abs($actual - $predicted);
    $percentCorrect = 1 - $difference;

    $score = round($percentCorrect * 50);
    if( $percentCorrect == 1){
        $score += 100;
    }
    if($debug){
        echo '<tr>';
        echo '<td>prediction: ' . $predicted . ' W%</td>';
        echo '<td>actual: ' . $actual . ' W%</td>';
        if($percentCorrect == 1){ echo '<td class="points">'; }else{ echo '<td>'; }
        echo '<i>' . round($percentCorrect * 100) . '% correct</i></td>';
        echo '<td>x 50 points</td>';
        echo '<td><strong class="points">+' . $score . ' points</td>';
        echo '</tr>';
    }
    return $score;
}

function scoreRank($rank, $details, $teamStats, $debug){
    $actual = $teamStats[$details['team']]['RANK'];
    $rankValue = 1/15;
    $difference = abs($actual - $rank);
    $percentCorrect = 1 - ($difference * $rankValue);

    $score = round($percentCorrect * 100);
    if( $percentCorrect == 1){
        $score += 50;
    }
    if($debug){
        echo '<tr>';
        echo '<td>prediction: ' . $rank. ' position</td>';
        echo '<td>actual: ' . $actual . ' position</td>';
        if($percentCorrect == 1){ echo '<td class="points">'; }else{ echo '<td>'; }
        echo '<i>' . round($percentCorrect * 100, 3) . '% correct</i></td>';
        echo '<td>x 100 points</td>';
        echo '<td><strong class="points">+' . $score . ' points</td>';
        echo '</tr>';
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

function currentStat($details, $teamStats, $stat){
    $actual = $teamStats[$details['team']][$stat];
    return $actual;
}

$totalScores = [];

foreach($picks as $user => $_picks){
    $total_score= 0;
    if($debug){
        echo '<h4 class="center">' . $user . '</h4><div class="row"><div class="col-md-10 offset-md-1"><div class="table-responsive table-inverse"><table class="table"><tbody>';
    }
    foreach($_picks as $conference => $standings){
        foreach($standings as $rank => $details){
            $picks[$user][$conference][$rank]['W_PCT'] = round($picks[$user][$conference][$rank]['wins']/82, 3);
            $picks[$user][$conference][$rank]['REAL_W_PCT'] = currentStat($details, $teamStats, 'W_PCT');
            $picks[$user][$conference][$rank]['REAL_W'] = currentStat($details, $teamStats, 'W');
            $picks[$user][$conference][$rank]['REAL_L'] = currentStat($details, $teamStats, 'L');
            $picks[$user][$conference][$rank]['short'] = currentStat($details, $teamStats, 'TEAM');
            $score = scorePick($rank, $details, $teamStats, $debug);
            $picks[$user][$conference][$rank]['score'] = $score;
            $picks[$user][$conference][$rank]['correct'] = isCorrectRank($rank, $details, $teamStats);
            $total_score += $score;
        }
    }
    if($debug){
        echo '<tr><td colspan="4"></td><td class="points">' . $total_score . ' points</td></tr>';
        echo '</tbody></table></div></div></div>';
    }
    $totalScores[$user] = $total_score;
}
arsort($totalScores);
