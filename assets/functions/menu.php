<?php
// Register menus
register_nav_menus(
	array(
		'main-nav-left' => __( 'Main Menu Left', 'exchange' ),   // Main nav in header
		'main-nav-right' => __( 'Main Menu Right', 'exchange' ),   // Main nav in header
		'footer-links' => __( 'Footer Links', 'exchange' ), // Secondary nav in footer
		'mobile-nav' => __( 'Mobile Nav', 'exchange' ) // mobile nav in footer

	)
);

// The Top Menu
function exchange_top_nav( $side ) {
	$allowed_sides = array( 'left','right' );
	if ( ! in_array( $side, $allowed_sides, true ) ) {
		return;
	} else {
		wp_nav_menu( array(
			'container' => false,                           // Remove nav container
			'menu_class' => 'vertical medium-horizontal menu',       // Adding custom nav class
			'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
			'theme_location' => 'main-nav-' . $side,        			// Where it's located in the theme
			'depth' => 5,                                   // Limit the depth of the nav
			'fallback_cb' => false,                         // Fallback function (see below)
			'walker' => new Topbar_Menu_Walker(),
		) );
	}
}

// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu simple\">\n";
    }
}

// The Off Canvas Menu
function exchange_off_canvas_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
        'theme_location' => 'main-nav',        			// Where it's located in the theme
        'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Off_Canvas_Menu_Walker()
    ));
}

class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"vertical menu\">\n";
    }
}

// The Footer Menu
function exchange_footer_links() {
    wp_nav_menu(array(
    	'container' => 'false',                         // Remove nav container
    	'menu' => __( 'Footer Links', 'exchange' ),   	// Nav name
    	'menu_class' => 'menu',      					// Adding custom nav class
    	'theme_location' => 'footer-links',             // Where it's located in the theme
        'depth' => 0,                                   // Limit the depth of the nav
    	'fallback_cb' => ''  							// Fallback function
	));
} /* End Footer Menu */

// The Footer Menu
function exchange_mobile_nav() {
    wp_nav_menu(array(
    	'container' => 'false',                         // Remove nav container
    	'menu' => __( 'Mobile Menu', 'exchange' ),   	// Nav name
    	'menu_class' => 'mobile-nav',      			    // Adding custom nav class
    	'theme_location' => 'mobile-nav',             // Where it's located in the theme
        'depth' => 0,                                   // Limit the depth of the nav
    	'fallback_cb' => ''  							// Fallback function
	));
} /* End Footer Menu */



// Header Fallback Menu
function exchange_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => '',      						// Adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                           // Before each link
        'link_after' => ''                             // After each link
	) );
}

// Footer Fallback Menu
function exchange_footer_links_fallback() {
	/* You can put a default here if you like */
}

// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );
