<?php get_header(); ?>
<?php 
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );//Retrieving playlist from url
    /*here we set up  the loop to retrieve one video from current playlist*/
    if(!isset($_GET['v'])){
        $playing_video_args = array('post_type'         => 'a24videos',
                                    'order'             => 'DESC',
                                    'tax_query'         => array(array('taxonomy' => 'playlist',
                                                                   'field'    => 'slug', 
                                                                   'terms'    => $term, ),
                                                            ),
                                    'posts_per_page'    => 1
                                );
    } else {
        $playing_video_args = array('post_type'         => 'a24videos',
                                    'p'             => $_GET['v'],
                                    'tax_query'         => array(array('taxonomy' => 'playlist',
                                                                   'field'    => 'slug', 
                                                                   'terms'    => $term, ),
                                                            ),
                                    'posts_per_page'    => 1
                                );
    }
        /*here we set up  the loop to retrieve only videos from current playlist*/
        $playlist_args = array('post_type'          => 'a24videos',
                                    'order'         => 'DESC',
                                    'tax_query'     => array(array('taxonomy' => 'playlist',
                                                                   'field'    => 'slug', 
                                                                   'terms'    => $term, ),
                                                            )
                                );

    $loop = new WP_Query( $playlist_args );
    /*Saving playlist infos in variables*/
    $name           = $term->name.'<br/>';
    $slug           = $term->slug;
    $description    = $term->description;
    $taxonomy       = $term->taxonomy;
    $termid         = $term->term_id;
    $date           = get_field('date', $taxonomy.'_'.$termid);
    $image          = get_field('playlist_image',  $taxonomy.'_'.$termid );
    $author         = get_field('author',  $taxonomy.'_'.$termid );

    /*Counting nbr comments on current playlist*/
    $nbr_comments = $nbr_title = 0;
    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post();
        $nbr_comments += get_comments_number();
        ++$nbr_title ;
    endwhile;
    endif;
    rewind_posts();
    echo $nbr_comments ;

