<?php get_header();?>
<?php
// now run a query for each animal family
foreach( $terms as $term ) {
 
    // Define the query
    $args = array(
        'post_type' => 'animal',
        'animal_cat' => $term->slug
    );
    $query = new WP_Query( $args );
             
    // output the term name in a heading tag                
    echo'<h2>' . $term->name . '</h2>';
     
    // output the post titles in a list
    echo '<ul>';
     
        // Start the Loop
        while ( $query->have_posts() ) : $query->the_post(); ?>
 
        <li class="animal-listing" id="post-<?php the_ID(); ?>">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
         
        <?php endwhile;
     
    echo '</ul>';
     
    // use reset postdata to restore orginal query
    wp_reset_postdata();
 
} ?>
<?php get_footer() ?>