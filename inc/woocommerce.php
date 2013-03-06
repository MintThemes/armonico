<?php
/**
 * WooCommerce Tweaks
 *
 */

function mt_armonico_woocommerce() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
	remove_action('woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
	remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);

	

	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

	remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display' );

}
add_action( 'after_setup_theme', 'mt_armonico_woocommerce' );


/**
 * Custom Add To Cart Messages
 **/
add_action( 'woocommerce_add_to_cart_message', 'custom_add_to_cart_message' );
function custom_add_to_cart_message() {
	global $woocommerce;

	// Output success messages
	$return_to 	= get_permalink(woocommerce_get_page_id('shop'));

	$message 	= sprintf('<a href="%s" class="view view-cart">%s</a> %s', get_permalink(woocommerce_get_page_id('cart')), __('View Cart &rarr;', 'woocommerce'), __('Product successfully added to your cart.', 'woocommerce') );

	return $message;
}

/**
 * turn off all css styling from woocommerce
 **/
define('WOOCOMMERCE_USE_CSS', false);

/**
 * load woocommerce styles from woocommerce stylesheet included in the theme's css folder
 **/
function wp_enqueue_woocommerce_style(){
	wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
	if ( class_exists( 'woocommerce' ) ) {
		wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
		wp_enqueue_style( 'woocommerce' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );

