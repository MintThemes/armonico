<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce_loop, $woocommerce, $product;

$crosssells = $woocommerce->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 		=> 2,
	'no_found_rows' 		=> 1,
	'orderby' 				=> 'rand',
	'post__in' 				=> $crosssells
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= 2;

if ( $products->have_posts() ) : ?>

	 <div class="related products"> 
     <h2><?php _e('You may also be interested in&hellip;', 'armonico') ?></h2>      
        <div class="product-list">
            <ul class="list ">
                <div class="mintthemes_isotopes_container">
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
                
                        <?php woocommerce_get_template_part( 'content', 'product-related' ); ?>
            
                    <?php endwhile; // end of the loop. ?>
                </div>   
            </ul>
        </div>
    </div>

<?php endif;

wp_reset_query();
