<?php
/**
 * Plugin Name: Bootstrap Genesis Featured Image Sizes Attribute Modification
 * Plugin URI: https://github.com/salcode/bsg-featured-image-sizes-attribute-modification
 * Description: On sites using the Bootstrap Genesis Theme on pages using the content-sidebar layout, modify the sizes attribute on the featured image to reflect the columns being used.
 * Version: 0.1.0
 * Author: Sal Ferrarello
 * Author URI: http://salferrarello.com/
 * Text Domain: bsg-featured-image-sizes-attribute-modification
 * Domain Path: /languages
 *
 * @package bsg-featured-image-sizes-attribute-modification
 */

add_filter( 'wp_calculate_image_sizes', 'bsg_featured_image_wp_calculate_image_sizes', 10, 5 );

/**
 * On sites using the Bootstrap Genesis Theme on pages using the content-sidebar layout,
 * modify the sizes attribute on the featured image to reflect the columns being used.
 *
 * @param string       $sizes         A source size value for use in a 'sizes' attribute.
 * @param array|string $size          Requested size. Image size or array of width and height values
 *                                    in pixels (in that order).
 * @param string|null  $image_src     The URL to the image file or null.
 * @param array|null   $image_meta    The image meta data as returned by wp_get_attachment_metadata() or null.
 * @param int          $attachment_id Image attachment ID of the original image or 0.
 *
 * @return string The updated value for the `sizes` attribute.
 */
function bsg_featured_image_wp_calculate_image_sizes( $sizes, $size, $image_src, $image_meta, $attachment_id ) {

	$theme = wp_get_theme();
	if ( 'Bootstrap Genesis' !== $theme->name ) {
		return $sizes;
	}

	if ( 'content-sidebar' !== genesis_site_layout() ) {
		return $sizes;
	}

	if ( '(max-width: 1170px) 100vw, 1170px' !== $sizes ) {
		return $sizes;
	}

	return '(max-width: 767px) 100vw, (max-width: 1200px) 75vw, 900px';
}
