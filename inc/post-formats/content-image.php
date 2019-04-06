<?php
/**
 * The template for displaying posts in the Image post format.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

// POST META
$orderby = get_post_meta( $post->ID, '_bean_post_randomize', true );
$orderby = ( $orderby == 'off' ) ? 'post__in' : 'rand';
?>

<?php
bean_gallery( $post->ID, '', 'post-lightbox', $orderby, true );
