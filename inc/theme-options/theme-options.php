<?php
/**
 * Armonico Theme Options
 *
 * @package Armonico
 * @since Armonico 1.0
 */

/**
 * Register the form setting for our armonico_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, armonico_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since Armonico 1.0
 */
function armonico_theme_options_init() {
	wp_enqueue_style( 'farbtastic' );
    wp_enqueue_script( 'farbtastic' );
    wp_enqueue_script( 'my-theme-options', get_template_directory_uri() . '/js/theme-options.js', array( 'farbtastic', 'jquery' ) );
	
	register_setting(
		'armonico_options',
		'armonico_options',
		'armonico_theme_options_validate'
	);
	
	add_settings_section(
		'slider_settings',
		__( 'Slider Settings', 'armonico' ),
		'__return_false',
		'armonico_options'
	);
	
	if (taxonomy_exists('product_cat')){
		add_settings_field(
			'slider_type',
			__( 'Post or Product?', 'armonico' ), 
			'armonico_settings_field_select',
			'armonico_options',
			'slider_settings',
			array(
				'name'        => 'slider_type',
				'value'       => armonico_get_theme_option( 'slider_type' ),
				'options'     => array('post','product'),
				'description' => __( 'For the slider on the homepage, do you want to display products or posts?', 'armonico' )
			)
		);
	}
		
	add_settings_field(
		'slider_featured_post_category',
		__( 'Featured Slider Post Category', 'armonico' ), 
		'armonico_settings_field_select',
		'armonico_options',
		'slider_settings',
		array(
			'name'        => 'slider_featured_post_category',
			'value'       => armonico_get_theme_option( 'slider_featured_post_category' ),
			'options'     => armonico_get_categories(),
			'description' => __( 'If using \"Posts\", Posts in this category will be used on the homepage&#39;s slider.', 'armonico' )
		)
	);
	
		
	add_settings_field(
		'slider_featured_product_category',
		__( 'Featured Slider Product Category', 'armonico' ), 
		'armonico_settings_field_select',
		'armonico_options',
		'slider_settings',
		array(
			'name'        => 'slider_featured_product_category',
			'value'       => armonico_get_theme_option( 'slider_featured_product_category' ),
			'options'     => armonico_get_product_cats(),
			'description' => __( 'If using \"Products\", Products in this category will be used on the homepage&#39;s slider.', 'armonico' )
		)
	);
	
	//
	add_settings_section(
		'homepageposttype',
		__( 'Homepage Posts', 'armonico' ),
		'__return_false',
		'armonico_options'
	);
	
	if (taxonomy_exists('product_cat')){
		add_settings_field(
			'post_vs_product',
			__( 'Post or Product?', 'armonico' ), 
			'armonico_settings_field_select',
			'armonico_options',
			'homepageposttype',
			array(
				'name'        => 'post_vs_product',
				'value'       => armonico_get_theme_option( 'post_vs_product' ),
				'options'     => array('post','product'),
				'description' => __( 'For the main posts on the homepage, do you want to display products or posts?', 'armonico' )
			)
		);
	}
	
	add_settings_field(
		'featured_post_category',
		__( 'Featured Post Category', 'armonico' ), 
		'armonico_settings_field_select',
		'armonico_options',
		'homepageposttype',
		array(
			'name'        => 'featured_post_category',
			'value'       => armonico_get_theme_option( 'featured_post_category' ),
			'options'     => armonico_get_categories(),
			'description' => __( 'If you selected "post" above, select the category you would like to feature on the home page. Otherwise leave this blank', 'armonico' )
		)
	);
	
	if (taxonomy_exists('product_cat')){
		add_settings_field(
			'featured_product_category',
			__( 'Featured Product Category', 'armonico' ), 
			'armonico_settings_field_select',
			'armonico_options',
			'homepageposttype',
			array(
				'name'        => 'featured_product_category',
				'value'       => armonico_get_theme_option( 'featured_product_category' ),
				'options'     => armonico_get_product_cats(),
				'description' => __( 'If you selected "product" above, select the category you would like to feature on the home page. Otherwise leave this blank', 'armonico' )
			)
		);
	}
	
	//
	add_settings_section(
		'sociallinks',
		__( 'Social Links', 'armonico' ),
		'__return_false',
		'armonico_options'
	);
	
	add_settings_field(
		'twitter',
		__( 'Twitter', 'armonico' ), 
		'armonico_settings_field_textbox',
		'armonico_options',
		'sociallinks',
		array(
			'name'        => 'twitter',
			'value'       => armonico_get_theme_option( 'twitter' ),
			'description' => __( 'Twitter URL', 'armonico' )
		)
	);
	
	add_settings_field(
		'facebook',
		__( 'Facebook', 'armonico' ), 
		'armonico_settings_field_textbox',
		'armonico_options',
		'sociallinks',
		array(
			'name'        => 'facebook',
			'value'       => armonico_get_theme_option( 'facebook' ),
			'description' => __( 'Facebook URL', 'armonico' )
		)
	);
	
	add_settings_field(
		'youtube',
		__( 'YouTube', 'armonico' ), 
		'armonico_settings_field_textbox',
		'armonico_options',
		'sociallinks',
		array(
			'name'        => 'youtube',
			'value'       => armonico_get_theme_option( 'youtube' ),
			'description' => __( 'YouTube URL', 'armonico' )
		)
	);
	//
	add_settings_section(
		'homepageslogan',
		__( 'Homepage Slogan/Testimonial', 'armonico' ),
		'__return_false',
		'armonico_options'
	);
	
	add_settings_field(
		'home_slogan',
		__( 'Slogan/Testimonial', 'armonico' ), 
		'armonico_settings_field_textbox',
		'armonico_options',
		'homepageslogan',
		array(
			'name'        => 'home_slogan',
			'value'       => armonico_get_theme_option( 'home_slogan' ),
			'description' => __( 'Enter the text you want to display on the slogan/testimonial area on the homepage. Leave blank to hide it.', 'armonico' )
		)
	);
	//
	add_settings_section(
		'tagline_settings',
		__( 'Tagline in Header', 'armonico' ),
		'__return_false',
		'armonico_options'
	);
	
	add_settings_field(
		'display_tagline',
		__( 'Display Tagline?', 'armonico' ), 
		'armonico_settings_field_select',
		'armonico_options',
		'tagline_settings',
		array(
			'name'        => 'display_tagline',
			'value'       => armonico_get_theme_option( 'display_tagline' ),
			'options'     => array('Display tagline','Don\'t display tagline'),
			'description' => __( 'Do you want to display the tagline beside the logo at the top of the page?', 'armonico' )
		)
	);
	
	if (armonico_get_theme_option( 'tagline_color' ) == ""){$default_tagline_color = '#444';}else{$default_tagline_color = armonico_get_theme_option( 'tagline_color' ); }
	add_settings_field( 
		'tagline_color', 
		__( 'Color', 'armonico' ), 
		'armonico_color_picker',
		'armonico_options', 
		'tagline_settings',
		array(
			'name'        => 'tagline_color',
			'value'       => $default_tagline_color,
			'description' => __( 'Select the color you want to use for the tagline next to the logo at the tops of the page. Default color is #444', 'armonico' )
		)
	);
	//
	add_settings_section(
		'footer',
		__( 'Footer Settings', 'armonico' ),
		'__return_false',
		'armonico_options'
	);
	
	if (armonico_get_theme_option( 'footer_color' ) == ""){$default_footer_color = '#444';}else{$default_footer_color = armonico_get_theme_option( 'footer_color' ); }
	add_settings_field( 
		'footer_color', 
		__( 'Color', 'armonico' ), 
		'armonico_color_picker',
		'armonico_options', 
		'footer',
		array(
			'name'        => 'footer_color',
			'value'       => $default_footer_color,
			'description' => __( 'Select the color you want to use for the text in the footer. Default color is #444', 'armonico' )
		)
	);
	
}
add_action( 'admin_init', 'armonico_theme_options_init' );

