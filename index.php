<?php

include('api.php');

$OPEN_SUBMISSIONS = false;

$teams = [];

$teams['west'] = [
	"Dallas Mavericks",
	"Denver Nuggets",
	"Golden State Warriors",
	"Houston Rockets",
	"Los Angeles Clippers",
	"Los Angeles Lakers",
	"Memphis Grizzlies",
	"Minnesota Timberwolves",
	"New Orleans Pelicans",
	"Oklahoma City Thunder",
	"Phoenix Suns",
	"Portland Trail Blazers",
	"Sacramento Kings",
	"San Antonio Spurs",
	"Utah Jazz",
];
$teams['east'] = [
	"Atlanta Hawks",
	"Boston Celtics",
	"Brooklyn Nets",
	"Charlotte Hornets",
	"Chicago Bulls",
	"Cleveland Cavaliers",
	"Detroit Pistons",
	"Indiana Pacers",
	"Miami Heat",
	"Milwaukee Bucks",
	"New York Knicks",
	"Orlando Magic",
	"Philadelphia 76ers",
	"Toronto Raptors",
	"Washington Wizards",
];

$directory = 'data/';

if(file_exists($directory . 'entries.json')){
	$entries = json_decode(file_get_contents($directory . 'entries.json'), true);
} else {
	$entries = [];
}
$picks = [];
foreach($entries as $user => $files){
	$picks[$user] = json_decode(file_get_contents($directory . end($files) . '.json'), true);
}

include('scoring.php');

function scoreColor($score){
	if($score >= 1){
		return '<span style="color: green">+' . $score . '</span>';
	} else {
		return '<span style="color: red">' . $score . '</span>';
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NBA Predictions</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
<h1>NBA Standings Predictions</h1>

<div class="container">

	<div class="alert alert-warning">
		<h4 class="center">Current Standings</h4>
		<div class="row">
			<div class="col-md-6">
				<h5 class="border-bottom center" style="padding-bottom: 20px;">West</h5>
				<?php foreach ($westStandings as $i => $team) {
					echo '<div class="row border-bottom">';
					echo '<div class="col-xs-9">' . ($i + 1) . '. <b>' . $team['NAME'] . '</b></div>';
					echo '<div class="col-xs-3"><i>' . $team['W'] . '-' . $team['L'] . '</i></div>';
					echo '</div>';
				} ?>
			</div>
			<div class="col-md-6">
				<h5 class="border-bottom center" style="padding-bottom: 20px;">East</h5>
				<?php foreach ($eastStandings as $i => $team) {
					echo '<div class="row border-bottom">';
					echo '<div class="col-xs-9">' . ($i + 1) . '. <b>' . $team['NAME'] . '</b></div>';
					echo '<div class="col-xs-3"><i>' . $team['W'] . '-' . $team['L'] . '</i></div>';
					echo '</div>';
				} ?>
			</div>
		</div>
	</div>

	<?php if($entries){
		foreach( $totalScores as $user => $points ){
			$divisions = $picks[$user]; ?>
			<div class="alert alert-info">
				<h4 style="text-align:center;"><?php echo $user;?></h4>
				<h5 style="text-align:center;"><?php echo $points . ' points';?></h5>
				<div class="row">
					<?php foreach ($divisions as $division => $standings){ ?>
					<div class="col-md-6">
						<h5 class="center border-bottom" style="padding-bottom: 20px;"><?php echo $division; ?></h5>
						<?php foreach ($standings as $i => $team) {
							echo '<div class="row border-bottom">';
							if($team['correct']){
								echo '<div class="col-xs-7">' . $i . '. <b>' . $team['team'] . '</b></div>';
							} else {
								echo '<div class="col-xs-7" style="opacity: 0.5;">' . $i . '. <b>' . $team['team'] . '</b></div>';
							}
							echo '<div class="col-xs-3"><i>' . $team['wins'] . '-' . (82 - intval($team['wins'])) . '</i></div>';
							echo '<div class="col-xs-2">' . scoreColor($team['score']) . '</div>';
							echo '</div>';
						} ?>
					</div>
					<?php } ?>
				</div>
			</div>
		<?php }
	} ?>

	<?php if($OPEN_SUBMISSIONS){
		include('form.php');
	} ?>

	<div class="row">
		<div class="col-xs-12" style="text-align:center; margin-top: 40px;">
			<h1>Scoring</h1>
			<p><span style="color: green;">+50</span> points for correct placement</p>
			<p><span style="color: red;">-10</span> points for every place away from predicted placement</p>
			<p><span style="color: green;">+100</span> points for guessing correct amount of wins</p>
			<p><span style="color: red;">-1</span> point for every win away from predicted amount of wins</p>

		</div>
	</div>

</div>










<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="js/app.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
