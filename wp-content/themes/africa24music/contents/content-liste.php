<div class="col-xs-12 col-sm-6 col-md-3">
	<div class="video-item-cadre">
		<span class="video-tags">
			<span class="views"><i class="a24-eye"></i> <?php echo wpb_get_videos_views(get_the_ID()); ?></span>
			<!-- <span class="views"><i class="a24-heart"></i> 144</span> -->
		</span>
		<a href="<?php echo get_permalink(); ?>" class="details">
			<span class="country"><?php echo a24videos_get_a_term(get_the_id(), 'genres') ?></span>
			<span class="country"><?php echo a24videos_get_a_term(get_the_id(), 'pays') ?></span>
		</a>
		<div class="plays">
			<span class="play-btn"><img src="<?php echo get_template_directory_uri() ?>/images/play-icon.png" class="img-responsive" alt=""></span>
		</div>
		<div class="video-item"><img src="<?php echo the_post_thumbnail_url('medium'); ?>" alt="" class="img-responsive" /></div>
		<div class="title-cadre">
			<div class="vertical-barre white">&nbsp;</div>
			<div class="video-infos">
				<span class="titre"><?php echo the_title() ?></span>
				<span class="video-artiste"><?php echo get_field( 'artistes' ); ?></span>
			</div>
		</div>
	</div>
</div>