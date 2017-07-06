<?php get_header(); ?>

<main id="main" class="archive__wrapper" role="main" data-toggler=".facets-active">

	<div class="main-inner">

		<?php
		$args = array(
			'name'        => 'stories',
			'post_type'   => 'page',
			'post_status' => 'private',
			'numberposts' => 1
		);
		$get_stories_page = get_posts( $args );
		if ( $get_stories_page ) :
			$exchange = BaseController::exchange_factory( $get_stories_page[0] );
			include_once( get_stylesheet_directory() . '/parts/content-page-header.php' );
			include_once( get_stylesheet_directory() . '/parts/loop-featured-stories.php' ); ?>

		<?php else: ?>

			<?php get_template_part( 'parts/content', 'archive-header'); ?>

		<?php endif; ?>


		
		<?php if ( function_exists( 'facetwp_display' ) ) : ?>

			<?php get_template_part( 'parts/nav', 'facets' ); ?>

		<?php endif; ?>

		<div class="archive__info-and-controls">
			<div class="archive__active-facet-summary"></div>
		</div>
		
		<?php if (have_posts()) : ?>
		
			<?php get_template_part( 'parts/content', 'archive-interface' ); ?>

		<?php else : ?>

			<?php get_template_part( 'parts/content', 'missing' ); ?>

		<?php endif; ?>

		<footer class="archive__footer">

			<section class="archive__footer__section footer__section">

				<div class="section-inner">

					<?php get_template_part( 'parts/content','story-share-cta' ); ?>

				</div>

			</section>

		</footer>

	</div> <!-- end .main-inner -->

</main> <!-- end #main -->

<?php get_footer(); ?>
