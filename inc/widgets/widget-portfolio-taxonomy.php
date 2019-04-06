<?php
/**
 * Widget Name: Bean Portfolio Taxonomy
 */

// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Bean_Portfolio_Taxonomy_Widget' );
	}
);

class Bean_Portfolio_Taxonomy_Widget extends WP_Widget {

	// Constructor
	function __construct() {
		parent::__construct(
			'bean_portfolio_tax', // Base ID
			__( 'Portfolio Taxonomy', 'trim' ), // Name
			array( 'description' => __( 'A cloud of portfolio tags or categories.', 'trim' ) ) // Args
		);
	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$tax   = $instance['tax'];

		// Before widget
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		// Variable
		if ( $tax != '' ) {
			switch ( $tax ) {
				case 'Portfolio Tags':
					$tax_term = 'portfolio_tag';
					break;
				case 'Portfolio Categories':
					$tax_term = 'portfolio_category';
					break;
			}
		}

		$taxonomy = $tax_term;
		$terms    = get_terms( $taxonomy );

		if ( $terms && ! is_wp_error( $terms ) ) :
		?>
			<div class="tagcloud">
				<?php foreach ( $terms as $term ) { ?>
					<a href="<?php echo get_term_link( $term->slug, $taxonomy ); ?>"><?php echo $term->name; ?></a>
				<?php } ?>
			</div>
		<?php
		endif;
		wp_reset_query();

		// After widget
		echo $after_widget;
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tax']   = $new_instance['tax'];

		return $instance;
	}

	// Display widget form
	function form( $instance ) {
		$defaults = array(
			'title' => 'Skills',
			'tax'   => 'Portfolio Categories',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<?php
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( ! is_plugin_active( 'bean-portfolio/bean-portfolio.php' ) ) {
		?>
			<div class="bean-widget-notification">
				<p><?php _e( 'Please download & install the <b>Bean Portfolio</b> WordPress plugin to properly display this widget.', 'trim' ); ?><br/>
				<a href="<?php echo BEAN_PORTFOLIO_PLUGIN_URL; ?>" target="_blank" class="button button-secondary"><?php _e( 'Bean Portfolio &rarr;', 'trim' ); ?></a></p>
			</div>
		<?php } ?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'trim' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'tax' ); ?>"><?php _e( 'Taxonomy:', 'trim' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'tax' ); ?>" name="<?php echo $this->get_field_name( 'tax' ); ?>" class="widefat">
			<option
			<?php
			if ( 'Portfolio Tags' == $instance['tax'] ) {
				echo 'selected="selected"';}
?>
>Portfolio Tags</option>
			<option
			<?php
			if ( 'Portfolio Categories' == $instance['tax'] ) {
				echo 'selected="selected"';}
?>
>Portfolio Categories</option>
		</select>
		</p>

	<?php
	} // END form
} // END class
