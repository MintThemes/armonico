<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package armonico
 * @since armonico 1.0
 */
 
get_header(); ?>

<div id="main">
    <div class="boot">
	<?php if ( have_posts() ) : ?>
        <div class="section-title">
            <div class="holder">
                <h2>
                <?php
					if ( is_category() ) {
						printf( '<span>' . single_cat_title( '', false ) . '</span>' );

					} elseif ( is_tag() ) {
						printf( __( 'Tag Archives: %s', 'armonico' ), '<span>' . single_tag_title( '', false ) . '</span>' );

					} elseif ( is_author() ) {
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						*/
						the_post();
						printf( __( 'Author Archives: %s', 'armonico' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();

					} elseif ( is_day() ) {
						printf( __( 'Daily Archives: %s', 'armonico' ), '<span>' . get_the_date() . '</span>' );

					} elseif ( is_month() ) {
						printf( __( 'Monthly Archives: %s', 'armonico' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

					} elseif ( is_year() ) {
						printf( __( 'Yearly Archives: %s', 'armonico' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

					} else {
						_e( 'Archives', 'armonico' );

					}
				?>
                </h2>
                <?php
					if ( is_category() ) {
						// show an optional category description
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

					} elseif ( is_tag() ) {
						// show an optional tag description
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) )
							echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
					}
				?>
            </div>
        </div>
        <div id="content">
        
			<?php 
			
				if ( function_exists( 'mintthemes_isotopes' ) ): 
					mintthemes_isotopes(); 
				endif; //armonico_isotopes
			
            ?>
                    
            <div class="product-list">
				<ul class="list">
                	<?php	
						/* Start the Loop */ 
                    	while ( have_posts() ) : the_post(); 
					?>
    
                        <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to overload this in a child theme then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                        ?>
    
                    <?php endwhile; ?>
                </ul>
			</div>
        </div>
			<?php else : ?>
				<div class="post-holder">
				<?php get_template_part( 'no-results', 'archive' ); ?>
				</div>
			<?php endif; ?>
            
            <?php armonico_paginate_links(); ?>

			
    </div>
</div><!-- main end -->

<?php get_footer(); ?>