<?php
/**
 * @package armonico
 * @since armonico 1.0
 */
?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="ico">
     <a href="<?php the_permalink(); ?>"><span class="overlay"></span></a>
    	<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
		?>
        <a href="<?php the_permalink(); ?>"><img src="<?php echo aq_resize( $img_url, 204, 151, true );  ?>" width="204" height="151" alt="<?php the_title(); ?>" /></a>
    </div>
    <div class="price-box">
        <span class="price"><?php edd_price(get_the_ID()); ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="view">View</a>
</li>
