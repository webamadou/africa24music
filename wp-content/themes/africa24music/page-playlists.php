<?php get_header(); ?>
<div class="container">
    <div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
    	<div class="page-content page-playlists">
    		<h1 class="page-title">playlists</h1>
            <div id="carousel" class="hidden-xs carousel-wrapper">
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
                                        echo '<img src="'.$image['url'].'" alt="'.$datas->name.'" title="'.$datas->name.'"  width="300px" />' ;
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
            <div class="hidden-xs live_scrool showout" target="playlist-mozaik"><h3><a href="#playlist-mozaik">Découvrez toutes les playlists</a></h3></div>
            <div class="hidden-xs col-sm-12 pub-full-100 row advertise"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('w1') ) : endif; ?></div>
    		<div class="row"><form action="" class="filter-form">
				<div class="col-xs-12 col-sm-12 filter-list">
    				<ul id="pays-list" class="liste pays">
    					<?php 
    						$c = 1 ;
    						$pays = get_terms('pays');
    						// var_dump($pays) ;
    						foreach ($pays as $tag) {
    							?>
    							<li class="col-xs-6 col-sm-4 col-md-3 pays" data-group = "<?php echo 'categ'.$c ?>"><a href="#"><?php echo $tag->name; ?></a></li>
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
    							?>
    							<li class="col-xs-6 col-sm-4 col-md-3 genre" data-group = "<?php echo 'categ'.$c ?>"><a href="#"><?php echo $tag->name; ?></a></li>
    					<?php 
    						$c++ ;
    						$c = ($c <= 5)? $c : 1 ;
    					 }
    					?>
    				</ul>
				</div>
    		</form></div>
            <div id="timeline" class="row home-timeline active">
                <div id='playlist-mozaik'>
                    <ul class="row">
                    <?php
                    $terms = get_terms( 'playlist', array('hide_empty' => false, ) );
                    foreach ($terms as $datas) {
                            $taxonomy = $datas->taxonomy;
                            $term = $datas->term_id;
                                echo '<li class="col-xs-12 col-sm-4 col-md-3">
                                        <div class="playlist-mozaik-content">
                                            <a href="'.home_url('/').'playlists/'.$datas->slug.'/">' ;
                                            $author = (get_field("author", $taxonomy."_".$term)) ;//On récup les infos de l'auteur
                                            // var_dump($author) ;
                                            $image = get_field("playlist_image",  $taxonomy."_".$term );
                                            if( !empty($image) ){ ?>
                                                <img src="<?php echo $image["url"]; ?>" alt="<?php echo $image["alt"]; ?>" class="img-responsive" />
                                            <?php } else {
                                                echo '<img src="'.get_template_directory_uri().'images/empty.png" alt="'. $image["alt"].'" class="img-responsive" />' ;
                                            } echo'</a>
                                                <span class="playlist-title">'.$datas->name.'</span>
                                                <a href="'.home_url('/').'playlists/'.$datas->slug.'/" class="playlist-details">Créé par '.$author['nickname'].'</a href="'.get_term_link( $datas ).'">
                                                <span class="playlist-rates"><!--input class="rating" data-disabled="true" data-show-caption="false" data-show-clear="false" data-size="xs" value="5" data-filled="a24-heart" data-empty="a24-heart" /--></span>
                                        </div>
                                     </li>' ;
                    } ?>
                  </ul>
                </div>
            </div>
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