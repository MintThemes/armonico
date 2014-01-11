<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package armonico
 * @since armonico 1.0
 */

if ( ! function_exists( 'armonico_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since armonico 1.0
 */
function armonico_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'armonico' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'armonico' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'armonico' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'armonico' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'armonico' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // armonico_content_nav

if ( ! function_exists( 'armonico_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since armonico 1.0
 */
function armonico_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'armonico' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'armonico' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" >
         <div class="ico">
           <?php echo get_avatar( $comment, 50 ); ?>
        </div>
			<footer>
				<div class="comment-author vcard">
					<?php printf( __( '%s', 'armonico' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'armonico' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php edit_comment_link( __( '(Edit)', 'armonico' ), ' ' );
					?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'armonico' ); ?></em>
					<br />
				<?php endif; ?>

				
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for armonico_comment()

if ( ! function_exists( 'armonico_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since armonico 1.0
 */
function armonico_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'armonico' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'armonico' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since armonico 1.0
 */
function armonico_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so armonico_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so armonico_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in armonico_categorized_blog
 *
 * @since armonico 1.0
 */
function armonico_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'armonico_category_transient_flusher' );
add_action( 'save_post', 'armonico_category_transient_flusher' );

if ( ! function_exists( 'armonico_paginate_links' ) ) :
/**
 * Paginate Links
 *
 * @since Armonico 1.0
 */
function armonico_paginate_links( $args = array() ) {
	global $wp_query;
	
	if ( get_query_var( 'paged' ) ) {
		$current_page = get_query_var( 'paged' );
	} else if ( get_query_var( 'page' ) ) {
		$current_page = get_query_var( 'page' );
	} else {
		$current_page = 1;
	}
	
	$permalink_structure = get_option('permalink_structure');
	$format = empty( $permalink_structure ) ? '?page=%#%' : 'page/%#%/';
	
	$defaults = array(
		'total'     => $wp_query->max_num_pages,
		'base'      => get_pagenum_link(1) . '%_%',
		'format'    => $format,
		'current'   => $current_page,
		'prev_next' => true,
		'prev_text'    => __('left'),
    	'next_text'    => __('right'),
		'type'      => 'list',
		'show_all'  => true
	);
	
	$args = wp_parse_args( $args, $defaults );

	echo paginate_links( apply_filters( 'armonico_paginate_links', $args ) );
}
endif;