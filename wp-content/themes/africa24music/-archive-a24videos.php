<?php get_header();?>
<div class="container">
    <div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
    	<div class="page-content">
    		<h1 class="page-title">clips</h1>
    		<div class="row"><form action="#" class="filter-form">
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
         					<input type="text" name="search" value="" placeholder="recherche" />
  
    					</div>
    				</div>
    			</div>
				<div class="col-xs-12 col-sm-12 filter-list">
    				<ul id="pays-list" class="liste pays">
    					<?php 
    						$c = 1 ;
    						$pays = get_terms('pays');

    						foreach ($pays as $tag) {
                                $term_link = get_term_link( $tag, 'pays' );
                                $test = ucfirst($tag->name);

                                
    							?>
                                <li class="col-xs-6 col-sm-4 col-md-3 pays" data-group = "<?php echo 'categ'.$c ?>"><a href="<?php echo $term_link ; ?>" class="tax-filter" data-term="<?php echo ucfirst($tag->name); ?>" data-tax="pays" ><?php echo $test; ?></a></li>
    					<?php  
    						$c++ ;
    						$c = ($c <= 5)? $c : 1 ;
    					}
    					?>
    				</ul>
    				<ul id="genres-list" class="liste genres">
    					<?php 
    						$c = 1 ;
    						// $genres = get_taxonomies('genres');
    						$genres = a24videos_get_all_terms('genres');
    						foreach ($genres as $tag) {
                                $term_link = get_term_link( $tag, 'genres' );
    							?>

    							<li class="col-xs-6 col-sm-4 col-md-3 genre" data-group = "<?php echo 'categ'.$c ?>"><a href="<?php echo $term_link ; ?>" data-tax="genres" class="tax-filter" data-term="<?php echo ucfirst($tag->name); ?>" ><?php echo ucfirst($tag->name); ?></a></li>
    					<?php 
    						$c++ ;
    						$c = ($c <= 5)? $c : 1 ;
    					 }
    					?>
    				</ul>
				</div>
                <div class="col-xs-12 col-sm-12 filter-choices"> 
                <ul class="list-choices">
<!--                      <li class="genre-choice"><a class="testtag" href="#"></a> </li>
                     <li class="pays-choice"><a class="testtag" href="#"></a> </li> -->

                </ul>
                </div>
    		</form></div>
    		<div id="timeline" class="row home-timeline active videos-container">
			<?php
				$args = array('post_type' => 'a24videos', 'order' => 'DESC', );
				$loop = new WP_Query( $args );
				if( $loop->have_posts() ){
					while ($loop->have_posts()) {
						$loop->the_post();
						get_template_part('contents/content', 'rubriques');
				}//End while loop
			}//End if loop 
			wp_reset_postdata();
			?>
    			<!--<div class="col-xs-12 col-sm-6 col-md-3 shuffle_sizer"></div>-->
    		</div>
    			<!--<div class="see-more"><a href=#>voir plus</a></div>-->
                <div class="loader"> <img src=" <?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="" /></div>
                
                <div class="see-more"><a class="videos-load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">voir plus</a></div>  
    	</div>
    </div>
</div>
<?php get_footer() ?>