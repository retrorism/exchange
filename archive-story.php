<?php get_header(); ?>

<main id="main" class="archive__wrapper" role="main">
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

		<?php if (have_posts()) : ?>
		<?php $colour = $GLOBALS['EXCHANGE_PLUGIN_CONFIG']['COLOURS']['blue-1-web']; ?>
		<section class="section--story-grid section--has_grid section--blue-1-web">
			<?php echo BasePattern::build_edge_svg('top', '#' . $colour ); ?>
			<div class="section-inner">
				<?php get_template_part( 'parts/content', 'archive-filters' ); ?>
				<?php get_template_part( 'parts/content', 'archive-grid' ); ?>
			<?php exchange_page_navi(); ?>
			</div>
			<?php echo BasePattern::build_edge_svg('top', '#' . $colour ); ?>
		</section>
		<?php else : ?>

			<?php get_template_part( 'parts/content', 'missing' ); ?>

		<?php endif; ?>
	</div> <!-- end .main-inner -->
</main> <!-- end #main -->

<?php get_footer(); ?>
