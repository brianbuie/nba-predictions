<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NBA Predictions</title>
	<link href="css/vendor/font-awesome/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css?<?php echo rand(1, 1234423); ?>" type="text/css">
</head>
<body>
<h1 class="center spaced-out">NBA Standings Predictions</h1>
<div class="container">
	<div class="row">
		<div class="col-md-4 offset-md-4">
			<div class="row">
				<div class="col-xs-2 center">
					<?php if( $prev_day = $date->get_prev_day() ){ ?>
						<a href="?date=<?php echo $prev_day->format('Y-m-d'); ?>"><i class="date-nav fa fa-arrow-left"></i></a>
					<?php } ?>
				</div>
				<div class="col-xs-8 center">
					<h5>
						<?php echo $date->format($date->selected_day, 'F j, Y'); ?>
					</h5>
				</div>
				<div class="col-xs-2 center">
					<?php if( $next_day = $date->get_next_day() ){ ?>
						<a href="?date=<?php echo $next_day->format('Y-m-d'); ?>"><i class="date-nav fa fa-arrow-right"></i></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>