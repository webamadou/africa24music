<?php get_header(); ?>
	<div id="primary" class="container">
		<div class="cadre">
			<section class="error-404 not-found">
				<head class="page-header">
					<h1 class="page-title">CONTENU INTROUVABLE</h1>
					<p style="text-align: center;"><img src="/wp-content/uploads/2016/10/Page_404_2.gif" class="img-responsive" style="max-height: 500px"></p>
				</head>
					<div id="search-form-bloc" class="col-xs-12">
						<h4>Vous pouvez faire une autre recherche !</h4>
						<?php get_search_form(); ?>
					</div>
				<div class="widget widget_categories">
	        		<div id="item1" class="home-timeline active">
	                    <div class="row">
							<!-- <h4>Voilà quelque suggestion</h4> -->
		        			<?php
		        				$args = array( 'post_type'		=> 'a24videos',
		        				               'posts_per_page' 	=> 8,
		        				               'meta_key' 			=> 'wpb_a24videos_count',
		        				               'orderby' 			=> 'rand',
		        				            ) ;
		        				$loop = new WP_Query( $args );
		        				if( $loop->have_posts() ){
		        					while ($loop->have_posts()) {
		        						$loop->the_post();
		        						get_template_part('contents/content', 'rubriques');
								}//End while loop
		        			}//End if loop 
							wp_reset_postdata();
		        			?>         
		                </div>
	        		</div>
				</div>
			</section>
		</div>
	</div>
<?php get_footer(); ?>