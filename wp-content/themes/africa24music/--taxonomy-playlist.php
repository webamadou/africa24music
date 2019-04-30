<?php get_header(); ?>
<?php 
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );//Retrieving playlist from url
    /*here we set up  the loop to retrieve all the videos of current playlist*/
    $playlist_args = array('post_type'          => 'a24videos',
                                'order'         => 'DESC',
                                'tax_query'     => array(array('taxonomy' => 'playlist',
                                                               'field'    => 'slug', 
                                                               'terms'    => $term, ),
                                                        )
                            );

    $playlistArray = array() ; $jsPlaylistArray = '' ;
    $loop = new WP_Query( $playlist_args );
    /*Saving playlist infos in variables*/
    $name           = $term->name;
    $slug           = $term->slug;
    $description    = $term->description;
    $taxonomy       = $term->taxonomy;
    $termid         = $term->term_id;
    $date           = get_field('date', $taxonomy.'_'.$termid);
    $date           = new Datetime($date) ;
    $image          = get_field('playlist_image',  $taxonomy.'_'.$termid );
    $author         = get_field('author',  $taxonomy.'_'.$termid );

    /*Counting nbr comments and nbr videos on current playlist*/
    $nbr_comments = $nbr_title = 0;

    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) :
            $loop->the_post();
            $splitVideoUrl      = explode('?v=', get_the_content()) ;//We first split video content
            $videoId            = str_replace( "[/embedyt]", '', @$splitVideoUrl[1] );//Then now we get the video id
            $playlistArray[] = $post->ID ;
            $jsPlaylistArray .= $videoId.',' ;
            $nbr_comments   += get_comments_number();
            ++$nbr_title ;
        endwhile;
    endif;
    $jsPlaylistArray = substr($jsPlaylistArray, 0, -1) ;
    rewind_posts();
    /*now we are going to set up the next and previous video variables*/
    if(isset($_GET['v'])){ $currentId = $_GET['v'] ; }
    else{ $currentId = $playlistArray[0] ; }
    $currentKey = array_search($currentId, $playlistArray) ;
    $endList = (($currentKey + 1) == $nbr_title)?true:false ;
    $nextKey = $currentKey + 1 ;
    $prevKey = $currentKey - 1 ;
    $prevId = (isset($playlistArray[$prevKey]))?$playlistArray[$prevKey]:0 ;
    $nextId = (isset($playlistArray[$nextKey]))?$playlistArray[$nextKey]:0 ;

    if(!isset($_GET['v'])){
        $playing_video_args = array('post_type'     => 'a24videos',
                                    'order'         => 'DESC',
                                    'tax_query'     => array(array('taxonomy' => 'playlist', 'field'    => 'slug', 'terms'    => $term, ), ),
                                    'posts_per_page'=> 1
                                );
    } else {
        $playing_video_args = array('post_type'     => 'a24videos',
                                    'p'             => $_GET['v'],
                                    'tax_query'     => array(array('taxonomy' => 'playlist', 'field'    => 'slug', 'terms'    => $term, ), ),
                                    'posts_per_page'=> 1
                                );
    }
