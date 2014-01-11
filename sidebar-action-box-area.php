<?php
/**
 * The Sidebar containing the action-box-area widget areas.
 *
 * @package armonico
 * @since armonico 1.0
 */
?>
		
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'action-box-area' ) ) : ?>
				<div class="actionbox-message">
					To show the action boxes in this space, go to your <a href="<?php echo admin_url( 'widgets.php' ); ?>">WordPress Backend > Appearance > Widgets</a>, and add the "Action Boxes" Widget to the "Action" Sidebar.
				</div>
			<?php endif; // end sidebar widget area ?>
		
