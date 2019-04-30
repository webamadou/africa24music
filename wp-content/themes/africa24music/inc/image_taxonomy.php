<?php
require_once get_template_directory() . '/inc/taxonomy-term-image-master/taxonomy-term-image.php';//On inclus le plugin qui permet de charger des images sur taxonomie

/*===============================terme image taxonomie settings=====================================*/
function the_term_image_taxonomy( $taxonomy ) {return 'playlist'; }
// add_filter( 'taxonomy-term-image-taxonomy', 'the_term_image_taxonomy' );

function the_taxonomy_term_image_labels( $labels ) {
        $labels['fieldTitle']       = 'Playlist image';
        $labels['fieldDescription'] = __( 'Selectionner une image pour la playlist', 'yourdomain' );

        return $labels;
    }
    add_filter( 'taxonomy-term-image-labels', 'the_taxonomy_term_image_labels' );

function the_taxonomy_term_image_meta_key( $option_name ) {return 'playlist_image'; }
add_filter( 'taxonomy-term-image-meta-key', 'the_taxonomy_term_image_meta_key' );

function my_taxonomy_term_image_js_dir_url( $option_name ) {
    return get_template_directory_uri(). '/inc/taxonomy-term-image-master/js';
}
// add_filter( 'taxonomy-term-image-js-dir-url', 'my_taxonomy_term_image_js_dir_url' );


// Add term page
function playlist_add_tags() {
    // this will add the custom meta field to the add new term page
    ?>
    <div class="form-field">
        <label for="term_meta_playlist_tags"><?php _e( 'Tags', 'Africa24Music' ); ?></label>
        <input id="videoTags" type="text" name="term_meta[custom_term_meta]" value="">
        <p class="description"><?php _e( 'Enter a value for this field','Africa24Music' ); ?></p>
    </div>
<?php
}
// add_action( 'playlist_add_form_fields', 'playlist_add_tags', 10, 2 );
// Edit term page


function playlist_edit_tags($term) {
 
    // put the term ID into a variable
    $t_id = $term->term_id;
 
    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option( "taxonomy_$t_id" ); ?>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Example meta field', 'Africa24Music' ); ?></label></th>
        <td>
            <input type="text" name="term_meta[custom_term_meta]" id="videoTags" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
            <p class="description"><?php _e( 'Enter a value for this field','Africa24Music' ); ?></p>
        </td>
    </tr>
<?php
}
// add_action( 'playlist_edit_form_fields', 'playlist_edit_tags', 10, 2 );

// Save extra taxonomy fields callback function.
function save_playlist_tags( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.
        update_option( "taxonomy_$t_id", $term_meta );
    }
}
/*add_action( 'edited_playlist', 'save_playlist_tags', 10, 2 );  
add_action( 'create_playlist', 'save_playlist_tags', 10, 2 );*/
