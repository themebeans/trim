<?php
/**
 * Theme Customizer functionality
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function trim_customize_register( $wp_customize ) {

	/**
	 * Customize.
	 */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-range-control.php' );

	/**
	 * Add the site logo max-width options to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => trim_defaults( 'custom_logo_max_width' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => trim_defaults( 'custom_logo_max_width' ),
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Max Width', 'trim' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 8,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 300,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'custom_logo_mobile_max_width', array(
			'default'           => trim_defaults( 'custom_logo_mobile_max_width' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_mobile_max_width', array(
				'default'     => trim_defaults( 'custom_logo_mobile_max_width' ),
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Mobile Max Width', 'trim' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 200,
					'step' => 2,
				),
			)
		)
	);

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_setting(
		'hidden_sidebar', array(
			'default' => trim_defaults( 'hidden_sidebar' ),
		)
	);
	$wp_customize->add_control(
		'hidden_sidebar', array(
			'type'     => 'checkbox',
			'label'    => 'Enable Hidden Sidebar',
			'section'  => 'general_settings',
			'priority' => 3,
		)
	);

	$wp_customize->add_section(
		'general_settings', array(
			'title'    => __( 'Theme Options', 'trim' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'twitter_profile', array(
			'default' => trim_defaults( 'twitter_profile' ),
		)
	);
	$wp_customize->add_control(
		'twitter_profile', array(
			'label'    => __( 'Twitter Username', 'trim' ),
			'section'  => 'general_settings',
			'type'     => 'text',
			'priority' => 6,
		)
	);

	$wp_customize->add_setting(
		'footer_copyright', array(
			'default'   => trim_defaults( 'footer_copyright' ),
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'footer_copyright', array(
			'type'     => 'textarea',
			'label'    => esc_html__( 'Footer Copyright', 'trim' ),
			'section'  => 'general_settings',
			'priority' => 7,
		)
	);

	$wp_customize->add_setting(
		'theme_accent_color', array(
			'default' => trim_defaults( 'theme_accent_color' ),
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'theme_accent_color', array(
				'label'    => __( 'Accent Color', 'trim' ),
				'section'  => 'colors',
				'settings' => 'theme_accent_color',
			)
		)
	);

	$wp_customize->add_setting(
		'theme_style', array(
			'default' => trim_defaults( 'theme_style' ),
		)
	);
	$wp_customize->add_control(
		'theme_style',
		array(
			'type'    => 'select',
			'label'   => __( 'Theme Style', 'trim' ),
			'section' => 'colors',
			'choices' => array(
				'theme_style_1' => __( 'Default', 'trim' ),
				'theme_style_2' => __( 'Minimal', 'trim' ),
				'theme_style_3' => __( 'Dark', 'trim' ),
			),
		)
	);

	$wp_customize->add_setting(
		'header_style', array(
			'default' => trim_defaults( 'header_style' ),
		)
	);

	$wp_customize->add_control(
		'header_style',
		array(
			'type'    => 'select',
			'label'   => __( 'Header Layout', 'trim' ),
			'section' => 'colors',
			'choices' => array(
				'header-2' => __( 'Default', 'trim' ),
				'header-1' => __( 'Fixed', 'trim' ),
				'header-3' => __( 'Centered', 'trim' ),
			),
		)
	);

	$wp_customize->add_section(
		'blog_settings', array(
			'title'    => __( 'Blog', 'trim' ),
			'priority' => 39,
		)
	);

	$wp_customize->add_setting(
		'show_tags', array(
			'default' => trim_defaults( 'show_tags' ),
		)
	);
	$wp_customize->add_control(
		'show_tags',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Tags', 'trim' ),
			'section'  => 'blog_settings',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
		'post_likes', array(
			'default' => trim_defaults( 'post_likes' ),
		)
	);
	$wp_customize->add_control(
		'post_likes',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Likes', 'trim' ),
			'section'  => 'blog_settings',
			'priority' => 2,
		)
	);

	$wp_customize->add_setting(
		'show_single_post_sidebar', array(
			'default' => trim_defaults( 'show_single_post_sidebar' ),
		)
	);
	$wp_customize->add_control(
		'show_single_post_sidebar',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Single Sidebar', 'trim' ),
			'section'  => 'blog_settings',
			'priority' => 3,
		)
	);

	$wp_customize->add_setting(
		'post_sharing', array(
			'default' => trim_defaults( 'post_sharing' ),
		)
	);

	$wp_customize->add_control(
		'post_sharing',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Single Sharing', 'trim' ),
			'section'  => 'blog_settings',
			'priority' => 4,
		)
	);

	$wp_customize->add_setting(
		'show_post_loop_single', array(
			'default' => trim_defaults( 'show_post_loop_single' ),
		)
	);

	$wp_customize->add_control(
		'show_post_loop_single',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Single Post Loop', 'trim' ),
			'section'  => 'blog_settings',
			'priority' => 5,
		)
	);

	$wp_customize->add_setting(
		'post_more_loop', array(
			'default' => trim_defaults( 'post_more_loop' ),
		)
	);

	$wp_customize->add_control(
		'post_more_loop',
		array(
			'type'     => 'select',
			'label'    => __( 'Post Single Loop', 'trim' ),
			'section'  => 'blog_settings',
			'priority' => 10,
			'choices'  => array(
				'more'    => __( 'All Posts', 'trim' ),
				'related' => __( 'Related Posts', 'trim' ),
			),
		)
	);

	$wp_customize->add_section(
		'portfolio_settings', array(
			'title'    => __( 'Portfolio', 'trim' ),
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'portfolio_filter', array(
			'default' => trim_defaults( 'portfolio_filter' ),
		)
	);
	$wp_customize->add_control(
		'portfolio_filter',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Filtering', 'trim' ),
			'section'  => 'portfolio_settings',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
		'portfolio_likes', array(
			'default' => trim_defaults( 'portfolio_likes' ),
		)
	);
	$wp_customize->add_control(
		'portfolio_likes',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Likes', 'trim' ),
			'section'  => 'portfolio_settings',
			'priority' => 2,
		)
	);

	$wp_customize->add_setting(
		'portfolio_meta', array(
			'default' => trim_defaults( 'portfolio_meta' ),
		)
	);
	$wp_customize->add_control(
		'portfolio_meta',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Template Meta', 'trim' ),
			'section'  => 'portfolio_settings',
			'priority' => 3,
		)
	);

	$wp_customize->add_setting(
		'show_portfolio_sharing', array(
			'default' => trim_defaults( 'show_portfolio_sharing' ),
		)
	);
	$wp_customize->add_control(
		'show_portfolio_sharing',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Single Sharing', 'trim' ),
			'section'  => 'portfolio_settings',
			'priority' => 5,
		)
	);

	$wp_customize->add_setting(
		'show_portfolio_loop_single', array(
			'default' => trim_defaults( 'show_portfolio_loop_single' ),
		)
	);
	$wp_customize->add_control(
		'show_portfolio_loop_single',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Single Porfolio Loop', 'trim' ),
			'section'  => 'portfolio_settings',
			'priority' => 6,
		)
	);

	$wp_customize->add_setting(
		'portfolio_posts_count', array(
			'default' => trim_defaults( 'portfolio_posts_count' ),
		)
	);
	$wp_customize->add_control(
		'portfolio_posts_count',
		array(
			'label'    => __( 'Portfolio Count', 'trim' ),
			'section'  => 'portfolio_settings',
			'type'     => 'text',
			'priority' => 7,
		)
	);

	$wp_customize->add_setting(
		'theme_version', array(
			'default' => trim_defaults( 'theme_version' ),
		)
	);
	$wp_customize->add_control(
		'theme_version',
		array(
			'type'     => 'select',
			'label'    => __( 'Portfolio Layout', 'trim' ),
			'section'  => 'portfolio_settings',
			'priority' => 8,
			'choices'  => array(
				'theme_version_grid'       => __( 'Masonry Gallery', 'trim' ),
				'theme_version_fullwidth'  => __( 'Fullwidth Stacked', 'trim' ),
				'theme_version_fullscreen' => __( 'Fullscreen Slider', 'trim' ),
			),
		)
	);

	$wp_customize->add_setting(
		'portfolio_loop_orderby', array(
			'default' => trim_defaults( 'portfolio_loop_orderby' ),
		)
	);
	$wp_customize->add_control(
		'portfolio_loop_orderby',
		array(
			'type'     => 'select',
			'label'    => __( 'Portfolio Template Loop', 'trim' ),
			'section'  => 'portfolio_settings',
			'priority' => 9,
			'choices'  => array(
				'date'       => __( 'Most Recent', 'trim' ),
				'view_count' => __( 'Most Popular', 'trim' ),
				'menu_order' => __( 'Sort Order', 'trim' ),
			),
		)
	);

	$wp_customize->add_setting(
		'portfolio_css_filter', array(
			'default' => trim_defaults( 'portfolio_css_filter' ),
		)
	);
	$wp_customize->add_control(
		'portfolio_css_filter',
		array(
			'type'     => 'select',
			'label'    => __( 'Portfolio CSS3 Filter', 'trim' ),
			'section'  => 'portfolio_settings',
			'priority' => 10,
			'choices'  => array(
				'none'       => __( 'None', 'trim' ),
				'grayscale'  => __( 'Black & White', 'trim' ),
				'sepia'      => __( 'Sepia Tone', 'trim' ),
				'saturation' => __( 'High Saturation', 'trim' ),
			),
		)
	);

	$wp_customize->add_setting(
		'portfolio_more_loop', array(
			'default' => trim_defaults( 'portfolio_more_loop' ),
		)
	);
	$wp_customize->add_control(
		'portfolio_more_loop',
		array(
			'type'     => 'select',
			'label'    => __( 'Portfolio Single Loop', 'trim' ),
			'section'  => 'portfolio_settings',
			'priority' => 11,
			'choices'  => array(
				'more'    => __( 'All Posts', 'trim' ),
				'related' => __( 'Related Posts', 'trim' ),
			),
		)
	);

	$wp_customize->add_section(
		'contact_settings', array(
			'title'    => __( 'Contact', 'trim' ),
			'priority' => 41,
		)
	);

	$wp_customize->add_setting(
		'bean_contact_form', array(
			'default' => trim_defaults( 'bean_contact_form' ),
		)
	);
	$wp_customize->add_control(
		'bean_contact_form',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Use Default Contact Form', 'trim' ),
			'section' => 'contact_settings',
		)
	);

	$wp_customize->add_setting(
		'admin_custom_email', array(
			'default' => trim_defaults( 'admin_custom_email' ),
		)
	);
	$wp_customize->add_control(
		'admin_custom_email',
		array(
			'label'   => __( 'Contact Form Email', 'trim' ),
			'section' => 'contact_settings',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'contact_button_text', array(
			'default'   => trim_defaults( 'contact_button_text' ),
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'contact_button_text',
		array(
			'label'   => __( 'Contact Button Text', 'trim' ),
			'section' => 'contact_settings',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'google_maps_code', array(
			'default' => trim_defaults( 'google_maps_code' ),
		)
	);
	$wp_customize->add_control(
		'google_maps_code', array(
			'type'        => 'textarea',
			'label'       => esc_html__( 'Google Maps Code', 'trim' ),
			'description' => __( 'Insert your Google map embed to display a map on the Contact template.', 'trim' ),
			'section'     => 'google_maps_code',
		)
	);

	if ( class_exists( 'Easy_Digital_Downloads' ) ) {

		$wp_customize->add_section(
			'edd_settings', array(
				'title'    => __( 'EDD', 'trim' ),
				'priority' => 43,
			)
		);

			$wp_customize->add_setting(
				'edd_filter', array(
					'default' => trim_defaults( 'edd_filter' ),
				)
			);

			$wp_customize->add_control(
				'edd_filter',
				array(
					'type'    => 'checkbox',
					'label'   => __( 'Enable Filtering', 'trim' ),
					'section' => 'edd_settings',
				)
			);

			$wp_customize->add_setting(
				'edd_meta', array(
					'default' => trim_defaults( 'edd_meta' ),
				)
			);

			$wp_customize->add_control(
				'edd_meta',
				array(
					'type'    => 'checkbox',
					'label'   => __( 'Enable Template Meta', 'trim' ),
					'section' => 'edd_settings',
				)
			);

			$wp_customize->add_setting(
				'edd_likes', array(
					'default' => trim_defaults( 'edd_likes' ),
				)
			);

			$wp_customize->add_control(
				'edd_likes',
				array(
					'type'     => 'checkbox',
					'label'    => __( 'Enable Likes', 'trim' ),
					'section'  => 'edd_settings',
					'priority' => 3,
				)
			);

			$wp_customize->add_setting(
				'show_single_edd_sidebar', array(
					'default' => trim_defaults( 'show_single_edd_sidebar' ),
				)
			);

			$wp_customize->add_control(
				'show_single_edd_sidebar',
				array(
					'type'     => 'checkbox',
					'label'    => __( 'Enable Single Sidebar', 'trim' ),
					'section'  => 'edd_settings',
					'priority' => 5,
				)
			);

			$wp_customize->add_setting(
				'show_edd_sharing', array(
					'default' => trim_defaults( 'show_edd_sharing' ),
				)
			);
			$wp_customize->add_control(
				'show_edd_sharing',
				array(
					'type'     => 'checkbox',
					'label'    => __( 'Enable Single Sharing', 'trim' ),
					'section'  => 'edd_settings',
					'priority' => 6,
				)
			);

			$wp_customize->add_setting(
				'show_edd_loop_single', array(
					'default' => trim_defaults( 'show_edd_loop_single' ),
				)
			);
			$wp_customize->add_control(
				'show_edd_loop_single',
				array(
					'type'     => 'checkbox',
					'label'    => __( 'Enable Single Shop Loop', 'trim' ),
					'section'  => 'edd_settings',
					'priority' => 7,
				)
			);

			$wp_customize->add_setting(
				'edd_posts_count', array(
					'default' => trim_defaults( 'edd_posts_count' ),
				)
			);

			$wp_customize->add_control(
				'edd_posts_count',
				array(
					'label'    => __( 'Downloads Count', 'trim' ),
					'section'  => 'edd_settings',
					'type'     => 'text',
					'priority' => 8,
				)
			);

			$wp_customize->add_setting(
				'edd_more_loop', array(
					'default' => trim_defaults( 'edd_more_loop' ),
				)
			);

			$wp_customize->add_control(
				'edd_more_loop',
				array(
					'type'     => 'select',
					'label'    => __( 'Portfolio Single Loop', 'trim' ),
					'section'  => 'edd_settings',
					'priority' => 10,
					'choices'  => array(
						'more'    => 'All Posts',
						'related' => 'Related Posts',
					),
				)
			);
	}

	$wp_customize->add_section(
		'404_settings', array(
			'title'    => __( '404 & Construction', 'trim' ),
			'priority' => 200,
		)
	);

	$wp_customize->add_setting( 'construction-img-upload', array() );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'construction-img-upload', array(
				'label'    => __( 'Construction Custom Image', 'trim' ),
				'section'  => '404_settings',
				'settings' => 'construction-img-upload',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_setting( '404-img-upload', array() );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, '404-img-upload', array(
				'label'    => __( '404 Custom Image', 'trim' ),
				'section'  => '404_settings',
				'settings' => '404-img-upload',
				'priority' => 2,
			)
		)
	);

	$wp_customize->add_setting( 'error_text', array( 'default' => '' ) );
	$wp_customize->add_control(
		'error_text',
		array(
			'label'    => __( '404 Text', 'trim' ),
			'section'  => '404_settings',
			'type'     => 'text',
			'priority' => 3,
		)
	);
}
add_action( 'customize_register', 'trim_customize_register' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function trim_customizer_live_preview() {
	wp_enqueue_script( 'trim-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview' . TRIM_ASSET_SUFFIX . '.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'trim_customizer_live_preview' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function trim_customize_controls_js() {
	wp_enqueue_script( 'trim-customize-controls', get_theme_file_uri( '/assets/js/admin/customize-controls' . TRIM_ASSET_SUFFIX . '.js' ), array( 'customize-controls' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'trim_customize_controls_js' );
