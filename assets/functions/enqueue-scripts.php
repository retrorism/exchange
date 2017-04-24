<?php
function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    // Adding Foundation scripts file in the footer
    wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/assets/js/foundation.js', array( 'jquery' ), '6.2', true );

    wp_enqueue_script( 'masonry-js', get_stylesheet_directory_uri() . '/vendor/masonry/dist/masonry.pkgd.min.js', array(), '', true );

    wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery','foundation-js', 'masonry-js' ), '', true );

	wp_localize_script( 'site-js', 'exchange_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
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
