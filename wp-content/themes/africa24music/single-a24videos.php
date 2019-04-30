<?php get_header(); ?>
<div class="container">
    <div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
    	<div class="page-content">
    		<?php if( have_posts() ): ?>
				<?php while( have_posts() ): the_post(); ?>
					<?php get_template_part('contents/content', 'a24videos'); ?>
    			<?php endwhile ?>
    		<?php endif ?>
    		<div class="row advertise">
    			<div class="hidden-xs col-sm-12 pub-full-100"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('w1') ) : endif; ?></div>
    		</div>
    		<div style="text-align: center;">
					<?php 
						if( comments_open() ){ 
							comments_template( '', true); 
						} else {
							echo '<h5 class="text-center">Sorry, Comments are closed!</h5>';
						}
						
					 ?>	
			</div>		 		
    		<div id="similaires" class="row hidden-xs hidden-sm">
    			<h1 class="page-title">vidéos similaires</h1>
    			<!-- <span class="slider-arrows left"><i class="a24-slide-left"></i></span>
    			<span class="slider-arrows right"><i class="a24-slide-right"></i></span> -->
    			<div id="slide-similaire" class="slide-similaired"><ul>
        			<?php
        				$nbrSimilaires = 5 ;//Nombre max vidéo similaires à afficher
	        			$artistes = get_post_custom_values("artistes");
	        			$name = get_post_meta($post->ID, 'artistes', true);
	        			$args = array('post_type' 	=> 'a24videos',
	        						 'order' 		=> 'DESC',
	        						 'post__not_in' => array($post->ID),
	        						 'showposts' 	=> 15,
	        						 'meta_query' 	=> array(array(
	        						                              'key' 	=> 'artistes', 
	        						                              'value' 	=> $name, 
	        						                              'compare' => 'LIKE',
								        							) 
	        						 						)
	        						);

	        		$loop = new WP_Query( $args );
					if( $loop->have_posts() ){ 
	                ?>
		            <?php
							while ($loop->have_posts()) {
								--$nbrSimilaires ;//On décrémente le nombre de vidéos similaires
								$loop->the_post();
		        				get_template_part('contents/content', 'similaires');
		        			}
		            ?>
		            <?php
					}
					if( $nbrSimilaires > 0 ) {
			     		$taxterms = wp_get_object_terms( $post->ID, 'genres', array('fields' => 'names'));
						$args = array('post_type' => 'a24videos', 
						              'order' => 'DESC', 
						              'post__not_in' => array($post->ID), 
						              'showposts' => $nbrSimilaires,
						              'tax_query' => array(array('taxonomy' => 'genres', 
						                                         'field'    => 'name', 
						                                         'terms'    => $taxterms, 
						                                         'operator' => 'IN', )
						              						)
                                  );
						$loop = new WP_Query( $args );
						if( $loop->have_posts() ){
							while ($loop->have_posts()) {
								--$nbrSimilaires ;//On décrémente le nombre de vidéos similaires
								$loop->the_post();
		        				get_template_part('contents/content', 'similaires');
		        			}
						}
					}
					if( $nbrSimilaires > 0 ) {
			     		$taxterms = wp_get_object_terms( $post->ID, 'pays', array('fields' => 'names'));
						$args = array('post_type' 		=> 'a24videos', 
						              'order' 			=> 'DESC', 
						              'post__not_in'	=> array($post->ID), 
						              'showposts' 		=> $nbrSimilaires,
						              'tax_query' 		=> array(array('taxonomy' 	=> 'pays', 
						                                         'field'    		=> 'name', 
						                                         'terms'    		=> $taxterms, 
						                                         'operator' 		=> 'IN',
						                                        	)
						              							)
                                  );
						$loop = new WP_Query( $args );
						if( $loop->have_posts() ){
							while ($loop->have_posts()) {
								$loop->the_post();
		        				get_template_part('contents/content', 'similaires');
		        			}
						}
					}
					wp_reset_postdata();
					?>
        		</ul></div>
    		</div>
    	</div>
    </div>
</div>
<script>
	/*=====================================================================*/
	var carousel = jQuery("#slide-similaire").flipster({
	                                            style: 'flat',
	                                            spacing: -0.3,
	                                            nav: false,
	                                            click: true,
	                                            autoplay: 2000,
	                                            buttons:   'custom',
	                                            buttonPrev:   '',
	                                            buttonNext:   '',
	                                            loop:   true,
	                                            start:   'center',
	                                            scrollwheel: false,
	                                            touch: true,
	                                        });
</script>
<?php get_footer(); ?>