?>
<div class="container">
    <div class="cadre">
        <div class="page-content">
            <h1 class="slim-title">PLAYLIST</h1>
            <div class="row playlist-header">
                <div class="col-sm-12 col-md-12 no-padding"><!-- PLAYLIST TITLE  -->
                    <div class="sub-title playlist">
                        <span class="oblique yellow">&nbsp;</span>
                        <div class="search-query">
                            <div class="col-xs-12 title"> <?php echo $name ?> </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 playlist-infos"><!-- playlist details  -->
                    <div class="hidden-xs col-sm-1 no-padding">
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
                    <div class="col-xs-6 col-sm-9 no-padding">
                        <span class="playlist-description"><?php echo a24m_excerpt($description,30) ?> </span>
                        <span class="playlist-others"><?php echo ($date)?'Date de création '.$date->format('j M Y').' - ':'' ?>
                            <?php echo (!empty($author['nickname']))?'Crée par: <span class="value-data">'.$author['nickname'].'</span>':'' ;
                            ?>
                                <?php echo $nbr_title.' titres' ?>
                        </span>
                    </div>
                    <div class="col-xs-6 col-sm-2 no-padding">
                        <div class="col-xs-12 col-sm-12 social-playlist no-padding">
                            <ul>
                                <li class="col-xs-4">
                                    <a href="#" title="les vidéos les plus populaires"><i class="action-icon a24-eye2"></i><br/>(10767)</a>
                                </li>
                                <li class="col-xs-4">
                                    <a href="#"><i class="action-icon a24-commentary"></i><br/>(<?php echo $nbr_comments ?>)</a>
                                </li>
                                <li class="col-xs-4">
                                    <a href="#"><i class="action-icon a24-share"></i><br/>Partager</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9 clip">
                <?php

                    $loop = new WP_Query( $playing_video_args ); 
                    while ($loop->have_posts()) {
                        $loop->the_post();
                        $splitVideoUrl      = explode('?v=', get_the_content()) ;//We first split video content
                        $videoId            = str_replace( "[/embedyt]", '', @$splitVideoUrl[1] );//Then now we get the video id
                        $postId             = $post->ID;
                        $currentTitle       = get_the_title();
                        $currentArtiste     = get_field( 'artistes' );
                        $currentDescription = get_field( 'description' ) ;
                        $currentThumb       = get_the_post_thumbnail( null, 'thumbnail', '' );
                        $currentDate        = get_the_date();
                        // the_ratings() functions returns an html element. We don't want to display yet. So we buffer values in a variable.
                        ob_start();
                        function_exists('the_ratings')? the_ratings():NULL;
                        $currentRates       = ob_get_clean() ;
                        $currentGenreTags   = a24videos_get_terms( $post->ID, 'genres') ;
                        $currentPaysTagSlug = a24videos_get_terms_list( $post->ID, 'pays','slug') ;
                        $currentPaysTerm    = get_term_by( 'slug', @$currentPaysTagSlug[0], 'pays' );
                        $currentPaysLink    = get_field('flag', @$currentPaysTerm->taxonomy.'_'.@$currentPaysTerm->term_id);
                        $currentPaysTags    = a24videos_get_terms( $post->ID, 'pays');
                        $currentVideoTags   = a24videos_get_terms( $post->ID, 'video_tags');
                        $currentAuthor      = get_field( 'author');
                        $currentNbrComment  = get_comments_number() ;
                        $currentNbrVus      = wpb_get_videos_views($post->ID) ;
                        wp_reset_postdata();
                    ?>
                        <div id="embeder" class="embed">
                            <div id="player"></div>
                        </div>
                <?php 
                    }//ENd while loop ?>
            </div>  
            <div class=" hidden-xs col-sm-4 col-md-3 clips-playlist">
                <?php
                    $loop = new WP_Query( $playlist_args );

                    while ( $loop->have_posts() ) {
                        $loop->the_post() ;
                        $splitVideoUrl      = explode('?v=', get_the_content()) ;//We first split video content
                        $videoItem          = str_replace( "[/embedyt]", '', @$splitVideoUrl[1] );//Then now we get the
                 ?>
                        <li class="next-clip">
                            <a href="<?php echo home_url('/').'playlists/'.$slug.'?v='.$post->ID ?>">
                                <span class="list-img"> 
                                    <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="" class="img-responsive">
                                </span>
                                <span class="list-title"><?php the_title(); ?></span><br/>
                                <span class="list-author"><?php echo get_field( 'artistes' ) ?></span><br/>
                            </a>
                        </li>
                <?php 
                    }//End while loop
            ?>
            </div>
            <div class="col-xs-12"><a href="#" class="infos-toggler"><i class="glyphicon glyphicon-plus"></i> infos vidéo</a></div>
            <div class="row playlist-footer">
                <div class="col-sm-12 col-md-12 no-padding"><!-- PLAYLIST TITLE  -->
                    <div class="playlist-video-details sub-title playlist">
                        <span class="oblique red">&nbsp;</span>
                        <div class="search-query">
                            <div class="col-xs-1 video-flag">
                            <?php $flag = $currentPaysLink != ''?$currentPaysLink:get_template_directory_uri().'/images/empty.png' ?>
                                <img src="<?php echo $flag ?>" class="img-responsive" alt="">
                            </div>
                            <div class="col-xs-9 title-n-artiste">
                                <h3 class="col-xs-12 currentTitle"><?php echo $currentTitle ?></h3>
                                <div class="col-xs-12 title currentArtiste"> <?php echo a24m_excerpt($currentArtiste,60) ?> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 playlist-infos"><!-- playlist details  -->
                    <!-- <div class="hidden-xs col-sm-2 no-padding"> -->
                    <div class="col-xs-6 col-sm-7 current-details no-padding">
                        <div class="hidden-xs col-sm-3 current-img"> <?php echo $currentThumb ?> </div>
                        <div class="col-xs-12 col-sm-9">
                            <div class="current-description"><?php echo a24m_excerpt($currentDescription,25) ?> </div>
                            <div class="current-date">Date de mise en ligne <?php  $currentDate ?> </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-5 no-padding">
                        <div class="col-xs-12 col-sm-6 social-video-details no-padding">
                            <ul>
                                <li class="">
                                    <a href="#"><i class="action-icon a24-eye2"></i><br/>(<?php echo $currentNbrVus ?>)</a>
                                </li>
                                <li class="">
                                    <a href="#"><i class="action-icon a24-commentary"></i><br/>(<?php echo $currentNbrComment ?>)</a>
                                </li>
                                <li class="">
                                    <a href="#"><i class="action-icon a24-share"></i><br/>Partager</a>
                                </li>
                            </ul>
                            <p class="vote-title">Votez pour cette playlist</p>
                            <?php echo $currentRates ?>
                        </div>
                        <div class="col-xs-12 col-sm-6 tags">
                            <span class="country"><?php echo $currentVideoTags ?></span>
                            <?php echo $currentPaysTags ?>
                            <?php echo $currentGenreTags ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <h1 class="slim-title">playlists similaires</h1>
            <div id="similar-playlists">
                <span class="slider-arrows left"><i class="a24-slide-left"></i></span>
                <span class="slider-arrows right"><i class="a24-slide-right"></i></span>
                <ul id='playlists_ul'>
                    < ?php for ($i=1; $i < 6 ; $i++) {
                  echo "<li>
                            <a href='#'><img src='".get_template_directory_uri()."/images/play".$i.".png' class='img-responsive' /></a>
                            <span class='shadow'></span>
                        </li>" ;
                    } ?>
                </ul>
                <div id='right_scroll'><img src="< ?php echo get_template_directory_uri() ?>/images/carousel-arrow-right.png" /></div>
            </div> -->
            <div class="row advertise">
                <div class="hidden-xs col-sm-12 pub-full-100"><h2>ESPACE PUB <br/>900 x 100</h2></div>
            </div>
        </div>
    </div>
