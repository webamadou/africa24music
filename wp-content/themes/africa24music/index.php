<?php get_header(); ?>
	<div id="bilboard">
		<div class="hidden-xs" id="wowslider-container1">
			<?php echo do_shortcode('[smartslider3 slider=2]'); ?>
		</div>
	</div>
    <div class="container">
        <div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
        	<div class="page-content">
	    		<div class="row advertise">
	    			<div class="hidden-xs col-sm-12 pub-full-100"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('w1') ) : endif; ?></div>
	    		</div>
        		<div class="row home-timeline-menu">
        			<ul class="">
        				<li rel="item1" color="#ED3227" class="col-xs-4 col-sm-4 active red">
        					<span class="timeline-menu-cadre reds"></span>
        					<span class="link"><a href="#">dernières vidéos</a></span>
        				</li>
        				<li rel="item2" color="#f8ed26" class="col-xs-4 col-sm-4 yellow">
        					<span class="timeline-menu-cadre yellows"></span>
        					<span class="link"><a href="#">découvertes</a></span>
        				</li>
        				<li rel="item3" color="#369cc6" class="col-xs-4 col-sm-4 blue">
        					<span class="timeline-menu-cadre blues"></span>
        					<span class="link"><a href="#">les + vues</a></span>
        				</li>
        			</ul>
        		</div>
        		<div id="item1" class="home-timeline active">
                    <div class="row">
        			<?php
        				$args = array('post_type' => 'a24videos', 'posts_per_page' => 8, 'order' => 'DESC', );
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
        			<div class="see-more"><a href="<?php echo esc_url( home_url( '/' ) ); ?>a24videos">Toutes les dernières vidéos</a></div>
        		</div>
        		<div id="item2" class="home-timeline">
                    <div class="row">
            			<?php
            				$args = array('post_type'           => 'a24videos',
            				              'tax_query'           => array(
                                                                        array(
                                                                            'taxonomy'  => 'rubriques', 
                                                                            'field'     => 'slug', 
                                                                            'terms'     => 'decouvertes',
                                                                        ),
                                                                    ),
            				              'posts_per_page' 	=> 8,
            				              'order' 			=> 'RAND', 
            				            );

            				$loop = new WP_Query( $args );
            				if( $loop->have_posts() ){
            					while ($loop->have_posts()) {
            						$loop->the_post();
            						get_template_part('contents/content', 'decouvertes');
    							}//End while loop
            				}//End if loop 
    					   wp_reset_postdata();
            			?>         
                    </div>
        			<div class="see-more"> <a href="<?php echo esc_url( home_url('/')); ?>rubriques/decouvertes">Toutes les vidéos découvertes</a> </div>
        		</div>
        		<div id="item3" class="home-timeline">
                    <div class="row">
        			<?php
        				$args = array( 'post_type'		=> 'a24videos',
        				               'posts_per_page' 	=> 8,
        				               'meta_key' 			=> 'wpb_a24videos_count',
        				               'orderby' 			=> 'meta_value_num',
        				               'order' => 'DESC'
        				            ) ;
        				$loop = new WP_Query( $args );
        				if( $loop->have_posts() ){
        					while ($loop->have_posts()) {
        						$loop->the_post();
        						get_template_part('contents/content', 'populaires');
							}//End while loop
        				}//End if loop 
					wp_reset_postdata();
        			?>         
                    </div>
        			<div class="see-more"><a href="<?php echo esc_url( home_url( '/' ) ); ?>populaires">Toutes les vidéos les + vues</a></div>
        		</div>
                <?php
                    $args = array('post_type' => 'post', 'posts_per_page' => 4, 'order' => 'DESC', );
                    $loop = new WP_Query( $args );
                    if( $loop->have_posts() ){
                ?>
        		<h1 class="slim-title"><a href="<?php echo esc_url( home_url('/') ); ?>news">NEWS</a></h1>
        		<div id="news" class="row">
    			<?php
    					while ($loop->have_posts()) {
    						$loop->the_post();
    				?>
	    				<div class="col-xs-12 col-sm-3">
	    					<div class="article">
	    						<div class="article-img"><a href="<?php echo get_permalink(); ?>">
	    					<?php if(has_post_thumbnail())
	    							echo '<img src="'.get_the_post_thumbnail_url( null, 'post-thumbnail' ).'" class="img-responsive" alt="africa24music'.get_the_title().'" title="'.get_the_title().'">' ;
	    						  else
	    							echo '<img src="'.get_template_directory_uri().'/images/emty_thumbnail.png" class="img-responsive" alt="africa24music'.get_the_title().'" title="'.get_the_title().'">' ;
	    						?>
	    						</a></div>
	    						<h2><a href="<?php echo get_permalink(); ?>"><?php echo the_title() ?></a></h2>
	    						<div class="hidden-xs col-md-12 extrait">
	    							<p><?php echo a24m_excerpt(get_the_excerpt(),35); ?></p>
	    						</div>
	    						<div class="hidden-xs tags">
	    							<b class="a24-eye2"></b> <?php echo wpb_get_videos_views(get_the_ID()) ?> 
	    							<!--<span class="a24-heart"></span> 144-->
	    						</div>
	    					</div>
	    				</div>
    				<?php
					}//End while loop
                ?>
        		</div>
                <?php
                    }//End if loop 
                    wp_reset_postdata();
                ?>
        		<div id="top-fan" class="hidden-xss col-sm-12">
        			<div class="top-fan">
        				<h1>Top fans</h1>
        				<?php
                            $args = array( 'post_type'          => 'a24videos',
                                           'posts_per_page'     => 5,
                                           'meta_key'           => 'ratings_users',
                                           'orderby'            => 'meta_value_num',
                                           'order'              => 'DESC',
                                        ) ;
        					$loop = new WP_Query( $args );
        					$i = 0 ;
        					if($loop->have_posts()){
        						// echo $loop->post_count ;
        						while ($loop->have_posts()) {
        							$loop->the_post(); ++$i ;
    								// echo the_title();
        							?>
			        				<div class="top-item" style="background: url('<?php echo get_the_post_thumbnail_url( null, 'large' )?>'); background-size: 670px 390px; background-position: center center; background-repeat: no-repeat"><a href="<?php echo get_permalink(); ?>" title="<?php echo the_title(); ?>">
				        				<span class="ranke"> <b><?php echo $i ?></b> </span>
			        					<div class="top-video-infos">
			        						<span class="titre"><?php echo the_title(); ?></span>
			        						<span class="video-artiste"><?php echo get_field( 'artistes' ); ?></span>
			        					</div>
				        				<div class="video-item">&nbsp;</div>
				        			</a></div>
				        		<?php }//END WHILE
	        				}//IF HAVE_POST
							wp_reset_postdata();
	        				?>
        			</div>
        			<!-- <div class="see-more"><a href="< ?php echo esc_url( home_url( '/' ) ); ?>topfan">voir plus</a></div> -->
        		</div>
        		<div class="row advertise">
                    <div class="hidden-xs col-sm-4 pub">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('w2') ) : endif; ?>
                        </div>
                    <div class="hidden-xs col-sm-4 pub">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('w3') ) : endif; ?>
                    </div>
                    <div class="hidden-xs col-sm-4 pub">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('w4') ) : endif; ?>
                    </div>
        		</div>
        		<h1 class="slim-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>playlists">playlists</a></h1>
                <div id="carousel" class="carousel-wrapper">
                    <ul class="flip-items">
                        <?php
                            $terms = a24videos_get_all_terms('playlist');
                            $l = 0 ;
                            foreach ($terms as $datas) {
                                ++$l ;
                                $taxonomy = $datas->taxonomy;
                                $term = $datas->term_id;
                                $image = get_field('playlist_image',  $taxonomy.'_'.$term );
                        ?>
                                <li>
                                    <a href="<?php echo get_term_link( $datas ) ?>">
                                    <?php
                                        if( !empty($image) ){
                                            echo '<img src="'.$image['url'].'" alt="'.$datas->name.'"  width="300px" />' ;
                                        }
                                    ?>
                                    </a>
                                    <span class='carousel-title'><?php echo $datas->name ?></span>
                                    <span class='shadow'></span>
                                </li>
                        <?php
                                if($l >= 5)
                                    break ;
                            }
                        ?>
                    </ul>
                </div>
        		<div class="see-more"><a href="<?php echo esc_url( home_url( '/' ) ); ?>playlists">Toutes les playlists</a></div>
        	</div>
        </div>
    </div>
    <script>

        //=======Carousel settings========
        var carousel = jQuery("#carousel").flipster({
                                                    style: 'carousel',
                                                    spacing: -0.3,
                                                    nav: false,
                                                    buttons:   'custom',
                                                    buttonPrev:   '',
                                                    buttonNext:   '',
                                                    loop:   true,
                                                    scrollwheel: false,
                                                });
    </script>
<?php get_footer(); ?>