<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package armonico
 * @since armonico 1.0
 */
?>
				
<div id="post-0" <?php post_class(); ?>>
    <div class="title">
        <h3><?php _e( 'Nothing Found', 'armonico' ); ?></h3>
    </div>
    <div class="text">
       <?php if ( is_home() ) : ?>

            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'armonico' ), admin_url( 'post-new.php' ) ); ?></p>

        <?php elseif ( is_search() ) : ?>

            <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'armonico' ); ?></p>
            <?php get_search_form(); ?>

        <?php else : ?>

            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'armonico' ); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>
    </div>
</div><!-- #post-<?php the_ID(); ?> -->      
        	
     



