<?php
/**
 * The Sidebar containing the action-box-area widget areas.
 *
 * @package armonico
 * @since armonico 1.0
 */
?>
		
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'speech-bubble-area' ) ) : ?>
				<?php //don't show anything by default because the user may not want to use this option --> ?>
			<?php endif; // end sidebar widget area ?>
		
