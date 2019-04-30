<?php

if ( ! function_exists( 'a24music_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since Twenty Fifteen 1.0
 */
function a24music_entry_meta() {
    if ( is_sticky() && is_home() && ! is_paged() ) {
        printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'twentyfifteen' ) );
    }

    $format = get_post_format();
    if ( current_theme_supports( 'post-formats', $format ) ) {
        printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
            sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'twentyfifteen' ) ),
            esc_url( get_post_format_link( $format ) ),
            get_post_format_string( $format )
        );
    }

    if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            get_the_date(),
            esc_attr( get_the_modified_date( 'c' ) ),
            get_the_modified_date()
        );

        printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
            _x( 'Posted on', 'Used before publish date.', 'twentyfifteen' ),
            esc_url( get_permalink() ),
            $time_string
        );
    }

    if ( 'post' == get_post_type() ) {
        if ( is_singular() || is_multi_author() ) {
            printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
                _x( 'Author', 'Used before post author name.', 'twentyfifteen' ),
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
            );
        }

        $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfifteen' ) );
        if ( $categories_list && twentyfifteen_categorized_blog() ) {
            printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                _x( 'Categories', 'Used before category names.', 'twentyfifteen' ),
                $categories_list
            );
        }

        $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfifteen' ) );
        if ( $tags_list ) {
            printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                _x( 'Tags', 'Used before tag names.', 'twentyfifteen' ),
                $tags_list
            );
        }
    }

    if ( is_attachment() && wp_attachment_is_image() ) {
        // Retrieve attachment metadata.
        $metadata = wp_get_attachment_metadata();

        printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
            _x( 'Full size', 'Used before full size attachment link.', 'twentyfifteen' ),
            esc_url( wp_get_attachment_url() ),
            $metadata['width'],
            $metadata['height']
        );
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        /* translators: %s: post title */
        comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'twentyfifteen' ), get_the_title() ) );
        echo '</span>';
    }
}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function twentyfifteen_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'twentyfifteen_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'twentyfifteen_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so twentyfifteen_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so twentyfifteen_categorized_blog should return false.
        return false;
    }
}

