<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package armonico
 * @since armonico 1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="title">
        <h3><?php the_title(); ?></h3>
    </div>
    <div class="text">
       <?php the_content(); ?>
       <?php edit_post_link( __( 'Edit', 'armonico' ), '<span class="edit-link">', '</span>' ); ?>
    </div>
</div><!-- #post-<?php the_ID(); ?> -->                             
   