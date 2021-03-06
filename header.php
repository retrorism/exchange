<!DOCTYPE html>
<!--#if expr="$HTTP_COOKIE=/fonts\-loaded\=true/" -->
<html lang="en" class="no-js fonts-loaded" <?php language_attributes(); ?>>
<!--#else -->
<html lang="en" class="no-js" <?php language_attributes(); ?>>
<!--#endif -->
	<head>
		<meta charset="utf-8">

		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Facebook -->
		<?php if ( is_front_page() ) : ?>
			<meta property="og:url" content="<?php echo esc_url( home_url() ); ?>" />
			<meta property="og:image" content="<?php echo esc_url( home_url('/site/wp-content/themes/exchange/assets/images/png/T_logo_Inverse_2016.png') ); ?>" />
			<meta property="og:description" content="<?php _e('Tandem is a cultural collaboration programme that strengthens civil society in Europe and neighbouring regions.', 'exchange'); ?>" />

		<?php else : ?>
			<?php if ( is_single() || is_page() ) : ?>
	        	<meta property="og:url" content="<?php the_permalink(); ?>" />
				<meta property="og:type" content="article" />
			<?php endif; ?>
			<?php if ( function_exists( 'exchange_get_share_title' ) && ( is_single() || is_page() ) ) : ?>
				<meta property="og:title" content="<?php exchange_get_share_title(); ?>" />
			<?php endif; ?>
			<?php if ( function_exists( 'exchange_get_share_description' ) ) : ?>
				<meta property="og:description" content="<?php exchange_get_share_description(); ?>" />
			<?php endif; ?>
			<?php if ( function_exists( 'exchange_get_share_image' ) ) : ?>
				<meta property="og:image" content="<?php exchange_get_share_image(); ?>" />
			<?php endif; ?>
		<?php endif; ?>


		<!-- If Site Icon isn't set in customizer -->
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
			<!-- Icons & Favicons -->
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
			<link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png" rel="apple-touch-icon" />
			<!--[if IE]>
				<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
			<![endif]-->
			<meta name="msapplication-TileColor" content="#f01d4f">
			<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">
	    	<meta name="theme-color" content="#121212">
	    <?php } ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<script>
			var doc = document.body || document.documentElement;
			var style = doc.style;	

			if ( style.webkitFlexWrap === '' || style.msFlexWrap === '' || style.flexWrap === '' ) { 
			    doc.className += " supports-flex";
			}
			/*! loadJS: load a JS file asynchronously. [c]2014 @scottjehl, Filament Group, Inc. (Based on http://goo.gl/REQGQ by Paul Irish). Licensed MIT */
			(function( w ){
			var loadJS = function( src, cb ){
				"use strict";
				var ref = w.document.getElementsByTagName( "script" )[ 0 ];
				var script = w.document.createElement( "script" );
				script.src = src;
				script.async = true;
				ref.parentNode.insertBefore( script, ref );
				if (cb && typeof(cb) === "function") {
					script.onload = cb;
				}
				return script;
			};
			// commonjs
			if( typeof module !== "undefined" ){
				module.exports = loadJS;
			}
			else {
				w.loadJS = loadJS;
			}
			}( typeof global !== "undefined" ? global : this ));

			/* Lazy loading */
			//loadJS( "<?php echo get_template_directory_uri(); ?>/vendor/vanilla-lazyload/dist/vanilla-lazyload.js", function() {});
			loadJS( "<?php echo get_template_directory_uri(); ?>/vendor/picturefill/dist/picturefill.min.js", function() {});
			loadJS( "<?php echo get_template_directory_uri(); ?>/vendor/lazysizes/lazysizes.min.js", function() {});
			loadJS( "<?php echo get_template_directory_uri(); ?>/vendor/fontfaceobserver/fontfaceobserver.js", function() {});
			loadJS( "<?php echo get_template_directory_uri(); ?>/vendor/what-input/what-input.min.js", function() {});

		</script>

		<?php wp_head(); ?>
		<!-- http://labs.jonsuh.com/font-loading-with-font-events/ -->
		<style>
			@import url(https://fonts.googleapis.com/css?family=Open+Sans:600,600italic,400,300,300italic,700,700italic,400italic&subset=latin,cyrillic);
			body {
			font-family: sans-serif;
			}
			.fonts-loaded body {
				font-family: Open Sans, sans-serif;
			}
		</style>




		<!-- Drop Google Analytics here -->
<!-- 		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-83933329-1', 'auto');
			ga('send', 'pageview');
		</script> -->
		<!-- end analytics -->

	</head>

	<body <?php body_class(); ?>>
		<header id="header" role="banner">
			<div class="inner-header">
				<?php get_template_part( 'parts/nav', 'topbar' ); ?>
			</div> <!-- end .inner-header -->
		</header> <!-- end #header -->
