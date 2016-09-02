<?php get_header(); ?>

<main id="main" class="archive__wrapper  " role="main">
	<div class="main-inner">
		<?php
		$args = array(
			'name'        => 'collaborations',
			'post_type'   => 'page',
			'post_status' => 'publish',
			'numberposts' => 1
		);
		$collaborations_page = get_posts( $args );
		if ( $collaborations_page ) : ?>
			<?php $exchange = BaseController::exchange_factory( $collaborations_page[0] ); ?>

			<?php include_once( get_stylesheet_directory() . '/parts/content-page-header.php' ); ?>
		<?php else: ?>
			<?php get_template_part( 'parts/content', 'archive-header'); ?>
		<?php endif; ?>
		<?php if ( is_post_type_archive('collaboration' ) ) : ?>
			<?php get_template_part( 'parts/content', 'archive-map'); ?>
			<section class="archive__interface-wrapper section--blue-1-web section--coloured">
			<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
				<div class="archive__view__toggle">
					<small><a class="grid-toggle active" data-exchange-toggle="archive__view--grid"><?php _e('Show on the grid', 'exchange' ); ?></a></small>
					<small><a class="map-toggle" data-exchange-toggle="archive__view--map"><?php _e('Show on the map', 'exchange' ); ?></a></small>
				</div>

		<?php else: ?>

		<section class="archive__interface-wrapper section--blue-1-web section--coloured">
				<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
		<?php endif; ?>
			<div class="section-inner">
			<?php get_template_part( 'parts/content', 'archive-filters'); ?>

		    <?php if (have_posts()) : ?>

				<div class="archive__grid" id="archive__view--grid">
					<div class="masonry-wrapper">

						<div class="masonry">

						<?php while (have_posts()) : the_post(); ?>

						<?php get_template_part( 'parts/loop', 'archive-grid' ); ?>

						<?php endwhile; ?>

						</div><!--masonry-->

					</div>
					<div class="button-wrapper">
						<?php exchange_create_archive_button(); ?>
					</div>

				<?php else : ?>

					<?php get_template_part( 'parts/content', 'missing' ); ?>

			<?php endif; ?>
				</div><!-- end archive__grid -->

			</div><!-- section-inner -->


			<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
		</section><!--archive__interface-wrapper-->
	</div> <!-- end .main-inner -->
</main> <!-- end #main -->

<?php get_footer(); ?>
