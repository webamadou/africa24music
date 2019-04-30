<h1 class="page-title"><?php echo get_field( 'artistes' ); ?> - <?php the_title(); ?></h1>
<div class="row">
	<div class="col-xs-12 video-details">
		<div class="video-cadre">
			<div class="embed">
				<?php the_content() ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-7">
			<div class="artist-pix">
				<p><img src="<?php echo the_post_thumbnail_url('thumbnail'); ?>" alt="" class="img-responsive"></p>
			</div>
			<div class="details">
				<h1 class="video-title"> <?php the_title(); ?></h1>
				<div class="artist-name"><a href="#"><?php echo get_field( 'artistes' ); ?></a></div>
				<!-- < ?php a24videos_get_terms( $post->ID, 'genes', '',' ' ); ?><br>
				< ?php a24videos_get_terms( $post->ID, 'pays', '', ' ' ); ?><br> -->
				<div class="description">
					<?php echo get_field( 'description' ); ?>
				</div>
				<div class="video-date">Mis en ligne le <?php the_date(); ?></div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-5">
			<div class="col-xs-12 col-sm-6">
				<div class="ratings">
					<div class="starsavis">
						<span class="vote-title">Votez pour cette vidéo:</span>
						<!-- <input class="rating" data-disabled="false" data-show-caption="false" data-show-clear="false" data-size="xs" value="3.5" data-filled="a24-heart" data-empty="a24-heart" /> -->
						<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
					</div>
				</div>
				<div class="socialisations">
					<ul>
						<!-- <li class="col-xs-2">
							<a href="#"><i class="a24-heart"></i><br/>(109 767)</a>
						</li>
						<li class="col-xs-2">
							<a href="#"><i class="a24-broken-heart"></i><br/>(0)</a>
						</li> -->
						<li class="col-xs-2">
							<a href="#"><i class="a24-heart"></i><br/>(10767)</a>
						</li>
						<li class="col-xs-2">
							<a href="#"><i class="a24-commentary"></i><br/>(14)</a>
						</li>
						<li class="col-xs-2">
<!-- 							<a href="#"><i class="a24-share"></i><br/>Share</a>
 -->	
<?php echo do_shortcode('[addtoany]'); ?>

 					</li>
					</ul>
				</div>
									<?php 
						if( comments_open() ){ 
							comments_template(); 
						} else {
							echo '<h5 class="text-center">Sorry, Comments are closed!</h5>';
						}
						
					 ?>	
			</div>
			<div class="col-xs-12 col-sm-6 tags">
				<?php echo a24videos_get_terms($post->ID, 'genres') ?> <?php echo a24videos_get_terms( $post->ID, 'pays'); ?> <?php echo a24videos_get_terms( $post->ID, 'video_tags'); ?>
			</div>
		</div>
	</div>
</div>