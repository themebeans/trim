<?php
/**
 * The template for displaying posts in the gallery post format.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

// META
$orderby = get_post_meta( $post->ID, '_bean_post_randomize', true );
$orderby = ( $orderby == 'off' ) ? 'post__in' : 'rand';

bean_gallery( $post->ID, '', 'slider', $orderby, true );
