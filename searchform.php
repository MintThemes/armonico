<?php
/**
 * The template for displaying search forms in armonico
 *
 * @package armonico
 * @since armonico 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'armonico' ); ?></label>
		<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'armonico' ); ?>" />
        <button type="submit" class="btn" name="submit" id="searchsubmit"><i class="icon-search"></i></button>
	</form>
