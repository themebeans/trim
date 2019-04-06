<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

if ( ! function_exists( 'trim_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function trim_site_logo() {

		$visibility = ( has_custom_logo() ) ? ' hidden' : null;

		do_action( 'trim_before_site_logo' );

		the_custom_logo();

		if ( ! has_custom_logo() || is_customize_preview() ) {
			printf( '<h1 class="h3 site-title site-logo %1$s" itemscope itemtype="http://schema.org/Organization"><a href="%2$s" rel="home" itemprop="url" class="black">%3$s</a></h1>', esc_attr( $visibility ), esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );

		}

		do_action( 'trim_after_site_logo' );
	}

endif;
