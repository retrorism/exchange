<?php
// SIDEBARS AND WIDGETIZED AREAS
function exchange_register_sidebars() {
	register_sidebar(array(
		'id' => 'footer-1',
		'name' => __('Footer 1', 'exchange'),
		'description' => __('Footer widget', 'exchange'),
		'before_widget' => '<div id="%1$s" class="footer__widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer__widget__title">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'footer-2',
		'name' => __('Footer 2', 'exchange'),
		'description' => __('Footer widget', 'exchange'),
		'before_widget' => '<div id="%1$s" class="footer__widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer__widget__title">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'footer-3',
		'name' => __('Footer 3', 'exchange'),
		'description' => __('Footer widget', 'exchange'),
		'before_widget' => '<div id="%1$s" class="footer__widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer__widget__title">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'footer-4',
		'name' => __('Footer 4', 'exchange'),
		'description' => __('Footer widget', 'exchange'),
		'before_widget' => '<div id="%1$s" class="footer__widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer__widget__title">',
		'after_title' => '</h4>',
	));

} // don't remove this bracket!
