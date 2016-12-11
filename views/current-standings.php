	<?php 
		$current_day = new DateTime();
		$first_day = new DateTime('2016-10-01');
		$prev_day = new DateTime( $date->format('Y-m-d') );
		$prev_day->modify('-1 day');
		$next_day = new DateTime( $date->format('Y-m-d') );
		$next_day->modify('+1 day');
	?>
	<h4 class="center">
		<?php 
		if( $prev_day->format('U') >= $first_day->format('U') ){
			echo '<a href="?date=' . $prev_day->format('Y-m-d') . '"><i class="date-nav fa fa-arrow-left"></i></a>';
		}
		echo $date->format('F j, Y');
		if( $next_day->format('U') < $current_day->format('U') ){
			echo '<a href="?date=' . $next_day->format('Y-m-d') . '"><i class="date-nav fa fa-arrow-right"></i></a>';
		}
		?>
	</h4>
	<div class="row">
		<?php foreach ($today->current->standings as $conference => $standings) { ?>
			<div class="col-lg-6">
				<div class="table-responsive">
					<table class="table table-sm table-inverse">
						<thead>
							<tr class="bg-primary">
								<th class="center"> Rank </th>
								<th class="capitalize"><?php echo $conference; ?>ern Conference </th>
								<th class="center"> Record </th>
								<th class="center"> Win % </th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($standings as $i => $team) { ?>
								<?php if($i < 8){ ?>
									<tr>
								<?php } else { ?>
									<tr class="incorrect">
								<?php } ?>
								<td class="center"><?php echo $i + 1; ?></td>
								<td><?php echo $team['TEAM']; ?></td>
								<td class="center"><?php echo $team['W'] . '-' . $team['L']; ?></td>
								<td class="center"><i><?php echo $team['W_PCT']; ?></i></td>
								</tr>
							<?php } // foreach team ?>
						</tbody>
					</table>
				</div> <!-- /table-responsive -->
			</div> <!-- /col-lg-6 -->
		<? } // foreach conference ?>
	</div> <!-- /row -->