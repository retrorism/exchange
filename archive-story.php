<?php get_header(); ?>

<main id="main" class="archive__wrapper" role="main">
	<div class="main-inner">
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
				<?php get_template_part( 'parts/loop', 'archive-grid' ); ?>

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
