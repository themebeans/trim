<?php
/**
 * The template for displaying the footer
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

if ( ! is_404() && ! is_page_template( 'template-underconstruction.php' ) ) {
	?>

	<?php if ( ! is_page_template( 'template-portfolio-fullscreen-slider.php' ) ) { ?>
			</div><!-- END #masonry-container -->
		<?php } ?>

	</div><!-- END .content-wrapper -->

	<div class="row footer-row">

	<footer class="footer <?php echo get_theme_mod( 'theme_version', trim_defaults( 'theme_version' ) ); ?> fadein">

		<p>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( $name ); ?></a></p>

		<p class="alt">
			<?php
			if ( get_theme_mod( 'footer_copyright', trim_defaults( 'footer_copyright' ) ) ) {
				echo get_theme_mod( 'footer_copyright', trim_defaults( 'footer_copyright' ) );
			} else {
				echo 'Theme by <a href="http://themebeans.com">ThemeBeans</a>';
			}
			?>
			</p>

		</footer>

	</div>

<?php } ?>

<?php wp_footer(); ?>

</body>

</html>
