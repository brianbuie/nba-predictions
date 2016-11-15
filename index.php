<?php 

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
<h1>NBA standings predictions</h1>

<div class="container">

	<?php if($entries){ foreach( $picks as $user => $divisions ){ ?>
		<h4><?php echo $user; ?></h4>
		<div class="row">
			<?php foreach ($divisions as $division => $standings){ ?>
			<div class="col-md-6">
				<h5><?php echo $division; ?></h5>
				<?php foreach ($standings as $i => $team) {
					echo '<div class="row">';
					echo '<div class="col-xs-8">' . $i . '. <b>' . $team['team'] . '</b></div>';
					echo '<div class="col-xs-4"><i>' . $team['wins'] . '-' . (82 - intval($team['wins'])) . '</i></div>';
					echo '</div>';
				} ?>
			</div>
			<?php } ?>
		</div>
	<?php } } ?>
	<form action="post.php" method="post">
		<div class="form-group row">
			<?php foreach($teams as $division => $teams){ ?>

				<div class="form-group col-lg-6">
					<h2><?php echo $division; ?></h2>
					<?php $i = 1; while($i < 3){ ?>
						<div class="form-group row">
							<div class="form-group col-xs-8">
								<select class="form-control" id="<?php echo $division . $i; ?>" name="<?php echo $division . $i; ?>" required>
									<option value="" disabled selected><?php echo $i; ?></option>
									<?php foreach ($teams as $team){
										echo '<option value="' . $team . '">' . $team . '</option>';
									} ?>
								</select>
							</div>
							<div class="form-group col-xs-4">
								<input class="form-control" type="number" placeholder="wins" id="<?php echo $division . $i; ?>-wins" name="<?php echo $division . $i; ?>-wins" required>
							</div>
						</div>
					<?php $i++; } ?>
				</div>
			<?php } ?>
		</div>
		<div class="form-group row">
			<div class="form-group col-xs-12">
				<input type="text" class="form-control" placeholder="Your Name" name="name" required>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
</div>










<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="js/app.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>