/* ==========================================
	 Include scripts
	========================================== */
    function a24m_script_enqueue() {
        //=======   css =======
        wp_enqueue_style('googleapis', 'https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic', '3.3.4', 'all');
        wp_enqueue_style('wow', get_template_directory_uri().'/js/wow/engine1/style.css', array(), '1.0', 'all');
        // wp_enqueue_style('datatable-css', 'https://cdn.datatables.net/v/bs-3.3.6/jq-2.2.3/dt-1.10.12/fc-3.2.2/fh-3.1.2/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.css', array(), '1.0', 'all');
        wp_enqueue_style('datatable-css', plugins_url().'/a24videos-manager/lib/datatable/datatables.min.css', array(), '1.0', 'all');
        wp_enqueue_style('jquery-ui', get_template_directory_uri()  . '/js/jquery-ui.min.css', array(), '3.3.4', 'all');
        wp_enqueue_style('bootstrap-dialogcss', get_template_directory_uri().'/js/bootstrap-dialog/css/bootstrap-dialog.css', array(), '3.3.4', true);
        wp_enqueue_style('tinycarousel', get_template_directory_uri().'/js/tinycarousel/tinycarousel.css', array(), '1.0', 'all');
        wp_enqueue_style('flipster-css', get_template_directory_uri().'/js/flipster_master/jquery.flipster.min.css', array(), '1.0', 'all');
        wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.css', array(), '3.3.4', 'all');
        wp_enqueue_style('a24_fonts', get_template_directory_uri().'/css/a24-fonts.css', array(), '1.0', 'all');
        wp_enqueue_style('style', get_template_directory_uri().'/css/style.css', array(), '1.0', 'all');
        wp_enqueue_style('responsive', get_template_directory_uri().'/css/responsive.css', array(), '1.0', 'all');
        //=======   js  =======
        wp_enqueue_script('jquery', 'http://code.jquery.com/jquery-3.1.1.min.js');
        wp_enqueue_script('bootstrapjs', get_template_directory_uri().'/js/bootstrap.min.js', array(), '3.3.4', true);
        wp_enqueue_script('datatablejs', 'https://cdn.datatables.net/v/bs-3.3.6/jq-2.2.3/dt-1.10.12/fc-3.2.2/fh-3.1.2/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js', array());
        wp_enqueue_script('jquery-uijs', get_template_directory_uri().'/js/jquery-ui.min.js', array(), '3.3.4', true);
        wp_enqueue_script('tinycarousel', get_template_directory_uri().'/js/tinycarousel/jquery.tinycarousel.min.js', array(), '3.3.4', true);
        wp_enqueue_script('flipster-js', get_template_directory_uri().'/js/flipster_master/jquery.flipster.min.js', array());
        wp_enqueue_script('scripts', get_template_directory_uri().'/js/scripts.js', array(), '3.3.4', true);
        wp_enqueue_script('bootstrap-dialogjs', get_template_directory_uri().'/js/bootstrap-dialog/js/bootstrap-dialog.js', array(), '3.3.4', true);
        /*wp_enqueue_script('jquery-validate', get_template_directory_uri().'/js/jquery.validate.js', array(), '3.3.4', true);
        wp_enqueue_script('jquery-validate-file', get_template_directory_uri().'/js/jquery.validate.file.js', array(), '3.3.4', true);*/
        wp_enqueue_script('datatablejs', plugins_url().'/a24videos-manager/lib/datatable/datatables.min.js', array());
        if(is_tax( get_query_var( 'taxonomy' ), get_query_var( 'term' ) )) {
            // The plugin youtube-embed goes in conflict when we're on the page of a playlist with the youtube API. We need so to deactivate all the actions of that plugin when we are on playlist page
            remove_action('admin_init', array("YouTubePrefs", 'check_double_plugin_warning'));
            remove_action('media_buttons', 'YouTubePrefs::media_button_wizard', 11);
            remove_action('admin_menu', 'YouTubePrefs::ytprefs_plugin_menu');
            remove_action('admin_bar_menu', 'YouTubePrefs::ytprefs_admin_bar', 100);
            remove_action('wp_enqueue_scripts', array('YouTubePrefs', 'ytprefs_admin_bar_scripts'));
            remove_action('admin_enqueue_scripts', array('YouTubePrefs', 'ytprefs_admin_bar_scripts'));
            remove_action('wp_print_scripts', array('YouTubePrefs', 'jsvars'));
            remove_action('wp_enqueue_scripts', array('YouTubePrefs', 'jsvars'));
            remove_action('wp_enqueue_scripts', array('YouTubePrefs', 'ytprefsscript'), 100);
            remove_action('wp_enqueue_scripts', array('YouTubePrefs', 'fitvids'), 101);
            remove_action('wp_head', array('YouTubePrefs', 'do_ogvideo'));
        }
    }
    add_action( 'wp_enqueue_scripts', 'a24m_script_enqueue');
/*
    ==========================================
     Filter taxonomies
    ==========================================
*/
    function ajax_filter_videos_scripts() {
      // Enqueue script
      wp_register_script('afp_script', get_template_directory_uri().'/js/ajax-filter-videos.js', false, null, false);
      wp_enqueue_script('afp_script');
     
      wp_localize_script( 'afp_script', 'afp_vars', array(
            'afp_nonce' => wp_create_nonce( 'afp_nonce' ), // Create nonce which we later will use to verify AJAX request
            'afp_ajax_url' => admin_url( 'admin-ajax.php' ),
          )
      );
    }

    add_action('wp_enqueue_scripts', 'ajax_filter_videos_scripts', 100);
/*
    ==========================================
     Activate menus
    ==========================================
*/
    function a24m_theme_setup() {

        add_theme_support('menus');

        register_nav_menu('primary', 'Primary Header Navigation');
        register_nav_menu('secondary', 'Footer Navigation');    
    }
    add_action('init', 'a24m_theme_setup');
