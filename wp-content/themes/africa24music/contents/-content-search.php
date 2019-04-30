<div class="col-xs-12 col-sm-6 col-md-3">
	<div class="video-item-cadre">
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		<?php the_title('<h1 class="entry-title">','</h1>' ); ?>
		<?php if( has_post_thumbnail() ): ?>
			<div class="pull-left"><?php the_post_thumbnail('thumbnail'); ?></div>
		<?php endif; ?>
		<small><?php the_category(' '); ?> || <?php the_tags(); ?> || <?php edit_post_link(); ?></small>
		<?php the_excerpt(); ?>
		<hr>
	</article>
	</div>
</div>
<?php
if (have_posts()) { ?>
    <h3><?php printf( __( 'Search Results for: %s'), '<span>' . get_search_query() . '</span>' ); ?></h3>
<?php }
query_posts('category_name=blog'); ?>
    <?php if (have_posts()) { ?>
        <?php $blogResults=0; ?>
        <?php while (have_posts()) { the_post(); ?>
            <?php $blogResults++; ?>
        <?php } ?>
        <h3><?php echo $blogResults; ?> Results in BLOG</h3>
        <?php while (have_posts()) { the_post(); ?>
            <div class="films">
                <div class="thumb">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
                </div>
                <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                <div class="entry">
                    <?php the_excerpt() ?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php query_posts('category_name=films'); ?>
    <?php if (have_posts()) { ?>
            <?php $fimlsResults=0; ?>
        <?php while (have_posts()) { the_post(); ?>
            <?php $filmsResults++; ?>
        <?php } ?>
    	<h3><?php echo $filmsResults; ?> Results in Films</h3>
        <?php while (have_posts()) { the_post(); ?>
            <div class="films">
                <div class="thumb">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
                </div>
                <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                <div class="entry">
                    <?php the_excerpt() ?>
                </div>
            </div>
        <?php } ?>
	<?php }