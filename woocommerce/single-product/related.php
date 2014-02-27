</div>

<?php
/**
 * Related Products
 */

global $product, $woocommerce_loop;

$related = $product->get_related();
$upsells = $product->get_upsells(); 

$related_posts = array_merge($related, $upsells);

if ( sizeof($related) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> 6,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related_posts
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>


    <div class="related products">       
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

wp_reset_postdata();
