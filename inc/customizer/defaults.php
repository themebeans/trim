<?php
/**
 * Customizer defaults
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

/**
 * Get the default option for @@pkg.name's Customizer settings.
 *
 * @param  string|string $name Option key name to get.
 * @return mixin
 */
function trim_defaults( $name ) {
	static $defaults;

	if ( ! $defaults ) {
		$defaults = apply_filters(
			'trim_defaults', array(

				// Identity.
				'custom_logo_max_width'        => 50,
				'custom_logo_mobile_max_width' => 50,

				// Colors.
				'theme_accent_color'           => '#14afe4',
				'theme_style'                  => 'theme_style_1',
				'hidden_sidebar'               => true,

				'twitter_profile'              => '',
				'footer_copyright'             => '',
				'header_style'                 => 'header-2',

				'show_tags'                    => false,
				'post_likes'                   => true,
				'show_single_post_sidebar'     => false,
				'post_sharing'                 => true,
				'show_post_loop_single'        => true,
				'post_more_loop'               => 'more',

				'portfolio_filter'             => true,
				'portfolio_likes'              => true,
				'portfolio_meta'               => true,
				'show_portfolio_sharing'       => true,
				'show_portfolio_loop_single'   => true,
				'portfolio_posts_count'        => '-1',

				'theme_version'                => 'theme_version_grid',
				'portfolio_loop_orderby'       => 'date',
				'portfolio_css_filter'         => 'none',
				'portfolio_more_loop'          => 'more',

				'bean_contact_form'            => true,
				'admin_custom_email'           => '',
				'contact_button_text'          => 'Send',
				'google_maps_code'             => '',

				'edd_filter'                   => true,
				'edd_meta'                     => true,
				'edd_likes'                    => true,
				'show_single_edd_sidebar'      => true,
				'show_edd_sharing'             => true,
				'show_edd_loop_single'         => true,
				'edd_posts_count'              => '-1',
				'edd_more_loop'                => 'more',
			)
		);
	}

	return isset( $defaults[ $name ] ) ? $defaults[ $name ] : null;
}
