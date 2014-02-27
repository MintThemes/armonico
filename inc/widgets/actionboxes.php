<?php
/**
 * Makes a custom Widget for displaying recent projects/portfolio
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package armonico
 * @since armonico 1.0
 */

class mt_armonico_Action_boxes extends WP_Widget {
	
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function mt_armonico_Action_boxes () {
		$widget_ops = array( 
			'classname' => 'mt_armonico_action_boxes', 
			'description' => __( 'On the homepage, this displays the action boxes in the header/slider', 'armonico' ) 
		);	

		$this->WP_Widget( 'mt_armonico_action_boxes', __( 'Action Boxes', 'armonico' ), $widget_ops );
		$this->alt_option_name = 'mt_armonico_action_boxes';

		add_action( 'save_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array An array of standard parameters for widgets in this theme
	 * @param array An array of settings for this widget instance
	 * @return void Echoes it's output
	 **/
	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'mt_armonico_action_boxes', 'widget' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = null;

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();

		extract( $args, EXTR_SKIP );

			$link1 = apply_filters( 'link1', empty( $instance['link1'] ) ? __( '', 'armonico' ) : $instance['link1'], $instance, $this->id_base);
			$image1 = apply_filters( 'image1', empty( $instance['image1'] ) ? __( '', 'armonico' ) : $instance['image1'], $instance, $this->id_base);
			$text1 = apply_filters( 'text1', empty( $instance['text1'] ) ? __( '', 'armonico' ) : $instance['text1'], $instance, $this->id_base);
			//
			$link2 = apply_filters( 'link2', empty( $instance['link2'] ) ? __( '', 'armonico' ) : $instance['link2'], $instance, $this->id_base);
			$image2 = apply_filters( 'image2', empty( $instance['image2'] ) ? __( '', 'armonico' ) : $instance['image2'], $instance, $this->id_base);
			$text2 = apply_filters( 'text2', empty( $instance['text2'] ) ? __( '', 'armonico' ) : $instance['text2'], $instance, $this->id_base);
			//
			$link3 = apply_filters( 'link3', empty( $instance['link3'] ) ? __( '', 'armonico' ) : $instance['link3'], $instance, $this->id_base);
			$image3 = apply_filters( 'image3', empty( $instance['image3'] ) ? __( '', 'armonico' ) : $instance['image3'], $instance, $this->id_base);
			$text3 = apply_filters( 'text3', empty( $instance['text3'] ) ? __( '', 'armonico' ) : $instance['text3'], $instance, $this->id_base);
			//
			$link4 = apply_filters( 'link4', empty( $instance['link4'] ) ? __( '', 'armonico' ) : $instance['link4'], $instance, $this->id_base);
			$image4 = apply_filters( 'image4', empty( $instance['image4'] ) ? __( '', 'armonico' ) : $instance['image4'], $instance, $this->id_base);
			$text4 = apply_filters( 'text4', empty( $instance['text4'] ) ? __( '', 'armonico' ) : $instance['text4'], $instance, $this->id_base);
			
			
			echo $before_widget;
			echo $before_title;
			echo $title; // Can set this with a widget option, or omit altogether
			echo $after_title;
?>
				<?php if ($text1 != ""){?>
				<div class="box">
                    <div class="ico">
                        <?php if ($image1 != ""){ ?><a href="<?php echo $link1; ?>"><img src="<?php echo aq_resize( $image1, 53, 53, true ); ?> " width="53" height="53" alt="image" /></a><?php } ?>
                    </div>
                    <div class="text">
                        <span><?php echo $text1; ?></span>
                    </div>
                </div>
                <?php } ?>
                <?php if ($text2 != ""){?>
                <div class="box">
                    <div class="ico">
                       <?php if ($image2 != ""){ ?><a href="<?php echo $link2; ?>"><img src="<?php echo aq_resize( $image2, 53, 53, true ); ?> " width="53" height="53" alt="image" /></a><?php } ?>
                    </div>
                    <div class="text">
                        <span><?php echo $text2; ?></span>
                    </div>
                </div>
                <?php } ?>
                <?php if ($text3 != ""){?>
                <div class="box">
                    <div class="ico">
                         <?php if ($image3 != ""){ ?><a href="<?php echo $link3; ?>"><img src="<?php echo aq_resize( $image3, 53, 53, true ); ?> " width="53" height="53" alt="image" /></a><?php } ?>
                    </div>
                    <div class="text">
                        <span><?php echo $text3; ?></span>
                    </div>
                </div>
                <?php } ?>
                <?php if ($text4 != ""){?>
                <div class="box">
                    <div class="ico">
                         <?php if ($image4 != ""){ ?><a href="<?php echo $link4; ?>"><img src="<?php echo aq_resize( $image4, 53, 53, true ); ?> " width="53" height="53" alt="image" /></a><?php } ?>
                    </div>
                    <div class="text">
                        <span><?php echo $text4; ?></span>
                    </div>
                </div>
                <?php } ?>
<?php
			echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();

		wp_cache_set( 'mt_armonico_action_boxes', $cache, 'widget' );
	}


	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['link1'] = strip_tags( $new_instance['link1'] );
		$instance['image1'] = strip_tags( $new_instance['image1'] );
		$instance['text1'] = strip_tags( $new_instance['text1'] );
		//
		$instance['link2'] = strip_tags( $new_instance['link2'] );
		$instance['image2'] = strip_tags( $new_instance['image2'] );
		$instance['text2'] = strip_tags( $new_instance['text2'] );
		//
		$instance['link3'] = strip_tags( $new_instance['link3'] );
		$instance['image3'] = strip_tags( $new_instance['image3'] );
		$instance['text3'] = strip_tags( $new_instance['text3'] );
		//
		$instance['link4'] = strip_tags( $new_instance['link4'] );
		$instance['image4'] = strip_tags( $new_instance['image4'] );
		$instance['text4'] = strip_tags( $new_instance['text4'] );
		//

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset( $alloptions['mt_armonico_action_boxes'] ) )
			delete_option( 'mt_armonico_action_boxes' );

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'mt_armonico_action_boxes', 'widget' );
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 **/
	function form( $instance ) {
		$link1 = isset( $instance[ 'link1' ] ) ? esc_attr( $instance[ 'link1' ] ) : '';
		$image1 = isset( $instance[ 'link1' ] ) ? esc_attr( $instance[ 'image1' ] ) : '';
		$text1 = isset( $instance[ 'link1' ] ) ? esc_attr( $instance[ 'text1' ] ) : '';
		//
		$link2 = isset( $instance[ 'link2' ] ) ? esc_attr( $instance[ 'link2' ] ) : '';
    	$image2 = isset( $instance[ 'link2' ] ) ? esc_attr( $instance[ 'image2' ] ) : '';
    	$text2 = isset( $instance[ 'link2' ] ) ? esc_attr( $instance[ 'text2' ] ) : '';
    	//
		$link3 = isset( $instance[ 'link3' ] ) ? esc_attr( $instance[ 'link3' ] ) : '';
    	$image3 = isset( $instance[ 'link3' ] ) ? esc_attr( $instance[ 'image3' ] ) : '';
    	$text3 = isset( $instance[ 'link3' ] ) ? esc_attr( $instance[ 'text3' ] ) : '';
    	//
		$link4 = isset( $instance[ 'link4' ] ) ? esc_attr( $instance[ 'link4' ] ) : '';
   		$image4 = isset( $instance[ 'link4' ] ) ? esc_attr( $instance[ 'image4' ] ) : '';
    	$text4 = isset( $instance[ 'link4' ] ) ? esc_attr( $instance[ 'text4' ] ) : '';
    	//			
?>
            
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link1' ) ); ?>"><?php _e( 'Link #1:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link1' ) ); ?>" type="text" value="<?php echo esc_attr( $link1 ); ?>" />
			</p>
            
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image1' ) ); ?>"><?php _e( 'Image #1:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image1' ) ); ?>" type="text" value="<?php echo esc_attr( $image1 ); ?>" />
                <input id="upload_image_button" type="button" value="<?php echo __( 'Upload Image', 'armonico' ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'text1' ) ); ?>"><?php _e( 'Text #1:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text1' ) ); ?>" type="text" value="<?php echo esc_attr( $text1 ); ?>" />
			</p>
            <!-- -->
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link2' ) ); ?>"><?php _e( 'Link #2:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link2' ) ); ?>" type="text" value="<?php echo esc_attr( $link2 ); ?>" />
			</p>
            
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image2' ) ); ?>"><?php _e( 'Image #2:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image2' ) ); ?>" type="text" value="<?php echo esc_attr( $image2 ); ?>" />
                <input id="upload_image_button" type="button" value="<?php echo __( 'Upload Image', 'armonico' ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'text2' ) ); ?>"><?php _e( 'Text #2:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text2' ) ); ?>" type="text" value="<?php echo esc_attr( $text2 ); ?>" />
			</p>
            <!-- -->
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link3' ) ); ?>"><?php _e( 'Link #3:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link3' ) ); ?>" type="text" value="<?php echo esc_attr( $link3 ); ?>" />
			</p>
            
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image3' ) ); ?>"><?php _e( 'Image #3:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image3' ) ); ?>" type="text" value="<?php echo esc_attr( $image3 ); ?>" />
                <input id="upload_image_button" type="button" value="<?php echo __( 'Upload Image', 'armonico' ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'text3' ) ); ?>"><?php _e( 'Text #3:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text3' ) ); ?>" type="text" value="<?php echo esc_attr( $text3 ); ?>" />
			</p>
            <!-- -->
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link4' ) ); ?>"><?php _e( 'Link #4:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link4' ) ); ?>" type="text" value="<?php echo esc_attr( $link4 ); ?>" />
			</p>
            
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image4' ) ); ?>"><?php _e( 'Image #4:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image4' ) ); ?>" type="text" value="<?php echo esc_attr( $image4 ); ?>" />
                <input id="upload_image_button" type="button" value="<?php echo __( 'Upload Image', 'armonico' ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'text4' ) ); ?>"><?php _e( 'Text #4:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text4' ) ); ?>" type="text" value="<?php echo esc_attr( $text4 ); ?>" />
			</p>

			
<?php
	}
}