</div>
      <!-- playerVars: { 'autoplay': 0, 'controls': 1, 'rel':0 }, -->
<script>
    jQuery('a[href="#"]').click(function(e){
        e.preventDefault() ;
    })
    jQuery('.infos-toggler').click(function(e){/*toggle video details*/
        var text = jQuery(this).html() ;
        e.preventDefault() ;
        jQuery( '.playlist-footer' ).toggle('fade', 'up', 600, 'ease-in') ;
        jQuery('.infos-toggler').delay(1000).html( text == '<i class="glyphicon glyphicon-plus"></i> infos vidéo'?'<i class="glyphicon glyphicon-minus"></i> infos vidéo':'<i class="glyphicon glyphicon-plus"></i> infos vidéo')
    }) ;
    var nextId = "<?php echo home_url('/').'playlists/'.$slug.'?v='.$nextId ?>" ;
    var playlistArray = ['Y09zpQWgjXw','d6a4hvoY0G0','7y0ChoYgSek'] ;
    /*Setting up video title length*/
    var that = jQuery('.currentArtiste');
    if(that.length){
        var textLength = that.html().length ;
        if( textLength < 30 ){
            that.css('font-size', '30%');
        } else {
            var div = textLength % 30 ;
            that.css('font-size', div+'%');
        }
    }
    // alert(next) ;
    /*Here we will use youtube API to launch videos*/
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var player;
    function onYouTubeIframeAPIReady() {
      player = new YT.Player('player', {
        height: '390',
        width: '100%',
        playerVars: { 
                    'autoplay': 1, 
                    'controls': 1, 
                    'rel':0, 
                    'origin':'http://music.africa24tv.com',
                    'playlist': '<?php echo $jsPlaylistArray ?>' 
                },
        videoId: '<?php echo $videoId ?>',
        events: {
          'onReady': onPlayerReady,
          'onStateChange':  function (event) {
                                console.log(event.data) ;
                                /*if (event.data == YT.PlayerState.ENDED) {
                                    window.location.replace(nextId)
                                }*/
                            }
        }
      });
    }

    // The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.playVideo();
    }

   /* var done = false;
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.ENDED && !done) {
          alert('waaaaaaaaaa') ;
          done = true;
        }
    }*/
    function stopVideo() {
        player.stopVideo();
    }
</script>
<?php get_footer() ?>