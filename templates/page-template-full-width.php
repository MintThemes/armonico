<?php
/**
 * Template Name: Full Width
 *
 * @package Intro
 * @since Intro 1.0
 */

get_header(); ?>
<div id="main">
    <div class="boot">
    
        <div id="content" class="full-width">
        
            <?php while ( have_posts() ) : the_post(); ?>
				<div class="post-holder">
					<?php get_template_part( 'content', 'page' ); ?>
    
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                            comments_template( '', true );
                    ?>
				</div><!-- #post-<?php the_ID(); ?> -->  
            <?php endwhile; // end of the loop. ?>
        </div>
    </div>
</div><!-- main end -->
<?php get_footer(); ?>
