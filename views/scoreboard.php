<?php
	$current_day = new DateTime();
	$first_day = new DateTime('2016-10-01');
	$prev_day = new DateTime( $date->format('Y-m-d') );
	$prev_day->modify('-1 day');
	$next_day = new DateTime( $date->format('Y-m-d') );
	$next_day->modify('+1 day');
?>
<div class="row">
	<div class="col-md-6 offset-md-3 user-container spaced-out">
		<div class="row">
			<div class="col-xs-2 center">
				<?php if( $prev_day > $first_day ){ ?>
					<a href="?date=<?php echo $prev_day->format('Y-m-d'); ?>"><i class="date-nav fa fa-arrow-left"></i></a>
				<?php } ?>
			</div>
			<div class="col-xs-8 center">
				<h5>
					<?php echo $date->format('F j, Y'); ?>
				</h5>
			</div>
			<div class="col-xs-2 center">
				<?php if( $next_day < $current_day ){ ?>
					<a href="?date=<?php echo $next_day->format('Y-m-d'); ?>"><i class="date-nav fa fa-arrow-right"></i></a>
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="table-responsive table-inverse spaced-out">
					<table class="table table-sm">
						<thead>
							<tr>
								<th class="center"> Rank </th>
								<th class="center"> Player </th>
								<th class="center"> Score </th>
								<th class="center"> 2 Day </th>
							</tr>
						</thead>
						<tbody>
							<?php foreach( $today->users as $rank => $user ){ ?>
								<tr>
									<td class="center">
										<?php echo $rank + 1; ?>
									</td>
									<td class="center">
										<h5 class="capitalize incorrect">
											<?php echo $user->name; ?>
										</h5>
									</td>
									<td class="center">
										<h3 class="positive">
											<?php echo $user->score; ?>
										</h3>
									</td>
									<td class="center">
										<?php echo display_difference($game->user_score_difference($user->name)); ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>