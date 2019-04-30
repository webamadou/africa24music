<?php get_header(); ?>
<div class="container costum-send">
    <div class="cadre">
		<div class="page-content">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="col-xs-12 col-sm-12">
				<div class="contact-form">
				<?php
				if( have_posts() ){
					while( have_posts() ){ the_post();
						echo "<h4 style='text-align: center'>Veuillez vous authentifier pour pouvoir envoyer votre vidéo</h4>";
						echo the_content();
					}
				}
				?>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>