<?php
$teamIDs['west'] = [
	"Dallas Mavericks" => 1610612742,
	"Denver Nuggets" => 1610612743,
	"Golden State Warriors" => 1610612744,
	"Houston Rockets" => 1610612745,
	"Los Angeles Clippers" => 1610612746,
	"Los Angeles Lakers" => 1610612747,
	"Memphis Grizzlies" => 1610612763,
	"Minnesota Timberwolves" => 1610612750,
	"New Orleans Pelicans" => 1610612740,
	"Oklahoma City Thunder" => 1610612760,
	"Phoenix Suns" => 1610612756,
	"Portland Trail Blazers" => 1610612757,
	"Sacramento Kings" => 1610612758,
	"San Antonio Spurs" => 1610612759,
	"Utah Jazz" => 1610612762,
];
$teamIDs['east'] = [
	"Atlanta Hawks" => 1610612737,
	"Boston Celtics" => 1610612738,
	"Brooklyn Nets" => 1610612751,
	"Charlotte Hornets" => 1610612766,
	"Chicago Bulls" => 1610612741,
	"Cleveland Cavaliers" => 1610612739,
	"Detroit Pistons" => 1610612765,
	"Indiana Pacers" => 1610612754,
	"Miami Heat" => 1610612748,
	"Milwaukee Bucks" => 1610612749,
	"New York Knicks" => 1610612752,
	"Orlando Magic" => 1610612753,
	"Philadelphia 76ers" => 1610612755,
	"Toronto Raptors" => 1610612761,
	"Washington Wizards" => 1610612764,
];

$url = 'stats.nba.com/stats/scoreboard/';
$data = '?GameDate=' . date('m/d/Y') . '&LeagueID=00&DayOffset=0';

$service_url = $url . $data;
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Referer: http://stats.nba.com/scores/'));
if(curl_exec($curl) === false){
    echo 'Curl error: ' . curl_error($curl);
    die();
}

$curl_response = curl_exec($curl);
$results = json_decode($curl_response);
function mapHeaders($headers, $array){
    $mapped = [];
    foreach($headers as $key => $val){
        $mapped[$val] = $array[$key];
    }
    return $mapped;
}
function nameFromID($id, $teamIDs){
    foreach($teamIDs as $conf => $team){
        foreach($team as $name => $_id){
            if($_id == $id){
                return $name;
            }
        }
    }
}
$eastStandings = [];
foreach($results->resultSets[4]->rowSet as $key => $team){
    $eastStandings[$key] = mapHeaders($results->resultSets[4]->headers, $team);
    $eastStandings[$key]['RANK'] = $key + 1;
    $eastStandings[$key]['NAME'] = nameFromID($eastStandings[$key]['TEAM_ID'], $teamIDs);
}
$westStandings = [];
foreach($results->resultSets[5]->rowSet as $key => $team){
    $westStandings[$key] = mapHeaders($results->resultSets[5]->headers, $team);
    $westStandings[$key]['RANK'] = $key + 1;
    $westStandings[$key]['NAME'] = nameFromID($westStandings[$key]['TEAM_ID'], $teamIDs);
}

function statsFromId($id, $standings){
    foreach($standings as $team){
        if($team['TEAM_ID'] == $id){
            return $team;
        }
    }
}
$teamStats = [];
foreach($teamIDs['east'] as $team => $id){
    $teamStats[$team] = statsFromId($id, $eastStandings);
}
foreach($teamIDs['west'] as $team => $id){
    $teamStats[$team] = statsFromId($id, $westStandings);
}