/*
    ==========================================
     Theme support function
    ==========================================
*/
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats',array('aside','image','video'));
add_theme_support('html5',array('search-form'));
/* ==========================================
	 Include scripts
	========================================== */
    require_once get_template_directory() . '/inc/image_taxonomy.php';

    require_once get_template_directory() . '/inc/ajax.php';

    function a24_music_custom_videos() {
        $labels = array(
            'name'                  => _x( 'A24videos', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'A24Video', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'A24Videos', 'text_domain' ),
            'name_admin_bar'        => __( 'A24videos', 'text_domain' ),
            'archives'              => __( 'A24 Archives', 'text_domain' ),
            'parent_item_colon'     => __( 'Video parent:', 'text_domain' ),
            'all_items'             => __( 'Toutes les vidéos', 'text_domain' ),
            'add_new_item'          => __( 'Ajouter une vidéo', 'text_domain' ),
            'add_new'               => __( 'Nouvelle vidéo', 'text_domain' ),
            'new_item'              => __( 'Nouvelle vidéo', 'text_domain' ),
            'edit_item'             => __( 'Editer', 'text_domain' ),
            'update_item'           => __( 'Mettre à jour', 'text_domain' ),
            'view_item'             => __( 'Voir la vidéo', 'text_domain' ),
            'search_items'          => __( 'Rechercher une vidéo', 'text_domain' ),
            'not_found'             => __( 'Vidéo introuvable', 'text_domain' ),
            'not_found_in_trash'    => __( 'Aucune vidéo dans la corbeille', 'text_domain' ),
            'featured_image'        => __( 'Image à la une', 'text_domain' ),
            'set_featured_image'    => __( 'Définir une image à la une', 'text_domain' ),
            'remove_featured_image' => __( 'Supprimer l\'image à la une', 'text_domain' ),
            'use_featured_image'    => __( 'Utiliser image à la une', 'text_domain' ),
            'insert_into_item'      => __( 'Ajouter à l\'article', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Charger à la vidéo', 'text_domain' ),
            'items_list'            => __( 'Liste des vidéos', 'text_domain' ),
            'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filtrer', 'text_domain' ),
        );
        $args = array(
            'label'                 => __( 'A24video', 'text_domain' ),
            'description'           => __( 'Vidéo Africa 24 music.', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'author','thumbnail' ,'comments'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );
        register_post_type( 'a24videos', $args );
    }
    add_action( 'init', 'a24_music_custom_videos', 0 );

/** let's edit the custom form tag to allow file upload */
function edit_form_tag( ) {
    echo ' enctype="multipart/form-data"';
}
add_action( 'playlist_term_edit_form_tag' , 'edit_form_tag' );

function a24_custom_taxonomies(){
    /*      ===Genres musicaux===       */
    $labelGenres = array(
        'name'                  => _x( 'Genres musicaux', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Genre musical', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Genres musicaux', 'text_domain' ),
        'name_admin_bar'        => __( 'Genres musicaux', 'text_domain' ),
        'archives'              => __( 'Archives genres musicaux', 'text_domain' ),
        'parent_item_colon'     => __( 'Genre parent', 'text_domain' ),
        'all_items'             => __( 'Tous les genres musicaux', 'text_domain' ),
        'add_new_item'          => __( 'Ajouter un genre musical', 'text_domain' ),
        'add_new'               => __( 'Nouveau genre musical', 'text_domain' ),
        'new_item'              => __( 'Nouveau genre musical', 'text_domain' ),
        'edit_item'             => __( 'Editer le genre', 'text_domain' ),
        'update_item'           => __( 'Mettre à jour', 'text_domain' ),
        'view_item'             => __( 'Voir le genre', 'text_domain' ),
        'search_items'          => __( 'Rechercher un genre', 'text_domain' ),
        'not_found'             => __( 'Genre introuvable', 'text_domain' ),
        'not_found_in_trash'    => __( 'Aucun genre musical dans la corbeille', 'text_domain' ),
    );
    $argsGenres = array(
        'hierarchical' => true,
        'labels' => $labelGenres,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'genres' )
    );
    /*      ===PLAYLIST===       */
    $labelPlaylists = array(
        'name'                  => _x( 'Playlists', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Playlist', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Playlists', 'text_domain' ),
        'name_admin_bar'        => __( 'Playlists', 'text_domain' ),
        'archives'              => __( 'Archives Playlists', 'text_domain' ),
        'all_items'             => __( 'Tous les playlists', 'text_domain' ),
        'add_new_item'          => __( 'Ajouter une playlist', 'text_domain' ),
        'add_new'               => __( 'Nouvelle playlist', 'text_domain' ),
        'new_item'              => __( 'Nouvelle playlist', 'text_domain' ),
        'edit_item'             => __( 'Editer la Playlist', 'text_domain' ),
        'update_item'           => __( 'Mettre à jour', 'text_domain' ),
        'view_item'             => __( 'Voir la playlist', 'text_domain' ),
        'search_items'          => __( 'Rechercher une playlist', 'text_domain' ),
        'not_found'             => __( 'Playlists introuvable', 'text_domain' ),
        'not_found_in_trash'    => __( 'Aucune playlist dans la corbeille', 'text_domain' ),
    );
    $argsPlaylists = array(
        'hierarchical' => true,
        'labels' => $labelPlaylists,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'playlists' )
    );
    /*      ===RUBRIQUES===       */
    $labelRubriques = array(
        'name'                  => _x( 'Rubriques', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Rubrique', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Rubriques', 'text_domain' ),
        'name_admin_bar'        => __( 'Rubriques', 'text_domain' ),
        'archives'              => __( 'Archives rubriques', 'text_domain' ),
        'all_items'             => __( 'Tous les rubriques', 'text_domain' ),
        'add_new_item'          => __( 'Ajouter un rubriques', 'text_domain' ),
        'add_new'               => __( 'Nouveau rubriques', 'text_domain' ),
        'new_item'              => __( 'Nouveau rubriques', 'text_domain' ),
        'edit_item'             => __( 'Editer le rubriques', 'text_domain' ),
        'update_item'           => __( 'Mettre à jour', 'text_domain' ),
        'view_item'             => __( 'Voir le rubrique', 'text_domain' ),
        'search_items'          => __( 'Rechercher un rubrique', 'text_domain' ),
        'not_found'             => __( 'Rubriques introuvable', 'text_domain' ),
        'not_found_in_trash'    => __( 'Aucun rubrique dans la corbeille', 'text_domain' ),
    );
    $argsRubriques = array(
        'hierarchical' => true,
        'labels' => $labelRubriques,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'rubriques' )
    );
    /*      ===Pays===       */
    $labelPays = array(
        'name'                  => _x( 'Pays', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Pays', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Pays', 'text_domain' ),
        'name_admin_bar'        => __( 'Pays', 'text_domain' ),
        'archives'              => __( 'Archives Pays', 'text_domain' ),
        'all_items'             => __( 'Tous les Pays', 'text_domain' ),
        'add_new_item'          => __( 'Ajouter un pays', 'text_domain' ),
        'add_new'               => __( 'Nouveau pays', 'text_domain' ),
        'new_item'              => __( 'Nouveau pays', 'text_domain' ),
        'edit_item'             => __( 'Editer le pays', 'text_domain' ),
        'update_item'           => __( 'Mettre à jour', 'text_domain' ),
        'view_item'             => __( 'Voir le pays', 'text_domain' ),
        'search_items'          => __( 'Rechercher un pays', 'text_domain' ),
        'not_found'             => __( 'Pays introuvable', 'text_domain' ),
        'not_found_in_trash'    => __( 'Aucun pays dans la corbeille', 'text_domain' ),
    );
    $argsPays = array(
        'label'                 => __( 'Pays', 'text_domain' ),
        'description'           => __( 'Taxonomi pays des vidéos Africa 24 music.', 'text_domain' ),
        'labels'                => $labelPays,
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => array('slug' => 'pays'),
    );


    register_taxonomy('genres', array('a24videos'), $argsGenres);
    register_taxonomy('pays', array('a24videos'), $argsPays);
    register_taxonomy('playlist', array('a24videos'), $argsPlaylists);
    register_taxonomy('rubriques', array('a24videos'), $argsRubriques);

    register_taxonomy('video_tags', 'a24videos', array(
        'label' => 'Video tags',
        'rewrite' => array( 'slug' => 'tags' ),
        'hierarchical' => false
    ) );
}
add_action( 'init', 'a24_custom_taxonomies');
/**====================================================================
 * Here we are removing default wordpress pagination from search post
 ======================================================================*/
