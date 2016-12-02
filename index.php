<?php

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
	<?php if($entries){ foreach( $picks as $user => $divisions ){ ?>
	<div class="alert alert-info">
		<h4><?php echo $user; ?></h4>
		<div class="row">
			<?php foreach ($divisions as $division => $standings){ ?>
			<div class="col-md-6">
				<h5><?php echo $division; ?></h5>
				<?php foreach ($standings as $i => $team) {
					echo '<div class="row border-bottom">';
					echo '<div class="col-xs-9">' . $i . '. <b>' . $team['team'] . '</b></div>';
					echo '<div class="col-xs-3"><i>' . $team['wins'] . '-' . (82 - intval($team['wins'])) . '</i></div>';
					echo '</div>';
				} ?>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } } ?>

	<?php if($OPEN_SUBMISSIONS){
		include('form.php');
	} ?>

</div>










<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="js/app.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
