<?php
/**
 * Widget Name: Bean CTA Widget
 */

// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Bean_CTA_Widget' );
	}
);

class Bean_CTA_Widget extends WP_Widget {

	// Constructor
	function __construct() {
		parent::__construct(
			'bean_cta', // Base ID
			__( 'Call to Action', 'trim' ), // Name
			array( 'description' => __( 'A standard call to action (CTA) post widget', 'trim' ) ) // Args
		);
	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Variables
		$link      = $instance['link'];
		$link_text = $instance['link_text'];

		// Before widget
		echo balanceTags( $before_widget );
		?>

		<?php
		if ( $link != '' ) :
?>
<a href="<?php echo $link; ?>" target="_blank"><?php endif; ?>

			<div class="bean-cta">
				<?php
				if ( $link != '' ) :
?>
<h3><?php echo esc_html( $link_text ); ?></h3><?php endif; ?>
			</div>

		<?php
		if ( $link != '' ) :
?>
</a><?php endif; ?>

		<?php
		// After widget
		echo balanceTags( $after_widget );
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['link_text'] = strip_tags( $new_instance['link_text'] );
		$instance['link']      = stripslashes( $new_instance['link'] );

		return $instance;
	}

	// Widget form
	function form( $instance ) {
		$defaults = array(
			'link_text' => '',
			'link'      => 'http://themebeans.com',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link:', 'trim' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'link_text' ); ?>"><?php _e( 'Link Text:', 'trim' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'link_text' ); ?>" name="<?php echo $this->get_field_name( 'link_text' ); ?>" value="<?php echo $instance['link_text']; ?>" />
		</p>
	<?php
	} // END form
} // END class
