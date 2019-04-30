<?php
/**
 * The template part for displaying results in search pages
 * @package WordPress
 * @subpackage A24music
 * @version 1.0
 */
?>
<li class="col-xs-12">
    <div class="col-xs-2"><div class="thumbnail"><?php echo $thumbnail ?></div></div>
    <div class="col-xs-10">
        <h5>Vidéo</h5>
        <?php the_title( sprintf( '<strong class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></strong>' ); ?>
        <h3><?php echo get_field('artistes'); ?></h3>
        <p><?php echo get_field('description') ?></p>
    </div>
</li>
