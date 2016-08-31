<?php

function site_scripts() {
	// Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way.
	global $wp_styles;

	// Adding Foundation scripts file in the footer.
	wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/assets/js/foundation.js', array( 'jquery' ), '6.2', true );

	// Adding masonry script for archive templates.
	if ( is_archive() ) {
		wp_enqueue_script( 'masonry-js', get_template_directory_uri() . '/vendor/masonry/dist/masonry.pkgd.min.js', array( 'jquery' ), '', true );
	}

	if ( is_post_type_archive('collaboration') ) {
		// Adding Foundation scripts file in the header.
		wp_dequeue_script( 'leaflet_map_construct' );
		wp_enqueue_style( 'leaflet_stylesheet' );
		wp_dequeue_script( 'leaflet_js' );
		wp_enqueue_script( 'leaflet_js', get_template_directory_uri() . '/vendor/leaflet/dist/leaflet.js', array(), '', false );
		wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery', 'masonry-js', 'leaflet_js', 'leaflet_snake_js' ), '', true );

		$translation_array = array(
			'yellowTandem' => exchange_slug_to_hex('yellow-tandem'),
			'markerUrl'    => get_template_directory_uri() . '/assets/images/png/T_dot_WEB.png',
		);
		//after wp_enqueue_script
		wp_localize_script( 'site-js', 'leaflet_vars', $translation_array );
	} else {
		// Adding scripts file in the footer.
		wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '', true );
	}

}
add_action('wp_enqueue_scripts', 'site_scripts', 999);

// Register main stylesheet using technique from toscho
// http://wordpress.stackexchange.com/a/40669

$min    = WP_DEBUG ? '': '.min';
$file   = "/assets/css/style$min.css";
$url    = get_template_directory_uri() . $file;
$path   = get_template_directory() . $file;
$handle = get_stylesheet() . '-default';

// Overridden?
if ( is_child_theme() && is_readable( get_stylesheet_directory() . $file ) )
{
    $url  = get_stylesheet_directory_uri() . $file;
    $path = get_stylesheet_directory() . $file;
}

$modified = filemtime( $path );

add_action( 'wp_loaded', function() use ( $handle, $url, $modified ) {
    wp_register_style( $handle, $url, [], $modified );
});

add_action( 'wp_enqueue_scripts', function() use ( $handle ) {
    wp_enqueue_style( $handle );
});
