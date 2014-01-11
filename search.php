<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package armonico
 * @since armonico 1.0
 */
get_header(); ?>

		<div id="main">
				<div class="boot">
					<div class="section-title">
						<div class="holder">
							<h2><?php printf( __( 'Search Results for: %s', 'armonico' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
						</div>
					</div>
					<div id="content">
                    <?php if ( have_posts() ) : ?>
                        <div class="product-list">
    
                        <?php /* Start the Loop */ ?>
                        <ul class="list">
							<?php while ( have_posts() ) : the_post(); ?>
            
                               <?php get_template_part( 'content', 'search' ); ?>
            
                            <?php endwhile; ?>
    					</ul>
                        
                    <?php else : ?>
    					<div class="post-holder">
                        
                        <?php get_template_part( 'no-results', 'index' ); ?>
    
                    <?php endif; ?>
                    
                     
            		<?php armonico_paginate_links(); ?>
               
			</div>
        </div>
    </div>
</div><!-- main end -->

<?php get_footer(); ?>