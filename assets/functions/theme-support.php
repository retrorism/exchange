<?php

// Register the three useful image sizes for use in Add Media modal
// http://wpshout.com/adding-using-custom-image-sizes-wordpress-guide-best-thing-ever/

function tandem_custom_sizes( $sizes ) {
		return array_merge( $sizes, array(
				'thumbnail' => __( 'Thumbnail' ),
				'post-thumbnail' => __( 'Featured Image' ),
				'story-landscape' => __( 'Story Landscape' ),
				'story-portrait' => __( 'Story Portrait' ),
				'header-image' => __( 'Header Image' ),
				'story-landscape-small' => __( 'Story Landscape Small' ),
				'story-portrait-small' => __( 'Story Portrait Small' ),
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
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function tandem_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];
	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
	600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	return $sizes;
}



// Adding WP Functions & Theme Support
function tandem_theme_support() {

	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );

	// Default thumbnail size
	set_post_thumbnail_size( 480, 320, true );

	add_image_size( 'story-landscape', get_option( 'medium_size_w' ), get_option('medium_size_h' ), true );
	add_image_size( 'story-landscape-small', get_option( 'medium_size_w' ) / 2, get_option('medium_size_h' ) / 2, true );
	add_image_size( 'story-portrait', get_option( 'medium_size_h' ), get_option('medium_size_w' ), true );
	add_image_size( 'story-portrait-small', get_option( 'medium_size_h' ) / 2, get_option('medium_size_w' ) / 2, true );
	add_image_size( 'medium', get_option( 'medium_size_w' ), 9999 , false );
	add_image_size( 'large', get_option( 'large_size_w' ), 9999 , false );
	add_image_size( 'header-image', 1440, 720, true);
	remove_image_size( 'medium_large' );

	add_filter( 'image_size_names_choose', 'tandem_custom_sizes' );
	add_filter( 'wp_calculate_image_sizes', 'tandem_content_image_sizes_attr', 10 , 2 );


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

	// Adding post format support
	/* add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	); */

} /* end theme support */
