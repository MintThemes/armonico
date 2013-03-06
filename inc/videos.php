<?php
/**
 * Video Embeds
 *
 * @package Intro
 * @since Intro 1.0
 */

/**
 * Determine if a post has a video.
 *
 * @since Intro 1.0
 */
function armonico_has_video() {
	global $post;
	
	$video = get_post_meta( $post->ID, 'video', true );
	
	if ( '' == $video )
		return false;
	
	return $video;
}

/**
 * Get the video embed
 *
 * @since Intro 1.0
 */
function armonico_the_video( $args = array() ) {
	global $post;
	
	$defaults = array(
		'width' => 725
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	$video = armonico_has_video();
	$video = wp_oembed_get( esc_url( $video ), $args );
	
	echo $video;
}

/**
 * Create the metabox
 *
 * @since Intro 1.0
 */
function armonico_metabox_post_video() {
	add_meta_box( 'armonico_video', __( 'Video', 'armonico' ), 'armonico_metabox_post_video_box', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'armonico_metabox_post_video' );

/**
 * Fill the created metabox with content.
 *
 * @since Intro 1.0
 */
function armonico_metabox_post_video_box( $post ) {
	/** Verification Field */
	wp_nonce_field( 'armonico-video', '_armonico_video_nonce' );

	/** Get Previous Value */
	$video = get_post_meta( $post->ID, 'video', true );
	$video = trim( html_entity_decode( esc_textarea( $video ) ) );
?>
	<label class="screen-reader-text" for="video"><?php _e( 'Video', 'armonico' ); ?></label>
	<textarea rows="1" cols="40" name="video" tabindex="6" id="video" style="width: 98%; height: 4em"><?php echo $video; ?></textarea>	
	
	<p><?php printf( __( 'For <a href="%s">oEmbed-enabled</a> video sites, simply paste the URL of the video above. Otherwise, paste the HTML embed code, making sure it has a width of <code>725px</code>.', 'armonico' ), 'http://codex.wordpress.org/Embeds' ); ?></p>
<?php
}

/**
 * Save the metabox
 *
 * @since Intro 1.0
 */
function armonico_metabox_post_video_save( $post_id, $post ) {
	// Bail if not a POST action
	if ( 'POST' !== strtoupper( $_SERVER[ 'REQUEST_METHOD' ] ) )
		return;
		
	/** Don't save when autosaving */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;
		
	/** Make sure we are on a page */
	if ( 'post' != $post->post_type )
		return $post_id;
	
	/** Check Nonce */
	if ( ! wp_verify_nonce( $_POST[ '_armonico_video_nonce' ], 'armonico-video' ) )
		return $post_id;
	
	/** video */
	$video = esc_html( $_POST[ 'video' ] );
		
	update_post_meta( $post_id, 'video', $video );
}
add_action( 'save_post', 'armonico_metabox_post_video_save', 10, 2 );