/**
 * Change the capability required to save the 'armonico_options' options group.
 *
 * @see armonico_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see armonico_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function armonico_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_armonico_options', 'armonico_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Armonico 1.0
 */
function armonico_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'armonico' ),
		__( 'Theme Options', 'armonico' ),
		'edit_theme_options',
		'armonico_options',
		'armonico_theme_options_render_page'
	);
	
}
add_action( 'admin_menu', 'armonico_theme_options_add_page' );

/**
 * Returns the options array for Armonico.
 *
 * @since Armonico 1.0
 */
function armonico_get_theme_options() {
	$saved = (array) get_option( 'armonico_options' );
	
	$defaults = array(
		'slider_type'     => '',
		'slider_featured_post_category'     => '',
		'slider_featured_product_category'     => '',
		'post_vs_product' 		=> '',
		'featured_product_category' 	=> '',
		'featured_post_category' 	=> '',
		'twitter'      => '',
		'facebook'		=> '',
		'youtube'		=> '',
		'home_slogan'			=> '',
		'display_tagline'   => '',
		'tagline_color'     => '',
		'footer_color'      => ''
	);
	
	$defaults = apply_filters( 'armonico_default_theme_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

/**
 * Get a single theme option
 *
 * @since Armonico 1.0
 */
function armonico_get_theme_option( $key ) {
	$options = armonico_get_theme_options();
	
	if ( isset( $options[ $key ] ) )
		return $options[ $key ];
		
	return false;
}

/**
 * Renders the Theme Options administration screen.
 *
 * @since Armonico 1.0
 */
function armonico_theme_options_render_page() {
	$theme = wp_get_theme();
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'armonico' ), $theme->Name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'armonico_options' );
				do_settings_sections( 'armonico_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see armonico_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since Armonico 1.0
 */
function armonico_theme_options_validate( $input ) {
	$output = array();
	
	if (taxonomy_exists('product_cat')){
		if ( isset ( $input[ 'slider_type' ] ) )
			$output[ 'slider_type' ] = esc_attr( $input[ 'slider_type' ] );
	}
	
	if ( $input[ 'slider_featured_product_category' ] == 0 || array_key_exists( $input[ 'slider_featured_product_category' ], armonico_get_categories()+armonico_get_product_cats() ) )
		$output[ 'slider_featured_product_category' ] = $input[ 'slider_featured_product_category' ];
	//	
	if ( $input[ 'slider_featured_post_category' ] == 0 || array_key_exists( $input[ 'slider_featured_post_category' ], armonico_get_categories()+armonico_get_product_cats() ) )
		$output[ 'slider_featured_post_category' ] = $input[ 'slider_featured_post_category' ];
	//	
	if (taxonomy_exists('product_cat')){
		if ( isset ( $input[ 'post_vs_product' ] ) )
			$output[ 'post_vs_product' ] = esc_attr( $input[ 'post_vs_product' ] );
	}
	//
	if (taxonomy_exists('product_cat')){
		if ( $input[ 'featured_product_category' ] == 0 || array_key_exists( $input[ 'featured_product_category' ], armonico_get_product_cats() ) )
			$output[ 'featured_product_category' ] = $input[ 'featured_product_category' ];
	}
	//
	if ( $input[ 'featured_post_category' ] == 0 || array_key_exists( $input[ 'featured_post_category' ], armonico_get_categories() ) )
		$output[ 'featured_post_category' ] = $input[ 'featured_post_category' ];
	//
	if ( isset ( $input[ 'twitter' ] ) )
		$output[ 'twitter' ] = esc_attr( $input[ 'twitter' ] );
		
	if ( isset ( $input[ 'facebook' ] ) )
		$output[ 'facebook' ] = esc_attr( $input[ 'facebook' ] );
		
	if ( isset ( $input[ 'youtube' ] ) )
		$output[ 'youtube' ] = esc_attr( $input[ 'youtube' ] );
	//
	if ( isset ( $input[ 'home_slogan' ] ) )
		$output[ 'home_slogan' ] = esc_attr( $input[ 'home_slogan' ] );
	//
	if ( isset ( $input[ 'display_tagline' ] ) )
		$output[ 'display_tagline' ] = esc_attr( $input[ 'display_tagline' ] );
	//
	if ( isset ( $input[ 'tagline_color' ] ) )
		$output[ 'tagline_color' ] = esc_attr( $input[ 'tagline_color' ] );
	//
	if ( isset ( $input[ 'footer_color' ] ) )
		$output[ 'footer_color' ] = esc_attr( $input[ 'footer_color' ] );
	//
	
	$output = wp_parse_args( $output, armonico_get_theme_options() );	
		
	return apply_filters( 'armonico_theme_options_validate', $output, $input );
}

/* Fields ***************************************************************/
 
/**
 * Number Field
 *
 * @since Armonico 1.0
 */
function armonico_settings_field_number( $args = array() ) {
	$defaults = array(
		'menu'        => '', 
		'min'         => 1,
		'max'         => 100,
		'step'        => 1,
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'armonico_options[%s]', $name ) );
?>
	<label for="<?php echo esc_attr( $id ); ?>">
		<input type="number" min="<?php echo absint( $min ); ?>" max="<?php echo absint( $max ); ?>" step="<?php echo absint( $step ); ?>" name="<?php echo $name; ?>" id="<?php echo $id ?>" value="<?php echo esc_attr( $value ); ?>" />
		<?php echo $description; ?>
	</label>
<?php
} 

/**
 * Textarea Field
 *
 * @since Armonico 1.0
 */
function armonico_settings_field_textarea( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'armonico_options[%s]', $name ) );
?>
	<label for="<?php echo $id; ?>">
		<textarea name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="code large-text" rows="3" cols="30"><?php echo esc_textarea( $value ); ?></textarea>
		<br />
		<?php echo $description; ?>
	</label>
<?php
} 

/**
 * Image Upload Field
 *
 * @since Armonico 1.0
 */
function armonico_settings_field_image_upload( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'armonico_options[%s]', $name ) );
?>
	<label for="<?php echo $id; ?>">
		<input type="text" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo esc_attr( $value ); ?>">
        <input id="upload_image_button" type="button" value="<?php echo __( 'Upload Image', 'armonico' ); ?>" />
		<br /><?php echo $description; ?>
	</label>
<?php
} 

/**
 * Textbox Field
 *
 * @since Armonico 1.0
 */
function armonico_settings_field_textbox( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'armonico_options[%s]', $name ) );
?>
	<label for="<?php echo $id; ?>">
		<input type="text" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo esc_attr( $value ); ?>">
		<br /><?php echo $description; ?>
	</label>
<?php
} 

/**
 * Single Checkbox Field
 *
 * @since Armonico 1.0
 */
function armonico_settings_field_checkbox_single( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'compare'     => 'on',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'armonico_options[%s]', $name ) );
?>
	<label for="<?php echo esc_attr( $id ); ?>">
		<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo esc_attr( $value ); ?>" <?php checked( $compare, $value ); ?>>
		<?php echo $description; ?>
	</label>
<?php
} 

/**
 * Radio Field
 *
 * @since Armonico 1.0
 */
