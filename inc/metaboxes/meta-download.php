<?php
/**
 * The file is for creating the product post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

function bean_metabox_download() {

	$prefix = '_bean_';

	/*
	===================================================================*/
	/*
	  PAGE META SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'download-meta',
		'title'    => __( 'Download Meta', 'trim' ),
		'page'     => 'download',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Download Excerpt:', 'trim' ),
				'desc' => __( 'A mini description of your download, to be displayed on the downloads page.', 'trim' ),
				'id'   => $prefix . 'download_excerpt',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Download Grid Image:', 'trim' ),
				'desc' => 'Upload an image for the grid.',
				'id'   => $prefix . 'download_grid_image',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

}
add_action( 'add_meta_boxes', 'bean_metabox_download' );
