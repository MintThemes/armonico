<?php
/**
 * The Template for displaying all single posts.
 *
 * @package armonico
 * @since armonico 1.0
 */

get_header(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class("product"); ?>>
    <div class="boot">
        <div class="product-info">
            <div class="product_images">
                <ul>
                	<?php
						/*
						 * Count attachments. 
						 */
						$args = array(
							'post_type' => 'attachment',
							'numberposts' => -1,
							'post_status' => null,
							'post_parent' => get_the_ID()
							); 
						$attachments = get_posts($args);
						$currentAttachmentNum = 0;
						//
						if ($attachments) {
							$currentAttachmentNum = 0;
							$counter = 0;
							foreach ($attachments as $attachment1) {
								$counter = $counter+1; 
								if (get_post_mime_type( $attachment1->ID ) == "image/png" || get_post_mime_type( $attachment1->ID ) == "image/jpeg") { ?>
									<li><img src="<?php echo aq_resize( $attachment1->guid, 493, 518, true ); ?>" alt="image" /></li><?php
								}//end if (mime_type)
							} //end foreach attachment
						}//end if (attachments)?>
                </ul>
            </div>
            <div class="summary">
                <h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                	<p itemprop="price" class="price"></p>
                </div>
                <div itemprop="description">
                	<?php the_content(); ?>
                </div>
                <div class="switcher">
                <?php 
				if ($attachments) {
					$currentAttachmentNum = 0;
					$counter = 0;
					foreach ($attachments as $attachment1) {
						$counter = $counter+1; 
						if (get_post_mime_type( $attachment1->ID ) == "image/png" || get_post_mime_type( $attachment1->ID ) == "image/jpeg") { ?>
							<a href="<?php echo $attachment1->guid; ?>" rel="thumbnails" class="zoom <?php if ($counter == 1){ echo "first"; } ?>"><img src="<?php echo aq_resize( $attachment1->guid, 97, 97, true ); ?>" width="97px" height="97px" alt="image" /></a>
							<?php
						}//end if (mime_type)
					} //end foreach attachment
				}//end if (attachments)?>   
                </div>
			</div><!-- .summary -->
        </div>
        <div id="content">
            <div class="product-list">
                <ul class="list">
                    <?php
					$download_args = array(
						'post_type' => 'download',
						'posts_per_page' => 8,
					);
									
					//cat 5 is the themes category for Mint Themes
					$downloads = new WP_Query($download_args);
					
					if ( $downloads->have_posts() ) : ?>
						<?php while( $downloads->have_posts() ) : $downloads->the_post(); ?>
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
                                            <span class="price"><?php edd_price(get_the_ID()); ?></span>
                                    <?php } ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="view">View</a>
                            </li>
     
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div><!-- main end -->
<?php get_footer(); ?>