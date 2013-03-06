<?php
/**
 * armonico functions and definitions
 *
 * @package armonico
 * @since armonico 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since armonico 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'armonico_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since armonico 1.0
 */
function armonico_setup() {
	/**
	 * Video Embeds
	 */
	require( get_template_directory() . '/inc/videos.php' );

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on armonico, use a find and replace
	 * to change 'armonico' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'armonico', get_template_directory() . '/languages' );
	
	/**
	 * Declare support for WooCommerce
	 */
	add_theme_support( 'woocommerce' );
	
	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' ); 
	add_image_size( 'feature-slider', 692, 9999 );
	

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in two location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'armonico' ),
		'footer' => __( 'Footer Menu', 'armonico' ),
	) );

	
}
endif; // armonico_setup
add_action( 'after_setup_theme', 'armonico_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since armonico 1.0
 */
if ( ! function_exists( 'armonico_widgets_init' ) ):
	function armonico_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Sidebar', 'armonico' ),
			'id' => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
		register_sidebar( array(
			'name' => __( 'Homepage Action Box Area', 'armonico' ),
			'id' => 'action-box-area',
			'before_widget' => '<div class="social-list">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="hidden-box-title">',
			'after_title' => '</h1>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Homepage Speech Bubble Area', 'armonico' ),
			'id' => 'speech-bubble-area',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h1 class="hidden-box-title">',
			'after_title' => '</h1>',
		) );
		
		//register widgets
		register_widget( 'mt_armonico_Action_boxes' );
		register_widget( 'mt_armonico_Speech_bubble_area' );
	}
endif;// armonico_widgets_init
add_action( 'widgets_init', 'armonico_widgets_init' );

/**
 * Enqueue scripts and styles
 */
if ( ! function_exists( 'armonico_scripts' ) ):
	function armonico_scripts() {
		wp_enqueue_style( 'style', get_stylesheet_uri() );
		
		wp_enqueue_style( 'css3', get_template_directory_uri() . '/css/css3.css' );
		wp_enqueue_style( 'googledroidsans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700' );
		wp_enqueue_style( 'googledroidsans', 'http://fonts.googleapis.com/css?family=Droid+Serif:400italic' );
	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	
		if ( is_singular() && wp_attachment_is_image() ) {
			wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
		}
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ) );
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'armonico', get_template_directory_uri() . '/js/scripts.js', array( 'isotope', 'flexslider' ) );
		wp_enqueue_script( 'mintthemes-select', get_template_directory_uri() . '/js/selectBox.min.js', array( 'jquery' ) );
		
		//woocommerce stuff used for edd as well
		wp_enqueue_script( 'fancybox',  plugins_url() . '/woocommerce/assets/js/fancybox/fancybox.min.js', array( 'jquery' ) );
		wp_enqueue_style( 'css3', get_template_directory_uri() . '/css/css3.css' );
	
		if( is_singular( 'download' ) ){
			wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.min.js', array( 'jquery' ));
			wp_enqueue_style( 'woocommerce_fancybox_styles', get_template_directory_uri() . '/css/fancybox.css' );
		}
	}
endif; //armonico_scripts
add_action( 'wp_enqueue_scripts', 'armonico_scripts' );

/**
 * Enqueue scripts and styles for the admin section (theme options)
 */
if ( ! function_exists( 'armonico_admin_scripts' ) ):
	function armonico_admin_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('mt-media-upload', get_template_directory_uri()  .'/inc/theme-options/theme-options.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('mt-media-upload');
	}
endif; //armonico_admin_scripts	
 
/**
 * Enqueue thickbox styling for theme options
 */
if ( ! function_exists( 'armonico_admin_styles' ) ):
	function armonico_admin_styles() {
		wp_enqueue_style('thickbox');
	}
endif; //armonico_admin_styles
	
/**
* Call the above 2 functions if the user is on the theme options page
*/
global $pagenow; 
if (isset($_GET['page']) && $_GET['page'] == 'armonico_options' || $pagenow == "widgets.php") {
add_action('admin_print_scripts', 'armonico_admin_scripts');
add_action('admin_print_styles', 'armonico_admin_styles');
}

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Implement the Custom Background feature
 */
require( get_template_directory() . '/inc/custom-background.php' );


/**
 * Include AQ Resizer
 */
require( get_template_directory() . '/inc/aq_resizer/aq-resizer.php' );
require( get_template_directory() . '/inc/aq_resizer/aq-resizer-ratio-check.php' );

/**
 * WooCommerce Tweaks
 */
require_once( get_template_directory() . '/inc/woocommerce.php' );

/**
 * Action Boxes for Home page
 */
require_once( get_template_directory() . '/inc/widgets/actionboxes.php' );

/**
 * Speech Bubble Text area on Home page
 */
require_once( get_template_directory() . '/inc/widgets/speechbubbletext.php' );

/**
 * Menu fallback. Link to the menu editor if that is useful.
 *
 * @param  array $args
 * @return string
 */
if ( ! function_exists( 'link_to_menu_editor' ) ):
	function link_to_menu_editor( $args )
	{
		if ( ! current_user_can( 'manage_options' ) )
		{
			return;
		}
	
		// see wp-includes/nav-menu-template.php for available arguments
		extract( $args );
	
		$link = $link_before
			. '<a href="' .admin_url( 'nav-menus.php' ) . '">' . $before . 'Add a menu' . $after . '</a>'
			. $link_after;
	
		// We have a list
		if ( FALSE !== stripos( $items_wrap, '<ul' )
			or FALSE !== stripos( $items_wrap, '<ol' )
		)
		{
			$link = "<li>$link</li>";
		}
	
		$output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
		if ( ! empty ( $container ) )
		{
			$output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
		}
	
		if ( $echo )
		{
			echo $output;
		}
	
		return $output;
	}
endif;

/**
 * Check if WooCommerce is installed.
 *
 */
function armonico_wc_check() {
	if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_action( 'admin_notices', 'armonico_wc_check_notice' );
	}
}
add_action( 'after_setup_theme', 'armonico_wc_check' );

/**
 * Show notice that WooCommerce should be installed
 *
 */
function armonico_wc_check_notice() {
	echo '<div class="updated fade"><p>';
		printf( __( 'If you want to do e-commerce with this theme, make sure to download, install, and activate the <a href="%s">WooCommerce</a> plugin.', 'armonico' ), admin_url( sprintf( 'update.php?action=install-plugin&plugin=woocommerce&_wpnonce=%s', wp_create_nonce( 'install-plugin_woocommerce' ) ) ) );
	echo '</p></div>';
}

/**
 * Check if Isotopes is installed.
 *
 */
function armonico_isotopes_check() {
	if ( ! in_array( 'mp-isotopes/mp-isotopes.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_action( 'admin_notices', 'armonico_isotopes_check_notice' );
	}
}
add_action( 'after_setup_theme', 'armonico_isotopes_check' );

/**
 * Show notice that Isotopes should be installed
 *
 */
function armonico_isotopes_check_notice() {
	echo '<div class="updated fade"><p>';
		printf( __( 'Make sure to download the free <a target="_blank" href="http://mintthemes.com/plugins/isotopes-for-wordpress/">Isotopes</a> plugin. After you have it downloaded, upload it <a href="' . admin_url("plugin-install.php?tab=upload"). '">here</a>', 'armonico' ) );
	echo '</p></div>';
}
