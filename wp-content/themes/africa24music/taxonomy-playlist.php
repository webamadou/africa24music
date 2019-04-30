<?php get_header(); ?>
<?php 
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );//Retrieving playlist from url

    /*here we set up  the loop to retrieve all the videos of current playlist*/
    $playlist_args = array('post_type'          => 'a24videos',
                                'order'         => 'DESC',
                                'tax_query'     => array(array('taxonomy' => 'playlist',
                                                               'field'    => 'slug', 
                                                               'terms'    => $term, ),
                                                        ),
                                'nopaging'      => true,
                            );

    $playlistArray = array() ; $jsPlaylistArray = '' ;
    $loop = new WP_Query( $playlist_args );

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
    $nbr_comments = $nbr_title = $nbr_views = 0;

    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) :
            $loop->the_post();
            $splitVideoUrl      = explode('?v=', get_the_content()) ;//We first split video content
            $videoId            = str_replace( "[/embedyt]", '', @$splitVideoUrl[1] );//Then now we get the video id
            $playlistArray[]    = $post->ID ;
            $jsPlaylistArray[]  = $videoId ;
            $nbr_comments      += get_comments_number();
            $nbr_views      += wpb_get_videos_views($post->ID) ;
            ++$nbr_title ;
        endwhile;
    endif;

    rewind_posts();
    /*now we are going to set up the next and previous video variables*/
    if(isset($_GET['v'])){ $currentId = $_GET['v'] ; }
    else{ $currentId = @$playlistArray[0] ; }
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
                    </div>
                    <div class="col-xs-12 col-sm-12 no-padding">
                        <span class="playlist-img">
                            <?php
                                if( !empty($image) )
                                    $playlist_image = $image['url'] ;
                                else
                                    $playlist_image = get_template_directory_uri().'/images/empty_thumbnail.png';

                                    echo '<img src="'.$playlist_image.'" alt="'.@$image['alt'].'"  width="300px" class="img-responsive" />' ;
                            ?>
                        </span>
                        <span class="playlist-description"><?php echo a24m_excerpt($description,30) ?> </span>
                        <span class="playlist-others"><?php echo ($date)?'Date de création '.$date->format('j M Y').' - ':'' ?>
                            <?php echo (!empty($author['nickname']))?'Crée par: <span class="value-data">'.$author['nickname'].'</span>':'' ;
                            ?>
                                <?php echo $nbr_title.' titres' ?>
                        </span>
                    </div>
                    <div class="hidden-xs hidden-sm hidden-md hidden-lg no-padding">
                        <div class="col-xs-12 col-sm-12 social-playlist no-padding">
                            <ul>
                                <li class="col-xs-4">
                                    <a href="#" title="les vidéos les plus populaires"><i class="action-icon a24-eye2"></i><br/>(<?php echo $nbr_views ?>)</a>
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
            <?php 
            $loop = new WP_Query( $playing_video_args );
            if ( $loop->have_posts() ){//If we have at least one video in the playlist ?>
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
                        $currentLink        = get_permalink();
                        $currentThumb       = get_the_post_thumbnail( null, 'thumbnail', '' );
                        $currentDate        = get_the_date();
                        if(empty($currentThumb))
                            $currentThumb = '<img width="150" height="150" src="'.get_template_directory_uri().'/images/empty_thumbnail.png" class="attachment-thumbnail size-thumbnail wp-post-image" alt="Ghetto Kids of sitya loss Dancing Jambole" />' ;

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
                        wpb_set_post_views( $post->ID ) ;
                        wp_reset_postdata();
                    ?>
                        <div id="embeder" class="embed">
                            <div id="player"></div>
                        </div>
                <?php 
                    }//ENd while loop ?>
            </div>  
            <div class=" col-xs-12 col-sm-4 col-md-3 clips-playlist">
                <?php
                    $loop = new WP_Query( $playlist_args );
                    $rel = 0 ;
                    while ( $loop->have_posts() ) {
                        $loop->the_post() ;
                        $splitVideoUrl      = explode('?v=', get_the_content()) ;//We first split video content
                        $videoItem          = str_replace( "[/embedyt]", '', @$splitVideoUrl[1] );//Then now we get the video ID
                        $images             = get_the_post_thumbnail_url($loop->ID, 'thumbnail' );
                        $images             = ($images == false)?get_template_directory_uri().'/images/empty_thumbnail.png':$images ;
                    ?>
                        <li class="next-clip" rel="<?php echo $rel ?>">
                            <a href="<?php echo home_url('/').'playlists/'.$slug ?>">
                                <span class="list-img"> 
                                    <img src="<?php echo $images ?>" alt="" class="img-responsive">
                                </span>
                                <span class="list-title"><?php the_title(); ?></span><br/>
                                <span class="list-author"><?php echo get_field( 'artistes' ) ?></span><br/>
                            </a>
                        </li>
                    <?php
                        $splitTheVideoUrl       = explode('?v=', get_the_content()) ;//We first split video content
                        ob_start();
                        function_exists('the_ratings')? the_ratings():NULL;
                        $currentItemRates       = ob_get_clean() ;
                        $currentItemPaysTagSlug = a24videos_get_terms_list( $post->ID, 'pays','slug') ;
                        $currentItemPaysTerm    = get_term_by( 'slug', @$currentItemPaysTagSlug[0], 'pays' );
                        $currentItemPaysLink    = get_field( 'flag', @$currentItemPaysTerm->taxonomy.'_'.@$currentItemPaysTerm->term_id );

                        // $the_flag = get_field('flag', @$currentPaysTerm->taxonomy.'_'.@$currentPaysTerm->term_id);
                        $theFlag = $currentItemPaysLink != ''?$currentItemPaysLink:get_template_directory_uri().'/images/empty.png' ;

                        //Now we setup a large array with the details of each video
                        $videosDetails[$rel] = array(
                                                     'title'        => get_the_title(),
                                                     'description'  => get_field( 'description' ),
                                                     'flag'         => $theFlag,
                                                     'thumbnail'    => $images,
                                                     'videoId'      => str_replace( "[/embedyt]", '', @$splitTheVideoUrl[1] ),
                                                     'artist'       => get_field( 'artistes' ),
                                                     'link'         => get_permalink(),
                                                     'date'         => get_the_date(),
                                                     'author'       => get_field( 'author' ),
                                                     'views'        => wpb_get_videos_views($post->ID),
                                                     'comments'     => get_comments_number(),
                                                     'rates'        => $currentItemRates,
                                                     'shares'       => '',
                                                     'genretags'    => a24videos_get_terms_list( $post->ID, 'genres','slug'),
                                                     'paystags'     => a24videos_get_terms_list( $post->ID, 'pays','slug'),
                                                     'videotags'    => a24videos_get_terms_list( $post->ID, 'video_tags','slug'),
                                                    );
                            $rel++ ;
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
                                <div class="col-xs-12 title current-artiste"> <?php echo a24m_excerpt($currentArtiste,60) ?> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 playlist-infos"><!-- playlist details  -->
                    <!-- <div class="hidden-xs col-sm-2 no-padding"> -->
                    <div class="col-xs-12 col-sm-7 current-details no-padding">
                        <div class="hidden-xs col-sm-3 current-img"><a href="<?php echo $currentLink ?>"> <?php echo $currentThumb ?> </a></div>
                        <div class="col-xs-12 col-sm-9 no-padding">
                            <div class="current-description"><?php echo a24m_excerpt($currentDescription,25) ?> </div>
                            <div class="current-date">Date de mise en ligne <?php  echo $currentDate ?> </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-5 no-padding">
                        <div class="col-xs-12 col-sm-6 social-video-details no-padding">
                            <ul class="col-xs-6 col-sm-12">
                                <li class="no-link">
                                    <a href="#"><i class="action-icon a24-eye2"></i><br/><span class="views">(<?php echo $currentNbrVus ?>)</span></a>
                                </li>
                                <li class="">
                                    <a href="#"><i class="action-icon a24-commentary"></i><br/><span class="comments">(<?php echo $currentNbrComment ?>)</span></a>
                                </li>
                                <li class="">
                                    <!-- <a href="#"><i class="action-icon a24-share"></i><br/>Partager</a> -->

                                </li>
                            </ul>
                            <div class="videos-rates col-xs-6 col-sm-12">
                                <p class="vote-title">Votez pour cette vidéo</p>
                                <?php echo $currentRates ?>
                                <?php echo ( is_user_logged_in() )?'':'<p class="log2rate"> <a href="'.home_url().'/login">Se connecter</a> pour voter </p>' ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 tags">
                            <span class="country"><?php echo $currentVideoTags ?></span>
                            <?php echo $currentPaysTags ?>
                            <?php echo $currentGenreTags ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }//END LOOP HAVE_POST
            else{ ?>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h1 class="empty-paylist">CETTE PLAYLIST EST POUR LE MOMENT VIDE</h1>
                </div>
            <?php }
            ?>
            <div class="row advertise">
                <div class="row advertise">
                    <div class="hidden-xs col-sm-12 pub-full-100"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('w1') ) : endif; ?></div>
                </div>
            </div>
            <div class="row">
                <div id="slider1" class="hidden-xs col-sm-12">
                    <a class="buttons prev" href="#">&#60;</a>
                    <div class="viewport">
                        <ul class="overview">
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
                                                echo '<img src="'.get_template_directory_uri().'/images/empty.png" alt="'. $image["alt"].'" class="img-responsive" />' ;
                                            } echo'</a>
                                                <span class="playlist-title">'.$datas->name.'</span>
                                        </div>
                                     </li>' ;
                        } ?>
                        </ul>
                    </div>
                    <a class="buttons next" href="#">&#62;</a>
                </div>
            </div>
        </div>
    </div>
