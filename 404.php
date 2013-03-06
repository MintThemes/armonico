<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package armonico
 * @since armonico 1.0
 */

get_header(); ?>

<div id="main">
    <div class="boot">
        <div id="sidebar">
            <?php get_sidebar(); ?>
        </div>
        <div id="content">
				<div class="post-holder">
					<div id="post-0" <?php post_class(); ?>>
                        <div class="title">
                            <h3><?php _e( 'Oops! That page can&rsquo;t be found.', 'armonico' ); ?></h3>
                        </div>
                        <div class="text">
                           <p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'armonico' ); ?></p>

							<?php get_search_form(); ?>
        
                           
                        </div>
                    </div><!-- #post-<?php the_ID(); ?> -->      
				</div><!-- #post-<?php the_ID(); ?> -->  
        </div>
    </div>
</div><!-- main end -->
<?php get_footer(); ?>



