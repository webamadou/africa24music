<?php get_header();?>
<div class="container">
    <div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
    	<div class="page-content">
    		<h1 class="page-title">TOP FANS</h1>
    		<div id="timeline" class="row home-timeline active">
			<?php
				$args = array( 'post_type'		=> 'a24videos',
				               'meta_key' 			=> 'ratings_average', 'orderby' => 'meta_value_num', 'order' => 'DESC',
				            ) ;
				//Top fan par nombre de vus
				$args = array( 'post_type'			=> 'a24videos',
				               'meta_key' 			=> 'wpb_a24videos_count',
				               'orderby' 			=> 'meta_value_num',
				               'order' => 'DESC'
				            ) ;
				$loop = new WP_Query( $args );
				$i = 0 ;
				if( $loop->have_posts() ){
					while ($loop->have_posts()) { ++$i ;
						$loop->the_post();
			?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="video-item-cadre">
							<span class="video-tags">
								<span class="views"><i class="a24-eye"></i> <?php echo wpb_get_videos_views(get_the_ID()); ?></span>
								<span class="views"><i class="a24-heart"></i> 144</span>
							</span>
							<span class="ranke"> <b><?php echo $i ?></b> </span>
							<div class="video-item">
								<a href="<?php echo get_permalink(); ?>" class="details">
									<img src="<?php echo the_post_thumbnail_url('medium'); ?>" alt="" class="img-responsive" />
								</a>
							</div>
							<div class="title-cadre">
								<div class="vertical-barre red">&nbsp;</div>
								<div class="video-infos">
									<span class="titre"><?php echo the_title() ?></span>
									<span class="video-artiste"><?php echo get_field( 'artistes' ); ?></span>
								</div>
							</div>
						</div>
					</div>
			<?php
				}//End while loop
			}//End if loop 
			wp_reset_postdata();
			?>
    		</div>
    	</div>
    </div>
</div>
<?php get_footer() ?>