</div>
      <!-- playerVars: { 'autoplay': 0, 'controls': 1, 'rel':0 }, -->

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#slider1').tinycarousel();
    });
</script>
<script>
    jQuery('a[href="#"]').click(function(e){
        e.preventDefault() ;
    })
    /**
     * This function will auto fill informations of the current details in the DOM
     * @param  {[type]} all the videos in the playlist are listed in an array. the videoIndex params is the index of current video in the array
     * @return void
     */
    function update_video_details(videoIndex) {
        jQuery('.video-flag').html('<img src="'+videosDetails[videoIndex]['flag']+'" class="img-responsive" />') ;
        jQuery('.current-img img').attr('src', videosDetails[videoIndex]['thumbnail']) ;
        jQuery('.current-img a').attr('href',videosDetails[videoIndex]['link']) ;
        jQuery('.playlist-video-details h3.currentTitle').html(videosDetails[videoIndex]['title']) ;
        jQuery('.current-artiste').html(videosDetails[videoIndex]['artist']) ;
        jQuery('.current-description').html(videosDetails[videoIndex]['description']) ;
        jQuery('.current-date').html('Date de mise en ligne '+videosDetails[videoIndex]['date']) ;
        jQuery('li span.views').html( videosDetails[videoIndex]['views'] ) ;
        jQuery('li span.comments').html( videosDetails[videoIndex]['comments'] ) ;
        jQuery('.videos-rates').html( videosDetails[videoIndex]['rates'] ) ;
        jQuery('.tags').html( videosDetails[videoIndex]['genretags']+' '+videosDetails[videoIndex]['videotags']+' '+videosDetails[videoIndex]['paystags'] ) ;

        var that = jQuery('.current-artiste');
        if(that.length){
            var textLength = that.html().length ;
            if( textLength < 30 ){
                that.css('font-size', '30%');
            } else {
                var div = textLength % 30 ;
                that.css('font-size', div+'%');
            }
        }
    }

    var playlistArray   = [<?php echo '"'.implode('","',$jsPlaylistArray).'"' ?>] ;//We trnasfer variable playlist to 
    var playlistLength  = [<?php echo count($jsPlaylistArray) ?>] ;//The number of videos in the playlist
    //Setting up of the youtube API
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    
    var player;
    currentIndex = 0 ;
    var videoList, videoCount;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '390',
            width: '100%',
            events:
            {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            },

            playerVars:
            {
                controls: 1,
                autoplay: 1,
                rel     : 0
            }
        });
    }
    videosDetails = <?php echo json_encode($videosDetails) ?> ;//We trnasfer the php array to a js array
    function onPlayerReady(event) {
        jQuery('.next-clip[rel="0"]').addClass('current').siblings().removeClass('current');
        jQuery('.next-clip').click(function(e){
            e.preventDefault() ;
            var videoIndex = jQuery(this).attr('rel') ;
            jQuery(this).addClass('current').siblings().removeClass('current');
            currentIndex = videoIndex ;
            //Let's got it auto srolling
            var offup = 63 * currentIndex ;
            jQuery('.clips-playlist').animate({scrollTop: offup },1500) ;

            event.target.loadPlaylist({
                'playlist'          : [playlistArray],
                'listType'          : 'playlist',
                'index'             : videoIndex,
            });
            update_video_details(currentIndex) ;//We call the function that'll update the video details
        }) ;
        // jQuery('body').on('click','a.ytp-next-button', function(e){
        jQuery('.ytp-next-button.ytp-button').click(function(e){
            alert('waa legui nak') ;
            // <a class="ytp-next-button ytp-button" aria-disabled="false" data-preview="https://i1.ytimg.com/vi/XsFC8nRsN94/mqdefault.jpg" data-tooltip-text="Serge Beynaud - Loko Loko (Clip Officiel)" href="https://www.youtube.com/watch?v=XsFC8nRsN94" data-duration="4:41" title="Suivante"><svg height="100%" version="1.1" viewBox="0 0 36 36" width="100%"><use class="ytp-svg-shadow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ytp-svg-12"></use><path class="ytp-svg-fill" d="M 12,24 20.5,18 12,12 V 24 z M 22,12 v 12 h 2 V 12 h -2 z" id="ytp-svg-12"></path></svg></a>
        }) ;
        event.target.loadPlaylist({
            'playlist'          : [playlistArray],
            'listType'          : 'playlist',
            'index'             : 0,
        });

        event.target.setLoop();
    }

    function onPlayerStateChange(event) {
        if(event.data == YT.PlayerState.ENDED) {
            ++currentIndex ;
            jQuery('.next-clip[rel="'+currentIndex+'"]').addClass('current').siblings().removeClass('current');
            //Let's got it auto srolling
            var offup = 63 * currentIndex ;
            jQuery('html,body .clips-playlist').animate({scrollTop: offup },1500) ;
            update_video_details( currentIndex ) ;//We call the function that'll update the video details
        }
    }

    //The link that toggle the current video's details
    jQuery('.infos-toggler').click(function(e){
        var text = jQuery(this).html() ;
        e.preventDefault() ;
        jQuery( '.playlist-footer' ).toggleClass('active') ;
        jQuery('.infos-toggler').delay(1000).html( text == '<i class="glyphicon glyphicon-plus"></i> infos vidéo'?'<i class="glyphicon glyphicon-minus"></i> infos vidéo':'<i class="glyphicon glyphicon-plus"></i> infos vidéo')
    }) ;
    /*Setting up video title length*/
    var that = jQuery('.current-artiste');
    if(that.length){
        var textLength = that.html().length ;
        if( textLength < 30 ){
            that.css('font-size', '30%');
        } else {
            var div = textLength % 30 ;
            that.css('font-size', div+'%');
        }
    }
</script>
<?php get_footer() ?><!-- \0/  -->