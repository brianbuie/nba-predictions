<div class="user-container spaced-out">
	<h5 class="center capitalize"><?php echo $user->name;?></h5>
	<h3 class="center positive spaced-out"><?php echo $user->score . ' points';?></h3>
	<div class="row">
		<?php foreach ($user->picks as $conference => $standings){ ?>
			<div class="col-lg-6">
				<div class="table-responsive table-inverse">
					<table class="table table-sm">
						<thead>
							<tr>
								<th class="center"> Rank </th>
								<th class="capitalize"> <?php echo $conference ?></th>
								<th colspan="2" class="center"> Predicted </th>
								<th colspan="2" class="center"> Current </th>
								<th colspan="2" class="center"> Points </th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($standings as $i => $team) { ?>
								<?php if($team['placement']['correct_%'] == 1){ ?>
									<tr class="correct">
								<?php } else { ?>
									<tr class="incorrect">
								<?php } ?>
									<td class="center">
										<?php echo $i; ?>
									</td>
									<td>
										<?php echo $game->current->team_actual($team['team'], 'ABRV'); ?>
									</td>
									<td class="center border-left">
										<?php echo $team['wins'] . '-' . (82 - intval($team['wins'])); ?>
									</td>
									<td class="center">
										<i><?php echo $team['w_pct']['predicted']; ?></i>
									</td>
									<td class="center border-left">
										<?php echo $game->current->team_actual($team['team'], 'W') . '-' . $game->current->team_actual($team['team'], 'L'); ?>
									</td>
									<td class="center">
										<i><?php echo $game->current->team_actual($team['team'], 'W_PCT'); ?></i>
									</td>
									<td class="center border-left">
										<strong class="positive"><?php echo $team['score']; ?></strong>
									</td>
									<td class="center">
										<?php echo display_difference($game->pick_score_difference($user->name, $conference, $i)); ?>
									</td>
								</tr>
							<?php } // foreach team ?>
						</tbody>
					</table>
				</div>
			</div> <!-- /column -->
		<?php } // foreach division ?>
	</div> <!-- /row -->
</div> <!-- /user-container -->