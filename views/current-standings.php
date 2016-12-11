	<h4 class="center spaced-out"> League Standings </h4>
	<div class="row">
		<?php foreach ($today->current->standings as $conference => $standings) { ?>
			<div class="col-lg-6">
				<div class="table-responsive">
					<table class="table table-sm table-inverse">
						<thead>
							<tr class="bg-primary">
								<th class="right"></th>
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
								<td class="right"><?php echo display_difference($game->team_rank_difference($team['TEAM_ID']), $inverted = true); ?></td>
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