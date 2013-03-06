<?php
/**
 * The Template for displaying all single posts.
 *
 * @package armonico
 * @since armonico 1.0
 */

get_header(); ?>
<div id="main">
    <div class="boot">
        <div id="content">
        
            <?php while ( have_posts() ) : the_post(); ?>
				<div class="post-holder">
            
					<?php get_template_part( 'content', 'single' ); ?>
    
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                            comments_template( '', true );
                    ?>
				</div><!-- #post-<?php the_ID(); ?> -->  
            <?php endwhile; // end of the loop. ?>
        </div>
        <div id="sidebar">
			<?php get_sidebar(); ?>
        </div>
    </div>
</div><!-- main end -->
<?php get_footer(); ?>