<?php get_header(); ?>
<div class="container costum-send">
    <div class="cadre">
		<div class="page-content">
		<?php
		if( have_posts() ):
			while( have_posts() ): the_post(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="col-xs-12 col-sm-12">
				<div class="a-propos">
					<p align="center"><img class="img-responsive size-full wp-image-3070 alignright" style="    max-height: 390px; max-width: 180px;" src="<?php echo home_url(); ?>/wp-content/uploads/2016/10/Junior_Page-denvoi.jpg" alt="tv-1" /></p>
					<?php the_content(); ?>
				</div>
			<?php endwhile;
		endif; ?>
			</div>
            <!-- <div class="hidden-xs col-sm-5">
                <img src="http://localhost/africa24music/wp-content/uploads/2016/08/A_Propos_A24_MUSIC.gif" class="img-responsive" style="max-height: 500px;">
            </div> -->
		</div>
	</div>
</div>
<?php get_footer(); ?>