<?php get_header(); 
$content_type = array('a24videos' => 'Vidéo' , 'post' => 'News');
$playlistArray = array() ;
$c = $py = $p = 0;//On définie les compteurs pour les clips playlist et post

//A second layer of security to avoid searching on less than 3 caracters
$query = get_search_query();
// if the first & last char is space, rip them
$query = trim($query);
// if  chars count is less than  3, redirect them to homepage
if (strlen($query)<3){
    wp_redirect( home_url() ); 
    exit; 
}
?>
<div class="container">
    <div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
        <div class="page-content search-page">
            <h1 class="page-title">recherche</h1>
            <div id="search-form-bloc" class="col-xs-12"> <?php get_search_form(); ?> </div>
            <div class="sub-title">
                <span class="oblique blue">&nbsp;</span>
                <div class="search-query">
                    <div class="col-xs-12 col-sm-10 title"> <?php echo  a24videos_get_search_nbr_results( $wp_query )?> </div> 
                    <div class="col-xs-12 col-sm-2 nbr-result">&nbsp;</div>
                </div>
            </div>
            <div id="categs-list" class="col-xs-12">
                <ul>
                    <li id="tab_all"><a href="#" target="all" class="active">Tous</a></li>
                    <li id="tab_a24videos"><a href="#" target="a24videos">Clips</a></li>
                    <li id="tab_playlists"><a href="#" target="playlists">Playlists</a></li>
                    <li id="tab_posts"><a href="#" target="posts">News</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-9 no-padding">
            <?php if ( have_posts() ) : ?>
                <div id="search-result-id" class="col-xs-12">
                    <ul id="list_playlists"><!-- playlist resultst  -->
                    <h3 id="title_playlists" class="search-bloc-title">playlists</h3>
                        <?php
                        while ( have_posts() ) {/*list plalist results*/ 
                            the_post();
                            $description  = a24videos_get_a_term(get_the_id(), 'playlist', 'description') ;
                            $playlist  = a24videos_get_a_term(get_the_id(), 'playlist', 'term_id') ;
                            if($playlist != null){
                                ++$py ;
                                $playlist_name  = a24videos_get_a_term(get_the_id(), 'playlist') ;
                                $link  = a24videos_get_a_term( get_the_id(), 'playlist', 'slug' ) ;
                                $image = get_field('playlist_image',  'playlist_'.$playlist );
                                $author = get_field('author',  'playlist_'.$playlist );
                                if(in_array($playlist_name, $playlistArray)) {//Skip if name already in playlist array
                                    continue ;}
                        ?>
                            <li class="col-xs-12 <?php echo ($py >= 3)?'shadow-py':''; ?>" rel="playlist">
                                <div class="col-xs-12">
                                <span class="rslt-thumbnail">
                                    <a href="<?php echo home_url( '/' ); ?>playlists/<?php echo $link ?>" rel="bookmark">
                                        <?php if( !empty($image) ){ ?>
                                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                                        <?php } else { ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>images/empty_thumbnail.png" alt="<?php echo $image['alt']; ?>" />
                                        <?php } ?>
                                    </a>
                                </span>
                                <!-- </div> <div class="col-xs-10" style="padding-top: 4%"> -->
                                    <strong class="entry-title">
                                        <a href="<?php echo home_url( '/' ); ?>playlists/<?php echo $link ?>" rel="bookmark"><?php echo $playlist_name ; ?></a>
                                    </strong>
                                    <p><?php echo a24m_excerpt($description, 12); ?></p>
                                </div>
                            </li>
                        <?php
                            $playlistArray[] = $playlist_name ;//Add playlist name in array to avoid to show it again
                            }//End if playlist
                        }
                        ?>
                    </ul>
                    <ul id="list_a24videos"><!-- videos results  -->
                    <h3 id="title_a24videos" class="search-bloc-title">Clips</h3>
                        <?php
                        while ( have_posts() ) {/*list videos results*/
                            the_post();
                                $thumbnail = get_the_post_thumbnail( null, 'thumbnail' ) ;
                                $post_type = get_post_type() ;
                                if($post_type == 'a24videos'){
                                    ++$c;
                            ?>
                                <li class="col-xs-12" rel="<?php echo $post_type ; ?>">
                                    <div class="col-xs-12">
                                        <span class="rslt-thumbnail"><a href="<?php echo esc_url( get_permalink() ); ?>">
                                            <?php echo($thumbnail != '')?$thumbnail:'<img src="'.get_template_directory_uri().'/images/empty_thumbnail.png" alt="'.get_the_title().'" />' ?>
                                        </a></span>
                                        <?php the_title( sprintf( '<strong class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></strong>' ); ?>
                                        <h3><?php echo get_field('artistes'); ?></h3>
                                        <p><?php echo a24m_excerpt(get_field('description')); ?></p>
                                    </div>
                                </li>
                            <?php
                            }//End if $post_type == a24videos
                        // End the loop.
                        }
                        ?>
                    </ul>
                    <ul id="list_posts"><!-- news results  -->
                    <h3 id="title_posts" class="search-bloc-title">News</h3>
                        <?php
                        while ( have_posts() ) { /*list news results*/
                            the_post();
                            $thumbnail = get_the_post_thumbnail( null, 'thumbnail' ) ;
                            $post_type = get_post_type() ;
                            $playlist  = a24videos_get_a_term(get_the_id(), 'playlist') ;
                            if($post_type == 'post'){
                                ++$p
                            ?>
                                <li class="col-xs-12 <?php echo ($py >= 3)?'shadow-p':''; ?>" rel="<?php echo $post_type ; ?>">
                                    <div class="col-xs-12">
                                        <span class="rslt-thumbnail"><a href="<?php echo esc_url( get_permalink() ); ?>">
                                            <?php echo($thumbnail != '')?$thumbnail:'<img src="'.get_template_directory_uri().'/images/empty_thumbnail.png" alt="'.get_the_title().'" />' ?>
                                        </a></span>
                                        <?php the_title( sprintf( '<strong class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></strong>' ); ?>
                                        <h3><?php echo get_field('artistes'); ?></h3>
                                        <p><?php echo a24m_excerpt(get_the_excerpt()); ?></p>
                                    </div>
                                </li>
                        <?php
                            }//End if $post_type  == post
                        // End the loop.
                        }
                        ?>
                    </ul>
                </div>
                <?php
            else :
                get_template_part( 'contents/content', 'none' );

            endif;
                ?>
            </div>
            <div class="hidden-xs col-sm-3">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('w5') ) : endif; ?>
            </div>
        </div><!-- .site-main -->
    </div><!-- .site-main -->
</div><!-- .content-area -->

<script>
    jQuery('body').on('click','.shadow',function(e,$){
        e.preventDefault() ;
        var element = jQuery(this).attr('id') ;
        var txt     = jQuery(this).html() ;
        jQuery('ul#list_'+element+' li:nth-child(4) ~ li').toggle('fade','up',600) ;
        jQuery(this).html(txt == '<a href="#">Voir plus</a>'?'<a href="#">Voir moins</a>':'<a href="#">Voir plus</a>') ;
    });

    var postType = ["a24videos","playlists","posts"];
    var total = 0 ;
    for (var i = 0; i < 3; i++) {
        var list    = jQuery('ul#list_'+postType[i]) ;
        var count   = jQuery('ul#list_'+postType[i]+' li').size(); //Get total results from nbr of li(s)
        /*Since playlists are included in the results based on videos, it happened that multiple playlists can come several times.
         But we have set a system to avoid displaying a playlist more than once. Still this will render an incoherent number of results. So to solve that lil issue we set the number of result base on number of li's. 
         So for each ittération we update the variable "total" and will use it to display the number of results. */
         total += count ;

        jQuery('h3#title_'+postType[i]).append(' <small>('+count+')</small>') ; //We append bloc title to the bloc
        if(count <= 0){//If no result for current content type we hide it's tab and bloc title
            jQuery('li#tab_'+postType[i]).hide() ;
            jQuery('ul#list_'+postType[i]).remove() ;
        }else if(count > 3){//Else we append se more link to the ul bloc
            jQuery(list).append('<span id="'+postType[i]+'" class="see-more shadow trigger"><a href="#">Voir plus</a></span>') ;
        }
    }
    var resultat = (total > 1)? total+' résultats':total+' résultat' ;
    jQuery('.sub-title .search-query .title').html( resultat ) ;

/*  ========================== search result tab options ======================= */
    /*jQuery('#categs-list li a').click(function(e) {
        e.preventDefault() ;
        var target = jQuery(this).attr('target') ;
        jQuery('#search-result-id ul').each(function(a){
            // alert(target) ;
            if(jQuery(this).attr('id') != 'list_'+target && target != 'all'){
                jQuery(this).hide("slide", { direction: "right" }, 300);
            } else if(target == 'all') {
                jQuery(this).show("slide", { direction: "left" }, 300);
                jQuery('ul .shadow').removeClass('lightedup') ;
            } else {
                jQuery(this).show("slide", { direction: "left" }, 300);
                if(target != 'all'){
                    jQuery('ul#list_'+target+' li:nth-child(4)  ~ li').show() ;
                }
            }
        });
    })*/
</script>
<?php get_footer(); ?>