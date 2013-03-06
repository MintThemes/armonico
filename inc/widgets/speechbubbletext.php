<?php
/**
 * Makes a custom Widget for displaying recent projects/portfolio
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package armonico
 * @since armonico 1.0
 */

class mt_armonico_Speech_bubble_area extends WP_Widget {
	
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function mt_armonico_Speech_bubble_area () {
		$widget_ops = array( 
			'classname' => 'mt_armonico_speech_bubble_area', 
			'description' => __( 'On the homepage, this displays the speech bubble area near the bottom', 'armonico' ) 
		);	

		$this->WP_Widget( 'mt_armonico_speech_bubble_area', __( 'Speech Bubble Area', 'armonico' ), $widget_ops );
		$this->alt_option_name = 'mt_armonico_speech_bubble_area';

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
		$cache = wp_cache_get( 'mt_armonico_speech_bubble_area', 'widget' );

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

			$title = apply_filters( 'title', empty( $instance['title'] ) ? __( '', 'armonico' ) : $instance['title'], $instance, $this->id_base);
			$subtitle = apply_filters( 'subtitle', empty( $instance['subtitle'] ) ? __( '', 'armonico' ) : $instance['subtitle'], $instance, $this->id_base);
			$bubbletext = apply_filters( 'bubbletext', empty( $instance['bubbletext'] ) ? __( '', 'armonico' ) : $instance['bubbletext'], $instance, $this->id_base);
			$image = apply_filters( 'image', empty( $instance['image'] ) ? __( '', 'armonico' ) : $instance['image'], $instance, $this->id_base);
			$link = apply_filters( 'link', empty( $instance['link'] ) ? __( '', 'armonico' ) : $instance['link'], $instance, $this->id_base);
			//
			$check1 = apply_filters( 'check1', empty( $instance['check1'] ) ? __( '', 'armonico' ) : $instance['check1'], $instance, $this->id_base);
			$check2 = apply_filters( 'check2', empty( $instance['check2'] ) ? __( '', 'armonico' ) : $instance['check2'], $instance, $this->id_base);
			$check3 = apply_filters( 'check3', empty( $instance['check3'] ) ? __( '', 'armonico' ) : $instance['check3'], $instance, $this->id_base);
			$check4 = apply_filters( 'check4', empty( $instance['check4'] ) ? __( '', 'armonico' ) : $instance['check4'], $instance, $this->id_base);
			
			echo $before_widget;
			echo $before_title;
			echo $title; // Can set this with a widget option, or omit altogether
			echo $after_title;
?>
				<?php if ($bubbletext != ""){?>
					 <div class="info-holder">
                        <div class="cite-box">
                            <div class="ico">
                                <?php if ($link != ""){ ?><a href="<?php echo $link; ?>"><?php if ($image != ""){ ?><img src="<?php echo aq_resize( $image, 50, 50, true); ?>" width="50" height="50" alt="<?php echo $title; ?>" /><?php } ?></a><?php } ?>
                            </div>
                            <div class="text">
                                <?php if ($title != ""){ ?><h3><strong><?php echo $title; ?></strong><?php if ($subtitle != ""){ echo (", " . $subtitle);} ?></h3><?php } ?>
                                <div class="cite">
                                    <div class="t">&nbsp;</div>
                                        <div class="holder">
                                            <p><?php echo $bubbletext; ?></p>
                                        </div>
                                    <div class="b">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                        <ul class="info-list">
                            <?php if ($check1 != ""){ ?><li><?php echo $check1; ?></li><?php } ?>
                            <?php if ($check2 != ""){ ?><li><?php echo $check2; ?></li><?php } ?>
                            <?php if ($check3 != ""){ ?><li><?php echo $check3; ?></li><?php } ?>
                            <?php if ($check4 != ""){ ?><li><?php echo $check4; ?></li><?php } ?>
                        </ul>
                    </div>
                <?php } //bubbletext check 
				
			echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();

		wp_cache_set( 'mt_armonico_speech_bubble_area', $cache, 'widget' );
	}


	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['bubbletext'] = strip_tags( $new_instance['bubbletext'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
		//
		$instance['check1'] = strip_tags( $new_instance['check1'] );
		$instance['check2'] = strip_tags( $new_instance['check2'] );
		$instance['check3'] = strip_tags( $new_instance['check3'] );
		$instance['check4'] = strip_tags( $new_instance['check4'] );

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset( $alloptions['mt_armonico_speech_bubble_area'] ) )
			delete_option( 'mt_armonico_speech_bubble_area' );

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'mt_armonico_speech_bubble_area', 'widget' );
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 **/
	function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$subtitle = isset( $instance[ 'subtitle' ] ) ? esc_attr( $instance[ 'subtitle' ] ) : '';
		$bubbletext = isset( $instance[ 'bubbletext' ] ) ? esc_attr( $instance[ 'bubbletext' ] ) : '';
		$image = isset( $instance[ 'image' ] ) ? esc_attr( $instance[ 'image' ] ) : '';
		$link = isset( $instance[ 'link' ] ) ? esc_attr( $instance[ 'link' ] ) : '';
		//
    	$check1 = isset( $instance[ 'check1' ] ) ? esc_attr( $instance[ 'check1' ] ) : '';
    	$check2 = isset( $instance[ 'check2' ] ) ? esc_attr( $instance[ 'check2' ] ) : '';
		$check3 = isset( $instance[ 'check3' ] ) ? esc_attr( $instance[ 'check3' ] ) : '';
    	$check4 = isset( $instance[ 'check4' ] ) ? esc_attr( $instance[ 'check4' ] ) : '';
?>
            <p>
            	If you do not wish to use this area, leave the fields blank.
            </p>
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
            
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php _e( 'Subtitle:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'bubbletext' ) ); ?>"><?php _e( 'Bubble text:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bubbletext' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bubbletext' ) ); ?>" type="text" value="<?php echo esc_attr( $bubbletext ); ?>" />
			</p>
            <!-- -->
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php _e( 'Image:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="text" value="<?php echo esc_attr( $image ); ?>" />
                 <input id="upload_image_button" type="button" value="<?php echo __( 'Upload Image', 'armonico' ); ?>" />
			</p>
            
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php _e( 'Link:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
			</p>
            
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'check1' ) ); ?>"><?php _e( 'Checkmark 1:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'check1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'check1' ) ); ?>" type="text" value="<?php echo esc_attr( $check1 ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'check2' ) ); ?>"><?php _e( 'Checkmark 2:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'check2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'check2' ) ); ?>" type="text" value="<?php echo esc_attr( $check2 ); ?>" />
			</p>
            <!-- -->
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'check3' ) ); ?>"><?php _e( 'Checkmark 3:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'check3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'check3' ) ); ?>" type="text" value="<?php echo esc_attr( $check3 ); ?>" />
			</p>
            
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'check4' ) ); ?>"><?php _e( 'Checkmark 4:', 'armonico' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'check4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'check4' ) ); ?>" type="text" value="<?php echo esc_attr( $check4 ); ?>" />
			</p>

<?php
	}
}