function armonico_settings_field_radio( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'options'     => array(),
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'armonico_options[%s]', $name ) );
?>
	<?php foreach ( $options as $option_id => $option_label ) : ?>
	<label title="<?php echo esc_attr( $option_label ); ?>">
		<input type="radio" name="<?php echo $name; ?>" value="<?php echo $option_id; ?>" <?php checked( $option_id, $value ); ?>>
		<?php echo esc_attr( $option_label ); ?>
	</label>
		<br />
	<?php endforeach; ?>
<?php
}

/**
 * Select Field
 *
 * @since Armonico 1.0
 */
function armonico_settings_field_select( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'options'     => array(),
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'armonico_options[%s]', $name ) );
?>
	<label for="<?php echo $id; ?>">
		<select name="<?php echo $name; ?>">
			<?php foreach ( $options as $option_id => $option_label ) : ?>
			<option value="<?php echo esc_attr( $option_id ); ?>" <?php selected( $option_id, $value ); ?>>
				<?php echo esc_attr( $option_label ); ?>
			</option>
			<?php endforeach; ?>
		</select>
		<?php echo $description; ?>
	</label>
<?php
}

/**
 * Color Picker
 *
 * @since Armonico 1.0
 */
function armonico_color_picker($args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'armonico_options[%s]', $name ) );
	?>
    <div class="color-picker">
        <input type="text" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo esc_attr( $value ); ?>">
        <input type='button' class='pickcolor button-secondary' value='Select Color'>
        <?php echo $description; ?>
        <div id='colorpicker' style='z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;'></div>
    </div>
    <?php
}

/* Helpers ***************************************************************/

function armonico_get_categories() {
	$output = array();
	$terms  = get_terms( array( 'category' ), array( 'hide_empty' => 0 ) );
	
	foreach ( $terms as $term ) {
		$output[ $term->term_id ] = $term->name;
	}
	
	return $output;
}

function armonico_get_product_cats() {
	if (taxonomy_exists('product_cat')){
		$output = array();
		$terms  = get_terms( array( 'product_cat' ), array( 'hide_empty' => 0 ) );
		
		foreach ( $terms as $term ) {
			$output[ $term->term_id ] = $term->name;
		}
		
		return $output;
	}
}

/* Custom CSS Colors ***************************************************************/

function my_wp_head() {
    echo '<style> 
		#header .slogan {  color:' . armonico_get_theme_option( 'tagline_color' ) . '; } 
		#colophon, #colophon a {  color:' . armonico_get_theme_option( 'footer_color' ) . '; } 
	</style>';
}
add_action( 'wp_head', 'my_wp_head' );