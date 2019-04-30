<?php get_header(); ?>
<div class="container costum-send">
    <div class="cadre">
		<div class="page-content">
		<?php
		if( have_posts() ):
			while( have_posts() ): the_post(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="col-xs-12 col-sm-7">
				<div class="contact-form">
					<?php the_content(); ?>
				</div>
				<hr>
			<?php endwhile;
		endif; ?>
			</div>
            <div class="hidden-xs col-sm-5">
                <img src="/wp-content/uploads/2016/10/Junior_Contact.png" class="img-responsive" style="max-height: 500px;">
            </div>
		</div>
	</div>
</div>
<?php get_footer(); ?>