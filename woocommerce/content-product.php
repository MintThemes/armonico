<?php
/**
 *
 */

global $product;
?>
 
<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="ico">
    <a href="<?php the_permalink(); ?>"><span class="overlay"></span></a>
    	<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
		?>
        <a href="<?php the_permalink(); ?>"><img src="<?php echo aq_resize( $img_url, 408, 302, true );  ?>" width="204" height="151" alt="<?php the_title(); ?>" /></a>
    </div>
    <div class="price-box">
    	 <?php
			/** 
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */	  
			do_action( 'woocommerce_before_shop_loop_item_title' ); 
		?>
         
        <?php
			/** 
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */	  
			do_action( 'woocommerce_after_shop_loop_item_title' ); 
		?>
        <span class="price"><?php echo __( ' Price: ', 'armonico' ); ?></span><?php woocommerce_template_loop_price(); ?> 
    </div>
     <a href="<?php the_permalink(); ?>" class="view">View</a>
</li>
<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>