function jc_limit_search_posts() {
    if ( is_search())
        set_query_var('posts_per_page', -1);
}
add_filter('pre_get_posts', 'jc_limit_search_posts');
/*======================================================================*/


function a24videos_get_terms( $postID, $term ){
    $terms_list = wp_get_post_terms($postID, $term); 
    $output = '';
                    
    $i = 0;
    foreach( $terms_list as $term ){ $i++;
        if( $i > 1 ){ $output .= ' '; }
        $output .= '<a class="tag" href="' . get_term_link( $term ) . '">'. $term->name .'</a>';
    }
    
    return $output;
}

function a24videos_get_terms_list( $postID, $term, $field = 'name' ){
    $terms_list = wp_get_post_terms($postID, $term); 
    $output = '';

    foreach( $terms_list as $term ){ $output[] = $term->$field ; }

    return $output;
}

function a24videos_get_a_term( $postID, $term, $field = 'name' ){
    $terms_list = wp_get_post_terms($postID, $term); 
    $output = '';
    return @$terms_list[0]->$field;
}

function a24videos_get_search_nbr_results( $wp_query ){
    $i = 0 ;
    $playlistArray = array() ;
    /*while ( $wp_query->have_posts() ) {
        the_post() ;
        $i++ ;
    }*/
    while ( $wp_query->have_posts() ) {
        the_post() ;
        $playlist  = a24videos_get_a_term(get_the_id(), 'playlist', 'term_id') ;
        $playlist_name  = a24videos_get_a_term(get_the_id(), 'playlist') ;
        if($playlist != null){
            if(in_array($playlist_name, $playlistArray)) {continue ;}
            $i++ ;
            $playlistArray[] = $playlist ;
        }
    }
    $c = $wp_query->post_count + $i ;
    $l = $wp_query->found_posts + $i ;
    $rslt = $l>1?'résultats':'résultat' ;
    return $return = $l.' '.$rslt ;
}

