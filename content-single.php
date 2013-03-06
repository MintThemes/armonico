<?php
/**
 * @package armonico
 * @since armonico 1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="title">
        <h3><?php the_title(); ?></h3>
        <span class="date"><?php the_date("F j, Y"); ?></span>
        <div class="comment-info">
            <span> <?php comments_number( '0', '1', '%' ); ?></span>
        </div>
    </div>
    <div class="text">
       <?php armonico_the_video(); ?>
       <?php the_content(); ?>
       <?php edit_post_link( __( 'Edit', 'armonico' ), '<span class="edit-link">', '</span>' ); ?>
    </div>
    <div class="like-holder">
        <div class="holder">
            <?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'armonico' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', ', ' );

			if ( ! armonico_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'armonico' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'armonico' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'Posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'armonico' );
				} else {
					$meta_text = __( 'Posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'armonico' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>
        </div>
    </div>
</div><!-- #post-<?php the_ID(); ?> -->                             
   