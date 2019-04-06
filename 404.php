<?php
/**
 * The template for displaying the 404 error page
 * This page is set automatically, not through the use of a template
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

get_header(); ?>

	<div class="error-logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home">
		<?php if ( get_theme_mod( '404-img-upload', trim_defaults( '404-img-upload' ) ) ) { ?>
			<img src="<?php echo get_theme_mod( '404-img-upload', trim_defaults( '404-img-upload' ) ); ?>"/>
		<?php } else { ?>
			<img src="
			<?php
			echo get_template_directory_uri();
			echo '/assets/images/404.png';
?>
">
		<?php } ?>
		</a>
	</div><!-- END .error-logo -->

	<p><?php echo get_theme_mod( 'error_text', trim_defaults( 'error_text' ) ); ?><br/><?php _e( 'Head ', 'trim' ); ?><a href="javascript:javascript:history.go(-1)"><?php _e( 'back', 'trim' ); ?></a><?php _e( ' or go on ', 'trim' ); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'home', 'trim' ); ?></a>.</p>

<?php
get_footer();
