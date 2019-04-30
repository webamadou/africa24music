<?php get_header(); ?>
<div class="container costum-send">
    <div class="cadre">
		<div class="page-content">
		<?php
		if( have_posts() ):
			while( have_posts() ): the_post(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="col-xs-12 col-sm-12">
					<?php the_content(); ?>
				<!-- <p style="text-align: center;">Vous êtes artiste et souhaitez voir votre clip diffusé à l'international à la télévision ?</p>
				<p style="text-align: center;"><img class="img-responsive alignnone size-full wp-image-3056" style="max-height: 500px;" src="http://music.africa24tv.com/wp-content/uploads/2016/10/Animation_2D_A24-MUSIC.gif" alt="animation_2d_a24-music" /></p>
				<p>
					La chaîne Africa24Music souhaite donner aux artistes africains et afrocarribéens la possibilité d’être diffusés sur tous ses réseaux ! Inscrivez-vous pour être informé du lancement de l'offre !
				</p>
				<p style="text-align: center;">[contact-form-7 id="3059" title="Send video"]</p> -->
			</div>
			<?php endwhile;
		endif;
				?>
		</div>
	</div>
</div>
<?php get_footer(); ?>