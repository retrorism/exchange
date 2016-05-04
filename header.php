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
		<!-- end analytics -->

	</head>

	<body <?php body_class(); ?>>
		<header id="header" role="banner">
			<div class="inner-header">
				<?php get_template_part( 'parts/nav', 'topbar' ); ?>
			</div> <!-- end .inner-header -->
		</header> <!-- end #header -->
