<?php get_header(); ?>

<main id="main" class="archive__wrapper" role="main">
	<div class="main-inner">
		<?php
		// Get Stories page header content.
		$args = array(
  			'name'        => 'stories',
  			'post_type'   => 'page',
			'post_status' => 'publish',
  			'numberposts' => 1
		);
		$stories_query = new WP_Query( $args );
		if ( $stories_query->have_posts ) :
			$exchange = BaseController::exchange_factory( $stories_query->posts[0] );
			include_once( get_stylesheet_directory() . '/parts/content-page-header.php' );
		endif; ?>

		<?php get_template_part('parts/loop','featured-stories'); ?>
		<?php if (have_posts()) : ?>
		<section class="section--story-grid section--has_grid section--blue-1-web">
			<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex('blue-1-web') ); ?>
			<div class="section-inner">
				<?php get_template_part( 'parts/content', 'archive-filters'); ?>
				<div class="archive__grid">
					<div class="masonry">

					<?php while (have_posts()) : the_post(); ?>

						<!-- To see additional archive styles, visit the /parts directory -->
						<?php $featured_posts = get_option('options_featured_stories'); ?>
						<?php include( get_stylesheet_directory() . '/parts/loop-archive-grid.php' ); ?>

					<?php endwhile; ?>

					</div><!--masonry-->
					<div class="button-wrapper">
						<?php exchange_create_archive_button(); ?>
					</div>
				<?php else : ?>

					<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>
			</div><!-- end .archive__grid-->

			</div>

			<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex('blue-1-web') ); ?>
		</section>

	</div> <!-- end .main-inner -->
</main> <!-- end #main -->

<?php get_footer(); ?>
