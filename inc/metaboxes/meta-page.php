<?php
/**
 * The file is for creating the page post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

function bean_metabox_page() {

	// Start with an underscore to hide fields from custom fields list.
	$prefix = '_bean_';

	// Set the context, based on whether or not Gutenberg is enabled.
	$context = ( function_exists( 'register_block_type' ) ) ? 'side' : 'normal';

	/**
	 * Post Settings.
	 */
	$meta_box = array(
		'id'       => 'page-meta',
		'title'    => __( 'Page Settings', 'trim' ),
		'page'     => 'page',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => 'Display Page Title:',
				'id'   => $prefix . 'page_title',
				'type' => 'checkbox',
				'desc' => 'Select to display the page title above the main entry content.',
				'std'  => true,
			),
			array(
				'name'    => __( 'Page Layout:', 'trim' ),
				'desc'    => __( 'Select your page layout option.', 'trim' ),
				'id'      => $prefix . 'page_layout',
				'type'    => 'radio',
				'std'     => 'page_sidebar',
				'options' => array(
					'page_std'               => __( 'Standard', 'trim' ),
					'page_sidebar'           => __( 'Sidebar', 'trim' ),
					'page_fullwidth'         => __( 'Full', 'trim' ),
					'page_fullwidth_sidebar' => __( 'Full Sidebar', 'trim' ),
				),
			),
		),
	);
	bean_add_meta_box( $meta_box );

}
add_action( 'add_meta_boxes', 'bean_metabox_page' );