function a24videos_get_all_terms( $term ){
    return $terms_list = get_terms($term,FALSE);
}
/*========================================================
 * Fonction qui va retourner un extrait d'un text utilis2
 * pour customiser la longeur de l'extrait
 ========================================================*/
function a24m_excerpt($text,$nbr=20){
    $string ="" ;
    $tab = explode(' ', $text) ;
    $nbrmo = count($tab) ;
    if($nbrmo <= $nbr)
        return $text ;
    for ($i = 0; $i<$nbrmo; $i++) {
        $string .= $tab[$i].' ' ;
        if ($i >= $nbr) {
            break ;
        }
    }
    return "$string ...";
}
/* ==========================================
     SET POST VIEW
    ========================================== */
function wpb_set_post_views($postID) {
    $count_key = 'wpb_a24videos_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');
function wpb_get_videos_views($postID){
    $count_key = 'wpb_a24videos_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return 0 ;
    }
    return $count ;
}
/* ===========================================
    CUSTOMIZE WP-POST RATING
   =========================================== *
   // WP Post Ratings Override plugin images, from plugin source
    function my_deregister_script() {
        $postratings_max = intval(get_option('postratings_max'));
        $postratings_ajax_style = get_option('postratings_ajax_style');
        $postratings_custom = intval(get_option('postratings_customrating'));
        if($postratings_custom) {
            for($i = 1; $i <= $postratings_max; $i++) {
                $postratings_javascript .= 'var ratings_'.$i.'_mouseover_image=new Image();ratings_'.$i.'_mouseover_image.src=ratingsL10n.plugin_url+"/images/"+ratingsL10n.image+"/rating_'.$i.'_over."+ratingsL10n.image_ext;';
            }
        } else {
            $postratings_javascript = 'var ratings_mouseover_image=new Image();ratings_mouseover_image.src=ratingsL10n.plugin_url+"/images/"+ratingsL10n.image+"/rating_over."+ratingsL10n.image_ext;';
        }
        wp_deregister_script( 'wp-postratings' );
        wp_enqueue_script('wp-postratings', plugins_url('wp-postratings/postratings-js.js'), array('jquery'), WP_POSTRATINGS_VERSION, true);
        wp_localize_script('wp-postratings', 'ratingsL10n', array(
            'plugin_url' => get_bloginfo('stylesheet_directory') . '/images/ratings',
            'ajax_url' => admin_url('admin-ajax.php'),
            'text_wait' => __('Please rate only 1 post at a time.', 'wp-postratings'),
            'image' => get_option('postratings_image'),
            'image_ext' => 'png',
            'max' => $postratings_max,
            'show_loading' => intval($postratings_ajax_style['loading']),
            'show_fading' => intval($postratings_ajax_style['fading']),
            'custom' => $postratings_custom,
            'l10n_print_after' => $postratings_javascript
        ));
    }
    add_action( 'wp_print_scripts', 'my_deregister_script', 100 );
    // Fixing WP-Ratings plugin initial output, to match Design
    function prefix_ratings_fix($html) {
        $search = plugins_url( '/wp-postratings/images/stars/' );
        $replace = get_bloginfo('stylesheet_directory') . '/images/ratings/images/stars/';

        $html = str_replace($search, $replace, $html);

        return $html;
    }
    add_filter( 'expand_ratings_template', 'prefix_ratings_fix', 999, 1 ); // WP-Ratings Filter
    
    /*  ========================== include taxonomy in search ======================= */
    //via http://wordpress.stackexchange.com/questions/2623/include-custom-taxonomy-term-in-search/5404#5404

    function a24m_search_where($where){
        global $wpdb;

        if ( is_search() )
        $where .= "OR (t.name LIKE '%".get_search_query() . "%' AND {$wpdb->posts} . post_status = 'publish')";

        return $where;
    }

    function a24m_search_join($join){
        global $wpdb;

        if ( is_search() )
        $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
        return $join;
    }

    function a24m_search_groupby($groupby){
        global $wpdb;

        // we need to group on post ID
        $groupby_id = "{$wpdb->posts} . ID";
        if ( ! is_search() || strpos($groupby, $groupby_id) !== false )
        return $groupby;

        // groupby was empty, use ours
        if ( ! strlen( trim($groupby) ) )
        return $groupby_id;

        // wasn't empty, append ours
        return $groupby . ", " . $groupby_id;
    }

    add_filter('posts_where', 'a24m_search_where');
    add_filter('posts_join', 'a24m_search_join');
    add_filter('posts_groupby', 'a24m_search_groupby');
