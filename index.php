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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NBA Predictions</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style2.css" type="text/css">
</head>

<body>
<h1>NBA Standings Predictions</h1>

<p class="center"><a href="?debug">Full Scoring Breakdown</a></p>

<div class="container">

	<?php include('scoring.php'); ?>

	<h4 class="center">Current Standings</h4>
	<div class="row">
		<div class="col-lg-6">
			<div class="table-responsive">
				<table class="table table-sm table-inverse">
					<thead>
						<tr class="bg-primary">
							<th class="center"> Rank </th>
							<th> Western Conference </th>
							<th class="center"> Record </th>
							<th class="center"> Win % </th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($westStandings as $i => $team) {
							echo '<tr>';
							echo '<td class="center">' . ($i + 1) . '</td>';
							echo '<td>' . $team['NAME'] . '</td>';
							echo '<td class="center">' . $team['W'] . '-' . $team['L'] . '</td>';
							echo '<td class="center"><i>' . $team['W_PCT'] . '%</i></td>';
							echo '</tr>';
						} ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="table-responsive">
				<table class="table table-sm table-inverse">
					<thead>
						<tr class="bg-primary">
							<th class="center"> Rank </th>
							<th> Eastern Conference </th>
							<th class="center"> Record </th>
							<th class="center"> Win % </th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($eastStandings as $i => $team) {
							echo '<tr>';
							echo '<td class="center">' . ($i + 1) . '</td>';
							echo '<td>' . $team['NAME'] . '</td>';
							echo '<td class="center">' . $team['W'] . '-' . $team['L'] . '</td>';
							echo '<td class="center"><i>' . $team['W_PCT'] . '%</i></td>';
							echo '</tr>';
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<?php if($entries){
		foreach( $totalScores as $user => $points ){
			$divisions = $picks[$user]; ?>
			<div class="user-container">
				<h5 class="center"><?php echo $user;?></h5>
				<h3 class="center points"><?php echo $points . ' points';?></h3>
				<div class="row">
					<?php foreach ($divisions as $division => $standings){ ?>
						<div class="col-lg-6">
							<div class="table-responsive table-inverse">
								<table class="table table-sm">
									<thead>
										<tr>
											<th class="center"> Rank </th>
											<th> <?php echo $division ?> </th>
											<th colspan="2" class="center"> Predicted </th>
											<th colspan="2" class="center"> Current </th>
											<th class="center"> Points </th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($standings as $i => $team) {
											if($team['correct']){
												echo '<tr class="correct">';
											} else {
												echo '<tr class="incorrect">';
											}
											echo '<td class="center">' . $i . '</td>';
											echo '<td>' . $team['short'] . '</td>';
											echo '<td class="center border-left">' . $team['wins'] . '-' . (82 - intval($team['wins'])) . '</td>';
											echo '<td class="center"><i>' . $team['W_PCT'] . '</i></td>';
											echo '<td class="center border-left">' . $team['REAL_W'] . '-' . $team['REAL_L'] . '</td>';
											echo '<td class="center"><i>' . $team['REAL_W_PCT'] . '</i></td>';
											echo '<td class="center border-left"><strong class="points">' . $team['score'] . '</strong></td>';
											echo '</tr>';
										} ?>
									</tbody>
								</table>
							</div>
						</div> <!-- /column -->
					<?php } // foreach division ?>
				</div> <!-- /row -->
			</div> <!-- /user-container -->
		<?php } // foreach user ?>
	<?php } // if entries ?>

	<?php if($OPEN_SUBMISSIONS){
		include('form.php');
	} ?>

	<div class="row">
		<div class="col-xs-12" style="text-align:center; margin-top: 40px;">
			<h1>Scoring</h1>
			<p>Scoring is based on % correct compared to actual standings and win percentage</p>
			<p>Position predictions are out of <span class="points">100 points</span>, with a <span class="points">50 point</span> bonus for being 100% correct</p>
			<p>Wins are now ranked by comparing win percentage, out of <span class="points">50 points</span>, with a <span class="points">100 point</span> bonus for being 100% correct</p>
			<p>You can view the scoring in more detail <a href="?debug">here</a></p>

		</div>
	</div>

</div>










<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="js/app.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
