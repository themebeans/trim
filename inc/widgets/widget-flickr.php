<?php
/**
 * Widget Name: Bean Flickr Widget
 */

// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Bean_Flickr_Widget' );
	}
);

class Bean_Flickr_Widget extends WP_Widget {

	// Constructor
	function __construct() {
		parent::__construct(
			'bean_flickr', // Base ID
			__( 'Flickr Photos', 'trim' ), // Name
			array( 'description' => __( 'Add a Flickr feed widget.', 'trim' ) ) // Args
		);
	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Variables
		$title    = apply_filters( 'widget_title', $instance['title'] );
		$flickrID = $instance['flickrID'];
		$type     = $instance['type'];
		$display  = $instance['display'];

		// Before
		echo balanceTags( $before_widget );

		if ( $title ) {
			echo balanceTags( $before_title ) . esc_html( $title ) . balanceTags( $after_title );
		}

		// Variable
		if ( $type != '' ) {
			switch ( $type ) {
				case 'User':
					$type = 'user';
					break;
				case 'Group':
					$type = 'group';
					break;
			}
		}

		if ( $display != '' ) {
			switch ( $display ) {
				case 'Random':
					$display = 'random';
					break;
				case 'Latest':
					$display = 'latest';
					break;
			}
		}
		?>

		<div class="flickr-image-wrapper">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=<?php echo esc_js( $display ); ?>&amp;size=s&amp;layout=x&amp;source=<?php echo esc_js( $type ); ?>&amp;<?php echo esc_js( $type ); ?>=<?php echo esc_js( $flickrID ); ?>"></script>
		</div>

		<?php

		// After
		echo $after_widget;
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['type']     = $new_instance['type'];
		$instance['display']  = $new_instance['display'];

		return $instance;
	}

	// Display widget
	function form( $instance ) {
		$defaults = array(
			'title'    => '',
			'flickrID' => '',
			'type'     => 'User',
			'display'  => 'Latest',

		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title / Intro:', 'trim' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'flickrID' ) ); ?>"><?php _e( 'Flickr ID:', 'trim' ); ?> (<a target="_blank" href="http://idgettr.com/">idGettr</a>)</label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'flickrID' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickrID' ) ); ?>" value="<?php echo esc_attr( $instance['flickrID'] ); ?>" />
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php _e( 'Type:', 'trim' ); ?></label>
		<select id="<?php echo esc_html( $this->get_field_id( 'type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" class="widefat">
			<option
			<?php
			if ( 'User' == $instance['type'] ) {
				echo 'selected="selected"';}
?>
>User</option>
			<option
			<?php
			if ( 'Group' == $instance['type'] ) {
				echo 'selected="selected"';}
?>
>Group</option>
		</select>
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>"><?php _e( 'Display:', 'trim' ); ?></label>
		<select id="<?php echo esc_html( $this->get_field_id( 'display' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>" class="widefat">
			<option
			<?php
			if ( 'Random' == $instance['display'] ) {
				echo 'selected="selected"';}
?>
>Random</option>
			<option
			<?php
			if ( 'Latest' == $instance['display'] ) {
				echo 'selected="selected"';}
?>
>Latest</option>
		</select>
		</p>
	<?php
	} //END form
} //END class
