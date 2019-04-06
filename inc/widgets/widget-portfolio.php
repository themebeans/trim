<?php
/**
 * Widget Name: Bean Portfolio
 */

// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Bean_Portfolio_Widget' );
	}
);

class Bean_Portfolio_Widget extends WP_Widget {

	// Constructor
	function __construct() {
		parent::__construct(
			'bean_portfolio', // Base ID
			__( 'Portfolio', 'trim' ), // Name
			array( 'description' => __( 'Standard portfolio post widget.', 'trim' ) ) // Args
		);
	}

	// Display Widget
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );

		// WIDGET VARIABLES
		$desc      = $instance['desc'];
		$postcount = $instance['postcount'];
		$loop      = $instance['loop'];

		// BEFORE WIDGET
		echo $before_widget;
		?>

		<?php
		if ( $title ) {
			echo $before_title . $title . $after_title;}
?>
		<?php
		if ( $desc != '' ) :
?>
<p><?php echo $desc; ?></p><?php endif; ?>

		<ul>
			<?php
			// SELECT VARIABLE
			if ( $loop != '' ) {
				switch ( $loop ) {
					case 'Most Recent':
						$orderby  = 'date';
						$meta_key = '';
						break;
					case 'Random':
						$orderby  = 'rand';
						$meta_key = '';
						break;
					case 'Most Views':
						$orderby  = 'meta_value_num';
						$meta_key = 'post_views_count';
						break;
				}
			}

			$args = array(
				'post_type'      => 'portfolio',
				'order'          => 'DSC',
				'orderby'        => $orderby,
				'meta_key'       => $meta_key,
				'posts_per_page' => $postcount,
			);
			query_posts( $args );
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();

						?>

							<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { // FEATURED IMAGE ?>
					<li>
						<div class="post-thumb">
							<a title="<?php printf( __( 'Permanent Link to %s', 'trim' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'grid-feat' ); ?>
								 </a>
						</div>
					</li>
				<?php } ?>

				<?php
			endwhile;
endif;
			wp_reset_query();
?>

		</ul>

		<?php
		// After Widget
		echo $after_widget;
	}

	// Update Widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip Tags
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['desc']      = stripslashes( $new_instance['desc'] );
		$instance['loop']      = $new_instance['loop'];
		$instance['postcount'] = $new_instance['postcount'];

		return $instance;
	}

	// Display Widget
	function form( $instance ) {
		$defaults = array(
			'title'     => 'Projects',
			'desc'      => 'Display your portfolio posts by most recent, most popular or randomly.',
			'postcount' => '1',
			'loop'      => 'Most Recent',
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

		<p style="margin-top: -8px;">
		<textarea class="widefat" rows="5" cols="15" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e( 'Number of Posts: (-1 for Infinite)', 'trim' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'loop' ); ?>"><?php _e( 'Portfolio Loop:', 'trim' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'loop' ); ?>" name="<?php echo $this->get_field_name( 'loop' ); ?>" class="widefat">
			<option
			<?php
			if ( 'Most Recent' == $instance['loop'] ) {
				echo 'selected="selected"';}
?>
>Most Recent</option>
			<option
			<?php
			if ( 'Most Views' == $instance['loop'] ) {
				echo 'selected="selected"';}
?>
>Most Views</option>
			<option
			<?php
			if ( 'Random' == $instance['loop'] ) {
				echo 'selected="selected"';}
?>
>Random</option>
		</select>
		</p>
	<?php
	} //END form
} //END class
