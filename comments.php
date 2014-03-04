<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to armonico_comment() which is
 * located in the functions.php file.
 *
 * @package armonico
 * @since armonico 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'armonico' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'armonico' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'armonico' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'armonico' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use armonico_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define armonico_comment() and that will be used instead.
				 * See armonico_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'armonico_comment' ) );
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'armonico' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'armonico' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'armonico' ) ); ?></div>
		</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'armonico' ); ?></p>
	<?php endif; ?>

	
	<div class="comments-form">
		<?php
			$fields = array(
				'author' => '<div class="comment-form-author row">
								<input id="author" class="txt" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr( __( 'Your Name: (Required)', 'intro' ) ) . '" />
							</div>',
				'email'  => '<div class="comment-form-email row">
								<input id="email" class="txt" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr( __( 'Your Email: (Required)', 'intro' ) ) . '" />
							</div>',
				'url'    => '<div class="comment-form-url row">
								<input id="url" class="txt" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_attr( __( 'Your Website: (Required)', 'intro' ) ) . '" />
							</div>'
			);
			
			$comment = '<div class="comment-form-comment row">
							<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
						</div>';

			$comment_form_args = array(
				'title_reply'          => __( 'Have something to say?', 'intro' ),
				'fields'               => $fields,
				'comment_field'        => $comment,
				'comment_notes_after'  => '',
				'comment_notes_before' => '',
				'label_submit'         => __( 'Submit', 'intro' )
			);
			
			comment_form( apply_filters( 'comment_form_args', $comment_form_args ) ); 
		?>
	</div>

</div><!-- #comments .comments-area -->
