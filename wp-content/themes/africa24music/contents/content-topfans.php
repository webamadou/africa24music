<div class="col-xs-12 col-sm-6 col-md-3">
	<div class="video-item-cadre">
		<span class="video-tags">
			<span class="views"><i class="a24-eye"></i> <?php echo wpb_get_videos_views(get_the_ID()); ?></span>
			<!-- <span class="views"><i class="a24-heart"></i> 144</span> -->
		</span>
		<span class="ranke"> <b><?php echo $i ?></b> </span>
		<div class="video-item">
			<a href="<?php echo get_permalink(); ?>" class="details">
				<img src="<?php echo the_post_thumbnail_url('medium'); ?>" alt="<?php echo 'africa24music-'.get_the_title(); ?>" title="<?php echo get_the_title(); ?>" class="img-responsive" />
			</a>
		</div>
		<div class="title-cadre">
			<div class="vertical-barre red">&nbsp;</div>
			<div class="video-infos">
				<span class="titre"><?php echo the_title() ?></span>
				<span class="video-artiste"><?php echo get_field( 'artistes' ); ?></span>
			</div>
		</div>
	</div>
</div>