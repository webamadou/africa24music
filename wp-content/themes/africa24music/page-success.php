<?php get_header(); ?>
<div class="container costum-send">
    <div class="cadre">
		<div class="page-content" style="margin-top: 35px; border: 1px solid #3d7988;">
		<?php
		if( have_posts() ):
			while( have_posts() ): the_post(); ?>
			<h1 class="page-title">&nbsp;</h1>
			<div class="col-xs-12 col-sm-7">
				<div id="success-message">
					<h3>Merci !</h3>
					<h4>Votre clip à été envoyé <br/>et sera soumis au comité de validation.</h4>
				</div>
				<hr>
			</div>
			<?php endwhile;
		endif; ?>
            <div class="hidden-xs col-sm-5">
                <img class="img-responsive size-full wp-image-3070 alignright" style="    max-height: 390px; max-width: 180px;" src="<?php echo home_url(); ?>/wp-content/uploads/2016/10/Junior_Page-denvoi.jpg" alt="tv-1" />
            </div>
		</div>
	</div>
</div>
<?php get_footer(); ?>