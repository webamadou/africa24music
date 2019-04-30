<?php get_header(); ?>

<div class="container costum-send">
    <div class="cadre">
		<div class="page-content">
		<?php
		if( have_posts() ):
			while( have_posts() ): the_post(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="col-xs-12 col-sm-12">
						<p><?php the_content(); ?></p>
						<hr>
					<?php endwhile;
				endif;
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>