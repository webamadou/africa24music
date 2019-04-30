<?php get_header(); ?>
<div class="container costum-send">
    <div class="cadre">
		<div class="page-content">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="col-xs-12 col-sm-7">
				<div class="contact-form">
					<?php wp_login_form(); ?>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>