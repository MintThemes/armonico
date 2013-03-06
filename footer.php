<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package armonico
 * @since armonico 1.0
 */
?>
<div id="colophon" class="site-footer" role="contentinfo">
				<div class="social-info">
					<ul class="social">
						<?php if (armonico_get_theme_option( 'twitter' ) != ""){?><li class="twitter"><div class="icon-twitter"></div><a href="<?php echo armonico_get_theme_option( 'twitter' ); ?>"><?php echo __( 'Twitter', 'armonico' ); ?></a></li><?php } ?>
						<?php if (armonico_get_theme_option( 'facebook' ) != ""){?><li class="facebook"><div class="icon-facebook"><a href="<?php echo armonico_get_theme_option( 'facebook' ); ?>"><?php echo __( 'Facebook', 'armonico' ); ?></a></li><?php } ?>
                        <?php if (armonico_get_theme_option( 'youtube' ) != ""){?><li class="youtube"><div class="icon-youtube"><a href="<?php echo armonico_get_theme_option( 'youtube' ); ?>"><?php echo __( 'YouTube', 'armonico' ); ?></a></li><?php } ?>
						
					</ul>
				</div>
				<div class="copy">
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'fallback_cb' => 'link_to_menu_editor' ) ); ?>
                    <p><?php echo __( 'Copyright', 'armonico' ); ?> &copy;  <?php echo date('Y'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a> | <a rel="Mint Themes - Ecommerce WordPress Themes" href="<?php echo __( 'http://mintthemes.com', 'armonico' ); ?>">Mint Themes</a> | <a href="http://wordpress.org"><?php printf( 'WordPress' ); ?></a></p>
					
				</div>
			</div><!-- footer end -->
		</div><!-- wrapper end -->
        <?php wp_footer(); ?>
	</body>
</html>


	