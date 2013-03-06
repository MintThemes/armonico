<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package armonico
 * @since armonico 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'armonico' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
    <div id="header" class="clearfix">
        <h1 class="logo">
        <?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            	<?php //retina check 
				if (  in_array( 'wp-retina-2x/wp-retina-2x.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
				?>
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width/2; ?>" height="<?php echo get_custom_header()->height/2; ?>" alt="home" />
                <?php 
				} else { ?>
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="home" />
				<?php } ?>
			</a>
		<?php } else { echo ('<a href="' . admin_url( 'themes.php?page=custom-header' ) . '">Upload your logo</a>'); }// if ( ! empty( $header_image ) ) ?>
        </h1>
    	<?php if (armonico_get_theme_option( 'display_tagline' ) == "0"){?><span class="slogan"><?php bloginfo( 'description' ); ?></span><?php } ?>
        <div class="holder">
            <div class="nav-holder">
                <div class="nav-box">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'link_to_menu_editor' ) ); ?>
                </div>
            </div>
            <div class="box"></div>
            <?php if (  in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
            	<?php global $woocommerce; ?>
				<?php if ($woocommerce->cart->cart_contents_count > 0) { ?>
                <div class="box">
                    <a href="<?php echo esc_url( get_permalink( woocommerce_get_page_id( 'cart' ) ) ); ?>" class="button headercart add-to-cart"><span class="icon-cart"></span><span><?php _e( 'Cart', 'armonico' ); ?></span><strong><?php echo $woocommerce->cart->cart_contents_count; ?></strong></a>
                </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div><!-- header end -->
 	