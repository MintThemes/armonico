<?php
/**
 * Template Name: Home
 *
 * @package Armonico
 * @since Armonico 1.0
 */


get_header(); ?>

	<div id="main">
        <div class="gallery-holder">
			<?php
			$slideshow_args  = NULL;
			
			if ( armonico_get_theme_option( 'slider_type' ) == '0' ){
				$slideshow_args = array(
					'post_type' => 'post',
					'showposts' => 6,
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'category',
							'field'    => 'id',
							'terms'    => array( armonico_get_theme_option( 'slider_featured_post_category' ) ),
							'operator' => 'IN'
						)
					)
				);
			}
			if ( armonico_get_theme_option( 'slider_type' ) == '1' ){
				$slideshow_args = array(
					'post_type' => 'product',
					'showposts' => 6,
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'id',
							'terms'    => array( armonico_get_theme_option( 'slider_featured_product_category' ) ),
							'operator' => 'IN'
						)
					)
				);
			}
        
            $slideshow = new WP_Query( apply_filters( 'armonico_slideshow_args', $slideshow_args ) );
    
            if ( $slideshow->have_posts() ) {
            ?>
            <div class="gallery-box">
                    <ul class="gallery">
                    <?php while ( $slideshow->have_posts() ) : $slideshow->the_post(); ?>
                        <?php
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
						?>
                        <li><a href="<?php the_permalink(); ?>"><img src="<?php echo aq_resize( $img_url, 692, 383, true );  ?>" alt="<?php the_title(); ?>" /></a></li>
                    <?php endwhile; ?>
                    </ul>
            </div>
        <?php }else{ echo ('<a style="margin:10px;" href="' . admin_url( 'themes.php?page=armonico_options' ) . '">Fill out your Theme Options and add some "Slide" Posts.</a>'); } ?>
            <?php get_sidebar('action-box-area'); ?>
        </div>
        <?php //slogan check
		if (armonico_get_theme_option( 'home_slogan' ) != ""){ ?>
            <div class="slogan-box">
                <p><?php echo armonico_get_theme_option( 'home_slogan' ); ?></p>
            </div>
        	<?php //if there's no slogan this uses a different design so only use the class "product-list-slogan" if it is true ?>
			<div class="product-list sloganbg">
        <?php } else{ ?>
        	<div class="product-list">
        <?php } ?>
            <ul class="list">
            <div class="moveplugins_isotopes_container">
			
            <?php //woocommerce check - is woocommerce plugin installed? ?>
			<?php if (  in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
						if (armonico_get_theme_option( 'post_vs_product' ) == '0'){
							$news_args = array(
								'post_type' => "post",
								'posts_per_page' => 8,
								'tax_query' => array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'category',
										'field'    => 'id',
										'terms'    => array( armonico_get_theme_option( 'featured_post_category' ) ),
										'operator' => 'IN'
									)
								)
							);
							
						}else{
							$news_args = array(
								'post_type' => "product",
								'posts_per_page' => 8,
								'tax_query' => array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'product_cat',
										'field'    => 'id',
										'terms'    => array( armonico_get_theme_option( 'featured_product_category' ) ),
										'operator' => 'IN'
									)
								)
							);	
							
						}
           		  }else{ //use normal posts because woocommerce is not installed
                    $news_args = array(
                        'post_type' => "post",
						'posts_per_page' => 8,
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'category',
								'field'    => 'id',
								'terms'    => array( armonico_get_theme_option( 'featured_post_category' ) ),
								'operator' => 'IN'
							)
						)
                    );
             	  } ?>
             <?php
			 	global $product;
				$news = new WP_Query( apply_filters( 'latest_news_args', $news_args ) );
				
				if ( $news->have_posts() ) : ?>
					<?php while( $news->have_posts() ) : $news->the_post(); ?>
						<?php if (is_tax('product_cat')){ ?>
                            <?php $product = new WC_Product( $post->ID ); ?>
                        <?php } ?>
                    
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
                            	<?php if (is_tax('product_cat')){ 
										woocommerce_template_loop_price(); 
								} else{ ?>
                                        <span class="price"><?php the_title(); ?></span>
                        		<?php } ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="view">View</a>
                        </li>
     
                    <?php endwhile; ?>
				<?php endif; ?>
                </div>
			</ul>
            <?php armonico_paginate_links(); ?>
        </div>
         <?php get_sidebar('speech-bubble-area'); ?>
    </div><!-- main end -->

<?php get_footer(); ?>