<?php
/**
 * Single video page
 * page of a single vidoe
 * Template Africa24Music
 */
	$currentPaysTagSlug = a24videos_get_terms_list( $post->ID, 'pays','slug') ;
	$currentPaysTerm    = get_term_by( 'slug', @$currentPaysTagSlug[0], 'pays' );
	$currentPaysLink    = get_field('flag', @$currentPaysTerm->taxonomy.'_'.@$currentPaysTerm->term_id);
?>
<h1 class="page-title"><?php echo get_field( 'artistes' ); ?> - <?php the_title(); ?></h1>
<div class="row">
	<div class="col-xs-12 video-details">
		<div class="video-cadre">
			<div class="embed">
				<?php the_content() ?>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 no-padding"><!-- PLAYLIST TITLE  -->
		    <div class="playlist-video-details sub-title playlist">
		        <span class="oblique red">&nbsp;</span>
		        <div class="search-query">
		            <div class="col-xs-1 video-flag">
		            <?php $flag = $currentPaysLink != ''?$currentPaysLink:get_template_directory_uri().'/images/empty.png' ?>
		                <img src="<?php echo $flag ?>" class="img-responsive" alt="<?php echo 'africa24music-pays-'.$currentPaysTagSlug[0] ?>">
		            </div>
		            <div class="col-xs-9 title-n-artiste">
		                <h3 class="col-xs-12 currentTitle"><?php echo the_title() ?></h3>
		                <div class="col-xs-12 title currentArtiste"> <?php echo a24m_excerpt( get_field( 'artistes' ),60) ?> </div>
		            </div>
		        </div>
		    </div>
		</div>
		<div class="col-xs-12 col-sm-7">
			<div class="artist-pix">
				<p><img src="<?php echo the_post_thumbnail_url('thumbnail'); ?>" alt="<?php echo 'africa24music-'.get_the_title(); ?>" title="<?php echo get_the_title(); ?>" class="img-responsive"></p>
			</div>
			<div class="details">
				<div class="description">
					<?php echo get_field( 'description' ); ?>
				</div>
				<div class="video-date">Date de mise en ligne <?php the_date(); ?></div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-5">
			<div class="col-xs-12 col-sm-6">
				<div class="socialisations col-xs-6">
					<ul>
						<li class="col-xs-2 no-link">
							<a href="#"><i class="a24-eye2"></i><br/>(<?php echo wpb_get_videos_views($post->ID) ?>)</a>
						</li>
						<li class="col-xs-2 scrool-comments">
							<a href="#"><i class="a24-commentary"></i><br/>(<?php echo get_comments_number() ?>)</a>
						</li>
						<li class="col-xs-2">
							<!-- <a href="#"><i class="a24-share"></i><br/>Share</a> -->
							<?php echo do_shortcode('[addtoany]'); ?>
 						</li>
					</ul>
				</div>
				<div class="ratings col-xs-6">
					<div class="starsavis">
						<span class="vote-title">Votez pour cette vidéo:</span>
						<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
						<?php echo ( is_user_logged_in() )?'':'<p class="log2rate"> <a href="'.home_url().'/login">Se connecter</a> pour voter </p>' ?>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 tags">
				<?php echo a24videos_get_terms($post->ID, 'genres') ?> <?php echo a24videos_get_terms( $post->ID, 'pays'); ?> <?php echo a24videos_get_terms( $post->ID, 'video_tags'); ?>
			</div>
		</div>
	</div>
</div>
<script>
	var that = jQuery('.currentArtiste');
	if(that.length){
	    var textLength = that.html().length ;
	    if( textLength < 30 ){
	        that.css('font-size', '30%');
	    } else {
	        var div = textLength % 30 ;
	        that.css('font-size', div+'%');
	    }
	}
</script>