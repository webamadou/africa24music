<?php
/*

======================
	AJAX FUNCTIONS 
======================
	
*/
/*add_action( 'wp_ajax_nopriv_videos_load_more', 'videos_load_more');
add_action( 'wp_ajax_videos_load_more', 'videos_load_more');

function videos_load_more(){
	$paged = $_POST["page"]+1;	

	$query = new WP_Query( array(
		'post_type' => 'a24videos',
		'paged' => $paged,
		'order' => 'DESC'
 		) );
	if( $query->have_posts() ){
		while ($query->have_posts()) {
				$query->the_post();
				get_template_part('contents/content', 'rubriques');
		}//End while loop

	}
	wp_reset_postdata();
	die();

}*/


/********Ajax Infinite Scroll for tag taxonomy**********/
add_action( 'wp_ajax_nopriv_tag_taxonomy', 'tag_taxonomy');
add_action( 'wp_ajax_tag_taxonomy', 'tag_taxonomy');

function tag_taxonomy($tri){
	$paged = $_POST["page"]+1;
	$slug = $_POST["tag_slug"];
	$tag_tax = $_POST["tag_tax"];

	if (!empty($_POST['tri'])) {

		$tri = $_POST['tri'];
	}
	$args = array(
		'post_type' => 'a24videos',
		'paged' => $paged,
		'order' => 'DESC',
		'meta_key' => '',
      'tax_query' => array(array('taxonomy' => $tag_tax,
                                 'field'    => 'slug',
                                 'terms'    => $slug
                                )),
 		);
/***Tri*****/
	if( !$tri ) {
	unset( $args['meta_key'] );
	unset($args['orderby']);
	$args['order'] = 'DESC';
	}
	if($tri =="popular") : 
	    $args['meta_key'] = 'wpb_a24videos_count';
	    $args['orderby'] = 'meta_value_num';
		$args['order'] = 'DESC';
	endif;
	if($tri =="rated") : 
	    $args['meta_key'] = 'ratings_average';
	    $args['orderby'] = 'meta_value_num';
		$args['order'] = 'DESC';
	endif;
	if($tri =="az") : 
		if ($args['meta_key']) {
			unset($args['meta_key']);
		}
	    $args['orderby'] = 'title';
		$args['order'] = 'ASC';
	endif;
	if($tri =="za") :
		if ($args['meta_key']) {
			unset($args['meta_key']);
		} 
	    $args['orderby'] = 'title';
		$args['order'] = 'DESC';
	endif;
/***End Tri*****/

	$query = new WP_Query($args);
	 $maxpages = $query->max_num_pages;

	if( $query->have_posts() ){
		while ($query->have_posts()) {
				$query->the_post();
				get_template_part('contents/content', 'rubriques');
		}//End while loop
		if ($paged < $maxpages) {
?>
		<script>
		jQuery(document).ready(function($) {
			$('.see-more').show();
		});
		</script>
<?php
		}else {
?>
<script>
jQuery(document).ready(function($) {
	$('.see-more').hide();
});
</script>
<?php
		}
	}
	else {
			echo "<p align='center'>Aucune vidéo correspondante au tri trouvé</p>";
		}

	wp_reset_postdata();
	die();
}
/********End of Ajax Infinite Scroll for tag taxonomy**********/

/********Ajax Infinite Scroll for Popular**********/
add_action( 'wp_ajax_nopriv_tag_popular', 'tag_popular');
add_action( 'wp_ajax_tag_popular', 'tag_popular');

function tag_popular(){
	$paged = $_POST["page"]+1;
	$query = new WP_Query( array(
		'post_type' => 'a24videos',
		'paged' => $paged,
		'order' => 'DESC',
        'meta_key'          => 'wpb_a24videos_count',
        'orderby'            => 'meta_value_num',
 		));



	 $maxpages = $query->max_num_pages;
	if( $query->have_posts() ){		
		while ($query->have_posts()) {
				$query->the_post();
				get_template_part('contents/content', 'rubriques');
		}//End while loop
		if ($paged < $maxpages) {
?>
		<script>
		jQuery(document).ready(function($) {
			$('.see-more').show();
		});
		</script>
<?php
		}else {
?>
<script>
jQuery(document).ready(function($) {
	$('.see-more').hide();
});
</script>
<?php
		}
	}
	wp_reset_postdata();
	die();
}
/********End of Ajax Infinite Scroll for Popular**********/

// Script for getting posts
function ajax_filter_get_videos( $taxonomy, $tri ) {
 
  // Verify nonce
  if( !isset( $_POST['afp_nonce'] ) || !wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ) )
    die('Permission denied');
 
 	$paged = $_POST["page"]+1;	
if(!empty($_POST['taxonomy'])) {

  $taxonomy = $_POST['taxonomy'];
  //$tax = $_POST['tax'];


      foreach ($taxonomy as $tax => $slugs) :
        $tax_qry[] = [
            'taxonomy' => $tax,
            'field'    => 'name',
            'terms'    => $slugs,
        ];
    endforeach;

}
//Tri
if (!empty($_POST['tri'])) {

	$tri = $_POST['tri'];
}
  // WP Query
  $args = array(
    'post_type' => 'a24videos',
		'paged' => $paged,
		'order' => 'DESC',
		'meta_key' => '',
  );
 
  if( !$tri ) {
    unset( $args['meta_key'] );
    unset($args['orderby']);
    $args['order'] = 'DESC';
  }
	if ($tax_qry) :
	    $args['tax_query'] = $tax_qry;
	endif;

	if($tri =="popular") : 
	    $args['meta_key'] = 'wpb_a24videos_count';
	    $args['orderby'] = 'meta_value_num';
		$args['order'] = 'DESC';

	endif;

	if($tri =="rated") : 
	    $args['meta_key'] = 'ratings_average';
	    $args['orderby'] = 'meta_value_num';
		$args['order'] = 'DESC';

	endif;

	if($tri =="az") : 
		if ($args['meta_key']) {
			unset($args['meta_key']);
		}
	    $args['orderby'] = 'title';
		$args['order'] = 'ASC';

	endif;

	if($tri =="za") :
		if ($args['meta_key']) {
			unset($args['meta_key']);
		} 
	    $args['orderby'] = 'title';
		$args['order'] = 'DESC';
	endif;
  $query = new WP_Query( $args );
  $maxpages = $query->max_num_pages;

	if( $query->have_posts() ){


		while ($query->have_posts()) {
				$query->the_post();
				get_template_part('contents/content', 'rubriques');
		}//End while loop


		if ($paged < $maxpages) {
?>
		<script>
		jQuery(document).ready(function($) {
			$('.see-more').show();
		});
		</script>
<?php
		}

	} else {

		echo "<p align='center'>Aucune vidéo correspondante au filtre trouvé</p>";

	}
	wp_reset_postdata();

 
  die();
}
 
add_action('wp_ajax_filter_videos', 'ajax_filter_get_videos');
add_action('wp_ajax_nopriv_filter_videos', 'ajax_filter_get_videos');

?>