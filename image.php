<?php
/**
 * The template for displaying image attachments.
 *
 * @package armonico
 * @since armonico 1.0
 */
get_header(); ?>
<div id="main">
    <div class="boot">
        <div id="sidebar">
            <?php get_sidebar(); ?>
        </div>
        <div id="content">
        
            <?php while ( have_posts() ) : the_post(); ?>
				<div class="post-holder">
            
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="title">
                            <h3><?php the_title(); ?></h3>
                        </div>
                        <div class="text">
                          <div class="entry-meta">
							<?php
								$metadata = wp_get_attachment_metadata();
								printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'armonico' ),
									esc_attr( get_the_date( 'c' ) ),
									esc_html( get_the_date() ),
									wp_get_attachment_url(),
									$metadata['width'],
									$metadata['height'],
									get_permalink( $post->post_parent ),
									get_the_title( $post->post_parent )
								);
							?>
							<?php edit_post_link( __( 'Edit', 'armonico' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-meta -->

						<nav id="image-navigation">
							<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'armonico' ) ); ?></span>
							<span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'armonico' ) ); ?></span>
						</nav><!-- #image-navigation -->

					<div class="entry-content">

						<div class="entry-attachment">
							<div class="attachment">
								<?php
									/**
									 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
									 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
									 */
									$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
									foreach ( $attachments as $k => $attachment ) {
										if ( $attachment->ID == $post->ID )
											break;
									}
									$k++;
									// If there is more than 1 attachment in a gallery
									if ( count( $attachments ) > 1 ) {
										if ( isset( $attachments[ $k ] ) )
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
										else
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
									} else {
										// or, if there's only 1 image, get the URL of the image
										$next_attachment_url = wp_get_attachment_url();
									}
								?>

								<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
									$attachment_size = apply_filters( 'armonico_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
									echo wp_get_attachment_image( $post->ID, $attachment_size );
								?></a>
							</div><!-- .attachment -->

							<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div><!-- .entry-caption -->
							<?php endif; ?>
						</div><!-- .entry-attachment -->

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'armonico' ), 'after' => '</div>' ) ); ?>

					</div><!-- .entry-content -->
                           <?php edit_post_link( __( 'Edit', 'armonico' ), '<span class="edit-link">', '</span>' ); ?>
                        </div>
                    </div><!-- #post-<?php the_ID(); ?> -->                             
   
    
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                            comments_template( '', true );
                    ?>
				</div><!-- #post-<?php the_ID(); ?> -->  
            <?php endwhile; // end of the loop. ?>
        </div>
    </div>
</div><!-- main end -->
<?php get_footer(); ?>