/*===================================   include custom fields in search ======================================*/
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    
    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;
   
    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );
/*==============================================
    ------------------------------------------
================================================*/
// Enregistrement des sidebar et des widgets
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'ESPACE_PUB 1',
        'id' => 'w1',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => 'ESPACE_PUB 2',
        'id' => 'w2',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => 'ESPACE_PUB 3',
        'id' => 'w3',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => 'ESPACE_PUB 4',
        'id' => 'w4',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => 'ESPACE_PUB 5',
        'id' => 'w5',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));
}

//add code for comments
function switch_on_comments_automatically(){
    global $wpdb;
    $wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET comment_status = 'open'")); // Switch comments on automatically
} 

function default_comments_on( $data ) {
    if( $data['post_type'] == 'A24videos' ) {
        $data['comment_status'] = 1;
    }

    return $data;
}
add_filter( 'wp_insert_post_data', 'default_comments_on' );


/************Search engine on videos List**************/
function template_chooser($template) {
    global $wp_query;   
    $post_type = get_query_var('post_type'); 
    //$post_type = get_post_type();  
    //if( isset($_GET['s']) && $post_type == 'a24videos' )   
    if($wp_query->is_search() && $post_type =='a24videos')
    {
    set_query_var('posts_per_page', 4);
    return locate_template('archive-a24videos.php');  //  redirect to archive-search.php
    }   
    return $template;   
}
add_filter('template_include', 'template_chooser');

