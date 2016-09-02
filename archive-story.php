<?php get_header(); ?>

<main id="main" class="archive__wrapper" role="main">
	<div class="main-inner">
		<?php
		$args = array(
  			'name'        => 'stories',
  			'post_type'   => 'page',
			'post_status' => 'publish',
  			'numberposts' => 1
		);
		$stories_page = get_posts( $args );
		if ( $stories_page ) :
			$exchange = BaseController::exchange_factory( $stories_page[0] );
			include_once( get_stylesheet_directory() . '/parts/content-page-header.php' );
		endif; ?>

		<?php get_template_part('parts/loop','featured-stories'); ?>

		<?php if (have_posts()) : ?>
		<?php $colour = $GLOBALS['EXCHANGE_PLUGIN_CONFIG']['COLOURS']['blue-1-web']; ?>
		<section class="section--story-grid section--has_grid section--blue-1-web">
			<?php echo BasePattern::build_edge_svg('top', '#' . $colour ); ?>
			<div class="section-inner">
				<?php get_template_part( 'parts/content', 'archive-filters'); ?>
				<div class="archive__grid" data-masonry='{ "itemSelector": ".archive__grid__griditem" }'>
				<?php while (have_posts()) : the_post(); ?>

					<!-- To see additional archive styles, visit the /parts directory -->
					<?php $featured_posts = get_option('options_featured_stories'); ?>
					<?php include( get_stylesheet_directory() . '/parts/loop-archive-grid.php' ); ?>

				<?php endwhile; ?>
				</div>

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