?>
<div class="container">
    <div class="cadre">
        <div class="page-content">
            <h1 class="slim-title">PLAYLIST</h1>
            <div class="row playlist-header">
                <div class="col-sm-12 col-md-12"><!-- PLAYLIST TITLE  -->
                    <div class="sub-title playlist">
                        <span class="oblique yellow">&nbsp;</span>
                        <div class="search-query">
                            <div class="col-xs-12 title"> <?php echo $name ?> </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 playlist-infos"><!-- playlist details  -->
                    <div class="hidden-xs col-sm-1">
                        <span class="playlist-img">
                            <?php
                                if( !empty($image) )
                                    $playlist_image = $image['url'] ;
                                else
                                    $playlist_image = get_template_directory_uri().'images/empty_thumbnail.png';

                                    echo '<img src="'.$playlist_image.'" alt="'.@$image['alt'].'"  width="300px" class="img-responsive" />' ;
                            ?>
                        </span>
                    </div>
                    <div class="col-xs-4 col-sm-6">
                        <span class="playlist-description"><?php echo $description ?> </span><br/><br/>
                        <span class="playlist-others">Date de création: <span class="value-data"><?php echo $date ?></span>
                            <?php echo (!empty($author['nickname']))?'Crée par: <span class="value-data">'.$author['nickname'].'</span>':'' ;
                            ?>
                                <?php echo $nbr_title.' titres' ?>
                        </span>
                    </div>
                    <div class="col-xs-4 col-sm-3 social-playlist">
                        <ul>
                            <li class="col-xs-2">
                                <a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/eye.png" alt=""><br/>(10767)</a>
                            </li>
                            <li class="col-xs-2">
                                <a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/comment.png" alt=""><br/>(<?php echo $nbr_comments ?>)</a>
                            </li>
                            <li class="col-xs-2">
                                <a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/social_share.png" alt=""><br/></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-2 voting">
                        <span class="vote-title"> Votez pour cette playlist:</span><br/><br/>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-8 clip">
            <?php

                $loop = new WP_Query( $playing_video_args ); 
                while ($loop->have_posts()) {
                    $loop->the_post();
                    $splitVideoUrl      = explode('?v=', get_the_content()) ;//We first split video content
                    $videoId            = str_replace( "[/embedyt]", '', @$splitVideoUrl[1] );//Then now we get the video id
                    $id       = $post->ID;
                    echo "$id<br/>";
                    $currentTitle       = get_the_title();
                    $currentArtiste     = get_field( 'artistes' );
                    $currentDEscription = get_field( 'description' ) ;
                    $currentThumb       = get_the_post_thumbnail( null, 'thumbnail', '' );
                    $currentDate        = the_date();
                    ob_start();
                    function_exists('the_ratings')? the_ratings():NULL;
                    $currentRates       = ob_get_clean() ;
                    $currentGenreTags   = a24videos_get_terms($post->ID, 'genres') ;
                    $currentPaysTags    = a24videos_get_terms( $post->ID, 'pays') ;
                    $currentVideoTags   = a24videos_get_terms( $post->ID, 'video_tags');
                    wp_reset_postdata();
                ?>
                    <div id="embeder" class="embed">
                        <input type="hidden" name="current" value="<?php echo $videoId ?>" />
                        <!--iframe width="100%" height="450" src="https://www.youtube.com/embed/< ?php echo $videoId ?>?autoplay=1" frameborder="0" allowfullscreen></iframe-->
                        <div id="player"></div>
                    </div>
            <?php }//ENd while loop ?>
            </div>  
            <div class="col-sm-4 col-md-4 clips-playlist">
            <?php
                $loop = new WP_Query( $playlist_args );
                $playlistArray = array() ;
            while ( $loop->have_posts() ) {
                $loop->the_post() ;
                $splitVideoUrl      = explode('?v=', get_the_content()) ;//We first split video content
                $videoItem            = str_replace( "[/embedyt]", '', @$splitVideoUrl[1] );//Then now we get the 
                $playlistArray[] = $videoItem ;
             ?>
                <li class="next-clip">
                    <a href="<?php echo home_url('/').'playlists/'.$slug.'?v='.$post->ID ?>">
                        <span class="list-img"> <img src="<?php echo the_post_thumbnail_url('thumbnail'); ?>" alt="" class="img-responsive"></span>
                        <span class="list-title"><?php the_title(); ?></span><br/>
                        <span class="list-author"><?php echo get_field( 'artistes' ) ?></span><br/>
                </li>
            <?php } 
                var_dump($playlistArray) ;
            ?>
            </div>
            <div class="row playlist-footer">
                <div class="col-sm-8 col-md-8 col-xs-12 video-infos">
                    <p>
                        <span class="clip-img"><?php echo $currentThumb ?></span>
                        <span class="clip-title"><?php echo $currentTitle ?></span><br/>
                        <span class="clip-artiste"><?php echo $currentArtiste ?> </span><br/><br/>
                        <?php 
                        echo ($currentDate != '')?'<span class="clip-addeddate">Date de mise en ligne: <span class="value-data"> '.$currentDate.' </span> </span>':'' ;
                        ?>

                    </p>
                </div>
                <div class="hidden-xs col-sm-4 col-md-4 playlist-pub">
                    <h2>espace pub <br/>340 x 80</h2>
                </div>
            </div>
            <h1 class="slim-title">playlists similaires</h1>
            <div id="similar-playlists">
                <span class="slider-arrows left"><i class="a24-slide-left"></i></span>
                <span class="slider-arrows right"><i class="a24-slide-right"></i></span>
                <ul id='playlists_ul'>
                    <?php for ($i=1; $i < 6 ; $i++) {
                  echo "<li>
                            <a href='#'><img src='".get_template_directory_uri()."/images/play".$i.".png' class='img-responsive' /></a>
                            <span class='shadow'></span>
                        </li>" ;
                    } ?>
                </ul>
                <div id='right_scroll'><img src="<?php echo get_template_directory_uri() ?>/images/carousel-arrow-right.png" /></div>
            </div>
            <div class="row advertise">
                <div class="hidden-xs col-sm-12 pub-full-100"><h2>ESPACE PUB <br/>900 x 100</h2></div>
            </div>
        </div>
    </div>
</div>
      <!-- playerVars: { 'autoplay': 0, 'controls': 1, 'rel':0 }, -->
<script>
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var player;
    function onYouTubeIframeAPIReady() {
      player = new YT.Player('player', {
        height: '390',
        width: '100%',
        videoId: '<?php echo $videoId ?>',
        events: {
          'onReady': onPlayerReady,
          'onStateChange':  function (event) {
                                /*if(event.data == 1) { // The video started playing
                                  alert('ouiiiiiiiiiiiii') ;
                                } else {*/
                                    alert(event.data) ;
                                    console.log(event.data) ;
                                    /*if (event.data == YT.PlayerState.ENDED) {
                                      alert('waaaaaaaaaa') ;
                                    }*/
                                // };
                            }
        }
      });
    }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.playVideo();
    }

    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    var done = false;
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.ENDED && !done) {
          alert('waaaaaaaaaa') ;
          done = true;
        }
    }
    function stopVideo() {
        player.stopVideo();
    }
</script>
<?php get_footer() ?>