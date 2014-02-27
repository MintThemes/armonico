<?php
/**
 * Single Product Thumbnails
 */

global $post, $woocommerce;
?>
	<?php	
	$attachments = get_posts( array(
		'post_type' 	=> 'attachment',
		'numberposts' 	=> -1,
		'post_status' 	=> null,
		'post_parent' 	=> $post->ID,
		'post_mime_type'=> 'image',
		'orderby'		=> 'menu_order',
		'order'			=> 'ASC'
	) );
	if ($attachments) {
		?>
        <div class="thumbnails">
        <?php
		
		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
		
		foreach ( $attachments as $key => $attachment ) {
			
			if ( get_post_meta( $attachment->ID, '_woocommerce_exclude_image', true ) == 1 ) 
				continue;
				
			$classes = array( 'zoom' );
			
			if ( $loop == 0 || $loop % $columns == 0 ) 
				$classes[] = 'first';
			
			if ( ( $loop + 1 ) % $columns == 0 ) 
				$classes[] = 'last';

			printf( '<a href="%s" title="%s" rel="thumbnails" class="%s"><img src="' . aq_resize( wp_get_attachment_url( $attachment->ID ), 100, 100, true ) . '" width="97" height="97" /></a>', wp_get_attachment_url( $attachment->ID ), esc_attr( $attachment->post_title ), implode(' ', $classes), aq_resize( wp_get_attachment_url( $attachment->ID ), 100, 100, true ) );
			
			$loop++;

		}
		
	}
?>
<?php if ($attachments) { echo ('</div>');  } ?>