/**===============================================================/
=================================================================*/

function save_send_video_forms() {
    global $wpdb;
    $table_name = $wpdb->prefix."users_videos" ;
    $post = array() ;
        $post['artiste_name']       = @$_POST['artiste'] ;
        $post['video_title']        = @$_POST['titre'] ;
        $post['featuring']          = @$_POST['artistes'] ;
        $post['productor_name']     = @$_POST['producteur'] ;
        $post['genre_id']           = @$_POST['genre'] ;
        $post['countrie_id']        = @$_POST['video_countrie'] ;
        $post['year_prod']          = @$_POST['year'] ;
        $post['yt_link']            = @$_POST['yt_link'] ;
        $post['video_thumb']        = @$_POST['thumbnail'] ;
        $post['wetransfer_link']    = @$_POST['wetransfer_link'] ;
        $post['dropbox_link']       = @$_POST['dropbox_link'] ;
        $post['steps']              = 0 ;
        $post['created_at']         = date('Y-m-d H:i:s') ;
        $post['updated_at']         = date('Y-m-d H:i:s') ;

    /*$wpdb->show_errors();
    if( $wpdb->insert( $table_name, $post ) ){
        echo "Data well saved";
    } else {
        // echo $wpdb->show_errors() ;
        echo "ERROR while saving data";
        // wp_safe_redirect(home_url().'/envoyez-vos-clips');
    }*/
    echo "Nicely done" ;
    die();
}
add_action( 'wp_ajax_save_send_video_form', 'save_send_video_form' );
add_action( 'wp_ajax_nopriv_save_send_video_form', 'save_send_video_form' );

/**===============================================================/

            SOME CUSTOM FUNCTIONS FOR VIDEOS MANAGMENT
=================================================================*/

/**
 * From this hook we will add query vars that will be callable from the URL
 * @param [type] $aVars [description]
 */
function add_query_vars($aVars) {
    $aVars[] = "em_number"; 
    return $aVars;
}
add_filter('query_vars', 'add_query_vars');

/**
 * Here we add the rewrite rule for the query we created above
 * @param [type] $aVars [description]
*/
function add_rewrite_rules($aRules) {
    // $aNewRules = array('msds-pif/([^/]+)/?$'      => 'index.php?pagename=msds-pif&msds_pif_cat=$matches[1]');
    $aNewRules = array('video-details/([^/]+)/?$' => 'index.php?pagename=video-details&em_number=$matches[1]');
    $aRules = $aNewRules + $aRules;
    return $aRules;
}
add_filter('rewrite_rules_array', 'add_rewrite_rules');


function clip($id_clip, $fields = "*") {
    global $wpdb;
    $table_name     = $wpdb->prefix."uploaded_file" ;

    $resultat = $wpdb->get_row("SELECT $fields FROM $table_name WHERE id_uploaded_clip = $id_clip", ARRAY_A) ;
    return $resultat ;
}

function clips($fields = "*", $where_clause = "1", $order = 'created_at DESC', $return_type = OBJECT ) {
    global $wpdb;
    $table_name     = $wpdb->prefix."uploaded_file" ;

    $resultat = $wpdb->get_results("SELECT $fields FROM $table_name WHERE $where_clause ORDER BY $order", OBJECT) ;
    return $resultat ;
}

function userClips($user_id,$fields = "*", $where_clause = "1", $order = 'created_at DESC', $return_type = OBJECT ) {
    global $wpdb;
    $table_name     = $wpdb->prefix."uploaded_file" ;

    $resultat = $wpdb->get_results("SELECT $fields FROM $table_name WHERE user_id = $user_id ORDER BY $order", OBJECT) ;
    return $resultat ;
}


/*****Manage User Capabilities of the Plugin A24-Manager******/

function add_sendvideos_caps() {

    $role_editor = get_role('editor');
    $role_editor->add_cap( 'manage_videos' );

    $role_admin = get_role('administrator');
    $role_admin->add_cap('manage_videos');

}

add_action('admin_init', 'add_sendvideos_caps');

/*****Manage User Capabilities of the Plugin A24-Manager******/