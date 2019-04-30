<?php get_header();?>
<div class="container">
    <div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
    	<div class="page-content">
    		<h1 class="page-title">Vidéos populaires</h1>
            <div class="row"><form id="filter-search" action="<?php echo home_url( '/' ); ?>" method="get" role="search" class="filter-form">
    			<div class="filter-order">
    				<div class="col-xs-12 col-sm-6 filter-menu">
    					<ul>
        					<li class="genre-link" target-link="genres-list">
        						<a href="#">Genre </a>
        					</li>
        					<li class="pays-link" target-link="pays-list">
        						<a href="#">Pays</a>
        					</li>
        				</ul>
    				</div>
    				<div class="col-xs-12 col-sm-6 order-menu">
    					<div class="order">
        					<div class="select-order">
                                <select class="tri-videos" id="">
                                    <option class="choix-tri" value="">Afficher par</option>
                                    <option class="choix-tri" value="popular">les plus populaires</option>
                                    <option class="choix-tri" value="rated">les plus votées</option>
                                    <option class="choix-tri" value="az"> De A-Z </option>
                                    <option class="choix-tri" value="za"> De Z-A </option>
                                </select>
	        				</div>
                            <input class="search-field" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="Recherche" />                            
                            <input type="hidden" name="post_type" value="a24videos" />
    					</div>
    				</div>
    			</div>
				<div class="col-xs-12 col-sm-12 filter-list">
                    <ul id="pays-list" class="liste pays">
                        <div class="col-xs-6 col-sm-4 col-md-3">
                            <?php 
                                $c        = 1 ;
                                $pays     = get_terms('pays', array('orderby' => 'name')); $total = count($pays) ;
                                $nbrLines = ceil($total / 4) ; 
                                foreach ($pays as $tag) {
                                    $term_link = get_term_link( $tag, 'pays');
                                    $test = ucfirst($tag->name);

                                    ?>
                                    <li class="pays" data-group = "<?php echo 'categ'.$c ?>"><a href="<?php echo $term_link ; ?>" class="tax-filter" data-term="<?php echo ucfirst($tag->name); ?>" data-tax="pays" ><?php echo $test; ?></a></li>
                            <?php  
                                $c++ ;
                                if($c > $nbrLines){
                                    echo '</div><div class="col-xs-6 col-sm-4 col-md-3">';
                                    $c = 1 ;
                                }
                            }
                            ?>
                        </div>
                    </ul>
                    <ul id="genres-list" class="liste genres">
                        <div class="col-xs-6 col-sm-4 col-md-3">
                            <?php 
                                $c        = 1 ;
                                $genres   = get_terms('genres', array('orderby' => 'name')); $total = count($genres) ;
                                $nbrLines = ceil($total / 4);
                                foreach ($genres as $tag) {
                                    $term_link = get_term_link( $tag, 'genres' );
                                    ?>

                                    <li class="genre" data-group = "<?php echo 'categ'.$c ?>"><a href="<?php echo $term_link ; ?>" data-tax="genres" class="tax-filter" data-term="<?php echo ucfirst($tag->name); ?>" ><?php echo ucfirst($tag->name); ?></a></li>
                            <?php  
                                $c++ ;
                                if($c > $nbrLines){
                                    echo '</div><div class="col-xs-6 col-sm-4 col-md-3">';
                                    $c = 1 ;
                                }
                             }
                            ?>
                        </div>
                    </ul>
				</div>
                <div class="col-xs-12 col-sm-12 filter-choices"> 
                <ul class="list-choices">
                </ul>
                </div>

    		</form></div>
            <div id="timeline" class="row home-timeline active popular videos-container">

			<?php
				$args = array('post_type' => 'a24videos',
                              
                            'meta_key'          => 'wpb_a24videos_count',
                            'orderby'            => 'meta_value_num',
                            'order' => 'DESC',
                            //'posts_per_page'    => 12
                               );
				$loop = new WP_Query( $args );
                $maxpages = $loop->max_num_pages;

				if( $loop->have_posts() ){
					while ($loop->have_posts()) {
						$loop->the_post();
						get_template_part('contents/content', 'rubriques');
				}//End while loop
                    if ($maxpages == 1) {
                    ?>
                            <script>
                            jQuery(document).ready(function($) {
                                $('.see-more').hide();
                            });
                            </script>
                    <?php
                            }else {
                    ?>
                    <script>
                    jQuery(document).ready(function($) {
                        $('.see-more').show();
                    });
                    </script>
                    <?php
                        }

			}//End if loop 
			wp_reset_postdata();
			?>
    		</div>
                <div class="loader"> <img src=" <?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="" /></div>
                <div class="see-more"><a class="videos-load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">voir plus</a></div>  
    	</div>
    </div>
</div>
<?php get_footer() ?>