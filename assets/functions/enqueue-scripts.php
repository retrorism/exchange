<?php
function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

	// Adding Foundation scripts file in the footer
	wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/assets/js/foundation.js', array( 'jquery' ), '6.2', true );

	$themejspath = get_stylesheet_directory() . '/assets/js/scripts.js';

	if ( is_post_type_archive('collaboration') ) {
		// Adding Foundation scripts file in the header.
		wp_dequeue_script( 'leaflet_map_construct' );
		wp_enqueue_style( 'leaflet_stylesheet' );
		wp_dequeue_script( 'leaflet_js' );
		wp_enqueue_script( 'leaflet_js', get_template_directory_uri() . '/vendor/leaflet/dist/leaflet.js', array(), '', false );
		wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery', 'leaflet_js' ), filemtime( $themejspath ), true );
		$translation_array = array(
			'yellowTandem' => exchange_slug_to_hex('yellow-tandem'),
			'markerUrl'	=> get_template_directory_uri() . '/assets/images/png/T_dot_WEB.png',
		);
		//after wp_enqueue_script
		wp_localize_script( 'site-js', 'leaflet_vars', $translation_array );
	} else {
		// Adding scripts file in the footer with versioning
		wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), filemtime( $themejspath ), true );
	}

	wp_localize_script( 'site-js', 'exchange_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	// Comment reply script for threaded comments
	if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
	  wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);

// Register main stylesheet using technique from toscho
// http://wordpress.stackexchange.com/a/40669

$min	= WP_DEBUG ? '': '.min';
$file   = "/assets/css/style$min.css";
$url	= get_template_directory_uri() . $file;
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
