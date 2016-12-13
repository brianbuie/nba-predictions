<div class="row spaced-out">
	<?php foreach( $game->current->users as $rank => $user ){ ?>
		<div class="col-sm-6 col-md-3">
			<div class="user-image">
				<?php echo $images->get_user_image($user->name); ?>
			</div>
			<h5 class="capitalize incorrect center padding-bottom-sm">
				<?php echo $user->name; ?>
			</h5>
			<h1 class="positive center">
				<?php echo $user->score; ?>
			</h1>
			<p class="center">
				<?php echo display_difference($game->user_score_difference($user->name)); ?>
			</p>
		</div>
	<?php } // foreach user ?>
</div>