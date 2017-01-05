<?php

// Register the three useful image sizes for use in Add Media modal
// http://wpshout.com/adding-using-custom-image-sizes-wordpress-guide-best-thing-ever/

function exchange_custom_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'thumbnail' => __( 'Thumbnail' ),
			'post-thumbnail' => __( 'Featured Image' ),
			'medium-portrait' => __( 'Small Portrait' ),
			'medium-large-portrait' => __( 'Medium Portrait' ),
			'large-portrait' => __( 'Large Portrait' ),
			'header-image' => __( 'Header Image' ),
		) );
}

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 * Source: https://github.com/WordPress/twentysixteen/blob/master/functions.php#L346
 *
 * @since Exchange 0.1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *				      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
// function exchange_content_image_sizes_attr( $sizes, $size ) {
// 	$width = $size[0];
// 	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
// 	840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
// 	600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
// 	return $sizes;
// }
// add_filter( 'wp_calculate_image_sizes', 'exchange_content_image_sizes_attr', 10 , 2 );


// Adding WP Functions & Theme Support.
function exchange_theme_support() {

	$med_h = get_option('medium_size_h' );
	$med_w = get_option('medium_size_w' );
	$large_h = get_option('large_size_h' );
	$large_w = get_option( 'large_size_w' );
	$wide_w = 3 * $med_w;

	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'placeholder', 24, 16, true );
	add_image_size( 'placeholder-portrait', 16, 24, true );
	add_image_size( 'placeholder-square', 24, 24, true );
	add_image_size( 'large', $large_w, $large_h, true );
	add_image_size( 'large-portrait', $large_h, $large_w, true );
	add_image_size( 'medium', $med_w, $med_h, true );
	add_image_size( 'medium-portrait', $med_h, $med_w, true );
	add_image_size( 'medium-large', 1.5 * $med_w, 1.5 * $med_h, true );
	add_image_size( 'medium-large-portrait', 1.5 * $med_h, 1.5 * $med_w, true );
	add_image_size( 'medium-large-square', 1.5 * $med_w, 1.5 * $med_w, true );
	add_image_size( 'header-image', $wide_w, $wide_w * ( 2 / 3 ), true );

	add_filter( 'image_size_names_choose', 'exchange_custom_sizes' );

	// Add RSS Support
	add_theme_support( 'automatic-feed-links' );

	// Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );

	// Add HTML5 Support
	add_theme_support( 'html5',
		array(
			'comment-list',
			'comment-form',
			'search-form',
		)
	);

	// Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
	$GLOBALS['content_width'] = apply_filters( 'exchange_theme_support', 1200 );

} /* end theme support */

add_action( 'after_setup_theme', 'exchange_theme_support' );
